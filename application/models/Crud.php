<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    ////////////////// CLEAR CACHE ///////////////////
	public function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
	
	//////////////////// C - CREATE ///////////////////////
	public function create($table, $data) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();	
	}
	
	//////////////////// R - READ /////////////////////////
	public function read($table) {
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_order($table, $field, $type) {
		$query = $this->db->order_by($field, $type);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_single($field, $value, $table) {
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->where($field, $value);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_single_order($field, $value, $table, $or_field, $or_value) {
		$query = $this->db->order_by($or_field, $or_value);
		$query = $this->db->where($field, $value);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_like($field, $value, $table) {
		$query = $this->db->like($field, $value);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_like2($field, $value, $field2, $value2, $table) {
		$query = $this->db->like($field, $value);
		$query = $this->db->or_like($field2, $value2);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_like3($field, $value, $field2, $value2, $field3, $value3, $table) {
		$query = $this->db->like($field, $value);
		$query = $this->db->or_like($field2, $value2);
		$query = $this->db->or_like($field3, $value3);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read_field($field, $value, $table, $call) {
		$return_call = '';
		$getresult = $this->read_single($field, $value, $table);
		if(!empty($getresult)) {
			foreach($getresult as $result)  {
				$return_call = $result->$call;
			}
		}
		return $return_call;
	}
	
	public function read2($field, $value, $field2, $value2, $table) {
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function read3($field, $value, $field2, $value2, $field3, $value3, $table) {
		$query = $this->db->order_by('id', 'DESC');
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->where($field3, $value3);
		$query = $this->db->get($table);
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	
	public function check($field, $value, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	public function check2($field, $value, $field2, $value2, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	public function check3($field, $value, $field2, $value2, $field3, $value3, $table){
		$query = $this->db->where($field, $value);
		$query = $this->db->where($field2, $value2);
		$query = $this->db->where($field3, $value3);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	//////////////////// U - UPDATE ///////////////////////
	public function update($field, $value, $table, $data) {
		$this->db->where($field, $value);
		$this->db->update($table, $data);
		return $this->db->affected_rows();	
	}
	
	//////////////////// D - DELETE ///////////////////////
	public function delete($field, $value, $table) {
		$this->db->where($field, $value);
		$this->db->delete($table);
		return $this->db->affected_rows();	
	}
	//////////////////// END DATABASE CRUD ///////////////////////
	
	//////////////////// DATATABLE AJAX CRUD ///////////////////////
	public function datatable_query($table, $column_order, $column_search, $order, $where='') {
		// where clause
		if(!empty($where)) {
			$this->db->where(key($where), $where[key($where)]);
		}
		
		$this->db->from($table);
 
		// here combine like queries for search processing
		$i = 0;
		if($_POST['search']['value']) {
			foreach($column_search as $item) {
				if($i == 0) {
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				$i++;
			}
		}
		 
		// here order processing
		if(isset($_POST['order'])) { // order by click column
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order)) { // order by default defined
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
 
	public function datatable_load($table, $column_order, $column_search, $order, $where='') {
		$this->datatable_query($table, $column_order, $column_search, $order, $where);
		
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
 
	public function datatable_filtered($table, $column_order, $column_search, $order, $where='') {
		$this->datatable_query($table, $column_order, $column_search, $order, $where);
		$query = $this->db->get();
		return $query->num_rows();
	}
 
	public function datatable_count($table, $where='') {
		$this->db->select("*");
		
		// where clause
		if(!empty($where)) {
			$this->db->where(key($where), $where[key($where)]);
		}
		
		$this->db->from($table);
		return $this->db->count_all_results();
	} 
	//////////////////// END DATATABLE AJAX CRUD ///////////////////////
	
	//////////////////// GET FIELD ///////////////////////
	public function get_data($id, $field, $table) {
		$getresult = $this->read_single('id', $id, $table);
		
		$result = ''; // default
		if(!empty($getresult)){
			foreach($getresult as $item){
				$result = $item->$field;	
			}
		}
		
		return $result;
	}
	
	//////////////////// NOTIFICATION CRUD ///////////////////////
	public function msg($type = '', $text = ''){
		if($type == 'success'){
			$icon = 'fa fa-check-circle-o';
			$icon_text = 'Successful!';
		} else if($type == 'info'){
			$icon = 'fa fa-exclamation-circle';
			$icon_text = 'Head up!';
		} else if($type == 'warning'){
			$icon = 'fa fa-exclamation-triangle';
			$icon_text = 'Please check!';
		} else if($type == 'danger'){
			$icon = 'fa fa-times-circle-o';
			$icon_text = 'Oops!';
		}
		
		return '
			<div class="alert alert-icon alert-'.$type.'">
				<button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span>
				</button>
				<i class="'.$icon.' fa-2x pull-left"></i> 
				<strong>'.$icon_text.'</strong> '.$text.'
			</div>
		';	
	}
	//////////////////// END NOTIFICATION CRUD ///////////////////////
	
	//////////////////// EMAIL CRUD ///////////////////////
	public function send_email($to, $from, $subject, $body_msg, $name, $subhead) {
		//clear initial email variables
		$this->email->clear(); 
		$email_status = '';
		
		$this->email->to($to);
		$this->email->from($from, $name);
		$this->email->subject($subject);
						
		$mail_data = array('message'=>$body_msg, 'subhead'=>$subhead);
		$this->email->set_mailtype("html"); //use HTML format
		$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
				
		$this->email->message($mail_design);
		if(!$this->email->send()) {
			$email_status = FALSE;
		} else {
			$email_status = TRUE;
		}
		
		return $email_status;
	}
	//////////////////// END EMAIL CRUD ///////////////////////
	
	//////////////////// APP NOTIFY CRUD ///////////////////////
	public function notify($user_id, $user, $email, $phone, $item_id, $item, $title, $details, $type, $hash) {
		// register notification
		$not_data = array(
			'user_id' => $user_id,
			'nhash' => $hash,
			'item_id' => $item_id,
			'item' => $item,
			'new' => 1,
			'title' => $title,
			'details' => $details,
			'type' => $type,
			'reg_date' => date(fdate)
		);
		$not_ins = $this->create('ka_notify', $not_data);
		if($not_ins){
			// send email
			if($type == 'email'){
				$email_result = '';
				$from = app_email;
				$subject = $title;
				$name = app_name;
				$sub_head = $title.' Notification';
				
				$body = '
					<div class="mname">Hi '.ucwords($user).',</div><br />You have new '.$title.' notification,<br /><br />
					'.$details.'<br /><br />
					Warm Regards.
				';
				
				$email_result = $this->send_email($email, $from, $subject, $body, $name, $sub_head);
			} else {
				// send sms	
			}
		}
	}
	//////////////////// END APP NOTIFY CRUD ///////////////////////
	
	//////////////////// IMAGE LIBRARY ///////////////////////
	public function do_upload($htmlFieldName, $path) {
        $config['file_name'] = time();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|tif|bmp';
        $config['max_size'] = '10000';
        $config['max_width'] = '6000';
        $config['max_height'] = '6000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        unset($config);
        
		if (!$this->upload->do_upload($htmlFieldName)){
            return array('error' => $this->upload->display_errors(), 'status' => 0);
        } else {
            $up_data = $this->upload->data();
			return array('status' => 1, 'upload_data' => $this->upload->data(), 'image_width' => $up_data['image_width'], 'image_height' => $up_data['image_height']);
        }
    }
	
	public function resize_image($sourcePath, $desPath, $width = '500', $height = '500', $real_width, $real_height) {
        $this->image_lib->clear();
		$config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
		$config['width'] = $width;
        $config['height'] = $height;
		
		$dim = (intval($real_width) / intval($real_height)) - ($config['width'] / $config['height']);
		$config['master_dim'] = ($dim > 0)? "height" : "width";
		
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->resize())
            return true;
        return false;
    }
	
	public function crop_image($sourcePath, $desPath, $width = '320', $height = '320') {
        $this->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;
		$config['x_axis'] = '20';
		$config['y_axis'] = '20';
        
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->crop())
            return true;
        return false;
    }
	//////////////////// END IMAGE LIBRARY ///////////////////////
	
	//////////////////// SABRE CRUD ///////////////////////
	public function sabre_sandbox($link) {
		$api = 'https://api.test.sabre.com/'.$link; // TEST
		//$api = 'https://api.sabre.com/'.$link; // LIVE
		return $api;
	}
	
	public function sabre_token() {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->sabre_sandbox('v2/auth/token');
		$api_key = 'V1:j6z7mhzv3z4tpg9e:DEVCENTER:EXT';
		$api_secret = 'YY1fkVm8';
		
		// encode authorization (key:secret) using base64_encode or use https://www.base64encode.org/
		$auth_encode = base64_encode(base64_encode($api_key).':'.base64_encode($api_secret));
		
		$chead = array();
		$chead[] = 'Authorization: Basic '.$auth_encode;
		$chead[] = 'Content-Type: application/x-www-form-urlencoded';
		//$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
    	curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function sabre_get($endpoint, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->sabre_sandbox($endpoint);
		
		$chead = array();
		$chead[] = 'Authorization: Bearer '.$token;
		$chead[] = 'Content-Type: application/x-www-form-urlencoded';

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	//////////////////// END SABRE API CRUD ///////////////////////
	
	//////////////////// PAYMENT API CRUD ///////////////////////
	public function pay_sandbox($link) {
		//$api = 'http://moneywave.herokuapp.com/'.$link;
		$api = 'https://live.moneywaveapi.co/'.$link;
		return $api;
	}
	
	public function pay_token() {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/merchant/verify');
		$api_key = 'lv_BTDE1WQFPI3Q3K1V1LA3';
		$api_secret = 'lv_TB99GAPNQMK35OITXDXU9Y5XCFZ72J';
		$curl_data = array('apiKey'=>$api_key, 'secret'=>$api_secret);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
    	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_getbank($code, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		if($code == 'NGN') {
			$api_link = 'https://live.moneywaveapi.co/banks';
		} else {
			$api_link = 'https://live.moneywaveapi.co/banks?country='.$code;	
		}
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_validate($acc_no, $bank_code, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/resolve/account');
		$curl_data = array('account_number'=>$acc_no, 'bank_code'=>$bank_code);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_card_to_wallet($firstname, $lastname, $phonenumber, $email, $card_no, $cvv, $expiry_year, $expiry_month, $amount, $fee, $currency, $redirecturl, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/transfer');
		$recipient = 'wallet';
		$apiKey = 'ts_7GTTG1A0NI2W7QM7B8PT';
		$medium = 'web';
		
		$curl_data = array('firstname'=>$firstname, 'lastname'=>$lastname, 'phonenumber'=>$phonenumber, 'email'=>$email, 'recipient'=>$recipient, 'card_no'=>$card_no, 'cvv'=>$cvv, 'expiry_year'=>$expiry_year, 'expiry_month'=>$expiry_month, 'apiKey'=>$apiKey, 'amount'=>$amount, 'fee'=>$fee, 'redirecturl'=>$redirecturl, 'medium'=>$medium, 'chargeCurrency'=>$currency);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_verify($id, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/transfer/'.$id);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_wallet_to_account($amount, $bankcode, $accountNumber, $currency, $senderName, $token) {
		// create a new cURL resource
		$curl = curl_init();

		// parameters
		$api_link = $this->pay_sandbox('v1/disburse');
		$lock = 'paratech';
		
		$curl_data = array('lock'=>$lock, 'amount'=>$amount, 'bankcode'=>$bankcode, 'accountNumber'=>$accountNumber, 'currency'=>$currency, 'senderName'=>$senderName);
		$curl_data = json_encode($curl_data);
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_wallet_balance($token) {
		// create a new cURL resource
		$curl = curl_init();
		
		$curl_data = array('name'=>'Wallet');
		$curl_data = json_encode($curl_data);

		// parameters
		$api_link = $this->pay_sandbox('v1/wallet');
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		//curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	
	public function pay_wallet_transaction($ref, $token) {
		// create a new cURL resource
		$curl = curl_init();
		
		$curl_data = array('ref'=>$ref);
		$curl_data = json_encode($curl_data);

		// parameters
		$api_link = $this->pay_sandbox('v1/disburse/status');
		
		$chead = array();
		$chead[] = 'Authorization: '.$token;
		$chead[] = 'Content-Type: application/json';
		$chead[] = 'Content-Length: '.strlen($curl_data);

		// set URL and other appropriate options
		curl_setopt($curl, CURLOPT_URL, $api_link);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $chead);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// grab URL and pass it to the browser
		$result = curl_exec($curl);

		// close cURL resource, and free up system resources
		curl_close($curl);

		return $result;
	}
	//////////////////// END PAYMENT API CRUD ///////////////////////
	
	//////////////////// FLIGHT CLASS ///////////////////////
	public function flight_class($code) {
		$class_name = '';
		if($code) {
			if($code == 'P') {
				$class_name = 'Premium First';
			} else if($code == 'F') {
				$class_name = 'First';
			} else if($code == 'J') {
				$class_name = 'Premium Business';
			} else if($code == 'C') {
				$class_name = 'Business';
			} else if($code == 'S') {
				$class_name = 'Premium Economy';
			} else if($code == 'Y') {
				$class_name = 'Economy';
			}
		}
		return $class_name;
	}
	//////////////////// END FLIGHT CLASS ///////////////////////
	
	//////////////////// MUNITES TO HOURS ///////////////////////
	public function to_hours($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor(($time) / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
	//////////////////// END MUNITES TO HOURS ///////////////////////
	
	//////////////////// DATETIME ///////////////////////
	public function get_date($date, $format='') {
		if($format == 'date') {
			$newdate = date('D, M d', strtotime($date));
		} else if($format == 'time') {
			$newdate = date('h:i A', strtotime($date));
		} else {
			$newdate = date('D, M d, Y h:i A', strtotime($date));
		}
		return $newdate;
	}
	//////////////////// END DATETIME ///////////////////////
	
}
