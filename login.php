<?php

// Inclusion de la fonction isConnected()
require 'parts/functions.php';

// Nécessaire pour pouvoir utiliser les variables de session
session_start();

// Si le visiteur n'est pas deja connecté, on traite le formulaire
if(!isConnected()){

    // Appel des variables
    if(
        isset($_POST['form-email']) &&
        isset($_POST['password'])
    ){

        // Bloc des vérifs
        if(!filter_var($_POST['form-email'], FILTER_VALIDATE_EMAIL)){
            $errors[] = 'Email invalide';
        }

        // Connexion à la base de données
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=mailodie;charset=utf8', 'root', '');
            //Affichage des erreurs SQL si il y en a
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e){
            die('Il y a un problème sur la BDD : ' . $e->getMessage());
        }

        // Vérification de l'adresse mail dans la BDD
        $response = $bdd->prepare('SELECT * FROM users WHERE email = ?');

        $response->execute([
            $_POST['form-email']
        ]);
        $user = $response->fetch();

        // Si le compte n'existe pas, message d'erreur
        if(empty($user)){
            $errors[] = 'Aucun compte enregistré avec cette adresse mail.';
        } else{

            // Si le MDP ne correspond pas, message d'erreur
            if(!password_verify($_POST['password'], $user['password'])){
                $errors[] = 'Mot de passe incorrect ! Veuillez réessayer.';
            } else{

                // Message de succès
                $successMessage = 'Vous êtes bien connecté !';

                // On crée un sous tableau "user" dans la session. Dans ce tableau on y met le mail et le mdp envoyés par le formulaire
                $_SESSION['user'] = $user;
            }
        }

    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Mail'odie - Connexion</title>
</head>
<body>
    <div class="container-fluid">
        <?php
        // Inclusion du menu HTML
        include 'parts/menu.php';
        ?>

        <div class="row">
            <div class="col-12 col-md-4 offset-md-4 mt-5">
                <!-- Formulaire de connexion -->
                <?php

                // Si il y a des erreurs, on les affiches
                if(isset($errors)){
                    foreach($errors as $error){
                        echo '<p style="color:red;">' . $error . '</p>';
                    }
                }

                // Si le message de succès existe, on l'affiche, sinon on affiche le formulaire
                if(isset($successMessage)){
                    echo '<p style="color:green;">' . $successMessage . '</p>';
                } else {

                    // Si le visiteur n'est pas connecté, on affiche le formulaire, sinon on affiche un message d'erreur
                    if(!isConnected()){

                ?>
                <form action="" method="POST">
                    <legend>Formulaire de connexion</legend>
                    <div class="form-group">
                        <label for="form-email">Email :</label>
                        <input id="form-email" name="form-email" class="form-control" type="email" placeholder="angus.young@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Mot de passe :</label>
                        <input type="password" name="password" class="form-control" id="InputPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </form>

                <?php
                    } else {
                        echo '<p style="color:red;">Vous êtes déjà connecté !</p>';
                    }
                }

                ?>
            </div>
        </div>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>