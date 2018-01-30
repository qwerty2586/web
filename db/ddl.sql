

PRAGMA writable_schema = 1;
delete from sqlite_master where type in ('table', 'index', 'trigger');
PRAGMA writable_schema = 0;


CREATE TABLE users (
  iduser integer PRIMARY KEY AUTOINCREMENT,
  name varchar,
  login varchar UNIQUE,
  password varchar,
  email varchar,
  idright integer
);

CREATE TABLE rights (
  idright integer PRIMARY KEY AUTOINCREMENT,
  label varchar,
  weight integer
);

CREATE TABLE ratings (
  idrating integer PRIMARY KEY AUTOINCREMENT,
  iduser integer,
  idarticle integer,
  quality integer,
  length integer,
  interesting integer,
  review varchar,
  finished integer
);

CREATE TABLE articles (
  idarticle integer PRIMARY KEY AUTOINCREMENT,
  iduser integer,
  name varchar,
  aprouval integer,
  filename varchar
);
