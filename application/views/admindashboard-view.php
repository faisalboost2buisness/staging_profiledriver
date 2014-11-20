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
    function membership_sort_hide(){
        $('.sorting_asc').hide();
        $('.sorting_desc').hide();
    }
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
<script>
    $( document ).ready(function() {
        <?php
         if(isset($sucessmessage) && $sucessmessage!=''){
         ?>
        $("#membershipmessage").delay(5000).fadeOut(); //have tried "fast" also
        <?php
        }
        ?>
    });
</script>
<section role="main" id="main">
<!--heading-->
<hgroup id="main-title" class="thin" style="text-align:left;">
    <h1>Admin Panel</h1>
</hgroup>
<?php
if(isset($menu['logged_in']) && $menu['logged_in']!=''){
$id='sorting-advanced1';
$count=0;
$title='Accounts';
?>
<!--title-->
<div class="with-padding">
<div class="wrapped left-icon icon-info-round" style=" margin-bottom: 10px;">
    <div style="width: 332px;float: left;"><?=$title?></div>
    <?php
    if(isset($sucessmessage) && $sucessmessage!=''){
        echo '<div style="color: red;float: left;" id="membershipmessage">Membership is successfully created</div>';
    }
    ?>
</div>
<?php
//for selecting sort class and also check details ang get details depend on membership
if(isset($user_details) && is_array($user_details)){
    $count=count($user_details);
    if($count>0){
        $id='sorting-advanced';
    }else{
        $id='sorting-advanced1';
    }
}
$title='Accounts';
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
<!--table starts here-->
<table class="table responsive-table" id="<?=$id?>">
<thead>
<tr>
    <th scope="col" style="width: 3%;" class="align-center hide-on-mobile">SI No</th>
    <th scope="col" style="width: 18%;" class="align-center hide-on-mobile">Account/User Name</th>
    <th scope="col" width="13%" class="align-center hide-on-mobile">Account User</th>
    <th scope="col" width="13%" class="align-center hide-on-mobile">Email</th>
    <th scope="" width="13%" class="align-center hide-on-mobile-portrait">
        <!--form starts here-->
        <form method="post" action="<?php echo base_url()?>dashboard/usersortdashboard" id="form-login" style="float: right;">
            <select id="select_member" name="member_type" onchange="select_member_type();" class="select validate" onclick="membership_sort_hide();">
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
                    }elseif($member_type=='trainer'){
                        $membership='Trainer';
                    }elseif($member_type=='sales_person'){
                        $membership='Sales Person';
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
                <option value="trainer">Trainer </option>
                <option value="sales_person">Sales Person </option>
            </select>
        </form>
        <!--form ends here-->
    </th>
    <th scope="col" width="10%" class="lign-center hide-on-mobile-portrait" style="text-align: center;">Phone Number</th>
    <th scope="col" width="18%" class="lign-center hide-on-mobile-portrait" style="text-align: center;">Actions</th>
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
    $account_manger_count=1;
    $sub_admin_det=1;
    $trainer_det=1;
    $sales_person_det=1;
    foreach($user_details as $value){
        //echo '<pre>'.print_r($value,true).'</pre>';
        $datedisplay=strtotime($value['registratation_timestamp']);
        if($value['usertype']!='admin'){
            ?>
            <tr>
            <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?=$i?></th>
            <?php
            //function to give sub string for company name
            //$content_display=$value['company_name'];
            if($value['usertype']=='account_managers'){
                ?>
                <td style="width:220px;text-align: left;"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dealerlisting/<?=$value['registration_id']?>">Account Manager <?=$account_manger_count?></a></td>
                <?php
                $account_manger_count++;
            }else if($value['usertype']=='auto_brand'){
                $content_display=$value['autobrand_company_name'];
                ?>
                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width:220px;text-align: left;"><label><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dealerlisting/auto_brand_dealer/<?=$value['registration_id']?>"><?=$content_display?></a></label></td>
            <?php
            }else if($value['usertype']=='sub_admin'){
                ?>
                <td style="width:220px;text-align: left;"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/subadmindashboard/<?=$value['registration_id']?>">Sub Admin <?=$sub_admin_det?></a></td>
                <?
                $sub_admin_det++;
            }else if($value['usertype']=='trainer'){
                ?>
                <td style="width:220px;text-align: left;">
                    <a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a>
                    <a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/subadmindashboard/<?=$value['registration_id']?>">Trainer <?=$trainer_det?></a>
                </td>
                <?
                $trainer_det++;
            }else if($value['usertype']=='sales_person'){
                ?>
                <td style="width:220px;text-align: left;">
                    <a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a>
                    <a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/subadmindashboard/<?=$value['registration_id']?>">Sales Person <?=$sales_person_det?></a>
                </td>
                <?
                $sales_person_det++;
            }else{
                $content_display=$value['dealership_company_name'];
                ?>
                <td style="width:220px;text-align: left;"><a class="list-link icon-user"  style="float: left; line-height: normal; margin-top: 0px; margin-left: 9px; width: 0px; display: table-cell;margin-right: 19px;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a><a style="display: table-cell; float: left; width: 81%;" href="<?=base_url()?>dashboard/dealerdashboard/<?=$value['registration_id']?>"><?=$content_display?></a></td>
            <?php
            }
            $content_name=ucfirst($value['first_name'].' '.$value['last_name']);
            $content_name_length=strlen($content_name);
            if($content_name_length>20){
                $content_string= substr(($content_name),0,20);
                //$pos=strrpos($content_string," ");
                $content_name=$content_string.'...';
            }else{
                $content_name=$content_name;
            }
            if($value['usertype']=='account_managers'){
                ?>
                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width: 174px;"><label><?=$content_name?></label></td>
            <?php
            }else if($value['usertype']=='auto_brand'){
                ?>
                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width: 174px;"><label><?=$content_name?></label></td>
            <?php
            }else{
                ?>
                <td class="checkbox-cell" class="align-center hide-on-mobile" style="width: 174px;"><label><?=$content_name?></label></td>
            <?php
            }
            ?>
            <?php
            if($value['usertype']=='account_managers'){
                $membership='Account Manager';
            }else if($value['usertype']=='dealership'){
                $membership='Dealership';
            }else if($value['usertype']=='auto_brand'){
                $membership='Auto Manufacturer';
            }elseif($value['usertype']=='sub_admin'){
                $membership='Sub Admin';
            }elseif($value['usertype']=='trainer'){
                $membership='Trainer';
            }elseif($value['usertype']=='sales_person'){
                $membership='Sales Person';
            }else{
                $membership='';
            }
            ?>
            <td class="align-center hide-on-mobile"><a href="mailto:<?=$value['email_id'];?>"><?=$value['email_id'];?></a></td>
            <td class="align-center hide-on-mobile"><?= $membership;?></td>
            <?php
            if($value['usertype']=='sub_admin' || $value['usertype']=='account_managers'){
                ?>
                <td class="align-center hide-on-mobile"><?=$value['contact_phone_number']?></td>
            <?php
            }else{
                if($value['usertype'] == 'dealership'){
                    $company_phone_number = $value['dealer_company_phonenumber'];
                }else{
                    $company_phone_number = $value['autobrand_company_phonenumber'];
                }
                if($company_phone_number=='' || $company_phone_number==0){
                    ?>
                    <td class="align-center hide-on-mobile">N/A</td>
                <?php
                }else{
                    ?>
                    <td class="align-center hide-on-mobile"><?=$company_phone_number?></td>
                <?php
                }
            }
            ?>
            <td class="align-center hide-on-mobile" style="width: 172px;">
            <span class="button-group compact">
                                    <?php
            if($value['usertype']=='account_managers'){
                ?>
                <a href="<?=base_url()?>settings/<?=$value['registration_id']?>" class="button compact with-tooltip" title="Add Dealers">Add Dealer</a>
            <?php
            }
            ?>
                                        <a href="<?=base_url()?>profile/<?=$value['registration_id']?>" class="button compact with-tooltip" title="Edit">Edit</a>
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
    }).on('click', 'tbody td', function(event){
        // Do not process if something else has been clicked
        if (event.target !== this){
            return;
        }
        var tr = $(this).parent(),
            row = tr.next('.row-drop'),
            rows;
        // If click on a special row
        if (tr.hasClass('row-drop')){
            return;
        }
        // If there is already a special row
        if (row.length > 0){
            // Un-style row
            tr.children().removeClass('anthracite-gradient glossy');
            // Remove row
            row.remove();
            return;
        }
        // Remove existing special rows
        rows = tr.siblings('.row-drop');
        if (rows.length > 0){
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
        if (rows.length > 0){
            // Un-style previous rows
            rows.prev().children().removeClass('anthracite-gradient glossy');
            // Remove rows
            rows.remove();
        }
    });
    // Table sort - simple
</script>