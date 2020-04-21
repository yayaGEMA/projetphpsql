<?php

// Fonction qui retourne true si l'utilisateur est bien connecté, sinon false
function isConnected(){
    return isset($_SESSION['user']);
}