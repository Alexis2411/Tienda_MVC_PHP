
<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido']=='confirmado'):?>
<h1>
    Tu pedido se ha confirmado
</h1>

<p>
    Tu pedido ha sido guardado con exito una vez que realices la transferencia bancaria.
</p>
<br>
<?php if(isset($pedido)):?>
<h3>
    Datos del pedido
</h3>


    Numero de pedido:<?=$pedido->id?>
    <br>
    Total a pagar:<?=$pedido->coste?>
        <br>
    Productos:

        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
             <?php foreach ($pedido_productos as $producto):?>
                <tr>
                    <td>
                        <?php if ($producto['imagen'] != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto['imagen'] ?>" alt="" class="img_carrito">
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" alt="Sin imágen" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id=<?=$producto['id']?>"> <?= $producto['nombre'] ?>
                        </a>
                    </td>
                    <td>
                        <?= $producto['precio'] ?>
                    </td>
                    <td>
                        <?= $producto['unidades'] ?>
                    </td>
                </tr>

             <?php endforeach;?>
        </table>


<?php endif;?>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido']!='confirm') :?>
<p>
    No ha podido procesarse
</p>
<?php endif;?>
