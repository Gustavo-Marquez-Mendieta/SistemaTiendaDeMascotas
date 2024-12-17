<?php
class Pedido_model extends CI_Model
{

    public function guardar_pedido($cliente_id)
    {
        $data = array(
            'cliente_id' => $cliente_id
        );

        $this->db->insert('pedidos', $data);
        $insert_id = $this->db->insert_id();
        log_message('debug', 'ID del pedido insertado: ' . $insert_id);
        return $insert_id;
    }

    public function guardar_detalle_pedido($pedido_id, $producto_id, $cantidad)
    {
        $data = array(
            'pedido_id' => $pedido_id,
            'producto_id' => $producto_id,
            'cantidad' => $cantidad
        );

        $result = $this->db->insert('detalles_pedidos', $data);
        log_message('debug', 'Resultado de la inserción del detalle del pedido: ' . ($result ? 'Éxito' : 'Error'));
        return $result;
    }
    
}
