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

$Nume = $_POST['Nume'];
$Prenume = $_POST['Prenume'];
$Data_nasterii = $_POST['Data_nasterii'];
$Adresa = $_POST['Adresa'];
$Nr_telefon = $_POST['Nr_telefon'];

$sql_actori = "INSERT INTO Spectatori (Nume, Prenume, Data_nasterii, Adresa, Nr_telefon) VALUES ('$Nume', '$Prenume', '$Data_nasterii', '$Adresa', '$Nr_telefon')";
if ($conn->query($sql_actori) === TRUE) {
    echo "Datele au fost adăugate în tabelul Spectatori cu succes!";
} else {
    echo "Eroare: " . $sql_actori . "<br>" . $conn->error;
}
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
$conn->close();
?>
