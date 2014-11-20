<style>
    .list-count {
        border-radius: 9px;
        display: block;
        font-size: 13px;
        height: 9px;
        line-height: 16px;
        margin: -11px -21px;
        min-width: 11px;
        position: absolute;
        right: 10px;
        text-align: right;
        text-shadow: none;
        top: 48%;
        border-radius:0px;
    }
    .with-right-arrow:after, .tabs > li > a:after   
    {
        background: url("<?=base_url()?>images/standard/sprites.png");
        background-repeat: no-repeat;
        top:51%;
    } 
    .imageselectedfirst:after 
    {
        background-position: -76px -130px;  
        width: 33px;
        height: 33px;
    } 
    .imageselectedsecond:after 
    {
        background-position: -24px -125px;
        top: 43%;
        width: 30px;
        height: 44px;
    } 
    .submenusselction{
        background-position: -77px -103px;
    }
    .submenusunselectionselction{
        background-position: -32px -34px;
    }
    #panel-nav .navigable
    {
        overflow-x:visible; 
        overflow-y:visible; 
        min-height: 740px!important; 
    }
    </style>
<script type='text/JavaScript' src='<?=base_url()?>js/jacs.js'></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
    function showeventdatesection(){
        $('#event_date_section').toggle();
    }
    function camapine_selction(){
        var select_option=$('#configuredcamp').val();
        if(select_option=='custom_campaign'){    
            $('.show_leadsection_custom').toggle(); 
        }else{
            $('.show_leadsection').toggle();
        }
    }
    function viewleadlist(){
        $('#viewleadlist').toggle(); 
    }
    function select_mailer_option(){
        $('#mailer_option').toggle(); 
    }
    </script>
<?php
$segment=$this->uri->segment(2);
    if($segment=='campaignviewpage'){
        ?>
        <script>
            $( document ).ready(function() {
                $('.show_leadsection').toggle();
            });
        </script>
        <?php
        }else if($segment=='customerlist' ||  $segment=='sale_leadlist'){
        ?>
        <script>
            $( document ).ready(function() {
                $('#viewleadlist').toggle();
            });
        </script>
        <?php   
        }else if($segment=='mailoutoption'){
        ?>
            <script>
                $( document ).ready(function() {
                    $('#mailer_option').toggle();
                });
            </script>
        <?php   
        }else{
        ?>
            <script>
            $( document ).ready(function() {
                $('#event_date_section').toggle();
            });
            </script>
        <?php   
        }
        if(isset($event_insert_id) && $event_insert_id!=''){
            $event_insert_id=$event_insert_id; 
            $ststes_fields=$this -> settings_model -> choose_advert_event_select($dealer_id_upload_data,$event_insert_id);  
        }else{
            $event_insert_id='';  
            $ststes_fields='';
        }
        if(isset($ststes_fields) && $ststes_fields=='1'){
            $class='imageselectedsecond'; 
            $class_submenu='submenusselction'; 
        }else{
            $class='imageselectedfirst'; 
            $class_submenu='submenusunselectionselction' ; 
        }
        if(isset($incomplete_event)&& $incomplete_event!='' ){
            $campaine_step='campaine_select';  
        }
        //campaine secion
        if(isset($campaine_step) && $campaine_step!=''){
            $camapin_fields=$this -> settings_model -> campaign_select($event_insert_id); 
        }else{
            $camapin_fields='';
        }
        if($camapin_fields!=''){
            foreach($camapin_fields as $values){
                if($values['step1_select']=='1'){
                    $class_step1='submenusselction'; 
                }else{
                    $class_step1='submenusunselectionselction' ; 
                } 
                if($values['lead_mining_presets']=='custom_campaign'){
                    $class_step2='submenusselction'; 
                }else{
                    $class_step2='submenusunselectionselction' ; 
                }
                if($values['step3_select']=='1'){
                    $class_step3='submenusselction'; 
                }else{
                    $class_step3='submenusunselectionselction' ; 
                } 
                //main class selection if advanced selection (Bule tick mark)
                if($values['advancedoption_select']!=1){
                    if($values['step1_select']==1 && $values['step3_select']==1){
                        $class_campaine='imageselectedsecond'; 
                    }else{
                        $class_campaine='imageselectedfirst';   
                    }
                }else{
                    if($values['step1_select']==1 && $values['step3_select']=='1' && $values['advancedoption_select']=='1' ){
                        $class_campaine='imageselectedsecond';
                    }else{
                        $class_campaine='imageselectedfirst'; 
                    }
                }
            }
        }else{
            $class_step1='submenusunselectionselction' ; 
            $class_step2='submenusunselectionselction' ; 
            $class_step3='submenusunselectionselction' ; 
            $class_campaine='imageselectedfirst'; 
        }
        if(isset($leadlist) && $leadlist!=''){
            $lead_step='leadlist';  
        }
        //leadsection selection
        if(isset($lead_step) && $lead_step!=''){
            $lead_selection=$this -> settings_model -> leadsection_select($event_insert_id); 
        }else{
            $lead_selection='';
        }
        if($lead_selection!=''){
            foreach($lead_selection as $values){
                if($values['equity_scrap']!=0 || $values['model_break_down']!=0 || $values['fuel_effciency']!=0 || $values['wrranty_scrap']!=0 || $values['custom_campain']!=0){
                    $customer_leadlist_equity_scrap_count=$this -> settings_model -> getleadcount($event_insert_id,'1');
                    $customer_leadlist_model_breakdown_count=$this -> settings_model -> getleadcount($event_insert_id,'2');
                    $customer_leadlist_fuel_efficiency_count=$this -> settings_model -> getleadcount($event_insert_id,'3');
                    $customer_leadlist_warrant_scarp_count=$this -> settings_model -> getleadcount($event_insert_id,'4');
                    $customer_leadlist_advance_option_count=$this -> settings_model -> getleadcount($event_insert_id,'5');
                    if($customer_leadlist_equity_scrap_count!=0 || $customer_leadlist_model_breakdown_count!=0 || $customer_leadlist_fuel_efficiency_count!=0 || $customer_leadlist_warrant_scarp_count!=0 || $customer_leadlist_advance_option_count!=0 ){
                        $class_lead_main='imageselectedsecond'; 
                        $class_lead_sub='submenusselction';
                    }else {
                        $class_lead_main='imageselectedfirst'; 
                        $class_lead_sub='submenusunselectionselction';
                    }
                }else{
                    $class_lead_main='imageselectedfirst'; 
                    $class_lead_sub='submenusunselectionselction';
                }
            }
        }else{
            $class_lead_main='imageselectedfirst'; 
            $class_lead_sub='submenusunselectionselction';
        }
        //mailout options
        if(isset($mailout) && $mailout!=''){
            $mailout_selection=$this -> settings_model -> mailout_option_select($event_insert_id); 
        }else{
            $mailout_selection='';
        }
        if($mailout_selection!=''){
            foreach($mailout_selection as $values){
                if($values['step1_select']==1 && $values['step2_select']==1 && $values['step3_select']==1 && $values['step4_select']==1){
                    $class_mailout='imageselectedsecond'; 
                    $class_mailout_sub='submenusselction';
                }else{
                    $class_mailout='imageselectedfirst'; 
                    $class_mailout_sub='submenusunselectionselction'; 
                }
            }
        }else{
            $class_mailout='imageselectedfirst'; 
            $class_mailout_sub='submenusunselectionselction';
        }
?>
<script type='text/JavaScript' src='<?=base_url()?>js/jacs.js'></script>
<!--Campign page starts here-->
    <div class="panel-navigation silver-gradient" style="top: 65px;left: 69px;min-height: 740px;">
        <div id="panel-nav" class="panel-load-target scrollable" style="position:none;">
            <div class="navigable">
                <ul class="unstyled-list open-on-panel-content">
                    <li class="title-menu" style="height: 33px; padding-top: 18px;"><h4>Event Build Process</h4></li>
                    <li class="big-menu grey-gradient with-right-arrow <?php echo $class?>" onclick="showeventdatesection()">
                    <span>Date & Marketing</span></li>
                    <li class="message-menu" style="display: none;" id="event_date_section">
                        <span class="message-status" style="width: 146px;">
                        <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                        <?php
                        if($event_insert_id!=''){
                            $event_id=$event_insert_id;      
                        }else{
                            $event_id=0;
                        }
                        ?>
                        <a href="<?=base_url()?>campaign/<?php echo $dealer_id_upload_data?>" title="Read message">
                        <strong class="blue">Date & Marketing</strong><br/>
                        </a></span>
                        <span class="message-status" style="width: 200px;">
                       <a href="<?=base_url()?>campaign/advertising_option/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>" class="new-message <?php echo $class_submenu?>" title="Choose List File" style="margin-top: 8px; float: left; width: 16px;">Choose Advertising Options</a>
                       <a href="<?=base_url()?>campaign/advertising_option/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>" title="Choose List File" style="margin-top: 8px; float: left; margin-left: 10px;"> 
                       <strong><span style="color:hsl(0, 0%, 30%);">Choose Advertising Options</span></strong></a>
                        </span>
                    </li>
                    <li class="big-menu grey-gradient with-right-arrow <?php echo $class_campaine?>" onclick="camapine_selction()">
                    <span>Lead Selection</span></li>
                    <?php
                    //display campaine side menu on to lead section list
                    if(isset($campaine_step) && $campaine_step!=''){
                        if($camapin_fields!=''){
                            foreach($camapin_fields as $values){
                                if($values['lead_mining_presets']=='custom_campaign'){ 
                                        if($event_insert_id!=''){
                                            $event_id=$event_insert_id;      
                                        }else{
                                            $event_id=0;
                                        }
                                        ?>
                                        <li class="message-menu show_leadsection" style="min-height:78px;display: none;" id="advancedoption_capaine_select">
                                            <span class="message-status" style="width: 137px;">
                                                <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                                                <a href="#" title="Read message"><strong class="blue">EPS Advantage</strong><br/></a>
                                            </span> 
                                            <span class="message-status" style="width: 200px;">
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/adv_step1" class="new-message <?php echo $class_step1?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select_advanced">Step 1</a>                       
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/adv_step1" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                                <strong><span style="color:hsl(0, 0%, 30%);">Step 1</span></strong></a>
                                            </span>
                                            <span class="message-status" style="width: 200px;">
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/adv_step2" class="new-message <?php echo $class_step2?>" title="Lead Filtering" onclick="changesecondtabs();" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step2">Step 2</a>                       
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/adv_step2" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                            <strong><span style="color:hsl(0, 0%, 30%);">Step 2</span></strong></a>
                                            </span>
                                            <span class="message-status" style="width: 200px;">
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/adv_step3" class="new-message <?php echo $class_step3?>" title="Custom Options"  style="margin-top: 6px;float: left; width: 16px;">Step 3</a>                     
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/adv_step3" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                                <strong><span style="color:hsl(0, 0%, 30%);">Step 3</span></strong></a>
                                            </span>
                                    </li>
                                    <?php  
                                    }else{
                                        if($event_insert_id!=''){
                                            $event_id=$event_insert_id;      
                                        }else{
                                            $event_id=0;
                                        }
                                    ?>
                                    <li class="message-menu show_leadsection" style="min-height:78px;display: none;" id="advancedoption_capaine_unselection">
                                    <span class="message-status" style="width: 137px;">
                                                <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                                                <a href="#" title="Read message"><strong class="blue">EPS Advantage</strong><br/></a>
                                            </span> 
                                       <span class="message-status" style="width: 200px;">
                                            <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step1" class="new-message <?php echo $class_step1?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step1" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                                <strong><span style="color:hsl(0, 0%, 30%);">Step 1</span></strong></a>
                                            </span>  
                                            <span class="message-status" style="width: 200px;">
                                            <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step2" class="new-message <?php echo $class_step1?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                                <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step2" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                                <strong><span style="color:hsl(0, 0%, 30%);">Step 2</span></strong></a>
                                            </span>       
                                    </li>
                                    <?php
                                    }
                                }
                            }
                        }else{
                           if($event_insert_id!=''){
                                $event_id=$event_insert_id;      
                            }else{
                                $event_id=0;
                            }
                                    ?>
                            <li class="message-menu show_leadsection" style="min-height:78px;display: none;" id="advancedoption_capaine_unselection">
                                <span class="message-status" style="width: 137px;">
                                    <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                                    <a href="#" title="Read message"><strong class="blue">EPS Advantage</strong><br/></a>
                                </span> 
                                <span class="message-status" style="width: 200px;">
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step1" class="new-message <?php echo $class_step1?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step1" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                    <strong><span style="color:hsl(0, 0%, 30%);">Step 1</span></strong></a>
                                </span>
                                <span class="message-status" style="width: 200px;">
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step2" class="new-message <?php echo $class_step3?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step2" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                    <strong><span style="color:hsl(0, 0%, 30%);">Step 2</span></strong></a>
                                </span>
                            </li>
                            <li class="message-menu show_leadsection_custom" style="min-height:78px;display:none" id="advancedoption_capaine_select">
                                <span class="message-status" style="width: 137px;">
                                    <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                                    <a href="#" title="Read message"><strong class="blue">EPS Advantage</strong><br/></a>
                                </span> 
                                <span class="message-status" style="width: 200px;">
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step1" class="new-message <?php echo $class_step1?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step1" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                    <strong><span style="color:hsl(0, 0%, 30%);">Step 1</span></strong></a>
                                </span>
                                <span class="message-status" style="width: 200px;">
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step2" class="new-message <?php echo $class_step3?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step2" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                    <strong><span style="color:hsl(0, 0%, 30%);">Step 2</span></strong></a>
                                </span>
                                <span class="message-status" style="width: 200px;">
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step3" class="new-message <?php echo $class_step3?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                                    <a href="<?=base_url()?>campaign/linkto_step1/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/campign_step3" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                                    <strong><span style="color:hsl(0, 0%, 30%);">Step 3</span></strong></a>
                                </span>
                            </li>
                        <?php
                        }
                        ?>
                    <li class="big-menu grey-gradient with-right-arrow <?php echo $class_lead_main?>" onclick="viewleadlist();">
                    <span>View Lead List</span></li>
                     <?php
                        if($event_insert_id!=''){
                            $event_id=$event_insert_id;      
                        }else{
                            $event_id=0;
                        }
                        ?>
                    <li class="message-menu" id="viewleadlist" style="display: none;">
                        <span class="message-status" style="width: 99px;">
                            <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                            <a href="#" title="Read message"><strong class="blue">Lead List</strong><br/></a>
                        </span> 
                        <span class="message-status" style="width: 200px;">
                            <a href="<?=base_url()?>campaign/sale_leadlist/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>" class="new-message <?php echo $class_lead_sub?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="campaine_step1_select">Step 1</a>
                            <a href="<?=base_url()?>campaign/sale_leadlist/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                            <strong><span style="color:hsl(0, 0%, 30%);">Confirm Lead List</span></strong></a>
                        </span>
                    </li>
                    <li class="big-menu grey-gradient with-right-arrow <?php echo $class_mailout?> " id="mailerlaststep" onclick="select_mailer_option()">
                    <span>Mailer Option</span></li>
                     <?php
                    if($event_insert_id!=''){
                        $event_id=$event_insert_id;      
                    }else{
                        $event_id=0;
                    }
                    ?>
                    <li class="message-menu" style="min-height:115px;display:none;" id="mailer_option">
                        <?php
                        if($event_insert_id!=''){
                            $event_id=$event_insert_id;      
                        }else{
                            $event_id=0;
                        }
                        ?>
                        <span class="message-status" style="width: 126px;">
                            <a href="#" class="starred" title="starred" style="float: left;">starred</a>
                            <a href="#" title="Read message"><strong class="blue">Mailer Option</strong><br/></a>
                        </span> 
                         <span class="message-status" style="width: 200px;">
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/1" class="new-message <?php echo $class_mailout_sub?>" title="Choose List File" style="margin-top: 6px;float: left; width: 16px;" id="choose_mailer_step1">Step 1</a>
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/1" title="Choose List File" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                            <strong><span style="color:hsl(0, 0%, 30%);">Step 1</span></strong></a>
                        </span>
                        <span class="message-status" style="width: 200px;">
                        <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/2" class="new-message <?php echo $class_mailout_sub?>" title="Lead Filtering" style="margin-top: 6px;float: left; width: 16px;" id="choose_mailer_step2">Step 2</a>
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/2" title="Lead Filtering" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                            <strong><span style="color:hsl(0, 0%, 30%);">Step 2</span></strong></a>
                        </span>
                        <span class="message-status" style="width: 200px;">
                        <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/3" class="new-message <?php echo $class_mailout_sub?>" title="Custom Options" style="margin-top: 6px;float: left; width: 16px;" id="choose_mailer_step3">Step 3</a>
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/3" title="Lead Filtering" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                            <strong><span style="color:hsl(0, 0%, 30%);">Step 3</span></strong></a>
                        </span>
                        <span class="message-status" style="width: 200px;">
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/4" class="new-message <?php echo $class_mailout_sub?>" title="Custom Options" style="margin-top: 6px;float: left; width: 16px;" id="choose_mailer_step4">Step 4</a>
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/4" title="Lead Filtering" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                            <strong><span style="color:hsl(0, 0%, 30%);">Step 4</span></strong></a>
                        </span>
                        <span class="message-status" style="width: 200px;">
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/5" class="new-message <?php echo $class_mailout_sub?>" title="Custom Options" style="margin-top: 6px;float: left; width: 16px;" id="choose_mailer_step5">Step 5</a>
                            <a href="<?=base_url()?>campaign/linkto_maileroption/<?php echo $event_id?>/<?php echo $dealer_id_upload_data?>/5" title="Lead Filtering" style="margin-top: 6px; float: left; margin-left: 10px;"> 
                            <strong><span style="color:hsl(0, 0%, 30%);">Step 5</span></strong></a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>