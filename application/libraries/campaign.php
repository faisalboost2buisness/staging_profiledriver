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
    public function index($dealer_id_pass='')
    {
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $this->session->unset_userdata('event_id_get');
        $this->session->unset_userdata('incompete_event_set');
        
        if (isset($data['menu']['logged_in']) != '') 
        { 
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
        //check incompete events for the dealer
        $this->load->view('themes/footer',$data); 
        }
        else
        {
        redirect(base_url().'login');
        }
        
    }
    public function newsaleandeven()
    {
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') 
        { 
        $this->load->view('themes/header',$data);
        if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin'){
        $this->load->view('themes/side-bar',$data);
        }else{
        $this->load->view('themes/dealerside-bar',$data);
        }
        $this-> load-> view('newsaleandeven-view',$data);
        $this->load->view('themes/footer',$data);  
        }
        else
        {
        redirect(base_url().'login');
        }
    }
    //buld you event page
    public function buildevent($dealer_id)
    {
        $data['dealerdashboard']=$dealer_id;
        $data['menu']=$this->login_model->loginauth();
        if (isset($data['menu']['logged_in']) != '') 
        {
        $event_insert_get=$this->settings_model->reopen_incomplete_event($dealer_id);
        if($event_insert_get!='')
        { 
        foreach($event_insert_get as $values)
        {
        $event_insert_get=$values['event_id'];
        $incomple=1;
        $this -> session -> set_userdata('event_id_get', $event_insert_get);
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        $this -> session -> set_userdata('incompete_event_set', $incomple);
        $data['incompete_events']=$this->session->userdata('incompete_event_set');
        }
         $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
         if($lead_selection!='')
         {
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
        }
        
        $this->load->view('campaignpage-sidebar-view',$data);
        $this->load->view('newcampign-view',$data);
       }
    }
    //campaine view page
     public function campaignviewpage($dealer_id_pass='')
    {
        $data['menu']=$this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        if (isset($data['menu']['logged_in']) != '') 
        {
        $dealers_userid=$data['menu']['logged_in']['registration_id'];
        $data['dealerdashboard']=$dealers_userid;
        $data['dealer_id_upload_data']=$dealer_id_pass;
        $data['member_type']=$this->input->post('member_type'); 
        $event_start_date=$this->input->post('event_start_date');
        $event_end_date=$this->input->post('event_end_date');
        $advertising_option=$this->input->post('advertising_option');
        $event_insert_id_set=$this->input->post('event_insert_edit');
        $this->session->userdata('incompete_event_set');
        $campign_status=$this->input->post('campign_status');
        if($event_start_date!='' && $event_end_date!=''){
        if($campign_status=='edit'){
        $this -> session -> set_userdata('event_id_get', $event_insert_id_set);
        $this->session->userdata('event_id_get');           
        $data['event_insert_id']=$event_insert_id_set;
        $incomple=1;
        $this -> session -> set_userdata('incompete_event_set', $incomple);
        $data['incompete_events']=$this->session->userdata('incompete_event_set');
        $data['campign_status']='edit';
        }
        else if($this->session->userdata('event_id_get')!=''){
        $campine_event_get=$this->settings_model->camapign_select($this->session->userdata('event_id_get'));
        if($campine_event_get!='')
        {
        $incomple=1;
        $this -> session -> set_userdata('incompete_event_set', $incomple);
        $data['incompete_events']=$this->session->userdata('incompete_event_set');
        }
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        }
        else{
              $event_insert_get=$this->settings_model->insert_event($dealer_id_pass);
        $this -> session -> set_userdata('event_id_get', $event_insert_get);            
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        }
      
        $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
         if(!empty($mailout_selection)){
            $incomple=1;
            $this -> session -> set_userdata('mailout', $incomple);
            $data['mailout']=$this->session->userdata('mailout');
        }
        $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
         if($lead_selection!=0){
         $incomple=1;
         $this -> session -> set_userdata('leadlist', $incomple);
         $data['leadlist']=$this->session->userdata('leadlist');
        }                
        $this->load->view('themes/header',$data);
        if($data['menu']['logged_in']['usertype']=='admin' || $data['menu']['logged_in']['usertype']=='sub_admin' || $data['menu']['logged_in']['usertype']=='account_managers' || $data['menu']['logged_in']['usertype']=='auto_brand'){
        $this->load->view('themes/side-bar',$data);
        }else{
        $this->load->view('themes/dealerside-bar',$data); 
        }
        if($advertising_option=='1' || $advertising_option=='3')
        {
        $this-> load-> view('campaign-confirm-view',$data);  
        }
        else
        {
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
    
    //customerlist
    public function customerlist($dealer_id_pass='')
    {
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $data['campaine_step']='capaine_step_complete';
        $manufacurer_interesr_rate=$this->input->post('manufacurer_interesr_rate');
        $best_sub_prime_rate=$this->input->post('best_sub_prime_rate');
        $factory_rebate=$this->input->post('factory_rebate');
        $dealership_incentives=$this->input->post('dealership_incentives');
        $excess_vehicle=$this->input->post('excess_vehicle');
        $dealership_promos=$this->input->post('dealership_promos');
        if (isset($data['menu']['logged_in']) != '') 
        { 
        if($manufacurer_interesr_rate!=''|| $best_sub_prime_rate!='' || $factory_rebate!='' || $dealership_incentives!='' || $excess_vehicle!='' || $dealership_promos!='')
        {
          $data['campaign_inesrt_id']=$this->settings_model->update_campaign_step3($this->session->userdata('campain_insert_id'));  
        }
         $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
         if($lead_selection!=0){
         $incomple=1;
         $this -> session -> set_userdata('leadlist', $incomple);
         $data['leadlist']=$this->session->userdata('leadlist');
        }
         $dealers_userid=$data['menu']['logged_in']['registration_id'];
         $data['event_insert_id']=$this->session->userdata('event_id_get');
         $data['dealerdashboard']=$dealers_userid;
         $data['dealer_id_upload_data']=$dealer_id_pass;
         $data['member_type']=$this->input->post('member_type'); 
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
         $this-> load-> view('campaignpage-sidebar-view',$data);
         $lead_mining_presets=$this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
         if($lead_mining_presets!='custom_campaign'){
         $this-> load-> view('target-customer-list',$data);
         }
         else{
         
          $this-> load-> view('advanced-option-report-list',$data);  
         }
         $this->load->view('themes/footer',$data);    
               
        }
         else
         {
         redirect(base_url().'login');
         }
    }
     //mailout function
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
     if(!empty($mailout_selection)){
            $incomple=1;
            $this -> session -> set_userdata('mailout', $incomple);
            $data['mailout']=$this->session->userdata('mailout');
     }
    $this->load->view('themes/header',$data);
    if($equity_scrap!='' || $model_break_down!='' || $fuel_effciency!='' || $wrranty_scrap!='' || $custom_campain!='')
    {  
     $lead_delete_cusomer_data=$this -> settings_model -> leadlistdelete($this->session->userdata('lead_list_id'));   
    }
    
    if($equity_scrap!=''){
       if(!empty($equity_scrap_customer_id)){
       foreach ($equity_scrap_customer_id as $value_equity_scrap){
        $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$equity_scrap,$value_equity_scrap);  
        }
        }
    }

    if($model_break_down!=''){
        if(!empty($modebreakdown_customer_id)){
        foreach ($modebreakdown_customer_id as $value_modebreakdown){
        $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$model_break_down,$value_modebreakdown);  
        }
        }  
    }
     if($fuel_effciency!=''){
        if(!empty($fuelefficiency_customer_id)){
        foreach ($fuelefficiency_customer_id as $value_fuelefficiency){
        $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$fuel_effciency,$value_fuelefficiency);  
        }
        } 
        } 
     if($wrranty_scrap!=''){
         if(!empty($warrantyscrape_customer_id)){
        foreach ($warrantyscrape_customer_id as $value_wrranty_scrap){
        $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$wrranty_scrap,$value_wrranty_scrap);  
        }
        } 
        }
     if($custom_campain!=''){
     if(!empty($customcampaign_customer_id)){
       foreach ($customcampaign_customer_id as $value_customcampaign){
        $lead_cusomer_data_section=$this -> settings_model -> lead_customer_data_insert($this->session->userdata('lead_list_id'),$custom_campain,$value_customcampaign);  
        }
        }
    }
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
    
    $report_download_time=date('m-d-y',time());
    $foldername=($companyname_show.'-eventreport-'.$report_download_time.'-'.$this->session->userdata('event_id_get'));
     $base_path = $this -> config -> item('rootpath');
     $targetPath=$base_path.'/downloadreportzip/'.$foldername.'/';
     $file_path=$base_path.'/downloadreportzip/'.$foldername.'/';
     if(is_dir($targetPath))
     {
         $dir = opendir($base_path.'/downloadreportzip/'.$foldername);
       while (($file = readdir($dir)) !== false){
        
        if ($file != "."  && $file != "..")
            {
               
               unlink($base_path.'/downloadreportzip/'.$foldername.'/'.$file); 
            }
        }
        
     }else{
     mkdir($file_path, 0755);   
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
   $lead_mining_presets_select=$this -> main_model -> get_lead_mining_presets($this->session->userdata('event_id_get'));
    if($lead_mining_presets_select=='custom_campaign'){
    $group_1_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),1);
    if(isset($group_1_details) && $group_1_details!=''){
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'1');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1); 
    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1);
    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_1_details,1);
    }
    }
    $group_2_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),2);
    if(isset($group_2_details) && $group_2_details!=''){
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'2');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2); 
    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2); 
    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_2_details,2);
    }
    }
    $group_3_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),3);
    if(isset($group_3_details) && $group_3_details!=''){
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'3');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);
    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);  
    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_3_details,3);
    }
    }
    $group_4_details=$this -> settings_model -> getgroupname_advanced_option($this->session->userdata('event_id_get'),4);
    if(isset($group_4_details) && $group_4_details!=''){
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'4');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4); 
    $this->create_txt($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4); 
    $this->create_xml($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_4_details,4);
    }
    }
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
        $i=1;
    $group_name=$this -> settings_model -> getleadgrouptitle($lead_mining_presets_select);
    if(isset($group_name)&& $group_name!=''){
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'1');
    if($get_selected_lead_group!=0){
     $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[0],1); 
    
     $i++; 
    }
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'2');
    if($get_selected_lead_group!=0){
     $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[1],2);
     
     $i++;
    }
    
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'3');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[2],3);
    
    $i++;
    }

    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'4');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[3],4);
    
    $i++;
    }
    
  
    $get_selected_lead_group=$this->settings_model->getleadcount($this->session->userdata('event_id_get'),'5');
    if($get_selected_lead_group!=0){
    $this->create_csv($this->session->userdata('event_id_get'),$foldername,$dealer_id_pass,$group_name[4],5);
    
    $i++;
    }
    
    }
    }
 }
    else
    {
    redirect(base_url().'login');
    }
    
    }
    function insertcustomer_lead_list()
    {
        $equity_scrap=$this->input->post('equity_scrap');
        $model_break_down=$this->input->post('model_break_down');
        $fuel_effciency=$this->input->post('fuel_effciency');
        $wrraenty_scrap=$this->input->post('wrranty_scrap');
        $custom_campain=$this->input->post('custom_campain');
        $fuel_report6=$this->input->post('fuel_report6');
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        if($equity_scrap!='' || $model_break_down!='' || $fuel_effciency!='' || $wrraenty_scrap!='' || $custom_campain!='' || $fuel_report6!='')
        {
         $leadlist_insert_id=$this->settings_model->insertleadlistselction($this->session->userdata('event_id_get')); 
          $this -> session -> set_userdata('lead_list_id', $leadlist_insert_id);            
            $data['lead_list_id']=$this->session->userdata('lead_list_id');
         echo "Done";  
         
        }
    }
    //mail_insert
    function insert_mailer_step1()
    {
    $mailer_size=$this->input->post('mailer_size');
  
        $data['event_insert_id']=$this->session->userdata('event_id_get');
        if($mailer_size!='')
        {
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
      function insert_mailer_step2()
    {
        $versioning=$this->input->post('versioning');
        $data['event_insert_id']=$this->session->userdata('event_id_get');
      $data['mailer_insert_id']=$this->session->userdata('mailer_id');
      if($this->session->userdata('mailer_id')!='')
      {
      $mailer_id_get=$this->settings_model->updatemailetsetp2($this->session->userdata('mailer_id'));
      
      }
      else
      {
        $mailer_id_get=$this->settings_model->insertmailetsetp2($this->session->userdata('mailer_id'));
        $this -> session -> set_userdata('mailer_id', $mailer_id_get);            
        $data['mailer_insert_id']=$this->session->userdata('mailer_id');
      }
    }
    //mailer step3
      function insert_mailer_step3()
    {
        $auto_pen=$this->input->post('auto_pen');
       
        $insert_cardstock=$this->input->post('insert_cardstock');
        $insert_paperstock=$this->input->post('insert_paperstock');
        $variable_image=$this->input->post('variable_image');
        $colored_envelop=$this->input->post('colored_envelop');
        $data['event_insert_id']=$this->session->userdata('event_id_get');
      $data['mailer_insert_id']=$this->session->userdata('mailer_id');
      if($auto_pen!='' || $insert_cardstock!='' || $insert_paperstock!=''|| $variable_image!=''|| $colored_envelop!='')
      {
      $mailer_id_get_step3=$this->settings_model->updatemailetsetp3($this->session->userdata('mailer_id'));
      echo "Done";
      }
      else
      {
        echo "Not done";
        $mailer_id_get_step3='';
      }
      }
       function insert_mailer_step4()
    {
    $upgrade_package=$this->input->post('upgrade_package');
    $data['event_insert_id']=$this->session->userdata('event_id_get');
    $data['mailer_insert_id']=$this->session->userdata('mailer_id');
    if($upgrade_package!='' )
    {
       
      $mailer_id_get_step4=$this->settings_model->updatemailetsetp4($this->session->userdata('mailer_id'));
      $event_id_complete=$this->settings_model->update_event_complete($this->session->userdata('event_id_get'));
      echo "Done";
      
      }
      else
      {
         $event_id_complete=$this->settings_model->update_event_complete($this->session->userdata('event_id_get'));
        $mailer_id_get_step4='';
        echo "Not Done";
      }
  }
    
   //function to display report fields
    public function check_report_type(){
    $report_get=$this->input->post('report_value');
    $lead_id=$this->input->post('lead_id');
    $event_id=$this->input->post('event_id');
    $id=$this->input->post('id');
    $first_fieldname='';
    $first_secondname='';
    $report_type_select='';
    $values_select='';
    $values_second_select='';
    $get_description=$this->settings_model->get_report_description($report_get);
    //print_r($get_reportfield);
    //$get_selected_options=$this->settings_model->get_advanced_option_group_details($event_id,$id);
    $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_id,$id);
    if(isset($get_selected_options) && $get_selected_options!=''){
    foreach($get_selected_options as $values){
        $report_type_select=$values['report_type'];
        $values_select=$values['value1'];
        $values_second_select=$values['value2'];
    }
    }
    if($id==''){
      $id='1';  
    }
    else{
       $id=$id; 
            
    }
      if($report_get=='vehicle_class')
        {
            ?>
            <div style="float: right; width: 58%;margin-top: 10px;">
                <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                <label for="small-label-1" class="label">Description</label>
                <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                </div>
                </p>
                <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                    <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                    <label for="small-label-1" class="label showlabel"></label>
                    <div style="clear: both;"></div>
                    <div id="vechicle_class_option" class="vechicle_class_option_show">
                    <?php
                    if($report_type_select=='vehicle_class'){
                      $first_fieldname= $values_select; 
                        
                    }
                    else{
                        $first_fieldname='';
                        }
                    $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Cars");
                      $report_first_fieldname=explode(',',$first_fieldname);
                       ?>          
                       <select id="report_vehicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                           <?php
                           foreach($options as $id=>$value){
                            if(in_array($id,$report_first_fieldname)) {
            
            	            $selected='selected ';
            
            	                }else {
            
            	            $selected= ' ';
            
            	            }
                            ?>
                           <option value="<?=$id?>" <?php echo $selected?>><?=$value?></option>
                           
                            <?php
                            }
                            ?> 
            
                        </select>
                </div>
                </p>
            <div style="clear: both;height: 4px;"></div>
            <div style="height: 20px;float: left;">&nbsp;</div>
            </div>
            <?php
        }
        elseif($report_get=='drive_type')
        {
            if($report_type_select=='drive_type'){
                 $first_fieldname= $values_select; 
             }
              else{
                $first_fieldname='';
              } 
            ?>
            <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Drive Type</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                                <select name="drive_type" id="drive_type<?php echo $id?>" class="select" style="text-align: left;overflow-y: scroll;width:299px;" >
                                  <option value="fwd" <?php echo $first_fieldname=='fwd' ? ' selected ':''; ?>>FWD</option>
                                    <option value="rwd" <?php echo $first_fieldname=='rwd' ? ' selected ':''; ?>>RWD</option>
                                    <option value="awd" <?php echo $first_fieldname=='awd' ? ' selected ':''; ?>>AWD</option>
                                    <option value="4x4" <?php echo $first_fieldname=='4x4' ? ' selected ':''; ?>>4x4</option>
                                </select>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php
        }
        elseif($report_get=='fuel_economy')
        {
            if($report_type_select=='fuel_economy'){
                 $first_fieldname= $values_select; 
                  $first_secondname= $values_second_select; 
             }
              else{
                $first_fieldname='';
                $first_secondname=''; 
              } 
            
           ?>
           <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Fuel Economy</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                               <div style="float:left;width:100%"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">From</label>
                            <input type="text" id="fuel_economy_from<?php echo $id?>" name="fuel_economy_from" class="input" value="<?php echo $first_fieldname?>" style="text-align: left;width:103px;" placeholder="litre/100 km"/></p>
                            <p class="inline-small-label button-height pclass" style="float: left;">
                            <label class="label" for="small-label-1" style="margin-left: 11px; width: 21px;">To</label>
                            <input type="text" id="fuel_economy_to<?php echo $id?>" name="fuel_economy_to" class="input" value="<?php echo $first_secondname?>" style="text-align: left;width:103px;" placeholder="litre/100 km"/>
                            </p></div>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php
        }
        elseif($report_get=='trade_in_value')
        {
             if($report_type_select=='trade_in_value'){
                 $first_fieldname= $values_select; 
                  $first_secondname= $values_second_select; 
             }
              else{
                $first_fieldname='';
                $first_secondname=''; 
              }
            ?>
         
            <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Trade In Value</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                              <div style="float:left;width:100%"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">From</label>
                            <input type="text"  name="trade_in_from" id="trade_in_value_from<?php echo $id?>" value="<?php echo $first_fieldname?>" class="input" style="text-align: left;width:103px;"></p>
                            <p class="inline-small-label button-height pclass" style="float: left;">
                            <label class="label" for="small-label-1" style="margin-left: 11px; width: 21px;">To</label>
                            <input type="text"  name="trade_in_to" id="trade_in_value_to<?php echo $id?>" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:103px;">
                            </p></div>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php
        }
        elseif($report_get=='finance_rate'){
             if($report_type_select=='finance_rate'){
                 $first_fieldname= $values_select; 
                  $first_secondname= $values_second_select; 
             }
              else{
                $first_fieldname='';
                $first_secondname=''; 
              }
         ?>
         <div style="float: right; width: 58%;margin-top: 10px;">
                <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                    <label for="small-label-1" class="label">Description</label>
                    <div class="report_type_description" id="report_type_description"><?=$get_description?>
                    </div>
                </p>
                <div style="clear: both;"></div>
                <h4 class="typetitle"><label class="showreportdiv" >Finance Rate (APR)</label></h4>
                    <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                        <label for="small-label-1" class="label showlabel"></label>
                        <div style="clear: both;"></div>
                        <div id="vechicle_class_option" class="vechicle_class_option_show">
                          <div style="float:left;width:100%;" id="show_form_field"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">Min</label>
                        <input type="text" id="monthly_payment_from<?php echo $id?>" name="monthly_payment_from" class="input" value="<?php echo $first_fieldname?>" style="text-align: left;width:96px;"></p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                        <label class="label" for="small-label-1" style="margin-left: 11px; width: 35px;">Max</label>
                        <input type="text" id="monthly_payment_to<?php echo $id?>" name="monthly_payment_to" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:96px;">
                        </p></div>
                        </div>
                    </p>
                <div style="clear: both;height: 4px;"></div>
                <div style="height: 20px;float: left;">&nbsp;</div>
            </div>
            <?php  
        }
        elseif($report_get=='fue_type'){
            if($report_type_select=='fue_type'){
                 $first_fieldname= $values['field_name1']; 
                 $first_secondname= $values_select;
                 
             }
              else{
                $first_fieldname='';
                $first_secondname='';
                
              }
            ?>
          <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Fuel Type</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                             <p class="inline-small-label button-height pclass" style="float: left;width: 65px;"><label style="float: left;">
                          <label class="label" for="small-label-1" style="width:119px;">Gas</label>
                          <input type="radio" name="fuel_type" id="fuel_type<?php echo $id?>" value="gas" style="width: 21px;float: left;margin-top:9px;" <?php if($first_fieldname=='gas'){ echo ' checked="checked"';}else{ }?> /></label>
                          </p>
                          <p class="inline-small-label button-height pclass" style="float: left;width: 75px;"><label style="float: left;">
                          <label class="label" for="small-label-1" style="width:61px;">Diesel</label>
                          <input type="radio" name="fuel_type" id="fuel_type<?php echo $id?>" <?php if($first_fieldname=='diesel'){ echo ' checked="checked"';}else{ }?> value="diesel" style="width: 21px;float: left;margin-top:9px;" /></label>
                          </p>
                           <p class="inline-small-label button-height pclass" style="float: left;width: 75px;"><label style="float: left;">
                          <label class="label" for="small-label-1" style="width:61px;">Other</label>
                          <input type="radio" name="fuel_type" id="fuel_type<?php echo $id?>" <?php if($first_fieldname=='hybrid'){ echo ' checked="checked"';}else{ }?> value="hybrid" style="width: 21px;float: left;margin-top:9px;"/></label>
                          </p>
                         <div style="clear:both;"></div>
                          <p class="inline-small-label button-height pclass" style="float: left;">
                          <?php
                    $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Cars");
                      $report_first_fieldname=explode(',',$first_secondname);
                       ?>
                           <select id="fuel_vehicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                <?php
                           foreach($options as $id=>$value){
                            if(in_array($id,$report_first_fieldname)) {
            
            	            $selected='selected ';
            
            	                }else {
            
            	            $selected= ' ';
            
            	            }
                            ?>
                           <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                           
                            <?php
                            }
                            ?> 
            
                            </select>
                            </p>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php   
        }
        elseif($report_get=='local_town'){
          if($report_type_select=='local_town'){
                 $first_fieldname= $values['field_name1']; 
                 $first_secondname= $values_select;
                 
             }
              else{
                $first_fieldname='';
                $first_secondname='';
                
              }   
            ?>
           
         <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Local vs Out of Town</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                            <p class="inline-small-label button-height pclass" style="float: left;width: 80px;"><label style="float: left;">
                          <label class="label" for="small-label-1" style="width:80px;">
                          <input type="radio" name="local_town" id="local_town<?php echo $id?>" value="local" style="width: 21px;float: none;" <?php if($first_fieldname=='local'){ echo ' checked="checked"';}else{ }?>/>Local</label></label>
                          </p>
                          <p class="inline-small-label button-height pclass" style="float: left;width: 112px;"><label style="float: left;">
                          <label class="label" for="small-label-1" style="width:216px;">
                          
                          <input type="radio" name="local_town" id="local_town<?php echo $id?>" value="out_of_town" style="width: 21px;float:none" <?php if($first_fieldname=='out_of_town'){ echo ' checked="checked"';}else{ }?>/>Out Of Town</label></label>
                          </p>
                          <div style="clear:both"></div>
                          <p class="inline-small-label button-height pclass" style="float: left;">
                            <?php
                    $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Cars");
                      $report_first_fieldname=explode(',',$first_secondname);
                       ?>
                          <select id="town_vehicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                <?php
                           foreach($options as $id=>$value){
                            if(in_array($id,$report_first_fieldname)) {
            
            	            $selected='selected ';
            
            	                }else {
            
            	            $selected= ' ';
            
            	            }
                            ?>
                           <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                           
                            <?php
                            }
                            ?> 
                            </select>
                            </p>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php    
        }
        elseif($report_get=='used_new_purchaser'){
           if($report_type_select=='used_new_purchaser'){
                 $first_fieldname= $values['field_name1']; 
                 $first_secondname= $values_select;
                 
             }
              else{
                $first_fieldname='';
                $first_secondname='';
                
              }  
            ?>
          <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Used vs New Purchaser</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                             <p class="inline-small-label button-height pclass" style="float: left;width: 117px;">
                          <label class="label"  style="width:119px;"><input type="radio" name="used_new_purchaser" id="used_new_purchaser<?php echo $id?>" value="new" <?php if($first_fieldname=='new'){ echo ' checked="checked"';}else{ }?> style="width: 21px;margin-top:9px;" checked="checked" />&nbsp;&nbsp;New vehicle
                          </label>
                          </p>
                          <p class="inline-small-label button-height pclass" style="float: left;width: 117px;">
                          <label class="label"  style="width:139px;"><input type="radio" name="used_new_purchaser" id="used_new_purchaser<?php echo $id?>" value="used" <?php if($first_fieldname=='used'){ echo ' checked="checked"';}else{ }?> style="width: 21px;margin-top:9px;" />&nbsp;&nbsp;Used vehicle
                          </label>
                          </p>
                          <div style="clear:both"></div>
                          <p class="inline-small-label button-height pclass" style="float: left;">
                           <?php
                    $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Cars");
                      $report_first_fieldname=explode(',',$first_secondname);
                       ?>
                          <select id="purchase_vechicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                <?php
                           foreach($options as $id=>$value){
                            if(in_array($id,$report_first_fieldname)) {
            
            	            $selected='selected ';
            
            	                }else {
            
            	            $selected= ' ';
            
            	            }
                            ?>
                           <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                           
                            <?php
                            }
                            ?> 
                            </select>
                            </p>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php    
        }
        elseif($report_get=='power_focus'){
             if($report_type_select=='power_focus'){
                 $first_fieldname= $values_select; 
               }
              else{
                $first_fieldname='';
                } 
            ?>
            <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Power Focus</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                             <?php
                    $options = array("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Cars");
                      $report_first_fieldname=explode(',',$first_fieldname);
                       ?>
                           <select id="power_vechicle_class<?php echo $id?>" name="power_vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                <?php
                           foreach($options as $id=>$value){
                            if(in_array($id,$report_first_fieldname)) {
            
            	            $selected='selected ';
            
            	                }else {
            
            	            $selected= ' ';
            
            	            }
                            ?>
                           <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                           
                            <?php
                            }
                            ?> 
                            </select>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php
        }
        elseif($report_get=='monthly_payment'){
             if($report_type_select=='monthly_payment'){
                 $first_fieldname= $values_select; 
                  $first_secondname= $values_second_select; 
             }
              else{
                $first_fieldname='';
                $first_secondname=''; 
              }
            ?>
             <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Monthly Payment Range</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                          <div style="float:left;width:100%"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">Min</label>
                            <input type="text" id="monthly_payment_from_id<?php echo $id?>" name="monthly_payment_from" value="<?php echo $first_fieldname?>" class="input"style="text-align: left;width:96px;"></p>
                             
                           <p class="inline-small-label button-height pclass" style="float: left;">
                            <label class="label" for="small-label-1" style="margin-left: 11px; width: 35px;">Max</label>
                            <input type="text" id="monthly_payment_to_id<?php echo $id?>" name="monthly_payment_to" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:96px;">
                            </p></div>
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php
        }
         elseif($report_get=='out_warranty')
        {
            ?>
            <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Out of Warranty</label></h4>
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label showlabel"></label>
                            <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                         
                            </div>
                        </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php
            }
            elseif($report_get=='specific_model'){
                 if($report_type_select=='specific_model'){
                 $first_fieldname= $values_select; 
                  $first_secondname= $values_second_select; 
             }
              else{
                $first_fieldname='';
                $first_secondname=''; 
              }
             ?> 
              
                <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Specific Model Pull</label></h4>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="width: 100%;float:left">
                   <div style="float: left; text-align: left; width: 151px;"><label class="label" style="color: #808080;font-weight: 12px;font-weight: bold;;">Vehicle Manufacturer</label></div>
                    <div style="float:left;margin-top: 8px;">
                   <select name="vehicle_manufacture" id="vehicle_manufacture<?php echo $id?>" class="select" style="text-align: left;overflow-y: scroll;width:289px;" onchange="selectmodel(this.value,'<?php echo $id?>','<?php echo $first_secondname?>');">
                 <option value="">Select</option>
                    <?php
                            $makes_details=$this->main_model->makes_models();
                            foreach($makes_details as $makes){
                                ?>
                              <option value="<?=$makes['make']?>" <?php echo $makes['make']==$first_fieldname ? ' selected ':''; ?>><?=$makes['make']?></option>
                              <?php
                            }
                            ?>
                    </select>
    					</div>
                       </div>
                              <div style="width: 100%;float:left;margin-top: 20px;">
                   <div style="float: left; text-align: left; width: 151px;"><label class="label" style="color: #808080;font-weight: 12px;font-weight: bold;;">Vehicle Models</label></div>
                    <div style="float:left;margin-top: 8px;">
                   
    			 <select name="vehicle_model" id="vehicle_model<?php echo $id?>" class="select" style="text-align: left;overflow-y: scroll;width:289px;" >
                 <option value="">Select</option>
                  
                                </select>
    					</div>
                       </div>
                </div>
                <?php 
            }
            elseif($report_get=='dealership_brand'){
                 $user_id=$this->input->post('user_id');
                     if(isset($user_id) || $user_id!=''){
                     $get_userdetails=$this -> main_model -> user_data($user_id);
                      $manufcture_name=$get_userdetails[0]['masterbrand'];
                 }
                $specific_description=str_replace("#manufacture#","$manufcture_name",$get_description);
                ?>
                <div style="float: right; width: 58%;margin-top: 10px;">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description"><?php echo $specific_description?>
                        </div>
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Competitors Vehicle Owners</label></h4>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <?php 
            }
    }
    
    
    function epsadvantage_campaign_fiststep()
    {
        $data['menu']=$this->login_model->loginauth();
        $campaine_insert_id=$this->settings_model->insert_campaign_step1($this->session->userdata('event_id_get'));
         $this -> session -> set_userdata('campain_insert_id', $campaine_insert_id);            
         $data['campaine_insert_get']=$this->session->userdata('campain_insert_id');
         echo $campaine_insert_id;
        
    }
    function epsadvantage_campaign_advanced_option()
    {
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
      
    }
     else
    {
    redirect(base_url().'login');
    }
   }
       //function to go to step 1
    public function linkto_step1($event_id,$dealer_id,$getstep){
        if($event_id!=0){
        $data['menu']=$this->login_model->loginauth();
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        if (isset($data['menu']['logged_in']) != '') 
            {
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
            $data['dealerdashboard']=$dealers_userid;
            $data['dealer_id_upload_data']=$dealer_id;
            $this -> session -> set_userdata('event_id_get', $event_id);
            $this->session->userdata('event_id_get');           
            $data['event_insert_id']=$event_id;
            $incomple=1;
            $this -> session -> set_userdata('incompete_event_set', $incomple);
            $data['incompete_events']=$this->session->userdata('incompete_event_set');
            $data['campign_status']='edit';
            $mailout_selection=$this -> settings_model -> mailout_option_select($this->session->userdata('event_id_get')); 
            $get_campign_id=$this->settings_model->get_campign_id($event_id);
            $this -> session -> set_userdata('campain_insert_id', $get_campign_id);            
         $data['campaine_insert_get']=$this->session->userdata('campain_insert_id');
                if(!empty($mailout_selection)){
                $incomple=1;
                $this -> session -> set_userdata('mailout', $incomple);
                $data['mailout']=$this->session->userdata('mailout');
                }
            $lead_selection=$this -> settings_model -> leadsection_select($this->session->userdata('event_id_get')); 
                if($lead_selection!=0){
                $incomple=1;
                $this -> session -> set_userdata('leadlist', $incomple);
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
        }else{
                        
            $this->index($dealer_id);             
            
        }
}    
    public function sale_leadlist($event_id,$dealer_id){
        
    $data['title'] = 'Exclusive Private Sale Inc-Campaign';
    $data['menu']=$this->login_model->loginauth();
    
    $data['campaine_step']='capaine_step_complete';
        if (isset($data['menu']['logged_in']) != '') 
        { 
          $this -> session -> set_userdata('event_insert_id', $event_id);
            $data['event_insert_id']=$this->session->userdata('event_insert_id');
             $lead_selection=$this -> settings_model -> leadsection_select($event_id); 
            if($lead_selection!=0 && $event_id!=0){
            $incomple=1;
            $this -> session -> set_userdata('leadlist', $incomple);
            $data['leadlist']=$this->session->userdata('leadlist');
            
            $dealers_userid=$data['menu']['logged_in']['registration_id'];
          
            $data['dealerdashboard']=$dealers_userid;
            $data['dealer_id_upload_data']=$dealer_id;
            $data['editted_step']='lead_step1';
            $mailout_selection=$this -> settings_model -> mailout_option_select($event_id); 
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
            $this-> load-> view('campaignpage-sidebar-view',$data);
            $this-> load-> view('target-customer-list',$data);
            $this->load->view('themes/footer',$data);   
            
       
        }else{
             $this->index($dealer_id);    
            } 
            }
    }
    public function linkto_maileroption($event_id,$dealer_id,$step_no){
        
            $data['title'] = 'Exclusive Private Sale Inc-Campaign';
            $data['menu']=$this->login_model->loginauth();
            $data['lead_step']='leadlist_step_complete';
            $data['campaine_step']='capaine_step_complete';
            $this -> session -> set_userdata('event_insert_id', $event_id);
            $data['event_insert_id']=$this->session->userdata('event_insert_id');
            if (isset($data['menu']['logged_in']) != '') { 
                $mailout_selection=$this -> settings_model -> mailout_option_select($event_id); 
                if($mailout_selection!=0 && $event_id!=0){
                
                $data['dealerdashboard']=$dealer_id;
                $data['dealer_id_upload_data']=$dealer_id;
                $data['editted_step']=$step_no;
                
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
    public function advertising_option($event_id,$dealer_id_upload_data){
        if($event_id!=0){
        $data['title'] = 'Exclusive Private Sale Inc-Campaign';
        $data['menu']=$this->login_model->loginauth();
        $this->session->unset_userdata('event_id_get');
        $this->session->unset_userdata('incompete_event_set');
        
        if (isset($data['menu']['logged_in']) != '') 
        { 
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
        //check incompete events for the dealer
        
        }  
        }else{
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
        //check incompete events for the dealer
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
    $reoprt_name_show=$this -> settings_model -> getreporttype($value_report_name['report_type']); 
    }    
    }
    }
    else{
    $reoprt_name_show=$reportname;     
    }
    $report_download_time=date('m-d-y',time());
    $csvfilename=($companyname_show.'-'.trim($reoprt_name_show).'-'.$report_download_time);
    $query = $this->db->query("SELECT buyer_first_name,buyer_last_name,buyer_address,buyer_appartment,buyer_city,buyer_province,buyer_postalcode,buyer_homephone,buyer_businessphone,sold_vehicle_year,sold_vehicle_make,sold_vehicle_model FROM eps_data where dealership_id=$dealer_id");
    $num = $query->num_fields();
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
    $sql_leadlist=("SELECT cd.dealership_id,
    cd.buyer_first_name,
    cd.buyer_last_name,
    cd.buyer_address, 
    cd.buyer_appartment, 
    cd.buyer_city, 
    cd.buyer_province, 
    cd.buyer_postalcode,
    cd.buyer_homephone, 
    cd.buyer_businessphone,
    cd.sold_vehicle_year,
    cd.sold_vehicle_make, 
    cd.sold_vehicle_model,
    cd.sold_vehicle_stock
    FROM eps_data cd, leadlist_customer_data lc, select_customer_leadlist sl
    WHERE lc.lead_customer_id = cd.id AND 
    lc.lead_type = $report_id AND 
    sl.customer_leadlist_id=lc.customer_leadlist_id 	
    AND sl.event_id =$event_id order by lc.lead_customer_id asc");
$quer=$this->db->query($sql_leadlist);
$this -> query_to_csv($quer,TRUE,'downloadreportzip/'.$foldername.'/'.$csvfilename.'.csv',$dealer_id);
 }
     //create and save textfile
    function create_txt($event_id,$foldername,$dealer_id,$reportname,$report_id){  
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
    $reoprt_name_show=$this -> settings_model -> getreporttype($value_report_name['report_type']); 
    }    
    }
    }
    else{
    $reoprt_name_show=$reportname;     
    }
    $report_download_time=date('m-d-y',time());
    $zipname=($companyname_show.'-'.trim($reoprt_name_show).'-'.$report_download_time);   
    $dealership_name='';
    
    $content = 'Dealership Name    FirstName	LastName    Address	Apartment	City	State	Zip	 HomePhone	BusinessPhone	 Year	Make  Model   Purchase Date Trade In Value';
    $sql_leadlist=("SELECT lead_customer_id FROM  select_customer_leadlist, 
    leadlist_customer_data WHERE 
    select_customer_leadlist.customer_leadlist_id=leadlist_customer_data.customer_leadlist_id AND
    leadlist_customer_data.lead_type = $report_id AND 
    select_customer_leadlist.event_id=$event_id");
    $query_leadlist=$this->db->query($sql_leadlist);
    $content1='';
    if($query_leadlist -> num_rows() > 0){
        $returnvalue= $query_leadlist->result_array();
        
        foreach($returnvalue as $values){
            $sql=("select * from  pbs_customer_data where id=$values[lead_customer_id]");
            $quer = $this->db->query($sql);
            $returnvalue_customer_data= $quer->result_array(); 
            foreach($returnvalue_customer_data as $values_customer_data){
             $sql=("SELECT  company_name 	
            FROM  registration
            WHERE registration_id ='$values_customer_data[dealership_id]' 
            ");
            
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0)
            {
            $returnvalue_delership_name= $query->result_array();
            foreach($returnvalue_delership_name as $values_dealership){
             $dealership_name=trim(ucfirst($values_dealership['company_name']));   
            }
            }   
            $sql_puchasedate=("select contract_date from  pbs_financial_data where vehicle_stock='$values_customer_data[sold_vehicle_stock]'");
            $query_puchasedate = $this->db->query($sql_puchasedate);
            $purchasedate= $query_puchasedate->result_array();
            foreach($purchasedate as $purchase_date_display){ 
                if($purchase_date_display['contract_date']!=''){
                $purchase_date_get=$purchase_date_display['contract_date'];
            }
            else{
                $purchase_date_get='N/A';
            }
            }
                $content1.="$dealership_name\t$values_customer_data[buyer_first_name]\t$values_customer_data[buyer_last_name]\t$values_customer_data[buyer_address]$values_customer_data[buyer_appartment]\t$values_customer_data[buyer_city]\t$values_customer_data[buyer_province]\t$values_customer_data[buyer_postalcode]\t$values_customer_data[buyer_homephone]\t$values_customer_data[buyer_businessphone]\t$values_customer_data[sold_vehicle_year]\t$values_customer_data[sold_vehicle_make]\t$values_customer_data[sold_vehicle_model]\t$purchase_date_get\t \n";   
            }
            
        }
    }
    $textfilecontent="$content\n$content1";
    $base_path = $this -> config -> item('rootpath');
    $handle = fopen($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.txt', 'w');
    fwrite($handle, $textfilecontent);
    fclose($handle);
    }
     function create_xml($event_id,$foldername,$dealer_id,$reportname,$report_id) {
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
    $reoprt_name_show=$this -> settings_model -> getreporttype($value_report_name['report_type']); 
    }    
    }
    }
    else{
    $reoprt_name_show=$reportname;     
    }
    $report_download_time=date('m-d-y',time());
    $zipname=($companyname_show.'-'.trim($reoprt_name_show).'-'.$report_download_time); 
    $xml = new DOMDocument("1.0");
	$root = $xml->createElement("data");
    $dealership_name='';
    $leadlist_details_get=$this->settings_model->get_leadlist_details_with_event_id($event_id);
    if($leadlist_details_get!='')
    {
    $i=1;
    $xml->appendChild($root);
       $sql_leadlist=("SELECT cd.dealership_id,
    cd.buyer_first_name,
    cd.buyer_last_name,
    cd.buyer_address, 
    cd.buyer_appartment, 
    cd.buyer_city, 
    cd.buyer_province, 
    cd.buyer_postalcode,
    cd.buyer_homephone, 
    cd.buyer_businessphone,
    cd.sold_vehicle_year,
    cd.sold_vehicle_make, 
    cd.sold_vehicle_model,
    cd.sold_vehicle_stock
    FROM pbs_customer_data cd, leadlist_customer_data lc, select_customer_leadlist sl
    WHERE lc.lead_customer_id = cd.id
    AND sl.customer_leadlist_id=lc.customer_leadlist_id AND
    lc.lead_type = $report_id AND 	
     sl.event_id =$event_id");
    $query_leadlist=$this->db->query($sql_leadlist);
    $content1='';
    if($query_leadlist -> num_rows() > 0){
    $returnvalue= $query_leadlist->result_array();
    foreach($returnvalue as $values){

            $sql=("SELECT  company_name 	
            FROM  registration
            WHERE registration_id ='$values[dealership_id]' 
            ");
            
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0)
            {
            $returnvalue_delership_name= $query->result_array();
            foreach($returnvalue_delership_name as $values_dealership){
             $dealership_name=trim(ucfirst($values_dealership['company_name']));   
            }
            }   
        $sql_puchasedate=("select contract_date from  pbs_financial_data where vehicle_stock='$values[sold_vehicle_stock]'");
        $query_puchasedate = $this->db->query($sql_puchasedate);
        $purchasedate= $query_puchasedate->result_array();
        foreach($purchasedate as $purchase_date_display){
            if($purchase_date_display['contract_date']!=''){
                $purchase_date_get=$purchase_date_display['contract_date'];
            }
            else{
                $purchase_date_get='N/A';
            }
        }
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
	$xml->save($base_path.'downloadreportzip/'.$foldername.'/'.$zipname.'.xml') or die("Error");
	} 
    }
 }
} 
function downloadzip()
{
    $dealer_id=$_POST['dealer_id'];
    $event_id=$_POST['event_id'];
    $zipname = 'adcs.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
}
function submitleadlist($delaer_id,$event_id){
     $data['title'] = 'Exclusive Private Sale Inc-Campaign';
     $data['menu']=$this->login_model->loginauth();
     if (isset($data['menu']['logged_in']) != '') 
     {
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
    if($dealer_email!=''){  		
    $message.= 'Dear '.$dealer_name.',<br/><br/>';
    $message.='Your leadlist details file is given below.Please download<br><br>
    ';
    $message.='<a href='.base_url().'downloadpdf/create_pdf/'.$event_id.'/'.$delaer_id.'  class="TableLink">Download</a><br><br>'; 
    $message.='Regards,<br/>Exclusive Private Sale.Inc';  
    $this->main_model->HTMLemail($dealer_email,'Exclusive Private Sale<'.$admin_emailid.'>','',$subject,$message);
  }
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
     function array_to_csv($array, $download = ""){
    //if ($download != "")
    //{    
    // header('Content-Type: application/csv');
    //header('Content-Disposition: attachement; filename="' . $download . '"');
    // }        
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
function query_to_csv($query, $headers = TRUE, $download = "",$dealer_id){
    
if ( ! is_object($query) OR ! method_exists($query, 'list_fields')){
    show_error('invalid query');
}
$array = array();
if ($headers){
$line = array();
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
    
    if($i==14){
        
        $sql=("SELECT  contract_date 	
        FROM pbs_financial_data
        WHERE vehicle_stock = '$item' 
         ");
        
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0)
        {
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
         $purchase_date=trim($values['contract_date']);   
        }
        }
        else
        {
        $purchase_date='N/A';
        }
        $line[] = $purchase_date; 
    }
    else if($i==1){
      $sql=("SELECT  company_name 	
        FROM  registration
        WHERE registration_id = '$item' 
         ");
        
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0)
        {
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
         $dealership_name=trim(ucfirst($values['company_name']));   
        }
        }
        else
        {
        $dealership_name='N/A';
        }
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
function insert_advanceoption_groups(){
 $report_name=$this->input->post('report_name'); 
 $value_get_1=$this->input->post('value_get_1'); 
 $value_get_2=$this->input->post('value_get_2');
 $feild_name_1=$this->input->post('feild_name_1');
 $feild_name_2=$this->input->post('feild_name_2');
 $event_id=$this->input->post('event_id');
 $leadlist_details_get=$this->settings_model->insert_advance_option_group_selection();
 if($leadlist_details_get!=''){
    echo "Done";
 }
 } 
function diaplaymode(){
    $make=$this->input->post('make');
    $model=$this->input->post('model');  
     $sql_make=("select model from Vehicle where make='$make'
        GROUP BY model ASC");
        $result=$this->db->query($sql_make);
        if($result -> num_rows() >0){
        $retrieved=$result->result_array();
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
        }else{
            $optStr ='';
        }
        echo $optStr;
}  
}
?>