<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Downloadpdf extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> library('form_validation');
        $this->load->model('login_model'); 
        $this->load->model('main_model'); 
        $this->load->model('settings_model'); 
        $this->load->library("pagination");
        $this->load->library('session');
        $this -> load -> library('zip');
    }
 
    public function create_pdf($event_id,$dealer_id) {
        //============================================================+
        // File name   : example_001.php
        // Begin       : 2008-03-04
        // Last Update : 2013-05-14
        //
        // Description : Example 001 for TCPDF class
        //               Default Header and Footer
        //
        // Author: Nicola Asuni
        //
        // (c) Copyright:
        //               Nicola Asuni
        //               Tecnick.com LTD
        //               www.tecnick.com
        //               info@tecnick.com
        //============================================================+

        /**
        * Creates an example PDF TEST document using TCPDF
        * @package com.tecnick.tcpdf
        * @abstract TCPDF - Example: Default Header and Footer
        * @author Nicola Asuni
        * @since 2008-03-04
        */

        // create new PDF document
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
 
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Exclusive Private Sale Inc');
        $pdf->SetTitle('Exclusive Private Sale Inc');
        $pdf->SetSubject('Exclusive Private Sale Inc');
        $pdf->SetKeywords('Exclusive, PDF');  

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Exclusive Private Sale Inc', 'http://advantage.exclusiveprivatesale.com', array(0,64,255), array(0,64,128));
//        $pdf->setFooterData(array(0,64,0), array(0,64,128));
 
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }  
 
        // ---------------------------------------------------------   
 
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);  

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 14, '', true);  

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
         // set text shadow effect
        $customer_leadlist_count_group2='';
        $customer_leadlist_count_group5='';
        $customer_leadlist_count_group1='';
        $customer_leadlist_count_group3='';
        $customer_leadlist_count_group4='';
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal')); 
        $report_name=''; 
        $report_type='';
        $report_description='';
        $lead_count='0';
        $event_details=$this->settings_model->get_campign_editdetails($event_id);
        $campine_event_get=$this->settings_model->camapign_select($event_id);
        $leadsection_select=$this->settings_model->leadsection_select($event_id);
        $get_mailout_option_details=$this->settings_model->get_mailout_option_details($event_id);
        $lead_count=$this->settings_model->get_customer_leadcount($event_id);
        $dealer_info=$this -> main_model -> user_info_by_id($dealer_id);
        if(isset($event_details)){
            foreach($event_details as $event_details_show){
                $event_start_date=date('m/d/y',$event_details_show['event_start_date']);
                $event_end_date=date('m/d/y',$event_details_show['event_end_date']);
                if($event_details_show['advertising_option']=='2'){
                   $advertising_option='EPS Advantage'; 
                }
                else{
                   $advertising_option='N/A'; 
                }
            }
        }
        $total_event_cost_get='';
        $invitecost_get='';
        $versioning_cost='';
        $autopen_price='';
        $insert_cardstock_price='';
        $insert_paperstock_price='';
        $variable_imaging_price='';
        $colored_envelopes_price='';
           
    if(isset($campine_event_get) && $campine_event_get!=''){
    foreach($campine_event_get as $values){
        $lead_mining_presets=$values['lead_mining_presets'];
        $lead_mining_presets_name=$this->settings_model->get_lead_type_name($lead_mining_presets);
        $group_name=$this -> settings_model -> getleadgrouptitle($lead_mining_presets);
        $past_vehicle_purchase_date_from_range=$values['past_vehicle_purchase_date_from_range'];
        if(isset($leadsection_select)){
        $group=0;
        foreach($leadsection_select as $values_lead_selct){
         if($values_lead_selct['equity_scrap']!='0'){
            $group1=$this -> settings_model -> getleadgrouptitle('equity_scrape');
            $group_name1=$group_name[0]; 
            $group=$group+1;
            $customer_leadlist_count_group1=$this -> settings_model -> getleadcount($event_id,1);
            }
         else{
            $group1='N/A';
            $customer_leadlist_count_group1='0';
            $group_name1='N/A';
         }
         if($values_lead_selct['model_break_down']!='0')
         {
          $group2=$this -> settings_model -> getleadgrouptitle('model_breakdown');
          $customer_leadlist_count_group2=$this -> settings_model -> getleadcount($event_id,2);
          $group_name2=$group_name[1]; 
          $group=$group+1;
          }
          else{
            $group2='N/A';
            $customer_leadlist_count_group2=0;
            $group_name2='N/A';
         } 
          if($values_lead_selct['fuel_effciency']!='0')
         {
          $group3=$this -> settings_model -> getleadgrouptitle('effiecency');
          $customer_leadlist_count_group3=$this -> settings_model -> getleadcount($event_id,3);
            $group_name3=$group_name[2];
          $group=$group+1; 
          }
          else{
            $group3='N/A';
            $customer_leadlist_count_group3=0;
             $group_name3='N/A';
         }
          if($values_lead_selct['wrranty_scrap']!='0')
         {
          $group4=$this -> settings_model -> getleadgrouptitle('warranty_scrape');
          $customer_leadlist_count_group4=$this -> settings_model -> getleadcount($event_id,4);
          $group_name4=$group_name[3]; 
          $group=$group+1;
          }
          else{
            $group4='N/A';
            $customer_leadlist_count_group4=0;
            $group_name4='N/A';
         }
         if($values_lead_selct['custom_campain']!='0')
         {
         $customer_leadlist_count_group5=$this -> settings_model -> getleadcount($event_id,5);
          $group5=$this -> settings_model -> getleadgrouptitle('custom_campaign');
          $group_name5=$group_name[4];
          $group=$group+1;
          }
          else{
            $group5='N/A';
            $customer_leadlist_count_group5=0;
            $group_name5='N/A';
         }
         $report_type6_show='';
          if($values_lead_selct['fuel_efficiency_report6']!='0')
         {
         $customer_leadlist_count_group6=$this -> settings_model -> getleadcount($event_id,6);
         $group_name6=$group_name[5];
          $group=$group+1;
         $report_type6_show.='<p style="font-size:14px;color:red;"><span  style="font-weight:bold">6th Lead Group</span></p>';
         $report_type6_show.='<p style="font-size:14px;">'.$group_name6.'</p>'  ;
         $report_type6_show.='<p style="font-size:14px;">Lead Count : '.$customer_leadlist_count_group6.'</p>';
          }
          else{
            $group6='N/A';
            $customer_leadlist_count_group6=0;
            $group_name6='N/A';
            $report_type6_show='';
         }
         
         
        }
    }
        $past_date_explode=explode('.',$past_vehicle_purchase_date_from_range);
        if(count($past_date_explode) == 2){
            if($past_date_explode[1]==0){
              $past_from_date=$past_date_explode[0]; 
            }
            else{
                $past_from_date=$past_vehicle_purchase_date_from_range;
            }
            $past_vehicle_purchase_date_to_range=$values['past_vehicle_purchase_date_to_range'];
              $past_to_date_explode=explode('.',$past_vehicle_purchase_date_to_range);
            if($past_to_date_explode[1]==0){
              $past_to_date=$past_to_date_explode[0]; 
            }
            else{
                $past_to_date=$past_vehicle_purchase_date_to_range;
            }
        }else{
            $past_from_date=$past_date_explode[0]; 
            $past_to_date=$values['past_vehicle_purchase_date_to_range'];
        }
            if(isset($get_mailout_option_details) && $get_mailout_option_details!=''){
            foreach($get_mailout_option_details as $values_maileroption){
            if($values_maileroption['mailer_size']=='smallinvites'){
             $invitesize='Standard Invite';    
            }
            else{
              $invitesize='Large Invite';  
            }
            
            $invitecost_get=$values_maileroption['invitecost'];
            $invitecost=number_format($invitecost_get, 2, '.', '');
            if($values_maileroption['versioning']==1){
            $versioning_cost_get=($group-1)*85;
            $versioning_cost=number_format($versioning_cost_get, 2, '.', '');
            
            }
            else{
              $versioning_cost=0;  
              $version_display='';
            } 
            if($values_maileroption['autopen']==1){
            $get_additional_optional_price=$this->settings_model->get_cost_of_additional_options('autopen');
            $autopen_price=number_format($lead_count*$get_additional_optional_price, 2, '.', '');
            
            }
            else{
              $autopen_price=0; 
              $autopen_display=''; 
            }
            if($values_maileroption['insert_cardstock']==1){
            $get_additional_optional_price=$this->settings_model->get_cost_of_additional_options('insert_cardstock');
            $insert_cardstock_price=number_format($lead_count*$get_additional_optional_price, 2, '.', '');
            
            }
            else{
              $insert_cardstock_price=0;
              $insert_cardstock_display='';  
            }
            if($values_maileroption['insert_paperstock']==1){
            $get_additional_optional_price=$this->settings_model->get_cost_of_additional_options('insert_paperstock');
            $insert_paperstock_price=number_format($lead_count*$get_additional_optional_price, 2, '.', '');
            
            }
            else{
              $insert_paperstock_price=0;  
              $insert_paperstock_display='';
            }
            if($values_maileroption['variable_imaging']==1){
            $get_additional_optional_price=$this->settings_model->get_cost_of_additional_options('variable_imaging');
            $variable_imaging_price=number_format($lead_count*$get_additional_optional_price, 2, '.', '');
            
            }
            else{
              $variable_imaging_price=0;  
              $variable_imaging_display='';
            }
            if($values_maileroption['colored_envelopes']==1){
            $get_additional_optional_price=$this->settings_model->get_cost_of_additional_options('colored_envelopes');
            $colored_envelopes_price=number_format($lead_count*$get_additional_optional_price, 2, '.', '');
            
            }
            else{
              $colored_envelopes_price=0;
              $colored_envelopes_display='';  
            }   
        }
    }   $show_fees=number_format('3000', 2, '.', '');
        $total_event_cost_get=(3000+$invitecost+$versioning_cost+$autopen_price+$insert_cardstock_price+$insert_paperstock_price+$variable_imaging_price+$colored_envelopes_price);
        $total_event_cost=number_format($total_event_cost_get, 2, '.', '');
        if($values['lead_mining_presets']=='custom_campaign'){
            
        $epsadvantage_info=$this->settings_model->epsadvantage_info($event_id);
        $get_report_details=$this->settings_model->getgroupname_advanced_option_with_event_id($event_id); 
        $managers = '<p style="color:white;font-size:14px;">Your EPS Contacts</p>';
        $manager_details=$this -> settings_model->dealers_assigned_managers($dealer_id);
        if(isset($manager_details) && is_array($manager_details)){
            $managers .= '<p style="color:white;font-size:11px;">'; 
            $i = 1;
            foreach($manager_details as $manager_value){
                $manager_ids=$manager_value['user_id'];
                $manager_detail=$this -> main_model -> user_info_by_id($manager_ids);
                $name=$manager_detail->first_name.' '.$manager_detail->last_name;
                $managers .= $name."<br/>";
                if($manager_detail->company_phonenumber){
                    $managers .= $manager_detail->company_phonenumber."<br/>";
                }
                if($manager_detail->dealership_email){
                    $managers .= $manager_detail->dealership_email."<br/><br/>";
                }
                $i++;
            }
            $name='<br/>Charity Lee';
            $managers .= $name."<br/>";
            $managers .= "780-987-3940<br/>";
            $managers .= "charity.lee@exclusiveprivatesale.com";
            
            $managers .= '</p>';
        }else{
            $managers = '';
        }
        $field_report='';
        $i = 1;
        foreach($get_report_details as $report_selected)
        {
            $report_name=$report_selected['report_type'];
            $value1=$report_selected['value1'];
            $value2=$report_selected['value2'];
            $field_name1=$report_selected['field_name1'];
            $field_name2=$report_selected['field_name2'];
            $report_type=$this->settings_model->getreporttype($report_name);
            
            $report_details=$this->settings_model->get_advance_option_report($report_name,$value1,$value2,$field_name1,$field_name2);
            $report_description=$this->settings_model->get_report_description($report_name); 
            $customer_leadlist_count_group=$this -> settings_model -> getleadcount($event_id,$report_selected['group_name']);
            if($i > 1){
               $field_report.= '<p></p>'; 
            }
        if($report_details == 'Unknown'){
        }else{
                $field_report.='<p style="font-size:12px;"><span style="font-weight:bold">Lead Group - '.$report_selected['group_name'].'</span></p>';
                $field_report.='<p style="font-size:12px;"><span style="font-weight:bold">Report Type:</span> '.$report_details['report_type'].'</p> ';
                $field_report.='<p style="font-size:12px;"><span style="font-weight:bold">Report Description: </span>'.$report_details['report_description'].'</p>';
                if(isset($report_details['report_settings'])){
                    $field_report.='<p style="font-size:12px;"><span  style="font-weight:bold">Report Settings </span><br/>'.$report_details['report_settings'].'</p>';
                }
            }
//            $field_report.='<p style="font-size:12px;">Report Type: '.$report_type.'</p> ';
//            $field_report.='<p style="font-size:12px;"><span >Report Description: </span>'.$report_description.'</span></p>';
//            $field_report.='<p style="font-size:12px;"><span  style="font-weight:bold">Report Settings </span></p>';
//            if($field_name1!='' && $field_name2!=''){
//                $field_report.='<p style="font-size:12px;"><span >'.$field_name1.': '.$value1.', '.$field_name2.': '.$value2.'</span></p>'; 
//            }
//            else if($field_name1!='' && $field_name2==''){
//                $report_feild_setting_values='';
//                $report_feild_setting_values=$this -> settings_model -> report_field_settings($field_name1);
//                $value1_replace=str_replace('_',' ',$value1);
//                $field_report.='<p style="font-size:12px;"><span >'.$report_feild_setting_values.': '.$value1_replace.'</span></p>';    
//            }
//            else{
//                $value1_replace=str_replace('_',' ',$value1);
//                $field_report.='<p style="font-size:12px;"><span >Report Settings Field: '.$value1_replace.'</span></p>';    
//            }
            $field_report.='<p style="font-size:12px;"><span  style="font-weight:bold">Lead Count:</span> '.$customer_leadlist_count_group.'</p>';
            
            if($i <  count($get_report_details)){
                $field_report.= '<hr/>';
            }
            $i++;
        }
        // Display Header Image
//$pdf->Ln(15);
//$pdf->MultiCell(135, 0, '<img src="'.K_PATH_IMAGES.'exclusive_bg.jpg" />', 0, 'C', 0, 0, '', '', false, 0, true, false, 40, 'T');
        // Display Customer Name
        $count_group = count($get_report_details);
        $pdf->Ln(0);
        $pdf->MultiCell(130, 0, '<span style="color:#FFFFFF;font-size:14px;">Your Event At a Glance</span>', 0, 'L', 0, 0, '150', '', false, 0, true, false, 40, 'T');
        $html_sidebar = <<<EOD
                <p style="margin:0;color:white;font-size:11px;"><b>Event Start Date:</b> $event_start_date<br />
                <b>Event End Date:</b> $event_end_date<br />
                <b>Custom Campaign</b><br />
                <b>Total EPS Invites:</b> $lead_count<br />
                <b>Lead Target Groups:</b> $count_group<br/>Purchase Date: $past_from_date To $past_to_date Years
                <br/><b>Advertising Options:</b><br/> $advertising_option
                <br/><b>Lead Mining Presets:</b><br/> $lead_mining_presets_name</p>
                <p style="color:white;font-size:14px;">Your Dealership Info</p>
                <p style="color:white;font-size:11px;">$dealer_info->company_name<br/>$dealer_info->city,$dealer_info->state<br/>$dealer_info->zipcode<br/>$dealer_info->company_phonenumber<br/>$dealer_info->dealership_email<br/>$dealer_info->company_website</p>
                $managers
                <p style="color:white;font-size:14px;">EPS Invite Options</p>
                <p style="margin:0;color:white;font-size:12px;">Invite Size : $invitesize<br/>Invite Cost :$$invitecost</p>
                
                <p style="color:white;font-size:14px;">Estimated Event Fees</p>
                <p style="margin:0;color:white;font-size:12px;">Show Fees:       $$show_fees<br />
                Invite Cost:      $$invitecost<br />
                Versioning: $$versioning_cost<br />
                AutoPen: $$autopen_price<br />
                Insert - Cardstock: $$insert_cardstock_price<br />
                Insert - Paperstock: $$insert_paperstock_price<br />
                Variable Imaging: $$variable_imaging_price<br />
                Coloured Envelopes: $$colored_envelopes_price<br />
                Total Event Cost: $$total_event_cost<br />  
                 </p>      
EOD;
        $pdf->Ln(10);
        $pdf->MultiCell(60, 0, $html_sidebar, 0, 'L', 0, 0, '150', '', false, 0, true, false, 40, 'T');

        $html = <<<EOD
        <p style="margin-top:-20px;font-size:14px;"><i>Hi $dealer_info->first_name, </i></p>
        <p style="font-size:12px;">Please review the settings of your Exclusive Private Sale event scheduled from $event_start_date to $event_end_date. We are excited to be a part of $dealer_info->company_name's marketing strategy and look forward to a successful sales event with your team!
        </p>
        <p style="font-size:12px;">Your Advantage Invite settings are below. This information will be sent to our design team so they can create a unique invite design and call to action for each group of invitees. Your Account Manager at EPS will also receive a copy of this document and verify that all settings are correct.</p>
        <p style="font-size:12px;">If you selected to include Conquest mailers or Upgrader mailers, EPS will contact you to discuss the details & options for these.</p>
        <p style="font-size:14px;"><span  style="font-weight:bold">Exclusive Private Sale Event Details</span></p>
        
        $field_report
        <p style="font-size:14px;"><span  style="font-weight:bold">Current Dealership & OEM Specials</span></p>
        <p style="font-size:12px;">Manufacturer Interest Rate: $epsadvantage_info->manufacurer_interesr_rate<br/>
                Best Sub Prime Rate: $epsadvantage_info->best_sub_prime_rate<br/>
                Factory Rebate: $epsadvantage_info->factory_rebate<br/>
                Dealership Incentives: $epsadvantage_info->dealership_incentives<br/>
                Excess Vehicle: $epsadvantage_info->excess_vehicle<br/>
                Dealership Promos: $epsadvantage_info->dealership_promos<br/>
                </p>
EOD;
     // Print text using writeHTMLCell()
//    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);  
    // Display Text
$pdf->Ln(-7);
$pdf->MultiCell(130, 0, $html, 0, 'L', 0, 0, '14', '', false, 0, true, false, 40, 'T');

      }
     else{
       
         $report_type=$this->settings_model->getreporttype($report_name);
         
        $get_report_details=$this->settings_model->getgroupname_advanced_option_with_event_id($event_id); 
        $count_group = count($get_report_details);
        $pdf->Ln(0);
        $pdf->MultiCell(130, 0, '<span style="color:#FFFFFF;font-size:14px;">Your Event At a Glance</span>', 0, 'L', 0, 0, '150', '', false, 0, true, false, 40, 'T');
        $html_sidebar = <<<EOD
                <p style="margin:0;color:white;font-size:11px;"><b>Event Start Date:</b> $event_start_date<br />
                <b>Event End Date:</b> $event_end_date<br />
                <b>Custom Campaign</b><br />
                <b>Total EPS Invites:</b> $lead_count<br />
                <b>Lead Target Groups:</b> $count_group<br/>Purchase Date: $past_from_date To $past_to_date Years
                <br/><b>Advertising Options:</b><br/> $advertising_option
                <br/><b>Lead Mining Presets:</b><br/> $lead_mining_presets_name</p>
                <p style="color:white;font-size:14px;">Your Dealership Info</p>
                <p style="color:white;font-size:14px;">EPS Invite Options</p>
                <p style="margin:0;color:white;font-size:12px;">Invite Size : $invitesize<br/>Invite Cost :$$invitecost</p>
                
                <p style="color:white;font-size:14px;">Estimated Event Fees</p>
                <p style="margin:0;color:white;font-size:12px;">Show Fees:       $$show_fees<br />
                Invite Cost:      $$invitecost<br />
                Versioning: $$versioning_cost<br />
                AutoPen: $$autopen_price<br />
                Insert - Cardstock: $$insert_cardstock_price<br />
                Insert - Paperstock: $$insert_paperstock_price<br />
                Variable Imaging: $$variable_imaging_price<br />
                Coloured Envelopes: $$colored_envelopes_price<br />
                Total Event Cost: $$total_event_cost<br />  
                 </p>      
EOD;
        $pdf->Ln(10);
        $pdf->MultiCell(60, 0, $html_sidebar, 0, 'L', 0, 0, '150', '', false, 0, true, false, 40, 'T');
        
         $html = <<<EOD
        <p></p>
        <p style="margin-top:-20px;font-size:14px;"><i>Hi $dealer_info->first_name, </i></p>
        <p style="font-size:12px;">Please review the settings of your Exclusive Private Sale event scheduled from $event_start_date to $event_end_date. We are excited to be a part of $dealer_info->company_name's marketing strategy and look forward to a successful sales event with your team!
        </p>
         <p style="font-size:12px;">Your Advantage Invite settings are below. This information will be sent to our design team so they can create a unique invite design and call to action for each group of invitees. Your Account Manager at EPS will also receive a copy of this document and verify that all settings are correct.</p>
         <p style="font-size:12px;">If you selected to include Conquest mailers or Upgrader mailers, EPS will contact you to discuss the details & options for these.</p>
         <p style="font-size:15px;"><span  style="font-weight:bold">Exclusive Private Sale Event Details</span></p>
         <p style="font-size:14px;">Event Start Date: $event_start_date</p>
         <p style="font-size:14px;">Event End Date: $event_end_date</p>
         <p style="font-size:14px;">Advertising Options: $advertising_option</p>
         <p style="font-size:14px;">Lead Mining Presets: $lead_mining_presets_name</p>
         <p style="font-size:14px;">Vechicle Purchase Date Range: From $past_from_date To $past_to_date Years Ago</p>
         <p style="font-size:14px;">Total Lead Count: $lead_count</p>
         <p style="font-size:15px;"><span  style="font-weight:bold">Exclusive Private Sale Lead List Details</span></p>
         <p style="font-size:14px;color:red;"><span  style="font-weight:bold">1st Lead Group</span></p>
         <p style="font-size:14px;">$group_name1</p>  
         <p style="font-size:14px;">Lead Count : $customer_leadlist_count_group1</p>
         <p style="font-size:14px;color:red;"><span  style="font-weight:bold">2nd Lead Group</span></p>
         <p style="font-size:14px;">$group_name2</p>  
         <p style="font-size:14px;">Lead Count : $customer_leadlist_count_group2</p>
         <p style="font-size:14px;color:red;"><span  style="font-weight:bold">3rd Lead Group</span></p>
         <p style="font-size:14px;">$group_name3</p>  
         <p style="font-size:14px;">Lead Count : $customer_leadlist_count_group3</p>
         <p style="font-size:14px;color:red;"><span  style="font-weight:bold">4th Lead Group</span></p>
         <p style="font-size:14px;">$group_name4</p>  
         <p style="font-size:14px;">Lead Count : $customer_leadlist_count_group4</p>
         <p style="font-size:14px;color:red;"><span  style="font-weight:bold">5th Lead Group</span></p>
         <p style="font-size:14px;">$group_name5</p>  
         <p style="font-size:14px;">Lead Count : $customer_leadlist_count_group5</p>
         $report_type6_show
         </p>
         
EOD;
        $pdf->Ln(-7);
        $pdf->MultiCell(130, 0, $html, 0, 'L', 0, 0, '14', '', false, 0, true, false, 40, 'T');
  }
  }
  }

 
    // ---------------------------------------------------------   
     // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
   $companyname_show='';
    $get_dealer_company_name=$this -> main_model -> dealercompanynameget($dealer_id);
    if(isset($get_dealer_company_name) && $get_dealer_company_name!=''){
     foreach($get_dealer_company_name as $value_dealer_company_name){
      $companyname_get=substr(trim($value_dealer_company_name['company_name']),0,10); 
      $companyname_show=strtolower(str_replace(" ","-",$companyname_get));
     }   
    }
    $base_path = $this -> config -> item('rootpath');
    $dirs = array_filter(glob($base_path.'downloadreportzip/*'), 'is_dir');
//print_r( $dirs);
//  print_r(basename($base_path.'downloadreportzip/'));die;
    $event_date=$this -> settings_model -> getEventDate($event_id);
    $report_download_time=date('m.d.y',$event_date);
    $zipname=($companyname_show.'-'.trim($report_download_time).'-'.$event_id); 
    $pdfname=($companyname_show.'-eventreport-'.$report_download_time.'-'.$event_id);
    $base_path = $this -> config -> item('rootpath');
    $destination = $base_path.'downloadreportzip';
//    mkdir($base_path.'downloadreportzip/'.$zipname, 0777, true);
//chmod($base_path.'downloadreportzip/'.$zipname, 0777);
//     $pdf->Output($base_path.'downloadreportzip/'.$zipname.'/'.$pdfname.'.pdf'); 
   $pdf->Output($base_path.'downloadreportzip/'.$zipname.'/'.$pdfname.'.pdf', 'F'); 
    $folder_in_zip = "/"; //root directory of the new zip file
    $base_path = $this -> config -> item('rootpath');
    $this->zip->archive($base_path.'/downloadreportzip/'.$zipname.'/'.$zipname.'.zip'); 
    //$path = $base_path.'/downloadreportzip/my_backup.zip';
    $this->zip->get_files_from_folder($base_path.'/downloadreportzip/'.$zipname.'/',$zipname.'.zip/',$zipname);
    $this->zip->download($zipname.'.zip');
//    
     //============================================================+
    // END OF FILE
    //============================================================+
    }

  
 }



 
/* End of file c_test.php */
/* Location: ./application/controllers/c_test.php */