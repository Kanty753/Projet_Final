<?php
session_start();
require("../inc/connect.php");
$_SESSION['error']=array();
$_SESSION['error']['pseudo'] = 0;
$_SESSION['error']['email'] = 0;
$_SESSION['error']['pwd'] = 0;
$_SESSION['error']['cpwd'] = 0;
if (isset($_POST['genre'])) {
$genre=$_POST['genre'];
}
if (isset($_POST['birth'])) {
$birth=$_POST['birth'];
}
if (isset($_POST['ville'])) {
$ville = $_POST['ville'];
}
if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
}
if (isset($_POST['pwd'])) {
    $pwd = $_POST['pwd'];
}
if (isset($_POST['cpwd'])) {
    $cpwd = $_POST['cpwd'];
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if ($pseudo == "") {
    $_SESSION['error']['pseudo'] = 1;
}
if ($email == "") {
    $_SESSION['error']['email'] = 1;
}
if ($pwd == "") {
    $_SESSION['error']['pwd'] = 1;
}
if ($cpwd == "" && $pwd != "") {
    $_SESSION['error']['cpwd'] = 1;
}
if ($pwd != "" && (($cpwd != "" && $pwd != $cpwd) || $cpwd == "")) {
    $_SESSION['error']['cpwd'] = 1;
}
if($pwd == $cpwd && $pwd != "")
{
    $_SESSION['error']['cpwd'] = 0;

}
if (($_SESSION['error']['cpwd'] == 1 || $_SESSION['error']['email'] == 1 || $_SESSION['error']['pseudo'] == 1 || $_SESSION['error']['pwd'] == 1)) {
    header('location:../pages/signup.php');
}
$requete = sprintf("SELECT  * FROM Membre Where email='%s'", $email);
$resultat = mysqli_query(dbconnect(), $requete);
if (mysqli_num_rows($resultat) != 0) {
    $_SESSION['error']['email'] = 2;
    $_SESSION['error']['pseudo'] = 0;
    $_SESSION['error']['pwd'] = 0;
    $_SESSION['error']['cpwd'] = 0;
    header('location:../pages/signup.php');
}
if ($_SESSION['error']['cpwd'] == 0 && $_SESSION['error']['email'] == 0 && $_SESSION['error']['pseudo'] == 0 && $_SESSION['error']['pwd'] == 0) {
    $requete = sprintf("INSERT INTO Membre (nom,date_naissance,genre,email,ville,mdp,image_profil) VALUES ('%s', '%s', '%s','%s','%s','%s',NULL)", $pseudo, $birth, $genre , $email , $ville ,$pwd);
    mysqli_query(dbconnect(), $requete);
    $requete2 = sprintf("SELECT id_membre FROM Membre WHERE Email='%s'", $email);
    $resultat = mysqli_query(dbconnect(), $requete2);
    while ($row = mysqli_fetch_assoc($resultat)) {
    $_SESSION['user']['id_membre'] = $row['id_membre'];
    }
    $_SESSION['user']['nom'] = $pseudo ;
    $_SESSION['user']['email'] = $email;
    header('location:../pages/home.php');
    exit(); 
}
?>