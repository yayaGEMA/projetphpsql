<?php

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
    <title>Mail'odie - Partage de mélodies et structures musicales</title>
</head>
<body>
    <div class="container-fluid">
        <?php
        // Inclusion du menu HTML
        include 'parts/menu.php';
        ?>

        <div class="row">
            <h1 class="text-center col-12 mt-4">Bienvenue sur Mail'odie</h1>
            <h3 class="text-center col-12 mt-2">Le site de partage d'écriture musicale</h3>
        </div>
        <div class="row">
            <p class=" col-6 offset-3 mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias totam fugit voluptas ea hic minima facilis quasi esse necessitatibus saepe dolorum, tempore non ipsum molestias vel ratione. Ipsum, alias voluptatum.</p>
        </div>
    </div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>