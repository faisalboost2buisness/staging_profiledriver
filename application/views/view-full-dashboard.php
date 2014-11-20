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
}
.tdbackground
{
    background-color: white; 
}
.dataTables_paginate,#sorting-advanced_length, .dataTables_filter, #sorting-advanced_info
{
    display: none;
}
.dataTables_header, .dataTables_footer{
    height: 45px;
}
</style>
<script type="text/javascript">
function back_form(){
    window.history.back() 
}
</script>
<!-- Button to open/hide menu -->
<a href="#" id="open-menu"><span>Menu</span></a>
<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
<!-- Main content -->
<section role="main" id="main">
    <hgroup id="main-title" class="thin" style="text-align:left;">
        <h1>User Account Details </h1>
    </hgroup>
    <div class="with-padding">
        <p class="wrapped left-icon icon-info-round">
        Account Details
        <!--Button to return back-->  
        <button type="button" class="button glossy mid-margin-right" onclick="back_form();" style="float: right;">
            <span class="button-icon green-gradient"><span class="icon-backward"></span></span>
            Back
        </button>
        </p>
        <!--table starts here-->  
        <table class="table responsive-table" id="sorting-advanced">
            <thead>
                <tr>
                    <th scope="col" width="14%" style="text-align: center;" class="align-center hide-on-mobile">First Name</th>
                    <th scope="col" width="14%">Last Name</th>
                    <th scope="col" width="14%" class="align-center hide-on-mobile">Company Name</th>
                    <th scope="col" width="14%" class="align-center hide-on-mobile">Email</th>
                    <th scope="col" width="14%" class="align-center hide-on-mobile">Company Phone</th>
                    <th scope="col" width="14%" class="align-center hide-on-mobile">Company Website</th>
                    <th scope="col" width="13%" class="align-center hide-on-mobile">Contact Person</th>
                </tr>
            </thead>
            <?php
            //print_r($user_details);
            if(isset($user_details) && $user_details!=''){
                $i=1;
                foreach($user_details as $value){
                    $datedisplay=strtotime($value['registratation_timestamp']);
                    if($value['last_name']!=''){
                        $lastname=ucfirst($value['last_name']);
                    }else{
                        $lastname='N/A'; 
                    } 
                    if($value['company_website']!=''){
                        $website=$value['company_website'];
                    }else{
                        $website='N/A'; 
                    }  
                    if($value['contact_person']!=''){
                        $contact_person=ucfirst($value['contact_person']);
                    }else{
                        $contact_person='N/A'; 
                    }              
                    ?>  
                    <thead>        
                        <tr>
                            <th scope="row" style="font-weight: normal;background: white; "class="align-center hide-on-mobile"><?=ucfirst($value['first_name'])?></th>
                            <td style="background: white; " class="align-center hide-on-mobile"><?=$lastname?></td>
                            <td style="background: white; " class="align-center hide-on-mobile"><?=ucfirst($value['company_name'])?></td>
                            <td style="background: white; " class="align-center hide-on-mobile"><?=$value['email_id']?></td>
                            <td style="background: white; " class="align-center hide-on-mobile"><?=$value['company_phonenumber']?></td>
                            <td style="background: white; " class="align-center hide-on-mobile">
                            <?=$website?>	
                            </td>
                            <td style="background: white; " class="align-center hide-on-mobile">
                            <?=$contact_person?>	
                            </td>
                        </tr>
                    </thead>
                    <?
                    $i++;
                }
                ?>
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;" class="align-center hide-on-mobile">Membership</th>
                        <th scope="col" class="align-center hide-on-mobile">Country</th>
                        <th scope="col"  class="align-center hide-on-mobile">State</th>
                        <th scope="col" class="align-center hide-on-mobile">City</th>
                        <th scope="col" class="align-center hide-on-mobile">Address</th>
                        <th scope="col" class="align-center hide-on-mobile">Postcode</th>
                        <th scope="col" class="align-center hide-on-mobile">Date</th>
                    </tr>
                </thead>  
                <?php
                foreach($user_details as $value){
                    $datedisplay=strtotime($value['registratation_timestamp']);
                    if($value['usertype']=='account_managers'){
                        $membership='Account Manager';
                    }else if($value['usertype']=='dealership'){
                        $membership='Dealer';
                    }else if($value['usertype']=='auto_brand'){
                        $membership='Auto Brand';
                    }else{
                        $membership='';
                    }
                ?>                       
                <tr>
                    <th scope="row" style=" font-weight: normal;background: white;text-align: center; " class="align-center hide-on-mobile"><?=$membership?></th>
                    <td style="background: white; " class="align-center hide-on-mobile"><?=ucfirst($value['country'])?></td>
                    <td style="background: white; " class="align-center hide-on-mobile"><?=ucfirst($value['state'])?></td>
                    <td style="background: white; " class="align-center hide-on-mobile"><?=ucfirst($value['city'])?></td>
                    <td style="background: white; " class="align-center hide-on-mobile"><?=ucfirst($value['address'])?></td>
                    <td style="background: white; " class="align-center hide-on-mobile">
                    <?=$value['zipcode']?>	
                    </td>
                    <td  style="background: white; " class="align-center hide-on-mobile">
                    <?=date('M d, Y',$datedisplay)?>	
                    </td>
                </tr>
            <?
            $i++;
            }
        }
        ?>
        </table>
        <!--table ends here-->
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
    { 'bSortable': false, 'aTargets': [ 0,0 ] }
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
}).on('click', 'tbody td', function(event)
{
    // Do not process if something else has been clicked
    var tr = $(this).parent(),
    //row = tr.next('.row-drop'),
    rows;
    // If click on a special row
    // If there is already a special row
    // Remove existing special rows
    //rows = tr.siblings('.row-drop');
    // Style row
    tr.children().addClass('anthracite-gradient glossy');
    // Add fake row
})
// Table sort - simple
</script>