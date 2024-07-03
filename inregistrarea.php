<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cinematograf";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $name = $_POST["name"];
    $birthdate = $_POST["birthdate"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `spectatori` (`Nume`, `Prenume`, `Data_nasterii`, `Adresa`, `Nr_telefon`) VALUES ('$name', '', '$birthdate', '$address', $phone)";

    if ($conn->query($sql) === TRUE) {
        $last_inserted_id = $conn->insert_id;

        $sql_user = "INSERT INTO `utilizatori` (`ID_spectator`, `Username`, `Parola`) VALUES ($last_inserted_id, '$username', '$hashed_password')";

        if ($conn->query($sql_user) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql_user . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
