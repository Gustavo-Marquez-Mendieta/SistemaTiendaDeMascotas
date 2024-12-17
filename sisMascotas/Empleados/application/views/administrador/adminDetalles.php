<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetLover - Pet Care Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">

    <style>
        .custom-select-reportitos {
            background-color: transparent;
            color: white;
            border: none;
            text-align: center;
            text-align-last: center;
            font-size: 20px;
            height: 100%;
            appearance: none;
            margin-top: 10px;
        }

        .custom-select-reportitos option {
            background-color: black;
            color: white;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        /* Estilos para DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #7AB730 !important;
            color: white !important;
            border: 1px solid #7AB730 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #5a8f1f !important;
            color: white !important;
            border: 1px solid #5a8f1f !important;
        }

        /* Estilo para la cabecera de la tabla */
        .table thead th {
            background-color: #343a40 !important;
            color: white !important;
            border-color: #454d55 !important;
            vertical-align: middle !important;
        }

        /* Ajuste para el hover en las filas */
        .table-striped tbody tr:hover {
            background-color: rgba(0, 0, 0, .05);
        }

        .table-container {
            margin: 20px 0;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        /* Ajustes para los controles de DataTables */
        .dataTables_wrapper .dataTables_length select {
            padding: 5px;
            border-radius: 4px;
            margin: 0 5px;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-left: 5px;
        }

        /* Estilo para los badges */
        .badge {
            padding: 8px 12px;
            font-size: 0.9em;
        }

        /* Estilo para los botones */
        .btn-info {
            background-color: #7AB730;
            border-color: #7AB730;
        }

        .btn-info:hover {
            background-color: #5a8f1f;
            border-color: #5a8f1f;
        }

        /* Ajustes responsive */
        @media (max-width: 768px) {
            .table-container {
                padding: 10px;
            }

            .table thead th {
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Shop</h1>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span
                        class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="<?php echo site_url('Welcome/dashboard'); ?>" class="nav-item nav-link">Dashboard</a>
                    <a href="<?php echo site_url('Welcome/admin'); ?>" class="nav-item nav-link">Usuarios</a>
                    <a href="<?php echo site_url('Welcome/adminProductos'); ?>" class="nav-item nav-link">Productos</a>
                    <a href="<?php echo site_url('Welcome/adminDetalles'); ?>" class="nav-item nav-link">Ventas</a>
                    <a href="<?php echo site_url('Welcome/adminClientes'); ?>" class="nav-item nav-link">Clientes</a>
                    <div class="nav-item">
                        <select class="custom-select-reportitos" onchange="location = this.value;">
                            <option value="" disabled selected>Reportes</option>
                            <option value="<?php echo site_url('Welcome/reporte_usuario'); ?>">Reportes de Usuario
                            </option>
                            <option value="<?php echo site_url('Welcome/reporte_por_categoria'); ?>">Reporte por
                                Categoria</option>
                            <option value="<?php echo site_url('Welcome/reporte_por_producto'); ?>">Reporte por Producto
                            </option>
                            <option value="<?php echo site_url('Welcome/reporte_productos_vencer'); ?>">Productos por
                                Vencer</option>
                        </select>
                    </div>
                </div>
                <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>"
                    class="btn btn-lg btn-primary px-3 d-none d-lg-block">Cerrar Sesion</a>
            </div>
        </nav>
    </div>

    <!-- Content Start -->
    <div class="container pt-5">
        <!-- Pedidos sin entregar -->
        <div class="table-container">
            <h2 class="text-secondary mb-4">Detalles de pedidos sin entregar</h2>
            <table id="pedidosTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Estado</th>
                        <th>Fecha del Pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?php echo $detalle['id']; ?></td>
                            <td><?php echo $detalle['producto_nombre']; ?></td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td>
                                <?php
                                switch ($detalle['estado']) {
                                    case 1:
                                        echo '<span class="badge badge-warning">Pendiente</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge badge-danger">Cancelado</span>';
                                        break;
                                    case 3:
                                        echo '<span class="badge badge-success">Entregado</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-secondary">Desconocido</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo $detalle['fechaPedido']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Ventas Realizadas -->
        <div class="table-container">
            <h2 class="text-secondary mb-4">Detalle de Ventas Realizadas</h2>
            <table id="ventasTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Pedido ID</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha del Pedido</th>
                        <th>Fecha de Venta</th>
                        <th>Empleado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?php echo $venta['id']; ?></td>
                            <td><?php echo $venta['cliente_nombre'] . ' ' . $venta['cliente_primerApellido']; ?></td>
                            <td><?php echo $venta['pedido_id']; ?></td>
                            <td><?php echo $venta['total']; ?> Bs.</td>
                            <td>
                                <?php
                                switch ($venta['estado']) {
                                    case 1:
                                        echo '<span class="badge badge-warning">Pendiente</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge badge-danger">Cancelado</span>';
                                        break;
                                    case 3:
                                        echo '<span class="badge badge-success">Entregado</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-secondary">Desconocido</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo $venta['fechaPedido']; ?></td>
                            <td><?php echo $venta['fechaVenta']; ?></td>
                            <td><?php echo $venta['entregador_nombre'] . ' ' . $venta['entregador_primerApellido'] . ' ' . $venta['entregador_segundoApellido']; ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url('Welcome/verDetallePedido/' . $venta['pedido_id']); ?>"
                                    class="btn btn-info btn-sm">Ver Detalles</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Configuración común para ambas tablas
            const tableConfig = {
                responsive: true,
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
                order: [[0, "desc"]],
                language: {
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron registros",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "Buscar:",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                },
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                drawCallback: function (settings) {
                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                }
            };

            // Inicializar tablas
            $('#pedidosTable').DataTable(tableConfig);
            $('#ventasTable').DataTable(tableConfig);
        });
    </script>
</body>

</html>