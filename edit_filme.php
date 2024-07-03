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

if (isset($_POST['id_film'])) {
    $id_film = $_POST['id_film'];

    if (isset($_POST['submit'])) {
        $Titlu = $_POST['Titlu'];
        $Regizor = $_POST['Regizor'];
        $An_lansare = $_POST['An_lansare'];
        $Gen = $_POST['Gen'];
        $Durata = $_POST['Durata'];
        $Limba = $_POST['Limba'];

        if ($_FILES['Poster']['error'] === 0) {
            $image_name = $_FILES['Poster']['name'];

            $image_url = 'img/' . $image_name;
            if (move_uploaded_file($_FILES['Poster']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/' . $image_url)) {
                $sql_filme = "UPDATE Filme SET Titlu='$Titlu', Regizor='$Regizor', An_lansare='$An_lansare', Gen='$Gen', Durata='$Durata', Limba='$Limba', Poster='$image_url' WHERE ID_film=$id_film";
                if ($conn->query($sql_filme) === TRUE) {
                    echo "Datele au fost actualizate cu succes!";
                } else {
                    echo "Eroare: " . $sql_filme . "<br>" . $conn->error;
                }
            } else {
                echo "Eroare la încărcarea imaginii.";
            }
        } else {
            $sql_filme = "UPDATE Filme SET Titlu='$Titlu', Regizor='$Regizor', An_lansare='$An_lansare', Gen='$Gen', Durata='$Durata', Limba='$Limba' WHERE ID_film=$id_film";
            if ($conn->query($sql_filme) === TRUE) {
                echo "Datele au fost actualizate cu succes!";
            } else {
                echo "Eroare: " . $sql_filme . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT * FROM Filme WHERE ID_film = $id_film";
    $result = $conn->query($sql);
    $film = $result->fetch_assoc();
    if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editare film</title>
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
    <h1>Editare Film</h1>
    <form method="post" action="edit_filme.php" enctype="multipart/form-data">
        <input type="hidden" name="id_film" value="<?php echo $id_film; ?>">
        <table>
            <tr>
                <td>Titlu</td>
                <td><input type="text" name="Titlu" value="<?php echo $film['Titlu']; ?>"></td>
            </tr>
            <tr>
                <td>Regizor</td>
                <td><input type="text" name="Regizor" value="<?php echo $film['Regizor']; ?>"></td>
            </tr>
            <tr>
                <td>An lansare</td>
                <td><input type="text" name="An_lansare" value="<?php echo $film['An_lansare']; ?>"></td>
            </tr>
            <tr>
                <td>Gen</td>
                <td><input type="text" name="Gen" value="<?php echo $film['Gen']; ?>"></td>
            </tr>
            <tr>
                <td>Durata</td>
                <td><input type="text" name="Durata" value="<?php echo $film['Durata']; ?>"></td>
            </tr>
            <tr>
                <td>Limba</td>
                <td><input type="text" name="Limba" value="<?php echo $film['Limba']; ?>"></td>
            </tr>
            <tr>
                <td>Poster</td>
                <td>
                    <?php echo "<img src='" . $film['Poster'] . "' width='100' height='100'>"; ?>
                    <input type="file" name="Poster">
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
