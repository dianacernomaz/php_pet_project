<!DOCTYPE html>
<html>
<head>
    <title>Listă Cinematografe</title>
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
    <h1>Listă Cinematografe</h1>

    <form method="post">
        <label>Denumirea:</label>
        <input type="text" name="cautaDenumirea"><br>

        <label>Adresa:</label>
        <input type="text" name="cautaAdresa"><br>

        <label>Oras:</label>
        <input type="text" name="cautaOras"><br>

        <label>Stat:</label>
        <input type="text" name="cautaStat"><br>

        <label>Capacitate:</label>
        <input type="number" name="cautaCapacitate"><br>

        <input type="submit" name="btnSearch" value="Caută">
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Denumirea</th>
            <th>Adresa</th>
            <th>Oras</th>
            <th>Stat</th>
            <th>Capacitate</th>
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

        $sql = "SELECT * FROM Cinematografe WHERE 1=1";

        if (isset($_POST['btnSearch'])) {
            $cautaDenumirea = $_POST['cautaDenumirea'];
            $cautaAdresa = $_POST['cautaAdresa'];
            $cautaOras = $_POST['cautaOras'];
            $cautaStat = $_POST['cautaStat'];
            $cautaCapacitate = $_POST['cautaCapacitate'];

            if (!empty($cautaDenumirea)) {
                $sql .= " AND Denumirea LIKE '%$cautaDenumirea%'";
            }

            if (!empty($cautaAdresa)) {
                $sql .= " AND Adresa LIKE '%$cautaAdresa%'";
            }

            if (!empty($cautaOras)) {
                $sql .= " AND Oras LIKE '%$cautaOras%'";
            }

            if (!empty($cautaStat)) {
                $sql .= " AND Stat LIKE '%$cautaStat%'";
            }

            if (!empty($cautaCapacitate)) {
                $sql .= " AND Capacitate = $cautaCapacitate";
            }
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID_cinematograf"] . "</td>";
                echo "<td>" . $row["Denumirea"] . "</td>";
                echo "<td>" . $row["Adresa"] . "</td>";
                echo "<td>" . $row["Oras"] . "</td>";
                echo "<td>" . $row["Stat"] . "</td>";
                echo "<td>" . $row["Capacitate"] . "</td>";
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
