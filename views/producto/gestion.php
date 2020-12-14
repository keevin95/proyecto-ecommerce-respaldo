<h1>Gestion de productos</h1>

<a href="<?= base_url ?>producto/crear" class="button button-small">
    Crear Producto
</a>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha cargado exitosamente</strong>

<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>
    <strong class="alert_red">El producto no se ha cargado. Intentelo nuevamente</strong>
<?php endif; ?>

<?php Utils::deleteSession('producto'); ?>
<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha borrado exitosamente</strong>

<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <strong class="alert_red">El producto no se ha borrado. Intentelo nuevamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
<table>
    <!--Encabezado de tablas-->
    <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>
    <?php while ($pro = $productos->fetch_object()) : ?>
        <tr>
            <td><?= $pro->id; ?></td>
            <td><?= $pro->nombre; ?></td>
            <td><?= $pro->precio; ?></td>
            <td><?= $pro->stock; ?></td>
            <td>
                <!--Se usa el & para pasar el parametro porque ya hay parametros get -->
                <a href="<?= base_url ?>producto/editar&id=<?= $pro->id; ?>" class='button button-gestion'>Editar</a>
                <a href="<?= base_url ?>producto/eliminar&id=<?= $pro->id; ?>" class='button button-gestion button-black'>Eliminar</a>

            </td>

        </tr>
    <?php endwhile; ?>
</table>