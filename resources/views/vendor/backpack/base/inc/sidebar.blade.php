@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://fakeimg.pl/160x160/00a65a/ffffff/?text={{ Auth::user()->name[0] }}" class="img-circle" alt="Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('layout.logged-in') }}</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i><span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          <li><a href="{{ route('consumers.index') }}"><i class="fa fa-cutlery"></i> <span>{{ trans('layout.consumers') }}</span></a></li>
          <li><a href="{{ route('stock.edit') }}"><i class="fa fa-list"></i> <span>{{ trans('layout.stock') }}</span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-shopping-cart"></i> <span>{{ trans('layout.consumers-orders') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ route('consumer_orders.create') }}"><i class="fa fa-plus"></i> <span>{{ trans('actions.create') }}</span></a></li>
              <li><a href="{{ route('consumer_orders.index') }}"><i class="fa fa-eye"></i> <span>{{ trans('actions.view-all') }}</span></a></li>
            </ul>
          </li>

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>

          <li><a href="{{ route('profile.show') }}"><i class="fa fa-user"></i> <span>{{ trans('layout.profile') }}</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
