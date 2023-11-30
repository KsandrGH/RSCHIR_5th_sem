<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список товаров</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        form {
            text-align: center;
            margin: 20px;
        }

        label {
            font-size: 18px;
            margin-right: 10px;
        }

        select {
            font-size: 18px;
            padding: 5px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Список товаров</h1>

    <!-- Форма для выбора сортировки -->
    <form method="GET" action="index.php">
        <label for="sort">Сортировка:</label>
        <select id="sort" name="sort">
            <option value="price_asc">По цене (по возрастанию)</option>
            <option value="price_desc">По цене (по убыванию)</option>
            <option value="name_asc">По названию (по возрастанию)</option>
            <option value="name_desc">По названию (по убыванию)</option>
            <option value="description_asc">По описанию (по возрастанию)</option>
            <option value="description_desc">По описанию (по убыванию)</option>
            <option value="id_asc">По ID (по возрастанию)</option>
            <option value="id_desc">По ID (по убыванию)</option>
        </select>
        <input type="submit" value="Применить">
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

    $sort = "price_asc"; // Сортировка по умолчанию

    // Проверяем, была ли отправлена форма с выбором сортировки
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["sort"])) {
        $sort = $_GET["sort"];
    }

    // Определение поля и направления сортировки на основе выбора пользователя
    $orderField = "price";
    $orderDirection = "ASC";

    if ($sort == "price_desc") {
        $orderDirection = "DESC";
        $orderField = "price";
    } elseif ($sort == "name_asc") {
        $orderField = "name";
    } elseif ($sort == "name_desc") {
        $orderDirection = "DESC";
        $orderField = "name";
    } elseif ($sort == "description_asc") {
        $orderField = "description";
    } elseif ($sort == "description_desc") {
        $orderDirection = "DESC";
        $orderField = "description";
    } elseif ($sort == "id_asc") {
        $orderField = "id";
    } elseif ($sort == "id_desc") {
        $orderDirection = "DESC";
        $orderField = "id";
    }

    $sql = "SELECT * FROM products ORDER BY $orderField $orderDirection";
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
