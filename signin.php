<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>

    <form method="POST" action="signin.php" class="signin">
        <label for="pass"> PassWord </label>
        <input type="password" name="password" id="password"><br>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email"><br>
        <input type="submit" value="Validate">
    </form>
    <?php
    include 'connect.php';
    global $db;

    if (!empty($_POST)) {

        if (!empty($_POST["password"]) && !empty($_POST["email"])) {
            $pass = $_POST["password"];
            $email = $_POST["email"];

            $query = $db->prepare("SELECT * FROM user WHERE email = ? AND password = ? ");
            $query->execute(array($email, $pass));
            $bool = $query->fetch();
            if ($bool) {
                die("vous etes co");
            } else {
                die("aucun compte trouvé");
            }
        } else {
            die("le formulaire n'est pas complet");
        }
    }

    ?>
</body>

</html>