
<?php
session_start();
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<header class="header">
  <div class="header__inner">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand header__brand" href="index.php">Авоська</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto header__nav">
            <?php if (isset($_SESSION['user'])): ?>
                <?php if (!empty($_SESSION['user']['is_admin'])): ?>
                    <li class="nav-item header__nav-item">
                      <a class="nav-link header__nav-link" href="admin.php">Админ-панель</a>
                    </li>
                    <li class="nav-item header__nav-item">
                      <a class="nav-link header__nav-link" href="orders.php">Мои заказы</a>
                    </li>
                    <li class="nav-item header__nav-item">
                      <a class="nav-link header__nav-link" href="product.php">Оформить заказ</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item header__nav-item">
                      <a class="nav-link header__nav-link" href="order.php">Мои заказы</a>
                    </li>
                    <li class="nav-item header__nav-item">
                      <a class="nav-link header__nav-link" href="product.php">Оформить заказ</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item header__nav-item">
                  <a class="nav-link header__nav-link text-danger" href="logout.php">Выход</a>
                </li>
            <?php else: ?>
                <li class="nav-item header__nav-item">
                  <a class="nav-link header__nav-link" href="login.php">Вход</a>
                </li>
                <li class="nav-item header__nav-item">
                  <a class="nav-link header__nav-link" href="register.php">Регистрация</a>
                </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
