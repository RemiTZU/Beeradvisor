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

    $biere = $_GET["biere"];
    $query = $db->prepare("SELECT * FROM beerinfo WHERE name=?");
    $res = $query->execute([$biere]);
    $data = $query->fetch();
    echo "NOM  : " . $data['name'] . "<br>";
    echo "Inetrnational Bitterness Unit : " . $data['IBU'] . "<br>";
    echo "Degree : " . $data['degree'] . "<br>";
    
    $query = $db->prepare("SELECT avg(rating) AS rating FROM comment WHERE id_biere=?");
    $res = $query->execute([$data["id"]]);
    $rating = $query->fetch();
    echo "Note : " . $rating["rating"];

    ?>
</body>
</html>