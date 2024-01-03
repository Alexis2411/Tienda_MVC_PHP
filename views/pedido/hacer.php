<?php if (isset($_SESSION['identity'])):?>
    <h1>Hacer Pedido</h1>
    <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
<?php else: ?>
    <h1>
        Debes loguearte para hacer un pedido.
    </h1>
    <p>
        No tienes cuenta?
    </p>
<?php endif; ?>