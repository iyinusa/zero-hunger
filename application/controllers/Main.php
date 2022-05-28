<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index() {
		
		$data['title'] = 'Welcome to '.app_name;
		$data['page_active'] = 'main';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('main', $data);
		$this->load->view('designs/main_footer', $data);
	}
}
