<!--Barra lateral-->
<aside id="lateral">
    <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <?php $valor=Utils::stateCarrito();?>
            <li><a href="<?=base_url?>carrito/index">Productos(<?=$valor['count']?>)</li>
            <li><a href="<?=base_url?>carrito/index">Total( $ <?=$valor['total']?>)</li>
            <li><a href="<?=base_url?>carrito/index">Ver carrito</li>
        </ul>
    </div>
    <div id="login" class="block_aside">
        <?php if (!isset($_SESSION['identity'])): ?>
            <h3>Entrar a la Web</h3>
            <form action="<?= base_url ?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="password">Contrasena</label>
                <input type="password" name="password">
                <input type="submit" value="Enviar">
            </form>
        <?php else: ?>
            <h3>
                <?= $_SESSION['identity']->nombre . ' ' . $_SESSION['identity']->apellidos ?>
            </h3>
        <?php endif; ?>
        <?php if (isset($_SESSION['identity'])): ?>
        <ul>
            <?php if (isset($_SESSION['admin'])): ?>
                <li>
                    <a href="<?=base_url?>categoria/index">Gestionar Categorias</a>
                </li>
                <li>
                    <a href="<?=base_url?>producto/gestion">Gestionar Productos</a>
                </li>
                <li>
                    <a href="">Gestionar Pedidos</a>
                </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['identity'])): ?>
                <li>
                    <a href="">Mis pedidos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>usuario/logout">Cerrar Sesión</a>
                </li>
                <?php endif; ?>
            <?php else:?>           
                <li>
                    <a href="<?= base_url ?>usuario/registro">Registrarse</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<div id="central">