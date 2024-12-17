<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pet Shop - Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
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

        /* Dashboard specific styles */
        .dashboard-stats {
            background: linear-gradient(45deg, #7AB730, #82C91E);
            border-radius: 15px;
            padding: 20px;
            color: white;
            transition: transform 0.3s ease;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .dashboard-stats:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .stats-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 800;
        }

        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-bottom: 2px solid #f8f9fa;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .card-title {
            font-size: 1.2rem;
            color: #333;
            font-weight: 700;
            margin: 0;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .scroll-table {
            max-height: 400px;
            overflow-y: auto;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dashboard-stats {
                margin-bottom: 15px;
            }

            .dashboard-card {
                margin-bottom: 15px;
            }
        }

        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 0.75rem 1.25rem;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .card-footer {
            border-top: 2px solid #f8f9fa;
            padding: 1rem 1.25rem;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .text-success {
            color: #7AB730 !important;
        }

        .font-weight-bold {
            font-weight: 600 !important;
        }

        .list-group-flush .list-group-item:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        .scrollable-table {
            max-height: 300px;
            /* Ajusta esta altura según el tamaño del gráfico */
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="container-fluid">
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Pet</span>Shop</h1>
                </a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
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
                    <a href="<?php echo site_url('Welcome/dashboard'); ?>"
                        class="nav-item nav-link active">Dashboard</a>
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

    <!-- Dashboard Content -->
    <div class="container-fluid pt-5">
        <div class="container-fluid">
            <!-- Stats Row -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-stats">
                        <i class="fas fa-box-open stats-icon"></i>
                        <div class="stats-title">Total Productos</div>
                        <div class="stats-number"><?php echo $total_productos; ?></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-stats">
                        <i class="fas fa-shopping-cart stats-icon"></i>
                        <div class="stats-title">Total Ventas</div>
                        <div class="stats-number"><?php echo $total_ventas; ?></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-stats">
                        <i class="fas fa-users stats-icon"></i>
                        <div class="stats-title">Total Clientes</div>
                        <div class="stats-number"><?php echo $total_clientes; ?></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="dashboard-stats">
                        <i class="fas fa-money-bill-wave stats-icon"></i>
                        <div class="stats-title">Ventas del Mes</div>
                        <div class="stats-number">
                            <?php
                            // Verificación y formato del número
                            $ventas_mes = isset($ventas_mes) ? floatval($ventas_mes) : 0;
                            echo number_format($ventas_mes, 2) . ' Bs.';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Tables Row -->
            <div class="row">
                <!-- Sección izquierda con el gráfico existente -->
                <div class="col-lg-8 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title"><i class="fas fa-chart-line mr-2 text-primary"></i>Tendencia de
                                Ventas</h5>
                            <div class="d-flex align-items-center">
                                <select id="yearSelector" class="form-control form-control-sm mr-2">
                                    <?php foreach ($años_disponibles as $año): ?>
                                        <option value="<?php echo $año->año; ?>" <?php echo ($año->año == $año_seleccionado) ? 'selected' : ''; ?>>
                                            <?php echo $año->año; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="ventasChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Nueva sección derecha con el detalle mensual -->
                <div class="col-lg-4 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-calendar-alt mr-2 text-success"></i>
                                Detalle Mensual <?php echo $año_seleccionado; ?>
                            </h5>
                        </div>
                        <div class="card-body p-0 scrollable-table">
                            <div class="list-group list-group-flush">
                                <?php
                                $meses = [
                                    1 => 'Enero',
                                    2 => 'Febrero',
                                    3 => 'Marzo',
                                    4 => 'Abril',
                                    5 => 'Mayo',
                                    6 => 'Junio',
                                    7 => 'Julio',
                                    8 => 'Agosto',
                                    9 => 'Septiembre',
                                    10 => 'Octubre',
                                    11 => 'Noviembre',
                                    12 => 'Diciembre'
                                ];

                                $total_anual = 0;
                                foreach ($ventas_por_mes as $index => $monto):
                                    $total_anual += $monto;
                                    $mes_actual = date('n');
                                    $año_actual = date('Y');
                                    $es_mes_actual = ($index + 1) == $mes_actual && $año_seleccionado == $año_actual;
                                    ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center 
                            <?php echo $es_mes_actual ? 'bg-light' : ''; ?>">
                                        <div>
                                            <i class="fas fa-circle <?php echo $monto > 0 ? 'text-success' : 'text-muted'; ?> mr-2"
                                                style="font-size: 8px;"></i>
                                            <?php echo $meses[$index + 1]; ?>
                                        </div>
                                        <div>
                                            <span
                                                class="font-weight-bold <?php echo $monto > 0 ? 'text-success' : 'text-muted'; ?>">
                                                <?php echo number_format($monto, 2); ?> Bs.
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="card-footer bg-white mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">Total Anual:</div>
                                    <div class="h5 mb-0 font-weight-bold text-success">
                                        <?php echo number_format($total_anual, 2); ?> Bs.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Bottom Row -->
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-star mr-2 text-warning"></i>Productos Más Vendidos
                            </h5>
                        </div>
                        <div class="scroll-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productos_mas_vendidos as $producto): ?>
                                        <tr>
                                            <td><?php echo $producto->nombre; ?></td>
                                            <td class="text-right"><?php echo $producto->cantidad_total; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Productos Bajo Stock -->
                <div class="col-lg-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-exclamation-triangle mr-2 text-danger"></i>Stock
                                Bajo</h5>
                        </div>
                        <div class="scroll-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productos_bajos_stock as $producto): ?>
                                        <tr>
                                            <td><?php echo $producto->nombre; ?></td>
                                            <td class="text-warning font-weight-bold"><?php echo $producto->stock; ?></td>
                                            <td><?php echo number_format($producto->precio, 2); ?> Bs.</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Ventas Recientes -->
                <div class="col-lg-3 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-clock mr-2 text-info"></i>Ventas Recientes</h5>
                        </div>
                        <div class="scroll-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($ventas_recientes)): ?>
                                        <?php foreach ($ventas_recientes as $venta): ?>
                                            <tr>
                                                <td><?php echo $venta->nombre . ' ' . $venta->primerApellido; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($venta->fechaVenta)); ?></td>
                                                <td class="text-right"><?php echo number_format($venta->total, 2); ?> Bs.</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No hay ventas recientes</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-4">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-user mr-2 text-primary"></i>Clientes por Total de
                                Compras</h5>
                        </div>
                        <div class="scroll-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre Completo</th>
                                        <th>Total Compras</th>
                                        <th>Tipo de Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($clientes_por_total_compras)): ?>
                                        <?php foreach ($clientes_por_total_compras as $cliente): ?>
                                            <tr>
                                                <td><?php echo $cliente->nombre . ' ' . $cliente->primerApellido . ' ' . ($cliente->segundoApellido ?? ''); ?>
                                                </td>
                                                <td style="text-align: center;" class="text-right">
                                                    <?php echo number_format($cliente->total_compras, 2); ?>
                                                    Bs.</td>
                                                <td><?php echo $cliente->tipo_cliente; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No hay datos de clientes</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nombresMeses = [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];

            let chartVentas;

            function initChart(datos) {
                const ctx = document.getElementById('ventasChart').getContext('2d');

                if (chartVentas) {
                    chartVentas.destroy();
                }

                chartVentas = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: nombresMeses,
                        datasets: [{
                            label: 'Ventas Totales',
                            data: datos,
                            borderColor: '#7AB730',
                            backgroundColor: 'rgba(122, 183, 48, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#7AB730',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let value = context.raw || 0;
                                        return 'Total: ' + value.toFixed(2) + ' Bs.';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                },
                                ticks: {
                                    callback: function (value) {
                                        return value.toFixed(2) + ' Bs.';
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Inicializar el gráfico con los datos actuales
            let ventasIniciales = <?php echo json_encode($ventas_por_mes); ?>;
            initChart(ventasIniciales);

            // Manejar el cambio de año
            document.getElementById('yearSelector').addEventListener('change', function () {
                const año = this.value;

                // Actualizar la URL sin recargar la página
                const url = new URL(window.location.href);
                url.searchParams.set('año', año);
                window.history.pushState({}, '', url);

                // Obtener datos del nuevo año
                fetch(`<?php echo site_url('Welcome/obtener_ventas_año'); ?>?año=${año}`)
                    .then(response => response.json())
                    .then(datos => {
                        initChart(datos);
                        actualizarDetalleMensual(datos, año);
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>

</html>