<!--Page to add dealers-->
<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<section role="main" id="main">
    <hgroup id="main-title" class="thin" style="text-align: left;">
        <h1>Settings</h1>
    </hgroup>
    <?php
    if(isset($error)){
        echo $error;
    }
    if(isset($success)){
    ?>    
        <div style="color: green;"><?php echo $success;?></div>
    <?
    }
    ?>
    <style>
    .select{
        width: 261px;
    }
    .drop-down{
        text-align: left;
        width: 256px; 
        height:76px 
    }
    .field-block{
        padding: 0 30px 0 182px;
    }
    .field-block.button-height {
        margin-bottom: 16px;
        margin-left: 32px;
        margin-top: -31px;
        text-align: right;
    }
    .field-block {
        padding: 0 20px 0 194px;
    }
    </style>
    <?php 
    /*Dealer details*/
    $selected='';
    $dealer_details=$this -> settings_model -> assigned_dealer_with_alldealers($user_id);
    if(isset($dealer_details) && is_array($dealer_details)){
        foreach($dealer_details as $value){ 
            $dealer_details=$this -> settings_model ->managers_assigned_dealers($user_id);
            if(isset($dealer_details) && $dealer_details!=''){
                if(in_array($value['registration_id'],$dealer_details)){
                    $selected='selected';
                }
                else{
                    $selected='';
                }
            }
        }
    }
    ?>
    <!--dealers assigning form starts here-->
    <form method="post" action="<?php echo base_url()?>settings/setting_uploadprocess" title="Add Dealers"  id="form-login">
    <input type="hidden" value="<?=$user_id?>" name="user_id" id="user_memberid"/>
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" style="float: none;margin: 0 auto;width: 686px;">
                    <fieldset class="fieldset" style="width: 657px;">
                        <!--heading-->
                        <legend class="legend">Add Dealer</legend> 
                        <!--Button to save and return back-->
                        <div class="field-block button-height">
                            <button type="button" class="button glossy mid-margin-right" onclick="back_form();" >
                            <span class="button-icon green-gradient"><span class="icon-backward"></span></span>Save</button>
                        </div>
                        <!--box to select dealers-->
                        <p class="inline-small-label button-height" id="canadian_state" style="float: left; width: 225px;padding:0;">
                            <select id="validation-select" name="dealers[]"  multiple style="width:221px;" size="5">
                                <?php 
                                /*Dealer details*/
                                $selected='';
                                $dealer_details=$this -> settings_model -> assigned_alldealers($user_id);
                                if(isset($dealer_details) && is_array($dealer_details)){
                                    foreach($dealer_details as $value){ 
                                        $dealer_name=$value['first_name'].' '.$value['last_name'];
                                        ?>                                
                                        <option value="<?=$value['registration_id']?>" ><?php echo $dealer_name?></option>                                
                                        <?php
                                    }
                                }else{
                                ?>                                
                                    <option value="" >No dealers Found</option>                                
                                <?php
                                }
                                ?>
                            </select> 
                        </p>
                        <div style="float: left; width: 168px; margin-left: 16px;">
                            <!--Button to add dealers-->
                            <button type="button" class="button glossy mid-margin-right" onclick="adddealers();" style="width: 80px;">
                                <span class="button-icon red-gradient" style="margin-left:-42px"><span class="icon-right"></span></span>
                                Add
                            </button> 
                            <!--Button to remove dealers-->
                            <button type="button" class="button glossy mid-margin-right" onclick="removedealer();"  style="margin-top: 10px;">
                                <span class="button-icon black-gradient"><span class="icon-left"></span></span>
                                Remove
                            </button>   
                        </div>  
                        <input type="hidden" value="" id="valuesdeal"/>
                        <div id="old_dealers" style="float: left; width: 168px; margin-left: 11px;">
                            <select id="validation-remove" name="dealers_remove[]" multiple style="width:221px;" size="5">
                                <?php 
                                /*Dealer details*/
                                $selected='';
                                $dealer_details=$this -> settings_model -> new_removeddealers($user_id);
                                if(isset($dealer_details) && is_array($dealer_details)){
                                    foreach($dealer_details as $value){
                                        $dealer_details=$this -> settings_model ->managers_assigned_dealers($user_id);
                                        $assigned_dealer_name=$value['first_name'].' '.$value['last_name'];   
                                        ?>                                
                                        <option value="<?=$value['registration_id']?>" ><?php echo $assigned_dealer_name?></option>                                
                                        <?php
                                    }
                                }else{
                                    ?>                                
                                    <option value="" >No dealers Found</option>                                
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <select id="new_dealers" name="dealers_remove[]" style="width:205px;display:none;" multiple size="5">
                        </select><br />
                    </fieldset> 
                </div>
            </div>
        </div>
    </form>
    <!--dealers assigning form ends here-->
</section>
<!-- Scripts -->
<script src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>
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
<script type="text/javascript">
    //function to add new dealers to list
    function adddealers(){
        var dealers_name=$('#validation-select').val();
        var member_name=$('#user_memberid').val();
        $('#validation-select option:selected').remove();
        $.post('<?=base_url()?>settings/adddealers',{dealers_name :  dealers_name,member_id : member_name},function(data){
            $('#old_dealers').hide();
            $('#new_dealers').show();
            $('#valuesdeal').val('yes');
            $('#new_dealers').html(data);
        });
    }
    //function to remove dealers
    function removedealer(){
        var dealers_name=$('#validation-remove').val();
        var valuesdeal=$('#valuesdeal').val();
        $('#validation-remove option:selected').appendTo('#validation-select');
        if(valuesdeal=='yes'){
            var dealers_name=$('#new_dealers').val();
            $('#new_dealers option:selected').appendTo('#validation-select');
        }
        var member_name=$('#user_memberid').val();
        $.post('<?=base_url()?>settings/removedealers',{dealers_name :  dealers_name,member_id : member_name},function(data){
            $('#old_dealers').hide();
            $('#new_dealers').show();
            $('#valuesdeal').val('yes');
            $('#new_dealers').html(data);
        });
    }
    //function to show removed dealer list
    function removednewdealerlist(){
        var member_name2=$('#user_memberid').val();
        var dealers_name=$('#validation-remove').val();
        $.post('<?=base_url()?>settings/newdealerlist',{dealers_name :  dealers_name,member_id : member_name2},function(data){
            $('#validation-remove').hide();
            $('#validation-select').hide();
            $('#newassigneddealers').show();
            $('#valuesdealer').val('yes');
            $('#newassigneddealers').html(data);
        });
    }
</script>