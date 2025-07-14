<?php
require("../inc/function.php");
session_start();
$_SESSION['id'] = $row['id']; // ou 'idMembre' selon ta table

$_SESSION['mail_error']=0;
$_SESSION['pwd_error'] = 0 ;
if (isset($_POST['email']) && isset($_POST['pwd']) && $_POST['pwd']!="" && $_POST['email']!="") {
    if (isMembre(($_POST['email']))==true) {
        $temp=array();
        $temp = getMembrebyEmail($_POST['email']);
        if ($temp['mdp']==$_POST['pwd']) {
            $_SESSION['user']['id'] = $temp['id'];
            $_SESSION['user']['pseudo'] = $temp['pseudo'];
            $_SESSION['user']['email'] = $temp['email'];
            header('location:../pages/home.php');
        }
        else {
        $_SESSION['pwd_error']=1;
        header('location:../pages/login.php');    
        }
    }
    else {
    $_SESSION['mail_error']=1;
    header('location:../pages/login.php');
    }
}
else if(!isset($_POST['email']) || $_POST['email']=="") {
    $_SESSION['mail_error']=2;
    header('location:../pages/login.php');
}
else if (!isset($_POST['pwd'])|| $_POST['pwd']=="") {
    $_SESSION['pwd_error']=2;
    header('location:../pages/login.php');    
}
?>