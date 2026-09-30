#!/usr/bin/env bash
# Регресс после merge в main: common + все verify/<ID>.sh этапов в статусе DONE.
# Один прогон вместо цепочки «этап N вызывает этап N-1».
set -euo pipefail
ROOT="$(git rev-parse --show-toplevel)"
cd "$ROOT"

bash .phase/verify/common.sh

# e2e один раз на весь регресс, а не в каждом этапе
if [[ -f frontend/playwright.config.ts ]]; then
  npm --prefix frontend run test:e2e
fi

awk -F'|' '{id=$2; st=$3; gsub(/ /,"",id); gsub(/ /,"",st)} st=="DONE" && id ~ /^[A-Z][0-9]+$/ {print id}' .phase/STATE.md |
while read -r id; do
  f=".phase/verify/$id.sh"
  [[ -f "$f" ]] || continue
  echo "=== regress $id ==="
  SKIP_E2E=1 bash "$f"
done

echo "regress: PASS"
