<?php if (isset($pro)) : ?>
    <h1><?= $pro->nombre ?></h1>
    <div id='detail-product'>
        <div class='image'>
            <?php if ($pro->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="camiseta">
            <?php else : ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="camiseta">
            <?php endif; ?>
        </div>
        <div class='data'>
            <h2 class="description"><?= $pro->descripcion ?></h2>
            <p class="price">$<?= $pro->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id ?>" class="button">Comprar</a>
            </a>
        </div>
    </div>

<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>