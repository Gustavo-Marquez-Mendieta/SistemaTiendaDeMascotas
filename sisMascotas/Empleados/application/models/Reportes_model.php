<?php
class Reportes_model extends CI_Model
{
    // Reportes_model.php
    // Reportes_model.php
    public function get_reporte_detallado_producto($producto_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('
            p.producto_id,
            p.nombre as producto,
            p.categoria,
            p.mascota,
            p.precio,
            p.stock as stock_actual,
            COUNT(DISTINCT v.id) as total_ventas,
            COUNT(DISTINCT v.cliente_id) as clientes_unicos,
            SUM(dp.cantidad) as unidades_vendidas,
            SUM(dp.cantidad * p.precio) as ingresos_totales,
            ROUND(AVG(dp.cantidad), 2) as promedio_unidades_por_venta,
            MAX(dp.cantidad) as mayor_venta,
            MIN(dp.cantidad) as menor_venta,
            MAX(v.fechaVenta) as ultima_venta,
            (SELECT sp.fecha_vencimiento 
             FROM stock_producto sp 
             WHERE sp.producto_id = p.producto_id 
             AND sp.cantidad > 0 
             AND sp.fecha_vencimiento >= CURDATE()
             ORDER BY sp.fecha_vencimiento ASC 
             LIMIT 1) as proxima_fecha_vencimiento
        ');
        $this->db->from('productos p');
        $this->db->join('detalles_pedidos dp', 'p.producto_id = dp.producto_id', 'left');
        $this->db->join('pedidos ped', 'dp.pedido_id = ped.id', 'left');
        $this->db->join('venta v', 'ped.id = v.pedido_id', 'left');

        if ($producto_id) {
            $this->db->where('p.producto_id', $producto_id);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->group_by('p.producto_id');
        $this->db->order_by('unidades_vendidas', 'DESC');

        return $this->db->get()->result();
    }

    public function get_historial_ventas_detallado($producto_id, $fecha_inicio, $fecha_fin)
    {
        $estado_sql = "CASE 
            WHEN v.estado = 1 THEN 'Pendiente'
            WHEN v.estado = 2 THEN 'Cancelado'
            WHEN v.estado = 3 THEN 'Entregado'
        END";

        $this->db->select('
            v.fechaVenta,
            dp.cantidad,
            p.precio,
            (dp.cantidad * p.precio) as total,
            CONCAT(c.nombre, " ", c.primerApellido) as cliente,
            c.tipo_cliente,
            CONCAT(u.nombre, " ", u.primerApellido) as vendedor,
            ' . $estado_sql . ' as estado_venta
        ', FALSE);

        $this->db->from('detalles_pedidos dp');
        $this->db->join('productos p', 'dp.producto_id = p.producto_id');
        $this->db->join('pedidos ped', 'dp.pedido_id = ped.id');
        $this->db->join('venta v', 'ped.id = v.pedido_id');
        $this->db->join('clientes c', 'v.cliente_id = c.cliente_id');
        $this->db->join('usuario u', 'v.usuario_id = u.id');

        if ($producto_id) {
            $this->db->where('dp.producto_id', $producto_id);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->order_by('v.fechaVenta', 'DESC');
        return $this->db->get()->result();
    }
    public function get_top_clientes_por_producto($producto_id = null, $fecha_inicio = null, $fecha_fin = null)
    {
        $this->db->select('
        c.cliente_id,
        c.nombre,
        c.primerApellido,
        c.segundoApellido,
        c.tipo_cliente,
        COUNT(DISTINCT v.id) as numero_compras,
        SUM(dp.cantidad) as total_unidades,
        SUM(dp.cantidad * p.precio) as total_gastado,
        MAX(v.fechaVenta) as ultima_compra
    ');
        $this->db->from('clientes c');
        $this->db->join('venta v', 'c.cliente_id = v.cliente_id');
        $this->db->join('pedidos ped', 'v.pedido_id = ped.id');
        $this->db->join('detalles_pedidos dp', 'ped.id = dp.pedido_id');
        $this->db->join('productos p', 'dp.producto_id = p.producto_id');

        if ($producto_id) {
            $this->db->where('dp.producto_id', $producto_id);
        }

        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->where('v.estado', 3); // Solo ventas completadas/entregadas
        $this->db->group_by('c.cliente_id');
        $this->db->order_by('total_unidades', 'DESC');
        $this->db->limit(5);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_estadisticas_detalladas_producto($producto_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('
        p.nombre,
        p.categoria,
        p.descripcion,
        p.precio,
        p.stock,
        COUNT(DISTINCT dp.pedido_id) as total_pedidos,
        COALESCE(SUM(dp.cantidad), 0) as total_unidades_vendidas,
        COALESCE(SUM(dp.cantidad * p.precio), 0) as total_ingresos,
        AVG(dp.cantidad) as promedio_unidades_por_venta,
        COUNT(DISTINCT v.cliente_id) as total_clientes_unicos
    ');
        $this->db->from('productos p');
        $this->db->join('detalles_pedidos dp', 'p.producto_id = dp.producto_id', 'left');
        $this->db->join('pedidos ped', 'dp.pedido_id = ped.id', 'left');
        $this->db->join('venta v', 'ped.id = v.pedido_id', 'left');

        if ($producto_id) {
            $this->db->where('p.producto_id', $producto_id);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->group_by('p.producto_id');
        return $this->db->get()->row_array();
    }

    public function get_historial_ventas_producto($producto_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('
        v.fechaVenta,
        dp.cantidad,
        p.precio,
        (dp.cantidad * p.precio) as total,
        c.nombre as cliente_nombre,
        c.primerApellido as cliente_apellido,
        c.tipo_cliente,
        u.nombre as vendedor_nombre
    ');
        $this->db->from('detalles_pedidos dp');
        $this->db->join('productos p', 'dp.producto_id = p.producto_id');
        $this->db->join('pedidos ped', 'dp.pedido_id = ped.id');
        $this->db->join('venta v', 'ped.id = v.pedido_id');
        $this->db->join('clientes c', 'v.cliente_id = c.cliente_id');
        $this->db->join('usuario u', 'v.usuario_id = u.id');

        if ($producto_id) {
            $this->db->where('dp.producto_id', $producto_id);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->order_by('v.fechaVenta', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_tendencia_mensual_producto($producto_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('
        DATE_FORMAT(v.fechaVenta, "%Y-%m") as mes,
        COUNT(DISTINCT dp.pedido_id) as total_ventas,
        SUM(dp.cantidad) as unidades_vendidas,
        SUM(dp.cantidad * p.precio) as total_ingresos,
        AVG(dp.cantidad) as promedio_unidades
    ');
        $this->db->from('detalles_pedidos dp');
        $this->db->join('productos p', 'dp.producto_id = p.producto_id');
        $this->db->join('pedidos ped', 'dp.pedido_id = ped.id');
        $this->db->join('venta v', 'ped.id = v.pedido_id');

        if ($producto_id) {
            $this->db->where('dp.producto_id', $producto_id);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->group_by('mes');
        $this->db->order_by('mes', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_comparativa_categoria($categoria, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('
        p.nombre,
        COUNT(DISTINCT dp.pedido_id) as total_ventas,
        SUM(dp.cantidad) as unidades_vendidas,
        SUM(dp.cantidad * p.precio) as total_ingresos
    ');
        $this->db->from('productos p');
        $this->db->join('detalles_pedidos dp', 'p.producto_id = dp.producto_id', 'left');
        $this->db->join('pedidos ped', 'dp.pedido_id = ped.id', 'left');
        $this->db->join('venta v', 'ped.id = v.pedido_id', 'left');
        $this->db->where('p.categoria', $categoria);

        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio);
            $this->db->where('v.fechaVenta <=', $fecha_fin);
        }

        $this->db->group_by('p.producto_id');
        $this->db->order_by('unidades_vendidas', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }
    public function get_reporte($usuario_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('v.*, v.fechaVenta AS fecha_entrega, u.nombre AS nombre_usuario, u.primerApellido AS apellido_usuario, 
                           c.nombre AS nombre_cliente, c.primerApellido AS apellido_cliente, V.total AS total_pedido');
        $this->db->from('Venta v');
        $this->db->join('usuario u', 'v.usuario_id = u.id'); // Unión con la tabla de usuarios
        $this->db->join('Clientes c', 'v.cliente_id = c.cliente_id'); // Unión con la tabla de clientes

        // Filtrar por ID de usuario y fechas si se proporcionan
        if (!empty($usuario_id)) {
            $this->db->where('v.usuario_id', $usuario_id);
        }
        if (!empty($fecha_inicio)) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio); // Filtrar por fecha de entrega
        }
        if (!empty($fecha_fin)) {
            $fecha_fin = date('Y-m-d', strtotime($fecha_fin . ' +1 day')); // Extender el rango al último día completo
            $this->db->where('v.fechaVenta <', $fecha_fin); // Filtrar por fecha de entrega
        }

        $query = $this->db->get();
        return $query->result();
    }
    public function obtener_reporte($usuario_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('venta.*, usuario.nombre as nombre_usuario, usuario.primerApellido as apellido_usuario, 
                       clientes.nombre as nombre_cliente, clientes.primerApellido as apellido_cliente');
        $this->db->from('venta');
        $this->db->join('usuario', 'venta.usuario_id = usuario.id');
        $this->db->join('clientes', 'venta.cliente_id = clientes.cliente_id');
        $this->db->where('venta.usuario_id', $usuario_id);
        $this->db->where('venta.fechaVenta >=', $fecha_inicio);
        $this->db->where('venta.fechaVenta <=', $fecha_fin);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_reporte_por_categoria($categoria = '', $fecha_inicio = '', $fecha_fin = '')
    {
        // Iniciar la consulta con JOIN para combinar tablas
        $this->db->select('
        productos.categoria,
        productos.nombre as producto,
        productos.precio,
        productos.stock,
        detalles_pedidos.cantidad as cantidad_vendida,
        (productos.precio * detalles_pedidos.cantidad) as total_vendido
    ');
        $this->db->from('detalles_pedidos');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id', 'inner');
        $this->db->join('pedidos', 'detalles_pedidos.pedido_id = pedidos.id', 'inner');
        $this->db->join('venta', 'pedidos.id = venta.pedido_id', 'inner');

        // Aplicar filtro por categoría
        if (!empty($categoria)) {
            $this->db->where('productos.categoria', $categoria);
        }

        // Aplicar filtros por fechas si se proporcionan
        if (!empty($fecha_inicio)) {
            $this->db->where('venta.fechaVenta >=', $fecha_inicio);
        }
        if (!empty($fecha_fin)) {
            $this->db->where('venta.fechaVenta <=', $fecha_fin);
        }

        // Ejecutar la consulta y devolver los resultados
        $query = $this->db->get();
        return $query->result();
    }



    public function get_reporte_por_usuario($usuario_id, $fecha_inicio, $fecha_fin)
    {
        // Asegúrate de que tus columnas y tablas sean correctas
        $this->db->select('venta.*, 
                       usuario.nombre AS nombre_usuario, 
                       usuario.primerApellido AS apellido_usuario, 
                       clientes.nombre AS nombre_cliente, 
                       clientes.primerApellido AS apellido_cliente');
        $this->db->from('venta'); // Cambia esto al nombre de tu tabla de ventas
        $this->db->join('usuario', 'venta.usuario_id = usuario.id'); // Cambia según tu relación
        // Cambia esta línea para usar la relación correcta
        $this->db->join('clientes', 'venta.cliente_id = clientes.cliente_id'); // Referencia correcta a cliente_id
        $this->db->where('venta.usuario_id', $usuario_id);
        $this->db->where('venta.fechaVenta >=', $fecha_inicio);
        $this->db->where('venta.fechaVenta <=', $fecha_fin);
        $query = $this->db->get();

        return $query->result(); // Devuelve los resultados
    }


    public function get_reporte_productos($producto_id = null, $categoria = null, $fecha_inicio = null, $fecha_fin = null)
    {
        $this->db->select('p.nombre AS producto, p.categoria AS categoria, p.precio, p.stock, 
                       COALESCE(SUM(d.cantidad), 0) AS cantidad_vendida, 
                       COALESCE(SUM(d.cantidad * p.precio), 0) AS total_vendido');
        $this->db->from('productos p');
        $this->db->join('detalles_pedidos d', 'p.producto_id = d.producto_id', 'left');
        $this->db->join('pedidos ped', 'd.pedido_id = ped.id', 'left');  // Añadir la unión con la tabla pedidos

        // Filtrar por producto, categoría y fechas
        if ($producto_id) {
            $this->db->where('p.producto_id', $producto_id);
        }
        if ($categoria) {
            $this->db->where('p.categoria', $categoria);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('ped.fechaPedido >=', $fecha_inicio);  // Cambiar 'd.fecha_pedido' por 'ped.fechaPedido'
            $this->db->where('ped.fechaPedido <=', $fecha_fin);  // Cambiar 'd.fecha_pedido' por 'ped.fechaPedido'
        }

        $this->db->group_by('p.producto_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_reporte_productos_por_categoria($categoria = null, $fecha_inicio = null, $fecha_fin = null)
    {
        // Selecciona los campos relevantes de la tabla productos y la tabla venta
        $this->db->select('productos.nombre as producto, productos.categoria, productos.precio, productos.stock, SUM(detalle_pedido.cantidad) as cantidad_vendida, SUM(detalle_pedido.cantidad * productos.precio) as total_vendido');
        $this->db->from('venta');
        $this->db->join('pedidos', 'venta.pedido_id = pedidos.id');  // Unir la tabla venta con pedidos
        $this->db->join('detalle_pedido', 'pedidos.id = detalle_pedido.pedido_id');  // Unir pedidos con detalle_pedido
        $this->db->join('productos', 'detalle_pedido.producto_id = productos.producto_id');  // Unir detalle_pedido con productos

        // Filtros por categoría y fechas
        if (!empty($categoria)) {
            $this->db->where('productos.categoria', $categoria);
        }

        if (!empty($fecha_inicio)) {
            $this->db->where('venta.fechaVenta >=', $fecha_inicio);
        }

        if (!empty($fecha_fin)) {
            $this->db->where('venta.fechaVenta <=', $fecha_fin);
        }

        // Agrupar los resultados por los campos relevantes
        $this->db->group_by('productos.nombre, productos.categoria, productos.precio, productos.stock');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_reporte_productos_por_producto($producto_id = null, $fecha_inicio = null, $fecha_fin = null)
    {
        // Seleccionar campos relevantes, incluyendo el nombre del cliente
        $this->db->select('productos.nombre as producto, productos.categoria, productos.precio, productos.stock, detalles_pedidos.cantidad as cantidad_vendida, (detalles_pedidos.cantidad * productos.precio) as total_vendido, venta.fechaVenta, CONCAT(clientes.nombre, " ", clientes.primerApellido, " ", IFNULL(clientes.segundoApellido, "")) as cliente');
        $this->db->from('venta');
        $this->db->join('pedidos', 'venta.pedido_id = pedidos.id');  // Unir venta con pedidos
        $this->db->join('detalles_pedidos', 'pedidos.id = detalles_pedidos.pedido_id');  // Unir pedidos con detalles_pedidos
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');  // Unir detalles_pedidos con productos
        $this->db->join('clientes', 'venta.cliente_id = clientes.cliente_id');  // Unir venta con clientes

        // Filtro por producto
        if (!empty($producto_id)) {
            $this->db->where('productos.producto_id', $producto_id);
        }

        // Filtro por fechas
        if (!empty($fecha_inicio)) {
            $this->db->where('venta.fechaVenta >=', $fecha_inicio);
        }

        if (!empty($fecha_fin)) {
            $this->db->where('venta.fechaVenta <=', $fecha_fin);
        }

        // Ordenar por fecha de venta
        $this->db->order_by('venta.fechaVenta', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }




    public function get_most_sold_product()
    {
        $this->db->select('D.producto_id, COUNT(*) as cantidad_vendida');
        $this->db->from('detalles_pedidos D');
        $this->db->group_by('D.producto_id');
        $this->db->order_by('cantidad_vendida', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_monthly_sales($fecha_inicio = null, $fecha_fin = null)
    {
        $this->db->select("DATE_FORMAT(ped.fechaPedido, '%Y-%m') as mes, SUM(d.cantidad * p.precio) as total_vendido");
        $this->db->from('detalles_pedidos d');
        $this->db->join('productos p', 'd.producto_id = p.producto_id');
        $this->db->join('pedidos ped', 'd.pedido_id = ped.id');
        $this->db->join('venta v', 'ped.id = v.pedido_id');

        if (!empty($fecha_inicio)) {
            $this->db->where('ped.fechaPedido >=', $fecha_inicio);
        }
        if (!empty($fecha_fin)) {
            $fecha_fin = date('Y-m-d', strtotime($fecha_fin . ' +1 day'));
            $this->db->where('ped.fechaPedido <', $fecha_fin);
        }

        $this->db->group_by("mes");
        $this->db->order_by("mes", 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }




    public function get_productos_por_vencer($dias = 30)
    {
        $fecha_limite = date('Y-m-d', strtotime('+' . $dias . ' days'));
        $fecha_actual = date('Y-m-d');

        $this->db->select('p.producto_id, p.nombre, p.descripcion, p.stock, p.categoria, p.mascota, 
                           sp.fecha_vencimiento, sp.lote, sp.cantidad,
                           DATEDIFF(sp.fecha_vencimiento, CURDATE()) as dias_restantes');
        $this->db->from('productos p');
        $this->db->join('stock_producto sp', 'p.producto_id = sp.producto_id');
        $this->db->where('sp.fecha_vencimiento <=', $fecha_limite);
        $this->db->where('sp.fecha_vencimiento >=', $fecha_actual);
        $this->db->where('sp.cantidad >', 0);
        $this->db->where('p.estado', 1);
        $this->db->order_by('sp.fecha_vencimiento', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }




}