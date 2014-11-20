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
</script>
<style>
.button{
    font-size: 11px;
}
 .tdbackground
 {
   background-color: white; 
 }
 .dataTables_paginate,#sorting-advanced_length, .dataTables_filter, #sorting-advanced_info
 {
    display: none;
 }
.dataTables_header, .dataTables_footer{
    height: 45px;
}
</style>
	<!-- Button to open/hide menu -->
	<a href="#" id="open-menu"><span>Menu</span></a>
	<!-- Button to open/hide shortcuts -->
	<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
	<!-- Main content -->
	<section role="main" id="main">
		<hgroup id="main-title" class="thin" style="text-align:left;">
			<h1>User Account Details </h1>
		</hgroup>
		<div class="with-padding">
			<p class="wrapped left-icon icon-info-round">
    			Account Details
                <button type="button" class="button glossy mid-margin-right" onclick="back_form();" style="float: right;">
    				<span class="button-icon green-gradient"><span class="icon-backward"></span></span>
    				Back
    			</button>
			</p>
            <table class="table responsive-table" id="sorting-advanced">
                <thead>
                    <tr>
                        <th scope="col" width="14%" style="text-align: center;" class="align-center hide-on-mobile">Name</th>
                        <th scope="col" width="14%">Last Name</th>
                        <th scope="col" width="14%" class="align-center hide-on-mobile">Email</th>
                        <th scope="col" width="14%" class="align-center hide-on-mobile">Address</th>
                        <th scope="col" width="14%" class="align-center hide-on-mobile">Appartment</th>
                        <th scope="col" width="14%" class="align-center hide-on-mobile">City</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile">Province</th>
                    </tr>
                </thead>
                <?php
                //print_r($user_details);
                if(isset($user_details) && $user_details!=''){
                    $i=1;
                    foreach($user_details as $value){
                        if($value['buyer_first_name']!=''){
                            $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']));
                        }else{
                            $buyer_first_name='N/A'; 
                        }
                        if($value['buyer_email']!=''){
                            $buyer_email=$value['buyer_email'];
                        }else{
                            $buyer_email='N/A';
                        }
                        if($value['buyer_city']!=''){
                            $buyer_city=ucfirst(strtolower($value['buyer_city']));
                        }else{
                            $buyer_city='N/A';     
                        }
                        if($value['buyer_postalcode']!=''){
                            $buyer_postalcode 	=$value['buyer_postalcode'];
                        }else{
                            $buyer_postalcode='N/A';   
                        }
                        if($value['new_used']=='U'){
                            $new_used='Used';  
                        }else{
                            $new_used='New'; 
                        }  
                        ?>  
                        <thead>        
        				    <tr>
        						<th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$buyer_first_name?></th>
                                <td style="width:220px"><?=ucfirst($value['buyer_last_name'])?> </td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px"><?=$buyer_email?></td>
        						<td class="checkbox-cell" class="align-center hide-on-mobile" ><label><?=ucfirst($value['buyer_address'])?></label></td>
                                <td class="align-center hide-on-mobile"><?=ucfirst($value['buyer_appartment']);?></td>
        						<td class="align-center hide-on-mobile"><?= ucfirst($value['buyer_city']);?></td>
                                <td class="align-center hide-on-mobile"><?=ucfirst($value['buyer_province']);?></td>
    					   </tr>
                        </thead>
                        <?
                        $i++;
                    }
                  ?>
				<thead>
					<tr>
						<th scope="col" style="text-align: center;" class="align-center hide-on-mobile">Postal Code</th>
						<th scope="col" class="align-center hide-on-mobile">Homephone</th>
						<th scope="col"  class="align-center hide-on-mobile">Businessphone</th>
						<th scope="col" class="align-center hide-on-mobile">Cellphone</th>
						<th scope="col" class="align-center hide-on-mobile">Sold Vehicle Stock</th>
						<th scope="col" class="align-center hide-on-mobile">Sold Vehicle VIN</th>
                        <th scope="col" class="align-center hide-on-mobile">Condition</th>
					</tr>
                </thead>  
                <?php
                foreach($user_details as $value){
                ?> 
                    <thead> 
                        <tr>
                            <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$value['buyer_postalcode']?></th>
                            
                            <td style="width:220px"><?=$value['buyer_homephone']?> </td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px"><?=$value['buyer_businessphone']?></td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><?=$value['buyer_cellphone']?></label></td>
                            <td class="align-center hide-on-mobile"><?=$value['sold_vehicle_stock'];?></td>
                            <td class="align-center hide-on-mobile"><?=$value['sold_vehicle_VIN'];?></td>
                            <td class="align-center hide-on-mobile" style="width: 281px;"><?ucfirst($value['buyer_address'])?>
                            </td>
                        </tr>
                    </thead>
                    <?
                    $i++;
                }
                ?>
                <thead>
					<tr>
						<th scope="col" style="text-align: center;" class="align-center hide-on-mobile">Postal Code</th>
						<th scope="col" class="align-center hide-on-mobile">Homephone</th>
						<th scope="col"  class="align-center hide-on-mobile">Businessphone</th>
						<th scope="col" class="align-center hide-on-mobile">Cellphone</th>
						<th scope="col" class="align-center hide-on-mobile">Sold Vehicle Stock</th>
						<th scope="col" class="align-center hide-on-mobile">Sold Vehicle VIN</th>
                        <th scope="col" class="align-center hide-on-mobile">Condition</th>
					</tr>
                </thead>  
                <?php
                 foreach($user_details as $value){
                  ?> 
                    <thead> 
					   <tr>
                            <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$value['buyer_postalcode']?></th>
                            
                            <td style="width:220px"><?=$value['buyer_homephone']?> </td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px"><?=$value['buyer_businessphone']?></td>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><?=$value['buyer_cellphone']?></label></td>
                            <td class="align-center hide-on-mobile"><?=$value['sold_vehicle_stock'];?></td>
                            <td class="align-center hide-on-mobile"><?=$value['sold_vehicle_VIN'];?></td>
                            <td class="align-center hide-on-mobile" style="width: 281px;"><?ucfirst($value['buyer_address'])?>
                            </td>
					   </tr>
                    </thead>
                    <?
                    $i++;
                }
            }
            ?>
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
				{ 'bSortable': false, 'aTargets': [ 0,0 ] }
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
		}).on('click', 'tbody td', function(event)
		{
			// Do not process if something else has been clicked
			var tr = $(this).parent(),
				//row = tr.next('.row-drop'),
				rows;
			// If click on a special row
			// If there is already a special row
			// Remove existing special rows
			//rows = tr.siblings('.row-drop');
			// Style row
			tr.children().addClass('anthracite-gradient glossy');
			// Add fake row
		})
		// Table sort - simple
	</script>