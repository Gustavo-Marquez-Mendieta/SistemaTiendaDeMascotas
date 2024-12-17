<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reporte por Categoría</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
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

        /* Estilos mejorados para el contenedor principal */
        .report-container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        /* Estilo para el formulario */
        .report-form {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Estilos para la tabla de resultados */
        .report-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .report-table th {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: left;
        }

        .report-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .report-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Estilos para el gráfico */
        .chart-container {
            margin-top: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .btn-generate {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-generate:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Header y Navbar (mantener el mismo que tienes) -->
    
    <div class="container pt-5">
        <div class="report-container">
            <h2 class="mb-4">Reporte por Categoría</h2>

            <div class="report-form">
                <?php echo form_open('Welcome/generar_pdf_categoria'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="producto">Seleccionar Producto:</label>
                                <select class="form-control" name="producto_id" id="producto">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Seleccionar Categoría:</label>
                                <select class="form-control" name="categoria" id="categoria">
                                    <option value="">Todas las Categorías</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?php echo $cat->categoria; ?>"
                                            <?php echo ($categoria == $cat->categoria) ? 'selected' : ''; ?>>
                                            <?php echo $cat->categoria; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha Inicio:</label>
                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_fin">Fecha Fin:</label>
                                <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-generate">Generar Reporte</button>
                    </div>
                <?php echo form_close(); ?>
            </div>

            <?php if (isset($reporte) && !empty($reporte)): ?>
                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Cantidad Vendida</th>
                                <th>Total Vendido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reporte as $item): ?>
                                <tr>
                                    <td><?php echo $item->producto; ?></td>
                                    <td><?php echo $item->categoria; ?></td>
                                    <td>Bs. <?php echo number_format($item->precio, 2); ?></td>
                                    <td><?php echo $item->stock; ?></td>
                                    <td><?php echo $item->cantidad_vendida; ?></td>
                                    <td>Bs. <?php echo number_format($item->total_vendido, 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="chart-container">
                    <canvas id="ventas-chart"></canvas>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-4">
                    No se encontraron resultados para los criterios seleccionados.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        <?php if (isset($reporte) && !empty($reporte)): ?>
            const ctx = document.getElementById('ventas-chart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode(array_column($reporte, 'producto')); ?>,
                    datasets: [{
                        label: 'Cantidad Vendida',
                        data: <?php echo json_encode(array_column($reporte, 'cantidad_vendida')); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Vendido (Bs)',
                        data: <?php echo json_encode(array_column($reporte, 'total_vendido')); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        type: 'line'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>