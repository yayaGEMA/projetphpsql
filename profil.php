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
    <div class="container-fluid">
        <?php
        include 'parts/menu.php';
        ?>
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4 mt-5">
                <h1 class="text-center"> Mon profil</h1>
            </div>
            <div class="col-md-6 offset-md-3">

                <?php
                // Si l'utilisateur est bien connecté, on affiche un message de salutation avec ses infos tirées depuis la session, sinon message d'erreur
                if(isConnected()){
                    if($_SESSION['user']['admin'] ==1){
                        $statut = "Administrateur";
                    }else {
                        $statut = "Membre";
                    }
                    function frenchTimeStamp(){
                        $getTimestamp = strtotime($_SESSION['user']['register_date']);
                        return strftime('%A %d %B %Y, %Hh %Mm %Ss', $getTimestamp);
                    }
                    echo 
                        "<ul class=\"list-unstyled border rounded mt-4 p-2\">
                            <li class=\"p-3 border-bottom\"><strong>Prénom : </strong>" . $_SESSION['user']['firstname'] . "</li>
                            <li class=\"p-3 border-bottom\"><strong>Nom : </strong>" . $_SESSION['user']['lastname'] . "</li>
                            <li class=\"p-3 border-bottom\"><strong>Adresse mail : </strong>" . $_SESSION['user']['email'] . "</li>
                            <li class=\"p-3 border-bottom\"><strong>Statut : </strong>" . $statut . "</li>
                            <li class=\"p-3 \"><strong>Date d'inscription : </strong>" . frenchTimeStamp() . "</li>
                        </ul>"
                    ;
                } else {
                    echo '<p style="color:red;">Vous devez être connecté pour accèder à cette page !</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>