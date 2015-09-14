<div class="modal-header bg-primary text-white">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel">Edit Brand</h4>
	<p> Correct or change the current brand name here... </p>
</div>

<div class="modal-body">
	
	<h4 class="text-capitalize">{{$brand->name}}</h4>

	{!!Form::open(['route' => ['admin.brand.update', $brand->id], 'class'=>"m-t", 'id'=>'editbrand-form', 'role'=>"form"])!!}
		{!!Form::text('name', $brand->name, ['validate' => 'required', 'placeholder' => 'Edit brand name', 'class' => 'form-control'])!!}
	{!!Form::close()!!}

	<br>
	<div class="error-place font-18 text-center"></div>
	<div  class="ajax-loader">Please waint...<br>@include('partials.spinners')</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

	<button type="button" class="btn btn-success" id="submit-update"><i class="fa fa-check fa-lg"></i>Update</button>
</div>

<script type="text/javascript">
$(function(){
    $('form#editbrand-form').ajaxrequest_submit('#submit-update', {
        msgPlace : '.error-place',
        validate : {etype: 'group'},
        ajaxLoader : '.ajax-loader',
        pageReload: true,
    });
});
</script>