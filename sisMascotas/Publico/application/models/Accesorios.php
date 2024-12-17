<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accesorios extends CI_Model
{
    public function obtener_camas_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Casas Camas y Frazadas');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_Torres_Rascadores_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Torres y Rascadores');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Platos_Dispensadores_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Platos y Dispensadores');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Transportadores_Jaulas_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Transportadores y Jaulas');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Collares_Percheras_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Collares Correas y Pecheras');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Casas_Camas_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Casas Camas y Frazadas');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Collares_Correas_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Collares Correas y Pecheras');
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
    public function Platos_Dispensadores_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Platos y Dispensadores');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Ropa_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Ropa');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Transportadores_Jaulas_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Transportadores y Jaulas');
        $query = $this->db->get('productos');
        return $query->result();
    }
}