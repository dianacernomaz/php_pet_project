<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cinematograf";

$conn = new mysqli($servername, $username, $password, $database);
session_start();
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
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
$conn->close();
?>
