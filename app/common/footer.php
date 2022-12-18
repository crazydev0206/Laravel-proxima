<style>
.footer-social-media li a {
    background: #fff;
    color: #2d4653;
    border-radius: 25px !important;
    padding: 6px 10px;
    text-decoration: none;
    -webkit-transition: all 0.3s ease 0.03s;
    transition: all 0.3s ease 0.03s;
}

.footer-social-media li a:hover,
.footer-social-media li a:active,
.footer-social-media li a:focus,
.footer-social-media li a:active:focus {
    background: #f7f7f7;
    text-decoration: none;
}

.footer-social-media li a {
    background: #fff;
    color: #2d4653;
    border-radius: 25px;
}

.footer-social-media li a:hover,
.footer-social-media li a:active,
.footer-social-media li a:focus,
.footer-social-media li a:active:focus {
    -webkit-transition: all 0.3s ease 0.03s;
    transition: all 0.3s ease 0.03s;
}

.footer-social-media li a.fr-facebook:hover,
.footer-social-media li a.fr-facebook:active,
.footer-social-media li a.fr-facebook:focus,
.footer-social-media li a.fr-facebook:active:focus {
    background: #4c67b3;
    color: #fff;
}

.footer-social-media li a.fr-instagram:hover,
.footer-social-media li a.fr-instagram:active,
.footer-social-media li a.fr-instagram:focus,
.footer-social-media li a.fr-instagram:active:focus {
    color: #fff;
    background-color: #604cec;
    background: center/contain url("<?php echo url('images/instagram-background.png'); ?>");
}

.footer-social-media li a.fr-youtube:hover,
.footer-social-media li a.fr-youtube:active,
.footer-social-media li a.fr-youtube:focus,
.footer-social-media li a.fr-youtube:active:focus {
    background: #ff0002;
    color: #fff;
}

.footer-social-media li a.fr-twitter:hover,
.footer-social-media li a.fr-twitter:active,
.footer-social-media li a.fr-twitter:focus,
.footer-social-media li a.fr-twitter:active:focus {
    background: #5eaade;
    color: #fff;
}

.footer-text {

    margin-top: -15px !important;
    line-height: 5px !important;
    text-decoration: none !important;
}

.foot_text {

    line-height: 10px !important;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<div style="position:fixed; right:0px; bottom:30px; background:rgba(235, 235, 235, 0.80); padding:10px; cursor:pointer; z-index:777; border:1px solid #777; display:none;"
    onclick="scroll_top()" id="scroll_anchor">
    <i class="fa fa-arrow-up"></i>
</div>

<div class='footer__content'>
    <!-- Footer -->
    <footer class='page-footer font-small mdb-color pt-4'>
        <!-- Footer Links -->
        <div class='container text-center text-md-left'>
            <!-- Footer links -->
            <div class='row text-center text-md-left mt-3 pb-3'>
                <!-- Grid column -->
                <div class='col-md-3 col-lg-3 col-xl-3 mx-auto mt-3'>
                    <h6 class='text-uppercase mb-4 font-weight-bold text-center'>
                        <a href="<?php echo url('/'); ?>"><img src="<?php echo url('images/PROXIMARIDE.png'); ?>"
                                alt="ProximaRide" style="max-width:100px;" /></a>
                    </h6>
                    <p class="text-left"><?php echo trans('common.we_proud'); ?></p>
                    <!-- / Store information -->
                    <ul class='footer__store ul__list d-none'>
                        <li>
                            <a href='#'>
                                <img src="/images/store/google-play.png" alt="Google play" />
                            </a>
                        </li>
                        <li>
                            <a href='#'>
                                <img src="/images/store/app-store.png" alt="App store" />
                            </a>
                        </li>
                    </ul>
                    <!-- / End store information -->
                </div>
                <!-- Grid column -->
                <hr class='w-100 clearfix d-md-none'>
                <!-- Grid column -->
                <div class='col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 footer-menu-box'>

                    <!-- <h6 style="color:#fff !important;font-weight: 700;margin-bottom: 20px !important;">Useful links</h6> -->

                    <?php if ($user_id == 0) { ?>
                    <p class="foot_text"><a class='footer-text footer-heading' href='<?php echo url('signup'); ?>'
                            style="font-weight: 500; font-size: 15px;"><?php echo trans('common.signup'); ?></a></p>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('signin'); ?>'><?php echo trans('common.login'); ?></a>
                    </p>
                    <?php } else { ?>
                    <p class="foot_text"><a class='footer-text' href='<?php echo url('personal-information'); ?>'
                            style="font-weight: 500; font-size: 15px;"><?php echo trans('common.my_profile'); ?></a></p>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('my-rides'); ?>'><?php echo trans('common.my_rides'); ?></a>
                    </p>
                    <?php } ?>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('post-ride'); ?>'><?php echo trans('common.post_ride'); ?></a>
                    </p>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('search-ride'); ?>'><?php echo trans('common.find_ride'); ?></a>
                    </p>
                </div>
                <!-- Grid column -->
                <hr class='w-100 clearfix d-md-none'>
                <!-- Grid column -->
                <div class='col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 footer-menu-box'>
                    <h6 style="color:#fff !important;font-weight: 700;margin-bottom: 20px !important;">How it works</h6>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('drivers'); ?>'><?php echo trans('common.for_drivers'); ?></a>
                    </p>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('passengers') ?>'><?php echo trans('common.for_passengers'); ?></a>
                    </p>
                    <p class="foot_text">
                        <a class='footer-text' href='<?php echo url('help'); ?>'><?php echo trans('common.help'); ?></a>
                    </p>
                </div>
                <!-- Grid column -->
                <hr class='w-100 clearfix d-md-none'>
                <!-- Grid column -->
                <div class='col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 footer-menu-box'>
                    <!-- <h6 style="color:#fff !important;font-weight: 700;margin-bottom: 20px !important;">Contact us</h6> -->
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('contact-us'); ?>'><?php echo trans('common.contact_support'); ?></a>
                    </p>

                    <p class="foot_text"><a class='footer-text footer-heading' href='<?php echo url('students'); ?>'
                            style="font-weight: 500; font-size: 15px;"><?php echo trans('common.students'); ?></a></p>

                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('partners'); ?>'><?php echo trans('common.partners'); ?></a>
                    </p>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('news'); ?>'><?php echo trans('common.media'); ?></a>
                    </p>
                </div>
                <!-- Grid column -->
                <hr class='w-100 clearfix d-md-none'>
                <!-- Grid column -->
                <div class='col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 footer-menu-box'>
                    <!-- <h6 style="color:#fff !important;font-weight: 700;margin-bottom: 20px !important;">Terms</h6> -->
                    <p class="foot_text"><a class='footer-text footer-heading'
                            href='<?php echo url('terms-of-service'); ?>'
                            style="font-weight: 500; font-size: 15px;"><?php echo trans('common.terms_services'); ?></a>
                    </p>
                    <p class="foot_text"><a class='footer-text'
                            href='<?php echo url('terms-of-use'); ?>'><?php echo trans('common.terms_use'); ?></a></p>
                    <p class="foot_text">
                        <a class='footer-text'
                            href='<?php echo url('privacy-policy'); ?>'><?php echo trans('common.privacy_policy'); ?></a>
                    </p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Footer links -->
            <hr>
            <!-- Grid row -->
            <div class='row d-flex align-items-center'>
                <!-- Grid column -->
                <div class='col-md-7 col-lg-8'>
                    <!-- Copyright -->
                    <p class='text-center text-md-left'>© 2022 ProximaRide.
                        <?php echo trans('common.rights_reserved'); ?></p>
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class='col-md-5 col-lg-4 ml-lg-0'>
                    <!-- Social buttons -->
                    <div class='text-center text-md-right'>
                        <ul class='list-unstyled list-inline footer-social-media'>
                            <li class='list-inline-item p-0' style="background-color:transparent;">
                                <a class='btn-floating btn-sm rgba-white-slight mx-1 fr-facebook'
                                    href="<?php echo $site->facebook; ?>" target="_blank">
                                    <!--<img src="<?php echo url('images/2-framed-facebook.png'); ?>" style="max-width:30px; border-top-left-radius:50%; border-top-right-radius:50%;">-->
                                    <i aria-hidden='true' class='fa fa-facebook'></i>
                                </a>
                            </li>
                            <li class='list-inline-item'>
                                <a class='btn-floating btn-sm rgba-white-slight mx-1 fr-instagram'
                                    href="<?php echo $site->instagram; ?>" target="_blank">
                                    <!--<img src="<?php echo url('images/2-framed-instagram.png'); ?>" style="max-width:30px; border-top-left-radius:50%; border-top-right-radius:50%;">-->
                                    <i aria-hidden='true' class='fa fa-instagram'></i>
                                </a>
                            </li>
                            <li class='list-inline-item'>
                                <a class='btn-floating btn-sm rgba-white-slight mx-1 fr-youtube'
                                    href="<?php echo $site->youtube; ?>" target="_blank">
                                    <!--<img src="<?php echo url('images/2-framed-youtube.png'); ?>" style="max-width:30px; border-top-left-radius:50%; border-top-right-radius:50%;">-->
                                    <i aria-hidden='true' class='fa fa-youtube-play'></i>
                                </a>
                            </li>
                            <li class='list-inline-item'>
                                <a class='btn-floating btn-sm rgba-white-slight mx-1 fr-twitter'
                                    href="<?php echo $site->twitter; ?>" target="_blank">
                                    <!--<img src="<?php echo url('images/2-framed-twitter.png'); ?>" style="max-width:30px; border-top-left-radius:50%; border-top-right-radius:50%;">-->
                                    <i aria-hidden='true' class='fa fa-twitter'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        <!-- Footer Links -->
    </footer>
    <!-- Footer -->
    <!-- ===================footer_end=========================== -->
    <!-- popup -->
    <!-- popup -->
    <!-- =====================banner_end===================== -->
    <!--<script src='https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js' type='text/javascript'></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src='<?php echo url('javascripts/libs/jquery.mobile-1.4.5.min.js'); ?>'></script>
    <script src='<?php echo url('plugins/formvalidation/js/FormValidation.min.js'); ?>'></script>
    <script src='<?php echo url('javascripts/libs/popper.min.js'); ?>'></script>
    <script src="<?php echo url('javascripts/libs/bootstrap.4.4.1.min.js'); ?>"></script>


    <script src='<?php echo url('javascripts/libs/gijgo.min.js'); ?>' type='text/javascript'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo url('javascripts/libs/bootstrap-select-country.min.js'); ?>"></script>
    <script src="<?php echo url('javascripts/site.js'); ?>"></script>
    <!-- InputMask -->
    <script src="<?php echo url('plugins/input-mask/jquery.inputmask.js'); ?>"></script>
    <script src="<?php echo url('plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
    <script src="<?php echo url('plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <!-- <script type="module" src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/ionic.js"></script> -->
    <script>
    $("[data-mask]").inputmask();


    $(function() {
        $("#dpicker").datepicker({
            dateFormat: 'yy/mm/dd'
        });
    });

    $(document).ready(function() {
        var dateToday = new Date();
        /* $('#datepicker').datepicker({
           uiLibrary: 'bootstrap4',
             format: 'dd-mm-yyyy',
             minDate: dateToday,
         });*/




        // $(".countrypicker").selectpicker();
        // $('.countrypicker').countrypicker({
        //     flag: true
        //   });
    });
    </script>
    <!-- calander_end -->


    <script src="<?php echo url('javascripts/common.js'); ?>" type="text/javascript"></script>
    <script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    function onYouTubeIframeAPIReady() {
        window.initiateYouTubeFunctions();
    }

    function scroll_top() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
        //var scrollPos =  $("header").offset().top;
        //$(window).scrollTop(scrollPos);
    }

    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('#scroll_anchor').fadeIn();
            } else {
                $('#scroll_anchor').fadeOut();
            }
        });
    });
    </script>

    <script type="text/javascript">
    var onloadCallback = function() {
        //alert("grecaptcha is ready!");
    };

    window.captcha = [];

    function myCallBack() {
        var captchas = document.getElementsByClassName("g-recaptcha");
        for (var i = 0; i < captchas.length; i++) {
            window.captcha[i] = grecaptcha.render(captchas[i], {
                'sitekey': '6LfAGWciAAAAAJUGyZjA1fssjZars2CVnw3JBdWv'
            });
        }
    }

    function swap_locations() {
        var ride_departure = $("#ride-departure").val();
        var ride_departure_lat = $("#ride-departure-lat").val();
        var ride_departure_lng = $("#ride-departure-lng").val();
        var departure_place = $("#departure_place").val();
        var departure_route = $("#departure_route").val();
        var departure_zipcode = $("#departure_zipcode").val();
        var departure_city = $("#departure_city").val();
        var departure_state = $("#departure_state").val();
        var departure_country = $("#departure_country").val();

        var ride_destination = $("#ride-destination").val();
        var ride_destination_lat = $("#ride-destination-lat").val();
        var ride_destination_lng = $("#ride-destination-lng").val();
        var destination_place = $("#destination_place").val();
        var destination_route = $("#destination_route").val();
        var destination_zipcode = $("#destination_zipcode").val();
        var destination_city = $("#destination_city").val();
        var destination_state = $("#destination_state").val();
        var destination_country = $("#destination_country").val();

        $("#ride-departure").val(ride_destination);
        $("#ride-departure-lat").val(ride_destination_lat);
        $("#ride-departure-lng").val(ride_destination_lng);
        $("#departure_place").val(destination_place);
        $("#departure_route").val(destination_route);
        $("#departure_zipcode").val(destination_zipcode);
        $("#departure_city").val(destination_city);
        $("#departure_state").val(destination_state);
        $("#departure_country").val(destination_country);

        $("#ride-destination").val(ride_departure);
        $("#ride-destination-lat").val(ride_departure_lat);
        $("#ride-destination-lng").val(ride_departure_lng);
        $("#destination_place").val(departure_place);
        $("#destination_route").val(departure_route);
        $("#destination_zipcode").val(departure_zipcode);
        $("#destination_city").val(departure_city);
        $("#destination_state").val(departure_state);
        $("#destination_country").val(departure_country);

    }


    function check_date(th) {
        var date = $(th).val();
        var value = date.split("-");

        if (value[0] == undefined || value[1] == undefined || value[2] == undefined) $(th).val('');
        else {
            var d = parseInt(value[0], 10),
                m = parseInt(value[1], 10),
                y = parseInt(value[2], 10);

            if (d > 31) $(th).val('');
            else if (m > 12) $(th).val('');
            else if (y < 2020) $(th).val('');
        }

        //alert(date);
        /*if (new Date('dd-mm-yyyy', date)) {
            //Valid date
            //alert('valid');
        } else {
            //Not a valid date
            $(th).val('');
        }*/
    }



    function hide_warning(warning) {
        var formData = new FormData();
        var token = '<?php echo csrf_token(); ?>';
        formData.append('_token', token);
        formData.append('warning', warning);

        $.ajax({
            url: "<?php echo url('hide-warning') ?>",
            type: "POST",
            data: formData,
            beforeSend: function() { //alert('sending');
            },
            contentType: false,
            processData: false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                if (!data.success) {} else {
                    // ALL GOOD! just show the success message!
                }
            },
            error: function() {
                //error
            }
        });
    }
    </script>



    <script type="text/javascript">
    $(".language_select").click(function() {

        var lang = $(this).attr('data-language');

        var currentUrl = '<?php echo url()->current(); ?>' + '?lang=' + lang;

        location.href = currentUrl;


    });
    </script>


<script>
    const result = '<?php echo Session::has('success') ? 'success' : (Session::has('error') ? 'error' : '');?>';
    const message = '<?php echo Session::has('success') ? Session::get('success') : (Session::has('error') ? Session::get('error') : '');?>';

    if(result == 'error'){
        showErrorDialog(message, <?php echo Session::forget('error')?>);
    }
    
    if(result == 'success'){
        showSuccessDialog(message, <?php echo Session::forget('success')?>)
    }
</script>
</div>
<!-- / Google MAP APIS -->

</div>
</body>

</html>