#!/usr/bin/env bash
set -euo pipefail
cd "$(git rev-parse --show-toplevel)"
bash .phase/verify/ro-report.sh S01 \
  '## Инфоблоки' '## Каталог и разделы' '## Свойства' '## ТП, цены, наличие' \
  '## Линзы и цвета' '## Контент' '## Заказы и формы' '## Факты для gate'"'"'ов' '## Неизвестно'
