/********************** SELECTING ITEM *************************/
/*
* 10th Sept 2015
* Version 2.0
* HOW TO USE: 
<div class="styledcheckbox">
	<input type="checkbox" name="brandid" value="{{$brand->id}}">
	<i class="font-21 ion-android-checkbox-outline-blank off"></i>
	<i class="font-21 ion-android-checkbox-outline on"></i>
</div>

It apply already checked input normally:
<input type="checkbox" name="brandid" value="" checked="checked">
*
*/
(function ($) {
	"use strict";
	
	$.fn.extend({
		styledcheckbox : function (options){
			var opt, $dat, $that = $(this);
				$('body').on('click', '.styledcheckbox', function(e){
					e.preventDefault();
					e.stopImmediatePropagation();
					toggleSelectx($(this))
				});

				$('[multiple-checkbox]').on('click', function(e){
					//console.log(e);
					e.preventDefault();
					e.stopImmediatePropagation();

					$('.styledcheckbox').each(function(i){
						toggleSelectx($(this));

					});
				});

				function toggleSelectx($dis){
					$dat = $dis.find('input');
					if( $dat.prop('checked') === false || $dat.attr('checked') == undefined){
						$dat
						.prop('checked', true)
						.attr('checked', 'checked');
						$dis.find('.on').show();
						$dis.find('.off').hide();
					}else{
						$dat
						.prop('checked', false)
						.removeAttr('checked');
						$dis.find('.on').hide();
						$dis.find('.off').show();
					}
				}
		},
	});
})(jQuery);