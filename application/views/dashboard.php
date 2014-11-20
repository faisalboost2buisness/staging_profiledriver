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
        
        $this->load->library("pagination");
	}
    public function index()
    {
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
         
              if($data['menu']['logged_in']['usertype']=='admin')
            {
               $data['user_details']=$this -> main_model-> alluserdetails();
               $this->load->view('themes/header',$data);
               $this->load->view('themes/side-bar',$data);
                $this-> load-> view('admindashboard-view',$data);
                $this->load->view('themes/footer',$data);
            }
             elseif($data['menu']['logged_in']['usertype']=='dealership')
            {
                $data['menu']=$this->login_model->loginauth();
                $userid=$data['menu']['logged_in']['registration_id'];
              $this->dealerdashboard($userid); 
            }
            else
            {
                 $data['user_details']=$this -> main_model-> dealerdetails($data['menu']['logged_in']['usertype'],$data['menu']['logged_in']['registration_id']);
            
            // print_r($data['user_details']);
        $this->load->view('themes/header',$data);
        $this->load->view('themes/side-bar',$data);
        $this-> load-> view('dashboard-view',$data);
        $this->load->view('themes/footer',$data);
       }}
       else
       {
           redirect(base_url().'login');
       } 
    }
    public function delete($propertyid){
    $data['menu']=$this->login_model->loginauth();    
        $property=$this->main_model->property_delete($propertyid);
        echo 'Done'; 
    }
    public function get_propertylisting_count($user_id){
        $this -> db -> select('property_id');
        $this -> db -> from(' coba_property_basic');
        $this -> db -> where('property_owner', $user_id );       
        $details = $this -> db -> count_all_results();
		return $details;
    }    
    public function dealershipdashbaord()
    {
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') 
        {
     
            if($data['menu']['logged_in']['usertype']=='admin')
            {   
                $data['user_details']=$this -> main_model-> alluserdetails();   
                
            }
            else
            {
                $data['user_details']=$this -> main_model-> dealerdetails($data['menu']['logged_in']['usertype'],$data['menu']['logged_in']['registration_id']);
            }
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this-> load-> view('dashboard-view',$data);
            $this->load->view('themes/footer',$data);
       }
       else
       {
           redirect(base_url().'login');
       } 
    }
    public function viewdashbord($user_id)
    {
       $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') 
        {
         
          //$data['details'] = $this -> main_model -> user_data($user_id);
          $data['user_details']=$this -> main_model-> dealerfulldetails($user_id);
          $this->load->view('themes/header',$data);
        $this->load->view('themes/side-bar',$data);
        $this-> load-> view('view-full-dashboard',$data);
        $this->load->view('themes/footer',$data);
    
       }
       else
       {
           redirect(base_url().'login');
       }  
    }
public function dealerdashboard($dealers_userid){
    $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
     $data['menu']=$this->login_model->loginauth();
      if (isset($data['menu']['logged_in']) != '') 
     {
      $data['dealerdashboard']=$dealers_userid;     
     $this->load->view('themes/header',$data);
     $this->load->view('themes/dealerside-bar',$data);
     $this-> load-> view('dealerdashboard-view',$data);
     $this->load->view('themes/footer',$data);
     }else
       {
           redirect(base_url().'login');
       } 
     
}
public function usersortdashboard(){
    $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
     $data['menu']=$this->login_model->loginauth();
     if (isset($data['menu']['logged_in']) != '') 
     {
     $data['member_type']=$this->input->post('member_type'); 
     $data['user_details']=$this -> main_model-> sortuserdetails();
     $this->load->view('themes/header',$data);
     $this->load->view('themes/side-bar',$data);
     $this-> load-> view('dashboard-view',$data);
     $this->load->view('themes/footer',$data);
      }
       else
       {
           redirect(base_url().'login');
       } 
}
    }
    ?>