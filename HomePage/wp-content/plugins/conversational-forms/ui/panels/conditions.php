<?php
// conditional groups template
$element['conditional_groups']['magic'] = $magic_tags['system']['tags'];
if( !empty( $element['conditional_groups']['fields'] ) ){
	unset( $element['conditional_groups']['fields'] );
}
?>
<button style="width:250px;" id="new-conditional" class="button ajax-trigger" data-request="wfb_new_condition_group" data-template="#conditions-tmpl" data-target="#qcformbuilder-forms-conditions-panel" type="button"><?php esc_html_e( 'Add Conditional Group', 'qcformbuilder-forms' ); ?></button>
<input type="hidden" name="_magic" value="<?php echo esc_attr( json_encode( $magic_tags['system']['tags'] ) ); ?>">
<input type="hidden" id="wfb-conditions-db" name="config[conditional_groups]" value="<?php echo esc_attr( json_encode( $element['conditional_groups'] ) ); ?>" 
class="ajax-trigger"
data-event="rebuild-conditions"
data-request="#wfb-conditions-db"
data-type="json"
data-template="#conditions-tmpl"
data-target="#qcformbuilder-forms-conditions-panel"
data-autoload="true"
>
<div id="qcformbuilder-forms-conditions-panel"></div>
<script type="text/html" id="conditions-tmpl">
	<input type="hidden" name="_open_condition" value="{{_open_condition}}">
	<div class="qcformbuilder-editor-conditions-panel" style="margin-bottom: 32px;">
		<ul class="active-conditions-list">
			{{#each conditions}}
				<li class="qcformbuilder-condition-nav {{#is @root/_open_condition value=id}}active{{/is}} qcformbuilder-forms-condition-group condition-point-{{id}}" style="">
					<input type="hidden" name="conditions[{{id}}][id]" value="{{id}}">
					{{#if name}}			
						{{#is @root/_open_condition not=id}}
							<input type="hidden" name="conditions[{{id}}][name]" value="{{name}}">
							<input type="hidden" name="conditions[{{id}}][type]" value="{{type}}">
							{{#if fields}}
								<input type="hidden" name="conditions[{{id}}][fields]" value="{{json fields}}">
							{{/if}}
							{{#if group}}
								<input type="hidden" name="conditions[{{id}}][group]" value="{{json group}}">
							{{/if}}

						{{/is}}
						<a data-open-group="{{id}}" style="cursor:pointer;"><span id="condition-group-{{id}}">{{name}}</span> <span class="condition-line-number"></span></a>
					{{else}}
						<input type="text" name="conditions[{{id}}][name]" value="{{name}}" data-new-condition="{{id}}" placeholder="<?php echo esc_attr( 'New Group Name', 'qcformbuilder-forms'); ?>" style="width:100%;">
						{{#script}}
							jQuery('[data-new-condition]').focus();
						{{/script}}
					{{/if}}
				</li>

			{{/each}}
		</ul>
	</div>

	{{#find conditions @root/_open_condition}}
		<div class="qcformbuilder-editor-condition-config qcformbuilder-forms-condition-edit" style="margin-top: -27px; width:auto;">
			{{#if name}}
				<div class="condition-point-{{id}}" style="width: 550px; float: left;">
					<div class="qcformbuilder-config-group">
						<label for="{{id}}_lable"><?php esc_html_e( 'Name', 'qcformbuilder-forms' ); ?></label>
						<div class="qcformbuilder-config-field">
							<input type="text" name="conditions[{{id}}][name]" id="condition-group-name-{{id}}" data-sync="#condition-group-{{id}}" value="{{name}}" required class="required block-input">
						</div>
					</div>
					
					<div class="qcformbuilder-config-group">
						<label for="{{id}}_lable">Type</label>
						<div class="qcformbuilder-config-field">
							<select name="conditions[{{id}}][type]" data-live-sync="true">
								<option value=""></option>
								<option value="show" {{#is type value="show"}}selected="selected"{{/is}}><?php esc_html_e('Show', 'qcformbuilder-forms'); ?></option>
								
							</select>
							{{#if type}}
								<button type="button" data-add-group="{{id}}" class="pull-right button button-small"><?php echo esc_html__('Add Conditional Line', 'qcformbuilder-forms'); ?></button>
							{{/if}}
						</div>
					</div>
					{{#each group}}
						{{#unless @first}}
							<span style="display: block; margin: 0px 0px 8px;"><?php esc_html_e( 'or', 'qcformbuilder-forms' ); ?></span>
						{{/unless}}
						<div class="qcformbuilder-condition-group qcformbuilder-condition-lines">
						{{#each this}}
							<div class="qcformbuilder-condition-line condition-line-{{@key}}">
								<input type="hidden" name="conditions[{{../../id}}][group][{{parent}}][{{@key}}][parent]" value="{{parent}}">
								<span style="display:inline-block;">{{#if @first}}
									<?php esc_html_e( 'if', 'qcformbuilder-forms' ); ?>
								{{else}}
									<?php esc_html_e( 'and', 'qcformbuilder-forms' ); ?>
								{{/if}}</span>
								<input type="hidden" name="conditions[{{../../../id}}][fields][{{@key}}]" value="{{field}}" id="condition-bound-field-{{@key}}" data-live-sync="true">
								<select style="max-width:120px;vertical-align: inherit;" name="conditions[{{../../id}}][group][{{parent}}][{{@key}}][field]" data-sync="#condition-bound-field-{{@key}}">
									<option></option>
									<optgroup label="<?php esc_attr_e('Fields', 'qcformbuilder-forms'); ?>">
									{{#each @root/fields}}
										<option value="{{ID}}" {{#is ../field value=ID}}selected="selected"{{/is}} {{#is conditions/type value=../../../id}}disabled="disabled"{{/is}}>{{label}} [{{slug}}]</option>
									{{/each}}
									</optgroup>
									<?php /*<optgroup label="System Tags">
									{{#each @root/magic}}
										<option value="{{this}}" {{#is ../field value=this}}selected="selected"{{/is}}>{{this}}</option>
									{{/each}}
									</optgroup>*/ ?>
								</select>
								<select style="max-width:110px;vertical-align: inherit;" name="conditions[{{../../id}}][group][{{parent}}][{{@key}}][compare]">
									<option value="is" {{#is compare value="is"}}selected="selected"{{/is}}><?php esc_html_e( 'is', 'qcformbuilder-forms' ); ?></option>
									<option value="contains" {{#is compare value="contains"}}selected="selected"{{/is}}><?php esc_html_e( 'contains', 'qcformbuilder-forms' ); ?></option>
								</select>
								<span data-value="" class="qcformbuilder-conditional-field-value" style="padding: 0 12px 0; display:inline-block; width:200px;">
								{{#find @root/fields field}}
									{{#if config/option}}
										<select style="width:165px;vertical-align: inherit;" name="conditions[{{../../../../id}}][group][{{../../parent}}][{{@key}}][value]">
											<option></option>
											{{#each config/option}}
												<option value="{{@key}}" {{#is ../../../value value=@key}}selected="selected"{{/is}}>{{label}}</option>
											{{/each}}
										</select>
									{{else}}
										<input type="text" class="magic-tag-enabled block-input" name="conditions[{{../../../../id}}][group][{{../../parent}}][{{@key}}][value]" value="{{../../value}}" {{#unless ../../field}}placeholder="<?php echo esc_html__( 'Select field first', 'qcformbuilder-forms' ); ?>" disabled=""{{/unless}}>
									{{/if}}
								{{else}}
									<input type="text" class="magic-tag-enabled block-input" name="conditions[{{../../../../id}}][group][{{../parent}}][{{@key}}][value]" value="{{../value}}" {{#unless ../field}}placeholder="<?php echo esc_html__( 'Select field first', 'qcformbuilder-forms' ); ?>" disabled=""{{/unless}}>
								{{/find}}
								</span>
								<button class="button pull-right" data-remove-line="{{@key}}" type="button"><i class="icon-join"></i></button>
							</div>
						{{/each}}
						<div style="margin: 12px 0 0;"><button class="button button-small" data-add-line="{{@key}}" data-group="{{../id}}" type="button"><?php esc_html_e( 'Add Condition', 'qcformbuilder-forms' ); ?></button></div>
						</div>
					{{/each}}

					<button style="margin: 12px 0 12px;" type="button" class="block-input button" data-confirm="<?php echo esc_attr( __('Are you sure you want to remove this condition?', 'qcformbuilder forms') ); ?>" data-remove-group="{{id}}"><?php esc_html_e( 'Remove Condition', 'qcformbuilder-forms' ); ?></button>
				</div>
				<div style="float: left; width: 288px; padding-left: 12px;">
				{{#if @root/fields}}
					<h4 style="border-bottom: 1px solid rgb(191, 191, 191); margin: 0px 0px 6px; padding: 0px 0px 6px;"><?php esc_html_e('Applied Fields', 'qcformbuilder-forms'); ?></h4>
					<p class="description"><?php esc_html_e('Select the fields to apply this condition to.', 'qcformbuilder-forms' ); ?></p>
					{{#each @root/fields}}

						<label style="display: block; margin-left: 20px;{{#find ../../fields ID}}opacity:0.7;{{/find}}"><input style="margin-left: -20px;" type="checkbox" data-bind-condition="#field-condition-type-{{ID}}" value="{{../id}}" {{#is conditions/type value=../id}}checked="checked"{{else}}{{#find @root/conditions conditions/type}}disabled="disabled"{{/find}}{{/is}} {{#find ../../fields ID}}disabled="disabled"{{/find}}>{{label}} [{{slug}}]</label>
						
					{{/each}}
				{{/if}}
				</div>
			{{/if}}
		</div>
	{{/find}}

</script>
<script type="text/javascript">
	var wfb_new_condition_line, wfb_new_condition_group;

	jQuery( function( $ ){

		function get_base_form(){
			var data_fields		= $('.qcformbuilder-forms-options-form').formJSON(),
				object = {
					_open_condition	: data_fields._open_condition,
					conditions		: data_fields.conditions,
					fields			: data_fields.config.fields,
					magic			: data_fields._magic
				};

			return object;
		}

		wfb_new_condition_group = function(){
			var data = get_base_form(),
				db = $('#wfb-conditions-db'),
				id = 'con_' + Math.round(Math.random() * 99887766) + '' + Math.round(Math.random() * 99887766);

			if( !data.conditions ){
				data.conditions = {};
			}

			data.conditions[id] = {
				id : id
			};

			data._open_condition = id;

			db.val( JSON.stringify( data ) );

			return data;
		}

		$( document ).on('click', '[data-add-line]', function(){
			var clicked = $( this ),
				id = clicked.data('addLine'),
				db = $('#wfb-conditions-db'),
				data = get_base_form(),
				pid = clicked.data('group'),
				cid = 'cl' + Math.round(Math.random() * 99887766) + '' + Math.round(Math.random() * 99887766);

			if( !data.conditions[pid].group ){
				data.conditions[pid].group = {};
			}
			if( !data.conditions[pid].group[id] ){
				data.conditions[pid].group[id] = {};
			}

			// initial line
			data.conditions[pid].group[id][cid] = {
				parent		:	id
			};
			get_base_form();
			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );
		});

        var $newConditionalButton = $( '#new-conditional' );
        var addProcessorButtonPulser;

        $newConditionalButton.on( 'click', function(){
            if( 'object' === typeof addProcessorButtonPulser ){
                $newConditionalButton.removeClass( 'button-primary' );
                addProcessorButtonPulser.stopPulse();
            }
        });

		$( document ).on('click', '[data-add-group]', function(){

			var clicked = $( this ),
				pid = clicked.data('addGroup'),
				db = $('#wfb-conditions-db'),
				data = get_base_form(),
				id = 'rw' + Math.round(Math.random() * 99887766) + '' + Math.round(Math.random() * 99887766),
				cid = 'cl' + Math.round(Math.random() * 99887766) + '' + Math.round(Math.random() * 99887766);

			if( !data.conditions[pid].group ){
				data.conditions[pid].group = {};
			}
			if( !data.conditions[pid].group[id] ){
				data.conditions[pid].group[id] = {};
			}

			// initial line
			data.conditions[pid].group[id][cid] = {
				parent		:	id
			};

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );
		});
		$( document ).on('blur change', '[data-new-condition]', function(){
			var clicked = $( this ),
				id = clicked.data('newCondition');
			if( !clicked.val().length ){
				$('.condition-point-' + id).remove();
			}
			var db = $('#wfb-conditions-db'),
				data = get_base_form();

			data._open_condition = id;

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );
		});
		$( document ).on('change', '[data-live-sync]', function(){

			var data = get_base_form(),
				db = $('#wfb-conditions-db');

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );

		});

        $( document ).on( 'click', '#tab_conditions' , function(){

            if( 0 === $('.active-conditions-list').children().length ) {
                $newConditionalButton.addClass('button-primary');
                addProcessorButtonPulser = new QcformbuilderFormsButtonPulse( $newConditionalButton );
                window.setTimeout(function(){
                    addProcessorButtonPulser.startPulse();
                }, 3000);
            }

			var data = get_base_form(),
				db = $('#wfb-conditions-db');

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );

		});

		$( document ).on('click', '[data-open-group]', function(){


            var clicked = $( this ),
				id = clicked.data('openGroup'),
				db = $('#wfb-conditions-db'),
				data = get_base_form();

			data._open_condition = id;
			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );

		});

		$( document ).on('click', '[data-remove-line]', function(){
			var clicked = $( this ),
				id = clicked.data('removeLine');

			$('.condition-line-' + id).remove();

			var db = $('#wfb-conditions-db'),
				data = get_base_form();

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );
		});

		$( document ).on('click', '[data-remove-group]', function(){
			var clicked = $( this ),
				id = clicked.data('removeGroup');

			if( clicked.data('confirm') ){
				if( !confirm( clicked.data('confirm') ) ){
					return;
				}
			}

			$('.condition-point-' + id).remove();

			var db = $('#wfb-conditions-db'),
				data = get_base_form();

			data._open_condition = '';

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );
		});

		$( document ).on( 'keydown keyup keypress change', '[data-sync]', function( e ){
			var press = $( this ),
				target = $( press.data('sync') );
			if( target.is( 'input' ) ){
				target.val( press.val() ).trigger( 'change' );
			}else{
				target.html( press.val() );
			}
		});
		$( document ).on( 'change', '[data-bind-condition]', function(){

			$(document).trigger('show.fieldedit');

			var clicked = $(this),
				bind = $( clicked.data('bindCondition') );
			if( clicked.is(':checked') ){
				bind.val( clicked.val() );
			}else{
				bind.val( '' );
			}

			var data = get_base_form(),
				db = $('#wfb-conditions-db');

			db.val( JSON.stringify( data ) ).trigger( 'rebuild-conditions' );
		});
		$( document ).on( 'show.fieldedit', function(){

			var data = $('#qcformbuilder-forms-conditions-panel').formJSON(),
				condition_selectors = $( '.wfb-conditional-selector');
			condition_selectors.each( function(){
				var select 	 = $(this),
					selected = select.parent().val(),
					field = select.parent().data('id');

				select.empty();
				for( var con in data.conditions ){
					var run = true;
					// check field is not in here.
					for( var grp in data.conditions[con].group ){
						for( var ln in data.conditions[con].group[grp] ){
							if( data.conditions[con].group[grp][ln].field === field ){
								run = false;
							}
						}
					}
					if( true === run ){
						var sel = '',
							line = '<option value="' + con + '" ' + ( selected === con ? 'selected="selected"' : '' ) + '>' + data.conditions[con].name + '</option>';

						select.append( line );
					}
				}

			});
		});


	} );

</script>