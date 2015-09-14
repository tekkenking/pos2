/**
	CODE WRITTEN BY BUCKETCODES

	UPDATED: 11th September 2015

* JQUERY AJAX FORM PLUGIN
	DEPENDENCIES FILES FUNCTIONS:
	1.	js-debugger.js
		*_debug()
		*typeString(o)
		*validater
/*
	
	OPTIONS DESCRIBTION

	ajaxloader = This is where the ajax loader image would be displayed [DEFAULT: ''],
	msgPlace: =  This is 
	ajaxStatusMsg: This wil 'error-msg',
	wideAjaxStatusMsg: '',
	msgPlaceFade:0,
	close: false,
	disableSubmitButton:false,
	url:'',
	ajaxType: 'Post',
	responseType:'json',
	dataContent:'',
	redirectDelay: 2000,
	extraContent:'',
	validate: { vtype : {
			'name' : { required : 'left blank not' }
						}
			  },

*/

//To close error place. If the close symbol is clicked
$('body').on('click', 'button[data-close="alert"]', function(e){
	e.preventDefault();
	$(this).closest('.alert').removeClass('alert alert-danger alert-success alert-info').text('');
});

(function ($) {
	"use strict";
	$.fn.extend({
		ajaxrequest_submit : function (submitButton,options){
			var opt, $form;
			opt  = $.extend({
				ajaxLoader : false
			}, options);

			$form = $(this);

			//hide Ajax Loader
			ajaxLoaderFunc('hide');

			$(submitButton).on('click', function (e){
				e.preventDefault();

				 //show Ajax Loader
				ajaxLoaderFunc('show');

				$form.ajaxrequest(options);

				//hide Ajax Loader
				ajaxLoaderFunc('hide')
			});

			function ajaxLoaderFunc(state){
				if( opt.ajaxLoader !== false && state === 'show') $(opt.ajaxLoader).show();
				if( opt.ajaxLoader !== false && state === 'hide') $(opt.ajaxLoader).hide();
			}
		}
	});
})(jQuery);

(function (c) {
	"use strict";
	c.fn.extend({
		ajaxrequest : function (options) {
			var isCloseModalBox, o, form, msg='', alerttype, ajaxr, errorContainer ='', data = undefined, datax='', newClass, callbacks;
			
			o = c.extend({
					msgPlace:'',
					wideAjaxStatusMsg: '', // '.error-msg'
					ajaxStatusMsg : '',
					msgPlaceFade:0,
					close: false,
					closeButton: false,
					disableSubmitButton:false,
					url:'',
					ajaxType: 'Post',
					responseType:'json',
					contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
					processData : true,
					cache: true,
					dataContent:'',
					redirectDelay: 2000,
					extraContent:'',
					validate: false,
					vdata:'',
					pageReload: false,
					ajaxRefresh: false,
					targetHTMLplace:'',
					immediatelyAfterAjax_callback:'',
					beforeAjax_callback:'',
					afterAjax_callback:'',
					successCallback: '',
					clearfields: '',
					clearfieldsExcludes: '',
					
			},  options );
			
			//Setting the wideAjaxStatusMsg to msgPlace which is usually a form child, while wideAjaxStatusMsg is usually a document child
			o.msgPlace = (
							o.wideAjaxStatusMsg !== '' 
								&& 
							c(document).find(o.wideAjaxStatusMsg).text() !== undefined 
						) 
							? o.wideAjaxStatusMsg
							: o.msgPlace;

			/**** VALIDATION PROCESS ****/
			if(o.validate !== false){
 
				//Lets check if 
				var vtype, etype;
				vtype = o.validate;

				if(typeof(o.validate) === 'object'){
					if( o.validate.vtype !== undefined ) vtype = o.validate.vtype;

					if( o.validate.etype !== undefined ) etype = o.validate.etype;
				}

				errorContainer = c(this).validater({
					rules: vtype,
					errorMessageType: etype,
					vdata: o.vdata
				});

				//If error found. Return Error and quit the script from executing further
				if( errorContainer !== '' ){
					msg = errorContainer;
					alerttype = 'danger';
					statusMessage();

					return false;
				}
			}
			/**** VALIDATION PROCESS ENDS ****/

			o.msgPlaceFade = parseInt(o.msgPlaceFade);
			
			return this.each(function () {
				form =	c(this);
				
				//_debug(o.dataContent);

				//Lets disable submit button if not false
				if( o.disableSubmitButton !== false){
					o.disableSubmitButton.addClass('disabled').attr('disabled', 'disabled');
				}
	
				//Hide message place if shown before
				c(o.msgPlace).html(msg).hide();

					o.url = (o.url !== '') ? o.url : form.attr('action');

					/*if(
					
						typeof(o.dataContent) === 'object' 
						&& $.isArray(o.dataContent) === false){

						o.dataContent = (o.dataContent !== '') 
										? $.param(o.dataContent) 
										: form.serialize();
					}*/
					
					o.dataContent = (
										typeof(o.dataContent) === 'object' 
										&& $.isArray(o.dataContent) === false
									) ? $.param(o.dataContent) 
										: form.serialize();

					//this would check if the content is array
					if($.isArray(o.dataContent) === true){
						o.dataContent = {'javascriptArrayString' : o.dataContent.toString()};
					}

					//We check if extraContent is supplied..
					//If supplied then we make sure normal is also supplied
					//Then we serialize extra content which is in json format
					//The we concatenate extra content with the original content
					if( o.extraContent !== '' && o.dataContent !== ''){
						o.dataContent = o.dataContent + '&' + $.param(o.extraContent);
					}

					//_debug(o.beforeAjax_callback);

					if( o.beforeAjax_callback !== '' ){
							callbacks = c.Callbacks();
							callbacks.add( o.beforeAjax_callback );
							callbacks.fire();
						}

					//Ajax process starts here
					ajaxr = c.ajax({
						url 		: o.url,
						type 		: o.ajaxType,
						dataType 	: o.responseType,
						data 		: o.dataContent,
						cache 		: o.cache,
						processData : o.processData,
						contentType : o.contentType,
					});

					/*ajaxr.always(function(data){

					});*/

					ajaxr.done(function(data){
						
						datax = data;

						if( o.immediatelyAfterAjax_callback !== '' ){
						
							callbacks = c.Callbacks();
							callbacks.add( o.immediatelyAfterAjax_callback );
							callbacks.fire(data);
							return false;
						}

						if( o.responseType !== 'json' ){
							c(o.targetHTMLplace).html(data);
							return false;
						}
	
						//An ajax message is returned assign it to msg
						if( data.message !== undefined && $.trim(data.message) !== ''){
							if( c.isArray(data.message) ){
								c.each(data.message, function(key, value){
										msg +='<div>' + value + '</div>';
								});
							}else{
								msg = '<div>' + data.message + '</div>';
							}
						}

						if( data.arraymessage !== undefined )
						{
							c.each(data.arraymessage, function(key, value){
								msg +='<div>' + value + '</div>';
							});
						}

						//If url is returned and message status is success
						if( data.url !== undefined && (data.status !== 'error' && data.status !== 'danger')){
							//if( msg !== '' ){
								alerttype = (data.alerttype === undefined) ? data.status : data.alerttype;
								
								statusMessage();
								
								//_debug(data.url);
								//return false;

								//Redirect delay must be 800 and above. To avoid program and browser crash
								o.redirectDelay = parseInt(o.redirectDelay);
								o.redirectDelay = (o.redirectDelay < 800) ? 800 : o.redirectDelay;

								setInterval(function(){
									window.location.replace(data.url);
								}, o.redirectDelay);
							//}

						}else if( data.status !== undefined ){
							//If close variable is set to true. Means if status is not a "fail", the modalbox should close
							if( o.close === true && (data.status !== 'error' && data.status !== 'danger')){
								isCloseModalBox = true;
							}
								
						}else{
							//LaraVel validation Json Object is here with deeper array dept
							//We have to check if we are using laravel 3 or laravel 4 and set the appropriate
							data = (data.errors !== undefined) ? data.errors : data;
							c.each(data, function(key, value){ msg +='<div>' + value + '</div>'; });
							
							//We'll manually assign the error class here for twitter bootstrap
							data.status = 'danger';
						}

						//Showing the Ajax Error in the assigned container
						//With the assigned twitter_boostrap alert class attribute, from server
						alerttype = (data.alerttype === undefined) ? data.status : data.alerttype;
						statusMessage();

						if( o.successCallback !== '' && (data.status !== 'danger') || (data.status !== 'error' ) ){

							callbacks = c.Callbacks();
							callbacks.add( o.successCallback );
							callbacks.fire(data);
						}
						

						//Closing modalbox
						if( isCloseModalBox === true ){
							//setInterval(function(){
								var disModal = form.closest('.modal');
								disModal.modal('hide');


								if(o.ajaxRefresh !== false  && data.status === 'success'){
									disModal.on('hidden.bs.modal', function(e){
										//_debug(e);
										c(o.ajaxRefresh).ajaxrefresh();
									});

									//o.ajaxRefresh = false;
								}

								
								//window.ajaxrefresh();
							//}, parseInt(o.redirectDelay));
						}

						//If ajax page refresh and browser refresh is active at the same time? Ajax refresh would be disabled
						if(o.ajaxRefresh !== false && o.pageReload !== false ){o.ajaxRefresh = false;}

						//Browser refresh
						if(o.pageReload === true && data.status === 'success'){
							//_debug(o.pageReload);
							//window.location.href=window.location.href;
							location.reload(true);
						}


						//Ajax refresh NOT YET COMPLETE
						if(o.ajaxRefresh !== false  && data.status === 'success'){
							c(o.ajaxRefresh).ajaxrefresh();
						}
	
						//To fadeout status message
						if( o.msgPlaceFade > 0 ){
							c(o.msgPlace).delay(o.msgPlaceFade).fadeOut('slow');
						}
					
						//For submit button
						if(o.disableSubmitButton !== false){
							//If submit button is disabled re-enable
							if( o.disableSubmitButton.hasClass('disabled') === true){
								o.disableSubmitButton.removeClass('disabled').removeAttr('disabled', 'disabled');
							}
						}
					
						//For selected fields clearance after success
						if( o.clearfields !== '' && (data.status !== 'danger' && data.status !== 'error' ) ){
							//clearfields();
							form.freset({
								clearfields : o.clearfields,
								clearfieldsExcludes : o.clearfieldsExcludes
							});
						}
						
						if( o.afterAjax_callback !== '' ){
							callbacks = c.Callbacks();
							// add the function "foo" to the list
							callbacks.add( o.afterAjax_callback );
							callbacks.fire(data);
							return false;
						}

					});

					ajaxr.fail(function(jqXHR, textStatus){
						//console.log(jqXHR);
						if( jqXHR.responseJSON !== undefined ){
							//msg = "<div>ERROR:</div><br>";
							c.each(jqXHR.responseJSON, function(typex, valuex){
								msg += "<div>" + typex+': ' +valuex + "</div><br>";
							});

						}else{
							msg = jqXHR.responseText;
						}

						alerttype = 'danger';
						statusMessage();
					});

			});
			
			/* SETS OF FUNCTIONS */
			function statusMessage(){

				if( msg !== undefined && msg !== '' ){

					//Check if it's by ID or Class
					newClass = ( o.msgPlace.indexOf('#') !== -1) ? o.ajaxStatusMsg : o.msgPlace;
					
					c(o.msgPlace)
					.html(function(){
						if( o.closeButton === true ){
							return '<button data-close="alert" class="close"><i class="fa fa-times"></i></button>' + msg;
						}else{
							return msg;
						}
					})
					.prop('class', ((newClass.indexOf('.') !== -1) ? newClass.substr(1) : newClass) + ' ' + 'alert alert-' + alerttype ).show()

				}
			}

		}
	});
})(jQuery);