<?php session_start(); 
global $db;
?>
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
    <a href="index.php">Accueil</a>
    <div class="input-contol">
        <label for="search">
            <img src="D:\InfoCours\WEB\BeerAdvisor\search.jpg">
        </label>
        <form method="POST" action="search.php">
            Beer type :
            <select name="category" id="category">
                <option value="tout">qu'importe</option>
                <option value="Lager">Lager</option>
                <option value="Ale">Ale</option>
                <option value="Porter">Porter</option>
            </select> <br>
            Alcohol level : 
            <input type="checkbox" class="alcohol" name="bool_alcohol" id="bool_alcohol" onchange="cb_clique(event)">
            <input type="number" name="alcohol" id="alcohol" min="0" max="100" value="7"> <br>
            IBU :
            <input type="checkbox" class="IBU" name="bool_IBU" id="bool_IBU" onchange="cb_clique(event)">
            <input type="number" name="IBU" id="IBU" min="0" max="100" value="30"> <br>
            Goûts :
            <select name="taste" id="taste" onchange="taste_select()">
                <option value="reset">Qu'importe</option>
                <?php
                
                include 'connect.php';
                $query = $db->prepare("SELECT name FROM taste");
                $res = $query->execute();
                $data = $query->fetch();
                while($data != null) {
                    echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
                    $data = $query->fetch();
                }
                ?>
            </select>
            -> 
            <input type="text" name="taste_txt" id="taste_txt" readonly> <br>

            <script>
                function taste_select() {
                    var taste = document.getElementById("taste").value;
                    var x = document.getElementById("taste_txt").value;
                    if (x.indexOf("taste") == -1) {
                        document.getElementById("taste_txt").value = x + taste + ";";
                    }
                    if (taste == "reset") {
                        document.getElementById("taste_txt").value = "";
                    }
                }
            </script>

            <input type="submit" value="valider">
        </form>

        </div>
        
    <?php

    if (!empty($_POST)) {

        $type = $_POST["category"];
        $alcohol = $_POST["alcohol"];
        $IBU = $_POST["IBU"];

        $list_taste = explode(";", $_POST["taste_txt"]);

        echo json_encode($list_taste). "<br>";

        $taste = $_POST["taste"];

        $req = "SELECT * FROM beerinfo";
        $where = " WHERE TRUE ";
        $order = "";
        $array = array();
        if ($_POST["category"] != "tout") {
            //$req = $req . " WHERE type=? ";
            $where = $where . " AND type=? ";
            $array = array_merge($array, array($type));
        }

        $i = 0;
        while ($list_taste[$i]) {
            $where = $where . " AND name IN (SELECT beerinfo.name FROM beer_taste INNER JOIN beerinfo ON beer_taste.id_beer = beerinfo.id INNER JOIN taste ON beer_taste.id_taste = taste.id WHERE taste.name = ?)";
            $array = array_merge($array, array($list_taste[$i]));
            $i ++;
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
        echo $req . $where . $order . " comportant comme argument : " . json_encode($array) . "<br>";
        
        $query = $db->prepare($req . $where . $order);
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
