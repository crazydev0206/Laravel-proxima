<?php include(app_path().'/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet" type="text/css" />
<style>
        .vehicle__detail__list li .li-wrapper{
            margin-bottom: 10px;
        }
        
        .vehicle__detail__list li .li-wrapper span.ans{
            font-weight: 500;
        }
        
        .mbl-show{
                display: none;
            }
        
        @media (max-width: 767px) {
            .btn.btn-outline.btn-outline-b-light {
                font-size: 13px;
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .justify-content-between {
                -ms-flex-pack: justify !important;
                justify-content: normal !important;
            }
            
            .mbl-show{
                display: block;
            }
            
            .dsk-hide{
                display: none;
            }
        }
    
    .book-btn{
        background: #394d5b;
        color: white;
    }
    
    ul.facilities-list {
    padding: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: calc(100% + 20px);
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-left: -10px;
    margin-right: -10px;
}
    
    ul.facilities-list li {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -ms-flex-preferred-size: 50%;
    flex-basis: 50%;
    max-width: 50%;
    list-style: none;
    padding-left: 10px;
    padding-right: 10px;
    margin-bottom: 10px;
}
    
    ul.facilities-list li p {
    display: block;
    font-size: 16px;
    text-decoration: none;
    cursor: default;
    color: #333;
    margin-bottom: 0px;
}
    
    @media only screen and (max-width:792px)
    {
        ul.facilities-list li {
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
    max-width: 100%;
}
    }
    
    .btn-outline-default{
            background: #394d5b;
            color: white;
        }
    </style>
<?php 
    $from=$ride[0]['ride']->departure_city;
    $to=$ride[0]['ride']->destination_city;
                    
    if($from=='') $from=$ride[0]['ride']->departure_place;
    if($to=='') $to=$ride[0]['ride']->destination_place;

    if($from=='') $from=$ride[0]['ride']->departure_state;
    if($to=='') $to=$ride[0]['ride']->destination_state;

    if($from=='') $from=$ride[0]['ride']->departure;
    if($to=='' OR $from==$to) $to=$ride[0]['ride']->destination;

    $book_btn=1;
    if($user_id!=0 AND $user->id==$ride[0]['ride']->added_by) $book_btn=0;

    $seats_available=$ride[0]['ride']->seats-count($bookings);
?>

<div class='body__content'>
<div class='post__ride page__common p-60 with-b-top ride__view__page'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-12 col-lg-8 col-xl-8'>
<div class='ride__view__wrapper'>
<div class='page__title__wrapper'>
<div class='page__title__box'>
<h3 class='page__title text-c-blue f-700'>
<?php echo $from.' to '.$to; ?>
</h3>
<h6 class='view-date text-normal sub-title'>
<?php echo date_format(new DateTime($ride[0]['ride']->date),'l, F d, Y').' at '.date_format(new DateTime($ride[0]['ride']->time),'h:i a'); ?>
</h6>
</div>
<div class='page__title__suffix'>
<span class='page__suffix-info'>
<span class='price-info f-700'>
$<?php echo $ride[0]['ride']->price; ?>
</span>
<div class='clearfix'></div>
<span class='price-suffix text-c-blue'><?php echo trans('rides.per_seat'); ?></span>
</span>
</div>
</div>
    
    <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    
    <?php if($ride[0]['ride']->status=='1') { ?>
    <p class="alert alert-success"><i class="fa fa-info-circle"></i> <?php echo trans('rides.ride_completed'); ?></p>
    <?php } else if($ride[0]['ride']->status=='2') { ?>
    <p class="alert alert-danger"><i class="fa fa-info-circle"></i> <?php echo trans('rides.ride_cancelled'); ?></p>
    <?php } else if($ride[0]['ride']->closed=='1') { ?>
    <p class="alert alert-danger"><i class="fa fa-info-circle"></i> This ride has been closed by the driver</p>
    <?php } ?>
    
<div class='ride__view__route' style="font-size:16px;">
<p class='mb-1'>
<b><?php echo trans('rides.from'); ?>:</b>
<?php echo $ride[0]['ride']->departure; ?>
</p>
<p>
<b><?php echo trans('rides.to'); ?>:</b>
<?php echo $ride[0]['ride']->destination; ?>
</p>
</div>
    
<div class='ride__view__route' style="font-size:16px;">
<p class='mb-1'>
<b><?php echo trans('rides.pickup_location'); ?>:</b>
<?php echo $ride[0]['ride']->pickup; ?>
</p>
<p>
<b><?php echo trans('rides.dropoff_location'); ?>:</b>
<?php echo $ride[0]['ride']->dropoff; ?>
</p>
</div>
    
<div class='ride__view__info' style="font-size:16px;">
<p>
<?php echo $ride[0]['ride']->details; ?>
</p>
</div>
    
    <div class='ride__view__route' style="font-size:16px;">
<p class='mb-1'>
<b><?php echo trans('rides.luggage'); ?>:</b>
<?php 
    if($ride[0]['ride']->luggage=='S') echo trans('rides.small');
    else if($ride[0]['ride']->luggage=='M') echo trans('rides.medium');
    else if($ride[0]['ride']->luggage=='L') echo trans('rides.large');
    else if($ride[0]['ride']->luggage=='XL') echo trans('rides.xl');
    else echo $ride[0]['ride']->luggage;
    ?>
</p>
</div>
    
    <div class='ride__view__route mt-3' style="font-size:16px;">
        
        <ul class='ul__list ul__list--horizontal seat__availability' style="color: #5e7a8e !important;">
            <b><?php echo trans('rides.seats'); ?>:</b>&nbsp;
    <?php if($ride[0]['ride']->seats>=1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>=1) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>1) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>2) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>2) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>3) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>3) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>4) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>4) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>5) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>5) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['ride']->seats>6) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if(count($bookings)>6) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
            &nbsp;&nbsp;(<?php echo $ride[0]['ride']->seats-count($bookings); ?> seats left)
</ul>
    
</div>
    
    <div class='ride__view__route mt-3' style="font-size:16px;">
<div class='radio-text show-info-top-right' style="color:#5e7a8e;">
<b><?php echo trans('rides.payment_method'); ?>:</b>&nbsp;
    <?php if($ride[0]['ride']->payment_method=='Cash') { ?>
    <img src="<?php echo url('images/icons-png/hand-cash.png'); ?>" class="img-fluid" alt="Hand cash" style="max-width:25px;"/>
    <?php } else if($ride[0]['ride']->payment_method=='Online payment') { ?>
    <img src="<?php echo url('images/icons-png/money-transfer.png'); ?>" class="img-fluid" alt="Hand cash" style="max-width:25px;"/>
    <?php } else if($ride[0]['ride']->payment_method=='Secured cash') { ?>
    <img src="<?php echo url('images/icons-png/money-guaranteed.png'); ?>" class="img-fluid" alt="Hand cash" style="max-width:25px;"/>
    <?php } ?>
    
    <div class='radio-text show-info-top-right'>
<span class='info-icon' data-toggle='tooltip' title='<?php if($ride[0]['ride']->payment_method=='Cash') echo 'Pay to the driver in cash when you meet'; else if($ride[0]['ride']->payment_method=='Online payment') echo 'Your account will be charged, but the funds will be paid to the driver only after the ride is complete'; else if($ride[0]['ride']->payment_method=='Secured cash') echo 'The amount will be held from your account, and it will be refunded to you once you meet the driver and pay him in cash'; ?>'>
<i class='fa fa-info-circle'></i>
</span>
<?php  echo $ride[0]['ride']->payment_method; ?>
        </div>
        </div>
</div>
    
    <?php 
    $features=array();
    if(!empty($ride[0]['ride']->features)) {
    $features=explode(';', $ride[0]['ride']->features);
    ?>
    <div class="row">
<div class="col-12">
<h6 class='bottom-border sub-title mb-0 mt-4' style="color: #5e7a8e !important;">
<?php echo trans('rides.features'); ?>:
</h6>
<div class="card mb-0 mt-3" style="background:rgba(0, 0, 0, 0.03);">
<div class="card-body">
<ul class="facilities-list mb-0">
    <?php foreach($features as $feature) { ?>
    <li>
<p style="<?php if($feature=='Pink ride') echo 'color: #e11e86;'; else if($feature=='Extra-care ride') echo 'color: #077dd5;'; ?>">
<span class="fa fa-check-square"></span>
<?php echo $feature; ?>
</p>
</li>
    <?php } ?>
    </ul>
</div>
</div>
</div>
</div>
    <?php } ?>
    
    <?php if(!empty($ratings)) { ?>
        <div class='profile__reviews__wrapper mt-4'>
<h6 class='bottom-border sub-title mb-0 mt-4 mb-2' style="color: #5e7a8e !important;">
<?php echo trans('rides.feedbacks'); ?>:
</h6>
<div class='profile__reviews mb-5'>
    <?php foreach($ratings as $rating) {
    $user_name='User deleted';
    $user_img=url('images/neutral.png');
    if($rating['user']!='NA')
    {
        $user_name=$rating['user']->first_name.' '.$rating['user']->last_name;
        if($rating['user']->gender=='Male')
        $user_img=url('images/male.png');
        else if($rating['user']->gender=='Female')
        $user_img=url('images/female.png');
        else
        $user_img=url('images/neutral.png');
        if(!empty($rating['user']->profile_image)) $user_img=url('images/profile_images/'.$rating['user']->profile_image);
        else if(!empty($rating['user']->avatar)) $user_img=$rating['user']->avatar;
    }
    ?>
<div class='profile__review'>
<div class='media <?php if($rating['driver_rating']=='NA') echo 'mb-1'; else echo 'mb-0'; ?>'>
<div class='media-left mr-3'>
<div class='image__rounded'>
    <a href="<?php echo url('passenger/'.$rating['user']->username); ?>">
<img src="<?php echo $user_img; ?>" class="img-fluid img-round" alt="User simple" />
    </a>
</div>
</div>
<div class='media-body pt-2'>
    <h6 class='r-title mb-1'><a href="<?php echo url('passenger/'.$rating['user']->username); ?>"><?php echo $user_name; ?></a></h6>
<div class='r-rateing'>
    <ul class='ul__list'>
<li>
<div class='d-flex'>
    <div class='r-text' style="background:#f39c12; color:white; padding-left:3px; padding-right:3px; font-weight:bold; border-radius:2px;">
<span>
<?php echo number_format($rating['avg_rating'], 1); ?>
</span>
</div>
    
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-readonly='true' data-rating='<?php echo $rating['avg_rating']; ?>' data-size='20px'></div>
</div>

</div>
</li>
    </ul>
</div>
<p class='r-desc mb-0'><?php echo $rating['rating']->review; ?></p>
</div>
</div>
</div>
    <?php if($rating['driver_rating']!='NA') {
        $user_name='User deleted';
        $user_img=url('images/neutral.png');
        if($rating['driver']!='NA')
        {
        $user_name=$rating['driver']->first_name.' '.$rating['driver']->last_name;
        if($rating['driver']->gender=='Male')
        $user_img=url('images/male.png');
        else if($rating['driver']->gender=='Female')
        $user_img=url('images/female.png');
        else
        $user_img=url('images/neutral.png');
        if(!empty($rating['driver']->profile_image)) $user_img=url('images/profile_images/'.$rating['driver']->profile_image);
        else if(!empty($rating['driver']->avatar)) $user_img=$rating['driver']->avatar;
        }
    ?>
    <div style="padding-left:70px;">
        <div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
    <?php if($rating['driver']!='NA') { ?>
    <a href="<?php echo url('driver/'.$rating['driver']->username); ?>">
<img src="<?php echo $user_img; ?>" class="img-fluid img-round" alt="User simple" />
    </a>
    <?php } else { ?>
    <img src="<?php echo $user_img; ?>" class="img-fluid img-round" alt="User simple" />
    <?php } ?>
</div>
</div>
<div class='media-body pt-3'>
    <h6 class='r-title mb-1'>
        <?php if($rating['driver']!='NA') { ?>
        <a href="<?php echo url('driver/'.$rating['driver']->username); ?>"><?php echo $user_name; ?></a>
        <?php } else { ?>
        <?php echo $user_name; ?>
        <?php } ?>
    </h6>
<div class='r-rateing'>
<ul class='ul__list'>
<li>
<div class='d-flex'>
    <div class='r-text' style="background:#f39c12; color:white; padding-left:3px; padding-right:3px; font-weight:bold; border-radius:2px;">
<span>
<?php echo number_format($rating['avg_rating_driver'], 1); ?>
</span>
</div>
    
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-readonly='true' data-rating='<?php echo $rating['avg_rating_driver']; ?>' data-size='20px'></div>
</div>

</div>
</li>
    </ul>
</div>
<p class='r-desc'><?php echo $rating['driver_rating']->review; ?></p>
</div>
</div>
</div>
    </div>
    <?php } else if($user_id==$rating['rating']->driver_id) { ?>
    <div style="padding-left:70px;">
    <a href="<?php echo url('leave-feedback/'.$rating['rating']->booking_id); ?>" class='f-600 mr-1 mb-3 mb-md-1 d-sm-inline-block'>Provide feedback</a>
    </div>
    <?php } } ?>
            </div>
        </div>
    <?php } ?>
    
    <?php if(!empty($booking_requests) AND $user_id!=0 AND $user->id==$ride[0]['ride']->added_by) { ?>
    <div class='ride__passengers mt-5'>
        <h6 class='bottom-border sub-title mb-0 mt-4' style="color: #5e7a8e !important;">
<?php echo trans('rides.booking_requests'); ?>:
</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?php echo trans('rides.passenger'); ?></th>
                    <th><?php echo trans('rides.seats_booked'); ?></th>
                    <th><?php echo trans('rides.total_cost'); ?></th>
                    <th><?php echo trans('rides.booked_on'); ?></th>
                    <th><?php echo trans('rides.actions'); ?></th>
                </tr>
            </thead>
            <tbody>
    <?php foreach($booking_requests as $request) { ?>
                <tr>
                    <td>
                        <a href="<?php echo url('passenger/'.$request['passenger']->username); ?>">
                            <b><?php echo $request['passenger']->first_name.' '.$request['passenger']->last_name; ?></b>
                        </a>
                        <p class="mb-0"><?php echo $request['passenger']->email; ?></p>
                        <?php if($request['passenger']->phone!='') { ?>
                        <p><?php echo $request['passenger']->phone; ?></p>
                        <?php } ?>
                    </td>
                    <td>
                        <ul class='ul__list ride-form-seats'>
<li>
<label for='number-of-seat-1'>
<input id='number-of-seat-1' name='seats' type='radio' value='1' checked>
<span class='seats'>
<span class='seat-number'>
<?php echo $request['booking']->seats; ?>
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
                        </ul>
                    </td>
                    <td style="font-weight:bold;">$<?php echo $request['booking']->ride_price*$request['booking']->seats; ?> CAD
                    <p><?php echo $request['booking']->payment_method; ?></p>
                    </td>
                    <td><?php echo date_format(new DateTime($request['booking']->booked_on),'d-m-Y'); ?>
                        <p><?php echo date_format(new DateTime($request['booking']->booked_on),'H:i'); ?></p>
                    </td>
                    <td>
                        <button class="btn btn-success pt-1 pb-1 mb-1" onclick="change_status(this, '<?php echo $request['booking']->id; ?>', '1')">Accept</button><br>
                        <button class="btn btn-danger pt-1 pb-1" onclick="change_status(this, '<?php echo $request['booking']->id; ?>', '3')">Reject</button>
                    </td>
                </tr>
    <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
   
<div class='ride__passengers mt-5'>
    <?php if(($user_id!=0 AND $ride[0]['ride']->added_by==$user->id AND $ride[0]['ride']->status!='2') OR ($user_ride!='NA' AND $user_ride->status!='0')) { ?>
<h6 class='bottom-border sub-title mb-0 mt-4' style="color: #5e7a8e !important;">
<?php echo trans('rides.my_passengers'); ?>:
</h6>
<div class='ride__passenger__table mb-4 mt-3'>
<div class='passengers__list'>
    <?php for($i=0; $i<$ride[0]['ride']->seats; $i++) {
    $booked=0;
    if(isset($bookings[$i])) {
        if($bookings[$i]['booking']->status=='5') $booking=0;
        else $booked=1;
    }
    
    if($booked AND $bookings[$i]['booking']->status!='0') $seat_img=url('images/icons-png/seat-hover-1.png');
    else $seat_img=url('images/icons-png/seat.png');
    ?>
<div class='passenger__list__row'>
<div class='passenger__list__seat table-grid'>
<div class='passenger__seat__wrapper d-flex justify-content-center align-content-center'>
<div class='passenger__seat'>
<span class='seat-number'>
<?php echo $i+1; ?>
</span>
<picture class='seat-image'>
<img src="<?php echo $seat_img; ?>" alt="Seat hover 1" />
</picture>
</div>
</div>
</div>
<div class='passenger__seat__user table-grid' style="overflow:hidden; width:100%;">
<div class='media passenger__info align-self-left' style="width:100%;">
    <?php if($booked) { ?>
<div class='media-left mr-3 align-self-center'>
<div class='passenger__image'>
    <?php 
    if($bookings[$i]['passenger']->gender=='Male')
    $user_img=url('images/male.png');
    else if($bookings[$i]['passenger']->gender=='Female')
    $user_img=url('images/female.png');
    else
    $user_img=url('images/neutral.png');
    if(!empty($bookings[$i]['passenger']->profile_image)) $user_img=url('images/profile_images/'.$bookings[$i]['passenger']->profile_image);
    else if(!empty($bookings[$i]['passenger']->avatar)) $user_img=$bookings[$i]['passenger']->avatar;
    ?>
<picture>
    <a href="<?php echo url('passenger/'.$bookings[$i]['passenger']->username); ?>">
<img src="<?php echo $user_img; ?>" alt="User simple" style="border-radius:50%;"/>
    </a>
</picture>
</div>
</div>
<div class='media-body pt-1' style="line-height: 1.4rem; width:100%;">
<h6 class="mb-0">
<a href="<?php echo url('passenger/'.$bookings[$i]['passenger']->username); ?>">
    <b><?php echo $bookings[$i]['passenger']->first_name.' '.$bookings[$i]['passenger']->last_name; ?></b>
</a>
<span class='light f-400'></span>
</h6>
<p class='mb-0'>
<i class="fa fa-envelope"></i> <?php echo $bookings[$i]['passenger']->email; ?>
</p>
<p class="mb-0">
<i class="fa fa-phone"></i> <?php echo $bookings[$i]['passenger']->phone; ?>
</p>
    <?php if($ride[0]['ride']->status=='0' AND $ride[0]['ride']->closed=='0' AND $user_id==$ride[0]['ride']->added_by) { ?>
<p class="mb-1">
<a href="<?php echo url('cancel-passenger/'.$bookings[$i]['booking']->id); ?>" style="color:red;"><i class="fa fa-times"></i> <?php echo trans('rides.cancel_passenger'); ?></a>
</p>
    <?php } ?>
</div>
    <?php } else { ?>
    <p><?php echo trans('rides.seat_available_booking'); ?></p>
    <?php } ?>
</div>
</div>
</div>
    <?php } ?>
</div>
</div>
    <?php } ?>
    
    <?php if($user_id!=0 AND ($ride[0]['ride']->added_by==$user->id) AND $ride[0]['ride']->status=='0') { ?>
    <div class='ride__buttons__row form-group'>
<div class='row'>
<div class='col-8 col-sm-8 col-md-6 dsk-hide'>
    <?php if($ride[0]['ride']->closed!='1') { ?>
<div class='d-flex justify-content-between justify-content-sm-start'>
<a href="<?php echo url('edit-ride/'.$ride[0]['ride']->id); ?>"><button class='f-600 btn btn-outline btn-outline-default btn-c-transition btn-radius mr-1 mb-3 mb-md-1 d-sm-inline-block'><?php echo trans('rides.edit_ride'); ?></button></a>
    <?php if(1) { ?>
<a href="<?php echo url('cancel-ride/'.$ride[0]['ride']->id); ?>"><button class='f-600 btn btn-outline btn-outline-default btn-c-transition btn-radius mr-1 mb-3 mb-md-1 d-sm-inline-block'><?php echo trans('rides.cancel_ride'); ?></button></a>
    <?php } ?>
</div>
    <?php } ?>
</div>
        </div>
    </div>
    <?php } ?>
    
<div class='ride__buttons__row form-group'>
<div class='row'>
    <div class="col-12">
        <?php 
        //check if ride is closed or not
        if($book_btn AND $user_ride=='NA' AND $ride[0]['ride']->status=='0') {
        if($ride[0]['ride']->closed!='1') {
        $flag=1;
    
        if(in_array('I want only 5 star passengers', $features) AND $user_id!=0) 
        {
            $rating=\CommonFunctions::instance()->pass_ratings($user_id);
            if($rating!='5') {
                $flag=0;
                $rating_flag=1;
            }
        }
            
            $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
            if($ride[0]['ride']->booking_method=='Instant booking')
                $date->modify("-15 minutes");
            else
                $date->modify("-30 minutes");
            $expiry15m_before=$date->format("Y-m-d H:i");
            if(!($expiry15m_before>=date('Y-m-d H:i'))) $flag=0;
    
        if($flag) {
        ?>
        <a href="<?php if($user_id==0) echo url('signin/?next='.url('ride/'.$ride[0]['ride']->url)); else echo url('book-seat/'.$ride[0]['ride']->id); ?>"><button class='f-600 btn btn-default btn-outline btn-outline-b-light book-btn mr-1 mb-3 mb-md-1 d-sm-inline-block pt-4 pb-4' style="width:100%; font-size:22px;"><?php if($ride[0]['ride']->booking_method=='Instant booking') echo trans('rides.book_seat'); else echo trans('rides.request_book'); ?></button></a>
        <?php } else { if(isset($rating_flag)) { ?>
        <p class="alert alert-danger">Sorry you can’t book on this ride. The driver has specified he wants only 5-star passengers.</p>
        <?php } } } } ?>
        
        <?php if($user_ride!='NA' AND $user_ride->status=='0') { ?>
        <p class="alert alert-success">Your booking request is under review. We will notify you once your seat is confirmed.</p>
        
        <a href="<?php echo url('cancel-seat/'.$user_ride->id); ?>"><button class='f-600 btn btn-default btn-outline btn-outline-b-light book-btn mr-1 mb-3 mb-md-1 d-sm-inline-block pt-4 pb-4' style="width:100%; font-size:22px;"><?php echo trans('rides.cancel_my_seat'); ?></button></a>
        
        <?php } ?>
        
        <?php 
        if($user_ride!='NA') {
            if($user_ride->status=='1') {
                if($ride[0]['ride']->date.' '.$ride[0]['ride']->time<=date('Y-m-d H:i')) {
        ?>
        <button class='f-600 btn btn-success book-btn mr-1 mb-3 mb-md-1 d-sm-inline-block pt-4 pb-4' data-toggle="modal" data-target="#ride-completed" style="width:100%; font-size:22px;" onclick="$('#completed_ride_field').val('<?php echo $user_ride->id; ?>')"><i class="fa fa-check-square"></i> Mark as completed</button>
        <?php } else { ?>
        <a href="<?php echo url('cancel-seat/'.$user_ride->id); ?>"><button class='f-600 btn btn-default btn-outline btn-outline-b-light book-btn mr-1 mb-3 mb-md-1 d-sm-inline-block pt-4 pb-4' style="width:100%; font-size:22px;"><?php echo trans('rides.cancel_my_seat'); ?></button></a>
        <?php } } else if($user_ride->status=='2') { if($user_rating=='NA') { ?>
        <a href="<?php echo url('leave-feedback/'.$user_ride->id); ?>">
        <button class='f-600 btn btn-success book-btn mr-1 mb-3 mb-md-1 d-sm-inline-block pt-4 pb-4' style="width:100%; font-size:22px;" onclick="$('#feedback_ride_field').val('<?php echo $user_ride->id; ?>'); $('#feedback_type').val('1');"><i class="fa fa-star"></i> <?php echo trans('rides.provide_feedback'); ?></button>
        </a>
        <?php } } ?>
        <?php } ?>
    </div>
    
<div class='col-8 col-sm-8 col-md-6 dsk-hide'>
    
</div>
<div class='col-4 col-sm-4 col-md-6 text-sm-right text-center dsk-hide d-none'>
    <?php if($user_id!=0 AND $user->id==$ride[0]['ride']->added_by) { ?>
<a href="<?php echo url('edit-ride/'.$ride[0]['ride']->id); ?>"><button class='f-600 btn btn-default btn-outline btn-outline-b-light btn-round'>Edit this ride</button></a>
    <?php } ?>
</div>
    
<div class='col-12 col-sm-12 col-md-12 mbl-show'>
<div class='d-flex justify-content-between justify-content-sm-start'>
<button class='f-600 btn btn-default btn-outline btn-outline-b-light btn-round mr-2 mb-3 mb-md-1 d-sm-inline-block'>Ride Booked</button>
<button class='f-600 btn btn-default btn-outline btn-outline-b-light btn-round mb-3 mb-md-1 d-sm-inline-block btn-edit'>Edit this ride</button>
</div>
</div>
</div>
</div>
    <?php if(!empty($ride[0]['ride']->notes)) { ?>
<div class='ride__note form-group'>
<div class='card ride__card'>
<div class='card-body pt-3 pb-0'>
<p class="mb-3">
<b><?php echo trans('rides.important_note'); ?>:</b> <?php echo $ride[0]['ride']->notes; ?>
</p>
</div>
</div>
</div>
    <?php } ?>
<div class='ride__general d-none'>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis id metus congue, varius libero ac, commodo turpis. Curabitur non varius quam. Proin sed hendrerit nulla. Mauris maximus vel sapien quis tristique. Maecenas mattis, dui id mattis mattis, massa tortor cursus velit, in porttitor augue orci gravida mauris. Vestibulum suscipit a lectus at tincidunt.
</p>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis id metus congue, varius libero ac, commodo turpis. Curabitur non varius quam. Proin sed hendrerit nulla. Mauris maximus vel sapien quis tristique. Maecenas mattis, dui id mattis mattis, massa tortor cursus velit, in porttitor augue orci gravida mauris. Vestibulum suscipit a lectus at tincidunt.
</p>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis id metus congue, varius libero ac, commodo turpis. Curabitur non varius quam. Proin sed hendrerit nulla. Mauris maximus vel sapien quis tristique. Maecenas mattis, dui id mattis mattis, massa tortor cursus velit, in porttitor augue orci gravida mauris. Vestibulum suscipit a lectus at tincidunt.
</p>
</div>
</div>
</div>
</div>
<div class='col-12 col-md-12 col-lg-4 col-xl-4'>
    <div class='profile__sidebar'>
<?php include(app_path().'/common/ride_sidebar.php'); ?>
</div>
    
<div class='ride__car__info'>
<div class='car__restricted'>

</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
<style>
                  .ind-payrun-container.payrun-detail-container {
    border-radius: 3px;
    border: 1px solid #F4F7FF;
    box-shadow: 0 4px 25px 0 rgba(28,29,83,.06);
}
.payrun-detail-container {
    position: relative;
    margin-top: 14px;
    margin-bottom: 40px;
    min-width: 650px;
    border-left: 2px solid black;
}
.panel-default {
    border-color: #ddd;
}
.panel {
    margin-bottom: 21px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
                  
                  .ind-payrun-container.payrun-detail-container .panel-body.draft, .ind-payrun-container.payrun-detail-container .panel-body.recalled {
    border-color: #788297;
}
.ind-payrun-container.payrun-detail-container .panel-body {
    padding: 15px 25px;
    border-left: 2px solid;
    border-radius: 3px;
}
                  
                  .ind-payrun-container.payrun-detail-container .payrun-info-row {
    padding-top: 15px;
}
                  
                  .ind-payrun-container.payrun-detail-container .payrun-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: start;
    justify-content: flex-start;
    padding-bottom: 0;
    padding-top: 0;
}
.payrun-detail-container .payrun-row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: start;
    justify-content: flex-start;
    padding-bottom: 10px;
    padding-top: 5px;
}
                  
                  ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail.payrun-total-detail {
    border-right: thin solid #eee;
    border-image: linear-gradient(to bottom,#fff 0,#eee 25%,#eee 50%,#eee 75%,#fff 100%);
    border-left: 0;
    border-image-slice: 1;
}
.ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail {
    padding-right: 5%;
}
.payrun-detail-container .payrun-row .payrun-detail {
    padding-right: 5%;
}
.right-separationline {
    border-right: 1px solid #ededed;
    padding-right: 12px;
    margin-right: 8px;
}
                  .ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail:not(:first-child) {
    padding-left: 5%;
}
.ind-payrun-container.payrun-detail-container .payrun-row .payrun-detail {
    padding-right: 5%;
}
                  
                  .btn-primary, .btn-primary.disabled, .btn-primary[disabled], fieldset[disabled] .btn-primary, .btn-primary.disabled:hover, .btn-primary[disabled]:hover, fieldset[disabled] .btn-primary:hover, .btn-primary.disabled:focus, .btn-primary[disabled]:focus, fieldset[disabled] .btn-primary:focus, .btn-primary.disabled:active, .btn-primary[disabled]:active, fieldset[disabled] .btn-primary:active, .btn-primary.disabled.active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary.active, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    background-color: #4E98FF;
    color: #fff;
    border-color: #4E98FF;
}
.pull-right {
    float: right!important;
}
                  .pull-left {
    float: left!important;
}
                  .ind-payrun-container.payrun-detail-container .payrun-note {
    color: #666;
}
.payrun-detail-container .payrun-note {
    color: #222;
    padding-top: 10px;
    padding-bottom: 5px;
}
.font-small {
    font-size: 13px!important;
}
                  .ind-payrun-container.payrun-detail-container .payrun-row span {
    font-size: 11px;
    font-style: normal;
    text-transform: uppercase;
    color: #666;
    letter-spacing: .3px;
}
                  
                  .payrun-detail-container .payrun-row .payrun-data {
    padding-top: 4px;
                          color: #222;
                          font-size: 15px;
                      line-height: 1.42857143;
                      font-weight: bold;
}
.font-semibold {
    font-family: AvertaSemibold,AvertaRegular;
}
              </style>
              
              <style>
                  .india-payrun-summary-container {
    font-size: 14px!important;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    padding: 25px 30px;
                      padding-left: 0px;
                      padding-top: 8px;
}
                  .india-payrun-summary-container .net-pay-section {
    background-color: #F1F2F8;
    border-radius: 6px;
    color: #2F3448;
    width: 411px;
    height: 160px;
    padding: 20px;
    margin-right: 20px;
    border: 1px solid #E7E8EF;
}
                  
                  .india-payrun-summary-container .net-pay-section .net-pay-data-without-bt {
    margin-top: 18px;
}
                  .india-payrun-summary-container .net-pay-section .payrun-label {
    color: #2F3448;
    opacity: .5;
    font-size: 13px;
}
                  .india-payrun-summary-container .pay-day-section {
    width: 152px;
    height: 160px;
    border-radius: 6px;
    background: #fff;
    text-align: center;
    border: 1px solid #EEEFF3;
    padding: 15px;
    color: #1E223D;
}
                  .india-payrun-summary-container .pay-day-section .emp-count-without-skipped-emp {
    margin-top: 15px;
}
                  .table.noborder-table {
    margin-bottom: 10px;
}
                  
                  .table td, .table th {
    padding: .75rem;
    border-top: 0px solid #dee2e6;
    border-bottom: 1px solid #dee2e6;
}
              </style>

<?php if($book_btn) { ?>
<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="booking-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="ride_id" value="<?php echo $ride[0]['ride']->id; ?>" id="ride">
              <div class="modal-header" style="background: #F9FAFF; padding: 18px 45px 18px 34px; padding-left:20px; padding-right:20px;">
                  
                  <div style="overflow:hidden;">
                      <div class="pull-left">
                          <h3 class="modal-title">Book a Seat</h3>
                      </div>
                  </div>
                  
              </div>
              <div class="modal-body pt-2" style="padding: 18px 45px 18px 34px; padding-top:0px; padding-left:20px; padding-right:20px;">
                  <div id="ember953" class="liquid-container ember-view" style=""><div id="ember956" class="liquid-child ember-view" style="top: 0px; left: 0px;">      <div id="ember957" class="ember-view">
<div class="scroll-x scroll-y scrollbox split-view-content ind-split-view-content download-payslip-footer-margin">
<!---->  <table class="table table-responsive">
    <tbody>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Departure</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->departure; ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Destination</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->destination; ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Leaving at</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo date_format(new DateTime($ride[0]['ride']->date),'l, F d').' at '.date_format(new DateTime($ride[0]['ride']->time),'h:i a'); ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Select seat(s)</b>
        </td>
        <td width="50%" class="ptop-medium">
              <!-- / Number of seats -->

<ul class='ul__list ride-form-seats'>
    <?php if($seats_available>=1) { ?>
<li>
<label for='number-of-seat-1'>
<input id='number-of-seat-1' name='seats' type='radio' value='1' checked>
<span class='seats'>
<span class='seat-number'>
1
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>1) { ?>
<li>
<label for='number-of-seat-2'>
<input id='number-of-seat-2' name='seats' type='radio' value='2'>
<span class='seats'>
<span class='seat-number'>
2
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>2) { ?>
<li>
<label for='number-of-seat-3'>
<input id='number-of-seat-3' name='seats' type='radio' value='3'>
<span class='seats'>
<span class='seat-number'>
3
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>3) { ?>
<li>
<label for='number-of-seat-4'>
<input id='number-of-seat-4' name='seats' type='radio' value='4'>
<span class='seats'>
<span class='seat-number'>
4
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>4) { ?>
<li>
<label for='number-of-seat-5'>
<input id='number-of-seat-5' name='seats' type='radio' value='5'>
<span class='seats'>
<span class='seat-number'>
5
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>5) { ?>
<li>
<label for='number-of-seat-6'>
<input id='number-of-seat-6' name='seats' type='radio' value='6'>
<span class='seats'>
<span class='seat-number'>
6
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
    <?php if($seats_available>6) { ?>
<li>
<label for='number-of-seat-7'>
<input id='number-of-seat-7' name='seats' type='radio' value='7'>
<span class='seats'>
<span class='seat-number'>
7
</span>
<span class='seat-icon'>
<img src="<?php echo url('images/icons-png/seat.png'); ?>" class="seat-unselect" alt="Seat" />
<img src="<?php echo url('images/icons-png/seat-hover-1.png'); ?>" class="seat-select" alt="Seat hover 1" />
</span>
</span>
</label>
</li>
    <?php } ?>
</ul>

<!-- / End Number of seats -->
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Price per seat</b>
        </td>
        <td width="50%" class="ptop-medium">
              $<?php echo $ride[0]['ride']->price; ?> CAD
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Booking price</b>
        </td>
        <td width="50%" class="ptop-medium">
            <?php 
                    $booking_price=$site->booking_price;
                    $booking_per=$site->booking_per;
        
                    if($user_id!=0 AND $user->charge_booking=='0')
                    {
                        $booking_price=0;
                        $booking_per=1;
                    }
                    else if($user_id!=0 AND ($user->booking_price!='' OR $user->booking_per!=''))
                    {
                        $booking_price=$user->booking_price;
                        $booking_per=$user->booking_per;
                    }
        
                    if($booking_per==0) $booking_per=1;
        
                    $total_cost=$ride[0]['ride']->price;
                    //$booking_per=$total_cost*$booking_per/100;
        
                    //if($booking_price>$booking_per) $booking_price=$booking_per;
                     $booking_price=number_format($booking_price, 2);
            ?>
              $<?php echo $booking_price; ?> CAD
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Total</b>
        </td>
        <td width="50%" class="ptop-medium">
              <font style="<?php if($user_id!=0 AND $user->free_rides>0) { ?>text-decoration:line-through;<?php } ?>">
                  $<?php echo number_format($ride[0]['ride']->price+$booking_price, 2); ?> CAD
              </font>
            <?php if($user_id!=0 AND $user->free_rides>0) { ?>  <p class="m-0" style="color:green;">You have <?php echo $user->free_rides; ?> free ride left.</p><?php } ?>
        </td>
      </tr>
      <tr>
        <td width="50%" class="ptop-medium">
          <b>Payment method</b>
        </td>
        <td width="50%" class="ptop-medium">
              <?php echo $ride[0]['ride']->payment_method; ?>
        </td>
      </tr>
<!---->    </tbody>
  </table>
    
    <?php if(((($ride[0]['ride']->payment_method=='Online payment' OR $ride[0]['ride']->payment_method=='Guaranteed cash') OR $ride[0]['ride']->payment_method=='Secured cash') OR ($ride[0]['ride']->payment_method=='Cash' AND $booking_price>0)) AND $user_id!=0 AND $user->free_rides==0) { ?>
    <div class='form-group'>
    <?php if(!empty($user_cards)) { $i=0; ?>
        <ul class='ul__list ul__list--horizontal mt-4'>
    
            <?php foreach($user_cards as $card) { ?>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='access-driver-phone-yes<?php echo $i; ?>'>
<div class='radio-element'>
<input id='access-driver-phone-yes<?php echo $i; ?>' name='payment' type='radio' value='my_card' onchange="update_card(this, '<?php echo $card->id; ?>')" <?php if($i++==0) echo 'checked'; ?>>
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
XXXX-XXXX-XXXX-<?php echo $card->last4; ?>
</div>
</label>
</li>
    
    <?php }  ?>
    <input type="hidden" name="card_id" value="<?php echo $user_cards[0]->id; ?>" id="card_id">

<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='access-driver-phone-yesn'>
<div class='radio-element'>
<input id='access-driver-phone-yesn' name='payment' type='radio' value='new_card' onchange="new_card(this)">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
Use another card
</div>
</label>
</li>
        </ul>
    <?php } else { ?>
        <input name='payment' type='hidden' value='new_card'>
    <?php } ?>
    </div>
    
    <div id="card-element">
      <!-- a Stripe Element will be inserted here. -->
    </div>
    <div class="alert alert-danger mt-2" id="card-errors" role="alert" style="display:none;"></div>
    <?php } ?>
<!----><!----> 
</div>
</div>
</div></div>

                  <p class="alert alert-danger mt-2" id="booking_error" style="display:none;"></p>
                  <p class="alert alert-success mt-3" id="booking_success" style="display:none;"></p>
              </div>
              <div class="modal-footer" style="padding: 18px 30px 18px 17px; padding-left:20px; padding-right:20px;">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary pull-right" style="margin-right:10px;" id="book_btn">Checkout</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php } ?>

<div class="modal fade" id="ride-completed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="completed-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="0" id="completed_ride_field">
              <div class="modal-header" style="background: #F9FAFF; padding: 18px 45px 18px 34px; padding-left:20px; padding-right:20px;">
                  
                  <div style="overflow:hidden;">
                      <div class="pull-left">
                          <h3 class="modal-title">Ride completed</h3>
                      </div>
                  </div>
                  
              </div>
              <div class="modal-body" style="padding: 18px 45px 18px 34px; padding-top:0px; padding-left:20px; padding-right:20px;">
                  <p class="alert alert-success" id="booking_success" style="display:none;"></p>
                  <div id="ember953" class="liquid-container ember-view" style=""><div id="ember956" class="liquid-child ember-view" style="top: 0px; left: 0px;">      <div id="ember957" class="ember-view">
<div class="scroll-x scroll-y scrollbox split-view-content ind-split-view-content download-payslip-footer-margin">
<p class="mt-3 mb-0" style="font-size:16px;">Are you sure you want to mark your ride as completed?</p>
</div>
</div>
</div></div>

                  
              </div>
              <div class="modal-footer" style="padding: 18px 30px 18px 17px; padding-left:20px; padding-right:20px;">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary pull-right" style="margin-right:10px;" id="comp_btn">Yes</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<div class="modal fade" id="ride-feedback" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" id="feedback-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="0" id="feedback_ride_field">
                    <input type="hidden" name="type" value="1" id="feedback_type">
              <div class="modal-header" style="background: #F9FAFF; padding: 18px 45px 18px 34px; padding-left:20px; padding-right:20px;">
                  
                  <div style="overflow:hidden;">
                      <div class="pull-left">
                          <h3 class="modal-title">Provide feedback</h3>
                      </div>
                  </div>
                  
              </div>
              <div class="modal-body" style="padding: 18px 45px 18px 34px; padding-top:0px; padding-left:20px; padding-right:20px;">
                  <p class="alert alert-success" id="booking_success" style="display:none;"></p>
                  <div id="ember953" class="liquid-container ember-view" style=""><div id="ember956" class="liquid-child ember-view" style="top: 0px; left: 0px;">      <div id="ember957" class="ember-view">
<div class="scroll-x scroll-y scrollbox split-view-content ind-split-view-content download-payslip-footer-margin pt-3">
    <div class='form-group'>
        <label class="mb-0">Rating:</label>
<div class='r-rateing'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input type="hidden" name="rating">
</div>
</div>
    
    <div class='form-group'>
        <label class="mb-0">Review:</label>
<textarea class="form-control" name="review" required></textarea>
</div>
</div>
</div>
</div></div>

                  
              </div>
              <div class="modal-footer" style="padding: 18px 30px 18px 17px; padding-left:20px; padding-right:20px;">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary pull-right" style="margin-right:10px;" id="feedback_btn">Submit</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<script>
    function change_status(th, b_id, status)
    {
        var formData=new FormData();
        var token='<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('b_id', b_id);
        formData.append('status', status);
        
        $.ajax({
                url: "<?php echo url('change-status') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $(th).attr('disabled', true);
                    $("#request_error").hide();
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $(th).attr('disabled', false);
                        $("#request_error").text(data.error);
                        $("#request_error").show();
                    } else {
                        // ALL GOOD! just show the success message!
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    }
    
    function update_card(th, id){
        if($(th).is(":checked")) $("#card_id").val(id);
    }
    
    $("#booking-form").submit(function(e){
        var th=this;
        e.preventDefault();
        var flag=0;
        
        var payment_type=$("input[name=payment]:checked").val();
    <?php if($ride[0]['ride']->payment_method=='Cash' OR empty($user_cards)) { ?>
        payment_type=$("input[name=payment]").val();
        <?php } ?>
    if(payment_type=='new_card') {

  window.stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
        $("#card-errors").show();
    } else { //alert(result.token);
      // Send the token to your server
        $("#card-errors").hide();
        $("#book_btn").attr('disabled', true);
        stripeTokenHandler(result.token);
        
        booking_form(th);
    }
  });
    }
        else booking_form(th);
        
        
    });
    
    function booking_form(th)
    {
        var formData=new FormData(th);
        var token='<?php echo csrf_token(); ?>';
        
        $.ajax({
                url: "<?php echo url('book-seat') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $("#book_btn").attr('disabled', true);
                    $("#booking_error").hide();
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $("#booking_success").hide();
                        $("#book_btn").attr('disabled', false);
                        $("#booking_error").text(data.error);
                        $("#booking_error").show();
                    } else {
                        // ALL GOOD! just show the success message!
                        $("#booking_success").text('Your seat has been booked successfully.');
                        $("#booking_success").show();
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    }
    
    $("#completed-form").submit(function(e){
        e.preventDefault();
        var formData=new FormData(this);
        var token='<?php echo csrf_token(); ?>';
        
        $.ajax({
                url: "<?php echo url('ride-completed') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $("#comp_btn").attr('disabled', true);
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $("#comp_btn").attr('disabled', false);
                    } else {
                        // ALL GOOD! just show the success message!
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    });
    
    $("#feedback-form").submit(function(e){
        e.preventDefault();
        var formData=new FormData(this);
        var token='<?php echo csrf_token(); ?>';
        
        $.ajax({
                url: "<?php echo url('ride-feedback') ?>",
                type: "POST",
                data:  formData,
                beforeSend: function(){ //alert('sending');
                    $("#feedback_btn").attr('disabled', true);
                },
                contentType: false,
                processData:false,
                success: function(data) { //alert(data);
                    //success
                    // here we will handle errors and validation messages
                    if ( ! data.success) {
                        $("#feedback_btn").attr('disabled', false);
                    } else {
                        // ALL GOOD! just show the success message!
                        window.location='';
                    }
                },
                error: function()  {
                    //error
                } 	        
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" type="text/javascript"></script>

<script src="https://js.stripe.com/v3/"></script>
          <script>
              // Create a Stripe client
              var pk='<?php echo env('STRIPE_PUB_KEY'); ?>';
window.stripe = Stripe(pk);

// Create an instance of Elements
window.elements = window.stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

              $("input[name=payment]").on('change', function(){
                  var payment=$(this).val();
                  if(payment=='new_card')
                  new_card(this);
                  else $("#card-element").empty();
                  
                  $("#booking_error").hide();
              });
              
              
              
window.card = window.elements.create('card', {style: style});
              
    function new_card(th) {
// Create an instance of the card Element

// Add an instance of the card Element into the `card-element` <div>
window.card.mount('#card-element');
              
              // Handle real-time validation errors from the card Element.
window.card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
      $("#card-errors").show();
       $("#booking_error").hide();
  } else {
    displayError.textContent = '';
      $("#card-errors").hide();
      $("#booking_error").hide();
  }
});
    }

            <?php if(empty($user_cards)) { ?> new_card('this'); <?php } ?>
              
// Handle form submission
/*var form = document.getElementById('booking-form');
form.addEventListener('submit', function(event) {
    var payment_type=$("input[name=payment]").val();
    alert(payment_type);
    if(payment_type=='new_card') {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
        $("#card-errors").show();
    } else { //alert(result.token);
      // Send the token to your server
        $("#card-errors").hide();
        $("#payment-submit").attr('disabled', true);
      stripeTokenHandler(result.token);
    }
  });
    }
});*/
              
              function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('booking-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  //form.submit();
                  return 1;
}
</script>
