<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beer Advisor | ConnectToDataBase</title>
</head>

<body>
    <?php
    //environement constant 
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "beerdata");

    //dsn of connection
    $dsn =  "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

    //connection to database
    try {
        $db = new PDO($dsn, DBUSER, DBPASS);
        //data utf8 ?
        $db->exec("SET NAMES utf8");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }


    ?>
</body>

</html>