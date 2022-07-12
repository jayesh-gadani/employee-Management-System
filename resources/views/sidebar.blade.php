 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/index.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Karavya Soltions</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          <a style="color:white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{'/home'}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
            
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-user" aria-hidden="true"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
               <li class="nav-item">
                <a href="{{route('user')}}" class="nav-link">
                  <i class="fa fa-list" aria-hidden="true"></i>
                  <p>List User</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('add')}}" class="nav-link">
                  <i class="fa fa-user-plus" aria-hidden="true"></i>
                  <p>Add New User</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-briefcase" aria-hidden="true"></i>
              <p>
                Projects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('listing_project')}}" class="nav-link">
                  <i class="fa fa-list" aria-hidden="true"></i>
                  <p>List Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('add_project')}}" class="nav-link">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>

                  <p>Add New Projects</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
             <i class="fa fa-tasks" aria-hidden="true"></i>
              <p>
                Tasks
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{route('listing_task')}}" class="nav-link">
                  <i class="fa fa-list" aria-hidden="true"></i>
                  <p>List Task</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('add_task')}}" class="nav-link">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                  <p>Add NewTask</p>
                </a>
              </li>
              
              </ul>
          </li>

          <li class="nav-item">
            <a href='{{route('change_password')}}' class="nav-link">
            <i class="fa fa-key" aria-hidden="true"></i>
              <p>
                Change Password
                
              </p>
            </a>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        {{ __('Logout') }}
                                    </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </a>
          </li>
      
  
         
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>