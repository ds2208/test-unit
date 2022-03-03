<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index.index')}}" class="brand-link">
        <img src="{{url('themes/admin/dist/img/logoSSSS.jpg')}}" alt="Solarify Application" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Solarify Aplikacija</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.index.manual_set')}}" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Upravljaj svojim sistemom')
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Merenja')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.measurements.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Lista merenja')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.measurements.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Dodaj merenje')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Autori')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Autori')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Dodaj autora')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.comments.index')}}" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Komentari')
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            @lang('Reklame')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.ads.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Reklame')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.ads.add')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Dodaj reklamu')</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>