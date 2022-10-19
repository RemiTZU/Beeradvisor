<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
    echo "<p>profil de ". $_SESSION['user']['username']." </p>";

    echo "<p> email :". $_SESSION['user'] ['email']."</p>";

    
?>

<a href='deconnexion.php'>deconnexion</a>
<input type="checkbox" name="modification" id="modification">
<script></script>
</body>
</html>