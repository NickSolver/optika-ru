#!/usr/bin/env bash
# Общие проверки. Запускаются на каждом этапе перед verify/<ID>.sh.
# Проверка пропускается, только если её инструмента ещё нет в проекте (ранние этапы).
# После S11 (frontend) и S12 (php-тесты) пропуск = ошибка: см. REQUIRE_* ниже.
set -euo pipefail

ROOT="$(git rev-parse --show-toplevel)"
cd "$ROOT"

REQUIRE_FRONT="${REQUIRE_FRONT:-$( [[ -f frontend/package.json ]] && echo 1 || echo 0 )}"
REQUIRE_PHPTEST="${REQUIRE_PHPTEST:-$( [[ -f tests/php/run.sh ]] && echo 1 || echo 0 )}"

step() { printf '\n=== %s ===\n' "$1"; }

step "whitespace / conflict markers"
CHANGED="$(git diff --name-only main...HEAD 2>/dev/null || true)"
if [[ -n "$CHANGED" ]]; then
  # shellcheck disable=SC2086
  bash .phase/verify/check-whitespace.sh $CHANGED
fi

step "bitrix core and design untouched"
if grep -qE '^(bitrix|design)/' <<< "$CHANGED"; then
  echo "ERROR: изменён bitrix/ или design/"; exit 1
fi
echo ok

step "php -l (изменённые .php)"
while IFS= read -r f; do
  [[ "$f" == *.php && -f "$f" ]] && php -l "$f" >/dev/null
done <<< "$CHANGED"
echo ok

if [[ "$REQUIRE_FRONT" == 1 ]]; then
  step "frontend: typecheck, lint, unit, build"
  npm --prefix frontend run typecheck
  npm --prefix frontend run lint
  npm --prefix frontend run test:unit
  npm --prefix frontend run build
fi

if [[ "$REQUIRE_PHPTEST" == 1 ]]; then
  step "php tests"
  bash tests/php/run.sh
fi

step "forbidden patterns"
FAIL=0
if [[ -d frontend/src ]]; then
  # Пользовательские/недетерминированные вызовы вне onMounted ловит критик;
  # здесь — только то, что не допустимо нигде.
  if grep -RInE 'Access-Control-Allow-Origin:\s*\*' local frontend/src 2>/dev/null; then FAIL=1; fi
fi
if [[ -d local ]]; then
  if grep -RInE 'get_object_vars\s*\(|[^_]serialize\s*\(' local/php_interface/lib/Lokamed/Api local/php_interface/lib/Lokamed/Page 2>/dev/null; then FAIL=1; fi
fi
[[ "$FAIL" == 0 ]] || { echo "ERROR: forbidden pattern"; exit 1; }
echo ok

echo
echo "common: PASS"
