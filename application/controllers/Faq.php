<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('faq_view');
        $this->load->view('templates/footer');
    }
}
