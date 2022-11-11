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
    include 'connect.php';
    global $db;
    $iduserprofil = $_GET["id"];
    echo "<p>profil de " . $iduserprofil . " </p>";

    $query = $db->prepare("SELECT * FROM comment INNER JOIN logins ON logins.idlogins=comment.id_user INNER JOIN beerinfo ON beerinfo.Id=comment.id_biere WHERE idlogins=? ORDER BY date");
    $res = $query->execute([$iduserprofil]);
    $comments = $query->fetch();
    
// verification du follow

    $query = $db->prepare("SELECT * FROM follow WHERE iduserfollow=?");
    $res = $query->execute([$iduserprofil]);
    $data = $query->fetch();
    $bool = false;
    while ($data != NULL) {
        if ($data['idfollower'] == $_SESSION['logins']['idlogins']) {
            $bool = True;
        }
        $data = $query->fetch();
    }
    if($bool){
        while ($comments != null) {
            echo "biere : " . $comments['name'];
            echo" ";
            echo "Commentaire : " . $comments['description'];
            echo"<br>";
            $comments = $query->fetch();
        }

        echo "<a href='unfollow.php?id=$iduserprofil'>unfollow</a>";
    }else{
        if (isset($_SESSION['logins'])) {
            echo "<a href='follow.php?id=$iduserprofil'>follow</a>";
        } else {
            echo '<a href="signin_signup.php">Connectez-vous pour suivre un utilisateur</a>';
        }
    }


    
    
    ?>
    
</body>

</html>
