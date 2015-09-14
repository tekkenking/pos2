@extends('layouts.master')

@section('title', $pagetitle)

@section('topbar')
	@parent
@endsection


@section('main')

	@parent

	@section('content')	


		<div class="col-md-9">
		    <div class="tabs-container">
		        <ul class="nav nav-tabs left-title">
		        	<li class="title">
		        		<button data-href="{{route('admin.brands.create')}}" class="btn btn-xs font-15 font-boldx btn-warning text-white" data-target=".bs-modal-nm" data-toggle="modal">
		        			<i class="fa fa-plus"></i> 
		        			Add brand
		        		</button>
		        	</li>
		        	<li class=""><a data-toggle="tab" href="#tab-2"> Store Worth</a></li>
		            <li class="active"><a data-toggle="tab" href="#tab-1"> Available Brands</a></li>
		        </ul>
		        <div class="tab-content">
		            <div id="tab-1" class="tab-pane active">
		                <div class="panel-body">

							<table class="table table-striped table-bordered table-hover data-table" aria-describedby="DataTables_Table_0_info" role="grid">
			                    <thead>
				                    <tr role="row">
				                    	<th width="4%">
				                    		<a href="#" multiple-checkbox>All</a>
				                    	</th>
				                    	<th width="53%">Name</th>

				                    	<!--<th class="text-center" width="10%">Status</th>-->

				                    	<th width="18%">Category(s)</th>

				                    	<th width="25%">Actions</th>
				                    </tr>
			                    </thead>
			                    <tbody>
			                    
			                    	@if(!empty($brands))
			                    		@foreach( $brands as $brand )
						                    <tr class="gradeA odd" role="row">
						                    	<td>
													
													<div class="styledcheckbox">
														<input type="checkbox" name="brandid" value="{{$brand->id}}">
														<i class="font-21 ion-android-checkbox-outline-blank off"></i>
														<i class="font-21 ion-android-checkbox-outline on"></i>
													</div>
						                    		
						                    	</td>
						                    	<td>
						                    		<a href="{{route('admin.cat.index', ['catid' => $brand->id])}}">
						                    			<span class="font-15 text-capitalize">{{$brand->name}}</span>
						                    		</a>
						                    	</td>
						                        <!--<td class="text-center">
						                        	@if( $brand->published === 1 )
						                        		<a href="{{--route('admin.brand.togglestatus', ['id'=>$brand->id, 'status'=>$brand->published])--}}" class="toggle-status" title="published">
						                        			<i class="fa fa-check-circle text-info font-21"></i>
						                        		</a>
						                        	@else
						                        		<a href="{{--route('admin.brand.togglestatus', ['id'=>$brand->id, 'status'=>$brand->published])--}}" class="toggle-status" title="not published">
						                        			<i class="fa fa-circle text-danger font-21"></i>
						                        		</a>
						                        	@endif
						                        </td>-->
						                        <td>
						       						{{count($brand->productcategories)}}
						                        </td>
						                        <td class="center">
						                        <div class="btn-group">
						                        	<button data-href="{{route('admin.brand.edit', ['id'=>$brand->id])}}" data-target=".bs-modal-nm" data-toggle="modal" class="btn btn-sm btn-white font-bold" title="Edit"> 
							                			<i class="ion-edit"></i> Edit
							                		</button>

							                		<button data-href="{{route('admin.brand.delete', ['id'=>$brand->id])}}" name="{{$brand->name}}" class="btn btn-sm btn-danger font-bold sweetalert" title="Delete"> 
							                			<i class="ion-trash-b"></i> Del
							                		</button>
							                	</div>
						                        </td>
						                    </tr>
					                    @endforeach
				                   	@endif
			                    </tbody>
			                    <!--<tfoot>
			                    	<tr>
			                    		<th rowspan="1" colspan="1">Username</th>
			                    		<th rowspan="1" colspan="1">Roles</th>
			                    		<th rowspan="1" colspan="1">Actions</th>
			                    	</tr>
			                    </tfoot>-->
		                    </table>
		                </div>
		            </div>
		            <div id="tab-2" class="tab-pane">
		                <div class="panel-body">
		                    <strong>Donec quam felis</strong>

		                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
		                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

		                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
		                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
		                </div>
		            </div>
		        </div>


		    </div>
		</div>


		<div class="col-md-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title bg-primary text-white">
					<h5><i class="fa fa-cubes fa-lg"></i> Page menu </h5>
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
						<a href="#" class="list-group-item">
							Delete selected 
							<div class="inline pull-right">
								<i class="ion-trash-b font-21"></i>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(function(){
				$('.data-table').DataTable();

				$('.styledcheckbox').styledcheckbox();

				$('table').on('click', '.sweetalert', function(e){
					e.preventDefault();

					var $that = $(this);
					var name = $(this).attr('name');
					var url = $(this).attr('data-href');

				    swal({
				        title: "Are you sure?",
				        text: "You're about to delete <b class='text-capitalize text-danger'>["+name+"]</b> brand including all it's categories and products. This can not be reversed!",
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
				    			text: "<b class='text-capitalize text-danger'>["+name+"]</b> including all it's categories and products are deleted", 
				    			type: "success",
				    			html: true
				    		}, function(){
				    			location.reload(true);
				    		});
				    	});
				    });
				});

				//$('.toggle-status').toggleStatus();
			})
		</script>



	@endsection
@endsection