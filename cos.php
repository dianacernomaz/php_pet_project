<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cinematograf";

$conn = new mysqli($servername, $username, $password, $database);
session_start();
if (!isset($_SESSION['ID_utilizator'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['ID_utilizator'];
$query = "SELECT filme.ID_film, filme.Titlu
          FROM filme";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watched Movies</title>
</head>
<body>

<h2>Watched Movies</h2>

<form action="process_watched_movies.php" method="post">
    <label for="watched_movies">Select the movies you have watched:</label>
    <select name="watched_movies[]" id="watched_movies" multiple>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['ID_film']}'>{$row['Titlu']}</option>";
        }
        ?>
    </select>
    <br>
    <input type="submit" value="Submit">
</form>

<a href="logout.php">Logout</a>

</body>
</html>
