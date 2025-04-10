<?php
include 'db.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

  
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        
        echo '<p class="alert alert-danger">неверный логин или пароль</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>авторизация</title>
</head>
<body>
    <div class="container">
        <form class="mt-4" method="post">
            <input class="form-control mb-4" type="text" name="login" placeholder="логин" required>
            <input class="form-control mb-4" type="text" name="password" placeholder="пароль" required>
            <button class="btn btn-primary" type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
