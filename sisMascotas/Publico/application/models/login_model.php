<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    //Para que esta funcion sea universal debe ser conocido en toda la app
    //y eso se pone en el autoload.php model hasta abajo

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Asegúrate de que la base de datos esté cargada
    }

    public function agregarusuario1($data)
    {
        return $this->db->insert('usuarios', $data);
    }
    
    public function agregarusuario($data)
    {
        // validar usuario y si no existe insertar, si se inserta devolver true, si no devolver false
        $this->db->insert('usuarios', $data);
        return $this->db->affected_rows() > 0;
    }

    public function validarusuario($user, $password)
    {

        $this->db->where('nombre_usuario', $user);
        $this->db->where('contraseña', $password);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function existeUsuarioPorNombre($nombre_usuario)
    {
        $this->db->where('nombre_usuario', $nombre_usuario);
        $query = $this->db->get('usuarios');
        return $query->num_rows() > 0;
    }

    public function existeUsuarioPorCorreo($correo)
    {
        $this->db->where('email', $correo);
        $query = $this->db->get('usuarios');
        return $query->num_rows() > 0;
    }
}
