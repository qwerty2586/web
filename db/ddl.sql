

PRAGMA writable_schema = 1;
delete from sqlite_master where type in ('table', 'index', 'trigger');
PRAGMA writable_schema = 0;


CREATE TABLE uzivatele (
  iduzivatel integer PRIMARY KEY AUTOINCREMENT,
  jmeno varchar,
  login varchar UNIQUE,
  heslo varchar,
  email varchar,
  idprava integer
);

CREATE TABLE prava (
  idprava integer PRIMARY KEY AUTOINCREMENT,
  nazev varchar,
  vaha integer
);

CREATE TABLE hodnoceni (
  idhodnoceni integer PRIMARY KEY AUTOINCREMENT,
  iduzivatel integer,
  idprispevek integer,
  kvalita integer,
  delka integer,
  zajimavost integer,
  slovni_hodnoceni varchar
);

CREATE TABLE prispevky (
  idprispevek integer PRIMARY KEY AUTOINCREMENT,
  iduzivatel integer,
  aprouval varchar,
  filename varchar
);
