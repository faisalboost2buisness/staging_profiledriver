<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customerdata extends CI_Controller {
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
    //getting customer data
    public function index($dealers_userid=''){
        $this->load->library('session');
        if(isset($_POST['columns'])){
            $this->session->set_userdata('customer_columns',$_POST['columns']);
            $this->session->set_userdata('customer_operators',$_POST['operators']);
            $this->session->set_userdata('customer_values',$_POST['values']);
        }else{
            $this->session->unset_userdata('customer_columns');
            $this->session->unset_userdata('customer_operators');
            $this->session->unset_userdata('customer_values');
        }
        $data['title'] = 'Exclusive Private Sale Inc-View Customer Data';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
//            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='dealership'){
                //get logged in user details
                $data['user_details']=$this -> main_model-> customerdata($dealers_userid);
                $data['dealerdashboard']=$dealers_userid; 
                $this->load->view('themes/header',$data);
                $this->load->view('themes/side-bar',$data);
                $this-> load-> view('customerdata-view',$data);
                $this->load->view('themes/footer',$data);
//            }
        }
        else{
           redirect(base_url().'login');
        } 
    }
    public function jsonCustomerData($dealers_userid=''){
        $this->load->library('session');
        $iTotal=$this -> main_model-> countCustomerData($dealers_userid);
        $user_details=$this -> main_model-> customerDataJson($dealers_userid,$iTotal);
        echo $user_details;
    }

    //getting customer full details
    public function viewcustometdata($dealers_userid){
        $data['title'] = 'Exclusive Private Sale Inc-View Customer Data';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='dealership'){
                //get customer full details by passing customer id
                $data['user_details']=$this -> main_model-> customerdatafulldetails($dealers_userid);
                $data['dealerdashboard']=$dealers_userid; 
                $this->load->view('themes/header',$data);
                $this->load->view('themes/dealerside-bar',$data);
                $this-> load-> view('viewfullcustometdata.php',$data);
                $this->load->view('themes/footer',$data);
            }
        }
        else{
           redirect(base_url().'login');
        } 
    }
}
    ?>