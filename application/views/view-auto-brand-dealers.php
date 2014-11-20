<!--
This page shows all dealers listing under an account manager
-->
<script type="text/javascript">
function deletepoperty(property_id){
    if(confirm('Are you sure ?')){
        $.post('<?php echo base_url(); ?>
        dashboard/delete/'+property_id,function(data) {
        if(data=='Done'){
        window.location.reload('
        <?php echo base_url(); ?>
        dashboard');
        }
        });
    }
}
</script>
<!-- Button to open/hide menu -->
<a href="#" id="open-menu"><span>Menu</span></a>
<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
<!-- Main content -->
<section role="main" id="main">
    <hgroup id="main-title" class="thin" style="text-align:left;">
        <h1>Dealer Details</h1>
    </hgroup>
    <div class="with-padding">
        <!--heading-->
        <p class="wrapped left-icon icon-info-round">
        Dealers Details
            <button type="button" class="button glossy mid-margin-right" onclick="back_form();" style="float: right;">
                <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
                Back
            </button>
        </p>
        <?php
        $id='sorting-advanced1';
        $count=0;
        if(isset($user_details) && is_array($user_details)){
        
            $count=count($user_details);
            if($count>0){
                $id='sorting-advanced';
            }else{
                $id='sorting-advanced1';
            }
        }
        ?>		
        <table class="table responsive-table" id="<?=$id?>">
        <!-- Table heading start -->
            <thead>
                <tr>
                    <th scope="col" class="align-center hide-on-mobile" style="text-align: center;">SI No</th>
                    <th scope="col" style="width: 201px;" class="align-center hide-on-mobile">Company Name</th>
                    <th scope="col" width="13%" class="align-center hide-on-mobile">Account User</th>
                    <th scope="col" width="13%" class="align-center hide-on-mobile-portrait">Email</th>
                    <th scope="col" width="15%" class="align-center hide-on-mobile">Phone Number</th>
                    <th scope="col" width="20%" class="align-center hide-on-mobile">Actions</th>
                </tr>
            </thead>
            <!--Table heading end -->
            <tfoot>
            <?php
            if (isset($user_details) && is_array($user_details)){
                $count = count($user_details);
            }else{
                $count=0; 
            }
            ?>
                <tr>
                    <td colspan="6">
                    <?=$count ?> entries found
                    </td>
                </tr>
            </tfoot>    
            <!--details display start -->
            <tbody> 
            <?
            //print_r($user_details);
            if(isset($user_details)  && is_array($user_details)){
                $i=1;
                foreach($user_details as $value){
                    $datedisplay=strtotime($value['registratation_timestamp']);
                    if($value['usertype']!='admin'){
                    ?>          
                        <tr>
                        <th scope="row" class="align-center hide-on-mobile" style="text-align: center;width: 6%;"><?=$i?></th>
                        <td style="padding-left:19px;width: 23%;" class="align-center hide-on-mobile"><label><?=ucfirst($value['company_name'])?></label><a class="list-link icon-user"  style="float: right;line-height: normal;margin-top: 0;" title="View Profile" href="<?=base_url()?>dashboard/viewdashbord/<?=$value['registration_id']?>">&nbsp;</a></td>
                        <td class="align-center hide-on-mobile" style="width: 23%;"><?=ucfirst($value['first_name']) ?></td>
                        <td class="align-center hide-on-mobile" style="width: 29%;"><?=ucfirst($value['email_id']) ?></td>
                        <td class="align-center hide-on-mobile" style="width: 14%;"><?=$value['company_phonenumber'] ?></td>                    
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
            }
            else
            {
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
    </div>
</section>
<!-- End sidebar/drop-down menu -->
<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
<script src="<?=base_url() ?>js/libs/jquery-1.10.2.min.js"></script>
<script src="<?=base_url() ?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url() ?>js/developr.input.js"></script>
<script src="<?=base_url() ?>js/developr.navigable.js"></script>
<script src="<?=base_url() ?>js/developr.notify.js"></script>
<script src="<?=base_url() ?>js/developr.scroll.js"></script>
<script src="<?=base_url() ?>js/developr.tooltip.js"></script>
<script src="<?=base_url() ?>js/developr.table.js"></script>
<!-- Plugins -->
<script src="<?=base_url() ?>js/libs/jquery.tablesorter.min.js"></script>
<script src="<?=base_url() ?>js/libs/DataTables/jquery.dataTables.min.js"></script>
<script>
// Call template init (optional, but faster if called manually)
$.template.init();
// Table sort - DataTables
var table = $('#sorting-advanced');
table.dataTable({
    'aoColumnDefs' : [{
    'bSortable' : false,
    'aTargets' : [0, 5]
    }],
    'sPaginationType' : 'full_numbers',
    'sDom' : '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
    'fnInitComplete' : function(oSettings) {
        // Style length select
        table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
        tableStyled = true;
    }
});
// Table sort - styled
$('#sorting-example1').tablesorter({
    headers : {
        0 : {
            sorter : false
        },
        5 : {
            sorter : false
        }
    }
}).on('click', 'tbody td', function(event) {
    // Do not process if something else has been clicked
    if (event.target !== this) {
        return;
    }
    var tr = $(this).parent(), row = tr.next('.row-drop'), rows;
    // If click on a special row
    if (tr.hasClass('row-drop')) {
        return;
    }
    // If there is already a special row
    if (row.length > 0) {
        // Un-style row
        tr.children().removeClass('anthracite-gradient glossy');
        // Remove row
        row.remove();
        return;
    }
    // Remove existing special rows
    rows = tr.siblings('.row-drop');
    if (rows.length > 0) {
        // Un-style previous rows
        rows.prev().children().removeClass('anthracite-gradient glossy');
        // Remove rows
        rows.remove();
    }
    // Style row
    tr.children().addClass('anthracite-gradient glossy');
    // Add fake row
    $('<tr class="row-drop">' + '<td colspan="' + tr.children().length + '">' + '<div class="float-right">' + '<button type="submit" class="button glossy mid-margin-right">' + '<span class="button-icon"><span class="icon-mail"></span></span>' + 'Send mail' + '</button>' + '<button type="submit" class="button glossy">' + '<span class="button-icon red-gradient"><span class="icon-cross"></span></span>' + 'Remove' + '</button>' + '</div>' + '<strong>Name:</strong> John Doe<br>' + '<strong>Account:</strong> admin<br>' + '<strong>Last connect:</strong> 05-07-2011<br>' + '<strong>Email:</strong> john@doe.com' + '</td>' + '</tr>').insertAfter(tr);
}).on('sortStart', function() {
    var rows = $(this).find('.row-drop');
    if (rows.length > 0) {
        // Un-style previous rows
        rows.prev().children().removeClass('anthracite-gradient glossy');
        // Remove rows
        rows.remove();
    }
});
// Table sort - simple
$('#sorting-example2').tablesorter({
    headers : {
        5 : {
            sorter : false
        }
    }
}); 
</script>