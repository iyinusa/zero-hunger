<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index() {
		
		$data['title'] = app_name.' | Contact Us';
		$data['page_active'] = 'contact';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('contact', $data);
		$this->load->view('designs/main_footer', $data);
	}
	
	public function send_email() {
		if($_POST) {
			$s_name = $this->input->post('form_name');
			$s_email = $this->input->post('form_email');
			$s_phone = $this->input->post('form_phone');
			$s_subject = $this->input->post('form_subject');
			$s_message = $this->input->post('form_message');
			
			// try and send activation email
			$email_result = '';
			$email = 'iyinusa@yahoo.co.uk, o.adebajo@oviwce.org';
			$from = $s_email;
			$name = app_name;
			$subject = $s_subject;
			$sub_head = 'Contact Message';
			
			$body = '
				<div class="mname">Dear '.$name.'</div><br/>There is a new message from website visitor.<br /><br />
				<b>Name:</b> '.$s_name.'<br />
				<b>Email:</b> '.$s_email.'<br />
				<b>Phone:</b> '.$s_phone.'<br /><br />
				<b>Message:</b><br /> '.$s_message.'<br /><br />Warm Regards
			';
			
			$email_result = $this->Crud->send_email($email, $from, $subject, $body, $name, $sub_head);
			if($email_result == TRUE){
				echo $this->Crud->msg('success', 'Message sent to us, we will contact you within 24 hours. Thank you for reaching out.');
			} else {
				echo $this->Crud->msg('danger', 'Sorry! - Message not sent this time, please try again or use other channel above. Thank you for reaching out.');
			}	
		}
	}
}
