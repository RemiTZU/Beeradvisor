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
    
    <a href="add_beer.php">Add a beer</a>

    <form action="profilsession.php" method="POST">
        <select name="order" id="order">
            <option value="a_u_note" id='note_ascd'>note montante</option>
            <option value="d_u_note" id='note_desc'>note descendante</option>
            <option value="a_a_note" id='avg_note_ascd'>note moyenne montante</option>
            <option value="d_a_note" id='avg_note_desc'>note moyenne descendante</option>
        </select>
        <input type="submit" value="valider">
    </form>
    <?php
    include 'connect.php';
    global $db;

    // SELECT *, AVG(rating) from comment INNER JOIN beerinfo ON comment.id_biere = beerinfo.Id where id_user=1 GROUP BY beerinfo.name;
    $var = $_SESSION['logins']['idlogins'];
    $array = [$var];
    $order = "";
    if (isset($_POST['order'])) {
        $order .= "ORDER BY ";
        if ($_POST['order'][2] == 'u') {
            $order .= "rating";
        } else {
            $order .= "(select avg(rating) from comment where id_user=?)";
            $array = array_merge($array, [$var]);
        }
        if ($_POST['order'][0] == 'a') {
            $order .= " DESC";
        }
    }
    $req = "SELECT * FROM beerinfo INNER JOIN comment ON
    beerinfo.Id = comment.id_biere WHERE comment.id_user=? " . $order;
    echo $req . "<br>";
    $query = $db->prepare($req);
    $res = $query->execute($array);
    $data = $query->fetch();
    if ($data == null) {
        echo "Vous n'avez pas encore commenté de bières";
    }
    while($data != null) {
        $nom = $data['name'];
        echo "<a href='biere.php?biere=$nom'>" . $nom . "</a> ";
        echo $data['rating'] . "<br>";
        $data = $query->fetch();
    }
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
    if ($_SESSION['logins']['adminstate']==1) {
       echo" <a href='modifbeerdata.php'>modifier beerdata <a>";
    }

    ?>




</body>

</html>
