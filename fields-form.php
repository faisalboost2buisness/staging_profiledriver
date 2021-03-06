<!--File to change the name-->
<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<script src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/developr.table.js"></script>
<!-- Plugins -->
<script src="<?=base_url()?>js/libs/jquery.tablesorter.min.js"></script>
<script src="<?=base_url()?>js/libs/DataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript">
function updatefieldname(changedfieldname,fieldname,user_id,fileid,id,field_id_get_append){
$.post('<?php echo base_url(); ?>/upload/update_changedfieldname',{changed_name :changedfieldname,field_name : fieldname,userid : user_id,file_id :fileid,id : id},function(data) {
if(data=='Error'){
    alert('Please select another field name to continue');
    var x=$('#select_db_feild'+field_id_get_append).val();
    
   // $('#select_db_feild'+field_id_get_append).prepend("<option value='' selected='selected'>Please select</option>");
   $('#select_db_feild'+field_id_get_append).prop('selectedIndex',0);
   
  
}else{
    
}
});
}
</script>
<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<!-- Button to open/hide menu -->
<a href="#" id="open-menu"><span>Menu</span></a>
<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
<!-- Main content -->
<section role="main" id="main">
<hgroup id="main-title" class="thin" style="text-align: left;">
<h1>Upload</h1>
</hgroup>
<style>
.select{
width:250px;
}
.field-block {
    padding: 0 30px 0 140px;
}
.inline-small-label > .label{
    float: right;
}
</style>
<script type="text/javascript">
function submit_fieldform(){
  $('#formedit-login').submit();  
}
</script>
    <?php
    if(isset($error)){
    ?>
    <div style="color: red;">
    <?php
    echo $error;
    ?>
    </div>
    <?php
    }if(isset($success)){
    echo $success;
    }
    //echo $file_name;
    ?>
    <!--Field display form starts here-->
    <form method="post" action="<?php echo base_url()?>upload/fieldprocess" title="Registration"  id="form-login" enctype="multipart/form-data">
       <input type="hidden" value="<?=$file_name?>" name="file_name"/>
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" style="margin-left:236px">
                    <fieldset class="fieldset">
                    <legend class="legend">Fields</legend>
                       <span style="color: gray;">(We've extracted one of your customer records to make sure and to match our fields choose the correct field label from each drop down)</span>
                        <?php
                        $extension=end(explode(".",$file_name));
                        $file_id=$this->upload_model ->select_filename($file_name,$user_id);
                        $count_array=count($first_field_values);
                        $count=0;
                      
                            for($i=0;$i<1;$i++){
                                if($extension=='csv'){
                               $base_path = $this -> config -> item('rootpath');
                              require_once $base_path.'uploadfile/parsecsv.lib.php';
                                $csv_file_display = new parseCSV();
                                $csv_file_display->auto($filepath);
                                //$this->load->view('csv_view',$data);
                                $first_field_values= $csv_file_display->titles; 
                              
                              $feild_count_id=1;
                                    foreach($csv_file_display->titles as $all_field){
                                        if($all_field!='')
                                        {
                                       //function called to get file id
                                       $id=$this -> upload_model ->select_field_id($file_id,$user_id,$all_field);
                                       //function to get the field names
                                       $field_result=$this -> upload_model ->find_fieldname($all_field);
                                      if($field_result=='Valid'){
                                        $count=1;
                                    ?>
                                    <p class="inline-small-label button-height" style="margin-top: 15px;">
                                        
                                        <select  id="select_db_feild<?=$feild_count_id?>" name="<?=$all_field?>" class="select validate[required]" onchange="updatefieldname(this.value,'<?=$all_field?>','<?=$user_id?>','<?=$file_id?>','<?=$id?>','<?=$feild_count_id?>')">
                                            <option value="">Please select</option>
                                            <?php
                                            foreach($field_details as $value){
                                            ?>
                                            <option value="<?=$value['field_name']?>" ><?=$value['field_name']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        
                                        <label for="validation-select" class="label"><?=$all_field?></label>
                                        </p>
                                    <?php
                                    }
                                    $feild_count_id++;
                                    
                                    }                                   
                                }
                                }else{
                                    $feild_count_id1=1;
                                    foreach($first_field_values as $all_field){
                                   //function called to get file id
                                   $id=$this -> upload_model ->select_field_id($file_id,$user_id,$all_field);
                                   //function to get the field names
                                   $field_result=$this -> upload_model ->find_fieldname($all_field);
                                  if($field_result=='Valid'){
                                    $count=1;
                                ?>
                                <p class="inline-small-label button-height">
                                  
                                    <select  id="select_db_feild<?=$feild_count_id1?>" name="<?=$all_field?>" class="select validate[required]" onchange="updatefieldname(this.value,'<?=$all_field?>','<?=$user_id?>','<?=$file_id?>','<?=$id?>','<?=$feild_count_id1?>')">
                                        <option value="">Please select</option>
                                        <?php
                                        foreach($field_details as $value){
                                        ?>
                                        <option value="<?=$value['field_name']?>" ><?=$value['field_name']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    
                                      <label for="validation-select" class="label" ><?=$all_field?></label>
                                    </p>
                                <?php
                                }
                                $feild_count_id1++;
                                }
                                }
                            }
                            if($count==0){
                                if($extension=='csv'){
                                        $file_extension='CSV';
                                    }else{
                                        $file_extension='XLS';
                                    }
                                    ?>
                                <p class="inline-small-label button-height" style="color: gray; font-weight: bold;">
                                   All the fields in the <?=$file_extension?> file matches our database field.Do you want to continue ?
                                    <?php
                                
                            }
                            ?>
                        
                         <div class="field-block button-height">
							<button type="submit" class="button glossy mid-margin-right" onclick="submit_fieldform()">
								<span class="button-icon"><span class="icon-tick"></span></span>
								Continue
							</button>
                            </div>
                    </fieldset>
                </div>
            </div>
        </div>

    </form>
    <!--Field display form ends here-->
</section>        