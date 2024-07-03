<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cinematograf";

    $conn = new mysqli($servername, $username, $password, $database);
session_start();
    if ($conn->connect_error) {
        die("Conexiune eșuată: " . $conn->connect_error);
    }

    $cinematograf_id = $_POST['cinematograf_id'];

    $sql = "DELETE FROM cinematografe WHERE ID_cinematograf = $cinematograf_id";

    if ($conn->query($sql) === TRUE) {
        echo "Cinematograf cu ID $cinematograf_id a fost șters din baza de date.";
    } else {
        echo "Eroare: " . $sql . "<br>" . $conn->error;
    }
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";

    $conn->close();
}
?>
