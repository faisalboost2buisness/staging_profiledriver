<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/resource_oper')?>"></script>
<div id="header_cb">
	<h2><?php echo $body['title']?></h2>
</div>
<div id="container">
	<p>&nbsp;</p>
	<div id="jq_msg"></div>
	<p>&nbsp;</p>
	<?php echo form_open($form['action'],$form['attributes'],$form['hidden'])?>
	<table width="100%">
		<tr>
			<td width="150" class="inline-small-label button-height">
                <label class="label" style="width:225px !important;">
                    <?php echo $this->lang->line('type')?>
                </label>
            </td>
			<td><?php echo form_dropdown($form['type']['name'], $form['type']['options'], $form['type']['selected'], $form['type']['attributes'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('name')?>
                </label>
            </td>
			<td><?php echo form_input($form['name'])?></td>
		</tr>
		<tr id="tr_controller">
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('controller')?>
                </label>
            </td>
			<td><?php echo form_dropdown($form['controller']['name'], $form['controller']['options'], $form['controller']['selected'], $form['controller']['attributes'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('description')?>
                </label>
            </td>
			<td><?php echo form_textarea($form['description'])?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
                <!--<button type="submit" class="cizacl_btn_save"><?php /*echo $form['submit']*/?></button>-->
                <button class="button glossy mid-margin-right" type="submit">
                    <span class="button-icon"><span class="icon-tick"></span></span>
                    <?php echo $form['submit']?>
                </button>
            </td>
		</tr>
	</table>
	<?php echo form_close()?> </div>
