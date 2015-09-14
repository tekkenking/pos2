@extends('layouts.master')

@section('title', $pagetitle)

@section('topbar')
	@parent
@endsection


@section('main')

	@parent

	@section('content')		


<div class="col-lg-12">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"> Roles and Permissions</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">This is second tab</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">

                	<div>
	                	<div class="inline">
	                		<a href="#" data-href="{{route('admin.settings.addroleform')}}" data-target=".bs-modal-nm" data-toggle="modal" class="btn btn-info"> 
	                			Add Roles
	                		</a>
	                	</div>

	                	<!--<div class="pull-right">
	                		<a href="#" data-href="{{route('admin.settings.addroleform')}}" data-target=".bs-modal-nm" data-toggle="modal" class="btn btn-info"> 
	                			Add Permissions
	                		</a>
	                	</div>-->

                	</div>
                	<hr>
					<table class="table table-striped table-bordered table-hover data-table" aria-describedby="DataTables_Table_0_info" role="grid">
	                    <thead>
		                    <tr role="row">
		                    	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Name" style="width: 163px;">Name</th>

		                    	<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Username" style="width: 191px;">Username</th>

		                    	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="User roles" style="width: 238px;">Roles</th>

		                    	<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 214px;">Permissions</th>-->

		                    	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: Edit roles" style="width: 115px;">Actions</th>
		                    </tr>
	                    </thead>
	                    <tbody>
	                    	@if(!empty($resultset))
	                    		@foreach( $resultset as $user )
				                    <tr class="gradeA odd" role="row">
				                    	<td>
				                    		<span class="font-15">{{$user->name}}</span>
				                    	</td>
				                        <td class="sorting_1">
				                        	<span class="font-15">{{$user->username}}</span>
				                        </td>
				                        <td>
				                        	
			                        		@foreach($user->roles as $role)
			                        			<span class="label label-warning font-15">{{$role->name}}</span>
			                        		@endforeach
				                        
				                        </td>
				                        <td class="center">
				                        	<a href="#" data-href="{{route('admin.settings.assignroleform', ['userid' => $user->id])}}" data-target=".bs-modal-nm" data-toggle="modal" class="btn btn-sm btn-info font-bold"> 
					                			<i class="fa fa-edit fa-lg"></i> Edit
					                		</a>
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


<script type="text/javascript">
	$(function(){
		$('.data-table').DataTable();
	})
</script>
	@endsection

@endsection