<style>
    h5{
        font-size: 20px;
    }
    
    @media only screen and (max-width:792px)
    {
        .profile__page{
            padding-top: 30px;
        }
    }
</style>
<!-- / Mobile extra sidebar -->
<div class='profile__extra__wrapper'>
<div class='d-md-none d-block pt-0 mt-0'>
<div class='d-flex pt-0 pb-3 w-100 justify-content-between align-items-center mt-0'>
<h5 class='mb-0 mt-0'><?php echo trans('profile.profile_menu'); ?></h5>
<button class='profile__extra__toggle btn btn-default' data-target='#profile-menu-extra' data-toggle='collapse'>
<span class='fa fa-bars'></span>
</button>
</div>
</div>
<div class='collapse profile__extra__sidebar' id='profile-menu-extra'>
<!-- / Profile Information -->
<div class='card card__contact mb-4'>
<div class='card-header'>
<h5 class='card-title mb-0'><?php echo trans('profile.my_profile'); ?></h5>
</div>
<div class='card-body card__body p-0'>
<ul class='ul__list ul__list__card li-p-125 profile-s-menu'>
<li>
<a class="<?php if(isset($title) AND $title=='Personal information') echo 'active'; ?>" href='<?php echo url('personal-information'); ?>'>
<?php echo trans('profile.personal_information'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Photo') echo 'active'; ?>" href='<?php echo url('photo'); ?>'>
<?php echo trans('profile.photo'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Preferences') echo 'active'; ?>" href='<?php echo url('preferences'); ?>'>
<?php echo trans('profile.preferences'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Vehicle') echo 'active'; ?>" href='<?php echo url('vehicle'); ?>'>
<?php echo trans('profile.vehicle'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Refer a Friend') echo 'active'; ?>" href='<?php echo url('refer-friend'); ?>'>
Referrals
</a>
</li>
</ul>
</div>
</div>
<!-- / End Profile Information -->
<!-- / Rating -->
<div class='card card__contact mb-4'>
<div class='card-header'>
<h5 class='card-title mb-0'><?php echo trans('profile.my_ratings'); ?></h5>
</div>
<div class='card-body card__body p-0'>
<ul class='ul__list ul__list__card li-p-125 profile-s-menu'>
<li>
<a class="<?php if(isset($title) AND $title=="Ratings I left") echo 'active'; ?>" href='<?php echo url('ratings-left'); ?>'>
<?php echo trans('profile.ratings_left'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Ratings I received") echo 'active'; ?>" href='<?php echo url('ratings-received'); ?>'>
<?php echo trans('profile.ratings_received'); ?>
</a>
</li>
</ul>
</div>
</div>
<!-- / End Rating -->
<!-- / Account -->
<div class='card card__contact mb-4'>
<div class='card-header'>
<h5 class='card-title mb-0'><?php echo trans('profile.my_wallet'); ?></h5>
</div>
<div class='card-body card__body p-0'>
<ul class='ul__list ul__list__card li-p-125 profile-s-menu'>
<li>
<a class="<?php if(isset($title) AND $title=="All transactions") echo 'active'; ?>" href='<?php echo url('all-transactions'); ?>'>
<?php echo trans('profile.balance_transactions'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Booking credits") echo 'active'; ?>" href='<?php echo url('booking-credits'); ?>'>
Booking credits
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Request withdrawal") echo 'active'; ?>" href='<?php echo url('request-withdrawal'); ?>'>
<?php echo trans('profile.payout'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Payments') echo 'active'; ?>" href='<?php echo url('payments'); ?>'>
<?php echo trans('profile.my_cards'); ?>
</a>
</li>
</ul>
</div>
</div>
<!-- / End Account -->
<!-- / Account -->
<div class='card card__contact mb-4'>
<div class='card-header'>
<h5 class='card-title mb-0'><?php echo trans('profile.my_account'); ?></h5>
</div>
<div class='card-body card__body p-0'>
<ul class='ul__list ul__list__card li-p-125 profile-s-menu'>
<li>
<a class="<?php if(isset($title) AND $title=="Home address") echo 'active'; ?>" href='<?php echo url('home-address'); ?>'>
<?php echo trans('profile.home_address'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Phone") echo 'active'; ?>" href='<?php echo url('phone'); ?>'>
<?php echo trans('profile.phone'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Email") echo 'active'; ?>" href='<?php echo url('email'); ?>'>
<?php echo trans('profile.email'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Password') echo 'active'; ?>" href='<?php echo url('password'); ?>'>
<?php echo trans('profile.password'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=='Close my account') echo 'active'; ?>" href='<?php echo url('close-account'); ?>'>
<?php echo trans('profile.close_my_account'); ?>
</a>
</li>
</ul>
</div>
</div>
<!-- / End Account -->
    
<!-- / Account -->
<div class='card card__contact mb-4'>
<div class='card-header'>
<h5 class='card-title mb-0'><?php echo trans('profile.verifications'); ?></h5>
</div>
<div class='card-body card__body p-0'>
<ul class='ul__list ul__list__card li-p-125 profile-s-menu'>
<li>
<a class="<?php if(isset($title) AND $title=="Verify phone number") echo 'active'; ?>" href='<?php echo url('verify-phone'); ?>'>
<?php echo trans('profile.verify_phone_number'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Verify driver's license") echo 'active'; ?>" href='<?php echo url('verify-driver'); ?>'>
<?php echo trans('profile.verify_driver_license'); ?>
</a>
</li>
<li>
<a class="<?php if(isset($title) AND $title=="Verify student card") echo 'active'; ?>" href='<?php echo url('verify-student'); ?>'>
<?php echo trans('profile.verify_student_card'); ?>
</a>
</li>
</ul>
</div>
</div>
<!-- / End Account -->

</div>
<!-- / End Mobile extra sidebar -->
</div>
<!-- / Personal card -->
<!--<div class='card card__profile mb-4'>
<div class='card__body card-body'>
<div class='card__body__content text-center'>
<div class='image__outer mb-2'>
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
<source srcset='<?php echo $img; ?>'>
<img src="<?php echo $img; ?>" alt="<?php echo $user_data->first_name.' '.$user_data->last_name; ?>" style="max-width:100%; max-height:100px;"/>
</picture>
</div>
<div class='image__content'>
<div class='profile__content text-center'>
<h5 class="mb-0"><?php echo $user_data->first_name.' '.$user_data->last_name; ?></h5>
<p class="mb-1">
    <?php if(!empty($user_data->country)) { ?>
<span class='fa fa-map-marker'></span> <?php if(!empty($user->city)) echo $user_data->city.', '.$user_data->state.', '.$user_data->country; ?>
    <?php } ?>
</p>
<div class='profile__rating__wrapper svg-back-transparent text-center d-flex justify-content-center mb-2'>
<div class='profile-rating' data-background='transparent' data-rating='4.4'></div>
</div>
</div>
<ul class='social__list ul__list ul__list--horizontal justify-content-center'>
    <?php if(!empty($user_data->facebook)) { ?>
<li>
<a href='<?php echo $user_data->facebook ?>' target="_blank">
<span class='fa fa-facebook'></span>
</a>
</li>
    <?php } ?>
    <?php if(!empty($user_data->google)) { ?>
<li>
<a href='<?php echo $user_data->google; ?>' target="_blank">
<span class='fa fa-google-plus'></span>
</a>
</li>
    <?php } ?>
    <?php if(!empty($user_data->instagram)) { ?>
<li>
<a href='<?php echo $user_data->instagram ?>' target="_blank">
<span class='fa fa-instagram'></span>
</a>
</li>
    <?php } ?>
    <?php if(!empty($user_data->youtube)) { ?>
<li>
<a href='<?php echo $user_data->youtube; ?>' target="_blank">
<span class='fa fa-youtube'></span>
</a>
</li>
    <?php } ?>
</ul>
</div>
</div>
</div>
<div class='card__footer card-footer' style="line-height: 1rem;">
<div class='cf-left cf-grid'>
<div class='text-center'>
<span class='f-700 h-text'><?php 
    if($user_data->dob!='0000-00-00') {
    $t_date=new DateTime('today');
    echo date_diff(date_create($user_data->dob), $t_date)->y;
    } else echo 'NA';
    ?></span>
<div class='clearfix'></div>
<span>Age</span>
</div>
</div>
<div class='cf-right cf-grid'>
<div class='text-center'>
<span class='f-700 h-text'>0</span>
<div class='clearfix'></div>
<span><?php if($user->type=='Driver') echo 'Driven'; else echo 'Booked'; ?></span>
</div>
</div>
</div>
</div>
 / End Personal card -->
<!-- / Contact information card -->
<!--<div class='card card__contact mb-4'>
<div class='card-header'>
<h5 class='card-title mb-0'>Contact information</h5>
</div>
<div class='card-body card__body'>
<ul class='ul__list contact__list'>
<li>
<div class='media'>
<div class='media-left'>
<div class='media-icon mb-2'>
<span class='fa fa-email fa-envelope'></span>
</div>
</div>
<div class='media-body' style="line-height: 0.9rem;">
<h6 class='m-title mb-0'>Email</h6>
<p class='m-text'><?php echo $user_data->email; ?></p>
</div>
</div>
</li>
<li>
<div class='media'>
<div class='media-left'>
<div class='media-icon mb-2'>
<span class='fa fa-mobile' style="font-size: 18px;"></span>
</div>
</div>
<div class='media-body' style="line-height: 0.9rem;">
<h6 class='m-title mb-0'>Mobile</h6>
<p class='m-text'><?php echo $user_data->phone; ?></p>
</div>
</div>
</li>
<li>
<div class='media'>
<div class='media-left'>
<div class='media-icon'>
<span class='fa fa-email fa-map-marker'></span>
</div>
</div>
<div class='media-body' style="line-height: 0.9rem;">
<h6 class='m-title mb-0'>Current address</h6>
<p class='m-text'><?php if(!empty($user->city)) echo $user_data->city.', '.$user_data->state.', '.$user_data->country; ?></p>
</div>
</div>
</li>
</ul>
</div>
</div>-->
<!-- / End Contact information card -->
<!-- / Refers a friend card -->
<!--<div class='card card__reference mb-5'>
    <a href="<?php echo url('refer-friend'); ?>" style="text-decoration:none;">
<div class='card-body'>
<h5 class='card-body-title text-center'>Refer a friend</h5>
</div>
    </a>
</div>-->
<!-- / End Refers a friend card -->