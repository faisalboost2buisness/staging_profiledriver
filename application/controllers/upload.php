<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Upload extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this->load->model('login_model'); 
        $this->load->library("pagination");
        $this->load->model("main_model");
        $this->load->model('settings_model'); 
        $this->load->model("upload_model");
    }
    /*function to call upload page*/
    public function index(){
        $data['menu']=$this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Upload';
        $data['segment']='upload';
        if (isset($data['menu']['logged_in']) != '')
        {
            
            $userid=$data['menu']['logged_in']['registration_id'];
            $user_type = $data['menu']['logged_in']['usertype'];
            $this->load->view('themes/header',$data);
            if($user_type=='dealership'){
                $data['dealerdashboard']=$userid; 
             $this->load->view('themes/dealerside-bar',$data);    
            }else{
            $this->load->view('themes/side-bar',$data);
            }
            $this -> load -> view('upload-view');
            $this->load->view('themes/footer',$data);
        }
        else
        {
            redirect(base_url().'login');
        }   
    }
    /*Function to move uploaded file*/
    public function uploadprocess()
    {
         $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '')
        {
        if (!empty($_FILES['upload_details']['name']))
        {
        $allowedExts = array("xls", "csv");
        
        $extension = end(explode(".", $_FILES["upload_details"]["name"]));
        //getting upload dealer id
         $upload_dealer_id=$this -> input ->post('upload_dealer_id');
         $set_upload_dealer_id='';
         if($upload_dealer_id!='')
         {
            $set_upload_dealer_id=$upload_dealer_id;
         }
         else
         {
             $set_upload_dealer_id= $data['menu']['logged_in']['registration_id'];
         }
        
            if(in_array($extension, $allowedExts)){
                $base_path = $this -> config -> item('rootpath');
                $filenames=$this -> main_model -> random_generator(10);
                $file_name=$filenames.'.'.$extension;
                $images1=$_FILES['upload_details']['tmp_name'];
                $file_move=move_uploaded_file($images1, "$base_path/uploadfile/$file_name");
                $data['menu']=$this->login_model->loginauth(); 
                $user_id = $data['menu']['logged_in']['registration_id'];
                $file_path=$base_path.'/uploadfile/'.$file_name;
                $insert_filename=$this -> upload_model ->insert_filename($file_name,$user_id);
                //enter if it is csv
                if($extension=='csv'){
                    //parse csv file
                    require_once $base_path.'uploadfile/parsecsv.lib.php';
                    $csv_file_display = new parseCSV();
                    $csv_file_display->auto($file_path);
                    $values=array();
                    $values[]= $csv_file_display->titles; 
                        foreach($csv_file_display->titles as $key => $all_field)
                        {
                            $insert_fieldsname=$this -> upload_model ->get_all_fields($all_field,$key,$user_id,$insert_filename);
                        }
                       
                    $this -> readuploadedfile($file_name,$set_upload_dealer_id);
                }else{
                   	require_once 'uploadfile/reader.php';
        	        $excel = new Spreadsheet_Excel_Reader();
                    $excel->read($file_path); // set the excel file name here  
                      $y=1;
                      while($y<=$excel->sheets[0]['numCols']) {// reading column by column 
                        $cell = isset($excel->sheets[0]['cells'][1][$y]) ? $excel->sheets[0]['cells'][1][$y] : '';
                        $this -> upload_model ->get_all_fields($cell,$y,$user_id,$insert_filename);
                        $y++;
                      } 
                     
                  $this -> readxlsfile($file_name,$set_upload_dealer_id);  
                 }     
            }else{
                $data['error'] = 'Please upload csv or xls file';
                $data['segment']='upload';
                $data['menu']=$this->login_model->loginauth();
                $userid=$data['menu']['logged_in']['registration_id'];
                $user_type = $data['menu']['logged_in']['usertype'];
                $this->load->view('themes/header',$data);
                    if($user_type=='dealership'){
                        $data['dealerdashboard']=$userid; 
                        $this->load->view('themes/dealerside-bar',$data);    
                    }else{
                        $this->load->view('themes/side-bar',$data);
                    }
                $this -> load -> view('upload-view');
                $this->load->view('themes/footer',$data); 
            }
        }else{
            $data['error'] = 'Please select a file to upload';
            $data['segment']='upload';
            $data['menu']=$this->login_model->loginauth();
            $userid=$data['menu']['logged_in']['registration_id'];
            $user_type = $data['menu']['logged_in']['usertype'];
            $this->load->view('themes/header',$data);
                if($user_type=='dealership'){
                    $data['dealerdashboard']=$userid; 
                    $this->load->view('themes/dealerside-bar',$data);    
                }else{
                    $this->load->view('themes/side-bar',$data);
                }
            $this -> load -> view('upload-view');
            $this->load->view('themes/footer',$data);
        }
         }
        else
        {
            redirect(base_url().'login');
        }
    }
    public function fields_form(){
        $data['title'] = 'Exclusive Private Sale Inc-Register';
        $data['field_details']=$this -> upload_model ->fields_details();
        $this->load->view('themes/header',$data);
        $data['menu']=$this->login_model->loginauth();
            if (isset($data['menu']['logged_in']) != '')
            {
                $data['user_id'] = $data['menu']['logged_in']['user_id'];
                $data['segment']='upload';
                $this->load->view('themes/side-bar',$data);
                $this -> load -> view('fields-form',$data);
                $this->load->view('themes/footer',$data); 
             }
            else
            {
                redirect(base_url().'login');
            }  
    }
     /*function to call upload page when xls file is uploaded*/
    public function readxlsfile($file_name,$upload_dealer){
        require_once 'uploadfile/reader.php';
        $excel = new Spreadsheet_Excel_Reader();
        $base_path = $this -> config -> item('rootpath');
        $file_path=$base_path.'/uploadfile/'.$file_name;
        $excel->read($file_path); // set the excel file name here  
        $y=1;
        //Reading cells for sending to next comparing page
            while($y<=$excel->sheets[0]['numCols']) {// reading column by column 
                $cell = isset($excel->sheets[0]['cells'][1][$y]) ? $excel->sheets[0]['cells'][1][$y] : '';
                $values[]=$cell;
                $y++;
            }  
        $data['first_field_values']=$values;
        $data['field_details']=$this -> upload_model ->fields_details();
        $data['menu']=$this->login_model->loginauth();
        $data['user_id'] = $data['menu']['logged_in']['registration_id'];
        $data['file_name']=$file_name;
        $data['upload_dealer']=$upload_dealer;
          $data['dealer_id_upload_data']=$upload_dealer;
        $data['segment']='upload';
        $userid=$data['menu']['logged_in']['registration_id'];
            $user_type = $data['menu']['logged_in']['usertype'];
            $this->load->view('themes/header',$data);
                if($user_type=='dealership'){
                    $data['dealerdashboard']=$userid; 
                    $this->load->view('themes/dealerside-bar',$data);    
                }else{
                    $this->load->view('themes/side-bar',$data);
                }
        $this -> load -> view('fields-form',$data);
        $this->load->view('themes/footer',$data); 
    }
    //Function to read csv file
    public function readuploadedfile($file_name,$upload_dealer){
        $this->load->library('csvreader');
        $this->load->helper('file');
        $base_path = $this -> config -> item('rootpath');
        $file_path=$base_path.'/uploadfile/'.$file_name;
        require_once $base_path.'uploadfile/parsecsv.lib.php';
        $csv_file_display = new parseCSV();
        $csv_file_display->auto($file_path);
        //$this->load->view('csv_view',$data);
                $values[]= $csv_file_display->titles; 
                foreach($csv_file_display->titles as $key => $all_field_get)
                {
                    $feild_name_pass='';
                        $field_details=$this -> upload_model ->fields_details_name($all_field_get);
                         $feild_name_pass.=$all_field_get.',';
                        //echo $field_details;
                } 
        $data['field_details']=$this -> upload_model ->fields_details();
        $data['filepath']=$file_path;
        $data['menu']=$this->login_model->loginauth();
        $data['user_id'] = $data['menu']['logged_in']['registration_id'];
        $data['file_name']=$file_name;
      
        $data['upload_dealer']=$upload_dealer;
        $data['dealer_id_upload_data']=$upload_dealer;
        $data['first_field_values']=$feild_name_pass;
        $data['segment']='upload';
        $userid=$data['menu']['logged_in']['registration_id'];
        $user_type = $data['menu']['logged_in']['usertype'];
        $this->load->view('themes/header',$data);
            if($user_type=='dealership'){
                $data['dealerdashboard']=$userid; 
                $this->load->view('themes/dealerside-bar',$data);    
            }else{
                $this->load->view('themes/side-bar',$data);
            }
        $this -> load -> view('fields-form',$data);
        $this->load->view('themes/footer',$data);
    } 
    public function fieldprocess()
    {
        $file_name=$this -> input ->post('file_name');
      $upload_dealer_id=$this -> input ->post('upload_dealer_id');
        $data['menu']=$this->login_model->loginauth();
        $user_id = $data['menu']['logged_in']['registration_id'];
        $extension = end(explode(".", $file_name));
            if($extension=='csv'){
                $last_id=$this->upload_model ->insert_csv_file_values($file_name,$user_id,$upload_dealer_id);
            }else{
                $last_id=$this->upload_model ->insert_xls_file_values($file_name,$user_id,$upload_dealer_id);   
            }
            if($last_id!=''){
                $data['error'] = 'Successfully uploaded your file'; 
                $data['segment']='upload'; 
                $data['menu']=$this->login_model->loginauth();
                $data['user_id'] = $data['menu']['logged_in']['registration_id'];
                $userid=$data['menu']['logged_in']['registration_id'];
                $user_type = $data['menu']['logged_in']['usertype'];
              
                  redirect(base_url().'campaign/'.$upload_dealer_id);
         
                  //redirect(base_url().'campaign'); 
            }
    }
    public function update_changedfieldname(){
        $changed_name=$this->input ->post('changed_name');  
        $file_name=$this->input ->post('field_name');  
        $user_id=$this->input ->post('userid');
        $file_id=$this->input ->post('file_id');
        $id=$this->input ->post('id');
        $update_variable=$this->upload_model->update_changename($changed_name,$file_name,$user_id,$file_id,$id);
        echo $update_variable;
    }
     public function checkfiletype()
     {
        $filename=$this->input ->post('filename');  
        $allowedExts = array("xls", "csv");
        $extension = explode(".", $filename);
            if(in_array($extension, $allowedExts))
            {
                 echo "VAILD";
            }
            else
            {
                echo "INVAILD";
            }
    }
    public function send_xlsfilename($cell){
        $data['menu']=$this->login_model->loginauth(); 
        $user_id = $data['menu']['logged_in']['registration_id'];
        $insert_filename=$this -> upload_model ->insert_filename($file_name,$user_id);
        $this ->upload_model ->insert_xlsfile($cell,$user_id);        
    }    
}
?>