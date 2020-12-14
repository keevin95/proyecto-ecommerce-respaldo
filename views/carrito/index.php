<h1>Carrito de compras</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Borrar</th>
        </tr>
        <?php
        foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
            <tr>
                <td>
                    <?php if ($producto->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="camiseta" class="img_carrito">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/camiseta.png" alt="camiseta" class="img_carrito" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"> <?= $producto->nombre ?> </a>
                </td>
                <td> <?= $producto->precio ?> </td>
                <!--Las unidades no puedo sacarlas asi =>$producto->unidades 
                porque unidades no es un objeto
                sino que es un array -->

                <td>

                    <?= $elemento['unidades'] ?>
                    <div class="updown-unidades">
                        <a class="button" href="<?= base_url ?>carrito/up&index=<?= $indice ?>">+</a>
                        <a class="button" href="<?= base_url ?>carrito/down&index=<?= $indice ?>">-</a>
                    </div>
                </td>
                <td><a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>" class="button button-pedido button-black button-delete">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <br>
    <div id="delete-carrito">
        <a href="<?= base_url ?>carrito/delete_all" class="button button-pedido button-black button-delete">Vaciar Carrito</a>
    </div>
    <div class="total_carrito">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3>Precio total: <?= $stats['total']; ?> </h3>

        <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">Confirmar pedido</a>
    </div>
<?php else : ?>
    <p>El carrito esta vacio, agrega un producto</p>

<?php endif; ?>