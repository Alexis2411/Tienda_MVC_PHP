<h1>Gestion de Productos</h1>

<a href="<?= base_url?>producto/create" class="button button_small">
    Crear Producto
</a>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>

    <?php while ($producto = $productos->fetch_object()): ?>
        <tr>
            <td>
                <?= $producto->id; ?>
            </td>
            <td>
                <?= $producto->nombre; ?>
            </td>
            <td>
                <?= $producto->precio; ?>
            </td>
            <td>
                <?= $producto->stock; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>