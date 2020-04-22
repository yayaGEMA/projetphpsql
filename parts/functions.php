<?php

// Fonction qui retourne true si l'utilisateur est bien connecté, sinon false
function isConnected(){
    return isset($_SESSION['user']);
}


// Fonction qui retourne le statut de l'user
function isAdmin(){
    if(isConnected()){
        if($_SESSION['user']['admin'] == 1){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
