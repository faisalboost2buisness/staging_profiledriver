<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Campaignreporthtml extends CI_Controller 
{
public function __construct() 
    {
    parent::__construct();
    $this -> load -> helper('url');
    $this -> load -> library('session');
    $this -> load -> helper('form');
    $this -> load -> library('form_validation');
    $this->load->model('login_model'); 
    $this->load->model('main_model'); 
    $this->load->model('settings_model'); 
    $this->load->library("pagination");
    $this->load->library('session');
    $this->load->database();
    $this->load->helper('xml');
    $this->load->library('email');
   	}
//function to display report fields
public function check_report_type(){
    $report_get=$this->input->post('report_value');
    $lead_id=$this->input->post('lead_id');
    $event_id=$this->input->post('event_id');
    $id=$this->input->post('id');
    $first_fieldname='';
    $first_secondname='';
    $report_type_select='';
    $values_select='';
    $values_second_select='';
    $get_description=$this->settings_model->get_report_description($report_get);
    //print_r($get_reportfield);
    //$get_selected_options=$this->settings_model->get_advanced_option_group_details($event_id,$id);
    $get_selected_options=$this->settings_model->getgroupname_advanced_option($event_id,$id);
    if(isset($get_selected_options) && $get_selected_options!=''){
    foreach($get_selected_options as $values){
        $report_type_select=$values['report_type'];
        $values_select=$values['value1'];
        $values_second_select=$values['value2'];
    }
    }
    if($id==''){
      $id='1';  
    }
    else{
       $id=$id; 
            
    }
    if($report_get=='vehicle_class'){
    ?>
    <div style="float: right; width: 58%;margin-top: 10px;">
        <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
            <label for="small-label-1" class="label">Description</label>
            <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
            </div>
        </p>
        <div style="clear: both;"></div>
        <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
        <label for="small-label-1" class="label showlabel"></label>
        <div style="clear: both;"></div>
        <div id="vechicle_class_option" class="vechicle_class_option_show">
        <?php
        if($report_type_select=='vehicle_class'){
            $first_fieldname= $values_select; 
            }
            else{
             $first_fieldname='';
             }
             $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Vehicles","two_seater_cars"=>"Two Seater Cars","unknown"=>"Unknown");
             $report_first_fieldname=explode(',',$first_fieldname);
             ?>          
             <select id="report_vehicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
             <?php
             foreach($options as $id=>$value){
             if(in_array($id,$report_first_fieldname)){
             $selected='selected ';
             }else{
             $selected= ' ';
             }
             ?>
             <option value="<?=$id?>" <?php echo $selected?>><?=$value?></option>
             <?php
             }
             ?> 
             </select>
             </div>
             </p>
            <div style="clear: both;height: 4px;"></div>
            <div style="height: 20px;float: left;">&nbsp;</div>
        </div>
    <?php
    }
    elseif($report_get=='drive_type'){
    if($report_type_select=='drive_type'){
         $first_fieldname= $values_select; 
     }
      else{
        $first_fieldname='';
      } 
    ?>
    <div style="float: right; width: 58%;margin-top: 10px;">
        <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
            <label for="small-label-1" class="label">Description</label>
            <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
            </div>
        </p>
        <div style="clear: both;"></div>
        <h4 class="typetitle"><label class="showreportdiv" >Drive Type</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
            <label for="small-label-1" class="label showlabel"></label>
            <div style="clear: both;"></div>
            <div id="vechicle_class_option" class="vechicle_class_option_show">
                <select name="drive_type" id="drive_type<?php echo $id?>" class="select" style="text-align: left;width:299px;" >
                <option value="fwd" <?php echo $first_fieldname=='fwd' ? ' selected ':''; ?>>FWD</option>
                <option value="rwd" <?php echo $first_fieldname=='rwd' ? ' selected ':''; ?>>RWD</option>
                <option value="awd" <?php echo $first_fieldname=='awd' ? ' selected ':''; ?>>AWD</option>
                <option value="4x4" <?php echo $first_fieldname=='4x4' ? ' selected ':''; ?>>4x4</option>
                </select>
            </div>
        </p>
        <div style="clear: both;height: 4px;"></div>
        <div style="height: 20px;float: left;">&nbsp;</div>
    </div>
    <?php
    }
    elseif($report_get=='fuel_economy'){
        if($report_type_select=='fuel_economy'){
        $first_fieldname= $values_select; 
        $first_secondname= $values_second_select; 
        }
        else{
        $first_fieldname='';
        $first_secondname=''; 
        } 
        ?>
        <div style="float: right; width: 58%;margin-top: 10px;">
        <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
           <label for="small-label-1" class="label">Description</label>
           <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
           </div>
       </p>
       <div style="clear: both;"></div>
       <h4 class="typetitle"><label class="showreportdiv" >Fuel Economy</label></h4>
       <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
           <label for="small-label-1" class="label showlabel"></label>
           <div style="clear: both;"></div>
           <div id="vechicle_class_option" class="vechicle_class_option_show">
               <div style="float:left;width:100%"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">From</label>
                   <input type="text" id="fuel_economy_from<?php echo $id?>" name="fuel_economy_from" class="input" value="<?php echo $first_fieldname?>" style="text-align: left;width:103px;" placeholder="litre/100 km"/></p>
                   <p class="inline-small-label button-height pclass" style="float: left;">
                       <label class="label" for="small-label-1" style="margin-left: 11px; width: 21px;">To</label>
                       <input type="text" id="fuel_economy_to<?php echo $id?>" name="fuel_economy_to" class="input" value="<?php echo $first_secondname?>" style="text-align: left;width:103px;" placeholder="litre/100 km"/>
                   </p></div>
           </div>
       </p>
       <div style="clear: both;height: 4px;"></div>
       <div style="height: 20px;float: left;">&nbsp;</div>
       </div>
       <?php
   }
   elseif($report_get=='trade_in_value'){
       if($report_type_select=='trade_in_value'){
       $first_fieldname= $values_select; 
       $first_secondname= $values_second_select; 
       }
       else{
       $first_fieldname='';
       $first_secondname=''; 
       }
       ?>
        <div style="float: right; width: 58%;margin-top: 10px;">
            <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                <label for="small-label-1" class="label">Description</label>
                <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                </div>
            </p>
            <div style="clear: both;"></div>
            <h4 class="typetitle"><label class="showreportdiv" >Trade In Value</label></h4>
            <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                <label for="small-label-1" class="label showlabel"></label>
                <div style="clear: both;"></div>
                <div id="vechicle_class_option" class="vechicle_class_option_show">
                    <div style="float:left;width:100%"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">From</label>
                    <input type="text"  name="trade_in_from" id="trade_in_value_from<?php echo $id?>" value="<?php echo $first_fieldname?>" class="input" style="text-align: left;width:103px;"></p>
                    <p class="inline-small-label button-height pclass" style="float: left;">
                        <label class="label" for="small-label-1" style="margin-left: 11px; width: 21px;">To</label>
                        <input type="text"  name="trade_in_to" id="trade_in_value_to<?php echo $id?>" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:103px;">
                    </p></div>
                      <div style="clear: both;"></div>
                <div id="vechicle_class_option" style="float:left;margin-top: 10px;">
                <select name="tradeinvalue_options" id="tradeinvalue_options<?php echo $id?>" class="select" style="text-align: left;width:307px;" >
                <option value="high" <?php echo $first_fieldname=='high' ? ' selected ':''; ?>>High</option>
                <option value="low" <?php echo $first_fieldname=='low' ? ' selected ':''; ?>>Low</option>
                <option value="average" <?php echo $first_fieldname=='average' ? ' selected ':''; ?>>Average</option>
                </select>
            </div>
                </div>
            </p>
            <div style="clear: both;height: 4px;"></div>
            <div style="height: 20px;float: left;">&nbsp;</div>
        </div>
        <?php
    }
    elseif($report_get=='finance_rate'){
        if($report_type_select=='finance_rate'){
        $first_fieldname= $values_select; 
        $first_secondname= $values_second_select; 
        }
        else{
        $first_fieldname='';
        $first_secondname=''; 
        }
        ?>
        <div style="float: right; width: 58%;margin-top: 10px;">
        <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
            <label for="small-label-1" class="label">Description</label>
            <div class="report_type_description" id="report_type_description"><?=$get_description?>
            </div>
        </p>
        <div style="clear: both;"></div>
        <h4 class="typetitle"><label class="showreportdiv" >Finance Rate (APR)</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
            <label for="small-label-1" class="label showlabel"></label>
            <div style="clear: both;"></div>
            <div id="vechicle_class_option" class="vechicle_class_option_show">
                <div style="float:left;width:100%;" id="show_form_field"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">Min</label>
                    <input type="text" id="monthly_payment_from<?php echo $id?>" name="monthly_payment_from" class="input" value="<?php echo $first_fieldname?>" style="text-align: left;width:96px;"></p>
                    <p class="inline-small-label button-height pclass" style="float: left;">
                        <label class="label" for="small-label-1" style="margin-left: 11px; width: 35px;">Max</label>
                        <input type="text" id="monthly_payment_to<?php echo $id?>" name="monthly_payment_to" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:96px;">
                    </p>
                </div>
            </div>
        </p>
        <div style="clear: both;height: 4px;"></div>
        <div style="height: 20px;float: left;">&nbsp;</div>
        </div>
        <?php  
    }
    elseif($report_get=='fuel_type'){
    if($report_type_select=='fuel_type'){
    $first_fieldname= $values['field_name1']; 
    $first_secondname= $values_select;
    }
    else{
    $first_fieldname='';
    $first_secondname='';
                
    }
    ?>
        <div style="float: right; width: 58%;margin-top: 10px;">
        <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
            <label for="small-label-1" class="label">Description</label>
            <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
            </div>
        </p>
        <div style="clear: both;"></div>
        <h4 class="typetitle"><label class="showreportdiv" >Fuel Type</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
            <label for="small-label-1" class="label showlabel"></label>
            <div style="clear: both;"></div>
                <div id="vechicle_class_option" class="vechicle_class_option_show">
                <p class="inline-small-label button-height pclass" style="float: left;width: 80px;"><label style="float: left;">
                    <label class="label" for="small-label-1" style="width:80px;">
                    <input type="radio" name="fuel_type" id="fuel_type<?php echo $id?>" value="gas" style="width: 21px;float: none;" <?php if($first_fieldname=='gas'){ echo ' checked="checked"';}else{ }?> checked/>Gas</label></label>
                </p>
                
                 <p class="inline-small-label button-height pclass" style="float: left;width: 80px;"><label style="float: left;">
                    <label class="label" for="small-label-1" style="width:80px;">
                    <input type="radio" name="fuel_type" id="fuel_type<?php echo $id?>" value="diesel" style="width: 21px;float: none;" <?php if($first_fieldname=='diesel'){ echo ' checked="checked"';}else{ }?>/>Diesel</label></label>
                </p>
                 <p class="inline-small-label button-height pclass" style="float: left;width: 80px;"><label style="float: left;">
                    <label class="label" for="small-label-1" style="width:80px;">
                    <input type="radio" name="fuel_type" id="unknown<?php echo $id?>" value="unknown" style="width: 21px;float: none;" <?php if($first_fieldname=='unknown'){ echo ' checked="checked"';}else{ }?>/>Unknown</label></label>
                </p>
                <div style="clear:both;"></div>
                <p class="inline-small-label button-height pclass" style="float: left;">
                <?php
                $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Vehicles");
                $report_first_fieldname=explode(',',$first_secondname);
                ?>
                <select id="fuel_vehicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                <?php
                foreach($options as $id=>$value){
                if(in_array($id,$report_first_fieldname)) {
                 $selected='selected ';
                 }else {
                 $selected= ' ';
                        
                 }
                 ?>
                 <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                  <?php
                  }
                  ?> 
                   </select>
                </p>
                </div>
        </p>
        <div style="clear: both;height: 4px;"></div>
        <div style="height: 20px;float: left;">&nbsp;</div>
    </div>
    <?php   
    }
     elseif($report_get=='local_town'){
     if($report_type_select=='local_town'){
     $first_fieldname= $values['field_name1']; 
     $first_secondname= $values_select;
      }
      else{
      $first_fieldname='';
      $first_secondname='';
      }   
      ?>
     <div style="float: right; width: 58%;margin-top: 10px;">
        <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
            <label for="small-label-1" class="label">Description</label>
            <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
            </div>
        </p>
        <div style="clear: both;"></div>
        <h4 class="typetitle"><label class="showreportdiv" >Local vs Out of Town</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
            <label for="small-label-1" class="label showlabel"></label>
            <div style="clear: both;"></div>
            <div id="vechicle_class_option" class="vechicle_class_option_show">
            <p class="inline-small-label button-height pclass" style="float: left;width: 80px;"><label style="float: left;">
            <label class="label" for="small-label-1" style="width:80px;">
            <input type="radio" name="local_town" id="local_town<?php echo $id?>" value="local" style="width: 21px;float: none;" <?php if($first_fieldname=='local'){ echo ' checked="checked"';}else{ }?> checked/>Local</label></label>
            </p>
            <p class="inline-small-label button-height pclass" style="float: left;width: 112px;"><label style="float: left;">
            <label class="label" for="small-label-1" style="width:216px;">
             <input type="radio" name="local_town" id="local_town<?php echo $id?>" value="out_of_town" style="width: 21px;float:none" <?php if($first_fieldname=='out_of_town'){ echo ' checked="checked"';}else{ }?>/>Out Of Town</label></label>
            </p>
            <div style="clear:both"></div>
            <p class="inline-small-label button-height pclass" style="float: left;">
                <?php
                $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Vehicles");
                $report_first_fieldname=explode(',',$first_secondname);
                ?>
                <select id="town_vehicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                <?php
                foreach($options as $id=>$value){
                if(in_array($id,$report_first_fieldname)){
                 $selected='selected ';
                 }else {
                  $selected= ' ';
                        
                        }
                        ?>
                  <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                  <?php
                    }
                    ?> 
                    </select>
            </p>
        </div>
        </p>
        <div style="clear: both;height: 4px;"></div>
        <div style="height: 20px;float: left;">&nbsp;</div>
    </div>
    <?php    
    }
    elseif($report_get=='used_new_purchaser'){
        if($report_type_select=='used_new_purchaser'){
        $first_fieldname= $values['field_name1']; 
        $first_secondname= $values_select;
         }
         else{
         $first_fieldname='';
         $first_secondname='';
                    
         }  
         ?>
         <div style="float: right; width: 58%;margin-top: 10px;">
             <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                 <label for="small-label-1" class="label">Description</label>
                 <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                 </div>
             </p>
             <div style="clear: both;"></div>
             <h4 class="typetitle"><label class="showreportdiv" >Used vs New Purchaser</label></h4>
             <p class="inline-small-label button-height pclass" style="float: left;">
                  <div style="clear: both;"></div>
                  <div id="vechicle_class_option" class="vechicle_class_option_show">
                      <p class="inline-small-label button-height pclass" style="float: left;width: 117px;">
                          <label class="label"  style="width:119px;"><input type="radio" name="used_new_purchaser" id="used_new_purchaser<?php echo $id?>" value="new" <?php if($first_fieldname=='new'){ echo ' checked="checked"';}else{ }?> style="width: 21px;margin-top:9px;" checked="checked" />&nbsp;&nbsp;New vehicle
                          </label>
                      </p>
                      <p class="inline-small-label button-height pclass" style="float: left;width: 117px;">
                          <label class="label"  style="width:139px;"><input type="radio" name="used_new_purchaser" id="used_new_purchaser<?php echo $id?>" value="used" <?php if($first_fieldname=='used'){ echo ' checked="checked"';}else{ }?> style="width: 21px;margin-top:9px;" />&nbsp;&nbsp;Used vehicle
                          </label>
                      </p>
                      <div style="clear:both"></div>
                      <p class="inline-small-label button-height pclass" style="float: left;">
                          <?php
                          $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Vehicles");
                          $report_first_fieldname=explode(',',$first_secondname);
                          ?>
                          <select id="purchase_vechicle_class<?php echo $id?>" name="vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                          <?php
                          foreach($options as $id=>$value){
                              if(in_array($id,$report_first_fieldname)) {
                              $selected='selected ';
                              }else {
                              $selected= ' ';
                              }
                              ?>
                              <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                             <?php
                         }
                         ?> 
                         </select>
                 </p>
                 </div>
            </p>
            <div style="clear: both;height: 4px;"></div>
            <div style="height: 20px;float: left;">&nbsp;</div>
        </div>
        <?php    
    }
    elseif($report_get=='power_focus'){
        if($report_type_select=='power_focus'){
        $first_fieldname= $values_select; 
        }
        else{
        $first_fieldname='';
        } 
        ?>
        <div style="float: right; width: 58%;margin-top: 10px;">
            <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
                <label for="small-label-1" class="label">Description</label>
                <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
                </div>
            </p>
            <div style="clear: both;"></div>
            <h4 class="typetitle"><label class="showreportdiv" >Performance Vehicles</label></h4>
            <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                <label for="small-label-1" class="label showlabel"></label>
                <div style="clear: both;"></div>
                <div id="vechicle_class_option" class="vechicle_class_option_show">
                     <?php
                     $options = array("four_door_cars"=>"4 Door Cars","two_door_cars"=>"2 Door Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","other"=>"Other");
                     $report_first_fieldname=explode(',',$first_fieldname);
                     ?>
                     <select id="power_vechicle_class<?php echo $id?>" name="power_vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                         <?php
                         foreach($options as $id=>$value){
                             if(in_array($id,$report_first_fieldname)) {
                             $selected='selected ';
                             }else {
                             $selected= ' ';
                             }
                             ?>
                             <option value="<?=$id?>" <?=$selected?>><?=$value?></option>
                             <?php
                         }
                         ?> 
                     </select>
                 </div>
             </p>
             <div style="clear: both;height: 4px;"></div>
             <div style="height: 20px;float: left;">&nbsp;</div>
         </div>
         <?php
     }
     elseif($report_get=='monthly_payment'){
         if($report_type_select=='monthly_payment'){
         $first_fieldname= $values_select; 
         $first_secondname= $values_second_select; 
         }
         else{
         $first_fieldname='';
         $first_secondname=''; 
         }
         ?>
         <div style="float: right; width: 58%;margin-top: 10px;">
         <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
         <label for="small-label-1" class="label">Description</label>
         <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
         </div>
         </p>
         <div style="clear: both;"></div>
         <h4 class="typetitle"><label class="showreportdiv" >Monthly Payment Range</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
        <label for="small-label-1" class="label showlabel"></label>
        <div style="clear: both;"></div>
        <div id="vechicle_class_option" class="vechicle_class_option_show">
        <div style="float:left;width:100%"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">Min</label>
        <input type="text" id="monthly_payment_from_id<?php echo $id?>" name="monthly_payment_from" value="<?php echo $first_fieldname?>" class="input"style="text-align: left;width:96px;"></p>
        <p class="inline-small-label button-height pclass" style="float: left;">
        <label class="label" for="small-label-1" style="margin-left: 11px; width: 35px;">Max</label>
        <input type="text" id="monthly_payment_to_id<?php echo $id?>" name="monthly_payment_to" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:96px;">
        </p></div>
        </div>
        </p>
        <div style="clear: both;height: 4px;"></div>
        <div style="height: 20px;float: left;">&nbsp;</div>
        </div>
        <?php
    }
    elseif($report_get=='out_warranty'){
    if($report_type_select=='out_warranty'){
        $first_fieldname= $values_select; 
    }else{
      $first_fieldname='';  
    }
    ?>
         <div style="float: right; width: 58%;margin-top: 10px;">
         <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
         <label for="small-label-1" class="label">Description</label>
         <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
         </div>
         </p>
         <div style="clear: both;"></div>
         <h4 class="typetitle"><label class="showreportdiv" >Out of Warranty</label></h4>
        <div style="float:left;width:98%">
            <div style="float:left;text-align: left; margin-bottom: 8px;">
                <label>
                    <input type="radio" name="vehicle_warranty" id="vehicle_warranty<?php echo $id?>" value="more_than_6months_basic_powertrain" style="width: 21px;float:left;height:18px" <?php if($first_fieldname=='more_than_6months_basic_powertrain'){ echo ' checked="checked"';}else{ }?>/>More than 6 months remaining on basic and powertrain
                </label>
            </div>
            <div style="float:left;text-align: left; margin-bottom: 8px;">
                <label>
                    <input type="radio" name="vehicle_warranty" id="vehicle_warranty<?php echo $id?>" value="less_than_6months_basicwarranty" style="width: 21px;float:left;height:18px" <?php if($first_fieldname=='less_than_6months_basicwarranty'){ echo ' checked="checked"';}else{ }?>/>Less than 6 months remaining on basic warranty
                </label>
            </div>
            <div style="float:left;text-align: left; margin-bottom: 8px;">
                <label>
                    <input type="radio" name="vehicle_warranty" id="vehicle_warranty<?php echo $id?>" value="no_basicwarranty_6months_powertrain" style="width: 21px;float:left;height:18px" <?php if($first_fieldname=='no_basicwarranty_6months_powertrain'){ echo ' checked="checked"';}else{ }?>/>No basic warranty remaining but more than 6 months on powertrain remaining
                </label>
            </div>
            <div style="float:left;text-align: left; margin-bottom: 8px;">
                <label>
                    <input type="radio" name="vehicle_warranty" id="vehicle_warranty<?php echo $id?>" value="less_than_6months_powertrain_warranty" style="width: 21px;float:left;height:18px" <?php if($first_fieldname=='less_than_6months_powertrain_warranty'){ echo ' checked="checked"';}else{ }?>/>Less than 6 months remaining on powertrain warranty
                </label>
            </div>
            <div style="float:left;text-align: left; margin-bottom: 8px;">
                <label>
                    <input type="radio" name="vehicle_warranty" id="vehicle_warranty<?php echo $id?>" value="no_warranty_vehicle" style="width: 21px;float:left;height:18px" <?php if($first_fieldname=='no_warranty_vehicle'){ echo ' checked="checked"';}else{ }?>/>No warranty on vehicle
                </label>
            </div>
        </div>
          </p>
          <div style="clear: both;height: 4px;"></div>
          <div style="height: 20px;float: left;">&nbsp;</div>
          </div>
          <?php
      }
      elseif($report_get=='specific_model'){
          if($report_type_select=='specific_model'){
          $first_fieldname= $values_select; 
          $first_secondname= $values_second_select; 
          }
          else{
          $first_fieldname='';
          $first_secondname=''; 
          }
          ?> 
           <div style="float: right; width: 58%;margin-top: 10px;">
           <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
           <label for="small-label-1" class="label">Description</label>
           <div class="report_type_description" id="report_type_description"><?php echo $get_description?>
           </div>
           </p>
            <div style="clear: both;"></div>
            <h4 class="typetitle"><label class="showreportdiv" >Specific Model Pull</label></h4>
            <div style="clear: both;height: 4px;"></div>
            <div style="width: 100%;float:left">
           <div style="float: left; text-align: left; width: 151px;"><label class="label" style="color: #808080;font-weight: 12px;font-weight: bold;;">Vehicle Manufacturer</label></div>
           <div style="float:left;margin-top: 8px;">
           <select name="vehicle_manufacture" id="vehicle_manufacture<?php echo $id?>" class="select" style="text-align: left;overflow-y: scroll;width:289px;" onchange="selectmodel(this.value,'<?php echo $id?>','<?php echo $first_secondname?>');">
           <option value="">Select</option>
           <?php
           $makes_details=$this->main_model->makes_models();
           foreach($makes_details as $makes){
           ?>
           <option value="<?=$makes['make']?>" <?php echo $makes['make']==$first_fieldname ? ' selected ':''; ?>><?=$makes['make']?></option>
           <?php
           }
           ?>
           </select>
    		</div>
            </div>
            <div style="width: 100%;float:left;margin-top: 20px;">
            <div style="float: left; text-align: left; width: 151px;"><label class="label" style="color: #808080;font-weight: 12px;font-weight: bold;;">Vehicle Models</label></div>
            <div style="float:left;margin-top: 8px;">
             <select name="vehicle_model" id="vehicle_model<?php echo $id?>" class="select" style="text-align: left;overflow-y: scroll;width:289px;" >
             <option value="">Select</option>
             </select>
    		</div>
          </div>
          </div>
          <?php 
      }
      elseif($report_get=='dealership_brand'){
      $user_id=$this->input->post('user_id');
      if(isset($user_id) || $user_id!=''){
      $get_userdetails=$this -> main_model -> user_data($user_id);
      $manufcture_name=$get_userdetails[0]['masterbrand'];
      }
      $specific_description=str_replace("#manufacture#","$manufcture_name",$get_description);
      ?>
      <div style="float: right; width: 58%;margin-top: 10px;">
      <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
      <label for="small-label-1" class="label">Description</label>
      <div class="report_type_description" id="report_type_description"><?php echo $specific_description?>
      </div>
      </p>
    <div style="clear: both;"></div>
    <h4 class="typetitle"><label class="showreportdiv" >Competitors Vehicle Owners</label></h4>
    <div style="clear: both;height: 4px;"></div>
    <div style="height: 20px;float: left;">&nbsp;</div>
    </div>
    <?php 
    }elseif ($report_get=='equity_scrapper') {
        if($report_type_select=='trade_in_value'){
            $first_fieldname= $values_select; 
            $first_secondname= $values_second_select; 
        }
        else{
            $first_fieldname='';
            $first_secondname=''; 
        }
        ?>
 <div style="float: right; width: 58%;margin-top: 10px;">
      <p class="inline-small-label button-height pclass" style="float: left; margin-top: 4px;">
      <label for="small-label-1" class="label">Description</label>
      <div class="report_type_description" id="report_type_description"><?php echo $get_description; ?>
      </div>
      </p>
    <div style="clear: both;"></div>
    <h4 class="typetitle"><label class="showreportdiv"> Equity Scrape</label></h4>
    <div style="clear: both;height: 4px;"></div>
    <div style="height: 20px;float: left;">&nbsp;</div>
    <div id="vechicle_class_option" class="vechicle_class_option_show">
    <p class="inline-small-label button-height pclass" style="float: left;">
                <?php
                $options = array ("full_size_cars"=>"Full-size Cars","mid_size_cars"=>"Mid-size Cars","small_cars"=>"Small Cars","suvs"=>"SUVs","crossovers"=>"Crossovers","trucks"=>"Trucks","vans"=>"Vans","green_cars"=>"Green Vehicles");
                $report_first_fieldname=explode(',',$first_secondname);
                ?>
                <select id="equity_vehicle_class<?php echo $id?>" name="equity_vehicle_class[]" class="select selectMultiple" style="text-align: left;overflow-y: scroll;width:299px;" multiple="">
                <?php
                foreach($options as $key=>$value){
                if(in_array($key,$report_first_fieldname)) {
                 $selected='selected ';
                 }else {
                 $selected= ' ';
                 }
                 ?>
                 <option value="<?=$key?>" <?=$selected?>><?=$value?></option>
                  <?php
                  }
                  ?> 
                   </select>
        </p>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                <label for="small-label-1" class="label showlabel"></label>
                <div style="clear: both;"></div>
                <div id="vechicle_class_option" class="vechicle_class_option_show">
                    <div style="float:left;width:100%"><h4 class="typetitle"><label class="showreportdiv" >OEM Incentive To Apply</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
            <label for="small-label-1" class="label showlabel"></label>
            <div style="clear: both;"></div>
            <div id="vechicle_class_option" class="vechicle_class_option_show">
                <div style="float:left;width:100%;" id="show_form_field"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">$</label>
                    <input type="text" id="oem_incentive<?php echo $id?>" name="oem_incentive" class="input" value="<?php echo $first_fieldname?>" style="text-align: left;width:96px;"></p>
                </div>
            </div>
        </p></div>
                    <div style="float:left;width:100%"><h4 class="typetitle"><label class="showreportdiv" >Finance Rate (APR)</label></h4>
        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
            <label for="small-label-1" class="label showlabel"></label>
            <div style="clear: both;"></div>
            <div id="vechicle_class_option" class="vechicle_class_option_show">
                <div style="float:left;width:100%;" id="show_form_field"><p class="inline-small-label button-height pclass" style="float: left;"><label class="label" for="small-label-1" style="width:38px;">Min</label>
                    <input type="text" id="equity_apr_from<?php echo $id?>" name="equity_apr_from" class="input" value="<?php echo $first_fieldname?>" style="text-align: left;width:96px;"></p>
                    <p class="inline-small-label button-height pclass" style="float: left;">
                        <label class="label" for="small-label-1" style="margin-left: 11px; width: 35px;">Max</label>
                        <input type="text" id="equity_apr_to<?php echo $id?>" name="equity_apr_to" value="<?php echo $first_secondname?>" class="input"style="text-align: left;width:96px;">
                    </p>
                </div>
            </div>
        </p></div>
                      <div style="clear: both;"></div>
                <div id="vechicle_class_option" style="float:left;margin-top: 10px;">
                    <h4 class="typetitle"><label class="showreportdiv" >Equity Position</label></h4>
                <select name="equity_options" id="equity_options<?php echo $id?>" class="select" style="text-align: left;width:307px;" >
                <option value="lKMh_equity" <?php echo $first_fieldname=='lKMh_equity' ? ' selected ':''; ?>>Low Annual KM – Highest Value</option>
                <option value="lKMa_equity" <?php echo $first_fieldname=='lKMa_equity' ? ' selected ':''; ?>>Low Annual KM – Average Value </option>
                <option value="lKMl_equity" <?php echo $first_fieldname=='lKMl_equity' ? ' selected ':''; ?>>Low Annual KM – Lowest Value</option>
                <option value="aKMh_equity" <?php echo $first_fieldname=='aKMh_equity' ? ' selected ':''; ?>>Average Annual KM – Highest Value</option>
                <option value="aKMa_equity" <?php echo $first_fieldname=='aKMa_equity' ? ' selected ':''; ?>>Average Annual KM – Highest Value</option>
                <option value="aKMl_equity" <?php echo $first_fieldname=='aKMl_equity' ? ' selected ':''; ?>>Average Annual KM – Highest Value</option>
                </select>
            </div>
                </div>
            </p>
            <div style="clear:both;height: 10px"></div>
        </div>
    </div>
<?php
        
    }
    }
    }
    ?>