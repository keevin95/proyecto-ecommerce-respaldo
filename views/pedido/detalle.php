<h1>Detalle del pedido</h1>

<?php if (isset($pedido)) : ?>
    <?php if(isset($_SESSION['admin'])) :?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="POST">
            <input type="hidden" value="<?= $pedido->id?>" name="pedido_id">
            <select name="estado">
                <option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '' ?> >Pendiente</option>
                <option value="preparation"<?=$pedido->estado == "preparation" ? 'selected' : '' ?>>En preparacion</option>
                <option value="ready"<?=$pedido->estado == "ready" ? 'selected' : '' ?>>Listo para enviar</option>
                <option value="sended"<?=$pedido->estado == "sended" ? 'selected' : '' ?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
    <?php endif; ?>
    <br>
    <h3>Direccion de envio</h3>
    Provincia:<?= $pedido->provincia ?><br>
    Ciudad:<?= $pedido->localidad ?><br>
    Direccion:<?= $pedido->direccion ?>

    <hr>
    <h3>Datos del pedido: </h3>
    
    Estado <?=Utils::showStatus($pedido->estado)?><br>
    Numero de pedido:<?= $pedido->id ?><br>
    Total a pagar: $ <?= $pedido->coste ?><br>
    Productos:
    <?php while ($producto = $productos->fetch_object()) : ?>
        <ul>
            <li>Cantidad:<?= $producto->unidades ?> <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?= $producto->nombre ?></a><?= $producto->precio ?></li>
        </ul>
    <?php endwhile ?>

<?php endif; ?>