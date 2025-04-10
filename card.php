<div class="container mt-5">
    <h2 class="product__title mb-4 text-center text-uppercase fw-bold">Список товаров</h2>
    <div class="product_inner row row-cols-1 row-cols-md-4 g-3 ">
        <?php foreach ($product as $product): ?>
            <div class="product-card col">
                <a href="view.php?id=<?= $product['id'] ?>" class="card__link text-decoration-none text-dark">
                    <div class="card__inner card h-100 shadow-lg border-0 rounded-4 overflow-hidden position-relative ">
                        <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top img-fluid product-card__image" alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="product__content card-body d-flex flex-column p-4 bg-light ">
                            <h5 class="product__title card-title text-primary fw-bold text-truncate" title="<?= htmlspecialchars($product['name']) ?>">
                                <?= htmlspecialchars($product['name']) ?>
                            </h5>
                            <p class="product__description card-text text-muted text-truncate " title="<?= htmlspecialchars($product['description']) ?>">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>
                            <p class="product__price card-text fw-semibold text-dark ">
                                <i class="bi bi-currency-ruble"></i> <?= $product['price'] ?> ₽
                            </p>
                            <p class="product__stock card-text text-success fw-semibold ">
                                <?php if ($product['stock'] > 0): ?> В наличии<?php endif; ?>
                            </p>
                            <div class="product__footer mt-auto">
                                <?php if ($product['stock'] > 0): ?>
                                    <a href="order_form.php?product=<?= urlencode($product['name']) ?>" class="btn btn-gradient w-100 fw-bold text-uppercase py-2">Купить</a>
                                <?php else: ?>
                                    <button class="btn btn-secondary w-100 py-2 " disabled>Нет в наличии</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            </div>
        <?php endforeach; ?>
    </div>
</div>
