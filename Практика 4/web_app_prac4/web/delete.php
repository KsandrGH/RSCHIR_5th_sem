<!DOCTYPE html>
<html>
<head>
    <title>Удалить товар</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #c82333;
        }
    </style>
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

    // Защита от SQL-инъекций: используйте подготовленные запросы
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Запись успешно удалена";
    } else {
        echo "Ошибка при удалении записи: " . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>