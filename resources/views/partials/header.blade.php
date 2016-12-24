<header class="main-header">
    <a href="{{ url('/') }}" class="logo">
        <span class="logo-mini"><strong>KL</strong></span>
        <span class="logo-lg"><strong>K</strong>riss-<strong>L</strong>aure</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        @if (Auth::check())
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!--<li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">2</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Vous avez 2 notifications</li>
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios-people info"></i> Contacter Bernard Brochard
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Tout voir</a></li>
                    </ul>
                </li>-->

                <li class="user user-menu">
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>
                        Déconnexion
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:none;">
                          {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </nav>
</header>
