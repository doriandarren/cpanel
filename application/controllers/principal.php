<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    private $title_head = 'Principal';
    private $descripcion_head = '';
    private $keywords_head = '';
    private $img_head = "public/img/head/logo.jpg";
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['title_head'] = 'Wizakor';
        $data['descripcion_head'] = $this->descripcion_head;
        $data['keywords_head'] = $this->keywords_head;
        $data['img_head'] = $this->img_head;
        
        $this->load->view('head', $data);
        $this->load->view(strtolower($this->title_head));
        $this->load->view('footer', TRUE);
    }
}
