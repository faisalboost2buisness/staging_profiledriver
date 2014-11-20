<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<!-- Button to open/hide menu -->
<!-- Main content -->
<section role="main" id="main">
<!--Contact form starts here-->
    <form method="post" action="<?php echo base_url()?>contact/contactprocess/" title="Registration"  id="form-login">
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" >
                    <fieldset class="fieldset">
                        <legend class="legend">Contact</legend>
                        <!--Name field-->
                        <p class="inline-small-label button-height">
                            <label for="validation-required" class="label">Name<font color="red">*</font></label>
                            <input type="text" name="name" id="first_name" class="input validate[required]" value="" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <!--Phone number field-->
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Phone number<font color="red">*</font></label>
                            <input type="text" name="phonenumber" id="company_phonenumber" class="input validate[required]" maxlength="11" onchange="isvalidphoneno();" value="" data-tooltip-options='{"position":"right"}' maxlength="11"/>
                        </p>
                        <!--Email field-->
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Email<font color="red">*</font></label>
                            <input type="text" name="email" id="validation_email" class="input validate[required,custom[email]]" value="" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <!--Message field-->
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Message<font color="red">*</font></label>
                            <input type="text" name="message" id="address" class="input validate[required]" value="" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <div class="field-block button-height" >
                            <!--Button to save--> 
                            <button type="submit" class="button glossy mid-margin-right">
                                <span class="button-icon"><span class="icon-tick"></span></span>
                                Save
                            </button>
                            <!--Button to cancel-->
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
    <!--Contact form ends here-->