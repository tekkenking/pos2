<div class="modal-header bg-primary text-white">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel">Add Role</h4>
	<small class="font-bold"> Creating staff role </small>
</div>

<div class="modal-body">
		
	{!!Form::open(['route' => 'admin.settings.saverole', 'class'=>"m-t", 'id'=>'addrole-form', 'role'=>"form"])!!}
		<div class="mesh-input-group">
		    {!!Form::text('name', '', ['placeholder'=>'Role Name', 'class'=>'form-control', 'validate'=>'required', 'autocomplete'=>'off'])!!}
		    {!!Form::text('slug', '', ['placeholder'=>'Role Slug', 'class'=>'form-control', 'validate'=>'required', 'autocomplete'=>'off'])!!}
		    {!!Form::text('description', '', ['placeholder'=>'Role Description', 'class'=>'form-control', 'validate'=>'alphanumeric', 'autocomplete'=>'off'])!!}
		    {!!Form::text('level', '', ['placeholder'=>'Role Level', 'class'=>'form-control', 'validate'=>'numerical', 'autocomplete'=>'off'])!!}
	    </div>
	{!!Form::close()!!}

	<div class="error-place font-18 text-center"></div>
	<div  class="ajax-loader">@include('partials.spinners')</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

	<button type="button" class="btn btn-primary" id="submit-save"><i class="fa fa-check fa-lg"></i> Create</button>
</div>

<script type="text/javascript">
$(function(){
    $('form#addrole-form').ajaxrequest_submit('#submit-save', {
        msgPlace : '.error-place',
        validate : {etype: 'group'},
        ajaxLoader : '.ajax-loader',
        clearfields: true,
    });
});
</script>