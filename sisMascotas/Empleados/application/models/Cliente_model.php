<?php
class Cliente_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function guardar_cliente($data)
    {
        // Guardar los datos del cliente en la base de datos
        $this->db->insert('clientes', $data);

        // Retornar el ID del cliente insertado
        return $this->db->insert_id();
    }

    public function buscar_cliente_por_ci($ci)
    {
        $this->db->where('ci', $ci);
        $query = $this->db->get('clientes');
        return $query->row(); // Retorna el cliente si existe, o NULL si no existe
    }
    public function actualizar_total_compras($cliente_id, $cantidad_total)
    {
        $this->db->set('total_compras', 'COALESCE(total_compras, 0) + ' . $cantidad_total, FALSE);
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('clientes');
    }
    public function get_cliente_by_id($cliente_id)
    {
        return $this->db->get_where('clientes', ['cliente_id' => $cliente_id])->row_array();
    }

    public function update_cliente($cliente_id, $data)
    {
        return $this->db->update('clientes', $data, ['cliente_id' => $cliente_id]);
    }
    // Función para obtener todos los clientes
    public function get_all_clients()
    {
        $query = $this->db->get('clientes'); // 'clientes' es el nombre de tu tabla
        return $query->result_array();
    }
    public function actualizar_cliente($cliente_id, $data)
    {
        $this->db->where('cliente_id', $cliente_id);
        return $this->db->update('clientes', $data);
    }

}
