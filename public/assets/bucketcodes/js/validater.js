/**
* CODE WRITTEN BY BUCKETCODES

	validate: { rules : {
			'name' : { required : 'left blank not' }
						}
			  },

*/
//Validation here
(function(c){
	"use strict";
	c.fn.extend({
		validater: function(options){
			var o, errorContainer='', fieldx={}, fieldxRules={}, fields, rules, currentName, catchFirstError_element;

			o = c.extend({
				rules:false,
				errorMessageType:'group',
				vdata:''
			}, options);

			var $that = (o.vdata === '') ? c(this) : o.vdata;

			//We must remove the error class from error fields
			//if( o.errorMessageType !== 'group' ){
				
				$that.find('.has-error').removeClass('has-error');
				
			//}
			
			var textFields 	= $that.find(':input').not(':radio, :checkbox, button, input[name="_method"], input[name="_token"]');

			var radios 		= $that.find(':radio');
			var checkboxes 	= $that.find(':checkbox');
			//console.log(textFields);
			
			//If radio or checkbox is with the form.. Then we can't use inline Error message with the validation..
			//So we forcefully set o.errorMessageType = 'group'
			if( (radios.length > 0 || checkboxes.length > 0)  && o.errorMessageType === 'inline'){
				console.log('This form used the validation errorMessageType:"inline", but it can\'t be used because the form contain either radio or checkbox which does not support the inline errorMessageType. errorMessageType being forcefully set to "group".');
				o.errorMessageType = 'group';
			}

			rules = 
			{ 
				required 		: 'is required',
				email 			: 'is invalid',
				integer 		: 'must be only numbers',
				phone 			: 'must be 11 digits',
				name			: 'must be only letters with space and apostroph',
				letter			: 'must be letters',
				date 			: 'is invalid. Accepted format is either mm/dd/yyyy or mm-dd-yyyy',
				range 			: 'out of range',
				conf 			: 'is not equal to ',
				alphanumeric	: 'must be only letters and numbers'
			};

			//Custom Rules;
			rules.numerical = rules.integer;

			var types = {
							email			: 	/([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/,
							name 			: 	/^[A-Za-z][a-zA-Z \']+$/,
							letter			:   /^[A-Za-z][a-zA-Z \s]+$/,
							phone 			: 	/^[(]?\d{4}[)]?\s?-?\s?\d{3}\s?-?\s?\d{4}$/,
							integer			: 	/^[0-9]+$/,
							date 			: 	/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/,
							alphanumeric	:	/^[a-zA-Z0-9 ]+$/
							//required	: 	//
						};

			//Custom Types
			types.fullname = types.name;
			types.numerical = types.integer;


			//Text inputs Verified
			if( textFields.length > 0 ){

				c.each(textFields, function(i){
					if( c(this).attr('validate') !== undefined ){
						fieldx[c(this).attr('name')] = {};
						currentName = c(this).attr('name');

						c.each(c(this).attr('validate').split('|'), function(v, k){
							if( k.match(/^(range:)[0-9\-]+/) !== null ){ //Catching Range
								var fromAndTo = k.split(':')[1];
								if( fromAndTo !== undefined ){
									var fromAndToArray = fromAndTo.split('-');
									fieldx[currentName]['range'] = {from:fromAndToArray[0], to:fromAndToArray[1], errormessage:rules['range']}
								}
							}else if( k.match(/^(conf:)/) !== null ){ //Catching conf
								var confirmField = k.split(':')[1];
								fieldx[currentName]['conf'] = {field : confirmField, errormessage : rules['conf']};
								
							}else{

								fieldx[currentName][k] = rules[k];

								//_debug(fieldx);
							}
							
						});
					}
				});
				
				o.rules = c.extend(true, fieldx, o.rules);

				//_debug(o.rules);
				
				processValidation(textFields);
			}

			//Radio Verified
			if( radios.length > 0 ){
				var groupedRadios = {};
				radios.each(function(i){

					if( groupedRadios[c(this).attr('name')] === undefined ){
							groupedRadios[c(this).attr('name')] = '';
					}

					if(c(this).is(':checked')){
							groupedRadios[c(this).attr('name')] = c(this).val();
						}

				});

				c.each(groupedRadios, function(i, v){
					if( v === '' ){
						errorContainer += '<div>' + i.capitalize().replace('_', ' ') + ' is required</div>';
					}
				});
			}

			//Validation for checkbox
			if( checkboxes.length > 0 ){
				checkboxes.each(function(i, k){

					//Lets gather the checkboxes with validate=required
					if( c(this).attr('validate') !== undefined && c(this).attr('validate') === 'required' )
					{
						//Lets gather error message on those checkboxes that are required but not checked
						if( c(this).is(':checked') === false ){
							//_debug( o.rules[c(this).attr('name')] );
							if( o.rules[c(this).attr('name')] !== undefined ){
								errorContainer += '<div>' + o.rules[c(this).attr('name')].required + '</div>';
							}else{
								errorContainer +='<div>' + c(this).attr('name').capitalize().replace('_', ' ') + ' is required </div>';
							}
						}
					}
				});

			}

			//We return the error messages
			return errorContainer;

			function processValidation(fields){
			
				c.each(fields, function(i, field){

					//Validation starts here
					if( o.rules[field.name] ){
					
						c.each(o.rules[field.name], function(k, v){

							if( k === 'required' ){ // Is required
								//_debug(k);
								if( field.value === '' || field.value === undefined || field.value.length < 1 ){
									var fieldname = field.name;
									focusMouseOnErrorElement(fieldname);
									
									//This is important when we set custom error message
									if( v.indexOf('#') === 0 ) {
										v = v.substr(1);
										fieldname = '';
									}else{
										fieldname = fieldname.replace('_', ' ', 'gi');
									}

									if( o.errorMessageType === 'inline' ){
										//inline_error_msg(field.name);
										errorContainer = (errorContainer === '') ? 'Required' : errorContainer;
									}else{
										errorContainer += '<div>'+ fieldname + ' ' + v + '</div>';
									}
										inline_error_msg(field.name);
									return false;
								}
							}
							
							//Field confirmation validation. e.g confirm-password must be equal to password. syntax [ conf:password ]
							if( k === 'conf' ){
								if( $that.find('input[name="'+ v.field +'"]').val() !== field.value ){
									var fieldname = field.name;
									focusMouseOnErrorElement(fieldname);
									
									//This is important when we set custom error message
									if( v.errormessage.indexOf('#') === 0 ) {
										v = v.errormessage.substr(1);
										fieldname = '';
									}else{
										v = fieldname +' ' + v.errormessage + ' '  + v.field;
										v = v.replace('_', ' ', 'gi');
									}
									
									if( o.errorMessageType === 'inline' ){
										//inline_error_msg(field.name);
										errorContainer = v;
									}else{
										errorContainer += '<div>' + v + '</div>';
									}
										inline_error_msg(field.name);
									return false;
								}

							} 

							//Format example: range	 : {from:1, to:10, errormessage:'Out of range'}
							if( k === 'range' ){ // Range
								var isNumber = new RegExp( types['numerical'] );
								//We'll check if the range is numerical
								if( isNumber.test(field.value) !== false ){
									field.value = parseInt(field.value);
									//We check if the number supplied is out of range
									if( field.value < v.from || field.value > v.to ){
										var fieldname = field.name;
										focusMouseOnErrorElement(fieldname);

										if( o.errorMessageType === 'inline' ){
											//inline_error_msg(field.name);
											errorContainer = v.errormessage;
										}else{
											errorContainer += '<div>'+ fieldname + ' ' + v.errormessage +'</div>';
										}
											inline_error_msg(field.name);
										return false;
									}
								}else{
										var fieldname = field.name;
										focusMouseOnErrorElement(fieldname);
										
									//This is important when we set custom error message
									if( v.indexOf('#') === 0 ) {
										v = v.substr(1);
										fieldname = '';
									}else{
										fieldname = fieldname.capitalize().replace('_', ' ', 'gi');
									}

										if( o.errorMessageType === 'inline' ){
											//inline_error_msg(field.name);
											errorContainer = rules['numerical'];
										}else{
											errorContainer += '<div>'+ fieldname + ' ' + rules['numerical'] + '</div>';
										}
										inline_error_msg(field.name);
										return false;
								}
							}

							//Other regex validation							
							if( types[k] !== undefined ){
								var pattern = new RegExp( types[k] );
								if( pattern.test(field.value) === false && field.value.length > 0 ){
									var fieldname = field.name;
									focusMouseOnErrorElement(fieldname);
										//This is important when we set custom error message
										if( v.indexOf('#') === 0 ) {
											v = v.substr(1);
											fieldname = '';
										}else{
											fieldname = fieldname.replace('_', ' ', 'gi');
										}

										if( o.errorMessageType === 'inline' ){
											//inline_error_msg(field.name);
											//errorContainer = v;
											errorContainer = (errorContainer === '') ? v : errorContainer;
										}else{
											errorContainer += '<div>'+ fieldname + ' ' + v + '</div>';
										}
										inline_error_msg(field.name);
									return false;
								}
							}

						});
					}
				});
			}

			//Function for setting focus on failed form element
			function focusMouseOnErrorElement(fieldname){
				//[ catchFirstError_element ] This would save after catching the first error element
				if( catchFirstError_element === undefined){
					catchFirstError_element = fieldname;
					//We select form element by it's name attribute value
					$('[name="'+catchFirstError_element+'"]').trigger('focus');
				}
			}

			function inline_error_msg(fieldname){
				//Lets check if .form-group is in the form field
				if( $('[name="'+fieldname+'"]').closest('.form-group').html() !== undefined ){
					//We add error class if control-group class is in the form field
					$('[name="'+fieldname+'"]').closest('.form-group').addClass('has-error');
				}else{
					//Else we add the error class directly to the form input, select or textarea
					$('[name="'+fieldname+'"]').addClass('has-error');
				}
			}

		}
	});
})(jQuery);