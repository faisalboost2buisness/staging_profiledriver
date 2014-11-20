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
}</style>
	<!-- Button to open/hide menu -->
	<a href="#" id="open-menu"><span>Menu</span></a>
	<!-- Button to open/hide shortcuts -->
	<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
	<!-- Main content -->
	<section role="main" id="main">
		<hgroup id="main-title" class="thin" style="text-align:left;">
			<h1>Dashboard</h1>
		</hgroup>
		<div class="with-padding">
			<p class="wrapped left-icon icon-info-round">
			User Listing
			</p>
         
			<table class="table responsive-table" id="sorting-advanced">
				<thead>
					<tr>
						<th scope="col" style="width: 5%;"><input type="checkbox" name="check-all" id="check-all" value="1"></th>
						<th scope="col" style="width: 15%;">Name</th>
						<th scope="col" width="13%" class="align-center hide-on-mobile">Date</th>
						<th scope="col" width="13%" class="align-center hide-on-mobile-portrait">Member Type</th>
						<th scope="col" width="15%" class="hide-on-tablet">Phone Number</th>
						<th scope="col" width="25%" class="align-center">Actions</th>
					</tr>
				</thead>
				<tfoot>
                <?php
                if(isset($user_details))
                {
                    $count=count($user_details);
                }
                ?>
					<tr>
						<td colspan="6">
							<?=$count?> entries found
						</td>
					</tr>
				</tfoot>
				<tbody>  <?php
                
                if(isset($menu['logged_in']) && $menu['logged_in']!='')
                {
                  if($menu['logged_in']['usertype']=='admin')
                  {
                    
                //print_r($user_details);
                if(isset($user_details) && $user_details!='')
                {
                foreach($user_details as $value){
                    $datedisplay=strtotime($value['registratation_timestamp']);
                    if($value['usertype']!='admin')
                    {                        
                        
                ?>          
					<tr>
						<th scope="row" class="checkbox-cell"><input type="checkbox" name="checked[]" id="check-1" value="1"></th>
						<td style="text-align: left; padding-left:19px;"><?=ucfirst($value['first_name'])?></td>
						<td><?=date('M d, Y',$datedisplay)?></td>
                        <?php 
                         if($value['usertype']=='account_managers')
                        {
                            $membership='Account Managers';
                        }
                        else if($value['usertype']=='dealership')
                        {
                            $membership='Dealership';
                        }
                         else if($value['usertype']=='auto_brand')
                        {
                            $membership='Auto brand';
                        }
                        else{
                            $membership='';
                        }
                        ?>
						<td><?= $membership;?></td>
						<td><?=$value['company_phonenumber']?></td>
                        <td class="align-right vertical-center">
							<span class="button-group compact">
                            <?php 
                             if($value['usertype']=='account_managers')
                        {
                             ?> 
                              	<a href="<?=base_url()?>settings/<?=$value['registration_id']?>" class="button compact with-tooltip" title="Add Dealers">Add Dealer</a>
                               <?php
                                }
                                ?>                        
								<a href="<?=base_url()?>profile/index/<?=$value['registration_id']?>" class="button compact with-tooltip" title="Edit">Edit</a>
                               <?php
                               if($value['usertype']=='account_managers')
                               {                              
                               ?>
								<a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>" class="button with-tooltip" title="View assigned dealers">Task List</a>
                                <?php
                                }
                                ?>
								<a href="javascript:void(0)" class="button with-tooltip confirm" title="Delete" onclick="deletepoperty(<?=$value['registration_id']?>)">Delete</a>
                                <?php
                }
                                ?>
							</span>
						</td>
					</tr>
                    <?
                    }
                    }
                    else
                    {
                    ?>
                    	<tr>
						<td colspan="8">No data found</td>
					</tr>
                    <?php
                    }
                   }
                   //user type other than admin
                else
                {
                   
                        if(isset($user_details) && $user_details!='')
                {
                foreach($user_details as $value){
                    $datedisplay=strtotime($value['registratation_timestamp']);
                    if($value['usertype']!='admin')
                    {
                        echo $value['usertype'];
                        if($value['usertype']=='account_managers')
                        {
                            $membership='Account Managers';
                        }
                        else if($value['usertype']=='dealership')
                        {
                            $membership='Dealership';
                        }
                         else if($value['usertype']=='auto_brand')
                        {
                            $membership='Auto brand';
                        }
                ?>          
					<tr>
						<th scope="row" class="checkbox-cell"><input type="checkbox" name="checked[]" id="check-1" value="1"></th>
						<td><?=ucfirst($value['first_name'])?></td>
						<td><?=date('M d, Y',$datedisplay)?></td>
						<td><?=$membership?></td>
						<td><?=$value['company_phonenumber']?></td>
                        <td class="align-right vertical-center">
							<span class="button-group compact">
								<a href="<?=base_url()?>profile/index/<?=$value['registration_id']?>" class="button compact icon-gear" title="Edit">Edit</a>
                               <?php
                               if($value['usertype']=='account_managers')
                               {                              
                               ?>
								<a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>" class="button icon-gear with-tooltip" title="View assigned dealers">View</a>
                                <?php
                                }
                                ?>
                                <?php
                                }
                                ?>
							</span>
						</td>
					</tr>
                    <?
                    }
                    }
                    else
                    {
                    ?>
                    	<tr>
						<td colspan="8">No data found</td>
					</tr>
                    <?php
                    }  
                    }
                    }
                    ?>
				</tbody>
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
				{ 'bSortable': false, 'aTargets': [ 0, 5 ] }
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