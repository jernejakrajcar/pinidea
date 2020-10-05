# pinidea
 ## PHP projekt - namenjen izdelavi podobne spletne strani kot je Pinterest
 
 Pinidiea je spletna aplikacija, kjer si lahko uporabnik ogleduje slike, tako imenovane pine, ki prikazujejo različne teme. Te pine si lahko uporabnik shrani v Boarde, ki lahko vsebujejo popolnoma različne pine. Kakor uporabniku najbolj paše. Pine, ki jih uporabnik sam ustvari jih lahko tudi sam doda na to aplikacijo.
 

### 1. Postavitev baze
Najprej sem ustvarila podatkovno bazo, kjer sem ustvaila tabele users, pins, boards, categories, countries in languages. To bazo sem nato vstavila v phpmyadmin na localhostu in nadaljevala s pisanjem kode v XAMPP. 


### 2. Header, Footer in Index
Naslednji korak je bil postavitev same spletne strani. Začela sem s headerjem, kjer sem tudi že navedla knjižnice, ki jih bom uporabljala vnaprej ter v footerju tudi povezave do skript za jquery in drugih knjižnic.

V samem index.php (torej na glavni strani) sem začela z izdelovanjem Grid tabele, zato ker sem želela, da se slike prikažejo na način Masonry položaja. Pri tem sem uporabila knjižnico s podatki:
 * Masonry PACKAGED v4.2.2
 * Cascading grid layout library
 * https://masonry.desandro.com
 * MIT License
 * by David DeSandro
 
### 3. Povezava na bazo
V database.php sem vpisala podatke za mojo bazo preko localhosta. Ter tudi dodala konfiguracijo za PDO.

Kar izgleda nekako takole:
```
$host = 'localhost';
$db   = 'pinterest';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
```
### 4. Prijava in registracija
Največ težav sem imela pri prijavi oz. bolj natančno pri prijavi preko drugih socialnih omrežij, kot sta Google in Twitter. Težave sem mela z callback Url-jem pri Twitterju in tudi s sprejemanjem podatkov, saj le te dobi samo enkrat preko klica API-ja. 

Pri prijavi s Twitterjem sem si veliko pomagala z video tutorialom: https://www.youtube.com/watch?v=ga4TTze4Nqg

### 5. Ustvarjanje pinov in boardov
Pomemben del spletne strani pinidea so seveda pini. Ti si narejeni kot slika, ki ima dodane podatke o njej. 
> Na primer: ![Quote_slika](https://www.google.si/search?hl=sl&tbm=isch&source=hp&biw=1920&bih=937&ei=Npl7X7ShLJGTlwSH84-ICw&q=quote&oq=quote&gs_lcp=CgNpbWcQAzICCAAyBQgAELEDMgIIADICCAAyAggAMgIIADICCAAyAggAMgIIADICCABQ4BxYySNgwShoAHAAeACAAUqIAegCkgEBNZgBAKABAaoBC2d3cy13aXotaW1nsAEA&sclient=img&ved=0ahUKEwi0lO20u57sAhWRyYUKHYf5A7EQ4dUDCAc&uact=5#imgrc=hzsZqJPT5RTpVM)
