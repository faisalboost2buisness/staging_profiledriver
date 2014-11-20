<style>
.main-fancydiv{
    border: 5px solid black;
    height: 53%;
    padding: 15px;
    background-color: white;
}
.label_name{
    width:48%;
    float:left;
    color: #000;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight:bold;
    margin-bottom: 4px;
}
.label_ans{
    color: #808080;
    font-size: 14px;
    margin-bottom: 4px;
    float: left;
    width: 200px;
}

</style>
<div class="main-fancydiv">
    <?php
    if(isset($get_customerdetails) || $get_customerdetails!=''){        
   
      
    ?>
    <h2>Customer Details</h2>
    <div>
    <?php
        if($get_customerdetails[0]['buyer_first_name']=='')
        {
            $buyer_first_name='N/A';
        }else{
            $buyer_first_name=$get_customerdetails[0]['buyer_first_name'];
            }
        ?>
        <label class="label_name">First Name</label>
        <span class="label_ans"><?php echo $buyer_first_name?></span><br />
        <?php
         if($get_customerdetails[0]['buyer_last_name']==''){
            $buyer_last_name='N/A';
            }else{
                $buyer_last_name=$get_customerdetails[0]['buyer_last_name'];
                }
        ?>
        <label class="label_name">Last Name</label>
        <span class="label_ans"><?=$buyer_last_name?></span><br />
        <?php
        if($get_customerdetails[0]['buyer_email']==''){
            $buyer_email='N/A';
            }else{
                $buyer_email=$get_customerdetails[0]['buyer_email'];
                }
        ?>
        <label class="label_name">Contact Email</label>
        <span class="label_ans"><?php echo $buyer_email?></span><br />
        <?php
        if($get_customerdetails[0]['buyer_address']==''){
            $buyer_address='N/A';
            }else{
                $buyer_address=$get_customerdetails[0]['buyer_address'];
                }
        ?>
        <label class="label_name">Address </label>
        <span class="label_ans"><?php echo $buyer_address?></span><br />
        <?php
         if($get_customerdetails[0]['buyer_city']==''){
            $buyer_city='N/A';
            }else{
                $buyer_city=$get_customerdetails[0]['buyer_city'];
                }
        ?>
        <label class="label_name">City </label>
        <span class="label_ans"><?php echo $buyer_city?></span><br />
        <?php
        if($get_customerdetails[0]['buyer_postalcode']==''){
            $buyer_postalcode='N/A';
            }else{
                $buyer_postalcode=$get_customerdetails[0]['buyer_postalcode'];
                }
        ?>
        <label class="label_name">Postal Code </label>
        <span class="label_ans"><?=$buyer_postalcode?></span><br />
        <?php
         if($get_customerdetails[0]['buyer_businessphone']==''){
            }else{
        ?>
         <label class="label_name">Business Phone Number </label>
        <span class="label_ans"><?php echo $get_customerdetails[0]['buyer_businessphone']?></span><br />
        <?php
        }if($get_customerdetails[0]['buyer_cellphone']==''){
            }else{
        ?>
         <label class="label_name">Phone Number </label>
        <span class="label_ans"><?php echo $get_customerdetails[0]['buyer_cellphone']?></span><br />
        <?php
        }if($get_customerdetails[0]['buyer_homephone']==''){
            }else{
        ?>
         <label class="label_name">Home Phone Number </label>
        <span class="label_ans"><?php echo $get_customerdetails[0]['buyer_homephone']?></span><br />
        <?php
        }if($get_customerdetails[0]['sold_vehicle_make']==''){
            $sold_vehicle_make='N/A';
            }else{
                $sold_vehicle_make=$get_customerdetails[0]['sold_vehicle_make'];
                }
        ?>
        <label class="label_name">Make </label>
        <span class="label_ans"><?php echo $sold_vehicle_make?></span><br />
        <?php
        if($get_customerdetails[0]['sold_vehicle_model']==''){
            $sold_vehicle_model='N/A';
            }else{
                $sold_vehicle_model=$get_customerdetails[0]['sold_vehicle_model'];
                }
        ?>
         <label class="label_name">Model </label>
        <span class="label_ans"><?php echo $sold_vehicle_model?></span><br />
        <?php
         if($get_customerdetails[0]['sold_vehicle_stock']==''){
            $sold_vehicle_stock='N/A';
            }else{
                $sold_vehicle_stock=$get_customerdetails[0]['sold_vehicle_stock'];
                }
        ?>
         <label class="label_name">Stock </label>
        <span class="label_ans"><?php echo $sold_vehicle_stock?></span><br />
        <?php
        if($get_customerdetails[0]['sold_vehicle_VIN']==''){
            $sold_vehicle_VIN='N/A';
            }else{
                $sold_vehicle_VIN=$get_customerdetails[0]['sold_vehicle_VIN'];
                }
        ?>
        <label class="label_name">Vin </label>
        <span class="label_ans"><?php echo $sold_vehicle_VIN?></span><br />
        <?php
        if($get_customerdetails[0]['sold_vehicle_year']==''){
            $sold_vehicle_year='N/A';
            }else{
                $sold_vehicle_year=$get_customerdetails[0]['sold_vehicle_year'];
                }
        ?>
        <label class="label_name">Year </label>
        <span class="label_ans"><?php echo $sold_vehicle_year?></span><br />
        <?php
        if($get_customerdetails[0]['new_used']==''){
            $vehicle_condition='N/A';
            }else{
                if($get_customerdetails[0]['new_used']=='N'){
                    $vehicle_condition='New';
                }else{
                    $vehicle_condition='Used';
                }
        ?>
        <label class="label_name">Condition </label>
        <span class="label_ans"><?php echo $vehicle_condition?></span><br />
        <?php
        }
        ?>
    </div>
    <?php
    }
    ?>
</div>