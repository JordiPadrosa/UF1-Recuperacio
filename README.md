# Prova UF1 - Segona convocatòria
## DAW-MP07-UF1 - Exercici de Desenvolupament web en entorn servidor.

Abans de res instal·la el [següent programa](https://obsproject.com/) o fes servir el teu programa per gravar la pantalla preferit. Quan acabis la prova guarda el vídeo a la següent [carpeta del drive](https://drive.google.com/drive/u/1/folders/17uNnVJmGe2c89mZdnP9aqe6ePTeivuMm). Recorda que has de realitzar una captura de la pantalla completa!
Durant la prova no es permet l'ús d'intel·ligència artificial (només aquella integrada l'IDE). Tampoc es permet la comunicació entre alumnes.

L'objectiu és crear un sistema d'accés protegit per capcha. Un company ja ha implementat els aspectes visuals de la nostra aplicació i només caldrà afegir-hi funcionalitat a la banda del servidor. Disposem dels següents fitxers
([Baixa`ls](https://downgit.github.io/#/home?url=https://github.com/aniollidon/gitbook-php/tree/master/activitats/DAW-MP07/DAW-MP07-UF1/prova-uf1-REC)):
+ `index.php`
+ `access.php`
+ `style.css`
+ Carpeta `captcha` amb les imatges capcha on el nom és el codi que cal introduir per accedir.

Podem llistar el contingut de la carpeta captcha amb el següent codi: 
```php
$dir = "captcha/";
$files = scandir($dir);
foreach ($files as $file) {
    if ( $file != "." && $file != "..") {
        echo "<img src='$dir/$file' alt=''>";
    }
}
```

## Es demana:

1. Assegura't que el fitxer `index.php` carrega una imatge capcha de la carpeta corresponent. Aquesta imatge ha de ser diferent cada vegada que es recarregui la pàgina. **(1 punt)**  
1. Crea el fitxer `process.php` on s'implementa la funcionalitat de comprovar les dades del capcha. **(4 punts)**
    + Assegura't que `process.php` rep les dades mitjançant el mètode `POST`
    + Utilitza el patró PGR i redirigeix a `acces.php` quan l'autenticació sigui correcta, i retorna a `index.php` quan aquesta sigui incorrecte.
    + Assegura't que `process.php` redirigeix a `index.php` quan no rep les dades mitjançant el mètode `POST`
    + Comprova que el codi capcha introduït per l'usuari és correcte sense tenir en compte majúscules i minúscules. 
    + Vigila que el codi capcha no es pugui obtenir llegint els paràmetres de GET o POST.
    + No es permeten més de 10 intents d'accés a `acces.php` per minut.
1. Manté l'autentificació activa mitjançant l'ús de sessions durant 1 minut. **(1 punt)**
    + L'accés a `index.php` redirigeix a `acces.php` si fa menys d'un minut des de l'última autentificació.
    + l'accés a `acces.php` redirigeix a `index.php` si l'autentificació no està activa.
1. Permet desautentificar-te mitjanant el botó "torna a l'inici" de la pàgina `acces.php`. **(1 punt)**
    + Aquest formulari també funcionarà amb el mètode `POST` i ens enviarà a `process.php`.
1. Mostra el nombre d'intents d'accés a `acces.php`.  **(1 punt)**
    + Mostra el numeral (1r, 2n, 3r... ) en funció del nombre d'intents.
1. Avisa a l'usuari dels errors en el procés. **(1 punt)**
    + Aquesta informació, cal que s'enviï mitjançant el mètode GET
    + L'accés incorrecte s'ha de mostrar diferent del final de l'autentificació.
    + Cal que el missatge d'error segueixi la línia de disseny de la pàgina.
1. Assegura't que el codi estigui ben documentat, segeixi un mateix format i que compleixi amb els requisits de claredat, la llegibilitat i l'eficiència. **(1 punt)**

## Cal tenir en compte:
+ Al treball entregat no pot aparèixer cap error o warning de PHP.
+ Cal penjar la gravació de la pantalla a la carpeta corresponent del drive. 
+ Recorda penjar l'enllaç del teu github al Classroom.