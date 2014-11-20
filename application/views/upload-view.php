<!-- JavaScript at the bottom for fast page loading -->
<!-- Scripts -->
  <link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1">
<script src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/developr.table.js"></script>
<script src="<?=base_url()?>js/libs/modernizr.custom.js"></script>
<!-- Plugins -->
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<!-- Button to open/hide menu -->
<a href="#" id="open-menu"><span>Menu</span></a>
<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>
<!-- Main content -->
    <section role="main" id="main">
        <hgroup id="main-title" class="thin" style="text-align: left;">
            <h1>Upload</h1>
        </hgroup>
        <?php
        if(isset($error)){
        ?>
            <div style="color: red;">
            <?php
            echo $error;
            ?>
            </div>
        <?php
        }
        if(isset($success)){
        echo $success;
        }
        ?>
<script type="text/javascript">
function submit_fieldform(){
  $('#form-login').submit();  
}
</script>
<style>
.footer-class{
    position: absolute;
}
</style>
    <!--Form to upload vehicle details files-->
    <form method="post" action="<?php echo base_url()?>upload/uploadprocess" title="Registration"  id="form-login" enctype="multipart/form-data">
        <div class="with-padding" style="margin-top: 15px;">
            <div class="columns">
                <div class="six-columns twelve-columns-tablet" style=" margin-left:236px">
                    <fieldset class="fieldset">
                        <legend class="legend">Upload New Customer File</legend>
                        <p class="inline-small-label button-height">
                        <label for="validation-select" class="label">Upload</label>
                        <input type="file" name="upload_details" id="filename" value=""  class="file validate[required]"/>
                        </p> 
                         <div class="field-block button-height">
                          <button type="button" class="button glossy mid-margin-right" onclick="back_form();">
								<span class="button-icon green-gradient"><span class="icon-backward"></span></span>
								Back
							</button>
							<button type="submit" class="button glossy mid-margin-right" onclick="submit_fieldform()">
								<span class="button-icon"><span class="icon-tick"></span></span>
								Submit
							</button>
                            </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
  <script>
		// Call template init (optional, but faster if called manually)
		$.template.init();
		// Color
		$('#anthracite-inputs').change(function(){
			$('#main')[this.checked ? 'addClass' : 'removeClass']('black-inputs');
		});
		// Switches mode
		$('#switch-mode').change(function(){
			$('#switch-wrapper')[this.checked ? 'addClass' : 'removeClass']('reversed-switches');
		});
		// Disabled switches
		$('#switch-enable').change(function(){
			$('#disabled-switches').children()[this.checked ? 'enableInput' : 'disableInput']();
		});
		// Tooltip menu
		$('#select-tooltip').menuTooltip($('#select-context').hide(), {
			classes: ['no-padding']
		});
		// Form validation
		//$('form').validationEngine();
        $('#form-login').submit(function(event)
		{
        var filename=$('#filename').val();
        //alert(filename);
        if(filename==''){
            $('form').validationEngine();
            return false;
        }else{
            
            $.ajax({
                url: "<?php echo base_url()?>upload/checkfiletype",
                type: "POST",
                data: 'filename=' + filename ,
                success: function(msg)
                {
                
                    if(msg=='INVAILD'){
                        alert(msg);
                        $('form').validationEngine(); 
                        $( "#filename" ).removeClass("file validate[required] withClearFunctions" );
                        $( "#filename" ).addClass("file validate[invaildfiletype] withClearFunctions" );
                        return false;
                    
                    }
                }
            });
        }
       });
	</script>  
</section>                                                                                                                        