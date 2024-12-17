<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cuadro.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/formularios.css">
    <style>
        #body {
            display: flex;
            margin-top: 20px;
        }

        .container {
            flex: 3;
            padding: 10px;
            margin-top: 50px;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .user-info .user-name {
            margin-left: 10px;
        }

        .user-info img {
            margin-left: 10px;
            width: 40px;
            height: 40px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            margin-top: 50px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 200px;
            min-height: 300px;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f0f0f0;
            ;
        }

        .card-body {
            padding: 10px;
            flex: 1;
        }

        .sidebar {
            flex: 1;
            padding: 10px;
            border-left: 1px solid #ddd;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
        }

        .btn-icon i {
            margin-left: 5px;
        }

        .banner {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 42px;
            background: transparent;
        }

        .logout-img {
            width: 30px;
            height: 25px;
        }

        ul.navigation {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-start;
        }

        ul.navigation li {
            margin: 0;
            padding: 0;
        }

        ul.navigation li a {
            text-decoration: none;
            text-align: center;
            color: #333;
            padding: 0px;
            display: inline-block;
        }

        ul.navigation li a:hover {
            background-color: #f0f0f0;
        }

        .discount {
            color: red;
            font-weight: bold;
        }

        .original-price {
            text-decoration: line-through;
            color: #888;
        }

        /* Estilos para los diálogos */
        #ciDialog,
        #clienteDialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #ciDialog label,
        #clienteDialog label {
            display: block;
            margin-bottom: 10px;
        }

        #ciDialog input,
        #clienteDialog input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        #ciDialog button,
        #clienteDialog button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-action {
            display: inline-flex;
            gap: 5px;
        }

        .btn-action button {
            margin-right: 5px;
        }

        #ticketModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            width: 400px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #ticketModal .modal-content {
            margin-bottom: 10px;
        }

        #ticketModal button.close-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
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
    <div class="container">

        <form method="GET" action="<?= site_url('Welcome/ver_pedidos') ?>" class="pedido">
            <h1>Lista de Pedidos</h1>
            <div class="form-group">
                <label for="search_ci">Buscar por CI:</label>
                <input type="text" id="search_ci" name="search_ci" class="form-control" placeholder="Ingrese CI">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>CI del Cliente</th>
                        <th>Cantidad de Productos</th>
                        <th>Fecha del Pedido</th>
                        <th>Total del Pedido</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pedidos_agrupados = [];
                    foreach ($pedidos as $pedido) {
                        $pedido_id = $pedido['pedido_id'];
                        if (!isset($pedidos_agrupados[$pedido_id])) {
                            $pedidos_agrupados[$pedido_id] = [
                                'pedido_id' => $pedido_id,
                                'cliente_nombre' => $pedido['cliente_nombre'],
                                'cliente_ci' => $pedido['cliente_ci'],
                                'fecha_pedido' => $pedido['fecha_pedido'],
                                'estado' => $pedido['estado'],
                                'cantidad_total' => 0,
                                'total' => 0
                            ];
                        }
                        $pedidos_agrupados[$pedido_id]['cantidad_total'] += $pedido['cantidad'];
                        $pedidos_agrupados[$pedido_id]['total'] += $pedido['total'];
                    }

                    foreach ($pedidos_agrupados as $pedido): ?>
                        <tr>
                            <td><?= htmlspecialchars($pedido['cliente_nombre']); ?></td>
                            <td><?= htmlspecialchars($pedido['cliente_ci']); ?></td>
                            <td><?= htmlspecialchars($pedido['cantidad_total']); ?></td>
                            <td><?= htmlspecialchars(date('d-m-Y H:i:s', strtotime($pedido['fecha_pedido']))); ?></td>
                            <td><?= htmlspecialchars(number_format($pedido['total'], 2)); ?> Bs.</td>
                            <td><?= htmlspecialchars($pedido['estado']); ?></td>
                            <td class="btn-action">
                                <?php if (isset($pedido['pedido_id'])): ?>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmarCancelacion('<?= $pedido['pedido_id'] ?>')">
                                        Cancelar
                                    </button>
                                    <button type="button" class="btn btn-info btn-sm open-ticket-modal"
                                        data-id="<?= $pedido['pedido_id']; ?>">
                                        Ticket
                                    </button>
                                <?php else: ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>

        <div id="ticketModal" class="modal">
            <div class="modal-content">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <img src="<?= base_url() ?>assets/images/logo.gif" alt="Icono"
                        style="width: 150px; height: 50px; margin-right: 10px;">
                    <h2 style="text-align: center; flex-grow: 1;">Ticket del Pedido</h2>
                </div>

                <p id="modalDate"></p>
                <p id="clientName"></p>

                <div id="pedidoDetails">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Precio y Total</th>
                            </tr>
                        </thead>
                        <tbody id="pedidoDetailsBody">
                        </tbody>
                    </table>
                    <h3 id="totalGeneral"></h3>
                </div>
                <button onclick="generatePDFAndDeliver(event)" class="btn btn-success">Generar PDF y Entregar
                    Pedido</button>
                <button class="close-btn" onclick="closeTicketModal()">Cerrar</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Verificar si hay mensaje flash y mostrarlo con SweetAlert2
            const flashMessage = '<?= $this->session->flashdata('mensaje') ?>';
            if (flashMessage) {
                Swal.fire({
                    icon: flashMessage.includes('Error') ? 'error' : 'success',
                    title: flashMessage.includes('Error') ? 'Error' : '¡Éxito!',
                    text: flashMessage,
                    confirmButtonText: 'OK'
                });
            }

            document.querySelectorAll(".open-ticket-modal").forEach(button => {
                button.addEventListener("click", function () {
                    const pedidoId = this.getAttribute("data-id");
                    fetchPedidoDetails(pedidoId);
                });
            });
        });

        function fetchPedidoDetails(pedidoId) {
            fetch(`<?= site_url('Welcome/get_pedido_details/') ?>` + pedidoId)
                .then(response => response.json())
                .then(data => {
                    const currentDate = new Date();
                    document.getElementById("modalDate").textContent = `Fecha: ${currentDate.toLocaleDateString()} ${currentDate.toLocaleTimeString()}`;
                    document.getElementById("clientName").textContent = `Cliente: ${data.cliente_nombre}`;

                    const pedidoDetailsBody = document.getElementById("pedidoDetailsBody");
                    pedidoDetailsBody.innerHTML = "";

                    data.detalles.forEach(item => {
                        const precioConDescuento = parseFloat(item.precio_con_descuento);

                        const row = `
                <tr>
                    <td>${item.producto_nombre}</td>
                    <td>${item.cantidad}</td>
              
                    <td>Precio: ${parseFloat(item.precio).toFixed(2)} Bs. <br> Precio con descuento: ${precioConDescuento.toFixed(2)} Bs.</td>
                    <td>Total: ${parseFloat(item.total_item).toFixed(2)} Bs.</td>
                </tr>
                `;
                        pedidoDetailsBody.insertAdjacentHTML('beforeend', row);
                    });

                    document.getElementById("totalGeneral").textContent = `Total General: ${parseFloat(data.total_general).toFixed(2)} Bs.`;
                    document.getElementById("ticketModal").style.display = "block";

                    window.currentPedidoData = {
                        detalles: data.detalles,
                        totalGeneral: data.total_general,
                        clienteNombre: data.cliente_nombre,
                        fechaPedido: currentDate.toISOString(),
                        pedidoId: pedidoId
                    };
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al cargar los detalles del pedido'
                    });
                });
        }


        async function generatePDFAndDeliver(event) {
            event.preventDefault();

            if (!window.currentPedidoData) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No hay datos del pedido disponibles'
                });
                return;
            }

            try {
                // Primero mostrar confirmación
                const confirmResult = await Swal.fire({
                    title: '¿Entregar pedido?',
                    text: "¿Estás seguro de que deseas entregar este pedido?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, entregar',
                    cancelButtonText: 'Cancelar'
                });

                if (!confirmResult.isConfirmed) {
                    return;
                }

                // Mostrar loading
                Swal.fire({
                    title: 'Procesando...',
                    text: 'Generando PDF y entregando pedido',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Generar PDF
                const pdfResponse = await fetch('<?= site_url('Welcome/generar_pdf_tiket') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(window.currentPedidoData)
                });

                if (!pdfResponse.ok) {
                    throw new Error('Error al generar el PDF');
                }

                const blob = await pdfResponse.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'pedido.pdf';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                // Entregar pedido
                const deliverResponse = await fetch(`<?= site_url('Welcome/entregar_pedido/') ?>${window.currentPedidoData.pedidoId}`, {
                    method: 'POST'
                });

                if (!deliverResponse.ok) {
                    throw new Error('Error al entregar el pedido');
                }

                // Mostrar mensaje de éxito
                await Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Pedido entregado correctamente',
                    confirmButtonText: 'OK'
                });

                closeTicketModal();
                location.reload();

            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al procesar el pedido: ' + error.message
                });
            }
        }

        function confirmarCancelacion(pedidoId) {
            Swal.fire({
                title: '¿Cancelar pedido?',
                text: "¿Estás seguro de que deseas cancelar este pedido?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, mantener'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= site_url('Welcome/cancelar_pedido/') ?>${pedidoId}`;
                }
            });
        }

        function closeTicketModal() {
            document.getElementById("ticketModal").style.display = "none";
        }
    </script>
</body>

</html>