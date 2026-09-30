#!/usr/bin/env bash
# Запуск критика (Codex) по этапу. Только чтение.
# Использование: .phase/critic.sh <STAGE_ID> [BASE_BRANCH]
set -euo pipefail

ID="${1:?stage id required}"
BASE="${2:-main}"
ROOT="$(git rev-parse --show-toplevel)"
cd "$ROOT"

# shellcheck disable=SC1091
[[ -f .phase/env ]] && source .phase/env
MODEL="${CRITIC_MODEL:-astra-sol-6.1}"
RUNTIME=".phase/runtime"
STAGE_FILE=".phase/stages/$ID.md"
DIFF="$RUNTIME/$ID.diff"
OUT="$RUNTIME/$ID.critic.md"

mkdir -p "$RUNTIME"
test -f "$STAGE_FILE" || { echo "ERROR: no $STAGE_FILE"; exit 2; }

git diff "$BASE...HEAD" > "$DIFF"
test -s "$DIFF" || { echo "ERROR: empty diff vs $BASE"; exit 2; }

PROMPT="$(cat .phase/prompts/critic.md)

STAGE_FILE: $STAGE_FILE
ARCHITECTURE: ARCHITECTURE.md
DECISIONS: .phase/DECISIONS.md
DIFF: $DIFF"

codex exec --model "$MODEL" --sandbox read-only --output-last-message "$OUT" "$PROMPT"

VERDICT="$(head -n1 "$OUT" | tr -d '\r')"
case "$VERDICT" in
  "VERDICT: PASS")        echo PASS; exit 0 ;;
  "VERDICT: FAIL")        echo FAIL; exit 1 ;;
  "VERDICT: NEEDS_HUMAN") echo NEEDS_HUMAN; exit 3 ;;
  *) echo "NEEDS_HUMAN (bad format: $VERDICT)"; exit 3 ;;
esac
