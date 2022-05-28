<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index() {
		
		$data['title'] = app_name.' | About Us';
		$data['page_active'] = 'about';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('about', $data);
		$this->load->view('designs/main_footer', $data);
	}
}
