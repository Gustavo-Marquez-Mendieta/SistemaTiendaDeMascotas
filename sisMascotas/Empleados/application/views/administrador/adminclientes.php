<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pet Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
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
    <div class="container-fluid pt-5">
        <h4 class="text-secondary mb-3">Pet Clientes</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Celular</th>
                        <th>Total Compras</th>
                        <th>Tipo Cliente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?php echo $cliente['cliente_id']; ?></td>
                                <td><?php echo $cliente['ci']; ?></td>
                                <td><?php echo $cliente['nombre']; ?></td>
                                <td><?php echo $cliente['primerApellido']; ?></td>
                                <td><?php echo $cliente['segundoApellido']; ?></td>
                                <td><?php echo $cliente['celular']; ?></td>
                                <td><?php echo $cliente['total_compras']; ?></td>
                                <td><?php echo $cliente['tipo_cliente']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="openEditModal(<?php echo htmlspecialchars(json_encode($cliente)); ?>)">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No hay clientes disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para Editar Cliente -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" action="<?php echo site_url('Welcome/actualizar_cliente'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="cliente_id" id="editClienteId">
                            <div class="form-group">
                                <label for="editCi">CI</label>
                                <input type="text" class="form-control" name="ci" id="editCi" required>
                            </div>
                            <div class="form-group">
                                <label for="editNombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="editNombre" required>
                            </div>
                            <div class="form-group">
                                <label for="editPrimerApellido">Primer Apellido</label>
                                <input type="text" class="form-control" name="primerApellido" id="editPrimerApellido"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="editSegundoApellido">Segundo Apellido</label>
                                <input type="text" class="form-control" name="segundoApellido" id="editSegundoApellido">
                            </div>
                            <div class="form-group">
                                <label for="editCelular">Celular</label>
                                <input type="text" class="form-control" name="celular" id="editCelular" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function openEditModal(cliente) {
                // Llenar el formulario con los datos del cliente
                document.getElementById('editClienteId').value = cliente.cliente_id;
                document.getElementById('editCi').value = cliente.ci;
                document.getElementById('editNombre').value = cliente.nombre;
                document.getElementById('editPrimerApellido').value = cliente.primerApellido;
                document.getElementById('editSegundoApellido').value = cliente.segundoApellido;
                document.getElementById('editCelular').value = cliente.celular;
                $('#editModal').modal('show');
            }

            document.addEventListener("DOMContentLoaded", function () {
                <?php if ($this->session->flashdata('success')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '<?php echo $this->session->flashdata('success'); ?>',
                        confirmButtonText: 'OK'
                    });
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?php echo $this->session->flashdata('error'); ?>',
                        confirmButtonText: 'OK'
                    });
                <?php endif; ?>
            });
        </script>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>