<nav class="row navbar bg-dark">
    <a href="index.php" class ="text-light text-decoration-none pl-2">Mail'odie</a>
        <div class="mainNavbar">
            <ul class="list-unstyled d-flex">
                <li><a href="index.php" class ="text-light text-decoration-none p-2">Accueil</a></li>
                <li><a href="" class ="text-light text-decoration-none p-2">Articles</a></li>
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
</nav>