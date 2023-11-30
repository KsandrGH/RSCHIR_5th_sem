<!DOCTYPE html>
<html>
<head>
    <title>Просмотр товара</title>
</head>
<body>

<h1>Просмотр товара</h1>

<form method="GET" action="read.php">
    <label for="id">ID товара для просмотра:</label>
    <input type="number" id="id" name="id" required><br>

    <input type="submit" value="Просмотреть">
</form>

<?php
$servername = "db"; 
$username = "user";
$password = "example";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "ID: " . $row["id"]. "<br>";
        echo "Название: " . $row["name"]. "<br>";
        echo "Описание: " . $row["description"]. "<br>";
        echo "Цена: " . $row["price"]. "<br>";
    } else {
        echo "Товар не найден";
    }
}

$conn->close();
?>
