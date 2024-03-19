<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('redirect')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('show_category')}}">
          <i class="bi bi-layout-text-window-reverse"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('show_supplier_page')}}">
          <i class="bi bi-person"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-shop"></i><span>Purchase</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('show_purchase_page')}}">
              <i class="bi bi-circle"></i><span>Show Purchase</span>
            </a>
          </li>
          <li>
            <a href="{{url('add_purchase_page')}}">
              <i class="bi bi-circle"></i><span>Add Purchase</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('show_product_page')}}">
              <i class="bi bi-circle"></i><span>Show Products</span>
            </a>
          </li>
          <li>
            <a href="{{url('add_product_page')}}">
              <i class="bi bi-circle"></i><span>Add Products</span>
            </a>
          </li>
          <!-- <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Out Of Stock</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Expired</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Forms Nav -->

      <!-- End Tables Nav -->

    
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('show_sale_page')}}">
          <i class="bi bi-bar-chart"></i><span>Sales</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
  
      </li>
      
     
      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="">
          <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('sale_report')}}">
              <i class="bi bi-circle"></i><span>Sales Report</span>
            </a>
          </li>
          <li>
            <a href="{{url('purchase_report')}}">
              <i class="bi bi-circle"></i><span>Purchase Report</span>
            </a>
          </li>
          
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('logout')}}" onclick="return confirm('Are you sure wants to logout?')">
          <i class="bi bi-box-arrow-right"></i><span>{{Auth::user()->name}}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        
      </li>


      

      
    </ul>

  </aside><!-- End Sidebar-->
