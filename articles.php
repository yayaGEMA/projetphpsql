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
    <title>Mail'odie - Articles</title>
</head>
<body>
    <div class="container-fluid">
        <?php
        include 'parts/menu.php';
        ?>
        <!-- H1 -->
        <div class ="row">
            <h1 class="text-center col-12 mt-4">Nos articles</h1>
        </div>
        <!-- Possibilité d'ajout d'article par un admin -->
        <div class="row">
            <?php
                    // Si l'utilisateur est bien connecté, on affiche un message de salutation avec ses infos tirées depuis la session, sinon message d'erreur
                    if(isConnected()){
                        if($_SESSION['user']['admin'] ==1){
                            echo '<a class="col-7 text-center" href="newarticle.php">Créer un nouvel article</a>';
                        }
                    }
            ?>
        </div>
        <!-- Tableau contenant les articles -->
        <div class="row">
            <table class="table table-striped col-6 offset-3 mt-4">
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Date de parution</th>
                        <?php
                        if(isConnected()){
                            if($_SESSION['user']['admin'] ==1){
                                echo '<th scope="col"></th>';
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connexion à la base de données
                    try{
                        $bdd = new PDO('mysql:host=localhost;dbname=mailodie;charset=utf8', 'root', '');
                        //Affichage des erreurs SQL si il y en a
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch(Exception $e){
                        die('Il y a un problème sur la BDD : ' . $e->getMessage());
                    }

                    // Récupération des données dans la table articles
                    $response = $bdd->query('SELECT articles.id, articles.title, users.firstname, users.lastname, articles.create_date FROM articles INNER JOIN users ON articles.author = users.id ORDER BY create_date');
                    $articles = $response->fetchAll(PDO::FETCH_ASSOC);


                    // Si aucun article n'a été trouvé, on le signale, sinon on les affiche
                    if(empty($articles)){
                        echo '<tr>
                        <th style="color:red;">Aucun article sur notre site pour le moment.</th>
                        </tr>';
                    } else{
                        foreach($articles as $article){
                            echo
                            '<tr>
                            <th scope="row"><a href="article.php?id='.$article['id'].'">'. htmlspecialchars($article['title']) .'</a></th>
                            <td>' . htmlspecialchars($article['firstname']) . ' ' . htmlspecialchars($article['lastname']) .'</td>
                            <td>' . htmlspecialchars(strftime('%A %d %B %Y, %Hh %Mm %Ss', strtotime($article['create_date']))) . '</td>';
                            if(isConnected()){
                                if($_SESSION['user']['admin'] ==1){
                                    echo '<th scope="col"><a href="supparticle.php" class="text-decoration-none text-danger">X</a></th>';
                                }
                            }
                            echo '</tr>';
                        }
                    }

                    // Fermeture de la requête
                    $response->closeCursor();
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>