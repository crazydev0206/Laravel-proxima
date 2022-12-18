<div class='card card__profile mb-4'>
<div class='card__body card-body'>
<div class='card__body__content text-center'>
<div class='image__outer mb-3'>
    <?php 
    if($ride[0]['driver']->gender=='Male')
    $img=url('images/male.png');
    else if($ride[0]['driver']->gender=='Female')
    $img=url('images/female.png');
    else
    $img=url('images/neutral.png');
    if(!empty($ride[0]['driver']->profile_image)) $img=url('images/profile_images/'.$ride[0]['driver']->profile_image);
    else if(!empty($ride[0]['driver']->avatar)) $img=$ride[0]['driver']->avatar;
    ?>
<picture>
<source srcset='<?php echo $img; ?>'>
    <a href="<?php echo url('driver/'.$ride[0]['driver']->username); ?>">
<img src="<?php echo $img; ?>" class="img-circle" alt="User simple" style="width:90px; height:90px;"/>
    </a>
</picture>
</div>
<div class='profile__info'>
    <h6 class='text-center mb-1'><a href="<?php echo url('driver/'.$ride[0]['driver']->username); ?>"><?php echo $ride[0]['driver']->first_name.' '.$ride[0]['driver']->last_name; ?>, <?php echo $ride[0]['driver_age']; ?></a></h6>
    <center>
        <?php if($ride[0]['driver_ratings']!='NA') { ?>
        <div class='profile-rating mb-3' data-background='#808080' data-rating='<?php echo $ride[0]['driver_ratings']; ?>' data-readonly='true' data-size='24px'></div>
        <?php } else echo trans('rides.no_reviews').'<br><br>'; ?>
    </center>
</div>

    <style>
        .verification__list ul.ul__list li{
            border-bottom:1px solid #ebebeb;
            border-collapse: collapse !important;
        }
    </style>
    
<div class='verification__list'>
<ul class='ul__list'>
    <?php if($ride[0]['driver']->driver=='1') { ?>
<li style="border-top:1px solid #ebebeb;">
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
<?php echo trans('rides.license_verified'); ?>
</div>
</div>
</li>
    <?php } ?>
    
    <?php if($ride[0]['driver']->phone_verified=='1') { ?>
<li>
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
<?php echo trans('rides.phone_verified'); ?>
</div>
</div>
</li>
    <?php } ?>
    <?php if($ride[0]['driver']->verify=='1') { ?>
<li>
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
<?php echo trans('rides.email_verified'); ?>
</div>
</div>
</li>
    <?php } ?>
</ul>
</div>
</div>
</div>
</div>
<div class='driver__info'>
<div class='card card__profile mb-4'>
<div class='card__body card-body'>
<div class='card__body__content text-center'>
<ul class='ul__list'>
<li>
<p class='mb-0'>
<?php echo trans('rides.rides_done'); ?>:
<b><?php echo \CommonFunctions::instance()->rides_driven($ride[0]['ride']->added_by); ?></b>
</p>
</li>
<li>
<p class='mb-0'>
<?php echo trans('rides.passengers_driven'); ?>:
<b><?php echo \CommonFunctions::instance()->pass_driven($ride[0]['ride']->added_by); ?></b>
</p>
</li>
</ul>
</div>

    <?php if($ride[0]['ride']->skip_vehicle!='1') { ?>
<div class='sidebar__car mt-2'>
<div class='row'>
<div class='col-12'>
<div class='img-thumbnail-wrapper'>
    <?php 
    $car_image=url('images/car_placeholder2.png');
    if(isset($ride[0]['ride']->car_image) AND $ride[0]['ride']->car_image!='') $car_image=url('car_images/'.$ride[0]['ride']->car_image);
    ?>
<img src="<?php echo $car_image; ?>" class="img-thumbnail img-fluid" alt="Bentley continental gt red wallpaper" />
</div>
    <?php 
    $vehicle_type=$ride[0]['ride']->vehicle_type;
    if($vehicle_type=='') $vehicle_type=$ride[0]['ride']->other;
    
    if($ride[0]['ride']->model!='') {
    ?>
<p class='text-center mt-2'><?php echo $ride[0]['ride']->model.' • '.$vehicle_type.' • '.$ride[0]['ride']->color.' • '.$ride[0]['ride']->year.'<br>'.$ride[0]['ride']->license_no; ?></p>
    <?php } ?>
</div>
</div>
</div>
    <?php } ?>
</div>
</div>
</div>