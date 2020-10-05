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



### 5. Ustvarjanje pinov in boardov
Pomemben del spletne strani pinidea so seveda pini. Ti si narejeni kot slika, ki ima dodane podatke o njej. 
> Na primer: Nekakšna slika s quotom bi imela naslov in opis tega kar prikazuje ali pripoveduje slika.

Te pine lahko uporabnik ustvari in potem se prikažejo na glavni strani. Te lahko uporabnik doda v svoje boarde. Board si prav tako uporabnik lahko ustvari. Pri boardu nastavi naslov in ali je ta board privaten ali javen. 

Poleg naslova in opisa pri posameznih pinih tudi piše, kdo je ta pin objavil. To deluje takole:
``` 
$query = "SELECT p.title, p.picture, p.description, u.nickname, u.avatar FROM pins p INNER JOIN users u ON u.id=p.user_id WHERE p.id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$pin]);

$pin_info = $stmt->fetch();
```
S tem SQL stavkom dobimo infomacije o pinu in kateri uporabnik je ta pin ustvaril.
Nato nam prikaže pin s pomočjo te kode:
```
<div class="pin-info-image">
            <img src="<?php echo $pin_info['picture']; ?>" style="height:auto;width:100%;">
</div>
```
In podatke o pinu s pomočjo te kode:
```
   <h3><?php echo $pin_info['title']; ?></h3>
   <h5 style="color:gray;"><?php echo $pin_info['description']; ?></h5>
   <hr>
   <div class="avatar" >
     <img src="<?php echo $pin_info['avatar']; ?>" style="height:80px;width:80px;border-radius:50%;">
   </div>
   <p><?php echo $pin_info['nickname']; ?></p>
   <hr>
```

### 6. Iskanje preko Search polja
Iskanje preko Search sem dodala, zato da če bi bilo kdaj pinov veliko, jih tako lažje poiščemo glede na to kaj želimo. To sem naredila na zelo enostaven način. S pomočjo SQL stavka, kjer sem primerjala z LIKE v naslovih pinov. Zato je dobro, da se pri pinih napiše dober in natančen naslov.

Po vpisu neke besede ali besedne zveze v Search polje se na search_index.php prenese to v spremenljivko $words:
```
$words = $_GET['searched'];
```

Nato pa se to uporabi v SQL stavku:
```
$query = "SELECT id,picture FROM pins WHERE title LIKE :words ORDER BY RAND()";
$words ="%$words%";
$stmt = $pdo->prepare($query);
$stmt ->bindValue(':words',$words);
$stmt->execute();
```

## 7. Credits
Pri prijavi s Twitterjem sem si veliko pomagala z video tutorialom: https://www.youtube.com/watch?v=ga4TTze4Nqg
