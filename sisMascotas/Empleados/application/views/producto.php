<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">

    <style>
        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info .user-name {
            margin-left: 5px;
            /* Reduce el margen entre el nombre de usuario y el ícono */
        }

        .user-info img {
            margin-left: 5px;
            /* Reduce el margen entre la imagen y el nombre */
            width: 30px;
            /* Ajusta el tamaño de la imagen si es necesario */
            height: 30px;
            /* Ajusta el tamaño de la imagen si es necesario */
        }

        .navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            list-style: none;
        }

        .navigation li {
            margin: 0 5px;
            /* Reducido para acercar los elementos */
            /* Reduce el margen entre los elementos de navegación */
        }

        .logout-img {
            width: 30px;
            /* Ajusta el tamaño de la imagen de cierre de sesión */
            height: 25px;
            /* Ajusta el tamaño de la imagen de cierre de sesión */
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-info .user-name {
            margin-left: 10px;
        }

        .user-info img {
            margin-left: 10px;
            width: 40px;
            height: 40px;
        }

        .featured ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .featured li {
            text-align: center;
            width: 400px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .featured img {
            max-width: 100%;
            height: auto;
        }

        .navigation {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            list-style: none;
        }

        .navigation li {
            margin: 0 5px;
            /* Reducido para acercar los elementos */
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .logout-img {
            width: 30px;
            height: 25px;
        }
    </style>
</head>

<body>
    <div id="header">
        <a href="<?= site_url('Welcome/empleado') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
                alt="Logo"></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Productos</a></li>
            <li><a href="<?= site_url('Welcome/ver_pedidos') ?>">Pedidos</a></li>
            <li><a href="<?= site_url('Welcome/carrito') ?>">Carrito</a></li>
            <?php if (isset($nombre)): ?>
                <li class="user-info">
                    <span class="user-name">Empleado <?= $nombre; ?></span>
                    <img src="<?= base_url() ?>assets/images/empleado.png" alt="User Icon">
                </li>
            <?php endif; ?>
            <li><a href="<?= site_url('Welcome/miCuenta') ?>">Mi cuenta</a></li>
            <li>
                <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Cerrar Sesión" class="btn-exit-system">
                    <img src="<?= base_url() ?>assets/images/apagar.png" alt="Cerrar sesión" class="logout-img">
                </a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="featured">
            <h1 style="text-align: center;">Seleccione su Mascota</h1>
            <ul>
                <li><a href="<?= site_url('Welcome/TiendaGatos') ?>"><img
                            src="<?= base_url() ?>assets/images/TiendaGatos.png" alt="Tienda Gatos"></a></li>
                <li><a href="<?= site_url('Welcome/TiendaPerros') ?>"><img
                            src="<?= base_url() ?>assets/images/TiendaPerros.png" alt="Tienda Perros"></a></li>
            </ul>
            <h1 style="text-align: center;">Explora nuestras ofertas</h1>
            <ul>
                <li><a href="<?= site_url('Welcome/ofertas') ?>"><img src="<?= base_url() ?>assets/images/ofertas.png"
                            alt="Ofertas"></a></li>
            </ul>
        </div>
    </div>
</body>

</html>