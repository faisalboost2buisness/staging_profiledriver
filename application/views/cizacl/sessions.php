<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php /*echo $this->cizacl->name*/?>-<?php /*echo $this->lang->line('version')*/?><?php /*echo $this->cizacl->version*/?></title>
<?php /*echo $this->cizacl->css() */?><?php /*echo $this->cizacl->scripts() */?>
<script type="text/javascript" src="<?php /*echo site_url('cizacl_js/sessions')*/?>"></script>
</head>

<body>
<div id="header"></div>-->
<hgroup id="main-title" class="thin" style="text-align:left;">
    <h1>Admin Panel</h1>
</hgroup>
<div class="with-padding">
    <div style=" margin-bottom: 10px;" class="wrapped left-icon icon-info-round">
        <div style="width: 332px;float: left;"><?php echo $this->lang->line('sessions_management')?></div>
    </div>
	<p align="right">
		<button type="button" onclick="del()" class="cizacl_btn_del"><?php echo $this->lang->line('del')?></button>
	</p>
	<p>&nbsp;</p>
	<table id="sessions_table">
	</table>
	<div id="sessions_navigator"></div>
</div>
<?php $this->load->view('cizacl/static_contents');?>
<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/sessions')?>"></script>
<!--</body>
</html>-->
