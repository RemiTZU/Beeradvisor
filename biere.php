<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beeradvisor | <?php echo $_GET["biere"];?> </title>
</head>
<body>
    <a href="search.php">Search.php</a> <br>
    <?php 
    include 'connect.php';
    global $db;

    // Affiche les charactéristiques de la bière
    $biere = $_GET["biere"];
    $query = $db->prepare("SELECT * FROM beerinfo WHERE name=?");
    $res = $query->execute([$biere]);
    $data = $query->fetch();
    echo "NOM  : " . $data['name'] . "<br>";
    echo "Inetrnational Bitterness Unit : " . $data['IBU'] . "<br>";
    echo "Degree : " . $data['degree'] . "<br>";
    
    // Affiche la note moyenne mise par les utilisateurs
    $query = $db->prepare("SELECT avg(rating) AS rating FROM comment WHERE id_biere=?");
    $res = $query->execute([$data["Id"]]);
    $rating = $query->fetch();
    echo "Note moyenne : " . $rating["rating"] . "<br>";
    
    // Si utilisateur connecté : il peut mettre un commentaire
    if (isset($_SESSION["logins"])) {
        if (!empty($_POST)) {
            $sql = "INSERT INTO comment(id_biere,id_user,rating,description) VALUES (?,?,?,?)";
            $query = $db->prepare($sql);
            $query->execute(array($data['Id'], $_SESSION['logins']['idlogins'], $_POST["note_user"], $_POST["com_user"]));
            $_POST = array();
        }
        $query = $db->prepare("SELECT * FROM comment WHERE id_biere=? and id_user=?");
        $res = $query->execute(array($data["Id"],$_SESSION['logins']['idlogins']));
        $comment_user = $query->fetch();

        if ($comment_user!=NULL) {
            echo "Votre commentaire : <br> Note : " . $comment_user['rating'] . " - ";
            echo "Commentaire : " . $comment_user['description'] . '<br>';
            echo '<a href="del_com.php?id_beer=' . $data["Id"] . '&biere=' . $data['name'] . '">DELETE</a><br><br>';
        } else {
            echo '
            Ajouter un commentaire : <br>
            <form action="biere.php?biere=' . $_GET["biere"] . '" method="post">
                Votre note : <input type="number" name="note_user" id="note_user" min="0" max="5"><br>
                Commentaire : <input type="text" name="com_user" id="com_user" maxlength="300"> <br>
                <input type="submit" value="poster"> 
            </form>'
            ;
        }
    }

    // Affiche les commentaires
    $query = $db->prepare("SELECT * FROM comment INNER JOIN logins ON logins.idlogins=comment.id_user WHERE id_biere=? ORDER BY date DESC");
    $res = $query->execute([$data["Id"]]);
    $comments = $query->fetch();

    while($comments != null) {
        
        $usernamecomment = $comments['username'];
        $idusercomment = $comments['idlogins'];
        echo"<br>";
        echo "<a href='profil.php?id=$idusercomment'> Utilisateur : "  . $usernamecomment . "</a>";
        echo "Note : " . $comments['rating'] . " - ";
        echo "Commentaire : " . $comments['description'];
        echo "id : " . $comments['idlogins'];
        $comments = $query->fetch();
    }
    if (isset($_SESSION['logins'])) {
        $adminstate = $_SESSION['logins']['adminstate'];
        if ($adminstate == 1) {
            echo"<a href='supbiere.php?name=$biere'>supprimer</a>";
        }
    }
    ?>

</body>
</html>
