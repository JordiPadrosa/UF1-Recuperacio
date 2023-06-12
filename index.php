<?php
    session_start();
    // Si el temps de la Sessio és superior a 1 minut destrueix la sessio, sinó redirecciona hola.php
    $tempsMax = 60;
    if(isset($_SESSION["temps"])){
        $tempsSessio = time() - $_SESSION["temps"];
        if($tempsSessio > $tempsMax){
            session_destroy(); 
        }else{
            header("Location: acces.php");
        }
    }
    // Si el temps de l'Acces és superior a 1 minut destrueix la sessio perquè pugui a tornar a intentar-ho
    if(isset($_SESSION["temps_acces"])){
        $tempsAcces = time() - $_SESSION["temps_acces"];
        if($tempsAcces > $tempsMax){
            session_destroy(); 
        }
    }
    // Segons el $_GET crida la funcio error() i li passa l'string corresponent
    if(isset($_GET["captcha_erroni"])){
        error("El captcha es erroni");
    }elseif(isset($_GET["masses_intents"])){
        error("Masses intents");
    }
    // Retorna una imatge aleatoria de la carpeta captcha
    function imgAleatoria() {
        $dir = "captcha/";
        $imatges = scandir($dir);
        $img = $dir . $imatges[rand(0, count($imatges) - 1)];
        if(isset($_SESSION["img"])){
            while ($_SESSION["img"] == $img) {
                $img = $dir . $imatges[rand(0, count($imatges) - 1)];
            }
        }
        $_SESSION["captcha"] = substr($img, 8, 5);
        return $img;
    }
    // Escriu l'error
    function error($error){
        ?>
        <div>
            <h1><?php echo $error ?></h1>        
      </div><?php
    }
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Accés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form class="divform" action="process.php" method="post">
            <h1>Registra't</h1>
            <span>crea un compte d'usuari</span>
            <input type="hidden" name="method" value="signup"/>
            <input type="text" placeholder="Nom" />
            <input type="email" placeholder="Correu electronic" />
            <input type="password" placeholder="Contrasenya" />
            <button>Registra't</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form class="divform" action="process.php" method="post">
            <input type="hidden" name="method" value="comprovar"/>
            <h1>Ets humà?</h1>
            <br>
            <span>Introdueix els caràcters presents a la imatge</span>
            <input type="text" name="captcha" placeholder="Caràcters" />
            <?php
                if(!isset($_GET["masses_intents"])){
                    ?>
                    <button>Continua</button>
                    <?php
                }
            ?>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <div class="capcha-container">
                    <form action="process.php" method="POST" type="hidden">
                        <input type="hidden" name="method" value="refresh"/>
                        <button class="capcha-refresh"><i class="fa fa-refresh"></i></button>
                    </form>
                    <?php
                     // TODO: Proveïr imatge capcha aleatòria
                        if(isset($_SESSION["refresh"])){
                            if($_SESSION["refresh"] == "true"){
                                $_SESSION["img"] = imgAleatoria();
                            } 
                        }else{
                            $_SESSION["img"] = imgAleatoria();
                        }
                    ?>
                    <img src="<?php echo $_SESSION["img"] ?>">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>