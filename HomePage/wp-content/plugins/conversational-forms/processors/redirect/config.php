<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('URL', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled required" name="{{_name}}[url]" value="{{url}}">
	</div>
</div>
<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Redirect Message', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled required" name="{{_name}}[message]" value="{{#if message}}{{message}}{{else}}<?php esc_html_e('Redirecting', 'qcformbuilder-forms'); ?>{{/if}}">
		<p class="description"><?php esc_html_e('Message text shown when redirecting in Ajax mode.', 'qcformbuilder-forms'); ?></p>
	</div>
</div>