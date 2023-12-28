<?php if (isset($datos)): ?>
    <h1>
        <?= $datos->nombre ?>
    </h1>
    <div id="detail-product">
        <div class="image">
            <?php if ($datos->imagen != null): ?>
                <img src="<?= base_url ?>uploads/images/<?= $datos->imagen ?>" alt="">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Sin imágen">
            <?php endif; ?>
        </div>
        <div class="data">
            <p class="description">
                <?= $datos->descripcion ?>
            </p>
            <p class="price">$
                <?= $datos->precio ?> USD
            </p>
            <a href="" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>