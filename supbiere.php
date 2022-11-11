<?php
session_start();
include 'connect.php';
global $db;
$namedelete = $_GET["name"];
$query = $db->prepare("DELETE FROM beerinfo WHERE name = ?");
$res = $query->execute([$namedelete]);
header("Location: search.php");
?>