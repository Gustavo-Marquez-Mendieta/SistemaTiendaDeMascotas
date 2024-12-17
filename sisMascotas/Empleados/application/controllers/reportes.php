<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Productos_model');
        $this->load->model('login_model');
        $this->load->model('Usuario_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Pedido_model');
        $this->load->model('Cliente_model');
        $this->load->model('Reportes_model');
    }
    public function reporte_por_usuario()
    {
        $usuario_id = $this->input->post('usuario_id');
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_final = $this->input->post('fecha_final');

        $this->load->model('Reportes_model');
        $data['reporte'] = $this->Reportes_model->get_report_by_user($usuario_id, $fecha_inicio, $fecha_final);

        // Cargar la vista con los datos del reporte
        $this->load->view('administrador/reporte_usuario', $data);
    }

}