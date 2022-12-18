<?php include(app_path().'/common/header.php'); ?>
<style>
        @font-face {
  font-family: "futura";
  src: url(fonts/Futura.ttf);
}
        
        h3, h5, .home__more__reason .travel h6, .home__easy__use h6, .card-spl h6, .join-move, .home__header__main .navbar-nav.header-left-side .nav-item .nav-link{
            font-family:  'futura', sans-serif;
        }
        
        h5{
            font-size: 23px;
        }
        
        .home__header__main .navbar-nav.header-left-side .nav-item .nav-link{
            font-size: 17px;
        }
        /*.home__search__banner .inputWithIcon .form-field-img {
    top: 12px;
    width: 28px;
        }*/
        
        /*.home__search__banner .input-group.gj-datepicker-bootstrap .input-group-append button .gj-icon {
    top: 13px;
}*/
        
        /*.form-date-picker-wrapper .close-date-btn {
            top: 12px;
        }*/
        
        /*.landing-search-icon.btn.wrn-btn{
            padding-top: 10px;
        }*/
        
        .home__header__main .navbar-nav.header-left-side .nav-item{
            margin-right: 15px;
        }
        
        input[type="text"]{
            border-radius: 10px;
        }
        
        @media only screen and (min-width:1400px) {
            .home__banner__box .carousel-item {
            height: 550px;
            min-height: 550px;
        }
            
            /*.landing-search-icon.btn.wrn-btn{
            padding-top: 10px;
                padding-bottom: 10px;
        }*/
        }
        
        @media only screen and (max-width:1300px){
            .home__banner__box .carousel-item {
            height: 440px;
            min-height: 440px;
        }
        }
        
        @media only screen and (min-width:1200px) {
            
                div.card__ride div.list-group .media-body p.font-weight-bold{
                    padding-top:.5rem;
                }
            
            /*.landing-search-icon.btn.wrn-btn{
            padding-top: 9.7px;
                padding-bottom: 9.64px;
        }*/
        }
        
        @media only screen and (min-width:768px) {
        .wrn-btn.wrn-btn-r-radius {
    border-top-right-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
        }
        }
        
        @media (max-width: 1000px) {
            
            /*.landing-search-icon.btn.wrn-btn{
            padding-top: 9.8px;
                padding-bottom: 9.8px;
        }*/
        }
        
        @media (max-width: 990px) and (min-width: 762px) {
            .home__banner__box .carousel-item {
            height: 350px;
            min-height: 350px;
        }
            
            /*.landing-search-icon.btn.wrn-btn{
            padding-top: 9.6px;
                padding-bottom: 9.6px;
        }*/
        }
        
        @media (max-width: 991px) {
        
        @media all and (max-width: 768px) {
            .home__search__banner .form-control.form-control-left {
                border-right: 1px solid #aaa;
            }
            
            .home__search__banner .input-group.gj-datepicker-bootstrap .input-group-append button{
                border-left: 1px solid #aaa !important;
            }
            
      .home__search__banner .search__section__submit {
        flex-basis: 100%;
        max-width: 100%; } }
  .home__search__banner .search__section__toggle {
    flex-basis: 40px;
    max-width: 40px; }
    .home__search__banner .search__section__toggle .btn-toggle {
      background: #f0f0f0;
      border-radius: 0;
      font-size: 0.77em;
      width: 100%;
      border-top: 1px solid #aaa;
      border-bottom: 1px solid #aaa; }
    @media all and (max-width: 768px) {
      .home__search__banner .search__section__toggle {
        flex-basis: 100%;
        max-width: 100%; }
        .home__search__banner .search__section__toggle .btn-toggle {
          border-bottom: none !important;
          border-left-color: #aaa;
          border-right-color: #aaa; } }
  .home__search__banner .search__section__to, .home__search__banner .search__section__from, .home__search__banner .search__section__date {
    flex-basis: calc((100% - 90px)/3);
    max-width: calc((100% - 90px)/3); }
    @media all and (max-width: 768px) {
      .home__search__banner .search__section__to, .home__search__banner .search__section__from, .home__search__banner .search__section__date {
        flex-basis: 100%;
        max-width: 100%; } }
            
            @media all and (max-width: 459px) {
      .even__more__list li {
        flex-basis: 50%;
        max-width: 50%; } }
            
            span.text{
                font-weight: 500;
            }
    </style>
    
    <style>
        ul.luggage__list input[type="radio"]:checked + .selector-role {
    border-color: #00d262;
            color: #00d262;
}
        
        .border {
    border: 1px solid #ced4da !important;
}
        
        @media (min-width: 768px) {
            .location__row .location__direction {
                position: absolute;
                top: calc(50% - 10px);
                right: calc(50% - 0px);
            }
        }
        
        @media (max-width: 767px) {
            
            .ride__others .car__image img {
                display: inline-block;
            }
            
            .ride__others .car__restricted ul li .img-block img {
                width: 16px !important;
            }
            
            .ride__others .car__restricted ul {
                width: calc(100% + 4px);
                display: flex;
            }
            
            p {
                font-size: 13px !important;
            }
            
            .profile__content h6{
            }
            
            .profile__content p{
                line-height: 0.8rem !important;
            }
            
            
            /*.search__result__row .grid {
    padding: 15px 10px;
    display: flex;
    flex-wrap: wrap;
}
            
            .search__result .search__result__other {
    flex-basis: 55%;
    max-width: 55%;
}
            
            .search__result .search__result__places {
    flex-basis: calc(100% - 100px);
    max-width: calc(100% - 100px);
}
            
            .search__result .search__result__info {
    flex-basis: 100px;
    max-width: 100px;
    padding-right: 15px;
}*/
            
        }
            
            label{
                margin-bottom: 6px;
            }
            
            .price__time .ride__price {
                font-size: 19px;
            }
        
        .home__search__banner .search__section__toggle .btn-toggle{
            background: #ced4da;
        }
        
        .search__fields--lg .inputWithIcon .gj-datepicker-bootstrap button .gj-icon, .search__fields--lg .form-date-picker-wrapper .gj-datepicker-bootstrap button .gj-icon {
    top: calc(14px + 4.5px) !important;
        }
        
        .form-date-picker-wrapper .close-date-btn{
            top: calc(14px + 3px) !important;
        }
    </style>
<style>
    label.checkbox__element.checkbox__long__text {
    position: relative;
    padding-left: 23px;
            padding-top: 2.4px;
}
    
    .home__search__banner .inputWithIcon .form-field-img {
        left: 6px;
        top: 17px;
        }
    
    @media all and (max-width: 768px) {
            .home__search__banner .form-control.form-control-left {
                border-right: 1px solid #aaa;
            }
            
            .home__search__banner .input-group.gj-datepicker-bootstrap .input-group-append button{
                border-left: 1px solid #aaa !important;
            }
    }
    
    @media only screen and (max-width: 767px) {
        .search__fields--lg .btn-toggle.btn-toggle-single.btn-toggle-up-down {
            background: #CDEBFE !important;
            color: #2d4653;
            border: 3px solid #2d4653;
            border-bottom: 3px solid #2d4653 !important;
            border-color: #2d4653 !important;
            border-color:transparent !important;
            border:0px !important;
            background: none !important;
            outline: 0 !important;
        }
        
        .home__banner__box .search-sec{
            padding-top: 10px;
            height: 88%;
        }
        
        .search__fields--lg .btn-toggle.btn-toggle-single {
            top: 47px;
            right: 45px;
        }
    }
    
    .location__row .location__direction {
    position: absolute;
    top: calc(50% - 10px);
    right: calc(50% - 0px);
}
    
    .form-group-border:focus-within {
  color: #495057 !important;
  background-color: transparent !important;
  border-color: #aaa !important;
            border-radius: 5px;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
  outline: 0 !important;
  -webkit-box-shadow: 0 0 0 0rem rgba(0, 123, 255, 0.45) !important;
          box-shadow: 0 0 0 0rem rgba(0, 123, 255, 0.45) !important; }
    
    .form-control:focus{
  border-color: #aaa !important; }
</style>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<h3 class='f-700'><?php 
    if(!isset($_GET['dep_city']) OR $_GET['dep_city']=='' OR !isset($_GET['des_city']) OR $_GET['des_city']=='') 
    {
        if($pink_rides) echo '<img src="'.url('images/6-1-new-pink-rides-rose.png').'" style="max-width:40px; margin-bottom:2px;"> <font style="color:#e4278b;">'.trans('rides.search_pink_rides').'</font>';
        else if($extra_care_rides) echo '<img src="'.url('images/50-extra-care-rides.png').'" style="max-width:40px; margin-bottom:2px;"> <font style="color:#228ddb;">'.trans('rides.search_extra_care_rides').'</font>';
        else if($customize_rides) echo '<img src="'.url('images/51-build-your-own-ride-version-2.png').'" style="max-width:40px; margin-bottom:2px;"> <font style="">'.trans('rides.search_customize_ride').'</font>';
        else
        echo trans('rides.search_rides');
    }
    else 
    {
        if($pink_rides) echo '<img src="'.url('images/6-1-new-pink-rides-rose.png').'" style="max-width:40px; margin-bottom:2px;"> <font style="color:#e4278b;">'.trans('rides.pink_rides').' '.trans('rides.from').' '.$_GET['dep_city'].' '.trans('rides.to').' '.$_GET['des_city'].'</font>';
        else if($extra_care_rides) echo '<img src="'.url('images/50-extra-care-rides.png').'" style="max-width:40px; margin-bottom:2px;"> <font style="color:#228ddb;">'.trans('rides.extra_care_rides').' '.trans('rides.from').' '.$_GET['dep_city'].' '.trans('rides.to').' '.$_GET['des_city'].'</font>';
        else if($customize_rides) echo '<img src="'.url('images/51-build-your-own-ride-version-2.png').'" style="max-width:40px; margin-bottom:2px;"> <font style="">'.trans('rides.customize_rides').' '.trans('rides.from').' '.$_GET['dep_city'].' '.trans('rides.to').' '.$_GET['des_city'].'</font>';
        else
        echo ''.trans('rides.rides').' '.trans('rides.from').' '.$_GET['dep_city'].' '.trans('rides.to').' '.$_GET['des_city'];
    }
    ?></h3>
    <?php if($customize_rides AND !isset($_GET['dep_city'])) { ?>
    <p><?php echo trans('rides.build_own_rides'); ?></p>
    <?php } ?>
    <hr class="mt-0 mb-4">
</div>
</div>
<div class='row'>
<div class='col-12 col-md-12 col-lg-4 col-xl-3 text-center'>
<h6 class='form-title' data-target='#mobile-search-form-toggle' data-toggle='collapse' style="cursor:pointer;">
<img src="<?php echo url('images/18-2-search-filter.png'); ?>" style="max-width:30px;"> <?php echo trans('rides.search_filters'); ?>
</h6>
<!--<div class='float-right d-lg-none mobile-collapse-wrapper' style="outline:0; padding-top:0px; padding-bottom:0px;">
<button class='btn btn-default' data-target='#mobile-search-form-toggle' data-toggle='collapse' style="outline:0; margin:0px; padding-top:0px; padding-bottom:0px;">
<span class='fa fa-bars'></span>
</button>
</div>-->
</div>
<div class='col-12 col-md-12 col-lg-8 col-xl-9'></div>
</div>
    <form action="" method="get">
<div class='row justify-content-xl-between'>
<div class='col-12 col-md-12 col-lg-4 col-xl-3 col-xxl-3'>
<div class='row no-gutters'>
<div class='col-12'>
<!-- / Search filter -->
<div class='search__form__box bg-light p-3 collapse reset-collapse-from-lg' id='mobile-search-form-toggle'>
<!-- / Driver Section -->
<div class='form__section'>
<h6 class='form-section-title'><?php echo trans('rides.driver'); ?></h6>
<hr class="mt-0">
<div class='form-group'>
<label><?php echo trans('rides.driver_age'); ?></label>
<select class='form-control filter_field' name="driver_age" id="driver_age_dropdown">
<option value=''><?php echo trans('rides.all'); ?></option>
<option value='21 - 30' <?php if(isset($_GET['driver_age']) AND $_GET['driver_age']=='21 - 30') echo 'selected'; ?> ><?php echo trans('rides.20_above'); ?></option>
<option value='31 - 40' <?php if(isset($_GET['driver_age']) AND $_GET['driver_age']=='31 - 40') echo 'selected'; ?> ><?php echo trans('rides.30_above'); ?></option>
<option value='41 - 50' <?php if(isset($_GET['driver_age']) AND $_GET['driver_age']=='41 - 50') echo 'selected'; ?> ><?php echo trans('rides.40_above'); ?></option>
<option value='51 - 60' <?php if(isset($_GET['driver_age']) AND $_GET['driver_age']=='51 - 60') echo 'selected'; ?> ><?php echo trans('rides.50_above'); ?></option>
<option value='Above 60' <?php if(isset($_GET['driver_age']) AND $_GET['driver_age']=='Above 60') echo 'selected'; ?> ><?php echo trans('rides.60_above'); ?></option>
</select>
</div>
<div class='form-group'>
<label><?php echo trans('rides.driver_rating'); ?></label>
<select class='form-control filter_field' name="driver_rating" id="driver_rating_dropdown">
<option value=''><?php echo trans('rides.all'); ?></option>
<option value='5' <?php if(isset($_GET['driver_rating']) AND $_GET['driver_rating']=='5') echo 'selected'; ?> ><?php echo trans('rides.5_stars'); ?></option>
<option value='4' <?php if(isset($_GET['driver_rating']) AND $_GET['driver_rating']=='4') echo 'selected'; ?> ><?php echo trans('rides.4_stars_above'); ?></option>
<option value='3' <?php if(isset($_GET['driver_rating']) AND $_GET['driver_rating']=='3') echo 'selected'; ?> ><?php echo trans('rides.3_stars_above'); ?>4 stars and above</option>
<option value='2' <?php if(isset($_GET['driver_rating']) AND $_GET['driver_rating']=='2') echo 'selected'; ?> ><?php echo trans('rides.2_stars_above'); ?>4 stars and above</option>
<option value='1' <?php if(isset($_GET['driver_rating']) AND $_GET['driver_rating']=='1') echo 'selected'; ?> ><?php echo trans('rides.1_stars_above'); ?>4 stars and above</option>
</select>
</div>
<div class='form-group'>
<ul class='ul__list ul__list--horizontal mt-4'>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='access-driver-phone-yes'>
<div class='radio-element'>
<input id='access-driver-phone-yes' name='phone' type='checkbox' value='1' class="filter_field" <?php if(isset($_GET['phone']) AND $_GET['phone']=='1') echo 'checked'; ?> >
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.driver_phone_access'); ?>
</div>
</label>
</li>
</ul>
</div>
<div class='form-group'>
<label for='ride-driver'><?php echo trans('rides.driver_you_know'); ?></label>
<input class='form-control filter_field' id='ride-driver' placeholder='Enter name' name="driver_name" value="<?php if(isset($_GET['driver_name'])) echo $_GET['driver_name']; ?>">
</div>
</div>
<!-- / End Driver Section -->
<div class='form-section'>
<h5 class='f-section-title mt-4'><?php echo trans('rides.passengers'); ?></h5>
<hr class="mt-0">
<div class='form-group'>
<label><?php echo trans('rides.passengers_rating'); ?></label>
<select class='form-control filter_field' name="pass_rating" id="pass_rating_dropdown">
<option value=''><?php echo trans('rides.all'); ?></option>
<option value='5' <?php if(isset($_GET['pass_rating']) AND $_GET['pass_rating']=='5') echo 'selected'; ?> ><?php echo trans('rides.4_stars'); ?></option>
<option value='4' <?php if(isset($_GET['pass_rating']) AND $_GET['pass_rating']=='4') echo 'selected'; ?> ><?php echo trans('rides.4_stars_above'); ?></option>
<option value='3' <?php if(isset($_GET['pass_rating']) AND $_GET['pass_rating']=='3') echo 'selected'; ?> ><?php echo trans('rides.3_stars_above'); ?></option>
<option value='2' <?php if(isset($_GET['pass_rating']) AND $_GET['pass_rating']=='2') echo 'selected'; ?> ><?php echo trans('rides.2_stars_above'); ?></option>
<option value='1' <?php if(isset($_GET['pass_rating']) AND $_GET['pass_rating']=='1') echo 'selected'; ?> ><?php echo trans('rides.1_stars_above'); ?></option>
</select>
</div>
</div>
<div class='form-section'>
<h5 class='f-section-title mt-4'><?php echo trans('rides.payment_method'); ?></h5>
<hr class="mt-0">
<ul class='ul__list'>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='payment-method-all'>
<div class='radio-element'>
<input id='payment-method-all' name='payment' type='radio' value='' <?php if(!isset($_GET['payment']) OR $_GET['payment']=='') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.all'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='payment-method-cash'>
<div class='radio-element'>
<input id='payment-method-cash' name='payment' type='radio' value='Cash' <?php if(isset($_GET['payment']) AND $_GET['payment']=='Cash') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.cash'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='payment-method-transfer'>
<div class='radio-element'>
<input id='payment-method-transfer' name='payment' type='radio' value='Online payment' <?php if(isset($_GET['payment']) AND $_GET['payment']=='Online payment') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.online_payment'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='payment-method-guaranteed-cash'>
<div class='radio-element'>
<input id='payment-method-guaranteed-cash' name='payment' type='radio' value='Secured cash' <?php if(isset($_GET['payment']) AND $_GET['payment']=='Secured cash') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.secured_cash'); ?>
</div>
</label>
</li>
</ul>
</div>
<div class='form-section'>
<h5 class='form-section-title mt-4'><?php echo trans('rides.vehicle'); ?></h5>
<hr class="mt-0">
<div class='form-group'>
<label><?php echo trans('rides.vehicle_type'); ?></label>
<select class='form-control mb-4 filter_field' name="vehicle" id="vehicle_dropdown">
<option value=''><?php echo trans('rides.all'); ?></option>
    <option value="Convertible" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Convertible') echo 'selected'; ?> ><?php echo trans('rides.convertible'); ?></option>
    <option value="Coupe" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Coupe') echo 'selected'; ?> ><?php echo trans('rides.coupe'); ?></option>
    <option value="Hatchback" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Hatchback') echo 'selected'; ?> ><?php echo trans('rides.hatchback'); ?></option>
    <option value="Minivan" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Minivan') echo 'selected'; ?> ><?php echo trans('rides.minivan'); ?></option>
    <option value="Sedan" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Sedan') echo 'selected'; ?> ><?php echo trans('rides.sedan'); ?></option>
    <option value="Station Wagon" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Station Wagon') echo 'selected'; ?> ><?php echo trans('rides.station_wagon'); ?></option>
    <option value="SUV" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='SUV') echo 'selected'; ?> ><?php echo trans('rides.suv'); ?></option>
    <option value="Truck" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Truck') echo 'selected'; ?> ><?php echo trans('rides.truck'); ?></option>
    <option value="Van" <?php if(isset($_GET['vehicle']) AND $_GET['vehicle']=='Van') echo 'selected'; ?> ><?php echo trans('rides.van'); ?></option>
</select>
<!-- / Ride features -->
<ul class='ride__features__list ul__list'>
    <?php 
    $features=array();
    if(!empty($_GET['features'])) $features=$_GET['features'];
    ?>
<li style="color: #e11e86; font-weight: bold;">
<label class='checkbox__square checkbox__element checkbox__long__text' for='pink_ride'>
<input id='pink_ride' type='checkbox' value='Pink ride' name="features[]" <?php if(in_array('Pink ride', $features) OR $pink_rides=='1') echo 'checked'; ?> class="filter_field" <?php if($pink_rides=='1') echo 'disabled'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<span class='info-icon filter_field' data-toggle='tooltip' title='This is simple hover text'>
<i class='fa fa-info-circle'></i>
</span>
<?php echo trans('rides.pink_rides'); ?>
</span>
</label>
</li>
<li style="color: #077dd5; font-weight: bold;">
<label class='checkbox__square checkbox__element checkbox__long__text' for='extra-care-ride'>
<input id='extra-care-ride' type='checkbox' value='Extra-care ride' name="features[]" <?php if(in_array('Extra-care ride', $features) OR $extra_care_rides=='1') echo 'checked'; ?> class="filter_field" <?php if($extra_care_rides=='1') echo 'disabled'; ?> >
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.extra_care_rides'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='electric_car'>
<input id='electric_car' type='checkbox' value='Electric car' name="features[]" <?php if(in_array('Electric car', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.electric_car'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='wi-fi'>
<input id='wi-fi' type='checkbox' value='Wi-Fi' name="features[]" <?php if(in_array('Wi-Fi', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.wifi'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='5 star passengers'>
<input id='5 star passengers' type='checkbox' value='I want only 5 star passengers' name="features[]" <?php if(in_array('I want only 5 star passengers', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.only_5_star'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='i take infants'>
<input id='i take infants' type='checkbox' value='I take infants and I provide car baby seat(s)' name="features[]" <?php if(in_array('I take infants and I provide car baby seat(s)', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon filter_field' data-toggle='tooltip' title='Talk to the driver BEFORE the ride; as there is an extra charge for this'>
<i class='fa fa-info-circle'></i>
</span>
<?php echo trans('rides.have_enfants_provide_car'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='i-take-infants'>
<input id='i-take-infants' type='checkbox' value='I take infants if the passenger provides car baby seat(s)' name="features[]" <?php if(in_array('I take infants if the passenger provides car baby seat(s)', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon filter_field' data-toggle='tooltip' title='Talk to the driver BEFORE the ride; as there is an extra charge for this'>
<i class='fa fa-info-circle'></i>
</span>
<?php echo trans('rides.have_enfants_no_car'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='isdftakesdids'>
<input id='isdtakesdkids' type='checkbox' value='I take children and I provide car booster seat(s)' name="features[]" <?php if(in_array('I take children and I provide car booster seat(s)', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
    <span class='info-icon filter_field' data-toggle='tooltip' title='Talk to the driver BEFORE the ride; as there is an extra charge for this'>
<i class='fa fa-info-circle'></i>
</span>
<?php echo trans('rides.have_children_provide_car'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element checkbox__long__text' for='idtakedkids'>
<input id='idtakedkids' type='checkbox' value='I take children if the passenger providers car baby seat(s)' name="features[]" <?php if(in_array('I take children if the passenger providers car baby seat(s)', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<span class='info-icon filter_field' data-toggle='tooltip' title='Talk to the driver BEFORE the ride; as there is an extra charge for this'>
<i class='fa fa-info-circle'></i>
</span>
<?php echo trans('rides.have_children_no_car'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='bike rack'>
<input id='bike rack' type='checkbox' value='Bike rack' name="features[]" <?php if(in_array('Bike rack', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.bike_rack'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='ski rack'>
<input id='ski rack' type='checkbox' value='Ski rack' name="features[]" <?php if(in_array('Ski rack', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.ski_rack'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='winter tires'>
<input id='winter tires' type='checkbox' value='Winter tires' name="features[]" <?php if(in_array('Winter tires', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.winter_tires'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='air conditioning'>
<input id='air conditioning' type='checkbox' value='Air conditioning' name="features[]" <?php if(in_array('Air conditioning', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.air_conditioning'); ?>
</span>
</label>
</li>
<li>
<label class='checkbox__square checkbox__element' for='heating'>
<input id='heating' type='checkbox' value='Heating' name="features[]" <?php if(in_array('Heating', $features)) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='checkbox__element'>
<i class='fa fa-check'></i>
</span>
</span>
<span class='text show-info-top-right'>
<?php echo trans('rides.heating'); ?>
</span>
</label>
</li>
</ul>
<!-- / End Ride features -->
<!-- / Luggage -->
</div>
<div class='form-section'>
<div class='form-group'>
<label><?php echo trans('rides.luggage'); ?></label>
<select class='form-control filter_field' name="luggage" id="luggage_dropdown">
<option value=''><?php echo trans('rides.all'); ?></option>
<option value='S' <?php if(isset($_GET['luggage']) AND $_GET['luggage']=='S') echo 'selected'; ?> ><?php echo trans('rides.small'); ?></option>
<option value='M' <?php if(isset($_GET['luggage']) AND $_GET['luggage']=='M') echo 'selected'; ?> ><?php echo trans('rides.medium'); ?></option>
<option value='L' <?php if(isset($_GET['luggage']) AND $_GET['luggage']=='L') echo 'selected'; ?> ><?php echo trans('rides.large'); ?></option>
<option value='XL' <?php if(isset($_GET['luggage']) AND $_GET['luggage']=='XL') echo 'selected'; ?> ><?php echo trans('rides.xl'); ?></option>
<option value='No luggage' <?php if(isset($_GET['luggage']) AND $_GET['luggage']=='No luggage') echo 'selected'; ?> ><?php echo trans('rides.no_luggage'); ?></option>
</select>
</div>
</div>
<!-- / End Luggage -->
<!-- / Smoking -->
<div class='form-group mt-4'>
<label><?php echo trans('rides.smoking'); ?></label>
<ul class='ul__list ul__list--horizontal'>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-smoking-type-yes2'>
<div class='radio-element'>
<input id='ride-smoking-type-yes2' name='smoke' type='radio' value='' <?php if((isset($_GET['smoke']) AND $_GET['smoke']=='') OR !isset($_GET['smoke'])) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.indifferent'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-smoking-type-yes'>
<div class='radio-element'>
<input id='ride-smoking-type-yes' name='smoke' type='radio' value='Yes' <?php if(isset($_GET['smoke']) AND $_GET['smoke']=='Yes') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.yes'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-smoking-type-no'>
<div class='radio-element'>
<input id='ride-smoking-type-no' name='smoke' type='radio' value='No' <?php if(isset($_GET['smoke']) AND $_GET['smoke']=='No') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.no'); ?>
</div>
</label>
</li>
</ul>
</div>
<!-- / End Smoking -->
<!-- / Pet allowed -->
<div class='form-group'>
<label><?php echo trans('rides.pets_allowed'); ?></label>
<ul class='ul__list ul__list--horizontal'>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-pet-allowed-yes2'>
<div class='radio-element'>
<input id='ride-pet-allowed-yes2' name='pets' type='radio' value='' <?php if((isset($_GET['pets']) AND $_GET['pets']=='') OR !isset($_GET['pets'])) echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.indifferent'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-pet-allowed-yes'>
<div class='radio-element'>
<input id='ride-pet-allowed-yes' name='pets' type='radio' value='Yes' <?php if(isset($_GET['pets']) AND $_GET['pets']=='Yes') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.yes'); ?>
</div>
</label>
</li>
<li>
<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-pet-allowed-no'>
<div class='radio-element'>
<input id='ride-pet-allowed-no' name='pets' type='radio' value='No' <?php if(isset($_GET['pets']) AND $_GET['pets']=='No') echo 'checked'; ?> class="filter_field">
<span class='checkbox__all'>
<span class='select-element checkbox__element'>
<span class='toggle'></span>
</span>
</span>
</div>
<div class='radio-text'>
<?php echo trans('rides.no'); ?>
</div>
</label>
</li>
</ul>
</div>
<!-- / End Pet allowed -->
</div>
</div>
<!-- / End Search filter -->
</div>
</div>

</div>

<div class='img-thumbnail-wrapper google-map-wrapper' style="display:none;">
<div class='embed-responsive embed-responsive-4by3 mb-3'>
<div class='post-ride-google-map embed-responsive-item' id='ride-google-map'></div>
</div>
</div>
    
<div class='col-12 col-md-12 col-lg-8 col-xl-9 col-xxl-8'>
<div class='row'>
<div class='container-fluid'>
<div class='row'>
<div class='col-12'>
<div class='bg-light p-3 search__main__outer'>
<div class='home__search__banner'>
<div class='search__fields--lg search__section__from form-group-border'>
<div class='inputWithIcon'>
<div class='input-group input-group-double'>
<input class='form-control form-control-left' id='ride-departure' name='departure' autocomplete="off" autofill="no" placeholder='<?php echo trans('rides.from'); ?>' type='text' required value="<?php if(isset($_GET['departure'])) echo $_GET['departure']; ?>">
<img alt='' class='location form-field-img' src='<?php echo url('images/new-21-search-bar-from.png'); ?>'>
<input class='form-control' id='ride-departure-lat' type='hidden' name="dep_lat" value="<?php if(isset($_GET['dep_lat'])) echo $_GET['dep_lat']; ?>">
<input class='form-control' id='ride-departure-lng' type='hidden' name="dep_lng" value="<?php if(isset($_GET['dep_lng'])) echo $_GET['dep_lng']; ?>">
    
<input class='form-control' id='departure_place' type='hidden' name="dep_place" value="<?php if(isset($_GET['dep_place'])) echo $_GET['dep_place']; ?>">
<input class='form-control' id='departure_route' type='hidden' name="dep_route" value="<?php if(isset($_GET['dep_route'])) echo $_GET['dep_route']; ?>">
<input class='form-control' id='departure_zipcode' type='hidden' name="dep_zipcode" value="<?php if(isset($_GET['dep_zipcode'])) echo $_GET['dep_zipcode']; ?>">
<input class='form-control' id='departure_city' type='hidden' name="dep_city" value="<?php if(isset($_GET['dep_city'])) echo $_GET['dep_city']; ?>">
<input class='form-control' id='departure_state' type='hidden' name="dep_state" value="<?php if(isset($_GET['dep_state'])) echo $_GET['dep_state']; ?>">
<input class='form-control' id='departure_country' type='hidden' name="dep_country" value="<?php if(isset($_GET['dep_country'])) echo $_GET['dep_country']; ?>">
</div>
</div>
</div>
<div class='search__fields--lg search__section__toggle'>
<button class='btn btn-rl-icon btn-toggle btn-toggle-single btn-toggle-up-down' type="button" onclick="swap_locations()">
<img class="desktop" src="<?php echo url('images/8-1-circular-arrows.png'); ?>" style="max-width:33px; max-height:33px;">
    <img class="mobile" src="<?php echo url('images/7-two-arrows.png'); ?>" style="max-width:42px; max-height:42px;">
</button>
</div>
<div class='search__fields--lg search__section__to form-group-border'>
<div class='inputWithIcon form-bg-white'>
<input class='form-control form-control-middle' id='ride-destination' placeholder='<?php echo trans('rides.to'); ?>' name="destination" autocomplete="off" autofill="no" type='text' required value="<?php if(isset($_GET['destination'])) echo $_GET['destination']; ?>">
<img alt='' class='location form-field-img to' src='<?php echo url('images/new-21-search-bar-to.png'); ?>'>

<input class='form-control' id='ride-destination-lat' type='hidden' name="des_lat" value="<?php if(isset($_GET['des_lat'])) echo $_GET['des_lat']; ?>">
<input class='form-control' id='ride-destination-lng' type='hidden' name="des_lng" value="<?php if(isset($_GET['des_lng'])) echo $_GET['des_lng']; ?>">
    
<input class='form-control' id='destination_place' type='hidden' name="des_place" value="<?php if(isset($_GET['des_place'])) echo $_GET['des_place']; ?>">
<input class='form-control' id='destination_route' type='hidden' name="des_route" value="<?php if(isset($_GET['des_route'])) echo $_GET['des_route']; ?>">
<input class='form-control' id='destination_zipcode' type='hidden' name="des_zipcode" value="<?php if(isset($_GET['des_zipcode'])) echo $_GET['des_zipcode']; ?>">
<input class='form-control' id='destination_city' type='hidden' name="des_city" value="<?php if(isset($_GET['des_city'])) echo $_GET['des_city']; ?>">
<input class='form-control' id='destination_state' type='hidden' name="des_state" value="<?php if(isset($_GET['des_state'])) echo $_GET['des_state']; ?>">
<input class='form-control' id='destination_country' type='hidden' name="des_country" value="<?php if(isset($_GET['des_country'])) echo $_GET['des_country']; ?>">
    
    <input class='form-control' id='ride-distance' type='hidden' name="total_distance" value="<?php if(isset($_GET['total_distance'])) echo $_GET['total_distance']; ?>">
    <input class='form-control' id='ride-time' type='hidden' name="total_time" value="<?php if(isset($_GET['total_time'])) echo $_GET['total_time']; ?>">
    
</div>
</div>
<div class='search__fields--lg search__section__date form-group-border'>
<div class='form-bg-white form-date-picker-wrapper'>
<input class='form-control form-control-last form-date-picker-close' id='datepicker' autocomplete="off" autofill="no" placeholder='Date (optional)' style="padding-left: 0px; background-color: #fff !important; cursor: text !important;" name="date" value="<?php if(isset($_GET['date'])) echo $_GET['date']; ?>" readonly>
<a class='close-date-btn' href='javascript:void(0)' id='close-landing-search-date'>
<span class='fa fa-times'></span>
</a>
</div>
</div>
<div class='search__fields--lg search__section__submit'>
<button class='btn btn-primary wrn-btn wrn-btn-r-radius landing-search-icon' type='submit'>
<i aria-hidden='true' class='fa fa-search'></i>
</button>
</div>
</div>
<div class='search__result__info'>
    <?php if($total_more_rides!=0 AND $total_rides!=0) { ?>
<p class='mb-0'>Found <?php echo $total_rides; ?> rides <?php if($full_rides!=0) echo '('.$full_rides.' ride(s) already full)'; ?></p>
    <?php } ?>
</div>
</div>
</div>
</div>
</form>
    
    <!--show results start-->
    <?php $mark_flag=0;
    if(!empty($rides) AND $total_rides!=0) {
        foreach($rides as $ride) {
            if(!isset($ride['date'])) continue;
    ?>
<div class='row mt-4'>
<div class='col-12'>
<h6><?php echo date_format(new DateTime($ride['date']),'l F d, Y'); ?><div class='seat-icon float-right' style="font-weight: normal; font-size: 14px;">
    <?php if($mark_flag==0) { ?>
<img src="images/icons-png/booked.png" alt="Seat hover 1" style="max-width: 20px;"/> Booked Seat&nbsp;&nbsp;
<img src="images/icons-png/seat.png" alt="Seat hover 1" style="max-width: 20px;"/> Available Seat
    <?php $mark_flag=1; } ?>
</div> </h6><hr class="mt-0">
</div>
</div>
<div class='row'>
<div class='col-12'>
<div class='search__result__list'>
    <?php 
            if(!empty($ride['rides'])) {
                foreach($ride['rides'] as $ride_data) {
                    $from=$ride_data['ride']->departure_city;
                    $to=$ride_data['ride']->destination_city;
                    
                    if($ride_data['ride']->departure_state_short!='') $from.=', '.$ride_data['ride']->departure_state_short;
                    if($ride_data['ride']->destination_state_short!='') $to.=', '.$ride_data['ride']->destination_state_short;
                    
                    $place_from=$ride_data['ride']->departure_place;
                    $place_to=$ride_data['ride']->destination_place;
                    
                    if($place_from=='') $place_from=$ride_data['ride']->departure_state;
                    if($place_to=='') $place_to=$ride_data['ride']->destination_state;
                    
                    if($place_from=='') $place_from=$ride_data['ride']->departure_city;
                    if($place_to=='') $place_to=$ride_data['ride']->destination_city;
                    
                    if($from=='') $from=$ride_data['ride']->departure_place;
                    if($to=='') $to=$ride_data['ride']->destination_place;
                    
                    if($from=='') $from=$ride_data['ride']->departure_state;
                    if($to=='') $to=$ride_data['ride']->destination_state;

                    if($from=='') $from=$ride_data['ride']->departure;
                    if($to=='' OR $from==$to) $to=$ride_data['ride']->destination;
    ?>
<div class='search__result__item' onclick="window.location='<?php echo url('ride/'.$ride_data['ride']->url) ?>'" style="cursor:pointer;">
<div class='search__result'>
<div class='search__result__row'>
<div class='search__result__info grid'>
<div class='grid__item align-self-center'>
<div class='price__time text-center'>
<div class='shazam_logo'></div>
<div class='ride__price box mr-auto ml-auto pt-0 pb-0'>
<span class='currency'>$</span>
<span class='price'><?php echo number_format($ride_data['ride']->price,2); ?></span>
</div>
<div class='ride__time'>
<span class='time'><?php echo date_format(new DateTime($ride_data['ride']->time),'h:i'); ?></span>
<span class='time-suffix'><?php echo date_format(new DateTime($ride_data['ride']->time),'a'); ?></span>
</div>
    
    <div class="mt-2">
        <?php if($ride_data['ride']->payment_method=='Cash') { ?>
            <img src="images/icons-png/hand-cash.png" class="img-fluid" alt="Hand cash" style="max-width:25px;"/> <?php echo trans('rides.cash'); ?>
        <?php } else if($ride_data['ride']->payment_method=='Online payment') { ?>
            <img src="images/icons-png/money-transfer.png" class="img-fluid" alt="Hand cash" style="max-width:25px;"/> <br><?php echo trans('rides.online_payment'); ?>
        <?php } else if($ride_data['ride']->payment_method=='Secured cash') { ?>
            <img src="images/icons-png/money-guaranteed.png" class="img-fluid" alt="Hand cash" style="max-width:25px;"/> <br><?php echo trans('rides.secured_cash'); ?>
        <?php } ?>
    </div>
    
</div>
</div>
</div>
<div class='search__result__places grid'>
<div class='grid__item align-self-center'>
<div class='location__row'>
<div class='location__from location__grid'>
<h5 class='l-title mb-0'><?php echo $from; ?></h5>
<p class='l-address'><?php echo $ride_data['ride']->pickup; ?></p>
<p class='distance mb-0 d-none'>
1.5km from your address
</p>
</div>
<div class='location__direction'>
<span class='direction_icon'>
<span class='fa fa-chevron-right'></span>
</span>
</div>
<div class='location__to location__grid'>
<h5 class='l-title mb-0'><?php echo $to; ?></h5>
<p class='l-address'><?php echo $ride_data['ride']->dropoff; ?></p>
<p class='distance mb-0 d-none'>
4km from your address
</p>
</div>
</div>
    <div class='location__row pt-1'>
        <?php //echo $ride_data['ride']->details; ?>
    </div>
</div>
</div>
<div class='search__result__seats grid grid-md-2-row justify-content-center'>
<div class='grid__item align-self-center'>
<ul class='ul__list ul__list--horizontal seat__availability'>
    <?php if($ride_data['ride']->seats>=1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>=1) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>1) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>2) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>2) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>3) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>3) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>4) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>4) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>5) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>5) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>6) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>6) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
</ul>
<p class='text-center mb-0'>
<?php echo $ride_data['seats_left']; ?> seat(s) left
</p>
</div>
</div>
<div class='search__result__driver grid grid-md-2-row'>
<div class='grid__item align-self-center'>
<div class='ride__driver'>
<div class='image__image pt-2'>
    <?php 
    if($ride_data['driver']->gender=='Male')
    $img=url('images/male.png');
    else if($ride_data['driver']->gender=='Female')
    $img=url('images/female.png');
    else
    $img=url('images/neutral.png');
    if(!empty($ride_data['driver']->profile_image)) $img=url('images/profile_images/'.$ride_data['driver']->profile_image);
    else if(!empty($ride_data['driver']->avatar)) $img=$ride_data['driver']->avatar;
    ?>
<picture>
<source srcset='<?php echo $img; ?>'>
<img src="<?php echo $img; ?>" alt="User simple" class="img-fluid img-round d-round" style="object-fit:fill;"/>
</picture>
</div>
<div class='image__content'>
<div class='profile__content text-center text-lg-left pl-lg-2'>
<h6 class="mb-0"><?php echo $ride_data['driver']->first_name; ?></h6>
<p class="mb-1" style="line-height: 1rem;">
Age: <?php echo $ride_data['driver_age']; ?><br>
0 driven
</p>
<div class='profile__rating__wrapper svg-back-transparent text-center d-flex' style="font-weight: bold; font-size: 14px;">
<?php echo $ride_data['driver_rating']; ?>&nbsp;&nbsp; <img src="images/11-review-full-star.png" style="max-width: 22px; max-height: 18px;">
</div>
</div>
</div>
</div>
</div>
</div>
<div class='search__result__other grid grid-md-2-row mr-auto ml-auto'>
<div class='grid__item align-self-center'>
<div class='ride__others'>
<div class='car__image'>
    <?php 
    $car_image=url('images/car_placeholder2.png');
    if(isset($ride_data['ride']->car_image) AND $ride_data['ride']->car_image!='') $car_image=url('car_images/'.$ride_data['ride']->car_image);
    ?>
<img src="<?php echo $car_image; ?>" class="img-fluid img-round d-round" alt="Car single" style="margin-bottom:5px;"/>
</div>
<div class='car__restricted'>
<ul class='ul__list ul__list--horizontal restricted__item'>
    <?php if($ride_data['ride']->animal_friendly!='') { ?>
<li>
    <?php 
        if($ride_data['ride']->animal_friendly=='Yes') $position='287.6px 142.7px';
        else if($ride_data['ride']->animal_friendly=='No') $position='208.6px 142.7px';
        else $position='287.6px 142.7px';
                                                       
        $img=url('images/60-6-pet-friendly.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->smoke!='') { ?>
<li>
    <?php 
        if($ride_data['ride']->smoke=='Yes') $position='287.6px 142.7px';
        else if($ride_data['ride']->smoke=='No') $position='208.6px 142.7px';
        else $position='287.6px 142.7px';
                                                       
        $img=url('images/60-1-secondhand-smoke.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->luggage!='') { ?>
<li>
    <?php
        if($ride_data['ride']->luggage!='No luggage') $position='287.6px 142.7px';
        else $position='208.6px 142.7px';
                                                       
        $img=url('images/60-7-luggage.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
    <?php } ?>
    <?php 
        $features=array();
        if($ride_data['ride']->features!='') $features=explode(';', $ride_data['ride']->features);
                    
    ?>
<li>
    <?php 
        if(in_array('Air conditioning', $features)) $position='287.6px 142.7px';
        else $position='208.6px 142.7px';
                                                       
        $img=url('images/60-5-air-conditioning.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
<li>
    <?php 
        $position='95px 133px';
        
        if($ride_data['ride']->max_back_seats=='2')
        $img=url('images/90-1-two-passengers-only.png');
        else
        $img=url('images/90-2-three-passengers.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 19px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
    <?php } } ?>
</div>
</div>
</div>
    <?php } ?>

    
    <?php } else if(isset($_GET['dep_city'])) {
        if($total_more_rides==0) {
    ?>
    <h5 class="mt-2"><img src="<?php echo url('images/21-3-exclamation-mark.png'); ?>" style="width:30px; height:30px; margin-bottom:2px;"> Sorry, no rides found for your search.</h5>
    <?php } else { ?>
    <h5 class="mt-2 mb-5"><img src="<?php echo url('images/21-3-exclamation-mark.png'); ?>" style="width:30px; height:30px; margin-bottom:2px;"> Sorry, no rides found within this search filter. Here are other rides from <?php echo $_GET['dep_city']; ?> to <?php echo $_GET['des_city']; ?></h5>
    <?php } } ?>
    
    <?php 
    if($total_more_rides!=0 AND $total_rides!=0) {
        ?>
    <h5 class="mt-5 mb-4">More rides from <?php echo $_GET['dep_city']; ?> to <?php echo $_GET['des_city']; ?></h5>
    <?php }
        if(!empty($more_rides) AND $total_more_rides!=0) {
        foreach($more_rides as $ride) {
            if(!isset($ride['date'])) continue;
    ?>
<div class='row mt-4'>
<div class='col-12'>
<h6><?php echo date_format(new DateTime($ride['date']),'l F d, Y'); ?><div class='seat-icon float-right' style="font-weight: normal; font-size: 14px;">
<?php if($mark_flag==0) { ?>
<img src="images/icons-png/booked.png" alt="Seat hover 1" style="max-width: 20px;"/> Booked Seat&nbsp;&nbsp;
<img src="images/icons-png/seat.png" alt="Seat hover 1" style="max-width: 20px;"/> Available Seat
    <?php $mark_flag=1; } ?>
</div> </h6><hr class="mt-0">
</div>
</div>
<div class='row'>
<div class='col-12'>
<div class='search__result__list'>
    <?php 
            if(!empty($ride['rides'])) {
                foreach($ride['rides'] as $ride_data) {
                    $from=$ride_data['ride']->departure_city;
                    $to=$ride_data['ride']->destination_city;
                    
                    if($ride_data['ride']->departure_state_short!='') $from.=', '.$ride_data['ride']->departure_state_short;
                    if($ride_data['ride']->destination_state_short!='') $to.=', '.$ride_data['ride']->destination_state_short;
                    
                    $place_from=$ride_data['ride']->departure_place;
                    $place_to=$ride_data['ride']->destination_place;
                    
                    if($place_from=='') $place_from=$ride_data['ride']->departure_state;
                    if($place_to=='') $place_to=$ride_data['ride']->destination_state;
                    
                    if($place_from=='') $place_from=$ride_data['ride']->departure_city;
                    if($place_to=='') $place_to=$ride_data['ride']->destination_city;
                    
                    if($from=='') $from=$ride_data['ride']->departure_place;
                    if($to=='') $to=$ride_data['ride']->destination_place;
                    
                    if($from=='') $from=$ride_data['ride']->departure_state;
                    if($to=='') $to=$ride_data['ride']->destination_state;

                    if($from=='') $from=$ride_data['ride']->departure;
                    if($to=='' OR $from==$to) $to=$ride_data['ride']->destination;
    ?>
<div class='search__result__item' onclick="window.location='<?php echo url('ride/'.$ride_data['ride']->url) ?>'" style="cursor:pointer;">
<div class='search__result'>
<div class='search__result__row'>
<div class='search__result__info grid'>
<div class='grid__item align-self-center'>
<div class='price__time text-center'>
<div class='shazam_logo'></div>
<div class='ride__price box mr-auto ml-auto pt-0 pb-0'>
<span class='currency'>$</span>
<span class='price'><?php echo number_format($ride_data['ride']->price,2); ?></span>
</div>
<div class='ride__time'>
<span class='time'><?php echo date_format(new DateTime($ride_data['ride']->time),'h:i'); ?></span>
<span class='time-suffix'><?php echo date_format(new DateTime($ride_data['ride']->time),'a'); ?></span>
</div>
    
    <div class="mt-2">
        <?php if($ride_data['ride']->payment_method=='Cash') { ?>
            <img src="images/icons-png/hand-cash.png" class="img-fluid" alt="Hand cash" style="max-width:25px;"/> <?php echo trans('rides.cash'); ?>
        <?php } else if($ride_data['ride']->payment_method=='Online payment') { ?>
            <img src="images/icons-png/money-transfer.png" class="img-fluid" alt="Hand cash" style="max-width:25px;"/> <br><?php echo trans('rides.online_payment'); ?>
        <?php } else if($ride_data['ride']->payment_method=='Secured cash') { ?>
            <img src="images/icons-png/money-guaranteed.png" class="img-fluid" alt="Hand cash" style="max-width:25px;"/> <br><?php echo trans('rides.secured_cash'); ?>
        <?php } ?>
    </div>
    
</div>
</div>
</div>
<div class='search__result__places grid'>
<div class='grid__item align-self-center'>
<div class='location__row'>
<div class='location__from location__grid'>
<h5 class='l-title mb-0'><?php echo $from; ?></h5>
<p class='l-address'><?php echo $ride_data['ride']->pickup; ?></p>
<p class='distance mb-0 d-none'>
1.5km from your address
</p>
</div>
<div class='location__direction'>
<span class='direction_icon'>
<span class='fa fa-chevron-right'></span>
</span>
</div>
<div class='location__to location__grid'>
<h5 class='l-title mb-0'><?php echo $to; ?></h5>
<p class='l-address'><?php echo $ride_data['ride']->dropoff; ?></p>
<p class='distance mb-0 d-none'>
4km from your address
</p>
</div>
</div>
    <div class='location__row pt-1'>
        <?php //echo $ride_data['ride']->details; ?>
    </div>
</div>
</div>
<div class='search__result__seats grid grid-md-2-row justify-content-center'>
<div class='grid__item align-self-center'>
<ul class='ul__list ul__list--horizontal seat__availability'>
    <?php if($ride_data['ride']->seats>=1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>=1) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>1) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>1) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>2) { ?>
<li class='filled-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>2) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat hover 1" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>3) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>3) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>4) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>4) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>5) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>5) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->seats>6) { ?>
<li class='empty-seats seat__list'>
<div class='seat-icon'>
    <?php 
                    if($ride_data['seats_booked']>6) $seat=url('images/icons-png/booked.png');
                    else $seat=url('images/icons-png/seat.png');
    ?>
<img src="<?php echo $seat; ?>" alt="Seat" />
</div>
</li>
    <?php } ?>
</ul>
<p class='text-center mb-0'>
<?php echo $ride_data['seats_left']; ?> seat(s) left
</p>
</div>
</div>
<div class='search__result__driver grid grid-md-2-row'>
<div class='grid__item align-self-center'>
<div class='ride__driver'>
<div class='image__image pt-2'>
    <?php 
    if($ride_data['driver']->gender=='Male')
    $img=url('images/male.png');
    else if($ride_data['driver']->gender=='Female')
    $img=url('images/female.png');
    else
    $img=url('images/neutral.png');
    if(!empty($ride_data['driver']->profile_image)) $img=url('images/profile_images/'.$ride_data['driver']->profile_image);
    else if(!empty($ride_data['driver']->avatar)) $img=$ride_data['driver']->avatar;
    ?>
<picture>
<source srcset='<?php echo $img; ?>'>
<img src="<?php echo $img; ?>" alt="User simple" style="border-radius:50%;"/>
</picture>
</div>
<div class='image__content'>
<div class='profile__content text-center text-lg-left pl-lg-2'>
<h6 class="mb-0"><?php echo $ride_data['driver']->first_name; ?></h6>
<p class="mb-1" style="line-height: 1rem;">
Age: <?php echo $ride_data['driver_age']; ?><br>
0 driven
</p>
<div class='profile__rating__wrapper svg-back-transparent text-center d-flex' style="font-weight: bold; font-size: 14px;">
<?php echo $ride_data['driver_rating']; ?>&nbsp;&nbsp; <img src="images/11-review-full-star.png" style="max-width: 22px; max-height: 18px;">
</div>
</div>
</div>
</div>
</div>
</div>
<div class='search__result__other grid grid-md-2-row mr-auto ml-auto'>
<div class='grid__item align-self-center'>
<div class='ride__others'>
<div class='car__image'>
    <?php 
    $car_image=url('images/car_placeholder2.png');
    if(isset($ride_data['ride']->car_image) AND $ride_data['ride']->car_image!='') $car_image=url('car_images/'.$ride_data['ride']->car_image);
    ?>
<img src="<?php echo $car_image; ?>" class="img-fluid img-round d-round" alt="Car single" style="margin-bottom:5px;"/>
</div>
<div class='car__restricted'>
<ul class='ul__list ul__list--horizontal restricted__item'>
    <?php if($ride_data['ride']->animal_friendly!='') { ?>
<li>
    <?php 
        if($ride_data['ride']->animal_friendly=='Yes') $position='287.6px 142.7px';
        else if($ride_data['ride']->animal_friendly=='No') $position='208.6px 142.7px';
        else $position='287.6px 142.7px';
                                                       
        $img=url('images/60-6-pet-friendly.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->smoke!='') { ?>
<li>
    <?php 
        if($ride_data['ride']->smoke=='Yes') $position='287.6px 142.7px';
        else if($ride_data['ride']->smoke=='No') $position='208.6px 142.7px';
        else $position='287.6px 142.7px';
                                                       
        $img=url('images/60-1-secondhand-smoke.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
    <?php } ?>
    <?php if($ride_data['ride']->luggage!='') { ?>
<li>
    <?php
        if($ride_data['ride']->luggage!='No luggage') $position='287.6px 142.7px';
        else $position='208.6px 142.7px';
                                                       
        $img=url('images/60-7-luggage.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
    <?php } ?>
    <?php 
        $features=array();
        if($ride_data['ride']->features!='') $features=explode(';', $ride_data['ride']->features);
                    
    ?>
<li>
    <?php 
        if(in_array('Air conditioning', $features)) $position='287.6px 142.7px';
        else $position='208.6px 142.7px';
                                                       
        $img=url('images/60-5-air-conditioning.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 53px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
<li>
    <?php 
        $position='95px 133px';
        
        if($ride_data['ride']->max_back_seats=='2')
        $img=url('images/90-1-two-passengers-only.png');
        else
        $img=url('images/90-2-three-passengers.png');
    ?>
<div class='img-block' style="background: url('<?php echo $img; ?>');
  background-position: <?php echo $position; ?>;
  height: 19px;
  width: 19px; background-size: 19px; border-radius:50%;">
<!--<img src="<?php echo $img; ?>" alt="No pet" style=""/>-->
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
    <?php } } ?>
</div>
</div>
</div>
    <?php } ?>
    <?php } ?>
    
    <?php if($total_more_rides!=0 AND $total_rides!=0) { ?>
<div class='row'>
<div class='col-12'>
    <div class='search__p__wrapper mt-5'>
<nav aria-label='Page navigation example' class='pagination__wrapper search__pagination__wrapper'>
<ul class='justify-content-center pagination search__pagination'>
<li class='page-item disabled'>
<a class='page-link' href='javascript:void(0)'>Back</a>
</li>
<li class='page-item'>
<a class='page-link' href='javascript:void(0)'>1</a>
</li>
<li class='page-item disabled'>
<a class='page-link' href='javascript:void(0)'>Next</a>
</li>
</ul>
</nav>

</div>
    
</div>
</div>
   <?php } ?> 
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/common.js'); ?>" type="text/javascript"></script>
<script src="<?php echo url('javascripts/post-ride-form.js'); ?>"></script>
<script>
  console.log("This will load first")
  function initialGoogleMap(){
  
    window.initGoogleMap();
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUB1MKo9R24yt2uYi4_LLw9hyZp-fKDwE&amp;libraries=places&amp;callback=initialGoogleMap" async="true" defer="defer"></script>
<script>
    $('.filter_field').change(function() {
    $(this).closest('form').submit();
});
    
    $(document).ready(function(){
        var driver_age='';
        <?php if(isset($_GET['driver_age'])) { ?>
        driver_age='<?php echo $_GET['driver_age'] ?>';
        <?php } ?>
        
        $("#driver_age_dropdown").val(driver_age);
        
        var driver_rating='';
        <?php if(isset($_GET['driver_rating'])) { ?>
        driver_rating='<?php echo $_GET['driver_rating'] ?>';
        <?php } ?>
        
        $("#driver_rating_dropdown").val(driver_rating);
        
        var pass_rating='';
        <?php if(isset($_GET['pass_rating'])) { ?>
        pass_rating='<?php echo $_GET['pass_rating'] ?>';
        <?php } ?>
        
        $("#pass_rating_dropdown").val(pass_rating);
        
        var luggage='';
        <?php if(isset($_GET['luggage'])) { ?>
        luggage='<?php echo $_GET['luggage'] ?>';
        <?php } ?>
        
        $("#luggage_dropdown").val(luggage);
        
        var vehicle_type='';
        <?php if(isset($_GET['vehicle'])) { ?>
        vehicle_type='<?php echo $_GET['vehicle'] ?>';
        <?php } ?>
        
        $("#vehicle_dropdown").val(vehicle_type);
    });
</script>