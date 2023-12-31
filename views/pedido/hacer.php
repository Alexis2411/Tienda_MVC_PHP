<?php if (isset($_SESSION['identity'])): ?>
    <h1>Hacer Pedido</h1>
    <p>
    <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>
    <br>
    <h3>Direccion de envios</h3>
    <form action="<?= base_url ?>pedido/add" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>
        <label for="ciudad">Ciudad</label>
        <input type="text" name="localidad" required>
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required>
        <input type="submit" value="Confrimar pedido">
    </form>
<?php else: ?>
    <h1>
        Debes loguearte para hacer un pedido.
    </h1>
    <p>
        No tienes cuenta?
    </p>
<?php endif; ?>