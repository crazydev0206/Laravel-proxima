<?php include(app_path().'/common/header.php'); ?>
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
<!--<div class='page__content__header'>
<h5 class="main-heading">Personal information</h5><hr class="mt-0 mb-4">
</div>-->
<div class='page__content__body'>
<div class='row'>
<div class='col-12 col-md-4 col-lg-3'>
    <?php include(app_path().'/common/left_profile.php'); ?>
</div>
<div class='col-12 col-md-8 col-lg-9'>
<!--<ul class='nav nav-tabs mb-3' id='profile-form-tab' role='tablist'>
<li class='nav-item'>
<a aria-controls='profile' aria-selected='true' class="nav-link <?php if(!isset($_GET['t']) OR $_GET['t']=='profile') echo 'active'; ?>" data-toggle='tab' href='#profile' id='home-tab' role='tab' onclick="$('.alert2').hide();">Profile</a>
</li>
    <?php if($user->type=='Driver') { ?>
<li class='nav-item'>
<a aria-controls='vehicle' aria-selected='true' class="nav-link <?php if(isset($_GET['t']) AND $_GET['t']=='vehicle') echo 'active'; ?>" data-toggle='tab' href='#vehicle' id='home-tab' role='tab' onclick="$('.alert2').hide();">Vehicle</a>
</li>
    <?php } ?>
<li class='nav-item'>
<a aria-controls='payments' aria-selected='false' class="nav-link <?php if(isset($_GET['t']) AND $_GET['t']=='payments') echo 'active'; ?>" data-toggle='tab' href='#payments' id='profile-tab' role='tab' onclick="$('.alert2').hide();">Payment</a>
</li>
<li class='nav-item'>
<a aria-controls='preferences' aria-selected='false' class="nav-link <?php if(isset($_GET['t']) AND $_GET['t']=='preferences') echo 'active'; ?>" data-toggle='tab' href='#preferences' id='preferences-tab' role='tab' onclick="$('.alert2').hide();">Preferences</a>
</li>
<li class='nav-item'>
<a aria-controls='security' aria-selected='false' class="nav-link <?php if(isset($_GET['t']) AND $_GET['t']=='security') echo 'active'; ?>" data-toggle='tab' href='#security' id='contact-tab' role='tab' onclick="$('.alert2').hide();">Security</a>
</li>
</ul>-->
<div class='tab-content' id='profile-form-content'>
    
<div aria-labelledby='profile-tab' class="tab-pane fade <?php if(!isset($_GET['t']) OR $_GET['t']=='profile') echo 'show active'; ?>" id='profile' role='tabpanel'>
    <form class='rider__sign parsley__form__validate' data-parsley-validate='' action="" method="post">
        <?php echo csrf_field(); ?>
<!-- / Personal Information -->
        <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->
        <div style="overflow:hidden;">
        <h5 class="main-heading pull-left"><?php echo trans('profile.home_address'); ?></h5>
        <p class="pull-right mb-0"><font style="color:red;">*</font> <?php echo trans('profile.indicates_required_fields'); ?></p>
        </div>
        <hr class="mt-0 mb-1">
        <p><?php echo trans('profile.to_be_eligible'); ?></p>
        
        <?php if(Session::has('success')) { ?>
    <p class="alert2 alert alert-success"><?php echo Session::get('success'); ?></p>
    <?php } ?>
    <?php if(Session::has('error')) { ?>
    <p class="alert2 alert alert-danger"><?php echo Session::get('error'); ?></p>
    <?php } ?>
        
<div class='row mt-4'>
<div class='col-12 col-md-12'>
<div class='form-group'>
<label for='profile-about-me'><?php echo trans('forms.country'); ?> <font style="color:red;">*</font></label>
    <?php $u_row['country']=$user->country; ?>
<select class='form-control form-group-border' id='country' name="country" required onchange="show_states(this.value)" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required.">
    <option value="">Please select</option>
    <option value="Canada" <?php if(!empty($u_row['country']) AND $u_row['country']=='Canada') echo 'selected'; ?> >Canada</option>
    <option value="United States" <?php if(!empty($u_row['country']) AND $u_row['country']=='United States') echo 'selected'; ?> >United States</option>
    <option value="Afganistan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Afghanistan') echo 'selected'; ?> >Afghanistan</option>
   <option value="Albania" <?php if(!empty($u_row['country']) AND $u_row['country']=='Albania') echo 'selected'; ?> >Albania</option>
   <option value="Algeria" <?php if(!empty($u_row['country']) AND $u_row['country']=='Algeria') echo 'selected'; ?> >Algeria</option>
   <option value="American Samoa" <?php if(!empty($u_row['country']) AND $u_row['country']=='American Samoa') echo 'selected'; ?> >American Samoa</option>
   <option value="Andorra" <?php if(!empty($u_row['country']) AND $u_row['country']=='Andorra') echo 'selected'; ?> >Andorra</option>
   <option value="Angola" <?php if(!empty($u_row['country']) AND $u_row['country']=='Angola') echo 'selected'; ?> >Angola</option>
   <option value="Anguilla" <?php if(!empty($u_row['country']) AND $u_row['country']=='Anguilla') echo 'selected'; ?> >Anguilla</option>
   <option value="Antigua & Barbuda" <?php if(!empty($u_row['country']) AND $u_row['country']=='Antigua & Barbuda') echo 'selected'; ?> >Antigua & Barbuda</option>
   <option value="Argentina" <?php if(!empty($u_row['country']) AND $u_row['country']=='Argentina') echo 'selected'; ?> >Argentina</option>
   <option value="Armenia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Armenia') echo 'selected'; ?> >Armenia</option>
   <option value="Aruba" <?php if(!empty($u_row['country']) AND $u_row['country']=='Aruba') echo 'selected'; ?> >Aruba</option>
   <option value="Australia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Australia') echo 'selected'; ?> >Australia</option>
   <option value="Austria" <?php if(!empty($u_row['country']) AND $u_row['country']=='Austria') echo 'selected'; ?> >Austria</option>
   <option value="Azerbaijan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Azerbaijan') echo 'selected'; ?> >Azerbaijan</option>
   <option value="Bahamas" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bahamas') echo 'selected'; ?> >Bahamas</option>
   <option value="Bahrain" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bahrain') echo 'selected'; ?> >Bahrain</option>
   <option value="Bangladesh" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bangladesh') echo 'selected'; ?> >Bangladesh</option>
   <option value="Barbados" <?php if(!empty($u_row['country']) AND $u_row['country']=='Barbados') echo 'selected'; ?> >Barbados</option>
   <option value="Belarus" <?php if(!empty($u_row['country']) AND $u_row['country']=='Belarus') echo 'selected'; ?> >Belarus</option>
   <option value="Belgium" <?php if(!empty($u_row['country']) AND $u_row['country']=='Belgium') echo 'selected'; ?> >Belgium</option>
   <option value="Belize" <?php if(!empty($u_row['country']) AND $u_row['country']=='Belize') echo 'selected'; ?> >Belize</option>
   <option value="Benin" <?php if(!empty($u_row['country']) AND $u_row['country']=='Benin') echo 'selected'; ?> >Benin</option>
   <option value="Bermuda" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bermuda') echo 'selected'; ?> >Bermuda</option>
   <option value="Bhutan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bhutan') echo 'selected'; ?> >Bhutan</option>
   <option value="Bolivia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bolivia') echo 'selected'; ?> >Bolivia</option>
   <option value="Bonaire" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bonaire') echo 'selected'; ?> >Bonaire</option>
   <option value="Bosnia & Herzegovina" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bosnia & Herzegovina') echo 'selected'; ?> >Bosnia & Herzegovina</option>
   <option value="Botswana" <?php if(!empty($u_row['country']) AND $u_row['country']=='Botswana') echo 'selected'; ?> >Botswana</option>
   <option value="Brazil" <?php if(!empty($u_row['country']) AND $u_row['country']=='Brazil') echo 'selected'; ?> >Brazil</option>
   <option value="British Indian Ocean Ter" <?php if(!empty($u_row['country']) AND $u_row['country']=='British Indian Ocean Ter') echo 'selected'; ?> >British Indian Ocean Ter</option>
   <option value="Brunei" <?php if(!empty($u_row['country']) AND $u_row['country']=='Brunei') echo 'selected'; ?> >Brunei</option>
   <option value="Bulgaria" <?php if(!empty($u_row['country']) AND $u_row['country']=='Bulgaria') echo 'selected'; ?> >Bulgaria</option>
   <option value="Burkina Faso" <?php if(!empty($u_row['country']) AND $u_row['country']=='Burkina Faso') echo 'selected'; ?> >Burkina Faso</option>
   <option value="Burundi" <?php if(!empty($u_row['country']) AND $u_row['country']=='Burkina Faso') echo 'selected'; ?> >Burundi</option>
   <option value="Cambodia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cambodia') echo 'selected'; ?> >Cambodia</option>
   <option value="Cameroon" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cameroon') echo 'selected'; ?> >Cameroon</option>
   <option value="Canada" <?php if(!empty($u_row['country']) AND $u_row['country']=='Canada') echo 'selected'; ?> >Canada</option>
   <option value="Canary Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Canary Islands') echo 'selected'; ?> >Canary Islands</option>
   <option value="Cape Verde" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cape Verde') echo 'selected'; ?> >Cape Verde</option>
   <option value="Cayman Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cayman Islands') echo 'selected'; ?> >Cayman Islands</option>
   <option value="Central African Republic" <?php if(!empty($u_row['country']) AND $u_row['country']=='Central African Republic') echo 'selected'; ?> >Central African Republic</option>
   <option value="Chad" <?php if(!empty($u_row['country']) AND $u_row['country']=='Chad') echo 'selected'; ?> >Chad</option>
   <option value="Channel Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Channel Islands') echo 'selected'; ?> >Channel Islands</option>
   <option value="Chile" <?php if(!empty($u_row['country']) AND $u_row['country']=='Chile') echo 'selected'; ?> >Chile</option>
   <option value="China" <?php if(!empty($u_row['country']) AND $u_row['country']=='China') echo 'selected'; ?> >China</option>
   <option value="Christmas Island" <?php if(!empty($u_row['country']) AND $u_row['country']=='Christmas Island') echo 'selected'; ?> >Christmas Island</option>
   <option value="Cocos Island" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cocos Island') echo 'selected'; ?> >Cocos Island</option>
   <option value="Colombia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Colombia') echo 'selected'; ?> >Colombia</option>
   <option value="Comoros" <?php if(!empty($u_row['country']) AND $u_row['country']=='Comoros') echo 'selected'; ?> >Comoros</option>
   <option value="Congo" <?php if(!empty($u_row['country']) AND $u_row['country']=='Congo') echo 'selected'; ?> >Congo</option>
   <option value="Cook Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cook Islands') echo 'selected'; ?> >Cook Islands</option>
   <option value="Costa Rica" <?php if(!empty($u_row['country']) AND $u_row['country']=='Costa Rica') echo 'selected'; ?> >Costa Rica</option>
   <option value="Cote DIvoire" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cote DIvoire') echo 'selected'; ?> >Cote DIvoire</option>
   <option value="Croatia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Croatia') echo 'selected'; ?> >Croatia</option>
   <option value="Cuba" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cuba') echo 'selected'; ?> >Cuba</option>
   <option value="Curaco" <?php if(!empty($u_row['country']) AND $u_row['country']=='Curaco') echo 'selected'; ?> >Curacao</option>
   <option value="Cyprus" <?php if(!empty($u_row['country']) AND $u_row['country']=='Cyprus') echo 'selected'; ?> >Cyprus</option>
   <option value="Czech Republic" <?php if(!empty($u_row['country']) AND $u_row['country']=='Czech Republic') echo 'selected'; ?> >Czech Republic</option>
   <option value="Denmark" <?php if(!empty($u_row['country']) AND $u_row['country']=='Denmark') echo 'selected'; ?> >Denmark</option>
   <option value="Djibouti" <?php if(!empty($u_row['country']) AND $u_row['country']=='Djibouti') echo 'selected'; ?> >Djibouti</option>
   <option value="Dominica" <?php if(!empty($u_row['country']) AND $u_row['country']=='Dominica') echo 'selected'; ?> >Dominica</option>
   <option value="Dominican Republic" <?php if(!empty($u_row['country']) AND $u_row['country']=='Dominican Republic') echo 'selected'; ?> >Dominican Republic</option>
   <option value="East Timor" <?php if(!empty($u_row['country']) AND $u_row['country']=='East Timor') echo 'selected'; ?> >East Timor</option>
   <option value="Ecuador" <?php if(!empty($u_row['country']) AND $u_row['country']=='Ecuador') echo 'selected'; ?> >Ecuador</option>
   <option value="Egypt" <?php if(!empty($u_row['country']) AND $u_row['country']=='Egypt') echo 'selected'; ?> >Egypt</option>
   <option value="El Salvador" <?php if(!empty($u_row['country']) AND $u_row['country']=='El Salvador') echo 'selected'; ?> >El Salvador</option>
   <option value="Equatorial Guinea" <?php if(!empty($u_row['country']) AND $u_row['country']=='Equatorial Guinea') echo 'selected'; ?> >Equatorial Guinea</option>
   <option value="Eritrea" <?php if(!empty($u_row['country']) AND $u_row['country']=='Eritrea') echo 'selected'; ?> >Eritrea</option>
   <option value="Estonia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Estonia') echo 'selected'; ?> >Estonia</option>
   <option value="Ethiopia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Ethiopia') echo 'selected'; ?> >Ethiopia</option>
   <option value="Falkland Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Falkland Islands') echo 'selected'; ?> >Falkland Islands</option>
   <option value="Faroe Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Faroe Islands') echo 'selected'; ?> >Faroe Islands</option>
   <option value="Fiji" <?php if(!empty($u_row['country']) AND $u_row['country']=='Fiji') echo 'selected'; ?> >Fiji</option>
   <option value="Finland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Finland') echo 'selected'; ?> >Finland</option>
   <option value="France" <?php if(!empty($u_row['country']) AND $u_row['country']=='France') echo 'selected'; ?> >France</option>
   <option value="French Guiana" <?php if(!empty($u_row['country']) AND $u_row['country']=='French Guiana') echo 'selected'; ?> >French Guiana</option>
   <option value="French Polynesia" <?php if(!empty($u_row['country']) AND $u_row['country']=='French Polynesia') echo 'selected'; ?> >French Polynesia</option>
   <option value="French Southern Ter" <?php if(!empty($u_row['country']) AND $u_row['country']=='French Southern Ter') echo 'selected'; ?> >French Southern Ter</option>
   <option value="Gabon" <?php if(!empty($u_row['country']) AND $u_row['country']=='Gabon') echo 'selected'; ?> >Gabon</option>
   <option value="Gambia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Gambia') echo 'selected'; ?> >Gambia</option>
   <option value="Georgia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Georgia') echo 'selected'; ?> >Georgia</option>
   <option value="Germany" <?php if(!empty($u_row['country']) AND $u_row['country']=='Germany') echo 'selected'; ?> >Germany</option>
   <option value="Ghana" <?php if(!empty($u_row['country']) AND $u_row['country']=='Ghana') echo 'selected'; ?> >Ghana</option>
   <option value="Gibraltar" <?php if(!empty($u_row['country']) AND $u_row['country']=='Gibraltar') echo 'selected'; ?> >Gibraltar</option>
   <option value="Great Britain" <?php if(!empty($u_row['country']) AND $u_row['country']=='Great Britain') echo 'selected'; ?> >Great Britain</option>
   <option value="Greece" <?php if(!empty($u_row['country']) AND $u_row['country']=='Greece') echo 'selected'; ?> >Greece</option>
   <option value="Greenland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Greenland') echo 'selected'; ?> >Greenland</option>
   <option value="Grenada" <?php if(!empty($u_row['country']) AND $u_row['country']=='Grenada') echo 'selected'; ?> >Grenada</option>
   <option value="Guadeloupe" <?php if(!empty($u_row['country']) AND $u_row['country']=='Guadeloupe') echo 'selected'; ?> >Guadeloupe</option>
   <option value="Guam" <?php if(!empty($u_row['country']) AND $u_row['country']=='Guam') echo 'selected'; ?> >Guam</option>
   <option value="Guatemala" <?php if(!empty($u_row['country']) AND $u_row['country']=='Guatemala') echo 'selected'; ?> >Guatemala</option>
   <option value="Guinea" <?php if(!empty($u_row['country']) AND $u_row['country']=='Guinea') echo 'selected'; ?> >Guinea</option>
   <option value="Guyana" <?php if(!empty($u_row['country']) AND $u_row['country']=='Guyana') echo 'selected'; ?> >Guyana</option>
   <option value="Haiti" <?php if(!empty($u_row['country']) AND $u_row['country']=='Haiti') echo 'selected'; ?> >Haiti</option>
   <option value="Hawaii" <?php if(!empty($u_row['country']) AND $u_row['country']=='Hawaii') echo 'selected'; ?> >Hawaii</option>
   <option value="Honduras" <?php if(!empty($u_row['country']) AND $u_row['country']=='Honduras') echo 'selected'; ?> >Honduras</option>
   <option value="Hong Kong" <?php if(!empty($u_row['country']) AND $u_row['country']=='Hong Kong') echo 'selected'; ?> >Hong Kong</option>
   <option value="Hungary" <?php if(!empty($u_row['country']) AND $u_row['country']=='Hungary') echo 'selected'; ?> >Hungary</option>
   <option value="Iceland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Iceland') echo 'selected'; ?> >Iceland</option>
   <option value="Indonesia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Indonesia') echo 'selected'; ?> >Indonesia</option>
   <option value="India" <?php if(!empty($u_row['country']) AND $u_row['country']=='India') echo 'selected'; ?> >India</option>
   <option value="Iran" <?php if(!empty($u_row['country']) AND $u_row['country']=='Iran') echo 'selected'; ?> >Iran</option>
   <option value="Iraq" <?php if(!empty($u_row['country']) AND $u_row['country']=='Iraq') echo 'selected'; ?> >Iraq</option>
   <option value="Ireland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Ireland') echo 'selected'; ?> >Ireland</option>
   <option value="Isle of Man" <?php if(!empty($u_row['country']) AND $u_row['country']=='Isle of Man') echo 'selected'; ?> >Isle of Man</option>
   <option value="Israel" <?php if(!empty($u_row['country']) AND $u_row['country']=='Israel') echo 'selected'; ?> >Israel</option>
   <option value="Italy" <?php if(!empty($u_row['country']) AND $u_row['country']=='Italy') echo 'selected'; ?> >Italy</option>
   <option value="Jamaica" <?php if(!empty($u_row['country']) AND $u_row['country']=='Jamaica') echo 'selected'; ?> >Jamaica</option>
   <option value="Japan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Japan') echo 'selected'; ?> >Japan</option>
   <option value="Jordan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Jordan') echo 'selected'; ?> >Jordan</option>
   <option value="Kazakhstan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Kazakhstan') echo 'selected'; ?> >Kazakhstan</option>
   <option value="Kenya" <?php if(!empty($u_row['country']) AND $u_row['country']=='Kenya') echo 'selected'; ?> >Kenya</option>
   <option value="Kiribati" <?php if(!empty($u_row['country']) AND $u_row['country']=='Kiribati') echo 'selected'; ?> >Kiribati</option>
   <option value="Korea North" <?php if(!empty($u_row['country']) AND $u_row['country']=='Korea North') echo 'selected'; ?> >Korea North</option>
   <option value="Korea Sout" <?php if(!empty($u_row['country']) AND $u_row['country']=='Korea Sout') echo 'selected'; ?> >Korea South</option>
   <option value="Kuwait" <?php if(!empty($u_row['country']) AND $u_row['country']=='Kuwait') echo 'selected'; ?> >Kuwait</option>
   <option value="Kyrgyzstan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Kyrgyzstan') echo 'selected'; ?> >Kyrgyzstan</option>
   <option value="Laos" <?php if(!empty($u_row['country']) AND $u_row['country']=='Laos') echo 'selected'; ?> >Laos</option>
   <option value="Latvia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Latvia') echo 'selected'; ?> >Latvia</option>
   <option value="Lebanon" <?php if(!empty($u_row['country']) AND $u_row['country']=='Lebanon') echo 'selected'; ?> >Lebanon</option>
   <option value="Lesotho" <?php if(!empty($u_row['country']) AND $u_row['country']=='Lesotho') echo 'selected'; ?> >Lesotho</option>
   <option value="Liberia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Liberia') echo 'selected'; ?> >Liberia</option>
   <option value="Libya" <?php if(!empty($u_row['country']) AND $u_row['country']=='Libya') echo 'selected'; ?> >Libya</option>
   <option value="Liechtenstein" <?php if(!empty($u_row['country']) AND $u_row['country']=='Liechtenstein') echo 'selected'; ?> >Liechtenstein</option>
   <option value="Lithuania" <?php if(!empty($u_row['country']) AND $u_row['country']=='Lithuania') echo 'selected'; ?> >Lithuania</option>
   <option value="Luxembourg" <?php if(!empty($u_row['country']) AND $u_row['country']=='Luxembourg') echo 'selected'; ?> >Luxembourg</option>
   <option value="Macau" <?php if(!empty($u_row['country']) AND $u_row['country']=='Macau') echo 'selected'; ?> >Macau</option>
   <option value="Macedonia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Macedonia') echo 'selected'; ?> >Macedonia</option>
   <option value="Madagascar" <?php if(!empty($u_row['country']) AND $u_row['country']=='Madagascar') echo 'selected'; ?> >Madagascar</option>
   <option value="Malaysia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Malaysia') echo 'selected'; ?> >Malaysia</option>
   <option value="Malawi" <?php if(!empty($u_row['country']) AND $u_row['country']=='Malawi') echo 'selected'; ?> >Malawi</option>
   <option value="Maldives" <?php if(!empty($u_row['country']) AND $u_row['country']=='Maldives') echo 'selected'; ?> >Maldives</option>
   <option value="Mali" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mali') echo 'selected'; ?> >Mali</option>
   <option value="Malta" <?php if(!empty($u_row['country']) AND $u_row['country']=='Malta') echo 'selected'; ?> >Malta</option>
   <option value="Marshall Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Marshall Islands') echo 'selected'; ?> >Marshall Islands</option>
   <option value="Martinique" <?php if(!empty($u_row['country']) AND $u_row['country']=='Martinique') echo 'selected'; ?> >Martinique</option>
   <option value="Mauritania" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mauritania') echo 'selected'; ?> >Mauritania</option>
   <option value="Mauritius" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mauritius') echo 'selected'; ?> >Mauritius</option>
   <option value="Mayotte" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mayotte') echo 'selected'; ?> >Mayotte</option>
   <option value="Mexico" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mexico') echo 'selected'; ?> >Mexico</option>
   <option value="Midway Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Midway Islands') echo 'selected'; ?> >Midway Islands</option>
   <option value="Moldova" <?php if(!empty($u_row['country']) AND $u_row['country']=='Moldova') echo 'selected'; ?> >Moldova</option>
   <option value="Monaco" <?php if(!empty($u_row['country']) AND $u_row['country']=='Monaco') echo 'selected'; ?> >Monaco</option>
   <option value="Mongolia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mongolia') echo 'selected'; ?> >Mongolia</option>
   <option value="Montserrat" <?php if(!empty($u_row['country']) AND $u_row['country']=='Montserrat') echo 'selected'; ?> >Montserrat</option>
   <option value="Morocco" <?php if(!empty($u_row['country']) AND $u_row['country']=='Morocco') echo 'selected'; ?> >Morocco</option>
   <option value="Mozambique" <?php if(!empty($u_row['country']) AND $u_row['country']=='Mozambique') echo 'selected'; ?> >Mozambique</option>
   <option value="Myanmar" <?php if(!empty($u_row['country']) AND $u_row['country']=='Myanmar') echo 'selected'; ?> >Myanmar</option>
   <option value="Nambia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Nambia') echo 'selected'; ?> >Nambia</option>
   <option value="Nauru" <?php if(!empty($u_row['country']) AND $u_row['country']=='Nauru') echo 'selected'; ?> >Nauru</option>
   <option value="Nepal" <?php if(!empty($u_row['country']) AND $u_row['country']=='Nepal') echo 'selected'; ?> >Nepal</option>
   <option value="Netherland Antilles" <?php if(!empty($u_row['country']) AND $u_row['country']=='Netherland Antilles') echo 'selected'; ?> >Netherland Antilles</option>
   <option value="Netherlands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Netherlands') echo 'selected'; ?> >Netherlands (Holland, Europe)</option>
   <option value="Nevis" <?php if(!empty($u_row['country']) AND $u_row['country']=='Nevis') echo 'selected'; ?> >Nevis</option>
   <option value="New Caledonia" <?php if(!empty($u_row['country']) AND $u_row['country']=='New Caledonia') echo 'selected'; ?> >New Caledonia</option>
   <option value="New Zealand" <?php if(!empty($u_row['country']) AND $u_row['country']=='New Zealand') echo 'selected'; ?> >New Zealand</option>
   <option value="Nicaragua" <?php if(!empty($u_row['country']) AND $u_row['country']=='Nicaragua"') echo 'selected'; ?> >Nicaragua</option>
   <option value="Niger" <?php if(!empty($u_row['country']) AND $u_row['country']=='Niger') echo 'selected'; ?> >Niger</option>
   <option value="Nigeria" <?php if(!empty($u_row['country']) AND $u_row['country']=='Nigeria') echo 'selected'; ?> >Nigeria</option>
   <option value="Niue" <?php if(!empty($u_row['country']) AND $u_row['country']=='Niue') echo 'selected'; ?> >Niue</option>
   <option value="Norfolk Island" <?php if(!empty($u_row['country']) AND $u_row['country']=='Norfolk Island') echo 'selected'; ?> >Norfolk Island</option>
   <option value="Norway" <?php if(!empty($u_row['country']) AND $u_row['country']=='Norway') echo 'selected'; ?> >Norway</option>
   <option value="Oman" <?php if(!empty($u_row['country']) AND $u_row['country']=='Oman') echo 'selected'; ?> >Oman</option>
   <option value="Pakistan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Pakistan') echo 'selected'; ?> >Pakistan</option>
   <option value="Palau Island" <?php if(!empty($u_row['country']) AND $u_row['country']=='Palau Island') echo 'selected'; ?> >Palau Island</option>
   <option value="Palestine" <?php if(!empty($u_row['country']) AND $u_row['country']=='Palestine') echo 'selected'; ?> >Palestine</option>
   <option value="Panama" <?php if(!empty($u_row['country']) AND $u_row['country']=='Panama') echo 'selected'; ?> >Panama</option>
   <option value="Papua New Guinea" <?php if(!empty($u_row['country']) AND $u_row['country']=='Papua New Guinea') echo 'selected'; ?> >Papua New Guinea</option>
   <option value="Paraguay" <?php if(!empty($u_row['country']) AND $u_row['country']=='Paraguay') echo 'selected'; ?> >Paraguay</option>
   <option value="Peru" <?php if(!empty($u_row['country']) AND $u_row['country']=='Peru') echo 'selected'; ?> >Peru</option>
   <option value="Phillipines" <?php if(!empty($u_row['country']) AND $u_row['country']=='Phillipines') echo 'selected'; ?> >Philippines</option>
   <option value="Pitcairn Island" <?php if(!empty($u_row['country']) AND $u_row['country']=='Pitcairn Island') echo 'selected'; ?> >Pitcairn Island</option>
   <option value="Poland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Poland') echo 'selected'; ?> >Poland</option>
   <option value="Portugal" <?php if(!empty($u_row['country']) AND $u_row['country']=='Portugal') echo 'selected'; ?> >Portugal</option>
   <option value="Puerto Rico" <?php if(!empty($u_row['country']) AND $u_row['country']=='Puerto Rico') echo 'selected'; ?> >Puerto Rico</option>
   <option value="Qatar" <?php if(!empty($u_row['country']) AND $u_row['country']=='Qatar') echo 'selected'; ?> >Qatar</option>
   <option value="Republic of Montenegro" <?php if(!empty($u_row['country']) AND $u_row['country']=='Republic of Montenegro') echo 'selected'; ?> >Republic of Montenegro</option>
   <option value="Republic of Serbia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Republic of Serbia') echo 'selected'; ?> >Republic of Serbia</option>
   <option value="Reunion" <?php if(!empty($u_row['country']) AND $u_row['country']=='Reunion') echo 'selected'; ?> >Reunion</option>
   <option value="Romania" <?php if(!empty($u_row['country']) AND $u_row['country']=='Romania') echo 'selected'; ?> >Romania</option>
   <option value="Russia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Russia') echo 'selected'; ?> >Russia</option>
   <option value="Rwanda" <?php if(!empty($u_row['country']) AND $u_row['country']=='Rwanda') echo 'selected'; ?> >Rwanda</option>
   <option value="St Barthelemy" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Barthelemy') echo 'selected'; ?> >St Barthelemy</option>
   <option value="St Eustatius" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Eustatius') echo 'selected'; ?> >St Eustatius</option>
   <option value="St Helena" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Helena') echo 'selected'; ?> >St Helena</option>
   <option value="St Kitts-Nevis" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Kitts-Nevis') echo 'selected'; ?> >St Kitts-Nevis</option>
   <option value="St Lucia" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Lucia') echo 'selected'; ?> >St Lucia</option>
   <option value="St Maarten" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Maarten') echo 'selected'; ?> >St Maarten</option>
   <option value="St Pierre & Miquelon" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Pierre & Miquelon') echo 'selected'; ?> >St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines" <?php if(!empty($u_row['country']) AND $u_row['country']=='St Vincent & Grenadines') echo 'selected'; ?> >St Vincent & Grenadines</option>
   <option value="Saipan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Saipan') echo 'selected'; ?> >Saipan</option>
   <option value="Samoa" <?php if(!empty($u_row['country']) AND $u_row['country']=='Samoa') echo 'selected'; ?> >Samoa</option>
   <option value="Samoa American" <?php if(!empty($u_row['country']) AND $u_row['country']=='Samoa American') echo 'selected'; ?> >Samoa American</option>
   <option value="San Marino" <?php if(!empty($u_row['country']) AND $u_row['country']=='San Marino') echo 'selected'; ?> >San Marino</option>
   <option value="Sao Tome & Principe" <?php if(!empty($u_row['country']) AND $u_row['country']=='Sao Tome & Principe') echo 'selected'; ?> >Sao Tome & Principe</option>
   <option value="Saudi Arabia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Saudi Arabia') echo 'selected'; ?> >Saudi Arabia</option>
   <option value="Senegal" <?php if(!empty($u_row['country']) AND $u_row['country']=='Senegal') echo 'selected'; ?> >Senegal</option>
   <option value="Seychelles" <?php if(!empty($u_row['country']) AND $u_row['country']=='Seychelles') echo 'selected'; ?> >Seychelles</option>
   <option value="Sierra Leone" <?php if(!empty($u_row['country']) AND $u_row['country']=='Sierra Leone') echo 'selected'; ?> >Sierra Leone</option>
   <option value="Singapore" <?php if(!empty($u_row['country']) AND $u_row['country']=='Singapore') echo 'selected'; ?> >Singapore</option>
   <option value="Slovakia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Slovakia') echo 'selected'; ?> >Slovakia</option>
   <option value="Slovenia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Slovenia') echo 'selected'; ?> >Slovenia</option>
   <option value="Solomon Islands" <?php if(!empty($u_row['country']) AND $u_row['country']=='Solomon Islands') echo 'selected'; ?> >Solomon Islands</option>
   <option value="Somalia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Somalia') echo 'selected'; ?> >Somalia</option>
   <option value="South Africa" <?php if(!empty($u_row['country']) AND $u_row['country']=='South Africa') echo 'selected'; ?> >South Africa</option>
   <option value="Spain" <?php if(!empty($u_row['country']) AND $u_row['country']=='Spain') echo 'selected'; ?> >Spain</option>
   <option value="Sri Lanka" <?php if(!empty($u_row['country']) AND $u_row['country']=='Sri Lanka') echo 'selected'; ?> >Sri Lanka</option>
   <option value="Sudan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Sudan') echo 'selected'; ?> >Sudan</option>
   <option value="Suriname" <?php if(!empty($u_row['country']) AND $u_row['country']=='Suriname') echo 'selected'; ?> >Suriname</option>
   <option value="Swaziland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Swaziland') echo 'selected'; ?> >Swaziland</option>
   <option value="Sweden" <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?> >Sweden</option>
   <option value="Switzerland" <?php if(!empty($u_row['country']) AND $u_row['country']=='Switzerland"') echo 'selected'; ?> >Switzerland</option>
   <option value="Syria" <?php if(!empty($u_row['country']) AND $u_row['country']=='Syria') echo 'selected'; ?> >Syria</option>
   <option value="Tahiti" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tahiti') echo 'selected'; ?> >Tahiti</option>
   <option value="Taiwan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Taiwan') echo 'selected'; ?> >Taiwan</option>
   <option value="Tajikistan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tajikistan') echo 'selected'; ?> >Tajikistan</option>
   <option value="Tanzania" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tanzania') echo 'selected'; ?> >Tanzania</option>
   <option value="Thailand" <?php if(!empty($u_row['country']) AND $u_row['country']=='Thailand') echo 'selected'; ?> >Thailand</option>
   <option value="Togo" <?php if(!empty($u_row['country']) AND $u_row['country']=='Togo') echo 'selected'; ?> >Togo</option>
   <option value="Tokelau" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tokelau') echo 'selected'; ?> >Tokelau</option>
   <option value="Tonga" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tonga') echo 'selected'; ?> >Tonga</option>
   <option value="Trinidad & Tobago" <?php if(!empty($u_row['country']) AND $u_row['country']=='Trinidad & Tobago') echo 'selected'; ?> >Trinidad & Tobago</option>
   <option value="Tunisia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tunisia') echo 'selected'; ?> >Tunisia</option>
   <option value="Turkey" <?php if(!empty($u_row['country']) AND $u_row['country']=='Turkey') echo 'selected'; ?> >Turkey</option>
   <option value="Turkmenistan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Turkmenistan') echo 'selected'; ?> >Turkmenistan</option>
   <option value="Turks & Caicos Is" <?php if(!empty($u_row['country']) AND $u_row['country']=='Turks & Caicos Is') echo 'selected'; ?> >Turks & Caicos Is</option>
   <option value="Tuvalu" <?php if(!empty($u_row['country']) AND $u_row['country']=='Tuvalu') echo 'selected'; ?> >Tuvalu</option>
   <option value="Uganda" <?php if(!empty($u_row['country']) AND $u_row['country']=='Uganda') echo 'selected'; ?> >Uganda</option>
   <option value="United Kingdom" <?php if(!empty($u_row['country']) AND $u_row['country']=='United Kingdom') echo 'selected'; ?> >United Kingdom</option>
   <option value="Ukraine" <?php if(!empty($u_row['country']) AND $u_row['country']=='Ukraine') echo 'selected'; ?> >Ukraine</option>
   <option value="United Arab Erimates" <?php if(!empty($u_row['country']) AND $u_row['country']=='United Arab Erimates') echo 'selected'; ?> >United Arab Emirates</option>
   <option value="United States of America" <?php if(!empty($u_row['country']) AND $u_row['country']=='United States of America') echo 'selected'; ?> >United States of America</option>
   <option value="Uraguay" <?php if(!empty($u_row['country']) AND $u_row['country']=='Uraguay') echo 'selected'; ?> >Uruguay</option>
   <option value="Uzbekistan" <?php if(!empty($u_row['country']) AND $u_row['country']=='Uzbekistan') echo 'selected'; ?> >Uzbekistan</option>
   <option value="Vanuatu" <?php if(!empty($u_row['country']) AND $u_row['country']=='Vanuatu') echo 'selected'; ?> >Vanuatu</option>
   <option value="Vatican City State" <?php if(!empty($u_row['country']) AND $u_row['country']=='Vatican City State') echo 'selected'; ?> >Vatican City State</option>
   <option value="Venezuela" <?php if(!empty($u_row['country']) AND $u_row['country']=='Venezuela') echo 'selected'; ?> >Venezuela</option>
   <option value="Vietnam" <?php if(!empty($u_row['country']) AND $u_row['country']=='Vietnam') echo 'selected'; ?> >Vietnam</option>
   <option value="Virgin Islands (Brit)" <?php if(!empty($u_row['country']) AND $u_row['country']=='Virgin Islands (Brit)') echo 'selected'; ?> >Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)" <?php if(!empty($u_row['country']) AND $u_row['country']=='Virgin Islands (USA)') echo 'selected'; ?> >Virgin Islands (USA)</option>
   <option value="Wake Island" <?php if(!empty($u_row['country']) AND $u_row['country']=='Wake Island') echo 'selected'; ?> >Wake Island</option>
   <option value="Wallis & Futana Is" <?php if(!empty($u_row['country']) AND $u_row['country']=='Wallis & Futana Is') echo 'selected'; ?> >Wallis & Futana Is</option>
   <option value="Yemen" <?php if(!empty($u_row['country']) AND $u_row['country']=='Yemen') echo 'selected'; ?> >Yemen</option>
   <option value="Zaire" <?php if(!empty($u_row['country']) AND $u_row['country']=='Zaire') echo 'selected'; ?> >Zaire</option>
   <option value="Zambia" <?php if(!empty($u_row['country']) AND $u_row['country']=='Zambia') echo 'selected'; ?> >Zambia</option>
   <option value="Zimbabwe" <?php if(!empty($u_row['country']) AND $u_row['country']=='Zimbabwe') echo 'selected'; ?> >Zimbabwe</option>
</select>
</div>
</div>
<div class='col-12 col-md-12'>
<div class='form-group'>
<label for='profile-address'><?php echo trans('forms.street_no'); ?> <font style="color:red;">*</font></label>
<input class='form-control form-group-border' id='profile-address' placeholder='' type='text' name="address" value="<?php echo $user->home_address; if(empty($user->home_address)) echo $user->address; ?>" required>
</div>
</div>
<div class='col-12 col-md-12'>
<div class='form-group'>
<label for='profile-about-me'><?php echo trans('forms.city'); ?> <font style="color:red;">*</font></label>
<input class='form-control form-group-border' id='city' name="city" required placeholder='' type='text' value="<?php echo $user->home_city; if(empty($user->home_city)) echo $user->city; ?>" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required.">
</div>
</div>
<div class='col-12 col-md-12'>
<div class='form-group'>
<label for='profile-about-me'><span id="state_title"><?php if($user->home_country=='Canada' OR (empty($user->home_country) AND $user->country=='Canada')) echo trans('forms.province'); else if($user->home_country=='United States' OR (empty($user->home_country) AND $user->country=='United States')) echo trans('forms.state'); else echo trans('forms.province_state'); ?></span> <font style="color:red;">*</font></label>
    <span id="state_box">
        <?php
        $state=$user->home_state;
        if(empty($state)) $state=$user->state;
        ?>
        <?php if($user->home_country=='Canada' OR (empty($user->home_country) AND $user->country=='Canada')) { ?>
        <select class="form-control form-group-border" name="state" data-parsley-trigger="blur focusout change" required data-parsley-required-message="This field is required.">
            <option value=""></option>
            <option value="Alberta" <?php if($state=='Alberta') echo 'selected'; ?> >Alberta</option>
            <option value="British Columbia" <?php if($state=='British Columbia') echo 'selected'; ?> >British Columbia</option>
            <option value="Manitoba" <?php if($state=='Manitoba') echo 'selected'; ?> >Manitoba</option>
            <option value="New-Brunswick" <?php if($state=='New-Brunswick') echo 'selected'; ?> >New-Brunswick</option>
            <option value="Newfoundland and Labrador" <?php if($state=='Newfoundland and Labrador') echo 'selected'; ?> >Newfoundland and Labrador</option>
            <option value="Nova Scotia" <?php if($state=='Nova Scotia') echo 'selected'; ?> >Nova Scotia</option>
            <option value="Northwest Territories" <?php if($state=='Northwest Territories') echo 'selected'; ?> >Northwest Territories</option>
            <option value="Nunavut" <?php if($state=='Nunavut') echo 'selected'; ?> >Nunavut</option>
            <option value="Ontario" <?php if($state=='Ontario') echo 'selected'; ?> >Ontario</option>
            <option value="Quebec" <?php if($state=='Quebec') echo 'selected'; ?> >Quebec</option>
            <option value="Prince Edward Island" <?php if($state=='Prince Edward Island') echo 'selected'; ?> >Prince Edward Island</option>
            <option value="Saskatchewan" <?php if($state=='Saskatchewan') echo 'selected'; ?> >Saskatchewan</option>
            <option value="Yukon" <?php if($state=='Yukon') echo 'selected'; ?> >Yukon</option>
        </select>
        <?php } else if($user->home_country=='United States' OR (empty($user->home_country) AND $user->country=='United States')) { ?>
        <select class="form-control form-group-border" name="state" data-parsley-trigger="blur focusout change" required data-parsley-required-message="This field is required.">
            <option value=""></option>
            <option value="Alabama" <?php if($state=='Alabama') echo 'selected'; ?> >Alabama</option>
            <option value="Alaska" <?php if($state=='Alaska') echo 'selected'; ?> >Alaska</option>
            <option value="Arizona" <?php if($state=='Arizona') echo 'selected'; ?> >Arizona</option>
            <option value="Arkansas" <?php if($state=='Arkansas') echo 'selected'; ?> >Arkansas</option>
            <option value="California" <?php if($state=='California') echo 'selected'; ?> >California</option>
            <option value="Colorado" <?php if($state=='Colorado') echo 'selected'; ?> >Colorado</option>
            <option value="Connecticut" <?php if($state=='Connecticut') echo 'selected'; ?> >Connecticut</option>
            <option value="Delaware" <?php if($state=='Delaware') echo 'selected'; ?> >Delaware</option>
            <option value="District of Columbia" <?php if($state=='District of Columbia') echo 'selected'; ?> >District of Columbia</option>
            <option value="Florida" <?php if($state=='Florida') echo 'selected'; ?> >Florida</option>
            <option value="Georgia" <?php if($state=='Georgia') echo 'selected'; ?> >Georgia</option>
            <option value="Hawaii" <?php if($state=='Hawaii') echo 'selected'; ?> >Hawaii</option>
            <option value="Idaho" <?php if($state=='Idaho') echo 'selected'; ?> >Idaho</option>
            <option value="Illinois" <?php if($state=='Illinois') echo 'selected'; ?> >Illinois</option>
            <option value="Indiana" <?php if($state=='Indiana') echo 'selected'; ?> >Indiana</option>
            <option value="Iowa" <?php if($state=='Iowa') echo 'selected'; ?> >Iowa</option>
            <option value="Kansas" <?php if($state=='Kansas') echo 'selected'; ?> >Kansas</option>
            <option value="Kentucky" <?php if($state=='Kentucky') echo 'selected'; ?> >Kentucky</option>
            <option value="Louisiana" <?php if($state=='Louisiana') echo 'selected'; ?> >Louisiana</option>
            <option value="Maine" <?php if($state=='Maine') echo 'selected'; ?> >Maine</option>
            <option value="Maryland" <?php if($state=='Maryland') echo 'selected'; ?> >Maryland</option>
            <option value="Massachusetts" <?php if($state=='Massachusetts') echo 'selected'; ?> >Massachusetts</option>
            <option value="Michigan" <?php if($state=='Michigan') echo 'selected'; ?> >Michigan</option>
            <option value="Minnesota" <?php if($state=='Minnesota') echo 'selected'; ?> >Minnesota</option>
            <option value="Mississippi" <?php if($state=='Mississippi') echo 'selected'; ?> >Mississippi</option>
            <option value="Missouri" <?php if($state=='Missouri') echo 'selected'; ?> >Missouri</option>
            <option value="Montana" <?php if($state=='Montana') echo 'selected'; ?> >Montana</option>
            <option value="Nebraska" <?php if($state=='Nebraska') echo 'selected'; ?> >Nebraska</option>
            <option value="Nevada" <?php if($state=='Nevada') echo 'selected'; ?> >Nevada</option>
            <option value="New Hampshire" <?php if($state=='New Hampshire') echo 'selected'; ?> >New Hampshire</option>
            <option value="New Jersey" <?php if($state=='New Jersey') echo 'selected'; ?> >New Jersey</option>
            <option value="New Mexico" <?php if($state=='New Mexico') echo 'selected'; ?> >New Mexico</option>
            <option value="New York" <?php if($state=='New York') echo 'selected'; ?> >New York</option>
            <option value="North Carolina" <?php if($state=='North Carolina') echo 'selected'; ?> >North Carolina</option>
            <option value="North Dakota" <?php if($state=='North Dakota') echo 'selected'; ?> >North Dakota</option>
            <option value="Ohio" <?php if($state=='Ohio') echo 'selected'; ?> >Ohio</option>
            <option value="Oklahoma" <?php if($state=='Oklahoma') echo 'selected'; ?> >Oklahoma</option>
            <option value="Oregon" <?php if($state=='Oregon') echo 'selected'; ?> >Oregon</option>
            <option value="Pennsylvania" <?php if($state=='Pennsylvania') echo 'selected'; ?> >Pennsylvania</option>
            <option value="Rhode Island" <?php if($state=='Rhode Island') echo 'selected'; ?> >Rhode Island</option>
            <option value="South Carolina" <?php if($state=='South Carolina') echo 'selected'; ?> >South Carolina</option>
            <option value="South Dakota" <?php if($state=='South Dakota') echo 'selected'; ?> >South Dakota</option>
            <option value="Tennessee" <?php if($state=='Tennessee') echo 'selected'; ?> >Tennessee</option>
            <option value="Texas" <?php if($state=='Texas') echo 'selected'; ?> >Texas</option>
            <option value="Utah" <?php if($state=='Utah') echo 'selected'; ?> >Utah</option>
            <option value="Vermont" <?php if($state=='Vermont') echo 'selected'; ?> >Vermont</option>
            <option value="Virginia" <?php if($state=='Virginia') echo 'selected'; ?> >Virginia</option>
            <option value="Washington" <?php if($state=='Washington') echo 'selected'; ?> >Washington</option>
            <option value="West Virginia" <?php if($state=='West Virginia') echo 'selected'; ?> >West Virginia</option>
            <option value="Wisconsin" <?php if($state=='Wisconsin') echo 'selected'; ?> >Wisconsin</option>
            <option value="Wyoming" <?php if($state=='Wyoming') echo 'selected'; ?> >Wyoming</option>
        </select>
        <?php } else { ?>
        <input class='form-control form-group-border' id='state' name="state" required placeholder='' type='text' value="<?php echo $state; ?>" list="states" autocomplete="no" autofill="no" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required.">
        <?php } ?>
    </span>
    <datalist id="states" name="states">
    </datalist>
</div>
</div>
<div class='col-12 col-md-12'>
<div class='form-group'>
<label for='profile-about-me'><?php echo trans('forms.zip_code'); ?> <font style="color:red;">*</font></label>
<input class='form-control form-group-border' id='city' name="zip_code" required placeholder='' type='text' value="<?php echo $user->home_zipcode; if(empty($user->home_zipcode)) echo $user->zipcode; ?>" data-parsley-trigger='blur focusout change' data-parsley-required-message="This field is required.">
</div>
</div>
</div>
      
<!-- / End Personal Information -->
<div class='form-group mt-2'>
<button class='btn btn-outline btn-outline-default btn-radius' type='submit'>
<?php echo trans('forms.save'); ?>
</button>
</div>
</form>
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
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
<script src="https://js.stripe.com/v3/"></script>
          <script>
              // Create a Stripe client
              var pk='<?php echo env('STRIPE_PUB_KEY'); ?>';
var stripe = Stripe(pk);

// Create an instance of Elements
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');
              
              // Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
      $("#card-errors").show();
  } else {
    displayError.textContent = '';
      $("#card-errors").hide();
  }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
        $("#card-errors").show();
    } else { //alert(result.token);
      // Send the token to your server
        $("#card-errors").hide();
        $("#payment-submit").attr('disabled', true);
      stripeTokenHandler(result.token);
    }
  });
});
              
              function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
<script>
    function add_zero(th)
    {
        var val=$(th).val();
        val=('0'+val).slice(-2);
        $(th).val(val);
    }
    
    function show_states(country)
    {
        $("#states").empty();
        $("#state_box").empty();
        
        if(country=='Canada') {
        $("#state_title").text('Province');
        $("#state_box").html('<select class="form-control" name="state" data-parsley-trigger="blur focusout change" required>\
<option value=""></option>\
                            <option value="Alberta">Alberta</option>\
                             <option value="British Columbia">British Columbia</option>\
                             <option value="Manitoba">Manitoba</option>\
                             <option value="New-Brunswick">New-Brunswick</option>\
                             <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>\
                             <option value="Nova Scotia">Nova Scotia</option>\
                             <option value="Northwest Territories">Northwest Territories</option>\
                             <option value="Nunavut">Nunavut</option>\
                             <option value="Ontario">Ontario</option>\
                             <option value="Quebec">Quebec</option>\
                             <option value="Prince Edward Island">Prince Edward Island</option>\
                             <option value="Saskatchewan">Saskatchewan</option>\
                             <option value="Yukon">Yukon</option>\
</select>\
                            ');
        }
        else if(country=='United States') {
        $("#state_title").text('State');
        $("#state_box").html('<select class="form-control" name="state" data-parsley-trigger="blur focusout change" required>\
<option value=""></option>\
                             <option value="Alabama">Alabama</option>\
                             <option value="Alaska">Alaska</option>\
                             <option value="Arizona">Arizona</option>\
                             <option value="Arkansas">Arkansas</option>\
                             <option value="California">California</option>\
                             <option value="Colorado">Colorado</option>\
                             <option value="Connecticut">Connecticut</option>\
                             <option value="Delaware">Delaware</option>\
                             <option value="District of Columbia">District of Columbia</option>\
                             <option value="Florida">Florida</option>\
                             <option value="Georgia">Georgia</option>\
                             <option value="Hawaii">Hawaii</option>\
                             <option value="Idaho">Idaho</option>\
                             <option value="Illinois">Illinois</option>\
                             <option value="Indiana">Indiana</option>\
                             <option value="Iowa">Iowa</option>\
                             <option value="Kansas">Kansas</option>\
                             <option value="Kentucky">Kentucky</option>\
                             <option value="Louisiana">Louisiana</option>\
                             <option value="Maine">Maine</option>\
                             <option value="Maryland">Maryland</option>\
                             <option value="Massachusetts">Massachusetts</option>\
                             <option value="Michigan">Michigan</option>\
                             <option value="Minnesota">Minnesota</option>\
                             <option value="Mississippi">Mississippi</option>\
                             <option value="Missouri">Missouri</option>\
                             <option value="Montana">Montana</option>\
                             <option value="Nebraska">Nebraska</option>\
                             <option value="Nevada">Nevada</option>\
                             <option value="New Hampshire">New Hampshire</option>\
                             <option value="New Jersey">New Jersey</option>\
                             <option value="New Mexico">New Mexico</option>\
                             <option value="New York">New York</option>\
                             <option value="North Carolina">North Carolina</option>\
                             <option value="North Dakota">North Dakota</option>\
                             <option value="Ohio">Ohio</option>\
                             <option value="Oklahoma">Oklahoma</option>\
                             <option value="Oregon">Oregon</option>\
                             <option value="Pennsylvania">Pennsylvania</option>\
                             <option value="Rhode Island">Rhode Island</option>\
                             <option value="South Carolina">South Carolina</option>\
                             <option value="South Dakota">South Dakota</option>\
                             <option value="Tennessee">Tennessee</option>\
                             <option value="Texas">Texas</option>\
                             <option value="Utah">Utah</option>\
                             <option value="Vermont">Vermont</option>\
                             <option value="Virginia">Virginia</option>\
                             <option value="Washington">Washington</option>\
                             <option value="West Virginia">West Virginia</option>\
                             <option value="Wisconsin">Wisconsin</option>\
                             <option value="Wyoming">Wyoming</option>\
                             <option value="Washington">Washington</option>\
                             <option value="Washington">Washington</option>\
                             <option value="Washington">Washington</option>\
</select>\
                            ');
        }
        else {
            $("#state_title").text('Province / State');
            $("#state_box").html("<input class='form-control' placeholder='' name='state' data-parsley-trigger='blur focusout change' required type='text' autocomplete='no' autofill='no'>");
        }
    }
    
                  $(document).on('click', '.car_browse', function(){
                    var file = $(this).prev();
                    file.trigger('click');
                  });

		  $(document).on('change', '.car_file', function(e){
                      var o=new FileReader;
                      o.readAsDataURL(e.target.files[0]),o.onloadend=function(o){
                          $("#car_image").attr("src",o.target.result); 
                      }
                    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
                  });
    
    $(document).ready(function(){
  
    $('#datepicker2').datepicker({
      uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy'
    });
  });
</script>
