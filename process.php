<?php
session_start();
if(isset($_POST["method"])){
    // Si l'usuari vol fer refresh del captcha
    if($_POST["method"] == "refresh"){
        $_SESSION["refresh"] = "true";
        header("Location: index.php");
    }elseif($_POST["method"] == "comprovar"){
        // Si l'usuari vol comprovar el captcha
        if(strtolower($_POST["captcha"]) == $_SESSION["captcha"]){
            if(!isset($_SESSION["intents"])){
                $_SESSION["intents"] = 1;
            }else{
                $_SESSION["intents"]++;
            }
            $_SESSION["temps"] = time();
            header("Location: acces.php");
        }else{
            $_SESSION["temps_acces"] = time();
            if(!isset($_SESSION["intents"])){
                $_SESSION["intents"] = 1;
            }else{
                $_SESSION["intents"]++;
            }
            // Si l'usuari ha fet 10 intents en menys d'un minut
            if($_SESSION["intents"] >= 10 && time() - $_SESSION["temps_acces"] < 60){
                header("Location: index.php?masses_intents");
            }else{
                // Si l'usuari ha ficat malament el captcha
                header("Location: index.php?captcha_erroni");
            }
        }
    }elseif($_POST["method"] == "tancarSessio"){
        // Si l'usuari vol tancar sessio
        session_destroy();
        header("Location: index.php");
    }
}
?>