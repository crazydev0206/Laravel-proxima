<?php include(app_path() . '/common/header.php'); ?>


<div class="container">

	<div class="row">

		<div class="col-md-6 offset-md-3">
			<div style="display: flex; justify-content:start; align-items:start;">
				<div class="text-left">
					<h3 class='f-700 mb-1'><?php echo trans('account.step1of5'); ?></h3>
					<p class="text-danger font-weight-bold">(*) Indicates required fields</p>
				</div>
			</div>

			<div class="row" style="margin-top:30px;">

				<div class="col-md-6">
					<div class="form-group">

						<label for='datepicker'><?php echo trans('account.first_name'); ?> <font style="color:red;">*</font></label>

						<input id="fn" class='form-control form-group-border' name='first_name' placeholder='' required type="text" value="<?php echo $user->first_name; ?>" style="border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;">

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">

						<label for='datepicker'><?php echo trans('account.last_name'); ?> <font style="color:red;">*</font></label>

						<input id="ln" class='form-control form-group-border' name='last_name' placeholder='' required type="text" value="<?php echo $user->last_name; ?>" style="border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;">

					</div>
				</div>

			</div>

			<div class="row mb-3">

				<div class="col-md-12">

					<label for='gender'><?php echo trans('account.gender'); ?> <font style="color:red;">*</font></label>

					<ul class='ul__list ul__list--horizontal'>
						<li>
							<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-smoking-type-yes'>
								<div class='radio-element'>
									<input id='ride-smoking-type-yes' name='gender' type='radio' value='Male' <?php if ($user->gender == 'Male') echo 'checked'; ?>>
									<span class='checkbox__all'>
										<span class='select-element checkbox__element'>
											<span class='toggle'></span>
										</span>
									</span>
								</div>
								<div class='radio-text'>
									<?php echo trans('account.male'); ?>
								</div>
							</label>
						</li>
						<li>
							<label class='checkbox__square checkbox__round checkbox__radio--1'>
								<div class='radio-element'>
									<input id='ride-smoking-type-no' name='gender' type='radio' value='Female' <?php if ($user->gender == 'Female') echo 'checked'; ?> class="filter_field">
									<span class='checkbox__all'>
										<span class='select-element checkbox__element'>
											<span class='toggle'></span>
										</span>
									</span>
								</div>
								<div class='radio-text'>
									<?php echo trans('account.female'); ?>
								</div>
							</label>
						</li>
						<li>
							<label class='checkbox__square checkbox__round checkbox__radio--1' for='ride-smoking-type-no2'>
								<div class='radio-element'>
									<input id='ride-smoking-type-no2' name='gender' type='radio' value='Prefer not to say' <?php if ($user->gender == 'Prefer not to say') echo 'checked'; ?> class="filter_field">
									<span class='checkbox__all'>
										<span class='select-element checkbox__element'>
											<span class='toggle'></span>
										</span>
									</span>
								</div>
								<div class='radio-text'>
									<?php echo trans('account.prefer_not_to_say'); ?>
								</div>
							</label>
						</li>
					</ul>
				</div>

			</div>


			<div class="row">

				<div class="col-md-12">

					<label><?php echo trans('account.date_birth'); ?> <font style="color:red;">*</font></label>

				</div>

				<div class="col-md-4">
					<select class='form-control form-group-border' id='year' placeholder='YYYY' name="year" autocomplete="no" autofill="no" style="width:100%; display:inline-block;border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;">
						<option value="">YYYY</option>
						<?php for ($i = 2015; $i >= 1950; $i--) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-md-4">

					<select class='form-control form-group-border' id='month' placeholder='MM' name="month" autocomplete="no" autofill="no" style="border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;">
						<option value="">MM</option>
						<?php for ($i = 1; $i <= 12; $i++) { ?>
							<option value="<?php if ($i < 10) echo '0';
											echo $i; ?>"><?php if ($i < 10) echo '0';
															echo $i; ?></option>
						<?php } ?>
					</select>

				</div>

				<div class="col-md-4">
					<select class='form-control form-group-border' id='date' placeholder='DD' name="date" style="border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;">
						<option value="">DD</option>
						<?php for ($i = 1; $i <= 31; $i++) { ?>
							<option value="<?php if ($i < 10) echo '0';
											echo $i; ?>"><?php if ($i < 10) echo '0';
															echo $i; ?></option>
						<?php } ?>
					</select>
				</div>

			</div>


			<div class="row">

				<div class="col-md-12">


					<div class='form-group mt-3'>
						<label for='datepicker'><?php echo trans('account.country'); ?> <font style="color:red;">*</font></label>
						<select class='form-control form-group-border' name="country" style="border:1px solid #ced4da !important;border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;" id="country">
							<option value=""><?php echo trans('account.please_select'); ?></option>
							<option value="United States" data-code="1">United States</option>
							<option value="Afganistan" data-code="93">Afghanistan</option>
							<option value="Albania" data-code="355">Albania</option>
							<option value="Algeria" data-code="213">Algeria</option>
							<option value="American Samoa">American Samoa</option>
							<option value="Andorra" data-code="376">Andorra</option>
							<option value="Angola" data-code="244">Angola</option>
							<option value="Anguilla" data-code="1264">Anguilla</option>
							<option value="Antigua & Barbuda" data-code="1268">Antigua & Barbuda</option>
							<option value="Argentina" data-code="54">Argentina</option>
							<option value="Armenia" data-code="374">Armenia</option>
							<option value="Aruba" data-code="297">Aruba</option>
							<option value="Australia" data-code="61">Australia</option>
							<option value="Austria" data-code="43">Austria</option>
							<option value="Azerbaijan" data-code="994">Azerbaijan</option>
							<option value="Bahamas" data-code="1242">Bahamas</option>
							<option value="Bahrain" data-code="973">Bahrain</option>
							<option value="Bangladesh" data-code="880">Bangladesh</option>
							<option value="Barbados" data-code="1246">Barbados</option>
							<option value="Belarus" data-code="375">Belarus</option>
							<option value="Belgium" data-code="32">Belgium</option>
							<option value="Belize" data-code="501">Belize</option>
							<option value="Benin" data-code="229">Benin</option>
							<option value="Bermuda" data-code="1441">Bermuda</option>
							<option value="Bhutan" data-code="975">Bhutan</option>
							<option value="Bolivia" data-code="591">Bolivia</option>
							<option value="Bonaire" data-code="599">Bonaire</option>
							<option value="Bosnia & Herzegovina" data-code="387">Bosnia & Herzegovina</option>
							<option value="Botswana" data-code="267">Botswana</option>
							<option value="Brazil" data-code="55">Brazil</option>
							<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
							<option value="Brunei" data-code="673">Brunei</option>
							<option value="Bulgaria" data-code="359">Bulgaria</option>
							<option value="Burkina Faso" data-code="226">Burkina Faso</option>
							<option value="Burundi" data-code="257">Burundi</option>
							<option value="Cambodia" data-code="855">Cambodia</option>
							<option value="Cameroon" data-code="237">Cameroon</option>
							<option value="Canada" data-code="1" selected>Canada</option>
							<option value="Canary Islands">Canary Islands</option>
							<option value="Cape Verde" data-code="238">Cape Verde</option>
							<option value="Cayman Islands" data-code="1345">Cayman Islands</option>
							<option value="Central African Republic" data-code="236">Central African Republic</option>
							<option value="Chad" data-code="235">Chad</option>
							<option value="Channel Islands" data-code="44">Channel Islands</option>
							<option value="Chile" data-code="56">Chile</option>
							<option value="China" data-code="86">China</option>
							<option value="Christmas Island" data-code="44">Christmas Island</option>
							<option value="Cocos Island">Cocos Island</option>
							<option value="Colombia" data-code="57">Colombia</option>
							<option value="Comoros" data-code="269">Comoros</option>
							<option value="Congo" data-code="242">Congo</option>
							<option value="Cook Islands" data-code="682">Cook Islands</option>
							<option value="Costa Rica" data-code="506">Costa Rica</option>
							<option value="Cote DIvoire">Cote DIvoire</option>
							<option value="Croatia" data-code="385">Croatia</option>
							<option value="Cuba" data-code="53">Cuba</option>
							<option value="Curaoco" data-code="599">Curacao</option>
							<option value="Cyprus" data-code="90392">Cyprus</option>
							<option value="Czech Republic" data-code="42">Czech Republic</option>
							<option value="Denmark" data-code="45">Denmark</option>
							<option value="Djibouti" data-code="253">Djibouti</option>
							<option value="Dominica" data-code="1809">Dominica</option>
							<option value="Dominican Republic" data-code="1809">Dominican Republic</option>
							<option value="East Timor" data-code="670">East Timor</option>
							<option value="Ecuador" data-code="593">Ecuador</option>
							<option value="Egypt" data-code="20">Egypt</option>
							<option value="El Salvador" data-code="503">El Salvador</option>
							<option value="Equatorial Guinea" data-code="240">Equatorial Guinea</option>
							<option value="Eritrea" data-code="291">Eritrea</option>
							<option value="Estonia" data-code="372">Estonia</option>
							<option value="Ethiopia" data-code="251">Ethiopia</option>
							<option value="Falkland Islands" data-code="500">Falkland Islands</option>
							<option value="Faroe Islands" data-code="298">Faroe Islands</option>
							<option value="Fiji" data-code="679">Fiji</option>
							<option value="Finland" data-code="358">Finland</option>
							<option value="France" data-code="33">France</option>
							<option value="French Guiana" data-code="594">French Guiana</option>
							<option value="French Polynesia" data-code="689">French Polynesia</option>
							<option value="French Southern Ter" data-code="262">French Southern Ter</option>
							<option value="Gabon" data-code="241">Gabon</option>
							<option value="Gambia" data-code="220">Gambia</option>
							<option value="Georgia" data-code="7880">Georgia</option>
							<option value="Germany" data-code="49">Germany</option>
							<option value="Ghana" data-code="233">Ghana</option>
							<option value="Gibraltar" data-code="350">Gibraltar</option>
							<option value="Great Britain">Great Britain</option>
							<option value="Greece" data-code="30">Greece</option>
							<option value="Greenland" data-code="299">Greenland</option>
							<option value="Grenada" data-code="1473">Grenada</option>
							<option value="Guadeloupe" data-code="590">Guadeloupe</option>
							<option value="Guam" data-code="671">Guam</option>
							<option value="Guatemala" data-code="502">Guatemala</option>
							<option value="Guinea" data-code="224">Guinea</option>
							<option value="Guyana" data-code="592">Guyana</option>
							<option value="Haiti" data-code="509">Haiti</option>
							<option value="Hawaii" data-code="1">Hawaii</option>
							<option value="Honduras" data-code="504">Honduras</option>
							<option value="Hong Kong" data-code="852">Hong Kong</option>
							<option value="Hungary" data-code="36">Hungary</option>
							<option value="Iceland" data-code="354">Iceland</option>
							<option value="Indonesia" data-code="62">Indonesia</option>
							<option value="India" data-code="91">India</option>
							<option value="Iran" data-code="98">Iran</option>
							<option value="Iraq" data-code="964">Iraq</option>
							<option value="Ireland" data-code="353">Ireland</option>
							<option value="Isle of Man">Isle of Man</option>
							<option value="Israel" data-code="972">Israel</option>
							<option value="Italy" data-code="39">Italy</option>
							<option value="Jamaica" data-code="1876">Jamaica</option>
							<option value="Japan" data-code="81">Japan</option>
							<option value="Jordan" data-code="962">Jordan</option>
							<option value="Kazakhstan" data-code="7">Kazakhstan</option>
							<option value="Kenya" data-code="254">Kenya</option>
							<option value="Kiribati" data-code="686">Kiribati</option>
							<option value="Korea North" data-code="850">Korea North</option>
							<option value="Korea Sout" data-code="82">Korea South</option>
							<option value="Kuwait" data-code="965">Kuwait</option>
							<option value="Kyrgyzstan" data-code="996">Kyrgyzstan</option>
							<option value="Laos" data-code="856">Laos</option>
							<option value="Latvia" data-code="371">Latvia</option>
							<option value="Lebanon" data-code="961">Lebanon</option>
							<option value="Lesotho" data-code="266">Lesotho</option>
							<option value="Liberia" data-code="231">Liberia</option>
							<option value="Libya" data-code="218">Libya</option>
							<option value="Liechtenstein" data-code="417">Liechtenstein</option>
							<option value="Lithuania" data-code="370">Lithuania</option>
							<option value="Luxembourg" data-code="352">Luxembourg</option>
							<option value="Macau" data-code="853">Macau</option>
							<option value="Macedonia" data-code="389">Macedonia</option>
							<option value="Madagascar" data-code="261">Madagascar</option>
							<option value="Malaysia" data-code="60">Malaysia</option>
							<option value="Malawi" data-code="265">Malawi</option>
							<option value="Maldives" data-code="960">Maldives</option>
							<option value="Mali" data-code="223">Mali</option>
							<option value="Malta" data-code="356">Malta</option>
							<option value="Marshall Islands" data-code="692">Marshall Islands</option>
							<option value="Martinique" data-code="596">Martinique</option>
							<option value="Mauritania" data-code="222">Mauritania</option>
							<option value="Mauritius" data-code="230">Mauritius</option>
							<option value="Mayotte" data-code="269">Mayotte</option>
							<option value="Mexico" data-code="52">Mexico</option>
							<option value="Midway Islands">Midway Islands</option>
							<option value="Moldova" data-code="373">Moldova</option>
							<option value="Monaco" data-code="377">Monaco</option>
							<option value="Mongolia" data-code="976">Mongolia</option>
							<option value="Montserrat" data-code="1664">Montserrat</option>
							<option value="Morocco" data-code="212">Morocco</option>
							<option value="Mozambique" data-code="258">Mozambique</option>
							<option value="Myanmar" data-code="95">Myanmar</option>
							<option value="Nambia" data-code="264">Nambia</option>
							<option value="Nauru" data-code="674">Nauru</option>
							<option value="Nepal" data-code="977">Nepal</option>
							<option value="Netherland Antilles" data-code="31">Netherland Antilles</option>
							<option value="Netherlands" data-code="31">Netherlands (Holland, Europe)</option>
							<option value="Nevis" data-code="31">Nevis</option>
							<option value="New Caledonia" data-code="687">New Caledonia</option>
							<option value="New Zealand" data-code="64">New Zealand</option>
							<option value="Nicaragua" data-code="505">Nicaragua</option>
							<option value="Niger" data-code="227">Niger</option>
							<option value="Nigeria" data-code="234">Nigeria</option>
							<option value="Niue" data-code="683">Niue</option>
							<option value="Norfolk Island" data-code="672">Norfolk Island</option>
							<option value="Norway" data-code="47">Norway</option>
							<option value="Oman" data-code="968">Oman</option>
							<option value="Pakistan" data-code="92">Pakistan</option>
							<option value="Palau Island" data-code="680">Palau Island</option>
							<option value="Palestine" data-code="">Palestine</option>
							<option value="Panama" data-code="507">Panama</option>
							<option value="Papua New Guinea" data-code="675">Papua New Guinea</option>
							<option value="Paraguay" data-code="595">Paraguay</option>
							<option value="Peru" data-code="51">Peru</option>
							<option value="Phillipines" data-code="63">Philippines</option>
							<option value="Pitcairn Island">Pitcairn Island</option>
							<option value="Poland" data-code="48">Poland</option>
							<option value="Portugal" data-code="351">Portugal</option>
							<option value="Puerto Rico" data-code="1787">Puerto Rico</option>
							<option value="Qatar" data-code="974">Qatar</option>
							<option value="Republic of Montenegro">Republic of Montenegro</option>
							<option value="Republic of Serbia">Republic of Serbia</option>
							<option value="Reunion" data-code="262">Reunion</option>
							<option value="Romania" data-code="40">Romania</option>
							<option value="Russia" data-code="7">Russia</option>
							<option value="Rwanda" data-code="250">Rwanda</option>
							<option value="St Barthelemy" data-code="590">St Barthelemy</option>
							<option value="St Eustatius" data-code="599">St Eustatius</option>
							<option value="St Helena" data-code="290">St Helena</option>
							<option value="St Kitts-Nevis" data-code="1">St Kitts-Nevis</option>
							<option value="St Lucia" data-code="1">St Lucia</option>
							<option value="St Maarten" data-code="721">St Maarten</option>
							<option value="St Pierre & Miquelon" data-code="508">St Pierre & Miquelon</option>
							<option value="St Vincent & Grenadines" data-code="721">St Vincent & Grenadines</option>
							<option value="Saipan">Saipan</option>
							<option value="Samoa">Samoa</option>
							<option value="Samoa American">Samoa American</option>
							<option value="San Marino" data-code="378">San Marino</option>
							<option value="Sao Tome & Principe" data-code="239">Sao Tome & Principe</option>
							<option value="Saudi Arabia" data-code="966">Saudi Arabia</option>
							<option value="Senegal" data-code="221">Senegal</option>
							<option value="Seychelles" data-code="248">Seychelles</option>
							<option value="Sierra Leone" data-code="232">Sierra Leone</option>
							<option value="Singapore" data-code="65">Singapore</option>
							<option value="Slovakia" data-code="421">Slovakia</option>
							<option value="Slovenia" data-code="386">Slovenia</option>
							<option value="Solomon Islands" data-code="677">Solomon Islands</option>
							<option value="Somalia" data-code="252">Somalia</option>
							<option value="South Africa" data-code="27">South Africa</option>
							<option value="Spain" data-code="34">Spain</option>
							<option value="Sri Lanka" data-code="94">Sri Lanka</option>
							<option value="Sudan" data-code="249">Sudan</option>
							<option value="Suriname" data-code="597">Suriname</option>
							<option value="Swaziland" data-code="268">Swaziland</option>
							<option value="Sweden" data-code="46">Sweden</option>
							<option value="Switzerland" data-code="41">Switzerland</option>
							<option value="Syria" data-code="963">Syria</option>
							<option value="Tahiti">Tahiti</option>
							<option value="Taiwan" data-code="886">Taiwan</option>
							<option value="Tajikistan" data-code="7">Tajikistan</option>
							<option value="Tanzania">Tanzania</option>
							<option value="Thailand" data-code="66">Thailand</option>
							<option value="Togo" data-code="228">Togo</option>
							<option value="Tokelau">Tokelau</option>
							<option value="Tonga" data-code="676">Tonga</option>
							<option value="Trinidad & Tobago" data-code="1868">Trinidad & Tobago</option>
							<option value="Tunisia" data-code="216">Tunisia</option>
							<option value="Turkey" data-code="90">Turkey</option>
							<option value="Turkmenistan" data-code="7">Turkmenistan</option>
							<option value="Turks & Caicos Is" data-code="1649">Turks & Caicos Is</option>
							<option value="Tuvalu" data-code="688">Tuvalu</option>
							<option value="Uganda" data-code="256">Uganda</option>
							<option value="United Kingdom" data-code="44">United Kingdom</option>
							<option value="Ukraine" data-code="380">Ukraine</option>
							<option value="United Arab Erimates" data-code="971">United Arab Emirates</option>
							<option value="United States of America" data-code="1">United States of America</option>
							<option value="Uraguay" data-code="598">Uruguay</option>
							<option value="Uzbekistan" data-code="7">Uzbekistan</option>
							<option value="Vanuatu" data-code="678">Vanuatu</option>
							<option value="Vatican City State" data-code="379">Vatican City State</option>
							<option value="Venezuela" data-code="58">Venezuela</option>
							<option value="Vietnam" data-code="84">Vietnam</option>
							<option value="Virgin Islands (Brit)" data-code="1284">Virgin Islands (Brit)</option>
							<option value="Virgin Islands (USA)" data-code="1340">Virgin Islands (USA)</option>
							<option value="Wake Island">Wake Island</option>
							<option value="Wallis & Futana Is" data-code="681">Wallis & Futana Is</option>
							<option value="Yemen" data-code="969">Yemen</option>
							<option value="Zaire">Zaire</option>
							<option value="Zambia" data-code="260">Zambia</option>
							<option value="Zimbabwe" data-code="263">Zimbabwe</option>
						</select>
					</div>


				</div>

			</div>


			<div class="row">

				<div class="col-md-6">

					<div class="form-group">

						<label for='datepicker'><?php echo trans('account.phone_number'); ?> <font style="color:red;">*</font></label>
						<input type="hidden" name="country_code" value="<?php echo $user->country_code; ?>">

						<div class="input-group mb-2">
							<!-- <div class="input-group-prepend">
								<div class="input-group-text" id="country_code"></div>
							</div> -->
							<input class='form-control' id='phone_field' placeholder='(___) ___-____' type='tel' name="phone" value="<?php echo $user->phone; ?>" required data-inputmask='"mask": "(999) 999-9999"' data-mask autocomplete="no" autofill="no" style="border:1px solid #ced4da !important;border:1px solid #ced4da !important;box-shadow: none !important;outline: none !important;" data-parsley-minlength="10">
						</div>
					</div>

				</div>

				<div class="col-md-6">
					<div class='form-group'>
						<label for='datepicker'><span id="state_title"><?php echo trans('account.province_state'); ?></span>
							<!-- <font style="color:red;">*</font> -->
						</label>
						<span id="state_box">
							<input value="<?= $user->state; ?>" class='form-control form-group-border' placeholder='' name="state" id="state" required type="text" <?php echo $user->state; ?> autocomplete="no" autofill="no" data-parsley-required-message="<?php echo trans('account.field_required'); ?>">
						</span>
					</div>
				</div>

				<div class="col-md-6">
					<div class='form-group'>
						<label for='datepicker'><?php echo trans('account.city'); ?> </label>
						<input value="<?= $user->city; ?>" class='form-control form-group-border' placeholder='' name="city" required type="text" id="city" <?php echo $user->city; ?>>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-md-12">
					<div class="alert alert-danger" id="error" style="display:none;">

					</div>
				</div>

			</div>


			<div class="row">

				<div class="col-md-12">
					<div class='form-group text-center' style="display:flex; justify-content:center; align-items:center;">
						<button class='btn btn-outline btn-outline-default btn-c-transition btn-radius' type='button' id="submit_btn">
							<?php echo trans('account.next'); ?>
						</button>
					</div>
				</div>

			</div>




		</div>

	</div>

</div>





<?php include(app_path() . '/common/footer.php'); ?>


<script type="text/javascript">
	$("#submit_btn").click(function() {

		var fn = $("#fn").val();
		var ln = $("#ln").val();
		var year = $("#year").val();
		var month = $("#month").val();
		var date = $("#date").val();
		var country = $("#country").val();

		var phone = $("#phone_field").val();

		var dateofbirth = year + "-" + month + "-" + date;

		var state = $("#state").val();

		var city = $("#city").val();

		var gender = $("input[name='gender']:checked").val();

		if (fn == "") {
			showErrorDialog( 'Please enter your first name');
			// error("Please enter your first name");
		} else if (ln == "") {

			showErrorDialog( 'Please enter your last name');

			// error("Please enter your last name");
		}else if (gender == "" || gender == null) {
			// error("Please select your gender");

			showErrorDialog( 'Please select your gender');
			
		}  else if (year == "" || month == "" || date == "") {
			
			// error("Please check your date of birth");
			showErrorDialog( 'Please check your date of birth');

		} else if (country == "") {

			// error("Please select your country");
			showErrorDialog( 'Please select your country');

		} else if (phone == "") {

			// $('#phone_field').addClass('border border-red')
			showErrorDialog( 'Please enter your phone number');

			// error("Please enter your phone number");
		}  else {

			$("#error").hide();

			var url = '<?= url('/api/user/first_step'); ?>';

			var token = '<?php echo csrf_token(); ?>';

			let countryPhoneCode = $("input[name='country_code']").val();

			// console.log(countryPhoneCode)


			$.post(url, {
				fn: fn,
				"_token": token,
				ln: ln,
				dob: dateofbirth,
				city: city,
				state: state,
				country: country,
				phone: phone,
				gender: gender,
				country_code: countryPhoneCode
			}, function(data) {
				
				if (data.result == "success") {

					location.href = "<?= url('/step/2'); ?>"

				}

			});
		}




	});


	function error(msg) {
		$("#error").show();
		$("#error").html(msg);
	}
</script>

<script type="text/javascript">
	getCountry();

	function getCountry() {
		var country = '<?= $user->country ?: ''; ?>';
		let countryCode = '<?= $user->country_code ?: ''; ?>';
		let country_code = countryCode ? countryCode : $('#country').find(":selected").attr('data-code');

		// $("#country_code").text('+' + country_code)
		

		$('#country').change(() => {
			let country_code = $('#country').find(":selected").attr('data-code');

			// $("#country_code").text(country_code ? '+' + country_code : '')
			$("input[name='country_code']").val(country_code ? country_code : '');
		})

		if (country) {
			$("#country").val(country).change();
		}

		<?php $dob = $user->dob; ?>


		var year = '<?php echo !empty($dob) ? date('Y', strtotime($dob)) : ''; ?>';

		var month = '<?php echo !empty($dob) ? date('m', strtotime($dob)) : ''; ?>';

		var date = '<?php echo !empty($dob) ? date('d', strtotime($dob)) : ''; ?>';


		$("#year").val(year).change();

		$("#month").val(month).change();
		$("#date").val(date).change();

	}
</script>