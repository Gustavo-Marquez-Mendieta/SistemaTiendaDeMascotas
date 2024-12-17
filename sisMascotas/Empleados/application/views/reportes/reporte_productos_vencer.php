<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetShop - Reporte de Ventas</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url(); ?>assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
        rel="stylesheet" />

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom CSS -->
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
            margin-top: 5px;
        }

        .custom-select-reportitos option {
            background-color: black;
            color: white;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .report-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #7AB730;
            color: white;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(122, 183, 48, 0.1);
        }

        .section-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f8f9fa;
        }

        .btn-export {
            background-color: #7AB730;
            border-color: #7AB730;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-export:hover {
            background-color: #5a8f1f;
            border-color: #5a8f1f;
            color: white;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #7AB730 !important;
            color: white !important;
            border: 1px solid #7AB730 !important;
        }

        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .filters-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
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
                <h1 class="m-0 display-5 text-capitalize text-white"><span class="text-primary">Pet</span>Shop</h1>
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

    <!-- Content Start -->
    <div class="container pt-5">
        <div class="report-container">
            <!-- Header Section -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h2 class="section-header">
                        <i class="fas fa-exclamation-triangle mr-2 text-warning"></i>
                        Productos por Vencer
                    </h2>
                </div>
                <div class="col-md-6 text-right">
                    <form id="exportForm" action="<?php echo site_url('Welcome/generar_pdf_productos_vencer'); ?>"
                        method="post">
                        <?php if (!empty($productos)):
                            foreach ($productos as $producto): ?>
                                <input type="hidden" name="producto[]"
                                    value="<?php echo htmlspecialchars($producto->nombre); ?>">
                                <input type="hidden" name="categoria[]"
                                    value="<?php echo htmlspecialchars($producto->categoria); ?>">
                                <input type="hidden" name="mascota[]"
                                    value="<?php echo htmlspecialchars($producto->mascota); ?>">
                                <input type="hidden" name="lote[]" value="<?php echo htmlspecialchars($producto->lote); ?>">
                                <input type="hidden" name="stock[]" value="<?php echo $producto->stock; ?>">
                                <input type="hidden" name="fecha_vencimiento[]"
                                    value="<?php echo $producto->fecha_vencimiento; ?>">
                                <input type="hidden" name="dias_restantes[]" value="<?php echo $producto->dias_restantes; ?>">
                            <?php endforeach; endif; ?>
                        <input type="hidden" name="dias_filtro" value="<?php echo isset($dias) ? $dias : 30; ?>">

                        <button type="button" onclick="exportarPDF()" class="btn btn-primary">
                            <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                        </button>
                    </form>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diasVencimiento">Mostrar productos que vencen en los próximos:</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="diasVencimiento"
                                    value="<?php echo isset($dias) ? $dias : 30; ?>" min="1" max="365">
                                <div class="input-group-append">
                                    <span class="input-group-text">días</span>
                                    <button class="btn btn-primary ml-2" onclick="aplicarFiltro()">
                                        <i class="fas fa-filter mr-2"></i>Filtrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-container">
                <table id="productosTable" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Mascota</th>
                            <th>Lote</th>
                            <th>Stock</th>
                            <th>Fecha Vencimiento</th>
                            <th>Días Restantes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)):
                            foreach ($productos as $producto):
                                $dias_restantes = $producto->dias_restantes;
                                $clase_alerta = '';
                                $texto_estado = '';

                                if ($dias_restantes <= 7) {
                                    $clase_alerta = 'table-danger';
                                    $texto_estado = 'Crítico';
                                } elseif ($dias_restantes <= 15) {
                                    $clase_alerta = 'table-warning';
                                    $texto_estado = 'Alerta';
                                } else {
                                    $clase_alerta = 'table-success';
                                    $texto_estado = 'Normal';
                                }
                                ?>
                                <tr class="<?php echo $clase_alerta; ?>">
                                    <td><?php echo htmlspecialchars($producto->nombre); ?></td>
                                    <td><?php echo htmlspecialchars($producto->categoria); ?></td>
                                    <td><?php echo ucfirst(htmlspecialchars($producto->mascota)); ?></td>
                                    <td><?php echo htmlspecialchars($producto->lote); ?></td>
                                    <td class="text-center"><?php echo $producto->stock; ?></td>
                                    <td class="text-center">
                                        <?php echo date('d/m/Y', strtotime($producto->fecha_vencimiento)); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $producto->dias_restantes; ?> días
                                        <span
                                            class="badge badge-pill badge-<?php echo $dias_restantes <= 7 ? 'danger' : ($dias_restantes <= 15 ? 'warning' : 'success'); ?>">
                                            <?php echo $texto_estado; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No se encontraron productos próximos a vencer.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#productosTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "order": [[6, "asc"]], // Ordenar por días restantes de menor a mayor
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
            });
        });

        function aplicarFiltro() {
            var dias = document.getElementById('diasVencimiento').value;
            if (dias < 1 || dias > 365) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Valor inválido',
                    text: 'Por favor ingrese un número entre 1 y 365 días',
                    confirmButtonColor: '#7AB730'
                });
                return;
            }
            window.location.href = '<?php echo site_url("Welcome/reporte_productos_vencer"); ?>?dias=' + dias;
        }

        function exportarPDF() {
            Swal.fire({
                title: '¿Exportar a PDF?',
                text: "Se generará un reporte PDF con los productos próximos a vencer",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, exportar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                confirmButtonColor: '#7AB730',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Generando PDF',
                        html: 'Por favor espere...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    document.getElementById('exportForm').submit();

                    setTimeout(() => {
                        Swal.close();
                    }, 1500);
                }
            });
        }

        // Permitir usar Enter en el campo de días
        document.getElementById('diasVencimiento').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                aplicarFiltro();
            }
        });
    </script>
</body>

</html>