<div class="modal-header bg-primary text-white">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;
	</button>
	<h4 class="modal-title" id="myModalLabel">Add Categories</h4>
	<p> After creating categories. You can create this categories products </p>
</div>

<div class="modal-body">
	
	<h2 class="text-navy text-capitalize font-bold">{{$brand->name}}</h2>
	<hr>
	{!!Form::open(['route' => 'admin.cat.store', 'class'=>"m-t", 'id'=>'add-form', 'role'=>"form"])!!}
		<input type="hidden" name="brand_id" value="{{$brand->id}}">
		<div id="magicsuggest"></div>
		
		<hr>

		<div class="styledcheckbox">
			<input type="checkbox" name="type" value="service">
			<i class="font-21 ion-android-checkbox-outline-blank off"></i>
			<i class="font-21 ion-android-checkbox-outline on"></i>
			<label class="font-21">
        		Service
    		</label>
		</div>

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
    $('form#add-form').ajaxrequest_submit('#submit-save', {
        msgPlace : '.error-place',
        validate : {etype: 'group'},
        ajaxLoader : '.ajax-loader',
        pageReload: true,
    });

    $('#magicsuggest').magicSuggest({
    	name: 'cats',
    	placeholder : 'Type brands name here...',
    	required: true,
    });

    $('.styledcheckbox').styledcheckbox();
});
</script>