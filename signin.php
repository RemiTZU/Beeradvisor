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
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                # code...
            }
            

            $query = $db->prepare("SELECT * FROM user WHERE email = ?");
            $query->execute([$email]);
            $user = $query->fetch();
            if (!$user) {
                echo"test";
                die("user or password incorrect");
            }
            if (!password_verify($pass,$user["password"])) {
                echo "hey";
                die("user or password incorrect");
            }  else{
                die("vous êtes co");
            }
            // les verfications sont passées 
            // on connecte l'utilisateur
            // demarrage d'une session php
            
                session_start();

            $_SESSION["user"] = ["id" => $user[iduser], 



        } else {
            die("le formulaire n'est pas complet");
        }
    }

    ?>
</body>

</html>