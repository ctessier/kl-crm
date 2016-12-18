<div class="main-sidebar">
    <div class="sidebar">
        <ul class="sidebar-menu">
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
            <li class="{{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
                <a href="{{ url('/profile') }}">
                    <i class="fa fa-user"></i>
                    <span>Mon compte</span>
                </a>
            </li>
        </ul>
    </div>
</div>
