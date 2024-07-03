<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h2 {
            margin-bottom: 20px;
        }

        a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #e50914;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            background-color: #ff3c4a;
        }
    </style>
</head>
<body>

    <h2>You have been logged out.</h2>
    <a href="log.html">Login again</a>
    <a href="afisare_actori.php">Înapoi</a>

</body>
</html>

<?php
session_start();

session_unset();

session_destroy();
?>
