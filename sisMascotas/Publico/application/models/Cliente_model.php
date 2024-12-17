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

}
