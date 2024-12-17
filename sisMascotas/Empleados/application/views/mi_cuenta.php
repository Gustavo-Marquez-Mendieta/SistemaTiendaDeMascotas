<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <style>
        /* Contenedor del formulario */
        form {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Contenedor para los campos del formulario */
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Contenedor para cada campo */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        /* Estilos para las etiquetas */
        form label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Estilos para los inputs */
        form input[type="text"],
        form input[type="password"],
        form input[type="number"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        /* Efecto hover en los inputs */
        form input[type="text"]:hover,
        form input[type="password"]:hover,
        form input[type="number"]:hover {
            border-color: #b0b0b0;
        }

        /* Efecto focus en los inputs */
        form input[type="text"]:focus,
        form input[type="password"]:focus,
        form input[type="number"]:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        /* Contenedor para el botón submit */
        .form-submit {
            grid-column: 1 / -1;
            margin-top: 1.5rem;
        }

        /* Estilo para el botón de submit */
        form input[type="submit"] {
            width: 100%;
            padding: 1rem;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Efecto hover en el botón */
        form input[type="submit"]:hover {
            background-color: #357ABD;
        }

        /* Mensajes de error y éxito */
        .error,
        .success {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            text-align: center;
        }

        .error {
            background-color: #FFE9E9;
            color: #D63031;
            border: 1px solid #FFB8B8;
        }

        .success {
            background-color: #E9FFE9;
            color: #27AE60;
            border: 1px solid #B8FFB8;
        }

        /* Título de la sección */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        /* Responsive para pantallas pequeñas */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            form {
                max-width: 100%;
                margin: 1rem;
                padding: 1rem;
            }
        }
    </style>

</head>

<body>
    <div id="header">
        <a href="<?= site_url('Welcome/empleado') ?>" id="logo"><img src="<?= base_url() ?>assets/images/logo.gif"
                alt="Logo"></a>
        <ul class="navigation">
            <li class="active"><a href="<?= site_url('Welcome/productos') ?>">Productos</a></li>
            <li><a href="<?= site_url('Welcome/ver_pedidos') ?>">Pedidos</a></li>
            <li><a href="<?= site_url('Welcome/carrito') ?>">Carrito</a></li>
            <?php if (isset($nombre)): ?>
                <li class="user-info">
                    <span class="user-name">Empleado <?= $nombre; ?></span>
                    <img src="<?= base_url() ?>assets/images/empleado.png" alt="User Icon">
                </li>
            <?php endif; ?>
            <li><a href="<?= site_url('Welcome/miCuenta') ?>">Mi cuenta</a></li>
            <li>
                <a href="<?php echo site_url('Welcome/cerrarsesion'); ?>" title="Cerrar Sesión" class="btn-exit-system">
                    <img src="<?= base_url() ?>assets/images/apagar.png" alt="Cerrar sesión" class="logout-img">
                </a>
            </li>
        </ul>
    </div>

    <div id="body">
        <?php if ($this->session->flashdata('error')): ?>
            <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <p class="success"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>

        <h2>Mi Cuenta</h2>

        <form action="<?php echo site_url('Welcome/actualizarCuenta'); ?>" method="post">
            <div class="form-row">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo set_value('nombre', $usuario->nombre); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label>Primer Apellido:</label>
                    <input type="text" name="primerApellido"
                        value="<?php echo set_value('primerApellido', $usuario->primerApellido); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Segundo Apellido:</label>
                    <input type="text" name="segundoApellido"
                        value="<?php echo set_value('segundoApellido', $usuario->segundoApellido); ?>" required>
                </div>
                <div class="form-group">
                    <label>Nombre de Usuario:</label>
                    <input type="text" name="nombre_usuario"
                        value="<?php echo set_value('nombre_usuario', $usuario->nombre_usuario); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="number" name="telefono"
                        value="<?php echo set_value('telefono', $usuario->telefono); ?>" required>
                </div>
                <div class="form-group">
                    <label>Dirección:</label>
                    <input type="text" name="direccion"
                        value="<?php echo set_value('direccion', $usuario->direccion); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Contraseña Actual:</label>
                    <input type="password" name="contrasena_actual" required>
                </div>
                <div class="form-group">
                    <label>Nueva Contraseña:</label>
                    <input type="password" name="nueva_contrasena" required>
                </div>
            </div>

            <div class="form-submit">
                <input type="submit" value="Actualizar">
            </div>
        </form>

    </div>
</body>

</html>