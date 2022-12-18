<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Twilio\Rest\Client;
use Twilio\Twiml\MessagingResponse;
use Mail;

class home extends Controller
{
    public function index(Request $request)
    {

        //\CommonFunctions::instance()->send_sms('12345 is your OTP for ProximaRide.', '+919319669446');

        /*$account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create('+919319669446', 
        ['from' => $twilio_number, 'body' => 'ProximaRide test: Reply Yes to this message please.', 'statusCallback' => 'https://project.codingwww.com/proximaride/public/sms-response'] );*/

        $id = $request->session()->get('id');

        if ($id != '' and $id != 0) {
            $user = DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
            $user = collect($user)->first();

            if ($user->step != 0) {
                $path = $request->path();
                if ($user->step == 1 and $path != 'welcome/step1of5') {
                    return redirect('welcome/step1of5');
                } else if ($user->step == 2 and $path != 'welcome/step2of5') {
                    return redirect('welcome/step2of5');
                } else if ($user->step == 3 and $path != 'welcome/step3of5') {
                    return redirect('welcome/step3of5');
                } else if ($user->step == 4 and $path != 'welcome/step4of5') {
                    return redirect('welcome/step4of5');
                } else if ($user->step == 5 and $path != 'welcome/step5of5') {
                    return redirect('welcome/step5of5');
                }
            }
        }

        $row = DB::select("SELECT id FROM ratings WHERE feature='1'");
        $total_ratings = count($row);

        $satisfied = array();
        $i = 0;
        $row = DB::select("SELECT id, review, user_id FROM ratings WHERE feature='1' LIMIT 4");
        foreach ($row as $r) {
            $user = DB::select("SELECT first_name, last_name, gender, avatar, profile_image, dob, country, username FROM users WHERE id='$r->user_id' LIMIT 1");
            if (count($user) == 0) continue;
            $user = collect($user)->first();
            $satisfied[$i]['rating'] = $r;

            $satisfied[$i]['user'] = $user;

            $t_date = new DateTime('today');
            $driver_age = date_diff(date_create($user->dob), $t_date)->y;
            $satisfied[$i]['user_age'] = $driver_age;

            $i++;
        }
        $rides = DB::select("SELECT id, date, url, departure_city, destination_city, departure_place, destination_place, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure_state_short, destination_state_short, departure, destination, price, pickup, dropoff FROM rides WHERE status='0' ORDER BY date ASC LIMIT 4");
        return view('index', ['title' => 'Home', 'rides' => $rides, 'satisfied' => $satisfied, 'total_ratings' => $total_ratings]);
    }

    public function accept_url(Request $request, $code)
    {
        $booking = DB::select("SELECT * FROM bookings WHERE code='$code' LIMIT 1");
        if (count($booking) == 1) {
            $booking = collect($booking)->first();
            $this->sms_response($request, $booking->s_id, 'yes', 1);
        }
    }

    public function reject_url(Request $request, $code)
    {
        $booking = DB::select("SELECT * FROM bookings WHERE code='$code' LIMIT 1");
        if (count($booking) == 1) {
            $booking = collect($booking)->first();
            $this->sms_response($request, $booking->s_id, 'no', 1);
        }
    }

    public function sms_response(Request $request, $s_id = '', $body = '', $url = 0)
    {
        //$response = new MessagingResponse();
        /*$response->message('SID: '.$s_id.', Status: '.$status,
        ['to' => '+919319669446']);*/

        if ($url == 0) {
            $s_id = $request->input('MessageSid');
            $body = strtolower($request->input('Body'));
        }
        $from = $request->input('From');
        $status = $request->input('MessageStatus');

        if ($body == 'yes') {
            //accept the booking
            $check = DB::select("SELECT * FROM bookings WHERE s_id='$s_id' LIMIT 1");
            if (count($check) == 1) {
                $check = collect($check)->first();
                $ride = DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$check->ride_id' LIMIT 1");
                $ride = collect($ride)->first();

                $l_from = $ride->departure_city;
                $l_to = $ride->destination_city;

                $user1 = DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified FROM users WHERE id='$check->user_id' LIMIT 1");
                $user1 = collect($user1)->first();

                if ($check->status == 0) {
                    DB::update("UPDATE bookings SET status='1' WHERE id='$check->id'");

                    //$sms_text2='Important: Your booking from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').' has been accepted. Team ProximaRide.';
                    //\CommonFunctions::instance()->send_sms($sms_text2, $user1->country_code.$user1->phone);

                    //send email START
                    \CommonFunctions::instance()->alert_email($request, $check->user_id, $check->driver_id, $check->id, '2');
                    //send email END
                } else {
                    if ($check->status == 1) $sms_text = 'ProximaRide: Booking already accepted.';
                    else if ($check->status == 2) $sms_text = 'ProximaRide: Booking has marked as completed.';
                    else if ($check->status == 3) $sms_text = 'ProximaRide: This booking is rejected.';
                    else if ($check->status == 4) $sms_text = 'ProximaRide: This booking is cancelled.';

                    \CommonFunctions::instance()->send_sms($sms_text, $user1->country_code . $user1->phone);
                }
            }
        } else if ($body == 'no') {
            //reject the booking
            $check = DB::select("SELECT * FROM bookings WHERE s_id='$s_id' LIMIT 1");
            if (count($check) == 1) {
                $check = collect($check)->first();
                $ride = DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$check->ride_id' LIMIT 1");
                $ride = collect($ride)->first();

                $l_from = $ride->departure_city;
                $l_to = $ride->destination_city;

                $user1 = DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified FROM users WHERE id='$check->driver_id' LIMIT 1");
                $user1 = collect($user1)->first();

                if ($check->status == 0) {
                    DB::update("UPDATE bookings SET status='3' WHERE id='$check->id'");

                    //$sms_text2='Important: Sorry your booking from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride->date),'l, F d').' has been rejected. We have refunded you the booking payment. Team ProximaRide.';
                    //\CommonFunctions::instance()->send_sms($sms_text2, $user1->country_code.$user1->phone);

                    $booking = $check;
                    $refund_amount = $booking->ride_price * $booking->seats;
                    if ($booking->payment_method == 'Cash') $refund_amount = 0;
                    $refund_amount += $booking->booking_price;

                    if (($booking->payment_method == 'Online payment' or $booking->payment_method == 'Secured cash' or $booking->payment_method == 'Cash') and $booking->free_ride == '0') {
                        //refund the ride price
                        if (1) {
                            $refund_id = '';
                            if ($refund_amount != 0) {
                                //refund amount
                                $refund_id = \CommonFunctions::instance()->refund_amount_wallet($request, $booking, $refund_amount);

                                //Record transaction START
                                \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '3', $refund_amount);
                                //Record transaction END
                            }

                            //track cancelled seat
                            DB::insert("INSERT INTO cancelled_seats (user_id, booking_id, driver_id, ride_id, seats, refund_amount, refund_id, on_date) VALUES ('$booking->user_id', '$booking->id', '$booking->driver_id', '$booking->ride_id', '$booking->seats', '$refund_amount', '$refund_id', NOW())");
                            $cancelled_id = DB::getPdo()->lastInsertId();
                        }
                    } else if ($booking->free_ride == '1') {
                        //refund user free ride
                        $user = DB::select("SELECT free_rides FROM users WHERE id='$booking->user_id' LIMIT 1");
                        $user = collect($user)->first();

                        $new_free_rides = $user->free_rides + 1;
                        DB::update("UPDATE users SET free_rides='$new_free_rides' WHERE id='$booking->user_id'");
                    }

                    //send email START
                    \CommonFunctions::instance()->alert_email($request, $check->user_id, $check->driver_id, $check->id, '3');
                    //send email END
                } else {
                    if ($check->status == 1) $sms_text = 'ProximaRide: Booking already accepted.';
                    else if ($check->status == 2) $sms_text = 'ProximaRide: Booking has marked as completed.';
                    else if ($check->status == 3) $sms_text = 'ProximaRide: This booking is rejected.';
                    else if ($check->status == 4) $sms_text = 'ProximaRide: This booking is cancelled.';

                    \CommonFunctions::instance()->send_sms($sms_text, $user1->country_code . $user1->phone);
                }
            }
        }

        /*$account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        
        $s_id="SM330d5befa5ab4125b3b24f4b2df676a6";
        $message = $client->messages($s_id)->fetch();
        $account_id=$message->accountSid;
        $s_id=$message->sid;
        $body=$message->body;
        $from=$message->from;
        
        if($body)
        exit();*/

        $body = 'SID: ' . $s_id . ', From: ' . $from . ', Body: ' . $body . ', Status: ' . $status;

        DB::insert("INSERT INTO temp (response) VALUES ('$body')");

        $response = '<Response>
<Message></Message>
</Response>';

        /*$s_id=$request->input('MessageSid');
        
            $title='SMS';
            $url=url('ride/');
            $url_title='View Ride';
            $from=env('MAIL_USERNAME');
            $email='ushaib.ushi@gmail.com';
            $name='Ushaib';
            $data2=array(
                'email'=>$email,
                'from'=>$from,
                'title'=>$title,
                'name'=>$name,
                'body'=>$body,
                'url'=>$url,
                'url_title'=>$url_title
            );
            
            Mail::send('emails.notification', $data2, function($message) use($email, $from, $name, $title) {
                $message->from('developer@codingwww.com', 'codingWWW');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });*/

        return response($response)
            ->header('Content-Type', 'text/xml');
    }

    public function cron_job_5(Request $request)
    {
        $t_date = date('Y-m-d');

        //check and mark rides as completed
        $row = DB::select("SELECT id, total_time, date, time, status, added_by FROM rides WHERE status='0' AND date<='$t_date'");
        foreach ($row as $r) {
            if ($r->total_time == '') continue;

            $time = explode(' day ', $r->total_time);
            if (isset($time[0]) and isset($time[1])) $time_hours = $time[0] * 24;
            else if (!isset($time[0])) $time_hours = explode(' hours ', $r->total_time)[0];
            else $time_hours = 1;

            if (isset($time[0])) {
                //check if ride is completed
                $date = new DateTime($r->date . " " . $r->time);
                $date->modify("+" . $time_hours . " hours");
                $completion_time = $date->format("Y-m-d H:i:00");

                if ($completion_time <= date('Y-m-d H:i:00')) {
                    //echo 'Ride completed';
                    $ride2 = $r;
                    \CommonFunctions::instance()->ride_completed($request, $ride2);
                }
            }
        }

        $row = DB::select("SELECT id, ride_id, time_limit, ride_price, booking_price, seats, payment_method, free_ride, user_id, driver_id FROM bookings WHERE status='0'");
        foreach ($row as $r) {
            $booking = $r;
            //check if time expired for accepting booking
            $ride = DB::select("SELECT date, time FROM rides WHERE id='$r->ride_id' LIMIT 1");
            $ride = collect($ride)->first();

            $ride_time = $ride->date . ' ' . $ride->time;
            $ride_time = strtotime(date_format(new DateTime($ride_time), 'Y-m-d H:i'));
            $current_time = strtotime(date('Y-m-d H:i'));

            $diff = $ride_time - $current_time;
            $hours = $diff / (60 * 60);

            if ($hours >= 36) $time_limit = 12;
            else if ($hours >= 12 and $hours <= 36) $time_limit = 6;
            else if ($hours >= 6 and $hours <= 12) $time_limit = 3;

            //echo 'Limit: '.$r->time_limit.' hours<br>';
            //echo $hours.' hours remaining<br><br>';

            if ($hours <= $r->time_limit) {
                //echo 'Limit expired.';

                $email_type = '3-2';

                $refund_amount = $r->ride_price * $r->seats;
                if ($r->payment_method == 'Cash') $refund_amount = 0;
                $refund_amount += $r->booking_price;

                if (($r->payment_method == 'Online payment' or $r->payment_method == 'Secured cash' or $r->payment_method == 'Cash') and $r->free_ride == '0') {
                    //refund the ride price
                    if (1) {
                        $refund_id = '';
                        if ($refund_amount != 0) {
                            //refund amount
                            $refund_id = \CommonFunctions::instance()->refund_amount_wallet($request, $booking, $refund_amount);

                            //Record transaction START
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '3', $refund_amount);
                            //Record transaction END
                        }

                        //track cancelled seat
                        DB::insert("INSERT INTO cancelled_seats (user_id, booking_id, driver_id, ride_id, seats, refund_amount, refund_id, on_date) VALUES ('$booking->user_id', '$booking->id', '$booking->driver_id', '$booking->ride_id', '$booking->seats', '$refund_amount', '$refund_id', NOW())");
                        $cancelled_id = DB::getPdo()->lastInsertId();
                    }
                } else if ($booking->free_ride == '1') {
                    //refund user free ride
                    $user = DB::select("SELECT free_rides FROM users WHERE id='$booking->user_id' LIMIT 1");
                    $user = collect($user)->first();

                    $new_free_rides = $user->free_rides + 1;
                    DB::update("UPDATE users SET free_rides='$new_free_rides' WHERE id='$booking->user_id'");
                }

                //send email START
                \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $booking->id, $email_type);
                //send email END

                DB::update("UPDATE bookings SET status='3' WHERE id='$r->id'");
            } else if ($hours <= ($r->time_limit / 2) and $reminder == 0) {
                //booking reminder at half time remaining
                \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $booking->id, '1-reminder');

                DB::update("UPDATE bookings SET reminder='1' WHERE id='$r->id'");
            } else if ($hours <= 1 and $reminder == 1) {
                //booking reminder at 1 hour left
                \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $booking->id, '1-reminder');

                DB::update("UPDATE bookings SET reminder='2' WHERE id='$r->id'");
            }
        }

        //create recurring rides
        /*$row=DB::select("SELECT id, until_date, until_limit, repeated, last_repeated, date FROM rides WHERE recurring='1' AND (last_repeated='0000-00-00' OR last_repeated<='$t_date')");
        foreach($row as $r)
        {
            //echo $r->id.'<br>';
            
            if($r->until_limit!='')
            {
                //echo $r->until_limit;
                if($r->repeated<$r->until_limit)
                {
                    //echo 'create recurrance';
                    $week=$r->repeated+1;
                    $repeat_date = new DateTime($r->date);
                    $repeat_date->modify("+".$week." week");
                    $repeat_date=$repeat_date->format("Y-m-d");
                    
                    while($repeat_date<=$t_date)
                    {
                        $week+=1;
                        $repeat_date = new DateTime($r->date);
                        $repeat_date->modify("+".$week." week");
                        $repeat_date=$repeat_date->format("Y-m-d");
                    }
                    //echo $repeat_date;
                    
                    $row2=DB::select("SELECT * FROM rides WHERE id='$r->id' LIMIT 1");
                    $row2=collect($row2)->first();
                    
                    $from=$row2->departure_city;
                    $to=$row2->destination_city;
                    if($from=='') $from=$row2->departure_state;
                    if($to=='') $to=$row2->destination_state;
                    if($from=='') $from=$row2->departure;
                    if($to=='') $to=$row2->destination;
                    
                    $url=$from.' to '.$to;
                    $url=substr($url, 0, 130);
                    $url=str_replace(' ', '-', strtolower($url));
                    $url=preg_replace("/[^A-Za-z0-9-]/", '', $url);
                    
                    $check=DB::select("SELECT id FROM rides ORDER BY id DESC LIMIT 1");
                    if(count($check)==1)
                    {
                        $check=collect($check)->first();
                        $url.='-'.($check->id+1);
                    }
                    else $url.='-1';
                    
                    DB::insert("INSERT INTO rides (url, departure, departure_lat, departure_lng, destination, destination_lat, destination_lng, total_distance, total_time, date, time, recurring, details, seats, model, vehicle_type, other, year, color, license_no, car_type, car_image, smoke, animal_friendly, features, booking_method, max_back_seats, luggage, accept_more_luggage, open_customized, price, payment_method, notes, added_by, added_on, departure_place, departure_route, departure_zipcode, departure_city, departure_state, departure_country, destination_place, destination_route, destination_zipcode, destination_city, destination_state, destination_country, skip_vehicle, parent) VALUES ('$url', '$row2->departure', '$row2->departure_lat', '$row2->departure_lng', '$row2->destination', '$row2->destination_lat', '$row2->destination_lng', '$row2->total_distance', '$row2->total_time', '$repeat_date', '$row2->time', '0', '$row2->details', '$row2->seats', '$row2->model', '$row2->vehicle_type', '$row2->other', '$row2->year', '$row2->color', '$row2->license_no', '$row2->car_type', '$row2->car_image', '$row2->smoke', '$row2->animal_friendly', '$row2->features', '$row2->booking_method', '$row2->max_back_seats', '$row2->luggage', '$row2->accept_more_luggage', '$row2->open_customized', '$row2->price', '$row2->payment_method', '$row2->notes', '$row2->added_by', NOW(), '$row2->departure_place', '$row2->departure_route', '$row2->departure_zipcode', '$row2->departure_city', '$row2->departure_state', '$row2->departure_country', '$row2->destination_place', '$row2->destination_route', '$row2->destination_zipcode', '$row2->destination_city', '$row2->destination_state', '$row2->destination_country', '$row2->skip_vehicle', '$row2->id')");
                    
                    $repeated=$row2->repeated+1;
                    DB::update("UPDATE rides SET last_repeated='$repeat_date', repeated='$repeated' WHERE id='$r->id'");
                }
                
            }
            else if($r->until_date!='0000-00-00')
            {
                //echo $r->until_date;
                if($until_date>$date)
                {
                    //echo 'create recurrance';
                    $week=$r->repeated+1;
                    $repeat_date = new DateTime($r->date);
                    $repeat_date->modify("+".$week." week");
                    $repeat_date=$repeat_date->format("Y-m-d");
                    
                    while($repeat_date<=$date)
                    {
                        $week+=1;
                        $repeat_date = new DateTime($r->date);
                        $repeat_date->modify("+".$week." week");
                        $repeat_date=$repeat_date->format("Y-m-d");
                    }
                    //echo $repeat_date;
                    if($repeat_date>$until_date) continue;
                    
                    $row2=DB::select("SELECT * FROM rides WHERE id='$r->id' LIMIT 1");
                    $row2=collect($row2)->first();
                    
                    $from=$row2->departure_city;
                    $to=$row2->destination_city;
                    if($from=='') $from=$row2->departure_state;
                    if($to=='') $to=$row2->destination_state;
                    if($from=='') $from=$row2->departure;
                    if($to=='') $to=$row2->destination;
                    
                    $url=$from.' to '.$to;
                    $url=substr($url, 0, 130);
                    $url=str_replace(' ', '-', strtolower($url));
                    $url=preg_replace("/[^A-Za-z0-9-]/", '', $url);
                    
                    $check=DB::select("SELECT id FROM rides ORDER BY id DESC LIMIT 1");
                    if(count($check)==1)
                    {
                        $check=collect($check)->first();
                        $url.='-'.($check->id+1);
                    }
                    else $url.='-1';
                    
                    DB::insert("INSERT INTO rides (url, departure, departure_lat, departure_lng, destination, destination_lat, destination_lng, total_distance, total_time, date, time, recurring, details, seats, model, vehicle_type, other, year, color, license_no, car_type, car_image, smoke, animal_friendly, features, booking_method, max_back_seats, luggage, accept_more_luggage, open_customized, price, payment_method, notes, added_by, added_on, departure_place, departure_route, departure_zipcode, departure_city, departure_state, departure_country, destination_place, destination_route, destination_zipcode, destination_city, destination_state, destination_country, skip_vehicle, parent) VALUES ('$url', '$row2->departure', '$row2->departure_lat', '$row2->departure_lng', '$row2->destination', '$row2->destination_lat', '$row2->destination_lng', '$row2->total_distance', '$row2->total_time', '$repeat_date', '$row2->time', '0', '$row2->details', '$row2->seats', '$row2->model', '$row2->vehicle_type', '$row2->other', '$row2->year', '$row2->color', '$row2->license_no', '$row2->car_type', '$row2->car_image', '$row2->smoke', '$row2->animal_friendly', '$row2->features', '$row2->booking_method', '$row2->max_back_seats', '$row2->luggage', '$row2->accept_more_luggage', '$row2->open_customized', '$row2->price', '$row2->payment_method', '$row2->notes', '$row2->added_by', NOW(), '$row2->departure_place', '$row2->departure_route', '$row2->departure_zipcode', '$row2->departure_city', '$row2->departure_state', '$row2->departure_country', '$row2->destination_place', '$row2->destination_route', '$row2->destination_zipcode', '$row2->destination_city', '$row2->destination_state', '$row2->destination_country', '$row2->skip_vehicle', '$row2->id')");
                    
                    $repeated=$row2->repeated+1;
                    DB::update("UPDATE rides SET last_repeated='$repeat_date', repeated='$repeated' WHERE id='$r->id'");
                }
            }
        }*/
    }

    public function contact_us(Request $request)
    {
        return view('contact_us.index', ['title' => 'Contact Us']);
    }

    public function how_it_works(Request $request)
    {

        $id = $request->session()->get('id');

        $lang = $request->session()->get('locale');

        if ($lang == null) {
            // code...
            $lang = "en";
        }


        $get = DB::select("SELECT * FROM videos WHERE page = ? AND lang = ?", ["how-it-works", $lang]);

        $link = "";

        if (count($get) <= 0) {
            // code...

            $link = "https://youtu.be/j7IRe6S7txo";
        } else {

            $c = collect($get)->first();

            $link = $c->link;
        }

        $link = $this->embed_link($link);

        return view('how_it_works.index', ['title' => 'How it Works', 'link' => $link]);
    }

    public function help(Request $request)
    {
        return view('help.index', ['title' => 'Help']);
    }

    public function students(Request $request)
    {

        $id = $request->session()->get('id');

        $lang = $request->session()->get('locale');

        if ($lang == null) {
            // code...
            $lang = "en";
        }


        $get = DB::select("SELECT * FROM videos WHERE page = ? AND lang = ?", ["student", $lang]);

        $link = "";

        if (count($get) <= 0) {
            // code...

            $link = "https://youtu.be/j7IRe6S7txo";
        } else {

            $c = collect($get)->first();

            $link = $c->link;
        }

        $link = $this->embed_link($link);

        return view('students.index', ['title' => 'Students', 'link' => $link]);
    }

    public function embed_link($url)
    {
        $parsedUrl = parse_url($url);
        # extract query string
        parse_str(@$parsedUrl['query'], $queryString);
        $youtubeId = @$queryString['v'] ?? substr(@$parsedUrl['path'], 1);

        return "https://youtube.com/embed/{$youtubeId}";
    }

    public function for_drivers(Request $request)
    {

        $id = $request->session()->get('id');

        $lang = $request->session()->get('locale');

        if ($lang == null) {
            // code...
            $lang = "en";
        }


        $get = DB::select("SELECT * FROM videos WHERE page = ? AND lang = ?", ["drivers", $lang]);

        $link = "";

        if (count($get) <= 0) {
            // code...

            $link = "https://youtu.be/K68UrdUOr2Y";
        } else {

            $c = collect($get)->first();

            $link = $c->link;
        }

        $link = $this->embed_link($link);

        return view('for_drivers.index', ['title' => 'Drivers', 'link' => $link]);
    }

    public function for_passengers(Request $request)
    {
        $id = $request->session()->get('id');

        $lang = $request->session()->get('locale');

        if ($lang == null) {
            // code...
            $lang = "en";
        }


        $get = DB::select("SELECT * FROM videos WHERE page = ? AND lang = ?", ["passengers", $lang]);

        $link = "";

        if (count($get) <= 0) {
            // code...

            $link = "https://www.youtube.com/watch?v=AkqMQtV71Po";
        } else {

            $c = collect($get)->first();

            $link = $c->link;
        }

        $link = $this->embed_link($link);

        return view('for_passengers.index', ['title' => 'Passengers', 'link' => $link]);
    }

    public function covid(Request $request)
    {
        return view('covid.index', ['title' => 'Covid-19']);
    }

    public function faq(Request $request)
    {
        return view('faq.index', ['title' => 'FAQ']);
    }

    public function partners(Request $request)
    {
        return view('partners.index', ['title' => 'Partners']);
    }

    public function news(Request $request)
    {
        if ($request->input('s') != '') {
            $s = $request->input('s');
            $news = DB::select("SELECT * FROM articles WHERE agency='$s' ORDER BY id DESC");
        } else
            $news = DB::select("SELECT * FROM articles ORDER BY id DESC");
        return view('news.index', ['title' => 'News', 'news' => $news]);
    }

    public function article(Request $request, $url)
    {
        $article = DB::select("SELECT * FROM articles WHERE url='$url' LIMIT 1");
        $article = collect($article)->first();
        return view('article.index', ['title' => $article->title . ' | ' . $article->agency . ' | Article', 'article' => $article]);
    }

    public function satisfied_members(Request $request)
    {
        $satisfied = array();
        $i = 0;
        $row = DB::select("SELECT id, review, user_id FROM ratings WHERE feature='1' LIMIT 4");
        foreach ($row as $r) {
            $user = DB::select("SELECT first_name, last_name, gender, avatar, profile_image, dob, country, username FROM users WHERE id='$r->user_id' LIMIT 1");
            if (count($user) == 0) continue;
            $user = collect($user)->first();
            $satisfied[$i]['rating'] = $r;

            $satisfied[$i]['user'] = $user;

            $t_date = new DateTime('today');
            $driver_age = date_diff(date_create($user->dob), $t_date)->y;
            $satisfied[$i]['user_age'] = $driver_age;

            $i++;
        }
        return view('satisfied_members.index', ['title' => 'Satisfied Members', 'satisfied' => $satisfied]);
    }

    public function terms_service(Request $request)
    {
        return view('terms_service.index', ['title' => 'Terms of Service']);
    }

    public function terms_conditons(Request $request)
    {
        return view('terms_conditions.index', ['title' => 'Terms and Conditions ']);
    }

    public function terms_use(Request $request)
    {
        return view('terms_use.index', ['title' => 'Terms of Use']);
    }

    public function privacy_policy(Request $request)
    {
        return view('privacy_policy.index', ['title' => 'Privacy Policy']);
    }

    function set_locale($locale) {
        if (in_array($locale, \Config::get('app.locales'))) {
          Session::put('locale', $locale);
        }
        return redirect()->back();
      }
}
