<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_Model
{
    public function get_stock_actual($producto_id)
    {
        // Obtener el stock actual del producto
        $this->db->select('p.stock, SUM(sp.cantidad) as stock_lotes');
        $this->db->from('productos p');
        $this->db->join('stock_producto sp', 'p.producto_id = sp.producto_id', 'left');
        $this->db->where('p.producto_id', $producto_id);
        $this->db->group_by('p.producto_id');

        $query = $this->db->get();
        $result = $query->row();

        // Retornar información detallada del stock
        if ($result) {
            return array(
                'stock_total' => $result->stock,
                'stock_lotes' => $result->stock_lotes ?: 0,
                'stock_disponible' => $result->stock,
                'estado_stock' => $this->calcular_estado_stock($result->stock)
            );
        }

        return null;
    }

    private function calcular_estado_stock($cantidad)
    {
        if ($cantidad > 50) {
            return 'alto';
        } elseif ($cantidad > 20) {
            return 'medio';
        } else {
            return 'bajo';
        }
    }
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }
    public function get_producto($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }
    public function get_productos_by_id($producto_id)
    {
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get('productos');
        return $query->row_array();
    }

    public function vaciar_carrito()
    {
        $this->session->unset_userdata('carrito');
    }
    public function obtenerProducto1()
    {
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result_array();
    }
    public function obtenerProducto0()
    {
        $this->db->where('estado', 0);
        $query = $this->db->get('productos');
        return $query->result_array();
    }
    public function cambiarEstadoProducto($producto_id, $estado)
    {
        $this->db->where('producto_id', $producto_id);
        return $this->db->update('productos', ['estado' => $estado, 'fechaActualizacion' => date('Y-m-d H:i:s')]);
    }

    public function get_categorias_unicas()
    {
        $this->db->distinct();
        $this->db->select('categoria');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos()
    {
        $query = $this->db->get('productos');
        return $query->result();
    }

    public function agregarProducto($data)
    {
        $this->db->insert('productos', $data);
    }

    public function obtenerProductoPorId($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }


    public function update_producto($id, $data)
    {
        $this->db->where('producto_id', $id);
        return $this->db->update('productos', $data);
    }

    public function eliminarProducto($id)
    {
        $this->db->where('producto_id', $id);
        return $this->db->delete('productos');
    }


    // Funciones para obtener Productos de Gatos
    public function obtener_accesorios_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Accesorios');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_alimento_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Alimento');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_juguetes_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Juguetes');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_higiene_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Higiene');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }

    public function obtener_productos_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_alimento_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Alimento');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos_perros_seco()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Alimento Seco');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos_perros_humedo()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Alimento Humedo');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_accesorios_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Accesorios');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_juguetes_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Juguetes');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_higiene_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Estetica E Higiene');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function verificar_stock($producto_id, $cantidad)
    {
        $this->db->select('stock');
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get('productos');
        $producto = $query->row();

        return $producto && $producto->stock >= $cantidad;
    }

    public function actualizar_stock($producto_id, $cantidad)
    {
        $this->db->set('stock', 'stock - ' . (int) $cantidad, FALSE);
        $this->db->where('producto_id', $producto_id);
        $this->db->update('productos');
    }
    public function descontar_stock($producto_id, $cantidad)
    {
        // Obtener el stock actual del producto
        $this->db->set('stock', 'stock - ' . intval($cantidad), FALSE);
        $this->db->where('producto_id', $producto_id);
        $this->db->update('productos');
    }
    public function get_all_categoria()
    {
        $this->db->distinct();
        $this->db->select('categoria');
        $this->db->from('productos');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_nombres()
    {
        $this->db->select('producto_id, nombre');
        $this->db->from('productos');
        $query = $this->db->get();
        return $query->result();
    }
    public function sumar_stock($producto_id, $cantidad)
    {
        $this->db->set('stock', 'stock + ' . (int) $cantidad, FALSE); // Sumar al stock existente
        $this->db->where('producto_id', $producto_id);
        return $this->db->update('productos'); // Cambia 'productos' por el nombre correcto de tu tabla
    }
    public function obtener_producto($producto_id)
    {
        return $this->db->get_where('productos', ['producto_id' => $producto_id])->row();
    }
    public function actualiza_stock($producto_id, $nuevo_stock)
    {
        $this->db->where('producto_id', $producto_id);
        return $this->db->update('productos', ['stock' => $nuevo_stock]);
    }
    public function obtener_alimento_humedo_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Alimento Humedo');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtenerProductosFiltrados($mascota = null, $categoria = null)
    {
        // Aplicar filtros según los parámetros recibidos
        if ($mascota) {
            $this->db->where('mascota', $mascota);
        }

        if ($categoria) {
            $this->db->where('categoria', $categoria);
        }

        // Obtener productos activos (estado 1)
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');

        return $query->result_array(); // Devuelve un array de productos
    }

    public function obtener_alimento_seco_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Alimento Seco');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    //!
    public function agregar_stock($producto_id, $cantidad, $fecha_vencimiento, $lote)
    {
        // Validar que los datos sean correctos
        if (!$producto_id || !$cantidad || !$fecha_vencimiento || !$lote) {
            return false;
        }

        // Comenzar transacción
        $this->db->trans_start();

        // Actualizar stock total
        $this->db->set('stock', 'stock + ' . (int) $cantidad, FALSE);
        $this->db->where('producto_id', $producto_id);
        $this->db->update('productos');

        // Registrar el nuevo ingreso de stock
        $data = array(
            'producto_id' => $producto_id,
            'cantidad' => $cantidad,
            'fecha_vencimiento' => $fecha_vencimiento,
            'lote' => $lote,
            'fecha_ingreso' => date('Y-m-d')
        );

        $this->db->insert('stock_producto', $data);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    // Obtener productos próximos a vencer
    public function get_productos_por_vencer($dias = 30)
    {
        $fecha_limite = date('Y-m-d', strtotime('+' . $dias . ' days'));

        $this->db->select('p.*, sp.fecha_vencimiento, sp.lote, sp.cantidad');
        $this->db->from('productos p');
        $this->db->join('stock_producto sp', 'p.producto_id = sp.producto_id');
        $this->db->where('sp.fecha_vencimiento <=', $fecha_limite);
        $this->db->where('sp.fecha_vencimiento >=', date('Y-m-d'));
        $this->db->where('sp.cantidad >', 0);

        return $this->db->get()->result();
    }

    // Obtener stock por lote
    public function get_stock_por_lote($producto_id)
    {
        $this->db->select('*');
        $this->db->from('stock_producto');
        $this->db->where('producto_id', $producto_id);
        $this->db->where('cantidad >', 0);
        $this->db->order_by('fecha_vencimiento', 'ASC');

        return $this->db->get()->result();
    }

    // Actualizar stock considerando el FIFO (First In, First Out)
    public function actualizar_stock_fifo($producto_id, $cantidad_requerida)
    {
        $lotes = $this->get_stock_por_lote($producto_id);
        $cantidad_restante = $cantidad_requerida;

        $this->db->trans_start();

        foreach ($lotes as $lote) {
            if ($cantidad_restante <= 0)
                break;

            $cantidad_a_tomar = min($lote->cantidad, $cantidad_restante);

            // Actualizar cantidad en el lote
            $this->db->where('id', $lote->id);
            $this->db->set('cantidad', 'cantidad - ' . $cantidad_a_tomar, FALSE);
            $this->db->update('stock_producto');

            $cantidad_restante -= $cantidad_a_tomar;
        }

        // Actualizar stock total en productos
        $this->db->where('producto_id', $producto_id);
        $this->db->set('stock', 'stock - ' . $cantidad_requerida, FALSE);
        $this->db->update('productos');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    // Añade estos métodos a tu clase Productos_model

    public function actualizar_lote($lote_id, $data)
    {
        $this->db->trans_start();

        // Obtener la información actual del lote
        $lote_actual = $this->db->get_where('stock_producto', ['id' => $lote_id])->row();

        if (!$lote_actual) {
            return false;
        }

        // Calcular la diferencia en cantidad
        $diferencia_cantidad = $data['cantidad'] - $lote_actual->cantidad;

        // Actualizar el stock total del producto
        if ($diferencia_cantidad != 0) {
            $this->db->set('stock', 'stock + ' . $diferencia_cantidad, FALSE);
            $this->db->where('producto_id', $lote_actual->producto_id);
            $this->db->update('productos');
        }

        // Actualizar la información del lote
        $this->db->where('id', $lote_id);
        $resultado = $this->db->update('stock_producto', [
            'lote' => $data['lote'],
            'cantidad' => $data['cantidad'],
            'fecha_vencimiento' => $data['fecha_vencimiento']
        ]);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function eliminar_lote($lote_id)
    {
        $this->db->trans_start();

        // Obtener la información del lote antes de eliminarlo
        $lote = $this->db->get_where('stock_producto', ['id' => $lote_id])->row();

        if (!$lote) {
            return false;
        }

        // Actualizar el stock total del producto
        $this->db->set('stock', 'stock - ' . $lote->cantidad, FALSE);
        $this->db->where('producto_id', $lote->producto_id);
        $this->db->update('productos');

        // Eliminar el lote
        $this->db->where('id', $lote_id);
        $resultado = $this->db->delete('stock_producto');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function obtener_lote($lote_id)
    {
        return $this->db->get_where('stock_producto', ['id' => $lote_id])->row();
    }

    public function validar_lote($lote_id, $producto_id)
    {
        $this->db->where('id', $lote_id);
        $this->db->where('producto_id', $producto_id);
        return $this->db->get('stock_producto')->row() !== null;
    }

    // Método para obtener el total de stock por producto incluyendo lotes
    public function get_total_stock($producto_id)
    {
        $this->db->select_sum('cantidad');
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get('stock_producto');
        return $query->row()->cantidad;
    }

    // Método para validar si se puede actualizar un lote
    public function puede_actualizar_lote($lote_id, $nueva_cantidad)
    {
        $lote = $this->obtener_lote($lote_id);
        if (!$lote) {
            return false;
        }

        // Verificar si el lote ya ha sido usado en ventas
        $this->db->select_sum('cantidad');
        $this->db->from('detalles_pedidos');
        $this->db->where('producto_id', $lote->producto_id);
        $this->db->where('estado', 1); // Pedidos activos
        $query = $this->db->get();
        $cantidad_vendida = $query->row()->cantidad ?? 0;

        // Si la nueva cantidad es menor que la cantidad vendida, no se puede actualizar
        if ($nueva_cantidad < $cantidad_vendida) {
            return false;
        }

        return true;
    }

    public function get_lotes_por_vencer($producto_id, $dias = 30)
    {
        $fecha_limite = date('Y-m-d', strtotime('+' . $dias . ' days'));

        $this->db->select('*');
        $this->db->from('stock_producto');
        $this->db->where('producto_id', $producto_id);
        $this->db->where('fecha_vencimiento <=', $fecha_limite);
        $this->db->where('fecha_vencimiento >=', date('Y-m-d'));
        $this->db->where('cantidad >', 0);
        $this->db->order_by('fecha_vencimiento', 'ASC');

        return $this->db->get()->result();
    }

    public function get_historial_lotes($producto_id)
    {
        $this->db->select('sp.*, p.nombre as nombre_producto');
        $this->db->from('stock_producto sp');
        $this->db->join('productos p', 'p.producto_id = sp.producto_id');
        $this->db->where('sp.producto_id', $producto_id);
        $this->db->order_by('sp.fecha_ingreso', 'DESC');

        return $this->db->get()->result();
    }
    public function validar_lote_en_uso($lote_id)
    {
        $lote = $this->obtener_lote($lote_id);
        if (!$lote) {
            return false;
        }

        // Verificar si hay detalles de pedidos que usan este lote
        $this->db->select('COUNT(*) as total');
        $this->db->from('detalles_pedidos');
        $this->db->where('producto_id', $lote->producto_id);
        $this->db->where('estado', 1);
        $query = $this->db->get();
        $resultado = $query->row();

        return $resultado->total > 0;
    }
}
