# RudFin

RudFin, a small bookkeeping web app of 2010 and 2011 on my RudWEb framework: daybooks with their
entries and the numbering of the daybooks, with the database schema and a user manual. A historical archive, kept
read-only: the PHP code of its time: not safe to deploy today, kept for its history.

## History

| Date | Commit | |
|---|---|---|
| 2010-09-29 | 1663c04 | the first commits: the folder and the database model |
| 2011-05-21 | a62b608 | the folder structure of the app, then the database work and adding books |
| 2011-05-22 | 28990bf | the daybook numbering, the last change |

## What is in it

- `src/FinApp/`: the app (controllers, modules, objects, the XHTML templates, the configs, the web root);
- `src/docs/tutorials/`: the manual pages for phpDocumentor;
- `extra/database/`: the MySQL Workbench model, the schema and a few queries.

The app runs on RudWEb, which is not in this repository: see
[rudweb-2009-2011](https://github.com/webservco-legacy/rudweb-2009-2011).

Left out of the whole history: the key and certificate of the development sandbox.

## How it was built

From my Subversion repository (r1 to r24), turned into git in 2026 (23 commits), the dates kept. The last
commit before this README sets LF line endings and indents with spaces (not in the third-party code).

## Third-party code

Bundled as it shipped, each under its own licence: jQuery 1.5 (MIT or GPL); the jQuery datePicker plugin by Kelvin Luck
(MIT or GPL) with its `date.js` by Jörn Zaefferer and Brandon Aaron.

## Licence

New BSD (see `LICENSE`), as the file headers say ("Copyright (c) 2008 - 2011, RudiSoft.Net", my company then); the
`LICENSE` file was added in 2026.
