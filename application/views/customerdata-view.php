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
function membership_sort_hide()
{
  
    $('.sorting_asc').hide();
    $('.sorting_desc').hide();
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
        
         	<h1>View Customer Data</h1>
          
		</hgroup>
          <?php
          $count='0';
         if(isset($menu['logged_in']) && $menu['logged_in']!='')
                {
                    
                    $count=count($user_details);
            ?>
            <div class="with-padding table-responsive" id="zeTable">
		<!--<div class="">-->
			<p class="wrapped left-icon icon-info-round">
			Customer Data
			</p>
              <?php
               //for selecting sort class and also check details ang get details depend on membership
           
              ?>
                        <style>
                            
                        </style>
                        <div style="width:100%;overflow-x: scroll;">
                            
                            <div id="advancedSearchForm_wrapper" class="advancedSearchForm_wrapper" style="display: none; width: 61%; float: right;overflow-y: scroll;<?php if(isset($_POST['columns'])){ if(count($_POST['columns'] > 2)){ echo 'height:360px;'; } }?>"> 			    			    		    			
                                <form method="post" action="<?php echo base_url(); ?>customerdata/<?php echo $dealerdashboard; ?>" id="advancedSearchForm" role="form" class="clearfix">
                                    <!--<input type="hidden" value="<?php echo $user_id; ?>" name="user_id">-->
                                    <div class="clearfix">
                                        <h5 style="color: black;" class="pull-left"><span class="fui-search"></span> Advanced search panel</h5>
                                        <a id="hideAdvancedSearch" class="pull-right small" href="#"><span class="fui-cross"></span> Hide</a>
                                    </div>
                                    <div style="clear: both"></div>
                                    <hr>
                                    <div id="advancedSearch_accordion" class="panel-group margin-bottom-15">   
                                        <details class="details margin-bottom" open style="display: none;" id="newSearchItem_templ">
                                            <summary>Search Item 1</summary>
                                                <div class="with-padding">
                                                    <div class="form-group clearfix margin-bottom-0">
                                                        <div class="col-sm-6">
                                                            <div class="mbl margin-bottom-0">
                                                                <div class="styled-select">
                                                                    <select placeholder="Choose column" name="columns[]" style="display: block;">
                                                                        <option value="">Choose column</option>
                                                                        <option value="buyer_first_name">First Name</option>
                                                                        <option value="buyer_last_name">Last Name</option>
                                                                        <option value="buyer_address">Address</option>
                                                                        <option value="buyer_appartment">Apart. #</option>
                                                                        <option value="buyer_city">City</option>
                                                                        <option value="buyer_province">Province</option>
                                                                        <option value="buyer_postalcode">Postal Code</option>
                                                                        <option value="buyer_homephone">Main Phone</option>
                                                                        <option value="buyer_cellphone">Cell Phone</option>
                                                                        <option value="first_payment_date">Purchase Date</option>
                                                                        <option value="sold_vehicle_year">Year</option>
                                                                        <option value="sold_vehicle_make">Make</option>
                                                                        <option value="sold_vehicle_model">Model</option>
                                                                        <option value="bodydescription">Trim/Style</option>
                                                                        <option value="sold_vehicle_VIN">VIN</option>
                                                                        <option value="vehiclecategory">Vehicle Class</option>
                                                                        <option value="enginefueltype">Fuel Type</option>
                                                                        <option value="littercombined">Fuel Economy (Combined)</option>
                                                                        <option value="drivenwheels">Drive Type</option>
                                                                        <option value="transmissiontype">Tranny Type</option>
                                                                        <option value="monthly_payment">Payment</option>
                                                                        <option value="contract_term">Term Length</option>
                                                                        <option value="total_finance_amount">Amount Financed</option>
                                                                        <option value="apr">APR</option>
                                                                        <option value="tradeinvalue">Trade In Value</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mbl margin-bottom-0">
                                                                <div class="styled-select">
                                                                    <select placeholder="Choose operator" name="operators[]">
                                                                        <option value="">Choose operator</option>
                                                                        <option value="=">Equals</option>
                                                                        <option value="!=">Does not equal</option>
                                                                        <option value="like">Contains</option>
                                                                        <option value="nlike">Does not contain</option>
                                                                        <option value="<">Less then (&lt;)</option>
                                                                        <option value=">">Greater then (&gt;)</option>
                                                                        <option value="<=">Equals or less then (&lt;=)</option>
                                                                        <option value=">=">Equals or greater (&gt;=)</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                    <div class="form-group clearfix margin-bottom-15">
                                                        <div class="col-sm-12" style="margin-left: 11px; margin-top: 11px;">
                                                            <input style="width: 389px;" type="text" name="values[]" placeholder="Value" id="inputEmail3" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group clearfix margin-bottom-0">
                                                        <div class="col-sm-12">
                                                                <a class="pull-right text-danger small removeAsItem" href="#"><span class="fui-cross-inverted"></span> Remove item</a>
                                                        </div>
                                                    </div>
                                            </div>
                                        </details><!-- /.panel -->
                                        <?php
                                        if(isset($_POST['columns'])){
                                            for($i=1; $i < count($_POST['columns']); $i++){
                                                ?>
                                                <details class="details margin-bottom" open>
                                                    <summary>Search Item <?php echo $i; ?></summary>
                                                        <div class="with-padding">
                                                            <div class="form-group clearfix margin-bottom-0">
                                                                <div class="col-sm-6">
                                                                    <div class="mbl margin-bottom-0">
                                                                        <div class="styled-select">
                                                                            <select class="" placeholder="Choose column" class="select-block selector" name="columns[]" style="display: block;">
                                                                                <option value="">Choose column</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_first_name'){ echo 'selected'; } ?> value="buyer_first_name">First Name</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_last_name'){ echo 'selected'; } ?> value="buyer_last_name">Last Name</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_address'){ echo 'selected'; } ?> value="buyer_address">Address</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_appartment'){ echo 'selected'; } ?> value="buyer_appartment">Apart. #</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_city'){ echo 'selected'; } ?> value="buyer_city">City</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_province'){ echo 'selected'; } ?> value="buyer_province">Province</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_postalcode'){ echo 'selected'; } ?> value="buyer_postalcode">Postal Code</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_homephone'){ echo 'selected'; } ?> value="buyer_homephone">Main Phone</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'buyer_cellphone'){ echo 'selected'; } ?> value="buyer_cellphone">Cell Phone</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'first_payment_date'){ echo 'selected'; } ?> value="first_payment_date">Purchase Date</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'sold_vehicle_year'){ echo 'selected'; } ?> value="sold_vehicle_year">Year</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'sold_vehicle_make'){ echo 'selected'; } ?> value="sold_vehicle_make">Make</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'sold_vehicle_model'){ echo 'selected'; } ?> value="sold_vehicle_model">Model</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'bodydescription'){ echo 'selected'; } ?> value="bodydescription">Trim/Style</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'sold_vehicle_VIN'){ echo 'selected'; } ?> value="sold_vehicle_VIN">VIN</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'vehiclecategory'){ echo 'selected'; } ?> value="vehiclecategory">Vehicle Class</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'enginefueltype'){ echo 'selected'; } ?> value="enginefueltype">Fuel Type</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'littercombined'){ echo 'selected'; } ?> value="littercombined">Fuel Economy (Combined)</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'drivenwheels'){ echo 'selected'; } ?> value="drivenwheels">Drive Type</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'transmissiontype'){ echo 'selected'; } ?> value="transmissiontype">Tranny Type</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'monthly_payment'){ echo 'selected'; } ?> value="monthly_payment">Payment</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'contract_term'){ echo 'selected'; } ?> value="contract_term">Term Length</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'total_finance_amount'){ echo 'selected'; } ?> value="total_finance_amount">Amount Financed</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'apr'){ echo 'selected'; } ?> value="apr">APR</option>
                                                                                <option <?php if($_POST['columns'][$i] == 'tradeinvalue'){ echo 'selected'; } ?> value="tradeinvalue">Trade In Value</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <style>

                                                                </style>
                                                                <div class="col-sm-6">
                                                                    <div class="mbl margin-bottom-0">
                                                                        <div class="styled-select">
                                                                            <select placeholder="Choose operator" name="operators[]">
                                                                                <option value="">Choose operator</option>
                                                                                <option <?php if($_POST['operators'][$i] == '='){ echo 'selected'; } ?> value="=">Equals</option>
                                                                                <option <?php if($_POST['operators'][$i] == '!='){ echo 'selected'; } ?> value="!=">Does not equal</option>
                                                                                <option <?php if($_POST['operators'][$i] == 'like'){ echo 'selected'; } ?> value="like">Contains</option>
                                                                                <option <?php if($_POST['operators'][$i] == 'nlike'){ echo 'selected'; } ?> value="nlike">Does not contain</option>
                                                                                <option <?php if($_POST['operators'][$i] == '<'){ echo 'selected'; } ?> value="<">Less then (&lt;)</option>
                                                                                <option <?php if($_POST['operators'][$i] == '>'){ echo 'selected'; } ?> value=">">Greater then (&gt;)</option>
                                                                                <option <?php if($_POST['operators'][$i] == '<='){ echo 'selected'; } ?> value="<=">Equals or less then (&lt;=)</option>
                                                                                <option <?php if($_POST['operators'][$i] == '>='){ echo 'selected'; } ?> value=">=">Equals or greater (&gt;=)</option>
                                                                            </select> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="clear: both"></div>
                                                            <div class="form-group clearfix margin-bottom-15">
                                                                <div class="col-sm-12" style="margin-left: 11px; margin-top: 11px;">
                                                                    <input style="width: 389px;" type="text" name="values[]" placeholder="Value" value="<?php echo $_POST['values'][$i]; ?>" id="inputEmail3" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group clearfix margin-bottom-0">
                                                                <div class="col-sm-12">
                                                                        <a class="pull-right text-danger small removeAsItem" href="#"><span class="fui-cross-inverted"></span> Remove item</a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </details>
                                            <?php
                                            }
                                        }else{
                                        ?>
                                            <details class="details margin-bottom" open>
                                                <summary>Search Item 1</summary>
                                                    <div class="with-padding">
                                                        <div class="form-group clearfix margin-bottom-0">
                                                            <div class="col-sm-6">
                                                                <div class="mbl margin-bottom-0">
                                                                    <div class="styled-select">
                                                                        <select class="" placeholder="Choose column" class="select-block selector" name="columns[]" style="display: block;">
                                                                            <option value="">Choose column</option>
                                                                            <option value="buyer_first_name">First Name</option>
                                                                            <option value="buyer_last_name">Last Name</option>
                                                                            <option value="buyer_address">Address</option>
                                                                            <option value="buyer_appartment">Apart. #</option>
                                                                            <option value="buyer_city">City</option>
                                                                            <option value="buyer_province">Province</option>
                                                                            <option value="buyer_postalcode">Postal Code</option>
                                                                            <option value="buyer_homephone">Main Phone</option>
                                                                            <option value="buyer_cellphone">Cell Phone</option>
                                                                            <option value="first_payment_date">Purchase Date</option>
                                                                            <option value="sold_vehicle_year">Year</option>
                                                                            <option value="sold_vehicle_make">Make</option>
                                                                            <option value="sold_vehicle_model">Model</option>
                                                                            <option value="bodydescription">Trim/Style</option>
                                                                            <option value="sold_vehicle_VIN">VIN</option>
                                                                            <option value="vehiclecategory">Vehicle Class</option>
                                                                            <option value="enginefueltype">Fuel Type</option>
                                                                            <option value="littercombined">Fuel Economy (Combined)</option>
                                                                            <option value="drivenwheels">Drive Type</option>
                                                                            <option value="transmissiontype">Tranny Type</option>
                                                                            <option value="monthly_payment">Payment</option>
                                                                            <option value="contract_term">Term Length</option>
                                                                            <option value="total_finance_amount">Amount Financed</option>
                                                                            <option value="apr">APR</option>
                                                                            <option value="tradeinvalue">Trade In Value</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <style>

                                                            </style>
                                                            <div class="col-sm-6">
                                                                <div class="mbl margin-bottom-0">
                                                                    <div class="styled-select">
                                                                        <select placeholder="Choose operator" name="operators[]">
                                                                            <option value="">Choose operator</option>
                                                                            <option value="=">Equals</option>
                                                                            <option value="!=">Does not equal</option>
                                                                            <option value="like">Contains</option>
                                                                            <option value="nlike">Does not contain</option>
                                                                            <option value="<">Less then (&lt;)</option>
                                                                            <option value=">">Greater then (&gt;)</option>
                                                                            <option value="<=">Equals or less then (&lt;=)</option>
                                                                            <option value=">=">Equals or greater (&gt;=)</option>
                                                                        </select> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both"></div>
                                                        <div class="form-group clearfix margin-bottom-15">
                                                            <div class="col-sm-12" style="margin-left: 11px; margin-top: 11px;">
                                                                <input style="width: 389px;" type="text" name="values[]" placeholder="Value" id="inputEmail3" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group clearfix margin-bottom-0">
                                                            <div class="col-sm-12">
                                                                    <a class="pull-right text-danger small removeAsItem" href="#"><span class="fui-cross-inverted"></span> Remove item</a>
                                                            </div>
                                                        </div>
                                                </div>
                                            </details><!-- /.panel -->
                                        <?php } ?>
                                    </div>
                                    <div class="form-group clearfix">
                                    <button class="form_button sprited button glossy mid-margin-right" type="submit"><span class="button-icon"><span class="icon-tick"></span></span> Apply search items</button>
                                    <a href ="<?php echo base_url()?>customerdata/<?php echo $dealerdashboard;?>" class="closemessage form_button sprited button glossy"><span class="button-icon red-gradient"><span class="icon-cross-round"></span></span> Clear search</a>
                                    <a id="addSearchItem" class="addColumnLink pull-right" href=""><span class="fui-plus"></span> Add search item</a>
                                    </div>
                                </form>
                            </div>
                            <div style="clear: both"></div>
                            <?php
                
                if(isset($user_details) && is_array($user_details))
                { ?>
                            <div class="input-group-btn">
                                <button id="toggleAdvancedSearch" type="button" class="btn btn-default"><span class="fui-gear"></span> More options</button>
                            </div>
                <?php }else{
                    ?>
                        <a class="button icon-undo" href ="<?php echo base_url()?>customerdata/<?php echo $dealerdashboard;?>">Refresh</a>
                            <div style="clear: both"></div>
                    <?php 
                } ?>
                            <table class="table responsive-table table-bordered table-striped table-hover" id="sorting-advanced">                            
				<thead>
					<tr>
						<!--<th scope="col" style="width: 3%;" class="align-center hide-on-mobile">SI No</th>-->
						<th scope="col" class="align-center hide-on-mobile"> Name</th>
						<th scope="col" class="align-center hide-on-mobile"> Address</th>
						<th scope="col" class="align-center hide-on-mobile"> Apartment. #</th>
                                                <th scope="col" class="align-center hide-on-mobile"> City</th>
                                                <th scope="col" class="align-center hide-on-mobile"> Province</th>
						<th scope="col" class="align-center hide-on-mobile-portrait">Postal Code</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Main Phone</th>   
						<th scope="col" class="align-center hide-on-mobile-portrait">Cell Phone</th>   
						<th scope="col" class="align-center hide-on-mobile-portrait">Purchase Date</th> 
						<th scope="col" class="align-center hide-on-mobile-portrait">Year</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Make</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Model</th> 
						<th scope="col" class="align-center hide-on-mobile-portrait">Trim/Style</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Vin</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Vehicle Class</th> 
						<th scope="col" class="align-center hide-on-mobile-portrait">Engine Fuel Type</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Fuel Economy (Combined)</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Drive Type</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Tranny Type</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Payment</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Term Length</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Amount Financed</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">APR</th>  
						<th scope="col" class="align-center hide-on-mobile-portrait">Trade In Value</th>  
<!--						<th scope="col" class="align-center hide-on-mobile"> Email</th>                                   
						<th scope="col" class="lign-center hide-on-mobile-portrait">Condition</th>
						<th scope="col" class="lign-center hide-on-mobile-portrait">Action</th>
-->
					</tr>
				</thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="24">Total Records: <?php echo $this->session->userdata('iTotal');?></td>
                                    </tr>
                                    test
                                </tfoot>
				<tbody>  
                <?php
                
                if(isset($user_details) && is_array($user_details))
                {
                    
                    $i=1;
              $account_manger_count=1;
              $sub_admin_det=1;
              foreach($user_details as $value){  
                    
              ?>          
					<!--<tr>-->
						<!--<th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$i?></th>-->
                         <?php
                       
                          
                            ?>
<!--                                <td class="align-center hide-on-mobile"><?=$value['name']?> </td>
                                <td class="align-center hide-on-mobile"><?=$value['buyer_address']?> </td>
                                <td class="align-center hide-on-mobile"><?php echo $value['buyer_appartment']; ?> </td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><?=$value['buyer_city']?></label></td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><?=$value['buyer_province']; ?></label></td>  
                                <td class="align-center hide-on-mobile"><?=$value['buyer_postalcode'];?></td>                
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?=$value['buyer_homephone'];?></td>    
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?=$value['buyer_cellphone'];?></td>    
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['first_payment_date']; ?></td>
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['sold_vehicle_year'];?></td>     
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['sold_vehicle_make'];?></td>     
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['sold_vehicle_model'];?></td>    
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['bodydescription'];?></td>       
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['sold_vehicle_VIN'];?></td>            
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['vehiclecategory'];?></td>             
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['enginefueltype'];?></td>                 
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['littercombined'];?></td>                 
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['drivenwheels'];?></td>                   
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['transmissiontype'];?></td>               
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['monthly_payment'];?></td>                
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['contract_term'];?></td>                  
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['total_finance_amount'];?></td>           
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['apr'];?></td>                
                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?= $value['tradeinvalue'];?></td>       -->
<!--                                <td class="checkbox-cell" class="align-center hide-on-mobile"><?=$buyer_email?></td>
                                <td class="align-center hide-on-mobile"><?= $new_used;?></td>
                                <td class="align-center hide-on-mobile">
                                    <span class="button-group compact">
                                        <a href="<?=base_url()?>customerdata/viewcustometdata/<?=$value['id']?>" class="button compact with-tooltip" title="View Customer Details">View Details</a>
                                    </span>
                                </td>-->
                        <!--</tr>-->
<?php
                  
                    $i++;
                    }
                    
                    }
                    else
                    {
                    ?>
<!--                    	<tr>
						<td colspan="8">No data found</td>
					</tr>-->
                    <?php
                    }
                  
                  
                    ?>
				</tbody>
			</table>
                        </div>
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
	<script src="<?=base_url()?>js/libs/jquery.details.min.js"></script>
	<!-- Plugins -->
	<script src="<?=base_url()?>js/libs/jquery.tablesorter.min.js"></script>
	<script src="<?=base_url()?>js/libs/DataTables/jquery.dataTables.min.js"></script>
	<script src="http://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
        <link href="http://datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript">
		// Call template init (optional, but faster if called manually)
		$.template.init();
		// Table sort - DataTables
                
		var table = $('#sorting-advanced');
		table.dataTable({
                        //"sPaginationType": "full_numbers",
                        "bProcessing": true,
                        "bServerSide": true,
                        "iDisplayLength": 10,
                        "aLengthMenu": [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
                        "sAjaxSource": "<?=base_url()?>customerdata/jsonCustomerData/<?php echo $dealerdashboard; ?>",
                        "sServerMethod": "POST",
                        "aaSorting": [[0, 'asc']],
                        "fnDrawCallback": function() {
                            json_data = table.fnSettings().jqXHR.responseJSON;
                            //var items = JSON.parse(table.fnSettings().jqXHR.responseJSON);
                            var iTotalRecords = json_data.iTotalRecords;
                            var iTotalDisplayRecords = json_data.iTotalDisplayRecords;
                             
                            var display_start = parseInt(json_data.iDisplayStart)+1;
                            var display_length = parseInt(json_data.iDisplayLength)+parseInt(json_data.iDisplayStart);
                             if(iTotalDisplayRecords < display_length){
                                 display_length = iTotalDisplayRecords;
                            }
                            console.log(iTotalRecords);
                            console.log(iTotalDisplayRecords);
                             if(iTotalRecords == iTotalDisplayRecords){
                                 html = "Showing "+display_start+" to "+display_length+" of "+iTotalRecords+" enteries";
                            }else if(iTotalRecords < iTotalDisplayRecords){
                                 html = "Showing "+display_start+" to "+display_length+" of "+iTotalDisplayRecords+" enteries. (Filtered from "+iTotalRecords+ " enteries) ";
                            }
                            $('#sorting-advanced_info').html(html);
                        },
			'fnInitComplete': function( oSettings )
			{
				// Style length select
				table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
				tableStyled = true;
			},
                        "sDom": '<"dataTables_header"T<"clear">lfrtip><"dataTables_footer">',
                        'tableTools': {
                            "sSwfPath": "http://datatables.net/release-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
                        },
		});
                
                $('a#addSearchItem').click(function(e){	
                    e.preventDefault();
                    newItem = $("#newSearchItem_templ").clone();
                    newItem.attr('id', '');
                    newItem.css('display', 'block');
                    newItem.appendTo("#advancedSearch_accordion");
                    newItem.find('.btn-group.select').each(function(){ $(this).remove(); });
//                    newItem.find('select.selector').selectpicker({style: 'btn-primary', menuStyle: 'dropdown-inverse'});
                    $('#advancedSearch_accordion details').each(function(index){
                            $(this).find('summary').text("Search item "+(index));
                            //$(this).find('.panel-collapse').removeClass('in');
                    });
                })
                
                $('#advancedSearchForm').on('click', 'a.removeAsItem', function(e){	
                    e.preventDefault();
                    $(this).closest('details').remove();
                    $('#advancedSearch_accordion details').each(function(index){
                            $(this).find('summary').text("Search item "+(index));
                            //$(this).find('.panel-collapse').removeClass('in');
                    });
                })
                $('button#toggleAdvancedSearch').click(function(){
                    $('#advancedSearchForm_wrapper').slideToggle('slow');
                })
                //hide advanced search
                $('a#hideAdvancedSearch').click(function(e){
                        e.preventDefault();
                        $('#advancedSearchForm_wrapper').slideUp();
                })
	   
	</script>