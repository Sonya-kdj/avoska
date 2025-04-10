<?php
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = 'root';
	$db_db = 'market';

	try {
		$pdo = new PDO("mysql:host=$db_host;dbname=$db_db;charset=utf8", $db_user, $db_password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e) {
		echo "Ошибка подключения к бд " . $e->getMessage();
	}

?>