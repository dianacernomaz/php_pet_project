<?php
session_start();
$NumeErr = $PrenumeErr = $DataNasteriiErr = $AdresaErr = $NrTelefonErr = "";
$Nume = $Prenume = $DataNasterii = $Adresa = $NrTelefon = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Nume"])) {
        $NumeErr = "Numele este obligatoriu";
    } else {
        $Nume = test_input($_POST["Nume"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Nume)) {
            $NumeErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["Prenume"])) {
        $PrenumeErr = "Prenumele este obligatoriu";
    } else {
        $Prenume = test_input($_POST["Prenume"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Prenume)) {
            $PrenumeErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["Data_nasterii"])) {
        $DataNasteriiErr = "Data nașterii este obligatorie";
    } else {
        $DataNasterii = test_input($_POST["Data_nasterii"]);
    }

    if (empty($_POST["Adresa"])) {
        $AdresaErr = "Adresa este obligatorie";
    } else {
        $Adresa = test_input($_POST["Adresa"]);
    }

    if (empty($_POST["Nr_telefon"])) {
        $NrTelefonErr = "Numărul de telefon este obligatoriu";
    } else {
        $NrTelefon = test_input($_POST["Nr_telefon"]);
    }

    if (empty($NumeErr) && empty($PrenumeErr) && empty($DataNasteriiErr) && empty($AdresaErr) && empty($NrTelefonErr)) {
        if (isset($_POST['submit'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "cinematograf";

            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Conexiune eșuată: " . $conn->connect_error);
            }

            $Nume = $_POST['Nume'];
            $Prenume = $_POST['Prenume'];
            $Data_nasterii = $_POST['Data_nasterii'];
            $Adresa = $_POST['Adresa'];
            $Nr_telefon = $_POST['Nr_telefon'];

            $sql_spectatori = "INSERT INTO Spectatori (Nume, Prenume, Data_nasterii, Adresa, Nr_telefon) VALUES ('$Nume', '$Prenume', '$Data_nasterii', '$Adresa', '$Nr_telefon')";
            
            if ($conn->query($sql_spectatori) === TRUE) {
                echo "Datele au fost adăugate în tabelul Spectatori cu succes!";
            } else {
                echo "Eroare: " . $sql_spectatori . "<br>" . $conn->error;
            }

            $conn->close();
        }
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
    <title>Formular Adaugare Spectatori</title>
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
    <form action="Adaugare_spectatori.php" method="POST">
        <label for="Nume">Nume:</label>
        <input type="text" name="Nume">
        <span class="error"><?php echo $NumeErr; ?></span><br><br>

        <label for="Prenume">Prenume:</label>
        <input type="text" name="Prenume">
        <span class="error"><?php echo $PrenumeErr; ?></span><br><br>

        <label for="Data_nasterii">Data nașterii:</label>
        <input type="date" name="Data_nasterii">
        <span class="error"><?php echo $DataNasteriiErr; ?></span><br><br>

        <label for="Adresa">Adresa:</label>
        <input type="text" name="Adresa">
        <span class="error"><?php echo $AdresaErr; ?></span><br><br>

        <label for="Nr_telefon">Număr de telefon:</label>
        <input type="number" name="Nr_telefon">
        <span class="error"><?php echo $NrTelefonErr; ?></span><br><br>

        <input type="submit" name="submit" value="Adauga spectator">
    </form>
</body>
</html>
