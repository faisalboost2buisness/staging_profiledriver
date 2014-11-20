<?php //echo form_open("auth/forgot_password",'id="form-password" class="input-wrapper orange-gradient glossy" title="Forget password?"');?>
<form method="post" action="" id="form-password" class="input-wrapper orange-gradient glossy" title="Forget password?">
    <p class="message">
        If you can’t remember your password, fill the input below with your e-mail and we’ll send you a new one:
        <span class="block-arrow">
            <span></span>
        </span>
    </p>
    <ul class="inputs black-input large">
        <li>
            <span class="icon-mail mid-margin-right"></span>
            <input type="email" name="email" id="mail" value="" class="input-unstyled" placeholder="Your e-mail" autocomplete="off">
            <?php //echo form_input($email,'','id="mail" class="input-unstyled" placeholder="Your e-mail" autocomplete="off"');?>
        </li>
    </ul>
    <!--Button to send new password-->
    <button type="submit" class="button glossy full-width" id="send-password">Send new password</button>
    <?php //echo form_button('submit', 'Send new password','class="button glossy full-width" id="send-password"');?>
<?php echo form_close();?>