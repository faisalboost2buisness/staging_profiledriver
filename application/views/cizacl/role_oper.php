<?php echo $this->cizacl->css() ?><?php echo $this->cizacl->scripts() ?>
<script type="text/javascript" src="<?php echo site_url('cizacl_js/role_oper')?>"></script>
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
                <label class="label" for="role_name">
                    <?php echo $this->lang->line('role_name')?>
                </label>
            </td>
			<td><?php echo form_input($form['name'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('inherit_by')?>
                </label>
            </td>
			<td><?php echo form_multiselect($form['inherit']['name'], $form['inherit']['options'], $form['inherit']['selected'], $form['inherit']['attributes'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('redirect_to')?>
                </label>
            </td>
			<td><?php echo form_dropdown($form['redirect']['name'], $form['redirect']['options'], $form['redirect']['selected'], $form['redirect']['attributes'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('description')?>
                </label>
            </td>
			<td><?php echo form_input($form['description'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('default_role')?>
                </label>
            </td>
			<td><?php echo form_dropdown($form['default']['name'], $form['default']['options'], $form['default']['selected'], $form['default']['attributes'])?></td>
		</tr>
		<tr>
			<td class="inline-small-label button-height">
                <label class="label">
                    <?php echo $this->lang->line('order')?>
                </label>
            </td>
			<td><?php echo form_input($form['order'])?></td>
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
