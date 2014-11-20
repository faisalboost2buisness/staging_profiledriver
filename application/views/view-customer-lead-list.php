<!--
This page shows all dealers listing under an account manager
-->
<!-- Button to open/hide menu -->
<style>
.textcolor{
    color:#666666;
}
html {
    height: 100%;
    /*Image only BG fallback*/
    background: url('http://thecodeplayer.com/uploads/media/gs.png');
    /*background = gradient + image pattern combo*/
    background: 
    linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
    url('http://thecodeplayer.com/uploads/media/gs.png');
}
.highlight{
    background-position:-4px -15px !important
}
.fancybox-inner {
    height: 685px !important;
    width: 445px !important;
}
.fancybox-close
{
    right: -43px!important;
}
</style>
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<? echo base_url()?>fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script>
function viewdealerdashbosrd(dealer_id){
    window.location.href = '<?=base_url()?>dashboard/dealerdashboard/'+dealer_id;
}
var j = jQuery.noConflict();
jQuery.noConflict();       
j(document).ready(function() {
    var inboxload=0;
    /*
    *  Simple image gallery. Uses default settings
    */
    j('.fancybox').fancybox({
        beforeShow: function(){
            j(".fancybox-skin").css("backgroundColor","transparent");
        },
        'width' : '400px',
        'height' : '800px',
        'scrolling'   : 'no',
        'autoSize' : false,
        'transitionIn' : 'none',
        'transitionOut' : 'none',
        'type' : 'iframe'
    });
    /*
    *  Different effects
    */
    // Change title type, overlay closing speed
    j(".fancybox-effects-a").fancybox({
    helpers : {
        title : {
        type : 'outside',
        },
        overlay : {
        speedOut : 0
        }
    }
    });
});
</script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css"/>
<a href="#" id="open-menu"><span>Menu</span></a>
<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
<!-- Main content -->
<section role="main" id="main" >
    <hgroup id="main-title" class="thin" style="text-align:left;padding-bottom:0px;">
    <h1>Exclusive Private Sale Lead List</h1>
    <?php
    $buyer_first_name='';
    if(isset($dealer_id_upload_data)){
        if($dealer_id_upload_data!=''){
            $dealerid_get=$dealer_id_upload_data;            
        }else{
            $dealerid_get='';   
        }
    }else{
        $dealerid_get='';
    }
    if($event_insert_id!=''){
        $event_insert_id=$event_insert_id;
    }else{
        $event_insert_id='';
    }
    $lead_mining_presets='';
    $returnvalue=$this -> settings_model -> select_lead_mining_presets($event_insert_id);
    if(isset($returnvalue) && $returnvalue!=''){
        $lead_mining_presets=$returnvalue;  
    }
    if($lead_mining_presets!='custom_campaign'){
        $group_name=$this -> settings_model -> getleadgrouptitle($lead_mining_presets);
    }else{
        $group_name=$this -> settings_model -> getgroupname_title_advanced_option_with_event_id($event_insert_id);   
    }
    $lead_details=$this -> settings_model -> leadsection_select($event_insert_id);
    $id='sorting-advanced1';
    $count=0;
    $total_count_show=0;
    if(isset($lead_details) && is_array($lead_details)){
        $customer_leadlist_equity_scrap_count=$this -> settings_model -> getleadcount($event_insert_id,'1');
        $customer_leadlist_model_breakdown_count=$this -> settings_model -> getleadcount($event_insert_id,'2');
        $customer_leadlist_fuel_efficiency_count=$this -> settings_model -> getleadcount($event_insert_id,'3');
        $customer_leadlist_warrant_scarp_count=$this -> settings_model -> getleadcount($event_insert_id,'4');
        $customer_leadlist_advance_option_count=$this -> settings_model -> getleadcount($event_insert_id,'5');
        $total_count_show=$customer_leadlist_equity_scrap_count+$customer_leadlist_model_breakdown_count+$customer_leadlist_fuel_efficiency_count+$customer_leadlist_advance_option_count+$customer_leadlist_warrant_scarp_count;
    ?>
    <!--form starts here-->
    <form action="<?=base_url()?>campaign/mailoutoption/<?=$dealerid_get?>" method="post" style="margin-top: 12px;" class="leadlist">
        <p class="wrapped left-icon icon-info-round" style="margin-bottom: 10px;">Total Leads : <?php echo $total_count_show?> 
        <button type="button" class="submit button glossy mid-margin-right" onclick="viewdealerdashbosrd('<?=$dealer_id_upload_data?>');" style="float: right;">
            <span class="button-icon"><span class="icon-tick"></span></span>
            Back
        </button>
    </form>
     <!--form ends here-->
    </hgroup>
<div class="with-padding">
<!--heading-->
<?php
$count=count($lead_details);
if($count>0){
    $id='sorting-advanced';
}else{
    $id='sorting-advanced1';
}
}
?>	
<?php
if(isset($lead_details) && $lead_details!=''){
    foreach($lead_details as $lead_customer_data){
        if($lead_customer_data['equity_scrap']!=0){
            $lead_customer_equity_scrap_details=$this -> settings_model -> get_lead_customer_id($lead_customer_data['customer_leadlist_id'],$lead_customer_data['equity_scrap']);  
            if($lead_mining_presets!='custom_campaign'){
                if($group_name[0]!=''){
                    $group_name_first= $group_name[0]; 
                }  
            }
            else{
                $group_1_details=$this -> settings_model -> getgroupname_advanced_option($event_insert_id,1);
                if(isset($group_1_details) && $group_1_details!=''){
                    foreach($group_1_details as $value_group1){
                        $group_name_first=$this -> settings_model -> getreporttype($value_group1['report_type']);
                    }
                }   
            }
        ?>
        <dl class="accordion same-height">
        <!-- Equity Scrape-->
        <div class="slidingbackground leadlisttopbar"><?php echo $group_name_first?></div>
        <div class="slidingDiv">
            <table class="table responsive-table" id="sorting-advanced1">
                <thead>
                    <tr>
                        <th scope="col"  class="align-center hide-on-mobile">Name</th>
                        <th scope="col" style="width: 18%;" class="align-center hide-on-mobile"> Email</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> Address</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> City</th>
                        <th scope="" width="13%" class="align-center hide-on-mobile-portrait">Zip
                        </th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Condition</th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($lead_customer_equity_scrap_details) && $lead_customer_equity_scrap_details!=''){
                    foreach($lead_customer_equity_scrap_details as $value_customer_id){
                        $pbs_customer_search_id=$value_customer_id['lead_customer_id'];
                        $lead_customer_details=$this -> settings_model -> get_pbs_details($pbs_customer_search_id); 
                        if(isset($lead_customer_details) && $lead_customer_details!=''){
                            foreach($lead_customer_details as $value){
                               
                                if($value['buyer_first_name']!=''){
                                    $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                                }
                                if($value['buyer_last_name']!=''){
                                    $buyer_last_name=ucfirst(strtolower($value['buyer_last_name']));
                                }else{
                                    $buyer_last_name='';    
                                }
                                if($value['buyer_email']!=''){
                                    $buyer_email=$value['buyer_email'];
                                }else{
                                    $buyer_email='N/A';
                                }
                                if($value['buyer_city']!=''){                
                                    $buyer_city=ucfirst(strtolower($value['buyer_city']));
                                }else{
                                    $buyer_city='N/A';     
                                }
                                if($value['buyer_postalcode']!=''){
                                    $buyer_postalcode =$value['buyer_postalcode'];
                                }else{
                                    $buyer_postalcode='N/A';   
                                }
                                if($value['new_used']=='U'){
                                    $new_used='Used';  
                                }else{
                                    $new_used='New';                
                                }
                                if($value['buyer_address']!=''){                
                                    $buyer_address=ucfirst(strtolower($value['buyer_address']));
                                }else{
                                    $buyer_address='N/A';     
                                }
                                $pbs_customer_id=$value['id'];
                                ?>
                                <tr>
                                    <th scope="row" class="checkbox-cell textcolor" style="text-align: center;font-weight: normal;"><?php echo $buyer_first_name?>&nbsp;<?php echo $buyer_last_name;?></th>
                                    <td style="width:220px;color:#666666;"><?php echo $buyer_email?> </td>
                                    <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?php echo $buyer_address?></td>
                                    <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?php echo $buyer_city?></label></td>
                                    <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $buyer_postalcode;?></td>
                                    <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $new_used;?></td>
                                    <td class="align-center hide-on-mobile" style="width: 281px;">
                                    <span class="button-group compact">
                                    <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                    </span>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }else{
                ?>
                    <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </dl>
    <?php
    }
    //Model Breakdown
    if($lead_customer_data['model_break_down']!=0){
        $lead_customer_equity_scrap_details=$this -> settings_model -> get_lead_customer_id($lead_customer_data['customer_leadlist_id'],$lead_customer_data['model_break_down']);  
            if($lead_mining_presets!='custom_campaign'){
                if($group_name[1]!=''){
                    $group_name_second= $group_name[1]; 
                }
            }else{
            $group_1_details=$this -> settings_model -> getgroupname_advanced_option($event_insert_id,2);
                if(isset($group_1_details) && $group_1_details!=''){
                    foreach($group_1_details as $value_group1){
                        $group_name_second=$this -> settings_model -> getreporttype($value_group1['report_type']);
                    }
                }   
            }
        ?>
        <dl class="accordion same-height">
        <!-- Equity Scrape-->
        <div class="slidingbackground leadlisttopbar"><?php echo $group_name_second?></div>
        <div class="slidingDiv">
            <table class="table responsive-table" id="sorting-advanced1">
                <thead>
                    <tr>
                        <th scope="col"  class="align-center hide-on-mobile">Name</th>
                        <th scope="col" style="width: 18%;" class="align-center hide-on-mobile"> Email</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> Address</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> City</th>
                        <th scope="" width="13%" class="align-center hide-on-mobile-portrait">Zip
                        </th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Condition</th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($lead_customer_equity_scrap_details) && $lead_customer_equity_scrap_details!=''){
                    foreach($lead_customer_equity_scrap_details as $value_customer_id){
                        $pbs_customer_search_id=$value_customer_id['lead_customer_id'];
                        $lead_customer_details=$this -> settings_model -> get_pbs_details($pbs_customer_search_id); 
                        if(isset($lead_customer_details) && $lead_customer_details!=''){
                            foreach($lead_customer_details as $value){
                                if($value['buyer_first_name']!=''){
                                    $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                                }
                                if($value['buyer_last_name']!=''){
                                    $buyer_last_name=ucfirst(strtolower($value['buyer_last_name']));
                                }else{
                                    $buyer_last_name='';    
                                }
                                if($value['buyer_email']!=''){
                                    $buyer_email=$value['buyer_email'];
                                }else{
                                    $buyer_email='N/A';
                                }
                                if($value['buyer_city']!=''){                
                                    $buyer_city=ucfirst(strtolower($value['buyer_city']));
                                }else{
                                    $buyer_city='N/A';     
                                }
                                if($value['buyer_postalcode']!=''){
                                    $buyer_postalcode =$value['buyer_postalcode'];
                                }else{
                                    $buyer_postalcode='N/A';   
                                }
                                if($value['new_used']=='U'){
                                    $new_used='Used';  
                                }else{
                                    $new_used='New';                
                                }
                                if($value['buyer_address']!=''){                
                                    $buyer_address=ucfirst(strtolower($value['buyer_address']));
                                }else{
                                    $buyer_address='N/A';     
                                }
                                $pbs_customer_id=$value['id'];
                                ?>
                                <tr>
                                    <th scope="row" class="checkbox-cell textcolor" style="text-align: center;font-weight: normal;"><?php echo $buyer_first_name?>&nbsp;<?php echo $buyer_last_name;?></th>
                                    <td style="width:220px;color:#666666;"><?php echo $buyer_email?> </td>
                                    <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?php echo $buyer_address?></td>
                                    <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?php echo $buyer_city?></label></td>
                                    <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $buyer_postalcode;?></td>
                                    <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $new_used;?></td>
                                    <td class="align-center hide-on-mobile" style="width: 281px;">
                                    <span class="button-group compact">
                                    <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                    </span>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                else
                {
                ?>
                    <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        </dl>
    <?php
    }
    //Fuel Efficiency
    if($lead_customer_data['fuel_effciency']!=0){
        $lead_customer_equity_scrap_details=$this -> settings_model -> get_lead_customer_id($lead_customer_data['customer_leadlist_id'],$lead_customer_data['fuel_effciency']);  
        if($lead_mining_presets!='custom_campaign'){
            if($group_name[2]!=''){
                $group_name_third=$group_name[2]; 
            }
    }else{
        $group_1_details=$this -> settings_model -> getgroupname_advanced_option($event_insert_id,3);
        if(isset($group_1_details) && $group_1_details!=''){
            foreach($group_1_details as $value_group1){
                $group_name_third=$this -> settings_model -> getreporttype($value_group1['report_type']);
            }
        }   
    }
    ?>
    <dl class="accordion same-height">
    <!-- Equity Scrape-->
        <div class="slidingbackground leadlisttopbar"><?php echo $group_name_third?></div>
            <div class="slidingDiv">
                <table class="table responsive-table" id="sorting-advanced1">
                    <thead>
                        <tr>
                            <th scope="col"  class="align-center hide-on-mobile">Name</th>
                            <th scope="col" style="width: 18%;" class="align-center hide-on-mobile"> Email</th>
                            <th scope="col" width="13%" class="align-center hide-on-mobile"> Address</th>
                            <th scope="col" width="13%" class="align-center hide-on-mobile"> City</th>
                            <th scope="" width="13%" class="align-center hide-on-mobile-portrait">Zip
                            </th>
                            <th scope="col" width="10%" class="align-center hide-on-mobile">Condition</th>
                            <th scope="col" width="10%" class="align-center hide-on-mobile">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($lead_customer_equity_scrap_details) && $lead_customer_equity_scrap_details!=''){
                        foreach($lead_customer_equity_scrap_details as $value_customer_id){
                        $pbs_customer_search_id=$value_customer_id['lead_customer_id'];
                        $lead_customer_details=$this -> settings_model -> get_pbs_details($pbs_customer_search_id); 
                            if(isset($lead_customer_details) && $lead_customer_details!=''){
                                foreach($lead_customer_details as $value){
                                    if($value['buyer_first_name']!=''){
                                        $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                                    }
                                    if($value['buyer_last_name']!=''){
                                        $buyer_last_name=ucfirst(strtolower($value['buyer_last_name']));
                                    }else{
                                        $buyer_last_name='';    
                                    }
                                    if($value['buyer_email']!=''){
                                        $buyer_email=$value['buyer_email'];
                                    }else{
                                        $buyer_email='N/A';
                                    }
                                    if($value['buyer_city']!=''){                
                                        $buyer_city=ucfirst(strtolower($value['buyer_city']));
                                    }else{
                                        $buyer_city='N/A';     
                                    }
                                    if($value['buyer_postalcode']!=''){
                                        $buyer_postalcode =$value['buyer_postalcode'];
                                    }else{
                                        $buyer_postalcode='N/A';   
                                    }
                                    if($value['new_used']=='U'){
                                        $new_used='Used';  
                                    }else{
                                        $new_used='New';                
                                    }
                                    if($value['buyer_address']!=''){                
                                        $buyer_address=ucfirst(strtolower($value['buyer_address']));
                                    }else{
                                        $buyer_address='N/A';     
                                    }
                                    $pbs_customer_id=$value['id'];
                                    ?>
                                    <tr>
                                        <th scope="row" class="checkbox-cell textcolor" style="text-align: center;font-weight: normal;"><?php echo $buyer_first_name?>&nbsp;<?php echo $buyer_last_name;?></th>
                                        <td style="width:220px;color:#666666;"><?php echo $buyer_email?> </td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?php echo $buyer_address?></td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?php echo $buyer_city?></label></td>
                                        <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $buyer_postalcode;?></td>
                                        <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $new_used;?></td>
                                        <td class="align-center hide-on-mobile" style="width: 281px;">
                                        <span class="button-group compact">
                                        <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                        </span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                    else
                    {
                    ?>
                        <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </dl>
    <?php
    }
    //Warranty Scrape
    if($lead_customer_data['wrranty_scrap']!=0){
        $group_name[3]='';
        $lead_customer_equity_scrap_details=$this -> settings_model -> get_lead_customer_id($lead_customer_data['customer_leadlist_id'],$lead_customer_data['wrranty_scrap']);  
        if($lead_mining_presets!='custom_campaign'){
            if($group_name[3]!=''){
            $group_name_fourth=$group_name[3]; 
            }
        }else{
        $group_1_details=$this -> settings_model -> getgroupname_advanced_option($event_insert_id,4);
            if(isset($group_1_details) && $group_1_details!=''){
                foreach($group_1_details as $value_group1){
                    $group_name_fourth=$this -> settings_model -> getreporttype($value_group1['report_type']);
                }
            }   
        }
    ?>
    <dl class="accordion same-height">
    <!-- Equity Scrape-->
        <div class="slidingbackground leadlisttopbar"><?php echo $group_name_fourth?></div>
        <div class="slidingDiv">
            <table class="table responsive-table" id="sorting-advanced1">
            <thead>
                <tr>
                    <th scope="col"  class="align-center hide-on-mobile">Name</th>
                    <th scope="col" style="width: 18%;" class="align-center hide-on-mobile"> Email</th>
                    <th scope="col" width="13%" class="align-center hide-on-mobile"> Address</th>
                    <th scope="col" width="13%" class="align-center hide-on-mobile"> City</th>
                    <th scope="" width="13%" class="align-center hide-on-mobile-portrait">Zip
                    </th>
                    <th scope="col" width="10%" class="align-center hide-on-mobile">Condition</th>
                    <th scope="col" width="10%" class="align-center hide-on-mobile">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($lead_customer_equity_scrap_details) && $lead_customer_equity_scrap_details!=''){
                foreach($lead_customer_equity_scrap_details as $value_customer_id){
                    $pbs_customer_search_id=$value_customer_id['lead_customer_id'];
                    $lead_customer_details=$this -> settings_model -> get_pbs_details($pbs_customer_search_id); 
                    if(isset($lead_customer_details) && $lead_customer_details!=''){
                        foreach($lead_customer_details as $value){
                            if($value['buyer_first_name']!=''){
                                $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                            }
                            if($value['buyer_last_name']!=''){
                                $buyer_last_name=ucfirst(strtolower($value['buyer_last_name']));
                            }else{
                                $buyer_last_name='';    
                            }
                            if($value['buyer_email']!=''){
                                $buyer_email=$value['buyer_email'];
                            }else{
                                $buyer_email='N/A';
                            }
                            if($value['buyer_city']!=''){                
                                $buyer_city=ucfirst(strtolower($value['buyer_city']));
                            }else{
                                $buyer_city='N/A';     
                            }
                            if($value['buyer_postalcode']!=''){
                                $buyer_postalcode =$value['buyer_postalcode'];
                            }else{
                                $buyer_postalcode='N/A';   
                            }
                            if($value['new_used']=='U'){
                                $new_used='Used';  
                            }else{
                                $new_used='New';                
                            }
                            if($value['buyer_address']!=''){                
                                $buyer_address=ucfirst(strtolower($value['buyer_address']));
                            }else{
                                $buyer_address='N/A';     
                            }
                            $pbs_customer_id=$value['id'];
                            ?>
                            <tr>
                                <th scope="row" class="checkbox-cell textcolor" style="text-align: center;font-weight: normal;"><?php echo $buyer_first_name?>&nbsp;<?php echo $buyer_last_name;?></th>
                                <td style="width:220px;color:#666666;"><?php echo $buyer_email?> </td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?php echo $buyer_address?></td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?php echo $buyer_city?></label></td>
                                <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $buyer_postalcode;?></td>
                                <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $new_used;?></td>
                                <td class="align-center hide-on-mobile" style="width: 281px;">
                                <span class="button-group compact">
                                <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                </span>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                    }
                }else{
                ?>
                    <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
                <?php
                }
                ?>
            </tbody>
            </table>
        </div>
    </dl>
    <?php
    }
    if($lead_customer_data['custom_campain']!=0){
        $lead_customer_equity_scrap_details=$this -> settings_model -> get_lead_customer_id($lead_customer_data['customer_leadlist_id'],$lead_customer_data['custom_campain']);  
        if($lead_mining_presets!='custom_campaign'){
            if($group_name[4]!=''){
                $group_name_fifth=$group_name[4]; 
            }
        }else{
            $group_1_details=$this -> settings_model -> getgroupname_advanced_option($event_insert_id,5);
            if(isset($group_1_details) && $group_1_details!=''){
                foreach($group_1_details as $value_group1){
                    $group_name_fifth=$this -> settings_model -> getreporttype($value_group1['report_type']);
                }
            }   
        }
    ?>
    <dl class="accordion same-height">
    <!-- Equity Scrape-->
    <div class="slidingbackground leadlisttopbar"><?php echo $group_name_fifth?></div>
        <div class="slidingDiv">
            <table class="table responsive-table" id="sorting-advanced1">
                <thead>
                    <tr>
                        <th scope="col"  class="align-center hide-on-mobile">Name</th>
                        <th scope="col" style="width: 18%;" class="align-center hide-on-mobile"> Email</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> Address</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> City</th>
                        <th scope="" width="13%" class="align-center hide-on-mobile-portrait">Zip
                        </th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Condition</th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($lead_customer_equity_scrap_details) && $lead_customer_equity_scrap_details!=''){
                    foreach($lead_customer_equity_scrap_details as $value_customer_id){
                    $pbs_customer_search_id=$value_customer_id['lead_customer_id'];
                    $lead_customer_details=$this -> settings_model -> get_pbs_details($pbs_customer_search_id); 
                        if(isset($lead_customer_details) && $lead_customer_details!=''){
                            foreach($lead_customer_details as $value){
                                if($value['buyer_first_name']!=''){
                                    $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                                }
                                if($value['buyer_last_name']!=''){
                                    $buyer_last_name=ucfirst(strtolower($value['buyer_last_name']));
                                }else
                                {
                                $buyer_last_name='';    
                                }
                                if($value['buyer_email']!=''){
                                    $buyer_email=$value['buyer_email'];
                                }else{
                                    $buyer_email='N/A';
                                }
                                if($value['buyer_city']!=''){                
                                    $buyer_city=ucfirst(strtolower($value['buyer_city']));
                                }else{
                                    $buyer_city='N/A';     
                                }
                                if($value['buyer_postalcode']!=''){
                                    $buyer_postalcode =$value['buyer_postalcode'];
                                }else{
                                    $buyer_postalcode='N/A';   
                                }
                                if($value['new_used']=='U'){
                                    $new_used='Used';  
                                }else{
                                    $new_used='New';                
                                }
                                if($value['buyer_address']!=''){                
                                    $buyer_address=ucfirst(strtolower($value['buyer_address']));
                                }else{
                                    $buyer_address='N/A';     
                                }
                                $pbs_customer_id=$value['id'];
                                ?>
                                    <tr>
                                        <th scope="row" class="checkbox-cell textcolor" style="text-align: center;font-weight: normal;"><?php echo $buyer_first_name?>&nbsp;<?php echo $buyer_last_name;?></th>
                                        <td style="width:220px;color:#666666;"><?php echo $buyer_email?> </td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?php echo $buyer_address?></td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?php echo $buyer_city?></label></td>
                                        <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $buyer_postalcode;?></td>
                                        <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $new_used;?></td>
                                        <td class="align-center hide-on-mobile" style="width: 281px;">
                                        <span class="button-group compact">
                                        <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                        </span>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    }
                }
                else
                {
                ?>
                    <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </dl>
    <?php
    }
    if($lead_customer_data['fuel_efficiency_report6']!=0){
        $lead_customer_equity_scrap_details=$this -> settings_model -> get_lead_customer_id($lead_customer_data['customer_leadlist_id'],$lead_customer_data['custom_campain']);  
        if($group_name[5]!=''){
            $group_name_six=$group_name[5]; 
        }else{
            $group_name_six= '';   
        }
    ?>
    <dl class="accordion same-height">
    <!-- Equity Scrape-->
    <div class="slidingbackground leadlisttopbar"><?php echo $group_name_six?></div>
        <div class="slidingDiv">
            <table class="table responsive-table" id="sorting-advanced1">
                <thead>
                    <tr>
                        <th scope="col"  class="align-center hide-on-mobile">Name</th>
                        <th scope="col" style="width: 18%;" class="align-center hide-on-mobile"> Email</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> Address</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile"> City</th>
                        <th scope="" width="13%" class="align-center hide-on-mobile-portrait">Zip
                        </th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Condition</th>
                        <th scope="col" width="10%" class="align-center hide-on-mobile">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($lead_customer_equity_scrap_details) && $lead_customer_equity_scrap_details!=''){
                    foreach($lead_customer_equity_scrap_details as $value_customer_id){
                        $pbs_customer_search_id=$value_customer_id['lead_customer_id'];
                        $lead_customer_details=$this -> settings_model -> get_pbs_details($pbs_customer_search_id); 
                        if(isset($lead_customer_details) && $lead_customer_details!=''){
                            foreach($lead_customer_details as $value){
                                if($value['buyer_first_name']!=''){
                                    $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                                }
                                if($value['buyer_last_name']!=''){
                                    $buyer_last_name=ucfirst(strtolower($value['buyer_last_name']));
                                }else{
                                    $buyer_last_name='';    
                                }
                                if($value['buyer_email']!=''){
                                    $buyer_email=$value['buyer_email'];
                                }else{
                                    $buyer_email='N/A';
                                }
                                if($value['buyer_city']!=''){                
                                    $buyer_city=ucfirst(strtolower($value['buyer_city']));
                                }else{
                                    $buyer_city='N/A';     
                                }
                                if($value['buyer_postalcode']!=''){
                                    $buyer_postalcode =$value['buyer_postalcode'];
                                }else{
                                    $buyer_postalcode='N/A';   
                                }
                                if($value['new_used']=='U'){
                                    $new_used='Used';  
                                }else{
                                    $new_used='New';                
                                }
                                if($value['buyer_address']!=''){                
                                    $buyer_address=ucfirst(strtolower($value['buyer_address']));
                                }else{
                                    $buyer_address='N/A';     
                                }
                                $pbs_customer_id=$value['id'];
                                ?>
                                    <tr>
                                        <th scope="row" class="checkbox-cell textcolor" style="text-align: center;font-weight: normal;"><?php echo $buyer_first_name?>&nbsp;<?php echo $buyer_last_name;?></th>
                                        <td style="width:220px;color:#666666;"><?php echo $buyer_email?> </td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?php echo $buyer_address?></td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?php echo $buyer_city?></label></td>
                                        <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $buyer_postalcode;?></td>
                                        <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $new_used;?></td>
                                        <td class="align-center hide-on-mobile" style="width: 281px;">
                                        <span class="button-group compact">
                                        <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                        </span>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                    }else{
                    ?>
                        <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
                    <?php
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </dl>
        <?php
        }
    }
}
else
{
?>
    <tr><td colspan="7" class="norecordfound">No Data Found</td></tr>
<?php
}
?>
</form>    
</div>
</section>
<!-- End sidebar/drop-down menu -->
<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<script src="<?=base_url() ?>js/libs/jquery-1.10.2.min.js"></script>
<script src="<?=base_url() ?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url() ?>js/developr.input.js"></script>
<script src="<?=base_url() ?>js/developr.navigable.js"></script>
<script src="<?=base_url() ?>js/developr.notify.js"></script>
<script src="<?=base_url() ?>js/developr.scroll.js"></script>
<script src="<?=base_url() ?>js/developr.tooltip.js"></script>
<!-- Plugins -->
<script src="<?=base_url() ?>js/libs/jquery.tablesorter.min.js"></script>
<script src="<?=base_url() ?>js/libs/DataTables/jquery.dataTables.min.js"></script>
<script>
$( document ).ready(function() {
$('#priority1').hide();   
});
</script>