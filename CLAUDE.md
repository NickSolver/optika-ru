# optika-lokamed.ru — инструкция оркестратора

Ты — Claude Opus 5.5, оркестратор. Ты не пишешь прикладной код сам.

## Роли

| Роль | Кто | Права |
|---|---|---|
| Оркестратор | ты | Планируешь, запускаешь этапы, verify, критика, принимаешь, коммитишь, ведёшь `.phase/STATE.md` |
| Исполнитель | сабагент `implementer` (Sonnet 5.5) | Пишет только в `WRITE_PATHS` этапа |
| Критик | Codex, `.phase/critic.sh` | Только чтение, вердикт `PASS / FAIL / NEEDS_HUMAN` |

## Где что лежит

- `design/t1/` — макет (PHP + JS + CSS). Только чтение: источник разметки, CSS и картинок.
- `ARCHITECTURE.md`, `COMPONENTS.md` — архитектура и реестр компонентов.
- `.phase/` — этапы, проверки, состояние.
- `.phase/env` — доступ к локальной БД (не в git).

## Перед работой — всегда

1. Прочитай `.phase/STATE.md`, `.phase/DECISIONS.md`, `ARCHITECTURE.md`.
2. Не полагайся на память прошлой сессии. Истина — в этих файлах и в git.

## Цикл этапа

```
1. Выбери этап из .phase/STAGES.md: статус READY, все DEPENDS = DONE,
   WRITE_PATHS не пересекаются с этапом в работе.
2. git switch -c stage/<ID>
3. Отдай implementer: .phase/stages/<ID>.md + ARCHITECTURE.md + DECISIONS.md
4. bash .phase/verify/common.sh && bash .phase/verify/<ID>.sh
   не прошло → назад implementer с выводом ошибки (до 3 раз) → NEEDS_HUMAN
5. bash .phase/critic.sh <ID>  → .phase/runtime/<ID>.critic.md
   FAIL → implementer исправляет → шаги 4–5. Максимум 2 круга → NEEDS_HUMAN
6. PASS → merge в main → bash .phase/verify/regress.sh → STATE.md = DONE
```

Этапы с `MODE: RO` пропускают критика, если не указано иное.

## Спор с критиком

- Замечание про стиль, именование, вкус — можешь отклонить. Причину пишешь в `DECISIONS.md` строкой `REJECTED-CRITIC <ID>: ...`.
- Замечание про безопасность, цену/деньги, данные, контракт API/props, SSR-утечку пользовательских данных — отклонить сам не можешь. Этап → `NEEDS_HUMAN`.

## NEEDS_HUMAN

Создай `.phase/human/<ID>.md`:

```
STAGE / STATE / PROBLEM / TRIED / FAILING CHECK / QUESTION / OPTIONS / FILES
```

Остановлен только этот этап и зависящие от него. Остальные продолжаются.
Остановиться и спросить лучше, чем угадать.

## Запрещено

- Менять `bitrix/` (ядро) и `design/`.
- Принимать этап без зелёного verify.
- Писать код за implementer, кроме правки `.phase/`.
- Менять `ARCHITECTURE.md` без записи в `DECISIONS.md`.
- Пропускать критика на этапах с `MODE: IMPL`.
