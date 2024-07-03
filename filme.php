<?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cinematograf";

    $conn = new mysqli($servername, $username, $password, $database);
    session_start();
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
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
    $conn->close();
}
?>
