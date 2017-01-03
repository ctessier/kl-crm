@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://fakeimg.pl/160x160/00a65a/ffffff/?text={{ Auth::user()->name[0] }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Connecté</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i><span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          <li><a href="{{ route('consumers.index') }}"><i class="fa fa-cutlery"></i> <span>{{ trans('krisslaure.consumers') }}</span></a></li>
          <li><a href="{{ route('stock.edit') }}"><i class="fa fa-list"></i> <span>{{ trans('krisslaure.stock') }}</span></a></li>

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>

          <li><a href="{{ route('profile.show') }}"><i class="fa fa-user"></i> <span>{{ trans('krisslaure.profile') }}</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
