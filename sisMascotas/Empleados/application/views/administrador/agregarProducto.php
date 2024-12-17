<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetLover - Pet Care Website Template</title>
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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label::after {
            content: " *";
            color: red;
        }

        .product-form-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 3rem;
        }

        .form-title {
            color: #2C3E50;
            border-bottom: 2px solid #3498DB;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }

        .image-preview-container {
            width: 100%;
            max-width: 300px;
            margin: 1rem auto;
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }

        .image-preview {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            display: none;
        }

        .preview-placeholder {
            color: #666;
            font-size: 0.9rem;
            display: block;
        }

        .form-control:focus {
            border-color: #3498DB;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-submit {
            background: #3498DB;
            border: none;
            padding: 0.8rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #2980B9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.1rem;
            color: #2C3E50;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .product-form-card {
                padding: 1rem;
            }
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

    <!-- Form Container -->
    <!-- Form Container -->
    <div class="container pt-5">
        <div class="product-form-card">
            <h3 class="form-title text-center mb-4">Agregar Nuevo Producto</h3>

            <form action="<?php echo site_url('Welcome/agregarProducto'); ?>" method="post"
                enctype="multipart/form-data">
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <div class="form-section">
                            <h5 class="section-title">Información Básica</h5>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                    required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio">Precio (Bs.)</label>
                                        <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <div class="form-section">
                            <h5 class="section-title">Categorización</h5>
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select class="form-control" id="categoria" name="categoria" required>
                                    <option value="Alimento">Alimentos</option>
                                    <option value="Accesorios">Accesorios</option>
                                    <option value="Higiene">Higiene</option>
                                    <option value="Juguetes">Juguetes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mascota">Mascota</label>
                                <select class="form-control" id="mascota" name="mascota" required>
                                    <option value="perro">Perro</option>
                                    <option value="gato">Gato</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo" required></select>
                            </div>
                        </div>

                        <div class="form-section" id="vencimientoLoteSection">
                            <h5 class="section-title">Información de Producto</h5>
                            <div class="form-group">
                                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"
                                    required>
                                <small class="form-text text-muted">La fecha debe ser posterior a hoy</small>
                            </div>

                            <div class="form-group">
                                <label for="lote">Número de Lote</label>
                                <input type="text" class="form-control" id="lote" name="lote"
                                    placeholder="Ejemplo: LOT2024001" required>
                                <small class="form-text text-muted">Use letras mayúsculas, números y guiones (3-20
                                    caracteres)</small>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Imagen -->
                    <div class="col-12">
                        <div class="form-section">
                            <h5 class="section-title">Imagen del Producto</h5>
                            <div class="form-group">
                                <label for="imagen_url">URL de Imagen</label>
                                <input type="text" class="form-control" id="imagen_url" name="imagen_url"
                                    placeholder="Ingrese la URL de la imagen del producto">
                            </div>
                            <div class="image-preview-container">
                                <img id="image-preview" class="image-preview" alt="Vista previa de la imagen">
                                <span class="preview-placeholder">Vista previa de la imagen</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Submit -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fas fa-save mr-2"></i>Agregar Producto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const opcionesGato = {
            Alimento: ['Alimento Seco Especial', 'Alimento Humedo', 'Alimento Seco', 'Snacks y Premios'],
            Accesorios: ['Casas Camas y Frazadas', 'Torres y Rascadores', 'Platos y Dispensadores', 'Transportadores y Jaulas', 'Collares Correas y Pecheras'],
            Higiene: ['Arenas Sanitarias', 'Areneros y Palas', 'Limpieza de Hogar', 'Shampoo y Aseo', 'Peines Cepillos y Cortadoras'],
            Juguetes: ['Catnip Hierba Gatera', 'Juguetes Gato']
        };

        const opcionesPerro = {
            Alimento: ['Alimento Seco Especial', 'Alimento Seco', 'Alimento Humedo', 'Snacks y Premios'],
            Accesorios: ['Casas Camas y Frazadas', 'Collares Correas y Pecheras', 'Platos y Dispensadores', 'Ropa', 'Transportadores y Jaulas'],
            Juguetes: ['Juguetes Goma y Cuerda', 'Pelotas y Otros', 'Peluches'],
            Higiene: ['Bolsas de Heces y Dispensadores', 'Limpieza de Hogar', 'Cuidado de Uñas', 'Cuidado Dental', 'Peines Cepillos y Cortadoras', 'Shampoo y Aseo']
        };

        function actualizarTipos() {
            var mascota = document.getElementById('mascota').value;
            var categoria = document.getElementById('categoria').value;
            var tipoSelect = document.getElementById('tipo');

            tipoSelect.innerHTML = '';

            var opciones = (mascota === 'gato') ? opcionesGato[categoria] : opcionesPerro[categoria];

            if (opciones) {
                opciones.forEach(function (opcion) {
                    var optionElement = document.createElement('option');
                    optionElement.value = opcion;
                    optionElement.textContent = opcion;
                    tipoSelect.appendChild(optionElement);
                });
            }
        }

        function toggleDateAndLotFields() {
            const categoria = document.getElementById('categoria').value;
            const vencimientoLoteSection = document.getElementById('vencimientoLoteSection');
            const fechaVencimientoInput = document.getElementById('fecha_vencimiento');
            const loteInput = document.getElementById('lote');

            if (categoria === 'Accesorios' || categoria === 'Juguetes') {
                vencimientoLoteSection.style.display = 'none';
                fechaVencimientoInput.removeAttribute('required');
                loteInput.removeAttribute('required');
                // Limpiar los valores cuando se oculta
                fechaVencimientoInput.value = '';
                loteInput.value = '';
            } else {
                vencimientoLoteSection.style.display = 'block';
                fechaVencimientoInput.setAttribute('required', '');
                loteInput.setAttribute('required', '');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Establecer fecha mínima para el campo de fecha de vencimiento
            const fechaVencimientoInput = document.getElementById('fecha_vencimiento');
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            fechaVencimientoInput.min = tomorrow.toISOString().split('T')[0];

            // Event listeners
            document.getElementById('mascota').addEventListener('change', actualizarTipos);
            document.getElementById('categoria').addEventListener('change', function () {
                actualizarTipos();
                toggleDateAndLotFields();
            });

            // Inicializar campos
            actualizarTipos();
            toggleDateAndLotFields();

            // Validación de fecha de vencimiento en tiempo real
            document.getElementById('fecha_vencimiento').addEventListener('change', function () {
                const fechaSeleccionada = new Date(this.value);
                const hoy = new Date();

                if (fechaSeleccionada <= hoy) {
                    this.classList.add('is-invalid');
                    this.nextElementSibling.classList.add('text-danger');
                    this.nextElementSibling.textContent = 'La fecha debe ser posterior a hoy';
                } else {
                    this.classList.remove('is-invalid');
                    this.nextElementSibling.classList.remove('text-danger');
                    this.nextElementSibling.textContent = 'Fecha válida';

                    // Verificar si la fecha está dentro de los próximos 30 días
                    const treintaDias = new Date();
                    treintaDias.setDate(treintaDias.getDate() + 30);

                    if (fechaSeleccionada <= treintaDias) {
                        this.nextElementSibling.classList.add('text-warning');
                        this.nextElementSibling.textContent = 'Advertencia: Fecha de vencimiento cercana (menos de 30 días)';
                    }
                }
            });

            // Validación de lote en tiempo real
            document.getElementById('lote').addEventListener('input', function () {
                const loteRegex = /^[A-Z0-9-]{3,20}$/;

                if (!loteRegex.test(this.value)) {
                    this.classList.add('is-invalid');
                    this.nextElementSibling.classList.add('text-danger');
                    this.nextElementSibling.textContent = 'Formato inválido: use mayúsculas, números y guiones (3-20 caracteres)';
                } else {
                    this.classList.remove('is-invalid');
                    this.nextElementSibling.classList.remove('text-danger');
                    this.nextElementSibling.textContent = 'Formato válido';
                }
            });

            // Validación de precio en tiempo real
            document.getElementById('precio').addEventListener('input', function () {
                const precio = parseFloat(this.value);
                if (precio <= 0) {
                    this.classList.add('is-invalid');
                    if (!this.nextElementSibling) {
                        const feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        this.parentNode.appendChild(feedback);
                    }
                    this.nextElementSibling.textContent = 'El precio debe ser mayor a 0';
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            // Validación de stock en tiempo real
            document.getElementById('stock').addEventListener('input', function () {
                const stock = parseInt(this.value);
                if (stock < 0) {
                    this.classList.add('is-invalid');
                    if (!this.nextElementSibling) {
                        const feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        this.parentNode.appendChild(feedback);
                    }
                    this.nextElementSibling.textContent = 'El stock no puede ser negativo';
                } else {
                    this.classList.remove('is-invalid');
                }
            });

            // Manejo del formulario en el submit
            const form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Get the category
                const categoria = document.getElementById('categoria').value;
                const requiresDateAndLot = !(categoria === 'Accesorios' || categoria === 'Juguetes');

                // Validaciones básicas
                const nombre = document.getElementById('nombre').value.trim();
                const descripcion = document.getElementById('descripcion').value.trim();
                const precio = document.getElementById('precio').value;
                const stock = document.getElementById('stock').value;

                // Validar campos requeridos básicos
                if (!nombre || !descripcion || !precio || !stock) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Por favor complete todos los campos requeridos',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Validar precio positivo
                if (precio <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El precio debe ser mayor a 0',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Validar stock no negativo
                if (stock < 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El stock no puede ser negativo',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Validar fecha y lote solo si son requeridos
                if (requiresDateAndLot) {
                    const fechaVencimiento = document.getElementById('fecha_vencimiento').value;
                    const lote = document.getElementById('lote').value.trim();

                    if (!fechaVencimiento || !lote) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Fecha de vencimiento y lote son requeridos para esta categoría',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Validar fecha de vencimiento
                    const fechaVenc = new Date(fechaVencimiento);
                    if (fechaVenc <= today) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'La fecha de vencimiento debe ser posterior a hoy',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Validar formato del lote
                    const loteRegex = /^[A-Z0-9-]{3,20}$/;
                    if (!loteRegex.test(lote)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El número de lote debe contener solo letras mayúsculas, números y guiones (3-20 caracteres)',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }
                }

                // Confirmación antes de enviar
                Swal.fire({
                    title: '¿Guardar producto?',
                    text: "¿Estás seguro de que deseas guardar este producto?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Guardando producto...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });
        });

        document.getElementById('imagen_url').addEventListener('input', function () {
            const imagePreview = document.getElementById('image-preview');
            const placeholder = document.querySelector('.preview-placeholder');
            const imageUrl = this.value.trim();

            if (imageUrl) {
                imagePreview.src = imageUrl;
                imagePreview.style.display = 'block';
                placeholder.style.display = 'none';

                // Manejar errores de carga de imagen
                imagePreview.onerror = function () {
                    imagePreview.style.display = 'none';
                    placeholder.style.display = 'block';
                    placeholder.textContent = 'Error al cargar la imagen';
                    placeholder.style.color = '#dc3545';
                };

                imagePreview.onload = function () {
                    placeholder.style.display = 'none';
                };
            } else {
                imagePreview.style.display = 'none';
                placeholder.style.display = 'block';
                placeholder.textContent = 'Vista previa de la imagen';
                placeholder.style.color = '#666';
            }
        });

        // Mensajes del servidor
        if (typeof successMessage !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: successMessage,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = baseUrl + 'Welcome/adminProductos';
                }
            });
        }

        if (typeof errorMessage !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                confirmButtonText: 'OK'
            });
        }
    </script>
</body>

</html>