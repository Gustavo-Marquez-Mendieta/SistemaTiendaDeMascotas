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
        .banner {
            width: 100%;
            height: 160px;
            background-size: contain;
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

        .add-to-cart:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

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
    </style>
</head>

<body>
    <div id="header">
        <a href="<?= site_url('Welcome/index') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
                width="310" height="114" alt="Pet Shop Logo"></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Tienda</a></li>
            <li><a href="<?= site_url('Welcome/carrito') ?>">Carrito <i class="fas fa-shopping-cart"></i></a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Acerca de</a></li>
            <li><a href="<?= site_url('Welcome/contacto') ?>">Contacto</a></li>
        </ul>
    </div>

    <a href="<?= site_url('Welcome/TiendaGatos') ?>" class="banner-link" title="Volver a la Tienda de Gatos">
        <div class="banner" style="background-image: url('<?= base_url() ?>assets/images/fondogatos.png');"></div>
    </a>
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

                    <!-- Deshabilitar el botón si el stock es 0 -->
                    <button type="button" class="add-to-cart" onclick="agregarAlCarrito(<?= $producto['producto_id']; ?>)"
                        <?= $producto['stock'] == 0 ? 'disabled' : ''; ?>>
                        <?= $producto['stock'] == 0 ? 'Sin stock' : 'Añadir al carrito'; ?>
                    </button>

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