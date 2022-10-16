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
        mail adress : <input type="email" name="email" id="email"><br>
        birthdate : <input type="date" name="birthdate" id="birthdate"><br>
        password : <input type="password" name="password" id="password"><br>
        repeat the password : <input type="password" name="pwd2" id="pwd2"><br>
        <input type="submit" value="Valider">
    </form>
    <?php
    $f_name = $name = $birthday = "";
    if (!empty($_POST)) {

        if (isset($_POST["f_name"], $_POST["name"], $_POST["birthdate"], $_POST["password"], $_POST["username"], $_POST["email"]) && !empty($_POST["f_name"]) && !empty($_POST["name"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["birthday"]) && !empty($_POST["password"])) {

            $f_name = strip_tags($_POST["f_name"]);
            $username = strip_tags($_POST["username"]);
            $name = $_POST["name"];
            $birthday = $_POST["birthdate"];

            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                die("l'adress email est pas bonne ");
            }

            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);

            if (!test_entry($f_name)) {
                die("entree de prénom incorrecte <br>");
            }

            if (!test_entry($name)) {
                die("entree de nom incorrecte <br> ");
            }

            if (intval(date("Y")) - intval(substr($birthday, 0, 4)) <= 18) {
                die("L'âge minimale de registration est 18 ans");
            }

            require_once "includes/connect.php";

            $sql = "INSERT INTO 'user'('username','fisrt_name','name','mail_adress','birthday','password') VALUES (:pseudo,:familyname,:thename, :email,:birthday '$pass')";
            $query = $db->prepare($sql);
            $query->bindValue(":pseudo", $username, PDO::PARAM_STR);
            $query->bindValue(":familyname", $_POST["f_name"], PDO::PARAM_STR);
            $query->bindValue(":thename", $_POST['name'], PDO::PARAM_STR);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->bindValue(":birthday", $_POST["birthday"], PDO::PARAM_STR);
            $query->execute();
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



    // echo substr($birthday, 0,4);
    // echo "<br>";
    // echo date("Y");
    // echo "<br>";
    // echo date("Y") - substr($birthday, 0, 4);
    // echo "<br>";

    ?>
</body>

</html>