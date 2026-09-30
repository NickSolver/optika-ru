#!/usr/bin/env bash
# Проверка, что всё готово к запуску оркестратора. Ничего не меняет.
set -uo pipefail
cd "$(git rev-parse --show-toplevel 2>/dev/null)" || { echo "FAIL: запускать из корня git-репозитория сайта"; exit 1; }

FAIL=0
ok()   { printf '  ok    %s\n' "$1"; }
bad()  { printf '  FAIL  %s\n' "$1"; FAIL=1; }
warn() { printf '  warn  %s\n' "$1"; }

echo "Инструменты:"
for t in git php node npm claude codex mysql; do
  command -v "$t" >/dev/null && ok "$t" || bad "$t не найден"
done
if command -v node >/dev/null; then
  NV="$(node -p 'process.versions.node.split(".")[0]')"
  [[ "$NV" -ge 20 ]] && ok "node $NV" || bad "node $NV, нужен >= 20"
fi
command -v docker >/dev/null && ok docker || warn "docker не найден (понадобится с S10)"

echo "Репозиторий:"
git rev-parse --verify -q main >/dev/null && ok "ветка main" || bad "нет ветки main"
[[ -z "$(git status --porcelain)" ]] && ok "рабочая копия чистая" || warn "есть незакоммиченные изменения"
[[ -f CLAUDE.md && -f ARCHITECTURE.md && -f COMPONENTS.md ]] && ok "документы в корне" || bad "нет CLAUDE.md/ARCHITECTURE.md/COMPONENTS.md в корне"
[[ -f .claude/agents/implementer.md ]] && ok "сабагент implementer" || bad "нет .claude/agents/implementer.md"
[[ -f design/t1/index.php ]] && ok "макет design/t1" || bad "нет design/t1/index.php"
git check-ignore -q .phase/env && ok ".phase/env в .gitignore" || bad ".phase/env не в .gitignore"

echo "БД:"
if [[ -f .phase/env ]]; then
  # shellcheck disable=SC1091
  source .phase/env
  if mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" -Nse 'SELECT COUNT(*) FROM b_iblock' >/dev/null 2>&1; then
    N="$(mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" -Nse 'SELECT COUNT(*) FROM b_iblock' 2>/dev/null)"
    ok "подключение, инфоблоков: $N"
  else
    bad "нет подключения к БД или нет таблицы b_iblock"
  fi
else
  bad "нет .phase/env (скопировать из .phase/env.example)"
fi

echo "Codex:"
codex --version >/dev/null 2>&1 && ok "codex $(codex --version 2>/dev/null | head -n1)" || bad "codex не отвечает"

echo
[[ "$FAIL" == 0 ]] && echo "preflight: PASS" || { echo "preflight: FAIL"; exit 1; }
