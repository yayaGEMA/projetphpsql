<?php

// Inclusion de la fonction permettant de vérifier si un captcha est correct ou pas
require 'recaptchavalid.php';

// Appel des variables
if(
    isset($_POST['form-email']) &&
    isset($_POST['password']) &&
    isset($_POST['passwordConfirmation']) &&
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['g-recaptcha-response'])
){

    // Blocs des vérifs

    // Email
    if(!filter_var($_POST['form-email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide';
    }

    // Mot de passe
    if (!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !@#=<>]).{8,1000}$/ ' , $_POST['password'] )){
        $errors[] = 'Mot de passe invalide ! Il doit contenir au moins un chiffre de 0-9, une lettre minuscule, une lettre MAJUSCULE, un caractère spécial et doit être entre 8 et 1000 caractères.';
    }

    // Confirmation de mot de passe
    if ($_POST["password"] != $_POST["passwordConfirmation"]){
        $errors[] = 'Mot de passe de confirmation différent !';
    }

    // Vérif firstname
    if (!preg_match("/^[a-z\- áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{2,50}$/i ", $_POST['firstname'])){
        $errors[] = 'Prénom invalide !';
    }

    // Vérif lastname
    if (!preg_match("/^[a-z\- áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]{2,50}$/i ", $_POST['lastname'])){
        $errors[] = 'Nom invalide !';
    }

    // Captcha
    if(!recaptcha_valid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){
        $errors[] = 'Captcha invalide !';
    }

    // Si pas d'erreurs
    if(!isset($errors)){

        // Connexion à la base de données
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=mailodie;charset=utf8', 'root', '');
            //Affichage des erreurs SQL si il y en a
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e){
            die('Il y a un problème sur la BDD : ' . $e->getMessage());
        }

        // Requête préparée avec un marqueur, pour éviter les injections SQL
        $response = $bdd->prepare("INSERT INTO users(email, password, firstname, lastname, admin, register_date, activated, register_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $register_date = date('Y-m-d H:i:s');

        $response->execute([
            $_POST['form-email'],
            $hashedPassword,
            $_POST['firstname'],
            $_POST['lastname'],
            0,
            $register_date,
            0,
            0
        ]);

        // Si l'insertion a réussi , message de succès, sinon message d'erreur
        if($response->rowCount() > 0){
            $successMessage = 'Votre compte a bien été créé. Un mail de confirmation vous a été envoyé à votre adresse ' . $_POST['form-email'] . ' !';
        }else{
            $errors[] = 'Problème avec la base de données, veuillez réessayer.';
        }

        // Fermeture de la requête
        $response->closeCursor();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Mail'odie - Création d'un compte</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- Here comes the nav -->

        <div class="row">
            <div class="col-12 col-md-4 offset-md-4 mt-5">
                <?php
                // Si le tableau $errors existe, alors on rentre dans cette condition
                if(isset($errors)){

                    //On parcourt le tableau $errors pour afficher un msg d'erreur pour chaque erreur stockée dans l'array
                    foreach($errors as $error){
                        echo '<p style="color:red;">' . $error . '</p>';
                    }
                }

                // Si le message de succès existe, on l'affiche
                if(isset($successMessage)){
                    echo '<p style="color:green;">'.htmlspecialchars($successMessage).'</p>';
                } else {

                ?>
                <!-- Formulaire d'inscription -->
                <form action="" method="POST">
                    <legend>Formulaire</legend>
                    <div class="form-group">
                        <label for="form-email">Email :</label>
                        <input id="form-email" name="form-email" class="form-control" type="email" placeholder="angus.young@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Mot de passe :</label>
                        <input type="password" name="password" class="form-control" id="InputPassword">
                    </div>
                    <div class="form-group">
                        <label for="InputPasswordConfirmation">Confirmation du mot de passe :</label>
                        <input type="password" name="passwordConfirmation" class="form-control" id="InputPasswordConfirmation">
                    </div>
                    <div class="form-group">
                        <label for="form-firstname">Prénom :</label>
                        <input id="form-firstname" name="firstname" class="form-control" type="text" placeholder="Ex : Jimmy">
                    </div>
                    <div class="form-group">
                        <label for="form-lastname">Nom :</label>
                        <input id="form-lastname" name="lastname" class="form-control" type="text" placeholder="Ex : Page">
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdSwusUAAAAAO_Ng4hdFsDyiUEk56Dl-7UPoTr5"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Je m'inscris !</button>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>