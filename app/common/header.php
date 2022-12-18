<?php

$languageSet = "en";

if (isset($_GET['lang'])) {
    // code...
    $languageSet = $_GET['lang'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>

    <style>
    .jconfirm-title {
        font-family: 'Futura', sans-serif !important;
        font-size: 20px;
    }

    .jconfirm.jconfirm-modern .jconfirm-box .jconfirm-buttons button {
        text-transform: inherit !important;
    }
    </style>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
    <meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <meta name="keywords" content="<?php echo trans('meta.keywords'); ?>">
    <meta name="description" content="<?php echo trans('meta.description'); ?>">
    <meta name="application-name" content="<?php echo env('APP_NAME'); ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo url('images/favicon/favicon-32x32.png'); ?>" type="image/x-icon" />
    <link rel="icon" href="<?php echo url('images/favicon/favicon-32x32.png'); ?>" type="image/x-icon">

    <title>
        <?php if (isset($title)) echo $title . ' | ';
        echo config('app.name'); ?>
    </title>

    <!-- Fonts Icon -->
    <link href="<?php echo url('css/all.min.css'); ?>" rel='stylesheet' type='text/css'>
    <link href="<?php echo url('css/fonts.css'); ?>" rel='stylesheet' type='text/css'>
    <link href="https://unpkg.com/linearicons@1.0.2/dist/web-font/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ionic/core/css/ionic.bundle.css" /> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pontano+Sans&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700'
        rel='stylesheet'>

    <!-- Vendor CSS -->
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css'
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css"
        rel="stylesheet" />
    <link href="https://unpkg.com/bootstrap-select-country@4.1.0/dist/css/bootstrap-select-country.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="plugins/formvalidation/js/FormValidation.min.css">

    <!-- Custom CSS -->
    <link href="<?php echo url('stylesheets/site.css'); ?>" rel="stylesheet" />
    <link href="<?php echo url('stylesheets/update.css'); ?>" rel="stylesheet" />
    <link href="<?php echo url('stylesheets/update-2.css'); ?>" rel="stylesheet" />
    <link href="<?php echo url('stylesheets/style.css'); ?>" rel="stylesheet" />


    <script>
    window._token = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    window.assetsPath = "<?php echo url('/'); ?>"
    window.showErrorDialog = (msg, fn = null) => {
        // setTimeout(() => {
        let dialog = $.confirm({
            title: 'Error',
            content: msg,
            icon: 'fa fa-exclamation-circle',
            type: 'red',
            typeAnimated: true,
            theme: 'modern',
            buttons: {

                somethingElse: {
                    text: 'Close',
                    btnClass: 'btn-red',
                    action: function() {

                        if (!fn) {
                            dialog.close();

                        } else {
                            fn
                            dialog.close()
                        }

                    }
                }
            }
        });

        // }, 1000);
    }
    window.showSuccessDialog = (msg, fn = null) => {
       
        let dialog = $.confirm({
            title: 'Success',
            content: msg,
            icon: 'fa fa-check',
            type: 'green',
            typeAnimated: true,
            theme: 'modern',
            buttons: {

                somethingElse: {
                    text: 'Close',
                    btnClass: 'btn-green',
                    action: function() {

                        if (!fn) {
                            dialog.close();

                        } else {
                            fn
                            dialog.close()
                        }

                    }
                }
            }
        });
    }
    </script>

    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->

    <!-- <script>
    //$(document).on('pagebeforecreate', function( e ) {
    //    $( "input, textarea, select", e.target ).attr( "data-role", "none" );
    //});
     //$(document).on('pagebeforecreate',function(){
    //    $.mobile.page.prototype.options.keepNative = "select,input,textarea";
    //});
</script>
     -->

    <!-- calaner -->
    <link href='https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css' rel='stylesheet' type='text/css'>
    <!-- calander -->


</head>

<body>
    <div class='body__wrapper'>
        <div class='header__content'>
            <!-- =====================Navbar=========================== -->
            <div class='home__header__main'>
                <div class='container-fluid'>
                    <nav class='navbar navbar-expand-lg navbar-light bg-light navbar-custom-header'>
                        <a class='navbar-brand' href='<?php echo ($user !== 0) ? url('dashboard') : url(''); ?>'>
                            <img class="desktop" src="<?php echo url('images/PROXIMARIDE.png'); ?>"
                                alt="<?php echo env('APP_NAME'); ?>" style="max-width: 100px;" />
                            <img class="mobile" src="<?php echo url('images/PROXIMARIDE_MOBILE.png'); ?>"
                                alt="<?php echo env('APP_NAME'); ?>" style="max-width: 60px;" />
                        </a>

                        <a class="float-right add-trip-mobile2 clickable" href="<?php echo url('search-ride'); ?>"><img
                                alt='' height='20' src='<?php echo url('images/11-3-lense-transparent.png'); ?>'
                                width='20'>
                            <!--<i class="fa fa-search"></i>-->
                        </a>
                        <a class="float-right add-trip-mobile clickable" href="<?php echo url('post-ride'); ?>"><img
                                alt='' height='26' src='<?php echo url('images/new-23-2-plus-inside-a-circle3.png'); ?>'
                                width='25'>
                            <!--<i class="fa fa-plus"></i>-->
                        </a>

                        <button aria-controls='navbarSupportedContent' aria-expanded='false'
                            aria-label='Toggle navigation' class='navbar-toggler' data-target='#navbarSupportedContent'
                            data-toggle='collapse' type='button' style="outline:0;">
                            <span class='navbar-toggler-icon'></span>
                        </button>

                        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                            <ul class='navbar-nav mr-auto header-left-side h-mobile-center-menu'>

                            <?php if ($user !== 0) {?>
                                   
                                   <li class='nav-item'>
                                       <a class='nav-link' href='<?php echo url('dashboard'); ?>'>
                                           <span class='text'>Dashboard</span>
                                       </a>
                                   </li>
                                   <?php }?>
                                   
                                <li class='nav-item'>
                                    <a class='nav-link nav-link-highlight' href='<?php echo url('students'); ?>'>
                                        <!--<span class='highlight' style="border-radius: 2px;">New</span>-->
                                        <?php
                                        if ($lang == 'en') $new_img = url('images/10-new-button-no-box.png');
                                        else if ($lang == 'fr') $new_img = url('images/New-in-French-PNG.png');
                                        else if ($lang == 'es') $new_img = url('images/New-in-Spanish-PNG.png');
                                        else $new_img = url('images/10-new-button-no-box.png');

                                        if ($lang == 'en') {
                                        ?>
                                        <img class="highlight" src="<?php echo $new_img; ?>"
                                            style="max-width: 19px; max-height: 20px; border-radius:0px; background:none; padding:0px; margin-bottom:0px;" />
                                        <?php } else if ($lang == 'fr') { ?>
                                        <img class="highlight" src="<?php echo $new_img; ?>"
                                            style="max-width: 45px; max-height: 20px; border-radius:0px; background:none; padding:0px;" />
                                        <?php } else if ($lang == 'es') { ?>
                                        <img class="highlight" src="<?php echo $new_img; ?>"
                                            style="max-width: 39px; max-height: 20px; border-radius:0px; background:none; padding:0px;" />
                                        <?php } ?>
                                        <img alt='' class='mr-2' height='20'
                                            src='<?php echo url('images/28-bachelor-degree.png'); ?>' width='20'><span
                                            class='text'><?php echo trans('common.students'); ?></span>
                                    </a>
                                </li>

                              

                                <li class='nav-item'>
                                    <a class='nav-link' href='<?php echo url('post-ride'); ?>'><img alt='' class='mr-2'
                                            height='26' widt
                                            src='<?php echo url('images/new-23-2-plus-inside-a-circle.png'); ?>'
                                            width='25'><span
                                            class='text'><?php echo trans('common.post_ride'); ?></span>
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='<?php echo url('search-ride'); ?>'><img alt=''
                                            class='mr-2' height='26'
                                            src='<?php echo url('images/new-23-1-magnifying-lense.png'); ?>' width='25'>
                                        <!--<i aria-hidden='true' class='fa fa-search pr-2' style="font-weight: normal; font-size:15px;"></i>--><span
                                            class='text'><?php echo trans('common.find_ride'); ?></span>
                                    </a>
                                </li>
                            </ul>
                            <?php if ($user_id != 0) { ?>
                            <!--<ul class='navbar-nav ml-auto mr-0 header-right-side header-logged-user'>
<li class='nav-item dropdown'>
<a class='nav-link login_text nav-login-btn dropdown-toggle nav-user-link' data-toggle='dropdown' href='#'>
$<?php echo $user->balance; ?> CAD
</a>
<ul class='dropdown-menu user-dropdown-menu' style="left:-115px !important;">
<li class='dropdown-item'>
<a class='dropdown-link' href='<?php echo url('request-withdrawal'); ?>'>
<span class='fa fa-user'></span>
Request Withdrawal
</a>
</li>
<li class='dropdown-item'>
<a class='dropdown-link' href='<?php echo url('all-transactions'); ?>'>
<span class='fa fa-credit-card'></span>
All Transactions
</a>
</li>
<li>
<hr>
</li>
</ul>
</li>
</ul>-->

                            <ul class='navbar-nav ml-0 mr-0 header-right-side header-logged-user h-mobile-center-menu'>
                                <li class='nav-item dropdown'>
                                    <a class='nav-link login_text nav-login-btn dropdown-toggle nav-user-link'
                                        data-toggle='dropdown' href='javascript:void(0)'>
                                        <span class="font-weight-bold px-1 mr-lg-2 ml-2 ml-lg-0"><?php echo ucfirst($user->first_name) .' '. ucfirst($user->last_name); ?></span>
                                        
                                        <?php
                                            if ($user->gender == 'Male')
                                                $img = url('images/male.png');
                                            else if ($user->gender == 'Female')
                                                $img = url('images/female.png');
                                            else
                                                $img = url('images/neutral.png');
                                            if (!empty($user->profile_image)) $img = url('images/profile_images/' . $user->profile_image);
                                            else if (!empty($user->avatar)) $img = $user->avatar;
                                            ?>
                                        <picture>
                                            <source srcset='<?php echo $img; ?>' type='image/svg+xml'>
                                            <img src="<?php echo $img; ?>" alt="User" style="border-radius:50%;" />
                                        </picture>
                                    </a>
                                    <ul class='dropdown-menu user-dropdown-menu'>
                                        <!-- / Little information user -->
                                        <!-- / Profile link -->
                                        <li class='dropdown-item'>
                                            <a class='dropdown-link' href='<?php echo url('dashboard'); ?>'>
                                                <?php
                                                    
                                                        $img = url('images/24-small-bag.png');
                                                    ?>
                                                <img src="<?php echo $img; ?>" alt="User"
                                                    style="border-radius:50%; max-width:20px; margin-bottom:2px; margin-right:2px;" />
                                                <?php echo trans('common.my_dashboard'); ?>
                                            </a>
                                        </li>

                                        <li class='dropdown-item'>
                                            <a class='dropdown-link' href='<?php echo url('personal-information'); ?>'>
                                                <?php
                                                    if ($user->gender == 'Male')
                                                        $img = url('images/male.png');
                                                    else if ($user->gender == 'Female')
                                                        $img = url('images/female.png');
                                                    ?>
                                                <img src="<?php echo $img; ?>" alt="User"
                                                    style="border-radius:50%; max-width:20px; margin-bottom:2px; margin-right:2px;" />
                                                <?php echo trans('common.my_profile'); ?>
                                            </a>
                                        </li>
                                        <!-- / End profile link -->
                                        <!-- / Settings link -->
                                        <li class='dropdown-item'>
                                            <a class='dropdown-link' href='<?php echo url('my-rides'); ?>'>
                                                <img src="<?php echo url('images/29-Sedan.png'); ?>" alt="User"
                                                    style="border-radius:50%; max-width:20px; margin-bottom:2px; margin-right:2px;" />
                                                <?php echo trans('common.my_rides'); ?>
                                            </a>
                                        </li>
                                        <!-- / End Settings link -->
                                        <li>
                                            <hr>
                                        </li>
                                        <!-- / Sign out link -->
                                        <li class='dropdown-item'>
                                            <a class='dropdown-link' href='<?php echo url('signout'); ?>'>
                                                <img src="<?php echo url('images/19-X-inside-circle-3.png'); ?>"
                                                    alt="User"
                                                    style="border-radius:50%; max-width:20px; margin-bottom:2px; margin-right:2px;" />
                                                <?php echo trans('common.signout'); ?>
                                            </a>
                                        </li>
                                        <!-- / End Sign out link -->
                                    </ul>
                                </li>
                            </ul>
                            <?php } ?>
                            <?php if ($user_id == 0) { ?>
                            <ul class='navbar-nav ml-auto mr-0 header-right-side h-mobile-center-menu'>
                                <li class='nav-item'>
                                    <a class='nav-link login_text nav-login-btn' href='<?php echo url('login'); ?>'><img
                                            src="<?php echo url('images/2-log-in-sign-up-no-circle.png') ?>"
                                            style="max-width:15px; max-height:15px; margin-bottom:2px;">
                                        <?php echo trans('common.login_signup'); ?>
                                    </a>
                                </li>
                            </ul>
                            <?php } ?>

                            <form class='form-inline my-2 my-lg- nav-right-section h-mobile-center-form'>
                                <div class="language-hp form-country-selector">
                                    <ul class="nav-link login_text nav-login-btn form-control "
                                        style="padding-top: 0.3em; height: 37.5px; margin-bottom: 0rem;">


                                        <?php

                                        $language = "en";

                                        if (isset($_GET['lang'])) {
                                            // code...
                                            $language = $_GET['lang'];
                                        }

                                        ?>







                                        <li class='nav-item dropdown'>
                                            <a class='nav-link flag-nav-link p-0 pt-1' data-toggle='dropdown'
                                                href='javascript:void(0)'>
                                                <?php if ($language == 'en') { ?>
                                                <img src="<?php echo url('images/british_flag.png'); ?>"
                                                    style="width: 19px; height: 12px; margin-bottom: 1px;" /> English
                                                <?php } else if ($language == 'fr') { ?>
                                                <img src="<?php echo url('images/french.jpg'); ?>"
                                                    style="width: 19px; height: 12px; margin-bottom: 1px;" /> Français
                                                <?php } else if ($language == 'es') { ?>
                                                <img src="<?php echo url('images/spanish.jpg'); ?>"
                                                    style="width: 19px; height: 12px; margin-bottom: 1px;" /> Español
                                                <?php } ?>
                                            </a>
                                            <ul class='dropdown-menu'>
                                                <!-- <a href='<?php echo url('setlocale/en'); ?>'> -->

                                                <a href="javascript:void(0)" class="language_select" data-language='en'>

                                                    <li class='dropdown-item'>
                                                        <img src="<?php echo url('images/british_flag.png'); ?>"
                                                            style="width: 19px; height: 12px; margin-bottom: 1px;" />
                                                        English
                                                    </li>
                                                </a>
                                                <!-- <a href='<?php echo url('setlocale/fr'); ?>'> -->
                                                <a href="javascript:void(0)" class="language_select" data-language='fr'>
                                                    <li class='dropdown-item'>
                                                        <img src="<?php echo url('images/french.jpg'); ?>"
                                                            style="width: 19px; height: 13px; margin-bottom: 2px;" />
                                                        Français
                                                    </li>
                                                </a>
                                                <!-- <a href='<?php echo url('setlocale/es'); ?>'> -->
                                                <a href="javascript:void(0)" class="language_select" data-language='es'>
                                                    <li class='dropdown-item'>
                                                        <img src="<?php echo url('images/spanish.jpg'); ?>"
                                                            style="width: 19px; height: 13px; margin-bottom: 2px;" />
                                                        Español
                                                    </li>
                                                </a>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- =====================Navbar_end======================= -->

        </div>