<?php if (isset($_SESSION['register']) && $_SESSION['register']=='complete'): ?>
    <strong class="alert_green">Registro Completado</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register']=='failed'): ?>
    <strong class="alert_red"> Registro Fallido Introduce bien los campos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register')?>

    <h1>Registrarse</h1>

    <form action="<?=base_url?>index.php?controller=usuario&action=save" method="POST">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>

        <label for="correo">Correo</label>
        <input type="email" name="correo" required>

        <label for="password">Contrasena</label>
        <input type="password" name="password" required>

        <input type="submit" value="Registrarse">

    </form>
</div>