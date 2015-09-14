@extends('layouts.master')

@section('title', $pagetitle)

@section('topbar')
	@parent
@endsection

@section('main')

	@parent

	@section('content')		
		<div class="col-sm-8">
			@include('sales.partials.cart')
		</div>
		<div class="col-sm-4">
			@include('sales.partials.payment_details')
			@include('sales.partials.customer_actions')
			@include('sales.partials.suspended_cart')
		</div>
	@endsection

@endsection