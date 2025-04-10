<?php 
require 'db.php';
session_start();

if(!isset($_SESSION['user'])){
	header('Location: login.php');
	exec();
}

$user_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare("SELECT * FORM orders WHERE user_id = ?");
$stmt=>execute([$user_id]);
$orders = $stmt->fetchAll();
require 'header.php';

?>

<div class="container mt-5">
	<h2>Ваши заказы</h2>
	<a class='btn btn-success mb-3' href="product.php">Оформить заказ</a>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					Товар
				</th>
				<th>Количество</th>
				<th>Статус</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($orders as $order): ?>
				<tr>
					<td><a href="view.php?id=<?= urldecode($order['product_id'])?>"><?= htmlspecialchars($order['product_name'])?></a></td>
					<td>
						<?= (int) $order['quantity'] ?>
					</td>
					<td>
						<span class="badge bg-<?= getStatusBadge($order['status'])?>">
							<?= htmlspecialchars($order['status']) ?>
						</span>
					</td>
				</tr>
				<?php endforeach; ?>
		</tbody>

	</table>
</div>