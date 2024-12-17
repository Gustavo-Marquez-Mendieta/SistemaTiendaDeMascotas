<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        #body {
            display: flex;
            margin-top: 20px;
        }

        .container {
            flex: 3;
            padding: 10px;
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

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 200px;
            min-height: 300px;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f0f0f0;
            ;
        }

        .card-body {
            padding: 10px;
            flex: 1;
        }

        .sidebar {
            flex: 1;
            padding: 10px;
            border-left: 1px solid #ddd;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
        }

        .btn-icon i {
            margin-left: 5px;
        }

        .banner {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 42px;
            background: transparent;
        }

        .logout-img {
            width: 30px;
            height: 25px;
        }

        ul.navigation {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-start;
        }

        ul.navigation li {
            margin: 0;
            padding: 0;
        }

        ul.navigation li a {
            text-decoration: none;
            text-align: center;
            color: #333;
            padding: 0px;
            display: inline-block;
        }

        ul.navigation li a:hover {
            background-color: #f0f0f0;
        }

        .discount {
            color: red;
            font-weight: bold;
        }

        .original-price {
            text-decoration: line-through;
            color: #888;
        }
    </style>
</head>

<body>
    <div id="header">
        <a href="<?= site_url('Welcome/index') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
                width="310" height="114" alt=""></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
            <li><a href="<?= site_url('Welcome/carrito') ?>">Carrito <i class="fas fa-shopping-cart"></i></a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Contacto</a></li>
        </ul>
    </div>

    <div class="banner" style="background-image: url('<?= base_url() ?>assets/images/fondoperros.png');"></div>
    <div id="body">
        <div class="container">
            <div class="products">
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $row): ?>
                        <?php
                        // Calcula el precio con descuento basado en el valor del atributo oferta
                        $precio = $row->precio;
                        $descuento = 0;
                        if ($row->oferta == 1) {
                            $descuento = 0.10; // 10%
                        } elseif ($row->oferta == 2) {
                            $descuento = 0.15; // 15%
                        } elseif ($row->oferta == 3) {
                            $descuento = 0.20; // 20%
                        }
                        $precioConDescuento = $precio - ($precio * $descuento);
                        ?>
                        <div class="card">
                            <a href="<?= site_url('Welcome/detallesperro/' . $row->producto_id); ?>"
                                title="Ver detalles de <?php echo $row->nombre; ?>">
                                <img class="card-img-top" src="<?php echo $row->imagen_url; ?>"
                                    alt="<?php echo $row->nombre; ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row->nombre; ?></h5>
                                <?php
                                $isEven = $row->producto_id % 2 == 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<span><i class="bi bi-star-fill" style="padding: 0px 2px; color:' . ($isEven ? '#ffb90c' : ($i <= 3 ? '#ffb90c' : '')) . ';"></i></span>';
                                }
                                ?>
                                <hr>
                                <?php if ($row->oferta > 0): ?>
                                    <p class="card-text">
                                        <span class="original-price">Bs. <?php echo number_format($row->precio, 2); ?></span> <br>
                                        <span class="discount">Bs. <?php echo number_format($precioConDescuento, 2); ?>
                                            (<?php echo $descuento * 100; ?>% OFF)</span>
                                    </p>
                                    <p class="card-text">Stock: <?php echo $row->stock; ?> unidades</p>
                                <?php else: ?>
                                    <p class="card-text">Bs. <?php echo number_format($row->precio, 2); ?></p>
                                    <p class="card-text">Stock: <?php echo $row->stock; ?> unidades</p>
                                <?php endif; ?>
                                <?php if ($row->stock > 0): ?>
                                    <a href="javascript:void(0);" onclick="agregarAlCarrito(<?php echo $row->producto_id; ?>)"
                                        class="btn btn-primary">Agregar al carrito</a>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>Agotado</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No se encontraron productos.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="sidebar">
            <div class="section">
                <div class="aside">
                    <ul>
                        <li><a href="<?= site_url('Welcome/Bolsas_Dispensadores_Perros') ?>">Bolsas de Heces y
                                Dispensadores</a>
                        </li>
                        <li><a href="<?= site_url('Welcome/Cuidado_Dental_Perros') ?>">Cuidado Dental</a></li>
                        <li><a href="<?= site_url('Welcome/Limpieza_Perros') ?>">Limpieza de Hogar</a>
                        </li>
                        <li><a href="<?= site_url('Welcome/Peines_Cepillos_Perros') ?>">Peines Cepillos y Cortadoras</a>
                        </li>
                        <li><a href="<?= site_url('Welcome/Shampoo_Perros') ?>">Shampoo y Aseo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="carritoModal" tabindex="-1" role="dialog" aria-labelledby="carritoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carritoModalLabel">Producto Agregado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    El producto ha sido agregado a tu carrito.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="<?= site_url('Welcome/carrito') ?>" class="btn btn-primary">Ir al Carrito</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function agregarAlCarrito(producto_id) {
            $.ajax({
                url: '<?= site_url('Welcome/agregar_al_carrito') ?>',
                method: 'POST',
                data: { producto_id: producto_id },
                success: function (response) {
                    $('#carritoModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error('Error al agregar al carrito:', status, error);
                }
            });
        }
    </script>
</body>

</html>