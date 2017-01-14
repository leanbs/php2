<header class="main-header">
    <!-- Logo -->
    <a class="logo" href="{{ url('/') }}">
        <img class="brand-image" alt="Brand" src="{{ asset('assets/img/logo-metro.png') }}" width="160">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
     
                            <p>
                            {{ Auth::user()->name }} - {{ Auth::user()->role }}
                            
                            </p>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>