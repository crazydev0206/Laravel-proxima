<?php include(app_path() . '/common/header.php'); ?>
<link href="<?php echo url('stylesheets/uikit.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('javascripts/libs/flot/flot.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/perfect-scrollbar.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/dashboard.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/wave.css'); ?>" rel="stylesheet" />



<style>
.home__header__main .container-fluid {
    padding: 0;
}
</style>
<style type="text/css">
.layout-fixed .layout-1 .layout-sidenav,
.layout-fixed-offcanvas .layout-1 .layout-sidenav {
    top: 0px !important;
}

.layout-container {
    padding-top: 0px !important;
}

.layout-content {
    padding-bottom: 0px !important;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: 'Futura', sans-serif;
}

h5 {
    font-size: 1.25rem;
}
</style>
<?php 

$ac_t = $user->account_type; 
$gender;
$dir;
$name;
$to;
$from;
$total_trip = 0;

foreach($booking as $book)     
{
    $gender = $user->gender;
    $dir = $book->profile_image ? 'profile_images/'.$book->profile_image : ( ($gender == 'Male') ? 'male.png' : 'female.png');

    $name = $book->first_name . ' '. $book->last_name;
    $name = ucfirst($name);

    $to = explode(',', $book->destination);
    $from = explode(',', $book->departure);

    $trip_date = $book->ride_date;
    $total_trip =+ intVal($book->total_distance); 
}
                        


// echo $trip_date;
?>
<div class='body__content container-fluid'>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-4 col-xl-3">
            <div class="container-fluid flex-grow-1 container-p-y">
                <?php include(app_path().'/common/left_profile.php')?>

            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8 col-xl-9">
            <div class="container-fluid flex-grow-1 container-p-y">
                <div class="d-flex align-items-center justify-content-between">

                    <div class="text-muted small d-block breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="lnr lnr-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo url('dashboard')?>"><?php echo $title?></a>
                            </li>
                            <?php if(isset($subtitle)):?>
                            <li class="breadcrumb-item active"><?php echo $subtitle?></li>
                            <?php endif?>
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <!-- 2nd row Start -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header with-elements flex-column align-items-stretch" >
                                <h3 class="card-header-title font-weight-bold mb-0" > 
                                    Welcome
                                    <?php if ($user->board_status !== 0): ?>
                                    back
                                    <?php endif;?>
                                    <?php echo ucfirst($user->first_name)?>
                                </h3>
                                <p class="mt-1 text-muted">
                                    This is your profile page. You may edit it from <a href="" class="ml-1 text-white btn-sm btn-outline btn-outline-default btn btn-dark  btn-round">here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card d-flex w-100 mb-4">
                            <div class="row no-gutters row-bordered row-border-light h-100">
                                <div class="d-flex col-md-6 col-lg-3 align-items-center">
                                    <div class="card-body">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-auto">
                                                <i class="lnr lnr-train text-primary display-4"></i>
                                            </div>
                                            <div class="col">
                                                <h6 class="mb-0 text-muted">Distance <span class="text-primary">
                                                        Travel</span></h6>
                                                <h4 class="mt-3 mb-0"><?php echo $total_trip ?: 0?> <small
                                                        class="font-weight-normal" style="font-size:16px;">/km</small>
                                                </h4>
                                            </div>
                                        </div>
                                        <!-- <p class="mb-0 text-muted">Spent this month</p> -->
                                    </div>
                                </div>
                                <div class="d-flex col-md-6 col-lg-3 align-items-center">
                                    <div class="card-body">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-auto">
                                                <i class="lnr lnr-rocket text-primary display-4"></i>
                                            </div>
                                            <div class="col">
                                                <h6 class="mb-0 text-muted">
                                                    Total <span class="text-primary">Trip</span>
                                                </h6>
                                                <h4 class="mt-3 mb-0">
                                                    <?php echo count($booking) ?: '0' ?><i
                                                        class="ion ion-md-arrow-round-up ml-3 text-success"></i></h4>
                                            </div>
                                        </div>
                                        <!-- <p class="mb-0 text-muted">Completed this month</p> -->
                                    </div>
                                </div>
                                <div class="d-flex col-md-6 col-lg-3 align-items-center">
                                    <div class="card-body">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-auto">
                                                <i class="lnr lnr-star text-primary display-4"></i>
                                            </div>
                                            <div class="col">
                                                <h6 class="mb-0 text-muted">Total <span
                                                        class="text-primary">Rating</span></h6>
                                                <h4 class="mt-3 mb-0">
                                                    <?php echo count($rating)?: '0' ?><i
                                                        class="ion ion-md-arrow-round-down ml-3 text-info"></i></h4>
                                            </div>
                                        </div>
                                        <!-- <p class="mb-0 text-muted">Since you join</p> -->
                                    </div>
                                </div>
                                <div class="d-flex col-md-6 col-lg-3 align-items-center">
                                    <div class="card-body">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-auto">
                                                <i class="lnr lnr-diamond text-primary display-4"></i>
                                            </div>
                                            <div class="col">
                                                <h6 class="mb-0 text-muted">
                                                    <?php  if($user->account_type == 'student') :?>
                                                    Booking <span class="text-primary">Credit</span>
                                                    <?php else:?>
                                                    Total <span class="text-primary">Earnings</span>
                                                    <?php endif?>
                                                </h6>
                                                <h4 class="mt-3 mb-0"><?php echo $user->balance?><i
                                                        class="ion ion-md-arrow-round-up ml-3 text-success"></i></h4>
                                            </div>
                                        </div>
                                        <!-- <p class="mb-0 text-muted">Since you join</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Staustic card 3 Start -->
                    </div>
                    <!-- 2nd row Start -->
                </div>

                <div class="row">
                    <!-- 1st row Start -->
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-header with-elements">
                                <h6 class="card-header-title mb-0">Statistics</h6>
                                <div class="card-header-elements ml-auto">
                                    <label class="text m-0">
                                        <span class="text-light text-tiny font-weight-semibold align-middle">SHOW
                                            STATS</span>
                                        <span class="switcher switcher-sm d-inline-block align-middle mr-0 ml-2"><input
                                                type="checkbox" class="switcher-input" checked=""><span
                                                class="switcher-indicator"><span class="switcher-yes"></span><span
                                                    class="switcher-no"></span></span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="statistics-chart-1" style="height: 270px; position: relative;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header with-elements">
                                <h6 class="card-header-title mb-0">Notifications</h6>
                                <div class="card-header-elements ml-auto">
                                    <!-- <button type="button" class="btn btn-default btn-xs md-btn-flat">Show more</button> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <?php 
                                        $features = array();
                                        $msg = '';

                                        if (!empty($user->features)) $features = explode(';', $user->features);

                                        if (in_array('Pink ride', $features) && !in_array('Extra-care ride', $features)) {
                                            $msg = trans('profile.selected_pinks') . '<br>';
                                            $msg = trans('profile.selected_pinks_message') . '<br>';
                                            $msg = trans('profile.selected_o');
                                        } elseif (in_array('Extra-care ride', $features) && !in_array('Pink ride', $features)) {
                                            $msg = trans('profile.extra_care_title') . '<br>';
                                            $msg = trans('profile.extra_care_gov') . '<br>';
                                            $msg = trans('profile.selected_o');
                                        } elseif (in_array('Extra-care ride', $features) && in_array('Pink ride', $features)) {
                                            $msg = trans('profile.selected_pinks_and_extra') . '<br>';
                                            $msg = trans('profile.pinks_and_extra_message') . '<br>';
                                            $msg = trans('profile.selected_o');
                                        } else {
                                            $msg =  trans('profile.to_be_eligible');
                                            $msg = str_replace( '(', '', $msg);

                                            $msg = Str::limit($msg, 50, '...');
                                        }
                                    ?>

                                    <?php if (in_array('Pink ride', $features) && !in_array('Extra-care ride', $features)):?>
                                    <a href="<?=url('personal-information')?>"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div
                                            class="ui-icon ui-icon-sm border-0 bg-secondary d-flex justify-content-center align-items-center">
                                            <i class="bi bi-user  text-white"></i>
                                        </div>

                                        <div class="media-body line-height-condenced ml-3">
                                            <div class="media-body line-height-condenced ml-3">
                                                <h6 class="text-dark display-6 font-weight-bold">
                                                    Complete your profile
                                                </h6>
                                                <p class="text-muted font-weight-normal mt-1">
                                                    <?php echo $msg?>
                                                </p>
                                                <!-- <small class="text-muted small font-weight-normal mt-1">12h ago</small> -->
                                            </div>
                                        </div>
                                    </a>
                                    <?php endif;?>

                                    <?php if(empty($user->driver_license) && $user->account_type == 'driver'):?>

                                    <a href="<?php echo url('verify-driver')?>"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div class="ui-icon ui-icon-sm bg-info border-0 text-white"
                                            style="//background-image:url('<?php #echo url('images/8-2-book-a-seat.png');?>') !important;">
                                            <!-- <img src="<?php echo url('images/8-2-book-a-seat.png')?>" width="25"> -->
                                        </div>
                                        <div class="media-body line-height-condenced ml-3">
                                            <div class="text-dark display-6 font-weight-bold">Upload drivers license
                                            </div>
                                            <div class="text-muted small mt-1 font-weight-normal">
                                                If you are registering as a driver, you must upload your driver’s
                                                license.
                                            </div>
                                        </div>
                                    </a>
                                    <?php endif?>
                                    <?php if($user->driver == 2 && $user->account_type == 'driver'):?>

                                    <a href="<?php echo url('verify-driver')?>"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div class="ui-icon ui-icon-sm bg-success border-0 text-white"
                                            style="//background-image:url('<?php #echo url('images/8-2-book-a-seat.png');?>') !important;">
                                            <!-- <img src="<?php echo url('images/8-2-book-a-seat.png')?>" width="25"> -->
                                        </div>
                                        <div class="media-body line-height-condenced ml-3">
                                            <div class="text-dark display-6 font-weight-bold">Drivers license
                                            </div>
                                            <div class="text-muted small mt-1 font-weight-normal">
                                                Your drivers' license has been verified
                                            </div>
                                        </div>
                                    </a>
                                    <?php else:?>
                                    <a href="<?php echo url('verify-driver')?>"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div class="ui-icon ui-icon-sm bg-danger border-0 text-white"
                                            style="//background-image:url('<?php #echo url('images/8-2-book-a-seat.png');?>') !important;">
                                            <!-- <img src="<?php echo url('images/8-2-book-a-seat.png')?>" width="25"> -->
                                        </div>
                                        <div class="media-body line-height-condenced ml-3">
                                            <div class="text-dark display-6 font-weight-bold">Upload drivers license
                                            </div>
                                            <div class="text-muted small mt-1 font-weight-normal">
                                                Your drivers' license has been verified
                                            </div>
                                        </div>
                                    </a>
                                    <?php endif?>



                                    <a href="javascript:"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div
                                            class="ui-icon ui-icon-sm feather icon-power bg-danger border-0 text-white">
                                        </div>
                                        <div class="media-body line-height-condenced ml-3">
                                            <div class="text-dark display-6 font-weight-bold">Server restarted</div>
                                            <div class="text-light small mt-1">
                                                19h ago
                                            </div>
                                        </div>
                                    </a>

                                    <a href="javascript:"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div
                                            class="ui-icon ui-icon-sm feather icon-alert-triangle bg-warning border-0 text-dark">
                                        </div>
                                        <div class="media-body line-height-condenced ml-3">
                                            <div class="text-dark display-6 font-weight-bold">99% server load</div>
                                            <div class="text-light small mt-1">
                                                Etiam nec fringilla magna. Donec mi metus.
                                            </div>
                                            <div class="text-light small mt-1">
                                                20h ago
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- 1st row Start -->
                </div>

                <div class="row">
                    <!-- 3rd row Start -->
                    <div class="col-xl-4">
                        <div class="card mb-4">
                            <div class="card-header with-elements">
                                <h6 class="card-header-title mb-0">
                                    <?php echo $user->account_type == 'student' ? 'Top rider' : 'Top user'?></h6>
                                <div class="card-header-elements ml-auto">
                                    <button type="button" class="btn btn-default btn-xs md-btn-flat">Show more</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush" id="reviews" style="height: 330px">

                                    <?php foreach ($rating as $value) {?>
                                    <a href="javascript:"
                                        class="list-group-item list-group-item-action media d-flex align-items-center">
                                        <div
                                            class="ui-icon ui-icon-sm feather icon-home bg-secondary border-0 text-white">
                                        </div>
                                        <div class="media-body line-height-condenced ml-3">
                                            <h6 class="text-dark display-6 font-weight-bold">
                                                Login from 192.168.1.1
                                            </h6>
                                            <p class="text-muted font-weight-normal mt-1">
                                                Aliquam ex eros, imperdiet vulputate hendrerit et.
                                            </p>
                                            <small class="text-muted small font-weight-normal mt-1">12h ago</small>
                                        </div>
                                    </a>
                                    <?php  }?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header with-elements pb-0">
                                <h6 class="card-header-title mb-0">Booking Details</h6>
                                <div class="card-header-elements ml-auto p-0">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#sale-stats">Upcoming</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#latest-sales">Past</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nav-tabs-top">
                                <div class="tab-content">

                                    <div class="tab-pane fade show active" id="sale-stats">
                                        <div style="height: 330px" id="tab-table-1" class="ps ps--active-y">
                                            <table class="table table-hover card-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <label class="custom-control custom-checkbox mb-0">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <span
                                                                    class="custom-control-label"><strong>Due</strong></span>
                                                            </label>
                                                        </th>
                                                        <th>User</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($booking as $book) {?>

                                                    <tr>
                                                        <td>
                                                            <label class="custom-control custom-checkbox mb-0">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <span
                                                                    class="custom-control-label"><strong>12</strong><br><span>hour</span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="media mb-0">

                                                                <img src="<?php echo url('images/'.$dir)?>"
                                                                    class="d-block ui-w-40 rounded-circle"
                                                                    style="height:40px; weight:40px;">
                                                                <div class="media-body align-self-center ml-3">
                                                                    <h6 class="mb-0"><?php echo $name?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <h6 class="mb-1">Trip from <?php echo $from[0] ?> to
                                                                    <?php echo $to[0]?></h6>
                                                                <?php if($ac_t == 'driver'):?>
                                                                <p class="text-muted mb-0">You will receive a payout of
                                                                    $<?php echo $book->booking_price?> after the trip
                                                                </p>
                                                                <?php else: ?>
                                                                <p class="text-muted mb-0">You will be charge
                                                                    $<?php echo $book->booking_price?> after the trip
                                                                </p>
                                                                <?php endif?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php }?>
                                                </tbody>
                                            </table>
                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                                                </div>
                                            </div>
                                            <div class="ps__rail-y" style="top: 0px; height: 330px; right: 0px;">
                                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 199px;">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:"
                                            class="card-footer d-block text-center text-dark small font-weight-semibold">SHOW
                                            MORE</a>
                                    </div>
                                    <div class="tab-pane fade" id="latest-sales">
                                        <div style="height: 330px" id="tab-table-2" class="ps">
                                            <table class="table table-hover card-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <label class="custom-control custom-checkbox mb-0">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <span
                                                                    class="custom-control-label"><strong>Due</strong></span>
                                                            </label>
                                                        </th>
                                                        <th>User</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($booking as $book) {?>

                                                    <tr>
                                                        <td>
                                                            <label class="custom-control custom-checkbox mb-0">
                                                                <input type="checkbox" class="custom-control-input">
                                                                <span
                                                                    class="custom-control-label"><strong>12</strong><br><span>hour</span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="media mb-0">

                                                                <img src="<?php echo url('images/'.$dir)?>"
                                                                    class="d-block ui-w-40 rounded-circle"
                                                                    style="height:40px; weight:40px;">
                                                                <div class="media-body align-self-center ml-3">
                                                                    <h6 class="mb-0"><?php echo $name?></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-inline-block align-middle">
                                                                <h6 class="mb-1">Trip from <?php echo $from[0] ?> to
                                                                    <?php echo $to[0]?></h6>
                                                                <?php if($ac_t == 'driver'):?>
                                                                <p class="text-muted mb-0">You will receive a payout of
                                                                    $<?php echo $book->booking_price?> after the trip
                                                                </p>
                                                                <?php else: ?>
                                                                <p class="text-muted mb-0">You will be charge
                                                                    $<?php echo $book->booking_price?> after the trip
                                                                </p>
                                                                <?php endif?>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php }?>
                                                </tbody>
                                            </table>
                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                                                </div>
                                            </div>
                                            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;">
                                                </div>
                                            </div>
                                        </div>
                                        <a href="javascript:"
                                            class="card-footer d-block text-center text-dark small font-weight-semibold">SHOW
                                            MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 3rd row Start -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(app_path() . '/common/footer.php'); ?>
<script src="<?php echo url('plugins/perfect-scrollbar.js'); ?>" type="text/javascript"></script>

<script src="javascripts/libs/eve/eve.js"></script>
<script src="javascripts/libs/flot/flot.js"></script>
<script src="javascripts/libs/flot/curvedLines.js"></script>
<script src="javascripts/libs/chart-am4/core.js"></script>
<script src="javascripts/libs/chart-am4/charts.js"></script>
<script src="javascripts/libs/chart-am4/animated.js"></script>
<script src="<?php echo url('javascripts/dashboard.js'); ?>" type="text/javascript"></script>

<script>
let drivers_license = '<?=$user->driver_license?>';

if (drivers_license == '') {
    showErrorDialog('You must upload your driver’s license to be able to post rides')
}

// new PerfectScrollBar($('#reviews'));
</script>