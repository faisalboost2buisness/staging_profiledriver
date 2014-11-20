<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admindashboard extends CI_Controller 
{
    public function __construct() 
    {
    parent::__construct();
    $this -> load -> helper('url');
    $this -> load -> library('session');
    $this -> load -> helper('form');
    $this -> load -> library('form_validation');
    $this->load->model('login_model'); 
    $this->load->model('main_model'); 
    $this->load->model('settings_model'); 
    $this->load->library("pagination");
    $this->load->model('dashboard_model');
    $this->load->model(array('auto_brand_model','dealership_model','registration_model'));

   	}
    public function index(){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') 
        {
            /*$data['user_count']=$this->dashboard_model->get_count_of_users();
            $data['dealers_count']=$this->dashboard_model->get_dealer_users();
            $data['accountmanager_count']=$this->dashboard_model->get_accountmanager();
            $data['autobrand_count']= $this->dashboard_model->get_autobrand();
            $data['new_user_details']=$this->dashboard_model->get_new_user_details();*/

            $data['user_count']=$this->registration->count_all();
            $data['dealers_count']=$this->dealership_model->get_dealer_users();
            $data['accountmanager_count']=$this->registration->get_count_by('usertype' , 'accounts_manager');
            $data['autobrand_count']= $this->auto_brand->count_all();
            $data['new_user_details']=$this->dashboard_model->get_new_user_details();
            $this->load->view('themes/header');
            $this->load->view('themes/side-bar',$data);
            $this->load->view('admin-new-dashboard',$data);
            $this->load->view('themes/footer',$data);
        }
    }

    public function generate_pdf(){
         
       $base_path = $this -> config -> item('base_url');
require_once $base_path.'/Generatepdf/create_result.php';
    }
    }
    ?>