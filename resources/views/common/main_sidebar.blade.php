<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Tools</li>
        <!-- Optionally, you can add icons to the links -->
        @foreach ($groups as $group)
        <li @if ($route['name'] == $group->name) class="treeview active" @else class="treeview" @endif>
          <a href="#"><i class="fa fa-pencil"></i> <span>{{ $group->name }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          @foreach ($group->module as $module)
          <ul class="treeview-menu">
            <li @if ($route['id'] == $module->route_id) class="active" @endif><a href="{{ $module->route_path }}">{{ $module->name }} </a></li>
          </ul>
          @endforeach
        </li>
        @endforeach
        <li class="header">Quick Menu</li>
        <li><a href="#"><i class="fa fa-circle-o"></i> <span>Merchant Center</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>