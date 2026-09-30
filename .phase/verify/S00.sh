#!/usr/bin/env bash
set -euo pipefail
cd "$(git rev-parse --show-toplevel)"
bash .phase/verify/ro-report.sh S00 \
  '## Репозиторий' '## Битрикс и модули' '## Свой код' '## Интеграции' \
  '## Хостинг' '## Факты для G-HOST и G-BX' '## Неизвестно'
