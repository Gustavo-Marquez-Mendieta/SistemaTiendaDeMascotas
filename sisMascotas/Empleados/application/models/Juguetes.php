<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Juguetes extends CI_Model
{
    public function Catnip_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Catnip Hierba Gatera');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Juguetes_Gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('tipo', 'Juguetes Gato');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Jueguetes_Goma_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Juguetes Goma y Cuerda');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Pelotas_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Pelotas y Otros');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function Peluches_Perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Peluches');
        $query = $this->db->get('productos');
        return $query->result();
    }
}