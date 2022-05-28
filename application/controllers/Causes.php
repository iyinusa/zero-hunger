<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Causes extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index() {
		
		$data['title'] = app_name.' | Causes';
		$data['page_active'] = 'cause';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('cause/cause', $data);
		$this->load->view('designs/main_footer', $data);
	}
	
	public function r($param1='') {
		if(empty($param1)){
			redirect(base_url('causes'), 'refresh');	
		}
		
		if($param1 == 'food') {
			$cause_name = 'Help Increase Food Production';
			$cause_details = 'From 25th Sept. to 20th Dec., 2017, We at ZeroHunger willing to donate food to 5 Motherless Babies Home in Lagos.';
			$cause_plan = 'We work directly with Farmers, take their fresh productions and gift to Hungers. As we all know that Farmers are business people and will need money as a return for their investment, that is why '.app_name.' seeks support for donation for us to be able to pay the farmers on requested productions.<br /><br />So we are going to use your Donations for fresh food productions from Farmers and Logistics to help successful delivery to Hungers.';
			$cause_amt = '1,500,000';
		} else {
			$cause_name = 'Help Stop Malnutrition';
			$cause_details = 'Help us work with Farmers for ensure secure, safe, nutricious and sufficient food and making it available for hungers.';
			$cause_plan = 'As an advocate of Responsible Consumption and Production in Agricultural Sector in Nigeria, '.app_name.' choose to work with farmers to ensure secure, safe, nutricious and sufficient food and making it available to the consumers.<br/><br/>So we are going to use your Donation to provide support to the Farmers and Logistics.';
			$cause_amt = '500,000';
		}
		
		$data['cause_name'] = ucwords($cause_name);
		$data['cause_details'] = $cause_details;
		$data['cause_plan'] = $cause_plan;
		$data['cause_amt'] = $cause_amt;
		
		$data['title'] = ucwords($cause_name).' | '.app_name;
		$data['page_active'] = 'cause';
		
		$this->load->view('designs/main_header', $data);
		$this->load->view('cause/cause_details', $data);
		$this->load->view('designs/main_footer', $data);
	}
	
	public function donate() {
		if($_POST) {
			$cause = $this->input->post('cause_type');
			$amount = $this->input->post('amount');
			
			// convert target to whole integer
			$amount = preg_replace('/\s+/', '', $amount); // remove all in between white spaces
			$amount = str_replace(',', '', $amount); // remove money format
			$amount = floatval($amount);
			
			// try and send activation email
			$email_result = '';
			$email = 'iyinusa@yahoo.co.uk';
			$from = app_email;
			$name = app_name;
			$subject = 'Donation Attempt';
			$sub_head = 'Someone Attempt Donation';
			
			$body = '
				<div class="mname">Dear '.$name.'</div><br/>Someone attempt to Donate &#8358;'.number_format($amount).' for '.$cause.'<br /><br />Warm Regards
			';
			
			$email_result = $this->Crud->send_email($email, $from, $subject, $body, $name, $sub_head);
			if($email_result == TRUE){
				echo $this->Crud->msg('success', 'Thank you! We\'re yet to start operations, we will notify when we are live. We appreciate your Interest and Support.');
			}
		}
	}
}
