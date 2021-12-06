<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{Auth::user()->thumb}}" class="img-circle elevation-2" width="30" height="30" alt="User Image">
                    <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right p-0" style="max-height: calc(100vh - 62px - 100px);width: 354px" aria-labelledby="navbarDropdown">
                    <div class="card card-widget widget-user m-0">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
                            <h5 class="widget-user-desc">Founder & CEO</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{Auth::user()->img}}" alt="{{Auth::user()->name}}">
                        </div>
                        <div class="card-footer pb-0">
                            <div class="row border-top ">
                                <div class="col border-right ">
                                    <div class="description-block">
                                        <a class="btn btn-outline-info" href="{{ route('profile') }}">
                                            {{ __('Profile') }}
                                        </a>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col">
                                    <div class="description-block">
{{--                                        <h5 class="description-header">35</h5>--}}
{{--                                        <span class="description-text">PRODUCTS</span>--}}

                                        <a class="btn btn-outline-warning" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>



                </div>
            </li>
        @endguest
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
{{--                <i class="fas fa-th-large"></i>--}}
{{--            </a>--}}
{{--        </li>--}}


    </ul>
</nav>
<!-- /.navbar -->
