<?php
session_start();
$NumeErr = $PrenumeErr = $DataNasteriiErr = $TaraOrigineErr = $IDFilmErr = $PozaErr = "";
$Nume = $Prenume = $DataNasterii = $TaraOrigine = $IDFilm = $Poza = "";
 
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
        $DataNasteriiErr = "Data nasterii este obligatorie";
    }

    if (empty($_POST["Tara_origine"])) {
        $TaraOrigineErr = "Tara de origine este obligatorie";
    } else {
        $TaraOrigine = test_input($_POST["Tara_origine"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $TaraOrigine)) {
            $TaraOrigineErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["ID_film"])) {
        $IDFilmErr = "ID Film este obligatoriu";
    }

    if ($_FILES['Poza']['error'] === 0) {
    } else {
        $PozaErr = "Eroare la încărcarea imaginii";
    }

    if (empty($NumeErr) && empty($PrenumeErr) && empty($DataNasteriiErr) && empty($TaraOrigineErr) && empty($IDFilmErr) && empty($PozaErr)) {
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
            $Tara_origine = $_POST['Tara_origine'];
            $ID_film = $_POST['ID_film'];

            if ($_FILES['Poza']['error'] === 0) {
                $image_name = $_FILES['Poza']['name'];

                $image_url = 'img/' . $image_name;

                if (move_uploaded_file($_FILES['Poza']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/' . $image_url)) {
                    $sql_actorii = "INSERT INTO actorii (Nume, Prenume, Data_nasterii, Tara_origine, ID_film, Poza) VALUES ('$Nume', '$Prenume', '$Data_nasterii', '$Tara_origine', '$ID_film', '$image_url')";
                    if ($conn->query($sql_actorii) === TRUE) {
                        echo "Datele au fost adăugate în tabelul Actorii cu succes!";
                    } else {
                        echo "Eroare: " . $sql_actorii . "<br>" . $conn->error;
                    }
                } else {
                    echo "Eroare la încărcarea imaginii.";
                }
            } else {
                echo "Eroare la încărcarea imaginii.";
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
    <title>Formular Adaugare Actorii</title>
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
    <form action="Adaugare_actorii.php" method="POST" enctype="multipart/form-data">
        <label for="Nume">Nume:</label>
        <input type="text" name="Nume">
        <span class="error"><?php echo $NumeErr; ?></span><br><br>

        <label for="Prenume">Prenume:</label>
        <input type="text" name="Prenume" >
        <span class="error"><?php echo $PrenumeErr; ?></span><br><br>

        <label for="Data_nasterii">Data_nasterii:</label>
        <input type="date" name="Data_nasterii" >
        <span class="error"><?php echo $DataNasteriiErr; ?></span><br><br>

        <label for="Tara_origine">Tara_origine:</label>
        <input type="text" name="Tara_origine" >
        <span class="error"><?php echo $TaraOrigineErr; ?></span><br><br>

        <label for="ID_film">ID_film:</label>
        <input type="number" name="ID_film" >
        <span class="error"><?php echo $IDFilmErr; ?></span><br><br>

        <label for="Poza">Incarca imagine:</label>
        <input type="file" name="Poza" >
        <span class="error"><?php echo $PozaErr; ?></span><br><br>

        <input type="submit" name="submit" value="Adauga actor">
    </form>
</body>
</html>
