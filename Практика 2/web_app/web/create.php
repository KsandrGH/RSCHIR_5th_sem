<!DOCTYPE html>
<html>
<head>
    <title>Добавить товар</title>
</head>
<body>

<h1>Добавить товар</h1>

<form method="POST" action="create.php">
    <label for="name">Название товара:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Описание товара:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="price">Цена:</label>
    <input type="number" id="price" name="price" step="0.01" required><br>

    <input type="submit" value="Добавить">
</form>
<?php
$servername = "db";
$username = "root";
$password = "example";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно добавлена";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
