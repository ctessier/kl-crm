<div class="main-sidebar">
    <div class="sidebar">
        <ul class="sidebar-menu">
            @if (Auth::check())
            <li class="{{ Route::currentRouteNamed('dashboard') ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="{{ Route::currentRouteNamed('consumers.index') ? 'active' : '' }}">
                <a href="{{ url('/consumers') }}">
                    <i class="fa fa-cutlery"></i>
                    <span>Mes consommateurs</span>
                </a>
            </li>
            <li class="header">UTILISATEUR</li>
            <li class="{{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
                <a href="{{ url('/profile') }}">
                    <i class="fa fa-user"></i>
                    <span>Mon compte</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
            @else
                <li class="active">
                    <a href="{{ url('/login') }}">
                        <i class="fa fa-sign-in"></i>
                        <span>Connexion</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
