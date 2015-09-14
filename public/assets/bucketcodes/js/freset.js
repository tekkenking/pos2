/***
* usage: $(form).freset( options )
*
*
* options = true | 'all' | 'field1, field2, field3'
***/

(function ($){
	"use strict";
		$.fn.extend({
			freset : function( options ){
				var cfields = [], $form, ar, $cf, o, nameType;

				o = $.extend({
					clearfields : '',
					clearfieldsExcludes : ''
				}, options);

				return this.each(function (){

					$form = $(this);

					if( o.clearfields === true || o.clearfields.toLowerCase() == 'all' ){
						ar = $form.find('input[type="text"], input[type="password"], textarea, input[type="number"], input[type="date"],input[type="email"],input[type="tel"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="url"],input[type="search"],input[type="color"],select').not(o.clearfieldsExcludes).get();

						$.each(ar, function(i,v){
							cfields.push($(v).attr('name'));
						});

					}else{
						cfields = o.clearfields.split(',');
					}
					
					$.each(cfields, function(i,v){
						$cf = $('[name="'+ v +'"]');

						//If it's Input
						if( $cf.is("input") && ($cf.prop('type') !== undefined) ) {
							nameType = $cf.prop('type').toLowerCase();

							//If it's checkbox
							if( nameType === 'checkbox' && ( $cf[0].checked ) ){
								$cf.prop("checked", false);
							}else{
								$cf.val('');
							}

						}

						//We reset select to the first option
						if( $cf.is("select") ){
							$cf.find('option:first').prop('selected', 'selected');
						}
						//If its text area
						if( $cf.is("textarea") ) $cf.text('');
					
					});

				});

			},
		});

})(jQuery);