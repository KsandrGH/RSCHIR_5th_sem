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

// Обработка GET-запроса для получения списка заказов
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $order_id = $_GET['id'];
        $sql = "SELECT * FROM orders WHERE id = $order_id";
    } else {
        $sql = "SELECT * FROM orders";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $orders = array();
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($orders);
    } else {
        echo json_encode(array('message' => 'No orders in database'));
    }
}

// Обработка POST-запроса для создания нового заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем, что входные данные в формате JSON
    $input_data = json_decode(file_get_contents("php://input"), true);
    
    if ($input_data) {
        // Извлекаем данные о заказе из JSON
        $customer_name = $input_data['customer_name'];
        $total_price = $input_data['total_price'];
        
        // Вставляем новый заказ в базу данных
        $sql = "INSERT INTO orders (customer_name, total_price) VALUES ('$customer_name', $total_price)";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('message' => 'Заказ успешно добавлен'));
        } else {
            echo json_encode(array('message' => 'Ошибка при добавлении заказа: ' . $conn->error));
        }
    } else {
        echo json_encode(array('message' => 'Неверный формат данных'));
    }
}

// Обработка PUT-запроса для обновления заказа
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Проверяем, что входные данные в формате JSON
    $input_data = json_decode(file_get_contents("php://input"), true);
    
    if ($input_data) {
        // Извлекаем данные о заказе из JSON
        $id = $input_data['id'];
        $customer_name = $input_data['customer_name'];
        $total_price = $input_data['total_price'];
        
        // Обновляем заказ в базе данных
        $sql = "UPDATE orders SET customer_name='$customer_name', total_price=$total_price WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('message' => 'Заказ успешно обновлен'));
        } else {
            echo json_encode(array('message' => 'Ошибка при обновлении заказа: ' . $conn->error));
        }
    } else {
        echo json_encode(array('message' => 'Неверный формат данных'));
    }
}

// Обработка DELETE-запроса для удаления заказа
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Получаем ID заказа из параметра запроса
    $id = $_GET['id'];
    
    // Удаляем заказ из базы данных
    $sql = "DELETE FROM orders WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Заказ успешно удален'));
    } else {
        echo json_encode(array('message' => 'Ошибка при удалении заказа: ' . $conn->error));
    }
}

// ...

$conn->close();
?>
