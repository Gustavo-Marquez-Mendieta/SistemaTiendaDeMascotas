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
        <h4 class="text-secondary mb-3">Pet Usuarios</h4>
        <a href="<?php echo site_url('Welcome/guardarUsuario'); ?>" class="btn btn-primary mb-3">Agregar Usuario</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Nombre de Usuario</th>
                        <th>Estado Usuario</th>
                        <th>Fecha Actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['id']; ?></td>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['primerApellido']; ?></td>
                                <td><?php echo $usuario['segundoApellido']; ?></td>
                                <td><?php echo $usuario['direccion']; ?></td>
                                <td><?php echo $usuario['telefono']; ?></td>
                                <td><?php echo $usuario['email']; ?></td>
                                <td><?php echo $usuario['nombre_usuario']; ?></td>
                                <td><?php echo $usuario['estadoUsuario'] == 1 ? 'Cuenta Activa' : 'Cuenta Suspendida'; ?></td>
                                <td><?php echo $usuario['fechaActualizacionUsuario']; ?></td>
                                <td>
                                    <?php if ($usuario['estadoUsuario'] == 1): ?>
                                        <a href="<?php echo site_url('Welcome/editar_usuario/' . $usuario['id']); ?>"
                                            class="btn btn-warning btn-sm">Editar</a>
                                        <a href="<?php echo site_url('Welcome/eliminar_usuario/' . $usuario['id']); ?>"
                                            class="btn btn-danger btn-sm">Eliminar</a>
                                    <?php else: ?>
                                        <a href="<?php echo site_url('Welcome/activar_usuario/' . $usuario['id']); ?>"
                                            class="btn btn-success btn-sm">Activar cuenta</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">No hay usuarios disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Verificar mensajes flash
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

                // Agregar eventos para los botones de eliminar
                document.querySelectorAll('.btn-danger').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = this.getAttribute('href');
                        confirmarEliminacion(url);
                    });
                });

                // Agregar eventos para los botones de activar cuenta
                document.querySelectorAll('.btn-success').forEach(button => {
                    if (button.textContent.trim() === 'Activar cuenta') {
                        button.addEventListener('click', function (e) {
                            e.preventDefault();
                            const url = this.getAttribute('href');
                            confirmarActivacion(url);
                        });
                    }
                });
            });

            function confirmarEliminacion(url) {
                Swal.fire({
                    title: '¿Eliminar usuario?',
                    text: "¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.",
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

            function confirmarActivacion(url) {
                Swal.fire({
                    title: '¿Activar cuenta?',
                    text: "¿Estás seguro de que deseas activar esta cuenta de usuario?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, activar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        </script>
        <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

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
    </div>
</body>

</html>