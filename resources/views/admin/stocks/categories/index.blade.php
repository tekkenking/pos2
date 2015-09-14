@extends('layouts.master')

@section('title', $pagetitle)

@section('topbar')
	@parent
@endsection


@section('main')

	@parent

	@section('content')	
		<div class="col-md-9">
			@if( !empty($categories) )
				<?php $counter = 0; ?>
				<?php $counted = 3; ?>
				<?php $countedCat = count($categories->productcategories); ?>

				@foreach($categories->productcategories as $cat)

					@if( $counter == 0 )
						<div class="row">
					@endif

					@if( $counter <= $counted )
						<div class="col-md-4">
							<div class="ibox">
								<div class="ibox-title">
									<a href="{{route('admin.product.index', ['brandid' => $brand->id, 'catid' => $cat->id ])}}">
										<h5 class="text-capitalize text-navy">
											{{$cat->name}}
										</h5>
									</a>
								</div>
								<div class="ibox-content">
			                        <div class="text-capitalize">
			                        	Total {{$cat->type}}s : {{count($cat->products)}}
			                        </div>
		                    	</div>
		                    	<div class="ibox-footer bg-inverse">
		                    		<div class="styledcheckbox">
										<input type="checkbox" name="catid" value="{{$cat->id}}">
										<i class="text-white fa fa-square-o font-21 off"></i>
										<i class="text-white fa fa-check-square font-21 on"></i>
									</div>


		                        	<!--@if( $cat->published === 1 )
		                        		<a href="#" class="text-info" title="published">
		                        			<i class="fa fa-check-circle font-21"></i>
		                        		</a>
		                        	@else
		                        		<a href="#" class="text-danger" title="not published">
		                        			<i class="fa fa-circle font-21"></i>
		                        		</a>
		                        	@endif-->

			                        <div class="btn-group pull-right">
			                        	<button data-href="{{route('admin.cat.edit', ['catid'=>$cat->id])}}" data-target=".bs-modal-nm" data-toggle="modal" class="btn btn-xs btn-white font-bold" title="Edit"> 
				                			<i class="ion-edit"></i> Edit
				                		</button>

				                		<button data-href="{{route('admin.cat.delete', ['catid'=>$cat->id])}}" name="{{$cat->name}}" class="btn btn-xs btn-danger font-bold sweetalert" title="Delete"> 
				                			<i class="ion-trash-b"></i> Del
				                		</button>
				                	</div>
		                    	</div>
							</div>
		                </div>
		                <?php $counter++; $countedCat--; ?>
	                @endif

					@if( $counter >= $counted || $countedCat == 0) 
						<?php $counter = 0; ?>
						</div>
					@endif

				@endforeach
			@else

			@endif
		</div>

		<div class="col-md-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title bg-primary text-white text-capitalize">
					<h5><i class="fa fa-cube fa-lg"></i> {{$brand->name}} menu </h5>
				</div>

				<div class="ibox-content no-padding">
					<div class="list-group">
						<!--<a href="#" class="list-group-item">
							Toggle status 
							<div class="inline pull-right">
								<i class="fa fa-check-circle text-info font-21"></i> 
								<i class="fa fa-circle text-danger font-21"></i>
							</div>
						</a>-->

						<a href="#" class="list-group-item" data-href="{{route('admin.cat.create', ['brandid' => $brand->id])}}" data-target=".bs-modal-nm" data-toggle="modal">
							Add Categories
							<div class="inline pull-right">
								<i class="fa fa-plus font-21"></i>
							</div>
						</a>	

						<a href="#" class="list-group-item" multiple-checkbox>
							Toggle Categories
							<div class="inline pull-right">
								<i class="fa fa-check-square-o font-21"></i>
							</div>
						</a>

						<a href="#" class="list-group-item">
							Delete Selected 
							<div class="inline pull-right">
								<i class="ion-trash-b font-21"></i>
							</div>
						</a>

						<a href="{!!route('admin.brands.index')!!}" class="list-group-item">
							Go Back
							<div class="inline pull-right">
								<i class="ion-arrow-return-left font-21"></i>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
	$(function(){
		$('.styledcheckbox').styledcheckbox();
		
		$('.sweetalert').on('click', function(e){
			e.preventDefault();

			var $that = $(this);
			var name = $(this).attr('name');
			var url = $(this).attr('data-href');

		    swal({
		        title: "Are you sure?",
		        text: "You're about to delete <b class='text-capitalize text-danger'>["+name+"]</b> category including it's products. This can not be reversed!",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#DD6B55",
		        confirmButtonText: "Yes, delete it!",
		        closeOnConfirm: false,
		        html: true
		    }, function(){
		    	$.get(url, function(data){
		    		swal({
		    			title: "Deleted!", 
		    			text: "<b class='text-capitalize text-danger'>["+name+"]</b> including all it's products are deleted", 
		    			type: "success",
		    			html: true
		    		}, function(){
		    			location.reload(true);
		    		});
		    	});
		    });
		});

	});
</script>
	@endsection
@endsection