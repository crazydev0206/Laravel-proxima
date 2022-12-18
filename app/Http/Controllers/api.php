<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Cookie;
use DateTime;
use Socialite;

use Twilio\Rest\Client;

use App\Mail\AddNewUser;
use App\Mail\VerifyMail;
use App\Mail\ProfileNotification;
use App\Mail\ForgetPassword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class api extends Controller
{


    public function copyPasteRide(Request $request)
    {
        $date = $request->date;

        $time = $request->time;

        $past_id = $request->id;

        $date = date('Y-m-d', strtotime($date));

        $g = DB::table('rides')->where('id', $past_id)->first();

        DB::table('rides')->insert(['departure' => $g->departure, 'departure_lat' => $g->departure_lat, 'departure_lng' => $g->departure_lng, 'destination' => $g->destination, 'destination_lat' => $g->destination_lat, 'destination_lng' => $g->destination_lng, 'total_distance' => $g->total_distance, 'total_time' => $g->total_time, 'date' => $date, 'time' => $time, 'recurring' => $g->recurring, 'details' => $g->details, 'seats' => $g->seats, 'model' => $g->model, 'vehicle_type' => $g->vehicle_type, 'other' => $g->other, 'year' => $g->year, 'color' => $g->color, 'license_no' => $g->license_no, 'car_type' => $g->car_type, 'smoke' => $g->smoke, 'animal_friendly' => $g->animal_friendly, 'features' => $g->features, 'booking_method' => $g->booking_method, 'max_back_seats' => $g->max_back_seats, 'luggage' => $g->luggage, 'accept_more_luggage' => $g->accept_more_luggage, 'open_customized' => $g->open_customized, 'price' => $g->price, 'payment_method' => $g->payment_method, 'notes' => $g->notes, 'added_by' => $g->added_by, 'added_on' => NOW(), 'url' => $g->url, 'departure_place' => $g->departure_place, 'departure_route' => $g->departure_route, 'departure_zipcode' => $g->departure_zipcode, 'departure_city' => $g->departure_city, 'departure_state' => $g->departure_state, 'departure_country' => $g->departure_country, 'destination_place' => $g->destination_place, 'destination_route' => $g->destination_route, 'destination_zipcode' => $g->destination_zipcode, 'destination_city' => $g->destination_city, 'destination_state' => $g->destination_state, 'destination_country' => $g->destination_country, 'car_image' => $g->car_image, 'skip_vehicle' => $g->skip_vehicle, 'status' => 0, 'until_date' => $g->until_date, 'until_limit' => $g->until_limit, 'repeated' => $g->repeated, 'last_repeated' => $g->last_repeated, 'parent' => $g->parent, 'pickup' => $g->pickup, 'dropoff' => $g->dropoff, 'departure_state_short' => $g->departure_state_short, 'destination_state_short' => $g->destination_state_short, 'closed' => $g->closed, 'suspend' => $g->suspend, 'middle_seats' => $g->middle_seats, 'back_seats' => $g->back_seats]);
    }

    public function changeYourPassword(Request $request)
    {
        $uid = $request->uid;

        $pass = Hash::make($request->pass);

        $checkCode = DB::table('reset_password')->where('user_id', $uid)->first();

        if(empty($checkCode->user_id) ){
            return response()->json([
                'status' => 'error',
                'msg' => 'Provided information is incorrect'
            ]);
        }

        DB::table('users')->where('id', $uid)->update(['pass' => $pass]);

        DB::table('reset_password')->where('user_id', $uid)->delete();

        return response()->json(['status' => 'success']);
    }


    public function changePassword(Request $request)
    {

        $check = DB::table('reset_password')->where('code', $request->URL)->exists();

        if ($check) {
            // code...

            $getuid = DB::table('reset_password')->where('code', $request->URL)->first();

            $UID = $getuid->user_id;

            return view('change_password.index', ['title' => 'Change Your Password', 'change_password_uid' => $UID]);
        } else {

            return redirect('/login');
        }
    }

    public function forgotSendEmail(Request $request)
    {
        $email = $request->email;

        $userCheck = DB::table('users')->where('email', $email)->exists();

        if (!$userCheck) {
            // code...
            return response()->json([
                'error' => 'email_not_found',
                'result' => 'error'
            ], 200);
        } else {


            $userInfo = DB::table('users')->where('email', $email)->first();

            $uid = $userInfo->id;

            $code = uniqid();

            DB::table('reset_password')->insert(['user_id' => $uid, 'code' => $code]);

            $verifyLink = url("set-password/$uid/$code");

            $data = [
                'url' => $verifyLink,
                'name' => ucfirst($userInfo->first_name),
                'u_id' => $uid,
                'code' => $code
            ];

            Mail::to($email)->send(new ForgetPassword($data));

            return response()->json([
                'error' => 'success',
                'result' => 'success'
            ], 200);
        }
    }

    public function signUpFinished(Request $request)
    {
        $uid = $request->session()->get('id');
        $email = $request->session()->get('email');

        DB::table('users')->where('id', $uid)->update(['step' => '6']);

        $user = DB::table('users')->where('id', $uid)->first();

        if($user->phone_verified == 1 && $user->step == 6){
            $data = [
                'name' => ucfirst($user->first_name),
                'body' => 'Now you have completed your profile on '.config('app.name').', we wish you welcome and want to share a few tips so you will enjoy your experience as a member of '.config('app.name'),
            ];

            Mail::to($user->email)->send(new ProfileNotification($data));
            
            return redirect('/dashboard');
        }
    }

    public function verifySmsCode(Request $request)
    {

        $code = $request->code;

        $phone = $request->phone;

        try {


            $account_sid = config('app.twilio_sid');
            $token = config('app.twilio_token');
            $sid =  config('app.twilio_verify_sid');

            $client = new Client($account_sid, $token);


            $verification_check = $client->verify->v2->services($sid)
                ->verificationChecks
                ->create(
                    [
                        "to" => $phone,
                        "code" => $code
                    ]
                );

            if ($verification_check->status == "approved") {

                $uid = $request->session()->get('id');

                DB::table('users')->where('id', $uid)->update(['phone_verified' => '1']);

                return response()->json([
                    'result' => 'success'
                ], 200);
            } else {

                return response()->json([
                    'error' => 'Wrong code',
                    'result' => 'error'
                ], 200);
            }
        } catch (\Twilio\Exceptions\RestException $e) {
            return response()->json([
                'error' => 'sms_error',
                'result' => 'error'
            ], 200);
        }
    }

    public function smsVerification(Request $request)
    {
        $phone = $request->phone;
       
       

            $account_sid = config('app.twilio_sid');
            $token = config('app.twilio_token');
            $_sid =  config('app.twilio_verify_sid');
            $_phone = config('app.twilio_phone');
    
            $code = $this->random_numbers(5);

            $twilio = new Client($account_sid, $token);

            $response = $twilio->verify->v2->services($_sid)
                                    ->verifications->create($phone, 'sms');

          
                return response()->json([
                    'result' => 'success',
                ], 200);
            
      
    }

    public function skipFifthStep(Request $request)
    {
        $uid = $request->session()->get('id');
        DB::table('users')->where('id', $uid)->update(['step' => 6]);
        return redirect('/personal-information');
    }

    public function submitForthForm(Request $request)
    {


        $pets = addslashes($request->input('pets'));

        $smoke = addslashes($request->input('smoke'));

        $features = '';

        if ($request->input('features') != '') $features = implode(';', $request->input('features'));

        $uid = $request->session()->get('id');

        DB::update("UPDATE users SET smoke='$smoke', pets='$pets', features='$features' WHERE id='$uid'");

        DB::table('users')->where('id', $uid)->update(['step' => 5]);

        return redirect('/step/5');
    }

    public function skipFourthStep(Request $request)
    {
        $uid = $request->session()->get('id');

        DB::table('users')->where('id', $uid)->update(['step' => 5]);

        return redirect('/step/5');
    }

    public function submitThirdForm(Request $request)
    {


        $model = addslashes($request->input('model'));
        $type = addslashes($request->input('type'));
        $other = addslashes($request->input('other'));
        $license_no = addslashes($request->input('license_no'));
        $color = addslashes($request->input('color'));
        $year = addslashes($request->input('year'));
        $image = $request->input('car_file_name');


        $id = $request->session()->get('id');

        $check = DB::select("SELECT id FROM vehicles WHERE user_id='$id' ORDER BY id DESC LIMIT 1");
        if (count($check) == 1) {
            $check = collect($check)->first();
            DB::update("UPDATE vehicles SET model='$model', type='$type', other='$other', license_no='$license_no', color='$color', year='$year', image='$image' WHERE id='$check->id'");
        } else DB::insert("INSERT INTO vehicles (user_id, model, type, other, license_no, color, year, image, added_on) VALUES ('$id', '$model', '$type', '$other', '$license_no', '$color', '$year', '$image', NOW())");


        DB::update("UPDATE users SET step='4', account_type='driver', type=2  WHERE id='$id'");

        return redirect('/step/4');
    }

    public function skipthirdfunction(Request $request)
    {
        $uid = $request->session()->get('id');

        DB::table('users')->where('id', $uid)->update(['step' => 4]);

        return redirect('/step/4');
    }

    public function uploadStep2Picture(Request $request)
    {

        $id = $request->session()->get('id');

        if ($request->input('file_name') != '') {
            $file_name = $request->input('file_name');

            DB::update("UPDATE users SET profile_image='$file_name', step='3' WHERE id='$id'");

            return redirect('/step/3');
        }

        if ($request->input('avatar') != '') {
            $file = $request->input('avatar');

            DB::update("UPDATE users SET step='3' WHERE id='$id'");

            return redirect('/step/3');
        }
    }

    public function step_two_skip(Request $request)
    {
        $uid = $request->session()->get('id');

        DB::table('users')->where('id', $uid)->update(['step' => 3]);
    }

    public function firstStep(Request $request)
    {
        $fn = $request->fn;
        $ln = $request->ln;
        $dob = date('Y-m-d', strtotime($request->dob));
        $city = $request->city;
        $state = $request->state;
        $country = $request->country;
        $phone = $request->phone;
        $gender = $request->gender;

        $country_code = $request->country_code;

        $uid = $request->session()->get('id');

        DB::table('users')->where('id', $uid)->update(
            [
                'first_name' => $fn, 'last_name' => $ln, 'gender' =>
                $gender, 'country' => $country, 'state' => $state, 
                'city' => $city, 'phone' => $phone, 'dob' => $dob, 
                'step' => 2, 'country_code' => $country_code
            ]
        );


        return response()->json([
            'result' => 'success'
        ], 200);
    }

    public function suspend_ride(Request $request)
    {
        $id = $request->input('id');

        $status = $request->input('status');

        DB::update("UPDATE rides SET suspend = '$status' WHERE id = '$id'");
    }


    public function login(Request $request)
    {
        $email = $request->email;

        $password = $request->password;

        $checkLoginCredentials = DB::table('users')->where('email', $email)->exists();

        if (!$checkLoginCredentials) {
            // code...
            return response()->json([
                'result' => 'failed',
                'error' => 'email_not_found',
                'msg' => 'Email not found. Please check your email address'
            ], 200);
        }

        $uDetails = DB::table('users')->where('email', $email)->first();


        if ($uDetails->email_verified == 0) {

            return response()->json([
                'result' => 'failed',
                'error' => 'email_verified',
                'msg' => 'This email is not verified yet. We had emailed you the verification link. Please check your email and verify it'
            ], 200);

            // code...
        }

        $getPassword = $uDetails->pass;

        if (!Hash::check($password, $getPassword)) {
            // code...
            return response()->json([
                'result' => 'failed',
                'error' => 'password_error',
                'msg' => 'Your password is incorrect'
            ], 200);
        }

        $uid = $uDetails->id;

        /*$request->session()->put('id', $user->id);*/

        $userD = [
            'id' => $uid,
            'name' => $uDetails->first_name . '' . $uDetails->last_name,
            'email' => $uDetails->email
        ];

        $request->session()->put('id', $uid);

        $request->session()->put('name', $uDetails->first_name . " " . $uDetails->last_name);

        $request->session()->put('email', $uDetails->email);

        $name = $uDetails->first_name;
        $msg = '';
        $step = $uDetails->step;

        if ($step !== 6) {
            $msg = "Hello $name, nice to meet you.\n Please complete your profile; it only takes a couple of minutes";
        }

        if ($step == 6) {
            $msg =  "Welcome back $name, enjoy your day ";
        }


        return response()->json([
            'result' => 'success',
            'error' => 'success',
            'msg' => $msg,
            'step' => $step
        ], 200);
    }

    public function check_email(Request $request)
    {
        $admin = env('ADMIN_EMAIL');

        echo $admin;
    }

    function resend_confirm_email(Request $request){
        $email = $request->email;

        $checkEmail = DB::table('users')->where('email', $email)->exists();

        if ($checkEmail) {

            $code = uniqid();

            $user = DB::table('users')->where('email', $email)->first();

            $verify = DB::table('verify')->where('user_id', $user->id)->first();
            
            if(!empty($verify->code)){

                DB::table('verify')->where('user_id', $user->id)->update(['status'=> 0, 'code' => $verify->code]);

                DB::table('verify')->inserT(['user_id' => $user->id, 'status' => 1, 'code' => $code]);
            }

            $verifyLink = url('verify-email?code=' . $code);
            $name = ucfirst($user->first_name);

            $data = [
                'verify_url' => $verifyLink,
                'email' => $email,
                'name' => $name
            ];

            Mail::to($email)->send(new VerifyMail($data));

            return response()->json([
                'result' => 'success',
                'msg' => 'A new verification mail has been sent. Please check your email to confirm'
            ]);
        }else {
            return response()->json([
                'result' => 'failed',
                'msg' => 'Email provided is incorrect'
            ]);
        }
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $fn = $request->fn;
        $ln = $request->ln;
        $pass = Hash::make($request->pass);
        $type = $request->type;
        $username = str_replace(' ', '-', strtolower($fn . ' ' . $ln));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $username = strtolower($username);


        $checkEmail = DB::table('users')->where('email', $email)->exists();

        if ($checkEmail) {
            // code...
            return response()->json([
                'result' => 'failed',
                'error' => 'email_exsist',
                'msg' => 'Email already exsist'
            ], 200);
        }

        $check = DB::table('users')->where('username', $username)->exists();

        if ($check) {
            // code...
            $username = $username . '-' . $this->random_number(5);
        }


        $charge_booking = 1;
        $booking_credits = 0;

        DB::table('users')->insert([
            'first_name' => $fn, 'last_name' => $ln, 'email' => $email,
            'type' => $type, 'pass' => $pass, 'status' => '0', 'charge_booking' => $charge_booking,
            'booking_credits' => '0', 'username' => $username
        ]);

        $uid = DB::getPdo()->lastInsertId();

        $code = uniqid();

        DB::table('verify')->inserT(['user_id' => $uid, 'code' => $code, 'status' => 1]);


        $verifyLink = url('verify-email?code=' . $code);
        $name = ucfirst($fn);

        $data = [
            'verify_url' => $verifyLink,
            'email' => $email,
            'name' => $name
        ];

        Mail::to($email)->send(new VerifyMail($data));

        $user = DB::table('users')->where('email', $email)->first();

        $data2 = array(
            'first_name' => $fn,
            'last_name' => $ln,
            'email' => $email,
            'view-url' => "/user/".$user->id
        );

        $adminEmail = config('app.admin_email');
        Mail::to($adminEmail)->send(new AddNewUser($data2));

        return response()->json([
            'result' => 'success',
            'msg' => 'Registration Successful'
        ], 200);
    }

    public function smtp_credentials()
    {
        $data['email'] = "support@meganmegmeg.site";
        $data['password'] = "Admin@123123";
        $data['smtp'] = "ssl";
        $data['port'] = 465;
        $data['from'] = "donotreply@proximaride.com";
        $data['from_name'] = "Support Proximaride";
        $data['host'] = "mail.meganmegmeg.site";


        return $data;
    }

    public function email_send($subject, $message, $to_email, $reply_email)
    {

        $smtp_credentials = $this->smtp_credentials();

        $mail = new PHPMailer(true);

        //Enable SMTP debugging.
        $mail->SMTPDebug = 0;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name                          
        $mail->Host = $smtp_credentials['host'];
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password     
        $mail->Username = $smtp_credentials['email'];
        $mail->Password = $smtp_credentials['password'];

        $mail->AddReplyTo($reply_email);

        $mail->SMTPSecure = $smtp_credentials['smtp'];
        //Set TCP port to connect to
        $mail->Port = $smtp_credentials['port'];

        $mail->From = $smtp_credentials['from'];
        $mail->FromName = $smtp_credentials['from_name'];

        $mail->addAddress($to_email);

        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        try {
            if ($mail->Send()) {
                // code...
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {

            return false;
        }
    }

}
