<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Cargar TCPDF desde Composer
require_once FCPATH . 'vendor/autoload.php';

class Pdf2 extends TCPDF
{
    public function __construct()
    {
        parent::__construct('P', 'mm', array(80, 180), true, 'UTF-8', false);

        // Configuración inicial
        $this->SetCreator('Sistema');
        $this->SetAuthor('Mi Sistema');
        $this->SetMargins(5, 5, 5);
        $this->SetAutoPageBreak(TRUE, 10);

        // Eliminar cabecera y pie de página por defecto
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
    }
}