<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karakter extends CI_Controller {

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('karakter_view');
        $this->load->view('templates/footer');
    }
}
