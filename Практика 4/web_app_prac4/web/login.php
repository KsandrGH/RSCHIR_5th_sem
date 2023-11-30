<?php
// Ваши настройки подключения к базе данных
$servername = "db";
$username = "root";
$password = "example";
$dbname = "mydb";

// Обработка POST-запроса при отправке формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Проверка данных пользователя (здесь вы можете сравнивать с данными в базе данных)
    if ($username === "admin" && $password === "adminpass") {
        // Вход для админа
        session_start();
        $_SESSION["username"] = $username;
        header("Location: admin.html"); // Перенаправление на админскую панель
        exit();
    } elseif ($username === "user" && $password === "userpass") {
        // Вход для пользователя
        session_start();
        $_SESSION["username"] = $username;
        header("Location: index.php"); // Перенаправление на пользовательскую панель
        exit();
    } else {
        // Неверные учетные данные, выведите сообщение об ошибке
        echo "Неверное имя пользователя или пароль.";
    }
}
?>
