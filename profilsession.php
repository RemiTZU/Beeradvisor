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
    echo "<p>profil de " . $_SESSION['logins']['username'] . " </p>";

    echo "<p> email :" . $_SESSION['logins']['email'] . "</p>";


    ?>

    <a href='deconnexion.php'>deconnexion</a>

    <form action="profilsession.php" method="POST" name="modification" id="form">

        username : <input type="text" name="newusername" id="username" placeholder="new name"><br>
        Information personnelles : <br>
        mail adress : <input type="text" name="newemail" id="email" placeholder="new email"><br>
        password : <input type="password" name="newpassword" id="password" placeholder="new password"><br>
        <input type="submit" value="Valider">
    </form>

    <?php

    include 'connect.php';
    global $db;

    if (!empty($_POST)) {

        if (!empty($_POST["newusername"]) && !empty($_POST["newemail"]) && !empty($_POST["newpassword"])) {

            $bool = True;
            $verif = True;
            $username = strip_tags($_POST["newusername"]);
            $email = $_POST["newemail"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $bool = False;
            } else {
                $query = $db->prepare("SELECT * FROM logins WHERE email=?");
                $query->execute([$email]);
                $bool = $query->fetch();
                if ($email == $_SESSION['logins']['email']) {
                    $verif = False;
                }
                if ($bool && $verif) {
                    $bool = False;
                    die("le mail existe deja");
                }
            }

            $query = $db->prepare("SELECT * FROM logins WHERE username=?");
            $query->execute([$username]);
            $bool = $query->fetch();
            if ($username == $_SESSION['logins']['username']) {
                $verif = False;
            }
            if ($bool && $verif) {
                $bool = False;
                die("ce pseudo est deja utilisé existe deja");
            }

            $pass = password_hash($_POST["newpassword"], PASSWORD_ARGON2ID);

            echo"hello";
            $bool = True;
            if ($bool) {
                $sql = "UPDATE logins 
                SET username = ?,
                email = ?,
                password = ?
                where email =" . $_SESSION['logins']['email'] . " ";
                $query = $db->prepare($sql);
                $query->execute(array($username, $email, $pass));



                // on redirige vers une page deco

                
            } else {
                echo "probleme dans ce que tu as rentrés";
            }
            
        } else {
            die("le formulaire n'est pas complet");
        }
    }

    ?>




</body>

</html>