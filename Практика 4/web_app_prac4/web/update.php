<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редактировать товар</title>
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

        input[type="number"],
        input[type="text"],
        textarea {
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

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Редактировать товар</h1>

    <div class="container">
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
                echo "<p class='success'>Запись успешно обновлена</p>";
            } else {
                echo "<p class='error'>Ошибка: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
