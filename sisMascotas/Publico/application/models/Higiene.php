<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Higiene extends CI_Model
{
    public function Arenas_Sanitarias_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Arenas Sanitarias');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Areneros_Palas_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Areneros y Palas');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Limpieza_Hogar_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Limpieza de Hogar');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Shampoo_Aseo_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Shampoo y Aseo');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Peines_Cepillos_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Peines Cepillos y Cortadoras');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Bolsas_Dispensadores_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Bolsas de Heces y Dispensadores');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Cuidado_uñas_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Cuidado de Uñas');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Cuidado_Dental_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Cuidado Dental');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Limpieza_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Limpieza de Hogar');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Peines_Cepillos_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Peines Cepillos y Cortadoras');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Shampoo_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Shampoo y Aseo');
        $query = $this->db->get('productos');
        return $query->result();
    }
}