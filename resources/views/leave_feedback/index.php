<?php include(app_path().'/common/header.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo url('rating/themes/bars-square.css'); ?>">
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
    
    ul.ul__list li{
        border-bottom: 1px solid #ced4da;
        margin-bottom: 5px;
        padding-bottom: 5px;
    }
    
    .br-theme-bars-square .br-widget a {
        margin-right: 5px;
    }
    </style>
<?php

    $from=$ride->departure_city;
    $to=$ride->destination_city;
                    
    if($from=='') $from=$ride->departure_place;
    if($to=='') $to=$ride->destination_place;

    if($from=='') $from=$ride->departure_state;
    if($to=='') $to=$ride->destination_state;

    if($from=='') $from=$ride->departure;
    if($to=='' OR $from==$to) $to=$ride->destination;
?>

<div class='body__content'>
<div class='post__ride page__common p-60 with-b-top ride__view__page'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-12 col-lg-8 col-xl-8'>
    <form action="" method="post" onsubmit="return check_data();">
        <?php echo csrf_field(); ?>
    <div class='page__title__wrapper'>
<div class='page__title__box'>
<h3 class='page__title text-c-blue f-700'>
<?php echo $from.' to '.$to; ?>
</h3>
<h6 class='view-date text-normal sub-title'>
<?php echo date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a'); ?>
</h6>
</div>
</div>
    
    <?php if(Session::has('success')) { ?>
    <p class="alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
    
    <ul class='ul__list'>
        <?php if($type=='1') { ?>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="vehicle_condition">
</div>
<div class='r-text'>
<span>
Condition of the vehicle
</span>
</div>
</div>
</li>
        <?php } ?>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="communication">
</div>
<div class='r-text'>
<span>
Communication
</span>
</div>
</div>
</li>
        <?php if($type=='1') { ?>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="conscious">
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
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="comfort">
</div>
<div class='r-text'>
<span>
Comfort
</span>
</div>
</div>
</li>
        <?php } ?>
        <?php if($type=='2') { ?>
        <li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="attitude">
</div>
<div class='r-text'>
<span>
Overall attitude
</span>
</div>
</div>
</li>
        <?php } ?>
        <?php if($type=='2') { ?>
        <li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="hygiene">
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
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="respect">
</div>
<div class='r-text'>
<span>
Respect and courtesy
</span>
</div>
</div>
</li>
        <?php } ?>
<li>
<div class='d-flex'>
<div class='r-rateing mr-1'>
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="safety">
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
<div class='profile-rating' data-background='#808080' data-rating='0' data-size='25px'></div>
    <input class="ratings" type="hidden" name="timeliness">
</div>
<div class='r-text'>
<span>
Timeliness
</span>
</div>
</div>
</li>
</ul>
    
    <div class='form-group mt-3'>
        <label>Write a review:</label>
        <textarea class="form-control form-group-border" name="review" required></textarea>
    </div>
        
        <hr class="mt-4 mb-3">
        
    <h5>How likely are you to recommend <?php if($type=='1') echo $driver->first_name; else echo $passenger->first_name; ?> to a friend or colleague? (Optional)</h5>
    <p>This part of the feedback will remain private and never be seen <?php if($type=='1') echo 'by the driver or other passengers.'; else echo 'by any passenger or driver.'; ?></p>
        
        <div class='form-group mt-3' style="overflow:hidden; max-width:430px;">
            <div style="overflow:hidden;">
            <select id="example-square" name="recommend" autocomplete="off">
                  <option value=""></option>
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                </div>
            
            <div style="overflow:hidden; max-width:403px; margin-top:5px;">
            <div style="float:left;">Not all likely</div>
            <div style="float:right;">Extremely likely</div>
            </div>
        </div>
        
    <div class='form-group mt-3'>
        <label>Leave a note for ProximaRide staff:</label>
        <textarea class="form-control form-group-border" name="note"></textarea>
    </div>
        
        
    <p class="alert alert-danger" id="error" style="display:none;"></p>
        
    <div class='form-group mt-2'>
        <button class='btn btn-outline btn-outline-default btn-radius' type='submit'>
            Submit
        </button>
    </div>
        
    </form>
</div>
<div class='col-12 col-md-12 col-lg-4 col-xl-4'>
    
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js" type="text/javascript"></script>
<script src="<?php echo url('rating/jquery.barrating.min.js'); ?>"></script>
<script src="<?php echo url('rating/js/examples.js'); ?>"></script>
<script>
    function check_data()
    {
        $("#error").hide();
        var flag=1;
        var val='';
        
        $(".ratings").each(function(){
            val=$(this).val();
            if(val=='' || val=='0') flag=0;
        });
        
        if(flag==1) return true;
        
        $("#error").text('Please provide all ratings.');
        $("#error").show();
        return false;
    }
</script>