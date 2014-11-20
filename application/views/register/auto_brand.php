<?php

$created_id = $menu['logged_in']['registration_id'];
$action = (is_object($user)) ? 'edit_user/'.$user->registration_id : 'create_user/'.$membership_type;
$is_edit = (is_object($user)) ? true : false;
$membership_name =  (is_object($user)) ? $user->first_name.' (Auto Manufacturer)' : 'Auto Manufacturer Registration';
?>
<hgroup id="main-title" class="thin" style="text-align: left;">
    <h1><?php echo ($is_edit) ? 'View Profile' : 'Registration' ?></h1>
</hgroup>
<?php if(isset($message) && $message != ""){ ?>
    <div style="color: red; border: 1px dashed; width: 50%; margin: 0px auto; padding: 13px;"><?=$message;?></div>
<?php
}if(isset($success)){
    ?>
    <div style="color: green; border: 1px dashed green; width: 50%; margin: 0px auto; padding: 13px;"><?=$success;?></div>
<?php
}
?>


<form method="post" action="<?php echo base_url()?>auth/<?php echo $action?>" title="Registration"  id="form-login">
        <input type="hidden" name="created_id" value="<?=$created_id?>"/>
        <?php //echo form_hidden($csrf); ?>
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                    <fieldset class="fieldset">
                        <legend class="legend"><?=$membership_name?></legend>
                        <div class="formheader">Auto Manufacturer Info</div>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Company Name<font color="red">*</font></label>
                            <input type="text" name="company_name" id="company_name" class="input validate[required]" value="<?php echo $company_name; ?>" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Address<font color="red">*</font></label>
                            <input type="text" name="address" id="address" class="input validate[required]" value="<?php echo $address; ?>" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Country<font color="red">*</font></label>
                            <select id="validation-select" name="country" class="select validate[required]" style="text-align: left;" onchange="zipcodechange()">
                                <option value="Canada" <?php echo $country=='Canada' ? ' selected ':''; ?>>Canada</option>
                                <option value="USA" <?php echo $country=='USA' ? ' selected ':''; ?>>USA</option>
                            ?>
                            </select>
                        </p>
                        <p class="inline-small-label button-height" id="canadian_state">
                            <label for="small-label-1" class="label">Province<font color="red">*</font></label>
                            <select id="states" name="canadastate" class="select validate[required]" style="text-align: left;">
                                <?php
                                $ststes_fields = $this->main_model->Canadian_provinces();
                                foreach($ststes_fields as $key=>$value){
                                    ?>
                                    <option value="<?=$key?>" <?php echo $canadastate == $key ? ' selected ':''; ?>><?=$value?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                        <p class="inline-small-label button-height" id="usa_state" style="display: none;">
                            <label for="small-label-1" class="label">Province<font color="red">*</font></label>
                            <select id="states" name="state"  style="text-align: left;" class="select validate[required]">
                                <?php

                                $state = ($is_edit) ? $state : '';
                                foreach($states as $key=>$value){
                                    ?>
                                    <option value="<?=$value['code']?>" <?php echo $state == $value['code'] ? ' selected ':''; ?>><?=$value['state']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">City</label>
                            <input type="text" name="city" id="city" class="input " value="<?php echo $city; ?>" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label" id="postalcodelabel">Postal Code<font color="red">*</font></label>
                            <label for="small-label-1" class="label" id="zipcodelabel" style="display: none;">Zip Code<font color="red">*</font></label>
                            <input type="text" name="zipcode" id="post_code" class="input zipcodes validate[required]" value="<?php echo $zipcode; ?>" data-tooltip-options='{"position":"right"}' onblur="changeupper();"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Phone Number<font color="red">*</font></label>
                            <input type="text" name="company_phonenumber" id="company_phonenumber" class="input validate[required]"  value="<?php echo $company_phonenumber; ?>" data-tooltip-options='{"position":"right"}' maxlength="11"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Website</label>
                            <input type="text" name="company_website" id="company_website" class="input small-margin-right" value="<?php echo $company_website; ?>"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Manufacturer<font color="red">*</font><br /><span style="font-size: 11px;">(Ctrl+Click for multiple selections)</span></label>
                            <select id="masterbrand"  name="masterbrand[]" class="select validate[required] selectMultiple" style="text-align: left;overflow-y: scroll;"  multiple="">
                                <?php
                                $makes_details=$this->main_model->makes_models();
                                $masterbrand = ($is_edit) ? $masterbrand : array();
                                foreach($makes_details as $makes){
                                    ?>
                                    <option value="<?=$makes['make']?>" <?php echo (in_array($makes['make'],$masterbrand)) ? ' selected="selected" ':''; ?>><?=$makes['make']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                        <div class="formheader">Contact Info</div>
                        <p class="inline-small-label button-height">
                            <label for="validation-required" class="label">First Name<font color="red">*</font></label>
                            <input type="text" name="first_name" id="first_name" class="input validate[required]" value="<?php echo $first_name; ?>" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Last Name<font color="red">*</font></label>
                            <input type="text" name="last_name" class="input validate[required]" id="last_name" class="input small-margin-right" value="<?php echo $last_name; ?>"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Contact Phone</label>
                            <input type="text" name="contact_phoneno" id="contact_person" class="input small-margin-right" value="<?php echo $contact_phoneno; ?>"/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Contact Email<font color="red">*</font><br /></label>
                            <input type="text" name="email" id="validation_email" class="input validate[required,custom[email]]" value="<?php echo $email; ?>" data-tooltip-options='{"position":"right"}'/><br />
                            <span style="font-size: 11px;color:grey;">[Set as Username]</span>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Job Position<font color="red">*</font></label>
                            <input type="text" name="job_position" id="job_position" class="input validate[required]" value="<?php echo $job_position?>" data-tooltip-options='{"position":"right"}'/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Password<font color="red">*</font></label>
                            <input type="password" name="password" id="password" class="input <?= (!$is_edit) ? 'validate[required]' : '' ?>" value=""/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Confirm Password<font color="red">*</font></label>
                            <input type="password" name="confirm_password" id="confirm_Password" class="input <?= (!$is_edit) ? 'validate[required]' : '' ?>" value="" onchange="return checkpassword();" data-tooltip-options='{"position":"right"}'/>
                        </p>

                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="auto_brand" data-tooltip-options='{"position":"right"}'/>

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

</section>
<?php $this->load->view('register/static_contents');?>