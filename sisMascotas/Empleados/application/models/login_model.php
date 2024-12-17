<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function listaproductos()
    {
        $this->db->select('producto_id, nombre, precio, imagen_url');
        $this->db->from('productos');
        return $this->db->get();
    }

    public function agregarusuario($data)
    {
        $this->db->insert('usuario', $data);
        return $this->db->affected_rows() > 0;
    }

    public function obtenerUsuarioPorId($usuario_id)
    {
        $this->db->where('id', $usuario_id); // Asegúrate de que 'id' es el nombre correcto
        $query = $this->db->get('usuario'); // Asegúrate de que 'usuario' es el nombre correcto de la tabla
        return $query->row(); // Debería devolver un objeto con los datos del usuario
    }
    


    public function validarusuario($user, $password)
    {
        log_message('debug', 'Método validarusuario llamado con usuario: ' . $user);

        $this->db->where('email', $user);
        $query = $this->db->get('usuario');

        if ($query->num_rows() == 1) {
            $usuario = $query->row();
            log_message('debug', 'Usuario encontrado. Contraseña hasheada: ' . $usuario->contrasena);

            if (password_verify($password, $usuario->contrasena)) {
                log_message('debug', 'Contraseña correcta');
                return true;
            } else {
                log_message('debug', 'Contraseña incorrecta');
            }
        } else {
            log_message('debug', 'Usuario no encontrado');
        }

        return false;
    }

    public function obtenerUsuarioPorEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('usuario');
        return $query->row();
    }

    public function existeUsuarioPorNombre($nombreUsuario)
    {
        $this->db->where('nombre_usuario', $nombreUsuario);
        $query = $this->db->get('usuario');
        return $query->num_rows() > 0;
    }

    public function existeUsuarioPorCorreo($correo)
    {
        $this->db->where('email', $correo);
        $query = $this->db->get('usuario');
        return $query->num_rows() > 0;
    }
}
