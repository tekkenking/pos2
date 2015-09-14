<!-- Modal Normal-->
<div class="modal inmodal fade bs-modal-nm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    </div>
  </div>
</div>

<!-- Modal Large -->
<div class="modal inmodal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div>
  </div>
</div>

<!-- Modal Small -->
<div class="modal inmodal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	var $doc = $(this);
	
	$doc.on('click', '[data-href]', function(e){
		var url = $(this).data('href');
		var targetModal = $(this).data('target');

		var loader = '@include("partials.spinners")';
		
		$(targetModal)
		.find('.modal-content')
		.html('<div style="height:200px; margin:15% auto">' + loader + '</div>')
		.end()
		.find('.modal-content')
		.load(url)
		.end()
		.modal('show');
	});
	
});
</script>