<?php
    $created_id = $menu['logged_in']['registration_id'];
    //$user_legend='Register '.$membership_name;
    $action = (is_object($user)) ? 'edit_user/'.$user->registration_id : 'create_user/'.$membership_type;
    $is_edit = (is_object($user)) ? true : false;
    $membership_name =  (is_object($user)) ? $user->first_name.' ('.ucwords(str_replace("_"," ",$user->usertype)).')' : ucwords(str_replace("_"," ",$membership_type)) .' Registration';
?>
<hgroup id="main-title" class="thin" style="text-align: left;">
    <h1><?php echo ($is_edit) ? 'View Profile' : 'Registration' ?></h1>
</hgroup>
<?php if(isset($message) && $message != ""){ ?>
    <div style="color: red; border: 1px dashed; width: 50%; margin: 0px auto; padding: 13px;"><?=$message;?></div>
<?php }if(isset($success)){ ?>
    <div style="color: green; border: 1px dashed green; width: 50%; margin: 0px auto; padding: 13px;"><?=$success;?></div>
<?php }?>
<form method="post" action="<?php echo base_url()?>auth/<?php echo $action ?>" title="Registration"  id="form-login">
    <input type="hidden" name="created_id" value="<?=$created_id?>"/>
    <?php //echo form_hidden($csrf); ?>
    <div class="with-padding" style="margin-top: 15px;">
        <div class="columns">
            <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 529px;">
                <fieldset class="fieldset">
                    <legend class="legend"><?=$membership_name?></legend>
                    <div class="formheader">Contact Info</div>
                    <p class="inline-small-label button-height">
                        <label for="validation-required" class="label">First Name<font color="red">*</font></label>
                        <input type="text" name="first_name" id="first_name" class="input validate[required]" value="<?php echo $first_name; ?>" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Last Name<font color="red">*</font></label>
                        <input type="text" name="last_name" id="last_name" class="input validate[required]" value="<?php echo $last_name; ?>"/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Phone<font color="red">*</font></label>
                        <input type="text" name="contact_phoneno" id="contact_person" class="input validate[required]" data-tooltip-options='{"position":"right"}' value="<?php echo $contact_phoneno; ?>"/>
                    </p>
                    <?php if($membership_type == 'trainer'): ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Contact Phone2<font color="red">*</font></label>
                        <input type="text" name="contact_phoneno2" id="contact_person2"  data-tooltip-options='{"position":"right"}' value="<?php echo $contact_phoneno2; ?>"/>
                    </p>
                    <?php endif; ?>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Email<font color="red">*</font></label>
                        <input type="text" name="email" id="validation_email" class="input validate[required,custom[email]]" value="<?php echo $email_id; ?>" data-tooltip-options='{"position":"right"}'/><br />
                        <span style="font-size: 11px;color:grey;">[Set as Username]</span>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Password<font color="red">*</font></label>
                        <input type="password" name="password" id="password" class="input <?= (!$is_edit) ? 'validate[required]' : '' ?>" value=""/>
                    </p>
                    <p class="inline-small-label button-height">
                        <label for="small-label-1" class="label">Confirm Password<font color="red">*</font></label>
                        <input type="password" name="confirm_password" id="confirm_Password" class="input <?= (!$is_edit) ? 'validate[required]' : '' ?>" value="" data-tooltip-options='{"position":"right"}'/>
                    </p>
                    <?php
                    if($membership_type=='sales_person'){
                        ?>
                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="sales_person" data-tooltip-options='{"position":"right"}'/>
                    <?php
                    }elseif($membership_type=='account_managers'){
                        ?>
                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="account_managers" data-tooltip-options='{"position":"right"}'/>
                    <?php
                    }elseif($membership_type=='trainer'){
                        ?>
                        <input type="hidden" name="membership" id="membership" class="input validate[required]" value="trainer" data-tooltip-options='{"position":"right"}'/>
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
<?php $this->load->view('register/static_contents');?>
<?php if(!$is_edit): ?>
    <script>
        jQuery(function($){
            setTimeout(function(){
                jQuery("#company_phonenumber").mask("(999) 999-9999");
                jQuery("#contact_person").mask("(999) 999-9999");
                jQuery("#contact_person2").mask("(999) 999-9999");
                jQuery("#post_code").mask("AAA AAA");
                jQuery("#zip_code").mask("99999");
            },2000)

        });
    </script>
<?php endif; ?>