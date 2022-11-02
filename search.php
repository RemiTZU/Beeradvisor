<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesearch.css">
    <script src="search.js"></script>
</head>
<body>
    <h1>BeerAdvisor Search</h1>
    <div class="input-contol">
        <label for="search">
            <img src="D:\InfoCours\WEB\BeerAdvisor\search.jpg">
        </label>
        <form method="POST" action="search.php">
            Beer type :
            <select name="category" id="category">
                <option value="tout">qu'importe</option>
                <option value="blonde">blonde</option>
                <option value="brune">brune</option>
                <option value="ambrée">ambrée</option>
            </select> <br>
            Alcohol level : 
            <input type="checkbox" class="alcohol" name="bool_alcohol" id="bool_alcohol" onchange="cb_clique(event)">
            <input type="number" name="alcohol" id="alcohol" min="0" max="100" value="7"> <br>
            IBU :
            <input type="checkbox" class="IBU" name="bool_IBU" id="bool_IBU" onchange="cb_clique(event)">
            <input type="number" name="IBU" id="IBU" min="0" max="100" value="30"> <br>

            <input type="submit" value="valider">
        </form>

        </div>
        
    <?php

    include 'connect.php';
    global $db;

    if (!empty($_POST)) {

        $type = $_POST["category"];
        $alcohol = $_POST["alcohol"];
        $IBU = $_POST["IBU"];

        $req = "SELECT * FROM beerinfo";
        $where = "";
        $order = "";
        $array = array();
        if ($_POST["category"] != "tout") {
            $req = $req . " WHERE type=? ";
            $array = array_merge($array, array($type));
        }
        if (isset($_POST["bool_alcohol"])) {
            $order = $order . " abs(degree-?)/".ecart_type("degree", "beerinfo", $db)." + ";
            $array = array_merge($array, array($alcohol));
        }
        if (isset($_POST["bool_IBU"])) {
            $order = $order . " abs(IBU-?)/".ecart_type("IBU", "beerinfo", $db)." + ";
            $array = array_merge($array, array($IBU));
        }
        if ($order != "") {
            $order = " ORDER BY (" . $order . " 0)";
        }
        echo $req . $order . " comportant comme argument : " . json_encode($array) . "<br>";
        
        $query = $db->prepare($req . $order);
        $res = $query->execute($array);
        $data = $query->fetch();

    } else {
        $query = $db->prepare("SELECT * FROM beerinfo");
        $res = $query->execute();
        $data = $query->fetch();
    }
    while($data != null) {
        $nom = $data['name'];
        echo "<a href='biere.php?biere=$nom'>" . $nom . "</a><br>";
        $data = $query->fetch();
    }

    function ecart_type($value, $table, $db)
    {
        $query = $db->prepare("SELECT std($value) AS ecart_type FROM $table");
        $res = $query->execute();
        $data = $query->fetch();
        return $data["ecart_type"];
    }

    ?>
</body>
</html>
