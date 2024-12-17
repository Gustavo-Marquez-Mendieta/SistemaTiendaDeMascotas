<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function getTotalProductos()
    {
        return $this->db->where('estado', 1)->count_all_results('productos');
    }

    public function getTotalVentas()
    {
        // Contar solo ventas entregadas (estado = 3)
        return $this->db->where('estado', 3)->count_all_results('venta');
    }

    public function getTotalClientes()
    {
        return $this->db->count_all_results('clientes');
    }
    public function getClientesPorTotalCompras()
    {
        $this->db->select('nombre, primerApellido, segundoApellido, total_compras, tipo_cliente');
        $this->db->from('clientes');
        $this->db->order_by('total_compras', 'DESC');
        return $this->db->get()->result();
    }
    public function getProductosBajosStock($limite = 5)
    {
        return $this->db->select('nombre, stock, precio')
            ->from('productos')
            ->where('estado', 1) // Productos activos
            ->where('stock <=', 10)
            ->order_by('stock', 'ASC')
            ->limit($limite)
            ->get()
            ->result();
    }

    public function getVentasRecientes($limite = 5)
    {
        return $this->db->select('v.id, 
                                 v.fechaVenta, 
                                 v.total, 
                                 c.nombre, 
                                 c.primerApellido')
            ->from('venta v')
            ->join('clientes c', 'c.cliente_id = v.cliente_id')
            ->where('v.estado', 3)
            ->order_by('v.fechaVenta', 'DESC')
            ->limit($limite)
            ->get()
            ->result();
    }

    public function getAñosDisponibles()
    {
        $this->db->distinct();
        $this->db->select('YEAR(fechaVenta) as año');
        $this->db->from('venta');
        $this->db->where('estado', 3); // Solo años con ventas entregadas
        $this->db->order_by('año', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return [['año' => date('Y')]];
        }

        return $query->result();
    }

    public function getVentasPorMesAño($año = null)
    {
        if ($año === null) {
            $año = date('Y');
        }

        // Crear array base con todos los meses en 0
        $ventas_por_mes = [];
        for ($i = 1; $i <= 12; $i++) {
            $ventas_por_mes[$i] = 0;
        }

        // Obtener ventas entregadas del año seleccionado
        $this->db->select('MONTH(fechaVenta) as mes, SUM(total) as total');
        $this->db->from('venta');
        $this->db->where('YEAR(fechaVenta)', $año);
        $this->db->where('estado', 3); // Solo ventas entregadas
        $this->db->group_by('mes');
        $query = $this->db->get();

        // Llenar con datos reales
        foreach ($query->result() as $row) {
            $ventas_por_mes[intval($row->mes)] = floatval($row->total);
        }

        return array_values($ventas_por_mes);
    }

    public function getVentasMesActual()
    {
        $año_actual = date('Y');
        $mes_actual = date('m');

        $query = $this->db->query("
            SELECT COALESCE(SUM(total), 0) as total_mes
            FROM venta 
            WHERE YEAR(fechaVenta) = ?
            AND MONTH(fechaVenta) = ?
            AND estado = 3",
            array($año_actual, $mes_actual)
        );

        return $query->row()->total_mes;
    }

    public function getProductosMasVendidos($limite = 5)
    {
        return $this->db->query("
            SELECT 
                p.nombre,
                COUNT(dp.producto_id) as total_vendidos,
                SUM(dp.cantidad) as cantidad_total
            FROM detalles_pedidos dp
            JOIN productos p ON p.producto_id = dp.producto_id
            JOIN pedidos pd ON pd.id = dp.pedido_id
            JOIN venta v ON v.pedido_id = pd.id
            WHERE dp.estado = 3 -- Detalles entregados
            AND v.estado = 3 -- Ventas entregadas
            AND p.estado = 1 -- Productos activos
            GROUP BY dp.producto_id, p.nombre
            ORDER BY total_vendidos DESC
            LIMIT ?",
            [$limite]
        )->result();
    }

    // Método para obtener estadísticas de estado de ventas
    public function getEstadisticasVentas()
    {
        $this->db->select('
            SUM(CASE WHEN estado = 1 THEN 1 ELSE 0 END) as pendientes,
            SUM(CASE WHEN estado = 2 THEN 1 ELSE 0 END) as canceladas,
            SUM(CASE WHEN estado = 3 THEN 1 ELSE 0 END) as entregadas
        ');
        $this->db->from('venta');
        return $this->db->get()->row();
    }

    // Método para obtener el total de ventas del año actual
    public function getTotalVentasAñoActual()
    {
        $año_actual = date('Y');

        $this->db->select('COALESCE(SUM(total), 0) as total');
        $this->db->from('venta');
        $this->db->where('YEAR(fechaVenta)', $año_actual);
        $this->db->where('estado', 3); // Solo ventas entregadas

        $query = $this->db->get();
        return $query->row()->total;
    }

    // Método para obtener ventas pendientes
    public function getVentasPendientes($limite = 5)
    {
        return $this->db->select('v.id, v.fechaVenta, v.total, c.nombre, c.primerApellido')
            ->from('venta v')
            ->join('clientes c', 'c.cliente_id = v.cliente_id')
            ->where('v.estado', 1) // Ventas pendientes
            ->order_by('v.fechaVenta', 'ASC')
            ->limit($limite)
            ->get()
            ->result();
    }
}