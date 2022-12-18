<?php include(app_path().'/common/header.php'); ?>

<style type="text/css">
    .media-body > .m-0{

        color: #000 !important;
        font-weight: 700 !important;
    }
</style>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<h2 class='page-title roboto'><?php echo trans('home.how_proximaride_works'); ?></h2>
<p style="font-size: 18px !important;"><?php echo trans('home.how_proximaride_works_text'); ?></p>

<div class='row'>
<div class='col-12 col-md-12 col-lg-12'>
 
    <div class='col-md-12 col-lg-7 mr-auto ml-auto'>
<!-- <div class="container-fluid pb-video-container"> -->
<div>
<div class='pb-row'>
<div class='pb__video__container'>
<div class='pb-video' id='home-pb-video'>
<div class='pb__video__content'>
<div class='embed-responsive embed-responsive-16by9'>
<iframe allowfullscreen='' class='pb-video-frame embed-responsive-item' frameborder='0' height='230' src='<?=$link; ?>' width='100%'></iframe>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- </div> -->
</div>
    
    <div class='home__ride__work'>
<div class='container'>
<div class='row mb-5'>
<div class='col-12 d-none'>
<h5 class='offer pt-5 page-section-title'><?php echo trans('home.how_ridesharing_work'); ?></h5>
<p class='safe m-0'><?php echo trans('home.follow_steps'); ?></p>
</div>
</div>
<div class='row'>
<div class='col-md-6'>
<div class='card card-default card-list-group-no-border card__ride'>
<div class='card-header text-center'>
<h5 class='card-title pt-0 m-0'><?php echo trans('home.for_passengers'); ?></h5>
<p class='card-text'><?php echo trans('home.for_passengers_text'); ?></p>
</div>
<div class='card-body'>
<div class='list-group'>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-1-find-a-ride.png'>
<!-- <img src="https://pbs.twimg.com/media/EGHYvttU4AAYKb7?format=jpg&name=large" class="d-block w-100" alt="..."> -->
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_passengers1'); ?></p>
<p class='card-text'><?php echo trans('home.for_passengers1_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-2-book-a-seat.png'>
<!-- <img src="https://pbs.twimg.com/media/EGHYvttU4AAYKb7?format=jpg&name=large" class="d-block w-100" alt="..."> -->
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_passengers2'); ?></p>
<p class='card-text'><?php echo trans('home.for_passengers2_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-3-pay-online.png'>
<!-- <img src="https://pbs.twimg.com/media/EGHYvttU4AAYKb7?format=jpg&name=large" class="d-block w-100" alt="..."> -->
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_passengers3'); ?></p>
<p class='card-text'><?php echo trans('home.for_passengers3_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-4-catch-your-ride.png'>
<!-- <img src="https://pbs.twimg.com/media/EGHYvttU4AAYKb7?format=jpg&name=large" class="d-block w-100" alt="..."> -->
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_passengers4'); ?></p>
<p class='card-text'><?php echo trans('home.for_passengers4_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-5-leave-a-review.png'>
<!-- <img src="https://pbs.twimg.com/media/EGHYvttU4AAYKb7?format=jpg&name=large" class="d-block w-100" alt="..."> -->
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_passengers5'); ?></p>
<p class='card-text'><?php echo trans('home.for_passengers5_text'); ?></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class='col-md-6'>
<div class='card card-default card-list-group-no-border card__ride'>
<div class='card-header text-center'>
<h5 class='card-title pt-0 m-0'><?php echo trans('home.for_drivers'); ?></h5>
<p class='card-text'><?php echo trans('home.for_drivers_text'); ?></p>
</div>
<div class='card-body'>
<div class='list-group'>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-6-offer-a-ride.png'>
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_drivers1'); ?></p>
<p class='card-text'><?php echo trans('home.for_drivers1_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-7-get-a-booking.png'>
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_drivers2'); ?></p>
<p class='card-text'><?php echo trans('home.for_drivers2_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-8-enjoy-the-ride.png'>
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_drivers3'); ?></p>
<p class='card-text'><?php echo trans('home.for_drivers3_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-9-get-paid.png'>
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_drivers4'); ?></p>
<p class='card-text'><?php echo trans('home.for_drivers4_text'); ?></p>
</div>
</div>
</div>
<div class='list-group-item'>
<div class='media'>
<div class='media-left'>
<img alt='' class='icon_img' src='images/8-10-leave-a-review.png'>
</div>
<div class='media-body'>
<p class='font-weight-bold m-0'><?php echo trans('home.for_drivers5'); ?></p>
<p class='card-text'><?php echo trans('home.for_drivers5_text'); ?></p>
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
    
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
