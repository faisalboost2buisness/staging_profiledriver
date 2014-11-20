<?php $this->load->view('themes/header'); ?>
<?php $this->load->view('themes/side-bar',$data); ?>
<section role="main" id="main">
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert error animated fadeIn">
            <p><?php echo $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
    <?php echo $body; ?>
</section>
<?php $this->load->view('themes/footer'); ?>
