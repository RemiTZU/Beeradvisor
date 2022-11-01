<?php
session_start();

unset($_SESSION["logins"]);

header("location: index.php");
