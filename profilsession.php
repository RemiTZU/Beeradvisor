<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="profilsession.js"></script>
</head>
<body>
    
    <?php 
    echo "<p>profil de ". $_SESSION['user']['username']." </p>";

    echo "<p> email :". $_SESSION['user'] ['email']."</p>";

    
?>

<a href='deconnexion.php'>deconnexion</a>
<button  id="button" onchange="cb_clique(event)">Modifier</button>


        <form action="profilsession" method="POST" name="modification" id="form">

        username : <input type="text" name="username" id="username" placeholder="new name"><br>
        Information personnelles : <br>
        mail adress : <input type="text" name="email" id="email" placeholder="new email"><br>
        password : <input type="password" name="password" id="password" placeholder="new password"><br>
        <input type="submit" value="Valider">
    </form>

     <?php

    include 'connect.php';
    global $db;

    if (!empty($_POST)) {

        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

            $bool = True;
            $verif = True;
            $username = strip_tags($_POST["username"]);
            $email = $_POST["email"];
        
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $bool = False;
            } else {
                $query = $db->prepare("SELECT * FROM user WHERE email=?");
                $query->execute([$email]);
                $bool = $query->fetch();
                if ($email == $_SESSION['user'] ['email'] ) {
                    $verif = False;
                }
                if ($bool && $verif) {
                    $bool = False;
                    die("le mail existe deja");
                }
            }

            $query = $db->prepare("SELECT * FROM user WHERE username=?");
            $query->execute([$username]);
            $bool = $query->fetch();
            if($username == $_SESSION['user']['username']){
                $verif = False;
            }
            if ($bool && $verif) {
                $bool = False;
                die("ce pseudo est deja utilisé existe deja");
            }

            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);



            if ($bool) {
                $sql = "INSERT INTO user(username,email,password) VALUES (?,?,?) where email = $_SESSION(['user'] ['email'])";
                $query = $db->prepare($sql);
                $query->execute(array($username,$email, $pass));

            

                // on redirige vers une page deco
             
            }else{
                echo "probleme dans ce que tu as rentrés";
            }
        } else {
            die("le formulaire n'est pas complet");
        }
    }

?> 

   

<script></script>
</body>
</html>