(function($){
	"use strict";
	$.fn.extend({
		ajaxtab : function (options){
			var opt, url, href, $that, content = {};

			opt = $.extend({
				loader:'<h3 class="text-muted text-center">Please wait. Now loading.....</h3>'
			}, options);

			return this.each(function(){
				$(this).on('click', function (e) {
					e.preventDefault();

					$that = $(this);

					href = this.hash; // We get the hash of the href link

					//Lets update the tab-pane id
					$that.closest('.nav-tabs')
					.next('.tab-content')
					.find('.tab-pane')
					.prop('id', href.substr(1));

					/*$('.tab-pane').prop('id', href.substr(1));*/

					//Ajax load on
					$(href).html(opt.loader);

					url = $(this).data('url'); // Get the ajax url on the link

					$.get(url, content, function(data){
						$(href).html(data);
						$that.tab('show');
					});

					return $that;
				});
			});

		}
	});
})(jQuery);