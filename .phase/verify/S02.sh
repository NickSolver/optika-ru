#!/usr/bin/env bash
set -euo pipefail
cd "$(git rev-parse --show-toplevel)"
bash .phase/verify/ro-report.sh S02 \
  '## Правила urlrewrite' '## Каталог' '## Контент' '## Sitemap и robots' \
  '## SEO-поля' '## Редиректы' '## Сопоставление с дизайном' '## Неизвестно'
CSV=.phase/results/S02/urls.csv
test -f "$CSV" || { echo "ERROR: нет $CSV"; exit 1; }
head -n1 "$CSV" | grep -qx 'url_pattern;пример;обработчик;vue_page;в_sitemap' || { echo "ERROR: заголовок CSV"; exit 1; }
[[ "$(wc -l < "$CSV")" -ge 10 ]] || { echo "ERROR: в urls.csv меньше 9 строк данных"; exit 1; }
echo "S02 urls.csv: PASS"
