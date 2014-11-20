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
            <h1>Master Details</h1>
        </hgroup>
        <div class="with-padding">
            <p class="wrapped left-icon icon-info-round">
            Master Details View
                <button type="button" class="button glossy mid-margin-right" onclick="back_form();" style="float: right;">
                    <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
                    Back
                </button>
            </p>
            <?php
            $count=count($member_details);
            if($count>0){
                $id='sorting-advanced';
            }else{
                $id='sorting-advanced1';
            }
            ?>
            <table class="table responsive-table" id="<?=$id?>">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;" class="align-center hide-on-mobile">SI No</th>
                        <th scope="col" class="align-center hide-on-mobile" style="width: 60px;">Quantity</th>
                        <th scope="col"  class="align-center hide-on-mobile">VIN - Truncated</th>
                        <th scope=""  class="align-center hide-on-mobile-portrait">Vehicle Year</th>
                        <th scope="col"  class="lign-center hide-on-mobile-portrait" style="text-align: center;">Vehicle Make</th>
                        <th scope="col"  class="lign-center hide-on-mobile-portrait" style="text-align: center;">Vehicle Model</th>
                        <th scope="col"  class="align-center hide-on-mobile">LKM High Value</th>
                        <th scope="col"  class="align-center hide-on-mobile">LKM Low Value</th>
                        <th scope="col"  class="align-center hide-on-mobile">HKM High Value</th>
                        <th scope="col"  class="align-center hide-on-mobile">HKM Low Value</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="10">
                        <?=$count?> entries found
                        </td>
                    </tr>
                </tfoot>
            <tbody>  
                <?php
                if(isset($member_details) || $member_details!=''){
                $i=1;
                    foreach($member_details as $value){
                    $make = $value['sold_vehicle_make'];
                    $model = $value['sold_vehicle_model'];
                    $year = $value['sold_vehicle_year'];
                    $vin = $value['vin'];
                    $count = $this->settings_model->getCount_Vehical($make,$model,$year,$vin);
                    ?>
                        <tr>
                            <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?php echo $i?></th>
                            <th scope="row" class="align-center hide-on-mobile" style="text-align: center;"><?php echo $count; ?></th>
                            <td class="checkbox-cell" class="align-center hide-on-mobile" style="text-align: center;" ><?php echo $value['vin']?></td>
                            <td><?php echo $value['sold_vehicle_year'];?></td>
                            <td class="align-center hide-on-mobile"><?php echo $value['sold_vehicle_make']?></td>
                            <td class="align-center hide-on-mobile"><?php echo $value['sold_vehicle_model']?></td>
                            
                            <?php
                            if($value['lkm_high_value']!=''){
                                $lkm_high_value=$value['lkm_high_value'];
                            }else{
                                $lkm_high_value='N/A';
                            }
                             if($value['lkm_low_value']!=''){
                                $lkm_low_value=$value['lkm_low_value'];
                            }else{
                                $lkm_low_value='N/A';
                            }
                             	
                            ?>
                            <td class="align-center hide-on-mobile"><?php echo $lkm_high_value?></td>
                            <td class="align-center hide-on-mobile"><?php echo $lkm_low_value?></td>
                            <?php
                            if($value['hkm_high_value']!=''){
                                $hkm_high_value=$value['hkm_high_value'];
                            }else{
                                $hkm_high_value='N/A'; 
                            }
                            ?>
                            <td class="align-center hide-on-mobile"><?php echo $hkm_high_value?></td>
                            <?php
                            if($value['hkm_low_value']!=''){
                                $hkm_low_value=$value['hkm_low_value'];
                            }else{
                                $hkm_low_value='N/A';
                            }
                            ?>
                            <td class="align-center hide-on-mobile"><?php echo $hkm_low_value?></td>
                        </tr>
                    <?php
                    $i++;
                    }
                }else{
                ?>
                <tr>
                    <td colspan="10">No data found</td>
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