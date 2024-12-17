<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link href="<?php echo base_url(); ?>assets/css/tabla.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #body {
            display: flex;
            margin-top: 20px;
        }

        .container {
            flex: 3;
            padding: 10px;
            margin-top: 50px;
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

        /* Estilos para los diálogos */
        #ciDialog,
        #clienteDialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #ciDialog label,
        #clienteDialog label {
            display: block;
            margin-bottom: 10px;
        }

        #ciDialog input,
        #clienteDialog input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #ciDialog button,
        #clienteDialog button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
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
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="titulo">Productos a adquirir</h1>
                    <table class="table carrito-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Mascota</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productos)): ?>
                                <?php
                                $total = 0;
                                foreach ($productos as $producto):
                                    $precioTotal = $producto['precio_con_descuento'] * $producto['cantidad'];
                                    $total += $precioTotal;
                                    ?>
                                    <tr>
                                        <td><?php echo $producto['nombre']; ?></td>
                                        <td><?php echo $producto['tipo']; ?></td>
                                        <td><?php echo $producto['mascota']; ?></td>
                                        <td>Bs. <?php echo number_format($producto['precio_con_descuento'], 2); ?></td>
                                        <td><?php echo $producto['cantidad']; ?></td>
                                        <td>Bs. <?php echo number_format($precioTotal, 2); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('Welcome/eliminar_del_carrito/' . $producto['producto_id']); ?>"
                                                class="btn btn-danger">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">El carrito está vacío.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4" id="pagar">
                    <h1 style="text-align: center;">Total del Carrito</h1>
                    <table class="table">
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total a Pagar:</strong></td>
                            <td><strong>Bs. <?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </table>
                    <a href="javascript:void(0);" onclick="finalizarCompra()" class="button">
                        <svg class="cartIcon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6H21L20 12H8L6 6Z" />
                        </svg>
                        Finalizar Pedido
                    </a>
                </div>
            </div>
        </div>

        <a href="<?php echo site_url('Welcome/vaciar_carrito'); ?>" class="btn btn-danger btn-vaciar"
            style="color: white;">Vaciar Carrito</a>
    </div>

    <!-- Diálogo para ingresar CI -->
    <div id="ciDialog">
        <form id="ciForm">
            <label for="ci">Ingrese su CI:</label>
            <input type="text" id="ci" name="ci" required>
            <button type="button" onclick="submitCi()">Confirmar</button>
        </form>
    </div>

    <!-- Diálogo para ingresar datos del cliente -->
    <div id="clienteDialog">
        <form id="clienteForm">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="primerApellido">Primer Apellido:</label>
            <input type="text" id="primerApellido" name="primerApellido" required>
            <label for="segundoApellido">Segundo Apellido:</label>
            <input type="text" id="segundoApellido" name="segundoApellido">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular">
            <button type="button" onclick="submitCliente()">Confirmar Pedido</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Verificar mensajes flash
            <?php if ($this->session->flashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?php echo $this->session->flashdata('success'); ?>',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>

            // Agregar eventos para los botones de eliminar
            document.querySelectorAll('.btn-danger').forEach(button => {
                if (!button.classList.contains('btn-vaciar')) {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        confirmarEliminacion(url);
                    });
                }
            });

            // Evento para el botón de vaciar carrito
            document.querySelector('.btn-vaciar')?.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                confirmarVaciarCarrito(url);
            });
        });

        // Función para confirmar eliminación de un producto
        function confirmarEliminacion(url) {
            Swal.fire({
                title: '¿Eliminar producto?',
                text: "¿Estás seguro de que deseas eliminar este producto del carrito?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        // Función para confirmar vaciar carrito
        function confirmarVaciarCarrito(url) {
            Swal.fire({
                title: '¿Vaciar carrito?',
                text: "¿Estás seguro de que deseas vaciar todo el carrito?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, vaciar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        function finalizarCompra() {
            <?php if (empty($productos)): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Carrito vacío',
                    text: 'No hay productos en el carrito para realizar el pedido.',
                    confirmButtonText: 'OK'
                });
                return;
            <?php endif; ?>

            // Reemplazar el diálogo normal por SweetAlert2
            Swal.fire({
                title: 'Ingrese su CI',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (ci) => {
                    if (!ci) {
                        Swal.showValidationMessage('Por favor ingrese un CI');
                        return false;
                    }
                    return fetch("<?php echo site_url('Welcome/buscar_cliente'); ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify({ ci })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                return { ...data.cliente, ci };
                            }
                            return { ci };
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Error: ${error}`);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    mostrarFormularioCliente(result.value);
                }
            });
        }

        function mostrarFormularioCliente(clienteData) {
            Swal.fire({
                title: 'Datos del Cliente',
                html: `
                <input type="hidden" id="swal-ci" value="${clienteData.ci || ''}">
                <input type="text" id="swal-nombre" class="swal2-input" placeholder="Nombre" value="${clienteData.nombre || ''}" required>
                <input type="text" id="swal-primerApellido" class="swal2-input" placeholder="Primer Apellido" value="${clienteData.primerApellido || ''}" required>
                <input type="text" id="swal-segundoApellido" class="swal2-input" placeholder="Segundo Apellido" value="${clienteData.segundoApellido || ''}">
                <input type="text" id="swal-celular" class="swal2-input" placeholder="Celular" value="${clienteData.celular || ''}">
            `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Confirmar Pedido',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const nombre = document.getElementById('swal-nombre').value;
                    const primerApellido = document.getElementById('swal-primerApellido').value;

                    if (!nombre || !primerApellido) {
                        Swal.showValidationMessage('Nombre y Primer Apellido son obligatorios');
                        return false;
                    }

                    return {
                        ci: document.getElementById('swal-ci').value,
                        nombre: nombre,
                        primerApellido: primerApellido,
                        segundoApellido: document.getElementById('swal-segundoApellido').value,
                        celular: document.getElementById('swal-celular').value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    guardarPedido(result.value);
                }
            });
        }

        function guardarPedido(clienteData) {
            Swal.fire({
                title: 'Procesando...',
                text: 'Guardando su pedido',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch("<?php echo site_url('Welcome/guardar_pedido'); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: JSON.stringify(clienteData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: '¡Su pedido ha sido realizado con éxito!',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "<?php echo site_url('Welcome/vaciar_carrito'); ?>";
                            }
                        });
                    } else {
                        throw new Error(data.message || 'Error al realizar el pedido');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Hubo un error al procesar su pedido',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>
</body>

</html>