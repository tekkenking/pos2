@extends('layouts.master')

@section('title', $pagetitle)

@section('left_navbar')@endsection

@section('topbar')@endsection

@section('main')
    @parent
    
    @section('content')

    <div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-6">
            <h2 class="font-bold">Welcome to IN+</h2>

            <p>
                Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
            </p>

            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
            </p>

            <p>
                When an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>

            <p>
                <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
            </p>

        </div>
        <div class="col-md-6">
            <div class="ibox-title bg-primary">
                <h2 class="text-white">Login to POS</h2>
            </div>
            <div class="ibox-content">
                {!!Form::open(['route' => 'auth.login', 'class'=>"m-t", 'id'=>'login-form', 'role'=>"form"])!!}
                    <div class="form-group">
                        {!!Form::text('username', '', ['placeholder'=>'Username', 'class'=>'form-control', 'validate'=>'required', 'autocomplete'=>'off'])!!}
                    </div>

                    <div class="form-group">
                        {!!Form::password('password', ['placeholder'=>'Password', 'class'=>'form-control', 'validate'=>'required', 'autocomplete'=>'off'])!!}
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b login-ajax">Login</button>
                {!!Form::close()!!}


                <div class="error-place"></div>

                <div  class="ajax-loader">@include('partials.spinners')</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('form#login-form').ajaxrequest_submit('.login-ajax', {
        msgPlace : '.error-place',
        validate : {etype: 'group'},
        ajaxLoader : '.ajax-loader'
    });
});
</script>

    @endsection
@endsection