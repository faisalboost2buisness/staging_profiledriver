    <link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
    <style>
        /*custom font*/
        @import url(http://fonts.googleapis.com/css?family=Montserrat);
            /*basic reset*/
            * {margin: 0; padding: 0;}
            html {
            height: 100%;
            /*Image only BG fallback*/
            background: url('http://thecodeplayer.com/uploads/media/gs.png');
            /*background = gradient + image pattern combo*/
            background: 
            linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
            url('http://thecodeplayer.com/uploads/media/gs.png');
            }
         
        /*form styles*/
        #msform {
            width: 63%;
            margin: 84px auto;
            text-align: center;
            position: relative;
        }
        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            box-sizing: border-box;
            margin: 0 ;
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
            #progressbar1 {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
        }
        #progressbar1 li {
            list-style-type: none;
            color: white;
            text-transform: uppercase;
            font-size: 9px;
            width: 33.33%;
            float: left;
            position: relative;
        }
        #progressbar1 li:before {
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
        #progressbar1 li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }
        #progressbar1 li:first-child:after {
            /*connector not needed before the first step*/
            content: none; 
        }
        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar1 li.active:before,  #progressbar li.active:after{
            background: #27AE60;
            color: white;
        }
        .reporttype{
           
             float: left;
    line-height: 12px;
    margin: 6px 0;
    width: 100%;
        }
        .reportlabel{
            
            float: left;
        }
        .inline-small-label{
            margin-bottom:10px;
            padding-left: 39px;
        }
        #msform input, #msform textarea{
            padding:8px;
            width: 43%;
        }
        p.button-height, ul.button-height, ol.button-height{
            margin-bottom: 4px;
            padding-left: 13px;
        }
        .inline-small-label > .label {
            display: block;
            float: left;
            font-weight: bold;
            margin-left: 2px;
            text-align: left;
            width: 168px;
            padding-bottom: 3px;
        }
        ul, ol {
    margin-left: 8.8em;
}
  .events
  {
  float: left;
  font-size: 16px;
  text-align: right;
  width: 52%;
  margin-left: 100px !important;
  }
  .input{
            float:left;
            
        }
.tabs-content
{
    margin-bottom: 10px;
}

    </style>
    <section role="main" id="main">
    <!-- multistep form -->
   <?php
   if(isset($dealer_id_upload_data))
   {
   if($dealer_id_upload_data!='')
   {
        $dealerid_get=$dealer_id_upload_data;            
   }
   else
   {
    $dealerid_get='';   
   }
   }
   else
   {
    $dealerid_get='';
   }
   ?>
    <form id="msform"  method="post" action="<?=base_url()?>campaign/customerlist/<?=$dealerid_get?>" id="form-login">
    <input type="hidden"  id="select_campine" value=""/>
    <!-- progressbar -->
        <ul id="progressbar" class="processbar-custom-campaine" style="display: none;">
            <li class="active" style="color: black;width: 111px;" onclick="changefirsttabs();" id="stepfirstlist" style="cursor: pointer;"><a href="javascript:void(0);">Step 1</a></li>
            <li style="color: black;width: 103px;" onclick="changesecondtabs();" id="steptwolist" class="" ><a href="javascript:void(0);">Step 2</a></li>
            <li style="color: black;width: 122px;" onclick="changethirdtabs();" id="stepthreelist" style="cursor: pointer;"><a href="javascript:void(0);">Step 3</a></li>
            
        </ul>
         <ul id="progressbar1" class="processbar-campaine" >
            <li class="active" style="color: black;width: 111px;" onclick="changefirsttabscampine();" id="stepfirstlistcampine" style="cursor: pointer;"><a href="javascript:void(0);">Step 1</a></li>
            <li style="color: black;width: 103px;" onclick="changesecondtabscampine();" id="steptwolistcampine" class="" ><a href="javascript:void(0);">Step 2</a></li>
            
            
        </ul>
     <!-- fieldsets -->
        <fieldset id="stepfirst" class="stepfirst">
          
                <div class="with-padding">
                
                <h3 style="color:#666666;">EPS ADVANTAGE LEAD MINING SETTINGS</h3>
                    <p class="inline-small-label button-height">
                    <label for="validation-select" class="label events" >Lead Mining Presets</label>
                        <span style="float: left;"><select id="configuredcamp" name="validation-select" class="select"  style="width: 39%;" onchange="displaystepdevice(this.value);">
                            <option value="" style="width: 44%;">Please select</option>
                            <option value="equity-scrape">Equity Scrape</option>
                            <option value="model-breakdown">Model Breakdown</option>
                            <option value="effiecency">Fuel Efficiency</option>
                            <option value="warranty_scrape">Warranty Scrape</option>
                            <option value="custom_campaign">Advanced Options</option>
                        </select></span>
                    </p>
                <div style="clear: both;height:10px"></div>
                <h5 class="event_subtext">Past Vechicle Purchase Date Range</h5>
                    <p class="inline-small-label button-height" >
                        <label style="color: gray; font-weight: bold;">From</label>
                        <select id="validation-select" name="validation-select" class="select validate"  style="width: 61px;padding-right: 4px;">
                            <?php
                            for($i=2;$i<=5;$i=$i+0.5){
                            ?>
                                <option value="$i" <?php echo $i=='2' ? ' selected ':''; ?>><?=$i?></option>
                            <?php
                            }
                            ?>
                        
                        </select>
                        <label style="color: gray; font-weight: bold;">To</label>
                        <select id="validation-select" name="validation-select" class="select validate"  style="width: 61px;padding-right: 4px;">
                            <?php
                            for($i=2.5;$i<=6;$i=$i+0.5){
                            ?>
                                <option value="$i" <?php echo $i=='2.5' ? ' selected ':''; ?>><?=$i?></option>
                            <?php
                            }
                            ?>
                        
                        </select>
                        <label style="color: gray; font-weight: bold;">Years Ago</label>
                    </p>
                </div>
           
        <button type="button" class="next  button glossy mid-margin-right" value="Next" onclick="configuredcampaign();validation();">
        <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
        <label id="showsteps">Step 2 of 2</label> 
        </button>
        
        </fieldset>
       
        
        <fieldset style="width:100%"  id="steptwo" class="steptwo">
            <div  class="standard-tabs margin-bottom" id="add-tabs">
              
                    <ul class="tabs">
                        <li class="active" id="selecttab1"><a href="javascript:(void)" onclick="select_tab('tab1');">1st Lead Group</a></li>
                        <li id="selecttab2"> <a href="javascript:(void)" onclick="select_tab('tab2');"> 2nd Lead Group</a></li>
                        <li id="selecttab3"><a href="javascript:(void)" onclick="select_tab('tab3');">3rd Lead Group</a></li>
                        <li id="selecttab4"><a href="javascript:(void)" onclick="select_tab('tab4');">4th Lead Group</a></li>
                        <li id="selecttab5"><a href="javascript:(void)" onclick="select_tab('tab5');">5th Lead Group</a></li>
                    
                    </ul>
                    <!--tab1-->
                <div class="tabs-content" style="float: left;" id="tab-1">
                    <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                        <label  class="reportlabel"><h4>Select Your Report Type</h4></label>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Vehicle_class"style="width: 31px;float: left;" checked="checked" onclick="showreportchangevalue(this.value)"/>Vehicle Class</label>
                            
                        </div>
                        <div class="reporttype"> 
                                                      
                            <label  class="label report_text"><input type="radio" name="report" value="Drive_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/> Drive Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fuel_economy" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Economy</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Trade_in_value" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Trade In Value</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Out_warranty" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Out of Warranty</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" style="width: 80%;float:left" ><input type="radio" name="report" value="Finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Finance Rate (APR)</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Monthly_payment" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text"  ><input type="radio" name="report" value="Specific_model" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Specific Model Pull </label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Power_focus" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Power Focus</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fue_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Local_town" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Local vs Out of Town</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Used_new_purchaser" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Used vs New Purchaser</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="dealership_brand" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Own Off Dealership Brand</label>
                        </div>
                    </div>
                    
                    <div style="float: right; width: 58%;margin-top: 10px;">
                        <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                        
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label ">Variable 1</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 2</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 3</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label labeltextaea">Variable 4</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 5</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                           <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        </p>
                        
                        <div style="height: 20px;float: left;">&nbsp;</div>
                    </div>
                    
                </div> 
           <!--tab1-->
           <!--tab2-->
        <div id="tab-2" class="tabs-content"  style="float: left;display: none;">
      
                    <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                        <label  class="reportlabel"><h4>Select Your Report Type</h4></label>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Vehicle_class"style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value)"/>Vehicle Class</label>
                            
                        </div>
                        <div class="reporttype"> 
                                                      
                            <label  class="label report_text"><input type="radio" name="report" value="Drive_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/> Drive Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fuel_economy" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Economy</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Trade_in_value" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Trade In Value</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Out_warranty" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Out of Warranty</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" style="width: 80%;float:left" ><input type="radio" name="report" value="Finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Finance Rate (APR)</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Monthly_payment" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text"  ><input type="radio" name="report" value="Specific_model" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Specific Model Pull </label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Power_focus" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Power Focus</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fue_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Local_town" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Local vs Out of Town</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Used_new_purchaser" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Used vs New Purchaser</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="dealership_brand" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Own Off Dealership Brand</label>
                        </div>
                    </div>
                    
                    <div style="float: right; width: 58%;margin-top: 10px;">
                        <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                        
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label ">Variable 1</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 2</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 3</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label labeltextaea">Variable 4</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 5</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                           <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        </p>
                        <div style="height: 20px;float: left;">&nbsp;</div>
                    </div>
                    
                </div>
               
        <!--tab2-->
          <!--tab3-->
        <div id="tab-3" class="tabs-content"  style="float: left;display: none;">
      
                    <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                        <label  class="reportlabel"><h4>Select Your Report Type</h4></label>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Vehicle_class"style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value)"/>Vehicle Class</label>
                            
                        </div>
                        <div class="reporttype"> 
                                                      
                            <label  class="label report_text"><input type="radio" name="report" value="Drive_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/> Drive Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fuel_economy" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Economy</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Trade_in_value" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Trade In Value</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Out_warranty" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Out of Warranty</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" style="width: 80%;float:left" ><input type="radio" name="report" value="Finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Finance Rate (APR)</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Monthly_payment" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text"  ><input type="radio" name="report" value="Specific_model" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Specific Model Pull </label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Power_focus" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Power Focus</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fue_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Local_town" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Local vs Out of Town</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Used_new_purchaser" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Used vs New Purchaser</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="dealership_brand" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Own Off Dealership Brand</label>
                        </div>
                    </div>
                    
                    <div style="float: right; width: 58%;margin-top: 10px;">
                        <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                        
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label ">Variable 1</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 2</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 3</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label labeltextaea">Variable 4</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 5</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                           <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        </p>
                        <div style="height: 20px;float: left;">&nbsp;</div>
                    </div>
                </div>
          <!--tab3-->
          <!--tab4-->
        <div id="tab-4" class="tabs-content"  style="float: left;display: none;">
      
                    <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                        <label  class="reportlabel"><h4>Select Your Report Type</h4></label>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Vehicle_class"style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value)"/>Vehicle Class</label>
                            
                        </div>
                        <div class="reporttype"> 
                                                      
                            <label  class="label report_text"><input type="radio" name="report" value="Drive_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/> Drive Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fuel_economy" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Economy</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Trade_in_value" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Trade In Value</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Out_warranty" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Out of Warranty</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" style="width: 80%;float:left" ><input type="radio" name="report" value="Finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Finance Rate (APR)</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Monthly_payment" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text"  ><input type="radio" name="report" value="Specific_model" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Specific Model Pull </label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Power_focus" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Power Focus</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fue_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Local_town" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Local vs Out of Town</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Used_new_purchaser" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Used vs New Purchaser</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="dealership_brand" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Own Off Dealership Brand</label>
                        </div>
                    </div>
                    
                    <div style="float: right; width: 58%;margin-top: 10px;">
                        <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                        
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label ">Variable 1</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 2</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 3</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label labeltextaea">Variable 4</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 5</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                           <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        </p>
                        <div style="height: 20px;float: left;">&nbsp;</div>
                    </div>
                </div>
        <!--tab4-->
        <!--tab5-->
        <div id="tab-5" class="tabs-content"  style="float: left;display: none;">
      
                    <div  class="with-padding" style="width: 33%;float: left;text-align: left;">
                        <label  class="reportlabel"><h4>Select Your Report Type</h4></label>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Vehicle_class"style="width: 31px;float: left;"  onclick="showreportchangevalue(this.value)"/>Vehicle Class</label>
                            
                        </div>
                        <div class="reporttype"> 
                                                      
                            <label  class="label report_text"><input type="radio" name="report" value="Drive_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/> Drive Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fuel_economy" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Economy</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Trade_in_value" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Trade In Value</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Out_warranty" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Out of Warranty</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" style="width: 80%;float:left" ><input type="radio" name="report" value="Finance_rate" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Finance Rate (APR)</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Monthly_payment" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Monthly Payment Range</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text"  ><input type="radio" name="report" value="Specific_model" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Specific Model Pull </label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Power_focus" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Power Focus</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Fue_type" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Fuel Type</label>
                        </div>
                        <div class="reporttype">
                            
                            <label  class="label report_text" ><input type="radio" name="report" value="Local_town" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Local vs Out of Town</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="Used_new_purchaser" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Used vs New Purchaser</label>
                        </div>
                        <div class="reporttype">
                            
                            <label class="label report_text" ><input type="radio" name="report" value="dealership_brand" style="width: 31px;float: left;" onclick="showreportchangevalue(this.value)"/>Own Off Dealership Brand</label>
                        </div>
                    </div>
                    
                    <div style="float: right; width: 58%;margin-top: 10px;">
                        <h4 class="typetitle"><label class="showreportdiv" >Vehicle Class</label></h4>
                        
                        <p class="inline-small-label button-height pclass" style="float: left;margin-top:12px;">
                            <label for="small-label-1" class="label ">Variable 1</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 2</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 3</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label labeltextaea">Variable 4</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                            <label for="small-label-1" class="label ">Variable 5</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right variabletext" value=""/>
                        </p>
                        <p class="inline-small-label button-height pclass" style="float: left;">
                           <div class="report_type_description" id="report_type_description">This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold 'ctrl' while you select. We suggest not picking more than 3 for a report.</div>
                        </p>
                        <div style="height: 20px;float: left;">&nbsp;</div>
                    </div>
                </div>
        <!--tab5-->
       </div>
     
       <button type="button" class="previous  button glossy mid-margin-right" value="Previous" >
        <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
        Previous
        </button>
        <button type="button" class="next  button glossy mid-margin-right" value="Next" >
        <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
        Step 2 of 3
        </button>
        </fieldset>
        
        
    <fieldset id="stepthree" class="stepthree">
    
    <label style="color: grey;"><h4>Fill in the boxes below with current info related to your dealership and auto manufactures current rebates, interest rates and other factors.</h4> </label>
    <p class="inline-small-label button-height" style="margin-top: 13px;">
    <label for="small-label-1" class="label">Manufacturer Interest Rate:</label>
    <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
    </p>
    <div style="clear: both;height:10px"></div>
    <p class="inline-small-label button-height">
    <label for="small-label-1" class="label">Best Sub-Prime Rate</label>
    <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
    </p>
    <div style="clear: both;height:10px"></div>
    <p class="inline-small-label button-height">
    <label for="small-label-1" class="label">Factory Rebate</label>
    <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
    </p>
    <div style="clear: both;height:10px"></div>
    <p class="inline-small-label button-height">
    <label for="small-label-1" class="label">Dealership Incentives: </label>
    <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
    </p>
    <div style="clear: both;height:10px"></div>
     <p class="inline-small-label button-height">
    <label for="small-label-1" class="label">Do you have any excess vehicle types that you would like to promote? </label>
    <textarea name="excess_vehicle" id="last_name" class="input small-margin-right"></textarea>
    </p>
    <div style="clear: both;height:10px"></div>
    <p class="inline-small-label button-height">
    <label for="small-label-1" class="label">Do you have any special dealership promos that you want us to know about?</label>
    <textarea name="dealership_promos" id="last_name" class="input small-margin-right"></textarea>
    </p>
    <div style="clear: both;height:10px"></div>
    <div style="clear: both;"></div>
    <button type="button" class="previous  button glossy mid-margin-right" value="Previous" style="float: left;margin-left: 209px;">
    <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
    Previous
    </button>
        <button type="submit" class="submit button glossy mid-margin-right" onclick="validation();" style="float: left;">
    <span class="button-icon"><span class="icon-tick"></span></span>
    Submit
    </button>
    </fieldset>
    
    </form>
    </section>
<div style="clear: both;"></div>
<!-- jQuery -->

<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->

<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script>
$( document ).ready(function() {

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$(".next").click(function(){
var configuredcamp=$('#configuredcamp').val();
 if(configuredcamp=='custom_campaign')
{ 
     
}
 else
 {
    $( "#steptwo" ).remove();
 }
$('#select_campine').val(configuredcamp); 
    var selected_campaine=$('#select_campine').val();
   
 
if(selected_campaine=='custom_campaign' )
{  
$.post('<?=base_url()?>settings/selectcampaine',{select_campaine : $('#select_campine').val()},function(data){

    });
$('.processbar-custom-campaine').show();
 $('.processbar-campaine').hide();
}
else
{
    
       $('.processbar-campaine').show();
       $('.processbar-custom-campaine').hide();
}

if(animating) return false;
animating = true;
current_fs = $(this).parent();
next_fs = $(this).parent().next();
//activate next step on progressbar using the index of next_fs
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
$("#progressbar1 li").eq($("fieldset").index(next_fs)).addClass("active");
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
$("#progressbar1 li").eq($("fieldset").index(current_fs)).removeClass("active");
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

});
</script>

<script src="<?=base_url()?>js/developr.tabs.js"></script>		<!-- Must be loaded last -->

<script>

// Call template init (optional, but faster if called manually)
$.template.init();

// Tabs adding/removing
var tabsAdded = [];

// Add a tab
function addTab()
{
// New tab id
var tabId = 'new-tab'+tabsAdded.length;

// Register tab
tabsAdded.push(tabId);

// Create
$('#add-tabs').addTab(tabId, 'New tab '+tabsAdded.length, 'Content of dynamically added tab');
};

// Remove dynamically created tabs
function removeTabs()
{
var tabId;
while (tabsAdded.length > 0)
{
$('#'+tabsAdded.pop()).removeTab();
}
};
function changesecondtabs(){
    $('#steptwo').show();
    $('#stepthree').hide();
    $('#stepfour').hide();
    $('#stepfirst').hide();
    $('#steptwolist').addClass("active");
    $('#stepthreelist').removeClass("active");
    $('#stepfourlist').removeClass("active");
     $('#stepfirstlist').addClass("active");
     $("#steptwo").css({'opacity':1, 'transform':'scale(1)'});
}

function changefirsttabs(){
   
    $('#steptwo').hide();
    $('#stepthree').hide();
    $('#stepfour').hide();
    $('#stepfirst').show();
     $('#stepfirstlist').addClass("active");
     $('#stepthreelist').removeClass("active");
     $('#steptwolist').removeClass("active");
     $('#stepfourlist').removeClass("active");
     $("#stepfirst").css({'opacity':1, 'transform':'scale(1)'});
}
function changethirdtabs(){
    $('#steptwo').hide();
    $('#stepfirst').hide();
    $('#stepfour').hide();
    $('#stepthree').show();
    $('#stepthreelist').addClass("active");
      $('#stepfirstlist').addClass("active");
     
     $('#steptwolist').addClass("active");
     $('#stepfourlist').removeClass("active");
       $("#stepthree").css({'opacity':1, 'transform':'scale(1)'});
}
function changefourthtabs(){
    $('#steptwo').hide();
    $('#stepfirst').hide();
    $('#stepthree').hide();
    $('#stepfour').show();
    $('#stepfourlist').addClass("active");
    $('#stepthreelist').addClass("active");
      $('#stepfirstlist').addClass("active");
     
     $('#steptwolist').addClass("active");
     $("#stepfour").css({'opacity':1, 'transform':'scale(1)'});
     
}

function changesecondtabscampine(){
  $('.stepthree').show();
    $('.stepfour').hide();
    $('.stepfirst').hide();
     $('#stepfirstlistcampine').addClass("active");
     $('#steptwolistcampine').addClass("active");
     $('#stepthreelistcampine').removeClass("active");
     $(".stepthree").css({'opacity':1, 'transform':'scale(1)'});
}
function changefirsttabscampine(){
    $('.steptwo').hide();
    $('.stepfirst').show();
   
    $('.stepthree').hide();
    $('#stepfirstlistcampine').addClass("active");
      $('#steptwolistcampine').removeClass("active");
      $('#stepthreelistcampine').removeClass("active");
      $(".stepfirst").css({'opacity':1, 'transform':'scale(1)'});
}
function changethirdtabscampine(){
    $('.stepthree').hide();
    $('.stepfirst').hide();
     $('.stepfour').show();
     
    $('#stepfirstlistcampine').addClass("active");
      $('#steptwolistcampine').addClass("active");
     
     $('#stepthreelistcampine').addClass("active");
  
       $(".stepfour").css({'opacity':1, 'transform':'scale(1)'});
}
function configuredcampaign(){
    var campaign=$('#configuredcamp').val();

    if(campaign==''){
         $( "#configuredcamp" ).removeClass( "select validate[required]" );
          $("#stepthreelistcampine").hide();
        }else{
    if(campaign=='custom_campaign'){
        $('#steptwo').show();
        $("#stepthreelistcampine").show()
    }else{
      $('#stepthree').show(); 
      $("#stepthreelistcampine").hide(); 
    }
  }  
}
</script>
<script>
    function validation()
    {
        
       
		// Call template init (optional, but faster if called manually)
        $( "#configuredcamp" ).addClass( "select validate[required]" );
		$.template.init();
		// Color
		$('#anthracite-inputs').change(function()
		{
			$('#main')[this.checked ? 'addClass' : 'removeClass']('black-inputs');
		});
		// Switches mode
		$('#switch-mode').change(function()
		{
			$('#switch-wrapper')[this.checked ? 'addClass' : 'removeClass']('reversed-switches');
		});
		// Disabled switches
		$('#switch-enable').change(function()
		{
			$('#disabled-switches').children()[this.checked ? 'enableInput' : 'disableInput']();
		});
		// Tooltip menu
		$('#select-tooltip').menuTooltip($('#select-context').hide(), {
			classes: ['no-padding']
		});
		// Form validation
		$('form').validationEngine();
       
    }
        function displaystepdevice(selectedcampine)
    {
        if(selectedcampine=='custom_campaign')
        {
            $('.processbar-custom-campaine').show();
            $('.processbar-campaine').hide();
            $('#showsteps').html('Step 2 of 3');
        }
        else
        {
            $('.processbar-custom-campaine').hide();
            $('.processbar-campaine').show();
             $('#showsteps').html('Step 2 of 2');
          
        }
        
    }
    function showreportchangevalue(changevalue)
    {
        var variable_name;
        var label_text;
        if(changevalue=='Vehicle_class')
        {
            variable_name='Vehicle Class';
            label_text='This report will allow you to separate your customer leads based on one or more vehicle classes. By targeting an individual vehicle class we can send them mailers and invites that match the current type of vehicle they drive - for example, if you target Trucks, we can send invites with images of your current truck line-up, or of a particular truck model you have many of on your lot. Choose the class(es) you would like to target from the list. When choosing more than 1, hold \'ctrl\' while you select. We suggest not picking more than 3 for a report.';
            
        }
        else if(changevalue=='Drive_type')
        {
            variable_name='Drive Type';
            label_text='This report will allow you to separate your customer leads based on the Drive Type of the vehicle they last purchased. By inviting your past customers to a sale event based on drive type we can use their buying preferences to provide a more enticing sale event with the vehicles they want being the focus of their invite. Choose the Drive Type(s) you would like to target from the list. When choosing more than 1, hold \'ctrl\' while you select.<p style="margin-top:10px;">Note: If you would like to separate your entire list based on all Drive Types please select "Drive Type" from our pre-configured list.</p>';
        }
          else if(changevalue=='Fuel_economy')
        {
            variable_name='Fuel Economy';
            label_text="Got a new fuel efficient model in your line-up? We\'ll invite those past customers that own fuel efficient vehicles to your Exclusive Private Sale with an invite just for them.<p style='margin-top:10px;'>Simply enter in the range of Fuel Economy you would like to focus on and let us do the rest. For more uses of this report contact your rep at EPS or view our help guide or our special guide to creating Private Sale Events that deliver results.</p>";
        }
          else if(changevalue=='Trade_in_value')
        {
            variable_name='Trade In Value';
            label_text="Info coming soon";
            
        }
          else if(changevalue=='Out_warranty')
        {
            variable_name='Out of Warranty';
            label_text="No options necessary for this report. Running this will pull out all records that have no warranty on their vehicle. Our invites will focus on the pain points of not having any warranty on a vehicle and the benefits of buying a new one from your dealership during your Private Sale event.<p style='margin-top:10px;'>Note: We do not recommend using this as the first report you run.</p>";
        }
          else if(changevalue=='Finance_rate')
        {
            variable_name='Finance Rate (APR)';
            label_text="Nobody likes paying subprime interest rates. Bring back your old customers with a Private Sale invite that focuses on the possibility of a lower interest rate based on improved credit scores. This is a great way to target a specific audience that has high residual F&I value.<p style='margin-top:10px;'>By default, selecting the Subprime option will return all customers with vehicle loans with an APR of 8.5% or higher. We\'ve also allowed you the ability to extract a specific APR range. Use this option for customized targeting.</p>";
            
        }
          else if(changevalue=='Monthly_payment')
        {
            variable_name='Monthly Payment Range';
            label_text='This report will extract records based on the monthly payment that your customers have. Want to target those buyers who can afford a specific monthly payment? Use the "minimum payment field" to set a limit. Or maybe you want to target budget vehicle purchasers - use the "max payment field" to set a cut off.';
            
        }
          else if(changevalue=='Specific_model')
        {
            variable_name='Specific Model Pull';
            label_text='This report will allow you to separate your customer leads based on a single vehicle model. By targeting a single vehicle model we can send them mailers and invites that match the current type of vehicle they drive.<p style="margin-top:10px;">Pick your target model from the drop down list.</p>';
        }  else if(changevalue=='Power_focus')
        {
            variable_name='Power Focus';
            label_text='Want to promote something a bit different? Use this report to target owners of high horsepower/high torque vehicles in specific vehicle classes. Our invite mailers will reflect a performance theme based on the class of vehicle(s) you pick. Choose the class(es) you would like to target from the list. When choosing more than 1, hold \'ctrl\' while you select. We suggest not picking more than 3 for a report.';
        }
          else if(changevalue=='Fue_type')
        {
            variable_name='Fuel Type';
            label_text='This report will allow you to separate your customer leads based on the Fuel Type of the vehicle they last purchased.<p style="margin-top:10px;">Choose the Fuel Type(s) you would like to target from the list. When choosing more than 1, hold \'ctrl\' while you select. </p><p style="margin-top:10px;">Note: If you would like to separate your entire list based on all Fuel Types please select "Fuel Type" from our pre-configured list.</p>';
        }
          else if(changevalue=='Local_town')
        {
            variable_name='Local vs Out of Town';
            label_text='Target your customers based on their location to you. Or exclude all out of towners by using this as your first report and then de-selecting the Lead Group at the next step.';
        }
          else if(changevalue=='Used_new_purchaser')
        {
            variable_name='Used vs New Purchaser';
            label_text='Once a new car buyer, forever a new car buyer. Don\'t waste your efforts on trying to sell used cars to people that only buy new and vice versa. As an additional option you can apply an additional filter based on vehicle class and get a list specific to New Truck Purchasers for example.';
        }
          else if(changevalue=='dealership_brand')
        {
            variable_name='Own Off Dealership Brand';
            label_text='Because you sell used vehicles too, not all your customers get to enjoy your dealerships amazing vehicles. It\'s time for these heathens to convert. We\'ll send them an invite to your next Private Sale with a special focus on getting into a _________________ [insert manufacters name here based on dealership account details].';
        }
      
        $('.showreportdiv').html(variable_name);
        $('.report_type_description').html(label_text);
        
    }
    function select_tab(select_tab)
  {
    if(select_tab=='tab2')
    {
        $('#selecttab2').addClass('active');
        $('#selecttab1').removeClass('active');
        $('#selecttab3').removeClass('active');
        $('#selecttab4').removeClass('active');
         $('#selecttab5').removeClass('active');
        $('#tab-1').hide();
        $('#tab-2').show();
        $('#tab-3').hide();
        $('#tab-5').hide();
        
    }
    else if(select_tab=='tab3')
    {
          $('#selecttab2').removeClass('active');
        $('#selecttab1').removeClass('active');
        $('#selecttab3').addClass('active');
        $('#selecttab4').removeClass('active');
         $('#selecttab5').removeClass('active');
          $('#tab-1').hide();
        $('#tab-2').hide();
        $('#tab-3').show();
        $('#tab-4').hide();
        $('#tab-5').hide();
    }
     else if(select_tab=='tab1')
    {
          $('#selecttab2').removeClass('active');
        $('#selecttab1').addClass('active');
        $('#selecttab3').removeClass('active');
        $('#selecttab4').removeClass('active');
         $('#selecttab5').removeClass('active');
         $('#tab-1').show();
        $('#tab-2').hide();
        $('#tab-3').hide();
        $('#tab-4').hide();
        $('#tab-5').hide();
        
    }
     else if(select_tab=='tab4')
    {
          $('#selecttab2').removeClass('active');
        $('#selecttab1').removeClass('active');
        $('#selecttab3').removeClass('active');
        $('#selecttab4').addClass('active');
         $('#selecttab5').removeClass('active');
         $('#tab-1').hide();
        $('#tab-2').hide();
        $('#tab-3').hide();
        $('#tab-4').show();
        $('#tab-5').hide();
    }
      else if(select_tab=='tab5')
    {
          $('#selecttab2').removeClass('active');
        $('#selecttab1').removeClass('active');
        $('#selecttab3').removeClass('active');
        $('#selecttab4').removeClass('active');
        $('#selecttab5').addClass('active');
         $('#tab-1').hide();
        $('#tab-2').hide();
        $('#tab-3').hide();
        $('#tab-4').hide();
         $('#tab-5').show();
    }
  }
	</script>