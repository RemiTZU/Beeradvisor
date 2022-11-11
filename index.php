<<<<<<< HEAD
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css" />
    <title>Document</title>
</head>

<body>
    <header>

        <section class="sec1">


            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,96C96,96,192,96,288,106.7C384,117,480,139,576,170.7C672,203,768,245,864,272C960,299,1056,309,1152,298.7C1248,288,1344,256,1392,240L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>

            <?php

            if (isset($_SESSION["logins"])) {
                echo " <a href='profilsession.php' id='signin'><img id='signin' src='IMG/login.jpg'></a>";
                echo "<p id = 'puser'>" . $_SESSION['logins']['username'] . " </p>";
            } else {
                echo " <a id ='signin' href='signin_signup.php'><img id ='signin' src='IMG/login.jpg'></a>";
            }
            ?>

            <h1>BEERADVISOR.</h1>
            <ul>
                <li>Informez-vous sur une grande variété de bière</li>
                <li>Bières testées par des experts</li>
            </ul>
            <h2>Bière du mois</h2>
            <div class="monthbeer">

                <img class="imageheader" src="IMG/33_BLEUE_GOUTTES_web-170x546.jpg" alt="">
            </div>

        </section>

    </header>

    
    <div id="presentation">
        <a href="search.php" id="link_search">
            <img id="img_search" src="IMG/searchlink1.jpg">
            <h2 id="search_label">search beer</h2>
        </a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="app.js"></script>

</body>

=======
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css" />
    <title>Document</title>
</head>

<body>
    <header>

        <section class="sec1">


            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,96C96,96,192,96,288,106.7C384,117,480,139,576,170.7C672,203,768,245,864,272C960,299,1056,309,1152,298.7C1248,288,1344,256,1392,240L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>

            <?php

            if (isset($_SESSION["logins"])) {
                echo " <a href='profilsession.php' id='signin'><img id='signin' src='IMG/login.jpg'></a>";
                echo "<p id = 'puser'>" . $_SESSION['logins']['username'] . " </p>";
            } else {
                echo " <a id ='signin' href='signin_signup.php'><img id ='signin' src='IMG/login.jpg'></a>";
            }
            ?>

            <h1>BEERADVISOR.</h1>
            <ul>
                <li>Informez-vous sur une grande variété de bière</li>
                <li>Bières testées par des experts</li>
            </ul>
            <h2>Bière du mois</h2>
            <div class="monthbeer">

                <img class="imageheader" src="IMG/33_BLEUE_GOUTTES_web-170x546.jpg" alt="">
            </div>

        </section>

    </header>

    
    <div id="presentation">
        <a href="search.php" id="link_search">
            <img id="img_search" src="IMG/searchlink1.jpg">
            <h2 id="search_label">search beer</h2>
        </a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="app.js"></script>

</body>

>>>>>>> 423e9384ca1318c88921d33936502db211bf1fa1
</html>