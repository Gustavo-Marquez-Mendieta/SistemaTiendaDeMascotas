<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto - Pet Shop</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
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

        .banner {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 30px;

            background: transparent;
        }

        .product-details {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 40px;
            margin-left: 200px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            max-width: 1000px;
        }

        .product-images {
            width: 40%;
            text-align: center;
        }

        .product-images img.main-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .thumbnail-images {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .thumbnail-images img {
            width: 60px;
            cursor: pointer;
            border-radius: 5px;
        }

        .product-info {
            width: 60%;
            padding-left: 20px;
        }

        .product-info h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .product-info p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #555;
        }

        .product-price {
            font-size: 1.5rem;
            color: red;
            margin-bottom: 20px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .quantity-selector .btn {
            width: 30px;
            height: 30px;
            line-height: 1;
            text-align: center;
            padding: 0;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
        }

        .add-to-cart {
            display: block;
            width: 100%;
            background-color: #3b8bff;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Descripción del producto */
        .product-description-box {
            margin-top: 30px;
        }

        .product-description-box h4 {
            font-size: 1.25rem;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: #333;
        }

        /* Modal */
        .modal-dialog {
            max-width: 500px;
        }

        .modal-body {
            font-size: 18px;
        }

        .modal-footer .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Otros estilos */
        .discount {
            color: red;
            font-weight: bold;
        }

        .original-price {
            text-decoration: line-through;
            color: #888;
        }

        .logout-img {
            width: 30px;
            height: 25px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .quantity-input {
            width: 80px;
            text-align: center;
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
            <li>
                <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Cerrar Sesión" class="btn-exit-system">
                    <img src="<?= base_url() ?>assets/images/apagar.png" alt="Cerrar sesión" class="logout-img">
                </a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="product-details">
            <?php if (!empty($producto)): ?>
                <div class="product-images">
                    <img src="<?= $producto['imagen_url']; ?>" alt="<?= $producto['nombre']; ?>" class="main-image">
                </div>
                <div class="product-info">
                    <h2><?= $producto['nombre']; ?></h2>
                    <p class="product-price">
                        <?php
                        // Calcular el precio con descuento basado en el valor del atributo oferta
                        $precio = $producto['precio'];
                        $descuento = 0;
                        if ($producto['oferta'] == 1) {
                            $descuento = 0.10; // 10%
                        } elseif ($producto['oferta'] == 2) {
                            $descuento = 0.15; // 15%
                        } elseif ($producto['oferta'] == 3) {
                            $descuento = 0.20; // 20%
                        }
                        $precioConDescuento = $precio - ($precio * $descuento);
                        ?>

                        <?php if ($producto['oferta'] > 0): ?>
                            <span class="original-price">Bs. <?= number_format($producto['precio'], 2); ?></span> <br>
                            <span class="discount-price">Bs. <?= number_format($precioConDescuento, 2); ?>
                                (<?= $descuento * 100; ?>% OFF)</span>
                        <?php else: ?>
                            Bs. <?= number_format($producto['precio'], 2); ?>
                        <?php endif; ?>
                    </p>
                    <p><strong>Categoría:</strong> <?= $producto['categoria']; ?></p>
                    <p><strong>Stock disponible:</strong> <?= $producto['stock']; ?></p>
                    <p><strong>Descripción:</strong> <?= $producto['descripcion']; ?></p>

                    <div class="quantity-selector">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                        <input type="number" id="cantidad" value="1" min="1" max="<?= $producto['stock']; ?>"
                            class="form-control quantity-input">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                    </div>

                    <button type="button" class="add-to-cart"
                        onclick="agregarAlCarrito(<?= $producto['producto_id']; ?>)">Añadir al carrito</button>
                    <a href="<?= site_url('Welcome/TiendaPerros') ?>" class="back-to-shop">Volver a la tienda</a>

                    <div class="product-description-box">
                        <h4>Detalles adicionales</h4>
                        <p>Aquí puedes añadir información extra o reseñas del producto.</p>
                    </div>
                </div>
            <?php else: ?>
                <p>No se encontraron detalles del producto.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal de Confirmación -->
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
                    El producto ha sido agregado al carrito.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <a href="<?= site_url('Welcome/carrito') ?>" class="btn btn-primary">Ver Carrito</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function agregarAlCarrito(producto_id) {
            var cantidad = document.getElementById('cantidad').value;

            $.ajax({
                url: '<?= site_url('Welcome/agregar_al_carrito') ?>',
                method: 'POST',
                data: {
                    producto_id: producto_id,
                    cantidad: cantidad
                },
                success: function (response) {
                    // Mostrar el modal si la respuesta es positiva
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