<?php
// Подключение к базе данных
$servername = "db";
$username = "root";
$password = "examplepassword";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Обработка GET-запроса для получения списка продуктов
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $products = array();
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($products);
    } else {
        echo json_encode(array('message' => 'Нет продуктов в базе данных'));
    }
}

// Обработка POST-запроса для создания нового продукта
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем, что входные данные в формате JSON
    $input_data = json_decode(file_get_contents("php://input"), true);
    
    if ($input_data) {
        // Извлекаем данные о продукте из JSON
        $name = $input_data['name'];
        $price = $input_data['price'];
        
        // Вставляем новый продукт в базу данных
        $sql = "INSERT INTO products (name, price) VALUES ('$name', $price)";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('message' => 'Продукт успешно добавлен'));
        } else {
            echo json_encode(array('message' => 'Ошибка при добавлении продукта: ' . $conn->error));
        }
    } else {
        echo json_encode(array('message' => 'Неверный формат данных'));
    }
}

// Обработка PUT-запроса для обновления продукта
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Проверяем, что входные данные в формате JSON
    $input_data = json_decode(file_get_contents("php://input"), true);
    
    if ($input_data) {
        // Извлекаем данные о продукте из JSON
        $id = $input_data['id'];
        $name = $input_data['name'];
        $price = $input_data['price'];
        
        // Обновляем продукт в базе данных
        $sql = "UPDATE products SET name='$name', price=$price WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('message' => 'Продукт успешно обновлен'));
        } else {
            echo json_encode(array('message' => 'Ошибка при обновлении продукта: ' . $conn->error));
        }
    } else {
        echo json_encode(array('message' => 'Неверный формат данных'));
    }
}

// Обработка DELETE-запроса для удаления продукта
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Получаем ID продукта из параметра запроса
    $id = $_GET['id'];
    
    // Удаляем продукт из базы данных
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Продукт успешно удален'));
    } else {
        echo json_encode(array('message' => 'Ошибка при удалении продукта: ' . $conn->error));
    }
}
$conn->close();
?>
