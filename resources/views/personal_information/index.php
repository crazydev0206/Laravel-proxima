<?php include(app_path() . '/common/header.php'); ?>
<link href="<?php echo url('stylesheets/uikit.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('javascripts/libs/flot/flot.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/perfect-scrollbar.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/dashboard.css'); ?>" rel="stylesheet" />
<link href="<?php echo url('stylesheets/wave.css'); ?>" rel="stylesheet" />

<div class='body__content container-fluid'>
    <div class="row">
        <div class="col-12 col-md-12 col-lg -4 col-xl-3">
            <div class="container-fluid flex-grow-1 container-p-y">
                <?php include(app_path().'/common/left_profile.php')?>

            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8 col-xl-9">
            <div class="container-fluid flex-grow-1 container-p-y">
                <div class="d-flex align-items-center justify-content-between">

                    <div class="text-muted small d-block breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="lnr lnr-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo url('dashboard')?>"><?php echo $title?></a>
                            </li>
                            <?php if(isset($subtitle)):?>
                            <li class="breadcrumb-item active"><?php echo $subtitle?></li>
                            <?php endif?>
                        </ol>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div style="display:flex; justify-content: space-between; align-item:center; ">
                            <h5><?php echo ucfirst($title)?></h5>
                            <span style="color:red;font-size: 14px;">(*) Indicates required
                                fields</span>

                        </div>
                    </div>
                    <div class="card-body">

                        <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                            method="post" id="personalForm">
                            <?php echo csrf_field(); ?>
                            <!-- / Personal Information -->
                            <!--<h5 class='f-500 mb-2'>Basic Details:</h5>-->

                            <p class="ml-4">
                            <?php $features = array();
                                            if (!empty($user->features)) $features = explode(';', $user->features);

                                            if (in_array('Pink ride', $features) && !in_array('Extra-care ride', $features)) {
                                                echo trans('profile.selected_pinks') . '<br>';
                                                echo trans('profile.selected_pinks_message') . '<br>';
                                                echo trans('profile.selected_o');
                                            } elseif (in_array('Extra-care ride', $features) && !in_array('Pink ride', $features)) {
                                                echo trans('profile.extra_care_title') . '<br>';
                                                echo trans('profile.extra_care_gov') . '<br>';
                                                echo trans('profile.selected_o');
                                            } elseif (in_array('Extra-care ride', $features) && in_array('Pink ride', $features)) {
                                                echo trans('profile.selected_pinks_and_extra') . '<br>';
                                                echo trans('profile.pinks_and_extra_message') . '<br>';
                                                echo trans('profile.selected_o');
                                            } else {
                                                echo trans('profile.to_be_eligible');
                                            }
                                        ?>

                            </p>
                            </p>
                            

                            <div class='row mt-4'>

                                <div class="col-12">
                                    
                                    <div class="container">
                                        <div class="row">
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label
                                                        for='profile-first-name'><?php echo trans('forms.first_name'); ?>
                                                        <font style="color:red;">* </font>
                                                    </label>
                                                    <input class='required- form-control form-group-border' id="fn"
                                                        name="first_name" required placeholder='' type='text'
                                                        value="<?php echo $user->first_name; ?>">
                                                </div>
                                            </div>

                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label
                                                        for='profile-last-name'><?php echo trans('forms.last_name'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <input class='required- form-control form-group-border' id='ln'
                                                        name="last_name" required placeholder='' type='text'
                                                        value="<?php echo $user->last_name; ?>">
                                                </div>
                                            </div>

                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label for='datepicker'><?php echo trans('forms.gender'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <ul class='ul__list ul__list--horizontal'>
                                                        <li>
                                                            <label
                                                                class='checkbox__square checkbox__round checkbox__radio--1'
                                                                for='ride-smoking-type-yes'>
                                                                <div class='radio-element'>
                                                                    <input id='required-ride-smoking-type-yes'
                                                                        data-parsley-errors-container='#parsley-gender-error'
                                                                        data-parsley-required="true" name='gender'
                                                                        type='radio' value='Male'
                                                                        <?php if ($user->gender == 'Male') echo 'checked'; ?>
                                                                        class="filter_field"
                                                                        data-parsley-required-message="This field is required.">
                                                                    <span class='checkbox__all'>
                                                                        <span class='select-element checkbox__element'>
                                                                            <span class='toggle'></span>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <div class='radio-text'>
                                                                    <?php echo trans('forms.male'); ?>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label
                                                                class='checkbox__square checkbox__round checkbox__radio--1'
                                                                for='ride-smoking-type-no'>
                                                                <div class='radio-element'>
                                                                    <input id='ride-smoking-type-no'
                                                                        data-parsley-errors-container='#parsley-gender-error'
                                                                        data-parsley-required="true" name='gender'
                                                                        type='radio' value='Female'
                                                                        <?php if ($user->gender == 'Female') echo 'checked'; ?>
                                                                        class="filter_field">
                                                                    <span class='checkbox__all'>
                                                                        <span class='select-element checkbox__element'>
                                                                            <span class='toggle'></span>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <div class='radio-text'>
                                                                    <?php echo trans('forms.female'); ?>
                                                                </div>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label
                                                                class='checkbox__square checkbox__round checkbox__radio--1'
                                                                for='ride-smoking-type-no2'>
                                                                <div class='radio-element'>
                                                                    <input id='ride-smoking-type-no2'
                                                                        data-parsley-errors-container='#parsley-gender-error'
                                                                        data-parsley-required="true" name='gender'
                                                                        type='radio' value='Prefer not to say'
                                                                        <?php if ($user->gender == 'Prefer not to say') echo 'checked'; ?>
                                                                        class="filter_field">
                                                                    <span class='checkbox__all'>
                                                                        <span class='select-element checkbox__element'>
                                                                            <span class='toggle'></span>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <div class='radio-text'>
                                                                    <?php echo trans('forms.prefer_not_say'); ?>
                                                                </div>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div id='parsley-gender-error'></div>
                                            </div>

                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label for='datepicker'><?php echo trans('forms.date_birth'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label><br>
                                                    <select class='form-control form-group-border' id='year'
                                                        data-parsley-errors-container='#parsley-dob-error'
                                                        placeholder='YYYY' name="year" autocomplete="no" autofill="no"
                                                        style="width:33%; display:inline-block;"
                                                        data-parsley-required-message="Please select a year." required
                                                        data-parsley-trigger='blur focusout change'
                                                        onchange="check_dob()">
                                                        <option value="">YYYY</option>
                                                        <?php for ($i = 1950; $i <= 2015; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"
                                                            <?php if (explode('-', $user->dob)[0] == $i) echo 'selected'; ?>>
                                                            <?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select class='form-control form-group-border' id='month'
                                                        data-parsley-errors-container='#parsley-dob-error'
                                                        placeholder='MM' name="month" autocomplete="no" autofill="no"
                                                        style="width:31%; display:inline-block;"
                                                        data-parsley-required-message="Please select a month." required
                                                        data-parsley-trigger='blur focusout change'
                                                        onchange="check_dob()">
                                                        <option value="">MM</option>
                                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                        <option value="<?php if ($i < 10) echo '0';
                                                        echo $i; ?>"
                                                            <?php if (explode('-', $user->dob)[1] == $i or explode('-', $user->dob)[2] == '0' . $i) echo 'selected'; ?>>
                                                            <?php if ($i < 10) echo '0';
                                                                                                                                                                                    echo $i; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                    <select class='form-control form-group-border' id='date'
                                                        data-parsley-errors-container='#parsley-dob-error'
                                                        placeholder='DD' name="date" autocomplete="no" autofill="no"
                                                        style="width:31%; display:inline-block;"
                                                        data-parsley-required-message="Please select a day." required
                                                        data-parsley-trigger='blur focusout change'
                                                        onchange="check_dob()">
                                                        <option value="">DD</option>
                                                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                        <option value="<?php if ($i < 10) echo '0';
                                                        echo $i; ?>"
                                                            <?php if (explode('-', $user->dob)[2] == $i) echo 'selected'; ?>>
                                                            <?php if ($i < 10) echo '0';
                                                                                                                                        echo $i; ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div id='parsley-dob-error'></div>
                                                <ul class="parsley-errors-list filled" id="dob-error"
                                                    aria-hidden="false" style="display:none;">
                                                    <li class="parsley-required"></li>
                                                </ul>
                                            </div>

                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label for='profile-about-me'><?php echo trans('forms.country'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <?php $u_row['country'] = $user->country; ?>
                                                    <select class='form-control form-group-border' id='country'
                                                        name="country" required onchange="show_states(this.value)"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                        <option value="">
                                                            <?php echo trans('forms.please_select'); ?>
                                                        </option>
                                                        <option value="Canada"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Canada') echo 'selected'; ?>>
                                                            Canada</option>
                                                        <option value="United States"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'United States') echo 'selected'; ?>>
                                                            United States</option>
                                                        <option value="Afganistan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Afghanistan') echo 'selected'; ?>>
                                                            Afghanistan</option>
                                                        <option value="Albania"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Albania') echo 'selected'; ?>>
                                                            Albania</option>
                                                        <option value="Algeria"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Algeria') echo 'selected'; ?>>
                                                            Algeria</option>
                                                        <option value="American Samoa"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'American Samoa') echo 'selected'; ?>>
                                                            American Samoa</option>
                                                        <option value="Andorra"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Andorra') echo 'selected'; ?>>
                                                            Andorra</option>
                                                        <option value="Angola"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Angola') echo 'selected'; ?>>
                                                            Angola</option>
                                                        <option value="Anguilla"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Anguilla') echo 'selected'; ?>>
                                                            Anguilla</option>
                                                        <option value="Antigua & Barbuda"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Antigua & Barbuda') echo 'selected'; ?>>
                                                            Antigua & Barbuda</option>
                                                        <option value="Argentina"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Argentina') echo 'selected'; ?>>
                                                            Argentina</option>
                                                        <option value="Armenia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Armenia') echo 'selected'; ?>>
                                                            Armenia</option>
                                                        <option value="Aruba"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Aruba') echo 'selected'; ?>>
                                                            Aruba</option>
                                                        <option value="Australia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Australia') echo 'selected'; ?>>
                                                            Australia</option>
                                                        <option value="Austria"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Austria') echo 'selected'; ?>>
                                                            Austria</option>
                                                        <option value="Azerbaijan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Azerbaijan') echo 'selected'; ?>>
                                                            Azerbaijan</option>
                                                        <option value="Bahamas"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bahamas') echo 'selected'; ?>>
                                                            Bahamas</option>
                                                        <option value="Bahrain"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bahrain') echo 'selected'; ?>>
                                                            Bahrain</option>
                                                        <option value="Bangladesh"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bangladesh') echo 'selected'; ?>>
                                                            Bangladesh</option>
                                                        <option value="Barbados"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Barbados') echo 'selected'; ?>>
                                                            Barbados</option>
                                                        <option value="Belarus"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Belarus') echo 'selected'; ?>>
                                                            Belarus</option>
                                                        <option value="Belgium"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Belgium') echo 'selected'; ?>>
                                                            Belgium</option>
                                                        <option value="Belize"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Belize') echo 'selected'; ?>>
                                                            Belize</option>
                                                        <option value="Benin"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Benin') echo 'selected'; ?>>
                                                            Benin</option>
                                                        <option value="Bermuda"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bermuda') echo 'selected'; ?>>
                                                            Bermuda</option>
                                                        <option value="Bhutan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bhutan') echo 'selected'; ?>>
                                                            Bhutan</option>
                                                        <option value="Bolivia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bolivia') echo 'selected'; ?>>
                                                            Bolivia</option>
                                                        <option value="Bonaire"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bonaire') echo 'selected'; ?>>
                                                            Bonaire</option>
                                                        <option value="Bosnia & Herzegovina"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bosnia & Herzegovina') echo 'selected'; ?>>
                                                            Bosnia & Herzegovina</option>
                                                        <option value="Botswana"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Botswana') echo 'selected'; ?>>
                                                            Botswana</option>
                                                        <option value="Brazil"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Brazil') echo 'selected'; ?>>
                                                            Brazil</option>
                                                        <option value="British Indian Ocean Ter"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'British Indian Ocean Ter') echo 'selected'; ?>>
                                                            British Indian Ocean Ter</option>
                                                        <option value="Brunei"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Brunei') echo 'selected'; ?>>
                                                            Brunei</option>
                                                        <option value="Bulgaria"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Bulgaria') echo 'selected'; ?>>
                                                            Bulgaria</option>
                                                        <option value="Burkina Faso"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Burkina Faso') echo 'selected'; ?>>
                                                            Burkina Faso</option>
                                                        <option value="Burundi"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Burkina Faso') echo 'selected'; ?>>
                                                            Burundi</option>
                                                        <option value="Cambodia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cambodia') echo 'selected'; ?>>
                                                            Cambodia</option>
                                                        <option value="Cameroon"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cameroon') echo 'selected'; ?>>
                                                            Cameroon</option>
                                                        <option value="Canada"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Canada') echo 'selected'; ?>>
                                                            Canada</option>
                                                        <option value="Canary Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Canary Islands') echo 'selected'; ?>>
                                                            Canary Islands</option>
                                                        <option value="Cape Verde"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cape Verde') echo 'selected'; ?>>
                                                            Cape Verde</option>
                                                        <option value="Cayman Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cayman Islands') echo 'selected'; ?>>
                                                            Cayman Islands</option>
                                                        <option value="Central African Republic"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Central African Republic') echo 'selected'; ?>>
                                                            Central African Republic</option>
                                                        <option value="Chad"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Chad') echo 'selected'; ?>>
                                                            Chad</option>
                                                        <option value="Channel Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Channel Islands') echo 'selected'; ?>>
                                                            Channel Islands</option>
                                                        <option value="Chile"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Chile') echo 'selected'; ?>>
                                                            Chile</option>
                                                        <option value="China"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'China') echo 'selected'; ?>>
                                                            China</option>
                                                        <option value="Christmas Island"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Christmas Island') echo 'selected'; ?>>
                                                            Christmas Island</option>
                                                        <option value="Cocos Island"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cocos Island') echo 'selected'; ?>>
                                                            Cocos Island</option>
                                                        <option value="Colombia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Colombia') echo 'selected'; ?>>
                                                            Colombia</option>
                                                        <option value="Comoros"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Comoros') echo 'selected'; ?>>
                                                            Comoros</option>
                                                        <option value="Congo"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Congo') echo 'selected'; ?>>
                                                            Congo</option>
                                                        <option value="Cook Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cook Islands') echo 'selected'; ?>>
                                                            Cook Islands</option>
                                                        <option value="Costa Rica"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Costa Rica') echo 'selected'; ?>>
                                                            Costa Rica</option>
                                                        <option value="Cote DIvoire"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cote DIvoire') echo 'selected'; ?>>
                                                            Cote DIvoire</option>
                                                        <option value="Croatia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Croatia') echo 'selected'; ?>>
                                                            Croatia</option>
                                                        <option value="Cuba"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cuba') echo 'selected'; ?>>
                                                            Cuba</option>
                                                        <option value="Curaco"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Curaco') echo 'selected'; ?>>
                                                            Curacao</option>
                                                        <option value="Cyprus"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Cyprus') echo 'selected'; ?>>
                                                            Cyprus</option>
                                                        <option value="Czech Republic"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Czech Republic') echo 'selected'; ?>>
                                                            Czech Republic</option>
                                                        <option value="Denmark"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Denmark') echo 'selected'; ?>>
                                                            Denmark</option>
                                                        <option value="Djibouti"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Djibouti') echo 'selected'; ?>>
                                                            Djibouti</option>
                                                        <option value="Dominica"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Dominica') echo 'selected'; ?>>
                                                            Dominica</option>
                                                        <option value="Dominican Republic"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Dominican Republic') echo 'selected'; ?>>
                                                            Dominican Republic</option>
                                                        <option value="East Timor"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'East Timor') echo 'selected'; ?>>
                                                            East Timor</option>
                                                        <option value="Ecuador"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Ecuador') echo 'selected'; ?>>
                                                            Ecuador</option>
                                                        <option value="Egypt"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Egypt') echo 'selected'; ?>>
                                                            Egypt</option>
                                                        <option value="El Salvador"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'El Salvador') echo 'selected'; ?>>
                                                            El Salvador</option>
                                                        <option value="Equatorial Guinea"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Equatorial Guinea') echo 'selected'; ?>>
                                                            Equatorial Guinea</option>
                                                        <option value="Eritrea"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Eritrea') echo 'selected'; ?>>
                                                            Eritrea</option>
                                                        <option value="Estonia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Estonia') echo 'selected'; ?>>
                                                            Estonia</option>
                                                        <option value="Ethiopia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Ethiopia') echo 'selected'; ?>>
                                                            Ethiopia</option>
                                                        <option value="Falkland Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Falkland Islands') echo 'selected'; ?>>
                                                            Falkland Islands</option>
                                                        <option value="Faroe Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Faroe Islands') echo 'selected'; ?>>
                                                            Faroe Islands</option>
                                                        <option value="Fiji"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Fiji') echo 'selected'; ?>>
                                                            Fiji</option>
                                                        <option value="Finland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Finland') echo 'selected'; ?>>
                                                            Finland</option>
                                                        <option value="France"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'France') echo 'selected'; ?>>
                                                            France</option>
                                                        <option value="French Guiana"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'French Guiana') echo 'selected'; ?>>
                                                            French Guiana</option>
                                                        <option value="French Polynesia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'French Polynesia') echo 'selected'; ?>>
                                                            French Polynesia</option>
                                                        <option value="French Southern Ter"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'French Southern Ter') echo 'selected'; ?>>
                                                            French Southern Ter</option>
                                                        <option value="Gabon"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Gabon') echo 'selected'; ?>>
                                                            Gabon</option>
                                                        <option value="Gambia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Gambia') echo 'selected'; ?>>
                                                            Gambia</option>
                                                        <option value="Georgia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Georgia') echo 'selected'; ?>>
                                                            Georgia</option>
                                                        <option value="Germany"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Germany') echo 'selected'; ?>>
                                                            Germany</option>
                                                        <option value="Ghana"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Ghana') echo 'selected'; ?>>
                                                            Ghana</option>
                                                        <option value="Gibraltar"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Gibraltar') echo 'selected'; ?>>
                                                            Gibraltar</option>
                                                        <option value="Great Britain"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Great Britain') echo 'selected'; ?>>
                                                            Great Britain</option>
                                                        <option value="Greece"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Greece') echo 'selected'; ?>>
                                                            Greece</option>
                                                        <option value="Greenland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Greenland') echo 'selected'; ?>>
                                                            Greenland</option>
                                                        <option value="Grenada"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Grenada') echo 'selected'; ?>>
                                                            Grenada</option>
                                                        <option value="Guadeloupe"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Guadeloupe') echo 'selected'; ?>>
                                                            Guadeloupe</option>
                                                        <option value="Guam"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Guam') echo 'selected'; ?>>
                                                            Guam</option>
                                                        <option value="Guatemala"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Guatemala') echo 'selected'; ?>>
                                                            Guatemala</option>
                                                        <option value="Guinea"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Guinea') echo 'selected'; ?>>
                                                            Guinea</option>
                                                        <option value="Guyana"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Guyana') echo 'selected'; ?>>
                                                            Guyana</option>
                                                        <option value="Haiti"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Haiti') echo 'selected'; ?>>
                                                            Haiti</option>
                                                        <option value="Hawaii"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Hawaii') echo 'selected'; ?>>
                                                            Hawaii</option>
                                                        <option value="Honduras"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Honduras') echo 'selected'; ?>>
                                                            Honduras</option>
                                                        <option value="Hong Kong"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Hong Kong') echo 'selected'; ?>>
                                                            Hong Kong</option>
                                                        <option value="Hungary"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Hungary') echo 'selected'; ?>>
                                                            Hungary</option>
                                                        <option value="Iceland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Iceland') echo 'selected'; ?>>
                                                            Iceland</option>
                                                        <option value="Indonesia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Indonesia') echo 'selected'; ?>>
                                                            Indonesia</option>
                                                        <option value="India"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'India') echo 'selected'; ?>>
                                                            India</option>
                                                        <option value="Iran"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Iran') echo 'selected'; ?>>
                                                            Iran</option>
                                                        <option value="Iraq"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Iraq') echo 'selected'; ?>>
                                                            Iraq</option>
                                                        <option value="Ireland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Ireland') echo 'selected'; ?>>
                                                            Ireland</option>
                                                        <option value="Isle of Man"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Isle of Man') echo 'selected'; ?>>
                                                            Isle of Man</option>
                                                        <option value="Israel"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Israel') echo 'selected'; ?>>
                                                            Israel</option>
                                                        <option value="Italy"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Italy') echo 'selected'; ?>>
                                                            Italy</option>
                                                        <option value="Jamaica"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Jamaica') echo 'selected'; ?>>
                                                            Jamaica</option>
                                                        <option value="Japan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Japan') echo 'selected'; ?>>
                                                            Japan</option>
                                                        <option value="Jordan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Jordan') echo 'selected'; ?>>
                                                            Jordan</option>
                                                        <option value="Kazakhstan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Kazakhstan') echo 'selected'; ?>>
                                                            Kazakhstan</option>
                                                        <option value="Kenya"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Kenya') echo 'selected'; ?>>
                                                            Kenya</option>
                                                        <option value="Kiribati"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Kiribati') echo 'selected'; ?>>
                                                            Kiribati</option>
                                                        <option value="Korea North"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Korea North') echo 'selected'; ?>>
                                                            Korea North</option>
                                                        <option value="Korea Sout"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Korea Sout') echo 'selected'; ?>>
                                                            Korea South</option>
                                                        <option value="Kuwait"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Kuwait') echo 'selected'; ?>>
                                                            Kuwait</option>
                                                        <option value="Kyrgyzstan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Kyrgyzstan') echo 'selected'; ?>>
                                                            Kyrgyzstan</option>
                                                        <option value="Laos"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Laos') echo 'selected'; ?>>
                                                            Laos</option>
                                                        <option value="Latvia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Latvia') echo 'selected'; ?>>
                                                            Latvia</option>
                                                        <option value="Lebanon"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Lebanon') echo 'selected'; ?>>
                                                            Lebanon</option>
                                                        <option value="Lesotho"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Lesotho') echo 'selected'; ?>>
                                                            Lesotho</option>
                                                        <option value="Liberia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Liberia') echo 'selected'; ?>>
                                                            Liberia</option>
                                                        <option value="Libya"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Libya') echo 'selected'; ?>>
                                                            Libya</option>
                                                        <option value="Liechtenstein"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Liechtenstein') echo 'selected'; ?>>
                                                            Liechtenstein</option>
                                                        <option value="Lithuania"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Lithuania') echo 'selected'; ?>>
                                                            Lithuania</option>
                                                        <option value="Luxembourg"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Luxembourg') echo 'selected'; ?>>
                                                            Luxembourg</option>
                                                        <option value="Macau"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Macau') echo 'selected'; ?>>
                                                            Macau</option>
                                                        <option value="Macedonia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Macedonia') echo 'selected'; ?>>
                                                            Macedonia</option>
                                                        <option value="Madagascar"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Madagascar') echo 'selected'; ?>>
                                                            Madagascar</option>
                                                        <option value="Malaysia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Malaysia') echo 'selected'; ?>>
                                                            Malaysia</option>
                                                        <option value="Malawi"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Malawi') echo 'selected'; ?>>
                                                            Malawi</option>
                                                        <option value="Maldives"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Maldives') echo 'selected'; ?>>
                                                            Maldives</option>
                                                        <option value="Mali"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mali') echo 'selected'; ?>>
                                                            Mali</option>
                                                        <option value="Malta"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Malta') echo 'selected'; ?>>
                                                            Malta</option>
                                                        <option value="Marshall Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Marshall Islands') echo 'selected'; ?>>
                                                            Marshall Islands</option>
                                                        <option value="Martinique"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Martinique') echo 'selected'; ?>>
                                                            Martinique</option>
                                                        <option value="Mauritania"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mauritania') echo 'selected'; ?>>
                                                            Mauritania</option>
                                                        <option value="Mauritius"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mauritius') echo 'selected'; ?>>
                                                            Mauritius</option>
                                                        <option value="Mayotte"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mayotte') echo 'selected'; ?>>
                                                            Mayotte</option>
                                                        <option value="Mexico"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mexico') echo 'selected'; ?>>
                                                            Mexico</option>
                                                        <option value="Midway Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Midway Islands') echo 'selected'; ?>>
                                                            Midway Islands</option>
                                                        <option value="Moldova"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Moldova') echo 'selected'; ?>>
                                                            Moldova</option>
                                                        <option value="Monaco"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Monaco') echo 'selected'; ?>>
                                                            Monaco</option>
                                                        <option value="Mongolia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mongolia') echo 'selected'; ?>>
                                                            Mongolia</option>
                                                        <option value="Montserrat"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Montserrat') echo 'selected'; ?>>
                                                            Montserrat</option>
                                                        <option value="Morocco"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Morocco') echo 'selected'; ?>>
                                                            Morocco</option>
                                                        <option value="Mozambique"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Mozambique') echo 'selected'; ?>>
                                                            Mozambique</option>
                                                        <option value="Myanmar"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Myanmar') echo 'selected'; ?>>
                                                            Myanmar</option>
                                                        <option value="Nambia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Nambia') echo 'selected'; ?>>
                                                            Nambia</option>
                                                        <option value="Nauru"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Nauru') echo 'selected'; ?>>
                                                            Nauru</option>
                                                        <option value="Nepal"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Nepal') echo 'selected'; ?>>
                                                            Nepal</option>
                                                        <option value="Netherland Antilles"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Netherland Antilles') echo 'selected'; ?>>
                                                            Netherland Antilles</option>
                                                        <option value="Netherlands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Netherlands') echo 'selected'; ?>>
                                                            Netherlands (Holland, Europe)</option>
                                                        <option value="Nevis"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Nevis') echo 'selected'; ?>>
                                                            Nevis</option>
                                                        <option value="New Caledonia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'New Caledonia') echo 'selected'; ?>>
                                                            New Caledonia</option>
                                                        <option value="New Zealand"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'New Zealand') echo 'selected'; ?>>
                                                            New Zealand</option>
                                                        <option value="Nicaragua"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Nicaragua"') echo 'selected'; ?>>
                                                            Nicaragua</option>
                                                        <option value="Niger"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Niger') echo 'selected'; ?>>
                                                            Niger</option>
                                                        <option value="Nigeria"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Nigeria') echo 'selected'; ?>>
                                                            Nigeria</option>
                                                        <option value="Niue"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Niue') echo 'selected'; ?>>
                                                            Niue</option>
                                                        <option value="Norfolk Island"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Norfolk Island') echo 'selected'; ?>>
                                                            Norfolk Island</option>
                                                        <option value="Norway"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Norway') echo 'selected'; ?>>
                                                            Norway</option>
                                                        <option value="Oman"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Oman') echo 'selected'; ?>>
                                                            Oman</option>
                                                        <option value="Pakistan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Pakistan') echo 'selected'; ?>>
                                                            Pakistan</option>
                                                        <option value="Palau Island"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Palau Island') echo 'selected'; ?>>
                                                            Palau Island</option>
                                                        <option value="Palestine"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Palestine') echo 'selected'; ?>>
                                                            Palestine</option>
                                                        <option value="Panama"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Panama') echo 'selected'; ?>>
                                                            Panama</option>
                                                        <option value="Papua New Guinea"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Papua New Guinea') echo 'selected'; ?>>
                                                            Papua New Guinea</option>
                                                        <option value="Paraguay"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Paraguay') echo 'selected'; ?>>
                                                            Paraguay</option>
                                                        <option value="Peru"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Peru') echo 'selected'; ?>>
                                                            Peru</option>
                                                        <option value="Phillipines"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Phillipines') echo 'selected'; ?>>
                                                            Philippines</option>
                                                        <option value="Pitcairn Island"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Pitcairn Island') echo 'selected'; ?>>
                                                            Pitcairn Island</option>
                                                        <option value="Poland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Poland') echo 'selected'; ?>>
                                                            Poland</option>
                                                        <option value="Portugal"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Portugal') echo 'selected'; ?>>
                                                            Portugal</option>
                                                        <option value="Puerto Rico"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Puerto Rico') echo 'selected'; ?>>
                                                            Puerto Rico</option>
                                                        <option value="Qatar"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Qatar') echo 'selected'; ?>>
                                                            Qatar</option>
                                                        <option value="Republic of Montenegro"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Republic of Montenegro') echo 'selected'; ?>>
                                                            Republic of Montenegro</option>
                                                        <option value="Republic of Serbia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Republic of Serbia') echo 'selected'; ?>>
                                                            Republic of Serbia</option>
                                                        <option value="Reunion"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Reunion') echo 'selected'; ?>>
                                                            Reunion</option>
                                                        <option value="Romania"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Romania') echo 'selected'; ?>>
                                                            Romania</option>
                                                        <option value="Russia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Russia') echo 'selected'; ?>>
                                                            Russia</option>
                                                        <option value="Rwanda"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Rwanda') echo 'selected'; ?>>
                                                            Rwanda</option>
                                                        <option value="St Barthelemy"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Barthelemy') echo 'selected'; ?>>
                                                            St Barthelemy</option>
                                                        <option value="St Eustatius"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Eustatius') echo 'selected'; ?>>
                                                            St Eustatius</option>
                                                        <option value="St Helena"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Helena') echo 'selected'; ?>>
                                                            St Helena</option>
                                                        <option value="St Kitts-Nevis"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Kitts-Nevis') echo 'selected'; ?>>
                                                            St Kitts-Nevis</option>
                                                        <option value="St Lucia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Lucia') echo 'selected'; ?>>
                                                            St Lucia</option>
                                                        <option value="St Maarten"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Maarten') echo 'selected'; ?>>
                                                            St Maarten</option>
                                                        <option value="St Pierre & Miquelon"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Pierre & Miquelon') echo 'selected'; ?>>
                                                            St Pierre & Miquelon</option>
                                                        <option value="St Vincent & Grenadines"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'St Vincent & Grenadines') echo 'selected'; ?>>
                                                            St Vincent & Grenadines</option>
                                                        <option value="Saipan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Saipan') echo 'selected'; ?>>
                                                            Saipan</option>
                                                        <option value="Samoa"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Samoa') echo 'selected'; ?>>
                                                            Samoa</option>
                                                        <option value="Samoa American"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Samoa American') echo 'selected'; ?>>
                                                            Samoa American</option>
                                                        <option value="San Marino"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'San Marino') echo 'selected'; ?>>
                                                            San Marino</option>
                                                        <option value="Sao Tome & Principe"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Sao Tome & Principe') echo 'selected'; ?>>
                                                            Sao Tome & Principe</option>
                                                        <option value="Saudi Arabia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Saudi Arabia') echo 'selected'; ?>>
                                                            Saudi Arabia</option>
                                                        <option value="Senegal"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Senegal') echo 'selected'; ?>>
                                                            Senegal</option>
                                                        <option value="Seychelles"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Seychelles') echo 'selected'; ?>>
                                                            Seychelles</option>
                                                        <option value="Sierra Leone"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Sierra Leone') echo 'selected'; ?>>
                                                            Sierra Leone</option>
                                                        <option value="Singapore"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Singapore') echo 'selected'; ?>>
                                                            Singapore</option>
                                                        <option value="Slovakia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Slovakia') echo 'selected'; ?>>
                                                            Slovakia</option>
                                                        <option value="Slovenia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Slovenia') echo 'selected'; ?>>
                                                            Slovenia</option>
                                                        <option value="Solomon Islands"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Solomon Islands') echo 'selected'; ?>>
                                                            Solomon Islands</option>
                                                        <option value="Somalia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Somalia') echo 'selected'; ?>>
                                                            Somalia</option>
                                                        <option value="South Africa"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'South Africa') echo 'selected'; ?>>
                                                            South Africa</option>
                                                        <option value="Spain"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Spain') echo 'selected'; ?>>
                                                            Spain</option>
                                                        <option value="Sri Lanka"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Sri Lanka') echo 'selected'; ?>>
                                                            Sri Lanka</option>
                                                        <option value="Sudan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Sudan') echo 'selected'; ?>>
                                                            Sudan</option>
                                                        <option value="Suriname"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Suriname') echo 'selected'; ?>>
                                                            Suriname</option>
                                                        <option value="Swaziland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Swaziland') echo 'selected'; ?>>
                                                            Swaziland</option>
                                                        <option value="Sweden"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Sweden') echo 'selected'; ?>>
                                                            Sweden</option>
                                                        <option value="Switzerland"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Switzerland"') echo 'selected'; ?>>
                                                            Switzerland</option>
                                                        <option value="Syria"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Syria') echo 'selected'; ?>>
                                                            Syria</option>
                                                        <option value="Tahiti"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tahiti') echo 'selected'; ?>>
                                                            Tahiti</option>
                                                        <option value="Taiwan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Taiwan') echo 'selected'; ?>>
                                                            Taiwan</option>
                                                        <option value="Tajikistan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tajikistan') echo 'selected'; ?>>
                                                            Tajikistan</option>
                                                        <option value="Tanzania"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tanzania') echo 'selected'; ?>>
                                                            Tanzania</option>
                                                        <option value="Thailand"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Thailand') echo 'selected'; ?>>
                                                            Thailand</option>
                                                        <option value="Togo"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Togo') echo 'selected'; ?>>
                                                            Togo</option>
                                                        <option value="Tokelau"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tokelau') echo 'selected'; ?>>
                                                            Tokelau</option>
                                                        <option value="Tonga"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tonga') echo 'selected'; ?>>
                                                            Tonga</option>
                                                        <option value="Trinidad & Tobago"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Trinidad & Tobago') echo 'selected'; ?>>
                                                            Trinidad & Tobago</option>
                                                        <option value="Tunisia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tunisia') echo 'selected'; ?>>
                                                            Tunisia</option>
                                                        <option value="Turkey"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Turkey') echo 'selected'; ?>>
                                                            Turkey</option>
                                                        <option value="Turkmenistan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Turkmenistan') echo 'selected'; ?>>
                                                            Turkmenistan</option>
                                                        <option value="Turks & Caicos Is"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Turks & Caicos Is') echo 'selected'; ?>>
                                                            Turks & Caicos Is</option>
                                                        <option value="Tuvalu"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Tuvalu') echo 'selected'; ?>>
                                                            Tuvalu</option>
                                                        <option value="Uganda"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Uganda') echo 'selected'; ?>>
                                                            Uganda</option>
                                                        <option value="United Kingdom"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'United Kingdom') echo 'selected'; ?>>
                                                            United Kingdom</option>
                                                        <option value="Ukraine"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Ukraine') echo 'selected'; ?>>
                                                            Ukraine</option>
                                                        <option value="United Arab Erimates"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'United Arab Erimates') echo 'selected'; ?>>
                                                            United Arab Emirates</option>
                                                        <option value="United States of America"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'United States of America') echo 'selected'; ?>>
                                                            United States of America</option>
                                                        <option value="Uraguay"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Uraguay') echo 'selected'; ?>>
                                                            Uruguay</option>
                                                        <option value="Uzbekistan"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Uzbekistan') echo 'selected'; ?>>
                                                            Uzbekistan</option>
                                                        <option value="Vanuatu"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Vanuatu') echo 'selected'; ?>>
                                                            Vanuatu</option>
                                                        <option value="Vatican City State"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Vatican City State') echo 'selected'; ?>>
                                                            Vatican City State</option>
                                                        <option value="Venezuela"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Venezuela') echo 'selected'; ?>>
                                                            Venezuela</option>
                                                        <option value="Vietnam"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Vietnam') echo 'selected'; ?>>
                                                            Vietnam</option>
                                                        <option value="Virgin Islands (Brit)"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Virgin Islands (Brit)') echo 'selected'; ?>>
                                                            Virgin Islands (Brit)</option>
                                                        <option value="Virgin Islands (USA)"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Virgin Islands (USA)') echo 'selected'; ?>>
                                                            Virgin Islands (USA)</option>
                                                        <option value="Wake Island"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Wake Island') echo 'selected'; ?>>
                                                            Wake Island</option>
                                                        <option value="Wallis & Futana Is"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Wallis & Futana Is') echo 'selected'; ?>>
                                                            Wallis & Futana Is</option>
                                                        <option value="Yemen"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Yemen') echo 'selected'; ?>>
                                                            Yemen</option>
                                                        <option value="Zaire"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Zaire') echo 'selected'; ?>>
                                                            Zaire</option>
                                                        <option value="Zambia"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Zambia') echo 'selected'; ?>>
                                                            Zambia</option>
                                                        <option value="Zimbabwe"
                                                            <?php if (!empty($u_row['country']) and $u_row['country'] == 'Zimbabwe') echo 'selected'; ?>>
                                                            Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label
                                                        for='profile-about-me'><?php echo trans('forms.street_no'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <input class='form-control form-group-border' id='address'
                                                        name="address" type='text' value="<?php echo $user->address; ?>"
                                                        required>
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label for='profile-about-me'><span
                                                            id="state_title"><?php if ($user->country == 'Canada') echo trans('forms.province_state');
                                                                                                    else if ($user->country == 'United States') echo trans('forms.province_state');
                                                                                                    else echo trans('forms.province_state'); ?></span>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <span id="state_box">
                                                        <?php if ($user->country == 'Canada') { ?>
                                                        <select class="form-control form-group-border" name="state"
                                                            data-parsley-trigger="blur focusout change" required
                                                            data-parsley-required-message="This field is required."
                                                            id="state">
                                                            <option value=""></option>
                                                            <option value="Alberta"
                                                                <?php if ($user->state == 'Alberta') echo 'selected'; ?>>
                                                                Alberta</option>
                                                            <option value="British Columbia"
                                                                <?php if ($user->state == 'British Columbia') echo 'selected'; ?>>
                                                                British Columbia</option>
                                                            <option value="Manitoba"
                                                                <?php if ($user->state == 'Manitoba') echo 'selected'; ?>>
                                                                Manitoba</option>
                                                            <option value="New-Brunswick"
                                                                <?php if ($user->state == 'New-Brunswick') echo 'selected'; ?>>
                                                                New-Brunswick</option>
                                                            <option value="Newfoundland and Labrador"
                                                                <?php if ($user->state == 'Newfoundland and Labrador') echo 'selected'; ?>>
                                                                Newfoundland and Labrador</option>
                                                            <option value="Nova Scotia"
                                                                <?php if ($user->state == 'Nova Scotia') echo 'selected'; ?>>
                                                                Nova Scotia</option>
                                                            <option value="Northwest Territories"
                                                                <?php if ($user->state == 'Northwest Territories') echo 'selected'; ?>>
                                                                Northwest Territories</option>
                                                            <option value="Nunavut"
                                                                <?php if ($user->state == 'Nunavut') echo 'selected'; ?>>
                                                                Nunavut</option>
                                                            <option value="Ontario"
                                                                <?php if ($user->state == 'Ontario') echo 'selected'; ?>>
                                                                Ontario</option>
                                                            <option value="Quebec"
                                                                <?php if ($user->state == 'Quebec') echo 'selected'; ?>>
                                                                Quebec</option>
                                                            <option value="Prince Edward Island"
                                                                <?php if ($user->state == 'Prince Edward Island') echo 'selected'; ?>>
                                                                Prince Edward Island</option>
                                                            <option value="Saskatchewan"
                                                                <?php if ($user->state == 'Saskatchewan') echo 'selected'; ?>>
                                                                Saskatchewan</option>
                                                            <option value="Yukon"
                                                                <?php if ($user->state == 'Yukon') echo 'selected'; ?>>
                                                                Yukon</option>
                                                        </select>
                                                        <?php } else if ($user->country == 'United States') { ?>
                                                        <select class="form-control form-group-border" name="state"
                                                            data-parsley-trigger="blur focusout change" required
                                                            data-parsley-required-message="This field is required."
                                                            id="state">
                                                            <option value=""></option>
                                                            <option value="Alabama"
                                                                <?php if ($user->state == 'Alabama') echo 'selected'; ?>>
                                                                Alabama</option>
                                                            <option value="Alaska"
                                                                <?php if ($user->state == 'Alaska') echo 'selected'; ?>>
                                                                Alaska</option>
                                                            <option value="Arizona"
                                                                <?php if ($user->state == 'Arizona') echo 'selected'; ?>>
                                                                Arizona</option>
                                                            <option value="Arkansas"
                                                                <?php if ($user->state == 'Arkansas') echo 'selected'; ?>>
                                                                Arkansas</option>
                                                            <option value="California"
                                                                <?php if ($user->state == 'California') echo 'selected'; ?>>
                                                                California</option>
                                                            <option value="Colorado"
                                                                <?php if ($user->state == 'Colorado') echo 'selected'; ?>>
                                                                Colorado</option>
                                                            <option value="Connecticut"
                                                                <?php if ($user->state == 'Connecticut') echo 'selected'; ?>>
                                                                Connecticut</option>
                                                            <option value="Delaware"
                                                                <?php if ($user->state == 'Delaware') echo 'selected'; ?>>
                                                                Delaware</option>
                                                            <option value="District of Columbia"
                                                                <?php if ($user->state == 'District of Columbia') echo 'selected'; ?>>
                                                                District of Columbia</option>
                                                            <option value="Florida"
                                                                <?php if ($user->state == 'Florida') echo 'selected'; ?>>
                                                                Florida</option>
                                                            <option value="Georgia"
                                                                <?php if ($user->state == 'Georgia') echo 'selected'; ?>>
                                                                Georgia</option>
                                                            <option value="Hawaii"
                                                                <?php if ($user->state == 'Hawaii') echo 'selected'; ?>>
                                                                Hawaii</option>
                                                            <option value="Idaho"
                                                                <?php if ($user->state == 'Idaho') echo 'selected'; ?>>
                                                                Idaho</option>
                                                            <option value="Illinois"
                                                                <?php if ($user->state == 'Illinois') echo 'selected'; ?>>
                                                                Illinois</option>
                                                            <option value="Indiana"
                                                                <?php if ($user->state == 'Indiana') echo 'selected'; ?>>
                                                                Indiana</option>
                                                            <option value="Iowa"
                                                                <?php if ($user->state == 'Iowa') echo 'selected'; ?>>
                                                                Iowa</option>
                                                            <option value="Kansas"
                                                                <?php if ($user->state == 'Kansas') echo 'selected'; ?>>
                                                                Kansas</option>
                                                            <option value="Kentucky"
                                                                <?php if ($user->state == 'Kentucky') echo 'selected'; ?>>
                                                                Kentucky</option>
                                                            <option value="Louisiana"
                                                                <?php if ($user->state == 'Louisiana') echo 'selected'; ?>>
                                                                Louisiana</option>
                                                            <option value="Maine"
                                                                <?php if ($user->state == 'Maine') echo 'selected'; ?>>
                                                                Maine</option>
                                                            <option value="Maryland"
                                                                <?php if ($user->state == 'Maryland') echo 'selected'; ?>>
                                                                Maryland</option>
                                                            <option value="Massachusetts"
                                                                <?php if ($user->state == 'Massachusetts') echo 'selected'; ?>>
                                                                Massachusetts</option>
                                                            <option value="Michigan"
                                                                <?php if ($user->state == 'Michigan') echo 'selected'; ?>>
                                                                Michigan</option>
                                                            <option value="Minnesota"
                                                                <?php if ($user->state == 'Minnesota') echo 'selected'; ?>>
                                                                Minnesota</option>
                                                            <option value="Mississippi"
                                                                <?php if ($user->state == 'Mississippi') echo 'selected'; ?>>
                                                                Mississippi</option>
                                                            <option value="Missouri"
                                                                <?php if ($user->state == 'Missouri') echo 'selected'; ?>>
                                                                Missouri</option>
                                                            <option value="Montana"
                                                                <?php if ($user->state == 'Montana') echo 'selected'; ?>>
                                                                Montana</option>
                                                            <option value="Nebraska"
                                                                <?php if ($user->state == 'Nebraska') echo 'selected'; ?>>
                                                                Nebraska</option>
                                                            <option value="Nevada"
                                                                <?php if ($user->state == 'Nevada') echo 'selected'; ?>>
                                                                Nevada</option>
                                                            <option value="New Hampshire"
                                                                <?php if ($user->state == 'New Hampshire') echo 'selected'; ?>>
                                                                New Hampshire</option>
                                                            <option value="New Jersey"
                                                                <?php if ($user->state == 'New Jersey') echo 'selected'; ?>>
                                                                New Jersey</option>
                                                            <option value="New Mexico"
                                                                <?php if ($user->state == 'New Mexico') echo 'selected'; ?>>
                                                                New Mexico</option>
                                                            <option value="New York"
                                                                <?php if ($user->state == 'New York') echo 'selected'; ?>>
                                                                New York</option>
                                                            <option value="North Carolina"
                                                                <?php if ($user->state == 'North Carolina') echo 'selected'; ?>>
                                                                North Carolina</option>
                                                            <option value="North Dakota"
                                                                <?php if ($user->state == 'North Dakota') echo 'selected'; ?>>
                                                                North Dakota</option>
                                                            <option value="Ohio"
                                                                <?php if ($user->state == 'Ohio') echo 'selected'; ?>>
                                                                Ohio</option>
                                                            <option value="Oklahoma"
                                                                <?php if ($user->state == 'Oklahoma') echo 'selected'; ?>>
                                                                Oklahoma</option>
                                                            <option value="Oregon"
                                                                <?php if ($user->state == 'Oregon') echo 'selected'; ?>>
                                                                Oregon</option>
                                                            <option value="Pennsylvania"
                                                                <?php if ($user->state == 'Pennsylvania') echo 'selected'; ?>>
                                                                Pennsylvania</option>
                                                            <option value="Rhode Island"
                                                                <?php if ($user->state == 'Rhode Island') echo 'selected'; ?>>
                                                                Rhode Island</option>
                                                            <option value="South Carolina"
                                                                <?php if ($user->state == 'South Carolina') echo 'selected'; ?>>
                                                                South Carolina</option>
                                                            <option value="South Dakota"
                                                                <?php if ($user->state == 'South Dakota') echo 'selected'; ?>>
                                                                South Dakota</option>
                                                            <option value="Tennessee"
                                                                <?php if ($user->state == 'Tennessee') echo 'selected'; ?>>
                                                                Tennessee</option>
                                                            <option value="Texas"
                                                                <?php if ($user->state == 'Texas') echo 'selected'; ?>>
                                                                Texas</option>
                                                            <option value="Utah"
                                                                <?php if ($user->state == 'Utah') echo 'selected'; ?>>
                                                                Utah</option>
                                                            <option value="Vermont"
                                                                <?php if ($user->state == 'Vermont') echo 'selected'; ?>>
                                                                Vermont</option>
                                                            <option value="Virginia"
                                                                <?php if ($user->state == 'Virginia') echo 'selected'; ?>>
                                                                Virginia</option>
                                                            <option value="Washington"
                                                                <?php if ($user->state == 'Washington') echo 'selected'; ?>>
                                                                Washington</option>
                                                            <option value="West Virginia"
                                                                <?php if ($user->state == 'West Virginia') echo 'selected'; ?>>
                                                                West Virginia</option>
                                                            <option value="Wisconsin"
                                                                <?php if ($user->state == 'Wisconsin') echo 'selected'; ?>>
                                                                Wisconsin</option>
                                                            <option value="Wyoming"
                                                                <?php if ($user->state == 'Wyoming') echo 'selected'; ?>>
                                                                Wyoming</option>
                                                        </select>
                                                        <?php } else { ?>
                                                        <input class='form-control form-group-border' id='state'
                                                            name="state" required placeholder='' type='text'
                                                            value="<?php echo $user->state; ?>" list="states"
                                                            autocomplete="no" autofill="no"
                                                            data-parsley-trigger='blur focusout change'
                                                            data-parsley-required-message="This field is required.">
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label for='profile-about-me'><?php echo trans('forms.city'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <input class='form-control form-group-border' id='city' name="city"
                                                        required placeholder='' type='text'
                                                        value="<?php echo $user->city; ?>"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label for='profile-about-me'><?php echo trans('forms.zip_code'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <input class='form-control form-group-border' id='zipcode'
                                                        name="zipcode" required placeholder='' type='text'
                                                        value="<?php echo $user->zipcode; ?>"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                </div>
                                            </div>

                                            <div class='col-12'>
                                                <div class='form-group'>
                                                    <label for='profile-about-me'><?php echo trans('forms.mini_bio'); ?>
                                                        <font style="color:red;">*</font>
                                                    </label>
                                                    <textarea class='form-control textarea_limit form-group-border'
                                                        id='profile-about-me' placeholder='' rows='3' name="about"
                                                        data-limit="300" required><?php echo $user->about; ?></textarea>
                                                    <div class="container pr-0 pt-1 pb-0 mb-0 text-right" id="count">
                                                        <span class="current_length">300</span>&nbsp;/ 300
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-4">
                <div class="card">
                   <div class="carb-body">
                        <p>If you are registering as a driver, you must upload your driver’s license. You may do that now, or when you post your first ride. Your rides won’t go live without it</p>
                   </div>
                </div>

            </div> -->

                            </div>

                            <div class="alert alert-danger" id="error" style="display:none;">
                                Error
                            </div>


                            <div class='form-group mt-2 text-center'>
                                <button class='btn btn-outline btn-outline-default btn-radius btn-dark' type='button'
                                    id="saveInformation">
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

<?php include(app_path() . '/common/footer.php'); ?>
<script src="<?php echo url('plugins/perfect-scrollbar.js'); ?>" type="text/javascript"></script>

<script>
function check_dob() {

    var year = $("#year").val();
    var month = $("#month").val();
    var date = $("#date").val();

    if (year != '' && month != '' && date != '') {
        var dob = year + '-' + month + '-' + date;

        var formData = new FormData();
        var token = '<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('dob', dob);

        $.ajax({
            url: "<?php echo url('check-dob') ?>",
            type: "POST",
            data: formData,
            beforeSend: function() { //alert('sending');
                $("#submit_btn").attr('disabled', true);
            },
            contentType: false,
            processData: false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                if (!data.success) {
                    $("#dob-error").html('<li class="parsley-required">Please select a valid date.</li>');
                    $("#dob-error").show();
                    $("#submit_btn").attr('disabled', true);
                } else {
                    // ALL GOOD! just show the success message!
                    $("#dob-error").hide();
                    $("#submit_btn").attr('disabled', false);
                }
            },
            error: function() {
                //error
            }
        });
    }
}

$('.textarea_limit').on("input", function() {
    var maxlength = $(this).attr('data-limit');
    var currentLength = $(this).val().length;

    if (currentLength >= maxlength) {
        $(this).val($(this).val().substring(0, maxlength));
        $(this).parent().children('#count').children('.current_length').text('0');
    } else {
        $(this).parent().children('#count').children('.current_length').text(maxlength - currentLength);
    }
});

function add_zero(th) {
    var val = $(th).val();
    val = ('0' + val).slice(-2);
    $(th).val(val);
}

function check_data() {
    //var check=check_password();
    //var match=match_password();

    //if(!check) return false;

    $("#error").hide();

    var phone = $("#phone_field").val().replace(/[^0-9]/gi, '');
    var lng = phone.length;
    if (parseInt(lng) < 10) {
        $("#error").text('Please enter a valid phone number.');
        $("#error").show();
        return false;
    }

    return true;
}

function show_states(country) {
    $("#states").empty();
    $("#state_box").empty();

    if (country == 'Canada') {
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
    } else if (country == 'United States') {
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
    } else {
        $("#state_title").text('Province / State');
        $("#state_box").html(
            "<input class='form-control' placeholder='' name='state' data-parsley-trigger='blur focusout change' required type='text' autocomplete='no' autofill='no'>"
        );
    }
}

$(document).on('click', '.car_browse', function() {
    var file = $(this).prev();
    file.trigger('click');
});


$(document).on('change', '.car_file', function(e) {
    var o = new FileReader;
    o.readAsDataURL(e.target.files[0]), o.onloadend = function(o) {

        var formData = new FormData();
        var token = '<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('file', e.target.files[0]);

        $.ajax({
            url: "<?php echo url('upload-id-card-image') ?>",
            type: "POST",
            data: formData,
            beforeSend: function() { //alert('sending');
                $("#submit_btn").attr('disabled', true);
            },
            contentType: false,
            processData: false,
            success: function(data) { //alert(data);
                $("#submit_btn").attr('disabled', false);
                //success
                // here we will handle errors and validation messages
                if (!data.success) {} else {
                    // ALL GOOD! just show the success message!
                    $("#img_file").val(data.name);
                    $(".car_file").val('');
                }
            },
            error: function() {
                //error
            }
        });

        $("#car_image").attr("src", o.target.result);
    }
    //$(this).prev().text($(this).val().replace(/C:\\fakepath\\/i, ''));
});

$(document).ready(function() {

    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy'
    });
});
</script>


<script type="text/javascript">
$("#saveInformation").click(function() {

    var fn = $("#fn").val();

    var ln = $("#ln").val();

    var gender = $("input[name='gender']:checked").val();

    var year = $("#year").val();
    var month = $("#month").val();
    var date = $("#date").val();

    var city = $("#city").val();
    var state = $("#state").val();
    var zip = $("#zipcode").val();
    var address = $("#address").val();
    var country = $("#country").val();

    let allRequired = true;

    if (fn == "") {
        showErrorDialog("Please enter your first name", $("#fn").addClass('border border-dander'));
    } else if (ln == "") {
        showErrorDialog("Please enter your last name", $("#ln").addClass('border border-dander'));
    } else if (gender == "" || gender == null) {
        showErrorDialog("Please select your gender", $("#gender").addClass('border border-dander'));
    } else if (year == "" || month == "" || date == "") {
        showErrorDialog("Please check your date of birth", $("#year").addClass('border border-dander'));
    } else if (address == "") {
        showErrorDialog("Please enter your address", $("#address").addClass('border border-dander'));
    } else if (city == "") {
        showErrorDialog("Please enter your city", $("#city").addClass('border border-dander'));
    } else if (state == "") {
        showErrorDialog("Please enter your state", $("#state").addClass('border border-dander'));
    } else if (zip == "") {
        showErrorDialog("Please enter your zipcode", $("#zip").addClass('border border-dander'));
    } else if (country == "") {

        showErrorDialog("Please enter your country", $("#country").addClass('border border-dander'));
    } else {

        $("#personalForm").submit();
    }

});

// function showErrorDialog(msg) {
//     $("#error").show();
//     $("#error").html(msg);
// }
</script>