<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    private $title_head = 'Principal';    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['title_head'] = 'Cpanel';        
        $this->load->view('head', $data);
        $this->load->view(strtolower($this->title_head));
        $this->load->view('footer', TRUE);
    }
}
