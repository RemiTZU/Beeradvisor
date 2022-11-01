<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Beer Advisor | Registration</title>
</head>

<body>
    <form method="POST" action="registration.php">
        username : <input type="text" name="username" id="username"><br>
        Information personnelles : <br>
        first_name : <input type="text" name="f_name" id="f_name"><br>
        name : <input type="text" name="name" id="name"><br>
        mail adress : <input type="text" name="email" id="email"><br>
        birthdate : <input type="date" name="birthdate" id="birthdate"><br>
        password : <input type="password" name="password" id="password"><br>
        repeat the password : <input type="password" name="pwd2" id="pwd2"><br>
        <input type="submit" value="Valider">
    </form>
    <?php
    include 'connect.php';
    global $db;
    if (!empty($_POST)) {

        if (!empty($_POST["f_name"]) && !empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["birthdate"]) && !empty($_POST["password"])) {

            $bool = True;
            $f_name = $email = $name = $birthdate = "";
            $f_name = $_POST["f_name"];
            $username = strip_tags($_POST["username"]);
            $name = $_POST["name"];
            $email = $_POST["email"];
            $birthdate = $_POST["birthdate"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                die("l'adress email est pas bonne ");
                $bool = False;
            } else {
                $query = $db->prepare("SELECT * FROM user WHERE email=?");
                $query->execute([$email]);
                $bool = $query->fetch();
                if ($bool) {
                    $bool = False;
                    die("le mail existe deja");
                } else {
                    $bool = True;
                }
            }

            $query = $db->prepare("SELECT * FROM user WHERE username=?");
            $query->execute([$username]);
            $bool = $query->fetch();
            if ($bool) {
                $bool = False;
                die("ce pseudo est deja utilisé existe deja");
            }

            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);


            if (!test_entry($f_name)) {
                die("entree de prénom incorrecte <br>");
                $bool = False;
            }

            if (!test_entry($name)) {
                die("entree de nom incorrecte <br> ");
                $bool = False;
            }

            if (intval(date("Y")) - intval(substr($birthdate, 0, 4)) <= 18) {
                die("L'âge minimale de registration est 18 ans");
                $bool = False;
            }


            if ($bool) {
                $sql = "INSERT INTO user(username,f_name,name,email,birthdate,password) VALUES (?,?,?,?,?,?)";
                $query = $db->prepare($sql);
                $query->execute(array($username, $f_name, $name, $email, $birthdate, $pass));

                // les verfications sont passées 
                // on connecte l'utilisateur
                // demarrage d'une session php


                session_start();
                //stockage des données de l'utilisateur

                $_SESSION["user"] = ["email" => $email, "username" => $username];

                // on redirige vers une page profil
                header("Location: index.php");
            }
        } else {
            die("le formulaire n'est pas complet");
        }
    }


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

    ?>
</body>

</html>