<?php 
namespace App\Helpers;
use DB;
use Mail;
use DateTime;
use DateInterval;
use DatePeriod;
use Twilio\Rest\Client;
use App;

class common_functions
{   
    public function send_sms($message, $recipients)
    {

        $recipients = "+923044406901";


        try{

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            $client = new Client($account_sid, $auth_token);



            $message = $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => $message] );

             return $message->sid;
        
        }catch(\Twilio\Exceptions\RestException $e)
        {
            return 0;
        }

       


        

        
    }
    
    public function log_activity($request, $activity)
    {   
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        DB::insert("INSERT INTO activity_log (user_id, user_type, activity, on_date) VALUES ('$admin_id', '$admin_type', '$activity', NOW())");
    }
    
    public function record_transaction($request, $user_id, $to_id, $link_id, $type, $price)
    {
        DB::insert("INSERT INTO transactions (user_id, to_id, link_id, type, price, on_date) VALUES ('$user_id', '$to_id', '$link_id', '$type', '$price', NOW())");
    }
    
    public function alert_email($request, $user1, $user2, $link_id, $type)
    {
        if($type=='1')
        {
            //ride booked
            
            $booking=DB::select("SELECT id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride, time_limit FROM bookings WHERE id='$link_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user1' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user2' LIMIT 1");
            $user2=collect($user2)->first();
            
            //send email to driver START
            $name=$user2->first_name;
            $email=$user2->email;
            App::setLocale($user2->lang);
            
            if($booking->status=='1') $text=trans('emails.new_booking', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            else 
            {
                if($booking->time_limit==0)
                $text=trans('emails.new_booking_request', ['l_from'=>$l_from, 'l_to'=>$l_to]);
                else
                $text=trans('emails.new_booking_request_limit', ['l_from'=>$l_from, 'l_to'=>$l_to, 'time_limit'=>$booking->time_limit]);
            }
            
            $code=substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 4);
            $accept_link='proximaride.com/a/'.$code;
            $reject_link='proximaride.com/r/'.$code;
            DB::update("UPDATE bookings SET code='$code' WHERE id='$booking->id'");
            
            if($user2->phone_verified=='1')
            {
                $price=$booking->ride_price*$booking->seats;
                
                if($booking->status=='1')
                    $sms_text=trans('sms.new_booking', ['price'=>$price, 'first_name'=>$user1->first_name, 'phone'=>$user1->country_code.$user1->phone, 'l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a')]);
                else  
                {
                    $sms_text=trans('sms.new_booking_request', ['price'=>$price, 'first_name'=>$user1->first_name, 'phone'=>$user1->country_code.$user1->phone, 'l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a')]);
                    
                    if($user2->country_code!='+91') $sms_text.=trans('sms.reply_actions');
                    else $sms_text.=trans('sms.reply_actions_links', ['accept_link'=>$accept_link, 'reject_link'=>$reject_link]);
                    
                    if($booking->time_limit!=0) $sms_text.=trans('sms.booking_limit', ['time_limit'=>$booking->time_limit]);
                }
                
                $s_id=\CommonFunctions::instance()->send_sms($sms_text, $user2->country_code.$user2->phone);
                DB::update("UPDATE bookings SET s_id='$s_id' WHERE id='$booking->id'");
            }
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            $total_price2='$'.$total_price.' CAD';
            
            $payment_explanation='';
            if($booking->payment_method=='Cash') $payment_explanation=trans('rides.passengers_pay_driver');
            else if($booking->payment_method=='Online payment') $payment_explanation=trans('rides.payment_taken_advanced');
            else if($booking->payment_method=='Secured cash') $payment_explanation=trans('rides.payment_held');
            
            //<b>Booked on:</b> '.date_format(new DateTime($booking->booked_on),'l, F d').' at '.date_format(new DateTime($booking->booked_on),'h:i a').'<br>
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.leaving_on').':</b> '.$booking->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.payment_method').':</b> '.$booking->payment_method.' ('.$payment_explanation.')<br><br>
              
              <b>'.trans('rides.passenger_details').':</b><br>
              '.$user1->first_name.' '.$user1->last_name.'<br>
              '.$user1->phone.'<br>
              '.$user1->email.'<br><br>
              
              '.trans('rides.have_nice_journey').'<br>';
            
            if($booking->status==1) $title=trans('rides.seat_booked');
            else $title=trans('rides.booking_request');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
            $data2=array(
                'email'=>$email,
                'from'=>$from,
                'title'=>$title,
                'name'=>$name,
                'body'=>$body,
                'url'=>$url,
                'url_title'=>$url_title,
                'accept_link'=>url('a/'.$code),
                'reject_link'=>url('r/'.$code)
            );
            
            Mail::send('emails.notification', $data2, function($message) use($email, $from, $name, $title) {
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to driver END
            
            
            //send email to passenger START
            $name=$user1->first_name;
            $email=$user1->email;
            App::setLocale($user1->lang);
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            if($booking->free_ride=='1') $total_price2='<font style="text-decoration:line-through;">$'.$total_price.' CAD</font> ('.trans('rides.free_ride').')';
            else $total_price2='$'.$total_price.' CAD';
            
            $seats_word='';
            if($booking->seats==1) $seats_word=trans('rides.one');
            else if($booking->seats==2) $seats_word=trans('rides.two');
            else if($booking->seats==3) $seats_word=trans('rides.three');
            else if($booking->seats==4) $seats_word=trans('rides.four');
            else if($booking->seats==5) $seats_word=trans('rides.five');
            else if($booking->seats==6) $seats_word=trans('rides.six');
            else if($booking->seats==7) $seats_word=trans('rides.seven');
            
                
            if($booking->status=='1') $text=trans('rides.seat_booked', ['seats_word'=>$seats_word, 'l_from'=>$l_from, 'l_to'=>$l_to]);
            else $text=trans('rides.seat_booked_notify', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user1->phone_verified=='1') 
            {
                $price=$booking->ride_price*$booking->seats;
                if($booking->status=='1') 
                    $sms_text=trans('sms.booking_made', ['l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a')]);
                else 
                    $sms_text=trans('sms.booking_made_notify', ['l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a')]);
                
                \CommonFunctions::instance()->send_sms($sms_text, $user1->country_code.$user1->phone);
            }
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_booked').':</b> '.$booking->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.payment_method').':</b> '.$booking->payment_method.' ('.$payment_explanation.')<br><br>
              
              <b>'.trans('rides.driver_details').':</b><br>
              '.$user2->first_name.' '.$user2->last_name.'<br>
              '.$user2->phone.'<br>
              '.$user2->email.'<br><br>
              
              '.trans('rides.thank_you').'. '.trans('rides.have_nice_journey').'<br>';
            
            if($booking->status==1) $title=trans('rides.seat_booked');
            else $title=trans('rides.booking_placed');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
        else if($type=='1-reminder')
        {
            //booking reminder
            
            $booking=DB::select("SELECT id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride, time_limit, code FROM bookings WHERE id='$link_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, username, email, country_code, phone, phone_verified, profile_image, avatar, gender, lang FROM users WHERE id='$user1' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, username, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user2' LIMIT 1");
            $user2=collect($user2)->first();
            
            //send email to driver START
            $name=$user2->first_name;
            $email=$user2->email;
            App::setLocale($user2->lang);
            
            $accept_link='proximaride.com/a/'.$booking->code;
            $reject_link='proximaride.com/r/'.$booking->code;
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            $total_price2='$'.$total_price.' CAD';
            
            $ride_time=$ride->date.' '.$ride->time;
            $ride_time=strtotime(date_format(new DateTime($ride_time),'Y-m-d H:i'));
            
            $time=date('h:i a', strtotime("-".$booking->time_limit." hours", $ride_time));
            
            $text=trans('emails.booking_to_expire', ['total_price'=>$total_price, 'time'=>$time, 'link'=>url('ride/'.$ride->url)]);
            
            $payment_explanation='';
            if($booking->payment_method=='Cash') $payment_explanation=trans('rides.passengers_pay_driver');
            else if($booking->payment_method=='Online payment') $payment_explanation=trans('rides.payment_taken_advanced');
            else if($booking->payment_method=='Secured cash') $payment_explanation=trans('rides.payment_held');
            
            //<b>Booked on:</b> '.date_format(new DateTime($booking->booked_on),'l, F d').' at '.date_format(new DateTime($booking->booked_on),'h:i a').'<br>
            
            if($user1->gender=='Male')
            $p_img=url('images/male.png');
            else if($user1->gender=='Female')
            $p_img=url('images/female.png');
            else
            $img=url('images/neutral.png');
            if(!empty($user1->profile_image)) $p_img=url('images/profile_images/'.$user1->profile_image);
            else if(!empty($user1->avatar)) $p_img=$user1->avatar;
            
            $body=trans('rides.hi').' '.$name.',<br><br>
              '.$text.'<br>
              
<div style="border:1px solid rgba(0, 0, 0, 0.1); padding:10px;">
    <b>'.trans('emails.booking_pending_approval').':</b><hr style="margin-top:10px; margin-bottom:10px;">
    
    <div style="overflow:hidden;">
    <div style="float:left; padding-top:5px;">
        <a href="'.url('passenger/'.$user1->username).'" style="font-weight:bold;"><img src="'.$p_img.'" style="max-width:30px; max-height:30px;"></a>
    </div>
    <div style="float:left; margin-left:8px;">
        <a href="'.url('ride/'.$ride->url).'" style="font-weight:bold;">'.$l_from.' to '.$l_to.'</a><br>
        on '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br>
        '.$booking->seats.' '.trans('emails.seats_booked_by').' '.$user1->first_name.'
    </div>
    </div>
</div><br>';
            
            $title=trans('emails.booked_need_response', ['first_name'=>$user->first_name, 'total_price'=>$total_price]);
            $url=url('ride/'.$ride->url);
            $url_title=trans('emails.respond_now');
            $from=env('MAIL_USERNAME');
            $data2=array(
                'email'=>$email,
                'from'=>$from,
                'title'=>$title,
                'name'=>$name,
                'body'=>$body,
                'url'=>$url,
                'url_title'=>$url_title,
                'accept_link'=>url('a/'.$booking->code),
                'reject_link'=>url('r/'.$booking->code)
            );
            
            Mail::send('emails.booking_reminder', $data2, function($message) use($email, $from, $name, $title) {
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to driver END
            
        }
        
        else if($type=='6')
        {
            //seat cancelled by passenger
            $cancelled=DB::select("SELECT id, ride_id, seats, booking_id, on_date FROM cancelled_seats WHERE id='$link_id' LIMIT 1");
            $cancelled=collect($cancelled)->first();
            
            $booking=DB::select("SELECT id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride FROM bookings WHERE id='$cancelled->booking_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user1' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user2' LIMIT 1");
            $user2=collect($user2)->first();
            
            //send email to driver START
            $name=$user2->first_name;
            $email=$user2->email;
            App::setLocale($user2->lang);
            
            $text=trans('emails.booking_cancelled', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user2->phone_verified=='1') 
            {
                //\CommonFunctions::instance()->send_sms($text.' Team ProximaRide.', $user2->country_code.$user2->phone);
            }
            
            $total_price=($booking->ride_price*$cancelled->seats);
            if($cancelled->seats==$booking->seats)
            $total_price+=+$booking->booking_price;
            $total_price2='$'.$total_price.' CAD';
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_cancelled').':</b> '.$cancelled->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.cancelled_on').':</b> '.date_format(new DateTime($cancelled->on_date),'l, F d').' at '.date_format(new DateTime($cancelled->on_date),'h:i a').'<br><br>
              
              <b>'.trans('rides.passenger_details').':</b><br>
              '.$user1->first_name.' '.$user1->last_name.'<br>
              '.$user1->phone.'<br>
              '.$user1->email.'<br>';
            
            $title=trans('rides.seat_cancelled');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to driver END
            
            
            //send email to passenger START
            $name=$user1->first_name;
            $email=$user1->email;
            App::setLocale($user1->lang);
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            if($booking->free_ride=='1') $total_price2='<font style="text-decoration:line-through;">$'.$total_price.' CAD</font> ('.trans('rides.free_ride').')';
            else $total_price2='$'.$total_price.' CAD';
            
            $text=trans('emails.seat_cancelled', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user1->phone_verified=='1') 
            {
                //\CommonFunctions::instance()->send_sms($text.' Team ProximaRide.', $user1->country_code.$user1->phone);
            }
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_cancelled').':</b> '.$cancelled->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.payment_method').':</b> '.$booking->payment_method.'<br>
              <b>'.trans('rides.cancelled_on').':</b> '.date_format(new DateTime($cancelled->on_date),'l, F d').' at '.date_format(new DateTime($cancelled->on_date),'h:i a').'<br><br>
              
              <b>'.trans('rides.driver_details').':</b><br>
              '.$user2->first_name.' '.$user2->last_name.'<br>
              '.$user2->phone.'<br>
              '.$user2->email.'<br>';
            
            $title=trans('rides.seat_cancelled');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
        else if($type=='6-b')
        {
            //passenger seat cancelled by driver
            $cancelled=DB::select("SELECT id, ride_id, seats, booking_id, on_date FROM cancelled_seats WHERE id='$link_id' LIMIT 1");
            $cancelled=collect($cancelled)->first();
            
            $booking=DB::select("SELECT id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride FROM bookings WHERE id='$cancelled->booking_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user1' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user2' LIMIT 1");
            $user2=collect($user2)->first();
            
            //send email to driver START
            $name=$user2->first_name;
            $email=$user2->email;
            App::setLocale($user2->lang);
            
            $text=trans('emails.booking_cancelled_driver', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user2->phone_verified=='1')
            {
                //\CommonFunctions::instance()->send_sms($text.' Team ProximaRide.', $user2->country_code.$user2->phone);
            }
            
            $total_price=($booking->ride_price*$cancelled->seats);
            if($cancelled->seats==$booking->seats)
            $total_price+=+$booking->booking_price;
            $total_price2='$'.$total_price.' CAD';
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_cancelled').':</b> '.$cancelled->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.cancelled_on').':</b> '.date_format(new DateTime($cancelled->on_date),'l, F d').' at '.date_format(new DateTime($cancelled->on_date),'h:i a').'<br><br>
              
              <b>'.trans('rides.passenger_details').':</b><br>
              '.$user1->first_name.' '.$user1->last_name.'<br>
              '.$user1->phone.'<br>
              '.$user1->email.'<br>';
            
            $title=trans('rides.seat_cancelled');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to driver END
            
            
            //send email to passenger START
            $name=$user1->first_name;
            $email=$user1->email;
            App::setLocale($user1->lang);
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            if($booking->free_ride=='1') $total_price2='<font style="text-decoration:line-through;">$'.$total_price.' CAD</font> ('.trans('rides.free_ride').')';
            else $total_price2='$'.$total_price.' CAD';
            
            $text=trans('emails.seat_cancelled_driver', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user1->phone_verified=='1') 
            {
                //\CommonFunctions::instance()->send_sms($text.' Team ProximaRide.', $user1->country_code.$user1->phone);
            }
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_cancelled').':</b> '.$cancelled->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.payment_method').':</b> '.$booking->payment_method.'<br>
              <b>'.trans('rides.cancelled_on').':</b> '.date_format(new DateTime($cancelled->on_date),'l, F d').' at '.date_format(new DateTime($cancelled->on_date),'h:i a').'<br><br>
              
              <b>'.trans('rides.driver_details').':</b><br>
              '.$user2->first_name.' '.$user2->last_name.'<br>
              '.$user2->phone.'<br>
              '.$user2->email.'<br>';
            
            $title=trans('rides.seat_cancelled');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
        else if($type=='7')
        {
            //ride cancelled by driver
            $cancelled=DB::select("SELECT id, ride_id, seats, booking_id, on_date FROM cancelled_seats WHERE id='$link_id' LIMIT 1");
            $cancelled=collect($cancelled)->first();
            
            $booking=DB::select("SELECT id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride FROM bookings WHERE id='$cancelled->booking_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user1' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user2' LIMIT 1");
            $user2=collect($user2)->first();
            
            //send email to passenger START
            $name=$user1->first_name;
            $email=$user1->email;
            App::setLocale($user1->lang);
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            if($booking->free_ride=='1') $total_price2='<font style="text-decoration:line-through;">$'.$total_price.' CAD</font> (Free Ride)';
            else $total_price2='$'.$total_price.' CAD';
            
            $text=trans('emails.booking_cancelled_by_driver', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user1->phone_verified=='1')
            {
                $sms_text=trans('sms.booking_cancelled_by_driver', ['l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a')]);
                
                \CommonFunctions::instance()->send_sms($sms_text, $user1->country_code.$user1->phone);
            }
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text.'<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_cancelled').':</b> '.$cancelled->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.payment_method').':</b> '.$booking->payment_method.'<br>
              <b>'.trans('rides.cancelled_on').':</b> '.date_format(new DateTime($cancelled->on_date),'l, F d').' at '.date_format(new DateTime($cancelled->on_date),'h:i a').'<br><br>
              
              <b>'.trans('rides.driver_details').':</b><br>
              '.$user2->first_name.' '.$user2->last_name.'<br>
              '.$user2->phone.'<br>
              '.$user2->email.'<br>';
            
            $title=trans('rides.ride_cancelled');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
        
        else if($type=='8')
        {
            //account password changed
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$user1' LIMIT 1");
            $user1=collect($user1)->first();
            
            //send email to user START
            $name=$user1->first_name;
            $email=$user1->email;
            App::setLocale($user1->lang);
            
            $text=trans('emails.account_password_changed');
            
            if($user1->phone_verified=='1')
            {
                \CommonFunctions::instance()->send_sms($text, $user1->country_code.$user1->phone);
            }
            
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text;
            
            $title=trans('rides.password_changed');
            $url=url('signin');
            $url_title=trans('rides.login_to_account');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
        
        else if($type=='2' OR $type=='3' OR $type=='3-2')
        {
            //ride accepted or rejected
            
            $booking=DB::select("SELECT id, user_id, driver_id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride FROM bookings WHERE id='$link_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$booking->user_id' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$booking->driver_id' LIMIT 1");
            $user2=collect($user2)->first();
            
            //send email to passenger START
            $name=$user1->first_name;
            $email=$user1->email;
            App::setLocale($user1->lang);
            
            
            if($type=='2') $text=trans('emails.booking_accepted', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            else if($type=='3-2') $text=trans('emails.cancelled_no_response', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            else $text=trans('emails.booking_rejected_driver', ['l_from'=>$l_from, 'l_to'=>$l_to]);
            
            if($user1->phone_verified=='1')
            {
                if($type=='2')
                    $sms_text='Important: Your booking from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').' has been accepted. Team ProximaRide.';
                else if($type=='3-2')
                    $sms_text='Important: Sorry your booking from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride->date),'l, F d').' has been cancelled due to no response from the driver. We have refunded you the booking payment. Team ProximaRide.';
                else
                    $sms_text='Important: Sorry your booking from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride->date),'l, F d').' has been rejected. We have refunded you the booking payment. Team ProximaRide.';
                
                \CommonFunctions::instance()->send_sms($sms_text, $user1->country_code.$user1->phone);
            }
            
            if($user2->phone_verified=='1')
            {
                if($type=='2')
                    $sms_text=trans('sms.you_approved_booking', ['first_name'=>$first_name, 'phone'=>$user1->country_code.$user1->phone, 'l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d')]);
                else if($type=='3-2')
                    $sms_text=trans('sms.booking_cancelled_no_response', ['first_name'=>$first_name, 'l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d')]);
                else
                    $sms_text=trans('sms.you_rejected_booking', ['first_name'=>$first_name, 'l_from'=>$l_from, 'l_to'=>$l_to, 'date_time'=>date_format(new DateTime($ride->date),'l, F d')]);
                
                \CommonFunctions::instance()->send_sms($sms_text, $user2->country_code.$user2->phone);
            }
            
            $total_price=($booking->ride_price*$booking->seats)+$booking->booking_price;
            $total_price2='$'.$total_price.' CAD';
            
            $payment_explanation='';
            if($booking->payment_method=='Cash') $payment_explanation=trans('rides.passengers_pay_driver');
            else if($booking->payment_method=='Online payment') $payment_explanation=trans('rides.payment_taken_advanced');
            else if($booking->payment_method=='Secured cash') $payment_explanation=trans('rides.payment_held');
                
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text;
                
            $ride_details='<br><br>
              <b>'.trans('rides.departure').':</b> '.$ride->departure.'<br>
              <b>'.trans('rides.destination').':</b> '.$ride->destination.'<br>
              <b>'.trans('rides.leaving_on').':</b> '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').'<br><br>
              
              <b>'.trans('rides.seats_booked').':</b> '.$booking->seats.'<br>
              <b>'.trans('rides.price_seat').':</b> $'.$booking->ride_price.' CAD<br>
              <b>'.trans('rides.booking_price').':</b> $'.$booking->booking_price.' CAD<br>
              <b>'.trans('rides.total_price').':</b> '.$total_price2.'<br>
              <b>'.trans('rides.payment_method').':</b> '.$booking->payment_method.' ('.$payment_explanation.')<br><br>
              
              <b>'.trans('rides.driver_details').':</b><br>
              '.$user2->first_name.' '.$user2->last_name.'<br>
              '.$user2->phone.'<br>
              '.$user2->email.'<br><br>
              
              '.trans('rides.thank_you').'. '.trans('rides.have_nice_journey').'<br>';
            
            if($type=='2') $body.=$ride_details;
            
            if($type=='2') $title=trans('rides.seat_booked');
            else $title=trans('rides.booking_cancelled');
            $url=url('ride/'.$ride->url);
            $url_title=trans('rides.view_ride');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
        
        else if($type=='4' OR $type=='5')
        {
            //feedback email on ride completion
            
            $booking=DB::select("SELECT id, user_id, driver_id, ride_id, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride FROM bookings WHERE id='$link_id' LIMIT 1");
            $booking=collect($booking)->first();
            
            $ride=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            $user1=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$booking->user_id' LIMIT 1");
            $user1=collect($user1)->first();
            
            $user2=DB::select("SELECT id, first_name, last_name, email, country_code, phone, phone_verified, lang FROM users WHERE id='$booking->driver_id' LIMIT 1");
            $user2=collect($user2)->first();
            
            $p_name=$user1->first_name;
            $d_name=$user2->first_name;
            
            
            if($type=='4') {
                $name=$p_name;
                $email=$user1->email;
                App::setLocale($user1->lang);
                $text=trans('emails.provide_feedback_passenger', ['l_from'=>$l_from, 'l_to'=>$l_to]);
                
                if($user1->phone_verified=='1') 
                {
                    //\CommonFunctions::instance()->send_sms($text.' Team ProximaRide.', $user1->country_code.$user1->phone);
                }
                $title=trans('emails.review_driver', ['l_to'=>$l_to]);
            }
            else if($type=='5') {
                $name=$d_name;
                $email=$user2->email;
                App::setLocale($user2->lang);
                $text=trans('emails.provide_feedback_driver', ['l_from'=>$l_from, 'l_to'=>$l_to, 'p_name'=>$p_name]);
                if($user2->phone_verified=='1') 
                {
                    //\CommonFunctions::instance()->send_sms($text, $user2->country_code.$user2->phone);
                }
                $title=trans('emails.review_passenger');
            }
                
            $body=trans('rides.hi').' '.$name.',<br>
              '.$text;
            
            $url=url('leave-feedback/'.$booking->id);
            $url_title=trans('emails.leave_your_review');
            $from=env('MAIL_USERNAME');
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
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
            //send email to passenger END
        }
    }
    
    public function ride_completed($request, $ride)
    {
        $ride_id=$ride->id;
                DB::update("UPDATE rides SET status='1' WHERE id='$ride_id'");
                
                $driver_id=$ride->added_by;
                $user=DB::select("SELECT * FROM users WHERE id='$driver_id' LIMIT 1");
                $user=collect($user)->first();
                
                $bookings2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status='1'");
                if(count($bookings2)!=0)
                {
                    foreach($bookings2 as $booking)
                    {
                        $seats=$booking->seats;
                        $total_cost=$booking->ride_price*$seats;
                
                        if($booking->payment_method=='Online payment')
                        {
                            //credit the ride price to driver account
                            $new_balance=$user->balance+$total_cost;
                            DB::update("UPDATE users SET balance='$new_balance' WHERE id='$booking->driver_id'");
                    
                            $link_id=$booking->id;
                            //Record transaction START
                            $this->record_transaction($request, $booking->user_id, $booking->driver_id, $link_id, '2', $total_cost);
                            //Record transaction END
                        }
                        else if($booking->payment_method=='Secured cash')
                        {
                            //refund the ride price
                            if($booking->charge_id!='')
                            {
                                //refund amount
                                $refund_id=$this->refund_amount_wallet($request, $booking, $total_cost);
                    
                                //Record transaction START
                                $this->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '5', $total_cost);
                                //Record transaction END
                            }
                        }
                        
                        DB::update("UPDATE bookings SET status='2' WHERE id='$booking->id'");
                        
                        //send email to passenger to leave feedback
                        $email_type='4';
                        //send email START
                        $this->alert_email($request, $booking->user_id, $booking->driver_id, $booking->id, $email_type);
                        //send email END
                
                        //send email to driver to leave feedback
                        $email_type='5';
                        //send email START
                        $this->alert_email($request, $booking->user_id, $booking->driver_id, $booking->id, $email_type);
                        //send email END
                        
                        //give referral booking credits
                        $user=DB::select("SELECT referral, referral_bookings FROM users WHERE id='$booking->user_id' LIMIT 1");
                        $user=collect($user)->first();
                        $referral_bookings=$user->referral_bookings;
                        
                        $user=DB::select("SELECT id, booking_credits FROM users WHERE id='$user->referral' LIMIT 1");
                        if(count($user)==1 AND $referral_bookings<2)
                        {
                            $user=collect($user)->first();
                            $booking_credits=$user->booking_credits+1;
                            DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$user->id'");
                            
                            $referral_bookings+=1;
                            DB::update("UPDATE users SET referral_bookings='$referral_bookings' WHERE id='$booking->user_id'");
                        }
                    }
                }
    }
    
    public function refund_amount_wallet($request, $booking, $total)
    {
        $refund_id='';
        
        $passenger=DB::select("SELECT balance FROM users WHERE id='$booking->user_id' LIMIT 1");
        $passenger=collect($passenger)->first();
        
        $new_balance=$passenger->balance+$total;
        
        DB::update("UPDATE users SET balance='$new_balance' WHERE id='$booking->user_id'");
        
        return $refund_id;
    }
    
    public function recurring($id)
    {
        $t_date=date("Y-m-d");
        
        $row=DB::select("SELECT id, until_date, until_limit, repeated, last_repeated, date FROM rides WHERE id='$id' LIMIT 1");
        foreach($row as $r)
        {
            //echo $r->id.'<br>';
            
            if($r->until_limit!='')
            {
                //echo $r->until_limit;
                for($i=$r->repeated; $i<$r->until_limit-1; $i++)
                {
                    //echo 'create recurrance';
                    $week=$i+1;
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
                    
                    $details=addslashes($row2->details);
                    $notes=addslashes($row2->notes);
                    $pickup=addslashes($row2->pickup);
                    $dropoff=addslashes($row2->dropoff);
                    DB::insert("INSERT INTO rides (url, departure, departure_lat, departure_lng, destination, destination_lat, destination_lng, total_distance, total_time, date, time, recurring, details, seats, model, vehicle_type, other, year, color, license_no, car_type, car_image, smoke, animal_friendly, features, booking_method, max_back_seats, luggage, accept_more_luggage, open_customized, price, payment_method, notes, added_by, added_on, departure_place, departure_route, departure_zipcode, departure_city, departure_state, departure_country, destination_place, destination_route, destination_zipcode, destination_city, destination_state, destination_country, skip_vehicle, parent, pickup, dropoff) VALUES ('$url', '$row2->departure', '$row2->departure_lat', '$row2->departure_lng', '$row2->destination', '$row2->destination_lat', '$row2->destination_lng', '$row2->total_distance', '$row2->total_time', '$repeat_date', '$row2->time', '0', '$details', '$row2->seats', '$row2->model', '$row2->vehicle_type', '$row2->other', '$row2->year', '$row2->color', '$row2->license_no', '$row2->car_type', '$row2->car_image', '$row2->smoke', '$row2->animal_friendly', '$row2->features', '$row2->booking_method', '$row2->max_back_seats', '$row2->luggage', '$row2->accept_more_luggage', '$row2->open_customized', '$row2->price', '$row2->payment_method', '$notes', '$row2->added_by', NOW(), '$row2->departure_place', '$row2->departure_route', '$row2->departure_zipcode', '$row2->departure_city', '$row2->departure_state', '$row2->departure_country', '$row2->destination_place', '$row2->destination_route', '$row2->destination_zipcode', '$row2->destination_city', '$row2->destination_state', '$row2->destination_country', '$row2->skip_vehicle', '$row2->id', '$pickup', '$dropoff')");
                    
                    $repeated=$row2->repeated+1;
                    DB::update("UPDATE rides SET last_repeated='$repeat_date', repeated='$repeated' WHERE id='$r->id'");
                }
                
            }
            else if($r->until_date!='0000-00-00')
            {
                //echo $r->until_date;
                $repeat_date = new DateTime($r->date);
                $repeat_date=$repeat_date->format("Y-m-d");
                while($repeat_date<$r->until_date)
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
                    //echo $repeat_date.'-'; exit();
                    if($repeat_date>$r->until_date) continue;
                    
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
                    
                    DB::insert("INSERT INTO rides (url, departure, departure_lat, departure_lng, destination, destination_lat, destination_lng, total_distance, total_time, date, time, recurring, details, seats, model, vehicle_type, other, year, color, license_no, car_type, car_image, smoke, animal_friendly, features, booking_method, max_back_seats, luggage, accept_more_luggage, open_customized, price, payment_method, notes, added_by, added_on, departure_place, departure_route, departure_zipcode, departure_city, departure_state, departure_country, destination_place, destination_route, destination_zipcode, destination_city, destination_state, destination_country, skip_vehicle, parent, pickup, dropoff) VALUES ('$url', '$row2->departure', '$row2->departure_lat', '$row2->departure_lng', '$row2->destination', '$row2->destination_lat', '$row2->destination_lng', '$row2->total_distance', '$row2->total_time', '$repeat_date', '$row2->time', '0', '$row2->details', '$row2->seats', '$row2->model', '$row2->vehicle_type', '$row2->other', '$row2->year', '$row2->color', '$row2->license_no', '$row2->car_type', '$row2->car_image', '$row2->smoke', '$row2->animal_friendly', '$row2->features', '$row2->booking_method', '$row2->max_back_seats', '$row2->luggage', '$row2->accept_more_luggage', '$row2->open_customized', '$row2->price', '$row2->payment_method', '$row2->notes', '$row2->added_by', NOW(), '$row2->departure_place', '$row2->departure_route', '$row2->departure_zipcode', '$row2->departure_city', '$row2->departure_state', '$row2->departure_country', '$row2->destination_place', '$row2->destination_route', '$row2->destination_zipcode', '$row2->destination_city', '$row2->destination_state', '$row2->destination_country', '$row2->skip_vehicle', '$row2->id', '$row2->pickup', '$row2->dropoff')");
                    
                    $repeated=$row2->repeated+1;
                    $r->repeated=$repeated;
                    DB::update("UPDATE rides SET last_repeated='$repeat_date', repeated='$repeated' WHERE id='$r->id'");
                }
            }
        }
    }
    
    public function pass_ratings($user_id)
    {
        $rating='NA';
        $row2=DB::select("SELECT avg(timeliness) as timeliness, avg(attitude) as attitude, avg(hygiene) as hygiene, avg(safety) as safety, avg(respect) as respect, avg(communication) as communication FROM ratings WHERE driver_id='$user_id' AND type='1' LIMIT 1");
        if(count($row2)==1)
        {
            $r2=collect($row2)->first();
            $rating=($r2->timeliness+$r2->attitude+$r2->safety+$r2->hygiene+$r2->respect+$r2->communication)/6;
        }
        return $rating;
    }
    
    public function rides_driven($driver_id)
    {
        $rides_driven=DB::select("SELECT id FROM rides WHERE added_by='$driver_id' AND status='1'");
        return count($rides_driven);
    }
    
    public function pass_driven($driver_id)
    {
        $pass_driven=DB::select("SELECT id FROM bookings WHERE driver_id='$driver_id' AND status='2'");
        return count($pass_driven);
    }
    
    public function rides_done($driver_id)
    {
        $rides_done=DB::select("SELECT id FROM bookings WHERE user_id='$driver_id' AND status='2'");
        return count($rides_done);
    }
    
    function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
      
    // Declare an empty array 
    $array = array(); 
      
    // Variable that store the date interval 
    // of period 1 day 
    $interval = new DateInterval('P1D'); 
  
    $realEnd = new DateTime($end); 
    $realEnd->add($interval); 
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
  
    // Use loop to store date into array 
    foreach($period as $date) {                  
        $array[] = $date->format($format);  
    } 
  
    // Return the array elements 
    return $array; 
    } 
    
    public function next_posts($post_category, $post_id)
    {   
        $next_posts=DB::select("SELECT category, slug, unique_id, title, image FROM blog_posts WHERE category='$post_category' AND id<'$post_id' LIMIT 4");
        if(count($next_posts)<4)
        {
            $next_posts=DB::select("SELECT category, slug, unique_id, title, image FROM blog_posts WHERE category='$post_category' AND id!='$post_id' LIMIT 4");
        }
        return $next_posts;
    }
    
    public function authors_posts($post_author_id, $post_id)
    {   
        $author_posts=DB::select("SELECT category, slug, unique_id, title, image FROM blog_posts WHERE id<'$post_id' AND author_id='$post_author_id' ORDER BY id DESC LIMIT 4,4");
        if(count($author_posts)<3)
        {
            $author_posts=DB::select("SELECT category, slug, unique_id, title, image FROM blog_posts WHERE id!='$post_id' AND author_id='$post_author_id' ORDER BY id DESC LIMIT 4");
        }
        return $author_posts;
    }
    
    public function trending_posts($post_category)
    {   
        $trending_posts=DB::select("SELECT category, slug, unique_id, title, image FROM blog_posts WHERE category='$post_category' ORDER BY views DESC LIMIT 5");
        return $trending_posts;
    }
    
    public function remove_extra_words($request, $string)
    {
        $string=preg_replace('/\ba(\W|$)/i', '', $string);
        $string=preg_replace('/\ban(\W|$)/i', '', $string);
        
        return $string;
    }
    
    public function compress_image($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
    }

     public static function instance()
     {
         return new common_functions();
     }
}
?>