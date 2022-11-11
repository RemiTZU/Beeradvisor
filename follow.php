<?php
 session_start(); 

    include 'connect.php';
    global $db;

    if (isset($_SESSION['logins'])) {
      $iduserprofil = $_GET["id"];
      $iduserconnect = $_SESSION['logins']['idlogins'];
      $query = $db->prepare("INSERT INTO follow(idfollower,iduserfollow) VALUES(?,?)");
      $res = $query->execute(array($iduserconnect,$iduserprofil));
    }
    
     header("Location: profil.php?id=$iduserprofil");
?>
