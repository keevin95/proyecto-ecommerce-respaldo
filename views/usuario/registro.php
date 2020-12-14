<?php require_once './helpers/utils.php'?>

<h1>Registro</h1>



<!--todo lo que no va a salir en pantalla se abre y se cierra con php"-->
<?php if (isset($_SESSION['register']) && ($_SESSION['register'] == 'complete')) : ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && ($_SESSION['register'] == 'failed')) : ?>
    <strong  class="alert_red">El registro no se ha podido completar, introduce bien los datos </strong>
<?php endif; ?>


<?php Utils::deleteSession('register'); ?>

<form action="<?= base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre"  />
    <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'nombre') : '' ?>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos"  />
    <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'apellidos') : '' ?>


    <label for="email">Email</label>
    <input type="email" name="email"  />
    <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'email') : '' ?>


    <label for="password">Password</label>
    <input type="password" name="password"  />
    <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'password') : '' ?>
  

    <input type="submit" value="Registrarse">
    <?php borrarErrores();?>



</form>