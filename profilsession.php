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
<button id="modification">Modifier</button>
<form action="profilsession" method="POST" name="modification">

        username : <input type="text" name="username" id="username"><br>
        Information personnelles : <br>
        first_name : <input type="text" name="f_name" id="f_name"><br>
        name : <input type="text" name="name" id="name"><br>
        mail adress : <input type="text" name="email" id="email"><br>
        birthdate : <input type="date" name="birthdate" id="birthdate"><br>
        password : <input type="password" name="password" id="password"><br>

</form>
<script></script>
</body>
</html>