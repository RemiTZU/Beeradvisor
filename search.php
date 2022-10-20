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
        if ($_POST["category"] == "tout") {
            $query = $db->prepare("SELECT * FROM beerinfo ORDER BY abs(Degree-?)");
            $res = $query->execute([$alcohol]);
            $data = $query->fetch();
        } else {
            $query = $db->prepare("SELECT * FROM beerinfo WHERE type=? ORDER BY abs(Degree-?)");
            $res = $query->execute(array($type,$alcohol));
            $data = $query->fetch();
        }
    } else {
        $query = $db->prepare("SELECT * FROM beerinfo");
        $res = $query->execute();
        $data = $query->fetch();
    }
    while($data != null) {
        echo $data['Name'] . "<br>";
        $data = $query->fetch();
    }

        ?>
    <!--<script>
        document.getElementById("search").onkeypress = function(e) {
            // Récupère la valeur du champ texte
            let text = document.getElementById("search").innerHTML;
            console.log(text);

            // On prépare une requête à envoyer à PHP
            //var oReq = new XMLHttpRequest();
            //oReq.onreadystatechange = function () {
            //    if (oReq.readyState === 4 && oReq.status === 200) {
            //        // On traite le résultat de la requête
            //        var res = JSON.parse(oReq.response);
            //        console.log(res);
            //    }
            //};
            //// On envoie la requête à PHP
            //oReq.open("get", "mapage.php", true);
            //oReq.send();
        };
    </script>-->
</body>
</html>
