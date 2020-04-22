<nav class="row navbar bg-success">
    <div class="mainNavbar col-12 d-flex p-2">
        <a href="index.php" class =" col-2 text-light text-decoration-none pl-2">Mail'odie</a>
        <ul class="list-unstyled d-flex m-0">
            <li><a href="index.php" class ="text-light text-decoration-none p-2">Accueil</a></li>
            <li><a href="articles.php" class ="text-light text-decoration-none p-2">Articles</a></li>
            <?php
            // Si l'utilisateur est connecté
            if(!empty($_SESSION['user'])){
                echo
                    "<li><a href=\"profil.php\" class =\"text-light text-decoration-none p-2\">Profil</a></li>
                    <li><a href=\"logout.php\" class =\"text-light text-decoration-none p-2\">Déconnexion</a></li>";
            } else {
                echo
                    "<li><a href=\"login.php\" class =\"text-light text-decoration-none p-2\">Connexion</a></li>
                    <li><a href=\"signup.php\" class =\"text-light text-decoration-none p-2\">Inscription</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="search col-2">
    
    </div>
</nav>