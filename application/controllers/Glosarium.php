<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Glosarium extends CI_Controller {

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('glosarium_view');
        $this->load->view('templates/footer');
    }
}
