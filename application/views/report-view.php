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
<script src="<?=base_url()?>js/libs/jquery.tablesorter.min.js"></script>
<script src="<?=base_url()?>js/libs/DataTables/jquery.dataTables.min.js"></script>
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
			View dealers
		</p>
		<table class="table responsive-table" id="sorting-advanced">
			<thead>
				<tr>
					<th scope="col"><input type="checkbox" name="check-all" id="check-all" value="1"></th>
					<th scope="col" width="13%" class="align-center hide-on-mobile">Make</th>
					<th scope="col" width="13%" class="align-center hide-on-mobile-portrait">Model</th>
					<th scope="col" width="15%" class="align-center hide-on-mobile">Year</th>
					<th scope="col" width="20%" class="align-center hide-on-mobile">Trim</th>
                    <th scope="col" width="13%" class="align-center hide-on-mobile">Registration Number</th>
                    <th scope="col" width="20%" class="align-center hide-on-mobile">Condition</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="8">
						6 entries found
					</td>
				</tr>
			</tfoot>
			<tbody>  <?php
            //print_r($user_details);
            if(isset($user_details) && $user_details!=''){
                foreach($user_details as $value){
                ?>          
    				<tr>
    					<th scope="row" class="checkbox-cell"><input type="checkbox" name="checked[]" id="check-1" value="1"></th>
    					<td><?=$value['make']?></td>
    					<td><?=$value['model']?></td>
    					<td><?=$value['year']?></td>
    					<td><?=$value['trim']?></td>
    					<td><?=$value['registration_number']?></td>
                        <td><?=$value['vehicle_condition']?></td>
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
            ?>
		  </tbody>
	   </table>
    </div>
</section>