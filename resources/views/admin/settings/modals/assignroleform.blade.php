<div class="modal-header bg-primary text-white">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel">Assign Roles to user</h4>
	<small class="font-bold"> Assigning roles to user </small>
</div>

<div class="modal-body">
		
	{!!Form::open(['route' => ['admin.settings.saveassignrole', $userid], 'class'=>"m-t", 'id'=>'assignrole-form', 'role'=>"form"])!!}

	@if( !empty($roles) )
		@foreach( $roles as $role )
			<div class="styledcheckbox">
				<input type="checkbox" @if(!empty($user_roles) && isset($user_roles[$role->slug])) checked="checked" @endif name="roleids[]" value="{{$role->id}}">
				<i class="font-21 ion-android-checkbox-outline-blank off"></i>
				<i class="font-21 ion-android-checkbox-outline on"></i>

				<label for="checkbox{!!$role->id!!}" class="font-21">
	        		{{$role->name}}
	    		</label>
			</div><br>
		@endforeach
	@else
		<h3 class="alert alert-danger"> You need to create roles, before assigning to users </h3>
	@endif

	{!!Form::close()!!}

	<div class="error-place font-18 text-center"></div>
	<div  class="ajax-loader">@include('partials.spinners')</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

	<button type="button" class="btn btn-primary" id="submit-save"><i class="fa fa-check fa-lg"></i> Assign</button>
</div>

<script type="text/javascript">
$(function(){
    $('form#assignrole-form').ajaxrequest_submit('#submit-save', {
        msgPlace : '.error-place',
        pageReload : true,
        ajaxLoader : '.ajax-loader',
    });

	$('.styledcheckbox').styledcheckbox();

});
</script>