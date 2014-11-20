<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> library('form_validation');
        $this->load->model('login_model'); 
        $this->load->model('main_model'); 
        $this->load->model('settings_model'); 
        $this->load->library("pagination");
    }
    //rediredted to dashboiard after login
    public function index($message=''){

        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
            if($data['menu']['logged_in']['usertype']=='admin'){
                //echo 'amdin logged in';exit;
                $data['user_details']=$this -> main_model-> alluserdetails();
                $data['sucessmessage']=$message;
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this-> load-> view('admindashboard-view',$data);
                $this->load->view('themes/footer',$data);
            }elseif($data['menu']['logged_in']['usertype']=='sub_admin'){
                $userid=$data['menu']['logged_in']['registration_id'];
                //redirect to sub admin dashboard
                $this-> subadmindashboard($userid,$message);
            }
            elseif($data['menu']['logged_in']['usertype']=='dealership'){
                $data['menu']=$this->login_model->loginauth();
                $userid=$data['menu']['logged_in']['registration_id'];
                //redirect to dealer dashboard
                $this->dealerdashboard($userid);
            }
            else{
                //getting dealer details
                $data['user_details']=$this -> main_model-> dealerdetails($data['menu']['logged_in']['usertype'],$data['menu']['logged_in']['registration_id']);
                if($data['menu']['logged_in']['usertype']=='auto_brand'){
                    $data['dealer_id_upload_data']=$data['menu']['logged_in']['registration_id'];
                }
                    $this->load->view('themes/header',$data);
                    $this->load->view('themes/side-bar',$data);
                    $this-> load-> view('dashboard-view',$data);
                    $this->load->view('themes/footer',$data);
            }
        }else{
            redirect(base_url().'login');
        } 
    }
    //delete account
    public function delete($propertyid){
        $data['menu']=$this->login_model->loginauth();    
        $property=$this->main_model->property_delete($propertyid);
        echo 'Done'; 
    }
    //campain delete
    public function deletecampign($campignid){
        $data['menu']=$this->login_model->loginauth();    
        $property=$this->main_model->delete_eventcampign($campignid);
        echo 'Done'; 
    }
    //admin dealer dashboard view
    public function dealershipdashbaord(){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            if($data['menu']['logged_in']['usertype']=='admin'){  
                //getting dealer details
                $data['user_details']=$this -> main_model-> alluserdetails();   
            }else{
                $data['user_details']=$this -> main_model-> dealerdetails($data['menu']['logged_in']['usertype'],$data['menu']['logged_in']['registration_id']);
            }
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this-> load-> view('dashboard-view',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        } 
    }
    //getting dealer details
    public function viewdashbord($user_id){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            //$data['details'] = $this -> main_model -> user_data($user_id);
            $data['dealer_id_upload_data']=$user_id;
            //getting dealer details from dealer id
            $data['user_details']=$this -> main_model-> dealerfulldetails($user_id);
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this-> load-> view('view-full-dashboard',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        }  
    }
    //redirect to dealer dashboard
    public function dealerdashboard($dealers_userid){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            $data['logged_in_user_type'] = $data['menu']['logged_in']['usertype'];
            $data['dealerdashboard']=$dealers_userid; 
            $data['date_created']=$this -> main_model-> updated_date_file($dealers_userid);    
            $this->load->view('themes/header',$data);
            $this->load->view('themes/dealerside-bar',$data);
            $this-> load-> view('dealerdashboard-view',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        } 
    }
    //getting sorted list of dealers
    public function usersortdashboard(){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            $membertype=$this->input->post('member_type');
            if($membertype!=''){
                $data['member_type']=$this->input->post('member_type'); 
                $data['user_details']=$this -> main_model-> sortuserdetails();
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this-> load-> view('dashboard-view',$data);
                $this->load->view('themes/footer',$data);
            }else{
                redirect(base_url().'dashboard');
            }
        }else{
                redirect(base_url().'login');
        } 
    }
    //redirect to sub admin dashboard
    public function subadmindashboard($user_id,$message=''){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            if($data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='admin'){
                //get assigned users for sub admin
                $data['user_details']=$this -> main_model-> subadmindisplay($user_id); 
                $data['sucessmessage']=$message;          
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this-> load-> view('admindashboard-view',$data);
                $this->load->view('themes/footer',$data);
            }else{
                redirect(base_url().'login');
            }
        }else{
            redirect(base_url().'login');
        }
    }
    //getting contact details
    public function account_mangercontact_details($manager_id){
        $data['manager_id']=$manager_id;
        $data['get_managerdetails']=$this -> main_model -> user_data($manager_id);
        $this-> load-> view('manager-contact-view',$data);
    }
    //viewing  event details for a dealer
    public function eventdetails_view($event_id,$dealeruser_id){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            $data['dealerdashboard']=$data['menu']['logged_in']['registration_id'];
            $data['user_id']=$dealeruser_id;
            $data['event_id']=$event_id;
            //getting event details
            $data['event_details']=$this -> settings_model-> get_campignevent_details($event_id);
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='admin'){
            $this->load->view('themes/side-bar',$data);
            }else{
            $this->load->view('themes/dealerside-bar',$data);  
            }
            $this-> load-> view('eventdetails-view',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        }    
    }
    public function dealerdashboardcopy(){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
            if($data['menu']['logged_in']['usertype']=='dealership'){
            $data['logged_in_user_type'] = 'dealership';
            }else{
                $data['logged_in_user_type'] = '';   
            }
            $dealers_userid='';
            $data['dealerdashboard']=$dealers_userid;     
            $this->load->view('themes/header',$data);
            $this->load->view('themes/dealerside-bar',$data);
            $this-> load-> view('dealerdashboard-viewcopy',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        } 
    }
    //function to get master vehicle details
    public function master_vehicledetails(){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        //getting master vehicle details
        $data['member_details']=$this->settings_model->getmaster_details();
        if (isset($data['menu']['logged_in']) != ''){
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this-> load-> view('masterdetails-view',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        }
    }
}
