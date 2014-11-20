<?php
class Profile extends CI_Controller {
	public function __construct() {
	parent::__construct();
    $this->load->helper('url');
    $this->load->library('image_lib');
	$this -> load -> model('main_model');
    $this -> load -> model('settings_model');
	$this -> load -> model('login_model');
		$data['menu'] = $this -> login_model ->loginauth();
	if (isset($data['menu']['logged_in']) != '') {

	}
	else{
		redirect(base_url().'login');
	}

}
		function index($registration_id) {
		  $data['title'] = 'Exclusive Private Sale Inc-View Profile';
		$data['menu'] = $this -> login_model -> loginauth();
		if (isset($data['menu']['logged_in']) == '') {
		redirect(base_url().'home');
		} else {
			$data['title'] = 'Exclusive Private Sale Inc-View Profile';
			$this -> load -> helper('form');
            $this -> load -> library('form_validation');
            //$user_id = $data['menu']['logged_in']['user_id'];
            $data['details'] = $this -> main_model -> user_data($registration_id);
            $data['user_id'] = $data['menu']['logged_in']['registration_id'];
            $userid=$data['menu']['logged_in']['registration_id'];
            $user_type = $data['menu']['logged_in']['usertype'];
             if($data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand')
                {
                $data['dealer_id_upload_data']=$data['menu']['logged_in']['registration_id'];
                }
            $this->load->view('themes/header',$data);
            if($user_type=='dealership'){
                    $data['dealerdashboard']=$userid; 
                    $this->load->view('themes/dealerside-bar',$data);    
                }else{
                    $this->load->view('themes/side-bar',$data);
                }
		
			$this -> load -> view('account-information',$data);
			$this -> load -> view('themes/footer', $data);
		}
		}
        public function profilepic_upload(){
	$this->load->view('upload-logo');
    }
    //Function to update account manager details
    public function managerupdate($registration_id){
        $data['menu'] = $this -> login_model -> loginauth();
		if (isset($data['menu']['logged_in']) != '') {
        
			$first_name=$this->input->post('first_name');
		    $last_name=$this->input->post('last_name');
			$mail_address=$this->input->post('email');
            $confirm_password=$this->input->post('confirm_Password');
            $password=$this->input->post('password');
            if($this->input->post('password')!=''){
		    	$passwordinfo='Ok';
		    }else{
		    $passwordinfo='Invalid';
		    }
            $membership=$this->input->post('membership');
            if($first_name=='' || $mail_address==''){
				$data['menu'] = $this -> login_model -> loginauth();
			
				$data['details'] = $this -> main_model -> user_data($registration_id);
				$data['error'] = 'Please fill all mandatory fields';
				$this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
				$this->load->view('account-information',$data);
				$this->load->view('themes/footer',$data);
			//password checking
			}elseif($passwordinfo=='Ok'){
            
			 	$data['menu'] = $this -> login_model -> loginauth();
				$user_id = $data['menu']['logged_in']['registration_id'];
                
				$record=$this->login_model->details_save($registration_id);
                //$this -> settings_model -> update_dealerdetails($registration_id,$dealer_name);
                if($membership=='dealership'){
                    $member_type='Dealer';
                }elseif($membership=='auto_brand'){
                    $member_type='Auto brand';
                }elseif($membership=='account_managers'){
                    $member_type='Account managers';
                }elseif($membership=='sub_admin'){
                    $member_type='Subadmin';
                }else{
                   $member_type='Admin'; 
                }
				if($record>0){
				$data['details'] = $this -> main_model -> user_data($record);
				$data['success'] = ''.ucfirst($member_type).' details updated successfully';
				$this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
				$this->load->view('account-information',$data);
				$this->load->view('themes/footer',$data);
			 }
             
             }else{
             	$data['menu'] = $this -> login_model -> loginauth();
				$user_id = $data['menu']['logged_in']['registration_id'];
                
				$record=$this->login_model->details_save($registration_id);
                //$this -> settings_model -> update_dealerdetails($registration_id,$dealer_name);
				if($record>0){
				$data['details'] = $this -> main_model -> user_data($record);
				$data['success'] = ''.ucfirst($member_type).' details updated successfully';
				$this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
				$this->load->view('account-information',$data);
				$this->load->view('themes/footer',$data);
				} 
                }  
            }
    }
    //profile update
    public function update($registration_id)
        {
        $data['menu'] = $this -> login_model -> loginauth();
        if (isset($data['menu']['logged_in']) != '') 
            {
            $first_name=$this->input->post('first_name');
            $last_name=$this->input->post('last_name');
            $mail_address=$this->input->post('email');
            $company_name=$this->input->post('company_name');
            $phone_number=$this->input->post('company_phonenumber');
            $dealer_name=$this ->input->post('dealers');
            $insertfeildvalues=$this->input->post('masterbrand');
             $city=$this->input->post('city');
            $country=$this->input->post('country');
            if($this->input->post('country')=='Canada')
            {
                $state=$this->input->post('canadastate');
            }else
            {
                $state=$this->input->post('state');  
            }
            $address=$this->input->post('address');
            $zip_code=$this->input->post('zipcode');
            $confirm_password=$this->input->post('confirm_Password');
            $password=$this->input->post('password');
            $membership=$this->input->post('membership');
            //mandatory field checking
            if($first_name=='' || $phone_number=='' ||  $address=='' || $zip_code=='')
            {
                $data['menu'] = $this -> login_model -> loginauth();
                $data['details'] = $this -> main_model -> user_data($registration_id);
                $data['error'] = 'Please fill all mandatory fields';
                $this->load->view('themes/header',$data);
                if($data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand')
                {
                $data['dealer_id_upload_data']=$data['menu']['logged_in']['registration_id'];
                }
                if($data['menu']['logged_in']['usertype']=='dealership')
                {
                $data['dealerdashboard']=$registration_id; 
                $this->load->view('themes/dealerside-bar',$data);    
                }else{
                $this->load->view('themes/side-bar',$data);
                }
                $this->load->view('account-information',$data);
                $this->load->view('themes/footer',$data);
                //password checking
            }
            else
            {
                $data['menu'] = $this -> login_model -> loginauth();
                $user_id = $data['menu']['logged_in']['registration_id'];
                $record=$this->login_model->details_save($registration_id);
                $data['dealer_id_upload_data']=$data['menu']['logged_in']['registration_id'];
                //$this -> settings_model -> update_dealerdetails($registration_id,$dealer_name);
                if($membership=='dealership'){
                $member_type='Dealer';
                }elseif($membership=='auto_brand'){
                $member_type='Auto brand';
                }elseif($membership=='account_managers'){
                $member_type='Account managers';
                }elseif($membership=='sub_admin'){
                $member_type='Subadmin';
                }else{
                $member_type='Admin'; 
                }
                if($record>0){
                $data['details'] = $this -> main_model -> user_data($record);
                $data['success'] = ''.ucfirst($member_type).' details updated successfully';
                $this->load->view('themes/header',$data);
                if($data['menu']['logged_in']['usertype']=='dealership')
                {
                $data['dealerdashboard']=$registration_id; 
                    $this->load->view('themes/dealerside-bar',$data);    
                }else
                {
                    $this->load->view('themes/side-bar',$data);
                }
                $this->load->view('account-information',$data);
                $this->load->view('themes/footer',$data);
                }
            
            }
            }
            else
            {
            	redirect(base_url().'login');
            	
            }
        }
}