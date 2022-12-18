<section class="sidebar">
  <!-- Sidebar user panel -->
  <!-- search form -->
  <!--<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>-->
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="<?php if(isset($dash)) echo $dash; ?>">
      <a href="<?php echo url('admin/dashboard'); ?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
      
      
      <li class="<?php if(isset($user_page)) echo $user_page; ?>">
      <a href="<?php echo url('admin/users'); ?>">
        <i class="fa fa-users"></i> <span>All users</span>
      </a>
    </li>
      
      <li class="<?php if(isset($pdriver_page)) echo $pdriver_page; ?>">
      <a href="<?php echo url('admin/verify-drivers'); ?>">
        <i class="fa fa-car"></i> <span>Drivers verification (<?php echo count($dpending); ?>)</span>
      </a>
    </li>
      
      <li class="<?php if(isset($pstudent_page)) echo $pstudent_page; ?>">
      <a href="<?php echo url('admin/verify-students'); ?>">
        <i class="fa fa-graduation-cap"></i> <span>Students verification (<?php echo count($spending); ?>)</span>
      </a>
    </li>
      
      <!--<li class="<?php if(isset($puser_page)) echo $puser_page; ?>">
      <a href="<?php echo url('admin/pending-users'); ?>">
        <i class="fa fa-users"></i> <span>Pending Users (<?php echo count($pending); ?>)</span>
      </a>
    </li>-->
      
      <li class="treeview <?php if(isset($active_rides)) echo $active_rides; ?> <?php if(isset($completed_rides)) echo $completed_rides; ?>">
      <a href="javascript:void(0)">
        <i class="fa fa-list"></i>
        <span>Manage rides</span>
        <span class="label label-primary pull-right">2</span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(isset($active_rides)) echo $active_rides; ?>"><a href="<?php echo url('admin/rides?s=1'); ?>"><i class="fa fa-circle-o"></i> <span>Active rides</span></a></li>
        <li class="<?php if(isset($completed_rides)) echo $completed_rides; ?>"><a href="<?php echo url('admin/rides?s=2'); ?>"><i class="fa fa-circle-o"></i> <span>Past rides</span></a></li>
      </ul>
      </li>
      
      <li class="<?php if(isset($bookings_page)) echo $bookings_page; ?>">
      <a href="<?php echo url('admin/bookings'); ?>">
        <i class="fa fa-ticket"></i> <span>All bookings</span>
      </a>
    </li>
      
      <li class="<?php if(isset($reviews_page)) echo $reviews_page; ?>">
      <a href="<?php echo url('admin/reviews'); ?>">
        <i class="fa fa-star"></i> <span>All reviews</span>
      </a>
    </li>
      
      <li class="<?php if(isset($transactions_page)) echo $transactions_page; ?>">
      <a href="<?php echo url('admin/transactions'); ?>">
        <i class="fa fa-credit-card"></i> <span>All transactions</span>
      </a>
    </li>
      
      <li class="<?php if(isset($withdrawal_page)) echo $withdrawal_page; ?>">
      <a href="<?php echo url('admin/withdrawal-requests'); ?>">
        <i class="fa fa-clone"></i> <span>Withdrawal requests (<?php echo count($w_requests); ?>)</span>
      </a>
      </li>
      
      <li class="<?php if(isset($b_credits_page)) echo $b_credits_page; ?>">
      <a href="<?php echo url('admin/booking-credits'); ?>">
        <i class="fa fa-database"></i> <span>Booking credits</span>
      </a>
      </li>
      
      <li class="treeview <?php if(isset($new_article)) echo $new_article; ?> <?php if(isset($all_articles)) echo $all_articles; ?>">
      <a href="javascript:void(0)">
        <i class="fa fa-newspaper-o"></i>
        <span>Manage news</span>
        <span class="label label-primary pull-right">2</span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if(isset($new_article)) echo $new_article; ?>"><a href="<?php echo url('admin/new-article'); ?>"><i class="fa fa-circle-o"></i> <span>New article</span></a></li>
        <li class="<?php if(isset($all_articles)) echo $all_articles; ?>"><a href="<?php echo url('admin/all-articles'); ?>"><i class="fa fa-circle-o"></i> <span>All articles</span></a></li>
      </ul>
      </li>

       <li class="<?php if(isset($video_setting)) echo $video_setting; ?>">
      <a href="<?php echo url('admin/video-setting'); ?>">
        <i class="fa fa-youtube"></i> <span>Videos</span>
      </a>
      </li>

      
      <li class="<?php if(isset($site_page)) echo $site_page; ?>">
      <a href="<?php echo url('admin/site-settings'); ?>">
        <i class="fa fa-cog"></i> <span>Site settings</span>
      </a>
      </li>
      
      

  </ul>
</section>
