<?php
Class Login_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }
    //function to check login
    function logincheck($emailid,$password){        
        $this->load->helper('url'); 
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where('email_id = ' . "'" . $emailid . "'");
        $this->db->where('password = ' . "'" . $password . "'");
        $this->db->limit(1);
        $query = $this -> db -> get();
        if($query->num_rows()==1){
            $returnvalue= $query->row_array();
            $userid=$returnvalue['registration_id'];        
            return $returnvalue;
        }else{
            return false;
        }
    }
    //function to insert account manager details
    function managerregistration_insert($password_text){
        $emailid=$this->input->post('email');
        $this->db->select('registration_id');
        $this->db->from('registration');
        $this->db->where('email_id = ' . "'" . $emailid . "'");
        $this->db->limit(1);
        $result=$this->db-> get();
        if($result->num_rows()>0){
            return 0;
        }else{    
            $data=array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'email_id'=>$this->input->post('email'),
            'usertype'=>$this->input->post('membership'),
            'contact_phone_number'=>$this->input->post('contact_phoneno'),
            'password'=>$password_text,
            'created_id'=>$this->input->post('created_id')
            );
            $this->db->insert("registration", $data);
            $last_id = $this->db->insert_id();
            return $last_id;
        }
    }
    //registraion insert
    function registration_insert($password_text){
        $emailid=$this->input->post('email');
        $this->db->select('registration_id');
        $this->db->from('registration');
        $this->db->where('email_id = ' . "'" . $emailid . "'");
        $this->db->limit(1);
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
            return 0;
        }else{
        if($this->input->post('membership')=='auto_brand' || $this->input->post('membership')=='dealership'){            
            $insertfeildvalues=$this->input->post('masterbrand');            
            $commacheck=0;
            $masterbrand='';
            if(is_array($insertfeildvalues) && $insertfeildvalues!=''){
                foreach($insertfeildvalues as $values){ 
                    if($commacheck>0){
                        $masterbrand.=',' ;
                    }
                    $masterbrand.=$values;
                    $commacheck++;
                }
            }
        }else{
            $masterbrand='';            
        }
        if($this->input->post('membership')=='dealership'){            
            $dealer_email=$this->input->post('dealership_email');            
        }else{
            $dealer_email='';
        }
        $country=$this->input->post('country');
        if($country=='Canada'){
            $state=$this->input->post('canadastate');  
        }else{
            $state=$this->input->post('state');
        }
        //insert in to registration table
        $data=array(
        'first_name'=>$this->input->post('first_name'),
        'last_name'=>$this->input->post('last_name'),
        'email_id'=>$this->input->post('email'),
        'company_website'=>$this->input->post('company_website'),
        'company_phonenumber'=>$this->input->post('company_phonenumber'),
        'password'=>$password_text,
        'company_name'=>$this->input->post('company_name'),
        'city'=>$this->input->post('city'),
        'state'=>$state,
        'country'=>$this->input->post('country'),
        'address'=>$this->input->post('address'),
        'zipcode'=>$this->input->post('zipcode'),
        'contact_person'=>$this->input->post('contact_person'),
        'usertype'=>$this->input->post('membership'),
        'contact_phone_number'=>$this->input->post('contact_phoneno'),
        'masterbrand'=>$masterbrand,
        'status'=>'VERIFIED',
        'created_id'=>$this->input->post('created_id'),
        'job_position'=>$this->input->post('job_position'),
        'dealership_email'=>$dealer_email,
        'data_source'=>$this->input->post('data_source'),
        'month'=>date("m"),
        'year'=>date('Y')
        );            
        $this->db->insert("registration", $data);
        $last_id=$this->db->insert_id();            
        //Create folder for user            
        return $last_id;
        }
    }
    //Login session setting
    public function loginauth(){
        $this->load->library('session');
        return $this->session->userdata;
    }
    //insert dealer details to database 
    public function details_save($user_id){
        if($this->input->post('password_dealer_select')!=''){
            $password_get=$this->input->post('password_dealer_select');
        }else{
            $password_get=$this->input->post('password');
        }
        $password=$this -> main_model ->ProtectData($password_get,'ENCODE');
        if($this->input->post('membership')=='auto_brand' || $this->input->post('membership')=='dealership'){
            $insertfeildvalues=$this->input->post('masterbrand');
            $commacheck=0;
            $masterbrand='';
            if(is_array($insertfeildvalues) && $insertfeildvalues!=''){
                foreach ($insertfeildvalues as $values){ 
                    if($commacheck>0){
                        $masterbrand.=',' ;
                    }
                    $masterbrand.=$values;
                    $commacheck++;
                }
            }
        }else{
            $masterbrand='';
        }
        if($this->input->post('membership')=='dealership'){
            $dealer_email=$this->input->post('dealership_email');
        }else{
            $dealer_email='';
        }
        if($this->input->post('country')=='Canada'){
            $state=$this->input->post('canadastate');
        }else{
            $state=$this->input->post('state');  
        }
        $data=array(
        'first_name'=>$this->input->post('first_name'),
        'last_name'=>$this->input->post('last_name'),
        'email_id'=>$this->input->post('email'),
        'company_website'=>$this->input->post('company_website'),
        'company_phonenumber'=>$this->input->post('company_phonenumber'),
        'password'=>$password,
        'company_name'=>$this->input->post('company_name'),
        'city'=>$this->input->post('city'),
        'state'=>$state,
        'country'=>$this->input->post('country'),
        'address'=>$this->input->post('address'),
        'zipcode'=>$this->input->post('zipcode'),
        'contact_person'=>$this->input->post('contact_person'),
        'masterbrand'=>$masterbrand,
        'usertype'=>$this->input->post('membership'),
        'contact_phone_number'=>$this->input->post('contact_phone_number'),
        'job_position'=>$this->input->post('job_position'),
        'dealership_email'=>$dealer_email,
        'data_source'=>$this->input->post('data_source')
        );
        $this->db->where('registration_id',$user_id);
        $this->db->update('registration',$data);
        return $user_id;    
    }
    //function to active user
    public function activate_user($id){
        $this->db->select('status');
        $this->db->from('registration');
        $this->db->where('registration_id = ' . "'" . $id . "'");
        $this->db->limit(1);
        $result=$this->db->get();
        if($result->num_rows()>0){
            $returnvalue=$result->result_array();
            foreach($returnvalue as $value){
                if($value['status']=='NOT-VERIFIED'){
                    //updating registration status
                    $insert_status="UPDATE registration set status='VERIFIED' where registration_id=$id";
                    $result=$this->db->query($insert_status);
                    return TRUE;
                }else{
                    return TRUE;
                }
            }    
        }else{
        
        }
    }
    //function to get postcode using city and state
    public function select_postcode($state,$city){
        $this->db->select('zip');
        $this->db->from('cities');
        $this->db->where('state = ' . "'" . $state . "'");
        $this->db->where('city = ' . "'" . $city . "'");
        $this->db->limit(1);
        $result=$this->db->get();
        if($result->num_rows()>0){
            $returnvalue=$result->row_array();
            $postcode=$returnvalue['zip'];
            return $postcode;
        }
    }
}