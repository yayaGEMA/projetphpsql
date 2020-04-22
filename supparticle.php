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
    <title>Mail'odie - Supprimer un article</title>
</head>
<body>
    <div class="container-fluid">
        <?php
        include 'parts/menu.php';
        ?>
        <!-- H1 -->
        <div class ="row">
            <h1 class="text-center col-12 mt-4">Supprimer un article</h1>
        </div>
        <div class="row">
            <?php
            // Si le visiteur n'est pas admin, on affiche le formulaire, sinon on affiche un message d'erreur
            if($_SESSION['user']['admin'] ==1){
            ?>
            
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>


<!-- ADRESSE URL de suppression d'article
https://www.anthony-demon.com/projetphpprocedural/admin-delete-article.php?id=7&csrf-token=5bb6d1b9be11ea402bd5ee64abfe0aac
 -->