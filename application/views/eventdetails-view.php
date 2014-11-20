<script type="text/javascript">
function deletepoperty(property_id){
    if(confirm('Are you sure ?')){
        $.post('<?php echo base_url(); ?>dashboard/delete/'+property_id,function(data) {
            if(data=='Done'){
                window.location.reload('<?php echo base_url(); ?>dashboard');
            }
        });
    }
}
function select_member_type(){
    $('#form-login').submit();
}
</script>
<style>
.button{
    font-size: 11px;
}
.list > li, .list-link {
    padding: 0px 0;
}
.topsort{
    float: left;
    margin-top: 131px;
    position: absolute;
    top: 22px;
    width: 893px;
    z-index: 14;
}
#select_member{
    width:120px;
}  
</style>
	<!-- Main content -->
<section role="main" id="main">
	<hgroup id="main-title" class="thin" style="text-align:left;">
       	<h1>Latest Event Details</h1>
	</hgroup>
	<div class="with-padding">
		<p class="wrapped left-icon icon-info-round">
            <button type="button" class="button glossy mid-margin-right" onclick="back_form();" style="float: right;">
    			<span class="button-icon green-gradient"><span class="icon-backward"></span></span>
    			Back
    		</button>
        </p>
        <?php
        $count=count($event_details);
            if($count>0){
                $id='sorting-advanced';
            }else{
                $id='sorting-advanced1';
            }
            ?>
		<table class="table responsive-table" id="<?=$id?>">
			<thead>
				<tr>
					<th scope="col" style="width: 30%;" class="align-center hide-on-mobile">Lead Mining Presets</th>
					<th scope="" class="align-center hide-on-mobile-portrait">Report Type</th>
					<th scope="col" class="lign-center hide-on-mobile-portrait" style="text-align: center;">Lead Count</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10">
						<?=$count?> entries found
					</td>
				</tr>
			</tfoot>
			<tbody>  
            <?php
            if(isset($event_details) || $event_details!=''){
                $i=1;
                foreach($event_details as $value){
                    $get_report_details=$this->settings_model->getgroupname_advanced_option_with_event_id($event_id); 
                    $lead_mining_presets=$this -> settings_model -> get_lead_type_name($value['lead_mining_presets']);
                    //echo $lead_mining_presets;
                    if($lead_mining_presets=='Advanced Options'){
                        foreach($get_report_details as $report_selected){
                            $report_type=$this -> settings_model -> getreporttype($report_selected['report_type']);
                            $customer_leadlist_count_group=$this -> settings_model -> getleadcount($event_id,$report_selected['group_name']);
                            ?>
            				<tr>
            					<th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?php echo $lead_mining_presets?></th>
            					<td><?php echo $report_type?></td>
            					<td class="align-center hide-on-mobile"><?php echo $customer_leadlist_count_group?></td>
            				</tr>
                             <?php
                             $i++;
                        }
                     }else{
                        $lead_mining_presets=$this -> main_model -> get_lead_mining_details($event_id);
                        $group_name=$this -> settings_model -> getleadgrouptitle($lead_mining_presets);
                        $customer_leadlist_check=$this -> main_model -> total_leadcount_display($lead_mining_presets,$user_id,$event_id);
                        $leadlist_id=null;
                        if($lead_mining_presets=='equity_scrape'){
                            $customer_data=$this -> main_model -> customerdatalist_equityscrap($user_id,0,200,$leadlist_id,$event_id);
                        }else if($lead_mining_presets=='model_breakdown'){
                            $customer_data=$this -> main_model -> customerdatalist_model_breakdown($user_id,0,500,'Car',$leadlist_id,$event_id);
                        }else if($lead_mining_presets=='effiecency'){
                            for($i=1;$i<6;$i++){
                                 $customer_data=$this -> main_model -> customerdatalist_fuel_type($user_id,0,50,'Car',$i,$leadlist_id,$event_id);
                            }
                        }else if($lead_mining_presets=='warranty_scrape'){
                            for($i=1;$i<6;$i++){
                                $customer_data=$this -> main_model -> warrant_scarp($event_id,$user_id,0,5000,$i,$leadlist_id='',$event_id);
                            }
                        }
                        if(!empty($customer_data)){
                            $count_equity_scrap=count($customer_data);
                            $check_all='checked';
                        } else{
                            $count_equity_scrap='0';
                        }
                        if($lead_mining_presets=='effiecency'){
                            $k=6;
                        }else{
                            $k=5;
                        }
                        for($i=0;$i<$k;$i++){
                            $report_type='';
                            $customer_leadlist_equity_scrap_count=$this -> settings_model -> getleadcount($event_id,'1');
                            $customer_leadlist_model_breakdown_count=$this -> settings_model -> getleadcount($event_id,'2');
                            $customer_leadlist_fuel_efficiency_count=$this -> settings_model -> getleadcount($event_id,'3');
                            $customer_leadlist_warrant_scarp_count=$this -> settings_model -> getleadcount($event_id,'4');
                            $customer_leadlist_advance_option_count=$this -> settings_model -> getleadcount($event_id,'5');
                            $customer_leadlist_efficiency_option_count=$this -> settings_model -> getleadcount($event_id,'6');
                            $lead_mining_presets_name=$this -> settings_model -> get_lead_type_name($lead_mining_presets);
                            ?>
                            <tr>
            					<th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?php echo $group_name[$i]?></th>
            					<td><?php echo $lead_mining_presets_name?></td>
                                <?php
                                if($i==0){
                                    $count_equity_scrap_det=$customer_leadlist_equity_scrap_count;
                                }elseif($i==1){
                                    $count_equity_scrap_det=$customer_leadlist_model_breakdown_count;
                                }elseif($i==2){
                                    $count_equity_scrap_det=$customer_leadlist_fuel_efficiency_count;
                                }elseif($i==3){
                                    $count_equity_scrap_det=$customer_leadlist_warrant_scarp_count;
                                }elseif($i==4){
                                    $count_equity_scrap_det=$customer_leadlist_advance_option_count;
                                }else{
                                    $count_equity_scrap_det=$customer_leadlist_efficiency_option_count;
                                }
                                ?>
            					<td class="align-center hide-on-mobile"><?php echo $count_equity_scrap_det?></td>
            				</tr>
                            <?php
                            }
                        }
                    }
                 }else{
                 ?>
                    <tr>
        				<td colspan="10">No data found</td>
        			</tr>
                <?php
                }
                ?>
            </tbody>
        <!--details display end -->
        </table>  
    </div>
</section>
	<!-- End sidebar/drop-down menu -->
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
	<script>
		// Call template init (optional, but faster if called manually)
		$.template.init();
		// Table sort - DataTables
		var table = $('#sorting-advanced');
		table.dataTable({
			'aoColumnDefs': [
				{ 'bSortable': false, 'aTargets': [ 0, 2] }
			],
			'sPaginationType': 'full_numbers',
			'sDom': '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
			'fnInitComplete': function( oSettings )
			{
				// Style length select
				table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
				tableStyled = true;
			}
		});
		// Table sort - styled
		$('#sorting-example1').tablesorter({
			headers: {
				0: { sorter: false },
				5: { sorter: false }
			}
		}).on('click', 'tbody td', function(event)
		{
			// Do not process if something else has been clicked
			if (event.target !== this)
			{
				return;
			}
			var tr = $(this).parent(),
				row = tr.next('.row-drop'),
				rows;
			// If click on a special row
			if (tr.hasClass('row-drop'))
			{
				return;
			}
			// If there is already a special row
			if (row.length > 0)
			{
				// Un-style row
				tr.children().removeClass('anthracite-gradient glossy');
				// Remove row
				row.remove();
				return;
			}
			// Remove existing special rows
			rows = tr.siblings('.row-drop');
			if (rows.length > 0)
			{
				// Un-style previous rows
				rows.prev().children().removeClass('anthracite-gradient glossy');
				// Remove rows
				rows.remove();
			}
			// Style row
			tr.children().addClass('anthracite-gradient glossy');
			// Add fake row
			$('<tr class="row-drop">'+
				'<td colspan="'+tr.children().length+'">'+
					'<div class="float-right">'+
						'<button type="submit" class="button glossy mid-margin-right">'+
							'<span class="button-icon"><span class="icon-mail"></span></span>'+
							'Send mail'+
						'</button>'+
						'<button type="submit" class="button glossy">'+
							'<span class="button-icon red-gradient"><span class="icon-cross"></span></span>'+
							'Remove'+
						'</button>'+
					'</div>'+
					'<strong>Name:</strong> John Doe<br>'+
					'<strong>Account:</strong> admin<br>'+
					'<strong>Last connect:</strong> 05-07-2011<br>'+
					'<strong>Email:</strong> john@doe.com'+
				'</td>'+
			'</tr>').insertAfter(tr);
		}).on('sortStart', function()
		{
			var rows = $(this).find('.row-drop');
			if (rows.length > 0)
			{
				// Un-style previous rows
				rows.prev().children().removeClass('anthracite-gradient glossy');
				// Remove rows
				rows.remove();
			}
		});
		// Table sort - simple
	    $('#sorting-example2').tablesorter({
			headers: {
				5: { sorter: false }
			}
		});
	</script>