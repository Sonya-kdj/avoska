<?php
require 'db.php';

session_start();

if(!isset($_SESSION['user'])){
	header('Location: login.php');
	exit();
}

// pапрашиваем список товаров

$stmt = $pdo->query("SELECT * FROM product");

$product = $stmt->fetchAll(PDO::FETCH_ASSOC);


require 'header.php';
require 'card.php';
?>