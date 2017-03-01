<ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
       
        <li class="active">
          <a href="{{ url('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span>
              <i></i>
            </span>
          </a>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Layer
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('layers')}}"><i class="fa fa-circle-o"></i> List Layer</a></li>
              </ul>
            </li>
            <li><a href="{{ url('excel')}}"><i class="fa fa-circle-o"></i> Excel</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Jalan
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ url('admin/jalan/fungsi')}}"><i class="fa fa-circle-o"></i> Fungsi</a></li>
                  <li><a href="{{ url('admin/jalan/status')}}"><i class="fa fa-circle-o"></i> Status</a></li>
                </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('pengaturan/user') }}"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="{{ url('pengaturan/role') }}"><i class="fa fa-circle-o"></i> Level</a></li>
          </ul>
        </li>
          
        
        
</ul>