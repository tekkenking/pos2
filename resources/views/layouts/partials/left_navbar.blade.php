<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                        <!--<span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg">
                        </span>-->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->name}}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li>
                                <a href="profile.html">
                                    <i class="fa fa-lock fa-lg"></i> Change Password
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('auth.logout')}}">
                                    <i class="fa fa-sign-out fa-lg"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <i class="fa fa-user fa-2x"></i>
                    </div>
                </li>

                @if( !empty(Menus::get()) )
                    @foreach(Menus::get() as $key => $menu )
                        @role($menu['role'])
                            <li>
                                <a href="{{route($menu['url'])}}">
                                    <i class="{{$menu['icon']}}"></i> 
                                    <span class="nav-label">{{$menu['name']}}</span>
                                    @if( isset($menu['submenu']) )
                                        <span class="fa arrow"></span>
                                    @endif
                                </a>

                                @if( isset($menu['submenu']) )
                                    <ul class="nav nav-second-level collapse">
                                    @foreach( $menu['submenu'] as $submenu)
                                        <li>
                                            <a href="{{route($submenu['url'])}}">
                                                <i class="{{$submenu['icon']}}"></i> 
                                                {{$submenu['name']}}
                                            </a>
                                        </li>
                                    @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endrole
                    @endforeach
                @endif
            </ul>

        </div>
    </nav>