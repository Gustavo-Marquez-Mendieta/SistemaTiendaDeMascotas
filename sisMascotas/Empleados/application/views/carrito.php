<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos generales */
        #body {
            display: flex;
            margin-top: 20px;
        }

        .container {
            flex: 3;
            padding: 10px;
            margin-top: 20px;
        }

        /* Estilos de navegación y usuario */
        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-info .user-name {
            margin-left: 10px;
            color: #374151;
            font-weight: 500;
        }

        .user-info img {
            margin-left: 10px;
            width: 40px;
            height: 40px;
        }

        /* Estilos para la tabla del carrito */
        .carrito-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
            border-collapse: collapse;
        }

        /* Estilos para el encabezado de la tabla */
        .carrito-table thead {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }

        .carrito-table th {
            padding: 1rem 1.5rem;
            font-weight: 600;
            text-align: left;
            font-size: 0.875rem;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            white-space: nowrap;
            position: relative;
        }

        /* Línea separadora entre headers */
        .carrito-table th:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 25%;
            height: 50%;
            width: 1px;
            background-color: #e2e8f0;
        }

        /* Alineación específica para cada columna del header */
        .carrito-table th:nth-child(1) {
            padding-left: 2rem;
        }

        .carrito-table th:nth-child(4),
        .carrito-table th:nth-child(5),
        .carrito-table th:nth-child(6) {
            text-align: center;
        }

        .carrito-table th:last-child {
            text-align: center;
            padding-right: 2rem;
        }

        /* Estilos para las celdas del cuerpo */
        .carrito-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            color: #1f2937;
            font-size: 0.95rem;
            vertical-align: middle;
        }

        /* Alineación específica para cada columna del cuerpo */
        .carrito-table td:nth-child(1) {
            padding-left: 2rem;
            font-weight: 500;
        }

        .carrito-table td:nth-child(4),
        .carrito-table td:nth-child(5),
        .carrito-table td:nth-child(6) {
            text-align: center;
            font-weight: 500;
        }

        .carrito-table td:last-child {
            text-align: center;
            padding-right: 2rem;
        }

        /* Estilos para las filas */
        .carrito-table tbody tr {
            transition: all 0.2s ease;
        }

        .carrito-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .carrito-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Contenedor principal de la sección de total */
        #pagar {
            padding: 0 1.5rem;
            margin-left: 2rem;
        }

        /* Título del total */
        #pagar h1 {
            color: #1f2937;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Tabla del total */
        #pagar .table {
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
        }

        #pagar .table tr {
            background: white;
        }

        #pagar .table td {
            padding: 1.5rem;
            border: none;
            color: #1f2937;
        }

        /* Estilo para el texto "Total a Pagar" */
        #pagar .table td strong:first-child {
            font-size: 1.1rem;
            color: #4b5563;
        }

        /* Estilo para el monto total */
        #pagar .table td:last-child strong {
            font-size: 1.25rem;
            color: #2563eb;
        }

        /* Botón finalizar pedido */
        .button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            background: linear-gradient(45deg, #2563eb, #4f46e5);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(45deg, #1d4ed8, #4338ca);
            color: white;
            text-decoration: none;
        }

        .button svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        /* Estilos para el botón eliminar */
        .btn-danger {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
            color: white;
            text-decoration: none;
        }

        /* Botón vaciar carrito */
        .btn-vaciar {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: #ef4444;
            color: white;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-vaciar:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
            color: white;
            text-decoration: none;
        }

        /* Titulo principal */
        .titulo {
            color: #1f2937;
            font-size: 1.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
        }

        /* Alert messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #dcfce7;
        }

        /* Layout y Grid */
        .row {
            display: flex;
            margin: 0 -15px;
        }

        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
            padding: 0 15px;
        }

        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding: 0 15px;
        }

        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .row {
                flex-direction: column;
            }

            .col-md-8,
            .col-md-4 {
                max-width: 100%;
                flex: 0 0 100%;
            }

            #pagar {
                margin-left: 0;
                margin-top: 2rem;
                padding: 0;
            }

            .carrito-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .carrito-table th,
            .carrito-table td {
                padding: 0.75rem 1rem;
            }

            .carrito-table th:first-child,
            .carrito-table td:first-child {
                padding-left: 1rem;
            }

            .carrito-table th:last-child,
            .carrito-table td:last-child {
                padding-right: 1rem;
            }

            .titulo {
                font-size: 1.5rem;
            }
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

    <br><br><br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="titulo">Detalle de Productos a adquirir</h1>
                <?php if ($this->session->flashdata('mensaje')): ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('mensaje'); ?>
                    </div>
                <?php endif; ?>

                <table class="carrito-table">
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
                                            class="btn btn-danger">Eliminar</a>
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

            <div class="col-md-4">
                <div id="pagar">
                    <h1>Total del Carrito</h1>
                    <table class="table">
                        <tr>
                            <td><strong>Total a Pagar:</strong></td>
                            <td><strong>Bs. <?php echo number_format($total, 2); ?></strong></td>
                        </tr>
                    </table>
                    <a href="javascript:void(0);" onclick="finalizarCompra()" class="button">
                        <svg class="cartIcon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6H21L20 12H8L6 6Z" fill="currentColor" />
                        </svg>
                        Finalizar Pedido
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <a href="<?php echo site_url('Welcome/vaciar_carrito'); ?>" class="btn-vaciar">Vaciar Carrito</a>
        </div>
    </div>

    <!-- Diálogos modales para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Verificar mensajes flash
            <?php if ($this->session->flashdata('mensaje')): ?>
                Swal.fire({
                    icon: '<?php echo strpos($this->session->flashdata('mensaje'), 'Error') !== false ? 'error' : 'success' ?>',
                    title: '<?php echo strpos($this->session->flashdata('mensaje'), 'Error') !== false ? 'Error' : '¡Éxito!' ?>',
                    text: '<?php echo $this->session->flashdata('mensaje'); ?>',
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
            document.querySelector('.btn-vaciar').addEventListener('click', function (e) {
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

        // Función para finalizar compra
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

            Swal.fire({
                title: 'Ingrese su CI',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Continuar',
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
                            Swal.showValidationMessage(`Error al buscar el cliente: ${error}`);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    mostrarFormularioCliente(result.value);
                }
            });
        }

        // Función para mostrar formulario de cliente
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

        // Función para guardar pedido
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