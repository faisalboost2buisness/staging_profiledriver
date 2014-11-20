<script type="text/javascript">
function deletepoperty(property_id)
{
  if(confirm('Are you sure ?')){
                $.post('<?php echo base_url(); ?>dashboard/delete/'+property_id,function(data) {
                if(data=='Done'){
                window.location.reload('<?php echo base_url(); ?>dashboard');
                }
                });
                }
}
function select_member_type()
{

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
	<!-- Button to open/hide menu -->
	<a href="#" id="open-menu"><span>Menu</span></a>
	<!-- Button to open/hide shortcuts -->
	<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
	<!-- Main content -->
	<section role="main" id="main">
		<hgroup id="main-title" class="thin" style="text-align:left;">
        
         	<h1>Admin Panel</h1>
          
		</hgroup>
          <?php
         if(isset($menu['logged_in']) && $menu['logged_in']!='')
                {
                  $id='sorting-advanced1';
                  $count=0;
                  $title='Accounts';
                  
                 
                
                ?>
		<div class="with-padding">
			<p class="wrapped left-icon icon-info-round">
			<?=$title?>
			</p>
              <?php
               //for selecting sort class and also check details ang get details depend on membership
           
                
                if(isset($user_details) && is_array($user_details))
                {
                   
                    $count=count($user_details);
                    if($count>0)
                    {
                        $id='sorting-advanced';
                    }
                    else
                    {
                        $id='sorting-advanced1';
                    }
                } 
                $title='User Listing';
                
              if(isset($member_type) && $member_type!='')
              {
                  if($member_type=='account_managers')
                        {
                            $membership='Account Manager';
                        }
                        else if($member_type=='dealership')
                        {
                            $membership='Dealership';
                        }
                         else if($member_type=='auto_brand')
                        {
                            $membership='Auto Manufacturer';
                        }elseif($member_type=='sub_admin'){
                            $membership='Sub Admin';
                        }
                        else{
                            $membership='All';
                        }
              }
              ?>
           
			<table class="table responsive-table" id="<?=$id?>">
				<thead>
					<tr>
						<th scope="col" style="width: 3%;" class="align-center hide-on-mobile">SI No</th>
						<th scope="col" style="width: 18%;" class="align-center hide-on-mobile">Company Name</th>
						<th scope="col" width="13%" class="align-center hide-on-mobile">Account User</th>
                        <th scope="col" width="13%" class="align-center hide-on-mobile">Email</th>
						<th scope="" width="13%" class="align-center hide-on-mobile-portrait">
                                              
                         <form method="post" action="<?php echo base_url()?>dashboard/usersortdashboard" id="form-login" style="float: right;">
                         
              <select id="select_member" name="member_type" onchange="select_member_type();" class="select validate">
              <?php
              if(isset($member_type) && $member_type!='')
              {
                  if($member_type=='account_managers')
                        {
                            $membership='Account Manager';
                        }
                        else if($member_type=='dealership')
                        {
                            $membership='Dealership';
                        }
                         else if($member_type=='auto_brand')
                        {
                            $membership='Auto Manufacturer';
                        }elseif($member_type=='sub_admin'){
                           $membership='Sub Admin'; 
                        }
                        else{
                            $membership='All';
                        }
              ?>
              <option value="<?=$member_type?>" selected><?=$membership?></option>
              <?
              }
              ?>
              <option value="All">Member Type</option>
               <option value="All">All</option>
              <option value="dealership">Dealership</option>
              <option value="account_managers">Account Manager</option>
              <option value="auto_brand">Auto Manufacturer</option>
              <option value="sub_admin">Sub Admin </option>
              </select></form>
             
                        </th>
						<th scope="col" width="10%" class="lign-center hide-on-mobile-portrait">Phone Number</th>
						<th scope="col" width="23%" class="lign-center hide-on-mobile-portrait" style="text-align: center;">Actions</th>
					</tr>
				</thead>
				<tfoot>
           
					<tr>
						<td colspan="7">
							<?=$count?> entries found
						</td>
					</tr>
				</tfoot>
				<tbody>  
                <?php
                
                if(isset($user_details) && is_array($user_details))
                {
                    $i=1;
              $account_manger_count=1;
                foreach($user_details as $value){
                  
                    $datedisplay=strtotime($value['registratation_timestamp']);
                    if($value['usertype']!='admin' )
                    {                        
                        
                ?>          
					<tr>
						<th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$i?></th>
                         <?php
                         //function to give sub string for company name
                                $content_display=$value['company_name'];
                               
                        if($value['usertype']=='account_managers')
                        {
                          
                            ?>
                            <td><a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>">Account Manager <?=$account_manger_count?></a><a class="list-link icon-user"  style=" float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                            <?php
                            $account_manger_count++;
                            }else if($value['usertype']=='sub_admin'){
                            ?>
                             <td>Sub Admin<a class="list-link icon-user"  style=" float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                            <?
                        }
                            else{
                                
                        ?>
                        	<td><a href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=$content_display?></a><a class="list-link icon-user"  style=" float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                        <?php
                        }
                         $content_name=ucfirst($value['first_name']);
                          $content_name_length=strlen($content_name);
                                if($content_name_length>20)
                                {
                                
                                $content_string= substr(($content_name),0,20);
                                //$pos=strrpos($content_string," ");
                                
                                $content_name=$content_string.'...';
                                
                                }else
                                {
                                  
                                  $content_name=$content_name;  
                                }
                        if($value['usertype']=='account_managers')
                        {
                           
                        ?>
						<td class="checkbox-cell" class="align-center hide-on-mobile" ><label><a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>"><?=$content_name?></a></label></td>
                        <?php
                        }
                          else if($value['usertype']=='auto_brand')
                        {
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><a href="<?=base_url()?>dealerlisting/auto_brand_dealer/<?=$value['registration_id']?>"><?=$content_name?></a></label></td>
                        <?php   
                        }
                        else
                        {
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><a href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=$content_name?></a></label></td>
                        <?php
                        
                        }
                        ?>
					
                        <?php 
                         if($value['usertype']=='account_managers')
                        {
                            $membership='Account Manager';
                        }
                        else if($value['usertype']=='dealership')
                        {
                            $membership='Dealership';
                        }
                         else if($value['usertype']=='auto_brand')
                        {
                            $membership='Auto Manufacturer';
                        }elseif($value['usertype']=='sub_admin'){
                           $membership='Sub Admin'; 
                        }
                        else{
                            $membership='';
                        }
                        ?>
                        <td class="align-center hide-on-mobile"><?=$value['email_id'];?></td>
						<td class="align-center hide-on-mobile"><?= $membership;?></td>
                        <?php
                        if($value['company_phonenumber']=='' || $value['company_phonenumber']==0){
                          ?> 
                           <td class="align-center hide-on-mobile">N/A</td>
                          <?php 
                        }else{
                            ?>
                         <td class="align-center hide-on-mobile"><?=$value['company_phonenumber']?></td>
                         <?php
                         }
                         ?>
                        <td class="align-center hide-on-mobile">
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

                                }
                                ?>
							</span>
						</td>
					</tr>
                    <?
                  
                    $i++;
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
                  
                  
                    ?>
				</tbody>
			</table>
       <?php
      
            }
            ?>
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
	   
	</script>