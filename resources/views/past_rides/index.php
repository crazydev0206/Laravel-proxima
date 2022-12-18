<?php include(app_path().'/common/header.php'); ?>
<style>
        h5{
            font-size: 16px;
        }
        
        h5.main-heading{
            font-size: 1.25erm;
        }
        
        h6.m-title{
            font-size: 12px;
            color: #ccd7e6 !important;
        }
        
        label{
            margin-bottom: 4px;
            font-weight: 500;
        }
        
        .card__profile, .card__contact, .card__reference, .card__top{
            box-shadow: 0 1px 6px 1px #eee;
        }
    
    input[type='text']{
        border-radius: 5px;
    }
    </style>

<div class='body__content'>
<div class='profile__page page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<div class='page__content__header'>
<h5 class="main-heading">Past rides</h5><hr class="mt-0 mb-4">
</div>
<div class='page__content__body'>
<div class='row'>
<div class='col-12 col-md-4 col-lg-3'>
    <?php $user_data=$user; include(app_path().'/common/left_profile.php'); ?>
</div>
<div class='col-12 col-md-8 col-lg-9'>
<ul class='nav nav-tabs mb-3' id='profile-form-tab' role='tablist'>
<li class='nav-item'>
<!--<a aria-controls='booked' aria-selected='true' class="nav-link <?php if((!isset($_GET['t']) OR $_GET['t']=='booked') OR ($user->type!='Driver') AND !isset($_GET['t'])) echo 'active'; ?>" data-toggle='tab' href='#booked' id='booked-tab' role='tab' onclick="$('.alert2').hide();">Rides booked</a>-->
    <a class="nav-link" href='<?php echo url('my-rides'); ?>' onclick="$('.alert2').hide();">Rides booked</a>
</li>
<li class='nav-item'>
<!--<a aria-controls='posted' aria-selected='true' class="nav-link <?php if((isset($_GET['t']) AND $_GET['t']=='posted') OR (isset($_GET['t']) AND $_GET['t']=='posted')) echo 'active'; ?>" data-toggle='tab' href='#posted' id='posted-tab' role='tab' onclick="$('.alert2').hide();">Rides posted</a>-->
    <a class="nav-link" href='<?php echo url('rides-posted'); ?>' onclick="$('.alert2').hide();">Rides posted</a>
</li>
<li class='nav-item'>
<!--<a aria-controls='past' aria-selected='false' class="nav-link <?php if(isset($_GET['t']) AND $_GET['t']=='past') echo 'active'; ?>" data-toggle='tab' href='#past' id='past-tab' role='tab' onclick="$('.alert2').hide();">Past rides</a>-->
    <a class="nav-link active" aria-selected='true' href='<?php echo url('past-rides') ?>' onclick="$('.alert2').hide();">Past rides</a>
</li>
</ul>
<div class='tab-content' id='profile-form-content'>
    <?php if(Session::has('success')) { ?>
    <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    
    <!--<div aria-labelledby='posted-tab' class="tab-pane fade <?php //if((isset($_GET['t']) AND $_GET['t']=='posted')) echo 'show active'; ?>" id='posted' role='tabpanel'>
        
        <div class='profile__travel__wrapper'>
            <?php 
            if(!empty($rides_posted) AND 0) {
                foreach($rides_posted as $ride) {
                    $from=$ride['ride']->departure_city;
                    $to=$ride['ride']->destination_city;
                    
                    if($ride['ride']->departure_state_short!='') $from.=', '.$ride['ride']->departure_state_short;
                    if($ride['ride']->destination_state_short!='') $to.=', '.$ride['ride']->destination_state_short;
                    
                    if($from=='') $from=$ride['ride']->departure_place;
                    if($to=='') $to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_state;
                    if($to=='') $to=$ride['ride']->destination_state;
                    
                    if($from=='') $from=$ride['ride']->departure;
                    if($to=='' OR $from==$to) $to=$ride['ride']->destination;
            ?>
            <div class='profile__travel__row mb-0' style="cursor: pointer;" onclick="window.location='<?php echo url('ride/'.$ride['ride']->url); ?>'">
                <div class='row'>
                    <div class='col-12 col-md-9 col-lg-8'>
                        <div class='media'>
                            <div class='media-left mr-3'>
                                <?php 
                        $car_image=url('images/car_placeholder2.png');
                        if(isset($ride['ride']->car_image) AND $ride['ride']->car_image!='') $car_image=url('car_images/'.$ride['ride']->car_image);
    ?>
                                <div class='image__round'>
                                    <img src="<?php echo $car_image; ?>" class="img-fluid img-rounded" alt="User simple" />
                                </div>
                            </div>
                            <div class='media-body'>
                                <h6 class='f-700 title mb-0'>
                                    <span class='travel'></span>
                                    <span class='locations'>
                                        <?php echo $from.' to '.$to; ?>
                                    </span>
                                </h6>
                                <p class='mb-0'>
                                    <?php echo date_format(new DateTime($ride['ride']->date),'l, F d').' at '.date_format(new DateTime($ride['ride']->time),'h:i a'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3 col-lg-4'>
                        <div class='price__navigation'>
                            <div class='price__info'>
                                <div class='price__info__price text-center'>
                                    <h4 class='title f-700 mb-0'>
                                        $<?php echo $ride['ride']->price; ?>
                                    </h4>
                                    <div class='price__info__details'>
                                        <span>per seat</span>
                                    </div>
                                </div>
                            </div>
                            <div class='navigation'>
                                <a href='#'>
                                    <span class='fa fa-chevron-right'></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 text-right">
            <a href="<?php echo url("cancel-ride/".$ride['ride']->id); ?>"><i class="fa fa-times"></i> Cancel ride</a>
            </div>
            <?php } } else echo "<i class='fa fa-info-circle'></i> No ride posted. You can post a ride <a href='".url('post-ride')."'>here</a>."; ?>
        </div>
    
    </div>
    
    <div aria-labelledby='booked-tab' class="tab-pane fade <?php //if((!isset($_GET['t']) OR $_GET['t']=='booked')) echo 'show active'; ?>" id='booked' role='tabpanel'>
        <?php 
            if(!empty($rides_booked) AND 0) {
                foreach($rides_booked as $ride) {
                    $from=$ride['ride']->departure_city;
                    $to=$ride['ride']->destination_city;
                    
                    if($ride['ride']->departure_state_short!='') $from.=', '.$ride['ride']->departure_state_short;
                    if($ride['ride']->destination_state_short!='') $to.=', '.$ride['ride']->destination_state_short;
                    
                    $place_from=$ride['ride']->departure_place;
                    $place_to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_place;
                    if($to=='') $to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_state;
                    if($to=='') $to=$ride['ride']->destination_state;

                    if($from=='') $from=$ride['ride']->departure;
                    if($to=='') $to=$ride['ride']->destination;
            ?>
            <div class='profile__travel__row' style="cursor: pointer;" onclick="window.location='<?php echo url('ride/'.$ride['ride']->url); ?>'">
                <div class='row'>
                    <div class='col-12 col-md-9 col-lg-8'>
                        <div class='media'>
                            <div class='media-left mr-3'>
                                <?php 
                        $car_image=url('images/car_placeholder2.png');
                        if(isset($ride['ride']->car_image) AND $ride['ride']->car_image!='') $car_image=url('car_images/'.$ride['ride']->car_image);
    ?>
                                <div class='image__round'>
                                    <img src="<?php echo $car_image; ?>" class="img-fluid img-rounded" alt="User simple" />
                                </div>
                            </div>
                            <div class='media-body'>
                                <h6 class='f-700 title mb-0'>
                                    <span class='travel'></span>
                                    <span class='locations'>
                                        <?php echo $from.' to '.$to; ?>
                                    </span>
                                </h6>
                                <p class='mb-0'>
                                    <?php echo date_format(new DateTime($ride['ride']->date),'l, F d').' at '.date_format(new DateTime($ride['ride']->time),'h:i a'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3 col-lg-4'>
                        <div class='price__navigation'>
                            <div class='price__info'>
                                <div class='price__info__price text-center'>
                                    <h4 class='title f-700 mb-0'>
                                        $<?php echo $ride['ride']->price; ?>
                                    </h4>
                                    <div class='price__info__details'>
                                        <span>per seat</span>
                                    </div>
                                </div>
                            </div>
                            <div class='navigation'>
                                <a href='#'>
                                    <span class='fa fa-chevron-right'></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } else echo "<i class='fa fa-info-circle'></i> No booked ride. You can search for a ride <a href='".url('search-ride')."'>here</a>."; ?>
    </div>-->
    
    <div aria-labelledby='past-tab' class="tab-pane fade show active" id='past' role='tabpanel'>
        <?php 
            if(!empty($rides_past)) {
                foreach($rides_past as $ride) {
                    $from=$ride['ride']->departure_city;
                    $to=$ride['ride']->destination_city;
                    
                    if($ride['ride']->departure_state_short!='') $from.=', '.$ride['ride']->departure_state_short;
                    if($ride['ride']->destination_state_short!='') $to.=', '.$ride['ride']->destination_state_short;
                    
                    $place_from=$ride['ride']->departure_place;
                    $place_to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_place;
                    if($to=='') $to=$ride['ride']->destination_place;
                    
                    if($from=='') $from=$ride['ride']->departure_state;
                    if($to=='') $to=$ride['ride']->destination_state;

                    if($from=='') $from=$ride['ride']->departure;
                    if($to=='') $to=$ride['ride']->destination;
            ?>
            <div class='profile__travel__row mb-0' style="cursor: pointer;" onclick="window.location='<?php echo url('ride/'.$ride['ride']->url); ?>'">
                <div class='row'>
                    <div class='col-12 col-md-9 col-lg-8'>
                        <div class='media'>
                            <div class='media-left mr-3'>
                                <?php 
                        $car_image=url('images/car_placeholder2.png');
                        if(isset($ride['ride']->car_image) AND $ride['ride']->car_image!='') $car_image=url('car_images/'.$ride['ride']->car_image);
    ?>
                                <div class='image__round'>
                                    <img src="<?php echo $car_image; ?>" class="img-fluid img-rounded" alt="User simple" />
                                </div>
                            </div>
                            <div class='media-body'>
                                <h6 class='f-700 title mb-0'>
                                    <span class='travel'></span>
                                    <span class='locations'>
                                        <?php echo $from.' to '.$to; ?>
                                    </span>
                                </h6>
                                <p class='mb-0'>
                                    <?php echo date_format(new DateTime($ride['ride']->date),'l, F d').' at '.date_format(new DateTime($ride['ride']->time),'h:i a'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12 col-md-3 col-lg-4'>
                        <div class='price__navigation'>
                            <div class='price__info'>
                                <div class='price__info__price text-center'>
                                    <h4 class='title f-700 mb-0'>
                                        $<?php echo $ride['ride']->price; ?>
                                    </h4>
                                    <div class='price__info__details'>
                                        <span>per seat</span>
                                    </div>
                                </div>
                            </div>
                            <div class='navigation'>
                                <a href='#'>
                                    <span class='fa fa-chevron-right'></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 text-right">
            
            <a href="javascript:void(0)" class="copy_ride" data-id="<?php echo $ride['ride']->id; ?>" style="padding-right: 20px;"><i class="fa fa-copy"></i> Copy Ride Again</a>


            <a href="<?php echo url("post-ride?c=".$ride['ride']->id); ?>"><i class="fa fa-copy"></i> Repost ride</a>

            </div>
            <?php } } else echo "<i class='fa fa-info-circle'></i> No past ride. You can search for a ride <a href='".url('search-ride')."'>here</a>."; ?>
    </div>
    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>





<div id="dateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="text-align:left;">
     
        <h4 class="modal-title" style="text-align:left;">Edit Date Of Ride</h4>
           <button type="button" class="close" data-dismiss="modal" style="font-size:30px;">&times;</button>
      </div>
      <div class="modal-body">
        
        <div class="row">

            <input type="hidden" id="past_ride_id">

            <div class="col-md-6">
                <div class='form-group'>
                    <h5 class='f-sub-title'><?php echo trans('rides.date_time'); ?></h5>
                    <div class='home-ride-date-picker form-group-border'>
                    <input class='form-control' id='ride-date-field' placeholder='<?php echo trans('rides.date'); ?>' autocomplete="off" name="date" style="background-color: #fff !important; cursor: text !important;" readonly>
                    </div>
                    </div>
            </div>
            <div class="col-md-6" style="padding-top: 7px;">
                <div class='form-group'>
                <label class='hide-up-to-md'>&nbsp;</label>
                <div class='home-ride-time-picker home-ride-date-picker'>
                    <div class='input-group input-group-s-append form-group-border'>
                        <span class='input-group-append'>
               
                </span>
                <input type="time" class='form-control' id='ride-time-field' placeholder='<?php echo trans('rides.time'); ?>' autocomplete="off" name="time" required style="border-left:0px; padding-left:3px;">
                </div>
                </div>
                </div>
            </div>

            <div class="col-md-12" style="text-align:right;">
                <button class="btn btn-md btn-primary" id="copy_ride_paste">Copy Ride</button>
            </div>
            
        </div>

      </div>
    </div>

  </div>
</div>





<?php include(app_path().'/common/footer.php'); ?>




<script type="text/javascript">
    $(".copy_ride").click(function(){

        var id = $(this).attr('data-id');

        $("#past_ride_id").val(id);

        $("#dateModal").modal('show');

    });
</script>

<script type="text/javascript">
    $("#copy_ride_paste").click(function(){

        var id = $("#past_ride_id").val();

        var date = $("#ride-date-field").val();

        var time = $("#ride-time-field").val();

        var url = '<?=url('/api/copy_paste_ride'); ?>';

       var token='<?php echo csrf_token(); ?>';

        $.post(url, {"_token":token, id:id, date:date, time:time}, function(data){

            console.log(data);

            location.href = "<?=url('/rides-posted'); ?>";

        }).fail(function(){
            alert("Something went wrong");
        });


    });
</script>