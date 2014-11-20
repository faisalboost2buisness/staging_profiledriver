<div id="form-wrapper">
        <div id="form-block" class="scratch-metal">
            <div id="form-viewport">
                <!--login form starts here-->
                <?php echo form_open("auth/login",'id="form-login" class="input-wrapper blue-gradient glossy" title="Login"');?>
                    <ul class="inputs black-input large">
                        <li>
                            <span class="icon-user mid-margin-right"></span>
                            <?php //echo form_input($identity,'','id="login" value="" class="input-unstyled" placeholder="Username " autocomplete="off"');?>
                            <input type="text" name="identity" id="login" value="" class="input-unstyled" placeholder="Username " autocomplete="off">
                        </li>
                        <li>
                            <span class="icon-lock mid-margin-right"></span>
                            <?php //echo form_input($password,'','id="pass" value="" class="input-unstyled" placeholder="Password" autocomplete="off"');?>
                            <input type="password" name="pass" id="pass" value="" class="input-unstyled" placeholder="Password" autocomplete="off">
                        </li>
                    </ul>
                    <p class="button-height">
                        <?php //echo form_button('submit', 'Login','id="login" class="button glossy float-right" type="submit"');?>
                        <button type="submit" class="button glossy float-right" id="login">Login</button>
                        <?php //echo form_checkbox('remember', '1', FALSE, 'id="remind" checked="checked" class="switch tiny mid-margin-right with-tooltip" title="Enable auto-login"');?>
                        <input type="checkbox" name="remind" id="remind" value="1" checked="checked" class="switch tiny mid-margin-right with-tooltip" title="Enable auto-login">
                        <label for="remind" style="margin-left:-6px">Remember Me</label>
                    </p>
                <?php echo form_close();?>
                <!--login form ends here-->
                <!--forget password form starts here-->
                <?php $this->load->view('auth/forgot_password',array('email' => $email));?>
                <!--forget password form starts here-->
            </div>
        </div>
    </div>
