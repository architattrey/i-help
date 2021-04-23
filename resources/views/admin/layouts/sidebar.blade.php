
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=url('/')?>/public/dist/img/hemkund_logo.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ucfirst(Auth::User()->name)}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
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
      <?php 
        //print_r($_SERVER["PHP_SELF"]);
        $address = explode("/", $_SERVER['PHP_SELF']);
        $class = "";
        if($address[2] == "dashboard"){
          $class = "active treeview";
        }elseif($address[2] == "languages"){
          $class = "active treeview";
        }elseif($address[2] == "medical-type"){
          $class = "active treeview";
        }elseif($address[2] == "user-actions"){
          $class = "active treeview";
        }elseif($address[2] == "transactions-actions"){
          $class = "active treeview";
        }elseif($address[2] == "blogs-actions"){
          $class = "active treeview";
        }elseif($address[2] == "videos-actions"){
          $class = "active treeview";
        }elseif($address[2] == "questions-actions"){
          $class = "active treeview";
        }elseif($address[2] == "answer-actions"){
          $class = "active treeview";
        }
      ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li>
        <li class="<?= $class;?>">
          <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
           </a>
        </li> -->
        <!--Language -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-language"></i>
            <span>Language</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('languages')}}"><i class="fa fa-circle-o"></i> Maintain Language</a></li>
          </ul>
        </li>
        <!--Medical Type -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-medkit"></i>
            <span>Medical</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('medical-type')}}"><i class="fa fa-circle-o"></i> Maintain Medical Type</a></li>
          </ul>
        </li>
        <!-- User -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('user-actions')}}"><i class="fa fa-circle-o"></i>&nbsp;Application Users</a></li>
          </ul>
        </li>
        <!-- All Transactions -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-university"></i>
            <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('transactions-actions')}}"><i class="fa fa-circle-o"></i>&nbsp;All Transactions</a></li>
          </ul>
        </li>
        <!--  blogs -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Blogs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('blogs-actions')}}"><i class="fa fa-circle-o"></i>&nbsp; All Blogs</a></li>
          </ul>
        </li>
        <!-- videos -->
       
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-video-camera"></i>
            <span>Videos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('videos-actions')}}"><i class="fa fa-circle-o"></i>&nbsp; All Videos</a></li>
          </ul>
        </li>
        <!--  Questions -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-question"></i>
            <span>Questions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('questions-actions')}}"><i class="fa fa-circle-o"></i>&nbsp; All Questions</a></li>
          </ul>
        </li>
        <!--  Questions Answer -->
        <li class="<?= $class;?>">
          <a href="#">
            <i class="fa fa-address-card"></i>
            <span>Answers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="<?= $class;?>">
            <li><a href="{{route('answer-actions')}}"><i class="fa fa-circle-o"></i>&nbsp;All Answers Of Questions</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>