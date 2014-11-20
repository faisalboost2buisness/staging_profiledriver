<style>
    .four-columns {
        float: left;
        width: 44.083%;
        margin-left: 20px;
        margin-right: 20px;
    }
    .body{
        color:#444;
    }
    .input{
        margin-left: 4px;
    }
</style>
<style>

/*form styles*/
#msform {
    margin-top: 46px;
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
    padding: 16px;
    border: 1px solid grey; 
    float: left; 
    border-radius: 23px; 
    width: 27%;
    height:127px;
    margin-right:10px;
}

</style>
<script type='text/JavaScript' src='<?=base_url()?>js/jacs.js'></script>

<!--Campign page starts here-->
    <div class="panel-navigation silver-gradient" style="top: 65px;">
        <div id="panel-nav" class="panel-load-target scrollable" style="height:490px;width: 98.5%;">
            <div class="navigable">
                <ul class="unstyled-list open-on-panel-content">
                    <li class="title-menu">Event Build Process</li>
                    <li class="big-menu grey-gradient with-right-arrow">
                        <span><span class="list-count">+</span>Date & Marketing</span>
                            <ul class="message-menu">
                                <li>
                                    <span class="message-status">
                                        <a href="#" class="starred" title="starred">starred</a>
                                    </span>
                                   
                                    <a href="#" title="Read message">
                                    <strong class="blue">Date & Marketing</strong><br/>
                                  
                                    </a>
                                </li>
                               
                            </ul>
                    </li>
                    <li class="big-menu grey-gradient with-right-arrow">
                    <span><span class="list-count">+</span>Lead Selection</span>
                        <ul class="message-menu">
                            <li class="message-menu">
                                <span class="message-status">
                                    <a href="#" class="starred" title="starred">starred</a>
                                    <a href="#" class="new-message" title="Choose List File">Choose List File</a>
                                    <a href="#" class="new-message" title="Lead Filtering">Lead Filtering</a>
                                    <a href="#" class="new-message" title="Custom Options">Custom Options</a>
                                </span>
                                <span class="message-info">
                                    <span class="blue">Feb 5</span>
                                </span>
                                <a href="#" title="EPS Advantage">
                                    <strong class="blue">EPS Advantage</strong><br>
                                    <strong>Choose List File</strong><br />
                                    <strong>Lead Filtering</strong><br />
                                    <strong>Custom Options</strong>
                                </a>
                            </li>
                            <li class="message-menu">
                                <span class="message-status">
                                    <a href="#" class="starred" title="starred">starred</a>
                                    <a href="#" class="new-message" title="Paper 1">New</a>
                                    <a href="#" class="new-message" title="Paper 2">New</a>
                                    <a href="#" class="new-message" title="Paper 3">New</a>
                                </span>
                                <span class="message-info">
                                    <span class="blue">Jan 28</span>
                                </span>
                                <a href="#" title="Conquest Mailers">
                                    <strong class="blue">Conquest Mailers</strong><br/>
                                    <strong>Paper 1</strong><br />
                                    <strong>paper 2</strong><br />
                                    <strong>Paper 3</strong>
                                </a>
                            </li>
                            <li class="message-menu">
                                <span class="message-status">
                                    <a href="#" class="starred" title="starred">starred</a>
                                    <a href="#" class="new-message" title="Target Options">Target Options</a>
                                </span>
                                <span class="message-info">
                                    <span class="blue">Jan 28</span>
                                </span>
                                <a href="#" title="Upgrader Letters">
                                    <strong class="blue">Upgrader Letters</strong><br>
                                    <strong>Target Options</strong>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="big-menu grey-gradient with-right-arrow">
                    <span><span class="list-count">+</span>Mailer Option</span>
                        <ul class="message-menu">
                            <li class="message-menu">
                                <span class="message-status">
                                    <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <span class="message-info">
                                    <span class="blue">Feb 5</span>
                                </span>
                                <a href="#" title="Read message">
                                    <strong class="blue">May Starck</strong><br>
                                    Another subject
                                </a>
                            </li>
                            <li class="message-menu">
                                <span class="message-status">
                                    <a href="#" class="unstarred" title="Not starred">Not starred</a>
                                </span>
                                <span class="message-info">
                                    <span class="blue">Jan 28</span>
                                </span>
                                <a href="#" title="Read message">
                                    <strong class="blue">May Starck</strong><br>
                                    Old subject
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div id="panel-content" class="panel-load-target scrollable with-padding" style="height:auto;position: relative; float: left; top: 49px; left: 298px; width: 57%;">
        <form id="msform">
            <h2 class="thin mid-margin-bottom" style="color:gray;margin-left: 20px;">READY TO BUILD YOUR EVENT?</h2>
            <div class="mailertextarea" style="width: 95%;margin-left: 20px;">
                <div class="with-padding" style="margin-top: 15px;margin-bottom: 27px;">
                    <label style="float: left;margin-right:10px;margin-top: 13px;">PICK EVENT DATES  </label>
                    <input type="text" name="" style="width: 30%; height: 15px;margin: 0px;float: left;margin-right:10px;" onclick="JACS.show(this,event);"/>&nbsp;&nbsp;
                    <input type="text" name="" style="width: 30%; height: 15px;margin: 0px;float: left;margin-right:10px;" onclick="JACS.show(this,event);"/>                   
                </div>               
            </div>
            <div class="mailertextarea" style="width: 95%; margin-left: 20px;">
                <h4 style="text-align: center;">CHOOSE ADVERTISING OPTIONS</h4><br />
                <div class="image1">
                    <img src="<?=base_url()?>images/standard/image11.jpg" style="width: 100%;"/>
                    <div class="reporttype" style="text-align: center;">
                    </div>
                </div>
                <div class="image1">
                    <img src="<?=base_url()?>images/standard/image12.jpg" style="width: 100%;"/>
                    <div class="reporttype" style="text-align: center;">
                    </div>
                </div>
                <div class="image1" style="margin-right: 0px;">
                    <img src="<?=base_url()?>images/standard/image13.jpg" style="width: 100%;"/>
                    <div class="reporttype" style="text-align: center;">
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
        </form>  
    </div>
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