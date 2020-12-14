<h1>Algunos de nuestros productos </h1>

<?php while ($product = $productos->fetch_object()) : ?>
    <div class="product">
        <a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
        <?php if ($product->imagen != null) : ?>
            <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="camiseta">
        <?php else : ?>
            <img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta">
        <?php endif; ?>
        <h2><?= $product->nombre ?></h2>
        <p>$<?= $product->precio ?></p>
        <a href="<?=base_url?>carrito/add&id=<?=$pro->id ?>" class="button">Comprar</a>
        </a>
    </div>
<?php endwhile; ?>
