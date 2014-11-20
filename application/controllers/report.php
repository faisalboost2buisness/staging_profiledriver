<?php
class Report extends CI_Controller {
public function __construct() {
parent::__construct();
$this->load->helper('url');
$this->load->library('image_lib');
$this -> load -> model('main_model');
$this -> load -> model('login_model');
$this -> load -> model('report_model');
$data['menu'] = $this -> login_model ->loginauth();
    if (isset($data['menu']['logged_in']) != '') {
   
    }
    else{
    redirect(base_url().'login');
    }
}
public function index(){
  $data['menu']=$this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Report';
        if (isset($data['menu']['logged_in']) != '')
        {
            $data['user_details']=$this -> report_model-> display_report();
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this -> load -> view('report-view',$data);
            $this->load->view('themes/footer',$data);
        }
        else
        {
            redirect(base_url().'login');
        }  
        }
}
?>