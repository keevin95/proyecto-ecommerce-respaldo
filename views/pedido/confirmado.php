<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'completo') : ?>
    <h1>Tu pedido ha sido confirmado</h1>
    <br>

    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido: </h3>

        Numero de pedido:<?= $pedido->id ?><br>
        Total a pagar: $ <?= $pedido->coste ?><br>
        Productos:
        <?php while ($producto = $productos->fetch_object()) : ?>
            <ul>
                <li>Cantidad:<?= $producto->unidades ?> <?= $producto->nombre ?><?= $producto->precio ?></li>
            </ul>
        <?php endwhile ?>

    <?php endif; ?>
    <br>
    <hr>
    <br>
    <a href="<?= base_url ?>">Volver a pagina de inicio</a>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'completo') : ?>
    <h1>Tu pedido no ha sido procesado</h1>
<?php endif; ?>