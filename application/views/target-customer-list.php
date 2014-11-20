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
</style>
<script>
function togglecheckboxes(master,group){
    var cbarray = document.getElementsByName(group);
    var p=0;
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
    var numberOfChecked = $('.check-equity-scrape:checked').length;
    var numberOfChecked1 = $('.check-model-breakdown:checked').length;
    var numberOfChecked2 = $('.check-fuel-efficiency:checked').length;
    var numberOfChecked3 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    $('#showcountlable').html(numberOfChecked);
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
}
function showcount(){
    var numberOfChecked = $('.check-equity-scrape:checked').length;
    $('#showcountlable').html(numberOfChecked);
    var numberOfChecked1 = $('.check-model-breakdown:checked').length;
    var numberOfChecked2 = $('.check-fuel-efficiency:checked').length;
    var numberOfChecked3 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    $('#showcountlable').html(numberOfChecked);
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
    if($('.check-equity-scrape').is(':checked')){
        $("#equity_check-all-pr1").prop("checked", true);
    }else{
        $("#equity_check-all-pr1").prop("checked", false);
    }
}
//get count function for modelbreake
function togglecheckboxes_modelbreakdown(master,group){
    var cbarray = document.getElementsByName(group);
    var p=0;
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
    var numberOfChecked = $('.check-model-breakdown:checked').length;
    $('#showcountlable_modelbreakdown').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-fuel-efficiency:checked').length;
    var numberOfChecked3 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
}
function showcount_modelbreakdown(){
    var numberOfChecked = $('.check-model-breakdown:checked').length;
    $('#showcountlable_modelbreakdown').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-fuel-efficiency:checked').length;
    var numberOfChecked3 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
    if($('.check-model-breakdown').is(':checked')){
    $("#model-break-down-check-all-pr1").prop("checked", true);
    }else{
    $("#model-break-down-check-all-pr1").prop("checked", false);
    }
}
//get count function for Fuel Efficiency
function togglecheckboxes_fuelefficiency(master,group){
    var cbarray = document.getElementsByName(group);
    var p=0;
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
    var numberOfChecked = $('.check-fuel-efficiency:checked').length;
    $('#showcountlable_fuelefficiency').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
}
function showcount_fuelefficiency(){
    var numberOfChecked = $('.check-fuel-efficiency:checked').length;
    $('#showcountlable_fuelefficiency').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
    if($('.check-fuel-efficiency').is(':checked')){
        $("#fuel-efficiency-check-all-pr1").prop("checked", true);
    }else{
        $("#fuel-efficiency-check-all-pr1").prop("checked", false);
    }
}
//get count function for Warranty Scrape
function togglecheckboxes_warrantyscrape(master,group){
    var cbarray = document.getElementsByName(group);
    var p=0;
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
    var numberOfChecked = $('.check-fuel-warranty-scrape:checked').length;
    $('#showcountlable_warrantyscrape').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-efficiency:checked:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
}
function togglecheckboxes_fuel_efficiency(master,group){
    var cbarray = document.getElementsByName(group);
    var p=0;
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
    var numberOfChecked = $('.check-fuel-report:checked').length;
    $('#showcountlable_report6').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-efficiency:checked:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-warranty-scrape').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
}
function showcount_warrantyscrape(){
    var numberOfChecked = $('.check-fuel-warranty-scrape:checked').length;
    $('#showcountlable_warrantyscrape').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-efficiency:checked:checked').length;
    var numberOfChecked4 = $('.check-custom-campaign:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
    if($('.check-fuel-warranty-scrape').is(':checked')){
        $("#warraent-check-all-pr1").prop("checked", true);
    }else{
        $("#warraent-check-all-pr1").prop("checked", false);
    }
}
//get count function for Custom Campaign
function togglecheckboxes_customcampaign(master,group){
    var cbarray = document.getElementsByName(group);
    var p=0;
    for(var i = 0; i < cbarray.length; i++){
        cbarray[i].checked = master.checked;
    }
    var numberOfChecked = $('.check-custom-campaign:checked').length;
    $('#showcountlable_customcampaign').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-efficiency:checked:checked').length;
    var numberOfChecked4 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
}
function showcount_customcampaign(){
    var numberOfChecked = $('.check-custom-campaign:checked').length;
    $('#showcountlable_customcampaign').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-efficiency:checked:checked').length;
    var numberOfChecked4 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked5 = $('.check-fuel-report:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
    if($('.check-custom-campaign').is(':checked')){
        $("#custom-check-all-pr1").prop("checked", true);
    }else{
        $("#custom-check-all-pr1").prop("checked", false);
    }
}
function showcount_fuel_report(){
    var numberOfChecked = $('.check-fuel-report:checked').length;
    $('#showcountlable_report6').html(numberOfChecked);
    var numberOfChecked1 = $('.check-equity-scrape:checked').length;
    var numberOfChecked2 = $('.check-model-breakdown:checked').length;
    var numberOfChecked3 = $('.check-fuel-efficiency:checked:checked').length;
    var numberOfChecked4 = $('.check-fuel-warranty-scrape:checked').length;
    var numberOfChecked5 = $('.check-custom-campaign:checked').length;
    var totalcustomreport=parseInt(numberOfChecked+numberOfChecked1+numberOfChecked2+numberOfChecked3+numberOfChecked4+numberOfChecked5)
    $('#totalleadget').html(totalcustomreport);
    $('#totalleadget1').html(totalcustomreport);
    if($('.check-fuel-report').is(':checked')){
        $("#fuelreport-check-all-pr1").prop("checked", true);
    }else{
        $("#fuelreport-check-all-pr1").prop("checked", false);
    }
}
function customer_leadlist(){
    if( $('#equity_check-all-pr1').is(':checked')){
        var equity_scrap=$('#equity_check-all-pr1').val();
    }else{
        var equity_scrap='';
    }
    if($("#model-break-down-check-all-pr1").is(':checked')){
        var model_break_down=$('#model-break-down-check-all-pr1').val();
    }else{
        var model_break_down='';
    }
    if($("#fuel-efficiency-check-all-pr1").is(':checked')){
        var fuel_effciency=$('#fuel-efficiency-check-all-pr1').val();
    }else{
        var fuel_effciency='';
    }
    if($("#warraent-check-all-pr1").is(':checked')){
        var wrranty_scrap=$('#warraent-check-all-pr1').val();
    }else{
        var wrranty_scrap='';
    }
    if($("#custom-check-all-pr1").is(':checked')){
        var custom_campain=$('#custom-check-all-pr1').val();
    }else{
        var custom_campain='';
    }
    if($("#fuelreport-check-all-pr1").is(':checked')){
        var fuel_report6=$('#fuelreport-check-all-pr1').val();
    }else{
        var fuel_report6='';
    }
    var lead_mining_presets_select=$('#lead_mining_presets_select').val();
    var event_id=$('#event_id').val();
    event_id
    $.ajax({
        url: "<?php echo base_url()?>campaign/insertcustomer_lead_list",
        data: 'equity_scrap=' + equity_scrap + '&model_break_down=' + model_break_down+ '&fuel_effciency=' + fuel_effciency+ '&wrranty_scrap=' + wrranty_scrap+ '&custom_campain=' + custom_campain+ '&event_id=' + event_id+ '&fuel_report6=' + fuel_report6+ '&lead_mining_presets_select=' + lead_mining_presets_select,
        type: "POST",
        success: function(data){
            if(data=='Done'){
                $('.leadlist').submit();
            }else{
                alert('No customer data found');
                exit();
            }
        }
    });
}
</script>
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<? echo base_url()?>fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<style type="text/css">
.fancybox-inner {
    height: 707px !important;
    width: 470px !important;
}
.fancybox-close
{
    right: -57px;
}
</style>
<script type="text/javascript">
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
<script>
$( document ).ready(function() {
    <?php
    if(isset($editted_step) || $editted_step!=''){
        if($editted_step=='lead_step1'){
        ?>
        $('#viewleadlist').toggle();
        $('#event_date_section').hide();
        <?php
        }
    }
    ?>
});
</script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css"/>
<a href="#" id="open-menu"><span>Menu</span></a>
<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
<!-- Main content -->
<section role="main" id="main" style="margin-left:315px">
    <hgroup id="main-title" class="thin" style="text-align:left;padding-bottom:0px;">
    <h1>Exclusive Private Sale Lead List</h1>
    <?php
    //$value=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data);
    //print_r($value);
    if(isset($dealer_id_upload_data)){
        if($dealer_id_upload_data!=''){
            $dealerid_get=$dealer_id_upload_data;
        }else{
            $dealerid_get='';
        }
    }else{
        $dealerid_get='';
    }
    $lead_mining_presets='';
    $lead_mining_presets=$this -> main_model -> get_lead_mining_presets($event_insert_id);
    $lead_mining_presets_name_get=$this -> settings_model -> get_lead_type_name($lead_mining_presets);
    ?>
    <form action="<?=base_url()?>campaign/mailoutoption/<?=$dealerid_get?>" method="post" style="margin-top: 12px;" class="leadlist">
        <p class="wrapped left-icon icon-info-round"><?php echo $lead_mining_presets_name_get;?>
        <button type="button" class="submit button glossy mid-margin-right" onclick="customer_leadlist();" style="float: right; ">
            <span class="button-icon"><span class="icon-tick"></span></span>
            Confirm
        </button>
        <?php
        $total_count_show=0;
        //$lead_mining_presets_leadlist='model_breakdown';
        $lead_mining_presets_leadlist=$this -> settings_model -> get_lead_mining_presets_leadlist($event_insert_id);
        $customer_leadlist_check=$this -> main_model -> total_leadcount_display($lead_mining_presets,$dealer_id_upload_data,$event_insert_id);
        if(!empty($customer_leadlist_check)){
            $total_count_show=$customer_leadlist_check;
        }else{
            $total_count_show='0';
        }
        ?>
        <span style="float: right;" class="total_leads">Total Leads : <label id="totalleadget"><?=$total_count_show?></label></span></p>
        <input  type="hidden" id="event_id" value="<?=$event_insert_id?>"/>
        <input type="hidden" name="lead_mining_presets" value="<?php echo $lead_mining_presets?>" id="lead_mining_presets_select"/>
        </hgroup>
        <div class="with-padding">
        <!--heading-->
        <?php
        $id='sorting-advanced1';
        $count=0;
        if(isset($user_details) && is_array($user_details)){
            $count=count($user_details);
            if($count>0){
                $id='sorting-advanced';
            }else{
                $id='sorting-advanced1';
            }
        }
        $leadlist_id=null;
        ?>
        <input type="hidden"  id="assigned_count" value=""/>
        <?php
        $check_all='';
        $count_equity_scrap='0';
        if($lead_mining_presets=='equity_scrape'){
            $customer_data=$this -> main_model -> customerdatalist_equityscrap($dealer_id_upload_data,0,200,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='model_breakdown'){
            $customer_data=$this -> main_model -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'Car',$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='efficiency'){
            $customer_data=$this -> main_model -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Car',1,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='warranty_scrape'){
            $customer_data=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,1,$leadlist_id='');
        }else if($lead_mining_presets=='drive_type'){
          $customer_data=$this -> main_model -> customerdatalist_drive_type($dealer_id_upload_data,0,5000,'fwd',$leadlist_id,$event_insert_id);
        }
        
        if(!empty($customer_data)){
            $count_equity_scrap=count($customer_data);
            $check_all='checked';
        }else{
            $count_equity_scrap='0';
        }
        //print_r($customer_data);
        $group_name=$this -> settings_model -> getleadgrouptitle($lead_mining_presets);
        if(isset($group_name)&& $group_name!=''){
        ?>
        <dl class="accordion same-height">
        <!-- Equity Scrape-->
        <div class="slidingbackground"><div class="checkboxalignclass"><input type="checkbox" name="equity_scrap" id="equity_check-all-pr1" class="check-all-pr1" value="1" style="margin-top:7px;"<?php echo $check_all?>  onclick="togglecheckboxes(this,'checkedpr1[]')" ></div><div style="width: 83%;"><a href="javascript:void(0)" class="show_hide " ><?php echo $group_name[0];?><span class="ui-icon ui-icon-triangle-1-e ui-iconsv" style=" margin-top: -1px;"></span></a></div><div class="leadstext">Leads : <label id="showcountlable"><?php echo $count_equity_scrap?></label></div></div>
            <div class="slidingDiv">
                <table class="table responsive-table" id="sorting-advanced1">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="width: 26%;" class="align-center hide-on-mobile"> Name</th>
                            <th scope="col" width="20%" class="align-center hide-on-mobile"> City </th>
                            <th scope="col" width="17%" class="align-center hide-on-mobile"> Home Phone</th>
                            <th scope="" width="25%" class="align-center hide-on-mobile-portrait">Vehicle 
                            </th>
                            <th scope="col" width="23%" class="lign-center hide-on-mobile-portrait">Purchase Date</th>
                            <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($customer_data) && is_array($customer_data)){
                        $vale_count=1;
                        $i=1;
                        foreach($customer_data as $key=>$value){
                            if($leadlist_id!=null){
                                $leadlist_id.=',' ; 
                            }  
                            if($value['buyer_first_name']!=''){
                                $buyer_first_name=ucfirst(strtolower($value['buyer_first_name'])).' '.ucfirst(strtolower($value['buyer_last_name']));
                            }else{
                                $buyer_first_name='N/A';
                            }
                            //making phone number formate
                            $buyer_homephone='';
                            if($value['buyer_homephone']!=''){
                                 preg_match('/\(([^\)]*)\)/', $value['buyer_homephone'], $matches);
                                 if(!empty($matches)){
                                  $buyer_homephone=$value['buyer_homephone'];  
                                 }else{
                                $string1=substr($value['buyer_homephone'], 0, 3);
                                $string2=substr($value['buyer_homephone'], 3, -4);
                                $string3=substr($value['buyer_homephone'], 6, 10);
                                $buyer_homephone='('.$string1.') '.$string2.'-'.$string3;
                                }
                            }else{
                                $buyer_homephone='N/A';
                            }
                            if($value['buyer_city']!=''){
                                $buyer_city=ucfirst(strtolower($value['buyer_city']));
                            }
                            else{
                                $buyer_city='N/A';
                            }
                            if($value['sold_vehicle_year']!='' || $value['sold_vehicle_make']!='' || $value['sold_vehicle_model']!=''){
                                $buyer_make_model =ucfirst(strtolower($value['sold_vehicle_year'])).' '.ucfirst(strtolower($value['sold_vehicle_make'])).' '.ucfirst(strtolower($value['sold_vehicle_model']));
                            }
                            else{
                                $buyer_make_model='N/A';
                            }
                            $purchase_date=$this -> main_model -> getpurchaesdates_eps_table($value['sold_vehicle_stock'],$value['dealership_id']);
                            if($purchase_date!=''){
                                $purchase_date=$purchase_date;
                            }
                            else{
                                $purchase_date='N/A';
                            }
                            $pbs_customer_id=$value['id'];
                            $leadlist_id.=$value['id'];
                            ?>
                            <tr>
                                <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="checkedpr1[]" class="check-equity-scrape" id="check-all-pr-value" value="<?php echo $pbs_customer_id?>" style="margin-top:9px;"   onclick="showcount();" checked></th>
                                <td style="width:220px;color:#666666;"><?=$buyer_first_name?> </td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?=$buyer_city?></td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?=$buyer_homephone?></label></td>
                                <td class="align-center hide-on-mobile" style="color:#666666;"><?=$buyer_make_model;?></td>
                                <td class="align-center hide-on-mobile" style="color:#666666;"><?php echo $purchase_date;?></td>
                                <td class="align-center hide-on-mobile" style="width: 281px;">
                                <span class="button-group compact">
                                <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip  fancybox fancybox.iframe" title="View Customer Details">Details</a>
                                </span>
                                </td>
                            </tr>
                        <?php
                        $vale_count++;
                        $i++;
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
        <?php
        $check_all='';
        $count_model_breakdown='0';
        if($lead_mining_presets=='equity_scrape'){
            $customer_data=$this -> main_model -> customerdatalist_equityscrap($dealer_id_upload_data,0,200,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='model_breakdown'){
            $customer_data=$this -> main_model -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'SUVS',$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='efficiency'){
            $customer_data=$this -> main_model -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Car',2,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='warranty_scrape'){
            $customer_data=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,2,$leadlist_id);
        }else if($lead_mining_presets=='drive_type'){
          $customer_data=$this -> main_model -> customerdatalist_drive_type($dealer_id_upload_data,0,5000,'rwd',$leadlist_id,$event_insert_id);
        }
        
        if(!empty($customer_data)){
            $count_model_breakdown=count($customer_data);
            $check_all='checked';
        }else{
            $count_model_breakdown='0';
        }
        ?>
        <!-- Equity Scrape-->
        <!-- Model Breakdown-->
        <div class="slidingbackground" style="margin-top:1px"><div class="checkboxalignclass"><input type="checkbox" name="model_break_down" id="model-break-down-check-all-pr1" class="check-all-pr1" value="2"  style="margin-top:9px;" <?php echo $check_all?> onclick="togglecheckboxes_modelbreakdown(this,'checkedprmodebreakdown[]')"></div><div style="width: 83%;"><a href="javascript:void(0)" class="show_hide1"><?php echo $group_name[1];?><span class="ui-icon ui-icon-triangle-1-e ui-iconsv1" style=" margin-top: -1px;"></span></a></div><div class="leadstext">Leads : <label id="showcountlable_modelbreakdown"><?=$count_model_breakdown?></label></div></div>
            <div class="slidingDiv1">
                <table class="table responsive-table" id="sorting-advanced1">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="width: 26%;" class="align-center hide-on-mobile"> Name</th>
                            <th scope="col" width="20%" class="align-center hide-on-mobile"> City</th>
                            <th scope="col" width="17%" class="align-center hide-on-mobile"> Home Phone</th>
                            <th scope="" width="25%" class="align-center hide-on-mobile-portrait">Vehicle 
                            </th>
                            <th scope="col" width="23%" class="lign-center hide-on-mobile-portrait">Purchase Date</th>
                            <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php
                if(isset($customer_data) && is_array($customer_data)){
                    foreach($customer_data as $key=>$value){
                        if($leadlist_id!=null){
                            $leadlist_id.=',' ; 
                        }
                        if($value['buyer_first_name']!=''){
                            $buyer_first_name=ucfirst(strtolower($value['buyer_first_name'])).' '.ucfirst(strtolower($value['buyer_last_name']));
                        }else{
                            $buyer_first_name='N/A';
                        }
                        //creating phone number formating string
                        $buyer_homephone='';
                        if($value['buyer_homephone']!=''){
                            preg_match('/\(([^\)]*)\)/', $value['buyer_homephone'], $matches);
                            if(!empty($matches)){
                                $buyer_homephone=$value['buyer_homephone'];  
                            }else{
                            $string1=substr($value['buyer_homephone'], 0, 3);
                            $string2=substr($value['buyer_homephone'], 3, -4);
                            $string3=substr($value['buyer_homephone'], 6, 10);
                            $buyer_homephone='('.$string1.') '.$string2.'-'.$string3;
                            }
                        }else{
                            $buyer_homephone='N/A';
                        }
                        if($value['buyer_city']!=''){
                            $buyer_city=ucfirst(strtolower($value['buyer_city']));
                        }else{
                            $buyer_city='N/A';
                        }
                        if($value['sold_vehicle_year']!='' || $value['sold_vehicle_make']!='' || $value['sold_vehicle_model']!=''){
                            $buyer_make_model =ucfirst(strtolower($value['sold_vehicle_year'])).' '.ucfirst(strtolower($value['sold_vehicle_make'])).' '.ucfirst(strtolower($value['sold_vehicle_model']));
                        }else{
                            $buyer_make_model='N/A';
                        }
                        $purchase_date=$this -> main_model -> getpurchaesdates_eps_table($value['sold_vehicle_stock'],$value['dealership_id']);
                        if($purchase_date!=''){
                            $purchase_date=$purchase_date;
                        }else{
                            $purchase_date='N/A';
                        }
                        $pbs_customer_id=$value['id'];
                        $leadlist_id.=$value['id'];
                        ?>
                        <tr>
                            <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="checkedprmodebreakdown[]" class="check-model-breakdown" id="check-all-pr-value"   value="<?php echo $pbs_customer_id?>" onclick="showcount_modelbreakdown();" checked></th>
                            <td style="width:220px;color:#666666;"><?=$buyer_first_name?> </td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?=$buyer_city?></td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?=$buyer_homephone?></label></td>
                            <td class="align-center hide-on-mobile" style="color:#666666;"><?=$buyer_make_model;?></td>
                            <td class="align-center hide-on-mobile" style="color:#666666;"><?= $purchase_date;?></td>
                            <td class="align-center hide-on-mobile" style="width: 281px;">
                            <span class="button-group compact">
                            <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                            </span>
                            </td>
                        </tr>
                    <?php
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
        <!-- Model Breakdown-->
        <?php
        $check_all='';
        $count_leadlist_fuel_effciency='0';
        if($lead_mining_presets=='equity_scrape'){
            $customer_data=$this -> main_model -> customerdatalist_equityscrap($dealer_id_upload_data,0,200,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='model_breakdown'){
            $customer_data=$this -> main_model -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'Trucks',$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='efficiency'){
            $customer_data=$this -> main_model -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'SUV',3,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='warranty_scrape'){
            $customer_data=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,3,$leadlist_id);
        }else if($lead_mining_presets=='drive_type'){
          $customer_data=$this -> main_model -> customerdatalist_drive_type($dealer_id_upload_data,0,5000,'awd',$leadlist_id,$event_insert_id);
        }
        if(!empty($customer_data)){
            $count_leadlist_fuel_effciency=count($customer_data);
            $check_all='checked';
        }else{
            $count_leadlist_fuel_effciency='0';
        }
        ?>
        <!--Fuel Efficiency-->
        <div class="slidingbackground" style="margin-top:1px"><div class="checkboxalignclass"><input type="checkbox" name="fuel_effciency" id="fuel-efficiency-check-all-pr1" class="check-all-pr1" style="margin-top:9px;" value="3" <?php echo $check_all?> onclick="togglecheckboxes_fuelefficiency(this,'checkedpr_fuelefficiency[]')"></div><div style="width: 83%;"><a href="javascript:void(0)" class="show_hide2"><?php echo $group_name[2];?><span class="ui-icon ui-icon-triangle-1-e ui-iconsv2" style=" margin-top: -1px;"></span></a></div><div class="leadstext">Leads : <label id="showcountlable_fuelefficiency"><?=$count_leadlist_fuel_effciency?></label></div></div>
            <div class="slidingDiv2">
                <table class="table responsive-table" id="sorting-advanced1">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="width: 26%;" class="align-center hide-on-mobile"> Name</th>
                            <th scope="col" width="20%" class="align-center hide-on-mobile"> City</th>
                            <th scope="col" width="17%" class="align-center hide-on-mobile"> Home Phone</th>
                            <th scope="" width="25%" class="align-center hide-on-mobile-portrait">Vehicle 
                            </th>
                            <th scope="col" width="23%" class="lign-center hide-on-mobile-portrait">Purchase Date</th>
                            <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php
                if(isset($customer_data) && is_array($customer_data)){
                    foreach($customer_data as $key=>$value){
                        if($leadlist_id!=null){
                            $leadlist_id.=',' ; 
                        }
                        if($value['buyer_first_name']!=''){
                            $buyer_first_name=ucfirst(strtolower($value['buyer_first_name'])).' '.ucfirst(strtolower($value['buyer_last_name']));
                        }else{
                            $buyer_first_name='N/A';
                        }
                        $buyer_homephone='';
                        if($value['buyer_homephone']!=''){
                             //creating phone number formating string
                             preg_match('/\(([^\)]*)\)/', $value['buyer_homephone'], $matches);
                                 if(!empty($matches)){
                                  $buyer_homephone=$value['buyer_homephone'];  
                             }else{ 
                                $string1=substr($value['buyer_homephone'], 0, 3);
                                $string2=substr($value['buyer_homephone'], 3, -4);
                                $string3=substr($value['buyer_homephone'], 6, 10);
                                $buyer_homephone='('.$string1.') '.$string2.'-'.$string3;
                            }
                        }else{
                            $buyer_homephone='N/A';
                        }
                        if($value['buyer_city']!=''){
                            $buyer_city=ucfirst(strtolower($value['buyer_city']));
                        }else{
                            $buyer_city='N/A';
                        }
                        if($value['sold_vehicle_year']!='' || $value['sold_vehicle_make']!='' || $value['sold_vehicle_model']!=''){
                            $buyer_make_model =ucfirst(strtolower($value['sold_vehicle_year'])).' '.ucfirst(strtolower($value['sold_vehicle_make'])).' '.ucfirst(strtolower($value['sold_vehicle_model']));
                        }
                        else{
                            $buyer_make_model='N/A';
                        }
                        $purchase_date=$this -> main_model -> getpurchaesdates_eps_table($value['sold_vehicle_stock'],$value['dealership_id']);
                        if($purchase_date!=''){
                            $purchase_date=$purchase_date;
                        }
                        else{
                            $purchase_date='N/A';
                        }
                        $pbs_customer_id=$value['id'];
                        $leadlist_id.=$value['id'];
                        ?>
                        <tr>
                            <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="checkedpr_fuelefficiency[]" class="check-fuel-efficiency"  id="check-all-pr-value" value="<?php echo $pbs_customer_id?>" onclick="showcount_fuelefficiency()" checked></th>
                            <td style="width:220px;color:#666666;"><?=$buyer_first_name?> </td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?=$buyer_city?></td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?=$buyer_homephone?></label></td>
                            <td class="align-center hide-on-mobile" style="color:#666666;"><?=$buyer_make_model;?></td>
                            <td class="align-center hide-on-mobile" style="color:#666666;"><?=$purchase_date;?></td>
                            <td class="align-center hide-on-mobile" style="width: 281px;">
                            <span class="button-group compact">
                            <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                            </span>
                            </td>
                        </tr>
                    <?php
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
        <!--Fuel Efficiency-->
        <?php
        $check_all='';
        $count_leadlist_warrenty_scrap='0';
        if($lead_mining_presets=='equity_scrape'){
            $customer_data=$this -> main_model -> customerdatalist_equityscrap($dealer_id_upload_data,0,200,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='model_breakdown'){
            $customer_data=$this -> main_model -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'Vans',$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='efficiency'){
            $customer_data=$this -> main_model -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'SUV',4,$leadlist_id,$event_insert_id);
        }else if($lead_mining_presets=='warranty_scrape'){
            $customer_data=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,4,$leadlist_id);
        }else if($lead_mining_presets=='drive_type'){
          $customer_data=$this -> main_model -> customerdatalist_drive_type($dealer_id_upload_data,0,5000,'4x4',$leadlist_id,$event_insert_id);
        }
        if(!empty($customer_data)){
            $count_leadlist_warrenty_scrap=count($customer_data);
            $check_all='checked';
        }else{
            $customer_warrenty_scrap='0';
        }
        ?>
        <!--Warranty Scrape-->
        <div class="slidingbackground" style="margin-top:1px;"><div class="checkboxalignclass"><input type="checkbox" name="wrranty_scrap" id="warraent-check-all-pr1" class="check-all-pr1" value="4"  style="margin-top:9px;" <?php echo $check_all?> onclick="togglecheckboxes_warrantyscrape(this,'checkedprwarrantyscrape[]')" ></div><div style="width: 83%;"><a href="javascript:void(0)" class="show_hide3"><?php echo $group_name[3];?><span class="ui-icon ui-icon-triangle-1-e ui-iconsv3" style=" margin-top: -1px;"></span></a></div><div class="leadstext">Leads : <label id="showcountlable_warrantyscrape"><?=$count_leadlist_warrenty_scrap?></label></div></div>
            <div class="slidingDiv3">
                <table class="table responsive-table" id="sorting-advanced1">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="width: 26%;" class="align-center hide-on-mobile"> Name</th>
                            <th scope="col" width="20%" class="align-center hide-on-mobile"> City</th>
                            <th scope="col" width="17%" class="align-center hide-on-mobile"> Home Phone</th>
                            <th scope="" width="25%" class="align-center hide-on-mobile-portrait">Vehicle 
                            </th>
                            <th scope="col" width="23%" class="lign-center hide-on-mobile-portrait">Purchase Date</th>
                            <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php
                if(isset($customer_data) && is_array($customer_data)){
                    foreach($customer_data as $key=>$value){
                        if($leadlist_id!=null){
                            $leadlist_id.=',' ; 
                        }
                        if($value['buyer_first_name']!=''){
                            $buyer_first_name=ucfirst(strtolower($value['buyer_first_name'])).' '.ucfirst(strtolower($value['buyer_last_name']));
                        }else{
                            $buyer_first_name='N/A';
                        }
                        $buyer_homephone='';
                        if($value['buyer_homephone']!=''){
                        //creating phone number formating string
                            preg_match('/\(([^\)]*)\)/', $value['buyer_homephone'], $matches);
                                 if(!empty($matches)){
                                  $buyer_homephone=$value['buyer_homephone'];  
                            }else{
                                $string1=substr($value['buyer_homephone'], 0, 3);
                                $string2=substr($value['buyer_homephone'], 3, -4);
                                $string3=substr($value['buyer_homephone'], 6, 10);
                                $buyer_homephone='('.$string1.') '.$string2.'-'.$string3;
                            }
                        }else{
                            $buyer_homephone='N/A';
                        }
                        if($value['buyer_city']!=''){
                            $buyer_city=ucfirst(strtolower($value['buyer_city']));
                        }else{
                            $buyer_city='N/A';
                        }
                        if($value['sold_vehicle_year']!='' || $value['sold_vehicle_make']!='' || $value['sold_vehicle_model']!=''){
                            $buyer_make_model =ucfirst(strtolower($value['sold_vehicle_year'])).' '.ucfirst(strtolower($value['sold_vehicle_make'])).' '.ucfirst(strtolower($value['sold_vehicle_model']));
                        }else{
                            $buyer_make_model='N/A';
                        }
                        $purchase_date=$this -> main_model -> getpurchaesdates_eps_table($value['sold_vehicle_stock'],$value['dealership_id']);
                        if($purchase_date!=''){
                            $purchase_date=$purchase_date;
                        }else{
                            $purchase_date='N/A';
                        }
                    $pbs_customer_id=$value['id'];
                    $leadlist_id.=$value['id'];
                    ?>
                    <tr>
                        <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="checkedprwarrantyscrape[]" class="check-fuel-warranty-scrape" id="check-all-pr-value" value="<?php echo $pbs_customer_id?>"  onclick="showcount_warrantyscrape();" checked></th>
                        <td style="width:220px;color:#666666;"><?=$buyer_first_name?> </td>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?=$buyer_city?></td>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?=$buyer_homephone?></label></td>
                        <td class="align-center hide-on-mobile" style="color:#666666;"><?=$buyer_make_model;?></td>
                        <td class="align-center hide-on-mobile" style="color:#666666;"><?=$purchase_date;?></td>
                        <td class="align-center hide-on-mobile" style="width: 281px;">
                        <span class="button-group compact">
                        <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                        </span>
                        </td>
                    </tr>
                    <?php
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
    <!--Warranty Scrape-->
    <?php
    $check_all='';
    $count_leadlist_advance_options='0';
    if($lead_mining_presets=='equity_scrape'){
        $customer_data=$this -> main_model -> customerdatalist_equityscrap($dealer_id_upload_data,0,200,$leadlist_id,$event_insert_id);
    }else if($lead_mining_presets=='model_breakdown'){
        $customer_data=$this -> main_model -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'',$leadlist_id,$event_insert_id);
    }else if($lead_mining_presets=='efficiency'){
        $customer_data=$this -> main_model -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Truck',5,$leadlist_id,$event_insert_id);
    }else if($lead_mining_presets=='warranty_scrape'){
        $customer_data=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,5,$leadlist_id);
    }else if($lead_mining_presets=='drive_type'){
          $customer_data=$this -> main_model -> customerdatalist_drive_type($dealer_id_upload_data,0,5000,'',$leadlist_id,$event_insert_id);
        }
    if(!empty($customer_data)){
        $count_leadlist_advance_options=count($customer_data);
        $check_all='checked';
    }else{
        $count_leadlist_advance_options='0';
    }
    ?>
    <!--Custom Campaign-->
    <div class="slidingbackground" style="margin-top:1px;"><div class="checkboxalignclass"><input type="checkbox" name="custom_campain" id="custom-check-all-pr1" class="check-all-pr1" style="margin-top:9px;" value="5" <?php echo $check_all?> onclick="togglecheckboxes_customcampaign(this,'checkedpcustomcampaign[]')" ></div><div style="width: 83%;"><a href="javascript:void(0)" class="show_hide4"><?php echo $group_name[4];?><span class="ui-icon ui-icon-triangle-1-e ui-iconsv4" style=" margin-top: -1px;"></span></a></div><div class="leadstext">Leads : <label id="showcountlable_customcampaign"><?=$count_leadlist_advance_options?></label></div></div>
        <div class="slidingDiv4">
            <table class="table responsive-table" id="sorting-advanced1">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" style="width: 26%;" class="align-center hide-on-mobile"> Name</th>
                        <th scope="col" width="20%" class="align-center hide-on-mobile"> City</th>
                        <th scope="col" width="17%" class="align-center hide-on-mobile"> Home Phone</th>
                        <th scope="" width="25%" class="align-center hide-on-mobile-portrait">Vehicle 
                        </th>
                        <th scope="col" width="23%" class="lign-center hide-on-mobile-portrait">Purchase Date</th>
                        <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Action</th>
                    </tr>
                </thead>
            <tbody>
            <?php
            if(isset($customer_data) && is_array($customer_data)){
                foreach($customer_data as $key=>$value){
                    if($leadlist_id!=null){
                        $leadlist_id.=',' ; 
                    }
                    if($value['buyer_first_name']!=''){
                        $buyer_first_name=ucfirst(strtolower($value['buyer_first_name'])).' '.ucfirst(strtolower($value['buyer_last_name']));
                    }else{
                        $buyer_first_name='N/A';
                    }
                    $buyer_homephone='';
                    if($value['buyer_homephone']!=''){
                         //creating phone number formating string
                        preg_match('/\(([^\)]*)\)/', $value['buyer_homephone'], $matches);
                        if(!empty($matches)){
                            $buyer_homephone=$value['buyer_homephone'];  
                        }else{
                            $string1=substr($value['buyer_homephone'], 0, 3);
                            $string2=substr($value['buyer_homephone'], 3, -4);
                            $string3=substr($value['buyer_homephone'], 6, 10);
                            $buyer_homephone='('.$string1.') '.$string2.'-'.$string3;
                        }
                    }else{
                        $buyer_homephone='N/A';
                    }
                    if($value['buyer_city']!=''){
                        $buyer_city=ucfirst(strtolower($value['buyer_city']));
                    }else{
                        $buyer_city='N/A';
                    }
                    if($value['sold_vehicle_year']!='' || $value['sold_vehicle_make']!='' || $value['sold_vehicle_model']!=''){
                        $buyer_make_model =ucfirst(strtolower($value['sold_vehicle_year'])).' '.ucfirst(strtolower($value['sold_vehicle_make'])).' '.ucfirst(strtolower($value['sold_vehicle_model']));
                    }else{
                        $buyer_make_model='N/A';
                    }
                    $purchase_date=$this -> main_model -> getpurchaesdates_eps_table($value['sold_vehicle_stock'],$value['dealership_id']);
                    if($purchase_date!=''){
                        $purchase_date=$purchase_date;
                    }else{
                        $purchase_date='N/A';
                    }
                    $pbs_customer_id=$value['id'];
                    $leadlist_id.=$value['id'];
                    ?>
                    <tr>
                        <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="checkedpcustomcampaign[]" class="check-custom-campaign" id="check-all-pr-value" value="<?php echo $pbs_customer_id?>" onclick="showcount_customcampaign();" checked></th>
                        <td style="width:220px;color:#666666;"><?=$buyer_first_name?> </td>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?=$buyer_city?></td>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?=$buyer_homephone?></label></td>
                        <td class="align-center hide-on-mobile" style="color:#666666;"><?=$buyer_make_model;?></td>
                        <td class="align-center hide-on-mobile" style="color:#666666;"><?= $purchase_date;?></td>
                        <td class="align-center hide-on-mobile" style="width: 281px;">
                        <span class="button-group compact">
                        <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                        </span>
                        </td>
                    </tr>
                <?php
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
    <?php
    if(isset($group_name[5])&& $group_name[5]!=''){
        $customer_data=$this -> main_model -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Truck',6,$leadlist_id,$event_insert_id);
        $count_fuel_effency_report6=count($customer_data);
        if(!empty($customer_data)){
            $count_leadlist_advance_options=count($customer_data);
            $check_all='checked';
        }
        else{
            $check_all='';
        }
    ?>
        <div class="slidingbackground" style="margin-top:1px;"><div class="checkboxalignclass"><input type="checkbox" name="fuelreopr6" id="fuelreport-check-all-pr1" class="check-all-pr1" value="6"  style="margin-top:9px;" <?php echo $check_all?> onclick="togglecheckboxes_fuel_efficiency(this,'checkedfuelgroup[]')" ></div><div style="width: 83%;"><a href="javascript:void(0)" class="show_hide5"><?php echo $group_name[5];?><span class="ui-icon ui-icon-triangle-1-e ui-iconsv3" style=" margin-top: -1px;"></span></a></div><div class="leadstext">Leads : <label id="showcountlable_report6"><?php echo $count_fuel_effency_report6?></label></div></div>
        <div class="slidingDiv5">
            <table class="table responsive-table" id="sorting-advanced1">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" style="width: 26%;" class="align-center hide-on-mobile"> Name</th>
                        <th scope="col" width="20%" class="align-center hide-on-mobile"> City</th>
                        <th scope="col" width="17%" class="align-center hide-on-mobile"> Home Phone</th>
                        <th scope="" width="25%" class="align-center hide-on-mobile-portrait">Vehicle 
                        </th>
                        <th scope="col" width="23%" class="lign-center hide-on-mobile-portrait">Purchase Date</th>
                        <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($customer_data) && is_array($customer_data)){
                    foreach($customer_data as $key=>$value){
                        if($leadlist_id!=null){
                            $leadlist_id.=',' ; 
                        }
                        if($value['buyer_first_name']!=''){
                            $buyer_first_name=ucfirst(strtolower($value['buyer_first_name'])).' '.ucfirst(strtolower($value['buyer_last_name']));
                        }else{
                            $buyer_first_name='N/A';
                        }
                        if($value['buyer_homephone']!=''){
                            $buyer_homephone='';
                             //creating phone number formating string
                             preg_match('/\(([^\)]*)\)/', $value['buyer_homephone'], $matches);
                             if(!empty($matches)){
                                 $buyer_homephone=$value['buyer_homephone'];  
                             }else{
                                $string1=substr($value['buyer_homephone'], 0, 3);
                                $string2=substr($value['buyer_homephone'], 3, -4);
                                $string3=substr($value['buyer_homephone'], 6, 10);
                                $buyer_homephone='('.$string1.') '.$string2.'-'.$string3;
                            }
                        }else{
                            $buyer_homephone='N/A';
                        }
                        if($value['buyer_city']!=''){
                            $buyer_city=ucfirst(strtolower($value['buyer_city']));
                        }else{
                            $buyer_city='N/A';
                        }
                        if($value['sold_vehicle_year']!='' || $value['sold_vehicle_make']!='' || $value['sold_vehicle_model']!=''){
                            $buyer_make_model =ucfirst(strtolower($value['sold_vehicle_year'])).' '.ucfirst(strtolower($value['sold_vehicle_make'])).' '.ucfirst(strtolower($value['sold_vehicle_model']));
                        }else{
                            $buyer_make_model='N/A';
                        }
                        $purchase_date=$this -> main_model -> getpurchaesdates_eps_table($value['sold_vehicle_stock'],$value['dealership_id']);
                        if($purchase_date!=''){
                            $purchase_date=$purchase_date;
                        }else{
                            $purchase_date='N/A';
                        }
                        $pbs_customer_id=$value['id'];
                        $leadlist_id.=$value['id'];
                        ?>
                        <tr>
                            <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="checkedfuelgroup[]" class="check-fuel-report" id="check-all-pr-value" value="<?php echo $pbs_customer_id?>" onclick="showcount_fuel_report();" checked></th>
                            <td style="width:220px;color:#666666;"><?=$buyer_first_name?> </td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;"><?=$buyer_city?></td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="color:#666666;"><label><?=$buyer_homephone?></label></td>
                            <td class="align-center hide-on-mobile" style="color:#666666;"><?=$buyer_make_model;?></td>
                            <td class="align-center hide-on-mobile" style="color:#666666;"><?= $purchase_date;?></td>
                            <td class="align-center hide-on-mobile" style="width: 281px;">
                            <span class="button-group compact">
                            <a href="<?=base_url()?>campaign/get_customer_details_with_customer_id/<?=$pbs_customer_id?>" class="button compact with-tooltip fancybox fancybox.iframe" title="View Customer Details">Details</a>
                            </span>
                            </td>
                        </tr>
                        <?php
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
        <?php
        }
        ?>
        <!--Custom Campaign-->
        </dl>
        <?php
        }
        ?>
        <p class="wrapped left-icon icon-info-round" style="text-align: left;">
            <button type="button" class="submit button glossy mid-margin-right" onclick="customer_leadlist();" style="float: right; ">
                <span class="button-icon"><span class="icon-tick"></span></span>
                Confirm
            </button>
        <span style="float: right;" class="total_leads">Total Leads : <label id="totalleadget1"><?=$total_count_show?></label></span></p>
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
// Call template init (optional, but faster if called manually)
$.template.init();
// Table sort - DataTables
var table = $('#sorting-advanced');
table.dataTable({
    'aoColumnDefs' : [{
        'bSortable' : false,
        'aTargets' : [0, 5]
    }],
    'sPaginationType' : 'full_numbers',
    'sDom' : '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
    'fnInitComplete' : function(oSettings) {
        // Style length select
        table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
        tableStyled = true;
    }
});
// Table sort - styled
$('#sorting-example1').tablesorter({
    headers : {
        0 : {
            sorter : false
        },
        5 : {
            sorter : false
        }
    }
}).on('click', 'tbody td', function(event) {
    // Do not process if something else has been clicked
    if (event.target !== this) {
        return;
    }
    var tr = $(this).parent(), row = tr.next('.row-drop'), rows;
    // If click on a special row
    if (tr.hasClass('row-drop')) {
        return;
    }
    // If there is already a special row
    if (row.length > 0) {
        // Un-style row
        tr.children().removeClass('anthracite-gradient glossy');
        // Remove row
        row.remove();
        return;
    }
    // Remove existing special rows
    rows = tr.siblings('.row-drop');
    if (rows.length > 0) {
        // Un-style previous rows
        rows.prev().children().removeClass('anthracite-gradient glossy');
        // Remove rows
        rows.remove();
    }
    // Style row
    tr.children().addClass('anthracite-gradient glossy');
    // Add fake row
    $('<tr class="row-drop">' + '<td colspan="' + tr.children().length + '">' + '<div class="float-right">' + '<button type="submit" class="button glossy mid-margin-right">' + '<span class="button-icon"><span class="icon-mail"></span></span>' + 'Send mail' + '</button>' + '<button type="submit" class="button glossy">' + '<span class="button-icon red-gradient"><span class="icon-cross"></span></span>' + 'Remove' + '</button>' + '</div>' + '<strong>Name:</strong> John Doe<br>' + '<strong>Account:</strong> admin<br>' + '<strong>Last connect:</strong> 05-07-2011<br>' + '<strong>Email:</strong> john@doe.com' + '</td>' + '</tr>').insertAfter(tr);
    }).on('sortStart', function() {
    var rows = $(this).find('.row-drop');
        if (rows.length > 0) {
            // Un-style previous rows
            rows.prev().children().removeClass('anthracite-gradient glossy');
            // Remove rows
            rows.remove();
        }
    });
    // Table sort - simple
    $('#sorting-example2').tablesorter({
        headers : {
            5 : {
                sorter : false
            }
        }
    });
function selectcheckbox(){
    if($('.check-all-pr1').attr('checked')){
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');
    }else{
        $('input[name=checkedpr1]').prop('checked', true);
        $(this).val('uncheck all');
    }
}
function closeaccordian(){
    if ($('#priority1').css('display') == 'block') {
        $('#priority1').hide();
    }
    else if ($('#priority2').css('display') == 'block') {
        //$("#priority2").css("display", "none");
        dt = $(this);
        dt.next('dd').hide();;
    }
    $('html, body').animate({scrollTop: '0px'}, 800);
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(".slidingDiv").hide();
    $(".show_hide").show();
    $('.show_hide').click(function(){
        $(".slidingDiv").slideToggle();
        $(".ui-iconsv").toggleClass("highlight");
        $(".ui-iconsv1").removeClass("highlight");
        $(".ui-iconsv2").removeClass("highlight");
        $(".ui-iconsv3").removeClass("highlight");
        $(".ui-iconsv4").removeClass("highlight");
        $(".ui-iconsv5").removeClass("highlight");
        $(".ui-iconsv6").removeClass("highlight");
        $(".ui-iconsv7").removeClass("highlight");
        $(".ui-iconsv8").removeClass("highlight");
        $(".ui-iconsv9").removeClass("highlight");
        $(".ui-iconsv10").removeClass("highlight");
        $(".ui-iconsv11").removeClass("highlight");
        $(".ui-iconsv12").removeClass("highlight");
        $(".ui-iconsv13").removeClass("highlight");
        $(".ui-iconsv14").removeClass("highlight");
        $(".ui-iconsv15").removeClass("highlight");
        $(".ui-iconsv16").removeClass("highlight");
        $(".slidingDiv1").hide();
        $(".slidingDiv2").hide();
        $(".slidingDiv3").hide();
        $(".slidingDiv4").hide();
        $(".slidingDiv5").hide();
        $(".slidingDiv6").hide();
        $(".slidingDiv7").hide();
        $(".slidingDiv8").hide();
        $(".slidingDiv9").hide();
        $(".slidingDiv10").hide();
        $(".slidingDiv11").hide();
        $(".slidingDiv12").hide();
        $(".slidingDiv13").hide();
        $(".slidingDiv14").hide();
        $(".slidingDiv15").hide();
        $(".slidingDiv16").hide();
    });
    $(".slidingDiv1").hide();
    $(".show_hide1").show();
    $('.show_hide1').click(function(){
        $(".ui-iconsv1").toggleClass("highlight");
        $(".ui-iconsv").removeClass("highlight");
        $(".ui-iconsv2").removeClass("highlight");
        $(".ui-iconsv3").removeClass("highlight");
        $(".ui-iconsv4").removeClass("highlight");
        $(".ui-iconsv5").removeClass("highlight");
        $(".ui-iconsv6").removeClass("highlight");
        $(".ui-iconsv7").removeClass("highlight");
        $(".ui-iconsv8").removeClass("highlight");
        $(".ui-iconsv9").removeClass("highlight");
        $(".ui-iconsv10").removeClass("highlight");
        $(".ui-iconsv11").removeClass("highlight");
        $(".ui-iconsv12").removeClass("highlight");
        $(".ui-iconsv13").removeClass("highlight");
        $(".ui-iconsv14").removeClass("highlight");
        $(".ui-iconsv15").removeClass("highlight");
        $(".ui-iconsv16").removeClass("highlight");
        $(".slidingDiv").hide();
        $(".slidingDiv1").slideToggle();
        $(".slidingDiv2").hide();
        $(".slidingDiv3").hide();
        $(".slidingDiv4").hide();
        $(".slidingDiv5").hide();
        $(".slidingDiv6").hide();
        $(".slidingDiv7").hide();
        $(".slidingDiv8").hide();
        $(".slidingDiv9").hide();
        $(".slidingDiv10").hide();
        $(".slidingDiv11").hide();
        $(".slidingDiv12").hide();
        $(".slidingDiv13").hide();
        $(".slidingDiv14").hide();
        $(".slidingDiv15").hide();
        $(".slidingDiv16").hide();
    });
    $(".slidingDiv2").hide();
    $(".show_hide2").show();
    $('.show_hide2').click(function(){
        $(".ui-iconsv2").toggleClass("highlight");
        $(".ui-iconsv1").removeClass("highlight");
        $(".ui-iconsv").removeClass("highlight");
        $(".ui-iconsv3").removeClass("highlight");
        $(".ui-iconsv4").removeClass("highlight");
        $(".ui-iconsv5").removeClass("highlight");
        $(".ui-iconsv6").removeClass("highlight");
        $(".ui-iconsv7").removeClass("highlight");
        $(".ui-iconsv8").removeClass("highlight");
        $(".ui-iconsv9").removeClass("highlight");
        $(".ui-iconsv10").removeClass("highlight");
        $(".ui-iconsv11").removeClass("highlight");
        $(".ui-iconsv12").removeClass("highlight");
        $(".ui-iconsv13").removeClass("highlight");
        $(".ui-iconsv14").removeClass("highlight");
        $(".ui-iconsv15").removeClass("highlight");
        $(".ui-iconsv16").removeClass("highlight");
        $(".slidingDiv").hide();
        $(".slidingDiv1").hide();
        $(".slidingDiv2").slideToggle();
        $(".slidingDiv3").hide();
        $(".slidingDiv4").hide();
        $(".slidingDiv5").hide();
        $(".slidingDiv6").hide();
        $(".slidingDiv7").hide();
        $(".slidingDiv8").hide();
        $(".slidingDiv9").hide();
        $(".slidingDiv10").hide();
        $(".slidingDiv11").hide();
        $(".slidingDiv12").hide();
        $(".slidingDiv13").hide();
        $(".slidingDiv14").hide();
        $(".slidingDiv15").hide();
        $(".slidingDiv16").hide();
    });
    $(".slidingDiv3").hide();
    $(".show_hide3").show();
    $('.show_hide3').click(function(){
        $(".ui-iconsv3").toggleClass("highlight");
        $(".ui-iconsv1").removeClass("highlight");
        $(".ui-iconsv2").removeClass("highlight");
        $(".ui-iconsv").removeClass("highlight");
        $(".ui-iconsv4").removeClass("highlight");
        $(".ui-iconsv5").removeClass("highlight");
        $(".ui-iconsv6").removeClass("highlight");
        $(".ui-iconsv7").removeClass("highlight");
        $(".ui-iconsv8").removeClass("highlight");
        $(".ui-iconsv9").removeClass("highlight");
        $(".ui-iconsv10").removeClass("highlight");
        $(".ui-iconsv11").removeClass("highlight");
        $(".ui-iconsv12").removeClass("highlight");
        $(".ui-iconsv13").removeClass("highlight");
        $(".ui-iconsv14").removeClass("highlight");
        $(".ui-iconsv15").removeClass("highlight");
        $(".ui-iconsv16").removeClass("highlight");
        $(".slidingDiv").hide();
        $(".slidingDiv1").hide();
        $(".slidingDiv2").hide();
        $(".slidingDiv3").slideToggle();
        $(".slidingDiv4").hide();
        $(".slidingDiv5").hide();
        $(".slidingDiv6").hide();
        $(".slidingDiv7").hide();
        $(".slidingDiv8").hide();
        $(".slidingDiv9").hide();
        $(".slidingDiv10").hide();
        $(".slidingDiv11").hide();
        $(".slidingDiv12").hide();
        $(".slidingDiv13").hide();
        $(".slidingDiv14").hide();
        $(".slidingDiv15").hide();
        $(".slidingDiv16").hide();
    });
    $(".slidingDiv4").hide();
    $(".show_hide4").show();
    $('.show_hide4').click(function(){
        $(".ui-iconsv4").toggleClass("highlight");
        $(".ui-iconsv1").removeClass("highlight");
        $(".ui-iconsv2").removeClass("highlight");
        $(".ui-iconsv3").removeClass("highlight");
        $(".ui-iconsv").removeClass("highlight");
        $(".ui-iconsv5").removeClass("highlight");
        $(".ui-iconsv6").removeClass("highlight");
        $(".ui-iconsv7").removeClass("highlight");
        $(".ui-iconsv8").removeClass("highlight");
        $(".ui-iconsv9").removeClass("highlight");
        $(".ui-iconsv10").removeClass("highlight");
        $(".ui-iconsv11").removeClass("highlight");
        $(".ui-iconsv12").removeClass("highlight");
        $(".ui-iconsv13").removeClass("highlight");
        $(".ui-iconsv14").removeClass("highlight");
        $(".ui-iconsv15").removeClass("highlight");
        $(".ui-iconsv16").removeClass("highlight");
        $(".slidingDiv").hide();
        $(".slidingDiv1").hide();
        $(".slidingDiv2").hide();
        $(".slidingDiv3").hide();
        $(".slidingDiv4").slideToggle();
        $(".slidingDiv5").hide();
        $(".slidingDiv6").hide();
        $(".slidingDiv7").hide();
        $(".slidingDiv8").hide();
        $(".slidingDiv9").hide();
        $(".slidingDiv10").hide();
        $(".slidingDiv11").hide();
        $(".slidingDiv12").hide();
        $(".slidingDiv13").hide();
        $(".slidingDiv14").hide();
        $(".slidingDiv15").hide();
        $(".slidingDiv16").hide();
    });
    $(".slidingDiv5").hide();
    $(".show_hide5").show();
    $('.show_hide5').click(function(){
        $(".ui-iconsv5").toggleClass("highlight");
        $(".ui-iconsv1").removeClass("highlight");
        $(".ui-iconsv2").removeClass("highlight");
        $(".ui-iconsv3").removeClass("highlight");
        $(".ui-iconsv").removeClass("highlight");
        $(".ui-iconsv6").removeClass("highlight");
        $(".ui-iconsv7").removeClass("highlight");
        $(".ui-iconsv8").removeClass("highlight");
        $(".ui-iconsv9").removeClass("highlight");
        $(".ui-iconsv10").removeClass("highlight");
        $(".ui-iconsv11").removeClass("highlight");
        $(".ui-iconsv12").removeClass("highlight");
        $(".ui-iconsv13").removeClass("highlight");
        $(".ui-iconsv14").removeClass("highlight");
        $(".ui-iconsv15").removeClass("highlight");
        $(".ui-iconsv16").removeClass("highlight");
        $(".slidingDiv").hide();
        $(".slidingDiv1").hide();
        $(".slidingDiv2").hide();
        $(".slidingDiv3").hide();
        $(".slidingDiv5").slideToggle();
        $(".slidingDiv6").hide();
        $(".slidingDiv7").hide();
        $(".slidingDiv8").hide();
        $(".slidingDiv9").hide();
        $(".slidingDiv10").hide();
        $(".slidingDiv11").hide();
        $(".slidingDiv12").hide();
        $(".slidingDiv13").hide();
        $(".slidingDiv14").hide();
        $(".slidingDiv15").hide();
        $(".slidingDiv16").hide();
    });
});
</script>