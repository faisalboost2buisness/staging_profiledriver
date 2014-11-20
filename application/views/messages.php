<!-- JavaScript at the bottom for fast page loading -->

<link rel="stylesheet" href="<?=base_url()?>js/libs/formValidator/developr.validationEngine.css?v=1"/>
<link rel="stylesheet" href="<?=base_url()?>css/modal.css"/>
<section role="main" id="main">
    <hgroup id="main-title" class="thin" style="text-align: left;">
    <h1>Messages</h1>
    </hgroup>
    <div class="with-padding">

			<div class="content-panel margin-bottom enabled-panels">
				<div class="panel-navigation silver-gradient">
                                    <div class="panel-control">
                                        <a onclick="document.location.reload(true);" class="button icon-undo" href="#">Refresh</a>
                                    </div>
                                    <?php if(isset($subjects)){ ?>
                                    <div style="height: 490px; position: relative;" class="panel-load-target scrollable">
                                        <div class="navigable">
                                            <ul class="unstyled-list open-on-panel-content">
                                                <?php foreach ($subjects as $key=>$value){
                                                if( isset($subjects[$key]) ){ ?>
                                                <li class="big-menu grey-gradient with-right-arrow">
                                                    <span><span class="list-count"><?php echo count($subjects[$key]); ?></span><?php echo ucwords(str_replace('_', " ", $key)); ?></span>
                                                    <ul class="message-menu">
                                                        <?php foreach ($value as $admin_email){ ?>
                                                        <li class="message-menu">
                                                            <span class="message-status">
                                                                <?php if($admin_email['starred'] == 0){ ?>
                                                                    <a title="Not starred" class="unstarred" href="#">Not starred</a>
                                                                <?php }else{ ?>
                                                                    <a title="Starred" class="starred" href="#">Starred</a>
                                                                <?php } ?>
                                                                <?php if($admin_email['message_read'] == 1){ ?>
                                                                    <a title="Mark as read" class="new-message" href="#">New</a>
                                                                <?php } ?>
                                                            </span>
                                                            <span class="message-info">
                                                                <span class="blue">
                                                                    <?php 
                                                                        date_default_timezone_set('MST7MDT');
                                                                        $message_time = $admin_email['time'];
                                                                        $date_now = date('m/d/Y h:i:s a', time());
                                                                        $d1 = new DateTime($message_time);
                                                                        $d2 = new DateTime($date_now);
                                                                        $interval = $d2->diff($d1);

                                                                        if($interval->format('%d') < 1){
                                                                            echo $d1->format('h:i');
                                                                        }else{
                                                                            echo $d1->format('M d');
                                                                        }
                                                                    ?>
                                                                </span>
                                                                <?php if($admin_email['attachement'] == 1){ ?>
                                                                    <a title="Download attachment" class="attach" href="#">Attachment</a>
                                                                <?php } ?>
                                                            </span>
                                                            <a title="Read message" href="#" onclick="loadMail(<?php echo $admin_email['messages_id']; ?>,<?php echo $user_id; ?>)">
                                                                <strong class="blue"><?php echo $admin_email['first_name']." ".$admin_email['last_name']; ?></strong><br>
                                                                <strong><?php echo $admin_email['subject']; ?></strong>
                                                            </a>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                                <?php }                                         
                                                }?>
                                                
                                            </ul>
                                        </div>
                                        <div class="custom-vscrollbar" style="display: none; opacity: 0;"><div></div></div>
                                    </div>
                                    <?php } ?>
				</div>
				<div class="panel-content linen">

					<div class="panel-control align-right">
						<span style="width: 40px" class="progress thin">
							<span style="width: 0.1%" class="progress-bar green-gradient"></span>
						</span>
						Used: 0.1%
						<a href="#" id="try-1" class="button icon-star margin-left">New message</a>
					</div>

					<div class="back"><span class="back-arrow"></span>Back</div><div style="height: 450px; position: relative;" class="panel-load-target scrollable with-padding">
                                            <?php if($leatest_message){ ?>
                                                <h2 id="subject_heading" class="thin mid-margin-bottom"><?php echo $leatest_message->subject; ?></h2>
                                                <h4 id="from_name" class="no-margin-top">From: <?php echo $leatest_message->first_name." ".$leatest_message->last_name; ?></h4>
                                            <?php } ?>
						<div class="large-box-shadow white-gradient with-border">

							<div class="button-height with-mid-padding silver-gradient no-margin-top">
								<span class="button-group children-tooltip">
									<a id="reply_modal_button" title="Reply to this message" class="button blue-gradient icon-reply" href="#">Reply</a>
									<a title="Reply to all" class="button" href="#"><span class="icon-replay-all"></span></a>
									<a id="forward_modal_button" title="Forward" class="button" href="#"><span class="icon-extract"></span></a>
								</span>
								<span class="button-group children-tooltip">
                                                                        <a id="trash-message" title="Move to trash" class="button" href="#"><span class="icon-trash"></span></a>
									<a title="Mark as important" class="button" href="#"><span class="icon-flag"></span></a>
								</span>
							</div>
                                                        <div id="body-main" style="padding-bottom: 20px;">
                                                            <?php 
                                                            if($leatest_message){
                                                                $thread = $leatest_message->thread;  
                                                                for($i = 0;$i < count($thread);$i++){
                                                                    ?>
                                                                    <div class="with-padding" style="padding-bottom: 0px ! important;">
                                                                        <?php echo $thread[$i]['reply']; ?>
                                                                         <?php if($i<count($thread)-1){
                                                                             $i = $i+1;
                                                                             ?>
                                                                            <div class="left-border grey" style="margin-bottom: 0px; margin-left: 25px ! important; margin-right: 0px ! important; margin-top: 20px ! important;">
                                                                               <?php echo $thread[$i]['reply']; ?>
                                                                            </div>
                                                                        <?php
                                                                         }
                                                                         ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="clear:both;height:10px;"></div>
						</div>
                                                <?php 
                                                if($leatest_message){
                                                ?>
                                                <input type="hidden" name="messages_id" id="messages_id" value="<?php echo $leatest_message->messages_id; ?>" />   
                                                <?php } ?>
					<div class="custom-vscrollbar" style="display: block; top: 6px; left: 645px; height: 478px; width: 8px; opacity: 0;"><div style="top: 0px; height: 316px;"></div></div></div>

				</div>

			</div>
		</div>
    <style>
        #modals{
            top:0% !important;
            left:50% !important;
            width: 100% !important;
        }
    </style>
                <div id="modals" class="with-blocker" style="display: none;">
                    <div class="modal-blocker visible"></div>
                    <div class="modal" style="width: 70%; left: 20%; top: 0px; opacity: 1; margin-top: 0px;">
                        <div class="modal-bar">
                            <ul class="modal-actions children-tooltip">
                                <li class="closemessage red-hover"><a title="Close" href="#">Close</a></li>
                            </ul>
                            <h3>New Message</h3>
                        </div>
                        <div class="modal-bg">                       
                            <div id="sign_up_form">
                                <form id="formedit-login" title="Registration" action="<?=base_url()?>messages/sendmessage/<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
                                    <p class="button-height inline-label">
                                        <label for="subject" class="label">Subject</label>
                                        <input type="text" name="subject" id="subject" class="input validate[required]" value="">
                                    </p>
                                    <p class="button-height inline-label">
                                        <label for="usertype" class="label">User Type</label>
                                        <select id="usertype" name="usertype" class="select validate[required]">
                                            <option value=""> Select User Type </option>
                                            <option value="admin">Admin</option>
                                            <option value="sub_admin">Sub Admin</option>
                                            <option value="account_managers">Account Managers</option>
                                            <option value="auto_brand">Auto Brand</option>
                                            <option <?php if($usertype == 'dealership'){ echo 'disabled'; } ?> value="dealership">Dealership</option>
                                        </select>
                                    </p>
                                    <p class="button-height inline-label">
                                        <label for="to_user" class="label">To: </label>
                                        <select tabindex="-1" id="to_user" name="to_user[]" class="select expandable-list multiple-as-single easy-multiple-selection check-list" multiple>
                                            <option value="-1"> Select All </option>
                                        </select>
                                        <span style="float: right;">
                                            <input type="checkbox" name="draft" id="draft" class="switch tiny" value="0" checked> <label for="draft">Draft</label>
                                        </span>
                                    </p>
                                    <p class="button-height inline-label">
                                        <label for="attachment" class="label">Attachment: </label>
                                        <input type="file" name="attachment" id="attachment" value="" class="file">
                                    </p>
                                    <input type="hidden" name="from_user" id="from_user" value="<?php echo $user_id; ?>" />
                                    <!--<textarea class="ckeditor" name="editor1"></textarea>-->
                                    <textarea name="body" id="body">This is a sample email: select <b>some text</b> and click buttons!</textarea>
                                    <div id="actions" style="margin-top: 20px; margin-left: 30%;">
                                        <button class="form_button sprited button glossy mid-margin-right" type="submit" style="margin-right: 20px;">
                                                <span class="button-icon"><span class="icon-tick"></span></span>
                                                Send
                                        </button>
                                        <button class="closemessage form_button sprited button glossy" type="submit">
                                                <span class="button-icon red-gradient"><span class="icon-cross-round"></span></span>
                                                Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                </div>
            </div>
    <style>
        #modals-reply{
            top:0% !important;
            left:50% !important;
            width: 100% !important;
        }
    </style>
            <div id="modals-reply" class="with-blocker" style="display: none;top: 0;left: 0;">
                <!--<div class="modal-blocker visible"></div>-->
                <div class="modal" style="width:70%;left: 20%; top: 0px; opacity: 1; margin-top: 0px;">
                    <div class="modal-bar">
                        <ul class="modal-actions children-tooltip">
                            <li class="closemessage red-hover"><a title="Close" href="#">Close</a></li>
                        </ul>
                        <h3>Reply to this message</h3>
                    </div>
                    <div class="modal-bg">                       
                        <div id="sign_up_form">
                            <form id="formedit-login" title="Registration" action="<?=base_url()?>messages/replymessage/<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
                                <p class="button-height inline-label">
                                    <label for="subject" class="label">Subject</label>
                                    <input type="text" name="subject" id="subject-reply" class="input validate[required]" value="RE: <?php echo $leatest_message->subject; ?>">
                                </p>
                                <p class="button-height inline-label">
                                    <label for="usertype" class="label">From: </label>
                                    <span id="name_reply"><?php echo $leatest_message->first_name." ".$leatest_message->last_name; ?>;</span>
                                </p>
                                <p class="button-height inline-label">
                                    <label for="attachment" class="label">Attachment: </label>
                                    <input type="file" name="attachment" id="attachment" value="" class="file">
                                </p>
                                <input type="hidden" name="from_user" id="from_user" value="<?php echo $user_id; ?>" />
                                <input type="hidden" name="messages_id" id="messages_id_reply" value="<?php echo $leatest_message->messages_id; ?>" />
                                <!--<textarea class="ckeditor" name="editor1"></textarea>-->
                                <textarea name="body" id="body"></textarea>
                                <div id="actions" style="margin-top: 20px; margin-left: 30%;">
                                    <button class="form_button sprited button glossy mid-margin-right" type="submit" style="margin-right: 20px;">
                                            <span class="button-icon"><span class="icon-tick"></span></span>
                                            Send
                                    </button>
                                    <button class="closemessage form_button sprited button glossy" type="submit">
                                            <span class="button-icon red-gradient"><span class="icon-cross-round"></span></span>
                                            Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
     <style>
        #modals-forward{
            top:0% !important;
            left:50% !important;
            width: 100% !important;
        }
    </style>
            <div id="modals-forward" class="with-blocker" style="display: none;">
                    <!--<div class="modal-blocker visible"></div>-->
                    <div class="modal" style="width:70%;left: 20%; top: 0px; opacity: 1; margin-top: 0px;">
                        <div class="modal-bar">
                            <ul class="modal-actions children-tooltip">
                                <li class="closemessage red-hover"><a title="Close" href="#">Close</a></li>
                            </ul>
                            <h3>Forward Message</h3>
                        </div>
                        <div class="modal-bg">                       
                            <div id="sign_up_form">
                                <form id="formedit-login" title="Registration" action="<?=base_url()?>messages/sendmessage/<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
                                    <p class="button-height inline-label">
                                        <label for="subject" class="label">Subject</label>
                                        <input type="text" name="subject" id="subject-f" class="input validate[required]" value="FW: <?php echo $leatest_message->subject; ?>">
                                    </p>
                                    <p class="button-height inline-label">
                                        <label for="usertype" class="label">User Type</label>
                                        <select id="usertypef" name="usertype" class="select validate[required]">
                                            <option value=""> Select User Type </option>
                                            <option value="admin">Admin</option>
                                            <option value="sub_admin">Sub Admin</option>
                                            <option value="account_managers">Account Managers</option>
                                            <option value="auto_brand">Auto Brand</option>
                                            <option <?php if($usertype == 'dealership'){ echo 'disabled'; } ?> value="dealership">Dealership</option>
                                        </select>
                                    </p>
                                    <p class="button-height inline-label">
                                        <label for="to_user" class="label">To: </label>
                                        <select tabindex="-1" id="to_userf" name="to_user[]" class="select expandable-list multiple-as-single easy-multiple-selection check-list" multiple>
                                            <option value="-1"> Select All </option>
                                        </select>
<!--                                        <span style="float: right;">
                                            <input type="checkbox" name="draft" id="draft" class="switch tiny" value="0" checked> <label for="draft">Draft</label>
                                        </span>-->
                                    </p>
                                    <p class="button-height inline-label">
                                        <label for="attachment" class="label">Attachment: </label>
                                        <input type="file" name="attachment" id="attachment" value="" class="file">
                                    </p>
                                    <input type="hidden" name="from_user" id="from_user" value="<?php echo $user_id; ?>" />
                                    <!--<textarea class="ckeditor" name="editor1"></textarea>-->
                                    <textarea name="body" id="body">
                                        <?php 
                                            $thread = $leatest_message->thread;  
                                            for($i = 0;$i < count($thread);$i++){
                                                ?>
                                                <div class="with-padding" style="padding-bottom: 0px ! important;">
                                                    <?php echo $thread[$i]['reply']; ?>
                                                     <?php if($i<count($thread)-1){
                                                         $i = $i+1;
                                                         ?>
                                                        <div class="left-border grey" style="margin-bottom: 0px; margin-left: 25px ! important; margin-right: 0px ! important; margin-top: 20px ! important;">
                                                           <?php echo $thread[$i]['reply']; ?>
                                                        </div>
                                                    <?php
                                                     }
                                                     ?>
                                                </div>
                                            <?php
                                            }
                                        ?>
                                    </textarea>
                                    <div id="actions" style="margin-top: 20px; margin-left: 30%;">
                                        <button class="form_button sprited button glossy mid-margin-right" type="submit" style="margin-right: 20px;">
                                                <span class="button-icon"><span class="icon-tick"></span></span>
                                                Send
                                        </button>
                                        <button class="closemessage form_button sprited button glossy" type="submit">
                                                <span class="button-icon red-gradient"><span class="icon-cross-round"></span></span>
                                                Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                </div>
            </div>
</section>   
<!-- Scripts 
<script src="<?=base_url()?>js/libs/jquery-1.10.2.min.js"></script>

-->
<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script src="<?=base_url()?>js/setup.js"></script>
<!-- Template functions -->
<script src="<?=base_url()?>js/developr.input.js"></script>
<script src="<?=base_url()?>js/developr.navigable.js"></script>
<script src="<?=base_url()?>js/developr.notify.js"></script>
<script src="<?=base_url()?>js/developr.scroll.js"></script>
	<!-- jQuery Form Validation -->
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<script src="<?=base_url()?>js/developr.tooltip.js"></script>
<script src="<?=base_url()?>js/jquery.lightbox_me.js"></script>
    <!-- CKEditor -->
<script type="text/javascript" src="<?=base_url()?>js/libs/tinymce/tinymce.min.js"></script>
    <!--<script src="<?=base_url()?>js/libs/ckeditor/ckeditor.js"></script>-->
<script type="text/javascript">

</script>
<script type="text/javascript" charset="utf-8">
        $("select#usertype").change(function(){
            var usertype = $("select#usertype option:selected").attr('value');
            $.post("<?=base_url()?>messages/usersbytype/<?php echo $user_id; ?>", {usertype:usertype}, function(data){
                console.log(data);
                var items = JSON.parse(data);

                var $selectElement = $("#to_user");
                $('#to_user')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="-1">Select All</option>')
                    .val('')
                ;
                $(items).each(function(){
                    var newOption = '<option value="' + this.registration_id + '">' + this.name + '</option>';
                    $selectElement.append(newOption);
                });
            });
        });
        $("select#usertypef").change(function(){
            var usertype = $("select#usertypef option:selected").attr('value');
            $.post("<?=base_url()?>messages/usersbytype/<?php echo $user_id; ?>", {usertype:usertype}, function(data){
                console.log(data);
                var items = JSON.parse(data);

                var $selectElement = $("#to_userf");
                $('#to_userf')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Select User</option>')
                    .val('')
                ;
                $(items).each(function(){
                    var newOption = '<option value="' + this.registration_id + '">' + this.name + '</option>';
                    $selectElement.append(newOption);
                });
            });
        });
        
        // Form validation
        $('form').validationEngine();
        $(function() {
            function launch() {
                 jQuery('#modals').lightbox_me({centered: true, onLoad: function() { jQuery('#modals').find('input:first').focus()}});
            }
            
            jQuery('#try-1').click(function(e) {
                <?php if($usertype == 'dealership'){ 
                ?>                
                    tinymce.init({
                        selector: "textarea",
                        toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                <?php    
                }else{
                ?>                
                    tinymce.init({
                        selector: "textarea",
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                <?php } ?>
                jQuery("#modals").lightbox_me({centered: true, preventScroll: true, onLoad: function() {
                        jQuery("#modals").find("input:first").focus();
                }});
				
                e.preventDefault();
            });          
            jQuery('#reply_modal_button').click(function(e) {
                var messages_id = $('#messages_id').val();
                $.post("<?=base_url()?>messages/loadMessage/<?php echo $user_id; ?>", {messages_id:messages_id}, function(data){
                    var items = JSON.parse(data);
                    var thread = items.thread;
                    var count = 0;
                    var html = '';
                    $(thread).each(function(){
                        var thrad_reply = this.reply;
                        if(count == 0){
                            count = count+1;
                        }else if(count == 1){
                            $('#to_user_text').val(this.to_user);
                            count = 0;
                        }
                    });
                    var name = items.first_name;
                    name = name.concat(" ");
                    name = name.concat(items.last_name);

                    $('#subject_heading').html(items.subject);               
                    $('#subject-reply').val('RE: '+items.subject);               
                    $('#messages_id_reply').val(items.messages_id);
                });
                <?php if($usertype == 'dealership'){ 
                ?>                
                    tinymce.init({
                        selector: "textarea",
                        toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                <?php    
                }else{
                ?>                
                    tinymce.init({
                        selector: "textarea",
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                <?php } ?>
                jQuery("#modals-reply").lightbox_me({centered: true, preventScroll: true, onLoad: function() {
                        jQuery("#modals-reply").find("input:first").focus();
                }});
				
                e.preventDefault();
            });
            
            jQuery('#forward_modal_button').click(function(e) {
                var messages_id = $('#messages_id').val();
                $.post("<?=base_url()?>messages/loadMessage/<?php echo $user_id; ?>", {messages_id:messages_id}, function(data){
                    var items = JSON.parse(data);
                    var thread = items.thread;
                    var count = 0;
                    var html = '';
                    $(thread).each(function(){
                        var thrad_reply = this.reply;
                        if(count == 0){
                            html = html.concat('<div class="with-padding" style="padding-bottom: 0px ! important;">');
                            html = html.concat(thrad_reply);
                            count = count+1;
                        }else if(count == 1){
                            html = html.concat('<div class="left-border grey" style="margin-bottom: 0px; margin-left: 25px ! important; margin-right: 0px ! important; margin-top: 20px ! important;">');
                            html = html.concat(thrad_reply);
                            html = html.concat('</div></div>');
                            count = 0;
                        }
                    });
                    tinyMCE.activeEditor.setContent(html);
                    var name = items.first_name;
                    name = name.concat(" ");
                    name = name.concat(items.last_name);
                    $('#subject-f').val('FW: '+items.subject);     
                    
                });
                
                <?php if($usertype == 'dealership'){ 
                ?>                
                    tinymce.init({
                        selector: "textarea",
                        toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                <?php    
                }else{
                ?>                
                    tinymce.init({
                        selector: "textarea",
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                <?php } ?>
                jQuery("#modals-forward").lightbox_me({centered: true, preventScroll: true, onLoad: function() {
                        jQuery("#modals-forward").find("input:first").focus();
                }});
				
                e.preventDefault();
            });
            
            jQuery('table tr:nth-child(even)').addClass('stripe');
        });
        
        jQuery('#trash-message').click(function(e) {
            var messages_id = $('#messages_id').val();
            $.post("<?=base_url()?>messages/deletMessage/<?php echo $user_id; ?>", {messages_id:messages_id}, function(data){
                document.location.reload(true);
            });  
        });
        
        function loadMail(messages_id,user_id){
            $.post("<?=base_url()?>messages/loadMessage/<?php echo $user_id; ?>", {messages_id:messages_id}, function(data){
                var items = JSON.parse(data);
                var thread = items.thread;
                var count = 0;
                var html = '';
                $(thread).each(function(){
                    var thrad_reply = this.reply;
                    if(count == 0){
                        html = html.concat('<div class="with-padding" style="padding-bottom: 0px ! important;">');
                        html = html.concat(thrad_reply);
                        count = count+1;
                    }else if(count == 1){
                        html = html.concat('<div class="left-border grey" style="margin-bottom: 0px; margin-left: 25px ! important; margin-right: 0px ! important; margin-top: 20px ! important;">');
                        html = html.concat(thrad_reply);
                        html = html.concat('</div></div>');
                        count = 0;
                    }
                });
                var name = items.first_name;
                name = name.concat(" ");
                name = name.concat(items.last_name);
                $('#body-main').html(html);
                $('#messages_id').val(items.messages_id);
                
                $('#subject_heading').html(items.subject); 
                
                $('#from_name').html("From: "+name);
            });
        }
    </script>
<!-- End sidebar/drop-down menu -->
<script src="<?=base_url()?>js/libs/formValidator/jquery.validationEngine.js?v=1"></script>
<script src="<?=base_url()?>js/libs/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>
<script src="<?=base_url()?>js/mask.js" type="text/javascript"></script>
<script>
//var jQuery17 = jQuery.noConflict();
</script>