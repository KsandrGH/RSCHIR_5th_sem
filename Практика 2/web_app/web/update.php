<!DOCTYPE html>
<html>
<head>
    <title>Редактировать товар</title>
</head>
<body>

<h1>Редактировать товар</h1>

<form method="POST" action="update.php">
    <label for="id">ID товара для редактирования:</label>
    <input type="number" id="id" name="id" required><br>

    <label for="name">Новое название товара:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Новое описание товара:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="price">Новая цена:</label>
    <input type="number" id="price" name="price" step="0.01" required><br>

    <input type="submit" value="Редактировать">
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
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно обновлена";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
