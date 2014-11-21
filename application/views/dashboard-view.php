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
    <?php
    if($menu['logged_in']['usertype']=='admin' || $menu['logged_in']['usertype']=='sub_admin'){
        ?>
        <h1>Admin Panel</h1>
    <?php
    }else{
        ?>
        <h1>Dashboard</h1>
    <?php
    }
    ?>
</hgroup>
<?php
if(isset($menu['logged_in']) && $menu['logged_in']!=''){
$id='sorting-advanced1';
$count=0;
$title='Accounts';
//for selecting sort class and also check details ang get details depend on membership
if($menu['logged_in']['usertype']=='account_managers' ){
    $user_id = $menu['logged_in']['registration_id'];
    $dealer_details=$this->main_model->getdealerslisting($user_id);
    if(isset($dealer_details) && is_array($dealer_details)){
        $count=count($dealer_details);
        if($count>0){
            $id='sorting-advanced';
        }else{
            $id='sorting-advanced1';
        }
    }
    $title='Assigned Dealers Details';
}else if($menu['logged_in']['usertype']=='auto_brand'){
    $user_id = $menu['logged_in']['registration_id'];
    $dealer_details=$this->main_model->getauto_brand_dealers($user_id);
    if(isset($dealer_details) && is_array($dealer_details)){
        $count=count($dealer_details);
        if($count>0){
            $id='sorting-advanced';
        }else{
            $id='sorting-advanced1';
        }
    }
    $title='Dealers Details';
}else{
    if(isset($user_details) && is_array($user_details)){
        $count=count($user_details);
        if($count>0){
            $id='sorting-advanced';
        }else{
            $id='sorting-advanced1';
        }
    }
    $title='Accounts';
}
?>
<div class="with-padding">
<p class="wrapped left-icon icon-info-round">
    <?=$title?>
    <?php if(isset($_SESSION['message_sent']) && $_SESSION['message_sent']==1){ echo '<div class="message-sent">message</div>'; } ?>
    <?php
    if(isset($member_type) && $member_type!=''){
    ?>
    <button type="button" class="button glossy mid-margin-right" onclick="back_form();" style="float: right;">
        <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
        Back
    </button></p>
<?php
}
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
<table class="table responsive-table" id="<?=$id?>">
<thead>
<tr>
    <th scope="col" style="width: 5%;" class="align-center hide-on-mobile">SI No</th>
    <?php
    if(isset($member_type) && $member_type!=''){
        if($member_type=='account_managers'){
        }elseif($member_type=='sub_admin'){
        }else{
            ?>
            <th scope="col"  class="align-center hide-on-mobile">Account/User Name</th>
        <?php
        }
    }
    if($menu['logged_in']['usertype']=='account_managers'){
        ?>
        <th scope="col"  class="align-center hide-on-mobile" >Account/User Name</th>
    <?php
    }elseif($menu['logged_in']['usertype']=='auto_brand'){
        ?>
        <th scope="col"  class="align-center hide-on-mobile">Account/User Name</th>
    <?php
    }
    ?>
    <th scope="col" class="align-center hide-on-mobile" style="width: 100px;">Account User</th>
    <th scope="col"  class="align-center hide-on-mobile">Email</th>
    <th scope=""  class="align-center hide-on-mobile-portrait">Member Type</th>
    <th scope="col"  class="lign-center hide-on-mobile-portrait" style="text-align: center;">Phone Number</th>
    <th scope="col"  class="lign-center hide-on-mobile-portrait" style="text-align: center;">Actions</th>
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
//for admin dashboard
if($menu['logged_in']['usertype']=='admin' || $menu['logged_in']['usertype']=='sub_admin'){
    // print_r($user_details);
    if(isset($user_details) && is_array($user_details)){
        $i=1;
        foreach($user_details as $value){
            $datedisplay=strtotime($value['registratation_timestamp']);
            if($value['usertype']!='admin' ){
                ?>
                <tr>
                <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$i?></th>
                <?php
                if(isset($member_type) && $member_type!=''){
                    if($member_type=='account_managers'){
                        ?>
                    <?php
                    } else if($member_type=='sub_admin'){
                    }
                    else if($member_type=='auto_brand'){
                        ?>
                        <th scope="row" class="align-center hide-on-mobile" style="text-align: left;"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a href="<?=base_url()?>dealerlisting/auto_brand_dealer/<?=$value['registration_id']?>" style="display: table-cell; float: left; width: 81%;"><?=$value['company_name']?></a></th>
                    <?php
                    }else{
                        ?>
                        <th scope="row" class="align-center hide-on-mobile" style="text-align: left;"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>" style="font-weight: normal;"><?=$value['company_name']?></a></th>
                    <?php
                    }
                }
                if(isset($member_type) && $member_type!=''){
                    if($member_type=='account_managers'){
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" style="text-align: left;" ><label><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=ucfirst($value['first_name'])?></a></label></td>
                    <?php
                    }else{
                        ?>
                        <td class="checkbox-cell" class="align-center hide-on-mobile" ><label><a href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=ucfirst($value['first_name'])?></a></label></td>
                    <?php
                    }
                }
                ?>
                <td><a href="mailto:<?=$value['email_id'];?>"><?=$value['email_id'];?></a></td>
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
                <td class="align-center hide-on-mobile"><?= $membership;?></td>
                <?php
                if($value['usertype']=='account_managers' || $value['usertype']=='sub_admin'){
                    ?>
                    <td class="align-center hide-on-mobile"><?=$value['contact_phone_number']?></td>
                <?php
                }else{
                    if($value['company_phonenumber']=='' || $value['company_phonenumber']==0){
                        ?>
                        <td class="align-center hide-on-mobile">N/A</td>
                    <?php
                    }else{

                        ?>
                        <td class="align-center hide-on-mobile"><?=$value['company_phonenumber']?></td>
                    <?php
                    }
                }
                ?>
                <td class="align-center hide-on-mobile">
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
            }
            ?>
            </span>
            </td>
            </tr>
            <?
            $i++;
        }
    }else{
        ?>
        <tr>
            <td colspan="8">No data found</td>
        </tr>
    <?php
    }
}
//end of admin dashboard and starting of others dashboard
//user type other than admin
else if($menu['logged_in']['usertype']=='dealership'){

    if(isset($user_details) && $user_details!=''){
        $i=1;
        foreach($user_details as $value){
            $datedisplay=strtotime($value['registratation_timestamp']);
            if($value['usertype']!='admin'){
                if($value['usertype']=='account_managers'){
                    $membership='Account Manager';
                }else if($value['usertype']=='dealership'){
                    $membership='Dealership';
                }else if($value['usertype']=='auto_brand'){
                    $membership='Auto Manufacturer';
                }elseif($value['usertype']=='sub_admin'){
                    $membership='Sub Admin';
                }
                ?>
                <tr>
                <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$i?></th>
                <td class="align-center hide-on-mobile"><?=$value['company_name']?></td>
                <td class="align-center hide-on-mobile" style="text-align: left;"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><label style="display: table-cell; float: left; width: 81%;"><?=ucfirst($value['first_name']).$value['last_name']?></label></td>
                <td class="align-center hide-on-mobile"><a href="mailto:<?=$value['email_id'];?>"><?=$value['email_id'];?></a></td>
                <td class="align-center hide-on-mobile"><?=$membership?></td>
                <td class="align-center hide-on-mobile"><?=$value['company_phonenumber']?></td>
                <td class="align-center hide-on-mobile">
                <span class="button-group compact">
                <a href="<?=base_url()?>profile/index/<?=$value['registration_id']?>" class="button compact" title="Edit">Edit</a>
                                    <?php
                if($value['usertype']=='account_managers'){
                    ?>
                    <a href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>" class="button with-tooltip" title="View assigned dealers">View</a>
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
    }else{
        ?>
        <tr>
            <td colspan="8">No data found</td>
        </tr>
    <?php
    }
}else{
if($menu['logged_in']['usertype']=='account_managers'){
    $user_id = $menu['logged_in']['registration_id'];
    $dealer_details=$this->main_model->getdealerslisting($user_id);
}else  if($menu['logged_in']['usertype']=='auto_brand'){
    $user_id = $menu['logged_in']['registration_id'];
    $dealer_details=$this->main_model->getauto_brand_dealers($user_id);
}
//print_r($user_details);
if(isset($dealer_details) && is_array($dealer_details)){
    $i=1;
    foreach($dealer_details as $value){
        $datedisplay=strtotime($value['registratation_timestamp']);
        if($value['usertype']!='admin'){
            ?>
            <tr>
            <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$i?></th>
            <td style="padding-left:19px;text-align: left;" class="align-center hide-on-mobile"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=$value['company_name']?></a></td>
            <td style="padding-left:19px;" class="align-center hide-on-mobile" ><?=ucfirst($value['first_name'])?></td>
            <td class="align-center hide-on-mobile"><a href="mailto:<?=$value['email_id'];?>"><?=$value['email_id'];?></a></td>
            <td class="align-center hide-on-mobile"><?=ucfirst($value['usertype']) ?></td>
            <?php
            if($value['usertype']=='account_managers' || $value['usertype']=='sub_admin'){
                ?>
                <td class="align-center hide-on-mobile"><?=$value['contact_phone_number'] ?></td>
            <?php
            }else{
                ?>
                <td class="align-center hide-on-mobile"><?=$value['company_phonenumber'] ?></td>
            <?php
            }
            ?>
            <td class="align-center hide-on-mobile">
            <span class="button-group compact">
            <a href="<?=base_url() ?>profile/index/<?=$value['registration_id'] ?>" class="button compact ">Edit</a>
        <?php
        }
        ?>
        </span>
        </td>
        </tr>
        <?
        $i++;
    }
}else{
    ?>
    <tr>
        <td colspan="8" style="color: #666666!important;">No data found</td>
    </tr>
<?php
}
?>
</tbody>
<!--details display end -->
</table>
<?php
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