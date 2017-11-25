## 1 Technologie

Povinně HTML5, CSS, PHP, MySQL (nebo jiná databáze) + volitelně šablony, JavaScript, AJAX apod.

## 2 Zadání samostatné práce

Možno volit mezi standardním a alternativními zadáními.

### 2.1 Standardní zadání - webové stránky konferenčního systému

- Vaším úkolem bude vytvořit webové stránky konference.  Téma konference si můžete zvolit libovolné.
- Uživateli systému budou autoři příspěvků (vkládají abstrakty a PDF dokumenty), recenzenti příspěvků (hodnotí příspěvky) a administrátoři (spravují uživatele, přiřazují příspěvky recenzentům a rozhodují o publikování příspěvků). Každý uživatel se bude do systému přihlašovat prostřednictvím uživatelského jména a hesla. Nepřihlášený uživatel vidí pouze publikované příspěvky.
- Nový uživatel se bude moci zaregistrovat, čímž získá status autora.
- Přihlášený autor vidí svoje příspěvky a stav, ve kterém se nacházejí (v recenzním řízení / přijat +hodnocení / odmítnut +hodnocení). Příspěvky může přidávat, editovat a volitelně i mazat.
- Přihlášený recenzent vidí příspěvky, které mu byly přiděleny k recenzi, a může je hodnotit (alespoň 3 kritéria). Pokud příspěvek nebyl dosud schválen, tak své hodnocení může změnit.
- Administrátor spravuje uživatele (určuje jejich role a může uživatele zablokovat či smazat), přiřazuje neschválené příspěvky recenzentům k ohodnocení (každý příspěvek bude recenzován minimálně třemi recenzenty) a na základě recenzí rozhoduje o přijetí nebo odmítnutí příspěvku. Přijaté příspěvky jsou automaticky publikovány ve veřejné části webu.
- Databáze musí obsahovat alespoň 3 tabulky dostatečně naplněné daty pro předvedení funkčnosti aplikace.

## 3 Nutné požadavky na všechny samostatné práce

- Práce musí být osobně předvedena cvičícímu a po schválení odevzdána na CourseWare či Portál.
- K práci musí být dodána dokumentace (viz dále) a skripty pro instalaci databáze (např. získané exportem databáze).
- Web musí dodržovat MVC architekturu.
- Pro práci s databází musí být využito PDO nebo jeho ekvivalent a používány předpřipravené dotazy (prepared statements).
- Web musí obsahovat responzivní design.
- Web musí obsahovat ošetření proti základním typům útoku (XSS, SQL injection).
- Web musí fungovat i s "ošklivými" URL adresami.

### 3.1 Dokumentace

K práci vytvořte dokumentaci, která bude obsahovat:

- Vaše jméno,  URL vytvořených stránek (pokud jsou na serveru students.kiv.zcu.cz), Váš email, datum vytvoření, název práce.
- popis použitých technologií - uveďte hlavně, v které části jste kterou technologii použili.
- popis adresářové struktury aplikace - co je v kterých adresářích a souborech.
- popis architektury aplikace - co mají na starosti které třídy (popř. lze využít i UML diagramy).
- u alternativního zadání uveďte celé, cvičícím schválené zadání práce.


Dokumentaci netiskněte, ale odevzdejte ji jako PDF.