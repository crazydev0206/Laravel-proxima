<?php include(app_path().'/common/header.php'); ?>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<h3 class='page-title bottom-border mb-3 pb-1'><img src="images/28-bachelor-degree.png" class='' style="max-width: 35px; max-height: 35px; margin-right: 5px;"/> <?php echo trans('pages.students') ?></h3>
<div class='row pt-3'>
    
    <div class='col-md-6 col-lg-6'>
        <h6 style="font-weight: 500 !important;"><?php echo trans('pages.students_title') ?></h6>
        
        <p class="text-justify"><?php echo trans('pages.students_text1', [], $languageSet) ?></p>
        
        <p class="text-justify"><?php echo trans('pages.students_text2', [], $languageSet) ?></p>
        
        <p class="text-justify"><?php echo trans('pages.students_text3', [], $languageSet) ?></p>
    </div>
    
    <div class='col-md-6 col-lg-6'>
<!-- <div class="container-fluid pb-video-container"> -->
<div>
<div class='pb-row'>
<div class='pb__video__container mt-0'>
<div class='pb-video' id='home-pb-video'>
<!--<div class='pb__video__control'>
<a class='control-link' href='#'>
<span class='fa fa-play'></span>
</a>
</div>-->

<div class='pb__video__cover2' style='background-image: url(&#39;https://img.youtube.com/vi/K68UrdUOr2Y/maxresdefault.jpg&#39;)'></div>
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
    
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
