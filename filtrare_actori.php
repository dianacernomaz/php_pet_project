<!DOCTYPE html>
<html>
<head>
    <title>Listă Actorii</title>
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
    <h1>Listă Actorii</h1>

    <form method="post">
        <label>Nume:</label>
        <input type="text" name="cautaNume"><br>

        <label>Prenume:</label>
        <input type="text" name="cautaPrenume"><br>

        <label>Data nașterii:</label>
        <input type="date" name="cautaDataNasterii"><br>

        <label>Tara origine:</label>
        <input type="text" name="cautaTaraOrigine"><br>

        <input type="submit" name="btnSearch" value="Caută">
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Data nașterii</th>
            <th>Tara origine</th>
            <th>ID film</th>
            <th>Poza</th>
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

        $sql = "SELECT * FROM actorii WHERE 1=1";

        if (isset($_POST['btnSearch'])) {
            $cautaNume = $_POST['cautaNume'];
            $cautaPrenume = $_POST['cautaPrenume'];
            $cautaDataNasterii = $_POST['cautaDataNasterii'];
            $cautaTaraOrigine = $_POST['cautaTaraOrigine'];

            if (!empty($cautaNume)) {
                $sql .= " AND Nume LIKE '%$cautaNume%'";
            }

            if (!empty($cautaPrenume)) {
                $sql .= " AND Prenume LIKE '%$cautaPrenume%'";
            }

            if (!empty($cautaDataNasterii)) {
                $sql .= " AND Data_nasterii = '$cautaDataNasterii'";
            }

            if (!empty($cautaTaraOrigine)) {
                $sql .= " AND Tara_origine LIKE '%$cautaTaraOrigine%'";
            }

        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID_actor"] . "</td>";
                echo "<td>" . $row["Nume"] . "</td>";
                echo "<td>" . $row["Prenume"] . "</td>";
                echo "<td>" . $row["Data_nasterii"] . "</td>";
                echo "<td>" . $row["Tara_origine"] . "</td>";
                echo "<td>" . $row["ID_film"] . "</td>";
                echo "<td><img src='" . $row["Poza"] . "' width='100' height='100'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Niciun rezultat găsit</td></tr>";
        }
if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
        $conn->close();
        ?>
    </table>
</body>
</html>
