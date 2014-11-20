<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<style>
/*custom font*/
@import url(http://fonts.googleapis.com/css?family=Montserrat);
/*basic reset*/
* {margin: 0; padding: 0;}
html {
	height: 100%;
	/*Image only BG fallback*/
	background: url('<?=base_url()?>images/standard/gs.png');
	/*background = gradient + image pattern combo*/
	background: 
		linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
		url('<?=base_url()?>images/standard/gs.png');
}
/*form styles*/
#msform {
    margin-top: 86px;
    position: relative;
    text-align: center;
    width: 96%;
     margin-bottom: 85px;
}
#msform fieldset {
	background: white;
	border: 0 none;
	border-radius: 3px;
	box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
	padding: 20px 30px;
	box-sizing: border-box;
	width: 80%;
	margin: 0 10%;
	/*stacking fieldsets above each other*/
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}
/*inputs*/
#msform input, #msform textarea {
	padding: 15px;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: montserrat;
	color: #2C3E50;
	font-size: 13px;
}
/*buttons*/
#msform .action-button {
	width: 100px;
	background: #27AE60;
	font-weight: bold;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px 5px;
	margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/
.fs-title {
	font-size: 15px;
	text-transform: uppercase;
	color: #2C3E50;
	margin-bottom: 10px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: white;
	text-transform: uppercase;
	font-size: 9px;
	width: 33.33%;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 20px;
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: white;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #27AE60;
	color: white;
}
 .imagefirst{
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    border: 1px solid grey; 
    float: left; 
    border-radius: 23px; 
    width: 46%;
    height:284px;
}
.imagesecond{
    border: 1px solid #808080;
    border-radius: 23px;
    float: right;
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    width: 46%;
    height: 284px;
}
.reporttype{
    text-align: left;
    width: 90%;
}
ul, ol {
    margin-left: 21.8em;
}
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.2); /* IE */
  -moz-transform: scale(1.2); /* FF */
  -webkit-transform: scale(1.2); /* Safari and Chrome */
  -o-transform: scale(1.2); /* Opera */
}
.image1{
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    border: 1px solid grey; 
    float: left; 
    border-radius: 23px; 
    width: 27%;
    height:170px;
    margin-left: 2%;
}
.image2{
    border: 1px solid #808080;
    border-radius: 23px;
    float: left;
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    width: 27%;
    height: 170px;
    margin-left: 4%;
}
.image3{
    border: 1px solid #808080;
    border-radius: 23px;
    float: right;
    padding-bottom: 16px;
    padding-left: 15px;
    padding-top: 5px;
    width: 27%;
    height: 170px;
    margin-right: 2%;
}
</style>
<style>
.four-columns {
    float: left;
    width: 44.083%;
    margin-left: 20px;
    margin-right: 20px;
}
.body
{
    color:#444;
}
.input 
{
    margin-left: 4px;
}
</style>
<div class="panel-navigation silver-gradient" style="margin-top: 65px; margin-left: 69px;">
    <div id="panel-nav" class="panel-load-target scrollable" style="height:490px;width: 98.5%;">
        <div class="navigable">
            <ul class="unstyled-list open-on-panel-content">
                <li class="big-menu grey-gradient with-right-arrow">
                <span><span class="list-count">+</span>Date & Marketing</span>
                    <!--<ul class="message-menu">
                        <li>
                            <span class="message-status">
                                <a href="#" class="unstarred" title="Not starred">Not starred</a>
                            </span>
                            <span class="message-info">
                                <span class="blue">Mar 5</span>
                            </span>
                            <a href="#" title="Read message">
                                <strong class="blue">EPS Advantage</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <span class="message-status">
                            <a href="#" class="unstarred" title="Not starred">Not starred</a>
                            </span>
                            <span class="message-info">
                            <span class="blue">Feb 15</span>
                            </span>
                            <a href="#" title="Read message">
                            <strong class="blue">Choose List File</strong>
                            </a>
                        </li>
                        <li>
                            <span class="message-status">
                                <a href="#" class="unstarred" title="Not starred">Not starred</a>
                            </span>
                            <span class="message-info">
                                <span class="blue">Mar 5</span>
                            </span>
                            <a href="#" title="Read message">
                                <strong class="blue">Lead Filtering</strong>
                            </a>
                        </li>
                        <li>
                            <span class="message-status">
                                <a href="#" class="unstarred" title="Not starred">Not starred</a>
                            </span>
                            <span class="message-info">
                                <span class="blue">Mar 5</span>
                            </span>
                            <a href="#" title="Read message">
                                <strong class="blue">Custom Options/Review</strong>
                            </a>
                        </li>
                    </ul>-->
                </li>
                <li class="big-menu grey-gradient with-right-arrow">
                <span><span class="list-count">+</span>Lead Selection</span>
                    <ul class="message-menu">
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">EPS Advantage</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                            <strong class="blue">Choose List File</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Lead Filtering</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Custom Options/Review</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Conquest Mailers</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Part 1</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Part 2</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Part 3</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Upgrader Letters</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Target Options</strong>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="big-menu grey-gradient with-right-arrow">
                <span><span class="list-count">+</span>Mailer Options</span>
                    <ul class="message-menu">
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Mailer Options</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">EPS Advantage</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Choose Mailer Size</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Confirm Versioning</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Extra Options</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Conquest Mailers</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Choose Size</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Extra options</strong>
                            </a>
                        </li>
                        <li class="message-menu">
                            <a href="#" title="Read message">
                                <strong class="blue">Upgrader Letters</strong>
                            </a>
                        </li>
                        </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<section role="main" id="main">
    <!-- multistep form -->
    <form id="msform">
        <!-- fieldsets -->
        <fieldset id="step1" style="margin-left: 27%; width: 69%;">
            <div class="with-padding" >
                <h4 style="color:#666666;">READY TO BUILD YOUR EVENT?</h4>
                <div class="mailertextarea" style="width: 100%;">
                    <span style="color: #666666;"><b>PICK EVENT DATES</b></span>&nbsp;&nbsp; 
                    <input type="text" name="" style="width: 34%; height: 15px;margin: 0px;"/>&nbsp;&nbsp;
                    <input type="text" name="" style="width: 34%; height: 15px;margin: 0px;"/>
                </div>
                <div class="mailertextarea" style="width: 100%;">
                    <h4 style="text-align: center;">CHOOSE ADVERTISING OPTIONS</h4><br />
                    <div class="image1">
                        <!--<h4 style="color:#666666;padding-top: 10px; padding-bottom: 14px;">Small Invite (5.5x4.25")</h4>-->
                        <div style="padding-top: 23%; margin-left: -8%;">
                            <img src="<?=base_url()?>images/standard/image11.jpg" style="height: 100px; width: 99%;"/>
                        </div>
                        <div class="reporttype" style="text-align: center;">
                            <!--<input type="radio" name="report" value="type1" style="width: 24px;"/>
                            <label style="color: grey;">Small Invite Size</label>-->
                        </div>
                    </div>
                    <div class="image2">
                        <!--<h4 style="color:#666666;padding-top: 10px; padding-bottom: 14px;">Large Invite (8.5x5.5")</h4>-->
                        <div style="padding-top: 23%; margin-left: -8%;">
                            <img src="<?=base_url()?>images/standard/image12.jpg" style="width: 99%; height: 100px;"/>
                        </div>
                        <div class="reporttype" style="text-align: center;">
                            <!--<input type="radio" name="report" value="type1" style="width: 24px;"/>
                            <label style="color: grey;">Large Invite Size</label>-->
                        </div>
                    </div>
                    <div class="image3">
                        <!--<h4 style="color:#666666;padding-top: 10px; padding-bottom: 14px;">Large Invite (8.5x5.5")</h4>-->
                        <div style="margin-left: -8%; padding-top: 7%;">
                            <img src="<?=base_url()?>images/standard/image13.jpg" style="height: 100px; margin-top: 15%; width: 99%;"/>
                        </div>
                        <div class="reporttype" style="text-align: center;">
                            <!--<input type="radio" name="report" value="type1" style="width: 24px;"/>
                            <label style="color: grey;">Large Invite Size</label>-->
                        </div>
                    </div>
                    <div>
                        <div style="float: left; margin-left:10%;">
                            <label>CONQUEST</label><br /><input type="checkbox" name=""/>
                        </div>
                        <div style="float: left; margin-left: 22%;">
                            <label>EPS ADVANTAGE</label><br /><input type="checkbox" name="" checked/>
                        </div>
                        <div style="float: right; margin-right: 10%;">
                            <label>UPGRADER</label><br /><input type="checkbox" name=""/>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div style="clear: both;height: 10px;"></div>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
        </fieldset>
        <fieldset id="step2">
            <div class="with-padding" >
                <h4 style="color:#666666;"> Step 2 - Versioning</h4>
                <label style="color: grey;float: left; text-align: left;margin-bottom: 10px;">Part of the EPS Advantage is being able to send the right mailer to the right lead. It's how we drive more sales and give your dealership the best ROI on it's advertising. By default we will create a version of your mailout for each group in your campaign. If you would like everyone to get the same mailer you can opt-out of our Versioning below.</label>
                <div class="reporttype" style="text-align: center;">
                    <input type="checkbox" checked="" name="report" value="type1" style="width:4%;"/>
                    <label class="cost_version">$300($75*4)</label>
                </div>
            </div>      
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous" name="previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
        </fieldset>
        <fieldset id="step3">
            <div class="with-padding" >
                <h4 style="color:#666666;">Step 3 - Special Options</h4>
                <label style="color: grey;float: left; text-align: left;margin-bottom: 10px;">The following options can be added to your campaign. These are proven methods at creating a mail out that will get more attention, and drive more potential customers into your dealership.</label>
                <div style="width: 100%;float:left">
                    <div class="reporttype">
                        <input type="checkbox" name="report" value="type1" style="width: 31px;"/>
                        <label style="color: grey;" >AutoPen ($0.36/piece)<span class="icon-question glossy with-tooltip tooltip-right" style="padding-left:11px;" title="AutoPen ($0.36/piece)" data-tooltip-options='{"classes":["green-gradient","glossy"]}'>&nbsp;</span></label>
                    </div>
                    <div class="reporttype">
                        <input type="checkbox" name="report" value="type1" style="width: 31px;"/>
                        <label style="color: grey;">Insert - Cardstock ($0.60/piece)<span class="icon-question glossy with-tooltip tooltip-right" style="padding-left:11px;" title="Insert - Cardstock ($0.60/piece)" data-tooltip-options='{"classes":["green-gradient","glossy"]}'>&nbsp;</span></label>
                    </div>
                    <div class="reporttype">
                        <input type="checkbox" name="report" value="type1" style="width: 31px;"/>
                        <label style="color: grey;"> Insert - Paperstock ($0.55/piece)<span class="icon-question glossy with-tooltip tooltip-right" style="padding-left:11px;" title="Insert - Paperstock ($0.55/piece)" data-tooltip-options='{"classes":["green-gradient","glossy"]}'>&nbsp;</span></label>
                    </div>
                    <div class="reporttype">
                        <input type="checkbox" name="report" value="type1" style="width: 31px;"/>
                        <label style="color: grey;"> Variable Imaging ($0.20)<span class="icon-question glossy with-tooltip tooltip-right" style="padding-left:11px;" title="Variable Imaging ($0.20)" data-tooltip-options='{"classes":["green-gradient","glossy"]}'>&nbsp;</span></label>
                    </div>
                    <div class="reporttype">
                        <input type="checkbox" name="report" value="type1" style="width: 31px;"/>
                        <label style="color: grey;"> Colored Envelopes ($0.15 each)
                        Desired Color<span class="icon-question glossy with-tooltip tooltip-right" style="padding-left:11px;" title="Colored Envelopes ($0.15 each) Desired Color" data-tooltip-options='{"classes":["green-gradient","glossy"]}'>&nbsp;</span></label>
                    </div>
                </div>  
            </div>  
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous" name="previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
        </fieldset>
        <fieldset id="step5"  class="stepfour">
            <h4 style="color:#666666;">Step 4 - The Upgrader Package</h4>
            <div style="text-align: center; margin: 0px auto; width: 97%;float: left;">
                <p class="inline-small-label button-height" style="width: 100%; float: left;">
                <label for="validation-required" class="label" style="padding-top: 0px; width: 100%; text-align: left;font-weight: normal;">Increase your conversion rate even more with out unique upgrade package. In addition to the regular EPS invite mailer we also send out a personalized letter with a message about upgrading their vehicle at the private event.A personalized web address is included for each client that receives a letter that provides the trade in value of their vehicle and an option to register for the Private Sales Event.</label></p>
                <input type="checkbox" name="upgrade_package" value="upgrade_package" style="width:2%;"/>
                <label style="color: grey;">Upgrader Package</label>
            </div>
            <div style="clear: both;height: 10px;"></div>
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="button" class="next  button glossy mid-margin-right" value="Next" name="next">
                <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
                Next
            </button>
            <input type="hidden" name="select_campine" id="select_campine" value=""/>
        </fieldset>
        <fieldset id="step4">
            <h4 style="color:#666666;">Step 5 - Review Your Order</h4>
            <button type="button" class="submit button glossy mid-margin-right" >
                <span class="button-icon red-gradient"><span class="icon-down-fat"></span></span>
                <a href="">Download</a>
            </button>
            <div style="clear: both;height:10px"></div>
            <button type="button" class="previous  button glossy mid-margin-right" value="Previous" name="previous">
                <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
                Previous
            </button>
            <button type="submit" class="submit button glossy mid-margin-right" onclick="validation();">
                <span class="button-icon"><span class="icon-tick"></span></span>
                Submit
            </button>
        </fieldset>
    </form>
</section>
<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script>
$( document ).ready(function() {
    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    $(".next").click(function(){
        if(animating) return false;
        animating = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });
    $(".previous").click(function(){
        if(animating) return false;
        animating = true;
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        //show the previous fieldset
        previous_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });
    $(".submit").click(function(){
        return false;
    });
});
function redirectpage(){
    $("#step1").show();
    $("#step2").hide();
    $("#step3").hide();
    $("#step4").hide();
    $("#step5").hide();
    $("#versioning").removeClass("active");
    $("#scale_campaigns").addClass("active");
    $("#special_option").removeClass("active");
    $("#upgradepricing").removeClass("active");
    $("#review").removeClass("active"); 
    $("#step1").css({'opacity':1, 'transform':'scale(1)'});
}
function redirectpageversion(){
    $("#step1").hide();
    $("#step2").show();
    $("#step3").hide();
    $("#step4").hide();
    $("#step5").hide();
    $("#versioning").addClass("active");
    $("#scale_campaigns").addClass("active");
    $("#special_option").removeClass("active");
    $("#review").removeClass("active"); 
    $("#upgradepricing").removeClass("active");
    $("#step2").css({'opacity':1, 'transform':'scale(1)'});   
}
function specialoption(){
    $("#step1").hide();
    $("#step2").hide();
    $("#step3").show();
    $("#step4").hide();
    $("#step5").hide();
    $("#special_option").addClass("active");
    $("#versioning").addClass("active");
    $("#scale_campaigns").addClass("active");
    $("#upgradepricing").removeClass("active");
    $("#review").removeClass("active"); 
    $("#step3").css({'opacity':1, 'transform':'scale(1)'});   
}
function reviewoption(){
    $("#step1").hide();
    $("#step2").hide();
    $("#step3").hide();
    $("#step5").hide();
    $("#step4").show();
    $("#special_option").addClass("active");
    $("#versioning").addClass("active");
    $("#scale_campaigns").addClass("active");
    $("#review").addClass("active");
    $("#upgradepricing").addClass("active");
    $("#step4").css({'opacity':1, 'transform':'scale(1)'});   
}
function upgradepricing(){
    $("#step1").hide();
    $("#step2").hide();
    $("#step3").hide();
    $("#step4").hide();
    $("#step5").show();
    $("#special_option").addClass("active");
    $("#versioning").addClass("active");
    $("#scale_campaigns").addClass("active");
    $("#upgradepricing").addClass("active");
    $("#review").removeClass("active");
    $("#step5").css({'opacity':1, 'transform':'scale(1)'});      
}
</script>