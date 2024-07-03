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
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
$conn->close();
?>
