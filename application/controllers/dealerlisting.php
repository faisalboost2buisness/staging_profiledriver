<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dealerlisting extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> library('form_validation');
        $this->load->model('login_model'); 
        $this->load->model('main_model'); 
        $this->load->library("pagination");
        $data['menu']=$this->login_model->loginauth();
        if(isset($data['menu']['logged_in'])!='') {
        }else{
            redirect(base_url().'login');
        }
    }
    /*Function to list all dealers under the account manager*/
    public function index($user_id){
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in'])!= '' && $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin') {            
            $data['title'] = 'Exclusive Private Sale Inc';
            $data['user_details']=$this->main_model->getdealerslisting($user_id);          
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this->load->view('account-dealer',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        }
    }
    /*Function to view auto brand dealers*/
    public function auto_brand_dealer($user_id){
        $data['title'] = 'Exclusive Private Sale Inc-Dashboard';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            $data['user_details']=$this -> main_model-> getauto_brand_dealers($user_id); 
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this-> load-> view('view-auto-brand-dealers',$data);
            $this->load->view('themes/footer',$data);
        }else{
            redirect(base_url().'login');
        }
    }
}    