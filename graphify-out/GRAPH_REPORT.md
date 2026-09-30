# Graph Report - www  (2026-07-30)

## Corpus Check
- 451 files · ~1,174,631 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 897 nodes · 781 edges · 446 communities (432 shown, 14 thin omitted)
- Extraction: 97% EXTRACTED · 3% INFERRED · 0% AMBIGUOUS · INFERRED: 20 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `ee21410f`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Installer
- PHPMailer
- phpmailer/composer.json
- SMTP
- ClassLoader
- self
- Editing this README
- PHPMailer – A full-featured email creation and transfer class for PHP
- CIBlockNewProperty
- init.php
- POP3
- YandexKitHandler
- Version20260730120000
- BuildSotbitLinkByProps
- DSNConfigurator
- SefRedirector
- OAuth
- seoMod
- debug.php
- ComposerAutoloaderInitee666ded0e8bbbebb5554160f5f1199c
- require
- SECURITY.md

## God Nodes (most connected - your core abstractions)
1. `PHPMailer` - 123 edges
2. `SMTP` - 42 edges
3. `ClassLoader` - 27 edges
4. `Installer` - 22 edges
5. `PHPMailer – A full-featured email creation and transfer class for PHP` - 16 edges
6. `InstalledVersions` - 15 edges
7. `Editing this README` - 14 edges
8. `POP3` - 12 edges
9. `process()` - 10 edges
10. `out()` - 10 edges

## Surprising Connections (you probably didn't know these)
- None detected - all connections are within the same source files.

## Import Cycles
- None detected.

## Communities (446 total, 14 thin omitted)

### Community 0 - "Installer"
Cohesion: 0.08
Nodes (20): checkParams(), checkPlatform(), displayHelp(), ErrorHandler, getHomeDir(), getOptValue(), getPlatformIssues(), getUserDir() (+12 more)

### Community 2 - "phpmailer/composer.json"
Cohesion: 0.04
Nodes (44): dealerdirect/phpcodesniffer-composer-installer, authors, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+36 more)

### Community 4 - "ClassLoader"
Cohesion: 0.07
Nodes (3): ComposerStaticInitee666ded0e8bbbebb5554160f5f1199c, ClassLoader, includeFile()

### Community 5 - "self"
Cohesion: 0.13
Nodes (4): Composer\Semver\VersionParser, PagenMeta, InstalledVersions, self

### Community 7 - "Editing this README"
Cohesion: 0.10
Nodes (20): Add your files, Authors and acknowledgment, Badges, Collaborate with your team, Contributing, Description, Editing this README, Getting started (+12 more)

### Community 8 - "PHPMailer – A full-featured email creation and transfer class for PHP"
Cohesion: 0.10
Nodes (19): A Simple Example, Changelog, Contributing, Documentation, Features, History, Installation & loading, Legacy versions (+11 more)

### Community 14 - "YandexKitHandler"
Cohesion: 0.31
Nodes (4): Bitrix\Main\Request, Bitrix\Sale\Payment, Bitrix\Sale\PaySystem\ServiceHandler, YandexKitHandler

### Community 15 - "Version20260730120000"
Cohesion: 0.24
Nodes (3): Version20260729140000, Version20260730120000, Version

## Knowledge Gaps
- **69 isolated node(s):** `phpmailer/phpmailer`, `name`, `type`, `description`, `authors` (+64 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **14 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `PHPMailer` connect `PHPMailer` to `SMTP`, `.lang`, `.preSend`, `.createBody`, `init.php`, `DSNConfigurator`, `.msgHTML`, `.addOrEnqueueAnAddress`?**
  _High betweenness centrality (0.079) - this node is a cross-community bridge._
- **Why does `SMTP` connect `SMTP` to `CIBlockNewProperty`, `init.php`?**
  _High betweenness centrality (0.033) - this node is a cross-community bridge._
- **Why does `InstalledVersions` connect `self` to `ClassLoader`?**
  _High betweenness centrality (0.022) - this node is a cross-community bridge._
- **Are the 17 inferred relationships involving `self` (e.g. with `.sotbitRedirect()` and `.getTlsStreamContextDefaults()`) actually correct?**
  _`self` has 17 INFERRED edges - model-reasoned connections that need verification._
- **What connects `phpmailer/phpmailer`, `name`, `type` to the rest of the system?**
  _69 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Installer` be split into smaller, more focused modules?**
  _Cohesion score 0.07744107744107744 - nodes in this community are weakly interconnected._
- **Should `PHPMailer` be split into smaller, more focused modules?**
  _Cohesion score 0.04242424242424243 - nodes in this community are weakly interconnected._