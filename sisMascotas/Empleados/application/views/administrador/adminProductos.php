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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

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

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #7AB730 !important;
            color: white !important;
            border: 1px solid #7AB730 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #5a8f1f !important;
            color: white !important;
            border: 1px solid #5a8f1f !important;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .table-responsive {
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        /* Nuevos estilos para el text overflow */
        .cell-content {
            max-height: 100px;
            /* Altura máxima para 4 líneas aproximadamente */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            line-height: 1.5;
        }

        /* Estilo para el tooltip */
        [data-tooltip] {
            position: relative;
            cursor: help;
        }

        /* Estilo para las celdas de la tabla */
        #productTable td {
            max-width: 200px;
            /* Ancho máximo para las celdas */
            vertical-align: top;
            padding: 10px;
        }

        /* Estilo específico para la columna de descripción */
        #productTable td:nth-child(3) {
            max-width: 300px;
            /* Más espacio para la descripción */
        }

        /* Estilo para las imágenes */
        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
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

    <!-- Content Start -->
    <div class="container-fluid pt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="text-secondary">Pet Productos</h4>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <a href="<?php echo site_url('Welcome/nuevoProducto'); ?>" class="btn btn-primary">Agregar Producto</a>
                <a href="<?php echo site_url('Welcome/adminProductos0'); ?>" class="btn btn-primary ml-2">Productos
                    Eliminados</a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="filterMascota">Filtrar por Mascota</label>
                    <select id="filterMascota" class="form-control" onchange="filtrarProductos()">
                        <option value="">Todas</option>
                        <option value="gato">Gato</option>
                        <option value="perro">Perro</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="filterCategoria">Filtrar por Categoría</label>
                    <select id="filterCategoria" class="form-control" onchange="filtrarProductos()">
                        <option value="">Todas</option>
                        <option value="alimento">Alimento</option>
                        <option value="juguetes">Juguetes</option>
                        <option value="accesorios">Accesorios</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="productTable" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock Total</th>
                        <th>Lotes</th> <!-- Nueva columna -->
                        <th>Categoría</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto['producto_id']; ?></td>
                                <td>
                                    <div class="cell-content" title="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                        <?php echo $producto['nombre']; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-content" title="<?php echo htmlspecialchars($producto['descripcion']); ?>">
                                        <?php echo $producto['descripcion']; ?>
                                    </div>
                                </td>
                                <td><?php echo $producto['precio']; ?>Bs.</td>
                                <td>
                                    <?php echo $producto['stock']; ?>
                                    <button class="btn btn-info btn-sm"
                                        onclick="mostrarModalStock(<?php echo $producto['producto_id']; ?>)"
                                        title="Agregar stock">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-sm"
                                        onclick="verLotes(<?php echo $producto['producto_id']; ?>)" title="Ver lotes">
                                        <i class="fas fa-box"></i> Ver lotes
                                    </button>
                                    <?php if (!empty($producto['lotes_por_vencer'])): ?>
                                        <span class="badge badge-warning">
                                            <?php echo count($producto['lotes_por_vencer']); ?> por vencer
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="cell-content" title="<?php echo htmlspecialchars($producto['categoria']); ?>">
                                        <?php echo $producto['categoria']; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($producto['imagen_url']): ?>
                                        <img src="<?php echo $producto['imagen_url']; ?>" alt="Imagen del Producto"
                                            class="product-image">
                                    <?php else: ?>
                                        No disponible
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('Welcome/editarProducto/' . $producto['producto_id']); ?>"
                                        class="btn btn-warning btn-sm mb-1">Editar</a>
                                    <a href="<?php echo site_url('Welcome/eliminarProducto/' . $producto['producto_id']); ?>"
                                        class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para Agregar Stock -->
        <!-- Modal para Agregar Stock -->
        <div class="modal fade" id="modalAgregarStock" tabindex="-1" role="dialog"
            aria-labelledby="modalAgregarStockLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarStockLabel">Agregar Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formAgregarStock">
                            <input type="hidden" id="producto_id" name="producto_id">

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" required
                                    min="1">
                                <div class="invalid-feedback">
                                    La cantidad debe ser mayor a 0
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lote">Número de Lote</label>
                                <input type="text" class="form-control" id="lote" name="lote" required
                                    pattern="[A-Z0-9-]{3,20}" placeholder="Ejemplo: LOT2024001">
                                <div class="invalid-feedback">
                                    Use letras mayúsculas, números y guiones (3-20 caracteres)
                                </div>
                                <small class="form-text text-muted">
                                    Formato: letras mayúsculas, números y guiones (ejemplo: LOT2024001)
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"
                                    required>
                                <div class="invalid-feedback">
                                    La fecha debe ser posterior a hoy
                                </div>
                                <small class="form-text text-muted">
                                    Seleccione una fecha posterior a hoy
                                </small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="guardarStock()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para Ver Lotes -->
        <div class="modal fade" id="modalVerLotes" tabindex="-1" role="dialog" aria-labelledby="modalVerLotesLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalVerLotesLabel">Detalle de Lotes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Cantidad</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tableLotes">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Editar Lote -->
        <div class="modal fade" id="modalEditarLote" tabindex="-1" role="dialog" aria-labelledby="modalEditarLoteLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLoteLabel">Editar Lote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarLote">
                            <input type="hidden" id="edit_lote_id" name="lote_id">
                            <input type="hidden" id="edit_producto_id" name="producto_id">

                            <div class="form-group">
                                <label for="edit_numero_lote">Número de Lote</label>
                                <input type="text" class="form-control" id="edit_numero_lote" name="numero_lote"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="edit_cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="edit_cantidad" name="cantidad" required
                                    min="0">
                            </div>

                            <div class="form-group">
                                <label for="edit_fecha_vencimiento">Fecha de Vencimiento</label>
                                <input type="date" class="form-control" id="edit_fecha_vencimiento"
                                    name="fecha_vencimiento" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="guardarEdicionLote()">Guardar
                            Cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->



        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- DataTables JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Establecer fecha mínima para el campo de fecha de vencimiento
                const fechaVencimientoInput = document.getElementById('fecha_vencimiento');
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                fechaVencimientoInput.min = tomorrow.toISOString().split('T')[0];

                // Agregar evento para los botones de eliminar
                document.querySelectorAll('.btn-danger').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        confirmarEliminacion(url);
                    });
                });
            });

            function confirmarEliminacion(url) {
                Swal.fire({
                    title: '¿Eliminar producto?',
                    text: "¿Estás seguro de que deseas eliminar este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }

            // Inicialización de DataTables
            $(document).ready(function () {
                var table = $('#productTable').DataTable({
                    "paging": true,
                    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
                    "pageLength": 10,
                    "dom": '<"top"lf>rt<"bottom"ip><"clear">',
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
                    "processing": true,
                    "ordering": true,
                    "order": [[0, "asc"]],
                    "responsive": true,
                    "stateSave": true,
                    "drawCallback": function (settings) {
                        $('.paginate_button.current').addClass('bg-primary text-white');
                        $('[title]').tooltip({
                            placement: 'top',
                            trigger: 'hover'
                        });
                    },
                    "initComplete": function (settings, json) {
                        $('.dataTables_length select').addClass('form-select form-select-sm');
                        $('.dataTables_filter input').addClass('form-control form-control-sm');
                    }
                });

                // Tooltips para contenido truncado
                $('#productTable').on('mouseenter', '.cell-content', function () {
                    var $this = $(this);
                    if (this.offsetHeight < this.scrollHeight || this.offsetWidth < this.scrollWidth) {
                        $this.tooltip({
                            title: $this.text(),
                            placement: 'top'
                        }).tooltip('show');
                    }
                });
            });

            // Funciones para el manejo de stock y lotes
            function mostrarModalStock(productoId) {
                // Limpiar el formulario
                document.getElementById('formAgregarStock').reset();
                // Establecer el ID del producto
                $('#producto_id').val(productoId);
                // Mostrar el modal
                $('#modalAgregarStock').modal('show');
            }

            function validarFormularioStock() {
                const cantidad = document.getElementById('cantidad').value;
                const lote = document.getElementById('lote').value;
                const fechaVencimiento = document.getElementById('fecha_vencimiento').value;

                if (!cantidad || cantidad <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La cantidad debe ser mayor a 0'
                    });
                    return false;
                }

                if (!lote || !/^[A-Z0-9-]{3,20}$/.test(lote)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El número de lote debe contener solo letras mayúsculas, números y guiones (3-20 caracteres)'
                    });
                    return false;
                }

                const fechaVenc = new Date(fechaVencimiento);
                const hoy = new Date();
                if (!fechaVencimiento || fechaVenc <= hoy) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La fecha de vencimiento debe ser posterior a hoy'
                    });
                    return false;
                }

                return true;
            }

            function guardarStock() {
                if (!validarFormularioStock()) {
                    return;
                }

                const formData = new FormData(document.getElementById('formAgregarStock'));

                Swal.fire({
                    title: 'Guardando...',
                    text: 'Por favor espere',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '<?php echo site_url('Welcome/agregar_stock'); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        try {
                            response = typeof response === 'string' ? JSON.parse(response) : response;

                            if (response.success) {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Stock agregado correctamente',
                                    icon: 'success'
                                }).then(() => {
                                    $('#modalAgregarStock').modal('hide');
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message || 'Error al guardar el stock',
                                    icon: 'error'
                                });
                            }
                        } catch (e) {
                            console.error('Error al procesar la respuesta:', e);
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al procesar la respuesta del servidor',
                                icon: 'error'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al guardar el stock',
                            icon: 'error'
                        });
                    }
                });
            }

            function verLotes(productoId) {
                Swal.fire({
                    title: 'Cargando...',
                    text: 'Obteniendo información de lotes',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '<?php echo site_url('Welcome/get_lotes/'); ?>' + productoId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        Swal.close();

                        if (!response || response.length === 0) {
                            Swal.fire({
                                title: 'Información',
                                text: 'No hay lotes registrados para este producto',
                                icon: 'info'
                            });
                            return;
                        }

                        let html = '';
                        response.forEach(lote => {
                            const fechaVencimiento = new Date(lote.fecha_vencimiento);
                            const hoy = new Date();
                            const diferenciaDias = Math.floor((fechaVencimiento - hoy) / (1000 * 60 * 60 * 24));

                            let estado = 'Normal';
                            let classEstado = 'text-success';

                            if (diferenciaDias <= 30 && diferenciaDias > 0) {
                                estado = 'Por vencer';
                                classEstado = 'text-warning';
                            } else if (diferenciaDias <= 0) {
                                estado = 'Vencido';
                                classEstado = 'text-danger';
                            }

                            html += `
                    <tr>
                        <td>${lote.lote}</td>
                        <td>${lote.cantidad}</td>
                        <td>${lote.fecha_ingreso}</td>
                        <td>${lote.fecha_vencimiento}</td>
                        <td class="${classEstado}">${estado}</td>
                        <td>
                            <button class="btn btn-sm btn-warning mr-1" onclick="editarLote(${lote.id}, '${lote.lote}', ${lote.cantidad}, '${lote.fecha_vencimiento}', ${productoId})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="eliminarLote(${lote.id}, ${productoId})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                        });

                        $('#tableLotes').html(html);
                        $('#modalVerLotes').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al obtener los lotes del producto',
                            icon: 'error'
                        });
                    }
                });
            }

            function editarLote(loteId, numeroLote, cantidad, fechaVencimiento, productoId) {
                $('#edit_lote_id').val(loteId);
                $('#edit_producto_id').val(productoId);
                $('#edit_numero_lote').val(numeroLote);
                $('#edit_cantidad').val(cantidad);
                $('#edit_fecha_vencimiento').val(fechaVencimiento);

                $('#modalVerLotes').modal('hide');
                $('#modalEditarLote').modal('show');
            }


            function guardarEdicionLote() {
                const formData = new FormData(document.getElementById('formEditarLote'));
                const productoId = $('#edit_producto_id').val();

                Swal.fire({
                    title: 'Guardando...',
                    text: 'Por favor espere',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '<?php echo site_url('Welcome/actualizar_lote'); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        try {
                            response = typeof response === 'string' ? JSON.parse(response) : response;

                            if (response.success) {
                                $('#modalEditarLote').modal('hide');

                                // Actualizar tanto la tabla de lotes como la tabla principal
                                verLotes(productoId);
                                actualizarTablaProductos();

                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Lote actualizado correctamente',
                                    icon: 'success'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.message || 'Error al actualizar el lote',
                                    icon: 'error'
                                });
                            }
                        } catch (e) {
                            console.error('Error:', e);
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al procesar la respuesta del servidor',
                                icon: 'error'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al actualizar el lote',
                            icon: 'error'
                        });
                    }
                });
            }


            function eliminarLote(loteId, productoId) {
                Swal.fire({
                    title: '¿Eliminar lote?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo site_url('Welcome/eliminar_lote/'); ?>' + loteId,
                            type: 'POST',
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {

                                    verLotes(productoId);
                                    actualizarTablaProductos();

                                    Swal.fire({
                                        title: 'Éxito',
                                        text: 'Lote eliminado correctamente',
                                        icon: 'success'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message || 'Error al eliminar el lote',
                                        icon: 'error'
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un error al eliminar el lote',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            }


            function actualizarTablaProductos() {
                $.ajax({
                    url: '<?php echo site_url('Welcome/get_productos_actualizados'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        var table = $('#productTable').DataTable();
                        table.clear();
                        table.rows.add(response).draw();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al actualizar la tabla de productos:', error);
                    }
                });
            }


            document.getElementById('cantidad').addEventListener('input', function () {
                if (this.value <= 0) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            document.getElementById('lote').addEventListener('input', function () {
                const regex = /^[A-Z0-9-]{3,20}$/;
                if (!regex.test(this.value)) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            document.getElementById('fecha_vencimiento').addEventListener('change', function () {
                const fechaSeleccionada = new Date(this.value);
                const hoy = new Date();
                if (fechaSeleccionada <= hoy) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });

        </script>

</body>

</html>