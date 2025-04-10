<?php 

require 'db.php';


// Проверяем авторизован ли пользователь
if (isset($_SESSION['user'])) {
  // Получаем данные пользователя из БД
  $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
  $stmt->execute([$_SESSION['user']['id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);


  // Сохраняем is_admin в сессии
  $_SESSION['user']['is_admin'] = $user['is_admin'];

}

//запрашиваем список товаров
$stmt = $pdo->prepare("SELECT * FROM product");
$product = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <title>Авоська</title>
</head>
<body>
  <?php include 'header.php'; ?>
  <section class="main">
    <div class="container">
      <div class="product">
        <?php require 'card.php'; ?>
      </div>

    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>