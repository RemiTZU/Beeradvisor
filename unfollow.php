<?php 
 session_start(); 

 include 'connect.php';
 global $db;
 $iduserprofil = $_GET["id"];
    $iduserconnect = $_SESSION['logins']['idlogins'];
    $query = $db->prepare("DELETE FROM follow WHERE idfollower = ? AND iduserfollow = ? ");
    $res = $query->execute(array($iduserconnect,$iduserprofil));
    header("Location: profil.php?id=$iduserprofil");
?>