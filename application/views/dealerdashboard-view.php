<style>
.four-columns {
    float: left;
    width: 44.083%;
    margin-left: 20px;
    margin-right: 20px;
}
.body
{
    color:#444;
}
.input 
{
    margin-left: 4px;
}
.message-status
{
    float: left;
    margin: -1px 6px 3px -13px;
    text-align: center;
}
.button-height
    {
  line-height:7px;      
    }
.align-center 
{
line-height:17px;    
}
.rowvalues{
    font-weight: normal;
}
.eventstatus{
    cursor: pointer;
}
.eventdevelopment{
 float: left;
 width:86%;
 margin-bottom:20px;
 margin-left:112px;   
}
</style>
<div class="panel-navigation silver-gradient" style="top: 65px;">
        <div id="panel-nav" class="panel-load-target scrollable" style="height:490px;width: 98.5%;">
            <div class="navigable">
                <ul class="unstyled-list open-on-panel-content">
                    <li class="big-menu grey-gradient with-right-arrow">
                    <span><span class="list-count">+</span>Message Center</span>
                        <!--<ul class="message-menu">
                            <li>
                                <span class="message-status">
                                    <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <span class="message-info">
                                    <span class="blue">Mar 5</span>
                                </span>
                                <a href="#" title="Read message">
                                    <strong class="blue">May Starck</strong><br/>
                                    Message subject
                                </a>
                            </li>
                            <li class="message-menu">
                                <span class="message-status">
                                <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <span class="message-info">
                                <span class="blue">Feb 15</span>
                                </span>
                                <a href="#" title="Read message">
                                <strong class="blue">John Doe</strong><br/>
                                <b>Re:</b> replied message
                                </a>
                            </li>
                        </ul>-->
                        <ul class="message-menu">
                            <li>
                            <span class="message-status">
                                    <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <a href="#" title="Read message">
                                    <strong class="blue">Coming Soon</strong><br/>
                                </a>
                            </li>
                            </ul>
                    </li>
                    <!--<li class="big-menu grey-gradient with-right-arrow">
                    <span><span class="list-count">+</span>History</span>
                        <ul class="message-menu">
                            <li class="message-menu">
                                <span class="message-status">
                                <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <span class="message-info">
                                <span class="blue">Feb 5</span>
                                </span>
                                <a href="#" title="Read message">
                                <strong class="blue">May Starck</strong><br>
                                Another subject
                                </a>
                            </li>
                            <li class="message-menu">
                                <span class="message-status">
                                <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <span class="message-info">
                                <span class="blue">Jan 28</span>
                                </span>
                                <a href="#" title="Read message">
                                <strong class="blue">May Starck</strong><br>
                                Old subject
                                </a>
                            </li>
                        </ul>
                    </li>-->
                    <li class="title-menu" style="height: 33px; padding-top: 18px;"><h4>Support</h4></li>
                    <li class="message-menu" style="padding: 26px 0 4px 68px;text-align: center;">
                        <span class="message-status">
                        <a href="#" class="starred" title="Starred">Starred</a>
                        </span>
                        <a href="<?php echo base_url()?>/userguide/userguide.pdf" title="Read message" style="text-align: left;" target="_blank">
                        <strong>Usage Guide</strong>
                        </a>
                    </li>
                    <li class="message-menu" style="padding: 26px 0 4px 68px;text-align: center;">
                        <span class="message-status">
                        <a href="#" class="starred" title="Starred" > Starred</a>
                        </span>                        
                        <a href="mailto:jordan@onetoonemailing.com" title="Read message" style="text-align: left;">
                        <strong>Help</strong>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    $height='';
    $event_table_details_count_get=$this -> settings_model -> get_dealer_events_details($dealerdashboard);
    if(isset($event_table_details_count_get) && $event_table_details_count_get!=''){
     $count_events=count($event_table_details_count_get); 
     if($count_events>5){
        $height='height:459px;';
     } 
     elseif($count_events==3){
        $height='height:296px;';
     }
     elseif($count_events==4){
        $height='height:396px;';
     }
      elseif($count_events==2){
        $height='height:124px;';
     }
     else{
       $height=''; 
     }
    }
    ?>
    <div id="panel-content" class="panel-load-target scrollable with-padding dealerdahboardmainbox">
        <h2 class="thin mid-margin-bottom" style="color:gray;margin-left: 20px;">Welcome to ProfitDriver</h2>
        	
      <div style="height: 18px;"></div>
      <div style="width: 100%;float: left;">
        <div class="new-row-mobile four-columns six-columns-tablet twelve-columns-mobile">
            <div class="block large-margin-bottom">
                <div class="block-title">
                    <h3>Database Mining Options</h3>
                </div>
                <ul class="events">
                    <?php
                    $get_latestevents_details=$this -> settings_model -> get_latest_eventdetails_reports($dealerdashboard);
                    //print_r($get_latestevents_details);
                    if(isset($get_latestevents_details) && $get_latestevents_details!=''){
                        foreach($get_latestevents_details as $event_id_get){
                            $event_id=$event_id_get['event_id'];
                            $user_id=$event_id_get['user_id'];
                            $event_date=$event_id_get['event_start_date'];
                            $event_startdate=date('d M, Y',$event_date);
                            ?>
<!--                            <li>
                                <span class="event-date orange"><?php echo $event_startdate?></span>
                                <a href="<?=base_url()?>dashboard/eventdetails_view/<?php echo $event_id?>/<?php echo $user_id?>" class="event-description">
                                <h4>Latest EPS Event Results</h4>
                                <p>Report description text</p>
                                </a>
                            </li>-->
                        <?php
                        }
                    }
                    else{
                        $event_startdate=date('d M, Y',time());
                    ?>

<!--                     <li>
                                <span class="event-date orange"><?php echo $event_startdate?></span>
                                <a href="javascript:void(0);" class="event-description">
                                <h4>Latest EPS Event Results</h4>
                                <p>No Results Found</p>
                                </a>
                            </li>-->
                    <?php
                    }
                    ?>

                    <?php if(isset($date_created)){ ?>
                        <li>
                            <span class="event-date orange"><?php echo  date("j- M-Y",$date_created); ?></span>
                            <a href="<?php echo base_url()?>customerdata/<?php echo $dealerdashboard; ?>" class="event-description">
                                <h4>Full DB View</h4>
                                <p>Excel like tables with sorting, filtering, & search</p>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <span class="event-date"></span>
                        <a href="<?php echo base_url()?>campaign/<?=$dealerdashboard?>" class="event-description">
                            <span class="event-description">
                                <h4>Private Sales Event Builder</h4>
                                <p>Find the perfect invites with targeted lead mining</p>
                            </span>
                        </a>
                    </li>
                    <?php
                    if(isset($logged_in_user_type) && ($logged_in_user_type=='dealership' || $logged_in_user_type=='admin')){
                    ?>
                    <li>
                        <span class="event-date"></span>
                        <a href="<?php echo base_url()?>minedata/<?=$dealerdashboard?>" class="event-description">
                            <span class="event-description">
                                <h4>5 Minute Data Mine</h4>
                                <p>Create up to 5 target lists in 5 Minutes</p>
                            </span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="new-row-mobile four-columns six-columns-tablet twelve-columns-mobile">
            <div class="block large-margin-bottom">
            	<div class="block-title">
            		<h3>Database Status</h3>
            	</div>
            	<ul class="events">
            		<li>
                            <span class="event-date"><?php echo  date("j- M-Y",$date_created); ?></span>
                            <span class="event-description">
                                <h4>Most Recent Sales Database Pull</h4>
                                <p>Scheduled to be pulled every 2 weeks</p>
                            </span>
            		</li>
            		<li>
                            <span class="event-date"><?php echo  date("j- M-Y",$date_created); ?></span>
                            <span class="event-description">
                                <h4>Blackbook Trade-In Value Pull Date</h4>
                                <p>Scheduled to be updated every 2 weeks</p>
                            </span>
            		</li>
            		<li>
                            <span class="event-date">1 Jan, 2015</span>
                            <span class="event-description">
                                <h4>COMING SOON: Service Data Pulls</h4>
                                <p>Look for Service Customer pulls in the New Year</p>
                            </span>
            		</li>
            	</ul>
            </div>
        </div>
    </div>
      <div style="clear: both;height: 5px"></div>
        <h3 class="thin mid-margin-bottom" style="color:gray;margin-left: 20px;margin-top: 0px">Report Review & Downloads</h3>
      <div class="button-height wrapped align-right" style="width: 91%;margin-left: 20px;">
             <div class="with-padding" style="margin-top: 9px !important;overflow-y:auto;<?php echo $height?>">
                 <div class="eventdevelopment" style="display: none;">
                    <?php
                    if($logged_in_user_type=='admin' ){
                    	$style='margin-left:19px;';  
                    }else if ($logged_in_user_type=='dealership'){
                        $style='margin-left:19x;'; 
    				}else{
                     $style='margin-left:86px;'; 
                    }
                    ?>
<!--                     <div class="columns" style="<?php echo $style?>">
                         <form method="post" action="<?php echo base_url()?>campaign/<?=$dealerdashboard?>" title="Registration"  id="form-login" enctype="multipart/form-data">
                            <button type="submit" class="button glossy mid-margin-right" onclick="submit_fieldform()">
                                <span class="button-icon"><span class="icon-tick"></span></span>
                                Build Your Custom Sales Event
                            </button>
                        </form>
                    </div>-->
                   <?php
                    if(isset($logged_in_user_type) && ($logged_in_user_type=='dealership' || $logged_in_user_type=='admin')){
                    ?>
<!--                    <div class="columns">
                        <form method="post" action="<?php echo base_url()?>minedata/<?=$dealerdashboard?>" title="Registration"  id="form-login" enctype="multipart/form-data">
                            <button type="submit" class="button glossy mid-margin-right" >
                                <span class="button-icon"><span class="icon-tick"></span></span>
                                Mine Data
                            </button>
                        </form>
                    </div>-->
                    <?php  
                    }
                    ?>
                </div>
                <table class="table responsive-table">
                    <thead style="line-height: 1;">
                        <tr>
                            <th scope="col"  class="align-center hide-on-mobile">Start Date</th>
                            <th scope="col"  class="align-center hide-on-mobile">End Date</th>
                            <th scope="col"  class="align-center hide-on-mobile">Advertising Options</th>
                            <th scope="col"  class="align-center hide-on-mobile">Lead Type</th>
                            <th scope=""  class="align-center hide-on-mobile-portrait">Number of Report Group
                            </th>
                            <th scope="col"  class="lign-center hide-on-mobile-portrait" style="text-align: center;">Lead Count</th>
                            <th scope="col"  class="lign-center hide-on-mobile-portrait" style="text-align: center;">Actions</th>
                            <th scope="col"  class="align-center hide-on-mobile">Status</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <?php
                    $advertise_option='';
                    $lead_mining_presets='';
                    $customer_leadcount=0;
                    $report_type='';
                    $event_table_details=$this -> settings_model -> get_dealer_events_details($dealerdashboard);
                    if(isset($event_table_details) && $event_table_details!=''){
                        foreach($event_table_details as $values_events){
                         $advertise_option=$this -> settings_model -> get_advertising_option($values_events['advertising_option']);
                            if(isset($advertise_option)){
                                $advertise_option=$advertise_option;
                            }else{
                                $advertise_option='';
                            }
                        $event_details=$this -> settings_model -> get_campign_details($values_events['event_id'],$dealerdashboard);
                        if(isset($event_details) && $event_details!=''){
                            foreach($event_details as $values){
                                $lead_mining_presets=$this -> settings_model -> get_lead_type_name($values['lead_mining_presets']);
                                $report_type=$this -> settings_model -> getreporttype($values['report_type']);
                                if(isset($lead_mining_presets)){
                                    $lead_mining_presets=$lead_mining_presets;
                                }else{
                                    $lead_mining_presets='N/A';
                                }
                                if(isset($report_type)){
                                    $report_type=$report_type;
                                }else{
                                    $report_type='N/A';
                                }
                                $customer_leadcount=$this -> settings_model -> get_customer_leadcount($values_events['event_id']);
                                if($values_events['creation_status']=='complete'){
                                    $image_name='completestar.png';
                                    $alt='Complete Event';
                                }else{
                                    $image_name='incompletestar.png';
                                    $alt='Incomplete Event';
                                }
                                $group=0;
                                $sql=("Select *  from  select_customer_leadlist where event_id=$values_events[event_id]");
                                $query=$this->db->query($sql);
                                $returnvalue= $query->result_array();
                                foreach($returnvalue as $values_get){
                                    if($values_get['equity_scrap']!='0'){
                                        $group=$group+1;
                                    }
                                    if($values_get['model_break_down']!='0'){
                                        $group=$group+1;
                                    }
                                    if($values_get['fuel_effciency']!='0'){
                                        $group=$group+1;
                                    }          
                                    if($values_get['wrranty_scrap']!='0'){
                                        $group=$group+1;
                                    }
                                    if($values_get['custom_campain']!='0'){
                                        $group=$group+1;
                                    } 
                                    if($values_get['fuel_efficiency_report6']!='0'){
                                        $group=$group+1;
                                    }
                                }
                                
                                ?>
                                <tr>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo date('m/d/Y',$values_events['event_start_date'])?></th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo date('m/d/Y',$values_events['event_end_date'])?></th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $advertise_option?></th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $lead_mining_presets?></th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $group?></th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $customer_leadcount?></th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;">
                                        <a href="<?php echo base_url()?>campaign/editcampign/<?=$values_events['event_id']?>/<?php echo $dealerdashboard?>"  title="Edit Event">Edit</a> /   
                                        <a href="javascript:void(0);" onclick="deletepoperty(<?=$values_events['event_id']?>,<?=$dealerdashboard?>)" title="Delete Event">Delete</a> 
                                            <?php
                                            if($customer_leadcount!=0){
                                            ?>
                                                / <a href="<?php echo base_url()?>campaign/viewlist/<?php echo $values_events['event_id']?>/<?php echo $dealerdashboard?>"  title="View List">View List</a> 
                                            <?php
                                            }
                                            if($values_events['creation_status']=='complete'){
                                            ?>
                                                / <a href="<?php echo base_url()?>downloadpdf/create_pdf/<?php echo $values_events['event_id']?>/<?php echo $dealerdashboard?>/1"  title="Download Report">Download Report</a> 
                                            <?php
                                            }
                                            ?>
                                    </th>
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><span class="eventstatus" alt="<?php echo $alt?>" title="<?php echo $alt?>"><img  src="<?php echo base_url()?>images/<?php echo $image_name?>" style="width: 19px;height: 19px;"/></span></th>
                                </tr>
                                <?php
                                }
                        }else{
                            $lead_mining_presets='N/A';
                            $report_type='N/A';
                            $customer_leadcount=$this -> settings_model -> get_customer_leadcount($values_events['event_id']);
                            if($values_events['creation_status']=='complete'){
                                $image_name='completestar.png';
                                $alt='Complete Event';
                            }else{
                                $image_name='incompletestar.png';
                                $alt='Incomplete Event';
                            }
                            ?>
                            <tr>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo date('m/d/Y',$values_events['event_start_date'])?></th>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo date('m/d/Y',$values_events['event_end_date'])?></th>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $advertise_option?></th>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $lead_mining_presets?></th>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $report_type?></th>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;"><?php echo $customer_leadcount?></th>
                                <th scope="row" class="align-center rowvalues" style="text-align: center;">
                                    <a href="<?php echo base_url()?>campaign/editcampign/<?=$values_events['event_id']?>/<?php echo $dealerdashboard?>"  title="Edit Event">Edit</a> /   
                                    <a href="javascript:void(0);" onclick="deletepoperty(<?=$values_events['event_id']?>,<?=$dealerdashboard?>)" title="Delete Event">Delete</a> 
                                    <?php
                                    if($customer_leadcount!=0)
                                    {
                                    ?>
                                    / <a href="<?php echo base_url()?>campaign/viewlist/<?php echo $values_events['event_id']?>/<?php echo $dealerdashboard?>"  title="View List">View List</a> 
                                    <?php
                                    }
                                    if($values_events['creation_status']=='complete' && $values_events['report_name']!=''){
                                    ?>
                                    / <a href="<?php echo base_url()?>downloadpdf/create_pdf/<?php echo $values_events['event_id']?>/<?php echo $dealerdashboard?>/1" target="_blank"  title="Download Report">Download Report</a> 
                                    <?php
                                    }
                                    ?> 
                                    <th scope="row" class="align-center rowvalues" style="text-align: center;"><span class="eventstatus" alt="<?php echo $alt?>" title="<?php echo $alt?>"><img  src="<?php echo base_url()?>images/<?php echo $image_name?>" style="width: 19px;height: 19px;"/></span></th>
                                </th>
                            </tr>
                            <?php    
                            }
                        }
                    }
                    else
                    {
                    ?>
                        <th scope="row" class="align-center hide-on-mobile" style="text-align: center;" colspan="7">No Results Found</th>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
		</div>
      <div style="height: 50px;clear: both"></div>
</div>
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
    <script>
var jQuery17 = jQuery.noConflict();
</script>
<script>
function deletepoperty(campign_id,dealerdashboard){
    if(confirm('Are you sure ?')){
        jQuery.post('<?php echo base_url(); ?>dashboard/deletecampign/'+campign_id,function(data) {
            if(data=='Done'){
                window.location.href='<?php echo base_url(); ?>dashboard/dealerdashboard/'+dealerdashboard;
            }
        });
    }
}
</script>