<h1>Gestionar Categoria</h1>
<a href="<?= base_url?>categoria/create" class="button button_small">
    Crear Categoria
</a>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>

    <?php while ($cat = $categorias->fetch_object()): ?>
        <tr>
            <td>
                <?= $cat->id ?>
            </td>
            <td>
                <?= $cat->nombre ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>