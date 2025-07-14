<?php
function dbconnect()
{
    static $connect = null;
    $bdd_name = "projet_final"; // Nom de la base de données
    $mdp = "";
    $user = "root";
    $host = "localhost";


    if ($connect === null) {
        $connect = mysqli_connect($host, $user, $mdp, $bdd_name);

        if (!$connect) {
            // Arrête le script et affiche une erreur si la connexion échoue
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        // Optionnel : définir l'encodage des caractères pour gérer les accents (UTF-8 recommandé)
        mysqli_set_charset($connect, 'utf8mb4');
    }

    return $connect;
}

?>