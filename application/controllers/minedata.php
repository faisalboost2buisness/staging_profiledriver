<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Minedata extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> library('form_validation');
        $this->load->model('login_model'); 
        $this->load->model('main_model'); 
        $this->load->model('settings_model'); 
        $this->load->library("pagination");
        $this->load->library('session');
        $this->load->database();
        $this->load->helper('xml');
        $this->load->library('email');
        $this -> load -> library('zip');
       	}
    //select report type
    public function index($dealer_id_pass=''){
        $data['menu']=$this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        if (isset($data['menu']['logged_in']) != ''){ 
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
            $data['dealerdashboard']=$dealers_userid;
            $data['dealer_id_upload_data']=$dealer_id_pass;
            //select and insert report type 
            $event_insert_get=$this->settings_model->insert_event_minedata1($dealer_id_pass);
            $this -> session -> set_userdata('event_id_get', $event_insert_get);
             $data['event_insert_id']=$this->session->userdata('event_id_get'); 
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data); 
            }
            $this-> load-> view('minedata-view',$data); 
            $this->load->view('themes/footer',$data); 
        }
        else
        {
        redirect(base_url().'login');
        }
    }
    //customerlist for mine data
    public function customerlist($dealer_id_pass=''){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $data['campaine_step']='capaine_step_complete';
        //insert report group insert
        $lead_mining_presets_insert_get=$this->epsadvantage_campaign_fiststep($this->session->userdata('event_id_get'));
        $lead_mining_presets=$this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        $data['event_insert_id_minedata']=$this->session->userdata('event_id_get');
        if (isset($data['menu']['logged_in']) != ''){ 
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
            $data['dealerdashboard']=$dealers_userid;
            $data['dealer_id_upload_data']=$dealer_id_pass;
            $data['member_type']=$this->input->post('member_type'); 
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data);
            }
            if($lead_mining_presets!='custom_campaign'){
             $this-> load-> view('minedata-customer-list',$data);
            }
            else{
                $this-> load-> view('minedata-advanced-option-report-list',$data);  
            }
            $this->load->view('themes/footer',$data);    
        }
        else{
            redirect(base_url().'login');
        }
    }
    //inserting and creating leadlist with files
    public function mailoutoption($dealer_id_pass=''){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $data['lead_step']='leadlist_step_complete';
        $data['campaine_step']='capaine_step_complete';
        $equity_scrap=$this->input->post('equity_scrap');
        $model_break_down=$this->input->post('model_break_down');
        $fuel_effciency=$this->input->post('fuel_effciency');
        $wrranty_scrap=$this->input->post('wrranty_scrap');
        $custom_campain=$this->input->post('custom_campain');
        $fuelreopr6=$this->input->post('fuelreopr6');
        $lead_mining_presets=$this->input->post('lead_mining_presets');
        $equity_scrap_customer_id=$this->input->post('checkedpr1');
        $modebreakdown_customer_id=$this->input->post('checkedprmodebreakdown');
        $fuelefficiency_customer_id=$this->input->post('checkedpr_fuelefficiency');
        $warrantyscrape_customer_id=$this->input->post('checkedprwarrantyscrape');
        $customcampaign_customer_id=$this->input->post('checkedpcustomcampaign');
        $fuelreopr6_customer_id=$this->input->post('checkedfuelgroup');
        if (isset($data['menu']['logged_in']) != '') { 
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        $data['dealerdashboard']=$dealer_id_pass;
        $data['dealer_id_upload_data']=$dealer_id_pass;
        $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
        $this->load->view('themes/header',$data);
        //deleting all lead list when edit exist events
        if($equity_scrap!='' || $model_break_down!='' || $fuel_effciency!='' || $wrranty_scrap!='' || $custom_campain!=''){  
         $lead_delete_cusomer_data=$this -> settings_model -> leadlistdelete($this->session->userdata('lead_list_id'));   
        }
        //insert first lead list
        if($equity_scrap!=''){
           if(!empty($equity_scrap_customer_id)){
           foreach ($equity_scrap_customer_id as $value_equity_scrap){
            $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$equity_scrap,$value_equity_scrap);  
            }
            }
        }
         //insert second lead list
        if($model_break_down!=''){
            if(!empty($modebreakdown_customer_id)){
            foreach ($modebreakdown_customer_id as $value_modebreakdown){
            $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$model_break_down,$value_modebreakdown);  
            }
            }  
        }
        //insert third lead list
         if($fuel_effciency!=''){
            if(!empty($fuelefficiency_customer_id)){
            foreach ($fuelefficiency_customer_id as $value_fuelefficiency){
            $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$fuel_effciency,$value_fuelefficiency);  
            }
            } 
            } 
         //insert fourth lead list    
        if($wrranty_scrap!=''){
             if(!empty($warrantyscrape_customer_id)){
            foreach ($warrantyscrape_customer_id as $value_wrranty_scrap){
            $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$wrranty_scrap,$value_wrranty_scrap);  
            }
            } 
            }
         //insert fifth lead list   
        if($custom_campain!=''){
            if(!empty($customcampaign_customer_id)){
               foreach ($customcampaign_customer_id as $value_customcampaign){
                $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$custom_campain,$value_customcampaign);  
                }
                }
        }
        //insert sixth lead list
        if($fuelreopr6!=''){
            if(!empty($fuelreopr6_customer_id)){
               foreach ($fuelreopr6_customer_id as $value_fuelreopr6){
                $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$fuelreopr6,$value_fuelreopr6);  
                }
                }
        }
        //create folder and create csv file
        $companyname_show='';
        $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id_pass);
        if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
         foreach($get_dealer_company_name as $value_dealer_company_name){
          $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
          $companyname_show=strtolower(str_replace(" ","",$companyname_get));
         }   
        }
        $report_download_time=date('mdy',time());
        //generate folder name and create folder
        $foldername=($companyname_show.'-'.$report_download_time.'-'.$this->session->userdata('event_id_get'));
        $base_path = $this -> config -> item('rootpath');
        $targetPath=$base_path.'/downloadreportzip/'.$foldername.'/';
        $file_path=$base_path.'/downloadreportzip/'.$foldername.'/';
        if(is_dir($targetPath)){
        $dir = opendir($base_path.'/downloadreportzip/'.$foldername);
        while (($file = readdir($dir)) !== false){
        if ($file != "."  && $file != ".."){
         unlink($base_path.'/downloadreportzip/'.$foldername.'/'.$file); 
         }
         }
        }
        else{
         mkdir($file_path, 0755);   
         }
        //create folder and create csv file
        if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
        $this->load->view('themes/side-bar',$data);
        }else{
            $this->load->view('themes/dealerside-bar',$data);
        }
        $lead_mining_presets_select='';
        //getting lead mining presets
        $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
        $get_selected_lead_group=$this->settings_model->leadsection_select($this->session->userdata('event_id_get'));
        foreach($get_selected_lead_group as $values_mindata_group){
        if($lead_mining_presets_select=='custom_campaign'){
        $group_1_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),1);
        if($values_mindata_group['equity_scrap']!='0'){
        // get lead count of first group and create files
        $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'1');
        if($get_selected_lead_group!=0){
        $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1); 
        $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1);
        $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1);
        }
        }
        $group_2_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),2);
        if($values_mindata_group['model_break_down']!='0'){
            // get lead count of second group and create files
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'2');
            if($get_selected_lead_group!=0){
                $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2); 
                $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2); 
                $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2);
            }
        }
        $group_3_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),3);
        if($values_mindata_group['fuel_effciency']!='0'){
            // get lead count of third group and create files
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'3');
            if($get_selected_lead_group!=0){
                $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);
                $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);  
                $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);
            }
        }
        $group_4_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),4);
         // get lead count of fourth group and create files
        if($values_mindata_group['wrranty_scrap']!='0'){
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'4');
            if($get_selected_lead_group!=0){
                $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4); 
                $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4); 
                $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4);
            }
        }
        $group_5_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),5);
        // get lead count of fifth group and create files
        if($values_mindata_group['custom_campain']!='0'){
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'5');
            if($get_selected_lead_group!=0){
                $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_5_details,5); 
                $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_5_details,5); 
                $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_5_details,5);
            }
        }
        }
        else{
        $group_name=$this -> settings_model -> getleadgrouptitle_report($lead_mining_presets_select);
        //getting lead group name
        if(isset($group_name)&& $group_name!=''){
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'1');
            //get lead count of first group and create files
            if($get_selected_lead_group!=0){
             $firstgroup=$group_name[0];
             $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$firstgroup,1); 
             $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$firstgroup,1);
             $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$firstgroup,1);
             
            }
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'2');
            //get lead count of second group and create files
            if($get_selected_lead_group!=0){
             $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[1],2);
             $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[1],2);
             $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[1],2);
             
            }
            
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'3');
            //get lead count of third group and create files
            if($get_selected_lead_group!=0){
            $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[2],3);
            $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[2],3);
            $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[2],3);
            
            }
            
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'4');
            //get lead count of fourth group and create files
            if($get_selected_lead_group!=0){
            $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[3],4);
            $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[3],4);
            $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[3],4);
            
            }
            
            
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'5');
            //get lead count of fifth group and create files
            if($get_selected_lead_group!=0){
            $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[4],5);
            $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[4],5);
            $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[4],5);
            
            }
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'6');
            //get lead count of sixth group and create files
            if($get_selected_lead_group!=0){
            $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[5],6);
            $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[5],6);
            $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[5],6);
            }
        }
        }
        $this->zip->archive($base_path.'/downloadreportzip/'.$foldername.'/'.$foldername.'.zip'); 
        //$path = $base_path.'/downloadreportzip/my_backup.zip';
        $this->zip->get_files_from_folder($base_path.'/downloadreportzip/'.$foldername.'/',$foldername.'.zip/',$foldername);
        $this->zip->download($foldername.'.zip');
        }
        }
        else
        {
        redirect(base_url().'login');
        }
    }
    //customer lead list insert
    function insertcustomer_lead_list(){
        $equity_scrap=$this->input->post('equity_scrap');
        $model_break_down=$this->input->post('model_break_down');
        $fuel_effciency=$this->input->post('fuel_effciency');
        $wrraenty_scrap=$this->input->post('wrranty_scrap');
        $custom_campain=$this->input->post('custom_campain');
        $fuel_report6=$this->input->post('fuel_report6');
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        //check and insert report type
        if($equity_scrap!='' || $model_break_down!='' || $fuel_effciency!='' || $wrraenty_scrap!='' || $custom_campain!='' || $fuel_report6!=''){
            $leadlist_insert_id=$this->settings_model->insertleadlistselction($this->session->userdata('event_id_get')); 
            $this -> session -> set_userdata('lead_list_id', $leadlist_insert_id);            
            $data['lead_list_id']=$this->session->userdata('lead_list_id');
            echo "Done";  
        }
    }
    //advance option insert
    function checkadvanceinsert(){
        $event_id=$this->input->post('event_id');  
        $sql=("Select * from  advance_options_group_selection where event_id=$event_id");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){ 
            echo "Done";
        }
    } 
    //insert mine data report
    function epsadvantage_campaign_fiststep(){
        $data['menu']=$this->login_model->loginauth();
        $campaine_insert_id=$this->settings_model->insert_campaign_step1_mine_data($this->session->userdata('event_id_get'));
        return $campaine_insert_id;
    }
    //mine data report type ia other than advance options
    function epsadvantage_campaign_advanced_option(){
        $data['menu']=$this->login_model->loginauth();
        $event_id=$this->input->post('event_insert_id');
        $get_campign_id=$this->settings_model->get_campign_id($event_id);
        if($get_campign_id!=0){
            $campine_advanced_option_updates=$this->settings_model->update_campaign_step1($get_campign_id);
            echo 'Done';
        }
    }
    //edit events
    function editcampign($event_id,$dealer_id){
        $data['menu']=$this->login_model->loginauth();
        $this->session->unset_userdata('event_id_get');
        $this->session->unset_userdata('incompete_event_set');
        $dealers_userid=$dealer_id;
        $data['dealerdashboard']=$dealer_id;
        $data['dealer_id_upload_data']=$dealer_id;
        if (isset($data['menu']['logged_in']) != ''){
            if($event_id!=''){ 
                $incomple=1;
                $this -> session -> set_userdata('incompete_event_set', $incomple);
                $data['incompete_events']=$this->session->userdata('incompete_event_set');
                $this -> session -> set_userdata('event_id_get', $event_id);
                $data['event_insert_id']=$this->session->userdata('event_id_get');
            }
            $data['campign_status']='edit';
            $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
            if(!empty($lead_selection)){
                $incomple=1;
                $this -> session -> set_userdata('leadlist', $incomple);
                $data['leadlist']=$this->session->userdata('leadlist');
            }
            $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
            if(!empty($mailout_selection)){
                $incomple=1;
                $this -> session -> set_userdata('mailout', $incomple);
                $data['mailout']=$this->session->userdata('mailout');
            }
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data);
            }
            $this->load->view('campaignpage-sidebar-view',$data);
            $this->load->view('newcampign-view',$data);
            $this->load->view('themes/footer',$data);  
        }else
        {
            redirect(base_url().'login');
        }
    }
    
    //view customer lead list
    public function viewlist($event_id,$dealer_id_upload_data){
        $data['title'] = 'Exclusive Private Sale Inc-viewlist';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') {
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
            $data['dealerdashboard']=$dealer_id_upload_data;
            $data['dealer_id_upload_data']=$dealer_id_upload_data;
            $data['event_insert_id']=$event_id;
            $data['event_id']=$event_id;
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data); 
            }
            $this-> load-> view('view-customer-lead-list',$data);
            //check incompete events for the dealer
        }else{
        redirect(base_url().'login');   
        }  
    }
    //get pbs customer details
    public function get_customer_details($customer_id,$foldername){
        $data['get_customerdetails']=$this -> main_model -> customerdatafulldetails($customer_id);
        $this->load->view('customer-details-view',$data);
    }
    
    //create csv file
    function create_csv($event_id,$foldername,$dealer_id,$reportname,$report_id){
        $base_path = $this -> config -> item('rootpath');
        $companyname_show='';
        $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id);
        if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
            foreach($get_dealer_company_name as $value_dealer_company_name){
                $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
                $companyname_show=strtolower(str_replace(" ","-",$companyname_get));
            }   
        }
        $lead_mining_presets_select='';
        $reoprt_name_show='';
        $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($event_id);
        if($lead_mining_presets_select=='custom_campaign'){
            if(isset($reportname) && $reportname!=''){
                foreach($reportname as $value_report_name){
                    $reoprt_name_show_get=$this -> settings_model -> getreporttype_report_generation_type($value_report_name['report_type']); 
                    $reoprt_name_show='G'.$report_id.'-'.$reoprt_name_show_get;
                }    
            }
        }else{
            $reoprt_name_show=$reportname;     
        }
        $report_download_time=date('m.d.y',time());
        //creating csv  file name
        $csvfilename=($companyname_show.'-'.trim($reoprt_name_show).'-'.$report_download_time);
        $num=$this -> settings_model -> getting_csv_fieldname_count($dealer_id);
        $var =array();
        $i=0;
        $fname="";
        $feild_name=array("dealership_id","buyer_first_name","buyer_last_name","buyer_address","buyer_appartment","buyer_city","buyer_province","buyer_postalcode","buyer_homephone","buyer_businessphone","sold_vehicle_year","sold_vehicle_make","sold_vehicle_model");
        while($i <$num){
            $test = $i;
            $value =$feild_name[$i];
            if($value != ''){
                $fname= $fname." ".$value;
                array_push($var, $value);
            }
            $i++;
        }
        $fname = trim($fname);
        $fname=str_replace(' ', ',', $fname);
        $this->db->select($fname);
        //getting csv fields
        $quer=$this -> settings_model -> getting_csv_field_query($report_id,$event_id);
        $numrow=$quer -> num_rows();
        if(file_exists($base_path.'downloadreportzip/'.$foldername.'/'.$csvfilename.'.csv')){
            $csvfilename=$csvfilename.'-'.$numrow;
        }else{
            $csvfilename=$csvfilename;
        }
        //uploaded in to the folder
        $this -> query_to_csv($quer,TRUE,'downloadreportzip/'.$foldername.'/'.$csvfilename.'.csv',$dealer_id);
    }
    //create and save textfile
    function create_txt($event_id,$foldername,$dealer_id,$reportname,$report_id){  
        $companyname_show='';
        $purchase_date_get='';
        $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id);
        if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
            foreach($get_dealer_company_name as $value_dealer_company_name){
                $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
                $companyname_show=strtolower(str_replace(" ","-",$companyname_get));
            }   
        }
        $lead_mining_presets_select='';
        $reoprt_name_show='';
        //getting report name
        $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($event_id);
        if($lead_mining_presets_select=='custom_campaign'){
        if(isset($reportname) && $reportname!=''){
            foreach($reportname as $value_report_name){
                $reoprt_name_show_get=$this -> settings_model -> getreporttype_report_generation_type($value_report_name['report_type']); 
                $reoprt_name_show='G'.$report_id.'-'.$reoprt_name_show_get;
            }    
        }
        }else{
            $reoprt_name_show=$reportname;     
        }
        //text file name creation
        $report_download_time=date('m.d.y',time());
        $zipname=($companyname_show.'-'.trim($reoprt_name_show).'-'.$report_download_time);   
        $dealership_name='';
        $content = 'Dealership Name    FirstName	LastName    Address	Apartment	City	State	Zip	 HomePhone	BusinessPhone	 Year	Make  Model   Purchase Date Trade In Value';
        $query_leadlist=$this -> settings_model -> getting_csv_field_query($report_id,$event_id);
        $content1='';
        $numrow=$query_leadlist -> num_rows();
        if($query_leadlist -> num_rows() > 0){
        $returnvalue= $query_leadlist->result_array();
        foreach($returnvalue as $values_customer_data){
        $dealership_name=$this -> settings_model -> getting_company_name($values_customer_data['dealership_id']); 
        //getting first payment date   
        $purchase_date_get=$this -> settings_model -> getting_firstpayment_date($values_customer_data['sold_vehicle_stock'],$dealer_id);
        $content1.="$dealership_name\t
        $values_customer_data[buyer_first_name]\t
        $values_customer_data[buyer_last_name]\t
        $values_customer_data[buyer_address]\t
        $values_customer_data[buyer_appartment]\t
        $values_customer_data[buyer_city]\t
        $values_customer_data[buyer_province]\t
        $values_customer_data[buyer_postalcode]\t
        $values_customer_data[buyer_homephone]\t
        $values_customer_data[buyer_businessphone]\t
        $values_customer_data[sold_vehicle_year]\t
        $values_customer_data[sold_vehicle_make]\t
        $values_customer_data[sold_vehicle_model]\t
        $purchase_date_get\t \n";   
        }
        }
        //generate and write content in to the text file
        $textfilecontent="$content\n$content1";
        $base_path = $this -> config -> item('rootpath');
        if(file_exists($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.txt')){
            $zipname=$zipname.'-'.$numrow;
        }else{
            $zipname=$zipname;
        }
        $handle = fopen($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.txt', 'w');
        fwrite($handle, $textfilecontent);
        fclose($handle);
    }
    //creating xml file
    function create_xml($event_id,$foldername,$dealer_id,$reportname,$report_id) {
        $companyname_show='';
        $purchase_date_get='';
        $base_path = $this -> config -> item('rootpath');
        $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id);
        if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
            foreach($get_dealer_company_name as $value_dealer_company_name){
                $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
                $companyname_show=strtolower(str_replace(" ","-",$companyname_get));
            }   
        }
        $lead_mining_presets_select='';
        $reoprt_name_show='';
        //getting report type name
        $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($event_id);
        if($lead_mining_presets_select=='custom_campaign'){
            if(isset($reportname) && $reportname!=''){
                foreach($reportname as $value_report_name){
                    //creating xml file name
                    $reoprt_name_show_get=$this -> settings_model -> getreporttype_report_generation_type($value_report_name['report_type']);
                    $reoprt_name_show='G'.$report_id.'-'.$reoprt_name_show_get;
                }    
            }
        }else{
            $reoprt_name_show=$reportname;     
        }
        $report_download_time=date('m.d.y',time());
        $zipname=($companyname_show.'-'.trim($reoprt_name_show).'-'.$report_download_time); 
        $xml = new DOMDocument("1.0");
        $root = $xml->createElement("data");
        $dealership_name='';
        //getting lead details
        $leadlist_details_get=$this->settings_model->get_leadlist_details_with_event_id($event_id);
        //generating lead list query
        if($leadlist_details_get!=''){
            $i=1;
            $xml->appendChild($root);
            $query_leadlist=$this -> settings_model -> getting_csv_field_query($report_id,$event_id);
            $content1='';
            $numrow=$query_leadlist -> num_rows();
            if($query_leadlist -> num_rows() > 0){
            $returnvalue= $query_leadlist->result_array();
            if(file_exists($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.xml')){
            $zipname=$zipname.'-'.$numrow;
            }else{
            $zipname=$zipname;
            }
            foreach($returnvalue as $values){
            $dealership_name=$this -> settings_model -> getting_company_name($values['dealership_id']);   
            $purchase_date_get=$this -> settings_model -> getting_firstpayment_date($values['sold_vehicle_stock'],$dealer_id);
            $id_dealership_name   = $xml->createElement("DealershipName");
            $id_dealership_nameText = $xml->createTextNode($dealership_name);
            $id_dealership_name ->appendChild($id_dealership_nameText);
            //-----------------------------------------------//
           	$id   = $xml->createElement("FirstName");
            $idText = $xml->createTextNode($values['buyer_first_name']);
            $id->appendChild($idText);
            //--------------------------------//
            $title   = $xml->createElement("LastName");
            $titleText = $xml->createTextNode($values['buyer_last_name']);
            $title->appendChild($titleText);
            //----------------------------------//
            $buyer_address_title   = $xml->createElement("Address");
            $buyer_address_titleText = $xml->createTextNode($values['buyer_address']);
            $buyer_address_title->appendChild($buyer_address_titleText);
            //----------------------------------//
            $buyer_appartment_title   = $xml->createElement("Apartment");
            $buyer_appartment_titleText = $xml->createTextNode($values['buyer_appartment']);
            $buyer_appartment_title->appendChild($buyer_appartment_titleText);
            //----------------------------------//
            $buyer_city_title   = $xml->createElement("City");
            $buyer_city_titleText = $xml->createTextNode($values['buyer_city']);
            $buyer_city_title->appendChild($buyer_city_titleText);
            //----------------------------------//
            $buyer_province_title   = $xml->createElement("State");
            $buyer_province_titleText = $xml->createTextNode($values['buyer_province']);
            $buyer_province_title->appendChild($buyer_province_titleText);
             //----------------------------------//
            $buyer_postalcode_title   = $xml->createElement("Zip");
            $buyer_postalcode_titleText = $xml->createTextNode($values['buyer_postalcode']);
            $buyer_postalcode_title->appendChild($buyer_postalcode_titleText);
            //----------------------------------//
             $buyer_homephone_title   = $xml->createElement("HomePhone");
            $buyer_homephone_titleText = $xml->createTextNode($values['buyer_homephone']);
            $buyer_homephone_title->appendChild($buyer_homephone_titleText);
            //----------------------------------//
            $buyer_businessphone_title   = $xml->createElement("WorkPhone");
            $buyer_businessphone_titleText = $xml->createTextNode($values['buyer_businessphone']);
            $buyer_businessphone_title->appendChild($buyer_businessphone_titleText);
             //----------------------------------//
            $sold_vehicle_year_title   = $xml->createElement("Year");
            $sold_vehicle_year_titleText = $xml->createTextNode($values['sold_vehicle_year']);
            $sold_vehicle_year_title->appendChild($sold_vehicle_year_titleText);
            //----------------------------------//
            $sold_vehicle_make_title   = $xml->createElement("Make");
            $sold_vehicle_make_titleText = $xml->createTextNode($values['sold_vehicle_make']);
            $sold_vehicle_make_title->appendChild($sold_vehicle_make_titleText);
            //----------------------------------//
            $sold_vehicle_model_title   = $xml->createElement("Model");
            $sold_vehicle_model_titleText = $xml->createTextNode($values['sold_vehicle_model']);
            $sold_vehicle_model_title->appendChild($sold_vehicle_model_titleText);
            //----------------------------------//
            $buyer_cellphone_title   = $xml->createElement("PurchaseDate");
            $buyer_cellphone_titleText = $xml->createTextNode($purchase_date_get);
            $buyer_cellphone_title->appendChild($buyer_cellphone_titleText);
            //----------------------------------//
            $book = $xml->createElement('Leadlist'.$i);
            $book->appendChild($id_dealership_name);
            $book->appendChild($id);
            $book->appendChild($title);
            $book->appendChild($buyer_address_title);
            $book->appendChild($buyer_appartment_title);
            $book->appendChild($buyer_city_title);
            $book->appendChild($buyer_province_title);
            $book->appendChild($buyer_postalcode_title);
            $book->appendChild($buyer_homephone_title);
            $book->appendChild($buyer_businessphone_title);
            $book->appendChild($sold_vehicle_year_title);
            $book->appendChild($sold_vehicle_make_title);
            $book->appendChild($sold_vehicle_model_title);
            $book->appendChild($buyer_cellphone_title);
            $i++;
            $root->appendChild($book);
            
            $xml->formatOutput = true;
            //echo "<xmp>". $xml->saveXML() ."</xmp>";
            //save in content to the xml file
            $xml->save($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.xml') or die("Error");
            } 
            }
        }
    } 
    // write in to csv creation file
    function array_to_csv($array, $download = ""){
        ob_start();
        $f = fopen($download, 'w') or show_error("Can't open php://output");
        $n = 0;        
        foreach ($array as $line){
            $n++;
            if ( ! fputcsv($f, $line)){
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();
    }
    //generating array generating query
    function query_to_csv($query, $headers = TRUE, $download = "",$dealer_id){
        if ( ! is_object($query) OR ! method_exists($query, 'list_fields')){
            show_error('invalid query');
        }
        $array = array();
        if ($headers){
            $line = array();
            //create array with needed fields
            $customer_data_feild_name=array("Dealership Name","First Name","Last Name","Address","Apartment #","City","Province/State","Postal Code/Zip","Home Phone","Work Phone","Year","Make","Model","Purchase Date","Trade In Value");
            foreach ($customer_data_feild_name as $name){
                $line[] = $name;
            }
            $array[] = $line;
        }
        $i=1;
        foreach ($query->result_array() as $row){
            $line = array();
            $p=1;
            foreach ($row as $item){
            //insert first payment in to the array
            if($i==14){
            $purchase_date=$this -> settings_model -> getting_firstpayment_date($item,$dealer_id);
            $line[] = $purchase_date; 
            }else if($i==1){
                $dealership_name=$this -> settings_model -> getting_company_name($item);
                $line[] = $dealership_name;   
            }else if($i==2){
                if($item!=''){
                    $firstname=trim($item);
                }else{
                    $firstname='N/A'; 
                }
                $line[] = $firstname; 
            }else{
                $line[] = trim($item);  
            }
            $i++;
            $p++;
            }
            $i=1;
            $array[] = $line;
        }
        $this ->  array_to_csv($array, $download);;
        //echo array_to_csv($array, $download);
    }
    //create and download lead list zip file
    public function create_pdf($event_id,$dealer_id) {
        $companyname_show='';
        //getting company name
        $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id);
        if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
            foreach($get_dealer_company_name as $value_dealer_company_name){
                $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
                $companyname_show=strtolower(str_replace(" ","",$companyname_get));
            }   
        }
        $report_download_time=date('mdy',time());
        $zipname=($companyname_show.'-'.$report_download_time.'-'.$event_id);
        $base_path = $this -> config -> item('rootpath');
        $destination = $base_path.'downloadreportzip';
        $base_path = $this -> config -> item('rootpath');
        $this->zip->archive($base_path.'/downloadreportzip/'.$zipname.'/'.$zipname.'.zip'); 
        //download zip file 
        $this->zip->get_files_from_folder($base_path.'/downloadreportzip/'.$zipname.'/',$zipname.'.zip/',$zipname);
        $this->zip->download($zipname.'.zip');
    }
}
?>