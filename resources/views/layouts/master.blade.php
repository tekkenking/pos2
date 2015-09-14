<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		{!! Larasset::start('header')->show('styles') !!}
		{!! Larasset::start('header')->show('scripts') !!}
		
		<title>Activa - @yield('title')</title>
	</head>
	
	<body class="pace-done {{systema('leftbar.status')}}">
	
		<div id="wrapper">

			@if(Auth::check())
				@include('layouts.partials.left_navbar')
			@endif

			<div id="page-wrapper" class="gray-bg dashbard-1">
	            @section('topbar')
	              @include('partials.navbar')
	            @show

				@section('breadcrumb')
					@include('partials.breadcrumb')
				@endsection
				
				<div class="row dwrapper wrapper-content">
					@section('main')
						@yield('content')
					@show
				</div>
			</div>
		</div>

		@include('partials.footer')
		@include('layouts.partials.modalbox')
	
	</body>
	
		{!! Larasset::start('footer')->show('scripts') !!}

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

</html>