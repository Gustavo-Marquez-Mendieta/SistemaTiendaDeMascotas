<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alimentos extends CI_Model
{
    public function obtener_alimento_seco_especial()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Alimento Seco Especial');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_Snacks_Premios()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Snacks y Premios');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function AlimentoSecoEspecialPerro()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Alimento Seco Especial');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_Snacks_Premios_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Snacks y Premios');
        $query = $this->db->get('productos');
        return $query->result();
    }
}