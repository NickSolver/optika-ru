#!/usr/bin/env bash
# Общая проверка RO-этапа: отчёт с заголовками, checkpoint, изменения только в results/<ID>.
# Использование: ro-report.sh <ID> "<заголовок 1>" "<заголовок 2>" ...
set -euo pipefail
ID="${1:?id}"; shift
ROOT="$(git rev-parse --show-toplevel)"
cd "$ROOT"
DIR=".phase/results/$ID"

test -f "$DIR/report.md"     || { echo "ERROR: нет $DIR/report.md"; exit 1; }
test -f "$DIR/checkpoint.md" || { echo "ERROR: нет $DIR/checkpoint.md"; exit 1; }
head -n1 "$DIR/checkpoint.md" | grep -qxE 'STATUS: (DONE|BLOCKED|SPLIT_REQUIRED|AWAITING_USER_DECISION)' \
  || { echo "ERROR: checkpoint без статуса"; exit 1; }

for h in "$@"; do
  grep -qxF "$h" "$DIR/report.md" || { echo "ERROR: нет заголовка: $h"; exit 1; }
done

# Каждый раздел должен быть непустым
awk '/^## /{if(name!="" && n==0){print "ERROR: пустой раздел " name; bad=1} name=$0; n=0; next}
     NF{n++} END{if(name!="" && n==0){print "ERROR: пустой раздел " name; bad=1} exit bad}' "$DIR/report.md"

# RO: ничего вне results/<ID> и .phase/STATE.md
OUTSIDE="$(git diff --name-only main...HEAD | grep -vE "^(\.phase/results/$ID/|\.phase/STATE\.md$)" || true)"
[[ -z "$OUTSIDE" ]] || { echo "ERROR: RO-этап изменил файлы:"; echo "$OUTSIDE"; exit 1; }

# Доказательства: хотя бы по одному ФАКТ в отчёте
grep -q 'ФАКТ:' "$DIR/report.md" || { echo "ERROR: нет ни одного ФАКТ:"; exit 1; }

echo "$ID report: PASS"
