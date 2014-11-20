<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<script type="text/javascript" src="<? echo base_url()?>js/jquery-1.6.1.min.js"></script>
<style>
/*custom font*/
@import url(http://fonts.googleapis.com/css?family=Montserrat);
/*basic reset*/
* {margin: 0; padding: 0;}
html {
    height: 100%;
    /*Image only BG fallback*/
    background: url('http://thecodeplayer.com/uploads/media/gs.png');
    /*background = gradient + image pattern combo*/
    background: linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
    url('http://thecodeplayer.com/uploads/media/gs.png');
}
/*form styles*/
#msform { 
    width: 63%;
    margin: 0 auto;
    text-align: center;
    position: relative;
    padding-top:0px;
}
#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 3px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    margin: 0 ;
    margin: 0 auto 0 15%;
    width: 100%;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

/*buttons*/
#msform .action-button {
    width: 100px;
    background: #27AE60;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/
.fs-title {
    font-size: 15px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
}
.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    margin-left: 196px;
    /*CSS counters to number the steps*/
    counter-reset: step;
}
#progressbar li {
    list-style-type: none;
    color: white;
    text-transform: uppercase;
    font-size: 9px;
    width: 33.33%;
    display: inline-block;
    position: relative;
}
#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 20px;
    line-height: 20px;
    display: block;
    font-size: 10px;
    color: #333;
    background: white;
    border-radius: 3px;
    margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
    background: #27AE60;
    color: white;
}
#progressbar1 {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
}
#progressbar1 li {
    list-style-type: none;
    color: white;
    text-transform: uppercase;
    font-size: 9px;
    width: 33.33%;
    display: inline-block;
    position: relative;
}
#progressbar1 li:before {
    content: counter(step);
    counter-increment: step;
    width: 20px;
    line-height: 20px;
    display: block;
    font-size: 10px;
    color: #333;
    background: white;
    border-radius: 3px;
    margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar1 li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}
#progressbar1 li:first-child:after {
    /*connector not needed before the first step*/
    content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar1 li.active:before,  #progressbar li.active:after{
    background: #27AE60;
    color: white;
}
.reporttype{
    float: left;
    line-height: 12px;
    margin: 6px 0;
    width: 100%;
}
.reportlabel{
    float: left;
}
.inline-small-label{
    margin-bottom:10px;
    padding-left: 39px;
}
#msform input, #msform textarea{
    padding:8px;
    width: 43%;
}
p.button-height, ul.button-height, ol.button-height{
    margin-bottom: 4px;
    padding-left: 13px;
}
.inline-small-label > .label {
    display: block;
    float: left;
    font-weight: bold;
    margin-left: 2px;
    text-align: left;
    width: 168px;
    padding-bottom: 3px;
}
ul, ol {
    margin-left: 8.8em;
}
.events
{
    float: left;
    font-size: 16px;
    text-align: right;
    width: 52%;
    margin-left: 100px !important;
}
.input{
    float:left;
}
.tabs-content
{
margin-bottom: 10px;
}
.four-columns {
    float: left;
    width: 44.083%;
    margin-left: 20px;
    margin-right: 20px;
}
.body
{
    color:#444;
}
.fs-title {
    font-size: 15px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
}
.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}
.imagefirst{
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    border: 1px solid grey; 
    float: left; 
    border-radius: 23px; 
    width: 46%;
    height:284px;
}
.imagesecond{
    border: 1px solid #808080;
    border-radius: 23px;
    float: right;
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    width: 46%;
    height: 284px;
}
#vechicle_class_option .select-styled-list{
    float: left;
    text-align: left;
}
#vechicle_class_option .fuel_economy_from{
    width:106px;
}
#vechicle_class_option .fuel_economy_to{
    width:106px;
}
#vechicle_class_option .trade_in_value_from{
    width:106px;
}
#vechicle_class_option .trade_in_value_to{
    width:106px;
}
#main
{
    position: inherit;
}
#vechicle_class_option .minimum_monthly_payment{
    width:106px;
}
#vechicle_class_option .maximum_monthly_payment{
    width:106px;
}
#eps_mining .lead_mining{
    float: left;
    width: 167px;
}
.tooltip {
    cursor: help; text-decoration: none;
    position: relative;
    white-space:normal;
}
.tooltip span 
{
    color: #4C4C4C;
    font-size: 13px;
    font-weight: bold;
    margin-left: -959em;
    position: absolute;
    width: 187px !important;
}
.tooltip:hover span {
    border-radius: 5px 5px;
    -moz-border-radius: 5px; 
    -webkit-border-radius: 5px; 
    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1); 
    -webkit-box-shadow: 5px 5px rgba(0, 0, 0, 0.1); 
    -moz-box-shadow: 5px 5px rgba(0, 0, 0, 0.1);
    font-family: Calibri, Tahoma, Geneva, sans-serif;
    position: absolute; 
    left: 1em; 
    top: 2em; 
    z-index: 99;
    margin-left: 0; 
    width: 250px;
}
.classic { 
    line-height: 17px;
    padding-bottom: 0.8em;
    padding-left: 1em;
    padding-right: 1em;
    padding-top: 0.8em;
    text-align: left; 
}
.custom { 
    padding: 0.5em 0.8em 0.8em 2em; 
    }
* html a:hover { 
    background: transparent; 
    }
.classic {
    background: #F0F1F4; 
    border: 1px solid #9A9A9A; 
    }
.critical { 
    background: #FFCCAA; 
    border: 1px solid #FF3334;	
    }
.help { 
    background: #9FDAEE; 
    border: 1px solid #2BB0D7;	
    }
.info { 
    background: #9FDAEE; 
    border: 1px solid #2BB0D7;	
    }
.warning { 
    background: #FFFFAA; 
    border: 1px solid #FFAD33; 
    }
    .drop-down custom-scroll{
   overflow-y: scroll !important;
}
</style>
    <section role="main" id="main">
    <!-- multistep form -->
    <?php

    if(isset($dealer_id_upload_data))
        {
            if($dealer_id_upload_data!='')
            {
                $dealerid_get=$dealer_id_upload_data;            
            }
            else
            {
                $dealerid_get='';   
            }
        }
    else
        {
        $dealerid_get='';
        }
    $incomplete_event_insert_get='';
    $lead_mining='';
    $past_vehicle_purchase_date_from_range='';
    $past_vehicle_purchase_date_to_range='';
    $report_type='';
    $manufacurer_interesr_rate='';
    $best_sub_prime_rate='';
    $factory_rebate='';
    $dealership_incentives='';
    $excess_vehicle='';
    $dealership_promos='';
    $lead_id=0;
    if(isset($incomplete_events) && $incomplete_events!=''){
        $get_campaign_editdetails=$this->settings_model->campaign_select($event_insert_id);  
        if(isset($get_campaign_editdetails) && $get_campaign_editdetails!=''){
        foreach($get_campaign_editdetails as $campign_values){
            $lead_id=$campign_values['id'];            
            $lead_mining=$campign_values['lead_mining_presets'];
            $past_vehicle_purchase_date_from_range=$campign_values['past_vehicle_purchase_date_from_range'];
            $past_vehicle_purchase_date_to_range=$campign_values['past_vehicle_purchase_date_to_range'];
            $max_invites=$campign_values['max_invites'];
            $report_type=$campign_values['report_type'];
            $manufacurer_interesr_rate=$campign_values['manufacurer_interesr_rate'];
            $best_sub_prime_rate=$campign_values['best_sub_prime_rate'];
            $factory_rebate=$campign_values['factory_rebate'];
            $dealership_incentives=$campign_values['dealership_incentives'];
            $excess_vehicle=$campign_values['excess_vehicle'];
            $dealership_promos=$campign_values['dealership_promos'];
            $step3_select=$campign_values['step3_select'];
            $advancedoption_select=$campign_values['advancedoption_select'];
            $step1_select= $campign_values['step1_select'];
            }
    }
   } 
    ?>
    <script>
     $( document ).ready(function() {
        <?php
        if(isset($editted_step) || $editted_step!=''){
            if($editted_step=='adv_step1' && $step1_select==1){
                
            ?>
            $('#advancedoption_capaine_select').toggle();
            $('#event_date_section').hide(); 
            changefirsttabs();
            <?php
        }elseif($editted_step=='adv_step2' && $advancedoption_select==1){
         ?>
         $('#advancedoption_capaine_select').toggle(); 
         $('#event_date_section').hide();
         $('#steptwo').show();
        $('#stepthree').hide();
        $('#stepfour').hide();
        $('#stepfirst').hide();
        $('#steptwolist').addClass("active");
        $('#stepthreelist').removeClass("active");
        $('#stepfourlist').removeClass("active");
        $('#stepfirstlist').addClass("active");
        $("#steptwo").css({'opacity':1, 'transform':'scale(1)'});
            <?php   
        }elseif($editted_step=='adv_step3' && $step3_select==1){
         ?>
         $('#advancedoption_capaine_select').toggle(); 
         $('#event_date_section').hide();
         $('#steptwo').hide();
        $('#stepfirst').hide();
        $('#stepfour').hide();
        $('#stepthree').show();
        $('#stepthreelist').addClass("active");
        $('#stepfirstlist').addClass("active");
        $('#steptwolist').addClass("active");
        $('#stepfourlist').removeClass("active");
        $("#stepthree").css({'opacity':1, 'transform':'scale(1)'});
            <?php   
        }
        elseif($editted_step=='campign_step1'){
         ?>
         $('#advancedoption_capaine_unselection').toggle();
         $('#event_date_section').hide();
            changefirsttabscampine();
            <?php   
        }elseif($editted_step=='campign_step2'){
         ?>
         $('#advancedoption_capaine_unselection').toggle();
         $('#event_date_section').hide();
            changesecondtabscampine();
            <?php   
        }else{
            ?>
           $('#advancedoption_capaine_select').toggle();
            $('#event_date_section').hide(); 
            changefirsttabs();  
            <?php
        }
        
        }
        ?>
            
            });
    </script>
    <form id="msform"  method="post" action="<?=base_url()?>campaign/customerlist/<?=$dealerid_get?>" id="form-login">
    <input type="hidden"  id="select_campine" value=""/>
    <input type="hidden"  id="campaine_insert_id" value="" name="campaine_insert_id"/>
    <input type="hidden"  id="event_insert_id" value="<?=$event_insert_id?>" name="event_insert_id"/>
    <input type="hidden"  id="lead_group1" value=""/>
    <!-- progressbar -->
        <ul id="progressbar" class="processbar-custom-campaine" style="display: none;">
            <li class="active" style="color: black;width: 111px;" onclick="changefirsttabs();" id="stepfirstlist" style="cursor: pointer;"><a href="javascript:void(0);">Step 1</a></li>
            <li style="color: black;width: 103px;" onclick="changesecondtabs();" id="steptwolist" class="" ><a href="javascript:void(0);">Step 2</a></li>
            <li style="color: black;width: 122px;" onclick="changethirdtabs();" id="stepthreelist" style="cursor: pointer;"><a href="javascript:void(0);">Step 3</a></li>
        </ul>
        <ul id="progressbar1" class="processbar-campaine" >
            <li class="active" style="color: black;width: 111px;" onclick="changefirsttabscampine();" id="stepfirstlistcampine" style="cursor: pointer;"><a href="javascript:void(0);">Step 1</a></li>
            <li style="color: black;width: 103px;" onclick="changesecondtabscampine();" id="steptwolistcampine" class="" ><a href="javascript:void(0);">Step 2</a></li>
        </ul>
        <!-- fieldsets -->
        <fieldset id="stepfirst" class="stepfirst">
            <div class="with-padding">
            <h3 style="color:#666666;">PROFITDRIVER LEAD MINING SETTINGS</h3>
                <div style="margin: 0 auto;width: 530px;">
                    <p class="inline-small-label button-height">
                        <label for="validation-select" class="label events" >Lead Mining Presets</label>
                        <span style="float: left;">
                            <div id="eps_mining">
                                <select id="configuredcamp" name="validation-select" class="select validate[required] lead_mining "  style="width: 39%;" onchange="displaystepdevice(this.value);">
                                    <option value="" style="width: 44%;">Please select</option>
 <!--                                   <option value="equity_scrape" <?php echo $lead_mining=='equity_scrape' ? ' selected ':''; ?>>Equity Scrape</option>   -->
                                    <option value="model_breakdown" <?php echo $lead_mining=='model_breakdown' ? ' selected ':''; ?>>Model Breakdown</option>
                                    <option value="efficiency" <?php echo $lead_mining=='efficiency' ? ' selected ':''; ?>>Fuel Efficiency</option>
 <!--                                   <option value="warranty_scrape" <?php echo $lead_mining=='warranty_scrape' ? ' selected ':''; ?>>Warranty Scrape</option>   -->
                                    <option value="drive_type" <?php echo $lead_mining=='drive_type' ? ' selected ':''; ?>>Drive Type</option>
                                    <option value="custom_campaign" <?php echo $lead_mining=='custom_campaign' ? ' selected ':''; ?>>Advanced Options</option>
                                </select>
                            </div>
                        </span>
                    </p>
                </div>
                <div style="clear: both;height:10px"></div>
                <h5 class="event_subtext">Past Vehicle Purchase Date Range</h5>
                <div class="reporttype" style="width:50%">
                    <p style="text-align: center;"><label  class="label report_text" style="width: 80%;float:left">
                    <span style="height: 15px; margin-top: 0px; position: relative; color: gray; top: 8px; float: left; margin-left: 20px; margin-right: 20px;">Purchases After: </span>
                    <input type="text" class="input validate[required]" id="daterange_from" name="validation-select" value="<?php echo $past_vehicle_purchase_date_from_range;?>"/></label></p>
                </div>
                <div class="reporttype" style="width:50%">
                    <label  class="label report_text" style="width: 80%;float:left">
                    <span style="height: 15px; margin-top: 0px; position: relative; color: gray; top: 8px; float: left; margin-left: 20px; margin-right: 20px;">And Before: </span>
                    <input type="text" class="input validate[required]" id="daterange_to" name="validation-select" value="<?php echo $past_vehicle_purchase_date_to_range;?>"/></label>
                </div>
                <div style="clear:both"></div>
                
                <div class="reporttype">
                    <label  class="label report_text" style="width: 80%;float:left">
                    <span style="height: 15px; margin-top: 0px; position: relative; color: gray; top: 8px; float: left; margin-left: 20px; margin-right: 20px;">Maximum Invites for Event Fee </span>
                    <input type="text" class="input validate[required]" id="max_invites" name="max_invites" value="<?php if(isset($max_invites)){ echo $max_invites; } ?>"/></label>
                </div>
                <div style="clear:both"></div>
                <p class="button-height inline-label" style="display: none;">
                    <label class="label">To</label>
<!--                    <select id="daterange_from" name="validation-select" class="select validate"  style="width: 61px;padding-right: 4px;display:none">
                    <?php
                    for($i=1;$i<=5;$i=$i+0.5){
                    if($past_vehicle_purchase_date_from_range!=''){
                    $selected=$past_vehicle_purchase_date_from_range;
                    }else{
                    $selected='1';
                    }
                    ?>
                        <option value="<?php echo $i?>" <?php echo $i==$selected ? ' selected ':''; ?>><?=$i?></option>
                    <?php
                    }
                    ?>
                    </select>-->
<!--                    <select id="daterange_to" name="validation-select" class="select validate"  style="width: 61px;padding-right: 4px;">
                    <?php
                    for($i=1.5;$i<=6;$i=$i+0.5){
                    if($past_vehicle_purchase_date_to_range!=''){
                    $selected=$past_vehicle_purchase_date_to_range;
                    }else{
                    $selected='1.5';
                    }
                    ?>
                        <option value="<?php echo $i?>" <?php echo $i==$selected ? ' selected ':''; ?>><?=$i?></option>
                    <?php
                    }
                    ?>
                    </select>-->
<!--                <label style="color: gray; font-weight: bold;">Years Ago</label>-->
                </p>
            
            </div>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" onclick="configuredcampaign();validation();">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                <label id="showsteps">Step 2 of 2</label> 
            </button>
        </fieldset>
        <fieldset style="width:100%"  id="steptwo" class="steptwo">
            <?php
            $get_group1=$this->settings_model->getgroupname_advanced_option_report_type($event_insert_id,'1'); 
            $get_group2=$this->settings_model->getgroupname_advanced_option_report_type($event_insert_id,'2'); 
            $get_group3=$this->settings_model->getgroupname_advanced_option_report_type($event_insert_id,'3'); 
            $get_group4=$this->settings_model->getgroupname_advanced_option_report_type($event_insert_id,'4'); 
            $get_group5=$this->settings_model->getgroupname_advanced_option_report_type($event_insert_id,'5'); 
            if($get_group1!=''){
                $first_tab=$get_group1;
            }
            else{
              $first_tab='vehicle_class';  
            }
           ?>
            <div  class="standard-tabs margin-bottom" id="add-tabs">
                <ul class="tabs">
                    <li class="active" id="selecttab1"><a href="javascript:(void)" onclick="select_tab('tab1','<?php echo $get_group1?>');">1st Lead Group</a></li>
                    <li id="selecttab2"> <a href="javascript:void(0);" onclick="select_tab('tab2','<?php echo $get_group2?>');"> 2nd Lead Group</a></li>
                    <li id="selecttab3"><a href="javascript:(void(0);" onclick="select_tab('tab3','<?php echo $get_group3?>');">3rd Lead Group</a></li>
                    <li id="selecttab4"><a href="javascript:void(0);" onclick="select_tab('tab4','<?php echo $get_group4?>');">4th Lead Group</a></li>
                    <li id="selecttab5"><a href="javascript:void(0);" onclick="select_tab('tab5','<?php echo $get_group5?>');">5th Lead Group</a></li>
                </ul>
                <!--tab1-->
                <style>
                .report_text{
                    text-align: left;
                    padding-top: 0px;
                }
                </style>
                <input type="hidden" value="1" id="group1" />
                <input type="hidden" value="" id="group2" />
                <input type="hidden" value="" id="group3" />
                <input type="hidden" value="" id="group4"/>
                <input type="hidden" value="" id="group5"/>
                <input type="hidden" value="" id="editgroup1" />
                <input type="hidden" value="" id="editgroup2" />
                <input type="hidden" value="" id="editgroup3" />
                <input type="hidden" value="" id="editgroup4"/>
                <input type="hidden" value="" id="editgroup5"/>
                <div class="tabs-content" style="float: left;" id="tab-1">
                <input id="report_incomplete_select" value="" type="hidden"/>
                <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                    <label  class="reportlabel"><h4>1st Group Report Type</h4></label>
                    <?php
                    $vehicle_class='';
                    $report_type='';
                      $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_insert_id,1);
                      if(isset($get_selected_options) && $get_selected_options!='')
                      {
                      foreach($get_selected_options as $values){
                        $report_type=$values['report_type'];
                        if($report_type=='vehicle_class'){ 
                            $vehicle_class= 'checked';
                            }
                            
                        }
                        }
                        if($report_type=='') { 
                            $vehicle_class= 'checked' ;
                            }
                    ?>
                        <div class="reporttype">
                            <label class="label report_text" ><input type="radio" name="report" value="vehicle_class" style="width: 31px;float: left;" id="user_report_vehicle_class1" onclick="showreportchangevalue(this.value,1)" class="report_type" <?php echo $vehicle_class?>/>Vehicle Model Class</label>
                        </div>
                        <div class="reporttype"> 
                            <label  class="label report_text"><input type="radio" name="report" value="drive_type" style="width: 31px;float: left;" <?php if($report_type=='drive_type'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type" id="user_report"/>Tranny Drive Type</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="fuel_economy" style="width: 31px;float: left;" <?php if($report_type=='fuel_economy'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Fuel Economy Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="trade_in_value" style="width: 31px;float: left;" <?php if($report_type=='trade_in_value'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Trade In Value Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="out_warranty" style="width: 31px;float: left;" <?php if($report_type=='out_warranty'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Vehicle Warranty Status</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" style="width: 80%;float:left">
                            <input type="radio" name="report" value="finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,1)" <?php if($report_type=='finance_rate'){ echo ' checked';}else{ }?> class="report_type"/>Loan APR Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="monthly_payment" style="width: 31px;float: left;" <?php if($report_type=='monthly_payment'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text"  ><input type="radio" name="report" value="specific_model" style="width: 31px;float: left;" <?php if($report_type=='specific_model'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Specific Make/Model Pull</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="power_focus" style="width: 31px;float: left;" <?php if($report_type=='power_focus'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Performance Vehicles</label>
                        </div>
                    
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="fuel_type" style="width: 31px;float: left;" <?php if($report_type=='fuel_type'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report" value="local_town" style="width: 31px;float: left;" <?php if($report_type=='local_town'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,1)" class="report_type"/>Local/Out of Town Customers</label>
                        </div>
                        <div class="reporttype">
                            <label class="label report_text" style="line-height: 16px;"><input type="radio" name="report" value="used_new_purchaser" <?php if($report_type=='used_new_purchaser'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" class="report_type" onclick="showreportchangevalue(this.value,1)"/>Used vs. New Purchases</label>
                        </div>
                        <div class="reporttype">
                            <label class="label report_text" ><input type="radio" name="report" value="dealership_brand" style="width: 31px;float: left;" <?php if($report_type=='dealership_brand'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,1)"/>Used, Non-OEM Purchasers</label>
                        </div>
                        <div class="reporttype">
                            <label class="label report_text" ><input type="radio" name="report" value="equity_scrapper" style="width: 31px;float: left;" <?php if($report_type=='equity_scrapper'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,1)"/>Equity Scrape</label>
                        </div>
                    </div>
            <script>
            $( document ).ready(function() {
            calluserreport('tab1',1,'<?php echo $get_group1?>','');
            showreportchangevalue('<?php echo $first_tab?>',1); 
            });
            </script>
          
            <div  class="newvechicle_div1"></div>
        </div> 
            <!--tab1-->
            <!--tab2-->
            <div id="tab-2" class="tabs-content"  style="float: left;display: none;">
                <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                    <label  class="reportlabel"><h4>2nd Group Report Type</h4></label>
                     <?php
                  $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_insert_id,2);
                  $report_type='';
                  if(isset($get_selected_options) && $get_selected_options!='')
                  {
                      foreach($get_selected_options as $values){
                        $report_type=$values['report_type'];
                      }
                  }
    
                ?>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_2" value="vehicle_class"  <?php if($report_type=='vehicle_class'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,2)" class="report_type" id="user_report_vehicle_class2" checked/>Vehicle Model Class</label>
                    </div>
                    <div class="reporttype"> 
                        <label  class="label report_text"><input type="radio" name="report_2" value="drive_type" style="width: 31px;float: left;" <?php if($report_type=='drive_type'){ echo ' checked';}else{ }?>  onclick="showreportchangevalue(this.value,2)" class="report_type" id="user_report"/> Tranny Drive Type</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="fuel_economy" style="width: 31px;float: left;"  <?php if($report_type=='fuel_economy'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Fuel Economy Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="trade_in_value" style="width: 31px;float: left;" <?php if($report_type=='trade_in_value'){ echo ' checked';}else{ }?>  onclick="showreportchangevalue(this.value,2)" class="report_type"/>Trade In Value Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="out_warranty" style="width: 31px;float: left;" <?php if($report_type=='out_warranty'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Vehicle Warranty Status</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" style="width: 80%;float:left">
                        <input type="radio" name="report_2" value="finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,2)" <?php if($report_type=='finance_rate'){ echo ' checked';}else{ }?>  class="report_type"/>Loan APR Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="monthly_payment" style="width: 31px;float: left;" <?php if($report_type=='monthly_payment'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Monthly Payment Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text"  ><input type="radio" name="report_2" value="specific_model" style="width: 31px;float: left;" <?php if($report_type=='specific_model'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Specific Make/Model Pull</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="power_focus" style="width: 31px;float: left;" <?php if($report_type=='power_focus'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Performance Vehicles</label>
                    </div>
                    
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="fuel_type" style="width: 31px;float: left;" <?php if($report_type=='fuel_type'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Fuel Type</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_2" value="local_town" style="width: 31px;float: left;" <?php if($report_type=='local_town'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,2)" class="report_type"/>Local/Out of Town Customers</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" style="line-height: 16px;"><input type="radio" name="report_2" value="used_new_purchaser" <?php if($report_type=='used_new_purchaser'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" class="report_type" onclick="showreportchangevalue(this.value,2)"/>Used vs. New Purchases</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_2" value="dealership_brand" style="width: 31px;float: left;"  <?php if($report_type=='dealership_brand'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,2)"/>Used, Non-OEM Purchasers</label>
                    </div>
                        <div class="reporttype">
                            <label class="label report_text" ><input type="radio" name="report_2" value="equity_scrapper" style="width: 31px;float: left;" <?php if($report_type=='equity_scrapper'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,2)"/>Equity Scrape</label>
                        </div>
                </div>
                <div style="float: right; width: 58%;margin-top: 10px;" class="vechicle_div">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        
                    </p>
                <div style="clear: both;"></div>
                <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                    <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                        <label for="small-label-1" class="label showlabel"></label>
                        <div style="clear: both;"></div>
                        <div id="vechicle_class_option" class="vechicle_class_option_show">
                            <select id="vehicle_class" name="vehicle_class[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                <option value="full_size_cars">Full-size Cars</option>
                                <option value="mid_size_cars">Mid-size Cars </option>
                                <option value="small_cars">Small Cars</option>
                                <option value="suvs">SUVs</option>
                                <option value="crossovers">Crossovers</option>
                                <option value="trucks">Trucks</option>
                                <option value="vans">Vans</option>
                                <option value="green_cars">Green Vehicles</option>
                                <option value="two_seater_cars">Two Seater Cars</option>
                                <option value="green_cars">Unknown</option>
                            </select>
                        </div>
                    </p>
                <div style="clear: both;height: 4px;"></div>
                <div style="height: 20px;float: left;">&nbsp;</div>
            </div>
            <div  class="newvechicle_div2"></div>
            </div>
            <!--tab2-->
            <!--tab3-->
            <div id="tab-3" class="tabs-content"  style="float: left;display: none;">
                <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                    <label  class="reportlabel"><h4>3rd Group Report Type</h4></label>
                <?php
                  $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_insert_id,3);
                  if(isset($get_selected_options) && $get_selected_options!='')
                  {
                      foreach($get_selected_options as $values){
                        $report_type=$values['report_type'];
                      }
                  }
                    ?>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_3" value="vehicle_class" <?php if($report_type=='vehicle_class'){ echo ' checked';}else{ }?>  style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type" id="user_report_vehicle_class3" checked/>Vehicle Model Class</label>
                    </div>
                    <div class="reporttype"> 
                        <label  class="label report_text"><input type="radio" name="report_3" value="drive_type" <?php if($report_type=='drive_type'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type" id="user_report"/> Tranny Drive Type</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="fuel_economy" <?php if($report_type=='fuel_economy'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Fuel Economy Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="trade_in_value"  <?php if($report_type=='trade_in_value'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Trade In Value Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="out_warranty" <?php if($report_type=='out_warranty'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Vehicle Warranty Status</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" style="width: 80%;float:left">
                        <input type="radio" name="report_3" value="finance_rate" <?php if($report_type=='finance_rate'){ echo ' checked';}else{ }?>  style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,3)"  class="report_type"/>Loan APR Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="monthly_payment" <?php if($report_type=='monthly_payment'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Monthly Payment Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text"  ><input type="radio" name="report_3" value="specific_model" <?php if($report_type=='specific_model'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Specific Make/Model Pull</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="power_focus" <?php if($report_type=='power_focus'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Performance Vehicles</label>
                    </div>
                
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="fuel_type" <?php if($report_type=='fuel_type'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,3)" class="report_type"/>Fuel Type</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_3" value="local_town" style="width: 31px;float: left;" <?php if($report_type=='local_town'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,3)" class="report_type"/>Local/Out of Town Customers</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" style="line-height: 16px;"><input type="radio" name="report_3" value="used_new_purchaser" <?php if($report_type=='used_new_purchaser'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" class="report_type" onclick="showreportchangevalue(this.value,3)"/>Used vs. New Purchases</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_3" value="dealership_brand" style="width: 31px;float: left;" <?php if($report_type=='dealership_brand'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,3)"/>Used, Non-OEM Purchasers</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_3" value="equity_scrapper" style="width: 31px;float: left;" <?php if($report_type=='equity_scrapper'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,3)"/>Equity Scrape</label>
                    </div>
                </div>
                <div style="float: right; width: 58%;margin-top: 10px;" class="vechicle_div">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                    
                    </p>
                <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                    <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                        <label for="small-label-1" class="label showlabel"></label>
                        <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                                <select id="vehicle_class" name="vehicle_class[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                    <option value="full_size_cars">Full-size Cars</option>
                                    <option value="mid_size_cars">Mid-size Cars </option>
                                    <option value="small_cars">Small Cars</option>
                                    <option value="suvs">SUVs</option>
                                    <option value="crossovers">Crossovers</option>
                                    <option value="trucks">Trucks</option>
                                    <option value="vans">Vans</option>
                                    <option value="green_cars">Green Vehicles</option>
                                </select>
                            </div>
                    </p>
                <div style="clear: both;height: 4px;"></div>
                <div style="height: 20px;float: left;">&nbsp;</div>
            </div>
            <div  class="newvechicle_div3"></div>
        </div>
            <!--tab3-->
            <!--tab4-->
            <div id="tab-4" class="tabs-content"  style="float: left;display: none;">
                <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                <label  class="reportlabel"><h4>4th Group Report Type</h4></label>
                    <div class="reporttype">
                     <?php
                  $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_insert_id,4);
                  if(isset($get_selected_options) && $get_selected_options!='')
                  {
                      foreach($get_selected_options as $values){
                        $report_type=$values['report_type'];
                      }
                  }
                    ?>
                        <label class="label report_text" ><input type="radio" name="report_4" value="vehicle_class"   <?php if($report_type=='vehicle_class'){ echo ' checked';}else{ }?>  style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,4)" class="report_type" id="user_report_vehicle_class4" checked/>Vehicle Model Class</label>
                    </div>
                    <div class="reporttype"> 
                        <label  class="label report_text"><input type="radio" name="report_4" value="drive_type" <?php if($report_type=='drive_type'){ echo ' checked';}else{ }?>  style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,4)" class="report_type" id="user_report"/> Tranny Drive Type</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="fuel_economy" <?php if($report_type=='fuel_economy'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,4)" class="report_type"/>Fuel Economy Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="trade_in_value" <?php if($report_type=='trade_in_value'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,4)" class="report_type"/>Trade In Value Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="out_warranty" <?php if($report_type=='out_warranty'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,4)" class="report_type"/>Vehicle Warranty Status</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" style="width: 80%;float:left">
                        <input type="radio" name="report_4" value="finance_rate" style="width: 31px;float: left;" <?php if($report_type=='finance_rate'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,4)"  class="report_type"/>Loan APR Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="monthly_payment" <?php if($report_type=='monthly_payment'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,4)" class="report_type"/>Monthly Payment Range</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text"  ><input type="radio" name="report_4" value="specific_model"<?php if($report_type=='specific_model'){ echo ' checked';}else{ }?>  style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,4)" class="report_type"/>Specific Make/Model Pull</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="power_focus" <?php if($report_type=='power_focus'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,4)" class="report_type"/>Performance Vehicles</label>
                    </div>
                
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="fuel_type" <?php if($report_type=='fuel_type'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,4)" class="report_type"/>Fuel Type</label>
                    </div>
                    <div class="reporttype">
                        <label  class="label report_text" ><input type="radio" name="report_4" value="local_town" style="width: 31px;float: left;"  <?php if($report_type=='local_town'){ echo 'checked';}else{ }?>  onclick="showreportchangevalue(this.value,4)" class="report_type"/>Local/Out of Town Customers</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" style="line-height: 16px;"><input type="radio" name="report_4" value="used_new_purchaser" <?php if($report_type=='used_new_purchaser'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" class="report_type" onclick="showreportchangevalue(this.value,4)"/>Used vs. New Purchases</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_4" value="dealership_brand" style="width: 31px;float: left;" <?php if($report_type=='dealership_brand'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,4)"/>Used, Non-OEM Purchasers</label>
                    </div>
                    <div class="reporttype">
                        <label class="label report_text" ><input type="radio" name="report_4" value="equity_scrapper" style="width: 31px;float: left;" <?php if($report_type=='equity_scrapper'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,4)"/>Equity Scrape</label>
                    </div>
                </div>
                <div style="float: right; width: 58%;margin-top: 10px;" class="vechicle_div">
                    <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                        <label for="small-label-1" class="label">Description</label>
                        <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        
                    </p>
                    <div style="clear: both;"></div>
                    <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                    <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                        <label for="small-label-1" class="label showlabel"></label>
                        <div style="clear: both;"></div>
                        <div id="vechicle_class_option" class="vechicle_class_option_show">
                            <select id="vehicle_class" name="vehicle_class[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                <option value="full_size_cars">Full-size Cars</option>
                                <option value="mid_size_cars">Mid-size Cars </option>
                                <option value="small_cars">Small Cars</option>
                                <option value="suvs">SUVs</option>
                                <option value="crossovers">Crossovers</option>
                                <option value="trucks">Trucks</option>
                                <option value="vans">Vans</option>
                                <option value="green_cars">GGreen Vehicles</option>
                            </select>
                        </div>
                    </p>
                    <div style="clear: both;height: 4px;"></div>
                    <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
                <div  class="newvechicle_div4"></div>
            </div>
                <!--tab4-->
                <!--tab5-->
                <div id="tab-5" class="tabs-content"  style="float: left;display: none;">
                    <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                        <label  class="reportlabel"><h4>5th Group Report Type</h4></label>
                        <div class="reporttype">
                         <?php
                  $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_insert_id,5);
                  if(isset($get_selected_options) && $get_selected_options!='')
                  {
                      foreach($get_selected_options as $values){
                        $report_type=$values['report_type'];
                      }
                  }
                    ?>
                            <label class="label report_text" ><input type="radio" name="report_5" value="vehicle_class" <?php if($report_type=='vehicle_class'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,5)" class="report_type" id="user_report_vehicle_class5" checked/>Vehicle Model Class</label>
                        </div>
                        <div class="reporttype"> 
                            <label  class="label report_text"><input type="radio" name="report_5" value="drive_type" <?php if($report_type=='drive_type'){ echo ' checked';}else{ }?> style="width: 31px;float: left;" onclick="showreportchangevalue(this.value,5)" class="report_type" id="user_report"/> Tranny Drive Type</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="fuel_economy" <?php if($report_type=='fuel_economy'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Fuel Economy Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="trade_in_value" <?php if($report_type=='trade_in_value'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Trade In Value Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="out_warranty" <?php if($report_type=='out_warranty'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Vehicle Warranty Status</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" style="width: 80%;float:left">
                            <input type="radio" name="report_5" value="finance_rate" style="width: 31px;float: left;" <?php if($report_type=='finance_rate'){ echo ' checked';}else{ }?> onclick="showreportchangevalue(this.value,5)"  class="report_type"/>Loan APR Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="monthly_payment" <?php if($report_type=='monthly_payment'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text"  ><input type="radio" name="report_5" value="specific_model" <?php if($report_type=='specific_model'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Specific Make/Model Pull</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="power_focus" <?php if($report_type=='power_focus'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Performance Vehicles</label>
                        </div>
                    
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="fuel_type" <?php if($report_type=='fuel_type'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            <label  class="label report_text" ><input type="radio" name="report_5" value="local_town" <?php if($report_type=='local_town'){ echo ' checked';}else{ }?> style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value,5)" class="report_type"/>Local/Out of Town Customers</label>
                        </div>
                        <div class="reporttype">
                            <label class="label report_text" style="line-height: 16px;"><input type="radio" name="report_5" value="used_new_purchaser" <?php if($report_type=='used_new_purchaser'){ echo ' checked';}else{ }?>  style="width: 31px;float: left;" class="report_type" onclick="showreportchangevalue(this.value,5)"/>Used vs. New Purchases</label>
                        </div>
                        <div class="reporttype">
                            <label class="label report_text" ><input type="radio" name="report_5" value="dealership_brand" style="width: 31px;float: left;"  <?php if($report_type=='dealership_brand'){ echo ' checked';}else{ }?>class="report_type" onclick="showreportchangevalue(this.value,5)"/>Used, Non-OEM Purchasers</label>
                        </div>
                        <div class="reporttype">
                            <label class="label report_text" ><input type="radio" name="report_5" value="equity_scrapper" style="width: 31px;float: left;" <?php if($report_type=='equity_scrapper'){ echo ' checked';}else{ }?> class="report_type" onclick="showreportchangevalue(this.value,5)"/>Equity Scrape</label>
                        </div>
                </div>
                <div style="float: right; width: 58%;margin-top: 10px;" class="vechicle_div">
                <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                    <label for="small-label-1" class="label">Description</label>
                    <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                
                </p>
                <div style="clear: both;"></div>
                <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                    <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                        <label for="small-label-1" class="label showlabel"></label>
                        <div style="clear: both;"></div>
                            <div id="vechicle_class_option" class="vechicle_class_option_show">
                                <select id="vehicle_class" name="vehicle_class[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                                    <option value="full_size_cars">Full-size Cars</option>
                                    <option value="mid_size_cars">Mid-size Cars </option>
                                    <option value="small_cars">Small Cars</option>
                                    <option value="suvs">SUVs</option>
                                    <option value="crossovers">Crossovers</option>
                                    <option value="trucks">Trucks</option>
                                    <option value="vans">Vans</option>
                                    <option value="green_cars">Green Vehicles</option>
                                </select>
                            </div>
                    </p>
                <div style="clear: both;height: 4px;"></div>
                <div style="height: 20px;float: left;">&nbsp;</div>
                </div>
            <div  class="newvechicle_div5"></div>
        </div>
            <!--tab5-->
            </div>
        <button type="button" class="previous  button glossy mid-margin-right" value="Previous" >
        <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
        Previous
        </button>
        <button type="button" class="next  button glossy mid-margin-right" value="Next" onclick="insert_report();">
        <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
        Step 2 of 3
        </button>
        </fieldset>
        <fieldset id="stepthree" class="stepthree">
        <label style="color: grey;"><h4>Fill in the boxes below with current info related to your dealership and auto manufactures current rebates, interest rates and other factors.</h4> </label>
            <p class="inline-small-label button-height" style="margin-top: 13px;">
                <label for="small-label-1" class="label">Manufacturer Interest Rate:</label>
                <input type="text" name="manufacurer_interesr_rate" id="last_name" class="input small-margin-right" value="<?php echo $manufacurer_interesr_rate?>"/><label style="width: 20px;float:left;margin-top:3px; ;"><a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Tell us the current Manufacturer Interest Rate you have. If you have multiple rates for different vehicles you can enter the vehicle name and rate here. Separate with commas for multiple rates</span></a></label>
            </p>
            <div style="clear: both;height:10px"></div>
            <p class="inline-small-label button-height">
                <label for="small-label-1" class="label">Best Sub-Prime Rate</label>
                <input type="text" name="best_sub_prime_rate" id="last_name" class="input small-margin-right" value="<?php echo $best_sub_prime_rate?>"/><label style="width: 20px;float:left;margin-top:3px; ;"><a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">What's the subprime rate you currently have?</span></a></label>
            </p>
            <div style="clear: both;height:10px"></div>
            <p class="inline-small-label button-height">
                <label for="small-label-1" class="label">Factory Rebate</label>
                <input type="text" name="factory_rebate" id="last_name" class="input small-margin-right" value="<?php echo $factory_rebate?>"/><label style="width: 20px;float:left;margin-top:3px; ;"><a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Any special rebates from the factory that you want us to use in the invites? Details are appreciated. (ie. Recent Grad Discount of $1000 on new vehicle purchases)</span></a></label>
            </p>
            <div style="clear: both;height:10px"></div>
            <p class="inline-small-label button-height">
                <label for="small-label-1" class="label">Dealership Incentives: </label>
                <input type="text" name="dealership_incentives" id="last_name" class="input small-margin-right" value="<?php echo $dealership_incentives?>"/><label style="width: 20px;float:left;margin-top:3px; ;"><a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Any inhouse specials you want your invitees to know about? Tell us about any manager specials, lot specials, etc.</span></a></label>
            </p>
            <div style="clear: both;height:10px"></div>
            <p class="inline-small-label button-height">
                <label for="small-label-1" class="label">Do you have any excess vehicle types that you would like to promote? </label>
                <textarea name="excess_vehicle" id="last_name" class="input small-margin-right"><?php echo $excess_vehicle?></textarea><label style="width: 20px;float:left;margin-top:3px; ;"><a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">AGot a particular vehicle Make/Model that you are trying to push off the lot? Tell us what you want to do and we can use it for the invites.</span></a></label>
            </p>
            <div style="clear: both;height:10px"></div>
            <p class="inline-small-label button-height">
                <label for="small-label-1" class="label">Do you have any special dealership promos that you want us to know about?</label>
                <textarea name="dealership_promos" id="last_name" class="input small-margin-right"><?php echo $dealership_promos?></textarea><label style="width: 20px;float:left;margin-top:3px; ;"><a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Enter any information related to the event that will help bring in more potential customers. Want to have a contest for everything that pre-registers? Tell us here with details on prizes. </span></a></label>
            </p>
        <div style="clear: both;height:10px"></div>
        <div style="clear: both;"></div>
        <button type="button" class="previous  button glossy mid-margin-right" value="Previous" style="float: left;margin-left: 209px;">
            <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
            Previous
        </button>
        <button type="submit" class="submit button glossy mid-margin-right" onclick="validation();" style="float: left;">
            <span class="button-icon"><span class="icon-tick"></span></span>
            Submit
        </button>
    </fieldset>
</form>
</section>
<div style="clear: both;"></div>
<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=base_url()?>css/jquery.ui.css"/>
<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script src="<?=base_url()?>js/jquery.ui.js"></script>
<script>
   var jQ=$.noConflict();
    jQ(function() {   
    var d = new Date('1990', '01', '01', '00', '00', '00', '00');
    d.setDate(d.getDate());
    var startdate = new Date();
    startdate.setDate(startdate.getDate());
    jQ("#daterange_from" ).datepicker({
        maxDate: startdate,
        minDate: d,
        defaultDate: "1d",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        onClose: function( selectedDate ) {
            var nextDay = new Date(selectedDate);
            nextDay.setDate(nextDay.getDate() + 1);
            jQ("#daterange_to" ).datepicker( "option", "minDate", nextDay );
        }
    });
    jQ("#daterange_from").click(function() {
        jQ( "#daterange_to" ).datepicker({
        maxDate: startdate,
        minDate: d,
        defaultDate: "1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
            onClose: function( selectedDate ) {
            jQ("#daterange_from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
 });
$( document ).ready(function() {   
    //jQuery time
    var leadmining=$('#configuredcamp').val(); 
    if(leadmining=='custom_campaign'){
        $("#progressbar").show();
        $("#progressbar1").hide();
    
    }
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    $(".next").click(function(){
    var configuredcamp=$('#configuredcamp').val();
        if(configuredcamp=='custom_campaign')
        { 
        }
        else
        {
            $( "#steptwo" ).remove();
        }
    $('#select_campine').val(configuredcamp); 
    var selected_campaine=$('#select_campine').val();
    if(selected_campaine=='custom_campaign' )
    {  
        $.post('<?=base_url()?>settings/selectcampaine',{select_campaine : $('#select_campine').val()},function(data){
        });
        $('.processbar-custom-campaine').show();
        $('.processbar-campaine').hide();
    }
    else
    {
        $('.processbar-campaine').show();
        $('.processbar-custom-campaine').hide();
    }
    if(animating) return false;
    animating = true;
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    $("#progressbar1 li").eq($("fieldset").index(next_fs)).addClass("active");
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'transform': 'scale('+scale+')'});
            next_fs.css({'left': left, 'opacity': opacity});
            }, 
        duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
        });
    });
        $(".previous").click(function(){
        if(animating) return false;
        animating = true;
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        //de-activate current step on progressbar
        
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        $("#progressbar1 li").eq($("fieldset").index(current_fs)).removeClass("active");
        //show the previous fieldset
        previous_fs.show(); 
        //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
            current_fs.hide();
            animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
            });
        });
    });
</script>
<script src="<?=base_url()?>js/developr.tabs.js"></script>		<!-- Must be loaded last -->
<script>
// Call template init (optional, but faster if called manually)
// Tabs adding/removing
var tabsAdded = [];
// Add a tab
function addTab()
    {
        // New tab id
        var tabId = 'new-tab'+tabsAdded.length;
        // Register tab
        tabsAdded.push(tabId);
        // Create
        $('#add-tabs').addTab(tabId, 'New tab '+tabsAdded.length, 'Content of dynamically added tab');
    };
// Remove dynamically created tabs
function removeTabs()
    {
        var tabId;
        while (tabsAdded.length > 0)
        {
        $('#'+tabsAdded.pop()).removeTab();
        }
    };
function changesecondtabs(){
        $('#steptwo').show();
        $('#stepthree').hide();
        $('#stepfour').hide();
        $('#stepfirst').hide();
        $('#steptwolist').addClass("active");
        $('#stepthreelist').removeClass("active");
        $('#stepfourlist').removeClass("active");
        $('#stepfirstlist').addClass("active");
        $("#steptwo").css({'opacity':1, 'transform':'scale(1)'});
    }
function changefirsttabs(){
    $('#steptwo').hide();
    $('#stepthree').hide();
    $('#stepfour').hide();
    $('#stepfirst').show();
    $('#stepfirstlist').addClass("active");
    $('#stepthreelist').removeClass("active");
    $('#steptwolist').removeClass("active");
    $('#stepfourlist').removeClass("active");
    $("#stepfirst").css({'opacity':1, 'transform':'scale(1)'});
}
function changethirdtabs(){
   
    $('#steptwo').hide();
    $('#stepfirst').hide();
    $('#stepfour').hide();
    $('#stepthree').show();
    $('#stepthreelist').addClass("active");
    $('#stepfirstlist').addClass("active");
    $('#steptwolist').addClass("active");
    $('#stepfourlist').removeClass("active");
    $("#stepthree").css({'opacity':1, 'transform':'scale(1)'});
    
}
function changefourthtabs(){
    $('#steptwo').hide();
    $('#stepfirst').hide();
    $('#stepthree').hide();
    $('#stepfour').show();
    $('#stepfourlist').addClass("active");
    $('#stepthreelist').addClass("active");
    $('#stepfirstlist').addClass("active");
    $('#steptwolist').addClass("active");
    $("#stepfour").css({'opacity':1, 'transform':'scale(1)'});
}
function changesecondtabscampine(){
    $('.stepthree').show();
    $('.stepfour').hide();
    $('.stepfirst').hide();
    $('#stepfirstlistcampine').addClass("active");
    $('#steptwolistcampine').addClass("active");
    $('#stepthreelistcampine').removeClass("active");
    $(".stepthree").css({'opacity':1, 'transform':'scale(1)'});
}
function changefirsttabscampine(){
    $('.steptwo').hide();
    $('.stepfirst').show();
    $('.stepthree').hide();
    $('#stepfirstlistcampine').addClass("active");
    $('#steptwolistcampine').removeClass("active");
    $('#stepthreelistcampine').removeClass("active");
    $(".stepfirst").css({'opacity':1, 'transform':'scale(1)'});
}
function changethirdtabscampine(){
    $('.stepthree').hide();
    $('.stepfirst').hide();
    $('.stepfour').show();
    $('#stepfirstlistcampine').addClass("active");
    $('#steptwolistcampine').addClass("active");
    $('#stepthreelistcampine').addClass("active");
    $(".stepfour").css({'opacity':1, 'transform':'scale(1)'});
}
function configuredcampaign(){
var campaign=$('#configuredcamp').val();
    if(campaign==''){
    $( "#configuredcamp" ).removeClass( "select validate[required]" );
    $("#stepthreelistcampine").hide();
        }else{
        if(campaign=='custom_campaign'){
        $('#steptwo').show();
        $("#stepthreelistcampine").show()
            }else{
        $('#stepthree').show(); 
        $("#stepthreelistcampine").hide(); 
        }
    }
var configuredcamp=$('#configuredcamp').val();
var daterange_from=$('#daterange_from').val();
var daterange_to=$('#daterange_to').val();
var max_invites=$('#max_invites').val();
var event_insert_id=$('#event_insert_id').val();

    $.ajax({
    url: "<?php echo base_url()?>campaign/epsadvantage_campaign_fiststep",
    data: 'configuredcamp=' + configuredcamp + '&daterange_from=' + daterange_from+ '&daterange_to=' + daterange_to+ '&max_invites=' + max_invites+ '&event_insert_id=' + event_insert_id,
    type: "POST",
        success: function(data){
        $('#campaine_insert_id').val(data);
        $('#campaine_step1_select').addClass("submenusselction");
        $('#campaine_step1_select').removeClass("submenusunselectionselction");
        $('#campaine_step1_select_advanced').addClass("submenusselction");
        $('#campaine_step1_select_advanced').removeClass("submenusunselectionselction");
        
        }
    
    }); 

}
function insert_report(){
  var campaine_insert_id=$('#campaine_insert_id').val();
    var report_type=$('[name=report]:checked').val();
    var field_val=$('#report_field').val();
    if(report_type=='vehicle_class'){
            var report_fieldname = $('#report_vehicle_class').val();
            var report_fieldname1 ='';
    }else if(report_type=='drive_type'){
            var report_fieldname = $('#drive_type').val();
            var report_fieldname1 ='';
    }else if(report_type=='fuel_economy'){
            var report_fieldname = $('#fuel_economy_from').val();
            var report_fieldname1 = $('#fuel_economy_to').val();
    }
    else if(report_type=='trade_in_value'){
            var report_fieldname = $('#trade_in_value_from').val();
            var report_fieldname1 = $('#trade_in_value_to').val();
    }
    else if(report_type=='finance_rate'){
            var report_fieldname = $('#monthly_payment_from').val();
            var report_fieldname1 = $('#monthly_payment_to').val();
    }else if(report_type=='fuel_type'){
            var report_fieldname=$('[name=fuel_type]:checked').val();
            var report_fieldname1 = $('#fuel_vehicle_class').val();
    }
    else if(report_type=='local_town'){
            var report_fieldname=$('[name=local_town]:checked').val();
            var report_fieldname1 = $('#town_vehicle_class').val();
    }
    else if(report_type=='used_new_purchaser'){
            var report_fieldname=$('[name=used_new_purchaser]:checked').val();
            var report_fieldname1 = $('#purchase_vechicle_class').val();
    }
    else if(report_type=='power_focus'){
            var report_fieldname = $('#power_vechicle_class').val();
            var report_fieldname1 = '';
    }
    else if(report_type=='monthly_payment'){
            var report_fieldname = $('#monthly_payment_from_id').val();
            var report_fieldname1 = $('#monthly_payment_to_id').val();
    }
    else if(report_type=='equity_scrapper'){
            var report_fieldname = $('#equity_vehicle_class').val();
            var report_fieldname1 = $('#oem_incentive').val();
            var report_fieldname2 = $('#equity_apr_from').val();
            var report_fieldname3 = $('#equity_apr_to').val();
            var report_fieldname4 = $('#equity_options').val();
    }
    var event_insert_id=$('#event_insert_id').val();
    $.ajax({
        
        url: "<?php echo base_url()?>campaign/epsadvantage_campaign_advanced_option",
        data: 'report_type=' + report_type + '&event_insert_id=' + event_insert_id,
        type: "POST",
        success: function(data){
            $('#campaine_step2').addClass("submenusselction");
            $('#campaine_step2').removeClass("submenusunselectionselction");
        }
    
    });
    var group_1=$('#group1').val();  
    var group_2=$('#group2').val(); 
    var group_3=$('#group3').val(); 
    var group_4=$('#group4').val(); 
    var group_5=$('#group5').val();
    if(group_1!=''){
        insert_advance_options('report',1);  
    }
    if(group_2!=''){
        insert_advance_options('report_2',2);  
    }
    if(group_3!=''){
        insert_advance_options('report_3',3);  
    }
    if(group_4!=''){
        insert_advance_options('report_4',4);  
    }
    if(group_5!=''){
        insert_advance_options('report_5',5);  
    }
    
    }
</script>
<script>
function validation()
    {
    // Call template init (optional, but faster if called manually)
    $( "#configuredcamp" ).addClass( "select validate[required]" );
    // Color
    $('#anthracite-inputs').change(function()
        {
            $('#main')[this.checked ? 'addClass' : 'removeClass']('black-inputs');
        });
    // Switches mode
    $('#switch-mode').change(function()
        {
            $('#switch-wrapper')[this.checked ? 'addClass' : 'removeClass']('reversed-switches');
        });
    // Disabled switches
    $('#switch-enable').change(function()
        {
            $('#disabled-switches').children()[this.checked ? 'enableInput' : 'disableInput']();
        });
    // Tooltip menu
        $('#select-tooltip').menuTooltip($('#select-context').hide(), {
            classes: ['no-padding']
        });
    // Form validation
    $('form').validationEngine();
    }
function displaystepdevice(selectedcampine)
    {
    if(selectedcampine=='custom_campaign')
        {
        
            $('.processbar-custom-campaine').show();
            $('.processbar-campaine').hide();
            $('#advancedoption_capaine_select').show();
            $('#advancedoption_capaine_unselection').hide();
            $('#showsteps').html('Step 2 of 3');
        }
    else
        {
            $('.processbar-custom-campaine').hide();
            $('.processbar-campaine').show();
            $('#advancedoption_capaine_select').hide();
            $('#advancedoption_capaine_unselection').show();
            $('#showsteps').html('Step 2 of 2');
        }
    }
</script>

<script type="text/javascript">
function showreportchangevalue(changevalue,id)
    {
        var event_id=$('#event_insert_id').val();
        $.post('<?php echo base_url();?>campaignreporthtml/check_report_type/',{report_value:changevalue,lead_id:<?php echo $lead_id?>,id:id,event_id:event_id},function(data) {
        $(".vechicle_div").hide();
        if(id==1){
        $(".newvechicle_div1").html(data);
        }
        else if(id==2){
         $(".newvechicle_div2").html(data);   
        }
        else if(id==3){
         $(".newvechicle_div3").html(data);   
        }
        else if(id==4){
         $(".newvechicle_div4").html(data);   
        }
        else if(id==5){
         $(".newvechicle_div5").html(data);   
        }
        });
  
    }
function get_report_feild_valuescount(reportname){
if(reportname=='vehicle_class'){
    var field_count='1,report_vehicle_class';  
}
else if(reportname=='drive_type'){
    var field_count='1,drive_type';  
}

else if(reportname=='fuel_economy'){
    var field_count='2,fuel_economy_from,fuel_economy_to';  
}
else if(reportname=='trade_in_value'){
    var field_count='3,trade_in_value_from,trade_in_value_to,tradeinvalue_options';  
}
else if(reportname=='finance_rate'){
    var field_count='2,monthly_payment_from,monthly_payment_to';  
}
else if(reportname=='fuel_type'){
    var field_count='1,fuel_vehicle_class';  
}
else if(reportname=='local_town'){
    var field_count='1,town_vehicle_class';  
}
else if(reportname=='used_new_purchaser'){
    var field_count='1,purchase_vechicle_class';  
}
else if(reportname=='power_focus'){
    var field_count='1,power_vechicle_class';  
}
else if(reportname=='monthly_payment'){
    var field_count='2,monthly_payment_from_id,monthly_payment_to_id';  
}
else if(reportname=='out_warranty'){
    var field_count='1,vehicle_warranty';  
}
else if(reportname=='specific_model'){
    var field_count='2,vehicle_manufacture,vehicle_model';  
}
else if(reportname=='dealership_brand'){
    var field_count='1,dealership_brand';  
}else if(reportname=='equity_scrapper'){
    var field_count='5,equity_vehicle_class,oem_incentive,equity_apr_from,equity_apr_to,equity_options';  
}
return field_count;
}
function get_report_fieldname(reportname){
if(reportname=='vehicle_class'){
    var field_count='';  
}
else if(reportname=='drive_type'){
    var field_count='';  
}
else if(reportname=='fuel_economy'){
    var field_count='2,From,To';  
}
else if(reportname=='trade_in_value'){
    var field_count='2,From,To';  
}
else if(reportname=='finance_rate'){
    var field_count='2,Min,Max';  
}
else if(reportname=='fuel_type'){
    var field_count='1,fuel_type';  
}
else if(reportname=='local_town'){
    var field_count='1,local_town';  
}
else if(reportname=='used_new_purchaser'){
    var field_count='1,used_new_purchaser';  
}
else if(reportname=='power_focus'){
    var field_count='';  
}
else if(reportname=='monthly_payment'){
    var field_count='2,Min,Max';  
}
else if(reportname=='out_warranty'){
    var field_count='';  
}
else if(reportname=='specific_model'){
    var field_count='2,Vehicle Manufacturer,Vehicle Models';  
}
else if(reportname=='dealership_brand'){
    var field_count='1,dealership_brand';  
}else if(reportname=='equity_scrapper'){
    var field_count='5,equity_vehicle_class,oem_incentive,equity_apr_from,equity_apr_to,equity_options';   
}
return field_count;    
}
function select_tab(select_tab,edited_report_type)
{
    var group_1=$('#group1').val();  
    var group_2=$('#group2').val(); 
    var group_3=$('#group3').val(); 
    var group_4=$('#group4').val(); 
    var group_5=$('#group5').val(); 
    var edit_group_1=$('#editgroup1').val();  
    var edit_group_2=$('#editgroup2').val(); 
    var edit_group_3=$('#editgroup3').val(); 
    var edit_group_4=$('#editgroup4').val(); 
    var edit_group_5=$('#editgroup5').val();     
    if(select_tab=='tab2')
        {
            $('#selecttab2').addClass('active');
            $('#selecttab1').removeClass('active');
            $('#selecttab3').removeClass('active');
            $('#selecttab4').removeClass('active');
            $('#selecttab5').removeClass('active');
            $('#tab-1').hide();
            $('#tab-2').show();
            $('#tab-3').hide();
            $('#tab-5').hide();
             
            calluserreport('tab2',group_2,edited_report_type,edit_group_2);
            
        }
    else if(select_tab=='tab3')
        {
            $('#selecttab2').removeClass('active');
            $('#selecttab1').removeClass('active');
            $('#selecttab3').addClass('active');
            $('#selecttab4').removeClass('active');
            $('#selecttab5').removeClass('active');
            $('#tab-1').hide();
            $('#tab-2').hide();
            $('#tab-3').show();
            $('#tab-4').hide();
            $('#tab-5').hide();
          
            calluserreport('tab3',group_3,edited_report_type,edit_group_3);
            
        }
    else if(select_tab=='tab1')
        {
            $('#selecttab2').removeClass('active');
            $('#selecttab1').addClass('active');
            $('#selecttab3').removeClass('active');
            $('#selecttab4').removeClass('active');
            $('#selecttab5').removeClass('active');
            $('#tab-1').show();
            $('#tab-2').hide();
            $('#tab-3').hide();
            $('#tab-4').hide();
            $('#tab-5').hide();
            calluserreport('tab1',group_1,edited_report_type,edit_group_1);
            
        }
    else if(select_tab=='tab4')
        {
            $('#selecttab2').removeClass('active');
            $('#selecttab1').removeClass('active');
            $('#selecttab3').removeClass('active');
            $('#selecttab4').addClass('active');
            $('#selecttab5').removeClass('active');
            $('#tab-1').hide();
            $('#tab-2').hide();
            $('#tab-3').hide();
            $('#tab-4').show();
            $('#tab-5').hide();
            
            calluserreport('tab4',group_4,edited_report_type,edit_group_4);
          
        }
    else if(select_tab=='tab5')
        {
            $('#selecttab2').removeClass('active');
            $('#selecttab1').removeClass('active');
            $('#selecttab3').removeClass('active');
            $('#selecttab4').removeClass('active');
            $('#selecttab5').addClass('active');
            $('#tab-1').hide();
            $('#tab-2').hide();
            $('#tab-3').hide();
            $('#tab-4').hide();
            $('#tab-5').show();
           
            calluserreport('tab5',group_5,edited_report_type,edit_group_5);
             
        }
    }
function calluserreport(tab,group,edited_report_type,edit_group){
   
    if(tab=='tab1')
    {
        id='1';
        var select_report_type=$('input:radio[name=report]:checked').val(); 
         if(edited_report_type!=''){
         $('#editgroup1').val(1);
         if(edited_report_type=='specific_model'){
         showmodel('1');  
         }   
        }
    }
    else if(tab=='tab2')
    {
        id='2';
        var select_report_type=$('input:radio[name=report_2]:checked').val(); 
        if(group==''){
        $('#group2').val(2); 
        
        }
        if(edited_report_type!=''){
         $('#editgroup2').val(2); 
         if(edited_report_type=='specific_model'){
          showmodel('2');  
         }   
        }
    }
    else if(tab=='tab3')
    {
        id='3';
        var select_report_type=$('input:radio[name=report_3]:checked').val(); 
        if(group==''){
        $('#group3').val(3); 
        }
        if(edited_report_type!=''){
         $('#editgroup3').val(3); 
         if(edited_report_type=='specific_model'){
          showmodel('3');  
         }   
        }
    }
    else if(tab=='tab4')
    {
        id='4';
        var select_report_type=$('input:radio[name=report_4]:checked').val(); 
        if(group==''){
        $('#group4').val(4); 
        }
        if(edited_report_type!=''){
          
         $('#editgroup4').val(4); 
         if(edited_report_type=='specific_model'){
          showmodel('4');  
         }   
        }
    }
    else 
    {
        id='5';
        var select_report_type=$('input:radio[name=report_5]:checked').val(); 
        if(group==''){
        $('#group5').val(5); 
        }
        if(edited_report_type!=''){
         $('#editgroup5').val(5);  
         if(edited_report_type=='specific_model'){
          showmodel('5');  
         }  
        }
    }
    if(tab=='tab1')
    {
    if(edited_report_type!=''){
          if(edit_group==''){
          showreportchangevalue(edited_report_type,id); 
    }
    }
    else if(group==''){
    showreportchangevalue(select_report_type,id); 
    }
    else{
    $('.vechicle_div').show();
    }                                    
            if(select_report_type=='vehicle_class'){
            $( '#user_report_vehicle_class'+id).prop( "checked", true );
       }
     }
    else
    {
        $('.vechicle_div').hide(); 
       
         if(edited_report_type!=''){
              if(edit_group==''){
          showreportchangevalue(edited_report_type,id);  
        }  
        }
        else if(group=='' ){
          
        showreportchangevalue(select_report_type,id); 
        }
        if(select_report_type=='vehicle_class'){
        $( ".vehicle_class" ).prop( "checked", true );
        }
        
    }
    
}
function insert_advance_options(reportname,id){
 var status=$('input:radio[name='+reportname+']:checked').val(); 
 var fieldname= get_report_fieldname(status);
 var fieldvalue= get_report_feild_valuescount(status);

 if(fieldvalue!=''){
 var split_value=fieldvalue.split(',');
 if(split_value[0]==1){
    if(status=='out_warranty'){
        var value_get_1=$('input:radio[name='+split_value[1]+']:checked').val();  
    }
    else{
        var value_get_1=$('#'+split_value[1]+id).val(); 
    }
 }
 
 else if(split_value[0]==3){
    var value_get_1=$('#'+split_value[1]+id).val();
    var value_get_2=$('#'+split_value[2]+id).val();
    var value_get_3=$('#'+split_value[3]+id).val();
 
 }else if(split_value[0]==5){
    var value_get_1=$('#'+split_value[1]+id).val();
    var value_get_2=$('#'+split_value[2]+id).val();
    var value_get_3=$('#'+split_value[3]+id).val();
    var value_get_4=$('#'+split_value[4]+id).val();
    var value_get_5=$('#'+split_value[5]+id).val();
 }
 else{
    var value_get_1=$('#'+split_value[1]+id).val();
    var value_get_2=$('#'+split_value[2]+id).val();
    
 }
 }
 if(fieldname!=''){
    var split_value=fieldname.split(',');
    if(split_value[0]==1){
        if((status=='local_town') || (status=='used_new_purchaser') || (status=='fuel_type')){ 
            var feildnameget=$('input:radio[name='+split_value[1]+']:checked').val();
            var feild_name_1=feildnameget;
 }
 else{
       
         var feild_name_1=split_value[1];
}   
 }
 else{
    var feild_name_1=split_value[1];
    var feild_name_2=split_value[2];
 }

 }

var event_id=$('#event_insert_id').val();
$.post('<?php echo base_url();?>campaign/insert_advanceoption_groups/',{report_name:status,value_get_1:value_get_1,value_get_2:value_get_2,value_get_3:value_get_3,feild_name_1:feild_name_1,feild_name_2:feild_name_2,event_id:event_id,id:id},function(data) {
    if(data=='Done'){
    $('#group'+id).val(''); 
    $('#editgroup'+id).val('');   
    }
});    
}
function selectmodel(make,id,model){

$.post('<?php echo base_url();?>campaign/diaplaymode/',{make:make,model:model},function(data) {
 $('#vehicle_model'+id).html(data); 

});   
}
function showmodel(id){
$('#vehicle_manufacture'+id).trigger('change');
}
</script>