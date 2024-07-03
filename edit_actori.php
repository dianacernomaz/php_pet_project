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

if (isset($_POST['id_actor'])) {
    $id_actor = $_POST['id_actor'];

    if (isset($_POST['submit'])) {
        $Nume = $_POST['Nume'];
        $Prenume = $_POST['Prenume'];
        $Data_nasterii = $_POST['Data_nasterii'];
        $Tara_origine = $_POST['Tara_origine'];
        $ID_film = $_POST['ID_film'];

        if ($_FILES['Poza']['error'] === 0) {
            $image_name = $_FILES['Poza']['name'];

            $image_url = 'img/' . $image_name;

            if (move_uploaded_file($_FILES['Poza']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/' . $image_url)) {
                $sql_actorii = "UPDATE actorii SET Nume='$Nume', Prenume='$Prenume', Data_nasterii='$Data_nasterii', Tara_origine='$Tara_origine', ID_film='$ID_film', Poza='$image_url' WHERE ID_actor=$id_actor";
                if ($conn->query($sql_actorii) === TRUE) {
                    echo "Datele au fost actualizate cu succes!";
                } else {
                    echo "Eroare: " . $sql_actorii . "<br>" . $conn->error;
                }
            } else {
                echo "Eroare la încărcarea imaginii.";
            }
        } else {
            $sql_actorii = "UPDATE actorii SET Nume='$Nume', Prenume='$Prenume', Data_nasterii='$Data_nasterii', Tara_origine='$Tara_origine', ID_film='$ID_film' WHERE ID_actor=$id_actor";
            if ($conn->query($sql_actorii) === TRUE) {
                echo "Datele au fost actualizate cu succes!";
            } else {
                echo "Eroare: " . $sql_actorii . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT * FROM actorii WHERE ID_actor = $id_actor";
    $result = $conn->query($sql);
    $actor = $result->fetch_assoc();
    if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editare Actor</title>
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
    <h1>Editare Actor</h1>
    <form method="post" action="edit_actori.php" enctype="multipart/form-data">
        <input type="hidden" name="id_actor" value="<?php echo $id_actor; ?>">
        <table>
            <tr>
                <td>Nume</td>
                <td><input type="text" name="Nume" value="<?php echo $actor['Nume']; ?>"></td>
            </tr>
            <tr>
                <td>Prenume</td>
                <td><input type="text" name="Prenume" value="<?php echo $actor['Prenume']; ?>"></td>
            </tr>
            <tr>
                <td>Data nașterii</td>
                <td><input type="date" name="Data_nasterii" value="<?php echo $actor['Data_nasterii']; ?>"></td>
            </tr>
            <tr>
                <td>Țara de origine</td>
                <td><input type="text" name="Tara_origine" value="<?php echo $actor['Tara_origine']; ?>"></td>
            </tr>
            <tr>
                <td>ID film</td>
                <td><input type="text" name="ID_film" value="<?php echo $actor['ID_film']; ?>"></td>
            </tr>
            <tr>
                <td>Poza</td>
                <td>
                    <?php echo "<img src='" . $actor['Poza'] . "' width='100' height='100'>"; ?>
                    <input type="file" name="Poza">
                </td>
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
