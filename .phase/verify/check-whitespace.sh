#!/usr/bin/env bash
# Хвостовые пробелы и маркеры конфликтов слияния в переданных путях.
set -euo pipefail
for path in "$@"; do
  [[ -e "$path" ]] || continue
  case "$path" in *.png|*.jpg|*.jpeg|*.webp|*.svg|*.bin|*.woff|*.woff2|*.lock) continue ;; esac
  if grep -RInE '[[:blank:]]$|^(<<<<<<<|=======|>>>>>>>)( |$)' -- "$path"; then
    echo "ERROR: whitespace/conflict marker in $path"
    exit 1
  fi
done
