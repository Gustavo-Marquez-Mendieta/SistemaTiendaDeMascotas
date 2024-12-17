<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->model('Productos_model');
		$this->load->model('Pedido_model');
		$this->load->model('Cliente_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function contacto()
	{
		$this->load->view('contactenos');
	}
	public function productos()
	{
		$this->load->view('producto');
	}
	public function login()
	{
		$this->load->view('login');
	}

	// Funciones para productos de gatos
	public function TiendaGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_gatos();
		$this->load->view('Gatos/TiendaGatos', $data);
	}

	public function AccesoriosGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_gatos();
		$this->load->view('Gatos/Accesorios', $data);
	}
	public function Casas_Camas_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->obtener_camas_gatos();
		$this->load->view('Gatos/Camas', $data);
	}
	public function Torres_Rascadores_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->obtener_Torres_Rascadores_Gatos();
		$this->load->view('Gatos/Torres_Rascadores', $data);
	}
	public function Transportadores_Jaulas_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Transportadores_Jaulas_Gatos();
		$this->load->view('Gatos/Transportadores_Jaulas', $data);
	}
	public function Platos_Dispensadores_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Platos_Dispensadores_Gatos();
		$this->load->view('Gatos/Platos_Dispensadores', $data);
	}
	public function Collares_Percheras_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Collares_Percheras_Gatos();
		$this->load->view('Gatos/Collares_Percheras', $data);
	}
	public function AlimentoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_gatos();
		$this->load->view('Gatos/Alimento', $data);
	}
	public function AlimentoHumedoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_humedo_gatos();
		$this->load->view('Gatos/Alimento_humedo', $data);
	}
	public function AlimentoSecoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_seco_gatos();
		$this->load->view('Gatos/Alimento_seco', $data);
	}
	public function AlimentoSecoEspecialGato()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_alimento_seco_especial();
		$this->load->view('Gatos/AlimentoSecoEspecial', $data);
	}
	public function Snacks_Premios_Gato()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_Snacks_Premios();
		$this->load->view('Gatos/Snacks_Premios', $data);
	}
	public function JuguetesGatos()
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
		$this->load->view('Gatos/Juguete', $data);
	}
	public function Catnip_Gatos()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Catnip_Gatos();
		$this->load->view('Gatos/Catnip_Gatos', $data);
	}
	public function Juguetes_Gatos()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Juguetes_Gatos();
		$this->load->view('Gatos/Juguete', $data);
	}
	public function HigieneGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_gatos();
		$this->load->view('Gatos/Higiene', $data);
	}
	public function Arenas_Sanitarias_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Arenas_Sanitarias_gatos();
		$this->load->view('Gatos/Arenas_Sanitarias', $data);
	}
	public function Areneros_Palas_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Areneros_Palas_Gatos();
		$this->load->view('Gatos/Areneros_Palas', $data);
	}
	public function Limpieza_Hogar_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Limpieza_Hogar_Gatos();
		$this->load->view('Gatos/Limpieza_Hogar', $data);
	}
	public function Shampoo_Aseo_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Shampoo_Aseo_Gatos();
		$this->load->view('Gatos/Shampoo_Aseo', $data);
	}
	public function Peines_Cepillos_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Peines_Cepillos_Gatos();
		$this->load->view('Gatos/Peines_Cepillos', $data);
	}
	// Funciones para productos de perros
	public function TiendaPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros();
		$this->load->view('Perros/TiendaPerros', $data);
	}
	public function AlimentoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_perros();
		$this->load->view('Perros/Alimento', $data);
	}
	public function AlimentoSecoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_seco();
		$this->load->view('Perros/Alimento_Seco', $data);
	}
	public function AlimentoHumedoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_humedo();
		$this->load->view('Perros/Alimento_Seco', $data);
	}

	public function AlimentoSecoEspecialPerro()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->AlimentoSecoEspecialPerro();
		$this->load->view('Perros/AlimentoSecoEspecial', $data);
	}
	public function Snacks_Premios_Perro()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_Snacks_Premios_Perros();
		$this->load->view('Perros/Snacks_Premios', $data);
	}
	public function AccesoriosPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_perros();
		$this->load->view('Perros/Accesorios', $data);
	}
	public function Casas_Camas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Casas_Camas_Perros();
		$this->load->view('Perros/Casas_Camas', $data);
	}
	public function Collares_Correas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Collares_Correas_Perros();
		$this->load->view('Perros/Collares_Correas', $data);
	}

	public function Platos_Dispensadores_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Platos_Dispensadores_Perros();
		$this->load->view('Perros/Platos_Dispensadores', $data);
	}
	public function Ropa_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Ropa_Perros();
		$this->load->view('Perros/Ropa', $data);
	}
	public function Transportadores_Jaulas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Transportadores_Jaulas_Perros();
		$this->load->view('Perros/Transportadores_Jaulas', $data);
	}
	public function JuguetesPerros()
	{
		$this->load->model('Productos_model');
		$productos = $this->Productos_model->obtener_juguetes_perros();

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
		$this->load->view('Perros/Juguetes', $data);
	}
	public function Jueguetes_Goma_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Jueguetes_Goma_Perros();
		$this->load->view('Perros/Jueguetes_Goma', $data);
	}
	public function Pelotas_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Pelotas_Perros();
		$this->load->view('Perros/Pelotas', $data);
	}
	public function Peluches_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Peluches_Perros();
		$this->load->view('Perros/Peluches', $data);
	}
	public function HigienePerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_perros();
		$this->load->view('Perros/Higiene', $data);
	}
	public function Bolsas_Dispensadores_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Bolsas_Dispensadores_Perros();
		$this->load->view('Perros/Bolsas_Dispensadores', $data);
	}
	public function Cuidado_uñas_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Cuidado_uñas_Perros();
		$this->load->view('Perros/Cuidado_uñas', $data);
	}
	public function Cuidado_Dental_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Cuidado_Dental_Perros();
		$this->load->view('Perros/Cuidado_Dental', $data);
	}
	public function Limpieza_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Limpieza_Perros();
		$this->load->view('Perros/Limpieza', $data);
	}
	public function Peines_Cepillos_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Peines_Cepillos_Perros();
		$this->load->view('Perros/Peines_Cepillos', $data);
	}
	public function Shampoo_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Shampoo_Perros();
		$this->load->view('Perros/Shampoo', $data);
	}
	public function detallesperro($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->load->view('Perros/detalles', $data);
	}
	public function detallesgato($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->load->view('Gatos/detalles', $data);
	}
	public function editarProduct()
	{
		$id = $this->input->post('producto_id');
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'precio' => $this->input->post('precio'),
			'stock' => $this->input->post('stock'),
			'categoria' => $this->input->post('categoria'),
			'imagen_url' => $this->input->post('imagen_url')
		);

		if ($this->Productos_model->update_producto($id, $data)) {
			redirect('Welcome/adminProductos');
		} else {
			show_error('No se pudo actualizar el producto.');
		}
	}
	public function eliminarProducto($id)
	{
		if ($this->Productos_model->delete_producto($id)) {
			redirect('Welcome/adminProductos'); // Redirigir después de eliminar
		} else {
			show_error('No se pudo eliminar el producto.');
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
		$this->load->view('carrito', $data);
	}
	public function eliminar_del_carrito($producto_id = null)
	{
		if ($producto_id === null) {
			redirect('Welcome/carrito');
			return;
		}
		$this->load->library('session');

		$carrito = $this->session->userdata('carrito') ? $this->session->userdata('carrito') : [];
		$nuevo_carrito = [];
		foreach ($carrito as $item) {
			if ($item['producto_id'] != $producto_id) {
				$nuevo_carrito[] = $item;
			}
		}
		$this->session->set_userdata('carrito', $nuevo_carrito);
		$this->session->set_flashdata('success', 'Producto eliminado del carrito'); // Cambiado de 'mensaje' a 'success'
		redirect('Welcome/carrito');  // Cambiado de 'carrito' a 'Welcome/carrito'
	}

	public function eliminar_producto($producto_id)
	{
		$this->load->model('Productos_model');
		$this->Productos_model->eliminar_del_carrito($producto_id);
		redirect('Welcome/carrito');
	}



	public function vaciar_carrito()
	{
		$this->load->model('Productos_model');
		$this->Productos_model->vaciar_carrito();
		redirect('Welcome/carrito'); // Redirige a la vista del carrito
	}
	public function ofertas()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos();
		$this->load->view('ofertas', $data);
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
				$this->Productos_model->actualizar_stock($producto['producto_id'], $nuevo_stock);
			}
		}

		// Vaciar el carrito
		$this->session->unset_userdata('carrito');

		echo json_encode(['status' => 'success']);
	}

}
