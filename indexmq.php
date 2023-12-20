<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camisetas</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container">
        <!--Cabecera-->
        <header id="header">
            <div id="logo">
                <img src="assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">Tienda de camisetas</a>
            </div>
        </header>
        <!--Menu-->
        <nav id="menu">
            <ul>
                <li>
                    <a href="">Inicio</a>
                </li>
                <li>
                    <a href="">Categoria</a>
                </li>
                <li>
                    <a href="">Categoria</a>
                </li>
                <li>
                    <a href="">Categoria</a>
                </li>
                <li>
                    <a href="">Categoria</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <!--Barra lateral-->
            <aside id="lateral">
                <div id="login" class="block_aside">
                    <h3>Entrar a la Web</h3>
                    <form action="" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                        <label for="password">Contrasena</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <ul>
                        <li>
                            <a href="">Mis pedidos</a>
                        </li>
                        <li>
                            <a href="">Gestionar pedidos</a>
                        </li>
                        <li>
                            <a href="">Gestionar categorias</a>

                        </li>
                    </ul>
                </div>
            </aside>
            <!--Contenido general-->
            <div id="central">
                <h1>Productos Destacados</h1>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="">
                    <h2>Camiseta Azul Olgada</h2>
                    <p>$30 USD</p>
                    <a href="" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="">
                    <h2>Camiseta Azul Olgada</h2>
                    <p>$30 USD</p>
                    <a href class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="">
                    <h2>Camiseta Azul Olgada</h2>
                    <p>$30 USD</p>
                    <a href="" class="button">Comprar</a>
                </div>
            </div>
        </div>

        <!--Pie de pagina-->
        <footer id="footer">
            <p>Dessarrollado por Alexis Roman &copy;
                <?= date('Y') ?>
            </p>
        </footer>
    </div>
</body>

</html>