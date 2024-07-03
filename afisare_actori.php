<!DOCTYPE html>
<html>
<head>
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
    <title>Listă Actori</title>
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
    <h1>Listă Actori</h1>
   
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Data nasterii</th>
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

        $sql = "SELECT * FROM actorii";
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
                echo "<td>
                        <form method='post' action='stergere_actori.php'>
                            <input type='hidden' name='actor_id' value='" . $row["ID_actor"] . "'>
                            <input type='submit' value='Șterge'>
                        </form>
                      </td>";
                      echo "<td>
                        <form method='post' action='edit_actori.php'>
                            <input type='hidden' name='id_actor' value='" . $row["ID_actor"] . "'>
                            <input type='submit' value='Editare'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "<form method='post' action='filtrare_actori.php'>
                            <form method='post' action='filtrare_actori.php'>
                            <input type='submit' value='Filtrare'>"."<br>"."<br>";
            echo "<form method='post' action='adaugare_actori.php'>
                            <form method='post' action='adaugare_actori.php'>
                            <input type='submit' value='Adaugare'>"."<br>"."<br>";
        }
        if (isset($_SESSION["username"])){ echo " Utilizatorul ".$_SESSION["username"]." este autentificat !";
        } else echo " Nici un utilizator nu este autentificat !";
        
        $conn->close();
        ?>
    </table>
</body>
</html>
