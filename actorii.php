<?php
if (isset($_POST['submit'])) {
    session_start();
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
    echo "<br>";
    if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
    $conn->close();
}
?>
