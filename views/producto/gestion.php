<h1>Gestion de Productos</h1>

<a href="<?= base_url ?>producto/create" class="button button_small">
    Crear Producto
</a>
<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">El producto fue creado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
    <strong class="alert_red">El producto no fue creado</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto');?>

<?php if (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] == 'complete'): ?>
    <strong class="alert_green">El producto fue eliminado correctamente</strong>
<?php elseif (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] != 'complete'): ?>
    <strong class="alert_red">El producto no fue eliminado</strong>
<?php endif; ?>
<?php Utils::deleteSession('eliminado');?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
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
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$producto->id?>" class="button button_gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$producto->id?>" class="button button_gestion button_red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>