<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
    <section role="main" id="main">
    <hgroup id="main-title" class="thin" style="text-align: left;">
        <h1>Registration</h1>
    </hgroup>
    <?php
    if(isset($error)){
    ?>
        <div style="color: red; border: 1px dashed; width: 50%; margin: 0px auto; padding: 13px;"><?=$error;?></div>
    <?php
    }if(isset($success)){
    ?>
        <div style="color: green; border: 1px dashed green; width: 50%; margin: 0px auto; padding: 13px;"><?=$success;?></div>
    <?php 
    }
    ?>
    <style>
    .select{
        width: 261px;
    }
    .drop-down{
        text-align: left;
        width: 256px; 
    }
    .select-value{
        text-align: left;
    }
    .drop-down > span, .drop-down > a
    {
        text-align: left;  
    }
    .field-block{
        padding: 0 30px 0 182px;
        padding-left: 180px\9!important;
    }
    .selectMultiple > .drop-down{
        height: 131px;
    }
    </style>
    <?php
    if($membershiptype=='dealer' || $membershiptype=='auto_brand'){
    if($membershiptype=='dealer'){
        $membership_name='Dealership'; 
    }
    elseif($membershiptype=='account_managers'){
        $membership_name='Accounts Manager'; 
    }elseif($membershiptype=='auto_brand'){
        $membership_name='Auto Manufacturer'; 
    }
    $created_id=$menu['logged_in']['registration_id'];
    ?>
    <form method="post" action="<?php echo base_url()?>register/registerprocess/<?php if(isset($membershiptype)){ echo $membershiptype;}?>" title="Registration"  id="form-login">
    <input type="hidden" name="created_id" value="<?=$created_id?>"/>
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                    <fieldset class="fieldset">
                    <legend class="legend"><?=$membership_name?> Registration </legend>
                    <div class="formheader">Dealership Info</div>
                    <p class="inline-small-label button-height">
                        <?php
                        if($membershiptype=='dealer'){
                        ?>
                            <label for="small-label-1" class="label">Dealership Name<font color="red">*</font></label>
                        <?php
                        }else{
                        ?>
                            <label for="small-label-1" class="label">Company Name<font color="red">*</font></label>
                        <?php
                        }
                        ?>
                        <input type="text" name="company_name" id="company_name" class="input validate[required]" value="<?php echo set_value('company_name'); ?>" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Address<font color="red">*</font></label>
                        <input type="text" name="address" id="address" class="input validate[required]" value="<?php echo set_value('address'); ?>" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Country<font color="red">*</font></label>
                            <select id="validation-select" name="country" class="select validate[required]" style="text-align: left;" onchange="zipcodechange()">
                                <option value="Canada" <?php echo set_value('country')=='Canada' ? ' selected ':''; ?>>Canada</option>
                                <option value="USA" <?php echo set_value('country')=='USA' ? ' selected ':''; ?>>USA</option>
                                <?php
                                //$country_fields=$this -> main_model -> CountrySelection();
                                //foreach($country_fields as $key=>$value){
                                ?>
                                <!--<option value="//$key">//$value</option>-->
                                <?php
                                //}
                                ?>
                            </select>
                    </p>
                    <p class="inline-small-label button-height" id="canadian_state">
                    <label for="small-label-1" class="label">Province<font color="red">*</font></label>
                        <select id="states" name="canadastate" class="select validate[required]" style="text-align: left;">
                        <?php
                        $ststes_fields=$this -> main_model -> Canadian_provinces();
                        foreach($ststes_fields as $key=>$value){
                        ?>
                            <option value="<?=$key?>" <?php echo set_value('canadastate')==$key ? ' selected ':''; ?>><?=$value?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </p>
                    <p class="inline-small-label button-height" id="usa_state" style="display: none;">
                    <label for="small-label-1" class="label">Province<font color="red">*</font></label>
                        <select id="states" name="state"  style="text-align: left;" class="select validate[required]">
                        <?php
                        $ststes_fields=$this -> main_model -> getusstates();
                        foreach($ststes_fields as $key=>$value){
                        ?>
                            <option value="<?=$value['code']?>" <?php echo set_value('state')==$value['code'] ? ' selected ':''; ?>><?=$value['state']?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">City</label>
                        <input type="text" name="city" id="city" class="input " value="<?php echo set_value('city'); ?>" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label" id="postalcodelabel">Postal Code<font color="red">*</font></label>                            
                        <label for="small-label-1" class="label" id="zipcodelabel" style="display: none;">Zip Code<font color="red">*</font></label>                        
                        <input type="text" name="zipcode" id="post_code" class="input zipcodes validate[required]" value="<?php echo set_value('zipcode'); ?>" data-tooltip-options='{"position":"right"}' onblur="changeupper();"/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Phone Number<font color="red">*</font></label>
                        <input type="text" name="company_phonenumber" id="company_phonenumber" class="input validate[required]"  value="<?php echo set_value('company_phonenumber'); ?>" data-tooltip-options='{"position":"right"}' maxlength="11"/>
                    </p>
                    <?php
                    if($membershiptype=='dealer'){
                    ?>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Dealership Email</label>
                            <input type="text" name="dealership_email" id="dealership_email" class="input validate[custom[email]]" value="<?php echo set_value('dealership_email'); ?>" data-tooltip-options='{"position":"right"}' />
                        </p>
                    <?php
                    }
                    ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Website</label>
                        <input type="text" name="company_website" id="company_website" class="input small-margin-right" value="<?php echo set_value('company_website'); ?>"/>
                    </p>
                    <?php
                    if($membershiptype=='dealer'){
                    ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Data Source<font color="red">*</font></label>
                        <select id="states" name="data_source" class="select validate[required]" style="text-align: left;" >
                            <option value="authenticom">Authenticom</option>  
                            <option value="pbs_direct">PBS Direct</option>                            
                        </select>
                    </p>
                    <?php
                    }
                    ?>
                    <?php
                    if($membershiptype=='auto_brand' || $membershiptype=='dealer'){
                    ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Manufacturer<font color="red">*</font><br /><span style="font-size: 11px;">(Ctrl+Click for multiple selections)</span></label>
                        <select id="masterbrand"  name="masterbrand[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;"  multiple="">
                            <?php
                            $makes_details=$this->main_model->makes_models();
                            foreach($makes_details as $makes){
                            ?>
                                <option value="<?=$makes['make']?>" <?php echo set_value('masterbrand')==$makes['make'] ? ' selected ':''; ?>><?=$makes['make']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </p>
                    <?php
                    }
                    ?>
                    <div class="formheader">Contact Info</div>
                    <p class="inline-small-label button-height">
                        <label for="validation-required" class="label">First Name<font color="red">*</font></label>
                        <input type="text" name="first_name" id="first_name" class="input validate[required]" value="<?php echo set_value('first_name'); ?>" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Last Name<font color="red">*</font></label>
                        <input type="text" name="last_name" class="input validate[required]" id="last_name" class="input small-margin-right" value="<?php echo set_value('last_name'); ?>"/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Phone</label>
                        <input type="text" name="contact_phoneno" id="contact_person" class="input small-margin-right" value="<?php echo set_value('contact_phoneno'); ?>"/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Email<font color="red">*</font><br /></label>
                        <input type="text" name="email" id="validation_email" class="input validate[required,custom[email]]" value="<?php echo set_value('email'); ?>" data-tooltip-options='{"position":"right"}'/><br />
                        <span style="font-size: 11px;color:grey;">[Set as Username]</span>
                    </p>
                    <?php
                    if($membershiptype=='auto_brand'){
                    ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Job Position<font color="red">*</font></label>
                        <input type="text" name="job_position" id="job_position" class="input validate[required]" value="" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <?php
                    }
                    ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Password<font color="red">*</font></label>
                        <input type="password" name="password" id="password" class="input validate[required]" value=""/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Confirm Password<font color="red">*</font></label>
                        <input type="password" name="confirm_Password" id="confirm_Password" class="input validate[required]" value="" onchange="return checkpassword();" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <?php
                    if($membershiptype=='dealer'){
                    ?>
                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="dealership" data-tooltip-options='{"position":"right"}'/>
                    <?php    
                    }elseif($membershiptype=='account_managers'){
                    ?>
                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="account_managers" data-tooltip-options='{"position":"right"}'/>
                    <?php
                    }elseif($membershiptype=='auto_brand'){
                    ?>
                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="auto_brand" data-tooltip-options='{"position":"right"}'/>
                    <?php  
                    }
                    ?>
                    <div class="field-block button-height" >
                        <button type="button" class="button glossy mid-margin-right" onclick="back_form();">
                                <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
                                Back
                        </button>
                        <button type="submit" class="button glossy mid-margin-right">
                            <span class="button-icon"><span class="icon-tick"></span></span>
                            Save
                        </button>
                        <button type="button" class="button glossy" onclick="cancel_form();">
                            <span class="button-icon red-gradient"><span class="icon-cross-round"></span></span>
                            Cancel
                        </button>
                    </div>
                </fieldset> 
            </div>
        </div>
    </div>
</form>
    <?php
    }elseif($membershiptype=='account_managers' || $membershiptype=='sub_admin'){
    $created_id=$menu['logged_in']['registration_id'];
    ?>
    <form method="post" action="<?php echo base_url()?>register/managerregisterprocess/<?php if(isset($membershiptype)){ echo $membershiptype;}?>" title="Registration"  id="form-login">
    <input type="hidden" name="created_id" value="<?=$created_id?>"/>
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                    <fieldset class="fieldset">
                        <?php
                        if($membershiptype=='account_managers'){
                            $user_legend='Register Account Manager';
                        }else{
                            $user_legend='Register Sub Admin'; 
                        }
                        ?>
                        <legend class="legend"><?=$user_legend?></legend>
                        <div class="formheader">Contact Info</div>
                        <p class="inline-small-label button-height">
                            <label for="validation-required" class="label">First Name<font color="red">*</font></label>
                            <input type="text" name="first_name" id="first_name" class="input validate[required]" value="<?php echo set_value('first_name'); ?>" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Last Name<font color="red">*</font></label>
                            <input type="text" name="last_name" id="last_name" class="input validate[required]" value="<?php echo set_value('last_name'); ?>"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Contact Phone<font color="red">*</font></label>
                            <input type="text" name="contact_phoneno" id="contact_person" class="input validate[required]" data-tooltip-options='{"position":"right"}' value="<?php echo set_value('contact_person'); ?>"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Email<font color="red">*</font></label>
                            <input type="text" name="email" id="validation_email" class="input validate[required,custom[email]]" value="<?php echo set_value('email'); ?>" data-tooltip-options='{"position":"right"}'/><br />
                            <span style="font-size: 11px;color:grey;">[Set as Username]</span>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Password<font color="red">*</font></label>
                            <input type="password" name="password" id="password" class="input validate[required]" value=""/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Confirm Password<font color="red">*</font></label>
                            <input type="password" name="confirm_Password" id="confirm_Password" class="input validate[required]" value="" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <?php
                        if($membershiptype=='dealer'){
                        ?>
                            <input type="hidden" name="membership" id="membership" class="input validate[required]" value="dealership" data-tooltip-options='{"position":"right"}'/>
                        <?php    
                        }elseif($membershiptype=='account_managers'){
                        ?>
                            <input type="hidden" name="membership" id="membership" class="input validate[required]" value="account_managers" data-tooltip-options='{"position":"right"}'/>
                        <?php
                        }elseif($membershiptype=='auto_brand'){
                        ?>
                            <input type="hidden" name="membership" id="membership" class="input validate[required]" value="auto_brand" data-tooltip-options='{"position":"right"}'/>
                        <?php  
                        }else{
                        ?>
                            <input type="hidden" name="membership" id="membership" class="input validate[required]" value="sub_admin" data-tooltip-options='{"position":"right"}'/>
                        <?php
                        }
                        ?>
                        <div class="field-block button-height" >
                            <button type="button" class="button glossy mid-margin-right" onclick="back_form();">
                                <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
                                Back
                            </button>
                            <button type="submit" class="button glossy mid-margin-right">
                                <span class="button-icon"><span class="icon-tick"></span></span>
                                Save
                            </button>
                        </div>
                    </fieldset> 
                </div>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
    </section>
<!-- Scripts -->
<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<!-- End sidebar/drop-down menu -->
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<script src="<?=base_url()?>js/mask.js" type="text/javascript"></script>
<script>
jQuery(function($){
    jQuery("#company_phonenumber").mask("(999) 999-9999");      
    jQuery("#contact_person").mask("(999) 999-9999");
    jQuery("#post_code").mask("AAA AAA");
    jQuery("#zip_code").mask("99999");    
});
</script>
<script>
var jQuery17 = jQuery.noConflict();
</script>
<script>
function cancel_form(){
    window.location.href = '<?=base_url()?>dashboard';
}
function back_form(){
    window.location.href = '<?=base_url()?>dashboard'; 
}
// Form validation
jQuery(document).ready(function(){
    jQuery('form').validationEngine();
});
function checkpassword(){  
    var password=jQuery('#password').val();
    var confirm_Password=jQuery('#confirm_Password').val(); 
    if(password!=confirm_Password){       
        jQuery('form').validationEngine();
        jQuery( "#password" ).removeClass( "input validate[required]" );
        jQuery( "#password" ).addClass( "input validate[equals]" );
        return false;
    }else{         
        jQuery('#form-login').submit();
        jQuery('form').validationEngine();
        jQuery( "#password" ).removeClass( "input validate[required]" );
        jQuery( "#password" ).removeClass( "input validate[equals]" );
        jQuery( ".passwordformError" ).removeClass( "formError" );
        jQuery( "#password" ).addClass( "input" );         
    }
}
function zipcodechange(){
    var country=jQuery('#validation-select').val();   
    var zipcode='Zip Code';
    if(country=='USA'){
        jQuery('#postalcodelabel').hide();
        jQuery('#zipcodelabel').show();
        jQuery('.zipcodes').attr('id', 'zip_code');
        jQuery('#usa_state').show(); 
        jQuery('#canadian_state').hide(); 
    }else{
        jQuery('#postalcodelabel').show();  
        jQuery('#zipcodelabel').hide(); 
        jQuery('.zipcodes').attr('id', 'post_code');   
        jQuery('#canadian_state').show(); 
        jQuery('#usa_state').hide(); 
    }
}
</script>
<script>
function changeupper(){
    jQuery("#post_code").val((jQuery("#post_code").val()).toUpperCase());
}
</script>