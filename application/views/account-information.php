<!-- JavaScript at the bottom for fast page loading -->
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1"/>
<section role="main" id="main">
    <!--heading-->
    <hgroup id="main-title" class="thin" style="text-align: left;">
        <h1>View Profile</h1>
    </hgroup>
    <!--error message display-->
    <div style="color: red;text-align: center; padding-top: 13px;">
        <?php
        if(isset($error)){
        ?>
            <div style="color: red;"><?=$error;?></div>
        <?php
        }
        if(isset($success)){
        ?>
            <div style="color: green; border: 1px dashed green; width: 50%; margin: 0px auto; padding: 13px;"><?=$success;?></div>
        <?php 
        }
        ?>
    </div>
    <style>
        .select{
            width: 261px;
        }
        .drop-down{
            text-align: left;
            width: 256px; 
        }
        .select-value
        {
            text-align: left;
        }
        .drop-down > span, .drop-down > a
        {
            text-align: left;  
        }
        .field-block{
            padding: 0 30px 0 182px;
        }
        .selectMultiple > .drop-down{
            height: 134px;
        }
        .label{
            text-align: left;
        }
    </style>
    <?php
    if($details[0]['usertype']=='dealership' ||  $details[0]['usertype']=='auto_brand'){
        ?>
         <!--Profile form starts here-->
        <form method="post" action="<?=base_url()?>profile/update/<?=$details[0]['registration_id']?>" title="Registration" id="formedit-login">
            <input type="hidden" name="membership" id="small-label-1" class="input small-margin-right" value="<?=$details[0]['usertype']?>"/>
            <div class="with-padding" style="margin-top: 15px;">
                <div class="columns">
                    <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                        <fieldset class="fieldset" style="margin-bottom: 36px;">
                            <?php
                            if($details[0]['usertype']=='account_managers'){
                                $membership='Accounts Manager';
                            }else if($details[0]['usertype']=='dealership'){
                                $membership='Dealer';
                            }else if($details[0]['usertype']=='auto_brand'){
                                $membership='Auto Manufacturer';
                            }else{
                                $membership='Admin';
                            }
                            ?>
                            <legend class="legend"> <?=ucfirst($details[0]['first_name'])?>&nbsp;(<?=$membership?>)</legend>
                             <!--heading-->
                            <div class="formheader">Dealership Info</div>
                             <!--Dealer name-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Dealership Name<font color="red">*</font></label>
                                <input type="text" name="company_name" id="company_name" class="input validate[required]" value="<?=$details[0]['company_name']?>" data-tooltip-options='{"position":"right"}'/>
                            </p>
                             <!--Address-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Address<font color="red">*</font></label>
                                <input type="text" name="address" id="small-label-1" class="input small-margin-right" value="<?=$details[0]['address']?>"/>
                            </p>
                             <!--Country field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Country<font color="red">*</font></label>
                                <select id="country-select" name="country" class="select validate[required]" onchange="zipcodechange();">
                                    <option <?php echo $details[0]['country']=='Canada' ? ' selected ':''; ?> value="Canada">Canada</option>
                                    <option <?php echo $details[0]['country']=='USA' ? ' selected ':''; ?> value="USA">USA</option>
                                </select>
                            </p>
                             <!--Province field-->
                            <p class="inline-small-label button-height" id="canadian_state">
                                <label for="small-label-1" class="label">Province<font color="red">*</font></label>
                                <select id="states" name="canadastate" class="select validate[required]" style="text-align: left;" onchange="select_city(this.value);">
                                    <?php
                                    $ststes_fields=$this -> main_model -> Canadian_provinces();
                                    foreach($ststes_fields as $key=>$value){
                                    ?>
                                        <option <?php echo $details[0]['state']==$key ? ' selected ':''; ?> value="<?=$key?>"><?=$value?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                            <p class="inline-small-label button-height" id="usa_state" style="display: none;">
                                <label for="small-label-1" class="label">Province<font color="red">*</font></label>
                                <select id="states" name="state" class="select validate[required]" onchange="select_city(this.value,'<?=$details[0]['city']?>');">
                                    <?php
                                    $ststes_fields=$this -> main_model -> getusstates();
                                    foreach($ststes_fields as $key=>$value){
                                    ?>
                                        <option <?php echo $details[0]['state']==$value['code'] ? ' selected ':''; ?>  value="<?=$value['code']?>"><?=$value['state']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                            <!--City field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">City</label>
                                <input type="text" name="city" id="city" class="input " value="<?=$details[0]['city']?>" data-tooltip-options='{"position":"right"}'/>
                            </p>
                            <!--Postal code field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label" id="postalcodelabel">Postal Code<font color="red">*</font></label>
                                <label for="small-label-1" class="label" id="zipcodelabel" style="display: none;">Zip Code<font color="red">*</font></label>   
                                <input type="text" name="zipcode" id="post_code" class="input validate[required]" value="<?=$details[0]['zipcode']?>" onblur="changeupper();"/>
                            </p>
                            <!--Phone number field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Phone number<font color="red">*</font></label>
                                <input type="text" name="company_phonenumber" id="company_phonenumber" class="input validate[required]" maxlength="11"  value="<?=$details[0]['company_phonenumber']?>"/>
                            </p>
                            <?php
                            if($details[0]['usertype']=='dealership'){
                            ?>
                            <!--Email field-->
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Dealership Email</label>
                                    <input type="text" name="dealership_email" class="input validate[custom[email]]" id="small-label-1" class="input"  value="<?=$details[0]['dealership_email']?>" value="" data-tooltip-options='{"position":"right"}'/>
                                </p>
                            <?php
                            }
                            ?>
                            <!--Website field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Website</label>
                                <input type="text" name="company_website" id="small-label-1" class="input small-margin-right" value="<?=$details[0]['company_website']?>"/>
                            </p>
                            <?php
                            if($details[0]['usertype']=='dealership'){
                            ?>
                                <!--Data source field-->
                                <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Data Source<font color="red">*</font></label>
                                <select id="states" name="data_source" class="select validate[required]" style="text-align: left;" >
                                    <?php
                                    if($details[0]['data_source']=='pbs_direct'){
                                    ?>
                                        <option value="pbs_direct" selected="">PBS Direct</option>
                                        <option value="authenticom">Authenticom</option>
                                    <?php
                                    }else{
                                    ?>
                                        <option value="pbs_direct" >PBS Direct</option>
                                        <option value="authenticom" selected="">Authenticom</option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                                </p>
                            <?php
                            }
                            ?>    
                            <!--Manufacturer field-->                                                            
                            <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Manufacturer<font color="red">*</font><br /><span style="font-size: 11px;">(Ctrl+Click for multiple selections)</span></label>
                            <select id="masterbrand" name="masterbrand[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;" onchange="select_city(this.value);" multiple="">
                            <?php
                            $makes_details=$this->main_model->makes_models();
                            if(isset($makes_details)){
                                $manufactureType=explode(',',$details[0]['masterbrand']);
                                foreach($makes_details as $makes){
                                    if(in_array($makes['make'],$manufactureType)){
                                    $selected='selected ';
                                    }else{
                                    $selected= ' ';
                                    }
                                    ?>
                                    <option <?=$selected?> value="<?=$makes['make']?>"><?=$makes['make']?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php
                            }
                            ?>
                            </p>
                            <!--Contact info div starts here-->       
                            <div class="formheader">Contact Info</div>
                            <!--First name field-->
                            <p class="inline-small-label button-height">
                                <label for="validation-required" class="label">First Name<font color="red">*</font></label>
                                <input type="text" name="first_name" id="validation-required" class="input validate" value="<?=$details[0]['first_name']?>" data-tooltip-options='{"position":"right"}'/>
                            </p>
                            <!--Last name field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Last Name<font color="red">*</font></label>
                                <input type="text" name="last_name" id="last_name" class="input validate[required]" value="<?=$details[0]['last_name']?>"/>
                            </p>
                            <!--Phone number field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Contact Phone</label>
                                <input type="text" name="contact_phone_number" id="contact_phone_number" class="input small-margin-right" value="<?=$details[0]['contact_phone_number']?>"/>
                            </p>
                            <?php
                            $user_id = $menu['logged_in']['registration_id'];
                            $get_usertype=$this -> main_model -> get_usertype($user_id);
                            if($get_usertype=='admin' || $menu['logged_in']['usertype']=='sub_admin'){
                            ?>
                                <!--Email field-->
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Contact Email<font color="red">*</font></label>
                                    <input type="text" name="email" id="small-label-1" class="input validate[required,custom[email]]"  value="<?=$details[0]['email_id']?>" value="" data-tooltip-options='{"position":"right"}'/>
                                    <br /><span style="font-size: 11px;color:grey;margin-left: 11px;">[Set as Username]</span>
                                </p>
                            <?php
                            }else{
                            ?>               
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Contact Email<font color="red">*</font></label>
                                    <input type="text"  id="small-label-1" class="input validate[required,custom[email]]" disabled="" value="<?=$details[0]['email_id']?>" value="" data-tooltip-options='{"position":"right"}'/>
                                    <br /><span style="font-size: 11px;color:grey;margin-left: 11px;">[Set as Username]</span>
                                    <input type="hidden" value="<?=$details[0]['email_id']?>" name="email"/>
                                </p>
                            <?php
                            }
                            ?>
                            <?php
                            $password=$this -> main_model ->ProtectData($details[0]['password'],'DECODE'); 
                            if($menu['logged_in']['usertype']=='admin' || $menu['logged_in']['usertype']=='sub_admin' || $menu['logged_in']['usertype']=='account_managers' || $menu['logged_in']['usertype']=='auto_brand'){
                            ?>
                            <!--Password field-->
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Password</label>
                                    <input type="text" name="password" id="small-label-1" class="input small-margin-right" value="<?=$password?>"/>
                                </p>
                            <?php
                            }else{ 
                            ?>              
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Password</label>
                                    <input type="password" name="password_dealer_select" id="small-label-1" class="input small-margin-right" value=""/>
                                    <input type="hidden" name="password" value="<?=$password?>"/>
                                </p>
                            <?php
                            }
                            ?>
                            <?php
                            if($details[0]['usertype']=='auto_brand'){
                            ?>
                            <!--Job position field-->
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Job Position<font color="red">*</font></label>
                                    <input type="text" name="job_position" id="job_position" class="input validate[required]" value="<?=$details[0]['job_position']?>" data-tooltip-options='{"position":"right"}'/>
                                </p>
                            <?php
                            }
                            ?>
                            <!--Button to return back-->                            
                            <div class="field-block button-height">
                                <button type="button" class="button glossy mid-margin-right" onclick="back_form();">
                                    <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
                                    Back
                                </button>
                                <!--Button to save--> 
                                <button type="submit" class="button glossy mid-margin-right">
                                    <span class="button-icon"><span class="icon-tick"></span></span>
                                    Save
                                </button>
                                <!--Button to delete--> 
                                <button type="button" class="button glossy" onclick="deletepoperty(<?=$details[0]['registration_id']?>)">
                                    <span class="button-icon red-gradient"><span class="icon-cross-round"></span></span>
                                    Delete
                                </button>
                            </div>
                        </fieldset> 
                    </div>
                </div>
            </div>
        </form>
        <!--Profile form ends here-->
        <?php
    }
    //other than dealer or automanufacturer
    elseif($details[0]['usertype']=='account_managers' || $details[0]['usertype']=='sub_admin' || $details[0]['usertype']=='admin' ){
        ?>
        <!--Profile form starts here-->
        <form method="post" action="<?=base_url()?>profile/managerupdate/<?=$details[0]['registration_id']?>" title="Registration" id="formedit-login" >
            <div class="with-padding" style="margin-top: 15px;">
                <div class="columns">
                    <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                        <fieldset class="fieldset" style="margin-bottom: 36px;">
                            <?php
                            if($details[0]['usertype']=='account_managers'){
                                $membership='Accounts Details';
                            }else if($details[0]['usertype']=='dealership'){
                                $membership='Register Dealer';
                            }else if($details[0]['usertype']=='auto_brand'){
                                $membership='Register Auto Manufacturer';
                            }else if($details[0]['usertype']=='sub_admin'){
                                $membership='Register Sub Admin';
                            }else{
                                $membership='Register Admin';
                            }
                            ?>
                            <legend class="legend"><?=$membership?></legend>
                            <!--heading-->
                            <div class="formheader">Contact Info</div>
                            <!--First name field-->
                            <p class="inline-small-label button-height">
                                    <label for="validation-required" class="label">First Name<font color="red">*</font></label>
                                    <input type="text" name="first_name" id="validation-required" class="input validate" value="<?=$details[0]['first_name']?>" data-tooltip-options='{"position":"right"}'/>
                            </p>
                            <!--Last name field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Last Name<font color="red">*</font></label>
                                <input type="text" name="last_name" id="last_name" class="input input validate[required]" value="<?=$details[0]['last_name']?>"/>
                            </p>
                            <!--Phone number field-->
                            <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Contact Phone<font color="red">*</font></label>
                                <input type="text" name="contact_phone_number" id="contact_phone_number" class="input small-margin-right" value="<?=$details[0]['contact_phone_number']?>" data-tooltip-options='{"position":"right"}'/>
                            </p>
                            <?php
                            $user_id = $menu['logged_in']['registration_id'];
                            $get_usertype=$this -> main_model -> get_usertype($user_id);
                            if($get_usertype=='admin' || $menu['logged_in']['usertype']=='sub_admin'){
                                if($details[0]['usertype']=='admin'){
                                    ?>
                                    <!--User name field-->
                                    <p class="inline-small-label button-height">
                                        <label for="small-label-1" class="label">User Name<font color="red">*</font></label>
                                        <input type="text" name="email" id="small-label-1" class="input validate[required]"  value="<?=$details[0]['email_id']?>" value="" data-tooltip-options='{"position":"right"}'/>
                                    </p>
                                    <?php
                                }else{
                                ?>
                                <!--Email field-->
                                    <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Contact Email<font color="red">*</font></label>
                                    <input type="text" name="email" id="small-label-1" class="input validate[required,custom[email]]"  value="<?=$details[0]['email_id']?>" value="" data-tooltip-options='{"position":"right"}'/>
                                    <span style="font-size: 11px;color:grey;margin-left: 11px;">[Set as Username]</span>
                                    </p>
                                <?php
                                }
                            }else{
                                ?>   
                                <!--Email field-->            
                                <p class="inline-small-label button-height">
                                    <label for="small-label-1" class="label">Contact Email<font color="red">*</font></label>
                                    <input type="text"  id="small-label-1" class="input validate[required,custom[email]]" disabled="" value="<?=$details[0]['email_id']?>" value="" data-tooltip-options='{"position":"right"}'/>
                                    <span style="font-size: 11px;color:grey;margin-left: 11px;">[Set as Username]</span>
                                    <input type="hidden" value="<?=$details[0]['email_id']?>" name="email"/>
                                </p>
                                <?php
                            }
                            ?>
                            <?php
                            $password_display=$this -> main_model ->ProtectData($details[0]['password'],'DECODE');
                            if($menu['logged_in']['usertype']=='admin' || $menu['logged_in']['usertype']=='sub_admin' || $menu['logged_in']['usertype']=='account_managers' || $menu['logged_in']['usertype']=='auto_brand'){
                            ?>
                            <!--Password field-->
                                <p class="inline-small-label button-height" style="margin-bottom: 10px;">
                                    <label for="small-label-1" class="label">Password</label>
                                    <input type="text" name="password" class="input small-margin-right" value=<?=$password_display?> />
                                </p>
                            <?php
                            }else{ 
                            ?>      
                            <!--Password field-->        
                                <p class="inline-small-label button-height">
                                <label for="small-label-1" class="label">Password</label>
                                <input type="password" name="password" id="small-label-1" class="input small-margin-right" value=""/>
                                </p>
                             <?php
                            }
                             ?>
                             <p class="inline-small-label button-height" style="float: left; margin-bottom: 11px;">
                                <label for="small-label-1" class="label"></label>
                                <span class="content" style="float: left; width: 269px;line-height: 16px;"><input type="checkbox" name="notification" value="yes"/>
                                <span style="color: #808080;font-size: 12px;">Send password change notification to the user</label></span>
                            </p>
                             <input type="hidden" name="membership" id="small-label-1" class="input small-margin-right" value="<?=$details[0]['usertype']?>"/>
                             <div class="field-block button-height">
                             <!--Button to return back-->  
                                <button type="button" class="button glossy mid-margin-right" onclick="back_form();">
                                    <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
                                    Back
                                </button>
                                <!--Button to save-->
                                <button type="submit" class="button glossy mid-margin-right">
                                    <span class="button-icon"><span class="icon-tick"></span></span>
                                    Save
                                </button>
                                <?php
                                if($menu['logged_in']['usertype']=='sub_admin' || $menu['logged_in']['usertype']=='admin'){
                                    $user_id = $menu['logged_in']['registration_id'];
                                    $creater_id=$this->main_model->get_createrid($user_id);
                                    if($creater_id==$details[0]['registration_id'] || $user_id==$details[0]['registration_id']){
                                    }else{
                                    ?>
                                    <!--Button to delete-->
                                        <button type="button" class="button glossy" onclick="deletepoperty(<?=$details[0]['registration_id']?>)">
                                        <span class="button-icon red-gradient"><span class="icon-cross-round"></span></span>
                                        Delete
                                        </button>
                                    <?php
                                    }
                                }else{
                                ?>
                                <?php   
                                }
                                ?>
                            </div>
                        </fieldset> 
                    </div>
                </div>
            </div>
        </form>   
        <!--Profile form ends here-->                  
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
var jQuery17 = jQuery.noConflict();
</script>
<script>
    //Function to return back
    function cancel_form(){
        window.location.href = '<?=base_url()?>dashboard';
        exit();
    }
    // Form validation
    jQuery(document).ready(function(){
        jQuery('form').validationEngine();
    });
    //function to change zipcode field
    function zipcodechange(){
        var country=jQuery('#country-select').val();
        var zipcode='Zip Code';
        if(country=='USA'){
            jQuery('#postalcodelabel').hide();
            jQuery('#zipcodelabel').show();
            jQuery('#usa_state').show(); 
            jQuery('#canadian_state').hide(); 
        }else{
            jQuery('#postalcodelabel').show();
            jQuery('#zipcodelabel').hide(); 
            jQuery('#canadian_state').show(); 
            jQuery('#usa_state').hide(); 
        }
    }
    //function to delete property
    function deletepoperty(property_id){
        if(confirm('Are you sure ?')){
            jQuery.post('<?php echo base_url(); ?>dashboard/delete/'+property_id,function(data) {
                if(data=='Done'){
                    window.location.href='<?php echo base_url(); ?>dashboard';
                }
            });
        }
    }
</script>
<script>
jQuery(function($){
    jQuery("#company_phonenumber").mask("999-999-9999");
    jQuery("#contact_person").mask("999-999-9999");
    jQuery("#post_code").mask("AAA AAA");
    jQuery("#contact_phone_number").mask("999-999-9999");
});
</script>
<script>
function changeupper(){
    jQuery("#post_code").val((jQuery("#post_code").val()).toUpperCase());
 }
</script>