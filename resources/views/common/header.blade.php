  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>IN</b>T</span>
      <span class="logo-lg">PPIN BACKEND</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- <img src="../img/avatar.jpg" class="user-image" alt="User Image"> -->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ $username or 'couponsn'}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <!-- <img src="../img/avatar.jpg" class="img-circle" alt="User Image"> -->

                <p>
                  {{ $userdesc or 'here is description' }}
                  <small>{{ $accesstime or 'here is accesstime' }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>

                <div class="pull-right">

                <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Sign out</a>
                        
                <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                    
              </div>

              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>