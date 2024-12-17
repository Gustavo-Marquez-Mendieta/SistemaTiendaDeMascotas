<?php
class Pedido_model extends CI_Model
{

    public function guardar_pedido($cliente_id)
    {
        $data = array(
            'cliente_id' => $cliente_id,
        );

        $this->db->insert('pedidos', $data);
        $insert_id = $this->db->insert_id();
        log_message('debug', 'ID del pedido insertado: ' . $insert_id);
        return $insert_id;
    }
    public function obtenerDetallesPorPedido($pedido_id)
    {
        $this->db->select('
            productos.nombre as producto_nombre,
            detalles_pedidos.cantidad,
            detalles_pedidos.estado,
            productos.precio,
            productos.oferta,
            (CASE 
                WHEN productos.oferta = 1 THEN productos.precio * 0.9
                WHEN productos.oferta = 2 THEN productos.precio * 0.85
                WHEN productos.oferta = 3 THEN productos.precio * 0.8
                ELSE productos.precio
            END) as precio_con_descuento,
            (detalles_pedidos.cantidad * 
                (CASE 
                    WHEN productos.oferta = 1 THEN productos.precio * 0.9
                    WHEN productos.oferta = 2 THEN productos.precio * 0.85
                    WHEN productos.oferta = 3 THEN productos.precio * 0.8
                    ELSE productos.precio
                END)
            ) as total_item,
            clientes.nombre as cliente_nombre,
            clientes.ci as cliente_ci
        ');
        $this->db->from('detalles_pedidos');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');
        $this->db->join('pedidos', 'detalles_pedidos.pedido_id = pedidos.id');
        $this->db->join('clientes', 'pedidos.cliente_id = clientes.cliente_id');
        $this->db->where('detalles_pedidos.pedido_id', $pedido_id);

        return $this->db->get()->result_array();
    }

    public function obtenerClientePorPedido($pedido_id)
    {
        $this->db->select('clientes.nombre, clientes.primerApellido, clientes.segundoApellido');
        $this->db->from('clientes');
        $this->db->join('pedidos', 'pedidos.cliente_id = clientes.cliente_id');
        $this->db->where('pedidos.id', $pedido_id);
        return $this->db->get()->row_array();
    }





    public function obtener_detalles_por_pedido($pedido_id)
    {
        $this->db->select('dp.cantidad, dp.estado, p.nombre AS producto_nombre, p.precio');
        $this->db->from('detalles_pedidos dp');
        $this->db->join('productos p', 'dp.producto_id = p.producto_id');
        $this->db->where('dp.pedido_id', $pedido_id);
        $query = $this->db->get();

        return $query->result_array(); // Devuelve un arreglo con los detalles
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
    public function get_pedidos($ci = null)
    {
        $query = "
        SELECT 
            detalles_pedidos.pedido_id,
            CONCAT(Clientes.nombre, ' ', Clientes.primerApellido, 
                CASE 
                    WHEN Clientes.segundoApellido IS NOT NULL 
                    THEN CONCAT(' ', Clientes.segundoApellido) 
                    ELSE '' 
                END) AS cliente_nombre,
            Clientes.ci AS cliente_ci,
            productos.nombre AS producto_nombre,
            detalles_pedidos.cantidad AS cantidad,
            CASE 
                WHEN detalles_pedidos.estado = 1 THEN 'Pendiente'
                WHEN detalles_pedidos.estado = 2 THEN 'Cancelado'
                WHEN detalles_pedidos.estado = 3 THEN 'Completado'
                ELSE 'Desconocido'
            END AS estado,
            productos.precio AS precio,
            productos.oferta AS oferta,
            pedidos.fechapedido AS fecha_pedido,
            CASE 
                WHEN productos.oferta = 1 THEN productos.precio * 0.90
                WHEN productos.oferta = 2 THEN productos.precio * 0.85
                WHEN productos.oferta = 3 THEN productos.precio * 0.80
                ELSE productos.precio
            END AS precio_con_descuento,
            (detalles_pedidos.cantidad * 
                CASE 
                    WHEN productos.oferta = 1 THEN productos.precio * 0.90
                    WHEN productos.oferta = 2 THEN productos.precio * 0.85
                    WHEN productos.oferta = 3 THEN productos.precio * 0.80
                    ELSE productos.precio
                END
            ) AS total
        FROM detalles_pedidos
        JOIN pedidos ON detalles_pedidos.pedido_id = pedidos.id
        JOIN Clientes ON pedidos.cliente_id = Clientes.cliente_id
        JOIN productos ON detalles_pedidos.producto_id = productos.producto_id
        WHERE detalles_pedidos.estado = 1
        ";

        if ($ci) {
            $query .= " AND Clientes.ci = " . $this->db->escape($ci);
        }

        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function get_detalles_pedidos($pedido_id)
    {
        $this->db->select('detalles_pedidos.producto_id,
                   productos.nombre AS producto_nombre,
                   detalles_pedidos.cantidad,
                   detalles_pedidos.estado,
                   productos.precio,
                   COALESCE(
                       CASE productos.oferta
                           WHEN 1 THEN productos.precio * 0.90  # 10% descuento
                           WHEN 2 THEN productos.precio * 0.85  # 15% descuento
                           WHEN 3 THEN productos.precio * 0.80  # 20% descuento
                           ELSE productos.precio
                       END,
                       productos.precio
                   ) as precio_con_descuento,
                   COALESCE(
                       detalles_pedidos.cantidad * 
                       CASE productos.oferta
                           WHEN 1 THEN productos.precio * 0.90
                           WHEN 2 THEN productos.precio * 0.85
                           WHEN 3 THEN productos.precio * 0.80
                           ELSE productos.precio
                       END,
                       detalles_pedidos.cantidad * productos.precio
                   ) AS total');
        $this->db->from('detalles_pedidos');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');
        $this->db->where('detalles_pedidos.pedido_id', $pedido_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_pedidosAdmin($ci = null)
    {
        $this->db->select('detalles_pedidos.pedido_id,
                        Clientes.nombre AS cliente_nombre, 
                        Clientes.ci AS cliente_ci, 
                        productos.nombre AS producto_nombre, 
                        detalles_pedidos.cantidad AS cantidad,
                        CASE detalles_pedidos.estado
                            WHEN 1 THEN \'Pendiente\'
                            WHEN 2 THEN \'Cancelado\'
                            WHEN 3 THEN \'Completado\'
                            ELSE \'Desconocido\'
                        END AS estado,
                        productos.precio AS precio, 
                        pedidos.fechapedido AS fecha_pedido,
                        (detalles_pedidos.cantidad * productos.precio) AS total');
        $this->db->from('detalles_pedidos');
        $this->db->join('pedidos', 'detalles_pedidos.pedido_id = pedidos.id');
        $this->db->join('Clientes', 'pedidos.cliente_id = Clientes.cliente_id');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');

        // Si se proporciona un CI, filtra los resultados
        if ($ci) {
            $this->db->where('clientes.ci', $ci);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function actualizar_estado_pedido($pedido_id, $estado)
    {
        $this->db->where('pedido_id', $pedido_id);
        return $this->db->update('detalles_pedidos', array('estado' => $estado));
    }
    public function get_pedido_by_id($pedido_id)
    {
        $this->db->select('pedidos.id AS pedido_id, 
                            pedidos.cliente_id, 
                            pedidos.fechaPedido AS fecha_pedido,
                            (SUM(detalles_pedidos.cantidad * productos.precio)) AS total');
        $this->db->from('pedidos');
        $this->db->join('detalles_pedidos', 'pedidos.id = detalles_pedidos.pedido_id');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');
        $this->db->where('pedidos.id', $pedido_id);
        $this->db->group_by('pedidos.id');

        $query = $this->db->get();
        return $query->row_array(); // Usa row_array para un solo resultado
    }
    public function get_pedidos_with_details()
    {
        $this->db->select('pedidos.*, clientes.cliente_id, clientes.nombre AS cliente_nombre, clientes.ci AS cliente_ci');
        $this->db->from('pedidos');
        $this->db->join('clientes', 'pedidos.cliente_id = clientes.cliente_id');
        $pedidos = $this->db->get()->result_array();

        foreach ($pedidos as &$pedido) {
            $this->db->select('productos.nombre AS producto_nombre, detalles_pedidos.cantidad, productos.precio');
            $this->db->from('detalles_pedidos');
            $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');
            $this->db->where('detalles_pedidos.pedido_id', $pedido['id']);
            $pedido['detalles'] = $this->db->get()->result_array();
        }

        return $pedidos;
    }



    public function update_estado_pedido($pedido_id, $estado)
    {
        $this->db->where('id', $pedido_id);
        $this->db->update('pedidos', ['estado' => $estado]);
    }
    public function get_detalles_pedido($pedido_id)
    {
        $this->db->select('producto_id, cantidad');
        $this->db->from('detalles_pedidos');
        $this->db->where('pedido_id', $pedido_id);

        $query = $this->db->get();
        return $query->result_array();
    }
}
