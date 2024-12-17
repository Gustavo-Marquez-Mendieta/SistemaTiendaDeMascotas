<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require_once APPPATH . 'third_party/fpdf/fpdf.php';

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Productos_model');
		$this->load->model('login_model');
		$this->load->model('Usuario_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Pedido_model');
		$this->load->model('Cliente_model');
		$this->load->model('Detalles_model');
		$this->load->model('Reportes_model');
		$this->load->model('Venta_model');
		$this->load->library('pdf');
		$this->load->model('Dashboard_model');

	}
	public function listapdf()
	{
		// Aquí va el código para generar el PDF usando la clase Pdf
		$this->pdf = new Pdf(); // Crea una nueva instancia de la clase Pdf
		// Continúa con tu lógica para generar el PDF
	}
	private function check_session_and_load_view($view, $data = array())
	{
		// Verifica si el usuario está autenticado
		if ($this->session->userdata('usuario')) {
			$data['nombre'] = $this->session->userdata('usuario');
			$data['id'] = $this->session->userdata('usuario_id');
			$this->load->view($view, $data);
		} else {
			redirect('Welcome/login');
		}
	}
	public function adminClientes()
	{
		$data['clientes'] = $this->Cliente_model->get_all_clients();
		$this->load->view('administrador/adminclientes', $data);
	}
	public function actualizar_cliente()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ci', 'CI', 'required');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('primerApellido', 'Primer Apellido', 'required');
		$this->form_validation->set_rules('celular', 'Celular', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Error al actualizar el cliente.');
		} else {
			$data = [
				'ci' => $this->input->post('ci'),
				'nombre' => $this->input->post('nombre'),
				'primerApellido' => $this->input->post('primerApellido'),
				'segundoApellido' => $this->input->post('segundoApellido'),
				'celular' => $this->input->post('celular')
			];
			$cliente_id = $this->input->post('cliente_id');

			$this->load->model('Cliente_model');
			if ($this->Cliente_model->actualizar_cliente($cliente_id, $data)) {
				$this->session->set_flashdata('success', 'Cliente actualizado correctamente.');
			} else {
				$this->session->set_flashdata('error', 'Error al actualizar el cliente.');
			}
		}

		redirect('Welcome/adminClientes');
	}

	public function dashboard()
	{
		if (!$this->session->userdata('usuario')) {
			redirect('Welcome/login');
		}

		$año_seleccionado = $this->input->get('año') ? $this->input->get('año') : date('Y');
		$data = array(
			'total_productos' => $this->Dashboard_model->getTotalProductos(),
			'total_ventas' => $this->Dashboard_model->getTotalVentas(),
			'total_clientes' => $this->Dashboard_model->getTotalClientes(),
			'ventas_mes' => $this->Dashboard_model->getVentasMesActual(), // Cambiado el nombre de la variable
			'productos_bajos_stock' => $this->Dashboard_model->getProductosBajosStock(),
			'ventas_recientes' => $this->Dashboard_model->getVentasRecientes(),
			'años_disponibles' => $this->Dashboard_model->getAñosDisponibles(),
			'ventas_por_mes' => $this->Dashboard_model->getVentasPorMesAño($año_seleccionado),
			'año_seleccionado' => $año_seleccionado,
			'productos_mas_vendidos' => $this->Dashboard_model->getProductosMasVendidos(),
			'clientes_por_total_compras' => $this->Dashboard_model->getClientesPorTotalCompras()
		);

		$this->load->view('administrador/dashboard', $data);
	}

	// Agregar este método para manejar la actualización del gráfico vía AJAX
	public function obtener_ventas_año()
	{
		$año = $this->input->get('año');
		$ventas = $this->Dashboard_model->getVentasPorMesAño($año);

		// Asegurar que la respuesta sea JSON
		header('Content-Type: application/json');
		echo json_encode($ventas);
	}
	// Reportes.php (Controlador)
	public function reporte_usuario()
	{
		$usuario_id = $this->input->post('usuario_id');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$data['usuarios'] = $this->Usuario_model->get_all_usuarios(); // Para mantener el selector de usuarios
		$data['reporte'] = $this->Reportes_model->get_reporte($usuario_id, $fecha_inicio, $fecha_fin);

		$this->load->view('reportes/reporte_usuario', $data);
	}
	public function generar_pdf()
	{
		$empleados = $this->input->post('empleado');
		$clientes = $this->input->post('cliente');
		$totales = $this->input->post('total');
		$estados = $this->input->post('estado');
		$fechas = $this->input->post('fecha');

		if (!$empleados || !$clientes || !$totales || !$estados || !$fechas) {
			redirect('welcome');
			return;
		}

		// Preparar datos para el análisis
		$data = [];
		$total_ventas = 0;
		$total_pendientes = 0;
		$total_cancelados = 0;
		$total_entregados = 0;
		$ventas_por_empleado = [];
		$ventas_por_cliente = [];

		for ($i = 0; $i < count($empleados); $i++) {
			$total = (float) $totales[$i];
			$data[] = [
				'empleado' => $empleados[$i],
				'cliente' => $clientes[$i],
				'total' => $total,
				'estado' => $estados[$i],
				'fecha' => $fechas[$i],
			];

			// Calcular totales por estado
			switch ($estados[$i]) {
				case 'Pendiente':
					$total_pendientes += $total;
					break;
				case 'Cancelado':
					$total_cancelados += $total;
					break;
				case 'Entregado':
					$total_entregados += $total;
					break;
			}

			// Acumular ventas por empleado
			if (!isset($ventas_por_empleado[$empleados[$i]])) {
				$ventas_por_empleado[$empleados[$i]] = ['total' => 0, 'count' => 0];
			}
			$ventas_por_empleado[$empleados[$i]]['total'] += $total;
			$ventas_por_empleado[$empleados[$i]]['count']++;

			$total_ventas += $total;
		}

		// Calcular métricas adicionales
		$promedio_venta = $total_ventas / count($data);
		$fecha_inicio = min($fechas);
		$fecha_fin = max($fechas);

		// Crear el PDF
		$this->load->library('pdf');
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();

		// Logo y título
		$pdf->Image(FCPATH . 'assets/images/logo1.jpg', 10, 10, 30);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 30, utf8_decode('Reporte Detallado de Ventas por Usuario'), 0, 1, 'C');

		// Información del período
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 6, utf8_decode('Período del Reporte: ' . date('d/m/Y', strtotime($fecha_inicio)) . ' al ' . date('d/m/Y', strtotime($fecha_fin))), 0, 1, 'R');

		// Marco para el resumen
		$pdf->SetFillColor(240, 240, 240);
		$pdf->Rect(10, 45, 190, 50, 'DF');

		// Resumen Financiero (dentro del marco)
		$pdf->SetXY(15, 48);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(180, 8, utf8_decode('Resumen Financiero'), 0, 1);

		$pdf->SetFont('Arial', '', 10);
		$y = $pdf->GetY();

		// Columna izquierda
		$pdf->SetXY(15, $y);
		$pdf->Cell(90, 6, utf8_decode('Total de Ventas: Bs. ' . number_format($total_ventas, 2)), 0, 0);
		// Columna derecha
		$pdf->SetXY(105, $y);
		$pdf->Cell(90, 6, utf8_decode('Promedio por Venta: Bs. ' . number_format($promedio_venta, 2)), 0, 1);

		// Segunda fila
		$y = $pdf->GetY();
		$pdf->SetXY(15, $y);
		$pdf->Cell(90, 6, utf8_decode('Ventas Entregadas: Bs. ' . number_format($total_entregados, 2)), 0, 0);
		$pdf->SetXY(105, $y);
		$pdf->Cell(90, 6, utf8_decode('Ventas Pendientes: Bs. ' . number_format($total_pendientes, 2)), 0, 1);

		// Tercera fila
		$y = $pdf->GetY();
		$pdf->SetXY(15, $y);
		$pdf->Cell(90, 6, utf8_decode('Ventas Canceladas: Bs. ' . number_format($total_cancelados, 2)), 0, 0);
		$pdf->SetXY(105, $y);
		$pdf->Cell(90, 6, utf8_decode('Total Transacciones: ' . count($data)), 0, 1);

		// Espacio después del marco
		$pdf->Ln(10);

		// Tabla de ventas
		$pdf->SetFont('Arial', 'B', 10);

		// Configurar colores para la tabla
		$pdf->SetFillColor(51, 122, 183);
		$pdf->SetTextColor(255);

		// Encabezados de la tabla
		$pdf->Cell(45, 8, 'Empleado', 1, 0, 'C', true);
		$pdf->Cell(45, 8, 'Cliente', 1, 0, 'C', true);
		$pdf->Cell(30, 8, 'Total (Bs.)', 1, 0, 'C', true);
		$pdf->Cell(35, 8, 'Estado', 1, 0, 'C', true);
		$pdf->Cell(35, 8, 'Fecha', 1, 1, 'C', true);

		// Restablecer colores para el contenido
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial', '', 9);

		// Contenido de la tabla
		foreach ($data as $row) {
			// Definir color de fondo según el estado
			switch ($row['estado']) {
				case 'Entregado':
					$pdf->SetFillColor(198, 239, 206);
					break;
				case 'Pendiente':
					$pdf->SetFillColor(255, 235, 156);
					break;
				case 'Cancelado':
					$pdf->SetFillColor(255, 199, 206);
					break;
			}

			$pdf->Cell(45, 7, utf8_decode($row['empleado']), 1, 0, 'L', true);
			$pdf->Cell(45, 7, utf8_decode($row['cliente']), 1, 0, 'L', true);
			$pdf->Cell(30, 7, number_format($row['total'], 2), 1, 0, 'R', true);
			$pdf->Cell(35, 7, $row['estado'], 1, 0, 'C', true);
			$pdf->Cell(35, 7, date('d/m/Y', strtotime($row['fecha'])), 1, 1, 'C', true);
		}

		// Pie de página con resumen
		$pdf->SetFillColor(245, 245, 245);
		$pdf->Rect(10, $pdf->GetY() + 5, 190, 25, 'DF');

		$pdf->SetY($pdf->GetY() + 8);
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Cell(0, 5, utf8_decode('Información Adicional:'), 0, 1, 'L');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(0, 5, utf8_decode('* Este reporte fue generado el ' . date('d/m/Y H:i:s')), 0, 1, 'L');
		$pdf->Cell(0, 5, utf8_decode('* Los montos incluyen impuestos y están expresados en Bolivianos (Bs.)'), 0, 1, 'L');

		$pdf->Output('D', 'reporte_ventas_usuario.pdf');
	}



	private function get_estado($estado)
	{
		switch ($estado) {
			case 1:
				return 'Pendiente';
			case 2:
				return 'Cancelado';
			case 3:
				return 'Entregado';
			default:
				return 'Desconocido';
		}
	}



	public function reporte_por_categoria()
	{
		$producto_id = $this->input->post('producto_id');
		$categoria = $this->input->post('categoria');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$data['categorias'] = $this->Productos_model->get_all_categoria();
		$data['productos'] = $this->Productos_model->get_all_nombres();
		$data['reporte'] = $this->Reportes_model->get_reporte_productos($producto_id, $categoria, $fecha_inicio, $fecha_fin);

		$data['producto_id'] = $producto_id;
		$data['categoria'] = $categoria;

		$this->load->view('reportes/reporte_categoria', $data);
	}

	public function generar_pdf_categoria()
	{
		// Obtener los datos del formulario
		$categorias = $this->input->post('categoria');
		$productos = $this->input->post('producto');
		$precios = $this->input->post('precio');
		$stocks = $this->input->post('stock');
		$cantidades_vendidas = $this->input->post('cantidad_vendida');
		$totales_vendidos = $this->input->post('total_vendido');

		if (!$categorias || empty($categorias)) {
			redirect('Welcome/reporte_por_categoria');
			return;
		}

		// Crear el PDF
		$this->load->library('pdf');
		$pdf = new PDF();
		$pdf->AddPage();

		// Agregar logo
		$pdf->Image(FCPATH . 'assets/images/logo1.jpg', 10, 10, 30);

		// Título del reporte
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 30, utf8_decode('Reporte por Categoría'), 0, 1, 'C');

		// Fecha del reporte
		$pdf->SetFont('Arial', 'I', 10);
		$pdf->Cell(0, 10, utf8_decode('Fecha de generación: ' . date('d/m/Y H:i')), 0, 1, 'R');
		$pdf->Ln(5);

		// Configuración de la tabla
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->SetFillColor(41, 128, 185); // Azul para encabezados
		$pdf->SetTextColor(255, 255, 255); // Texto blanco

		// Definir anchos de columnas
		$anchos = array(40, 50, 25, 20, 25, 30);

		// Encabezados de la tabla
		$pdf->Cell($anchos[0], 8, utf8_decode('Categoría'), 1, 0, 'C', true);
		$pdf->Cell($anchos[1], 8, utf8_decode('Producto'), 1, 0, 'C', true);
		$pdf->Cell($anchos[2], 8, utf8_decode('Precio (Bs.)'), 1, 0, 'C', true);
		$pdf->Cell($anchos[3], 8, utf8_decode('Stock'), 1, 0, 'C', true);
		$pdf->Cell($anchos[4], 8, utf8_decode('Cant. Vendida'), 1, 0, 'C', true);
		$pdf->Cell($anchos[5], 8, utf8_decode('Total (Bs.)'), 1, 1, 'C', true);

		// Restaurar color de texto para el contenido
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Arial', '', 8);

		// Variables para totales
		$total_general = 0;
		$total_vendido = 0;

		// Contenido de la tabla
		$fill = false;
		for ($i = 0; $i < count($categorias); $i++) {
			$fill = !$fill;
			$pdf->SetFillColor(245, 245, 245);

			$pdf->Cell($anchos[0], 7, utf8_decode($categorias[$i]), 1, 0, 'L', $fill);
			$pdf->Cell($anchos[1], 7, utf8_decode($productos[$i]), 1, 0, 'L', $fill);
			$pdf->Cell($anchos[2], 7, number_format(floatval($precios[$i]), 2), 1, 0, 'R', $fill);
			$pdf->Cell($anchos[3], 7, $stocks[$i], 1, 0, 'C', $fill);
			$pdf->Cell($anchos[4], 7, $cantidades_vendidas[$i], 1, 0, 'C', $fill);
			$pdf->Cell($anchos[5], 7, number_format(floatval($totales_vendidos[$i]), 2), 1, 1, 'R', $fill);

			$total_general += floatval($totales_vendidos[$i]);
			$total_vendido += intval($cantidades_vendidas[$i]);
		}

		// Totales
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->SetFillColor(41, 128, 185);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(array_sum(array_slice($anchos, 0, 4)), 8, utf8_decode('TOTALES'), 1, 0, 'R', true);
		$pdf->Cell($anchos[4], 8, $total_vendido, 1, 0, 'C', true);
		$pdf->Cell($anchos[5], 8, number_format($total_general, 2), 1, 1, 'R', true);

		// Resumen
		$pdf->Ln(10);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(0, 8, utf8_decode('Resumen del Reporte:'), 0, 1);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 6, utf8_decode('* Total de Productos Vendidos: ' . $total_vendido), 0, 1);
		$pdf->Cell(0, 6, utf8_decode('* Monto Total de Ventas: Bs. ' . number_format($total_general, 2)), 0, 1);

		// Nombre del archivo
		$nombre_archivo = utf8_decode('reporte_por_categoria.pdf');
		$pdf->Output('D', $nombre_archivo);
	}


	// En el controlador Welcome.php
	public function generar_pdf_producto()
	{
		$reporte = $this->session->userdata('ultimo_reporte');
		$historial = $this->session->userdata('ultimo_historial');

		if (!$reporte || !$historial) {
			redirect('Welcome/reporte_por_producto');
			return;
		}

		$this->load->library('pdf');
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();

		// Encabezado con logo
		$pdf->Image(FCPATH . 'assets/images/logo1.jpg', 10, 10, 30);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 30, utf8_decode('Reporte Detallado de Producto'), 0, 1, 'C');

		// Información del período
		$pdf->SetFont('Arial', '', 10);
		$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : 'Todas';
		$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : 'Todas';
		$pdf->Cell(0, 6, utf8_decode('Período: ' . $fecha_inicio . ' al ' . $fecha_fin), 0, 1, 'R');

		// Datos del producto
		$pdf->SetFillColor(240, 240, 240);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 10, utf8_decode('Detalles del Producto'), 0, 1, 'L');
		$pdf->SetFont('Arial', '', 10);

		// Información básica del producto
		$pdf->Cell(60, 6, utf8_decode('Producto: ' . $reporte[0]->producto), 0, 0);
		//Saltar de línea
		$pdf->Ln(6);
		$pdf->Cell(60, 6, utf8_decode('Categoría: ' . $reporte[0]->categoria), 0, 0);
		$pdf->Cell(70, 6, utf8_decode('Stock Actual: ' . $reporte[0]->stock_actual), 0, 1);

		// Métricas de resumen
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 10, utf8_decode('Métricas de Ventas'), 0, 1, 'L');

		// Crear una tabla de métricas
		$pdf->SetFont('Arial', '', 10);
		$metricas = array(
			array('Total Ventas', $reporte[0]->total_ventas),
			array('Unidades Vendidas', $reporte[0]->unidades_vendidas),
			array('Ingresos Totales', 'Bs. ' . number_format($reporte[0]->ingresos_totales, 2)),
			array('Clientes Únicos', $reporte[0]->clientes_unicos),
			array('Promedio por Venta', number_format($reporte[0]->promedio_unidades_por_venta, 2) . ' unidades')
		);

		foreach ($metricas as $metrica) {
			$pdf->Cell(95, 6, utf8_decode($metrica[0]), 1, 0);
			$pdf->Cell(95, 6, utf8_decode($metrica[1]), 1, 1, 'R');
		}

		// Historial de ventas
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 10, utf8_decode('Historial de Ventas'), 0, 1, 'L');

		// Encabezados de la tabla
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Cell(30, 7, 'Fecha', 1, 0, 'C', true);
		$pdf->Cell(50, 7, 'Cliente', 1, 0, 'C', true);
		$pdf->Cell(25, 7, 'Cantidad', 1, 0, 'C', true);
		$pdf->Cell(30, 7, 'Precio Unit.', 1, 0, 'C', true);
		$pdf->Cell(30, 7, 'Total', 1, 0, 'C', true);
		$pdf->Cell(25, 7, 'Estado', 1, 1, 'C', true);

		// Datos de la tabla
		$pdf->SetFont('Arial', '', 8);
		foreach ($historial as $venta) {
			$pdf->Cell(30, 6, date('d/m/Y', strtotime($venta->fechaVenta)), 1, 0);
			$pdf->Cell(50, 6, utf8_decode($venta->cliente), 1, 0);
			$pdf->Cell(25, 6, $venta->cantidad, 1, 0, 'C');
			$pdf->Cell(30, 6, 'Bs. ' . number_format($venta->precio, 2), 1, 0, 'R');
			$pdf->Cell(30, 6, 'Bs. ' . number_format($venta->total, 2), 1, 0, 'R');
			$pdf->Cell(25, 6, $venta->estado_venta, 1, 1, 'C');
		}

		$pdf->Output('D', 'Reporte_Producto.pdf');
	}
	public function reporte_por_producto()
	{
		$producto_id = $this->input->post('producto_id');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$data['productos'] = $this->Productos_model->get_all_nombres();
		$data['producto_id'] = $producto_id;

		// Obtener métricas detalladas del producto
		$data['reporte'] = $this->Reportes_model->get_reporte_detallado_producto(
			$producto_id,
			$fecha_inicio,
			$fecha_fin
		);

		// Obtener historial de ventas con detalles
		$data['historial_ventas'] = $this->Reportes_model->get_historial_ventas_detallado(
			$producto_id,
			$fecha_inicio,
			$fecha_fin
		);

		$this->load->view('reportes/reporte_productos', $data);
	}
	// public function generar_pdf_producto()
	// {
	// 	// Recibir los datos enviados desde la vista (formulario)
	// 	$productos = $this->input->post('producto');
	// 	$categorias = $this->input->post('categoria');
	// 	$precios = $this->input->post('precio');
	// 	$stocks = $this->input->post('stock');
	// 	$cantidades_vendidas = $this->input->post('cantidad_vendida');
	// 	$totales_vendidos = $this->input->post('total_vendido');

	// 	// Verificar que todos los datos necesarios estén presentes
	// 	if (!$productos || !$categorias || !$precios || !$stocks || !$cantidades_vendidas || !$totales_vendidos) {
	// 		redirect('Welcome/reporte_por_producto');
	// 		return;
	// 	}

	// 	// Preparar los datos para el PDF
	// 	$data = [];
	// 	for ($i = 0; $i < count($productos); $i++) {
	// 		$total_vendido = (float) str_replace(',', '', $totales_vendidos[$i]); // Eliminar comas y convertir a float
	// 		$data[] = [
	// 			'producto' => $productos[$i],
	// 			'categoria' => $categorias[$i],
	// 			'precio' => (float) $precios[$i],
	// 			'stock' => (int) $stocks[$i],
	// 			'cantidad_vendida' => (int) $cantidades_vendidas[$i],
	// 			'total_vendido' => $total_vendido,
	// 		];
	// 	}

	// 	// Generar el PDF
	// 	$this->load->library('pdf');
	// 	$pdf = new PDF();
	// 	$pdf->AddPage();
	// 	$pdf->SetFont('Arial', 'B', 14);
	// 	$pdf->Cell(0, 10, utf8_decode('Reporte por Producto'), 0, 1, 'C');
	// 	$pdf->Ln(5);

	// 	// Establecer anchos de columnas - ajustados para dar más espacio al nombre del producto
	// 	$pdf->SetFont('Arial', 'B', 10);
	// 	$columnWidths = [85, 20, 25, 15, 25, 25];

	// 	// Encabezados de columnas
	// 	$pdf->Cell($columnWidths[0], 10, utf8_decode('Producto'), 1, 0, 'C');
	// 	$pdf->Cell($columnWidths[1], 10, utf8_decode('Categoría'), 1, 0, 'C');
	// 	$pdf->Cell($columnWidths[2], 10, utf8_decode('Precio'), 1, 0, 'C');
	// 	$pdf->Cell($columnWidths[3], 10, utf8_decode('Stock'), 1, 0, 'C');
	// 	$pdf->Cell($columnWidths[4], 10, utf8_decode('Cant. Venta'), 1, 0, 'C');
	// 	$pdf->Cell($columnWidths[5], 10, utf8_decode('Total Venta'), 1, 1, 'C');

	// 	// Rellenar filas con datos
	// 	$pdf->SetFont('Arial', '', 10);
	// 	foreach ($data as $item) {
	// 		// Ajustar producto con MultiCell para salto de línea
	// 		$x = $pdf->GetX();
	// 		$y = $pdf->GetY();
	// 		$pdf->MultiCell($columnWidths[0], 10, utf8_decode($item['producto']), 1, 'L');
	// 		$pdf->SetXY($x + $columnWidths[0], $y);

	// 		$pdf->Cell($columnWidths[1], 10, utf8_decode($item['categoria']), 1, 0, 'L');
	// 		$pdf->Cell($columnWidths[2], 10, 'Bs. ' . number_format($item['precio'], 2), 1, 0, 'R');
	// 		$pdf->Cell($columnWidths[3], 10, $item['stock'], 1, 0, 'C');
	// 		$pdf->Cell($columnWidths[4], 10, $item['cantidad_vendida'], 1, 0, 'C');
	// 		$pdf->Cell($columnWidths[5], 10, 'Bs. ' . number_format($item['total_vendido'], 2), 1, 1, 'R');
	// 	}

	// 	$pdf->Output('D', 'reporte_por_producto.pdf');
	// }


	// Reportes.php (Controlador)
	public function reporte_producto_mas_vendido()
	{
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$ventas_mensuales = $this->Reportes_model->get_monthly_sales($fecha_inicio, $fecha_fin);

		// Preparar los datos para el gráfico
		$meses = [];
		$ventasTotales = [];

		foreach ($ventas_mensuales as $venta) {
			$meses[] = $venta['mes']; // Formato: 'YYYY-MM'
			$ventasTotales[] = $venta['total_vendido'];
		}

		$data['meses'] = $meses;
		$data['ventasTotales'] = $ventasTotales;

		$this->load->view('reportes/reporte_producto_mas_vendido', $data);
	}
	public function ventas_totales()
	{
		$this->load->model('Venta_model');
		$ventas_data = $this->Venta_model->get_totales_ventas_por_mes();
		$productos_vendidos = $this->Venta_model->get_productos_vendidos();

		$todos_los_meses = [];
		$anio_actual = date('Y');
		for ($i = 1; $i <= 12; $i++) {
			$mes = str_pad($i, 2, '0', STR_PAD_LEFT);
			$todos_los_meses["$anio_actual-$mes"] = 0;
		}

		foreach ($ventas_data as $venta) {
			$todos_los_meses[$venta->mes] = (float) $venta->total_ventas;
		}

		$data['ventas_por_mes'] = $todos_los_meses;
		$data['productos_vendidos'] = $productos_vendidos;
		$this->load->view('reportes/reporte_producto_mas_vendido', $data);
	}

	public function cerrarsesion()
	{
		$this->session->sess_destroy();
		redirect('Welcome/index');
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function contacto()
	{
		$this->load->view('contactenos');
	}

	public function admin()
	{
		$data['usuarios'] = $this->Usuario_model->obtenerUsuarios();
		$this->load->view('administrador/admin', $data);
	}
	public function activar_usuario($id)
	{
		$this->load->model('Usuario_model');
		if ($this->Usuario_model->activarUsuario($id)) {
			$this->session->set_flashdata('success', 'Cuenta activada con éxito.');
		} else {
			$this->session->set_flashdata('error', 'No se pudo activar la cuenta.');
		}
		redirect('Welcome/admin');
	}

	public function nuevoUsuario()
	{
		$this->load->view('administrador/nuevoUsuario');
	}
	public function eliminar_usuario($id)
	{
		$data = array('estadoUsuario' => 0);
		$this->db->where('id', $id);
		$resultado = $this->db->update('usuario', $data);

		if ($resultado) {
			$this->session->set_flashdata('success', 'Usuario desactivado correctamente.');
		} else {
			$this->session->set_flashdata('error', 'Error al desactivar el usuario.');
		}
		redirect('Welcome/admin');
	}


	public function empleado()
	{
		$this->check_session_and_load_view('welcome_message');
	}


	// Funciones para Gatos
	public function TiendaGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_gatos();
		$this->check_session_and_load_view('Gatos/TiendaGatos', $data);
	}
	public function AccesoriosGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_gatos();
		$this->check_session_and_load_view('Gatos/Accesorios', $data);
	}
	public function Casas_Camas_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->obtener_camas_gatos();
		$this->check_session_and_load_view('Gatos/Camas', $data);
	}
	public function Torres_Rascadores_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->obtener_Torres_Rascadores_Gatos();
		$this->check_session_and_load_view('Gatos/Torres_Rascadores', $data);
	}
	public function Transportadores_Jaulas_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Transportadores_Jaulas_Gatos();
		$this->check_session_and_load_view('Gatos/Transportadores_Jaulas', $data);
	}
	public function Platos_Dispensadores_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Platos_Dispensadores_Gatos();
		$this->check_session_and_load_view('Gatos/Platos_Dispensadores', $data);
	}
	public function Collares_Percheras_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Collares_Percheras_Gatos();
		$this->check_session_and_load_view('Gatos/Collares_Percheras', $data);
	}
	public function AlimentoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_gatos();
		$this->check_session_and_load_view('Gatos/Alimento', $data);
	}
	public function filtrarProductos()
	{
		// Obtener los parámetros de la URL
		$mascota = $this->input->get('mascota');
		$categoria = $this->input->get('categoria');

		// Cargar el modelo de productos
		$this->load->model('Productos_model');

		// Obtener los productos filtrados
		$productos = $this->Productos_model->obtenerProductosFiltrados($mascota, $categoria);

		// Pasar los datos a la vista
		$data['productos'] = $productos;

		// Cargar la vista con los productos filtrados
		$this->load->view('administrador/adminProductos', $data); // Reemplaza 'tu_vista' con el nombre real de tu vista
	}

	public function AlimentoHumedoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_humedo_gatos();
		$this->check_session_and_load_view('Gatos/Alimento_humedo', $data);
	}
	public function AlimentoSecoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_seco_gatos();
		$this->check_session_and_load_view('Gatos/Alimento_seco', $data);
	}
	public function AlimentoSecoEspecialGato()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_alimento_seco_especial();
		$this->check_session_and_load_view('Gatos/AlimentoSecoEspecial', $data);
	}
	public function Snacks_Premios_Gato()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_Snacks_Premios();
		$this->check_session_and_load_view('Gatos/Snacks_Premios', $data);
	}
	public function JugueteGatos()
	{
		$this->load->model('Productos_model');
		$productos = $this->Productos_model->obtener_juguetes_gatos();

		// Calcular descuentos para cada producto
		foreach ($productos as $producto) {
			$descuento = 0;
			switch ($producto->oferta) {
				case 1:
					$descuento = 0.10; // 10%
					break;
				case 2:
					$descuento = 0.15; // 15%
					break;
				case 3:
					$descuento = 0.20; // 20%
					break;
			}
			$producto->descuento = $descuento;
			$producto->precioConDescuento = $producto->precio - ($producto->precio * $descuento);
		}

		$data['productos'] = $productos;
		$this->load->view('Gatos/Juguetes', $data);
	}
	public function Catnip_Gatos()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Catnip_Gatos();
		$this->check_session_and_load_view('Gatos/Catnip_Gatos', $data);
	}
	public function Juguetes_Gatos()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Juguetes_Gatos();
		$this->check_session_and_load_view('Gatos/Juguete', $data);
	}
	public function HigieneGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_gatos();
		$this->check_session_and_load_view('Gatos/Higiene', $data);
	}
	public function Arenas_Sanitarias_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Arenas_Sanitarias_gatos();
		$this->check_session_and_load_view('Gatos/Arenas_Sanitarias', $data);
	}
	public function Areneros_Palas_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Areneros_Palas_Gatos();
		$this->check_session_and_load_view('Gatos/Areneros_Palas', $data);
	}
	public function Limpieza_Hogar_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Limpieza_Hogar_Gatos();
		$this->check_session_and_load_view('Gatos/Limpieza_Hogar', $data);
	}
	public function Shampoo_Aseo_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Shampoo_Aseo_Gatos();
		$this->check_session_and_load_view('Gatos/Shampoo_Aseo', $data);
	}
	public function Peines_Cepillos_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Peines_Cepillos_Gatos();
		$this->check_session_and_load_view('Gatos/Peines_Cepillos', $data);
	}

	// Funciones para Perros
	public function TiendaPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros();
		$this->check_session_and_load_view('Perros/TiendaPerros', $data);
	}
	public function AlimentoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_perros();
		$this->check_session_and_load_view('Perros/Alimento', $data);
	}
	public function AlimentoSecoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_seco();
		$this->check_session_and_load_view('Perros/Alimento_Seco', $data);
	}
	public function AlimentoHumedoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_humedo();
		$this->check_session_and_load_view('Perros/Alimento_Seco', $data);
	}
	public function AlimentoSecoEspecialPerro()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->AlimentoSecoEspecialPerro();
		$this->check_session_and_load_view('Perros/AlimentoSecoEspecial', $data);
	}
	public function Snacks_Premios_Perro()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_Snacks_Premios_Perros();
		$this->check_session_and_load_view('Perros/Snacks_Premios', $data);
	}
	public function AccesoriosPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_perros();
		$this->check_session_and_load_view('Perros/Accesorios', $data);
	}
	public function Limpieza_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Limpieza_Perros();
		$this->check_session_and_load_view('Perros/Limpieza', $data);
	}
	public function Casas_Camas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Casas_Camas_Perros();
		$this->check_session_and_load_view('Perros/Casas_Camas', $data);
	}
	public function Collares_Correas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Collares_Correas_Perros();
		$this->check_session_and_load_view('Perros/Collares_Correas', $data);
	}

	public function Platos_Dispensadores_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Platos_Dispensadores_Perros();
		$this->check_session_and_load_view('Perros/Platos_Dispensadores', $data);
	}
	public function Ropa_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Ropa_Perros();
		$this->check_session_and_load_view('Perros/Ropa', $data);
	}
	public function Transportadores_Jaulas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Transportadores_Jaulas_Perros();
		$this->check_session_and_load_view('Perros/Transportadores_Jaulas', $data);
	}
	public function JuguetesPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_juguetes_perros();
		$this->check_session_and_load_view('Perros/Juguetes', $data);
	}
	public function Jueguetes_Goma_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Jueguetes_Goma_Perros();
		$this->check_session_and_load_view('Perros/Jueguetes_Goma', $data);
	}
	public function Pelotas_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Pelotas_Perros();
		$this->check_session_and_load_view('Perros/Pelotas', $data);
	}
	public function Peluches_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Peluches_Perros();
		$this->check_session_and_load_view('Perros/Peluches', $data);
	}
	public function HigienePerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_perros();
		$this->check_session_and_load_view('Perros/Higiene', $data);
	}
	public function Bolsas_Dispensadores_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Bolsas_Dispensadores_Perros();
		$this->check_session_and_load_view('Perros/Bolsas_Dispensadores', $data);
	}

	public function Cuidado_uñas_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Cuidado_uñas_Perros();
		$this->check_session_and_load_view('Perros/Cuidado_uñas', $data);
	}
	public function Cuidado_Dental_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Cuidado_Dental_Perros();
		$this->check_session_and_load_view('Perros/Cuidado_Dental', $data);
	}
	public function Peines_Cepillos_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Peines_Cepillos_Perros();
		$this->check_session_and_load_view('Perros/Peines_Cepillos', $data);
	}
	public function Shampoo_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Shampoo_Perros();
		$this->check_session_and_load_view('Perros/Shampoo', $data);
	}
	public function productos()
	{
		$lista = $this->login_model->listaproductos();
		$data['productos'] = $lista;
		$this->check_session_and_load_view('producto', $data);
	}
	public function productos_gatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_gatos(); // Filtrar productos de gatos
		$this->load->view('productos_gatos', $data);
	}
	public function login()
	{
		$this->load->view('login');
	}

	public function validarusuariobd()
	{
		$user = $this->input->post('user');
		$password = $this->input->post('password');

		if ($this->login_model->validarusuario($user, $password)) {
			log_message('debug', 'Usuario validado correctamente: ' . $user);

			$usuario = $this->login_model->obtenerUsuarioPorEmail($user);
			log_message('debug', 'Datos del usuario obtenidos: ' . print_r($usuario, true));

			// Verifica el estado del usuario
			if ($usuario->estadoUsuario == 0) {
				log_message('debug', 'Cuenta suspendida para el usuario: ' . $user);
				$data['error'] = 'La cuenta está suspendida';
				$this->load->view('login', $data);
				return;
			}

			// Si el estado es 1, procede con la sesión
			$this->session->set_userdata('usuario_id', $usuario->id);
			$this->session->set_userdata('usuario', $usuario->nombre);

			if (trim($user) == 'roly@gmail.com') {
				log_message('debug', 'Usuario admin, redirigiendo a admin');
				redirect('Welcome/admin');
			} else {
				log_message('debug', 'Usuario normal, redirigiendo a empleado');
				redirect('Welcome/empleado');
			}
		} else {
			log_message('debug', 'Usuario o contraseña incorrecta');
			$data['error'] = 'Usuario o contraseña incorrecta';
			$this->load->view('login', $data);
		}
	}


	public function miCuenta()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		if (!$usuario_id) {
			redirect('Welcome/login');
		}

		$data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);
		$this->check_session_and_load_view('mi_cuenta', $data);
	}

	public function actualizarCuenta()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		if (!$usuario_id) {
			redirect('Welcome/login');
		}
		$this->load->model('Usuario_model');
		$usuario = $this->Usuario_model->get_usuario($usuario_id);
		$contrasena_actual = $this->input->post('contrasena_actual');
		$nueva_contrasena = $this->input->post('nueva_contrasena');
		if (!password_verify($contrasena_actual, $usuario->contrasena)) {
			$this->session->set_flashdata('error', 'La contraseña actual no es válida.');
			redirect('Welcome/miCuenta');
		}
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'nombre_usuario' => $this->input->post('nombre_usuario'),
			'telefono' => $this->input->post('telefono'),
			'direccion' => $this->input->post('direccion'),
			'fechaActualizacionUsuario' => date('Y-m-d H:i:s')
		);

		if (!empty($nueva_contrasena)) {
			$data['contrasena'] = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
			$this->load->library('email');
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 587,
				'smtp_user' => 'lazaro.roly.407@gmail.com',
				'smtp_pass' => 'ipbc bxyr hohu pqvr',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE,
				'newline' => "\r\n",
				'smtp_crypto' => 'tls'
			);
			$this->email->initialize($config);
			$this->email->from('tu_email@gmail.com', 'Roly Lazaro');
			$this->email->to($usuario->email);
			$this->email->cc('lazaro.roly.407@gmail.com');
			$this->email->subject('Cambio de Contraseña');
			$this->email->message('La contraseña ha sido cambiada exitosamente. La nueva contraseña es: ' . $nueva_contrasena . ' del usuario: ' . $usuario->email);
			if ($this->email->send()) {
				$this->session->set_flashdata('success', 'Se ha enviado un correo con la nueva contraseña.');
			} else {
				$this->session->set_flashdata('error', 'Correo no enviado: ' . $this->email->print_debugger());
			}
		}
		if ($this->Usuario_model->update_usuario($usuario_id, $data)) {
			$this->session->set_flashdata('success', 'Cuenta actualizada con éxito.');
			redirect('Welcome/miCuenta');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la cuenta.');
			redirect('Welcome/miCuenta');
		}
	}




	// public function agregarProducto()
	// {
	// 	$this->load->model('productos_model');
	// 	$data = array(
	// 		'nombre' => $this->input->post('nombre'),
	// 		'descripcion' => $this->input->post('descripcion'),
	// 		'precio' => $this->input->post('precio'),
	// 		'stock' => $this->input->post('stock'),
	// 		'categoria' => $this->input->post('categoria'),
	// 		'mascota' => $this->input->post('mascota'),
	// 		'tipo' => $this->input->post('tipo'),
	// 		'imagen_url' => $this->input->post('imagen_url'),
	// 		'fechaActualizacion' => date('Y-m-d H:i:s')
	// 	);
	// 	$this->productos_model->agregarProducto($data);
	// 	redirect('Welcome/adminProductos');
	// }


	public function editarProducto($id)
	{
		$data['producto'] = $this->Productos_model->get_producto($id);
		if (empty($data['producto'])) {
			show_404();
		}
		$this->load->view('administrador/editar_producto', $data);
	}
	// public function actualizarProducto()
	// {
	// 	$id = $this->input->post('producto_id');
	// 	$data = array(
	// 		'nombre' => $this->input->post('nombre'),
	// 		'descripcion' => $this->input->post('descripcion'),
	// 		'precio' => $this->input->post('precio'),
	// 		'stock' => $this->input->post('stock'),
	// 		'categoria' => $this->input->post('categoria'),
	// 		'mascota' => $this->input->post('mascota'),
	// 		'tipo' => $this->input->post('tipo'),
	// 		'imagen_url' => $this->input->post('imagen_url'),
	// 		'oferta' => $this->input->post('oferta')
	// 	);

	// 	if ($this->Productos_model->update_producto($id, $data)) {
	// 		log_message('info', 'Producto con ID ' . $id . ' actualizado correctamente.');
	// 		$response = [
	// 			'status' => 'success',
	// 			'message' => 'Producto actualizado correctamente',
	// 			'redirect' => site_url('Welcome/adminProductos')
	// 		];
	// 	} else {
	// 		log_message('error', 'Error al actualizar el producto con ID ' . $id . '.');
	// 		$response = [
	// 			'status' => 'error',
	// 			'message' => 'No se pudo actualizar el producto'
	// 		];
	// 	}

	// 	echo json_encode($response);
	// 	exit;
	// }
	// public function adminProductos()
	// {
	// 	$data['productos'] = $this->Productos_model->obtenerProducto1();
	// 	$this->load->view('administrador/adminProductos', $data);
	// }
	public function adminProductos0()
	{
		$data['productos'] = $this->Productos_model->obtenerProducto0();
		$this->load->view('administrador/adminProductosEliminados', $data);
	}
	public function reanudarProducto($producto_id)
	{
		$this->load->model('Productos_model');

		if ($this->Productos_model->cambiarEstadoProducto($producto_id, 1)) {
			$this->session->set_flashdata('success', 'Producto reanudado con éxito.');
		} else {
			$this->session->set_flashdata('error', 'No se pudo reanudar el producto.');
		}
		redirect('Welcome/adminProductos');
	}

	public function nuevoProducto()
	{
		$this->load->view('administrador/agregarProducto');
	}
	public function adminDetalles()
	{
		$this->load->model('Detalles_model');
		$data['detalles'] = $this->Detalles_model->get_detalles_pedidos();
		$data['ventas'] = $this->Detalles_model->get_ventas();
		$this->load->view('administrador/adminDetalles', $data);
	}
	public function verDetallePedido($pedido_id)
	{
		$this->load->model('Detalles_model');
		$data['detalle_pedido'] = $this->Detalles_model->get_detalle_pedido($pedido_id);
		$this->load->view('administrador/verDetallePedido', $data);
	}



	public function guardarUsuario()
	{
		$email = $this->input->post('email');
		$existeEmail = $this->Usuario_model->existeEmail($email);

		if ($existeEmail) {
			$this->session->set_flashdata('error', 'El correo electrónico ya está registrado.');
			redirect('Welcome/nuevoUsuario');
		} else {
			$password = bin2hex(random_bytes(8));
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'primerApellido' => $this->input->post('primerApellido'),
				'segundoApellido' => $this->input->post('segundoApellido'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				'email' => $email,
				'nombre_usuario' => $this->input->post('nombre_usuario'),
				'contrasena' => password_hash($password, PASSWORD_BCRYPT),
			);

			if (empty($data['nombre']) || empty($data['primerApellido']) || empty($data['nombre_usuario']) || empty($data['contrasena'])) {
				$this->session->set_flashdata('error', 'Todos los campos obligatorios deben ser completados.');
				redirect('Welcome/nuevoUsuario');
			} else {
				$this->Usuario_model->insertarUsuario($data);
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.gmail.com',
					'smtp_port' => 587,
					'smtp_user' => 'lazaro.roly.407@gmail.com',
					'smtp_pass' => 'ipbc bxyr hohu pqvr',
					'mailtype' => 'html',
					'charset' => 'utf-8',
					'wordwrap' => TRUE,
					'newline' => "\r\n",
					'smtp_crypto' => 'tls'
				);
				$this->load->library('email', $config);
				$this->email->from('tu_email@gmail.com', 'Roly Lazaro');
				$this->email->to($data['email']);
				$this->email->cc('lazaro.roly.407@gmail.com');
				$this->email->subject('Tu Contraseña');
				$this->email->message('La cuenta ha sido creada. La contraseña es: ' . $password . ' del usuario :' . $data['email']);

				if ($this->email->send()) {
					$data['success'] = 'Se envió su contraseña a ' . $data['nombre_usuario'];
				} else {
					$data['error'] = 'Correo no enviado: ' . $this->email->print_debugger();
				}
				$this->session->set_flashdata('success', 'Usuario creado exitosamente. Se envió la contraseña al correo.');
				redirect('admin');
			}
		}
	}
	public function editar_usuario($id)
	{
		$data['usuario'] = $this->Usuario_model->get_usuarios($id);
		if (empty($data['usuario'])) {
			show_404();
		}

		$this->load->view('administrador/editar_usuario', $data);
	}

	public function update_usuario()
	{
		$id = $this->input->post('id');
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'fechaNacimiento' => $this->input->post('fechaNacimiento'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'email' => $this->input->post('email'),
			'nombre_usuario' => $this->input->post('nombre_usuario'),
			'fechaActualizacionUsuario' => date('Y-m-d H:i:s')
		);

		if ($this->Usuario_model->update_usuario($id, $data)) {
			redirect('Welcome/admin');
		} else {
			show_error('No se pudo actualizar el usuario.');
		}
	}


	public function eliminarProducto($id)
	{
		$data = array('estado' => 0);
		$this->db->where('producto_id', $id);
		if ($this->db->update('productos', $data)) {
			$this->session->set_flashdata('success', 'Producto eliminado exitosamente.');
			redirect('Welcome/adminProductos');
		} else {
			$this->session->set_flashdata('error', 'Error al eliminar el producto.');
			redirect('Welcome/adminProductos');
		}
	}


	public function agregar_al_carrito()
	{
		$this->load->model('Productos_model');

		$producto_id = $this->input->post('producto_id');
		$cantidad = $this->input->post('cantidad') ? $this->input->post('cantidad') : 1; // Establecer cantidad predeterminada a 1 si no se proporciona

		$producto = $this->Productos_model->get_productos_by_id($producto_id);

		if (!$producto) {
			echo json_encode(['error' => 'Producto no encontrado']);
			return;
		}

		$descuento = 0;
		if ($producto['oferta'] == 1) {
			$descuento = 0.10;
		} elseif ($producto['oferta'] == 2) {
			$descuento = 0.15;
		} elseif ($producto['oferta'] == 3) {
			$descuento = 0.20;
		}

		$precio_con_descuento = $producto['precio'] - ($producto['precio'] * $descuento);
		$producto['precio_con_descuento'] = $precio_con_descuento;
		$producto['cantidad'] = $cantidad;
		$producto['producto_id'] = $producto_id;

		$this->load->library('session');
		$carrito = $this->session->userdata('carrito') ? $this->session->userdata('carrito') : [];

		// Verifica si el producto ya está en el carrito
		$encontrado = false;
		foreach ($carrito as &$item) {
			if ($item['producto_id'] == $producto_id) {
				$item['cantidad'] += $cantidad; // Aumentar la cantidad si ya está en el carrito
				$encontrado = true;
				break;
			}
		}

		if (!$encontrado) {
			$carrito[] = $producto; // Agregar el producto al carrito
		}

		$this->session->set_userdata('carrito', $carrito);

		echo json_encode(['success' => 'Producto agregado al carrito']);
	}
	public function eliminar_del_carrito($producto_id)
	{
		// Cargar la biblioteca de sesión
		$this->load->library('session');
		$carrito = $this->session->userdata('carrito');
		if ($carrito) {
			foreach ($carrito as $index => $item) {
				if ($item['producto_id'] == $producto_id) {
					unset($carrito[$index]);
					break;
				}
			}
			$carrito = array_values($carrito);
			$this->session->set_userdata('carrito', $carrito);

			$this->session->set_flashdata('mensaje', 'Producto eliminado del carrito exitosamente.');
		} else {
			$this->session->set_flashdata('mensaje', 'El producto no se encontró en el carrito.');
		}
		redirect('Welcome/carrito');
	}

	public function carrito()
	{
		$this->load->model('Productos_model');
		$productos = $this->session->userdata('carrito');
		$total = 0;
		if (!empty($productos)) {
			foreach ($productos as $producto) {
				$total += $producto['precio_con_descuento'] * $producto['cantidad'];
			}
		}
		$data['productos'] = $productos;
		$data['total'] = $total;
		$this->check_session_and_load_view('carrito', $data);
	}

	public function vaciar_carrito()
	{
		$this->load->model('Productos_model');
		$this->Productos_model->vaciar_carrito();
		redirect('Welcome/carrito');
	}
	public function ver_pedidos()
	{
		$this->load->model('Pedido_model');
		$ci = $this->input->get('search_ci');
		$data['pedidos'] = $this->Pedido_model->get_pedidos($ci);
		if (!$data['pedidos']) {
			$data['pedidos'] = [];
		}
		//valor de $data['pedidos']:
		// Array ( [0] => Array ( [pedido_id] => 108 [cliente_nombre] => Rogelio Carata Inca [cliente_ci] => 12345737 [producto_nombre] => Juguete Croquetero Ovni [cantidad] => 1 [estado] => Pendiente [precio] => 58.00 [oferta] => 1 [fecha_pedido] => 2024-12-02 11:09:45 [precio_con_descuento] => 52.2000 [total] => 52.2000 ) ) 1
		$this->check_session_and_load_view('pedidos', $data);
	}

	public function cancelar_pedido($pedido_id)
	{
		$this->load->model('Pedido_model');
		$this->load->model('Productos_model');

		$detalles_pedido = $this->Pedido_model->get_detalles_pedido($pedido_id);

		$this->db->trans_start();

		$resultado = $this->Pedido_model->actualizar_estado_pedido($pedido_id, 2); // 2 es el estado 'Cancelado'

		if ($resultado) {
			foreach ($detalles_pedido as $detalle) {
				$producto_id = $detalle['producto_id'];
				$cantidad = $detalle['cantidad'];
				$this->Productos_model->sumar_stock($producto_id, $cantidad);
			}

			$this->session->set_flashdata('mensaje', 'Pedido cancelado correctamente.');
		} else {
			$this->session->set_flashdata('mensaje', 'Error al cancelar el pedido.');
		}
		$this->db->trans_complete();
		redirect('Welcome/ver_pedidos');
	}

	public function procesar_compra()
	{
		$productos = $this->input->post('productos');
		$this->load->model('Productos_model');

		foreach ($productos as $producto) {
			$producto_id = $producto['id'];
			$cantidad = $producto['cantidad'];
			$this->Productos_model->actualizar_stock($producto_id, $cantidad);
		}
	}


	public function ver_pedido()
	{
		$this->load->model('Pedido_model');
		$data['pedidos'] = $this->Pedido_model->get_pedidos_with_details();
		$this->check_session_and_load_view('pedidos', $data);
	}

	public function get_pedido_details($pedido_id)
	{
		$this->load->model('Pedido_model');
		$detalles = $this->Pedido_model->obtenerDetallesPorPedido($pedido_id);

		$cliente = $this->Pedido_model->obtenerClientePorPedido($pedido_id);
		$cliente_nombre_completo = trim("{$cliente['nombre']} {$cliente['primerApellido']} {$cliente['segundoApellido']}");

		$total_general = array_sum(array_column($detalles, 'total_item'));
		$response = [
			'detalles' => $detalles,
			'total_general' => $total_general,
			'cliente_nombre' => $cliente_nombre_completo
		];
		echo json_encode($response);
	}
	public function entregar_pedido($pedido_id)
	{
		$this->load->model('Pedido_model');
		$this->load->model('Venta_model');
		$this->load->database();

		$this->db->trans_start();

		$pedido = $this->Pedido_model->get_pedido_by_id($pedido_id);
		if (!$pedido) {
			$this->db->trans_rollback();
			$this->output->set_status_header(404)->set_output(json_encode(['error' => 'Pedido no encontrado']));
			return;
		}

		$detalles_pedido = $this->Pedido_model->get_detalles_pedidos($pedido_id);
		$total = 0;
		foreach ($detalles_pedido as $detalle) {
			$total += $detalle['total'];
		}

		$usuario_id = $this->session->userdata('usuario_id');
		$venta_data = [
			'usuario_id' => $usuario_id,
			'cliente_id' => $pedido['cliente_id'],
			'pedido_id' => $pedido['pedido_id'],
			'total' => $total,
			'estado' => 3,
			'fechaPedido' => $pedido['fecha_pedido']
		];
		$this->db->select('total_compras');
		$this->db->where('cliente_id', $pedido['cliente_id']);
		$cliente = $this->db->get('clientes')->row_array();
		$nuevo_total = $cliente['total_compras'] + $total;
		$tipo_cliente = '';
		if ($nuevo_total > 5000) {
			$tipo_cliente = 'cliente frecuente';
		} elseif ($nuevo_total > 2500) {
			$tipo_cliente = 'cliente ocasional';
		} else {
			$tipo_cliente = 'cliente nuevo';
		}
		$this->db->set('total_compras', $nuevo_total);
		$this->db->set('tipo_cliente', $tipo_cliente);
		$this->db->where('cliente_id', $pedido['cliente_id']);
		$this->db->update('clientes');
		$this->Venta_model->insert_venta($venta_data);
		$this->Venta_model->update_detalles_estado($pedido_id, 3);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->output->set_status_header(500)->set_output(json_encode(['error' => 'Error al procesar la transacción']));
		} else {
			$this->session->set_flashdata('pedido_entregado', 'Pedido entregado con éxito');
			$this->output->set_content_type('application/json')->set_output(json_encode(['success' => true]));
		}
	}

	public function pruebaz()
	{
		echo '<img src="' . base_url() . 'assets/images/logo1.jpg" alt="Logo" />';
	}



	public function generar_pdf_tiket()
	{
		ob_start();

		$json = file_get_contents('php://input');
		$data = json_decode($json, true);

		if (!$data || !isset($data['clienteNombre'], $data['detalles'], $data['totalGeneral'])) {
			return $this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode(['error' => 'Datos incompletos o incorrectos para generar el PDF']));
		}

		try {
			$this->load->library('pdf');
			$pdf = new PDF();

			// Configuración de página
			$pdf->AddPage();
			$pdf->SetMargins(15, 15, 15);
			$pdf->SetAutoPageBreak(true, 20);

			// Header con logos en disposición más ordenada
			$logoHeight = 20;
			$spacing = ($pdf->GetPageWidth() - 30 - (5 * $logoHeight)) / 4;
			$y = 15;
			$logos = ['logo1.jpg', 'lg2.jpg', 'lg1.jpg', 'lg3.jpg', 'lg4.jpg'];

			foreach ($logos as $index => $logo) {
				$x = 15 + ($logoHeight + $spacing) * $index;
				$logoPath = FCPATH . 'assets/images/' . $logo;
				if (file_exists($logoPath)) {
					$pdf->Image($logoPath, $x, $y, $logoHeight);
				}
			}

			// Título y número de documento
			$pdf->SetY($y + $logoHeight + 10);
			$pdf->SetFont('Arial', 'B', 18);
			$pdf->SetTextColor(44, 62, 80);
			$pdf->Cell(0, 10, 'NOTA DE ENTREGA', 0, 1, 'C');

			$pdf->SetFont('Arial', 'B', 9);
			$pdf->SetTextColor(70, 70, 70);
			$pdf->Cell(0, 5, utf8_decode('TIENDA DE MASCOTAS PETSHOP MIMO'), 0, 1, 'C');
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(0, 5, utf8_decode('Av. D\'Orbigny Nro. 345 - Cochabamba, Bolivia'), 0, 1, 'C');
			$pdf->Cell(0, 5, 'Telf.: 69489817', 0, 1, 'C');

			// Cuadro de información del cliente
			$pdf->SetY($pdf->GetY() + 5);
			$pdf->SetFillColor(240, 240, 240);
			$pdf->SetFont('Arial', 'B', 9);
			$pdf->Cell(0, 1, '', 'T', 1); // Línea superior

			// Información del cliente en dos columnas
			$pdf->SetFont('Arial', 'B', 9);
			$y = $pdf->GetY() + 5;

			// Columna izquierda
			$pdf->SetXY(15, $y);
			$pdf->Cell(25, 5, 'CLIENTE:', 0, 0);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(85, 5, utf8_decode($data['clienteNombre']), 0, 0);

			// Columna derecha
			$pdf->SetFont('Arial', 'B', 9);
			$pdf->Cell(25, 5, 'FECHA:', 0, 0);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(40, 5, date('d/m/Y H:i'), 0, 1);

			// Segunda fila
			$y = $pdf->GetY() + 2;
			$pdf->SetXY(15, $y);
			$pdf->SetFont('Arial', 'B', 9);
			$pdf->Cell(25, 5, utf8_decode('DIRECCIÓN:'), 0, 0);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(85, 5, utf8_decode('Av. D\'Orbigny Nro. 345'), 0, 0);

			$pdf->SetFont('Arial', 'B', 9);
			$pdf->Cell(25, 5, 'PAGO:', 0, 0);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(40, 5, isset($data['tipoPago']) ? $data['tipoPago'] : 'Contado', 0, 1);

			$pdf->Cell(0, 1, '', 'B', 1); // Línea inferior
			$pdf->Ln(5);

			// Tabla de productos
			$pdf->SetFillColor(44, 62, 80);
			$pdf->SetTextColor(255, 255, 255);
			$pdf->SetFont('Arial', 'B', 9);

			// Encabezados de tabla
			$headerHeight = 8;
			$pdf->Cell(15, $headerHeight, 'CANT.', 1, 0, 'C', true);
			$pdf->Cell(90, $headerHeight, utf8_decode('DESCRIPCIÓN'), 1, 0, 'C', true);
			$pdf->Cell(25, $headerHeight, 'P. UNIT.', 1, 0, 'C', true);
			$pdf->Cell(25, $headerHeight, 'SUBTOTAL', 1, 0, 'C', true);
			$pdf->Cell(25, $headerHeight, 'TOTAL', 1, 1, 'C', true);

			// Detalles de productos
			$pdf->SetTextColor(70, 70, 70);
			$pdf->SetFont('Arial', '', 9);
			$fill = false;
			$pdf->SetFillColor(248, 248, 248);

			foreach ($data['detalles'] as $detalle) {
				$height = 7;
				$pdf->Cell(15, $height, $detalle['cantidad'], 1, 0, 'C', $fill);
				$pdf->Cell(90, $height, utf8_decode($detalle['producto_nombre']), 1, 0, 'L', $fill);
				$pdf->Cell(25, $height, number_format($detalle['precio'], 2), 1, 0, 'R', $fill);
				$pdf->Cell(25, $height, number_format($detalle['total_item'], 2), 1, 0, 'R', $fill);
				$pdf->Cell(25, $height, number_format($detalle['total_item'], 2), 1, 1, 'R', $fill);
				$fill = !$fill;
			}

			// Totales
			$pdf->Ln(2);

			// Calcular descuento total
			$descuento_total = 0;
			foreach ($data['detalles'] as $detalle) {
				$descuento_item = ($detalle['precio'] - $detalle['precio_con_descuento']) * $detalle['cantidad'];
				$descuento_total += $descuento_item;
			}

			$pdf->SetX($pdf->GetPageWidth() - 90);
			$pdf->SetFont('Arial', 'B', 9);
			$pdf->Cell(40, 6, 'DESCUENTO:', 1, 0, 'R', true);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(35, 6, 'Bs. ' . number_format($descuento_total, 2), 1, 1, 'R');

			$pdf->SetX($pdf->GetPageWidth() - 90);
			$pdf->SetFont('Arial', 'B', 10);
			$pdf->SetFillColor(44, 62, 80);
			$pdf->SetTextColor(255, 255, 255);
			$pdf->Cell(40, 8, 'TOTAL Bs.:', 1, 0, 'R', true);
			$pdf->SetTextColor(44, 62, 80);
			$pdf->Cell(35, 8, number_format($data['totalGeneral'], 2), 1, 1, 'R');

			// Monto en letras
			if (file_exists(APPPATH . 'libraries/NumeroALetras.php')) {
				require_once APPPATH . 'libraries/NumeroALetras.php';
				$numeroALetras = new NumeroALetras();
				$montoEnLetras = $numeroALetras->convertir($data['totalGeneral'], 'Bolivianos', 'Centavos');

				$pdf->SetFont('Arial', 'I', 9);
				$pdf->SetTextColor(70, 70, 70);
				$pdf->Cell(0, 8, 'Son: ' . $montoEnLetras, 'T', 1, 'L');
			}

			// Pie de página
			$pdf->SetY(-30);
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetTextColor(128, 128, 128);

			// Firmas
			$pdf->Cell(95, 5, '_____________________', 0, 0, 'C');
			$pdf->Cell(95, 5, '_____________________', 0, 1, 'C');
			$pdf->Cell(95, 5, 'Entregado por', 0, 0, 'C');
			$pdf->Cell(95, 5, 'Recibido por', 0, 1, 'C');

			$pdf->Ln(5);
			$pdf->SetFont('Arial', 'I', 8);
			$pdf->Cell(0, 5, utf8_decode('Este documento es un comprobante válido de entrega'), 0, 1, 'C');
			$pdf->Cell(0, 5, utf8_decode('Gracias por su preferencia'), 0, 1, 'C');

			ob_end_clean();
			$pdf->Output('D', 'Nota_Entrega.pdf');

		} catch (Exception $e) {
			ob_end_clean();
			log_message('error', 'Error al generar PDF: ' . $e->getMessage());
			echo 'Error al generar el PDF: ' . $e->getMessage();
		}
	}

	public function ofertas()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos();
		$this->check_session_and_load_view('ofertas', $data);
	}
	public function detallesperro($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->check_session_and_load_view('Perros/detalles', $data);
	}
	public function detallesgato($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->check_session_and_load_view('Gatos/detalles', $data);
	}
	public function buscar_cliente()
	{
		$data = json_decode($this->input->raw_input_stream, true);
		log_message('debug', 'Datos recibidos en buscar_cliente: ' . json_encode($data));

		if (!isset($data['ci'])) {
			echo json_encode(['status' => 'error', 'message' => 'CI no proporcionado']);
			return;
		}

		$cliente = $this->Cliente_model->buscar_cliente_por_ci($data['ci']);

		if ($cliente) {
			echo json_encode(['status' => 'success', 'cliente' => $cliente]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Cliente no encontrado']);
		}
	}


	public function guardar_pedido()
	{
		$data = json_decode($this->input->raw_input_stream, true);
		log_message('debug', 'Datos recibidos en guardar_pedido: ' . json_encode($data));

		if (!$data) {
			echo json_encode(['status' => 'error', 'message' => 'Datos no recibidos']);
			return;
		}

		// Buscar o guardar el cliente
		$cliente = $this->Cliente_model->buscar_cliente_por_ci($data['ci']);
		log_message('debug', 'Cliente encontrado: ' . json_encode($cliente));

		if (!$cliente) {
			$cliente_id = $this->Cliente_model->guardar_cliente($data);
			log_message('debug', 'Nuevo cliente creado con ID: ' . $cliente_id);
		} else {
			$cliente_id = $cliente->cliente_id;
			log_message('debug', 'Cliente existente con ID: ' . $cliente_id);
		}

		// Obtener el carrito de la sesión
		$this->load->library('session');
		$carrito = $this->session->userdata('carrito');
		log_message('debug', 'Carrito recibido: ' . json_encode($carrito));

		if (empty($carrito)) {
			echo json_encode(['status' => 'error', 'message' => 'Carrito vacío']);
			return;
		}

		// Guardar el pedido
		$pedido_id = $this->Pedido_model->guardar_pedido($cliente_id);
		log_message('debug', 'ID del pedido guardado: ' . $pedido_id);

		if (!$pedido_id) {
			echo json_encode(['status' => 'error', 'message' => 'Error al guardar el pedido']);
			return;
		}

		// Recorrer los productos del carrito y guardar los detalles del pedido
		foreach ($carrito as $producto) {
			// Guardar el detalle del pedido
			if (!$this->Pedido_model->guardar_detalle_pedido($pedido_id, $producto['producto_id'], $producto['cantidad'])) {
				echo json_encode(['status' => 'error', 'message' => 'Error al guardar los detalles del pedido']);
				return;
			}

			// Descontar el stock del producto
			$producto_actual = $this->Productos_model->obtener_producto($producto['producto_id']);
			if ($producto_actual) {
				$nuevo_stock = $producto_actual->stock - $producto['cantidad'];
				if ($nuevo_stock < 0) {
					// Si el stock es insuficiente, enviar un error
					echo json_encode(['status' => 'error', 'message' => 'Stock insuficiente para el producto: ' . $producto['nombre']]);
					return;
				}
				// Actualizar el stock del producto
				$this->Productos_model->actualiza_stock($producto['producto_id'], $nuevo_stock);
			}
		}

		// Vaciar el carrito
		$this->session->unset_userdata('carrito');

		echo json_encode(['status' => 'success']);
	}

	// Método para agregar stock con fecha de vencimiento
	public function agregar_stock()
	{
		$producto_id = $this->input->post('producto_id');
		$cantidad = $this->input->post('cantidad');
		$fecha_vencimiento = $this->input->post('fecha_vencimiento');
		$lote = $this->input->post('lote');

		if (!$producto_id || !$cantidad || !$fecha_vencimiento || !$lote) {
			echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos']);
			return;
		}

		$resultado = $this->Productos_model->agregar_stock($producto_id, $cantidad, $fecha_vencimiento, $lote);

		if ($resultado) {
			echo json_encode(['success' => true, 'message' => 'Stock agregado correctamente']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Error al agregar stock']);
		}
	}

	// Método para obtener los lotes de un producto
	public function get_lotes($producto_id)
	{
		$lotes = $this->Productos_model->get_stock_por_lote($producto_id);
		echo json_encode($lotes);
	}

	// Método para listar productos por vencer
	public function productos_por_vencer()
	{
		$dias = $this->input->get('dias') ? $this->input->get('dias') : 30;
		$productos = $this->Productos_model->get_productos_por_vencer($dias);

		$data['productos'] = $productos;
		$data['dias'] = $dias;
		$this->load->view('administrador/productos_por_vencer', $data);
	}

	// Modificar el método adminProductos existente
	public function adminProductos()
	{
		$data['productos'] = $this->Productos_model->obtenerProducto1();

		// Agregar productos por vencer
		$data['productos_por_vencer'] = $this->Productos_model->get_productos_por_vencer();

		$this->load->view('administrador/adminProductos', $data);
	}

	// Modificar el método actualizarProducto existente
	public function actualizarProducto()
	{
		header('Content-Type: application/json');

		$json_data = json_decode(file_get_contents('php://input'), true);
		if (!$json_data) {
			echo json_encode([
				'status' => 'error',
				'message' => 'No se recibieron datos válidos'
			]);
			return;
		}

		$id = $json_data['producto_id'];
		$data = array(
			'nombre' => $json_data['nombre'],
			'descripcion' => $json_data['descripcion'],
			'precio' => $json_data['precio'],
			'stock' => $json_data['stock'],
			'categoria' => $json_data['categoria'],
			'mascota' => $json_data['mascota'],
			'tipo' => $json_data['tipo'],
			'imagen_url' => $json_data['imagen_url'],
			'oferta' => $json_data['oferta']
		);

		$this->load->model('Productos_model');

		try {
			if ($this->Productos_model->update_producto($id, $data)) {
				echo json_encode([
					'status' => 'success',
					'message' => 'Producto actualizado correctamente',
					'redirect' => site_url('Welcome/adminProductos')
				]);
			} else {
				echo json_encode([
					'status' => 'error',
					'message' => 'No se pudo actualizar el producto'
				]);
			}
		} catch (Exception $e) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Error en la base de datos: ' . $e->getMessage()
			]);
		}
	}

	// Modificar el método agregarProducto existente
	public function agregarProducto()
	{
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'precio' => $this->input->post('precio'),
			'stock' => $this->input->post('stock'),
			'categoria' => $this->input->post('categoria'),
			'mascota' => $this->input->post('mascota'),
			'tipo' => $this->input->post('tipo'),
			'imagen_url' => $this->input->post('imagen_url'),
			'fechaActualizacion' => date('Y-m-d H:i:s')
		);

		$categoria = $this->input->post('categoria');
		$requires_date_and_lot = !($categoria === 'Accesorios' || $categoria === 'Juguetes');

		$this->db->trans_start();

		// Insertar el producto
		$producto_id = $this->Productos_model->agregarProducto($data);

		// Solo registrar fecha de vencimiento y lote si la categoría lo requiere
		if ($requires_date_and_lot && $producto_id) {
			$fecha_vencimiento = $this->input->post('fecha_vencimiento');
			$lote = $this->input->post('lote');

			if ($fecha_vencimiento && $lote) {
				$this->Productos_model->agregar_stock(
					$producto_id,
					$data['stock'],
					$fecha_vencimiento,
					$lote
				);
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', 'Fecha de vencimiento y lote son requeridos para esta categoría');
				redirect('Welcome/adminProductos');
				return;
			}
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('error', 'Error al agregar el producto');
		} else {
			$this->session->set_flashdata('success', 'Producto agregado correctamente');
		}

		redirect('Welcome/adminProductos');
	}

	public function reporte_productos_vencer()
	{
		$dias = $this->input->get('dias') ? $this->input->get('dias') : 30;

		$data['productos'] = $this->Reportes_model->get_productos_por_vencer($dias);
		$data['dias'] = $dias;

		$this->load->view('reportes/reporte_productos_vencer', $data);
	}


	public function generar_pdf_ventas()
	{
		// Obtener datos del formulario
		$fechas = $this->input->post('fecha');
		$productos = $this->input->post('producto');
		$cantidades = $this->input->post('cantidad');
		$totales = $this->input->post('total');

		if (!$productos || !$cantidades || !$totales || !$fechas) {
			redirect('Welcome/reporte_producto_mas_vendido');
			return;
		}

		// Crear el PDF
		$this->load->library('pdf');
		$pdf = new PDF();
		$pdf->AddPage();

		// Configuración de la página
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, utf8_decode('Reporte de Ventas por Producto'), 0, 1, 'C');

		// Fecha del reporte
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(0, 10, 'Fecha de generacion: ' . date('d/m/Y H:i'), 0, 1, 'R');
		$pdf->Ln(5);

		// Configurar la tabla
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetFillColor(200, 220, 255);

		// Definir anchos de columnas
		$anchos = array(40, 70, 40, 40);

		// Encabezados
		$pdf->Cell($anchos[0], 8, 'Fecha', 1, 0, 'C', true);
		$pdf->Cell($anchos[1], 8, 'Producto', 1, 0, 'C', true);
		$pdf->Cell($anchos[2], 8, 'Cantidad', 1, 0, 'C', true);
		$pdf->Cell($anchos[3], 8, 'Total (Bs.)', 1, 1, 'C', true);

		// Contenido
		$pdf->SetFont('Arial', '', 9);
		$total_general = 0;
		$total_cantidad = 0;

		for ($i = 0; $i < count($productos); $i++) {
			$total = floatval(str_replace(',', '', $totales[$i]));
			$cantidad = intval($cantidades[$i]);

			$pdf->Cell($anchos[0], 7, date('d/m/Y', strtotime($fechas[$i])), 1);
			$pdf->Cell($anchos[1], 7, utf8_decode($productos[$i]), 1);
			$pdf->Cell($anchos[2], 7, $cantidad, 1, 0, 'C');
			$pdf->Cell($anchos[3], 7, number_format($total, 2), 1, 1, 'R');

			$total_general += $total;
			$total_cantidad += $cantidad;
		}

		// Totales
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell($anchos[0] + $anchos[1], 7, 'TOTALES:', 1, 0, 'R');
		$pdf->Cell($anchos[2], 7, $total_cantidad, 1, 0, 'C');
		$pdf->Cell($anchos[3], 7, number_format($total_general, 2), 1, 1, 'R');

		// Resumen estadístico
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 8, utf8_decode('Resumen Estadístico:'), 0, 1);
		$pdf->SetFont('Arial', '', 10);

		$promedio_venta = $total_general / count($productos);
		$promedio_cantidad = $total_cantidad / count($productos);

		$pdf->Cell(0, 6, utf8_decode("Total de Registros: " . count($productos)), 0, 1);
		$pdf->Cell(0, 6, utf8_decode("Promedio de Venta por Registro: Bs. " . number_format($promedio_venta, 2)), 0, 1);
		$pdf->Cell(0, 6, utf8_decode("Promedio de Cantidad por Registro: " . number_format($promedio_cantidad, 1)), 0, 1);
		$pdf->Cell(0, 6, utf8_decode("Total General: Bs. " . number_format($total_general, 2)), 0, 1);

		$pdf->Output('D', 'reporte_ventas.pdf');
	}
	public function generar_pdf_productos_vencer()
	{
		// Obtener datos del formulario
		$productos = $this->input->post('producto');
		$categorias = $this->input->post('categoria');
		$mascotas = $this->input->post('mascota');
		$lotes = $this->input->post('lote');
		$stocks = $this->input->post('stock');
		$fechas_vencimiento = $this->input->post('fecha_vencimiento');
		$dias_restantes = $this->input->post('dias_restantes');
		$dias_filtro = $this->input->post('dias_filtro');

		if (!$productos || empty($productos)) {
			redirect('Welcome/reporte_productos_vencer');
			return;
		}

		// Crear el PDF
		$this->load->library('pdf');
		$pdf = new PDF();
		$pdf->AddPage();

		// Agregar logo
		$pdf->Image(FCPATH . 'assets/images/logo1.jpg', 10, 10, 30);

		// Configuración de la página
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 30, utf8_decode('Reporte de Productos por Vencer'), 0, 1, 'C');

		// Subtítulo con el filtro aplicado y diseño mejorado
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(230, 230, 230);
		$pdf->Cell(0, 10, utf8_decode('Productos que vencen en los próximos ' . utf8_decode($dias_filtro) . ' días'), 0, 1, 'C', true);

		// Fecha del reporte con mejor formato
		$pdf->SetFont('Arial', 'I', 10);
		$pdf->Cell(0, 10, utf8_decode('Fecha de generación: ' . date('d/m/Y H:i')), 0, 1, 'R');
		$pdf->Ln(5);

		// Configurar la tabla con mejor diseño
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->SetFillColor(41, 128, 185);
		$pdf->SetTextColor(255, 255, 255);

		// Definir anchos de columnas
		$anchos = array(60, 30, 20, 25, 15, 25, 20);

		// Encabezados
		$pdf->Cell($anchos[0], 8, utf8_decode('Producto'), 1, 0, 'C', true);
		$pdf->Cell($anchos[1], 8, utf8_decode('Categoría'), 1, 0, 'C', true);
		$pdf->Cell($anchos[2], 8, utf8_decode('Mascota'), 1, 0, 'C', true);
		$pdf->Cell($anchos[3], 8, utf8_decode('Lote'), 1, 0, 'C', true);
		$pdf->Cell($anchos[4], 8, utf8_decode('Stock'), 1, 0, 'C', true);
		$pdf->Cell($anchos[5], 8, utf8_decode('Vencimiento'), 1, 0, 'C', true);
		$pdf->Cell($anchos[6], 8, utf8_decode('Días Rest.'), 1, 1, 'C', true);

		// Restablecer color de texto para el contenido
		$pdf->SetTextColor(0, 0, 0);

		// Contenido con colores mejorados
		$pdf->SetFont('Arial', '', 8);
		$fill = false;
		for ($i = 0; $i < count($productos); $i++) {
			// Determinar el color basado en los días restantes
			$dias = intval($dias_restantes[$i]);
			if ($dias <= 7) {
				$pdf->SetTextColor(200, 0, 0);
			} elseif ($dias <= 15) {
				$pdf->SetTextColor(230, 95, 0);
			} else {
				$pdf->SetTextColor(0, 100, 0);
			}

			// Alternar color de fondo
			$fill = !$fill;
			$pdf->SetFillColor(245, 245, 245);

			$pdf->Cell($anchos[0], 7, utf8_decode($productos[$i]), 1, 0, 'L', $fill);
			$pdf->Cell($anchos[1], 7, utf8_decode($categorias[$i]), 1, 0, 'L', $fill);
			$pdf->Cell($anchos[2], 7, utf8_decode(ucfirst($mascotas[$i])), 1, 0, 'C', $fill);
			$pdf->Cell($anchos[3], 7, utf8_decode($lotes[$i]), 1, 0, 'C', $fill);
			$pdf->Cell($anchos[4], 7, utf8_decode($stocks[$i]), 1, 0, 'C', $fill);
			$pdf->Cell($anchos[5], 7, utf8_decode(date('d/m/Y', strtotime($fechas_vencimiento[$i]))), 1, 0, 'C', $fill);
			$pdf->Cell($anchos[6], 7, utf8_decode($dias_restantes[$i] . ' días'), 1, 1, 'C', $fill);

			// Restablecer color de texto
			$pdf->SetTextColor(0, 0, 0);
		}

		// Agregar resumen con diseño mejorado
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(41, 128, 185);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(0, 8, utf8_decode('Resumen del Reporte'), 0, 1, 'L', true);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Arial', '', 10);

		$total_productos = count($productos);
		$productos_criticos = count(array_filter($dias_restantes, function ($dias) {
			return intval($dias) <= 7;
		}));
		$productos_alerta = count(array_filter($dias_restantes, function ($dias) {
			return intval($dias) > 7 && intval($dias) <= 15;
		}));

		// Agregar iconos o símbolos para mejor visualización
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 8, utf8_decode("* Total de productos: " . $total_productos), 0, 1);
		$pdf->SetTextColor(200, 0, 0);
		$pdf->Cell(0, 8, utf8_decode("* Productos en estado crítico (7 días o menos): " . $productos_criticos), 0, 1);
		$pdf->SetTextColor(230, 95, 0);
		$pdf->Cell(0, 8, utf8_decode("* Productos en alerta (8-15 días): " . $productos_alerta), 0, 1);

		$nombre_archivo = 'productos_por_vencer_' . date('Y-m-d') . '.pdf';
		$pdf->Output('D', utf8_decode($nombre_archivo));
	}
	public function actualizar_lote()
	{
		$lote_id = $this->input->post('lote_id');
		$cantidad = $this->input->post('cantidad');
		$fecha_vencimiento = $this->input->post('fecha_vencimiento');
		$numero_lote = $this->input->post('numero_lote');

		if (!$lote_id || !$cantidad || !$fecha_vencimiento || !$numero_lote) {
			echo json_encode([
				'success' => false,
				'message' => 'Todos los campos son requeridos'
			]);
			return;
		}

		if ($cantidad < 0) {
			echo json_encode([
				'success' => false,
				'message' => 'La cantidad no puede ser negativa'
			]);
			return;
		}

		$resultado = $this->Productos_model->actualizar_lote($lote_id, [
			'cantidad' => $cantidad,
			'fecha_vencimiento' => $fecha_vencimiento,
			'lote' => $numero_lote
		]);

		if ($resultado) {
			echo json_encode([
				'success' => true,
				'message' => 'Lote actualizado correctamente'
			]);
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Error al actualizar el lote'
			]);
		}
	}

	public function eliminar_lote($lote_id)
	{
		if (!$lote_id) {
			echo json_encode([
				'success' => false,
				'message' => 'ID de lote no proporcionado'
			]);
			return;
		}

		if ($this->Productos_model->validar_lote_en_uso($lote_id)) {
			echo json_encode([
				'success' => false,
				'message' => 'No se puede eliminar este lote porque ya tiene ventas asociadas'
			]);
			return;
		}

		$resultado = $this->Productos_model->eliminar_lote($lote_id);

		if ($resultado) {
			echo json_encode([
				'success' => true,
				'message' => 'Lote eliminado correctamente'
			]);
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Error al eliminar el lote'
			]);
		}
	}

	public function get_productos_actualizados()
	{
		$productos = $this->Productos_model->obtenerProducto1();

		$data = array_map(function ($producto) {
			return [
				$producto['producto_id'],
				$producto['nombre'],
				$producto['descripcion'],
				$producto['precio'] . 'Bs.',
				$producto['stock'] . '<button class="btn btn-info btn-sm" onclick="mostrarModalStock(' . $producto['producto_id'] . ')" title="Agregar stock"><i class="fas fa-plus"></i></button>',
				'<button class="btn btn-secondary btn-sm" onclick="verLotes(' . $producto['producto_id'] . ')" title="Ver lotes"><i class="fas fa-box"></i> Ver lotes</button>',
				$producto['categoria'],
				$producto['imagen_url'] ? '<img src="' . $producto['imagen_url'] . '" alt="Imagen del Producto" class="product-image">' : 'No disponible',
				'<a href="' . site_url('Welcome/editarProducto/' . $producto['producto_id']) . '" class="btn btn-warning btn-sm mb-1">Editar</a> ' .
				'<a href="' . site_url('Welcome/eliminarProducto/' . $producto['producto_id']) . '" class="btn btn-danger btn-sm">Eliminar</a>'
			];
		}, $productos);

		echo json_encode($data);
	}

}
