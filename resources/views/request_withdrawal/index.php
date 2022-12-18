<?php include(app_path().'/common/header.php'); ?>
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
                        <h5 class="main-heading pull-left"><?php echo trans('profile.payout'); ?></h5>
                        <p class="pull-right mb-0 text-danger">
                            <font style="color:red;">*</font>
                            <?php echo trans('profile.indicates_required_fields'); ?>
                        </p>
                    </div>
                    <div class="card-body">
                    <?php if($user->balance<10) { ?>
                                <p class="alert alert-primary">Minimum balance of $10 CAD is required to submit a
                                    withdrawal request.</p>
                                <?php } else if(!isset($active_request->id)) { ?>
                               
                                <form class='rider__sign parsley__form__validate' data-parsley-validate='' action=""
                                    method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class='row'>
                                        <div class='col-12 col-md-6'>
                                            <div class='form-group'>
                                                <label><?php echo trans('forms.amount'); ?> <font style="color:red;">*
                                                    </font></label>
                                                <input class='form-control form-group-border' name='amount' required
                                                    type="number" step="any" min="10"
                                                    max="<?php echo $user->balance; ?>" autocomplete="off" autofill="no"
                                                    value="<?php echo $user->balance; ?>"
                                                    data-parsley-trigger='blur focusout change'
                                                    data-parsley-required-message="This field is required.">
                                            </div>
                                        </div>
                                        <div class='col-12 col-md-6'>
                                            <div class='form-group'>
                                                <label><?php echo trans('forms.payout_method'); ?> <font
                                                        style="color:red;">*</font></label>
                                                <select class='form-control form-group-border' name="method" required
                                                    data-parsley-trigger='blur focusout change'
                                                    data-parsley-required-message="This field is required."
                                                    onchange="update_method(this)">
                                                    <option value=""></option>
                                                    <option value="Bank"
                                                        <?php if(isset($request->method) AND $request->method=='Bank') echo 'selected'; ?>>
                                                        <?php echo trans('forms.bank_transfer'); ?></option>
                                                    <option value="PayPal"
                                                        <?php if(isset($request->method) AND $request->method=='PayPal') echo 'selected'; ?>>
                                                        <?php echo trans('forms.paypal_transfer'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="bank_details"
                                        style="<?php if(!isset($request->method) OR $request->method!='Bank') echo 'display:none;'; ?>">
                                        <h5 class="mt-4"><?php echo trans('forms.bank_details'); ?>:</h5>
                                        <hr class="mt-0">
                                        <div class='row'>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label><?php echo trans('forms.account_no'); ?> <font
                                                            style="color:red;">*</font></label>
                                                    <input
                                                        class='form-control details_fields bank_fields form-group-border'
                                                        name='account_no' required type="text" autocomplete="off"
                                                        autofill="no"
                                                        value="<?php if(isset($request->account_no)) echo $request->account_no; ?>"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label><?php echo trans('forms.bank_name'); ?> <font
                                                            style="color:red;">*</font></label>
                                                    <input
                                                        class='form-control details_fields bank_fields form-group-border'
                                                        name='bank_name' required type="text" autocomplete="off"
                                                        autofill="no"
                                                        value="<?php if(isset($request->bank_name)) echo $request->bank_name; ?>"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label><?php echo trans('forms.ifsc_code'); ?> <font
                                                            style="color:red;">*</font></label>
                                                    <input
                                                        class='form-control details_fields bank_fields form-group-border'
                                                        name='ifsc_code' required type="text" autocomplete="off"
                                                        autofill="no"
                                                        value="<?php if(isset($request->ifsc_code)) echo $request->ifsc_code; ?>"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                </div>
                                            </div>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label><?php echo trans('forms.country'); ?> <font
                                                            style="color:red;">*</font></label>
                                                    <?php $u_row['country']=$user->country;
                                                        if(isset($request->country)) $u_row['country']=$request->country;
                                                        ?>
                                                    <select
                                                        class='form-control details_fields bank_fields form-group-border'
                                                        id='country' name="country" required
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                        <option value="Albania"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Albania') echo 'selected'; ?>>
                                                            Albania</option>
                                                        <option value="Algeria"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Algeria') echo 'selected'; ?>>
                                                            Algeria</option>
                                                        <option value="Argentina"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Argentina') echo 'selected'; ?>>
                                                            Argentina</option>
                                                        <option value="Armenia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Armenia') echo 'selected'; ?>>
                                                            Armenia</option>
                                                        <option value="Australia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Australia') echo 'selected'; ?>>
                                                            Australia</option>
                                                        <option value="Austria"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Austria') echo 'selected'; ?>>
                                                            Austria</option>
                                                        <option value="Azerbaijan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Azerbaijan') echo 'selected'; ?>>
                                                            Azerbaijan</option>
                                                        <option value="Bahamas"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bahamas') echo 'selected'; ?>>
                                                            Bahamas</option>
                                                        <option value="Bahrain"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bahrain') echo 'selected'; ?>>
                                                            Bahrain</option>
                                                        <option value="Bangladesh"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bangladesh') echo 'selected'; ?>>
                                                            Bangladesh</option>
                                                        <option value="Barbados"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Barbados') echo 'selected'; ?>>
                                                            Barbados</option>
                                                        <option value="Belarus"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Belarus') echo 'selected'; ?>>
                                                            Belarus</option>
                                                        <option value="Belgium"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Belgium') echo 'selected'; ?>>
                                                            Belgium</option>
                                                        <option value="Belize"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Belize') echo 'selected'; ?>>
                                                            Belize</option>
                                                        <option value="Benin"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Benin') echo 'selected'; ?>>
                                                            Benin</option>
                                                        <option value="Bermuda"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bermuda') echo 'selected'; ?>>
                                                            Bermuda</option>
                                                        <option value="Bhutan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bhutan') echo 'selected'; ?>>
                                                            Bhutan</option>
                                                        <option value="Bolivia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bolivia') echo 'selected'; ?>>
                                                            Bolivia</option>
                                                        <option value="Bosnia and Herzegovina"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bosnia and Herzegovina') echo 'selected'; ?>>
                                                            Bosnia and Herzegovina</option>
                                                        <option value="Brazil"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Brazil') echo 'selected'; ?>>
                                                            Brazil</option>
                                                        <option value="British Indian Ocean Territory"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='British Indian Ocean Territory') echo 'selected'; ?>>
                                                            British Indian Ocean Territory</option>
                                                        <option value="Bulgaria"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Bulgaria') echo 'selected'; ?>>
                                                            Bulgaria</option>
                                                        <option value="Burma"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Burma') echo 'selected'; ?>>
                                                            Burma</option>
                                                        <option value="Cambodia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Cambodia') echo 'selected'; ?>>
                                                            Cambodia</option>
                                                        <option value="Cameroon"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Cameroon') echo 'selected'; ?>>
                                                            Cameroon</option>
                                                        <option value="Canada"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Canada') echo 'selected'; ?>>
                                                            Canada</option>
                                                        <option value="Chile"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Chile') echo 'selected'; ?>>
                                                            Chile</option>
                                                        <option value="China"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='China') echo 'selected'; ?>>
                                                            China</option>
                                                        <option value="Colombia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Colombia') echo 'selected'; ?>>
                                                            Colombia</option>
                                                        <option value="Comoros"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Comoros') echo 'selected'; ?>>
                                                            Comoros</option>
                                                        <option value="Costa Rica"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Costa Rica') echo 'selected'; ?>>
                                                            Costa Rica</option>
                                                        <option value="Croatia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Croatia') echo 'selected'; ?>>
                                                            Croatia</option>
                                                        <option value="Cuba"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Cuba') echo 'selected'; ?>>
                                                            Cuba</option>
                                                        <option value="Cyprus"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Cyprus') echo 'selected'; ?>>
                                                            Cyprus</option>
                                                        <option value="Czech Republic"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Czech Republic') echo 'selected'; ?>>
                                                            Czech Republic</option>
                                                        <option value="Denmark"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Denmark') echo 'selected'; ?>>
                                                            Denmark</option>
                                                        <option value="Dominican Republic"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Dominican Republic') echo 'selected'; ?>>
                                                            Dominican Republic</option>
                                                        <option value="Ecuador"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Ecuador') echo 'selected'; ?>>
                                                            Ecuador</option>
                                                        <option value="Egypt"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Egypt') echo 'selected'; ?>>
                                                            Egypt</option>
                                                        <option value="El Salvador"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='El Salvador') echo 'selected'; ?>>
                                                            El Salvador</option>
                                                        <option value="Estonia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Estonia') echo 'selected'; ?>>
                                                            Estonia</option>
                                                        <option value="France"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='France') echo 'selected'; ?>>
                                                            France</option>
                                                        <option value="Georgia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Georgia') echo 'selected'; ?>>
                                                            Georgia</option>
                                                        <option value="Germany"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Germany') echo 'selected'; ?>>
                                                            Germany</option>
                                                        <option value="Ghana"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Ghana') echo 'selected'; ?>>
                                                            Ghana</option>
                                                        <option value="Greece"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Greece') echo 'selected'; ?>>
                                                            Greece</option>
                                                        <option value="Greenland"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Greenland') echo 'selected'; ?>>
                                                            Greenland</option>
                                                        <option value="Guatemala"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Guatemala') echo 'selected'; ?>>
                                                            Guatemala</option>
                                                        <option value="Hong Kong"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Hong Kong') echo 'selected'; ?>>
                                                            Hong Kong</option>
                                                        <option value="Hungary"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Hungary') echo 'selected'; ?>>
                                                            Hungary</option>
                                                        <option value="Iceland"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Iceland') echo 'selected'; ?>>
                                                            Iceland</option>
                                                        <option value="India"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='India') echo 'selected'; ?>>
                                                            India</option>
                                                        <option value="Indonesia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Indonesia') echo 'selected'; ?>>
                                                            Indonesia</option>
                                                        <option value="Ireland"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Ireland') echo 'selected'; ?>>
                                                            Ireland</option>
                                                        <option value="Israel"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Israel') echo 'selected'; ?>>
                                                            Israel</option>
                                                        <option value="Italy"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Italy') echo 'selected'; ?>>
                                                            Italy</option>
                                                        <option value="Jamaica"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Jamaica') echo 'selected'; ?>>
                                                            Jamaica</option>
                                                        <option value="Japan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Japan') echo 'selected'; ?>>
                                                            Japan</option>
                                                        <option value="Korea"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Korea') echo 'selected'; ?>>
                                                            Korea</option>
                                                        <option value="Kyrgyzstan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Kyrgyzstan') echo 'selected'; ?>>
                                                            Kyrgyzstan</option>
                                                        <option value="Laos"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Laos') echo 'selected'; ?>>
                                                            Laos</option>
                                                        <option value="Latvia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Latvia') echo 'selected'; ?>>
                                                            Latvia</option>
                                                        <option value="Lebanon"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Lebanon') echo 'selected'; ?>>
                                                            Lebanon</option>
                                                        <option value="Liechtenstein"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Liechtenstein') echo 'selected'; ?>>
                                                            Liechtenstein</option>
                                                        <option value="Lithuania"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Lithuania') echo 'selected'; ?>>
                                                            Lithuania</option>
                                                        <option value="Luxembourg"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Luxembourg') echo 'selected'; ?>>
                                                            Luxembourg</option>
                                                        <option value="Macau"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Macau') echo 'selected'; ?>>
                                                            Macau</option>
                                                        <option value="Macedonia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Macedonia') echo 'selected'; ?>>
                                                            Macedonia</option>
                                                        <option value="Malaysia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Malaysia') echo 'selected'; ?>>
                                                            Malaysia</option>
                                                        <option value="Mexico"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Mexico') echo 'selected'; ?>>
                                                            Mexico</option>
                                                        <option value="Morocco"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Morocco') echo 'selected'; ?>>
                                                            Morocco</option>
                                                        <option value="Nepal"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Nepal') echo 'selected'; ?>>
                                                            Nepal</option>
                                                        <option value="Netherlands"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Netherlands') echo 'selected'; ?>>
                                                            Netherlands</option>
                                                        <option value="New Zealand"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='New Zealand') echo 'selected'; ?>>
                                                            New Zealand</option>
                                                        <option value="Norway"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Norway') echo 'selected'; ?>>
                                                            Norway</option>
                                                        <option value="Oman"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Oman') echo 'selected'; ?>>
                                                            Oman</option>
                                                        <option value="Pakistan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Pakistan') echo 'selected'; ?>>
                                                            Pakistan</option>
                                                        <option value="Paraguay"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Paraguay') echo 'selected'; ?>>
                                                            Paraguay</option>
                                                        <option value="Peru"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Peru') echo 'selected'; ?>>
                                                            Peru</option>
                                                        <option value="Philippines"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Philippines') echo 'selected'; ?>>
                                                            Philippines</option>
                                                        <option value="Poland"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Poland') echo 'selected'; ?>>
                                                            Poland</option>
                                                        <option value="Portugal"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Portugal') echo 'selected'; ?>>
                                                            Portugal</option>
                                                        <option value="Qatar"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Qatar') echo 'selected'; ?>>
                                                            Qatar</option>
                                                        <option value="Reunion"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Reunion') echo 'selected'; ?>>
                                                            Reunion</option>
                                                        <option value="Romania"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Romania') echo 'selected'; ?>>
                                                            Romania</option>
                                                        <option value="Russia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Russia') echo 'selected'; ?>>
                                                            Russia</option>
                                                        <option value="Saudi Arabia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Saudi Arabia') echo 'selected'; ?>>
                                                            Saudi Arabia</option>
                                                        <option value="Singapore"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Singapore') echo 'selected'; ?>>
                                                            Singapore</option>
                                                        <option value="Slovakia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Slovakia') echo 'selected'; ?>>
                                                            Slovakia</option>
                                                        <option value="Slovenia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Slovenia') echo 'selected'; ?>>
                                                            Slovenia</option>
                                                        <option value="South Africa"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='South Africa') echo 'selected'; ?>>
                                                            South Africa</option>
                                                        <option value="Sweden"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?>>
                                                            Sweden</option>
                                                        <option value="Switzerland"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Switzerland') echo 'selected'; ?>>
                                                            Switzerland</option>
                                                        <option value="Taiwan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Taiwan') echo 'selected'; ?>>
                                                            Taiwan</option>
                                                        <option value="Thailand"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Thailand') echo 'selected'; ?>>
                                                            Thailand</option>
                                                        <option value="Tunisia"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Tunisia') echo 'selected'; ?>>
                                                            Tunisia</option>
                                                        <option value="Turkey"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Turkey') echo 'selected'; ?>>
                                                            Turkey</option>
                                                        <option value="Turkmenistan"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Turkmenistan') echo 'selected'; ?>>
                                                            Turkmenistan</option>
                                                        <option value="United Kingdom"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?>>
                                                            United Kingdom</option>
                                                        <option value="United States"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?>>
                                                            United States</option>
                                                        <option value="Venezuela"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?>>
                                                            Venezuela</option>
                                                        <option value="Vietnam"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?>>
                                                            Vietnam</option>
                                                        <option value="Yemen"
                                                            <?php if(!empty($u_row['country']) AND $u_row['country']=='Sweden') echo 'selected'; ?>>
                                                            Yemen</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="paypal_details"
                                        style="<?php if(!isset($request->method) OR $request->method!='PayPal') echo 'display:none;'; ?>">
                                        <h5 class="mt-4"><?php echo trans('forms.paypal_details'); ?>:</h5>
                                        <hr class="mt-0">
                                        <div class='row'>
                                            <div class='col-12 col-md-6'>
                                                <div class='form-group'>
                                                    <label><?php echo trans('forms.paypal_email'); ?> <font
                                                            style="color:red;">*</font></label>
                                                    <input
                                                        class='form-control details_fields paypal_fields form-group-border'
                                                        name='paypal_email' required type="email" autocomplete="off"
                                                        autofill="no"
                                                        value="<?php if(isset($request->paypal_email)) echo $request->paypal_email; ?>"
                                                        data-parsley-trigger='blur focusout change'
                                                        data-parsley-required-message="This field is required.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <p class="alert alert-danger" style="display:none;" id="error"></p>
                                        <button class='btn btn-outline btn-outline-default btn-c-transition btn-radius'
                                            type='submit' id="submit_btn">
                                            <?php echo trans('forms.submit'); ?>
                                        </button>
                                    </div>
                                </form>
                                <?php } else { ?>
                                <p class="alert alert-success">Your withdrawal request for
                                    $<?php echo $active_request->amount; ?> CAD is under process. It will be processed
                                    within next 2 business days.</p>
                                <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include(app_path().'/common/footer.php'); ?>
<script src="<?php echo url('javascripts/libs/parsley.min.js'); ?>"></script>
<script>
function update_method(th) {
    var method = $(th).val();
    $("#bank_details").hide();
    $("#paypal_details").hide();
    $(".details_fields").attr('required', false);

    if (method == 'Bank') {
        $("#bank_details").show();
        $(".bank_fields").attr('required', true);
    } else if (method == 'PayPal') {
        $("#paypal_details").show();
        $(".paypal_fields").attr('required', true);
    }
}
</script>