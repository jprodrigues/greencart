<?php

if(!isset($element['variables'])){
	$element['variables'] = array();
}


?>
<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Name'); ?></label>
	<div class="qcformbuilder-config-field" style="margin: 0px; padding: 4px 0px; width: 401px;">
		<div><?php echo esc_html__('Value', 'qcformbuilder-forms'); ?></div>
	</div>
	<?php echo esc_html__('Behaviour', 'qcformbuilder-forms'); ?>
</div>
<div id="variable_entry_list_none" <?php if(!empty($element['variables'])){ echo 'style="display:none;"'; } ?>><p class="description"><?php echo esc_html__('No variables defined', 'qcformbuilder-forms'); ?></p></div>
<div id="variable_entry_list">

<?php
	if(!empty($element['variables']['keys'])){
		foreach($element['variables']['keys'] as $var_index=>$var_value){
			?>
			<div class="qcformbuilder-config-group">
				<label style="padding:2px 0;"><input type="text" class="block-input field-config set-system-variable" name="config[variables][keys][]" value="<?php echo esc_attr( $var_value ); ?>"></label>
				<div class="qcformbuilder-config-field" style="width:400px;">
					<input type="text" class="field-config var-value block-input magic-tag-enabled" name="config[variables][values][]" value="<?php echo esc_attr( $element['variables']['values'][$var_index] ); ?>">
				</div>
				<select name="config[variables][types][]" class="field-config" style="vertical-align: baseline;">
					<option value="static" <?php if( $element['variables']['types'][$var_index] == 'static'){ echo 'selected="selected"'; } ?>><?php echo esc_html__('Static', 'qcformbuilder-forms'); ?></option>
					<option value="passback" <?php if( $element['variables']['types'][$var_index] == 'passback'){ echo 'selected="selected"'; } ?>><?php echo esc_html__('Passback', 'qcformbuilder-forms'); ?></option>
					<option value="entryitem" <?php if( $element['variables']['types'][$var_index] == 'entryitem'){ echo 'selected="selected"'; } ?>><?php echo esc_html__('Entry List', 'qcformbuilder-forms'); ?></option>
				</select>
				&nbsp;<button type="button" class="button remove-this-variable">&times;</button>
			</div>
			<?php
		}
	}

?>
</div>
<?php do_action( 'qcformbuilder_forms_variables_config', $element ); ?>
<script type="text/html" id="variable-fields-tmpl">
	<div class="qcformbuilder-config-group">
		<label style="padding:2px 0;"><input type="text" class="block-input field-config set-system-variable" name="config[variables][keys][]" value=""></label>
		<div class="qcformbuilder-config-field" style="width:400px;">
			<input type="text" class="field-config var-value block-input magic-tag-enabled" name="config[variables][values][]" value="">
		</div>
		<select name="config[variables][types][]" class="field-config" style="vertical-align: baseline;">
			<option value="static"><?php echo esc_html__('Static', 'qcformbuilder-forms'); ?></option>
			<option value="passback"><?php echo esc_html__('Passback', 'qcformbuilder-forms'); ?></option>
			<option value="entryitem"><?php echo esc_html__('Entry List', 'qcformbuilder-forms'); ?></option>
		</select>
		&nbsp;<button type="button" class="button remove-this-variable">&times;</button>
	</div>
</script>
<script>
	jQuery(document).on('click', '.remove-this-variable', function(){		
		jQuery(this).closest('.qcformbuilder-config-group').remove();
		jQuery('.set-system-variable').trigger('change');
		if(!jQuery('#variable_entry_list').children().length){
			jQuery('#variable_entry_list_none').show();
		}
	});
	jQuery(document).on('click', '.qcformbuilder-add-variable', function(e){
		e.preventDefault();
		jQuery('#variable_entry_list_none').hide();
		jQuery('#variable_entry_list').append( jQuery('#variable-fields-tmpl').html() );
		rebind_field_bindings();
	});
	jQuery(document).on('change', '.set-system-variable', function(){
		//set-system-variable
		var variables 	= jQuery('.set-system-variable');

		if(!variables.length){
			system_values.variable = null;
			return;
		}
		// set object
		system_values.variable = {
			tags	:	{
				vars	: []
			},
			type	:	"<?php echo __('Variables', 'qcformbuilder-forms'); ?>",
			wrap	:	['{','}']
		};
		// add values
		for(var v = 0; v < variables.length; v++){
			if(variables[v].value.length){
				variables[v].value = variables[v].value.replace(/[^a-z0-9]/gi, '_').toLowerCase();
				system_values.variable.tags.vars.push( 'variable:' + variables[v].value );
				jQuery(variables[v]).closest('.qcformbuilder-config-group').find('.var-value').data('parent', variables[v].value);
			}
		}		
      
	});
    

</script>