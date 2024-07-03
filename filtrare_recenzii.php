<!DOCTYPE html>
<html>
<head>
    <title>Listă Recenzii</title>
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
    <h1>Listă Recenzii</h1>

    <form method="post">
        <label>ID Film:</label>
        <input type="number" name="cautaIDFilm"><br>

        <label>Data recenziei:</label>
        <input type="date" name="cautaDataRecenziei"><br>

        <label>Scor:</label>
        <input type="number" name="cautaScor"><br>

        <label>Text recenzie:</label>
        <input type="text" name="cautaTextRecenzie"><br>

        <label>ID spectator:</label>
        <input type="number" name="cautaIDSpectator"><br>

        <input type="submit" name="btnSearch" value="Caută">
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Film</th>
            <th>Data recenziei</th>
            <th>Scor</th>
            <th>Text recenzie</th>
            <th>ID spectator</th>
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

        $sql = "SELECT * FROM Recenzii WHERE 1=1";

        if (isset($_POST['btnSearch'])) {
            $cautaIDFilm = $_POST['cautaIDFilm'];
            $cautaDataRecenziei = $_POST['cautaDataRecenziei'];
            $cautaScor = $_POST['cautaScor'];
            $cautaTextRecenzie = $_POST['cautaTextRecenzie'];
            $cautaIDSpectator = $_POST['cautaIDSpectator'];

            if (!empty($cautaIDFilm)) {
                $sql .= " AND ID_film = $cautaIDFilm";
            }

            if (!empty($cautaDataRecenziei)) {
                $sql .= " AND Data_recenziei = '$cautaDataRecenziei'";
            }

            if (!empty($cautaScor)) {
                $sql .= " AND Scor = $cautaScor";
            }

            if (!empty($cautaTextRecenzie)) {
                $sql .= " AND Text_recenzie LIKE '%$cautaTextRecenzie%'";
            }

            if (!empty($cautaIDSpectator)) {
                $sql .= " AND ID_spectator = $cautaIDSpectator";
            }
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID_recenzie"] . "</td>";
                echo "<td>" . $row["ID_film"] . "</td>";
                echo "<td>" . $row["Data_recenziei"] . "</td>";
                echo "<td>" . $row["Scor"] . "</td>";
                echo "<td>" . $row["Text_recenzie"] . "</td>";
                echo "<td>" . $row["ID_spectator"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Niciun rezultat găsit</td></tr>";
        }
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        $conn->close();
        ?>
    </table>
</body>
</html>
