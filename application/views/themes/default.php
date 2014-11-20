<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie linen"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie linen" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie linen" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9 linen" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js linen" lang="en"><!--<![endif]-->
    <?php $this->load->view('themes/login_header'); ?>
    <div id="container">
        <hgroup id="login-title" class="large-margin-bottom">
            <h1 class="login-title-image">Developer</h1>
        </hgroup>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert error animated fadeIn">
                <p><?php echo $this->session->flashdata('error'); ?></p>
            </div>
        <?php endif; ?>
        <?php echo $body; ?>
    </div>
    <?php $this->load->view('themes/login_footer'); ?>
