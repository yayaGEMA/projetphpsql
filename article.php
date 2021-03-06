<?php
// Inclusion de la fonction isConnected()
require 'parts/functions.php';

// Nécessaire pour pouvoir utiliser les variables de session
session_start();

// Appel des variables
if(isset($_GET['id'])){

    // Bloc des vérifs
    if(!preg_match('/^\d{1,25}$/ ', $_GET['id'])){
        $errors[] = 'Article invalide !';
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
        $response = $bdd->prepare("SELECT articles.title, articles.content, articles.create_date, users.firstname, users.lastname FROM articles INNER JOIN users ON articles.author = users.id WHERE articles.id = ?");
        $response->execute([
            $_GET['id']
        ]);

        // Récupération des données de l'article trouvése par la requête sous forme de tableau associatif
        $article = $response->fetch();

        // Fermeture de la requête
        $response->closeCursor();
    }
}else {
    $errors[] = 'Aucun article existant !';
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Mail'odie - <?php echo htmlspecialchars($article['title']);?></title>
</head>
<body>
    <div class="container-fluid">
        <?php
        include 'parts/menu.php';

        if(empty($article)){
            echo '<h1 class="text-danger">Oups ! Il n\'y a aucun article à afficher.</h1>
            <p class="row">
            <div class="text-center"><a href="articles.php">Retour à la liste des articles</a></div>
            </p>';
        } else{
            ?>
        <div class="row">
            <h1 class="text-center col-12 mt-4"><?php echo htmlspecialchars($article['title']); ?></h1>
            <p class="row">
            <div class="text-center"><a href="articles.php">Retour à la liste des articles</a></div>
            </p>
        </div>
        <div class="col-md-6 offset-md-3">
            <?php
            echo 
                "<ul class=\"list-unstyled border rounded mt-4 p-2\">
                    <li class=\"p-3 border-bottom text-break\">" . nl2br(htmlspecialchars($article['content'])) . "</li>
                    <li class=\"p-3 \">posté par <strong>".htmlspecialchars($article['firstname'])." ". htmlspecialchars($article['lastname']) . "</strong> le " . htmlspecialchars(strftime('%A %d %B %Y, %Hh %Mm %Ss', strtotime($article['create_date']))). "</li>
                </ul>"
            ; ?>
        </div>;
        <?php
        }
        ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>