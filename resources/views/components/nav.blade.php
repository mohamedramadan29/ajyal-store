


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @auth()
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('dist/img/user2-160x160.jpg')}} " class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"> {{Auth::user()->name}} </a>

                </div>
            </div>
        @endauth

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($items as $item)
                    <li class="nav-item">
                        <a href="{{route($item['route'])}}" class="nav-link {{Route::is($item['active'])? 'active' : ''}}">
                            <i class="{{$item['icon']}}"></i>
                            <p>
                                {{$item['name']}}
                                @if(isset($item['batch']))
                                <span class="right badge badge-danger"> {{$item['batch']}} </span>
                                @endif
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->
</aside>
