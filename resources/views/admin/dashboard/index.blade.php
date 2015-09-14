@extends('layouts.master')

@section('title', $pagetitle)

@section('topbar')
	@parent
@endsection


@section('main')

	@parent

	@section('content')		

		@include('admin.partials.sales')
		{{--@include('admin.partials.expenditures')--}}
		@include('admin.partials.fast_slow_selling')

	@endsection

@endsection