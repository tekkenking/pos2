/** TOGGLES STATUS FOR BOTH SINGLE AND MULTIPLE REQUEST **/
(function($){
	"use strict";
		$.fn.extend({
			toggleStatus : function(options){
				var o, checkboxes =[], ID, URL, pageReload=false, $that;

				o= $.extend({
					published : 'fa fa-check-circle text-info',
					unpublished: 'fa fa-circle text-danger'
				}, options);

				return this.each(function(){
					$(this).on('click', function(e){
					e.preventDefault();
					e.stopImmediatePropagation(); // This would stop if from Double event fire
						if( $(this).hasClass('multipletogglestatus') ){
							
							$('input:checked').not('#default_checkbox').each(function(i){
								checkboxes[i] = $(this).val();
								if( URL === undefined ){
									URL = $(this).closest('tr').find('a.togglepublished').attr('status-url');
								}
							});

							if( checkboxes.length == 0 ){
								bootbox.alert('Nothing to publish or unpublish');
								return false;
							}

							//Assigns the IDs
							ID = checkboxes;

							//Reloads the Page for Multiple toggle
							pageReload = true;

							//Ajax Call to update the status in database
							callAjax($(this));

							//Lets empty the saved Arrays
							checkboxes = []; ID = '';
						}

						//Single Toggle
						if( $(this).hasClass('toggle-status') ){
							$that = $(this);

							//var ID = $(this).attr('status-id');
							URL = $(this).attr('href');

							$.get(URL, function(data){
								$that.find('i')
								//.toggleClass(o.published + ' ' + o.unpublished)
								.addClass(function(){
									if( $(this).hasClass(o.published) ){
										$(this).removeClass(o.published);
										//that.attr('title','Unpublished for sale')
										return o.unpublished;
									}else{
										$(this).removeClass(o.unpublished);
										//that.attr('title','Published for sale')
										return o.published;
									}
								});
							});

							//Ajax Call to update the status in database
							//callAjax($(this));

							/*$(this).find('i')
							.addClass(function(){
								if( $(this).hasClass('fa fa-check-circle') ){
									$(this).removeClass('icon-ok-sign green');
									//that.attr('title','Unpublished for sale')
									return 'icon-minus-sign red';
								}else{
									$(this).removeClass('icon-minus-sign red');
									//that.attr('title','Published for sale')
									return 'icon-ok-sign green';
								}
							});*/
						}

						function callAjax(that){
						//Ajax request
							that.ajaxrequest({
								dataContent:{id:ID},
								url: URL,
								pageReload: pageReload,
							});
						}

					});

				});
			}
		});

})(jQuery);