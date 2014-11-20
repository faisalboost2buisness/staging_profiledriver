<?php
class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this->load->model('login_model');
        $this->load->library("pagination");
        $this->load->model("main_model");
        $this->load->model("settings_model");
        $this->load->library('email');
    }
    /*function to call login page */
    public function index($dealer) {
        $data['menu']=$this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Register';
        if (isset($data['menu']['logged_in']) != '')
        {
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'){
                $data['membershiptype'] =$dealer;
                $data['segment']='upload';
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this -> load -> view('register-view',$data);
                $this->load->view('themes/footer',$data);
            } else
            {
                redirect(base_url().'dashboard');
            }
        }
        else
        {
            redirect(base_url().'login');
        }
    }
    //function to register account manager
    public function managerregisterprocess($membership_id){
        $register='';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '' )
        {

            $first_name=$this->input->post('first_name');
            $last_name=$this->input->post('last_name');
            $phone_number=$this->input->post('contact_phoneno');
            $mail_address=$this->input->post('email');
            $password=$this->input->post('password');
            $confirm_password=$this->input->post('confirm_Password');
            if($first_name=='' || $mail_address=='' || $password=='' || $confirm_password==''){
                $data['error'] = 'Please fill all mandatory fields';
                $data['membershiptype'] =$membership_id;
                $data['segment']='upload';
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this -> load -> view('register-view',$data);
                $this->load->view('themes/footer',$data);  }
            elseif($confirm_password!=$password){
                $data['error'] = 'Password and confirm password mismatching';
                $data['membershiptype'] =$membership_id;
                $data['segment']='upload';
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this -> load -> view('register-view',$data);
                $this->load->view('themes/footer',$data);
            }else{
                $input_password=$this->input->post('password');
                $password=$this -> main_model ->ProtectData($input_password,'ENCODE');
                $register= $this -> login_model -> managerregistration_insert($password);
                $message='';
                if ($register>0) {
                    $to=$this->input->post('email');
                    //$from='gixsysamuel@gmail.com';
                    $admin_emailid= $this -> config -> item('admin_address');
                    $subject='Welcome to Exclusive Private Sale.Inc';
                    $password=$this->input->post('password');
                    $message.= 'Dear '.$first_name.',<br/><br/>
                Welcome to Exclusive Private Sale.Inc<br/><br/>
                You are successfully registered in Exclusive Private Sale.Your username and password is given below<br>
                Username:'.$to.'<br>
                Password:'.$password.'<br><br>';
                    $message.='<a href='.base_url().' target="_blank" class="TableLink">CLICK HERE TO LOGIN</a><br><br></span><br/><br/>';
                    $message.='Regards,<br/>Exclusive Private Sale.Inc';
                    $this->main_model->HTMLemail($to,$admin_emailid,'',$subject,$message);
                    $sendmessage=1;
                    redirect(base_url().'dashboard/'.$sendmessage);
                }else {
                    $data['error'] = 'A member with the same contact email id already exists.';
                    $data['membershiptype'] =$membership_id;
                    $data['segment']='upload';
                    $this->load->view('themes/header',$data);
                    $this->load->view('themes/side-bar',$data);
                    $this->load->view('register-view',$data);
                    $this->load->view('themes/footer',$data);
                }
            }
        }else{
            redirect(base_url().'login');
        }
    }
    //creating membership

    public function registerprocess($membership_id){
        $register='';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '')
        {
            $first_name=$this->input->post('first_name');
            $last_name=$this->input->post('last_name');
            $company_name=$this->input->post('company_name');
            $membership_choose=$this->input->post('membership');
            //$company_logo=$this->input->post('company_logo');
            $mail_address=$this->input->post('email');
            $phone_number=$this->input->post('company_phonenumber');
            $password=addslashes($this->input->post('password'));
            $confirm_password=addslashes($this->input->post('confirm_Password'));
            $company_website=$this->input->post('company_website');
            if($this->input->post('membership')=='auto_brand' || $this->input->post('membership')=='dealership'){
                $masterbrand=$this->input->post('masterbrand');
            }
            $contact_person=$this->input->post('contact_person');
            $address=$this->input->post('address');
            $city=$this->input->post('city');

            $country=$this->input->post('country');
            if($country=='Canada'){
                $state=$this->input->post('canadastate');
            }else{
                $state=$this->input->post('state');
            }

            $zip_code=$this->input->post('zipcode');
            $membership=$this->input->post('membership');
            //$dealer_name=$this ->input->post('dealers');
            //mandatory field checking
            if($first_name=='' || $company_name=='' || $mail_address=='' || $phone_number=='' || $password=='' ||  $address=='' || $zip_code=='' || $confirm_password=='' || $membership==''){
                $data['error'] = 'Please fill all mandatory fields';
                $data['membershiptype'] =$membership_id;
                $data['segment']='upload';
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this -> load -> view('register-view',$data);
                $this->load->view('themes/footer',$data);
                //password checking
            }elseif($confirm_password!=$password){
                $data['error'] = 'Password and confirm password mismatching';
                $data['membershiptype'] =$membership_id;
                $data['segment']='upload';
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this -> load -> view('register-view',$data);
                $this->load->view('themes/footer',$data);
            }else{
                $input_password=$this->input->post('password');
                $password=$this -> main_model ->ProtectData($input_password,'ENCODE');
                $register= $this -> login_model -> registration_insert($password);
                $message='';
                if ($register>0) {
                    if($membership_choose=='dealership'){
                        $date=date('Y-m-d',time());
                        $first_name=trim($this->input->post('first_name'));
                        $company_name_select_dealer=trim($this->input->post('company_name'));
                        $company_name_select= str_replace(" ","",$company_name_select_dealer);
                        $foldername=($company_name_select.'-'.$register.'-'.$date);
                        $base_path = $this -> config -> item('rootpath');
                        $targetPath=$base_path.'/clients/'.$foldername.'/';
                        $file_path=$base_path.'/clients/'.$foldername.'/';
                        if(is_dir($targetPath)){
                        }else{
                            mkdir($file_path, 0755);
                        }
                        $folder_name_update=("Update registration set folder_name='$foldername' where registration_id=$register");
                        $query_folder_updates=$this->db->query($folder_name_update);
                    }
                    $first_name=$this->input->post("first_name");
                    $site_name= $this -> config -> item('site_name');
                    $admin_emailid= $this -> config -> item('admin_address');
                    $subject='Welcome to Exclusive Private Sale.Inc';
                    //$to='ecommercedvlpr@gmail.com';
                    $to=$this->input->post("email");
                    $pswd=$this->input->post("password");
                    $password=$this->input->post('password');
                    $message.= 'Dear '.$first_name.',<br/><br/>
                Welcome to Exclusive Private Sale.Inc<br/>
                You are successfully registered in Exclusive Private Sale.Your username and password is given below<br>
                Username:'.$to.'<br>
                Password:'.$pswd.'<br><br>';
                    $message.='<a href='.base_url().' target="_blank" class="TableLink">CLICK HERE TO LOGIN</a><br><br></span><br/><br/>';
                    $message.='Regards,<br/>Exclusive Private Sale.Inc';
                    $result=$this->main_model->HTMLemail($to,$admin_emailid,'',$subject,$message);
                    $sendmessage=1;
                    redirect(base_url().'dashboard/'.$sendmessage);
                }else {
                    $data['error'] = 'A member with the same contact email id already exists.';
                    $data['membershiptype'] =$membership_id;
                    $data['segment']='upload';
                    $this->load->view('themes/header',$data);
                    $this->load->view('themes/side-bar',$data);
                    $this->load->view('register-view',$data);
                    $this->load->view('themes/footer',$data);
                }
            }

        }else{
            redirect(base_url().'login');
        }
    }
    public function account_activation($id){
        //$activate = $this -> login_model -> activate_user($id);
        //if($activate>0){

        $this->load->view('themes/header');
        $this->load->view('login-view');
        $this->load->view('themes/footer');
        //}
    }
    public function membership(){
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '')
        {
            $data['title'] = 'Exclusive Private Sale Inc-Register';
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this->load->view('membership-view');
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        }
    }
    public function postcodedisplay(){
        $state=$_POST['states'];
        $city=$_POST['city'];
        $result_postcode=$this->login_model->select_postcode($state,$city);
        echo $result_postcode;
    }
}
?>