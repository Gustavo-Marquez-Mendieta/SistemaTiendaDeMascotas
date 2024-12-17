<?php
class Detalles_model extends CI_Model
{

    public function get_detalles_pedidos()
    {
        $this->db->select('detalles_pedidos.*, productos.nombre as producto_nombre, pedidos.fechaPedido as fechaPedido');
        $this->db->from('detalles_pedidos');
        $this->db->join('productos', 'productos.producto_id = detalles_pedidos.producto_id');
        $this->db->join('pedidos', 'pedidos.id = detalles_pedidos.pedido_id');
        $this->db->where_in('detalles_pedidos.estado', [1, 2]);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_ventas()
    {
        $this->db->select('Venta.*, Clientes.nombre as cliente_nombre,Clientes.primerApellido AS cliente_primerApellido,Clientes.segundoApellido AS cliente_segundoApellido, entregador.nombre as entregador_nombre, entregador.primerApellido as entregador_primerApellido, entregador.segundoApellido as entregador_segundoApellido');
        $this->db->from('Venta');
        $this->db->join('usuario', 'usuario.id = Venta.usuario_id');
        $this->db->join('Clientes', 'Clientes.cliente_id = Venta.cliente_id');
        $this->db->join('pedidos', 'pedidos.id = Venta.pedido_id');
        $this->db->join('usuario as entregador', 'entregador.id = Venta.usuario_id', 'left');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_detalle_pedido($pedido_id) {
        $this->db->select('detalles_pedidos.*, productos.nombre as producto_nombre, productos.precio');
        $this->db->from('detalles_pedidos');
        $this->db->join('productos', 'productos.producto_id = detalles_pedidos.producto_id');
    
        $this->db->where('detalles_pedidos.pedido_id', $pedido_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
