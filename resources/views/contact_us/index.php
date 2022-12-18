<?php include(app_path().'/common/header.php'); ?>
<style>
        .bg-light2 {
            padding-top: 15px;
            margin-bottom: 15px;
    background-color: #f8f9fa !important;
}
        
        .btn-outline-default{
            background: #394d5b;
            color: white;
        }
        
        .form-country-selector {
    max-width: 180px !important;
    padding-right:6px;
        }
    </style>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12'>
<div class='contact__how__can contact-section'>
<div class='row'>
<div class='col-12 col-md-11 col-lg-9 col-xl-8 mr-auto ml-auto'>
<h3 class='text-center f-700 mb-4'>Hello, how can we help?</h3>
<div class='ask__outer mb-5'>
<div class='ask__question'>
<div class='form-group mb-2'>
<div class='input-group input-group-lg'>
<div class='input-group-prepend'>
<span class='input-group-text'>
<span class='fa fa-search'></span>
</span>
</div>
<input class='form-control form-control-lg' placeholder='Ask a question...'>
<div class='input-group-append'>
<button class='btn btn-primary input-group-addon'>
Search
</button>
</div>
</div>
</div>
</div>
<div class='ask__suggestion'>
<div class='row'>
<div class='col-12 col-md-10 col-lg-9 col-xl-8 mr-auto ml-auto text-center'>
<p class='mb-0 text-grey-1'>or choose a category to quick find the help you need</p>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
<div class='contact__us contact-section mb-5'>
<div class='row'>
<div class='col-12 col-md-11 col-lg-9 col-xl-8 mr-auto ml-auto'>
<h5 class='text-center mb-4'>Contact us</h5>
<div class='contact__box'>
<div class='row bg-light2'>
<div class='col-12 col-md-6'>
<label class='mb-0'>Mailing address:</label>
</div>
<div class='col-12 col-md-6'>
<p class="mb-0">1051 Blvd Decarie</p>
<p class="mb-0">P.O Box, 53555 NORGATE</p>
<p class="mb-0">Montreal - QC</p>
<p class="">Canada</p>
</div>
</div>
<div class='row'>
<div class='col-12 col-md-6'>
<label class='mb-0'>Toll free:</label>
</div>
<div class='col-12 col-md-6'>
<p class=''>1-877-333 (Toll free within canada and USA)</p>
</div>
</div>
<div class='row bg-light2'>
<div class='col-12 col-md-6'>
<label class='mb-0'>Telephone:</label>
</div>
<div class='col-12 col-md-6'>
<p>1-877-333 (Toll free within canada and USA)</p>
</div>
</div>
<div class='row'>
<div class='col-12 col-md-6'>
<label class='mb-0'>e-mail:</label>
</div>
<div class='col-12 col-md-6'>
<p>example@example.com</p>
</div>
</div>
<div class='row bg-light2'>
<div class='col-12 col-md-6'>
<label class='mb-0'>Website:</label>
</div>
<div class='col-12 col-md-6'>
<p>www.example.com</p>
</div>
</div>
<div class='row mt-2'>
<div class='col-12'>
<h6 class='sub-title mb-4 mt-3'>E-mail addresses bt department:</h6>
<div class='row bg-light2'>
<div class='col-12 col-md-6'>
<label>General inquiries</label>
</div>
<div class='col-12 col-md-6'>
<p>example@example.com</p>
</div>
</div>
<div class='row'>
<div class='col-12 col-md-6'>
<label>Sales department</label>
</div>
<div class='col-12 col-md-6'>
<p>example@example.com</p>
</div>
</div>
<div class='row bg-light2'>
<div class='col-12 col-md-6'>
<label>Join at Ride for share</label>
</div>
<div class='col-12 col-md-6'>
<p>employmentshare.com</p>
</div>
</div>
<div class='row'>
<div class='col-12 col-md-6'>
<label>Office hours</label>
</div>
<div class='col-12 col-md-6'>
<p>Everyday from 9 am to 9pm EST</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class='contact__touch'>
<div class='row'>
<div class='col-12 col-md-10 col-lg-9 col-xl-8 mr-auto ml-auto'>
<h5 class='text-center mb-4'>Get in touch</h5>
<div class='contact__touch pt-4 pb-3 pl-5 pr-5 bg-light'>
<div class='row'>
<div class='container-fluid'>
<form action='' method='get' onsubmit="return submitUserForm();">
<div class='form-group'>
<input class='form-control' name='contact_name' placeholder='Your name and email *' type='text' required>
</div>
<div class='form-group'>
<input class='form-control' name='contact_subject' placeholder='Subject *' type='text' required>
</div>
<div class='form-group'>
<textarea class='form-control' name='contact_message' placeholder='Message...' rows="6" required></textarea>
</div>
    <div class="g-recaptcha" data-sitekey="6Lcy0OIUAAAAAI0mxFvI6GEE9Mr_bz260YGcDosT" data-callback="enableBtn" style="display: inline-block;"></div>
    <div id="g-recaptcha-error"></div>
<div class='form-group text-center mb-0 mt-2'>
<button class='btn btn-deafult btn-outline-default btn-radius btn-lg pl-5 pr-5'>
Submit
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

</div>
<script>
function submitUserForm() {
    var response = grecaptcha.getResponse();
    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
    return true;
}
function verifyCaptcha() {
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>
<?php include(app_path().'/common/footer.php'); ?>
