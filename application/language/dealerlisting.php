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
        if (isset($data['menu']['logged_in'])!= '') {
        }
        else{
            redirect(base_url().'login');
        }
    }
    /*Function to list all dealers under the account manager*/
    public function index(){
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
            $user_id=$data['menu']['logged_in']['registration_id'];
            $data['title'] = 'Exclusive Private Sale Inc';
            $data['user_details']=$this->main_model->getdealerslisting($user_id);
            print_r($data['user_details']);
            /*$this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this->load->view('account-dealer',$data);
            $this->load->view('themes/footer',$data);*/
        }
        
    }
}    