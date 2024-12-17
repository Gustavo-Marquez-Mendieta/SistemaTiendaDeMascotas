<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetLover - Pet Care Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries CSS -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css" rel="stylesheet">

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

        /* Report Container Styling */
        .report-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Form Styling */
        .report-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            height: calc(1.5em + 0.75rem + 2px);
        }

        /* Table Styling */
        .table-container {
            margin-top: 20px;
            background: white;
            border-radius: 8px;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
            border-color: #454d55;
            vertical-align: middle;
        }

        /* Button Styling */
        .btn-export {
            background-color: #28a745;
            color: white;
            padding: 8px 20px;
            border-radius: 4px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-export:hover {
            background-color: #218838;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        /* Badge Styling */
        .badge {
            padding: 8px 12px;
            font-size: 0.9em;
            border-radius: 4px;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #000;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        /* DataTables Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #7AB730 !important;
            color: white !important;
            border: 1px solid #7AB730 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #5a8f1f !important;
            color: white !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .report-container {
                padding: 15px;
            }

            .header-actions {
                flex-direction: column;
                gap: 15px;
            }
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .small {
            font-size: 85%;
        }

        .btn-export {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-export:hover {
            background-color: #218838;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-export i {
            font-size: 1.1em;
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
    <!-- Topbar End -->


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


    <!-- Navbar End -->

    <!-- Content Section -->
    <div class="container pt-5">
        <div class="report-container">
            <!-- Header with Title and Export Button -->
            <!-- Header with Title and Export Button -->
            <div class="header-actions">
                <div>
                    <h2 class="mb-0">Reporte por Usuario</h2>
                    <?php if (isset($reporte) && !empty($reporte)):
                        // Calcular totales y estadísticas
                        $total_ventas = 0;
                        $total_pendientes = 0;
                        $total_cancelados = 0;
                        $total_entregados = 0;
                        $ventas_por_empleado = array();

                        foreach ($reporte as $venta) {
                            $total_ventas += $venta->total;
                            switch ($venta->estado) {
                                case 1:
                                    $total_pendientes += $venta->total;
                                    break;
                                case 2:
                                    $total_cancelados += $venta->total;
                                    break;
                                case 3:
                                    $total_entregados += $venta->total;
                                    break;
                            }
                        }
                        ?>
                        <div class="mt-2 text-muted">
                            <small>Total de ventas: Bs. <?php echo number_format($total_ventas, 2); ?> |
                                Registros: <?php echo count($reporte); ?></small>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (isset($reporte) && !empty($reporte)): ?>
                    <form method="post" action="<?php echo site_url('Welcome/generar_pdf'); ?>" class="m-0">
                        <?php foreach ($reporte as $venta): ?>
                            <input type="hidden" name="empleado[]"
                                value="<?php echo $venta->nombre_usuario . ' ' . $venta->apellido_usuario; ?>">
                            <input type="hidden" name="cliente[]"
                                value="<?php echo $venta->nombre_cliente . ' ' . $venta->apellido_cliente; ?>">
                            <input type="hidden" name="total[]" value="<?php echo $venta->total; ?>">
                            <input type="hidden" name="estado[]"
                                value="<?php echo ($venta->estado == 1) ? 'Pendiente' : (($venta->estado == 2) ? 'Cancelado' : 'Entregado'); ?>">
                            <input type="hidden" name="fecha[]" value="<?php echo $venta->fechaVenta; ?>">
                        <?php endforeach; ?>

                        <!-- Datos adicionales para el reporte -->
                        <input type="hidden" name="total_ventas" value="<?php echo $total_ventas; ?>">
                        <input type="hidden" name="total_pendientes" value="<?php echo $total_pendientes; ?>">
                        <input type="hidden" name="total_cancelados" value="<?php echo $total_cancelados; ?>">
                        <input type="hidden" name="total_entregados" value="<?php echo $total_entregados; ?>">
                        <input type="hidden" name="fecha_inicio"
                            value="<?php echo isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : ''; ?>">
                        <input type="hidden" name="fecha_fin"
                            value="<?php echo isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : ''; ?>">

                        <div class="d-flex align-items-center">
                            <div class="text-right mr-3">
                                <div class="small text-muted">
                                    Entregados: Bs. <?php echo number_format($total_entregados, 2); ?><br>
                                    Pendientes: Bs. <?php echo number_format($total_pendientes, 2); ?><br>
                                    Cancelados: Bs. <?php echo number_format($total_cancelados, 2); ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-export">
                                <i class="fas fa-file-pdf"></i>
                                Exportar PDF Detallado
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Search Form -->
            <div class="report-form">
                <?php echo form_open('Welcome/reporte_usuario', ['class' => 'row']); ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="usuario">Empleado:</label>
                        <select name="usuario_id" id="usuario" class="form-control">
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo $usuario->id; ?>">
                                    <?php echo $usuario->nombre . ' ' . $usuario->primerApellido . ' ' . $usuario->segundoApellido; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search mr-2"></i>Generar
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <!-- Results Table -->
            <?php if (isset($reporte)): ?>
                <?php if (!empty($reporte)): ?>
                    <div class="table-container">
                        <table id="reportTable" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Empleado que entregó</th>
                                    <th>Nombre del Cliente</th>
                                    <th>Total por Venta</th>
                                    <th>Estado</th>
                                    <th>Fecha de Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reporte as $venta): ?>
                                    <tr>
                                        <td><?php echo $venta->nombre_usuario . ' ' . $venta->apellido_usuario; ?></td>
                                        <td><?php echo $venta->nombre_cliente . ' ' . $venta->apellido_cliente; ?></td>
                                        <td><?php echo $venta->total; ?> Bs.</td>
                                        <td>
                                            <?php
                                            $badgeClass = '';
                                            $estado = '';
                                            switch ($venta->estado) {
                                                case 1:
                                                    $badgeClass = 'badge-warning';
                                                    $estado = 'Pendiente';
                                                    break;
                                                case 2:
                                                    $badgeClass = 'badge-danger';
                                                    $estado = 'Cancelado';
                                                    break;
                                                case 3:
                                                    $badgeClass = 'badge-success';
                                                    $estado = 'Entregado';
                                                    break;
                                            }
                                            ?>
                                            <span class="badge <?php echo $badgeClass; ?>"><?php echo $estado; ?></span>
                                        </td>
                                        <td><?php echo $venta->fechaVenta; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info mt-4">
                        No se encontraron resultados para los criterios seleccionados.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#reportTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "order": [[4, "desc"]], // Ordenar por fecha de entrega descendente
                "responsive": true,
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });
        });
    </script>
</body>

</html>