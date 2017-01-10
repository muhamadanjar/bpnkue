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
              <a href="#"><i class="fa fa-circle-o"></i> Kuesioner
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('kuesioner')}}"><i class="fa fa-circle-o"></i> List Kuesioner</a></li>
              </ul>
            </li>
            <li><a href="{{ url('excel')}}"><i class="fa fa-circle-o"></i> Excel</a></li>
          </ul>
        </li>
          
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
</ul>