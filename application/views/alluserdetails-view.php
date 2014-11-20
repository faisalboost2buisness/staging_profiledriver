<?php
if(isset($menu['logged_in']) && $menu['logged_in']!=''){
$id='sorting-advanced1';
$count=0;
$title='Accounts';
//for selecting sort class and also check details ang get details depend on membership
if(isset($user_details) && is_array($user_details)){
    $count=count($user_details);
    if($count>0){
        $id='sorting-advanced';
    }else{
        $id='sorting-advanced1';
    }
} 
$title='User Listing';
if(isset($member_type) && $member_type!=''){
    if($member_type=='account_managers'){
        $membership='Account Manager';
    }else if($member_type=='dealership'){
        $membership='Dealership';
    }else if($member_type=='auto_brand'){
        $membership='Auto Manufacturer';
    }elseif($member_type=='sub_admin'){
        $membership='Sub Admin';
    }else{
        $membership='All';
    }
}
?>
<thead>
    <tr>
        <th scope="col" style="width: 5%;" class="align-center hide-on-mobile">SI No</th>
        <th scope="col" style="width: 15%;" class="align-center hide-on-mobile">Account User</th>
        <th scope="col" width="13%" class="align-center hide-on-mobile">Email</th>
        <th scope="" width="13%" class="align-center hide-on-mobile-portrait">
            <form method="post" action="<?php echo base_url()?>dashboard/usersortdashboard" id="form-login" style="float: right;">
                <select id="select_member" name="member_type" onchange="select_member_type();" class="select validate">
                    <?php
                    if(isset($member_type) && $member_type!=''){
                        if($member_type=='account_managers'){
                            $membership='Account Manager';
                        }else if($member_type=='dealership'){
                            $membership='Dealership';
                        }else if($member_type=='auto_brand'){
                            $membership='Auto Manufacturer';
                        }elseif($member_type=='sub_admin'){
                            $membership='Sub Admin'; 
                        }else{
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
                </select>
            </form>
        </th>
        <th scope="col" width="15%" class="lign-center hide-on-mobile-portrait">Phone Number</th>
        <th scope="col" width="25%" class="lign-center hide-on-mobile-portrait" style="text-align: center;">Actions</th>
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
    if(isset($user_details) && is_array($user_details)){
    $i=1;
        foreach($user_details as $value){
        $datedisplay=strtotime($value['registratation_timestamp']);
            if($value['usertype']!='admin' ){                        
            ?>  
                <thead>        
                    <tr>
                        <th scope="row" class="align-center hide-on-mobile " style="text-align: center;" class="showvalues"><?=$i?></th>
                        <?php
                        if($value['usertype']=='account_managers'){
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" class="showvalues"><label><a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>"><?=ucfirst($value['first_name'])?></a></label><a class="list-link icon-user"  style=" float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                        <?php
                        }else if($value['usertype']=='auto_brand'){
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" class="showvalues"><label><a href="<?=base_url()?>dealerlisting/auto_brand_dealer/<?=$value['registration_id']?>"><?=ucfirst($value['first_name'])?></a></label><a class="list-link icon-user"  style="float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                        <?php   
                        }else{
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" class="showvalues"><label><a href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=ucfirst($value['first_name'])?></a></label><a class="list-link icon-user"  style="float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                        <?php
                        }
                        ?>
                        <td class="align-center hide-on-mobile" class="showvalues"><?=$value['email_id'];?></td>
                        <?php 
                        if($value['usertype']=='account_managers'){
                            $membership='Account Manager';
                        }else if($value['usertype']=='dealership'){
                            $membership='Dealership';
                        }else if($value['usertype']=='auto_brand'){
                            $membership='Auto Manufacturer';
                        }elseif($value['usertype']=='sub_admin'){
                            $membership='Sub Admin'; 
                        }else{
                            $membership='';
                        }
                        ?>
                        <td class="align-center hide-on-mobile" class="showvalues"><?= $membership;?></td>
                        <td class="align-center hide-on-mobile" class="showvalues"><?=$value['company_phonenumber']?></td>
                        <td class="align-center hide-on-mobile" class="showvalues">
                            <span class="button-group compact">
                                <?php 
                                if($value['usertype']=='account_managers'){
                                ?> 
                                    <a href="<?=base_url()?>settings/<?=$value['registration_id']?>" class="button compact with-tooltip" title="Add Dealers">Add Dealer</a>
                                <?php
                                }
                                ?>                        
                                    <a href="<?=base_url()?>profile/index/<?=$value['registration_id']?>" class="button compact with-tooltip" title="Edit">Edit</a>
                                <?php
                                if($value['usertype']=='account_managers'){                              
                                ?>
                                    <a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>" class="button with-tooltip" title="View assigned dealers">Task List</a>
                                <?php
                                }
                               ?>
                            </span>
                        </td>
                    </tr>
                <?php
                 }
                ?>
            
            
            <?
            $i++;
            }
        }else{
        ?>
            <tr>
                <td colspan="8" class="showvalues">No data found</td>
            </tr>
        <?php
        }
        ?>
</thead>
</tbody>
</table>
<?php
}
?>