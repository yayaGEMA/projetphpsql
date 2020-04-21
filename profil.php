<?php
// Inclusion de la fonction isConnected()
require 'parts/functions.php';

// Nécessaire pour pouvoir utiliser les variables de session
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Mail'odie - Profil</title>
</head>
<body>
    <?php
    include 'parts/menu.php';
    ?>
    <?php

    // Si l'utilisateur est bien connecté, on affiche un message de salutation avec ses infos tirées depuis la session, sinon message d'erreur
    if(isConnected()){
        echo 'Bonjour, bienvenue sur notre site !';
    } else {
        echo '<p style="color:red;">Vous devez être connecté pour accèder à cette page !</p>';
    }

    ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>