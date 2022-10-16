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
    mail adress : <input type="email" name="mail" id="mail"><br>
    birthdate : <input type="date" name="birthdate" id="birthdate"><br>
    password : <input type="password" name="pwd" id="pwd"><br>
    repeat the password : <input type="password" name="pwd2" id="pwd2"><br>
    <input type="submit" value="Valider">
    </form>
<?php
    $f_name = $name = $birthday = "";
   if ( isset($_POST["f_name"], $_POST["name"], $_POST["birthdate"])) {
    $f_name = $_POST["f_name"] ;
    $name = $_POST["name"];
    $birthday = $_POST["birthdate"];
   }


    if (!test_entry($f_name)) {
        echo "entree de prénom incorrecte <br>";
    }
    if (!test_entry($name)) {
        echo "entree de nom incorrecte <br> ";
    }
    // echo substr($birthday, 0,4);
    // echo "<br>";
    // echo date("Y");
    // echo "<br>";
    // echo date("Y") - substr($birthday, 0, 4);
    // echo "<br>";

    if (intval(date("Y")) - intval(substr($birthday, 0, 4)) <= 18) {
        echo "L'âge minimale de registration est 18 ans";
    }


    function test_entry($entry) {
        $test = true;
        for ($i = 0; $i < strlen($entry); $i+=1){
            //echo $entry[$i];
            //echo " ";
            if ((64>ord($entry[$i]) || ord($entry[$i])>90) and (97>ord($entry[$i]) || ord($entry[$i])>122)) {
                $test = false;
            }
        }
        return $test;
    }

     if ( test_entry($f_name) and test_entry($name) and !(intval(date("Y")) - intval(substr($birthday, 0, 4)) <= 18) ) {
        
     }
    ?>
</body>
</html>