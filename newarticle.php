<?php
// Inclusion de la fonction isConnected()
require 'parts/functions.php';

// Nécessaire pour pouvoir utiliser les variables de session
session_start();

// Appel des variables
if(
    isset($_POST['title']) &&
    isset($_POST['content'])
){

    // Blocs des vérifs

    // Titre
    if(!preg_match('/^(.){5,150}$/i ', $_POST['title'])){
        $errors[] = 'Votre titre doit contenir entre 5 et 150 caractères !';
    }

    // Contenu
    if(
        mb_strlen($_POST['content']) <= 20 ||
        mb_strlen($_POST['content']) >= 20000
    ){
        $errors[] = 'Votre article doit contenir entre 20 et 20\'000 caractères !';
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
            $response = $bdd->prepare("INSERT INTO articles(title, author, create_date, content) VALUES (?, ?, ?, ?)");

            $register_date = date('Y-m-d H:i:s');

            $response->execute([
                $_POST['title'],
                $_SESSION['user']['id'],
                $register_date,
                $_POST['content']
            ]);

            // Si l'insertion a réussi , message de succès, sinon message d'erreur
            if($response->rowCount() > 0){
                $successMessage = 'Votre article a bien été créé.';
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
    <title>Mail'odie - Créer un nouvel article</title>
</head>
<body>
    <div class="container-fluid">
        <?php
        include 'parts/menu.php';
        ?>
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

                    // Si le visiteur n'est pas admin, on affiche le formulaire, sinon on affiche un message d'erreur
                    if($_SESSION['user']['admin'] ==1){
                ?>
                <!-- Formulaire de création d'article -->
                <form action="" method="POST">
                    <legend>Créer un nouvel article</legend>
                    <div class="form-group">
                        <label for="form-title">Titre :</label>
                        <input id="form-title" name="title" class="form-control" type="text" placeholder="Bb7 + F7" required>
                    </div>
                    <div class="form-group">
                        <label for="form-content">Contenu (min 20 caractères - max 20'000 caractères) :</label>
                        <textarea id="form-content" name="content" rows="15" maxlength="20000" class="form-control" placeholder="N'oubliez pas de dire bonjour et respectez les règles de politesse !" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoi</button>
                </form>
                <?php
                    } else {
                        echo '<p style="color:red;">Vous n\'avez pas le droit de créer un article !</p>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>