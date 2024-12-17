<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reporte por Categoría</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

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

        .report-container {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .report-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

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
        }

        .table thead th {
            background-color: #343a40;
            color: white;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

    <!-- Content Section -->
    <div class="container pt-5">
        <div class="report-container">
            <!-- Header with Title and Export Button -->
            <div class="header-actions">
                <h2 class="mb-0">Reporte por Categoría</h2>
                <?php if (isset($reporte) && !empty($reporte)): ?>
                    <form method="post" action="<?php echo site_url('Welcome/generar_pdf_categoria'); ?>" class="m-0">
                        <?php foreach ($reporte as $row): ?>
                            <input type="hidden" name="categoria[]" value="<?php echo $row->categoria; ?>">
                            <input type="hidden" name="producto[]" value="<?php echo $row->producto; ?>">
                            <input type="hidden" name="precio[]" value="<?php echo $row->precio; ?>">
                            <input type="hidden" name="stock[]" value="<?php echo $row->stock; ?>">
                            <input type="hidden" name="cantidad_vendida[]" value="<?php echo $row->cantidad_vendida; ?>">
                            <input type="hidden" name="total_vendido[]" value="<?php echo $row->total_vendido; ?>">
                        <?php endforeach; ?>

                        <?php if (isset($fecha_inicio) && isset($fecha_fin)): ?>
                            <input type="hidden" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
                            <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
                        <?php endif; ?>

                        <button type="submit" class="btn btn-export">
                            <i class="fas fa-file-pdf"></i>
                            Exportar PDF
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- Search Form -->
            <div class="report-form">
                <?php echo form_open('Welcome/reporte_por_categoria', ['class' => 'row']); ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <option value="">Todas las Categorías</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?php echo $cat->categoria; ?>" <?php echo ($categoria == $cat->categoria) ? 'selected' : ''; ?>>
                                    <?php echo $cat->categoria; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                            value="<?php echo set_value('fecha_inicio'); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                            value="<?php echo set_value('fecha_fin'); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search mr-2"></i>Generar Reporte
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <!-- Results Table -->
            <?php if (isset($reporte) && !empty($reporte)): ?>
                <div class="table-container">
                    <table id="reportTable" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Cantidad Vendida</th>
                                <th>Total Vendido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reporte as $item): ?>
                                <tr>
                                    <td><?php echo $item->categoria; ?></td>
                                    <td><?php echo $item->producto; ?></td>
                                    <td><?php echo number_format($item->precio, 2); ?> Bs.</td>
                                    <td><?php echo $item->stock; ?></td>
                                    <td><?php echo $item->cantidad_vendida; ?></td>
                                    <td><?php echo number_format($item->total_vendido, 2); ?> Bs.</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">TOTALES:</th>
                                <th><?php echo array_sum(array_column($reporte, 'cantidad_vendida')); ?></th>
                                <th><?php echo 'Bs. ' . number_format(array_sum(array_column($reporte, 'total_vendido')), 2); ?>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    No se encontraron resultados para los criterios seleccionados.
                </div>
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
                "order": [[0, "asc"]],
                "responsive": true
            });
        });
    </script>
</body>

</html>