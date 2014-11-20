<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Campaign extends CI_Controller 
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
    $this->load->library('session');
    $this->load->database();
    $this->load->helper('xml');
    $this->load->library('email');
   	}
    //campain page starting 
    public function index($dealer_id_pass=''){

        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        //setting incomplete event 
        $this->session->unset_userdata('event_id_get');
        $this->session->unset_userdata('incomplete_event_set');
        if (isset($data['menu']['logged_in']) != ''){ 
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
            $data['dealerdashboard']=$dealers_userid;
            $data['dealer_id_upload_data']=$dealer_id_pass;
            $data['member_type']=$this->input->post('member_type'); 
            $this->load->view('themes/header',$data);

            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data); 
            }
            $this->buildevent($dealer_id_pass);
            //check incomplete events for the dealer
            $this->load->view('themes/footer',$data); 
        }
        else{
            redirect(base_url().'login');
        }
    }
    public function newsaleandeven(){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){ 
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'){
            $this->load->view('themes/side-bar',$data);
            }else{
            $this->load->view('themes/dealerside-bar',$data);
            }
            $this-> load-> view('newsaleandeven-view',$data);
            $this->load->view('themes/footer',$data);  
        }
        else{
            redirect(base_url().'login');
        }
    }
    //buld your event page
    public function buildevent($dealer_id){

        $data['dealerdashboard']=$dealer_id;
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            //getting incomplete event 
            $event_insert_get=$this->settings_model->reopen_incomplete_event($dealer_id);
            if($event_insert_get!=''){ 
                foreach($event_insert_get as $values){
                    $event_insert_get=$values['event_id'];
                    $incomplete=1;
                    $this -> session -> set_userdata('event_id_get', $event_insert_get);
                    $data['event_insert_id']=$this->session->userdata('event_id_get');
                    $this -> session -> set_userdata('incomplete_event_set', $incomplete);
                    $data['incomplete_event']=$this->session->userdata('incomplete_event_set');
                }
                //setting leadlist id in to the session variable
                $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
                if($lead_selection!=''){
                    $incomplete=1;
                    $this -> session -> set_userdata('leadlist', $incomplete);
                    $data['leadlist']=$this->session->userdata('leadlist');
                    
                }
                //setting mailout id in to the session variable
                 $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
                 if(!empty($mailout_selection)){
                    $incomplete=1;
                    $this -> session -> set_userdata('mailout', $incomplete);
                    $data['mailout']=$this->session->userdata('mailout');
                }
            }
            //load campine side bar and event generation  page
            $this->load->view('campaignpage-sidebar-view',$data);
            $this->load->view('newcampign-view',$data);
       }
    }
    //calling campine generation
     public function campaignviewpage($dealer_id_pass=''){

        $data['menu'] = $this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        if (isset($data['menu']['logged_in']) != ''){
        $dealers_userid=$data['menu']['logged_in']['registration_id'];
        $data['dealerdashboard']=$dealers_userid;
        $data['dealer_id_upload_data']=$dealer_id_pass;
        $data['member_type']=$this->input->post('member_type'); 
        $event_start_date=$this->input->post('event_start_date');
        $event_end_date=$this->input->post('event_end_date');
        $advertising_option=$this->input->post('advertising_option');
        $event_insert_id_set=$this->input->post('event_insert_edit');
        $this->session->userdata('incomplete_event_set');
        $campign_status=$this->input->post('campign_status');
        //check event date empty
        if($event_start_date!='' && $event_end_date!=''){
        //edit event section
        if($campign_status=='edit'){
            $this -> session -> set_userdata('event_id_get', $event_insert_id_set);
            $this->session->userdata('event_id_get');           
            $data['event_insert_id']=$event_insert_id_set;
            $incomplete=1;
            $this -> session -> set_userdata('incomplete_event_set', $incomplete);
            $data['incomplete_events']=$this->session->userdata('incomplete_event_set');
            $data['campign_status']='edit';
            $event_insert_get=$this->settings_model->insert_event($dealer_id_pass);
        }
        else if($this->session->userdata('event_id_get')!=''){
            //geting campine creation id
             $event_insert_get=$this->settings_model->insert_event($dealer_id_pass);
            $campine_event_get=$this->settings_model->campaign_select($this->session->userdata('event_id_get'));
            if($campine_event_get!=''){
            $incomplete=1;
            $this -> session -> set_userdata('incomplete_event_set', $incomplete);
            $data['incomplete_events']=$this->session->userdata('incomplete_event_set');
            }
            $data['event_insert_id']=$this->session->userdata('event_id_get');
        }
        else{
            $event_insert_get=$this->settings_model->insert_event($dealer_id_pass);
            $this -> session -> set_userdata('event_id_get', $event_insert_get);            
            $data['event_insert_id']=$this->session->userdata('event_id_get');
        }
        //getting mailout id
        $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
         if(!empty($mailout_selection)){
            $incomplete=1;
            $this -> session -> set_userdata('mailout', $incomplete);
            $data['mailout']=$this->session->userdata('mailout');
        }
        //getting leadlist id
        $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
         if($lead_selection!=0){
             $incomplete=1;
             $this -> session -> set_userdata('leadlist', $incomplete);
             $data['leadlist']=$this->session->userdata('leadlist');
         }                
        $this->load->view('themes/header',$data);
        if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
            $this->load->view('themes/side-bar',$data);
        }else{
            $this->load->view('themes/dealerside-bar',$data); 
        }
        if($advertising_option=='1' || $advertising_option=='3'){
            $this-> load-> view('campaign-confirm-view',$data);  
        }
        else{
            $this->load->view('campaignpage-sidebar-view',$data);
            $this-> load-> view('campaign-view',$data); 
        }
            $this->load->view('themes/footer',$data); 
        }
        else{
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data); 
            }
            $data['error']='';
            $this->load->view('campaignpage-sidebar-view',$data);
            $this->load->view('newcampign-view',$data);
            $this->load->view('themes/footer',$data); 
        }       
        }
        else
        {
            redirect(base_url().'login');
        }
    }
    
    //view  total customer lead list
    public function customerlist($dealer_id_pass=''){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $data['campaine_step']='capaine_step_complete';
        $manufacurer_interesr_rate=$this->input->post('manufacurer_interesr_rate');
        $best_sub_prime_rate=$this->input->post('best_sub_prime_rate');
        $factory_rebate=$this->input->post('factory_rebate');
        $dealership_incentives=$this->input->post('dealership_incentives');
        $excess_vehicle=$this->input->post('excess_vehicle');
        $dealership_promos=$this->input->post('dealership_promos');
        if (isset($data['menu']['logged_in']) != ''){
            //check if fields are not empty and insert in to the database
            if($manufacurer_interesr_rate!=''|| $best_sub_prime_rate!='' || $factory_rebate!='' || $dealership_incentives!='' || $excess_vehicle!='' || $dealership_promos!=''){
            $data['campaign_inesrt_id']=$this->settings_model->update_campaign_step3($this->session->userdata('campain_insert_id'));  
            }
             $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
             if($lead_selection!=0){
                 $incomplete=1;
                 $this -> session -> set_userdata('leadlist', $incomplete);
                 $data['leadlist']=$this->session->userdata('leadlist');
            }
             $dealers_userid=$data['menu']['logged_in']['registration_id'];
             $data['event_insert_id']=$this->session->userdata('event_id_get');
             $data['dealerdashboard']=$dealers_userid;
             $data['dealer_id_upload_data']=$dealer_id_pass;
             $data['member_type']=$this->input->post('member_type'); 
             //getting mailout id
             $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
             if(!empty($mailout_selection)){
                $incomplete=1;
                $this -> session -> set_userdata('mailout', $incomplete);
                $data['mailout']=$this->session->userdata('mailout');
            }
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data);
            }
            $this-> load-> view('campaignpage-sidebar-view',$data);
            //check and redirect the page
            $lead_mining_presets=$this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
            if($lead_mining_presets!='custom_campaign'){
                $this-> load-> view('target-customer-list',$data);
            }
            else{
                $data['lead_mining_presets'] = $this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
                $data['lead_mining_presets_name_get'] = $this -> settings_model -> get_lead_type_name($data['lead_mining_presets']);
                if($data['lead_mining_presets_name_get']){
                    $query_date_range = $this -> settings_model -> get_advanced_past_vehicle_purchase_date_range($this->session->userdata('event_id_get'));
                    $returnvalue_group = array();
                    for($i = 1;$i<6;$i++){
                        $returnvalue_group[$i] = $this -> settings_model -> get_advance_option($this->session->userdata('event_id_get'),$i);
                    }
                    $data['query_date_range'] = $query_date_range;
                    $data['returnvalue_group'] = $returnvalue_group;
                    $return_group=$this -> main_model -> get_total_count_advance_options($this->session->userdata('event_id_get'),$dealer_id_pass,$lead_group='',$query_date_range,$returnvalue_group); 
                    $data['customer_leadlist_check'] = $return_group[0];
                    $data['return_group'] = $return_group;
                }
                $this-> load-> view('advanced-option-report-list',$data);  
            }
            $this->load->view('themes/footer',$data);    
        }
        else{
         redirect(base_url().'login');
         }
    }
    //create mailing invitation 
    public function mailoutoption($dealer_id_pass=''){
    $data['title'] = 'Exclusive Private Sale Inc-Campaign';
    $data['menu']=$this->login_model->loginauth();
    $data['lead_step']='leadlist_step_complete';
    $data['campaine_step']='capaine_step_complete';
    $equity_scrap=$this->input->post('equity_scrap');
    $model_break_down=$this->input->post('model_break_down');
    $fuel_effciency=$this->input->post('fuel_effciency');
    $wrranty_scrap=$this->input->post('wrranty_scrap');
    $custom_campaign=$this->input->post('custom_campain');
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
        if(!empty($mailout_selection)){
            $incomplete=1;
            $this -> session -> set_userdata('mailout', $incomplete);
            $data['mailout']=$this->session->userdata('mailout');
        }
        $this->load->view('themes/header',$data);
        //deleting all lead list when edit exist events
        if($equity_scrap!='' || $model_break_down!='' || $fuel_effciency!='' || $wrranty_scrap!='' || $custom_campaign!=''){  
         $lead_delete_cusomer_data=$this -> settings_model -> leadlistdelete($this->session->userdata('lead_list_id'));   
        }//insert first lead list
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
         if($custom_campaign!=''){
         if(!empty($customcampaign_customer_id)){
           foreach ($customcampaign_customer_id as $value_customcampaign){
                $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$custom_campaign,$value_customcampaign);  
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
        $companyname_show=strtolower(str_replace(" ","-",$companyname_get));
        }   
        }
        $report_download_time=date('m.d.y',time());

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
        }else{
        mkdir($file_path, 0777);   
        }
        //create folder and create csv file
        if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
        $this->load->view('themes/side-bar',$data);
        }else{
            $this->load->view('themes/dealerside-bar',$data);
        }
        $this-> load-> view('campaignpage-sidebar-view',$data);
        $this-> load-> view('mailout-options-view',$data);
        $this->load->view('themes/footer',$data);
        $lead_mining_presets_select='';
        //getting lead mining presets
        $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
        if($lead_mining_presets_select=='custom_campaign'){
        $group_1_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),1);
        if(isset($group_1_details) && $group_1_details!=''){
                // get lead count of first group and create files
                $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'1');
                if($get_selected_lead_group!=0){
                    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1); 
                    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1);
                    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1);
                }
            }
            // get lead count of second group and create files
            $group_2_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),2);
            if(isset($group_2_details) && $group_2_details!=''){
            $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'2');
                if($get_selected_lead_group!=0){
                    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2); 
                    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2); 
                    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2);
                }
            }
            // get lead count of third group and create files
            $group_3_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),3);
            if(isset($group_3_details) && $group_3_details!=''){
                $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'3');
                if($get_selected_lead_group!=0){
                    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);
                    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);  
                    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);
                    }
            }
            // get lead count of fourth group and create files
            $group_4_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),4);
            if(isset($group_4_details) && $group_4_details!=''){
                $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'4');
                if($get_selected_lead_group!=0){
                    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4); 
                    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4); 
                    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4);
                }
            }
            // get lead count of fifth group and create files
            $group_5_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),5);
            if(isset($group_5_details) && $group_5_details!=''){
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
    }
    else
    {
        redirect(base_url().'login');
    }
    }
    function insertcustomer_lead_list(){
        $equity_scrap=$this->input->post('equity_scrap');
        $model_break_down=$this->input->post('model_break_down');
        $fuel_effciency=$this->input->post('fuel_effciency');
        $wrraenty_scrap=$this->input->post('wrranty_scrap');
        $custom_campaign=$this->input->post('custom_campain');
        $fuel_report6=$this->input->post('fuel_report6');
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        if($equity_scrap!='' || $model_break_down!='' || $fuel_effciency!='' || $wrraenty_scrap!='' || $custom_campaign!='' || $fuel_report6!=''){
        $leadlist_insert_id=$this->settings_model->insertleadlistselction($this->session->userdata('event_id_get')); 
        $this -> session -> set_userdata('lead_list_id', $leadlist_insert_id);            
        $data['lead_list_id']=$this->session->userdata('lead_list_id');
        echo "Done";  
    }
    }
    //mail_insert
    function insert_mailer_step1(){
    $mailer_size=$this->input->post('mailer_size');
    $data['event_insert_id']=$this->session->userdata('event_id_get');
    if($mailer_size!=''){
        //mailout insert 
        $mailer_id_get=$this->settings_model->insertmailetsetp1($this->session->userdata('event_id_get'));
        $this -> session -> set_userdata('mailer_id', $mailer_id_get);            
        $data['mailer_insert_id']=$this->session->userdata('mailer_id');
        echo "Done";  
    }
    else
    {
        $data['mailer_insert_id']='';  
    } 
    }
    //mailer step2
      function insert_mailer_step2(){
      $versioning=$this->input->post('versioning');
      $data['event_insert_id']=$this->session->userdata('event_id_get');
      $data['mailer_insert_id']=$this->session->userdata('mailer_id');
      if($this->session->userdata('mailer_id')!=''){
        $mailer_id_get=$this->settings_model->updatemailetsetp2($this->session->userdata('mailer_id'));
      }
      else{
          $mailer_id_get=$this->settings_model->insertmailetsetp2($this->session->userdata('mailer_id'));
          $this -> session -> set_userdata('mailer_id', $mailer_id_get);            
          $data['mailer_insert_id']=$this->session->userdata('mailer_id');
      }
    }
    //mailer step3
    function insert_mailer_step3(){
    $auto_pen=$this->input->post('auto_pen');
    $insert_cardstock=$this->input->post('insert_cardstock');
    $insert_paperstock=$this->input->post('insert_paperstock');
    $variable_image=$this->input->post('variable_image');
    $colored_envelop=$this->input->post('colored_envelop');
    $data['event_insert_id']=$this->session->userdata('event_id_get');
    $data['mailer_insert_id']=$this->session->userdata('mailer_id');
    //insert mailout step3
        if($auto_pen!='' || $insert_cardstock!='' || $insert_paperstock!=''|| $variable_image!=''|| $colored_envelop!=''){
        $mailer_id_get_step3=$this->settings_model->updatemailetsetp3($this->session->userdata('mailer_id'));
        echo "Done";                                
    }
    else{
        echo "Not done";
        $mailer_id_get_step3='';
        }
      }
    function insert_mailer_step4(){
    $upgrade_package=$this->input->post('upgrade_package');
    $data['event_insert_id']=$this->session->userdata('event_id_get');
    $data['mailer_insert_id']=$this->session->userdata('mailer_id');
    if($upgrade_package!='' ){
    $mailer_id_get_step4=$this->settings_model->updatemailetsetp4($this->session->userdata('mailer_id'));
    $event_id_complete=$this->settings_model->update_event_complete($this->session->userdata('event_id_get'));
    echo "Done";
    }
    else{
        $event_id_complete=$this->settings_model->update_event_complete($this->session->userdata('event_id_get'));
        $mailer_id_get_step4='';
        echo "Not Done";
      }
  }
  
    function epsadvantage_campaign_fiststep(){
        $data['menu']=$this->login_model->loginauth();
        $campaine_insert_id=$this->settings_model->insert_campaign_step1($this->session->userdata('event_id_get'));
        $this -> session -> set_userdata('campain_insert_id', $campaine_insert_id);            
        $data['campaine_insert_get']=$this->session->userdata('campain_insert_id');
        echo $campaine_insert_id;
    }
    function epsadvantage_campaign_advanced_option(){
        $data['menu']=$this->login_model->loginauth();
        $event_id=$this->input->post('event_insert_id');
        $get_campign_id=$this->settings_model->get_campign_id($event_id);
        if($get_campign_id!=0){
        $campine_advanced_option_updates=$this->settings_model->update_campaign_step1($get_campign_id);
        echo 'Doneq';
    }
    }
    //edit events
   function editcampign($event_id,$dealer_id){
       $data['menu']=$this->login_model->loginauth();
       $this->session->unset_userdata('event_id_get');
       $this->session->unset_userdata('incomplete_event_set');
       $dealers_userid=$dealer_id;
       $data['dealerdashboard']=$dealer_id;
       $data['dealer_id_upload_data']=$dealer_id;
       if (isset($data['menu']['logged_in']) != ''){
           if($event_id!=''){ 
               $incomplete=1;
               $this -> session -> set_userdata('incomplete_event_set', $incomplete);
               $data['incomplete_event']=$this->session->userdata('incomplete_event_set');
               $this -> session -> set_userdata('event_id_get', $event_id);
               $data['event_insert_id']=$this->session->userdata('event_id_get');
           }
           $data['campign_status']='edit';
           //get lead id
           $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
           if(!empty($lead_selection)){
               $incomplete=1;
               $this -> session -> set_userdata('leadlist', $incomplete);
               $data['leadlist']=$this->session->userdata('leadlist');
           }
            //get mailout id
           $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
           if(!empty($mailout_selection)){
               $incomplete=1;
               $this -> session -> set_userdata('mailout', $incomplete);
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
       }
       else{
        redirect(base_url().'login');
       }
   }
   //function to go to step 1
   public function linkto_step1($event_id,$dealer_id,$getstep){
       if($event_id!=0){
           $data['menu']=$this->login_model->loginauth();
           $data['title'] = 'Exclusive Private Sale Inc-Campaign';
           if (isset($data['menu']['logged_in']) != ''){
               $dealers_userid=$data['menu']['logged_in']['registration_id'];
               $data['dealerdashboard']=$dealers_userid;
               $data['dealer_id_upload_data']=$dealer_id;
               $this -> session -> set_userdata('event_id_get', $event_id);
               $this->session->userdata('event_id_get');           
               $data['event_insert_id']=$event_id;
               $incomplete=1;
               $this -> session -> set_userdata('incomplete_event_set', $incomplete);
               $data['incomplete_event']=$this->session->userdata('incomplete_event_set');
               $data['campign_status']='edit';
               //getting mailout option id
               $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
               $get_campign_id=$this->settings_model->get_campign_id($event_id);
               $this -> session -> set_userdata('campain_insert_id', $get_campign_id);            
               $data['campaine_insert_get']=$this->session->userdata('campain_insert_id');
               if(!empty($mailout_selection)){
                   $incomplete=1;
                   $this -> session -> set_userdata('mailout', $incomplete);
                   $data['mailout']=$this->session->userdata('mailout');
                   }
               $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
               if($lead_selection!=0){
                   $incomplete=1;
                   $this -> session -> set_userdata('leadlist', $incomplete);
                   $data['leadlist']=$this->session->userdata('leadlist');
               }         
               $data['editted_step']=$getstep;      
               $this->load->view('themes/header',$data);
               if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
               }else{
                $this->load->view('themes/dealerside-bar',$data); 
               }
                   $this->load->view('campaignpage-sidebar-view',$data);
                   $this-> load-> view('campaign-view',$data); 
           }
       }
       else{
        $this->index($dealer_id);             
       }
    } 
    //get sale leadlist   selection
    public function sale_leadlist($event_id,$dealer_id){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $data['campaine_step']='capaine_step_complete';
        if (isset($data['menu']['logged_in']) != ''){ 
            $this -> session -> set_userdata('event_insert_id', $event_id);
            $data['event_insert_id']=$this->session->userdata('event_insert_id');
            $lead_selection=$this -> settings_model -> leadsection_select($event_id); 
            if($lead_selection!=0 && $event_id!=0){
                $incomplete=1;
                $this -> session -> set_userdata('leadlist', $incomplete);
                $data['leadlist']=$this->session->userdata('leadlist');
                $dealers_userid=$data['menu']['logged_in']['registration_id'];
                $data['dealerdashboard']=$dealers_userid;
                $data['dealer_id_upload_data']=$dealer_id;
                $data['editted_step']='lead_step1';
                $mailout_selection=$this -> settings_model -> mailout_option_select($event_id); 
                if(!empty($mailout_selection)){
                    $incomplete=1;
                    $this -> session -> set_userdata('mailout', $incomplete);
                    $data['mailout']=$this->session->userdata('mailout');
                }
                $this->load->view('themes/header',$data);
                if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                    $this->load->view('themes/side-bar',$data);
                }else{
                    $this->load->view('themes/dealerside-bar',$data);
                }
                $this-> load-> view('campaignpage-sidebar-view',$data);
                $this-> load-> view('target-customer-list',$data);
                $this->load->view('themes/footer',$data);   
            }else{
                $this->index($dealer_id);    
            } 
        }
        else{
            redirect(base_url().'login');
        }
    }
    //getting mailout options details 
    public function linkto_maileroption($event_id,$dealer_id,$step_no){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $data['lead_step']='leadlist_step_complete';
        $data['campaine_step']='capaine_step_complete';
        $this -> session -> set_userdata('event_insert_id', $event_id);
        $data['event_insert_id']=$this->session->userdata('event_insert_id');
        if (isset($data['menu']['logged_in']) != '') { 
            //getting invitaion details
        $mailout_selection=$this -> settings_model -> mailout_option_select($event_id); 
        if($mailout_selection!=0 && $event_id!=0){
            $data['dealerdashboard']=$dealer_id;
            $data['dealer_id_upload_data']=$dealer_id;
            $data['editted_step']=$step_no;
            if(!empty($mailout_selection)){
                $incomplete=1;
                $this -> session -> set_userdata('mailout', $incomplete);
                $data['mailout']=$this->session->userdata('mailout');
            }
             $this->load->view('themes/header',$data);
             if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'|| $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
             }else{
                $this->load->view('themes/dealerside-bar',$data);
             }
             $this-> load-> view('campaignpage-sidebar-view',$data);
             $this-> load-> view('mailout-options-view',$data);
             $this->load->view('themes/footer',$data);  
         }else{
            $this->index($dealer_id);  
         }
         }else
         {
         redirect(base_url().'login');
         }
    }
    //edit mailout option page
    public function advertising_option($event_id,$dealer_id_upload_data){
        if($event_id!=0){
            $data['title'] = 'Exclusive Private Sale Inc-Campaign';
            $data['menu']=$this->login_model->loginauth();
            $this->session->unset_userdata('event_id_get');
            $this->session->unset_userdata('incomplete_event_set');
            if (isset($data['menu']['logged_in']) != ''){ 
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
            $data['dealerdashboard']=$dealers_userid;
            $data['dealer_id_upload_data']=$dealer_id_upload_data;
            $data['member_type']=$this->input->post('member_type'); 
            $this->load->view('themes/header',$data);
            if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
                $this->load->view('themes/side-bar',$data);
            }else{
                $this->load->view('themes/dealerside-bar',$data); 
            }
            $this->editcampign($event_id,$dealer_id_upload_data);
            //check incomplete events for the dealer
            }  
        }
        else{
            $this->index($dealer_id_upload_data);
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
        //check incomplete events for the dealer
   }
    else{
        redirect(base_url().'login');   
    }  
    }
    //get pbs customer details
    public function get_customer_details($customer_id,$foldername){
        $data['get_customerdetails']=$this -> main_model -> customerdatafulldetails($customer_id);
        $this->load->view('customer-details-view',$data);
    }
    public function get_customer_details_with_customer_id($customer_id){
        $data['get_customerdetails']=$this -> main_model -> customerdatafulldetails($customer_id);
        $this->load->view('customer-details-view',$data);
    }
   //create csv file
   function create_csv($event_id,$foldername,$dealer_id,$reportname,$report_id){
   $companyname_show='';
   //getting dealer company name
   $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id);
   if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
       foreach($get_dealer_company_name as $value_dealer_company_name){
       $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
       $companyname_show=strtolower(str_replace(" ","-",$companyname_get));
       }   
    }
    $lead_mining_presets_select='';
    $reoprt_name_show='';
    //getting report type
    $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($event_id);
    if($lead_mining_presets_select=='custom_campaign'){
        if(isset($reportname) && $reportname!=''){
            foreach($reportname as $value_report_name){
                //getting report type name
                $reoprt_name_show_get=$this -> settings_model -> getreporttype_report_generation_type($value_report_name['report_type']); 
                $reoprt_name_show='G'.$report_id.'-'.$reoprt_name_show_get;
            }    
        }
    }
    else{
        $reoprt_name_show=$reportname;     
    }
    $report_download_time=date('m.d.y',time());
    //creating csv  file name
    $csvfilename=($companyname_show.'-'.trim($reoprt_name_show));
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
    $query=$this -> settings_model -> getting_csv_field_query($report_id,$event_id);
    $this -> query_to_csv($query,TRUE,'downloadreportzip/'.$foldername.'/'.$csvfilename.'.csv',$dealer_id);
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
    //creating report type name
    $reoprt_name_show_get=$this -> settings_model -> getreporttype_report_generation_type($value_report_name['report_type']); 
    $reoprt_name_show='G'.$report_id.'-'.$reoprt_name_show_get;
    }    
    }
    }
    else{
    $reoprt_name_show=$reportname;     
    }
    $report_download_time=date('m.d.y',time());
    //text file name creation
    $zipname=($companyname_show.'-'.trim($reoprt_name_show));   
    $dealership_name='';
    $content = 'Dealership Name    FirstName	LastName    Address	Apartment	City	State	Zip	 HomePhone	BusinessPhone	 Year	Make  Model   Purchase Date Trade In Value';
    $query_leadlist=$this -> settings_model -> getting_csv_field_query($report_id,$event_id); 
    $content1='';
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
    $handle = fopen($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.txt', 'w');
    fwrite($handle, $textfilecontent);
    fclose($handle);
    }
    //creating xml file
    function create_xml($event_id,$foldername,$dealer_id,$reportname,$report_id){
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
    $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($event_id);
    if($lead_mining_presets_select=='custom_campaign'){
    if(isset($reportname) && $reportname!=''){
    foreach($reportname as $value_report_name){
    //getting report type name
    $reoprt_name_show_get=$this -> settings_model -> getreporttype_report_generation_type($value_report_name['report_type']); 
    $reoprt_name_show='G'.$report_id.'-'.$reoprt_name_show_get;
    }    
    }
    }
    else{
    $reoprt_name_show=$reportname;     
    }
    $report_download_time=date('m.d.y',time());
    //creating xml file name
    $zipname=($companyname_show.'-'.trim($reoprt_name_show)); 
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
        if($query_leadlist -> num_rows() > 0){
            $returnvalue= $query_leadlist->result_array();
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
                $base_path = $this -> config -> item('rootpath');
                //save in content to the xml file
                $xml->save($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.xml') or die("Error");
            } 
        }
    }
    } 
    //submit lead list after creating event
    function submitleadlist($delaer_id,$event_id){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != ''){
            $dealer_email=$this->input->post('dealer_email'); 
            $account_manager=$this->input->post('account_manager'); 
            $email_address=$this->input->post('email_address');
            $dealer_name=$this->input->post('dealer_name');
            $account_manager_name=$this->input->post('account_manager_name');
            $subject='Reports From Exclusive Private Sale';
            //$to='ecommercedvlpr@gmail.com';
            $admin_emailid= $this -> config -> item('admin_address'); 
            $message='';
            $message_account_manager='';
            $message_other='';
            //$delaer_id=122;
            //$event_id=20;
            $base_path = $this -> config -> item('rootpath');
            $foldername=($delaer_id.'-'.$event_id);
            $filename =base_url().'downloadreportzip/'.$foldername.'/leadreport-'.$foldername.'.zip'; 
            //sending mail to dealer
            if($dealer_email!=''){  		
                $message.= 'Dear '.$dealer_name.',<br/><br/>';
                $message.='Your leadlist details file is given below.Please download<br><br>
                ';
                $message.='<a href='.base_url().'downloadpdf/create_pdf/'.$event_id.'/'.$delaer_id.'  class="TableLink">Download</a><br><br>'; 
                $message.='Regards,<br/>Exclusive Private Sale.Inc';  
                $this->main_model->HTMLemail($dealer_email,'Exclusive Private Sale<'.$admin_emailid.'>','',$subject,$message);
            }
            //sending mail to account manager
            if(!empty($account_manager)){
                $i=0;
                foreach($account_manager as $value_email){
                $message_account_manager.= 'Dear '.$account_manager_name[$i].',<br/><br/>';
                $message_account_manager.='Your leadlist details file is given below.Please download<br><br>
                ';
                $message_account_manager.='<a href='.base_url().'downloadpdf/create_pdf/'.$event_id.'/'.$delaer_id.'  class="TableLink">Download</a><br><br>'; 
                $message_account_manager.='Regards,<br/>Exclusive Private Sale.Inc';  
                $this->main_model->HTMLemail($value_email,'Exclusive Private Sale<'.$admin_emailid.'>','',$subject,$message_account_manager);
                $i++;
                } 
            }
            //sending mail to select address
            if($email_address!=''){
                $message_other.= 'Hello,<br/><br/>';
                $message_other.='Your leadlist details file is given below.Please download<br><br>
                ';
                $message_other.='<a href='.base_url().'downloadpdf/create_pdf/'.$event_id.'/'.$delaer_id.'  class="TableLink">Download</a><br><br>'; 
                $message_other.='Regards,<br/>Exclusive Private Sale.Inc';  
                $this->main_model->HTMLemail($email_address,'Exclusive Private Sale<'.$admin_emailid.'>','',$subject,$message_other); 
                }
            $data='sendmail';
            $this-> load-> view('page-redirect',$data);
        }
        else
        {
        redirect(base_url().'login');
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
    //getting first payment date
    $purchase_date=$this -> settings_model -> getting_firstpayment_date($item,$dealer_id);
    $line[] = $purchase_date; 
    }
    //insert company name in to the array
    else if($i==1){
    $dealership_name=$this -> settings_model -> getting_company_name($item);
    $line[] = $dealership_name;   
    }
    else if($i==2){
    if($item!=''){
    $firstname=trim($item);
    }  
    else{
    $firstname='N/A'; 
    }
    $line[] = $firstname; 
    }
    else{
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
//advance options group insertion
function insert_advanceoption_groups(){
     $report_name=$this->input->post('report_name'); 
     $value_get_1=$this->input->post('value_get_1'); 
     $value_get_2=$this->input->post('value_get_2');
     $value_get_3=$this->input->post('value_get_3');
     $feild_name_1=$this->input->post('feild_name_1');
     $feild_name_2=$this->input->post('feild_name_2');
     $event_id=$this->input->post('event_id');
     $leadlist_details_get=$this->settings_model->insert_advance_option_group_selection();
     if($leadlist_details_get!=''){
        echo "Done";
     }
 } 
 //display advance option specific mode
function diaplaymode(){
    $make=$this->input->post('make');
    $model=$this->input->post('model'); 
    $retrieved=$this->settings_model->getting_make_model($make); 
    $optStr='';
    foreach($retrieved as $values){
        if($values['model']!=''){
            if($model!=''){
                if($values['model']==$model){
                $optStr .= '<option value="'.$values['model'].'" selected>'.$values['model'].'</option>'; 
                }      
            }
            $optStr .= '<option value="'.$values['model'].'">'.$values['model'].'</option>';
            }
        }
    
    echo $optStr;
}  
}
?>