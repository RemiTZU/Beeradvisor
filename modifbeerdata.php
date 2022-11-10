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
<form action="modifbeerdata.php" method="$_POST">   
<select name="tastedelete" id="tastedelete" onchange="taste_select()">
<option value="reset">DELETE</option>
    <?php
    include 'connect.php';
    $query = $db->prepare("SELECT name FROM taste");
    $res = $query->execute();
    $data = $query->fetch();
    while ($data != null) {
        echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
        $data = $query->fetch();
    }
    ?>
</select>

<select name="tastedit" id="tastedit" onchange="taste_select()">
<option value="reset">EDIT</option>
    <?php
    include 'connect.php';
    $query = $db->prepare("SELECT name FROM taste");
    $res = $query->execute();
    $data = $query->fetch();
    while ($data != null) {
        echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";
        $data = $query->fetch();
    }
    ?>
</select>
</form>

<?php 
$catedelete = $_POST["tastedelete"];
$query = $db->prepare("DELETE FROM taste");
$res = $query->execute();
?>
<?php
echo "<form action='modifbeerdata.php' method='POST'>
<input type = 'texte' name='newcategory'>
<input type='submit'>
</form>"
?>
</body>

</html>




