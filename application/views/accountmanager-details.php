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
        .content{
            float: left;
            color: #808080;
        }
        .inline-small-label{
            float: left;
            margin-bottom: 5px !important;
            width: 436px;
            line-height: 25px!important;
        }
        .inline-small-label > .label {
            display: block;
            float: left;
            font-weight: bold;
            margin-left: -41px;
            text-align: left;
            width: 185px;
        }
    </style>
    <script>
    // Form validation
    jQuery(document).ready(function(){
        jQuery('form').validationEngine();
    });
    //function to check password
    function checkpassword()
    {  
        var password=jQuery('#password').val();
        var confirm_Password=jQuery('#confirm_Password').val();
        if(password!=confirm_Password){
            jQuery('form').validationEngine();
            jQuery( "#password" ).removeClass( "input validate[required]" );
            jQuery( "#password" ).addClass( "input validate[equals]" );
            return false;
        }
        else{         
            jQuery('#form-login').submit();
            jQuery('form').validationEngine();
            jQuery( "#password" ).removeClass( "input validate[required]" );
            jQuery( "#password" ).removeClass( "input validate[equals]" );
            jQuery( ".passwordformError" ).removeClass( "formError" );
            jQuery( "#password" ).addClass( "input" ); 
        }
        }
    </script>   
    <div class="with-padding" style="margin-top: 15px;">
        <div class="columns">
            <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                <fieldset class="fieldset">
                    <legend class="legend">Accounts Details</legend>
                    <div class="formheader">Contact Info</div>
                    <!--First name field-->
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">First Name</label>
                        <span class="content"><?=$details[0]['first_name']?></span>
                    </p>
                    <div style="clear: both;"></div>
                    <!--Last name field-->
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Last Name</label>
                        <span class="content"><?=$details[0]['last_name']?></span>
                    </p>
                    <div style="clear: both;"></div>
                    <!--Phone number field-->
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Phone</label>
                        <span class="content"><?=$details[0]['contact_phone_number']?></span>
                    </p>
                    <div style="clear: both;"></div>
                    <!--Email field-->
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Email</label>
                        <span class="content"><?=$details[0]['email_id']?></span>
                    </p>
                    <!---------------------profile details end ----------------------->
                    <!---------------------Password reset start  ------------------------>
                    <form method="post" action="<?php echo base_url();?>profile/change">
                        <div class="formheader" style="float: left;">Reset Password</div>
                        <div style="clear: both;"></div>
                        <!--Password field-->
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Password<font color="red">*</font></label>
                            <input type="text" name="password"  id="password" class="input small-margin-right validate[required]" value=""/>
                        </p>
                        <!--Confirm Password field-->
                        <p class="inline-small-label button-height" style="margin-top: 10px;">
                            <label for="small-label-1" class="label">Confirm Password<font color="red">*</font></label>
                            <input type="text" id="confirm_Password" name="password1" class="input small-margin-right validate[required]" value="" onchange="return checkpassword();" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <div style="clear: both;"></div>
                        <div class="field-block button-height" style="padding-top: 15px;">  
                        <!--Button to save-->           
                            <button type="submit" class="button glossy mid-margin-right">
                                <span class="button-icon"><span class="icon-tick"></span></span>
                                Save
                            </button>                    
                        </div>
                    </form>
                <!---------------------Password reset end  ------------------------>
                </fieldset> 
            </div>
        </div>
    </div>