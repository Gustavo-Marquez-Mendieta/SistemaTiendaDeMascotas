<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Venta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_venta($data)
    {
        return $this->db->insert('venta', $data);
    }

    public function update_detalles_estado($pedido_id, $estado)
    {
        $this->db->set('estado', $estado);
        $this->db->where('pedido_id', $pedido_id);
        $this->db->update('detalles_pedidos');
    }
    public function get_totales_ventas_por_mes()
    {
        $this->db->select("DATE_FORMAT(fechaVenta, '%Y-%m') as mes, SUM(total) as total_ventas");
        $this->db->from('venta');
        $this->db->where('fechaVenta IS NOT NULL');
        $this->db->group_by("mes");
        $this->db->order_by("mes", "ASC");
        $query = $this->db->get();
        return $query->result();
    }
    public function get_productos_vendidos()
    {
        $this->db->select('venta.fechaVenta, productos.nombre, detalles_pedidos.cantidad, (detalles_pedidos.cantidad * productos.precio) as total_venta');
        $this->db->from('venta');
        $this->db->join('pedidos', 'pedidos.id = venta.pedido_id');
        $this->db->join('detalles_pedidos', 'detalles_pedidos.pedido_id = pedidos.id');
        $this->db->join('productos', 'productos.producto_id = detalles_pedidos.producto_id');
        $this->db->order_by('venta.fechaVenta', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

}
