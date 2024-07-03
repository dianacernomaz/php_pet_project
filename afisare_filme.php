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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1f1f1f;
            color: #fff;
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
            max-width: 80px;
            max-height: 80px;
            border-radius: 5px;
        }

        form {
            display: inline-block;
        }

        .auth-message {
            color: #e50914;
            text-align: center;
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #e50914;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff0c18;
        }

        .delete-btn,
        .edit-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #e50914;
            font-size: 16px;
        }

        .delete-btn:hover,
        .edit-btn:hover {
            color: #ff0c18;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #333;
            color: white;
        }

        .logo {
            width: 50px;
        }

        .menu {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu a {
            text-decoration: none;
            color: white;
            margin: 0 15px;
        }

        .auth {
            display: flex;
            align-items: center;
        }

        .auth a {
            text-decoration: none;
            color: white;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
    <div class="logo">
      <img src="img/logo.png" alt="Logo">
    </div>
    <div class="menu">
      <a href="afisare_actori.php">Actori</a>
      <a href="afisare_spectatori.php">Spectatori</a>
      <a href="afisare_filme.php">Filme</a>
      <a href="afisare_recenzii.php">Recenzii</a>
      <a href="afisare_cinematografe.php">Cinematografe</a>
    </div>
    <div class="auth">
      <a href="log.html">Logare</a>
      <a href="inregistrare.html">Înregistrare</a>
    </div>
  </div>
    <h1>Listă Filme</h1>

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
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "cinematograf";
        $conn = new mysqli($servername, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Conexiune eșuată: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Filme";
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
            echo "<form method='post' action='filtrare_filme.php'>
                            <form method='post' action='filtrare_filme.php'>
                            <input type='submit' value='Filtrare'>"."<br>"."<br>";
            echo "<form method='post' action='adaugare_actori.php'>
                            <form method='post' action='adaugare_actori.php'>
                            <input type='submit' value='Adaugare'>"."<br>"."<br>";
        }

        $conn->close();
        if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        ?>
    </table>
</body>
</html>
