<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href=#>Create Category</a>
    <form action="modifbeerdata.php" method="POST">
        <select name="typedelete" id="typedelete">
            <option value="reset">DELETE</option>
            <?php
            include 'connect.php';
            global $db;
            $query = $db->prepare("SELECT name FROM beer_type");
            $res = $query->execute();
            $data = $query->fetch();
            while ($data != null) {
                echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
                $data = $query->fetch();
            }
            ?>
        </select>

        <select name="typedit" id="typedit">
        
            <option value="reset">EDIT</option>
            <?php
            include 'connect.php';
            $query = $db->prepare("SELECT name FROM beer_type");
            $res = $query->execute();
            $data = $query->fetch();
            while ($data != null) {
                echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
                $data = $query->fetch();
            }
            ?>
        </select>
        <input type = 'texte' name='editcategory'>
        <input type="submit" value="modifier">
    </form>


    <?php
    if (!empty($_POST)) {
        if (!empty($_POST["typedelete"])) {

            if ($_POST["typedelete"] != "DELETE") {
                $catedelete = $_POST["typedelete"];
                $query = $db->prepare("DELETE FROM beer_type WHERE name = ?");
                $res = $query->execute([$catedelete]);
            }

        }
        if (!empty($_POST["typedit"])) {

            if ($_POST["typedit"] != "EDIT") {

                $newdescription = $_POST["editcategory"];
                $query = $db->prepare("UPDATE beer_type SET description = ? WHERE name = ?");
                $res = $query->execute(array($newdescription, $_POST["typedit"]));
            }

        }
    }


    ?>
<div class="create">
  <form action="modifbeerdata.php" method="POST">
<input type = "texte" name="newcategory">
<input type = "texte" name="description">
<input type="submit">
</form>
</div>
<?php
    if (!empty($_POST)) {
        if (!empty($_POST["newcategory"])) {

           
                $newcategory= $_POST["newcategory"];
                $description = $_POST["description"];
                $query = $db->prepare("INSERT INTO beer_type(name,description) VALUES(?,?)");
                $res = $query->execute(array($newcategory,$description));

        }
    }
?>



</body>

</html>