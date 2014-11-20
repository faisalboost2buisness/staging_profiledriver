<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Ftpmove extends CI_Controller{
    public function __construct() { 
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this->load->model('login_model'); 
        $this->load->library("pagination");
        $this->load->model("main_model");
        $this->load->model("upload_model");
        $this->load->model("settings_model");
        $this -> load -> model("ftpread_model");
    }
    //move pbs file to clients folder
     function index(){
        $source='pbs';
        $this->load->helper('file');
        $base_path = '/home/advantage/';
        $file_path=$base_path.'pbs/';
        $dealer_id='';
        $dir = opendir($file_path);
        $message='';
        $admin_emailid= $this -> config -> item('admin_address'); 
        //List files  directory
        while (($file = readdir($dir)) !== false){
            
            if ($file != "."  && $file != ".."){
                $pbsdatafilename=explode('FandI',$file);
                if(isset($pbsdatafilename[1])){
                    $file_move=explode('_',$file);
                    if(!isset($file_move[1])){
                        $dealer_name=$pbsdatafilename[0];
                        //getting dealer's folder name
                        $folder_name=$this -> main_model -> getdealerfoldernamepbs($dealer_name);
                        if(isset($folder_name) && $folder_name!=''){
                            //getting dealer details 
                            $user_details_get=$this -> main_model -> userdetails_with_foldername_pbs($dealer_name);
                            if(isset($user_details_get) && $user_details_get!=''){
                                foreach($user_details_get as $user_details){
                                    $dealer_id=$user_details['registration_id'];
                                }
                            }
                            //echo $file."<br />";
                            $read_status=$dealer_id.'-1';
                            $move_file_path= $base_path.'public_html/clients/';
                            $dir_move_file = opendir($move_file_path);
                            //List files  directory in side clent directory
                            while (($file_move = readdir($dir_move_file)) !== false){
                                if ($file_move != "."  && $file_move != ".."){
                                    //creation date in database is equal to file uploaded data
                                    if($folder_name==$file_move){
                                        $file_creation_date=filemtime($file_path.$file);
                                       // echo date('m/d/y',$file_creation_date).'-'.$file_creation_date.'<br />';
                                       $query=$this -> ftpread_model -> ftp_feed_details_query($file);
                                        if($query -> num_rows() > 0){
                                        //getting the ftp file details
                                            $returnvalue= $query->result_array();
                                            if(isset($returnvalue)){
                                                foreach($returnvalue as $ftp_feed_details){
                                                    $creation_date=$ftp_feed_details['creation_date']; 
                                                    if($creation_date!=$file_creation_date){
                                                        //copy the file to dealer's folder from root folder
                                                        $copy_file=copy($file_path.$file, $move_file_path.$file_move.'/'.$file);
                                                        //copy is successfully made then update the details else send an email to admin
                                                        if($copy_file){
                                                            $ftp_feed_data=$this -> ftpread_model -> update_ftp_feed($file_creation_date,$dealer_id,$file);
                                                               
                                                        }else{
                                                            //send email when file move failed
                                                            $subject='Ftp file move failed';
                                                            $message.= 'Dear Admin,<br/><br/>
                                                            The file '.$file.' is failed to move in to the folder<br/><br/>';
                                                            $message.='Regards,<br/>Exclusive Private Sale.Inc';  
                                                            $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message); 
                                                        }
                                                    }
                                                }
                                            }  
                                        }else{
                                            //copy to folder and insert to ftp feed table
                                            $copy_file=copy($file_path.$file, $move_file_path.$file_move.'/'.$file);
                                            if($copy_file){
                                                $ftp_feed_data=$this -> ftpread_model -> insert_ftp_feed($file_creation_date,$dealer_id,$file,$source,$read_status);
                                            }else{
                                                //send email when file move failed
                                                $subject='Ftp file move failed';
                                                $message.= 'Dear Admin,<br/><br/>
                                                The file '.$file.' is failed to move in to the folder<br/><br/>';
                                                $message.='Regards,<br/>Exclusive Private Sale.Inc';
                                                $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message);   
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }      
    }
    //move authenticom to dealer folder
    function authenticom_file_move_dealer_folder(){
        $source='authenticom';
        $this->load->helper('file');
        $base_path = '/home/advantage/';
        $file_path=$base_path.'authenticom/';
        $dir = opendir($file_path);
        $dealer_id='';
        $admin_emailid= $this -> config -> item('admin_address'); 
        $message='';
        //List files  directory
        while (($file = readdir($dir)) !== false){
            if ($file != "."  && $file != ".."){
                $authenticomdatafilename=explode('_',$file);
                $start_name=$authenticomdatafilename[0];
                if(isset($start_name) && $start_name=='HIST'){
                    //echo $file."<br />";
                    $dealer_name=$authenticomdatafilename[1];
                    //getting dealer's folder name
                    $folder_name=$this -> main_model -> getdealerfoldername($dealer_name);
                    if(isset($folder_name) && $folder_name!=''){
                        $user_details_get=$this -> main_model -> userdetails_with_foldername($dealer_name);
                        if(isset($user_details_get) && $user_details_get!=''){
                            foreach($user_details_get as $user_details){
                                $dealer_id=$user_details['registration_id'];
                            }
                        }
                        $read_status=$dealer_id.'-1';
                        $move_file_path= $base_path.'public_html/clients/';
                        $dir_move_file = opendir($move_file_path);
                        //List files  directory in side clent directory
                        while (($file_move = readdir($dir_move_file)) !== false){
                            if ($file_move != "."  && $file_move != ".."){
                                //creation date in database is equal to file uploaded data
                                if($folder_name==$file_move){
                                    $file_creation_date=filemtime($file_path.$file);
                                   // echo date('m/d/y',$file_creation_date).'-'.$file_creation_date.'<br />';
                                   $query=$this -> ftpread_model -> ftp_feed_details_query($file);
                                    if($query -> num_rows() > 0){
                                    //getting the ftp file details
                                        $returnvalue= $query->result_array();
                                        if(isset($returnvalue)){
                                            foreach($returnvalue as $ftp_feed_details){
                                                $creation_date=$ftp_feed_details['creation_date']; 
                                                if($creation_date!=$file_creation_date){
                                                    //copy the file to dealer's folder from root folder
                                                    $copy_file=copy($file_path.$file, $move_file_path.$file_move.'/'.$file);
                                                    //copy is successfully made then update the details else send an email to admin
                                                    if($copy_file){
                                                        $ftp_feed_data=$this -> ftpread_model -> update_ftp_feed($file_creation_date,$dealer_id,$file);
                                                           
                                                    }else{
                                                        //send email when file move failed
                                                        $subject='Ftp file move failed';
                                                        $message.= 'Dear Admin,<br/><br/>
                                                        The file '.$file.' is failed to move in to the folder<br/><br/>';
                                                        $message.='Regards,<br/>Exclusive Private Sale.Inc';  
                                                        $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message); 
                                                    }
                                                }
                                            }
                                        }  
                                    }else{
                                        //if the file is already saved and updated evey week
                                        $copy_file=copy($file_path.$file, $move_file_path.$file_move.'/'.$file);
                                        if($copy_file){
                                            $ftp_feed_data=$this -> ftpread_model -> insert_ftp_feed($file_creation_date,$dealer_id,$file,$source,$read_status);
                                        }else{
                                            //send email when file move failed
                                            $subject='Ftp file move failed';
                                            $message.= 'Dear Admin,<br/><br/>
                                            The file '.$file.' is failed to move in to the folder<br/><br/>';
                                            $message.='Regards,<br/>Exclusive Private Sale.Inc';  
                                            $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message); 
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }   
    }
}
?>