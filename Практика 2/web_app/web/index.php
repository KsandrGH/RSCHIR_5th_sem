<!DOCTYPE html>
<html>
<head>
    <title>Список товаров</title>
</head>
<body>

<h1>Список товаров</h1>

<?php
$servername = "db"; 
$username = "root";
$password = "example";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Название</th><th>Описание</th><th>Цена</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"]. "</td>";
        echo "<td>" . $row["name"]. "</td>";
        echo "<td>" . $row["description"]. "</td>";
        echo "<td>" . $row["price"]. "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Нет записей в базе данных";
}

$conn->close();
?>

</body>
</html>
