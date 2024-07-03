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

if (isset($_POST['id_recenzie'])) {
    $id_recenzie = $_POST['id_recenzie'];

    if (isset($_POST['submit'])) {
        $ID_film = $_POST['ID_film'];
        $Data_recenziei = $_POST['Data_recenziei'];
        $Scor = $_POST['Scor'];
        $Text_recenzie = $_POST['Text_recenzie'];
        $ID_spectator = $_POST['ID_spectator'];

        $sql_recenzii = "UPDATE recenzii SET ID_film='$ID_film', Data_recenziei='$Data_recenziei', Scor='$Scor', Text_recenzie='$Text_recenzie', ID_spectator='$ID_spectator' WHERE ID_recenzie=$id_recenzie";
        if ($conn->query($sql_recenzii) === TRUE) {
            echo "Datele au fost actualizate cu succes!";
        } else {
            echo "Eroare: " . $sql_recenzii . "<br>" . $conn->error;
        }
    }

    $sql = "SELECT * FROM recenzii WHERE ID_recenzie = $id_recenzie";
    $result = $conn->query($sql);
    $recenzie = $result->fetch_assoc();
    if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editare Recenzie</title>
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
    <h1>Editare Recenzie</h1>
    <form method="post" action="edit_recenzii.php">
        <input type="hidden" name="id_recenzie" value="<?php echo $id_recenzie; ?>">
        <table>
            <tr>
                <td>ID Film</td>
                <td><input type="text" name="ID_film" value="<?php echo $recenzie['ID_film']; ?>"></td>
            </tr>
            <tr>
                <td>Data recenziei</td>
                <td><input type="date" name="Data_recenziei" value="<?php echo $recenzie['Data_recenziei']; ?>"></td>
            </tr>
            <tr>
                <td>Scor</td>
                <td><input type="text" name="Scor" value="<?php echo $recenzie['Scor']; ?>"></td>
            </tr>
            <tr>
                <td>Text recenzie</td>
                <td><input type="text" name="Text_recenzie" value="<?php echo $recenzie['Text_recenzie']; ?>"></td>
            </tr>
            <tr>
                <td>ID Spectator</td>
                <td><input type="text" name="ID_spectator" value="<?php echo $recenzie['ID_spectator']; ?>"></td>
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
