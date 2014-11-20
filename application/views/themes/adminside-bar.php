<!-- End main content -->
<!-- Side tabs shortcuts -->
<?php
$user_id = $menu['logged_in']['registration_id'];
$get_usertype=$this -> main_model -> get_usertype($user_id);
    if($get_usertype=='admin'){
        $user_type='Administrator';
    }elseif($get_usertype=='dealership'){
        $user_type='Dealer';
    }elseif($get_usertype=='account_managers'){
        $user_type='Account Manager';
    }else{
        $user_type='Auto Brand';
    }
 $segment=$this->uri->segment(1);
?>
<style>
#title-bar ~ #main{
    z-index: 0;
}
#Sellermenu1{
    background-color: white;
    border:6px solid #000;
    display: none;
    height: 216px;
    margin-left: -71px;
    margin-top: 0px;
    padding: 4px;
    position: absolute;
    width: 76px;
    left: 138px;
    top: 69px;
    z-index: 2147483647;
    //margin-left: -5px;
    //padding-bottom: 6px;
    //margin-top: -50px;
}
.faqhomebuttons {
    background-color: #086068;
    background-image: linear-gradient(to bottom, #1AAEA1, #007F74);
    border: 1px solid #086068;
    border-radius: 3px;
    color: #FFFFFF;
    float: left;
    font-family: arial,helvetica,sans-serif;
    font-size: 13px;
    font-weight: bold;
    margin-bottom: 4px;
    padding: 10px;
    text-align: center;
    text-shadow: -1px -1px 0 rgba(0, 0, 0, 0.3);
    width: 122px;
}
#submenushortcuts > li{
	background-color: white;
	background-image: url(http://gspedia.com/exclusiveprivatesale/images/standard/adminsubshortcuts.png);
	right: 0;
	width: 64px;
    height: 55px;
	-webkit-border-radius: 7px 0 0 7px;
	-moz-border-radius: 7px 0 0 7px;
	border-radius: 7px 0 0 7px;
    overflow: hidden;
    list-style: none;
	}
    
    #submenushortcuts li a{
        float: left;
        height: 100%;
        width: 100%;
    }
    #submenushortcuts{
        margin-left: 0.50em !important;
    }    
    .submenushortcuts-dealer{
background-position: -3px 136px;
}
.submenushortcuts-account{
 background-position: -1px -11px;   
}
.submenushortcuts-autobrand{
     background-position: -3px -82px;
}
    .submenushortcuts-dealer:hover{
        background-position: 63px 134px;
        }
        .submenushortcuts-account:hover{
        background-position: 67px -11px;
        }
        .submenushortcuts-autobrand:hover{
        background-position: -68px -82px;
        }
        .submenushortcuts-subadmin{
          background-position: -2px 64px;  
        }
        .submenushortcuts-subadmin:hover{
          background-position: 62px 64px;  
        }
</style>

<script src="http://gspedia.com/exclusiveprivatesale/js/libs/jquery-1.10.2.min.js"></script>

<script type="text/javascript">
var j = jQuery.noConflict();
jQuery.noConflict();
j(document).ready(function() {
  j('#registernew').click(function(){
     j("#Sellermenu1").show();
     //var title=j("#title_membership").attr('title', text);
     //alert(title);
     //j(this).removeAttr('title');
     j("#tooltips").hide();
   });
j('#Sellermenu1').mouseover(function(){
     j("#Sellermenu1").show();
     j("#tooltips").hide();
   });
   j('#registernew').mouseout(function(){
     j("#Sellermenu1").hide();
     j("#tooltips").show();     
   });
j('#Sellermenu1').mouseout(function(){
     j("#Sellermenu1").hide();
     j("#tooltips").show();
   });

});
</script>

    <script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="<? echo base_url()?>fancybox/jquery.fancybox.js?v=2.1.4"></script>
    <link rel="stylesheet" type="text/css" href="<? echo base_url()?>fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
     <script type="text/javascript"> 
     var j = jQuery.noConflict();           
        	j(document).ready(function() {
                var inboxload=0;
    			/*
    			 *  Simple image gallery. Uses default settings
    			 */
    			j('.fancybox').fancybox({
    			 beforeShow: function(){
                 j(".fancybox-skin").css("backgroundColor","transparent");
                    },
    				'width' : '400px',
    				'height' : '800px',
                    'scrolling'   : 'no',
    				'autoSize' : false,
    				'transitionIn' : 'none',
    				'transitionOut' : 'none',
    				'type' : 'iframe'
    			});
    			/*
    			*  Different effects
    			*/
    			// Change title type, overlay closing speed
    			j(".fancybox-effects-a").fancybox({
    				helpers : {
    					title : {
    						type : 'outside',
    					},
    					overlay : {
    						speedOut : 0
    					}
    				}
    			});
                });
                </script>
    <ul id="shortcuts" role="complementary" class="children-tooltip tooltip-right">
    <?php
   
    if($segment=='dashboard'){
        $current_class='current';
    }else{
        $current_class='';
    }
    if($get_usertype=='admin'){
    ?>
    <li class="<?=$current_class?>"><a href="<?=base_url()?>dashboard" class="shortcut-dashboard" title="Admin Panel">Admin Panel</a></li>
    <?php
    }else{
    ?>
        <li class="<?=$current_class?>"><a href="<?=base_url()?>dashboard" class="shortcut-dashboard" title="Dashboard">Dashboard</a></li>
        <?php
        }
        if($get_usertype=='admin' || $get_usertype=='sub_admin'){
            
         if($segment=='register'){
            //echo $segment; 
        $current_class='current';
    }else{
        $current_class='';
    } 
    
        ?>
        <li id="registernew" class="<?=$current_class?>"> <a href="javascript:void(0);" class="shortcut-messages " title="Create Membership" id="title_membership">Create Membership</a></li>
          <div id="Sellermenu1" >
          <ul id="submenushortcuts" role="complementary">
            <li class="submenushortcuts-dealer"><a href="<?=base_url()?>register/index/dealer" title="Create Dealer"></a></li>
            <li class="submenushortcuts-account"><a href="<?=base_url()?>register/index/account_managers" alt="Create Accounts Manager" title="Create Accounts Manager" ></a></li>
            <li class="submenushortcuts-autobrand"><a href="<?=base_url()?>register/index/auto_brand" title="Create Auto Brand" ></a></li>
            <li class="submenushortcuts-subadmin"><a href="<?=base_url()?>register/index/sub_admin" title="Create Subadmin" ></a></li>
        </ul> </div>
        <?php
        }if($get_usertype=='dealership' || $get_usertype=='account_managers'){
            if($segment=='upload')
            {
              $segment_class='current';  
            }
            else
            {
              $segment_class='';   
            }
        ?>
        <li class="<?=$segment_class?>"><a href="<?=base_url()?>upload" class="shortcut-contacts" title="Upload Dealer's Customer Database">Upload</a></li>
        <?php
        }
        ?>        
       <li><a href="<?=base_url()?>login/logout" class="shortcut-notes" title="Logout">Logout</a></li>
    </ul>
    <!-- Sidebar/drop-down menu -->
        <section id="menu" role="complementary">
        <!-- This wrapper is used by several responsive layouts -->
            <div id="menu-content">
                <header>
                <?=$user_type?>
                </header>
                <div id="profile">
                <img src="<?=base_url()?>images/user.png" width="64" height="64" alt="User name" class="user-icon">
                Hello
                    <?php
                    if(isset($menu['logged_in']['registration_id'])){
                    ?>
                        <span class="name"><?=ucfirst($menu['logged_in']['first_name'])?></span>
                    <?php
                    }
                    ?>
                </div>
              
                <!-- By default, this section is made for 4 icons, see the doc to learn how to change this, in "basic markup explained" -->
                    <ul id="access" class="children-tooltip">
                        <li><a href="<?=base_url()?>profile/index/<?=$user_id?>" title="Profile"><span class="icon-user"></span></a></li>
                    </ul>
               
                <section class="navigable" style="clear: both;">
                    <ul class="big-menu">
                        <li class="with-right-arrow">
                            <ul class="big-menu">
                            <?php
                             if($get_usertype=='account_managers'){
                                ?>
                               <li ><a href="<?=base_url()?>profile/index/<?=$user_id?>">Edit Profile</a></li> 
                                <?php
                                }
                                
                                if($get_usertype=='admin' || $get_usertype=='sub_admin'){
                                  
                                    if($segment=='register'){
                                        $current_class='current navigable-current';
                                    }else{
                                        $current_class='';
                                    }
                                ?>
                                <li ><a href="<?=base_url()?>register/membership" class="<?=$current_class?>">Create Membership</a></li>
                                <?php
                                }if($get_usertype=='dealership' || $get_usertype=='account_managers'){
                                ?>
                                <li><a href="<?=base_url()?>upload" title="Upload Dealer's Customer Database">Upload</a></li>
                                <?php
                                } if($segment=='dashboard'){
                                        $current_class='current navigable-current';
                                    }else{
                                        $current_class='';
                                    }
                                ?>
                                <li ><a href="<?=base_url()?>dashboard" class="<?=$current_class?>">Dashboard</a></li>
                                <!--<li><a href="<?=base_url()?>contact"  class="fancybox fancybox.iframe">Contact</a></li>-->
                                <li><a href="<?=base_url()?>login/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
               
            </div>
           
        </section>
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
