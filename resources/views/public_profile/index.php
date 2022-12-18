<?php include(app_path().'/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet" type="text/css" />
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
    
    .btn-outline-default{
            background: #394d5b;
            color: white;
        }
    
    .gj-datepicker [role=right-icon] {
        display: none;
    }
    
    .input-group > .custom-select:not(:last-child), .input-group > .form-control:not(:last-child) {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    </style>

<div class='body__content'>
<div class='profile__page page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<div class='page__content__body'>
<div class='row'>
<div class='col-12 col-md-4 col-lg-3'>
<div class='profile__sidebar'>
<div class='card card__profile mb-4'>
<div class='card__body card-body'>
<div class='card__body__content text-center'>
<div class='image__outer mb-3'>
    <?php 
    if($user_data->gender=='Male')
    $img=url('images/male.png');
    else if($user_data->gender=='Female')
    $img=url('images/female.png');
    else
    $img=url('images/neutral.png');
    if(!empty($user_data->profile_image)) $img=url('images/profile_images/'.$user_data->profile_image);
    else if(!empty($user_data->avatar)) $img=$user_data->avatar;
    ?>
<picture>
<source srcset='<?php  echo $img; ?>'>
<img src="<?php  echo $img; ?>" class="img-circle" alt="User simple" style="width:90px; height:90px;"/>
</picture>
</div>
<div class='profile__info'>
<h5 class='text-center mb-0'><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h5>
<p class='text-center'>
<span class='text-grey-1 mr-1'>Age:</span>
<b><?php echo $user_age; ?></b>
</p>
<p class='text-center text-grey-1'>
Member since
<b><?php echo date_format(new DateTime($user_data->created_on),'F'); ?></b>
<b><?php echo date_format(new DateTime($user_data->created_on),'Y'); ?></b>
</p>
</div>
<hr class='double'>
<div class='verification__list'>
<ul class='ul__list'>
    <?php if($user_data->driver=='1') { ?>
<li>
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
Driver's license verified
</div>
</div>
</li>
    <?php } ?>
<li>
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
Phone number verified
</div>
</div>
</li>
    <?php if($user_data->verify=='1') { ?>
<li>
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
Email verified
</div>
</div>
</li>
    <?php } ?>
<li>
<div class='media align-items-center'>
<div class='media-left'>
<span class='f-20 text-success'>
<span class='fa fa-check'></span>
</span>
</div>
<div class='media-body text-left pl-2'>
Linkedin profile conncted
</div>
</div>
</li>
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
Rides done as a driver:
<b>33</b>
</p>
</li>
<li>
<p class='mb-0'>
Rides done as a passenger:
<b>8</b>
</p>
</li>
<li>
<p class='mb-0'>
Passengers driven:
<b>354</b>
</p>
</li>
<li>
<p class='mb-0'>
Kilometers shared:
<b>34000</b>
</p>
</li>
</ul>
</div>
<hr class='double'>
<div class='sidebar__car'>
<div class='row'>
<div class='col-12'>
<div class='img-thumbnail-wrapper'>
    <?php 
    $car_image=url('images/car_placeholder2.png');
    if(isset($vehicle->image) AND $vehicle->image!='') $car_image=url('car_images/'.$vehicle->image);
    ?>
<img src="<?php echo $car_image; ?>" class="img-thumbnail img-fluid" alt="Bentley continental gt red wallpaper" />
</div>
    <?php 
    if(isset($vehicle->id)) {
    $vehicle_type=$vehicle->type;
    if($vehicle_type=='') $vehicle_type=$vehicle->other;
    ?>
<p class='text-center mt-2'><?php echo $vehicle->model.' • '.$vehicle_type.' • '.$vehicle->color.' • '.$vehicle->year.'<br>'.$vehicle->license_no; ?></p>
    <?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<div class='col-12 col-md-8 col-lg-9'>
<div class='public__bio'>
<p>
<?php echo $user_data->about; ?>
</p>
</div>
<hr class='double'>
<div class='public__rating'>
<div class='row'>
<div class='col-12 col-md-6'>
<h6>
Average rating:
<b>95%</b>
</h6>
<h6>
Reviewed by
<b>18</b>
members
</h6>
</div>
<div class='col-12 col-md-6'>
<ul class='ul__list'>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='4' data-readonly='true' data-size='20px'></div>
</div>
<div class='r-text'>
<span>
Timeliness
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='5' data-readonly='true' data-size='20px'></div>
</div>
<div class='r-text'>
<span>
Condition of the vehicle
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='5' data-readonly='true' data-size='20px'></div>
</div>
<div class='r-text'>
<span>
Safety
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='5' data-readonly='true' data-size='20px'></div>
</div>
<div class='r-text'>
<span>
Conscious of passengers
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='5' data-readonly='true' data-size='20px'></div>
</div>
<div class='r-text'>
<span>
Comfort
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='5' data-readonly='true' data-size='20px'></div>
</div>
<div class='r-text'>
<span>
Driver
</span>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
<!-- / Public review -->
<div class='public__review__wrapper'>
<hr>
<div class='profile__reviews__wrapper'>
<h4 class='section-title mt-2 mb-4'>Reviews</h4>
<div class='profile__reviews mb-5'>
<div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
<img src="/images/icons-png/user-simple.png" class="img-fluid img-round" alt="User simple" />
</div>
</div>
<div class='media-body'>
<h6 class='r-title'>John Doe</h6>
<p class='r-desc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dui magna, ultrices sed malesuada quis, hendrerit quis velit. Maecenas pellentesque facilisis fermentum.</p>
</div>
</div>
</div>
<div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
<img src="/images/icons-png/user-simple.png" class="img-fluid img-round" alt="User simple" />
</div>
</div>
<div class='media-body'>
<h6 class='r-title'>John Doe</h6>
<p class='r-desc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dui magna, ultrices sed malesuada quis, hendrerit quis velit. Maecenas pellentesque facilisis fermentum.</p>
</div>
</div>
</div>
<div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
<img src="/images/icons-png/user-simple.png" class="img-fluid img-round" alt="User simple" />
</div>
</div>
<div class='media-body'>
<h6 class='r-title'>John Doe</h6>
<p class='r-desc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dui magna, ultrices sed malesuada quis, hendrerit quis velit. Maecenas pellentesque facilisis fermentum.</p>
</div>
</div>
</div>
<div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
<img src="/images/icons-png/user-simple.png" class="img-fluid img-round" alt="User simple" />
</div>
</div>
<div class='media-body'>
<h6 class='r-title'>John Doe</h6>
<p class='r-desc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dui magna, ultrices sed malesuada quis, hendrerit quis velit. Maecenas pellentesque facilisis fermentum.</p>
</div>
</div>
</div>
<div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
<img src="/images/icons-png/user-simple.png" class="img-fluid img-round" alt="User simple" />
</div>
</div>
<div class='media-body'>
<h6 class='r-title'>John Doe</h6>
<p class='r-desc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dui magna, ultrices sed malesuada quis, hendrerit quis velit. Maecenas pellentesque facilisis fermentum.</p>
</div>
</div>
</div>
</div>
</div>

<div class='row'>
<div class='col-12'>
<p class='text-left mb-0'>
<a href='#'>
>>> Read more
</a>
</p>
</div>
</div>
</div>
<!-- / End public review -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" type="text/javascript"></script>
