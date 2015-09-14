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
		        <ul class="nav nav-tabs right-title">
		        	<li class="title">


						<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-info btn-xs font-15 dropdown-toggle">Menu <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

		        		<button data-href="{{route('admin.product.create')}}" class="btn btn-xs font-15 btn-warning text-white" data-target=".bs-modal-nm" data-toggle="modal">
		        			<i class="fa fa-plus"></i> 
		        			Add Products
		        		</button>


		        	</li>

					<?php $counter = 1; ?>
					@foreach( $modes as $mo )
						<li @if( $counter == 1 ) class="active" @endif >
							<a href="#tab-{{$counter}}" data-toggle="tab" class="ajaxable" data-mode="{{$mo->id}}" data-url="">
									
								{{$counter++}}.	<span class="text-capitalize">{{$mo->name}}</span>
								
							</a>
						</li>

					@endforeach

		        </ul>
		        <div class="tab-content">
		            <div id="tab-1" class="tab-pane active">
		                <div class="panel-body">

		                	@include('admin.stocks.products.products')

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

		</script>
	@endsection
@endsection