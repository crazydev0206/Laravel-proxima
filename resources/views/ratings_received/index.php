<?php include(app_path().'/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo url('stylesheets/uikit.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('javascripts/libs/flot/flot.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/perfect-scrollbar.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/dashboard.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/wave.css'); ?>" rel="stylesheet" />

<div class='body__content container-fluid'>
    <div class="row">
        <div class="col-12 col-md-12 col-lg -4 col-xl-3">
            <div class="container-fluid flex-grow-1 container-p-y">
                <?php $user_data=$user; include(app_path().'/common/left_profile.php'); ?>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8 col-xl-9">
            <div class="container-fluid flex-grow-1 container-p-y">
                <div class="d-flex align-items-center justify-content-between">

                    <div class="text-muted small d-block breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="lnr lnr-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo url($title)?>"><?php echo $title?></a>
                            </li>
                            <?php if(isset($subtitle)):?>
                            <li class="breadcrumb-item active"><?php echo $subtitle?></li>
                            <?php endif?>
                        </ol>
                    </div>


                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="main-heading"><?php echo trans('profile.ratings_received'); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class='public__rating'>
                            <div class='row'>
                                <div class='col-12 col-md-6'>
                                    <h6 style="font-size:15px;">
                                        <?php echo trans('profile.reviewed_by'); ?>
                                        <?php echo count($ratings); ?>
                                        <?php echo trans('profile.members'); ?>
                                    </h6>
                                </div>
                                <div class='col-12 col-md-6'>
                                    <ul class='ul__list'>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $vehicle_condition['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                    <input class="ratings" type="hidden" name="vehicle_condition">
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.condition_vehicle'); ?>
                                                        (<?php echo $vehicle_condition['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $conscious['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                    <input class="ratings" type="hidden" name="conscious">
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.conscious_passengers'); ?>
                                                        (<?php echo $conscious['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $comfort['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                    <input class="ratings" type="hidden" name="comfort">
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.comfort'); ?>
                                                        (<?php echo $comfort['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $communication['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.communication'); ?>
                                                        (<?php echo $communication['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $attitude['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                    <input class="ratings" type="hidden" name="attitude">
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.overall_attitude'); ?>
                                                        (<?php echo $attitude['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $hygiene['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                    <input class="ratings" type="hidden" name="hygiene">
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.personal_hygiene'); ?>
                                                        (<?php echo $hygiene['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $respect['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                    <input class="ratings" type="hidden" name="respect">
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.respect_courtesy'); ?>
                                                        (<?php echo $respect['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $safety['avg']; ?>' data-readonly='true'
                                                        data-size='25px'></div>
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.safety'); ?>
                                                        (<?php echo $safety['total']; ?>)
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class='d-flex'>
                                                <div class='r-rateing mr-1'>
                                                    <div class='profile-rating' data-background='#808080'
                                                        data-rating='<?php echo $timeliness['avg']; ?>'
                                                        data-readonly='true' data-size='25px'></div>
                                                </div>
                                                <div class='r-text'>
                                                    <span>
                                                        <?php echo trans('forms.timeliness'); ?>
                                                        (<?php echo $timeliness['total']; ?>)
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
                                <h6 class='bottom-border sub-title mb-0 mt-4 mb-2 d-none'
                                    style="color: #5e7a8e !important;">
                                    Reviews (<?php echo count($ratings); ?>)
                                </h6>
                                <div class='profile__reviews mb-5 mt-4'>
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
                                                        
                                                        if($rating['rating']->type=='1') $link='passenger/';
                                                        else $link='driver/';
                                                 ?>
                                    <div class='profile__review'>
                                        <div class='media mb-4'>
                                            <div class='media-left mr-3'>
                                                <div class='image__rounded'>
                                                    <?php if($rating['user']!='NA') { ?>
                                                    <a href="<?php echo url($link.$rating['user']->username); ?>">
                                                        <img src="<?php echo $user_img; ?>" class="img-fluid img-round"
                                                            alt="User simple" />
                                                    </a>
                                                    <?php } else { ?>
                                                    <img src="<?php echo url('images/neutral.png'); ?>"
                                                        class="img-fluid img-round" alt="User simple" />
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class='media-body pt-3'>
                                                <h6 class='r-title mb-0'>
                                                    <?php if($rating['user']!='NA') { ?>
                                                    <a
                                                        href="<?php echo url($link.$rating['user']->username); ?>"><?php echo $user_name; ?></a>
                                                    <?php } else echo $user_name; ?>
                                                    <?php
                                                                        if($rating['rating']->type=='1') echo '<small> • Passenger review</small>';
                                                                        else echo '<small> • Driver review</small>';
                                                                    ?>
                                                </h6>
                                                <p class="mb-1" style="color:black;"><a
                                                        href="<?php echo url('ride/'.$rating['ride']->url); ?>"
                                                        style="color:inherit;"><?php echo $from.' to '.$to.' on '.date_format(new DateTime($rating['ride']->date),'F d, Y'); ?></a>
                                                </p>

                                                <div class='r-rateing'>
                                                    <ul class='ul__list'>
                                                        <li>
                                                            <div class='d-flex'>
                                                                <div class='r-text'
                                                                    style="background:#f39c12; color:white; padding-left:3px; padding-right:3px; font-weight:bold; border-radius:2px;">
                                                                    <span>
                                                                        <?php echo number_format($rating['avg_rating'], 1); ?>
                                                                    </span>
                                                                </div>

                                                                <div class='r-rateing mr-1'>
                                                                    <div class='profile-rating'
                                                                        data-background='#808080' data-readonly='true'
                                                                        data-rating='<?php echo $rating['avg_rating']; ?>'
                                                                        data-size='20px'></div>
                                                                </div>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p class='r-desc mt-1'>
                                                    <?php echo $rating['rating']->review; ?></p>
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

<?php include(app_path().'/common/footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" type="text/javascript"></script>