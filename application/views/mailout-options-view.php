<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/equipment1.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/equipment2.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/equipment3.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/equipment4.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/equipment5.css" media="all" />
<script type="text/javascript" src="<?=base_url()?>js/equipment-jquery-gallery.js"></script>
<!-- Add jQuery library -->
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery-1.10.1.min.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<? echo base_url()?>fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<style>
    /*custom font*/
    @import url(http://fonts.googleapis.com/css?family=Montserrat);
    /*basic reset*/
    * {margin: 0; padding: 0;}
    html {
    height: 100%;
    /*Image only BG fallback*/
    background: url('<?=base_url()?>images/standard/gs.png');
    /*background = gradient + image pattern combo*/
    background: 
    linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
    url('<?=base_url()?>images/standard/gs.png');
    }
    /*form styles*/
    #msform {
        margin-top: 86px;
        text-align: center;
        margin-bottom: 31px;
    }
    #msform fieldset {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        margin: 0 0 0 10%;
        padding: 20px 0;
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
        font-family: montserrat;
        color: #2C3E50;
        font-size: 13px;
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
        margin-left: 0;
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
    .imagefirst{
        border: 1px solid #D9DCE1;
        box-shadow: 0 0 3px 1px;
        float: left;
        height: 210px;
        padding-bottom: 16px;
        padding-left: 16px;
        padding-top: 5px;
        width: 40%;
    }
    .imagesecond{
        border: 1px solid #D9DCE1;
        box-shadow: 0 0 3px 1px;
        float: left;
        height: 210px;
        margin-left: 30px;
        padding-bottom: 16px;
        padding-left: 17px;
        padding-top: 5px;
        width: 40%;
    }
    .reporttype{
        text-align: left;
        width: 90%;
    }
    ul, ol {
        margin-left: 13.8em;
    }
    input[type=checkbox]{
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.2); /* IE */
        -moz-transform: scale(1.2); /* FF */
        -webkit-transform: scale(1.2); /* Safari and Chrome */
        -o-transform: scale(1.2); /* Opera */
    }
    h4{
        font-size: 16px;
    }
    .reporttypeget{
        float: left;
        height: 45px;
        margin-left: 71px;
        margin-top: 10px;
        text-align: center;
        width: 130px;   
    }
    .advertisinglabel{
        float: left;
        margin-top: 10px;
        text-align: center;
    }
    .tooltip {
        cursor: help; text-decoration: none;
        position: relative;
        white-space:normal;
    }
    .tooltip span{
        color: #4C4C4C;
        font-size: 13px;
        font-weight: bold;
        margin-left: -959em;
        position: absolute;
        width: 187px !important;
    }
    .tooltip:hover span {
        border-radius: 5px 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; 
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 5px 5px rgba(0, 0, 0, 0.1); -moz-box-shadow: 5px 5px rgba(0, 0, 0, 0.1);
        font-family: Calibri, Tahoma, Geneva, sans-serif;
        position: absolute; left: 1em; top: 2em; z-index: 99;
        margin-left: 0; width: 250px;
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
    .critical { background: #FFCCAA; border: 1px solid #FF3334;	}
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
    .fancybox-custom .fancybox-skin {
        box-shadow: 0 0 50px #222;
    }
    .fancybox-close {
        height: 39px;
        right: -10px;
        top: -20px;
        width: 34px;
    }
    .fancybox-nav span {
        right: -15px !important;
        width: 35px;
    }
    .fancybox-prev span {
        left: -16px;
    }
</style>
<script type="text/javascript" src="<?=base_url()?>highslide/highslide-with-html.js"></script>
<script type="text/javascript" src="<?=base_url()?>highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>highslide/highslide.css" />
<script type="text/javascript">
    hs.registerOverlay({
        html: '<div class="closebutton" onclick="return hs.close(this)" title="Close"></div>',
        position: 'top right',
        top:'316px',
        fade: 2 // fading the semi-transparent overlay looks bad in IE
    });
    hs.graphicsDir = '<?=base_url()?>highslide/graphics/';
    hs.outlineType = 'rounded-white';
    hs.wrapperClassName = 'draggable-header';
</script>
<script>
$( document ).ready(function() {
    <?php
    if(isset($editted_step) && $editted_step!=''){
        if($editted_step=='1'){
        ?>
            $('#mailer_option').toggle(); 
            $('#event_date_section').hide();
            redirectpage();
        <?php
        }elseif($editted_step=='2'){
        ?>
            $('#mailer_option').toggle(); 
            $('#event_date_section').hide();
            redirectpageversion();
            <?php   
        }elseif($editted_step=='3'){
        ?>
            $('#mailer_option').toggle(); 
            $('#event_date_section').hide();
            specialoption();
        <?php   
        }elseif($editted_step=='4'){
        ?>
            $('#mailer_option').toggle();
            $('#event_date_section').hide(); 
            upgradepricing();
        <?php   
        }elseif($editted_step=='5'){
        ?>
            $('#mailer_option').toggle(); 
            $('#event_date_section').hide();
            reviewoption();
        <?php   
        }
    }
?>
});
</script>
    <section role="main" id="main" style="margin-left: 315px;">
        <!-- multistep form -->
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" style="color: black;width: 111px;cursor: pointer;" id="scale_campaigns" onclick="redirectpage()">Step 1</li>
                <li style="color: black;width: 111px;cursor: pointer;" id="versioning" onclick="redirectpageversion();">Step 2</li>
                <li style="color: black;width: 111px;cursor: pointer;" onclick="specialoption();" id="special_option">Step 3</li>
                <li style="color: black;width: 101px;cursor: pointer;" onclick="upgradepricing();" id="upgradepricing">Step 4</li>
                <li style="color: black;width: 101px;cursor: pointer;" onclick="reviewoption();" id="review">Step 5</li>
            </ul>
            <!--Display image-->
            <div class="feature" style="width: 634px; margin-top: 0px;padding-left:0px;" id="gallery">
                <div id="photos_div" class="main_content" style="display: block;">
                    <script type="text/javascript">
                        $jQ = jQuery.noConflict();
                        function mailer_step1_insert(){
                            var mailer_size=$jQ('input[name=mailer_size]:checked').val();
                            if(mailer_size!='undefined'){
                                mailer_size=mailer_size;  
                            }else{
                                mailer_size='';
                            }
                            var largeinvitecost=$jQ('#largeinvitecost').val();
                            var smallinvitecost=$jQ('#smallinvitecost').val();
                            $jQ.ajax({
                                url: "<?php echo base_url()?>campaign/insert_mailer_step1",
                                data: 'mailer_size=' + mailer_size+ '&largeinvitecost=' + largeinvitecost+'&smallinvitecost=' + smallinvitecost,
                                type: "POST",
                                success: function(data){
                                    $jQ('#choose_mailer_step1').addClass("submenusselction");
                                    $jQ('#choose_mailer_step1').removeClass("submenusunselectionselction");
                                }
                            });  
                        }
                        function mailer_step2_insert(){
                            var versioning=$jQ('input[name=versioning]:checked').val();
                            $jQ.ajax({
                                url: "<?php echo base_url()?>campaign/insert_mailer_step2",
                                data: 'versioning=' + versioning,
                                type: "POST",
                                success: function(data){
                                    $jQ('#choose_mailer_step2').addClass("submenusselction");
                                    $jQ('#choose_mailer_step2').removeClass("submenusunselectionselction");
                                }
                            });  
                        }
                        function mailer_step3_insert(){
                            var auto_pen=$jQ('input[name=auto_pen]:checked').val();
                            var insert_cardstock=$jQ('input[name=insert_cardstock]:checked').val();
                            var insert_paperstock=$jQ('input[name=insert_paperstock]:checked').val();
                            var variable_image=$jQ('input[name=variable_image]:checked').val();
                            var colored_envelop=$jQ('input[name=colored_envelop]:checked').val();
                            $jQ.ajax({
                                url: "<?php echo base_url()?>campaign/insert_mailer_step3",
                                data: 'auto_pen=' + auto_pen+ '&insert_cardstock=' + insert_cardstock+ '&insert_paperstock=' + insert_paperstock+ '&variable_image=' + variable_image+ '&colored_envelop=' + colored_envelop,
                                type: "POST",
                                success: function(data){
                                    if(data=='Done'){
                                        $jQ('#choose_mailer_step3').addClass("submenusselction");
                                        $jQ('#choose_mailer_step3').removeClass("submenusunselectionselction");
                                    }
                                }
                            });  
                        }
                        function mailer_step4_insert(){
                            var upgrade_package=$jQ('input[name=upgrade_package]:checked').val();
                            $jQ.ajax({
                                url: "<?php echo base_url()?>campaign/insert_mailer_step4",
                                data: 'upgrade_package=' + upgrade_package,
                                type: "POST",
                                success: function(data){
                                    if(data=='Done'){
                                        $jQ('#choose_mailer_step4').addClass("submenusselction");
                                        $jQ('#choose_mailer_step4').removeClass("submenusunselectionselction");
                                        $jQ('#choose_mailer_step5').addClass("submenusselction");
                                        $jQ('#choose_mailer_step5').removeClass("submenusunselectionselction");
                                        $jQ('#mailerlaststep').addClass("imageselectedsecond");
                                        $jQ('#mailerlaststep').removeClass("imageselectedfirst");
                                    } 
                                }
                            });  
                        }
                        function download_pdf(event_id,dealer_id){
                            window.open('<?php echo base_url()?>downloadpdf/create_pdf/'+event_id+'/'+dealer_id);
                        }
                        /*
                        *  Simple image gallery. Uses default settings
                        */
                        $jQ('.fancybox').fancybox();
                        $jQ(".fancybox-effects-a").fancybox({
                            helpers: {
                                title : {
                                    type : 'outside'
                                },
                                overlay : {
                                    speedOut : 0
                                }
                            }
                        });
                        $jQ(document).ready(function () {
                            /* This is basic - uses default settings */
                            $jQ("a.iframe").fancybox();
                        });
                        function displaystep(){
                            $jQ('#step6').show();
                        }
                        function hidesubmit(){
                            $jQ('#step6').hide();
                        }
                        function submitleaddetails(){
                            var i=0;
                            var j=0;
                            var p=0;
                            var email_address=$jQ('#email_address').val();
                            if($jQ('#dealer_email').is(':checked')){
                                i=1;
                            }else{
                                i=0; 
                            }
                            if($jQ('.account_manager_email').is(':checked')){
                                j=1; 
                            }else{
                                j=0;  
                            }
                            if(email_address==''){
                                p=0;  
                            }else{
                                p=1;   
                            } 
                            if(i!=0 || j!=0 || p!=0){          
                                $jQ('#leadlist-form').submit();
                            }else{
                                $('#showmessage').html('<font color="red">Please select atleast one email address</font>'); 
                            }
                        }
                    </script>
                    <div class="ad-gallery">
                    </div>
                <!-- ends -->
                </div>
            </div>      
        <!-- fieldsets -->
        <fieldset id="step1" style="float: none;">
            <?php
            $date=time();
            $newdate = strtotime ( '-2 year' , $date  ) ;
            $newdate1 = strtotime ( '-18 month' , $date  ) ;
            //echo date('m/d/Y',$newdate1);
            $invite_type='';
            $insert_cardstock='';
            $variable_imaging='';
            $colored_envelopes='';
            $upgrader_package='';
            $autoPen='';
            $insert_paperstock='';
            $versioning='';
            $colored_envelop='';
            $get_mailout_option=$this->settings_model->get_mailout_option_details($event_insert_id);
            if(isset($get_mailout_option) || $get_mailout_option!=''){
                $invite_type=$get_mailout_option[0]['mailer_size'];
                $autoPen=$get_mailout_option[0]['autopen'];
                $insert_cardstock=$get_mailout_option[0]['insert_cardstock'];
                $insert_paperstock=$get_mailout_option[0]['insert_paperstock'];
                $variable_imaging=$get_mailout_option[0]['variable_imaging']; 
                $colored_envelopes=$get_mailout_option[0]['colored_envelopes'];	
                $upgrader_package=$get_mailout_option[0]['upgrader_package'];
                $versioning=$get_mailout_option[0]['versioning'];
                $colored_envelop=$get_mailout_option[0]['colored_envelopes'];
            }
            $leadcount_get=$this->settings_model->get_customer_leadcount($event_insert_id);
            if(isset($leadcount_get) && $leadcount_get!=''){
                $leadcount_get=$leadcount_get;   
            }else{
                $leadcount_get=''; 
            }
            $price_invies_small_invites='';
            $price_invies_larger_invites='';
            $price_invies_small_invites=$this->settings_model->get_cost_of_smallinvites($leadcount_get);
            $price_invies_larger_invites=$this->settings_model->get_cost_of_largerinvites($leadcount_get);
            ?>
            <div class="with-padding" style="width: 627px;">
                <div class="mailheading">Choose Your Invite Size</div>
                <div class="mailertextarea">Welcome to the EPS ADVANTAGE invite configuator. We've provided this step by step method to create the perfect invites for your past customers. Onces you are done all of your options will be reviewed by your Account Manager at EPS to make sure you are getting the best results possible for your next Exclusive Private Sale.
                <br />Note: Each of your lead groups that you created in the previous steps will receive a unique looking invite.</div>
                <div class="gallaryimagediv">
                    <div class="imagefirst">
                        <h4 style="color:#666666;padding-top: 10px; padding-bottom: 14px;margin-bottom:0px;">Small Invite (5.5x4.25")</h4>
                        <div class="ad-gallery">
                            <ul>
                                <li>
                                <img src="<?=base_url()?>images/standard/image5.5.jpg" style="width:211px;"/> 
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="imagesecond" >
                        <h4 style="color:#666666;padding-top: 10px; padding-bottom: 14px;margin-bottom:0px;">Large Invite (8.5x5.5")</h4>
                            <div class="ad-gallery" >
                                <ul >
                                    <li>
                                    <img src="<?=base_url()?>images/standard/image5.5.jpg" style="width: 244px;"/></li>
                                </ul>
                            </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
                <div class="mailheading" style="padding-top: 15px; font-size: 15px;margin-bottom:3px;">
                    <a class="fancybox" href="<?=base_url()?>invitations/1car275x182.png" data-fancybox-group="gallery" >View our gallery of example invites</a>
                    <a class="fancybox" href="<?=base_url()?>invitations/1car425x281.png" data-fancybox-group="gallery" >
                    <a class="fancybox" href="<?=base_url()?>invitations/2car275x182.png" data-fancybox-group="gallery"></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/2car425x281.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/3car275x182.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/3car425x281.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/4car275x182.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/4car425x281.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/5car275x182.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/5car425x281.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/6car275x182.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/6car425x281.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/goat275x219.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/goat425x338.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/red-truck275x219.png" data-fancybox-group="gallery" ></a>
                    <a class="fancybox" href="<?=base_url()?>invitations/red-truck425x338.png" data-fancybox-group="gallery" ></a>
                </div>
                <div style="float: left;width:57%">
                    <div class="reporttypeget button anthracite-active" style="text-align: center;margin-top: 10px;float:left;">
                        <label class="advertisinglabel">
                        <input type="radio" name="mailer_size" value="smallinvites" id="smallinvites" <?php if($invite_type=='smallinvites'){ echo 'checked';}else{ }?> style="width: 22px;box-shadow:none;" class="input validate[required]"/>Small Invite Size</label>
                    </div>
                    <?php
                    if($leadcount_get!='' && $price_invies_small_invites!=''){
                    ?>
                        <div style="float: left;" class="lead_price">$<?php echo ($price_invies_small_invites)?> / Invite</div>
                    <?php
                    }
                    ?>
                    <input type="hidden" name="smallinvitecost" id="smallinvitecost" value="<?php echo ($price_invies_small_invites*$leadcount_get)?>"/>
                </div>
                <div style="float: left;width:43%">
                    <div class="reporttypeget button anthracite-active" style="text-align: center;margin-top: 10px;float:right;margin-left: 0px;margin-right:56px;">
                        <label class="advertisinglabel">
                        <input type="radio" name="mailer_size" value="largeinvites" id="smallinvites" <?php if($invite_type=='largeinvites'){ echo 'checked';}else{ }?> style="width: 22px;box-shadow:none;" class="input validate[required]"/>Large Invite Size</label>
                    </div>
                <?php
                if($leadcount_get!='' && $price_invies_larger_invites!=''){
                ?>
                    <div style="float: left;margin-left: 89px;" class="lead_price">$<?php echo ($price_invies_larger_invites)?> / Invite</div>
                <?php
                }
                ?>
                </div>
            </div>
            <input type="hidden" name="largeinvitecost" id="largeinvitecost" value="<?php echo ($price_invies_larger_invites*$leadcount_get)?>"/>
            <div style="clear: both;height: 25px;"></div>
                <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next" onclick="mailer_step1_insert();">
                    <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                    Next
                </button>
        </fieldset>
        <fieldset id="step2">
            <div class="with-padding" >
            <?php
            $group=0;
            $get_selected_lead_group=$this->settings_model->leadsection_select($event_insert_id);
            foreach($get_selected_lead_group as $values){
                if($values['equity_scrap']!='0'){
                $get_selected_lead_group=$this->settings_model->getleadcount($event_insert_id,'1');
                    if($get_selected_lead_group!=0){
                        $group=$group+1;
                    } 
                }
                if($values['model_break_down']!='0'){
                    $get_selected_lead_group=$this->settings_model->getleadcount($event_insert_id,'2');
                    if($get_selected_lead_group!=0){
                        $group=$group+1;
                    }
                }
                if($values['fuel_effciency']!='0'){
                    $get_selected_lead_group=$this->settings_model->getleadcount($event_insert_id,'3');
                    if($get_selected_lead_group!=0){
                        $group=$group+1;
                    }
                }
                if($values['wrranty_scrap']!='0'){
                    $get_selected_lead_group=$this->settings_model->getleadcount($event_insert_id,'4');
                    if($get_selected_lead_group!=0){
                        $group=$group+1;
                    }
                }
                if($values['custom_campain']!='0'){
                    $get_selected_lead_group=$this->settings_model->getleadcount($event_insert_id,'5');
                    if($get_selected_lead_group!=0){
                        $group=$group+1;
                    } 
                }
                if($values['fuel_efficiency_report6']!='0'){
                    $get_selected_lead_group=$this->settings_model->getleadcount($event_insert_id,'6');
                    if($get_selected_lead_group!=0){
                        $group=$group+1;
                    }
                }
            }
            ?>
            <div class="mailheading">Versioning</div>
            <label style="color: grey;float: left; text-align: left;margin-bottom: 10px;font-size:13px;">Part of the EPS Advantage is being able to send the right mailer to the right lead. It's how we drive more sales and give your dealership the best ROI on it's advertising. By default we will create a version of your mailout for each group in your campaign. If you would like everyone to get the same mailer you can opt-out of our Versioning below.</label>
            <?php
            if($versioning==''){
            ?>
                <div class="reporttype" style="text-align: center;">
                    <label> <input type="checkbox"  checked name="versioning" id="versioning" value="1" style="width:4%;"/>
                    <label class="cost_version">(<?php echo $group?>-1) X $85</label></label>
                </div>
            <?php
            }else{
            ?>
                <div class="reporttype" style="text-align: center;">
                    <label> <input type="checkbox"  <?php if($versioning=='1'){ echo 'checked';}else{ }?> name="versioning" id="versioning" value="1" style="width:4%;"/>
                    <label class="cost_version">(<?php echo $group?>-1) X $85</label></label>
                </div>
            <?php
            }
            ?>
            </div>      
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous" name="previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next" onclick="mailer_step2_insert();">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
        </fieldset>
        <fieldset id="step3">
            <div class="with-padding" > 
                <div class="mailheading">Special Options</div>
                <label class="mailoutoptionsdescription">The following options can be added to your campaign. These are proven methods at creating a mail out that will get more attention, and drive more potential customers into your dealership.</label>
                <div style="width: 100%;float:left">
                    <div class="reporttype">
                        <label class="mailoutcheckboxtext" ><input type="checkbox" <?php if($autoPen=='1'){ echo ' checked';}else{ }?> name="auto_pen" style="width: 31px;" id="auto_pen" value="1"/>
                        AutoPen ($0.36/piece)<label style="width: 20px;float:none;margin-left:6px;"><a class="tooltip" href="#">
                        <img src="<?=base_url()?>images/questionmark.png"/>
                        <span class="classic">Give your invites a personal touch with a handwritten return address, mailing address or even your signature. Designed to ensure higher invite engagement and more registrations to your event.</span></a></label></label>
                    </div>
                    <div class="reporttype">
                        <label class="mailoutcheckboxtext"><input type="checkbox" name="insert_cardstock" style="width: 31px;" <?php if($insert_cardstock=='1'){ echo ' checked';}else{ }?> id="insert_cardstock" value="1"/>
                        Insert - Cardstock ($0.60/piece)<label style="width: 20px;float:none;margin-left:6px;">
                        <a class="tooltip" href="#"><img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Add some extra incentives, promote a contest or even push a separate vehicle to all your invitees. Printed on the same high quality paper that your invite is printed on.</span></a></label></label>
                    </div>
                    <div class="reporttype">
                        <label class="mailoutcheckboxtext"> <input type="checkbox" name="insert_paperstock" style="width: 31px;" <?php if($insert_paperstock=='1'){ echo ' checked';}else{ }?> id="insert_paperstock" value="1"/>
                        Insert - Paperstock ($0.55/piece)<label style="width: 20px;float:none;margin-left:6px;">
                        <a class="tooltip" href="#">
                        <img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Add some extra incentives, promote a contest or even push a separate vehicle to all your invitees. Printed on standard paper for a more economical invite upgrade.</span></a></label></label>
                    </div>
                    <div class="reporttype">
                        <label class="mailoutcheckboxtext"><input type="checkbox" name="variable_image"  style="width: 31px;" <?php if($variable_imaging=='1'){ echo ' checked';}else{ }?> id="variable_image" value="1"/>
                        Variable Imaging ($0.20)<label style="width: 20px;float:none;margin-left:6px;"><a class="tooltip" href="#">
                        <img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Personalize each invite with variable text or images. Have each invite addressed to your past customers with a custom greeting and their name. Possibilities are endless. Contact your EPS rep for specific options</span></a></label></label>
                    </div>
                    <div class="reporttype">
                        <label class="mailoutcheckboxtext"> <input type="checkbox" name="colored_envelop" <?php if($colored_envelop=='1'){ echo ' checked';}else{ }?> style="width: 31px;" id="colored_envelop" value="1"/>
                        Colored Envelopes ($0.15 each)
                        Desired Color<label style="width: 20px;float:none;margin-left:6px;"><a class="tooltip" href="#">.
                        <img src="<?=base_url()?>images/questionmark.png"/><span class="classic">Make your mail piece stand out from the rest with a splash of color. Only for large size invites. Choose from Blue, Green, Gold, Beige or Pink.</span></a></label></label>
                    </div>
                </div>  
            </div>  
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous" name="previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next" onclick="mailer_step3_insert();">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
        </fieldset>
        <fieldset id="step5"  class="stepfour">
            <div class="mailheading">The Upgrader Package</div>
            <div style="text-align: center; margin: 0px auto; width: 97%;float: left;">
                <p class="inline-small-label button-height" style="width: 100%; float: left;">
                <label for="validation-required" class="label" style="padding-top: 0px; width: 100%; text-align: left;font-weight: normal;font-size:13px;">Increase your conversion rate even more with out unique upgrade package. In addition to the regular EPS invite mailer we also send out a personalized letter with a message about upgrading their vehicle at the private event.A personalized web address is included for each client that receives a letter that provides the trade in value of their vehicle and an option to register for the Private Sales Event.</label></p>
                <label style="color: grey;"><input type="checkbox" <?php if($upgrader_package=='1'){ echo ' checked';}else{ }?> name="upgrade_package" value="1" style="width:2%;" id="upgrade_package"/>
                Upgrader Package</label>
            </div>
            <div style="clear: both;height: 10px;"></div>
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next" onclick="mailer_step4_insert();">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
            <input type="hidden" name="select_campine" id="select_campine" value=""/>
        </fieldset>
        <fieldset id="step4">
            <div class="mailheading">Review Your Order</div>
            <button type="button" class="submit button glossy mid-margin-right" onclick="download_pdf('<?php echo $event_insert_id?>','<?php echo $dealer_id_upload_data?>');">
                <span class="button-icon red-gradient"><span class="icon-down-fat"></span></span>
                Download
            </button>
            <div style="clear: both;height:10px"></div>
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous" name="previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="submit button glossy mid-margin-right " onclick="displaystep();">
                <span class="button-icon"><span class="icon-tick"></span></span>
                Submit
            </button>
            </form>
        </fieldset>
        <fieldset id="step6" style="display: none;min-height: 500px;">
            <?php 
            $user_details=$this -> main_model-> dealerfulldetails($dealer_id_upload_data);
            foreach($user_details as $values_userdetails){
                $name=ucfirst($values_userdetails['first_name'].' '.$values_userdetails['last_name']);
                $email=$values_userdetails['email_id'];
            }
            ?>
            <form method="post" action="<?=base_url()?>campaign/submitleadlist/<?php echo $dealer_id_upload_data?>/<?php echo $event_insert_id?>" enctype="multipart/form-data" id="leadlist-form">
                <div class="submitformmain" ><div style="float: right;"><img src="<?=base_url()?>images/close.png" class="closebuttonimage" onclick="hidesubmit();"/></div>
                    <div class="mailheading" style="margin-bottom: 20px;margin-top: 20px;">Submitting and Emailing Reports</div>
                    <label id="showmessage" style="margin-left: 20px;"></label>
                    <div class="submit-form-subtitle" >Dealership Information</div>
                        <div class="mailheading" >
                            <input type="hidden" name="dealer_name" value="<?php echo $name?>"/>
                            <table class="table responsive-table" id="sorting-advanced1" style="width: 95%;margin-left: 20px;">
                                <thead>
                                    <tr>
                                    <th scope="col"></th>
                                    <th scope="col"  class="align-center hide-on-mobile" style=" font-size: 13px;"> Name</th>
                                    <th scope="col"  class="align-center hide-on-mobile" style=" font-size: 13px;"> Email </th>
                                </thead>
                                <tr>
                                    <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input type="checkbox" name="dealer_email" class="check-equity-scrape" id="dealer_email" style="margin-top:9px;"  value="<?php echo $email?>"></th>
                                    <td style="width:220px;color:#666666;font-size: 13px;"><?=$name?> </td>
                                    <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;font-size: 13px;"><?=$email?></td>
                                </tr>
                            </table>
                        </div>
                    <div class="submit-form-subtitle" style="margin-bottom: 11px; margin-top: 12px;">Account Manager(s) Information</div>
                    <div class="mailheading" >
                        <table class="table responsive-table" id="sorting-advanced1" style="width: 95%;margin-left: 20px;">
                            <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col"  class="align-center hide-on-mobile" style=" font-size: 13px;"> Name</th>
                            <th scope="col"  class="align-center hide-on-mobile" style=" font-size: 13px;"> Email </th>
                            </thead>
                            <?php
                            $account_manager_details=$this -> main_model-> getaccountmanagerdetaild($dealer_id_upload_data);
                            if(isset($account_manager_details) && $account_manager_details!=''){
                                foreach($account_manager_details as $values_account_manager_details){
                                    $name=ucfirst($values_account_manager_details['first_name'].' '.$values_account_manager_details['last_name']);
                                    $email=$values_account_manager_details['email_id'];
                                    ?>
                                    <tr>
                                        <input type="hidden" name="account_manager_name[]" value="<?php echo $name?>"/>
                                        <th scope="row" class="checkbox-cell textcolor" style="text-align: center;"><input class="account_manager_email" type="checkbox" name="account_manager[]" class="check-equity-scrape" id="check-all-pr-value" style="margin-top:9px;" value="<?php echo $email?>"></th>
                                        <td style="width:220px;color:#666666;font-size: 13px;"><?php echo $name?> </td>
                                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;color:#666666;font-size: 13px;"><?php echo $email?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                            ?>
                                <tr>
                                <td style="width:220px;color:#666666;font-size: 13px;" colspan="3">No Data Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                </div>
                <div class="submit-form-subtitle" style="margin-bottom: 11px; margin-top: 12px;margin-left: 30px;">
                    <label><input type="checkbox" name="epslisting" id="epslisting"/>&nbsp;&nbsp;EPS</label> 
                </div>
                <div class="submit-form-subtitle" style="margin-bottom: 11px; margin-top: 12px;margin-left: 30px;">
                    <label><input type="checkbox" name="onetoone" id="onetoone"/>&nbsp;&nbsp;One to One Mailing</label> 
                </div>
                <div class="submit-form-subtitle" style="margin-bottom: 3px;">
                    <input  class="input validate[required]" type="text"  value="" name="email_address" id="email_address" style="width: 296px;"/> 
                </div>
                <div style="margin-left: 20px;text-align: left;">(Enter multiple email addresses  separated by commas)</div>
                <div class="submitandemailbutton">
                    <button type="submit" class="submit button glossy mid-margin-right" onclick="submitleaddetails();">
                        <span class="button-icon"><span class="icon-tick"></span></span>
                        Send
                    </button>
                    </form>
                </div>
            </div>
        </fieldset>
    </section>
<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches
        $(".next").click(function(){
            if(animating) return false;
            animating = true;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
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
        $(".submit").click(function(){
            return false;
        });
    });
    function redirectpage(){
        $("#step1").show();
        $("#step2").hide();
        $("#step3").hide();
        $("#step4").hide();
        $("#step5").hide();
        $("#versioning").removeClass("active");
        $("#scale_campaigns").addClass("active");
        $("#special_option").removeClass("active");
        $("#upgradepricing").removeClass("active");
        $("#review").removeClass("active"); 
        $("#step1").css({'opacity':1, 'transform':'scale(1)'});
    }
    function redirectpageversion(){
        $("#step1").hide();
        $("#step2").show();
        $("#step3").hide();
        $("#step4").hide();
        $("#step5").hide();
        $("#versioning").addClass("active");
        $("#scale_campaigns").addClass("active");
        $("#special_option").removeClass("active");
        $("#review").removeClass("active"); 
        $("#upgradepricing").removeClass("active");
        $("#step2").css({'opacity':1, 'transform':'scale(1)'});   
    }
    function specialoption(){
        $("#step1").hide();
        $("#step2").hide();
        $("#step3").show();
        $("#step4").hide();
        $("#step5").hide();
        $("#special_option").addClass("active");
        $("#versioning").addClass("active");
        $("#scale_campaigns").addClass("active");
        $("#upgradepricing").removeClass("active");
        $("#review").removeClass("active"); 
        $("#step3").css({'opacity':1, 'transform':'scale(1)'});   
    }
    function reviewoption(){
        $("#step1").hide();
        $("#step2").hide();
        $("#step3").hide();
        $("#step5").hide();
        $("#step4").show();
        $("#special_option").addClass("active");
        $("#versioning").addClass("active");
        $("#scale_campaigns").addClass("active");
        $("#review").addClass("active");
        $("#upgradepricing").addClass("active");
        $("#step4").css({'opacity':1, 'transform':'scale(1)'});   
    }
    function upgradepricing(){
        $("#step1").hide();
        $("#step2").hide();
        $("#step3").hide();
        $("#step4").hide();
        $("#step5").show();
        $("#special_option").addClass("active");
        $("#versioning").addClass("active");
        $("#scale_campaigns").addClass("active");
        $("#upgradepricing").addClass("active");
        $("#review").removeClass("active");
        $("#step5").css({'opacity':1, 'transform':'scale(1)'});      
    }
</script>