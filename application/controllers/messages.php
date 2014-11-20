<?php
class Messages extends CI_Controller {
    public function __construct() 
    {
    	parent::__construct();
        $this->load->helper('url');
        $this->load->library('image_lib');
    	$this -> load -> model('main_model');
        $this -> load -> model('settings_model');
        $this->load->model('messages_model');
    	$this -> load -> model('login_model');
        $data['segment'] = 'messages';
        $data['menu'] = $this -> login_model ->loginauth();
    	if (isset($data['menu']['logged_in']) != '') {
    
    	}
    	else{
    		redirect(base_url().'login');
    	}
    
    }
    /*
     * 
     * SELECT `buyer_first_name`,`buyer_last_name`,`buyer_address`,`buyer_appartment`,`buyer_city`,`buyer_province`,`buyer_postalcode`,`buyer_homephone`,`buyer_cellphone`,`first_payment_date`,`sold_vehicle_year`,`sold_vehicle_make`,`sold_vehicle_model`,`bodydescription`,`sold_vehicle_VIN`,`vehiclecategory`,`enginefueltype`,`littercombined`,`drivenwheels`,`transmissiontype`,`monthly_payment`,`contract_term`,`total_finance_amount`,`apr`,`tradeinvalue` FROM `eps_data` WHERE `dealership_id` = '204'
     */
    function index($registration_id) 
    {    		  
        $data['title'] = 'Exclusive Private Sale Inc-View Profile';
        $data['segment'] = 'messages';
        $data['menu'] = $this -> login_model -> loginauth();
        if (isset($data['menu']['logged_in']) == '') 
        {
            redirect(base_url().'home');
        } 
        else 
        {
            $data['title'] = 'Exclusive Private Sale Inc-View Private Messaging System';
            $this->load->helper('form');
            $this->load->library('form_validation');
            $subjects_data = $this->messages_model->getUserSubjectById($registration_id);
            $count = 0;
            $subjects = array();
            if($subjects_data){
                foreach ($subjects_data as $subject){
                    $subjects[$subject['usertype']][] = $subject;
                }
                $data['subjects'] = $subjects;
            }
            $data['user_id'] = $data['menu']['logged_in']['registration_id'];
            $data['usertype'] = $this->messages_model->userTypeById($registration_id);
            
            $messages_id = $this->messages_model->getLatestMessageId($registration_id);
            if($messages_id){
                $leatest_message = new stdClass();
                $leatest_message = $this->messages_model->getMessageBySubjectId($registration_id,$messages_id);
                if($leatest_message){
                    $leatest_message->thread = $this->messages_model->getThreadBySubjectId($messages_id);
                    $data['leatest_message'] = $leatest_message;
                }
            }else{
                $data['leatest_message'] = null;
            }
            $userid=$data['menu']['logged_in']['registration_id'];
            $user_type = $data['menu']['logged_in']['usertype'];
            $data['dealer_id_upload_data']=$registration_id;
            $this->load->view('themes/header',$data);
            if($user_type=='dealership'){
                $data['dealerdashboard']=$userid; 
                $this->load->view('themes/dealerside-bar',$data); 
                $this->load->view('messages',$data);   
            }else{
                $this->load->view('themes/side-bar',$data);        
                $this->load->view('messages',$data);
            }
            $this->load->view('themes/footer', $data);
        }
    }
    
    public function sendmessage(){   
        $from_user = $this->input->post('from_user');
        $path = './attachments/'.$from_user."/";
        if(!is_dir($path)){
          mkdir($path,0755,TRUE);
        } 
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('attachment')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $attachment = $this->upload->data();
        }
        if(isset($attachment)){
            $attachment_flag = 1;
        }else{
            $attachment_flag = 0;
        }
        $usertype = $this->input->post('usertype');
        $subject = $this->input->post('subject');
        $to_user = $this->input->post('to_user');
        $body = $this->input->post('body');
        $draft = $this->input->post('draft');
        $date = date('Y-m-d H:i:s');
        if(in_array('-1',$to_user)){
            $users = $this->messages_model->usersByUserType($from_user,$usertype);
            $to_user = array();
            foreach($users as $user){
                $to_user[] = $user['registration_id'];
            }
        }
        for($i = 0;$i<count($to_user);$i++){
            $message_data = array('from_user' => $from_user, 'to_user' => $to_user[$i], 'subject' => $subject, 'subject' => $subject,'attachement' => $attachment_flag,'starred' => '0','message_read' => '1','draft' => $draft,'ip' =>  $this->input->ip_address(),'time' => $date);        
            $message_id = $this->messages_model->addMessage($message_data);        
            if($attachment_flag == 1){
                $thread_data = array('reply' => $body,'attachment' => $attachment['file_name'],'from_user' => $from_user,'ip' =>  $this->input->ip_address(),'time' => $date);
            }else{
                $thread_data = array('reply' => $body,'attachment' => '','from_user' => $from_user,'ip' =>  $this->input->ip_address(),'time' => $date);
            }

            $thread_data['messages_id'] = $message_id;

            $thread_id = $this->messages_model->addThread($thread_data);
        }
        redirect(base_url().'messages/'.$from_user);
    }
    
    public function replymessage(){
        $from_user = $this->input->post('from_user');
        $path = './attachments/'.$from_user."/";
        if(!is_dir($path)){
          mkdir($path,0755,TRUE);
        } 
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('attachment')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $attachment = $this->upload->data();
        }
        if($attachment){
            $attachment_flag = 1;
        }else{
            $attachment_flag = 0;
        }
        $subject = $this->input->post('subject');
        $messages_id = $this->input->post('messages_id');
        $body = $this->input->post('body');
        $date = date('Y-m-d H:i:s');
        
        $message_data = array('subject' => $subject, 'subject' => $subject,'attachement' => $attachment_flag,'starred' => '0','message_read' => '1','ip' =>  $this->input->ip_address(),'time' => $date);        
        $this->messages_model->updateMessage($message_data,$messages_id);
        
        if($attachment_flag == 1){
            $thread_data = array('reply' => $body,'attachment' => $attachment['file_name'],'from_user' => $from_user,'ip' =>  $this->input->ip_address(),'time' => $date);
        }else{
            $thread_data = array('reply' => $body,'attachment' => '','from_user' => $from_user,'ip' =>  $this->input->ip_address(),'time' => $date);
        }
        
        $thread_data['messages_id'] = $messages_id;
        
        $thread_id = $this->messages_model->addThread($thread_data);
        
        redirect(base_url().'messages/'.$from_user);
    }

    public function usersbytype($registration_id){
        $data['menu'] = $this -> login_model -> loginauth();
        if (isset($data['menu']['logged_in']) == '') 
        {
            redirect(base_url().'home');
        } 
        $usertype = $this->input->post('usertype');
        $users = $this->messages_model->usersByUserType($registration_id,$usertype);
        if($users){
            $users = json_encode($users);
            echo $users;
        }
        exit();
    }
    
    public function deletMessage($registration_id){
        $messages_id = $this->input->post('messages_id');
//        if($this->message_model->getMessageId($messages_id,$registration_id)){
//        }
        $this->messages_model->deleteMessage($messages_id,$registration_id);
    }

    public function loadMessage($registration_id){
        $data['menu'] = $this -> login_model -> loginauth();
        if (isset($data['menu']['logged_in']) == '') 
        {
            redirect(base_url().'home');
        } 
        $messages_id = $this->input->post('messages_id');
        $message_data = array('message_read' => '0');        
        $this->messages_model->updateMessage($message_data,$messages_id);
        $leatest_message = new stdClass();
        $leatest_message = $this->messages_model->loadMessageBySubjectId($registration_id,$messages_id);
        $leatest_message->thread = $this->messages_model->getThreadBySubjectId($messages_id);
        echo json_encode($leatest_message);
        exit();
    }
}