<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index() {
		
		$data['title'] = app_name.' | Events';
		$data['page_active'] = 'event';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('event/event', $data);
		$this->load->view('designs/main_footer', $data);
	}
}
