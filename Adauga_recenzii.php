<?php
session_start();
$IDFilmErr = $DataRecenzieiErr = $ScorErr = $TextRecenzieErr = $IDSpectatorErr = "";
$IDFilm = $DataRecenziei = $Scor = $TextRecenzie = $IDSpectator = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["ID_film"])) {
        $IDFilmErr = "ID_film este obligatoriu";
    } else {
        $IDFilm = test_input($_POST["ID_film"]);
    }

    if (empty($_POST["Data_recenziei"])) {
        $DataRecenzieiErr = "Data_recenziei este obligatorie";
    } else {
        $DataRecenziei = test_input($_POST["Data_recenziei"]);
    }

    if (empty($_POST["Scor"])) {
        $ScorErr = "Scor este obligatoriu";
    } else {
        $Scor = test_input($_POST["Scor"]);
    }

    if (empty($_POST["ID_spectator"])) {
        $IDSpectatorErr = "ID_spectator este obligatoriu";
    } else {
        $IDSpectator = test_input($_POST["ID_spectator"]);
    }
    if (empty($IDFilmErr) && empty($DataRecenzieiErr) && empty($ScorErr) && empty($TextRecenzieErr) && empty($IDSpectatorErr)) {
    $servername = "localhost";
$username = "root";
$password = "";
$database = "cinematograf";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$ID_film = $_POST['ID_film'];
$Data_recenziei = $_POST['Data_recenziei'];
$Scor = $_POST['Scor'];
$Text_recenzie = $_POST['Text_recenzie'];
$ID_spectator = $_POST['ID_spectator'];

$sql_actori = "INSERT INTO Recenzii (ID_film, Data_recenziei, Scor, Text_recenzie, ID_spectator) VALUES ('$ID_film', '$Data_recenziei', '$Scor', '$Text_recenzie', '$ID_spectator')";
if ($conn->query($sql_actori) === TRUE) {
    echo "Datele au fost adăugate în tabelul Recenzii cu succes!";
} else {
    echo "Eroare: " . $sql_actori . "<br>" . $conn->error;
}

$conn->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formular Adaugare Recenzii</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #141414;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        input[type="number"],
        input[type="date"],
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #333;
            border-radius: 3px;
            background-color: #1f1f1f;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #e50914;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff0c18;
        }

        .error {
            color: #e50914;
        }

        .auth-message {
            color: #e50914;
            text-align: center;
            margin-top: 10px;
        }
    </style
</head>
<body>

    <form action="Adauga_recenzii.php" method="POST" onsubmit="return validateForm()">
        <label for="ID_film">ID_film:</label>
        <input type="number" name="ID_film" value="<?php echo $IDFilm;?>">
        <span class="error"><?php echo $IDFilmErr;?></span><br><br>

        <label for="Data_recenziei">Data_recenziei:</label>
        <input type="date" name="Data_recenziei" value="<?php echo $DataRecenziei;?>">
        <span class="error"><?php echo $DataRecenzieiErr;?></span><br><br>

        <label for="Scor">Scor:</label>
        <input type="number" name="Scor" value="<?php echo $Scor;?>">
        <span class="error"><?php echo $ScorErr;?></span><br><br>

        <label for="Text_recenzie">Text_recenzie:</label>
        <input type="text" name="Text_recenzie" value="<?php echo $TextRecenzie;?>">
        <span class="error"><?php echo $TextRecenzieErr;?></span><br><br>

        <label for="ID_spectator">ID_spectator:</label>
        <input type="number" name="ID_spectator" value="<?php echo $IDSpectator;?>">
        <span class="error"><?php echo $IDSpectatorErr;?></span><br><br>

        <input type="submit" value="Adauga actor">
    </form>

</body>
</html>
