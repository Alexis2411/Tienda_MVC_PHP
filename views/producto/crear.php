<?php if (isset($editar) && isset($datos) && is_object($datos)): ?>
    <h1>Editar Producto <?=$datos->descripcion?></h1>
    <?php $url_action = base_url . "producto/save&id=".$datos->id?>
<?php else: ?>
    <h1>Crear Nuevos Productos</h1>
    <?php $url_action = base_url . "producto/save" ?>
<?php endif;?>

<div class="form_container">
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($datos) && is_object($datos)?$datos->nombre:""?>" required>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" ><?=isset($datos) && is_object($datos)?$datos->descripcion:""?></textarea>

        <label for="precio">Precio</label>
        <input type="number" name="precio" value="<?=isset($datos) && is_object($datos)?$datos->precio:""?>" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?=isset($datos) && is_object($datos)?$datos->stock:""?>" required>

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::showCategorias() ?>
        <select name="categoria">
    <?php while ($categoria = $categorias->fetch_object()): ?>
        <option value="<?= $categoria->id ?>"<?=isset($datos) && is_object($datos) && $categoria->id == $datos->categoria_id ? ' selected' : '' ?>>
            <?= $categoria->nombre ?>
        </option>
    <?php endwhile; ?>
</select>


        <label for="imagen">Imagen</label>
        <?php if(isset($datos) && is_object($datos) && !empty($datos->imagen)):?>
            <img src="<?=base_url?>uploads/images/<?=$datos->imagen?>" alt="" class="thumb">
        <?php endif?>
        <input type="file" name="imagen">


        <input type="submit" value="Guardar">

    </form>
</div>
</div>