<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Libre</title>
    <link rel="stylesheet" href="<?= base_url ?>styles.css" />
</head>

<body>
    <div id="container">

        <!--Cabecera -->
        <header id="header">
            <div id="logo">
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta-logo">
                <a href="<?=base_url?>">
                    <h1>Tienda libre</h1>
                </a>
            </div>


        </header>


        <!--menu -->
        <?php $categorias = Utils::showCategorias() ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>">
                        INICIO
                    </a>
                </li>
                <?php while ($cat = $categorias->fetch_object()) : ?>
                    <li>
                    <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>">
                        <?=$cat->nombre?>
                    </a>
                    </li>
                <?php endwhile; ?>
            </ul>

        </nav>
        <div id="content">