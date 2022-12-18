<?php include(app_path().'/common/header.php'); ?>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<h3 class='page-title bottom-border mb-3 pb-1'>Satisfied members</h3>
<div class='row'>
<div class='col-12 col-md-12 col-lg-12'>
    <div class='home__testimonial mt-3'>
<div class='container'>
    <div class='row'>
    <?php 
    if(!empty($satisfied)) { $i=0;
        foreach($satisfied as $s) {
            if($s['user']->gender=='Male')
            $img=url('images/male.png');
            else if($s['user']->gender=='Female')
            $img=url('images/female.png');
            else
            $img=url('images/neutral.png');
            
            if(!empty($s['user']->profile_image)) $img=url('images/profile_images/'.$s['user']->profile_image);
            else if(!empty($s['user']->avatar)) $img=$s['user']->avatar;
    ?>
<div class='col-md-1 <?php if($i>2) echo 'hide-on-mobile'; ?> '>
<a href="<?php echo url('passenger/'.$s['user']->username); ?>"><img alt='' class='icon_img' src='<?php echo $img; ?>'></a>
<!-- <img src="https://pbs.twimg.com/media/EGHYvttU4AAYKb7?format=jpg&name=large" class="d-block w-100" alt="..."> -->
</div>
<div class='col-md-5 <?php if($i++>2) echo 'hide-on-mobile'; ?> mb-4'>
<div class='card__message'>
<div class='card-body'>
<h6><?php echo $s['user']->first_name.' '.$s['user']->last_name;
            if($s['user']->dob!='') echo ', '.$s['user_age'].' years old';
            if($s['user']->country!='') echo ', a member from '.$s['user']->country; ?></h6>
<p class='card-text text-justify'><?php echo $s['rating']->review; ?></p>
</div>
</div>
</div>
    <?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
