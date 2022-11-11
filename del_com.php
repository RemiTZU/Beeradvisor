<?php session_start(); 

include 'connect.php';
global $db;
$query = $db->prepare("DELETE FROM comment WHERE id_user=? and id_biere=?");
$query->execute(array($_SESSION['logins']['idlogins'], $_GET["id_beer"]));

header("Location: biere.php?biere=" . $_GET["biere"]);

?>
