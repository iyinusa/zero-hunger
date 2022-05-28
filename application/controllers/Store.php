<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index() {
		
		$data['title'] = app_name.' | Store';
		$data['page_active'] = 'store';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('store/store', $data);
		$this->load->view('designs/main_footer', $data);
	}
}
