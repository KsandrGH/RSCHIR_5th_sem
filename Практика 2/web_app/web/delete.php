<!DOCTYPE html>
<html>
<head>
    <title>Удалить товар</title>
</head>
<body>

<h1>Удалить товар</h1>

<form method="GET" action="delete.php">
    <label for="id">ID товара для удаления:</label>
    <input type="number" id="id" name="id" required><br>

    <input type="submit" value="Удалить">
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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно удалена";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
