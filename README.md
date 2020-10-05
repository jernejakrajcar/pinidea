# pinidea
 PHP projekt - namenjen izdelavi podobne spletne strani kot je Pinterest
 
 Pinidiea je spletna aplikacija, kjer si lahko uporabnik ogleduje slike, tako imenovane pine, ki prikazujejo različne teme. Te pine si lahko uporabnik shrani v Boarde, ki lahko vsebujejo popolnoma različne pine. Kakor uporabniku najbolj paše. Pine, ki jih uporabnik sam ustvari jih lahko tudi sam doda na to aplikacijo.
 

<h3>1.Postavitev baze</h3>
Najprej sem ustvarila podatkovno bazo, kjer sem ustvaila tabele users, pins, boards, categories, countries in languages. To bazo sem nato vstavila v phpmyadmin na localhostu in nadaljevala s pisanjem kode v XAMPP. 

<h3>2.Header, Footer in Index</h3>
Naslednji korak je bil postavitev same spletne strani. Začela sem s headerjem, kjer sem tudi že navedla knjižnice, ki jih bom uporabljala vnaprej ter v footerju tudi povezave do skript za jquery in drugih knjižnic.

V samem index.php (torej na glavni strani) sem začela z izdelovanjem Grid tabele, zato ker sem želela, da se slike prikažejo na način Masonry položaja. Pri tem sem uporabila knjižnico s podatki:
 * Masonry PACKAGED v4.2.2
 * Cascading grid layout library
 * https://masonry.desandro.com
 * MIT License
 * by David DeSandro
 
<h3>3.Povezava na bazo in session_start()</h3>
V database.php sem vpisala podatke za mojo bazo preko localhosta. Ter tudi dodala konfiguracijo za PDO.

Kar izgleda nekako takole:
<code>
 <?php

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
?>
</code>
