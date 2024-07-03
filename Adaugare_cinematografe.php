<?php
session_start();
$DenumireaErr = $AdresaErr = $OrasErr = $StatErr = $CapacitateErr = "";
$Denumirea = $Adresa = $Oras = $Stat = $Capacitate = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Denumirea"])) {
        $DenumireaErr = "Denumirea este obligatorie";
    } else {
        $Denumirea = test_input($_POST["Denumirea"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Denumirea)) {
            $DenumireaErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["Adresa"])) {
        $AdresaErr = "Adresa este obligatorie";
    } else {
        $Adresa = test_input($_POST["Adresa"]);
    }

    if (empty($_POST["Oras"])) {
        $OrasErr = "Orasul este obligatoriu";
    } else {
        $Oras = test_input($_POST["Oras"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Oras)) {
            $OrasErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["Stat"])) {
        $StatErr = "Statul este obligatoriu";
    } else {
        $Stat = test_input($_POST["Stat"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Stat)) {
            $StatErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["Capacitate"])) {
        $CapacitateErr = "Capacitatea este obligatorie";
    } else {
        $Capacitate = test_input($_POST["Capacitate"]);
    }
    if (empty($DenumireaErr) && empty($AdresaErr) && empty($OrasErr) && empty($StatErr) && empty($CapacitateErr)) {
$servername = "localhost";
$username = "root";
$password = "";
$database = "cinematograf";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}

$Denumirea = $_POST['Denumirea'];
$Adresa = $_POST['Adresa'];
$Oras = $_POST['Oras'];
$Stat = $_POST['Stat'];
$Capacitate = $_POST['Capacitate'];

$sql_cinematografe = "INSERT INTO Cinematografe (Denumirea, Adresa, Oras, Stat, Capacitate) VALUES ('$Denumirea', '$Adresa', '$Oras', '$Stat', '$Capacitate')";
if ($conn->query($sql_cinematografe) === TRUE) {
    echo "Datele au fost adăugate în tabelul Cinematografe cu succes!";
} else {
    echo "Eroare: " . $sql_cinematografe . "<br>" . $conn->error;
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
    <title>Formular Adaugare Cinematografe</title>
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

        /* Stilizare mesaj autentificare */
        .auth-message {
            color: #e50914;
            text-align: center;
            margin-top: 10px;
        }
    </style
</head>
<body>

    <form action="Adaugare_cinematografe.php" method="POST">
        <label for="Denumirea">Denumirea:</label>
        <input type="text" name="Denumirea">
        <span class="error"><?php echo $DenumireaErr; ?></span><br><br>

        <label for="Adresa">Adresa:</label>
        <input type="text" name="Adresa" >
        <span class="error"><?php echo $AdresaErr; ?></span><br><br>

        <label for="Oras">Oras:</label>
        <input type="text" name="Oras" >
        <span class="error"><?php echo $OrasErr; ?></span><br><br>

        <label for="Stat">Stat:</label>
        <input type="text" name="Stat" >
        <span class="error"><?php echo $StatErr; ?></span><br><br>

        <label for="Capacitate">Capacitate (locuri):</label>
        <input type="number" name="Capacitate" >
        <span class="error"><?php echo $CapacitateErr; ?></span><br><br>

        <input type="submit" value="Adauga Cinematograf">
    </form>

</body>
</html>
