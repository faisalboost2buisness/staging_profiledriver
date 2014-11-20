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
    height: 161px;
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
    background-image: url(http://gspedia.com/exclusiveprivatesale/images/standard/subshortcuts.png);
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
    background-position: -3px 74px;
}
.submenushortcuts-account{
    background-position: -1px -11px;   
}
.submenushortcuts-autobrand{
    background-position: -3px -82px;
}
.submenushortcuts-dealer:hover{
    background-position: 62px 73px;
}
.submenushortcuts-account:hover{
    background-position: 67px -11px;
}
.submenushortcuts-autobrand:hover{
    background-position: -68px -82px;
}
.calendar-menu > li > a, li.calendar-menu > a {
    color: inherit;
    display: block;
    margin: -10px -10px -10px -50px;
    min-height: 16px;
    padding: 24px 14px 10px 16px;
}
.message-status {
    float: left;
    margin: -1px 0 0 -11px;
    text-align: center;
    width: 16px;
}
.panel-navigation {
    border-right: 1px solid #CCCCCC;
    bottom: 0;
    left: 69px;
    position: absolute;
    top: 55px;
    width: 249px;
}
</style>
<script src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>
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
<style type="text/css">
		.fancybox-inner {
			height: 313px !important;
		}
		#showinbox {
			background-color: black;
			border: 1px solid black;
			margin-left: -611px;
			margin-right: -100px;
			margin-top: 60px;
			opacity: 0.8;
			position: absolute;
			width: 690px;
			z-index: 1005;
		}
		#loadingimg {
			display: block;
			margin-left: 15px;
			margin-top: 48px;
			position: absolute;
		}
        
	</style>
<script type="text/javascript">         
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
<!--opening Side bar -->
<div style="clear: both;"></div>
    <ul id="shortcuts" role="complementary" class="children-tooltip tooltip-right">
        <?php
        if($segment=='dashboard' || $segment=='campaign' || $segment=='profile' || $segment=='upload'){
            $current_class='current';
        }else{
            $current_class='';
        }
        ?>
        <li class="<?=$current_class?>"><a href="<?=base_url()?>dashboard" class="shortcut-dashboard" title="Dashboard">Dashboard</a></li>
        <?php
        if($get_usertype=='admin' || $get_usertype=='sub_admin'){
        ?>
            <li id="registernew"><a href="javascript:void(0);" class="shortcut-messages" title="Create Membership" id="title_membership">Create Membership</a></li>
            <div id="Sellermenu1" >
                <ul id="submenushortcuts" role="complementary">
                    <li class="submenushortcuts-dealer"><a href="<?=base_url()?>register/index/dealer" title="Create Dealer"></a></li>
                    <li class="submenushortcuts-account"><a href="<?=base_url()?>register/index/account_managers" alt="Create Accounts Manager" title="Create Accounts Manager" ></a></li>
                    <li class="submenushortcuts-autobrand"><a href="<?=base_url()?>register/index/auto_brand" title="Create Auto Brand" ></a></li>
                </ul> 
            </div>
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
            <?php
            if(isset($dealerdashboard) && $dealerdashboard!='')
            {
                $dealer_usertype=$dealerdashboard;
                $get_userdetails=$this -> main_model -> user_data($dealerdashboard);
                foreach($get_userdetails as $dealer_details){
                    $dealer_details['first_name'].' '.$dealer_details['last_name'];
                    echo $dealer_details['first_name'].' '.$dealer_details['last_name'];
                }
            }
            ?>
            </header>
            <div id="profile">
            <?php
            //dealerlogo
            if(isset($dealerdashboard) && $dealerdashboard!='')
                {
                $dealerlogo=$this -> main_model -> get_dealer_logo($dealerdashboard);
                if($dealerlogo!='')  
                    {
                    foreach($dealerlogo as $key=>$value)
                        {
                        if($value['make_image']!='')
                            {
                            ?>
                                <img src="<?=base_url()?>make-image/<?=$value['make_image']?>" width="64" height="64" class="user-icon" style="margin:-11px 10px 0 -1px">  
                            <?php
                            }
                            else
                            {
                            ?>
                                <img src="<?=base_url()?>make-image/no-logo.png" width="64" height="64" class="user-icon" style="margin:-10px 10px 0 -2px"/>  
                            <?php
                            }
                        }
                    }
                    else
                    {
                    ?>
                    <img src="<?=base_url()?>images/user.png" width="64" height="64" class="user-icon" style="margin:-10px 10px 0 -2px"/>  
                    <?php
                    }
                }
                else
                {
                ?>
                    <img src="<?=base_url()?>images/user.png" width="64" height="64" alt="User name" class="user-icon" style="margin:-10px 10px 0 -2px"/>
                <?php
                }
                ?>
            Hello
            <?php
            if(isset($menu['logged_in']['registration_id'])){
            ?>
                <span class="name"><?=ucfirst($menu['logged_in']['first_name'])?></span>
            <?php
            }
            ?>
            </div>
            <ul class="unstyled-list">
                <li class="back">My EPS Team</li>
                <li>
                    <ul class="calendar-menu">
                    <?php
                    $manager_details=$this -> settings_model->dealers_assigned_managers($dealerdashboard);
                        if(isset($manager_details) && is_array($manager_details)){
                            foreach($manager_details as $manager_value){
                                $manager_ids=$manager_value['user_id'];
                                $get_managerdetails=$this -> main_model -> user_data($manager_ids);
                                foreach($get_managerdetails as $manager_detail){
                                    $manager_detail['first_name'].' '.$manager_detail['last_name'];
                                    $name=$manager_detail['first_name'].' '.$manager_detail['last_name'];
                                    ?>
                                        <li>
                                            <a href="<?=base_url()?>dashboard/account_mangercontact_details/<?=$manager_ids?>" class="fancybox fancybox.iframe">
                                            <?php echo $name?>
                                            </a>
                                        </li>
                                <?php
                                }
                            }
                        }else{
                        ?>
                        <li>
                            <a href="#"  title="Manager">
                            Not assigned
                            </a>
                        </li> 
                        <?php
                        }
                    ?>
                    </ul>
                </li>
                <li class="title-menu"></li>
                <li>
                    <ul class="message-menu">
                    <li>
                        <span class="message-status">
                        <span class="unstarred">Not starred</span>
                        </span>
                        <strong class="blue">Got an idea?</strong><br/><br/>
                        Tell us
                    </li>
                    </ul>
                </li>
                <li class="back">Your Upcoming Sales Event</li>
                <?php               
                $get_events=$this->settings_model->get_event_details($dealerdashboard);
                $start_date=date('M j, Y',strtotime($get_events[0]['event_start_date']));
                $last_date=date('M j, Y',strtotime($get_events[0]['event_end_date']));              
                $customer_data=$this -> main_model -> customerdata($dealerdashboard);
                $count=0;
                if(isset($customer_data) && $customer_data!='')
                {
                    $count=count($customer_data);
                }
                ?>
                <li>
                    <ul class="message-menu">
                        <li style="min-height: 18px;padding: 14px 65px 2px 22px;">
                            <span class="new-message" style="float: left;">New</span>
                            <strong class="blue">Sales Event Date</strong><br/><br/>
                            <span class="message-info" style="width: 84px;margin-top: 5px;">
                            <span class="blue"><?php echo $start_date;?></span>
                            </span>
                        </li>
                    </ul>
                </li>
                <li>
                    <ul class="message-menu">
                        <li style="min-height: 18px;padding: 14px 65px 2px 22px;">
                            <span class="new-message" style="float: left;">New</span>
                            <strong class="blue">EPS Advantage Invites Sent</strong><br/><br/>
                            <span class="message-info" style="width: 84px;">
                            <span class="blue"><?php echo $count*5;?></span>
                            </span>
                        </li>
                    </ul>
              </li>
                <li>
                <ul class="message-menu">
                    <li style="min-height: 18px;padding: 14px 65px 2px 22px;">
                        <span class="new-message" style="float: left;">New</span>
                        <strong class="blue">Last Event Sales</strong><br/><br/>
                        <span class="message-info" style="width: 84px;margin-top: 5px;">
                        <span class="blue"><?php echo $last_date;?></span>
                        </span>
                    </li>
                </ul>
                </li>
            </ul>
        <section class="navigable" style="clear: both;">
            <ul class="big-menu">
                <li class="with-right-arrow">All Events
                    <ul class="big-menu">
                    <?php
                    if($segment=='campaign' || $segment=='dashboard'){
                        $current_class='current navigable-current';
                    }else{
                        $current_class='';
                    }
                    if($segment=='profile'){
                        $current_classprofile='current navigable-current';
                    }else{
                        $current_classprofile='';
                    }
                     if($segment=='upload'){
                        $current_classupload='current navigable-current';
                    }else{
                        $current_classupload='';
                    }
                    ?>
                        <li><a href="<?=base_url()?>dashboard" class="<?=$current_class?>">Dashboard</a></li>
                        <li><a href="<?=base_url() ?>profile/<?=$dealerdashboard?>" title="Edit Profile" class="<?=$current_classprofile?>">Edit Profile</a></li>   
                        <li><a href="#" title="Reports" class="">Reports</a></li>
                        <li><a href="<?=base_url() ?>upload" title="File Browser" class="<?=$current_classupload?>">File Browser</a></li>
                        <li><a href="<?=base_url()?>login/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        </div>
    </section>
<!-- Scripts -->
<script src="<? echo base_url()?>js/libs/jquery-1.10.2.min.js"></script>
<script src="<? echo base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<? echo base_url()?>js/developr.input.js"></script>
<script src="<? echo base_url()?>js/developr.navigable.js"></script>
<script src="<? echo base_url()?>js/developr.notify.js"></script>
<script src="<? echo base_url()?>js/developr.scroll.js"></script>
<script src="<? echo base_url()?>js/developr.tooltip.js"></script>
<script src="<? echo base_url()?>js/developr.modal.js"></script>
<!-- glDatePicker -->
<script src="<? echo base_url()?>js/libs/glDatePicker/glDatePicker.min.js?v=1"></script>
<!-- jQuery Form Validation -->
<script src="<? echo base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<? echo base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
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
// Demo Iframe loading
function openIframe()
{
$.modal({
title: 'Iframe content',
url: 'http://www.envato.com',
useIframe: true,
width: 600,
height: 400
});
}
</script>
<script>
var jQuery17 = jQuery.noConflict();
</script>