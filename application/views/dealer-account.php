<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<section role="main" id="main">
    <hgroup id="main-title" class="thin" style="text-align: left;">
        <h1>View Profile</h1>
    </hgroup>
    <div style="color: red;text-align: center; padding-top: 13px;">
    <?php
    if(isset($error))
    {
    ?>
        <div style="color: red;"><?=$error;?></div>
    <?php
    }
    if(isset($success))
    {
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
    </div>
    <script>
    // Form validation
     jQuery(document).ready(function(){
    jQuery('form').validationEngine();
    });
    function checkpassword()
    {  
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
    </script>   
    <div class="with-padding" style="margin-top: 15px;">
        <div class="columns">
            <div class="six-columns twelve-columns-tablet" style=" margin-left:236px">
                <fieldset class="fieldset">
                <!---------------------profile details start ----------------------->
                    <legend class="legend"> <?=ucfirst($details[0]['first_name'])?>&nbsp;(Dealer)</legend>
                    <div class="formheader">Dealership Info</div>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Dealership Name</label>
                        <span class="content"><?php echo $details[0]['company_name']?></span>                        
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Address</label>
                        <span class="content"><?php echo $details[0]['address']?></span>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Country</label>
                        <span class="content"><?php echo $details[0]['country']?></span>
                    </p>
                    <p class="inline-small-label button-height" id="canadian_state">
                        <label for="small-label-1" class="label">Province</label>
                        <span class="content"><?php echo $details[0]['state']?></span>
                    </p>                    
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">City</label>
                        <span class="content"><?php echo $details[0]['city']?></span>                        
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label" id="postalcodelabel">Postal Code</label>
                        <span class="content"><?php echo $details[0]['zipcode']?></span> 
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Phone number</label>
                        <span class="content"><?php echo $details[0]['company_phonenumber']?></span>
                    </p>                   
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Dealership Email</label>
                        <span class="content"><?php echo $details[0]['dealership_email']?></span>
                    </p>                    
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Website</label>
                        <span class="content"><?php echo $details[0]['company_website']?></span>                        
                    </p>                  
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Data Source</label>
                        <span class="content"><?php echo $details[0]['data_source']?></span>
                    </p>                                                                                 
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Manufacturer</label>
                        <span class="content"><?php echo $details[0]['masterbrand']?></span>
                    </p>
                    <div class="formheader" style="float: left;">Contact Info</div>
                    <p class="inline-small-label button-height">
                        <label for="validation-required" class="label">First Name</label>
                        <span class="content"><?php echo $details[0]['first_name']?></span>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Last Name</label>
                        <span class="content"><?php echo $details[0]['last_name']?></span>                        
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Phone</label>
                        <span class="content"><?php echo $details[0]['contact_phone_number']?></span>
                    </p>   
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Email</label>
                        <span class="content"><?php echo $details[0]['email_id']?></span>
                    </p>
                    <!---------------------profile details end ----------------------->
                    <!---------------------Password reset start  ------------------------>
                    <form method="post" action="<?php echo base_url();?>profile/change">
                        <div class="formheader" style="float: left;">Reset Password</div>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Password<font color="red">*</font></label>
                            <input type="text" name="password"  id="password" class="input small-margin-right validate[required]" value=""/>
                        </p>
                        <p class="inline-small-label button-height" style="margin-top: 10px;">
                            <label for="small-label-1" class="label">Confirm Password<font color="red">*</font></label>
                            <input type="text" id="confirm_Password" name="password1" class="input small-margin-right validate[required]" value="" onchange="return checkpassword();" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <div style="clear: both;"></div>
                        <div class="field-block button-height">            
                            <button type="submit" class="button glossy mid-margin-right">
                            <span class="button-icon"><span class="icon-tick"></span></span>
                            Save
                            </button>                    
                        </div>
                    </form>
                    <!---------------------Password reset end  ------------------------>
                </div>    
                </fieldset> 
            </div>
        </div>
    </div>
</section>
<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
