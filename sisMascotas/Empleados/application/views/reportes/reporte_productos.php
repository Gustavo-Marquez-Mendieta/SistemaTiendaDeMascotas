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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
    <!-- Libraries Stylesheet -->
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

        /* Report Container */
        .report-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        /* Header Styling */
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

        /* Chart Container */
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Shop</h1>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <a href="" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
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
                    <option value="<?php echo site_url('Welcome/reporte_usuario'); ?>">Reportes de Usuario</option>
                    <option value="<?php echo site_url('Welcome/reporte_por_categoria'); ?>">Reporte por Categoria</option>
                    <option value="<?php echo site_url('Welcome/reporte_por_producto'); ?>">Reporte por Producto</option>
                    <option value="<?php echo site_url('Welcome/reporte_productos_vencer'); ?>">Productos por Vencer</option>
                </select>
                </div>
            </div>
            <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Cerrar Sesion</a>
        </div>
    </nav>
    </div>
    <div class="container pt-5">
        <div class="report-container">
            <div class="header-actions">
                <h2 class="mb-0">Reporte Detallado de Productos</h2>
                <?php if (isset($reporte) && !empty($reporte)): ?>
    <?php 
    // Guardar los datos del reporte en la sesión
    $this->session->set_userdata('ultimo_reporte', $reporte);
    $this->session->set_userdata('ultimo_historial', $historial_ventas);
    ?>
    <button onclick="window.location.href='<?php echo site_url('Welcome/generar_pdf_producto'); ?>'" class="btn btn-export">
        <i class="fas fa-file-pdf"></i>
        Exportar PDF
    </button>
<?php endif; ?>
            </div>

            <div class="report-form">
                <?php echo form_open('Welcome/reporte_por_producto', ['class' => 'row']); ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="producto_id">Producto:</label>
                            <select name="producto_id" id="producto" class="form-control" required>
                                <option value="">Todos los Productos</option>
                                <?php foreach ($productos as $producto): ?>
                                    <option value="<?php echo $producto->producto_id; ?>"
                                            <?php echo ($producto_id == $producto->producto_id) ? 'selected' : ''; ?>>
                                        <?php echo $producto->nombre; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio:</label>
                            <input type="date" name="fecha_inicio" class="form-control" 
                                   value="<?php echo set_value('fecha_inicio'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha Fin:</label>
                            <input type="date" name="fecha_fin" class="form-control" 
                                   value="<?php echo set_value('fecha_fin'); ?>">
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

            <?php if (isset($reporte) && !empty($reporte)): ?>
                <!-- Tarjetas de Resumen -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h6 class="card-title">Total Ventas</h6>
                                <h3 class="mb-0"><?php echo $reporte[0]->total_ventas; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h6 class="card-title">Ingresos Totales</h6>
                                <h3 class="mb-0">Bs. <?php echo number_format($reporte[0]->ingresos_totales, 2); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h6 class="card-title">Unidades Vendidas</h6>
                                <h3 class="mb-0"><?php echo $reporte[0]->unidades_vendidas; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h6 class="card-title">Clientes Únicos</h6>
                                <h3 class="mb-0"><?php echo $reporte[0]->clientes_unicos; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalles del Producto -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Información del Producto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nombre:</strong> <?php echo $reporte[0]->producto; ?></p>
                                <p><strong>Categoría:</strong> <?php echo $reporte[0]->categoria; ?></p>
                                <p><strong>Mascota:</strong> <?php echo ucfirst($reporte[0]->mascota); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Stock Actual:</strong> <?php echo $reporte[0]->stock_actual; ?></p>
                                <p><strong>Precio Actual:</strong> Bs. <?php echo number_format($reporte[0]->precio, 2); ?></p>
                                
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- Tabla de Historial de Ventas -->
                <div class="table-container">
                    <table id="reportTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Tipo Cliente</th>
                                <th>Vendedor</th>
                                <th>Cantidad</th>
                                <th>Precio Unit.</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historial_ventas as $venta): ?>
                                <tr>
                                    <td><?php echo date('d/m/Y', strtotime($venta->fechaVenta)); ?></td>
                                    <td><?php echo $venta->cliente; ?></td>
                                    <td><?php echo ucfirst($venta->tipo_cliente); ?></td>
                                    <td><?php echo $venta->vendedor; ?></td>
                                    <td><?php echo $venta->cantidad; ?></td>
                                    <td>Bs. <?php echo number_format($venta->precio, 2); ?></td>
                                    <td>Bs. <?php echo number_format($venta->total, 2); ?></td>
                                    <td>
                                        <span class="badge badge-<?php 
                                            echo $venta->estado_venta == 'Entregado' ? 'success' : 
                                                ($venta->estado_venta == 'Pendiente' ? 'warning' : 'danger'); 
                                        ?>">
                                            <?php echo $venta->estado_venta; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Gráfico de Tendencias -->
                <div class="card mb-4">
                    <div class="card-body">
                        <canvas id="ventasChart" height="100"></canvas>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    Seleccione un producto y rango de fechas para generar el reporte.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            $('#reportTable').DataTable({
                "pageLength": 10,
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
                "order": [[0, "desc"]]
            });

            <?php if (isset($historial_ventas) && !empty($historial_ventas)): ?>
            // Configurar el gráfico
            const ctx = document.getElementById('ventasChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php 
                        echo json_encode(array_map(function($venta) {
                            return date('d/m/Y', strtotime($venta->fechaVenta));
                        }, array_slice($historial_ventas, 0, 10))); 
                    ?>,
                    datasets: [{
                        label: 'Ventas por Día',
                        data: <?php 
                            echo json_encode(array_map(function($venta) {
                                return $venta->cantidad;
                            }, array_slice($historial_ventas, 0, 10))); 
                        ?>,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Tendencia de Ventas (Últimos 10 registros)'
                        }
                    }
                }
            });
            <?php endif; ?>
        });
    </script>
</body>
</html>