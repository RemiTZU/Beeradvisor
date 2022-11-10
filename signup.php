<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css" />
    <title>Beer Advisor | Registration</title>
</head>

<body>
    <div class="login-box">
        <h2>Sign up</h2>
        <form method="POST" action="signup.php">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="text" name="f_name" required="">
                <label>First Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="name" required="">
                <label>Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>E-mail</label>
            </div>
            <div class="user-box">
                <input type="date" name="birthdate" id="birthdate">
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="pwd2" required="">
                <label>Repeat Password</label>
            </div>
            <input type="submit" id="join-btn" name="join" alt="Join" value="Join">
        </form>
    </div>
    <?php
    include 'connect.php';
    global $db;
    if (!empty($_POST)) {

        if (!empty($_POST["f_name"]) && !empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["birthdate"]) && !empty($_POST["password"])) {

            $bool = True;
            $bool2 = True;
            $bool3 = True;
            $f_name = $email = $name = $birthdate = "";
            $f_name = $_POST["f_name"];
            $username = strip_tags($_POST["username"]);
            $name = $_POST["name"];
            $email = $_POST["email"];
            $birthdate = $_POST["birthdate"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                echo ("l'adress email est pas bonne ");
                $bool = False;
            } else {
                $query = $db->prepare("SELECT * FROM logins WHERE email=?");
                $query->execute([$email]);
                $bool2 = $query->fetch();
                if ($bool2) {
                    $bool2 = False;
                    echo ("le mail existe deja");
                } else {
                    $bool2 = True;
                }
            }

            $query = $db->prepare("SELECT * FROM logins WHERE username=?");
            $query->execute([$username]);
            $bool3 = $query->fetch();
            if ($bool3) {
                $bool3 = False;
                echo ("ce pseudo est deja utilisé existe deja");
            } else {
                $bool3 = True;
            }

            $pass = $_POST["password"];

            if ($pass == "adminpassword") {
                $adminstate = True;
            } else {
                $adminstate = false;
            }

            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);

            if (intval(date("Y")) - intval(substr($birthdate, 0, 4)) <= 18) {
                echo ("L'âge minimale de registration est 18 ans");
                $bool = False;
            }


            if ($bool && $bool2 && $bool3) {
                echo "ok";
                //ajout dans la table user
                // $sql = "INSERT INTO logins(f_name,name,birthdate) VALUES (?,?,?)";
                // $query = $db->prepare($sql);
                // $query->execute(array($f_name, $name, $birthdate));

                //ajout dans la table logins



                $sql = "INSERT INTO logins(username,email,password,adminstate,birthdate,f_name,name) VALUES (?,?,?,?,?,?,?)";
                $query = $db->prepare($sql);
                $query->execute(array($username, $email, $pass, $adminstate,$birthdate,$f_name, $name));
                // les verfications sont passées 
                // on connecte l'utilisateur
                // demarrage d'une session php

                $query = $db->prepare("SELECT * FROM logins WHERE email = ?");
                $query->execute([$email]);
                $user = $query->fetch();

                session_start();
                //stockage des données de l'utilisateur

                 $_SESSION["logins"] = ["email" => $user["email"], "username" => $user["username"], "idlogins" => $user['idlogins'],"adminstate" => $user['adminstate']];

                // on redirige vers une page profil
                header("Location: index.php");
            } else {
                echo "probleme";
            }
        } else {
            die("le formulaire n'est pas complet");
        }
    }

    /*
    function test_entry($entry)
    {
        $test = true;
        for ($i = 0; $i < strlen($entry); $i += 1) {
            //echo $entry[$i];
            //echo " ";
            if ((64 > ord($entry[$i]) || ord($entry[$i]) > 90) and (97 > ord($entry[$i]) || ord($entry[$i]) > 122)) {
                $test = false;
            }
        }
        return $test;
    }
*/
    ?>
</body>

</html>