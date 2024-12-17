<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_Model
{
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
    // Obtener todos los productos
    public function obtenerProductos()
    {
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtenerProducto()
    {
        $query = $this->db->get('productos');
        return $query->result_array();
    }

    // Obtener un producto por su ID
    public function obtenerProductoPorId($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }
    // Actualizar producto
    public function update_producto($id, $data)
    {
        $this->db->where('producto_id', $id);
        return $this->db->update('productos', $data);
    }

    // Eliminar producto
    public function delete_producto($id)
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
    public function obtener_alimento_humedo_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Alimento Humedo');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_alimento_seco_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Alimento Seco');
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

    public function obtener_productos()
    {
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
        $this->db->where('categoria', 'Higiene');
        $this->db->where('estado', 1);
        $query = $this->db->get('productos');
        return $query->result();
    }

    // Obtiene todos los productos del carrito
    public function obtener_carrito()
    {
        return $this->session->userdata('carrito') ?: array(); // Asegúrate de que devuelva un array
    }
    public function get_cantidad_total()
    {
        $this->db->from('productos');
        return $this->db->count_all_results();
    }
    // Elimina un producto del carrito
    public function eliminar_del_carrito($producto_id)
    {
        $carrito = $this->session->userdata('carrito');

        if (is_array($carrito) && isset($carrito[$producto_id])) {
            unset($carrito[$producto_id]);
            $this->session->set_userdata('carrito', $carrito);
        }
    }
    // Limpia el carrito
    public function vaciar_carrito()
    {
        $this->session->unset_userdata('carrito');
    }
    public function get_productos_by_id($producto_id)
    {
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get('productos');
        return $query->row_array();
    }
    public function obtener_producto($producto_id)
    {
        return $this->db->get_where('productos', ['producto_id' => $producto_id])->row();
    }

    // Actualizar el stock del producto
    public function actualizar_stock($producto_id, $nuevo_stock)
    {
        $this->db->where('producto_id', $producto_id);
        return $this->db->update('productos', ['stock' => $nuevo_stock]);
    }
}
