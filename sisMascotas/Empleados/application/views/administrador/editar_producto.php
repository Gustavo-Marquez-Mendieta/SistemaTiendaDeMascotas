<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetShop - Editar Producto</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
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

        .form-group label {
            font-weight: 600;
            color: #444;
        }

        .form-group label.required::after {
            content: " *";
            color: red;
        }

        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.25rem;
        }

        .form-control:focus {
            border-color: #7AB730;
            box-shadow: 0 0 0 0.2rem rgba(122, 183, 48, 0.25);
        }

        .btn-primary {
            background-color: #7AB730;
            border-color: #7AB730;
        }

        .btn-primary:hover {
            background-color: #669828;
            border-color: #669828;
        }

        .invalid-feedback {
            display: block;
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white">
                    <span class="text-primary">Pet</span>Shop
                </h1>
            </a>
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

    <!-- Contenido Principal -->
    <div class="container pt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Editar Producto</h4>
            </div>
            <div class="card-body">
                <?php echo form_open('Welcome/actualizarProducto', ['id' => 'formEditarProducto']); ?>
                <input type="hidden" name="producto_id" value="<?php echo $producto['producto_id']; ?>">

                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="required">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                value="<?php echo set_value('nombre', $producto['nombre']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="precio" class="required">Precio (Bs.)</label>
                            <input type="number" class="form-control" id="precio" name="precio"
                                value="<?php echo set_value('precio', $producto['precio']); ?>" step="0.01" min="0"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="stock" class="required">Stock Actual</label>
                            <input type="number" class="form-control" id="stock" name="stock"
                                value="<?php echo set_value('stock', $producto['stock']); ?>" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="mascota" class="required">Mascota</label>
                            <select class="form-control" id="mascota" name="mascota" required>
                                <option value="perro" <?php echo ($producto['mascota'] == 'perro') ? 'selected' : ''; ?>>
                                    Perro</option>
                                <option value="gato" <?php echo ($producto['mascota'] == 'gato') ? 'selected' : ''; ?>>
                                    Gato</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="categoria" class="required">Categoría</label>
                            <select class="form-control" id="categoria" name="categoria" required>
                                <option value="Alimento" <?php echo ($producto['categoria'] == 'Alimento') ? 'selected' : ''; ?>>Alimentos</option>
                                <option value="Accesorios" <?php echo ($producto['categoria'] == 'Accesorios') ? 'selected' : ''; ?>>Accesorios</option>
                                <option value="Higiene" <?php echo ($producto['categoria'] == 'Higiene') ? 'selected' : ''; ?>>Higiene</option>
                                <option value="Juguetes" <?php echo ($producto['categoria'] == 'Juguetes') ? 'selected' : ''; ?>>Juguetes</option>
                            </select>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion" class="required">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                required><?php echo set_value('descripcion', $producto['descripcion']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tipo" class="required">Tipo</label>
                            <select class="form-control" id="tipo" name="tipo" required></select>
                        </div>

                        <div class="form-group">
                            <label for="oferta">Oferta</label>
                            <select class="form-control" id="oferta" name="oferta">
                                <option value="0" <?php echo ($producto['oferta'] == 0) ? 'selected' : ''; ?>>Sin oferta
                                </option>
                                <option value="1" <?php echo ($producto['oferta'] == 1) ? 'selected' : ''; ?>>10% de
                                    descuento</option>
                                <option value="2" <?php echo ($producto['oferta'] == 2) ? 'selected' : ''; ?>>15% de
                                    descuento</option>
                                <option value="3" <?php echo ($producto['oferta'] == 3) ? 'selected' : ''; ?>>20% de
                                    descuento</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="imagen_url">URL de Imagen</label>
                            <input type="text" class="form-control" id="imagen_url" name="imagen_url"
                                value="<?php echo set_value('imagen_url', $producto['imagen_url']); ?>">
                            <?php if ($producto['imagen_url']): ?>
                                <img src="<?php echo $producto['imagen_url']; ?>" class="preview-image" alt="Vista previa">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-4">
                    <a href="<?php echo site_url('Welcome/adminProductos'); ?>"
                        class="btn btn-secondary mr-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- Scripts esenciales -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Opciones de productos para cada mascota
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

        // Función para actualizar las opciones de tipo según la mascota y categoría seleccionadas
        function actualizarTipos() {
            const mascota = document.getElementById('mascota').value;
            const categoria = document.getElementById('categoria').value;
            const tipoSelect = document.getElementById('tipo');
            const tipoActual = '<?php echo $producto['tipo']; ?>';

            tipoSelect.innerHTML = '';

            const opciones = (mascota === 'gato') ? opcionesGato[categoria] : opcionesPerro[categoria];

            if (opciones) {
                opciones.forEach(function (opcion) {
                    const optionElement = document.createElement('option');
                    optionElement.value = opcion;
                    optionElement.textContent = opcion;
                    optionElement.selected = (opcion === tipoActual);
                    tipoSelect.appendChild(optionElement);
                });
            }
        }

        // Función para validar la imagen URL
        function validarImagenUrl(url) {
    return url === '' || url.match(/https?:\/\/[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}\/(?:[^\s]*\.(?:jpeg|jpg|webp|gif|png|bmp|tiff|svg|ico))(?:[^\s]*)$/i) != null;
    }

        // Función para validar el formulario
        function validarFormulario() {
            const nombre = document.getElementById('nombre').value.trim();
            const descripcion = document.getElementById('descripcion').value.trim();
            const precio = parseFloat(document.getElementById('precio').value);
            const stock = parseInt(document.getElementById('stock').value);
            const imagenUrl = document.getElementById('imagen_url').value.trim();

            if (!nombre) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre del producto es requerido'
                });
                return false;
            }

            if (!descripcion) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La descripción del producto es requerida'
                });
                return false;
            }

            if (isNaN(precio) || precio <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El precio debe ser mayor a 0'
                });
                return false;
            }

            if (isNaN(stock) || stock < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El stock no puede ser negativo'
                });
                return false;
            }

            if (imagenUrl && !validarImagenUrl(imagenUrl)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La URL de la imagen debe ser válida (jpeg, jpg, gif, png)'
                });
                return false;
            }

            return true;
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function () {


            // Inicializar eventos para actualizar tipos
            document.getElementById('mascota').addEventListener('change', actualizarTipos);
            document.getElementById('categoria').addEventListener('change', actualizarTipos);

            // Inicializar tipos al cargar
            actualizarTipos();

            // Validación en tiempo real para el precio
            document.getElementById('precio').addEventListener('input', function () {
                if (this.value < 0) {
                    this.value = 0;
                }
            });

            // Validación en tiempo real para el stock
            document.getElementById('stock').addEventListener('input', function () {
                if (this.value < 0) {
                    this.value = 0;
                }
            });

            // Vista previa de imagen
            document.getElementById('imagen_url').addEventListener('input', function () {
                const previewImage = document.querySelector('.preview-image');
                if (previewImage) {
                    previewImage.src = this.value || '<?php echo $producto['imagen_url']; ?>';
                }
            });

            // Código para el envío del formulario
            document.getElementById('formEditarProducto').addEventListener('submit', function (e) {
                e.preventDefault();

                if (!validarFormulario()) {
                    return;
                }

                const formData = new FormData(this);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('La respuesta del servidor no fue exitosa');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: data.message,
                                confirmButtonColor: '#7AB730'
                            }).then(() => {
                                window.location.href = data.redirect;
                            });
                        } else {
                            throw new Error(data.message || 'Error al actualizar el producto');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message || 'Ha ocurrido un error al procesar la solicitud',
                            confirmButtonColor: '#7AB730'
                        });
                    });
            });

        });
    </script>
</body>

</html>