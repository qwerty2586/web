# KIV/WEB - Konferenční systém

Seminární práce na předmět KIV/WEB. Vypracoval Milan Hajžman.

## Zadání

Vaším úkolem bude vytvořit webové stránky konference.  Téma konference si můžete zvolit libovolné.

[Celé znění zadání.](SPECS.md)

## Struktura aplikace

```
|-- /css                 kaskádové styly
|-- /db
|   |-- db.sqlite        soubor databáze
|   |-- ddl.sql,dml.sql  iniciační skripty databáze
|
|-- /fonts               ikony bootstrapu
|-- /images              obrázky knihoven
|
|-- /js                  skripty třetích stran
|   |-- script.js        moje skripty
|
|-- /libs                sem se stáhnul composer
|
|-- /php                 moje php třídy
|-- /templates           šablony twigu
|-- /uploads             soubory nahrané autory
|-- /vendor              knihovny nahrané composerem(twig)
|
|
|-- articles.php,users.php,login.php 
                        
                         vstupní skripty programu
```
### Třída Context
Všechny třídy v aplikaci jsou chápany jako sigletony a poskytují aplikaci určitou funkcionalitu.
Context drží instance těchto tříd a jestliže nebyl singleton zatím vytvořen, 
pak zavolá Context konstruktor a uloží pro další použití. Tímto způsobem se minimalizuje vytváření nepoužívaných tříd.
Singletony si mezi sebou Context předávají a tak není zapotřebí používat globální scope.

Pokud například Renderer bude chtít databázi tak se při prvním volání připojení k databázi vytvoří, v každém dalším se předá z proměnné v Contextu.

### vstupní body
```
articles.php
users.php
login.php
```

  tyto skripty vždy vytvoří nový kontext a následují dvě možné situace na základě použitého http dotazu
- GET - z kontextu se zavolá třída Renderer která z šablon vytvoří příslušnou stránku
- POST - skript provede požadovanou operaci na základě zadaných parametrů a odpoví OK nebo chybovou hláškou.


## Použité technologie

Stránky generuji z šablon pomocí šablonovacího systému twig. Pro instalaci byl použit composer.
Všechny POST operace jsou prováděny AJAXem z jQuery. Na základě krátké odpovědi provede javascript navigační operaci(přechod na jinou stránku či znovunačtení té samé).
Cílem je eliminovat POST operace z historie prohlížeče.

Pro připojení k databázi používám PDO a jako databázi jsem si zvolil SQLite. V případě neexistujícího souboru se databáze vytvoří z přichystaných ddl a dml skriptů.

Na frontendu používám bootstrap a jQuery s pluginy dataTables a star-rating.

## Závěr
Aplikace by určitě snesla více péče.
 Jsem rád, že jsem si vyzkoušel nové technologie, například PDO.
 Nedávno jsem měl mořnost napsat si aplikaci v nodeJS a práce s ním byla o mnoho příjemnější než s php.