<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Просмотр товара</title>
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

        .container {
            width: 300px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        p {
            font-size: 18px;
            margin: 20px 0;
        }

        .not-found {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Просмотр товара</h1>

    <div class="container">
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
                echo "<p>ID: " . $row["id"]. "</p>";
                echo "<p>Название: " . $row["name"]. "</p>";
                echo "<p>Описание: " . $row["description"]. "</p>";
                echo "<p>Цена: " . $row["price"]. "</p>";
            } else {
                echo "<p class='not-found'>Товар не найден</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
