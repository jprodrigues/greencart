<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Progress Bar', 'qcformbuilder-forms'); ?></label>
	<div class="qcformbuilder-config-field">
		<label><input type="checkbox" name="config[auto_progress]" value="1" <?php if(!empty($element['auto_progress'])){ echo 'checked="checked"'; } ?>> <?php echo esc_html__('Show Breadcrumbs', 'qcformbuilder-forms'); ?></label>
		<p class="description"><?php echo esc_html__('ProTip: Use an HTML element to build a custom progress per page', 'qcformbuilder-forms'); ?></p>
	</div>
</div>
<div id="page_name_bind">

</div>
<?php do_action( 'qcformbuilder_forms_pages_config', $element ); ?>
<script type="text/html" id="page-name-tmpl">
<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Page', 'qcformbuilder-forms'); ?> {{page_no}}</label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="field-config" name="config[page_names][]" value="" style="width:400px;">
	</div>
</div>
</script>
<script>
	jQuery(document).on('add.page remove.page load.page', function(){
		
		var pages = jQuery('.page-toggle.button'),
			wrap = jQuery('#page_name_bind'),
			template 	= jQuery('#page-name-tmpl').html();

		wrap.empty();

		pages.each(function(k,v){
			var page 		= jQuery(v),
				cfg_tmpl	= jQuery(template.replace(/{{page_no}}/g, k+1));

			cfg_tmpl.find('.field-config').val(page.data('name'));

			cfg_tmpl.appendTo(wrap);
		});

	});
</script>