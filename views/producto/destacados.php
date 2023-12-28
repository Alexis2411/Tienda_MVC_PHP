<!--Contenido general-->
<h1>Productos Destacados</h1>
<?php while ($product = $productos->fetch_object()): ?>
    <div class="product">
        <a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
            <?php if ($product->imagen != null): ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Sin imágen">
            <?php endif; ?>
            <h2>
                <?= $product->nombre ?>
            </h2>
            <p>$30 USD</p>
        </a>
        <a href="" class="button">Comprar</a>
    </div>
<?php endwhile; ?>
</div>