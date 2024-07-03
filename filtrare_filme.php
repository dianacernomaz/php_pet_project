<!DOCTYPE html>
<html>
<head>
    <title>Listă Filme</title>
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
            margin: 20px auto;
            padding: 20px;
            background-color: #1f1f1f;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #fff;
        }

        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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

        table {
            width: 100%;
            margin-top: 20px;
            background-color: #1f1f1f;
            color: #fff;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background-color: #1f1f1f;
            color: #e50914;
        }

        tr:nth-child(even) {
            background-color: #292929;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        .auth-message {
            color: #e50914;
            text-align: center;
            margin-top: 10px;
        }
        </style>
</head>
<body>
    <h1>Listă Filme</h1>

    <form method="post">
        <label>Titlu:</label>
        <input type="text" name="cautaTitlu"><br>

        <label>Regizor:</label>
        <input type="text" name="cautaRegizor"><br>

        <label>An lansare:</label>
        <input type="number" name="cautaAn"><br>

        <input type="submit" name="btnSearch" value="Caută">
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titlu</th>
            <th>Regizor</th>
            <th>An_lansare</th>
            <th>Gen</th>
            <th>Durata</th>
            <th>Limba</th>
            <th>Poster</th>
        </tr>
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

        $sql = "SELECT * FROM Filme WHERE 1=1";

        if (isset($_POST['btnSearch'])) {
            $cautaTitlu = $_POST['cautaTitlu'];
            $cautaRegizor = $_POST['cautaRegizor'];
            $cautaAn = $_POST['cautaAn'];

            if (!empty($cautaTitlu)) {
                $sql .= " AND Titlu LIKE '%$cautaTitlu%'";
            }

            if (!empty($cautaRegizor)) {
                $sql .= " AND Regizor LIKE '%$cautaRegizor%'";
            }

            if (!empty($cautaAn)) {
                $sql .= " AND An_lansare = $cautaAn";
            }
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID_film"] . "</td>";
                echo "<td>" . $row["Titlu"] . "</td>";
                echo "<td>" . $row["Regizor"] . "</td>";
                echo "<td>" . $row["An_lansare"] . "</td>";
                echo "<td>" . $row["Gen"] . "</td>";
                echo "<td>" . $row["Durata"] . "</td>";
                echo "<td>" . $row["Limba"] . "</td>";
                echo "<td><img src='" . $row["Poster"] . "' width='100' height='100'></td>";
                echo "<td>
                        <form method='post' action='stergere_filme.php'>
                            <input type='hidden' name='film_id' value='" . $row["ID_film"] . "'>
                            <input type='submit' value='Șterge'>
                        </form>
                      </td>";
                      echo "<td>
                        <form method='post' action='edit_filme.php'>
                            <input type='hidden' name='id_film' value='" . $row["ID_film"] . "'>
                            <input type='submit' value='Editare'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        }
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        $conn->close();
        ?>
    </table>
</body>
</html>
