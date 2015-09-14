<div class="modal-header bg-primary text-white">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel">Add Brand</h4>
	<p> After creating brand. You can create this brand categories </p>
</div>

<div class="modal-body">
		
	{!!Form::open(['route' => 'admin.brands.store', 'class'=>"m-t", 'id'=>'addbrand-form', 'role'=>"form"])!!}
		<div id="magicsuggest"></div>
	{!!Form::close()!!}

	<br>
	<div class="error-place font-18 text-center"></div>
	<div  class="ajax-loader">Please waint...<br>@include('partials.spinners')</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

	<button type="button" class="btn btn-primary" id="submit-save"><i class="fa fa-check fa-lg"></i> Create</button>
</div>

<script type="text/javascript">
$(function(){
    $('form#addbrand-form').ajaxrequest_submit('#submit-save', {
        msgPlace : '.error-place',
        validate : {etype: 'group'},
        ajaxLoader : '.ajax-loader',
        pageReload: true,
    });

    $('#magicsuggest').magicSuggest({
    	name: 'brands',
    	placeholder : 'Type brands name here...',
    	required: true,
    });
});
</script>