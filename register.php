<?php 
include 'db.php';
include 'header.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
	$login = $_POST['login'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$fio = $_POST['fio'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$stmt = $pdo ->prepare("INSERT INTO users (login, password , fio, phone , email) VALUES (?,?,?,?,?)");
	if($stmt->execute([$login, $password, $fio, $phone, $email])){
		echo "<div class='alert alert-success'>Регистрация прошла успешно</div>";
	}else {
		echo "<div class='alert alert-danger'>Ошибка регистрации</div";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	<title>Регистрация</title>
</head>
<body>
	<div class="container">
		<form class="register__form mt-4" method="post">
			<input class="form-control mb-4" type="text" name="login"  placeholder="логин" required>
			<input class="form-control mb-4" type="password" name="password"  placeholder="пароль" required>
			<input class="form-control mb-4" type="text" name="fio"  placeholder="ФИО" required>
			<input class="form-control mb-4" type="text" name="email"  placeholder="email" required>
			<input class="form-control mb-4" type="number" name="phone"  placeholder="номер телефона" required>
			<button class="btn btn-primary" type="submit" >Зарегистрироваться</button>
		</form>
	</div>
</body>
</html>
