<?php
session_start();
$TitluErr = $RegizorErr = $AnLansareErr = $GenErr = $DurataErr = $LimbaErr = $IDCinematografErr = $PosterErr = "";
$Titlu = $Regizor = $AnLansare = $Gen = $Durata = $Limba = $IDCinematograf = $Poster = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Titlu"])) {
        $TitluErr = "Titlul este obligatoriu";
    } else {
        $Titlu = test_input($_POST["Titlu"]);
    }

    if (empty($_POST["Regizor"])) {
        $RegizorErr = "Regizorul este obligatoriu";
    } else {
        $Regizor = test_input($_POST["Regizor"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Regizor)) {
            $RegizorErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["An_lansare"])) {
        $AnLansareErr = "Anul de lansare este obligatoriu";
    } else {
        $AnLansare = test_input($_POST["An_lansare"]);
    }

    if (empty($_POST["Gen"])) {
        $GenErr = "Genul este obligatoriu";
    } else {
        $Gen = test_input($_POST["Gen"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $Gen)) {
            $GenErr = "Sunt permise doar litere și spații";
        }
    }

    if (empty($_POST["Durata"])) {
        $DurataErr = "Durata este obligatorie";
    } else {
        $Durata = test_input($_POST["Durata"]);
    }

    if (empty($_POST["Limba"])) {
        $LimbaErr = "Limba este obligatorie";
    } else {
        $Limba = test_input($_POST["Limba"]);
    }

    if (empty($_POST["ID_cinematograf"])) {
        $IDCinematografErr = "ID Cinematograf este obligatoriu";
    } else {
        $IDCinematograf = test_input($_POST["ID_cinematograf"]);
    }

    if ($_FILES['Poster']['error'] === 0) {
        $Poster = test_input($_FILES['Poster']['name']);
        $imageFileType = strtolower(pathinfo($Poster, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $PosterErr = "Formatul imaginii nu este acceptat. Alegeți o imagine de tip JPG, JPEG sau PNG.";
        }
    } else {
        $PosterErr = "Eroare la încărcarea imaginii";
    }
    if (empty($TitluErr) && empty($RegizorErr) && empty($AnLansareErr) && empty($GenErr) && empty($DurataErr) && empty($LimbaErr) && empty($IDCinematografErr) && empty($PosterErr)) {
        if (isset($_POST['submit'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "cinematograf";

            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Conexiune eșuată: " . $conn->connect_error);
            }

            $Titlu = $_POST['Titlu'];
            $Regizor = $_POST['Regizor'];
            $An_lansare = $_POST['An_lansare'];
            $Gen = $_POST['Gen'];
            $Durata = $_POST['Durata'];
            $Limba = $_POST['Limba'];
            $ID_cinematograf = $_POST['ID_cinematograf'];

            if ($_FILES['Poster']['error'] === 0) {
                $image_name = $_FILES['Poster']['name'];

                $image_url = 'img/' . $image_name;
                if (move_uploaded_file($_FILES['Poster']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/' . $image_url)) {
                    $sql_filme = "INSERT INTO Filme (Titlu, Regizor, An_lansare, Gen, Durata, Limba, ID_cinematograf, Poster) VALUES ('$Titlu', '$Regizor', '$An_lansare', '$Gen', '$Durata', '$Limba', '$ID_cinematograf', '$image_url')";
                    if ($conn->query($sql_filme) === TRUE) {
                        echo "Datele au fost adăugate în tabelul Filme cu succes!";
                    } else {
                        echo "Eroare: " . $sql_filme . "<br>" . $conn->error;
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
    <title>Formular Adaugare Filme</title>
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
    <form action="Adaugare_filme.php" method="POST" enctype="multipart/form-data">
        <label for="Titlu">Titlu:</label>
        <input type="text" name="Titlu">
        <span class="error"><?php echo $TitluErr; ?></span><br><br>

        <label for="Regizor">Regizor:</label>
        <input type="text" name="Regizor">
        <span class="error"><?php echo $RegizorErr; ?></span><br><br>

        <label for="An_lansare">An de lansare:</label>
        <input type="number" name="An_lansare">
        <span class="error"><?php echo $AnLansareErr; ?></span><br><br>

        <label for="Gen">Gen:</label>
        <input type="text" name="Gen">
        <span class="error"><?php echo $GenErr; ?></span><br><br>

        <label for="Durata">Durata (minute):</label>
        <input type="number" name="Durata">
        <span class="error"><?php echo $DurataErr; ?></span><br><br>

        <label for="Limba">Limba:</label>
        <input type="text" name="Limba">
        <span class="error"><?php echo $LimbaErr; ?></span><br><br>

        <label for="ID_cinematograf">ID Cinematograf:</label>
        <input type="number" name="ID_cinematograf">
        <span class="error"><?php echo $IDCinematografErr; ?></span><br><br>

        <label for="Poster">Incarca imagine:</label>
        <input type="file" name="Poster">
        <span class="error"><?php echo $PosterErr; ?></span><br><br>

        <input type="submit" name="submit" value="Adauga Film">
    </form>
</body>
</html>
