<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>

<body>
    <header>

        <section class="sec1">


            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1"
                    d="M0,96L48,96C96,96,192,96,288,106.7C384,117,480,139,576,170.7C672,203,768,245,864,272C960,299,1056,309,1152,298.7C1248,288,1344,256,1392,240L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>

            <?php

            if (isset($_SESSION["user"])) {
                echo" <a href='profilsession.php'><img id='signin' src='IMG/login.jpg'></a>";
            }else{
                echo" <a href='registration.php'><img id='signin' src='IMG/login.jpg'></a>";
            }
           ?>
           
            <h1>BEERADVISOR.</h1>
            <ul>
                <li>Informez-vous sur une grande variété de bière</li>
                <li>Bières testez par des experts</li>
            </ul>
            <h2>Bière du mois</h2>
            <div class="monthbeer">

                <img class="imageheader" src="IMG/heineken-original-bottle.jpg" alt="">
            </div>

        </section>
        <section class="sec2"></section>

    </header>
    <section class="sitenavigation">
        <h2>FIND OUT</h2>
        <div class="grid">
            <div class="search"> <a>Beer Searching</a> </div>
            <div class="history"><a href="https://www.heineken.com/fr/fr/history">Heineken's history</a></div>
            <div class="connection"><a>Sign in / Connection</a></div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="app.js"></script>

</body>

</html>