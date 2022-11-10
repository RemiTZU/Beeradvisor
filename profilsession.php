<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="profilsession.js"></script>
    <link rel="stylesheet" href="profil.css" />
</head>

<body>
    <h1>Profil</h1>
    <?php
    echo "<p>profil de " . $_SESSION['logins']['username'] . " </p>";

    echo "<p> email :" . $_SESSION['logins']['email'] . "</p>";


    ?>

    <a href='deconnexion.php' class="a1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>deconnexion</a>

    <a onclick="maFonction()" class="a2" href="#"> 
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Modifier
    </a>
    <div id="maDIV" style="display:none;">
        <div class="login-box">

            <form action="profilsession.php" method="POST" name="modification" id="form">
                <div class="user-box">
                    <input type="text" name="newusername" id="username" required="">
                    <label>Username</label>
                </div>
                <div class="user-box">
                    <input type="text" name="newemail" id="email" required="">
                    <label>E-mail</label>
                </div>
                <div class="user-box">
                    <input type="password" name="newpassword" id="password" required="">
                    <label>Password</label>
                </div>
                <input type="submit" id="join-btn" name="join" alt="Join" value="Join">
            </form>
        </div>
    </div>

    <script>
        function maFonction() {
            var div = document.getElementById("maDIV");
            if (div.style.display === "none") {
                div.style.display = "block";
            } else {
                div.style.display = "none";
            }
        }
    </script>


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
            $bool = True;
            echo "hello";
            if ($bool) {
                $sql = "UPDATE logins 
                SET username = ?,
                email = ?,
                password = ?
                where email = ? ";
                $query = $db->prepare($sql);
                $query->execute(array($username, $email, $pass, $_SESSION['logins']['email']));



                // on redirige vers une page deco

                header("Location: index.php");
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