 <aside id="left-panel" class="left-panel">
     <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
             <ul class="nav navbar-nav">
                 <li class="active">
                     <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                 </li>
                 <li class="menu-title">Master</li><!-- /.menu-title -->
                 <li>
                     <a href="{{ route('categories.index') }}"> <i class="menu-icon fa fa-cogs"></i>Category</a>
                 </li>
                 <li>
                     <a href="{{ route('suppliers.index') }}"> <i class="menu-icon fa fa-table"></i>Supplier</a>
                 </li>
                 <li>
                     <a href="{{ route('eoq_settings.index') }}"> <i class="menu-icon fa fa-bar-chart-o"></i>EOQ
                         Setting</a>
                 </li>
                 <li>
                     <a href="{{ route('users.index') }}"> <i class="menu-icon fa fa-users"></i>User Management</a>
                 </li>


                 <li class="menu-title">Menu</li><!-- /.menu-title -->


                 <li>
                     <a href="{{ route('products.index') }}"> <i class="menu-icon fa fa-tags"></i>Product</a>
                 </li>
                 <li>
                     <a href="widgets.html"> <i class="menu-icon fa fa-arrow-down"></i>Stock In</a>
                 </li>
                 <li>
                     <a href="widgets.html"> <i class="menu-icon fa fa-arrow-up"></i>Stock Out</a>
                 </li>

                 <li class="menu-title">Reports</li><!-- /.menu-title -->
                 <li>
                     <a href="widgets.html"> <i class="menu-icon fa fa-cloud-download"></i>Report In</a>
                 </li>
                 <li>
                     <a href="widgets.html"> <i class="menu-icon fa fa-cloud-upload"></i>Report Out</a>
                 </li>
             </ul>
         </div><!-- /.navbar-collapse -->
     </nav>
 </aside>
