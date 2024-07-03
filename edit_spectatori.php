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

if (isset($_POST['id_spectator'])) {
    $id_spectator = $_POST['id_spectator'];

    if (isset($_POST['submit'])) {
        $Nume = $_POST['Nume'];
        $Prenume = $_POST['Prenume'];
        $Data_nasterii = $_POST['Data_nasterii'];
        $Adresa = $_POST['Adresa'];
        $Nr_telefon = $_POST['Nr_telefon'];

        $sql_spectatori = "UPDATE spectatori SET Nume='$Nume', Prenume='$Prenume', Data_nasterii='$Data_nasterii', Adresa='$Adresa', Nr_telefon='$Nr_telefon' WHERE ID_spectator=$id_spectator";
        if ($conn->query($sql_spectatori) === TRUE) {
            echo "Datele au fost actualizate cu succes!";
        } else {
            echo "Eroare: " . $sql_spectatori . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM spectatori WHERE ID_spectator = $id_spectator";
    $result = $conn->query($sql);
    $spectator = $result->fetch_assoc();
    if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editare Spectator</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #141414;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #e50914;
            text-align: center;
            padding: 20px 0;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
            background-color: #1f1f1f;
            color: #fff;
            border-collapse: collapse;
        }

        td, th {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        tr:nth-child(even) {
            background-color: #292929;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
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

        img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Editare Spectator</h1>
    <form method="post" action="edit_spectatori.php">
        <input type="hidden" name="id_spectator" value="<?php echo $id_spectator; ?>">
        <table>
            <tr>
                <td>Nume</td>
                <td><input type="text" name="Nume" value="<?php echo $spectator['Nume']; ?>"></td>
            </tr>
            <tr>
                <td>Prenume</td>
                <td><input type="text" name="Prenume" value="<?php echo $spectator['Prenume']; ?>"></td>
            </tr>
            <tr>
                <td>Data nașterii</td>
                <td><input type="date" name="Data_nasterii" value="<?php echo $spectator['Data_nasterii']; ?>"></td>
            </tr>
            <tr>
                <td>Adresa</td>
                <td><input type="text" name="Adresa" value="<?php echo $spectator['Adresa']; ?>"></td>
            </tr>
            <tr>
                <td>Nr de telefon</td>
                <td><input type="text" name="Nr_telefon" value="<?php echo $spectator['Nr_telefon']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Actualizează"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    $conn->close();
}
?>
