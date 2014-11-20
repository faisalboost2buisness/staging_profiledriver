<style>
    .four-columns {
        float: left;
        width: 44.083%;
        margin-left: 20px;
        margin-right: 20px;
    }
    .body{
        color:#444;
    }
    .input{
        margin-left: 4px;
    }
</style>
<style>
    /*form styles*/
    #msform {
        margin-top: 46px;
        position: relative;
        text-align: center;
        width: 96%;
        margin-bottom: 85px;
    }
    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;
        /*stacking fieldsets above each other*/
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }
    /*inputs*/
    #msform input, #msform textarea {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        color: #666666;
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
    .reporttype{
        text-align: left;
        width: 90%;
    }
    ul, ol {
        margin-left: 21.8em;
    }
    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.2); /* IE */
        -moz-transform: scale(1.2); /* FF */
        -webkit-transform: scale(1.2); /* Safari and Chrome */
        -o-transform: scale(1.2); /* Opera */
    }
    .image1{
        border: 1px solid #D9DCE1;
        box-shadow: 0 0 3px 1px;
        float: left;
        height: 125px;
        margin-right: 10px;
        padding: 16px;
        width: 82%;
    }
    .imagemaindiv{
        float: left;
        margin-left: 8px;
        margin-right: 0;
        width: 32%;
    }
    .advertisinglabel{
        float: left;
        margin-top: 10px;
        text-align: center;
    }
    .label {
        line-height: 16px;    
        color: #808080;
        display: block;
        float: left;
        font-weight: bold;
        padding-top: 16px;
        text-align: right;
        width: 183px;
        font-family: arial;
    }
    input, .inputs {
        border: 0 none;
        border-radius: 4px;
        box-shadow: 0 0 0 1px rgba(51, 153, 255, 0) inset, 0 2px 5px rgba(0, 0, 0, 0.35) inset, 0 1px 1px rgba(255, 255, 255, 0.5), 0 0 0 rgba(51, 153, 255, 0);
        display: inline-block;
        line-height: 30px;
        padding: 0 9px;
        text-align: left;
        transition: box-shadow 400ms ease 0s;
        vertical-align: baseline;
        width: 245px;
        line-height: 16px;
        padding-bottom: 7px;
        padding-top: 7px;
        font-family: Arial,Helvetica,sans-serif;
        font-size: 13px;
    }
    .ui-datepicker-year{
        color: #000!important;
    }
    .tooltip {
        display:none;
        position:absolute;
        border:1px solid #333;
        background-color:#161616;
        border-radius:5px;
        padding:10px;
        color:#fff;
        font-size:12px Arial;
        width:800px;
    }
    </style>
    <style type="text/css">
    /** box wrapper for each food information, each set to float to left **/
    .advertise-select{
        float:left;
        position:relative;
        cursor:pointer;
    }
    /** we set to force the image width to 180px **/
    /** set color to white ***/
    .white-text{
        color:#ffffff;
    }
    /** this is the position text of user name **/
    .advertise-select-uploadby{
        position:absolute;
        bottom:5px;
        left:5px;
        font-size:0.7em;
    }
    .advertise-select-title{
        padding:5px;
        font-size:0.8em;
        color:#ffffff;
    }
    .advertise-select-desc{
        font-size:11px;
        width:188px;
        padding:5px;
        color:#ffffff;
        padding-left: 11px;
    }
    /** we hide the transparent slideup div and will only show when hovering **/
    .advertise-select-transparentbg{
        background-color: #000000;
        bottom: 0;
        display: none;
        height: 84%;
        left: 0;
        opacity: 0.76;
        position: absolute;
        width: 98%;
    }
    .advertise-select-info{
        font-size:0.7em;
        position:absolute;
        right:5px;
        bottom:5px;
        display:none;
        color:#ffffff;
    }
    .advertise-select-like, .advertise-select-comment{
        float:right;
        background:url(/jquery/images/demo/icon_star.png) no-repeat;
        padding-left:20px;
        margin-right:10px;
        height:16px;
        line-height:16px;
    }
    .advertise-select-comment{
        background:url(/jquery/images/demo/icon_comment.png) no-repeat;
        margin-right:10px;
    }
    .white-text{
        color:#ffffff;
    }
    .clear{
        clear:both;
    }
</style>
<link rel="stylesheet" href="<?= base_url()?>css/jquery.ui.css"/>
<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script src="<?php echo base_url()?>js/jquery.ui.js"></script>
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<script>
var jQ=$.noConflict();
    jQ(function() {
    var startdate = new Date();
    startdate.setDate(startdate.getDate());
    jQ("#event_start_date" ).datepicker({
        minDate: startdate,
        defaultDate: "1d",
        changeMonth: true,
        numberOfMonths: 1,
        onClose: function( selectedDate ) {
            var nextDay = new Date(selectedDate);
            nextDay.setDate(nextDay.getDate() + 1);
            jQ("#event_end_date" ).datepicker( "option", "minDate", nextDay );
        }
    });
    jQ("#event_start_date").click(function() {
        jQ( "#event_end_date" ).datepicker({
        defaultDate: "1w",
        changeMonth: true,
        numberOfMonths: 1,
            onClose: function( selectedDate ) {
            jQ("#event_start_date" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
    }); 
jQ(document).ready(function() {
    jQ(".advertise-select").bind("mouseover, mouseenter", function () {
        //this will change the user name to white text as we apply this class
        jQ(this).find(".advertise-select-uploadby").addClass("white-text");
        //this will find the child advertise-select-transparentbg div and slide/show the hidden box
        jQ(this).find(".advertise-select-transparentbg").slideDown(300);
        //this will show the comments, rating information in a delay of 0.2 sec
        jQ(this).find(".advertise-select-info").show(200);
        //we bind when the effect of mouseout and mouseleave on the advertise-select wrapper
    }).bind("mouseout, mouseleave", function () {
        //this will find the child advertise-select-transparentbg div and hide the hidden box
        jQ(this).find(".advertise-select-transparentbg").slideUp(300);
        //this will remove the class white-text we add before and will make the color back to its original color
        jQ(this).find(".advertise-select-uploadby").removeClass("white-text");
        //this will hide the comments, rating information in a delay of 0.3 sec
        jQ(this).find(".advertise-select-info").hide(300);
    });
    /*
    This is optional, if you want to enable url when user click the box, you can use this function. Otherwise you can leave it or remove it from the code.
    */
    jQ(".advertise-select").bind("click", function () {
        window.location.href = "#";
    });
});
</script>
<script>
    var jQuery17 = jQuery.noConflict();
    jQuery(document).ready(function(){
        jQuery('#msform').validationEngine();
    });
</script>
<?php
    $incompete_event_insert_get='';
    $event_start_date_display='';
    $event_end_date_display='';
    $advertising_option='';
    if(isset($campign_status)){
        $campign_status=$campign_status;  
    }else{
        $campign_status='';    
    }
    if($campign_status=='edit'){
        $get_campaign_editdetails=$this->settings_model->get_campaign_editdetails($event_insert_id);  
        if(isset($get_campaign_editdetails) && $get_campaign_editdetails!=''){
            foreach($get_campaign_editdetails as $values){
                $evenstartdate= $values['event_start_date'];
                $event_start_date_display=date('m/d/Y',$evenstartdate);
                $event_end_date_display=date('m/d/Y',$values['event_end_date']);
                $advertising_option=$values['advertising_option'];
            }
        }
    }else{
        $incompete_event_insert_get=$this->settings_model->reopen_incomplete_event($dealer_id_upload_data);
        if(isset($incompete_event_insert_get) && $incompete_event_insert_get!=''){
            foreach($incompete_event_insert_get as $values){
                $evenstartdate= $values['event_start_date'];
                $event_start_date_display=date('m/d/Y',$evenstartdate);
                $event_end_date_display=date('m/d/Y',$values['event_end_date']);
                $advertising_option=$values['advertising_option'];	
            }
        }
    }
?>
    <div id="panel-content" class="panel-load-target scrollable with-padding" style="height:auto;position: relative;  top: 49px;margin: 0 auto;width: 717px;">
        <form id="msform" action="<?php echo base_url()?>campaign/campaignviewpage/<?=$dealer_id_upload_data?>" method="post"style="width: 717px;">
            <?php
            if(isset($event_insert_id) && $event_insert_id!=''){
            ?>
                <input type="hidden"  id="event_insert_id" value="<?=$event_insert_id?>" name="event_insert_edit"/>
            <?php
            }else{
                $event_insert_id='';
                ?>
                <input type="hidden"  id="event_insert_id" value="<?=$event_insert_id?>" name="event_insert_edit"/>
            <?php
            }
            ?>
            <?php
            if($campign_status!=''){
            ?>
                <input type="hidden"  id="campign_status" value="<?=$campign_status?>" name="campign_status"/>
            <?php
            }else{
                $campign_status='';
                ?>
                <input type="hidden"  id="campign_status" value="<?=$campign_status?>" name="campign_status"/>
            <?php
            }
            ?>
            <h2 class="thin mid-margin-bottom" style="color:gray;margin-left: 20px;">READY TO BUILD YOUR EVENT?</h2>
            <div class="mailertextarea" style="width: 95%;margin-left: 20px;box-shadow:0 0 5px 1px;">
                <?php
                if(isset($error)){
                ?>
                    <div style="color: red;text-align: center;"><?php echo $error;?></div>
                <?    
                }
                ?>
                <div class="with-padding" style="margin-top: 15px;text-align: center;">                
                    <div class="label"><h4>PICK EVENT DATES </h4></div>
                    <div>
                        <input type="text" class="input validate[required]" id="event_start_date" name="event_start_date" style="width: 25%;text-align: center;" placeholder="Sale Start Date" value="<?php echo $event_start_date_display?>"/>&nbsp;&nbsp;
                        <input type="text" class="input validate[required]" id="event_end_date" name="event_end_date" style="width: 25%;text-align: center;" placeholder="Sale End Date" value="<?php echo $event_end_date_display;?>"/> 
                    </div>                  
                </div>               
            </div>
            <div class="mailertextarea" style="width: 95%; margin-left: 20px; margin-top: 20px;">
            <h4 style="text-align: center;margin-top:14px;">CHOOSE ADVERTISING OPTIONS</h4><br />
                <div class="imagemaindiv">
                    <div class="advertise-select">
                        <div class="image1">
                            <img src="<?=base_url()?>images/standard/conquest.png" style="width: 100%;cursor: pointer;"  class="masterTooltip" title="Go after your competitor's makes and models and grow your market share with Conquest Mailers from EPS.  Take over your primary marketing area.  "/><br/>
                        </div>
                        <div class="advertise-select-transparentbg">
                            <div class="advertise-select-desc">Go after your competitor's makes and models and grow your market share with Conquest Mailers from EPS.Take over your primary marketing area.  Own your PMA. Add Conquest Mailers to your next Exclusive Private Sale event and dominate the competition!</div>
                        </div>
                    </div>
                    <div class="button anthracite-active" style="height: 42px;margin-left: 46px;margin-top: 17px;"><label class="advertisinglabel"><input type="checkbox" name="advertising_option" value="1" style="width: 22px;box-shadow:none;" class="input validate[required]" <?php echo $advertising_option=='1' ? ' checked ':'';?>/>CONQUEST</label></div>
                </div>
                <div class="imagemaindiv">
                    <div class="advertise-select">
                        <div class="image1">
                            <img src="<?=base_url()?>images/standard/image12.jpg" style="width: 100%;cursor: pointer;" />
                        </div>
                        <div class="advertise-select-transparentbg">
                            <div class="advertise-select-desc">The industries best solution to sending relevant invites to your past customers. Target your customers by vehicle class, transmission type, trade in value or any of our other factors. You'll see higher registrations and more vehicle sales.</div>
                        </div>
                    </div>
                <div class="button anthracite-active " style="height: 42px;margin-left: 27px;margin-top: 17px;"><label class="advertisinglabel"><input type="checkbox" name="advertising_option" value="2" style="width: 22px;box-shadow:none;" class="input validate[required]" <?php echo $advertising_option=='2' ? ' checked ':'';?>/>EPS ADVANTAGE</label></div>
                </div>
            <div class="imagemaindiv" >
                <?php
                $dealer_brand=$this -> settings_model -> getdealerbrands($dealer_id_upload_data);
                foreach($dealer_brand as $values){
                    $dealer_brand_selected=$values['masterbrand'];
                    $dealer_brand_replace=str_ireplace(',',', ',$dealer_brand_selected);
                }
                ?>
                <div class="advertise-select">
                    <div class="image1">
                        <img src="<?=base_url()?>images/standard/image13.jpg" style="width: 100%;cursor: pointer;" />
                    </div>
                    <div class="advertise-select-transparentbg">
                        <div class="advertise-select-desc">Let our mail partner send customized and personalized "upgrade letters" to your past customers. Focused on highlighting the great features of a specific vehicle or the entire <?php echo $dealer_brand_replace;?> lineup, our Upgrader Mailers drive increased conversion rates and higher option upsells.</div>
                    </div>
                </div>
                <div class="button anthracite-active" style="height: 42px;margin-left: 45px;margin-top: 17px;"><label class="advertisinglabel"><input type="checkbox" name="advertising_option" value="3" style="width: 22px;box-shadow:none;" class="input validate[required]" <?php echo $advertising_option=='3' ? ' checked ':'';?>/>UPGRADER</label></div>
            </div>
            <div style="float: none; margin: 0px auto 10px; width: 116px;"><button type="submit" class="submit button glossy mid-margin-right" onclick="validation();" style="float: right; margin-top: 15px; margin-bottom: 10px;">
                <span class="button-icon"><span class="icon-tick"></span></span>
                Confirm
                </button>
            </div>
            <div style="clear: both;"></div>
            </div>
        </form>  
    </div>
<script src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<link rel="stylesheet" href="<?=base_url()?>css/styles/modal.css?v=1">
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/developr.table.js"></script>
<script src="<?=base_url()?>js/developr.modal.js"></script>
<!-- Plugins -->
<script src="<?=base_url()?>js/libs/jquery.tablesorter.min.js"></script>
<script src="<?=base_url()?>js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>