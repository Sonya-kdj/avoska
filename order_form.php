<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
	exit();
}

// проверяем, передан ли id товара 
$product_id = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;

if (!$product_id){
	die("Ошибка: некорректный id товара");
}

// получаем данные о товаре по id 
$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product){
	die("Ошибка: товар не найден");
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$quantity = (int) $_POST['quantity'];
	$address = trim($_POST['address']);
	$user_id = $_SESSION['user']['id'];

	// проверяем есть ли нужное количество товара в наличии 
	if ($quantity > $product['stock']) {
		$error = "Ошибка: недостаточно товара в наличии";
	} else {
		// оформляем заказ 
		$stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, product_name, quantity, address, status) VALUES (?, ?, ?, ?, ?, 'новый')");
		$stmt->execute([$user_id, $product['id'], $product['name'], $quantity, $address]);

		// обновляем количество на складе 
		$stmt = $pdo->prepare("UPDATE product SET stock = stock - ? WHERE id = ?");
		$stmt->execute([$quantity, $product['id']]);

		header('Location: order.php');
		exit();	
	}
}

require 'header.php';
?>

<div class="container mt-5">
	<h2 class="mb-4">Оформление заказа</h2>

	<?php if (isset($error)): ?>
		<div class="alert alert-danger" role="alert">
			<?= htmlspecialchars($error) ?>
		</div>
	<?php endif; ?>

	<div class="order__inner row">
		<div class="card__inner col-md-4 mb-4">
			<div class="card__body">
				<img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
				<div class="card__text">
					<h5 class="card__title">
						<?= htmlspecialchars($product['name']) ?>
					</h5>
					<p class="card__desc">
						<?= htmlspecialchars($product['description']) ?>
					</p>
					<p class="card__price">
						<?= htmlspecialchars($product['price']) ?> рублей
					</p>
				</div>
			</div>
		</div>

		<div class="order-form__inner col-md-6">
			<form method="POST">
				<div class="mb-3">
					<label class="form-label">Количество (доступно: <?= $product['stock'] ?>):</label>
					<input type="number" class="form-control" name="quantity" min="1" max="<?= $product['stock'] ?>" required>
				</div>

				<div class="mb-3">
					<label class="form-label">Адрес доставки</label>
					<input type="text" class="form-control" name="address" required>
				</div>

				<button class="btn btn-success w-100" type="submit">Подтвердить заказ</button>
			</form>
		</div>
	</div>
</div>
