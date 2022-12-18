<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use DateTime;
use DB;
use Mail;
use Socialite;

use App\Mail\WelcomeMessage;

class account extends Controller
{
    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }

    public function hide_warning(Request $request)
    {
        $warning = $request->input('warning');
        Cookie::queue($warning, '1', 2628000);
    }

    public function dashboard(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('first_name')!='')
        {
            $first_name=addslashes($request->input('first_name'));
            $last_name=addslashes($request->input('last_name'));
            $gender=addslashes($request->input('gender'));
            // $email=addslashes($request->input('email'));
            // $phone=addslashes($request->input('phone'));
            $address=addslashes($request->input('address'));
            $about=addslashes($request->input('about'));
            $city=addslashes($request->input('city'));
            $state=addslashes($request->input('state'));
            $country=addslashes($request->input('country'));
            $zipcode=addslashes($request->input('zipcode'));
            
            $dob='';
            $year=addslashes($request->input('year'));
            $month=addslashes($request->input('month'));
            $date=addslashes($request->input('date'));
            if($year!='' AND $month!='' AND $date!='') $dob=$year.'-'.$month.'-'.$date;
            
            $facebook=addslashes($request->input('facebook'));
            $google=addslashes($request->input('google'));
            $instagram=addslashes($request->input('instagram'));
            $youtube=addslashes($request->input('youtube'));

            $id_card_number = addslashes($request->input('id_card_number'));
            $id_image = addslashes($request->input('car_file'));
            
            DB::update("UPDATE users SET first_name='$first_name', last_name='$last_name', gender='$gender', board_status=1, address='$address', about='$about', facebook='$facebook', google='$google', instagram='$instagram', youtube='$youtube', city='$city', state='$state', country='$country', dob='$dob', zipcode='$zipcode', id_card_number='$id_card_number', id_card_image='$id_image' WHERE id='$id'");
            $request->session()->flash('success', 'Your details have been updated successfully');
            return redirect('personal-information');
        }
        
        if($request->input('sms')!='')
        {
            $smoke=addslashes($request->input('smoke'));
            $sms=addslashes($request->input('sms'));
            $emails=addslashes($request->input('emails'));
            
            DB::update("UPDATE users SET smoke='$smoke', sms='$sms', emails='$emails' WHERE id='$id'");
            $request->session()->flash('success', 'Your preferences have been updated successfully');
            return redirect('profile?t=preferences');
        }

       
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $rating = '';

        $booking ='';
        //  booking
        if($user->account_type == 'driver'){
            $booking = DB::table('bookings')
            ->join('users', function($join) use ($id){
                $join->on('bookings.user_id', '=', 'users.id')
                    ->where('bookings.driver_id', $id);
            })
            ->join('rides', function ($join) use ($id){
                $join->on('bookings.ride_id', '=', 'rides.id')
                    ->where('bookings.driver_id', $id);
                    //  ->orderBy('');
            })->orderBy('booked_on', 'desc')
            ->get();
        }else {
            $booking = DB::table('bookings')
            ->join('users', function($join) use ($id){
                $join->on('bookings.driver_id', '=', 'users.id')
                    ->where('bookings.user_id', $id);
            })
            ->orderBy('booked_on', 'desc')
            ->get();

        }

        //  rating
        if($user->account_type == 'driver'){
            $rating = DB::table('ratings')
            ->join('users', function($join) use ($id){
                $join->on('ratings.user_id', '=', 'users.id')
                    ->where('ratings.driver_id', $id);
            }) ->join('rides', function ($join) use ($id){
                $join->on('ratings.ride_id', '=', 'rides.id')
                    ->where('ratings.driver_id', $id);
            })
        //    ->orderBy('added_on', 'desc')
            ->get();
        }else {
            $rating = DB::table('ratings')
            ->join('users', function($join) use ($id){
                $join->on('ratings.driver_id', '=', 'users.id')
                    ->where('ratings.user_id', $id);
            })
            ->orderBy('added_on', 'desc')
            ->get();

        }
        
        

        $booking = collect($booking);
        $rating = collect($rating);

        // dd($rating);

        // foreach ($booking as $value) {
        //     dd($value->gender);
        // }

        // if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
       
        if ($user->step < 6) {
            // code...

            return redirect('/step/'.$user->step);
        
        }

        
        return view('dashboard.index', ['title'=>'Dashboard', 'user_data'=>$user, 'rating'=>$rating, 'booking'=>$booking]);
    }
    

    public function signin(Request $request)
    {


        if ($request->session()->get('id') != null) {
            // code...

            $uid = $request->session()->get('id');

            $uinfo = DB::table('users')->where('id', $uid)->first();



            if ($uinfo->step == "completed") {
                // code...
                return redirect('personal-information');
            } else {

                if ($uinfo->step == "0") {
                    // code...
                    $uinfo->step = "1";
                }

                if ($uinfo->step == "6") {
                    // code...

                    return redirect("/personal-information");;
                } else {

                    return redirect('/step/' . $uinfo->step);
                }
            }
        }

        if ($request->input('next') != '') {
            $next = $request->input('next');
            $request->session()->put('next', $next);
        }

        if ($request->input('email') != '') {
            $email = addslashes($request->input('email'));
            $pass = addslashes($request->input('pass'));

            $check = DB::select("SELECT id, status, type, student_card, driver_license, verify, suspend FROM users WHERE email='$email' AND pass='$pass' AND deleted='0' LIMIT 1");
            if (count($check) == 1) {
                $check = collect($check)->first();

                if ($check->verify == '0') {
                    $request->session()->flash('error', trans('account.verify_your_email'));
                    return redirect('signin');
                }

                if ($check->status == '3') {
                    $request->session()->flash('error', trans('account.your_account_rejected'));
                    return redirect('signin');
                }

                if ($check->suspend == '1') {
                    $request->session()->flash('error', trans('account.your_account_suspended'));
                    return redirect('signin');
                }

                $request->session()->put('id', $check->id);
                if ($request->input('remember_me') == '1') {
                    $token = md5(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 3) . rand(pow(10, 4 - 1), pow(10, 4) - 1));
                    DB::update("UPDATE users SET token='$token' WHERE id='$check->id'");
                    Cookie::queue('user_login_token', $token, 2628000);
                    Cookie::queue('remember', '1', 2628000);
                } else {
                    Cookie::queue('user_login_token', '', 2628000);
                    Cookie::queue('remember', '0', 2628000);
                }

                if ($check->type == 'Driver') {
                    if ($check->status == '0' and $check->driver_license == '') return redirect('complete-signup');
                }
                if ($check->type == 'Student') {
                    if ($check->status == '0') return redirect('complete-signup');
                }

                if ($request->session()->get('next') != '') {
                    $next = $request->session()->get('next');
                    return redirect($next);
                }

                $next = $request->session()->get('signup_next');
                if ($next != '') {
                    $request->session()->put('signup_next', '');
                    return redirect($next);
                }

                return redirect('personal-information');
            } else {
                $request->session()->flash('error', trans('account.email_password_not_valid'));
                return redirect('signin');
            }
        }

        $remember = $request->cookie('remember');
        if ($remember == '') $remember = '0';
        return view('signin.index', ['title' => 'Log in', 'remember' => $remember]);
    }

    public function signup(Request $request)
    {
        if ($request->input('email') != '') {
            $type = addslashes($request->input('type'));
            $gender = addslashes($request->input('gender'));
            $first_name = addslashes($request->input('first_name'));
            $last_name = addslashes($request->input('last_name'));
            $country = addslashes($request->input('country'));
            $state = addslashes($request->input('state'));
            $city = addslashes($request->input('city'));
            $email = addslashes($request->input('email'));
            $phone = addslashes($request->input('phone'));
            $pass1 = addslashes($request->input('pass1'));
            $pass2 = addslashes($request->input('pass2'));
            $username = str_replace(' ', '-', strtolower($first_name . ' ' . $last_name));
            $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

            $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
            if (count($check) == 1) {
                $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
            }

            // check if reCaptcha has been validated by Google
            $secret = '6Lcy0OIUAAAAAFCz9E9BXRaYPvEImxwjzw-42_FE';
            $captchaId = $request->input('g-recaptcha-response');

            //sends post request to the URL and tranforms response to JSON
            //$responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));

            /*$ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => [
                    'secret' => $secret,
                    'response' => $captchaId,
                    'remoteip' => $_SERVER['REMOTE_ADDR']
                ],
                CURLOPT_RETURNTRANSFER => true
            ]);

            $output = curl_exec($ch);
            curl_close($ch);

            $responseCaptcha = json_decode($output);*/

            if (0) { //$responseCaptcha->success == false
                $request->session()->flash('error', trans('account.prove_not_robot'));
                //return redirect('signup');
            } else {
                $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
                if (count($check) == 0) {
                    if ($pass1 == $pass2) {
                        $status = 0;

                        $referral = 0;
                        if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

                        $charge_booking = 1;

                        $booking_credits = 0;
                        $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
                        if (count($r_user) == 1) {
                            $r_user = collect($r_user)->first();
                            //$booking_credits=$r_user->booking_credits+1;
                            //DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");

                            $booking_credits = 2;
                        }

                        DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, phone, status, charge_booking, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '0', '$phone', '$status', '$charge_booking', '$referral', '$booking_credits')");
                        $id = DB::getPdo()->lastInsertId();
                        $request->session()->put('verify', $id);
                        //$request->session()->flash('success', 'Your account has been created successfully. We have sent you an email to your email address, please verify your email to continue.');

                        //send welcome email START
                        $name = $first_name . ' ' . $last_name;

                        /*$from=env('MAIL_USERNAME');
                    $data2=array(
                        'u_id'=>'1',
                        'code'=>'sdf',
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name,
                        'first_name'=>$frist_name
                    );
                    Mail::send('emails.welcome', $data2, function($message) use($email, $from, $name, $first_name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Welcome to ProximaRide, '.$first_name);
                        //$message->attach($pathToFile);
                    });*/
                        //send welcome email END

                        //send verify link START
                        $code = substr(md5(uniqid(rand(), true)), 0, 20);
                        DB::insert("INSERT INTO verify (user_id, code) VALUES ('$id','$code')");
                        $name = ucfirst($first_name);

                        $from = config('app.email_sender_from');

                        $data2 = array(
                            'u_id' => $id,
                            'code' => $code,
                            'email' => $email,
                            'from' => $from,
                            'name' => $name
                        );

                        Mail::send('emails.verify_email', $data2, function ($message) use ($email, $from, $name) {
                            $message->from($from, 'ProximaRide');
                            $message->to($email, $name);
                            $message->subject(trans('account.confirm_email_address'));
                            //$message->attach($pathToFile);
                        });
                        //send verify link END

                        //send new user registered alert start

                        $email = 'ermanamad@gmail.com';
                        $body = 'Hi,<br><br>There is a new user registered on the platform:<br> ' . $name . ' (' . $email . ')<br><br>';
                        $title = 'New user registration | ProximaRide';
                        $url = url('admin/dashboard');
                        $url_title = 'Admin Panel';
                        $from = env('MAIL_USERNAME');
                        
                        $data2 = array(
                            'email' => $email,
                            'from' => $from,
                            'title' => $title,
                            'body' => $body,
                            'url' => $url,
                            'url_title' => $url_title
                        );

                        Mail::send('emails.notification', $data2, function ($message) use ($email, $from, $title) {
                            $message->from('info@proximaride.com', 'ProximaRide');
                            $message->to($email);
                            $message->subject($title);
                            //$message->attach($pathToFile);
                        });
                        //end

                        return redirect('verify-email');

                        /*if($status==0)
                    return redirect('complete-signup');
                    else
                    return redirect('profile');*/
                    } else {
                        $request->session()->flash('error', trans('account.passwords_not_match'));
                        return redirect('signup');
                    }
                } else {
                    $request->session()->flash('error', trans('account.email_already_exists'));
                    return redirect('signup');
                }
            }
        }
        return view('signup.index', ['title' => 'Sign up']);
    }

    public function verify_email(Request $request)
    {


        $code = $request->code;

        $codeInfo = DB::table('verify')->where('code', $code)->exists();

        if ($codeInfo) {
            // code...

            $getCode = DB::table('verify')->where('code', $code)->first();

            $codee = $getCode->code;
           
            if($code == $codee && $getCode->status == 0)
            {
               
                $request->session()->put('result', 'error');
                $request->session()->put('message', 'A new verification email has been sent due to expiration of the current email.');

                return redirect('/login');
            }

            if ($code == $codee && $getCode->status == 1) {
                // code...
                $user_id = $getCode->user_id;

                DB::table('users')->where('id', $user_id)->update(['email_verified' => '1']);

                DB::table('verify')->where('code', $code)->delete();

                return redirect('/login');
            }
        } else {

            $request->session()->put('result', 'error');
            $request->session()->put('message', 'This email is not verified yet. We had emailed you the verification link. Please check your email and verify it');
        }
    }

    public function send_verification_email(Request $request)
    {
        $data = array();
        $data['success'] = 0;
        $id = $request->session()->get('verify');
        if ($id == '') return redirect('login');

        $user = DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$id' LIMIT 1");
        if (count($user) == 0) return redirect('login');
        $user = collect($user)->first();

        //send verify link START
        $code = substr(md5(uniqid(rand(), true)), 0, 20);
        DB::insert("INSERT INTO verify (user_id, code) VALUES ('$id','$code')");

        $name = $user->first_name;
        $email = $user->email;
        $id = $user->id;
        $from = env('MAIL_USERNAME');
        $data2 = array(
            'u_id' => $id,
            'code' => $code,
            'email' => $email,
            'from' => $from,
            'name' => $name
        );
        Mail::send('emails.verify', $data2, function ($message) use ($email, $from, $name) {
            $message->from('donotreply@proximaride.com', 'ProximaRide');
            $message->to($email);
            $message->subject(trans('account.confirm_email_address'));
        });
        $data['success'] = 1;
        //send verify link END

        return response()->json($data);
    }

    public function upload_profile_image(Request $request)
    {
        $data = array();
        $data['success'] = 0;

        $uid = $request->session()->get('id');

        $user = DB::table('users')->where('id', $uid)->first();

        if ($request->file('file') != '') {
            $error = '';
            $file = $request->file('file');

            //Move Uploaded File
            $destinationPath = 'images/profile_images/';
            $img_name = $file->getClientOriginalName();
            $array = explode('.', $img_name);
            $img_name = $array[0];
            $ext = $array[1];

            $img_name = strtolower($user->first_name). '_'. rand(pow(10, 4 - 1), pow(10, 4) - 1) . '.' . $ext;
            $fileName = $destinationPath . $img_name; // renameing image

            if ($file->move($destinationPath, $img_name)) {
                $data['name'] = $img_name;
                $data['success'] = 1;
            }
        }

        return response()->json($data);
    }

    public function upload_car_image(Request $request)
    {
        $data = array();
        $data['success'] = 0;

        if ($request->file('file') != '') {
            $error = '';
            $file = $request->file('file');

            //Move Uploaded File
            $data = $this->upload_image($file,'car_images/');
            // $destinationPath = 'car_images/';
            // $img_name = $file->getClientOriginalName();
            // $array = explode('.', $img_name);
            // $img_name = $array[0];
            // $ext = $array[1];
            // $img_name = rand(pow(10, 4 - 1), pow(10, 4) - 1) . '.' . $ext;
            // $fileName = $destinationPath . $img_name; // renameing image

            // if ($file->move($destinationPath, $img_name)) {
            //     $data['name'] = $img_name;
            //     $data['success'] = 1;
            // }
        }

        return response()->json($data);
    }
    
    public function upload_id_card_image(Request $request)
    {
        $data = array();
        $data['success'] = 0;

        if ($request->file('file') != '') {
            $error = '';
            $file = $request->file('file');

            //Move Uploaded File
            $data = $this->upload_image($file,'user_cards/');
        }

        return response()->json($data);
    }

    public function step1of5(Request $request)
    {

        return view('step1of5.index', ['title' => 'Step 1 of 5 | Welcome']);
    }

    public function step2of5(Request $request)
    {
        return view('step2of5.index', ['title' => 'Step 2 of 5 | Welcome']);
    }

    public function step3of5(Request $request)
    {

        $id = $request->session()->get('id');
        $vehicles = DB::table('vehicles')->where('user_id', $id)->first();

        return view('step3of5.index', ['title' => 'Step 3 of 5 | Welcome', 'vehicle' => $vehicles]);
    }

    public function step4of5(Request $request)
    {

        return view('step4of5.index', ['title' => 'Step 4 of 5 | Welcome']);
    }

    public function step5of5(Request $request)
    {
        $next = $request->session()->get('signup_next');

        return view('step5of5.index', ['title' => 'Step 5 of 5 | Welcome', 'next' => $next]);
    }

    public function complete_signup(Request $request)
    {
        $id = $request->session()->get('id');
        $status = '0';

        if ($request->file('student_card') != '') {
            $error = '';
            $file = $request->file('student_card');
            $type = $request->input('type');

            //Move Uploaded File
            $destinationPath = 'users_files/';
            $img_name = $file->getClientOriginalName();
            $array = explode('.', $img_name);
            $img_name = $array[0];
            $ext = $array[1];
            $img_name = rand(pow(10, 4 - 1), pow(10, 4) - 1) . '.' . $ext;
            $fileName = $destinationPath . $img_name; // renameing image

            if ($file->move($destinationPath, $img_name)) {
                $image = $img_name;
                $status = '2';
                DB::update("UPDATE users SET student_card='$image', status='2' WHERE id='$id'");
                $flag = 1;
            }
        }

        if ($request->file('driver_license') != '') {
            $error = '';
            $file = $request->file('driver_license');
            $type = $request->input('type');

            //Move Uploaded File
            $destinationPath = 'users_files/';
            $img_name = $file->getClientOriginalName();
            $array = explode('.', $img_name);
            $img_name = $array[0];
            $ext = $array[1];
            $img_name = rand(pow(10, 4 - 1), pow(10, 4) - 1) . '.' . $ext;
            $fileName = $destinationPath . $img_name; // renameing image

            if ($file->move($destinationPath, $img_name)) {
                $image = $img_name;
                $status = '2';
                DB::update("UPDATE users SET driver_license='$image', status='2' WHERE id='$id'");
                $flag = 1;
            }
        }

        if ($request->input('school_name') != '') {
            $school_name = addslashes($request->input('school_name'));

            $check = DB::update("UPDATE users SET school_name='$school_name' WHERE id='$id'");
            $flag = 1;
        }

        if ($request->input('type') != '') {
            $type = addslashes($request->input('type'));
            if ($type == 'Passenger') $status = '1';

            $charge_booking = 1;
            if ($type == 'Student') $charge_booking = 0;

            $check = DB::update("UPDATE users SET type='$type', status='$status', charge_booking='$charge_booking' WHERE id='$id'");
            if ($type == 'Passenger') return redirect('profile');
            $flag = 1;
        }

        if (isset($flag)) return redirect('complete-signup');

        return view('complete_signup.index', ['title' => 'Complete Sign up']);
    }

    public function facebook_redirect(Request $request)
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function facebook_callback(Request $request)
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        //var_dump($user);

        $f_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $username = str_replace(' ', '-', strtolower($name));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
        if (count($check) == 1) {
            $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        }

        $names = explode(' ', $name);
        $first_name = $names[0];
        $last_name = '';
        if (isset($names[1])) $last_name = $names[1];
        $type = '';
        $country = '';
        $state = '';
        $city = '';
        $pass1 = '';
        $gender = '';

        $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) {
            $referral = 0;
            if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

            $booking_credits = 0;
            $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
            if (count($r_user) == 1) {
                $r_user = collect($r_user)->first();
                $booking_credits = $r_user->booking_credits + 1;

                DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");
                $free_ride = 1;
            }

            DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, facebook_id, avatar, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '1', '$f_id', '$avatar', '$referral', '$booking_credits')");
            $id = DB::getPdo()->lastInsertId();
            $request->session()->put('id', $id);
            return redirect('/step/1');

            //send welcome email START
            /*$name=$first_name.' '.$last_name;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'u_id'=>'1',
                        'code'=>'sdf',
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.welcome', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Welcome to ProximaRide');
                        //$message->attach($pathToFile);
                    });*/
            //send welcome email END

            return redirect('profile');
        } else {
            $check = collect($check)->first();
            DB::update("UPDATE users SET facebook_id='$f_id', avatar='$avatar', verify='1' WHERE id='$check->id'");
            $request->session()->put('id', $check->id);
            return redirect('dashboard');
        }

        exit();
        return redirect()->to('profile');
    }

    public function google_redirect(Request $request)
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function google_callback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();
        //var_dump($user);

        $g_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $username = str_replace(' ', '-', strtolower($name));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
        if (count($check) == 1) {
            $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        }

        $names = explode(' ', $name);
        $first_name = $names[0];
        $last_name = '';
        if (isset($names[1])) $last_name = $names[1];
        $type = '';
        $country = '';
        $state = '';
        $city = '';
        $pass1 = '';
        $gender = '';

        $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) {
            $referral = 0;
            if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

            $booking_credits = 0;
            $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
            if (count($r_user) == 1) {
                $r_user = collect($r_user)->first();
                $booking_credits = $r_user->booking_credits + 1;

                DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");
                $free_ride = 1;
            }

            DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, google_id, avatar, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '1', '$g_id', '$avatar', '$referral', '$booking_credits')");
            $id = DB::getPdo()->lastInsertId();
            $request->session()->put('id', $id);
            return redirect('/step/1');

            return redirect('profile');
        } else {
            $check = collect($check)->first();
            DB::update("UPDATE users SET google_id='$g_id', avatar='$avatar', verify='1' WHERE id='$check->id'");
            $request->session()->put('id', $check->id);
            return redirect('dashboard');
        }

        exit();
        return redirect()->to('profile');
    }

    public function linkedin_redirect(Request $request)
    {
        return Socialite::driver('linkedin')->stateless()->redirect();
    }

    public function linkedin_callback(Request $request)
    {
        $user = Socialite::driver('linkedin')->stateless()->user();
        //var_dump($user);

        $g_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $username = str_replace(' ', '-', strtolower($name));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
        if (count($check) == 1) {
            $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        }

        $names = explode(' ', $name);
        $first_name = $names[0];
        $last_name = '';
        if (isset($names[1])) $last_name = $names[1];
        $type = '';
        $country = '';
        $state = '';
        $city = '';
        $pass1 = '';
        $gender = '';

        $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) {
            $referral = 0;
            if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

            $booking_credits = 0;
            $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
            if (count($r_user) == 1) {
                $r_user = collect($r_user)->first();
                $booking_credits = $r_user->booking_credits + 2;

                DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");
                $free_ride = 1;

                $booking_credits = 2;
            }

            DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, linkedin_id, avatar, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '1', '$g_id', '$avatar', '$referral', '$booking_credits')");
            $id = DB::getPdo()->lastInsertId();
            $request->session()->put('id', $id);
            return redirect('/step/1');

            //send welcome email START
            /*$name=$first_name.' '.$last_name;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'u_id'=>'1',
                        'code'=>'sdf',
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.welcome', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Welcome to ProximaRide');
                        //$message->attach($pathToFile);
                    });*/
            //send welcome email END

            return redirect('profile');
        } else {
            $check = collect($check)->first();
            DB::update("UPDATE users SET linkedin_id='$g_id', avatar='$avatar', verify='1' WHERE id='$check->id'");
            $request->session()->put('id', $check->id);
            return redirect('dashboard');
        }

        exit();
        return redirect()->to('profile');
    }

    public function instagram_redirect(Request $request)
    {
        return Socialite::driver('instagram')->stateless()->redirect();
    }

    public function instagram_callback(Request $request)
    {
        $user = Socialite::driver('instagram')->stateless()->user();
        //var_dump($user);

        $g_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $username = str_replace(' ', '-', strtolower($name));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
        if (count($check) == 1) {
            $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        }

        $names = explode(' ', $name);
        $first_name = $names[0];
        $last_name = '';
        if (isset($names[1])) $last_name = $names[1];
        $type = '';
        $country = '';
        $state = '';
        $city = '';
        $pass1 = '';
        $gender = '';

        $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) {
            $referral = 0;
            if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

            $booking_credits = 0;
            $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
            if (count($r_user) == 1) {
                $r_user = collect($r_user)->first();
                $booking_credits = $r_user->booking_credits + 2;

                DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");
                $free_ride = 1;

                $booking_credits = 2;
            }

            DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, linkedin_id, avatar, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '1', '$g_id', '$avatar', '$referral', '$booking_credits')");
            $id = DB::getPdo()->lastInsertId();
            $request->session()->put('id', $id);
            return redirect('/step/1');

            //send welcome email START
            /*$name=$first_name.' '.$last_name;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'u_id'=>'1',
                        'code'=>'sdf',
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.welcome', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Welcome to ProximaRide');
                        //$message->attach($pathToFile);
                    });*/
            //send welcome email END

            return redirect('profile');
        } else {
            $check = collect($check)->first();
            DB::update("UPDATE users SET linkedin_id='$g_id', avatar='$avatar', verify='1' WHERE id='$check->id'");
            $request->session()->put('id', $check->id);
            return redirect('dashboard');
        }

        exit();
        return redirect()->to('profile');
    }

    public function tiktok_redirect(Request $request)
    {
        return Socialite::driver('tiktok')->stateless()->redirect();
    }

    public function tiktok_callback(Request $request)
    {
        $user = Socialite::driver('tiktok')->stateless()->user();
        //var_dump($user);

        $g_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $username = str_replace(' ', '-', strtolower($name));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
        if (count($check) == 1) {
            $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        }

        $names = explode(' ', $name);
        $first_name = $names[0];
        $last_name = '';
        if (isset($names[1])) $last_name = $names[1];
        $type = '';
        $country = '';
        $state = '';
        $city = '';
        $pass1 = '';
        $gender = '';

        $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) {
            $referral = 0;
            if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

            $booking_credits = 0;
            $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
            if (count($r_user) == 1) {
                $r_user = collect($r_user)->first();
                $booking_credits = $r_user->booking_credits + 2;

                DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");
                $free_ride = 1;

                $booking_credits = 2;
            }

            DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, linkedin_id, avatar, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '1', '$g_id', '$avatar', '$referral', '$booking_credits')");
            $id = DB::getPdo()->lastInsertId();
            $request->session()->put('id', $id);
            return redirect('/step/1');

            //send welcome email START
            /*$name=$first_name.' '.$last_name;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'u_id'=>'1',
                        'code'=>'sdf',
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.welcome', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Welcome to ProximaRide');
                        //$message->attach($pathToFile);
                    });*/
            //send welcome email END

            return redirect('profile');
        } else {
            $check = collect($check)->first();
            DB::update("UPDATE users SET linkedin_id='$g_id', avatar='$avatar', verify='1' WHERE id='$check->id'");
            $request->session()->put('id', $check->id);
            return redirect('dashboard');
        }

        exit();
        return redirect()->to('profile');
    }

    public function snapchat_redirect(Request $request)
    {
        return Socialite::driver('snapchat')->stateless()->redirect();
    }

    public function snapchat_callback(Request $request)
    {
        $user = Socialite::driver('snapchat')->stateless()->user();
        //var_dump($user);

        $g_id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $username = str_replace(' ', '-', strtolower($name));
        $username = preg_replace("/[^A-Za-z0-9-]/", '', $username);

        $check = DB::select("SELECT id FROM users WHERE username='$username' LIMIT 1");
        if (count($check) == 1) {
            $username = $username . '-' . rand(pow(10, 4 - 1), pow(10, 4) - 1);
        }

        $names = explode(' ', $name);
        $first_name = $names[0];
        $last_name = '';
        if (isset($names[1])) $last_name = $names[1];
        $type = '';
        $country = '';
        $state = '';
        $city = '';
        $pass1 = '';
        $gender = '';

        $check = DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) {
            $referral = 0;
            if ($request->session()->get('referral') != '') $referral = $request->session()->get('referral');

            $booking_credits = 0;
            $r_user = DB::select("SELECT id, booking_credits FROM users WHERE id='$referral' LIMIT 1");
            if (count($r_user) == 1) {
                $r_user = collect($r_user)->first();
                $booking_credits = $r_user->booking_credits + 2;

                DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$referral'");
                $free_ride = 1;

                $booking_credits = 2;
            }

            DB::insert("INSERT INTO users (username, first_name, last_name, type, gender, country, state, city, email, pass, created_on, verify, linkedin_id, avatar, referral, booking_credits) VALUES ('$username', '$first_name', '$last_name', '$type', '$gender', '$country', '$state', '$city', '$email', '$pass1', NOW(), '1', '$g_id', '$avatar', '$referral', '$booking_credits')");
            $id = DB::getPdo()->lastInsertId();
            $request->session()->put('id', $id);
            return redirect('/step/1');

            //send welcome email START
            /*$name=$first_name.' '.$last_name;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'u_id'=>'1',
                        'code'=>'sdf',
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.welcome', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Welcome to ProximaRide');
                        //$message->attach($pathToFile);
                    });*/
            //send welcome email END

            return redirect('profile');
        } else {
            $check = collect($check)->first();
            DB::update("UPDATE users SET linkedin_id='$g_id', avatar='$avatar', verify='1' WHERE id='$check->id'");
            $request->session()->put('id', $check->id);
            return redirect('dashboard');
        }

        exit();
        return redirect()->to('profile');
    }

    public function forgot_password(Request $request)
    {


        return view('forgot_password.index', ['title' => 'Forgot Password']);
    }

    public function set_password(Request $request, $user_id, $code)
    {
        $row = DB::select("SELECT id FROM reset_password WHERE user_id='$user_id' AND code='$code' LIMIT 1");

        if (count($row) == 0) {
           return response()->json(['status' => 'error','msg'=>'Sorry link has expired']);
        } else {

            $row = collect($row)->first();
            $id = $row->id;   //id of row in verify table

            $user = DB::select("SELECT id FROM users WHERE id='$user_id' LIMIT 1");
            if (count($user) == 1) {
                $user = collect($user)->first();

                if ($request->input('pass1') != '') {
                    $pass1 = addslashes($request->input('pass1'));
                    $pass2 = addslashes($request->input('pass2'));

                    if ($pass1 == $pass2) {

                        $password = Hash::make($pass1);

                        DB::update("UPDATE users SET pass='$password', verify='1' WHERE id='$user_id'");
                        DB::delete("DELETE FROM reset_password WHERE user_id='$user_id' AND code='$code'");

                        return response()->json(['status' => 'success', 'msg' => 'Password changed successfully']);
                    } else{ 
                        
                        return response()->json([
                        'status' => 'error',
                        'msg' => trans('account.passwords_not_match')
                        ]);
                    }
                }
               
            }
        }

        return view('set_password.index', ['title' => 'Set Password']);
    }

    function verify(Request $request, $user_id, $code)
    {

        $row = DB::select("SELECT id FROM verify WHERE user_id='$user_id' AND code='$code' LIMIT 1");

        if (count($row) == 0) {
            echo '<p>This URL is expired.</p>';
        } else {
            $id = $row->id;   //id of row in verify table

            DB::update("UPDATE users SET verify='1' WHERE id='$user_id'");
            $user = DB::select("SELECT id FROM users WHERE id='$user_id' LIMIT 1");
            if (count($user) != 0) {
                DB::delete("DELETE FROM verify WHERE id='$id'");
                $user = collect($user)->first();

                $request->session()->put('id', $user->id);
                return redirect('/step/1');
            } else echo '<p>' . trans('account.user_not_found') . '</p>';
        }

        $user = DB::table('users')->where('id', $user_id)->first();
        Mail::to($user->email)->send(new WelcomeMessage($user));
    }

    function update_email2(Request $request, $user_id, $code)
    {

        $row = DB::select("SELECT id, update_email FROM users WHERE id='$user_id' AND code='$code' LIMIT 1");

        if (count($row) == 0) {
            echo '<p>This URL is expired.</p>';
        } else {
            $row = collect($row)->first();
            $id = $row->id;   //id of row in verify table

            DB::update("UPDATE users SET email='$row->update_email', update_email='', code='' WHERE id='$user_id'");
            $user = DB::select("SELECT id FROM users WHERE id='$user_id' LIMIT 1");
            if (count($user) != 0) {
                $user = collect($user)->first();
                $request->session()->put('id', $user->id);
                $request->session()->flash('success', trans('account.email_updated'));
                return redirect('email');
            } else echo '<p>' . trans('account.user_not_found') . '</p>';
        }
    }

    public function signout(Request $request)
    {
        $request->session()->put('id', '');
        $request->session()->forget('id');
        Cookie::queue('user_login_token', '', 2628000);
        return redirect('/');
    }

    public function check_email(Request $request)
    {
        //print_r($request->toArray());die;
        $data = array();
        $data['success'] = 0;
        $data['deleted'] = 0;

        $email = addslashes($request->input('email'));
        $check = DB::select("SELECT id, deleted FROM users WHERE email='$email' LIMIT 1");
        if (count($check) == 0) $data['success'] = 1;
        if (count($check) == 1) {
            $check = collect($check)->first();
            if ($check->deleted == '1') $data['deleted'] = 1;
        }
        return redirect('/signup');
        return response()->json($data);
    }

    public function check_email2(Request $request)
    {
        $id = $request->session()->get('verify');
        if ($id == '') return redirect('login');
        $data = array();
        $data['success'] = 0;

        $email = addslashes($request->input('email'));
        $check = DB::select("SELECT id FROM users WHERE email='$email' AND id!='$id' LIMIT 1");
        if (count($check) == 0) $data['success'] = 1;

        return response()->json($data);
    }

    public function check_dob(Request $request)
    {
        $data = array();
        $data['success'] = 0;

        $dob = addslashes($request->input('dob'));
        if ($this->validateDate($dob)) {
            $data['success'] = 1;

            $t_date = new DateTime('today');
            $user_age = date_diff(date_create($dob), $t_date)->y;
            if ($user_age < 18) {
                $data['success'] = 0;
                $data['error'] = trans('account.atleast_18_years');
            }
        } else $data['error'] = trans('account.select_valid_date');

        return response()->json($data);
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function update_email(Request $request)
    {
        $id = $request->session()->get('verify');
        if ($id == '') return redirect('login');
        $data = array();
        $data['success'] = 0;

        $email = addslashes($request->input('email'));
        $check = DB::update("UPDATE users SET email='$email' WHERE id='$id' LIMIT 1");

        $user = DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$id' LIMIT 1");
        if (count($user) == 0) return redirect('login');
        $user = collect($user)->first();

        //send verify link START
        $code = substr(md5(uniqid(rand(), true)), 0, 20);
        DB::insert("INSERT INTO verify (user_id, code) VALUES ('$id','$code')");

        $name = $user->first_name;
        $email = $user->email;
        $id = $user->id;
        $from = env('MAIL_USERNAME');
        $data2 = array(
            'u_id' => $id,
            'code' => $code,
            'email' => $email,
            'from' => $from,
            'name' => $name
        );
        Mail::send('emails.verify', $data2, function ($message) use ($email, $from, $name) {
            $message->from('hello@proximaride.com', 'ProximaRide');
            $message->to($email);
            $message->subject(trans('account.confirm_email_address'));
        });
        $data['success'] = 1;
        //send verify link END

        $data['success'] = 1;

        return response()->json($data);
    }
}
