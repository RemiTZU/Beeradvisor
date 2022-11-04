<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beeradvisor | <?php echo $_GET["biere"];?> </title>
</head>
<body>
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
    $res = $query->execute([$data["id"]]);
    $rating = $query->fetch();
    echo "Note : " . $rating["rating"];

    // Affiche les commentaires
    $query = $db->prepare("SELECT * FROM comment INNER JOIN user ON user.iduser=comment.id_user WHERE id_biere=?");
    $res = $query->execute([$data["id"]]);
    $comments = $query->fetch();

    while($comments != null) {
        // $username = $comments['username'];
        // echo "<br>Utilisateur : " . $username . " - ";
        // echo "<a href='profil.php?username=$username?id=$comments[id_user]'>" . $username .  " : </a>";
        echo "<br>Utilisateur : " . $comments['username'] . " - ";
        echo "Note : " . $comments['rating'] . " - ";
        echo "Commentaire : " . $comments['description'];
        $comments = $query->fetch();
    }

    ?>
</body>
</html>
