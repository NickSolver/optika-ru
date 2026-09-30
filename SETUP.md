# Запуск процесса optika-lokamed.ru

Время на подготовку: 30–60 минут. Большая часть — загрузка дампа БД.

## 0. Что нужно на машине

Всё запускается на одной машине разработчика (Linux/macOS или WSL2).

| Инструмент | Версия | Проверка |
|---|---|---|
| git | любая | `git --version` |
| PHP CLI | как на проде | `php -v` |
| Node.js | 20+ | `node -v` |
| Claude Code | последняя | `claude --version` |
| Codex CLI | последняя, с доступом к Astra Sol 6.1 | `codex --version` |
| MySQL-клиент | любой | `mysql --version` |
| Docker | любой | `docker -v` |

Claude Code авторизован: `claude` → `/login`.
Codex авторизован: `codex login`.

## 1. Разложить архив в репозиторий сайта

Архив распаковывается **в корень git-репозитория сайта** — туда, где лежат `bitrix/`, `local/`, `upload/`.

```bash
cd ~/projects/optika-lokamed          # корень репозитория
git switch main
git pull
git switch -c phase/setup

unzip ~/Downloads/lokamed-phase.zip -d .
```

После распаковки:

```
./CLAUDE.md                  инструкция оркестратора (Claude Code читает сам)
./SETUP.md                   этот файл
./ARCHITECTURE.md            архитектура
./COMPONENTS.md              реестр Vue-компонентов
./.claude/agents/implementer.md   сабагент Sonnet
./.claude/settings.json      права: запрет правки bitrix/ и design/, запрет push
./design/t1/                 макет (только чтение)
./.phase/
    STAGES.md  STATE.md  DECISIONS.md
    stages/    S00–S02 + шаблон
    verify/    common, regress, ro-report, S00–S02
    prompts/critic.md
    critic.sh
    tools/preflight.sh
    env.example
```

Если в репозитории уже есть `CLAUDE.md` или `.claude/settings.json` — не затирай, пришли их мне, объединю.

## 2. .gitignore

```bash
cat >> .gitignore <<'EOF'

# phase process
.phase/env
.phase/runtime/
EOF
```

Проверь, что `bitrix/` и `upload/` уже в `.gitignore` (обычно да). `design/t1/` коммитим: исполнителю нужен макет.

## 3. Локальная БД

Нужна копия продовой БД. Этапы S00–S02 только читают её.

```bash
# 1. Снять дамп на проде (или взять свежий бэкап)
mysqldump --single-transaction --quick --default-character-set=utf8mb4 \
  -u USER -p DBNAME | gzip > lokamed.sql.gz

# 2. Поднять MariaDB локально (версию подобрать под прод)
docker run -d --name lokamed-db \
  -e MARIADB_ROOT_PASSWORD=lokamed -e MARIADB_DATABASE=lokamed \
  -p 3307:3306 mariadb:10.11 \
  --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci

# 3. Залить дамп (подождать ~10 с после старта контейнера)
gunzip -c lokamed.sql.gz | mysql -h127.0.0.1 -P3307 -uroot -plokamed lokamed

# 4. Параметры доступа
cp .phase/env.example .phase/env
```

В `.phase/env` поправь значения, если менял порт или пароль. Там же `CRITIC_MODEL` — имя модели критика так, как его принимает `codex exec --model`.

Дамп не коммитить. В нём персональные данные клиентов из заказов и форм.

## 4. Проверка готовности

```bash
bash .phase/tools/preflight.sh
```

Должно закончиться `preflight: PASS`. Каждая строка `FAIL` — что поправить.

## 5. Закоммитить каркас

```bash
git add CLAUDE.md SETUP.md ARCHITECTURE.md COMPONENTS.md .claude design .phase .gitignore
git commit -m "phase: каркас процесса, архитектура, макет"
git switch main
git merge --ff-only phase/setup
```

Каркас должен лежать в `main`: проверки сравнивают ветку этапа с `main`.

## 6. Запуск оркестратора

```bash
cd ~/projects/optika-lokamed
claude --model opus
```

Первое сообщение:

```
Прочитай CLAUDE.md, .phase/STATE.md, .phase/STAGES.md.
Запусти S00 по циклу из CLAUDE.md. После S00 остановись и покажи мне отчёт.
```

Что произойдёт:

1. Opus создаст ветку `stage/S00`.
2. Отдаст этап сабагенту `implementer` (Sonnet).
3. Sonnet напишет `.phase/results/S00/report.md` и `checkpoint.md`.
4. Opus запустит `.phase/verify/common.sh` и `.phase/verify/S00.sh`.
5. S00 — этап только для чтения, критик не запускается.
6. Opus покажет отчёт и обновит `STATE.md`.

Права на команды: `.claude/settings.json` разрешает проверки, git-коммиты и сборку без подтверждения. Остальное Claude Code спросит. `git push` запрещён — пушишь сам.

## 7. Дальше по этапам

| Шаг | Что делаешь ты |
|---|---|
| S00 готов | Читаешь `.phase/results/S00/report.md`. Отвечаешь на «Неизвестно», особенно про хостинг и Node |
| «Запусти S01 и S02» | Их можно параллельно: зависят только от S00 |
| S01, S02 готовы | Присылаешь мне три отчёта. Я закрываю gate'ы, пишу G1 — список решений для тебя |
| G1 | Принимаешь решения. Я пишу файлы этапов S10+ под реальные данные |
| S10+ | Opus гоняет цикл «Sonnet → verify → Codex». Ты подключаешься на `NEEDS_HUMAN` |

## 8. Если этап встал

Opus создаст `.phase/human/<ID>.md`: что сломалось, что пробовали, вопрос, варианты.

1. Ответ пишешь в `.phase/human/<ID>.response.md`.
2. Говоришь Opus: `Продолжи <ID>, ответ в .phase/human/<ID>.response.md`.

## 9. Полезные команды

```bash
bash .phase/verify/common.sh           # общие проверки текущей ветки
bash .phase/verify/S00.sh              # проверка конкретного этапа
bash .phase/critic.sh S10              # критик вручную (с S10)
cat .phase/runtime/S10.critic.md       # ответ критика
bash .phase/verify/regress.sh          # всё закрытое (в main)
```

## Частые проблемы

| Симптом | Причина | Что делать |
|---|---|---|
| `ERROR: empty diff vs main` у критика | этап не закоммичен в ветку | `git add` + `git commit` в `stage/<ID>` |
| `RO-этап изменил файлы` | исполнитель записал что-то вне `results/<ID>` | откатить лишнее: `git checkout main -- <файл>` |
| `NEEDS_HUMAN (bad format)` | критик ответил не по формату | посмотреть `.phase/runtime/<ID>.critic.md`, перезапустить |
| `codex: unknown model` | имя модели в `CRITIC_MODEL` не то | `codex --help`, поправить `.phase/env` |
| кракозябры в отчёте S01 | дамп залит не в utf8mb4 | перезалить с `--default-character-set=utf8mb4` |
