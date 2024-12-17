<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Obtener usuario por ID
    public function get_usuarios($id)
    {
        $query = $this->db->get_where('usuario', array('id' => $id));
        return $query->row_array();
    }
    public function existeEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('Usuario'); // Asegúrate de que el nombre de la tabla sea correcto
        if ($query->num_rows() > 0) {
            return true; // El correo existe
        } else {
            return false; // El correo no existe
        }
    }
    public function eliminarUsuario($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('usuario');  // Nombre de la tabla 'usuario'
    }
    public function get_usuario($id)
    {
        $query = $this->db->get_where('usuario', array('id' => $id));
        return $query->row(); // Asegúrate de que devuelve un objeto
    }

    public function validarusuario($user, $password)
    {
        $this->db->where('email', $user);
        $query = $this->db->get('usuario');

        if ($query->num_rows() == 1) {
            $usuario = $query->row();
            if (password_verify($password, $usuario->contrasena)) {
                return true;
            }
        }

        return false;
    }
    public function update_usuario($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('usuario', $data);
    }

    // Obtener todos los usuarios
    public function obtenerUsuarios()
    {
        $query = $this->db->get('usuario');
        return $query->result_array();
    }
    public function activarUsuario($id)
    {
        $data = ['estadoUsuario' => 1, 'fechaActualizacionUsuario' => date('Y-m-d H:i:s')];
        $this->db->where('id', $id);
        return $this->db->update('usuario', $data);
    }

    public function obtenerUsuarioPorId($usuario_id)
    {
        $this->db->where('id', $usuario_id); // Asegúrate de que 'id' es el nombre correcto
        $query = $this->db->get('usuario'); // Asegúrate de que 'usuario' es el nombre correcto de la tabla
        return $query->row(); // Debería devolver un objeto con los datos del usuario
    }

    public function get_all_usuarios()
    {
        $query = $this->db->get('usuario');
        return $query->result();
    }



    public function actualizarUsuario($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('Usuario', $data);
    }


    public function delete_usuario($id)
    {
        $data = array('estadoUsuario' => 0); // Cambiar el estado a 0
        $this->db->where('id', $id);
        return $this->db->update('usuario', $data);
    }
    public function insertarUsuario($data)
    {
        // Inserta el usuario en la base de datos
        if (isset($data['fechaActualizacion'])) {
            unset($data['fechaActualizacion']);
        }
        // Inserta el usuario en la base de datos
        $this->db->insert('usuario', $data);
    }
}
