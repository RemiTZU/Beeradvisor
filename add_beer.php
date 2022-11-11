<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add beer</title>
</head>
<body style="background : #333">
    <form action="add_beer.php" method="post">
        Name of the beer : <input type="text" name="name_beer" id="name_beer" maxlength="100"> <br>
        Degree of beer : <input type="number" name="degree" id="degree" min="0" max="100" step="0.1"> <br>
        Inetrnational Bitterness Unit : <input type="number" name="IBU" id="IBU" min="0" max="100"> <br>
        Type : <select name="type" id="type">
            <?php
            include 'connect.php';
            $query = $db->prepare("SELECT name FROM beer_type");
            $res = $query->execute();
            $data = $query->fetch();
            while($data != null) {
                echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
                $data = $query->fetch();
            }
            ?>
        </select>
        Goûts :
        <select name="taste" id="taste" onchange="taste_select()">
            <option value="reset">Reset</option>
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
        <input type="submit" value="Add">
    </form>
    <?php
    if (isset($_POST)) {
        if ($_POST["name_beer"]) {
            $query = $db->prepare("SELECT * FROM beerinfo WHERE name=?");
            $res = $query->execute([$_POST["name_beer"]]);
            $data = $query->fetch();
            if ($data == NULL) {
                $query = $db->prepare("INSERT INTO beerinfo(name,degree,type,IBU) VALUES (?,?,?,?)");
                $res = $query->execute(array($_POST["name_beer"],$_POST["degree"],$_POST["type"],$_POST["IBU"]));
                $query = $db->prepare("SELECT Id FROM beerinfo WHERE name=?");
                $res = $query->execute([$_POST["name_beer"]]);
                $biere = $query->fetch();
                $list_taste = explode(";", $_POST["taste_txt"]);
                $i = 0;
                while ($list_taste[$i]) {
                    $query = $db->prepare("SELECT id FROM taste WHERE name=?");
                    $res = $query->execute([$list_taste[$i]]);
                    $data = $query->fetch();
                    $query = $db->prepare("INSERT INTO beer_taste(id_beer,id_taste) VALUES (?,?)");
                    $res = $query->execute(array($biere["Id"],$data["id"]));
                    $i ++;
                }

            }
        }
    }
    ?>
</body>
</html>
