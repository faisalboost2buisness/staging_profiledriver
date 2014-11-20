<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Contact extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this->load->model('login_model'); 
        $this->load->library("pagination");
        $this->load->model("main_model");
        $this->load->model("settings_model");  
    }
    //load view page
    public function index(){
        $this->load->view('contact-view');
    }
    //sending mail to admin in contact
    public function contactprocess(){
        //$emailid=$this->input->post("email");
        $to='ecommercedvlpr@gmail.com';
        $from_email=$this->input->post("email");
        $user_name=$this->input->post("name");
        $phone_number=$this->input->post("phonenumber");
        $usermessage=$this->input->post("message");
        $subject = $this -> input -> post('name') . ' is trying to contact you.';
        $message="Hi admin,<br/><br/>
        $user_name is trying to contact you.<br/>Details are given below<br/><br/>
        Name : $user_name <br/>
        Phone Number : $phone_number <br/>
        E-Mail : $from_email <br/>
        Message:$usermessage<br/><br/>
        Regards,<br/>
        Exclusive Private Sale";
        $this->main_model->HTMLemail($to,$from_email,'',$subject,$message);
    }
}
?>