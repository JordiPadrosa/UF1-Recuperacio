<?php
session_start();
// Si el temps de la Sessio és superior a 1 minut destrueix la sessio i redirecciona a index.php
$tempsMax = 60;
if(isset($_SESSION["temps"])){
    $tempsSessio = time() - $_SESSION["temps"];
    if($tempsSessio > $tempsMax){
        session_destroy();
        header("Location: index.php"); 
    }
}else{
    header("Location: index.php");
}
switch($_SESSION["intents"]){
    case 1:
        $numeral = "r";
        break;
    case 2:
        $numeral = "n";
        break;
    case 3:
        $numeral = "r";
        break;
    case 4:
        $numeral = "t";
        break;
    default:
        $numeral = "è";
        break;
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
            <h1>Benvingut!</h1>
            <span>Enhorabona! ets humà!</span>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Has aconseguit accedir al <?php echo $_SESSION["intents"].$numeral ?> intent</h1>
                <br>
                <form action="process.php" method="post" class="hidden">
                    <input type="hidden" name="method" value="tancarSessio"/>
                    <button class="ghost" id="signUp">Torna a l'inici</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>