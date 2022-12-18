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
<h6 class='text-center mb-0'><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h6>
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
    <?php if($user_data->phone_verified=='1') { ?>
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
    <?php } ?>
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
Rides done as a passenger:
<b><?php echo \CommonFunctions::instance()->rides_done($user_data->id); ?></b>
</p>
</li>
<li class="d-none">
<p class='mb-0'>
Kilometers shared:
<b>34000</b>
</p>
</li>
</ul>
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
<h6 style="font-size:15px;">
Average rating: <?php if(count($ratings)==0) echo 'NA'; else echo '95%'; ?>
</h6>
<h6 style="font-size:15px;">
Reviewed by <?php echo count($ratings); ?> members
</h6>
</div>
<div class='col-12 col-md-6'>
<ul class='ul__list'>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='<?php echo $communication; ?>' data-readonly='true' data-size='25px'></div>
</div>
<div class='r-text'>
<span>
Communication
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='<?php echo $safety; ?>' data-readonly='true' data-size='25px'></div>
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
<div class='profile-rating' data-background='#808080' data-rating='<?php echo $timeliness; ?>' data-readonly='true' data-size='25px'></div>
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
<div class='profile-rating' data-background='#808080' data-rating='<?php echo $attitude; ?>' data-readonly='true' data-size='25px'></div>
</div>
<div class='r-text'>
<span>
Overall attitude
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='<?php echo $hygiene; ?>' data-readonly='true' data-size='25px'></div>
</div>
<div class='r-text'>
<span>
Personal hygiene
</span>
</div>
</div>
</li>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='<?php echo $respect; ?>' data-readonly='true' data-size='25px'></div>
</div>
<div class='r-text'>
<span>
Respect and courtesy
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

<div class='profile__reviews__wrapper'>
<h6 class='bottom-border sub-title mb-0 mt-4 mb-2' style="color: #5e7a8e !important;">
Reviews (<?php echo count($ratings); ?>)
</h6>
<div class='profile__reviews mb-5'>
    <?php 
    if(!empty($ratings)) {
        foreach($ratings as $rating) {
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
            
            $from=$rating['ride']->departure_city;
            $to=$rating['ride']->destination_city;
                    
            if($from=='') $from=$rating['ride']->departure_place;
            if($to=='') $to=$rating['ride']->destination_place;

            if($from=='') $from=$rating['ride']->departure_state;
            if($to=='') $to=$rating['ride']->destination_state;

            if($from=='') $from=$rating['ride']->departure;
            if($to=='' OR $from==$to) $to=$rating['ride']->destination;
    ?>
<div class='profile__review'>
<div class='media mb-4'>
<div class='media-left mr-3'>
<div class='image__rounded'>
    <a href="<?php echo url('driver/'.$rating['user']->username); ?>">
<img src="<?php echo $user_img; ?>" class="img-fluid img-round" alt="User simple"/>
    </a>
</div>
</div>
<div class='media-body pt-3'>
<h6 class='r-title mb-0'><a href="<?php echo url('driver/'.$rating['user']->username); ?>"><?php echo $user_name; ?></a></h6>
    <p class="mb-1" style="color:black;"><a href="<?php echo url('ride/'.$rating['ride']->url); ?>" style="color:inherit;"><?php echo $from.' to '.$to.' on '.date_format(new DateTime($rating['ride']->date),'F d, Y'); ?></a></p>
    
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
<p class='r-desc mt-1'><?php echo $rating['rating']->review; ?></p>
</div>
</div>
</div>
    <?php } } ?>
    
</div>
</div>

<div class='row'>
<div class='col-12'>
<p class='text-left mb-0'>

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
