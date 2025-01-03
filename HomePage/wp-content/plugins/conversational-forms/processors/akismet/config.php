<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Name', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled required" name="{{_name}}[sender_name]" value="{{sender_name}}">
	</div>
</div>
<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Email', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled qcformbuilder-field-bind required" id="{{_id}}_sender_email" name="{{_name}}[sender_email]" value="{{sender_email}}">
	</div>
</div>
<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('URL', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled qcformbuilder-field-bind" id="{{_id}}_url" name="{{_name}}[url]" value="{{url}}">
	</div>
</div>
<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Content', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled qcformbuilder-field-bind" id="{{_id}}_content" name="{{_name}}[content]" value="{{content}}">
	</div>
</div>

<div class="qcformbuilder-config-group">
	<label><?php echo esc_html__('Error Message', 'qcformbuilder-forms'); ?> </label>
	<div class="qcformbuilder-config-field">
		<input type="text" class="block-input field-config magic-tag-enabled qcformbuilder-field-bind" id="{{_id}}_error" name="{{_name}}[error]" value="{{#if error}}{{error}}{{else}}<?php echo esc_html__('Sorry, that looked very spammy, try rephrasing things', 'qcformbuilder-forms'); ?>{{/if}}">
	</div>
</div>
