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

if (isset($_POST['id_cinematograf'])) {
    $id_cinematograf = $_POST['id_cinematograf'];

    if (isset($_POST['submit'])) {
        $Denumirea = $_POST['Denumirea'];
        $Adresa = $_POST['Adresa'];
        $Oras = $_POST['Oras'];
        $Stat = $_POST['Stat'];
        $Capacitate = $_POST['Capacitate'];

        $sql_cinematografe = "UPDATE cinematografe SET Denumirea='$Denumirea', Adresa='$Adresa', Oras='$Oras', Stat='$Stat', Capacitate='$Capacitate' WHERE ID_cinematograf=$id_cinematograf";
        if ($conn->query($sql_cinematografe) === TRUE) {
            echo "Datele au fost actualizate cu succes!";
        } else {
            echo "Eroare: " . $sql_cinematografe . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM cinematografe WHERE ID_cinematograf = $id_cinematograf";
    $result = $conn->query($sql);
    $cinematograf = $result->fetch_assoc();
    if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editare Cinematograf</title>
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
    <h1>Editare Cinematograf</h1>
    <form method="post" action="edit_cinematografe.php">
        <input type="hidden" name="id_cinematograf" value="<?php echo $id_cinematograf; ?>">
        <table>
            <tr>
                <td>Denumirea</td>
                <td><input type="text" name="Denumirea" value="<?php echo $cinematograf['Denumirea']; ?>"></td>
            </tr>
            <tr>
                <td>Adresa</td>
                <td><input type="text" name="Adresa" value="<?php echo $cinematograf['Adresa']; ?>"></td>
            </tr>
            <tr>
                <td>Oras</td>
                <td><input type="text" name="Oras" value="<?php echo $cinematograf['Oras']; ?>"></td>
            </tr>
            <tr>
                <td>Stat</td>
                <td><input type="text" name="Stat" value="<?php echo $cinematograf['Stat']; ?>"></td>
            </tr>
            <tr>
                <td>Capacitate</td>
                <td><input type="text" name="Capacitate" value="<?php echo $cinematograf['Capacitate']; ?>"></td>
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
