<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class rides extends Controller
{


    

    public function rides_closed(Request $request)
    {

        $user_id=$request->session()->get('id');
        
        $rides_closed=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status='0' AND closed = '1' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_posted[$i]['ride']=$r;
            
            $i++;
        }
        
        
        return view('closed_rides.index', ['title'=>'My Rides', 'rides_posted'=>$rides_closed]);


    }


    public function view_ride(Request $request, $url)
    {
        $user_id=$request->session()->get('id');
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE url='$url' LIMIT 1");
        if(count($row)==0) return redirect('/');
        foreach($row as $r)
        {
            $request->session()->put('signup_next', 'ride/'.$r->url);
            
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, phone_verified, driver, profile_image, dob, username FROM users WHERE id='$r->added_by' LIMIT 1");
            $row2=collect($row2)->first();
            $ride[$i]['driver']=$row2;
            
            $t_date=new DateTime('today');
            $driver_age=date_diff(date_create($row2->dob), $t_date)->y;
            $ride[$i]['driver_age']=$driver_age;
            
            $ride[$i]['driver_ratings']='NA';
            $row2=DB::select("SELECT avg(timeliness) as timeliness, avg(vehicle_condition) as vehicle_condition, avg(safety) as safety, avg(conscious) as conscious, avg(comfort) as comfort, avg(communication) as communication FROM ratings WHERE driver_id='$r->added_by' AND type='1' LIMIT 1");
            if(count($row2)==1)
            {
                $r2=collect($row2)->first();
                $ride[$i]['driver_ratings']=($r2->timeliness+$r2->vehicle_condition+$r2->safety+$r2->conscious+$r2->comfort+$r2->communication)/6;
            }
            
            $i++;
        }
        
        
        $row2=DB::select("SELECT id, booked_on FROM bookings WHERE ride_id='$ride_id' AND status='5'");
        foreach($row2 as $r2)
        {
            $date = new DateTime($r2->booked_on);
            $date->modify("+15 minutes");
            $timeout=$date->format("Y-m-d H:i:00");
            
            if($timeout<=date("Y-m-d H:i:00"))
            {
                //echo 'Timeout';
                DB::update("UPDATE bookings SET status='4' WHERE id='$r2->id'");
            }
        }
        
        $bookings=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status!='3' AND status!='4'");
        foreach($row2 as $r2)
        {
            for($j=0; $j<$r2->seats; $j++) 
            {
                $bookings[$i]['booking']=$r2;
            
                $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username FROM users WHERE id='$r2->user_id' LIMIT 1");
                $passenger=collect($passenger)->first();
                $bookings[$i]['passenger']=$passenger;
            
                $i++;
            }
        }
        
        $bookings_requests=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status='0'");
        foreach($row2 as $r2)
        {
            $bookings_requests[$i]['booking']=$r2;
            
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username FROM users WHERE id='$r2->user_id' LIMIT 1");
            $passenger=collect($passenger)->first();
            $bookings_requests[$i]['passenger']=$passenger;
            
            $i++;
        }
        
        $ratings=array(); $i=0;
        $row=DB::select("SELECT * FROM ratings WHERE ride_id='$ride_id' AND type='1' ORDER BY id DESC");
        foreach($row as $r)
        {
            $ratings[$i]['rating']=$r;
            $ratings[$i]['avg_rating']=($r->timeliness+$r->vehicle_condition+$r->safety+$r->conscious+$r->comfort+$r->communication)/6;
            
            $ratings[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->user_id' LIMIT 1");
            if(count($row2)==1) {
                $row2=collect($row2)->first();
                $ratings[$i]['user']=$row2;
            }
            
            $ratings[$i]['driver_rating']='NA';
            $row2=DB::select("SELECT * FROM ratings WHERE ride_id='$ride_id' AND type='2' AND user_id='$r->user_id' ORDER BY id DESC");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $ratings[$i]['driver_rating']=$row2;
                $ratings[$i]['avg_rating_driver']=($r->timeliness+$r->attitude+$r->safety+$r->hygiene+$r->respect+$r->communication)/6;
                
                $ratings[$i]['driver']='NA';
                $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->driver_id' LIMIT 1");
                if(count($row2)==1) 
                {
                    $row2=collect($row2)->first();
                    $ratings[$i]['driver']=$row2;
                }
            }
            
            
            $i++;
        }
        
        $user_ride=DB::select("SELECT id, status FROM bookings WHERE user_id='$user_id' AND ride_id='$ride_id' AND status!='4' ORDER BY id DESC LIMIT 1");
        if(count($user_ride)==1) {
            $user_ride=collect($user_ride)->first();
            
            $user_rating=DB::select("SELECT id, rating, review FROM ratings WHERE user_id='$user_id' AND ride_id='$ride_id' AND booking_id='$user_ride->id' LIMIT 1");
            if(count($user_rating)==1) {
                $user_rating=collect($user_rating)->first();
            }
            else $user_rating='NA';
        } 
        else { $user_ride='NA'; $user_rating='NA'; }
        
        $user_cards=DB::select("SELECT * FROM cards WHERE user_id='$user_id' ORDER BY id DESC");
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        
        $from=$ride[0]['ride']->departure_city;
        $to=$ride[0]['ride']->destination_city;
                    
        if($from=='') $from=$ride[0]['ride']->departure_place;
        if($to=='') $to=$ride[0]['ride']->destination_place;

        if($from=='') $from=$ride[0]['ride']->departure_state;
        if($to=='') $to=$ride[0]['ride']->destination_state;

        if($from=='') $from=$ride[0]['ride']->departure;
        if($to=='' OR $from==$to) $to=$ride[0]['ride']->destination;
        
        $time=explode(' day ', $ride[0]['ride']->total_time);
        if(isset($time[0]) AND isset($time[1])) $time_hours=$time[0]*24;
        else if(!isset($time[0])) $time_hours=explode(' hours ', $ride[0]['ride']->total_time)[0];
        else $time_hours=1;
        
        if(isset($time[0]) AND $ride[0]['ride']->status=='0')
        {
            //check if ride is completed
            $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
            $date->modify("+".$time_hours." hours");
            $completion_time=$date->format("Y-m-d H:i:00");
            //echo $completion_time;
            //echo date('Y-m-d H:i:00');
            
            if($completion_time<=date('Y-m-d H:i:00'))
            {
                //echo 'Ride completed';
                $ride2=$ride[0]['ride'];
                \CommonFunctions::instance()->ride_completed($request, $ride2);
                return redirect('ride/'.$ride[0]['ride']->url);
            }
            
        }
        
        $driver_id=$ride[0]['ride']->added_by;
        return view('view_ride.index', ['title'=>$from.' to '.$to.' | Ride', 'ride'=>$ride, 'bookings'=>$bookings, 'user_ride'=>$user_ride, 'user_rating'=>$user_rating, 'ratings'=>$ratings, 'user_cards'=>$user_cards, 'booking_requests'=>$bookings_requests, 'site'=>$site]);
    }
    
    public function book_ride(Request $request, $id)
    {
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
        $user=collect($user)->first();
        
        if ($user->step < 6) {
            // code...
            return redirect('/step/'.$user->step);
        }
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE id='$id' LIMIT 1");
        foreach($row as $r)
        {
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, phone_verified, driver, profile_image, dob, username FROM users WHERE id='$r->added_by' LIMIT 1");
            $row2=collect($row2)->first();
            $ride[$i]['driver']=$row2;
            
            $t_date=new DateTime('today');
            $driver_age=date_diff(date_create($row2->dob), $t_date)->y;
            $ride[$i]['driver_age']=$driver_age;
            
            $ride[$i]['driver_ratings']='NA';
            $row2=DB::select("SELECT avg(timeliness) as timeliness, avg(vehicle_condition) as vehicle_condition, avg(safety) as safety, avg(conscious) as conscious, avg(comfort) as comfort, avg(communication) as communication FROM ratings WHERE driver_id='$r->added_by' AND type='1' LIMIT 1");
            if(count($row2)==1)
            {
                $r2=collect($row2)->first();
                $ride[$i]['driver_ratings']=($r2->timeliness+$r2->vehicle_condition+$r2->safety+$r2->conscious+$r2->comfort+$r2->communication)/6;
            }
            
            $i++;
        }
        
        if($ride[0]['ride']->status==1)
        {
            return redirect('ride/'.$ride[0]['ride']->url);
        }
        else if($ride[0]['ride']->status==2)
        {
            return redirect('ride/'.$ride[0]['ride']->url);
        }
        
        $bookings=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status!='3' AND status!='4'");
        foreach($row2 as $r2)
        {
            for($j=0; $j<$r2->seats; $j++) 
            {
                $bookings[$i]['booking']=$r2;
            
                $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username FROM users WHERE id='$r2->user_id' LIMIT 1");
                $passenger=collect($passenger)->first();
                $bookings[$i]['passenger']=$passenger;
            
                $i++;
            }
        }
        
        $bookings_requests=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status='0'");
        foreach($row2 as $r2)
        {
            $bookings_requests[$i]['booking']=$r2;
            
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username FROM users WHERE id='$r2->user_id' LIMIT 1");
            $passenger=collect($passenger)->first();
            $bookings_requests[$i]['passenger']=$passenger;
            
            $i++;
        }
        
        $user_ride=DB::select("SELECT id, status FROM bookings WHERE user_id='$user_id' AND ride_id='$ride_id' ORDER BY id DESC LIMIT 1");
        if(count($user_ride)==1) {
            $user_ride=collect($user_ride)->first();
            
            $user_rating=DB::select("SELECT id, rating, review FROM ratings WHERE user_id='$user_id' AND ride_id='$ride_id' AND booking_id='$user_ride->id' LIMIT 1");
            if(count($user_rating)==1) {
                $user_rating=collect($user_rating)->first();
            }
            else $user_rating='NA';
        } 
        else { $user_ride='NA'; $user_rating='NA'; }
        
        $user_cards=DB::select("SELECT * FROM cards WHERE user_id='$user_id' ORDER BY id DESC");
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        return view('book_ride.index', ['title'=>'Book Ride', 'ride'=>$ride, 'bookings'=>$bookings, 'user_ride'=>$user_ride, 'user_rating'=>$user_rating, 'user_cards'=>$user_cards, 'booking_requests'=>$bookings_requests, 'site'=>$site]);
    }
    
    public function post_ride(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
        $user=collect($user)->first();
        
        if($user->step!=0)
        {
            $path=$request->path();
            if($user->step==1 AND $path!='welcome/step1of5')
            {
                return redirect('welcome/step1of5');
            }
            else if($user->step==2 AND $path!='welcome/step2of5')
            {
                return redirect('welcome/step2of5');
            }
            else if($user->step==3 AND $path!='welcome/step3of5')
            {
                return redirect('welcome/step3of5');
            }
            else if($user->step==4 AND $path!='welcome/step4of5')
            {
                return redirect('welcome/step4of5');
            }
            else if($user->step==5 AND $path!='welcome/step5of5')
            {
                return redirect('welcome/step5of5');
            }
        }
        /*if($user->driver_license=='') {
            $request->session()->flash('error', "You need to upload your driver's license first to start posting rides.");
            return redirect('verify-driver');
        }*/
        
        if($user->dob=='0000-00-00') 
        {
            $request->session()->flash('error', 'Please completed your profile first to post your first ride.');
            return redirect('personal-information'); 
        }

        // if($user->gender == 'Prefer not to say'){
        //     $request->session()->flash('error', 'You are not allowed to post a ride');
        //     return redirect('post-ride');
        // }
        
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($request->input('departure')!='' AND $request->input('destination')!='')
        {
            // check if reCaptcha has been validated by Google      
            /*$secret = '6Lcy0OIUAAAAAFCz9E9BXRaYPvEImxwjzw-42_FE';
            $captchaId = $request->input('g-recaptcha-response');
    
            //sends post request to the URL and tranforms response to JSON
            $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
    
            if($responseCaptcha->success == false){
                $request->session()->flash('error', 'Please prove you are not a robot first.');
                return redirect('post-ride');
            }*/
            
            $departure=addslashes($request->input('departure'));
            $departure_lat=addslashes($request->input('departure_lat'));
            $departure_lng=addslashes($request->input('departure_lng'));
            $departure_place=addslashes($request->input('departure_place'));
            $departure_route=addslashes($request->input('departure_route'));
            $departure_zipcode=addslashes($request->input('departure_zipcode'));
            $departure_city=addslashes($request->input('departure_city'));
            $departure_state=addslashes($request->input('departure_state'));
            $departure_state_short=addslashes($request->input('departure_state_short'));
            $departure_country=addslashes($request->input('departure_country'));
            
            $destination=addslashes($request->input('destination'));
            $destination_lat=addslashes($request->input('destination_lat'));
            $destination_lng=addslashes($request->input('destination_lng'));
            $destination_place=addslashes($request->input('destination_place'));
            $destination_route=addslashes($request->input('destination_route'));
            $destination_zipcode=addslashes($request->input('destination_zipcode'));
            $destination_city=addslashes($request->input('destination_city'));
            $destination_state=addslashes($request->input('destination_state'));
            $destination_state_short=addslashes($request->input('destination_state_short'));
            $destination_country=addslashes($request->input('destination_country'));
            
            $total_distance=addslashes($request->input('total_distance'));
            $total_time=addslashes($request->input('total_time'));
            
            $from=$departure_city;
            $to=$destination_city;
            if($from=='') $from=$departure_state;
            if($to=='') $to=$destination_state;
            if($from=='') $from=$departure;
            if($to=='') $to=$destination;
            $url=$from.' to '.$to;
            $url=substr($url, 0, 130);
            $url=str_replace(' ', '-', strtolower($url));
            $url=preg_replace("/[^A-Za-z0-9-]/", '', $url);
            $date=addslashes($request->input('date'));
            $date=date_format(new DateTime($date),'Y-m-d');
            $time=addslashes($request->input('time'));
            $time=date_format(new DateTime($time),'H:i');
            $recurring=addslashes($request->input('recurring'));
            $details=addslashes($request->input('details'));
            $seats=addslashes($request->input('seats'));
            
            $skip_vehicle=0;
            if($request->input('skip_vehicle')!='')
            $skip_vehicle=addslashes($request->input('skip_vehicle'));
            $model=addslashes($request->input('model'));
            $vehicle_type=addslashes($request->input('vehicle_type'));
            $other=addslashes($request->input('other'));
            $year=addslashes($request->input('year'));
            $color=addslashes($request->input('color'));
            $license_no=addslashes($request->input('license_no'));
            $car_type=addslashes($request->input('car_type'));
            $car_image=$request->input('car_file_name');
            
            $smoke=addslashes($request->input('smoke'));
            $animal_friendly=addslashes($request->input('animal_friendly'));
            $features='';
            if($request->input('features')!='')
            $features=implode(';', $request->input('features'));
            $booking_method=addslashes($request->input('booking_method'));
            $max_back_seats=addslashes($request->input('max_back_seats'));
            $luggage=addslashes($request->input('luggage'));
            $accept_more_luggage=addslashes($request->input('accept_more_luggage'));
            $open_customized=addslashes($request->input('open_customized'));
            $price=addslashes($request->input('price'));
            $payment_method=addslashes($request->input('payment_method'));
            $notes=addslashes($request->input('notes'));
            
            $until_date=addslashes($request->input('until_date'));
            if($until_date!='')
            $until_date=date_format(new DateTime($until_date),'Y-m-d');
            $until_limit=addslashes($request->input('until_limit'));
            
            $check=DB::select("SELECT id FROM rides ORDER BY id DESC LIMIT 1");
            if(count($check)==1)
            {
                $check=collect($check)->first();
                $url.='-'.($check->id+1);
            }
            else $url.='-1';
            
            $pickup=addslashes($request->input('pickup'));
            $dropoff=addslashes($request->input('dropoff'));


            $backSeats = $request->input('back_seats');

            $middleSeats = $request->input('middle_seats');
            
            DB::insert("INSERT INTO rides (url, departure, departure_lat, departure_lng, destination, destination_lat, destination_lng, total_distance, total_time, date, time, recurring, details, seats, model, vehicle_type, other, year, color, license_no, car_type, car_image, smoke, animal_friendly, features, booking_method, max_back_seats, luggage, accept_more_luggage, open_customized, price, payment_method, notes, added_by, added_on, departure_place, departure_route, departure_zipcode, departure_city, departure_state, departure_state_short, departure_country, destination_place, destination_route, destination_zipcode, destination_city, destination_state, destination_state_short, destination_country, skip_vehicle, until_date, until_limit, pickup, dropoff, back_seats, middle_seats) VALUES ('$url', '$departure', '$departure_lat', '$departure_lng', '$destination', '$destination_lat', '$destination_lng', '$total_distance', '$total_time', '$date', '$time', '$recurring', '$details', '$seats', '$model', '$vehicle_type', '$other', '$year', '$color', '$license_no', '$car_type', '$car_image', '$smoke', '$animal_friendly', '$features', '$booking_method', '$max_back_seats', '$luggage', '$accept_more_luggage', '$open_customized', '$price', '$payment_method', '$notes', '$user_id', NOW(), '$departure_place', '$departure_route', '$departure_zipcode', '$departure_city', '$departure_state', '$departure_state_short', '$departure_country', '$destination_place', '$destination_route', '$destination_zipcode', '$destination_city', '$destination_state', '$destination_state_short', '$destination_country', '$skip_vehicle', '$until_date', '$until_limit', '$pickup', '$dropoff', '$backSeats', '$middleSeats')");
            $id=DB::getPdo()->lastInsertId();


            $this->email_send('New Ride Posted', 'A new Ride has been posted on Proximaride', 'adeel_faisal1234@hotmail.com', 'adeel_faisal1234@hotmail.com');
            
            if($recurring=='1') \CommonFunctions::instance()->recurring($id);
            
            //return redirect('ride/'.$url);
            return redirect('rides-posted');
        }
        
        $old_ride=DB::select("SELECT * FROM rides WHERE added_by='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($old_ride)==1) $old_ride=collect($old_ride)->first();
        
        $c=$request->input('c');
        if($c=='') $c=0;
        $copy_ride=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND id='$c' LIMIT 1");
        if(count($copy_ride)==1) $copy_ride=collect($copy_ride)->first();
        
        $extra_care='0';
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        
        $user_preferences=DB::select("SELECT smoke, pets, features FROM users WHERE id='$user_id' LIMIT 1");
        $user_preferences=collect($user_preferences)->first();
        return view('post_ride.index', ['title'=>'Post a Ride', 'vehicle'=>$vehicle, 'old_ride'=>$old_ride, 'site'=>$site, 'extra_care'=>$extra_care, 'user_preferences'=>$user_preferences, 'copy_ride'=>$copy_ride]);
    }
    
    public function edit_ride(Request $request, $id)
    {
        $user_id=$request->session()->get('id');
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE id='$id' LIMIT 1");
        foreach($row as $r)
        {
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, phone_verified, driver, profile_image, dob, username FROM users WHERE id='$r->added_by' LIMIT 1");
            $row2=collect($row2)->first();
            $ride[$i]['driver']=$row2;
            
            $t_date=new DateTime('today');
            $driver_age=date_diff(date_create($row2->dob), $t_date)->y;
            $ride[$i]['driver_age']=$driver_age;
            
            $ride[$i]['driver_ratings']='NA';
            $row2=DB::select("SELECT avg(timeliness) as timeliness, avg(vehicle_condition) as vehicle_condition, avg(safety) as safety, avg(conscious) as conscious, avg(comfort) as comfort, avg(communication) as communication FROM ratings WHERE driver_id='$r->added_by' AND type='1' LIMIT 1");
            if(count($row2)==1)
            {
                $r2=collect($row2)->first();
                $ride[$i]['driver_ratings']=($r2->timeliness+$r2->vehicle_condition+$r2->safety+$r2->conscious+$r2->comfort+$r2->communication)/6;
            }
            
            $i++;
        }
        
        if($ride[0]['ride']->added_by!=$user_id) return redirect('my-rides');
        
        $bookings=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status!='3'");
        foreach($row2 as $r2)
        {
            for($j=0; $j<$r2->seats; $j++) 
            {
                $bookings[$i]['booking']=$r2;
            
                $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username FROM users WHERE id='$r2->user_id' LIMIT 1");
                $passenger=collect($passenger)->first();
                $bookings[$i]['passenger']=$passenger;
            
                $i++;
            }
        }
        
        $bookings_requests=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status='0'");
        foreach($row2 as $r2)
        {
            $bookings_requests[$i]['booking']=$r2;
            
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username FROM users WHERE id='$r2->user_id' LIMIT 1");
            $passenger=collect($passenger)->first();
            $bookings_requests[$i]['passenger']=$passenger;
            
            $i++;
        }
        
        $ratings=array(); $i=0;
        $row=DB::select("SELECT * FROM ratings WHERE ride_id='$ride_id' AND type='1' ORDER BY id DESC");
        foreach($row as $r)
        {
            $ratings[$i]['rating']=$r;
            $ratings[$i]['avg_rating']=($r->timeliness+$r->vehicle_condition+$r->safety+$r->conscious+$r->comfort+$r->communication)/6;
            
            $ratings[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->user_id' LIMIT 1");
            if(count($row2)==1) {
                $row2=collect($row2)->first();
                $ratings[$i]['user']=$row2;
            }
            
            $ratings[$i]['driver_rating']='NA';
            $row2=DB::select("SELECT * FROM ratings WHERE ride_id='$ride_id' AND type='2' AND user_id='$r->user_id' ORDER BY id DESC");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $ratings[$i]['driver_rating']=$row2;
                $ratings[$i]['avg_rating_driver']=($r->timeliness+$r->attitude+$r->safety+$r->hygiene+$r->respect+$r->communication)/6;
                
                $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->driver_id' LIMIT 1");
                if(count($row2)==1) 
                {
                    $row2=collect($row2)->first();
                    $ratings[$i]['driver']=$row2;
                }
            }
            
            
            $i++;
        }
        
        $user_ride=DB::select("SELECT id, status FROM bookings WHERE user_id='$user_id' AND ride_id='$ride_id' ORDER BY id DESC LIMIT 1");
        if(count($user_ride)==1) {
            $user_ride=collect($user_ride)->first();
            
            $user_rating=DB::select("SELECT id, rating, review FROM ratings WHERE user_id='$user_id' AND ride_id='$ride_id' AND booking_id='$user_ride->id' LIMIT 1");
            if(count($user_rating)==1) {
                $user_rating=collect($user_rating)->first();
            }
            else $user_rating='NA';
        } 
        else { $user_ride='NA'; $user_rating='NA'; }
        
        $user_cards=DB::select("SELECT * FROM cards WHERE user_id='$user_id' ORDER BY id DESC");
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        
        $from=$ride[0]['ride']->departure_city;
        $to=$ride[0]['ride']->destination_city;
                    
        if($from=='') $from=$ride[0]['ride']->departure_place;
        if($to=='') $to=$ride[0]['ride']->destination_place;

        if($from=='') $from=$ride[0]['ride']->departure_state;
        if($to=='') $to=$ride[0]['ride']->destination_state;

        if($from=='') $from=$ride[0]['ride']->departure;
        if($to=='' OR $from==$to) $to=$ride[0]['ride']->destination;
        
        
        if($request->input('departure')!='' AND $request->input('destination')!='')
        {
            // check if reCaptcha has been validated by Google      
            /*$secret = '6Lcy0OIUAAAAAFCz9E9BXRaYPvEImxwjzw-42_FE';
            $captchaId = $request->input('g-recaptcha-response');
    
            //sends post request to the URL and tranforms response to JSON
            $responseCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captchaId));
    
            if($responseCaptcha->success == false){
                $request->session()->flash('error', 'Please prove you are not a robot first.');
                return redirect('edit-ride/'.$id);
            }*/
            
            $departure=addslashes($request->input('departure'));
            $departure_lat=addslashes($request->input('departure_lat'));
            $departure_lng=addslashes($request->input('departure_lng'));
            $departure_place=addslashes($request->input('departure_place'));
            $departure_route=addslashes($request->input('departure_route'));
            $departure_zipcode=addslashes($request->input('departure_zipcode'));
            $departure_city=addslashes($request->input('departure_city'));
            $departure_state=addslashes($request->input('departure_state'));
            $departure_state_short=addslashes($request->input('departure_state_short'));
            $departure_country=addslashes($request->input('departure_country'));
            
            $destination=addslashes($request->input('destination'));
            $destination_lat=addslashes($request->input('destination_lat'));
            $destination_lng=addslashes($request->input('destination_lng'));
            $destination_place=addslashes($request->input('destination_place'));
            $destination_route=addslashes($request->input('destination_route'));
            $destination_zipcode=addslashes($request->input('destination_zipcode'));
            $destination_city=addslashes($request->input('destination_city'));
            $destination_state=addslashes($request->input('destination_state'));
            $destination_state_short=addslashes($request->input('destination_state_short'));
            $destination_country=addslashes($request->input('destination_country'));
            
            $total_distance=addslashes($request->input('total_distance'));
            $total_time=addslashes($request->input('total_time'));
            
            $from=$departure_city;
            $to=$destination_city;
            if($from=='') $from=$departure_state;
            if($to=='') $to=$destination_state;
            if($from=='') $from=$departure;
            if($to=='') $to=$destination;
            $url=$from.' to '.$to;
            $url=substr($url, 0, 130);
            $url=str_replace(' ', '-', strtolower($url));
            $url=preg_replace("/[^A-Za-z0-9-]/", '', $url);
            $date=addslashes($request->input('date'));
            $date=date_format(new DateTime($date),'Y-m-d');
            $time=addslashes($request->input('time'));
            $recurring=addslashes($request->input('recurring'));
            $details=addslashes($request->input('details'));
            $seats=addslashes($request->input('seats'));
            
            $skip_vehicle=0;
            if($request->input('skip_vehicle')!='')
            $skip_vehicle=addslashes($request->input('skip_vehicle'));
            $model=addslashes($request->input('model'));
            $vehicle_type=addslashes($request->input('vehicle_type'));
            $other=addslashes($request->input('other'));
            $year=addslashes($request->input('year'));
            $color=addslashes($request->input('color'));
            $license_no=addslashes($request->input('license_no'));
            $car_type=addslashes($request->input('car_type'));
            
            $smoke=addslashes($request->input('smoke'));
            $animal_friendly=addslashes($request->input('animal_friendly'));
            $features='';
            if($request->input('features')!='')
            $features=implode(';', $request->input('features'));
            $booking_method=addslashes($request->input('booking_method'));
            $max_back_seats=addslashes($request->input('max_back_seats'));
            $luggage=addslashes($request->input('luggage'));
            $accept_more_luggage=addslashes($request->input('accept_more_luggage'));
            $open_customized=addslashes($request->input('open_customized'));
            $price=addslashes($request->input('price'));
            $payment_method=addslashes($request->input('payment_method'));
            $notes=addslashes($request->input('notes'));
            
            $until_date=addslashes($request->input('until_date'));
            if($until_date!='')
            $until_date=date_format(new DateTime($until_date),'Y-m-d');
            $until_limit=addslashes($request->input('until_limit'));
            
            $pickup=addslashes($request->input('pickup'));
            $dropoff=addslashes($request->input('dropoff'));
            
            $car_image=$request->input('car_file_name');
            
            if(count($bookings)==0)
            DB::update("UPDATE rides SET departure='$departure', departure_lat='$departure_lat', departure_lng='$departure_lng', destination='$destination', destination_lat='$destination_lat', destination_lng='$destination_lng', total_distance='$total_distance', total_time='$total_time', date='$date', time='$time', recurring='$recurring', details='$details', seats='$seats', model='$model', vehicle_type='$vehicle_type', other='$other', year='$year', color='$color', license_no='$license_no', car_type='$car_type', smoke='$smoke', animal_friendly='$animal_friendly', features='$features', booking_method='$booking_method', max_back_seats='$max_back_seats', luggage='$luggage', accept_more_luggage='$accept_more_luggage', open_customized='$open_customized', price='$price', payment_method='$payment_method', notes='$notes', departure_place='$departure_place', departure_route='$departure_route', departure_zipcode='$departure_zipcode', departure_city='$departure_city', departure_state='$departure_state', departure_state_short='$departure_state_short', departure_country='$departure_country', destination_place='$destination_place', destination_route='$destination_route', destination_zipcode='$destination_zipcode', destination_city='$destination_city', destination_state='$destination_state', destination_state_short='$destination_state_short', destination_country='$destination_country', skip_vehicle='$skip_vehicle', until_date='$until_date', until_limit='$until_limit', pickup='$pickup', dropoff='$dropoff', car_image='$car_image' WHERE id='$id'");
            
            else
            DB::update("UPDATE rides SET recurring='$recurring', details='$details', model='$model', vehicle_type='$vehicle_type', other='$other', year='$year', color='$color', license_no='$license_no', car_type='$car_type', smoke='$smoke', animal_friendly='$animal_friendly', features='$features', booking_method='$booking_method', max_back_seats='$max_back_seats', accept_more_luggage='$accept_more_luggage', open_customized='$open_customized', payment_method='$payment_method', notes='$notes', skip_vehicle='$skip_vehicle', until_date='$until_date', until_limit='$until_limit', car_image='$car_image' WHERE id='$id'");
            
            $update_recurring='';
            if($request->input('update_recurring')!='')
            {
                $recurring_id=$request->input('update_recurring');
                $update_recurring=" parent='$recurring_id' AND status='0' ";
                
                if($ride[0]['ride']->parent!=0)
                {
                    $recurring_id=$ride[0]['ride']->parent;
                    $update_recurring=" (id='$recurring_id' OR parent='$recurring_id') AND status='0' ";
                }
                
                if(count($bookings)==0)
                DB::update("UPDATE rides SET departure='$departure', departure_lat='$departure_lat', departure_lng='$departure_lng', destination='$destination', destination_lat='$destination_lat', destination_lng='$destination_lng', total_distance='$total_distance', total_time='$total_time', time='$time', recurring='$recurring', details='$details', seats='$seats', model='$model', vehicle_type='$vehicle_type', other='$other', year='$year', color='$color', license_no='$license_no', car_type='$car_type', smoke='$smoke', animal_friendly='$animal_friendly', features='$features', booking_method='$booking_method', max_back_seats='$max_back_seats', luggage='$luggage', accept_more_luggage='$accept_more_luggage', open_customized='$open_customized', price='$price', payment_method='$payment_method', notes='$notes', departure_place='$departure_place', departure_route='$departure_route', departure_zipcode='$departure_zipcode', departure_city='$departure_city', departure_state='$departure_state', departure_state_short='$departure_state_short', departure_country='$departure_country', destination_place='$destination_place', destination_route='$destination_route', destination_zipcode='$destination_zipcode', destination_city='$destination_city', destination_state='$destination_state', destination_state_short='$destination_state_short', destination_country='$destination_country', skip_vehicle='$skip_vehicle', until_date='$until_date', until_limit='$until_limit', pickup='$pickup', dropoff='$dropoff', car_image='$car_image' WHERE $update_recurring");
            
                else
                DB::update("UPDATE rides SET recurring='$recurring', details='$details', model='$model', vehicle_type='$vehicle_type', other='$other', year='$year', color='$color', license_no='$license_no', car_type='$car_type', smoke='$smoke', animal_friendly='$animal_friendly', features='$features', booking_method='$booking_method', max_back_seats='$max_back_seats', accept_more_luggage='$accept_more_luggage', open_customized='$open_customized', payment_method='$payment_method', notes='$notes', skip_vehicle='$skip_vehicle', until_date='$until_date', until_limit='$until_limit', car_image='$car_image' WHERE $update_recurring");
            }
            
            if($recurring=='1') \CommonFunctions::instance()->recurring($id);
            
            return redirect('ride/'.$ride[0]['ride']->url);
        }
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        
        $recurring_rides=DB::select("SELECT id FROM rides WHERE (parent='$id' OR (id='$id' AND parent!=0)) AND status='0'");
        $recurring_rides=count($recurring_rides);
        
        return view('edit_ride.index', ['title'=>$from.' to '.$to.' | Edit Ride', 'ride'=>$ride, 'bookings'=>$bookings, 'user_ride'=>$user_ride, 'user_cards'=>$user_cards, 'booking_requests'=>$bookings_requests, 'site'=>$site, 'recurring_rides'=>$recurring_rides]);
    }
    
    public function my_rides(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $rides_posted=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status='0' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_posted[$i]['ride']=$r;
            
            $i++;
        }
        
        $rides_booked=array(); $i=0;
        $row=DB::select("SELECT * FROM bookings WHERE user_id='$user_id' AND (status='0' OR status='1') ORDER BY id DESC");
        foreach($row as $r)
        {
            $rides_booked[$i]['booking']=$r;
            
            $row2=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            $row2=collect($row2)->first();
            
            $rides_booked[$i]['ride']=$row2;
            
            $i++;
        }
        
        $rides_past=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status!='0' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_past[$i]['ride']=$r;
            
            $i++;
        }
        
        return view('my_rides.index', ['title'=>'My Rides', 'rides_posted'=>$rides_posted, 'rides_booked'=>$rides_booked, 'rides_past'=>$rides_past]);
    }
    
    public function rides_posted(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $rides_posted=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status='0' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_posted[$i]['ride']=$r;
            
            $i++;
        }
        
        $rides_booked=array(); $i=0;
        $row=DB::select("SELECT * FROM bookings WHERE user_id='$user_id' AND (status='0' OR status='1') ORDER BY id DESC");
        foreach($row as $r)
        {
            $rides_booked[$i]['booking']=$r;
            
            $row2=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            $row2=collect($row2)->first();
            
            $rides_booked[$i]['ride']=$row2;
            
            $i++;
        }
        
        $rides_past=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status!='0' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_past[$i]['ride']=$r;
            
            $i++;
        }
        
        return view('rides_posted.index', ['title'=>'Rides Posted', 'rides_posted'=>$rides_posted, 'rides_booked'=>$rides_booked, 'rides_past'=>$rides_past]);
    }
    
    public function past_rides(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $rides_posted=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status='0' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_posted[$i]['ride']=$r;
            
            $i++;
        }
        
        $rides_booked=array(); $i=0;
        $row=DB::select("SELECT * FROM bookings WHERE user_id='$user_id' AND (status='0' OR status='1') ORDER BY id DESC");
        foreach($row as $r)
        {
            $rides_booked[$i]['booking']=$r;
            
            $row2=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            $row2=collect($row2)->first();
            
            $rides_booked[$i]['ride']=$row2;
            
            $i++;
        }
        
        $rides_past=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE added_by='$user_id' AND status!='0' ORDER BY date ASC");
        foreach($row as $r)
        {
            $rides_past[$i]['ride']=$r;
            
            $i++;
        }
        
        return view('past_rides.index', ['title'=>'Past Rides', 'rides_posted'=>$rides_posted, 'rides_booked'=>$rides_booked, 'rides_past'=>$rides_past]);
    }
    
    public function search_rides(Request $request)
    {
        $id=$request->session()->get('id');
        
        if($id!='' AND $id!=0) 
        {
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        if($user->step!=0)
        {
            $path=$request->path();
            if($user->step==1 AND $path!='welcome/step1of5')
            {
                return redirect('welcome/step1of5');
            }
            else if($user->step==2 AND $path!='welcome/step2of5')
            {
                return redirect('welcome/step2of5');
            }
            else if($user->step==3 AND $path!='welcome/step3of5')
            {
                return redirect('welcome/step3of5');
            }
            else if($user->step==4 AND $path!='welcome/step4of5')
            {
                return redirect('welcome/step4of5');
            }
            else if($user->step==5 AND $path!='welcome/step5of5')
            {
                return redirect('welcome/step5of5');
            }
        }
        }
        
        $rides=array();
        $pink_rides=0;
        $extra_care_rides=0;
        $custom_rides=0;
        $path=$request->path();
        
        $title='Search rides';
        if($path=='pink-rides')
        {
            $title='Pink rides';
            $pink_rides=1;
        }
        else if($path=='extra-care-rides')
        {
            $title='Extra-care rides';
            $extra_care_rides=1;
        }
        else if($path=='customize-rides')
        {
            $title='Extra-care rides';
            $custom_rides=1;
        }
        
        if($request->input('departure')!='')
        {
            $departure=addslashes($request->input('departure'));
            $departure_city=addslashes($request->input('dep_city'));
            $departure_lat=addslashes($request->input('dep_lat'));
            $departure_lng=addslashes($request->input('dep_lng'));
            $destination=addslashes($request->input('destination'));
            $destination_city=addslashes($request->input('des_city'));
            $destination_lat=addslashes($request->input('des_lat'));
            $destination_lng=addslashes($request->input('des_lng'));
            
            $date_filter="";
            if($request->input('date')!='')
            {
                $date=$request->input('date');
                $date=date_format(new DateTime($date),'Y-m-d');
                
                $date_filter=" AND date>='$date' ";
            }
            else
            {
                $date=date('Y-m-d');
                $date_filter=" AND date>='$date' ";
            }
            
            $row=DB::select("SELECT * FROM rides WHERE (((departure LIKE '%$departure%' OR (departure_lat='$departure_lat' AND departure_lng='$departure_lng')) AND (destination LIKE '%$destination%' OR (destination_lat='$destination_lat' AND destination_lng='$destination_lng'))) OR (departure_city='$departure_city' AND destination_city='$destination_city')) AND status='0' AND suspend = '0' ORDER BY date ASC");
        }
        else $row=array();
        //$row=DB::select("SELECT * FROM rides ORDER BY date ASC");
        
        $rides2=array(); $more_rides2=array(); $i=0; $more_rides=0; $total_rides=0; $full_rides=0;
        foreach($row as $r)
        {
            $rides2[$r->date]=array();
            $more_rides2[$r->date]=array();
            
            $row2=DB::select("SELECT id, booked_on FROM bookings WHERE ride_id='$r->id' AND status='5'");
            foreach($row2 as $r2)
            {
                $date = new DateTime($r2->booked_on);
                $date->modify("+15 minutes");
                $timeout=$date->format("Y-m-d H:i:00");
            
                if($timeout<=date("Y-m-d H:i:00"))
                {
                    //echo 'Timeout';
                    DB::update("UPDATE bookings SET status='4' WHERE id='$r2->id'");
                }
            }
        }
        
        $i=0;
        foreach($row as $r)
        {
            $flag=1;
            
            if($request->input('date')!='')
            {
                $date=$request->input('date');
                $date=date_format(new DateTime($date),'Y-m-d');
                
                if($r->date!=$date) $flag=0;
            }
            
            $payment_filter="";
            if($request->input('payment')!='')
            {
                $payment=$request->input('payment');
                
                if($r->payment!=$payment) $flag=0;
            }
            
            $vehicle_type="";
            if($request->input('vehicle')!='')
            {
                $vehicle=$request->input('vehicle');
                
                if($r->vehicle_type!=$vehicle) $flag=0;
            }
            
            $luggage_filter="";
            if($request->input('luggage')!='')
            {
                $luggage=$request->input('luggage');
                
                if($r->luggage!=$luggage) $flag=0;
            }
            
            $smoke_filter="";
            if($request->input('smoke')!='')
            {
                $smoke=$request->input('smoke');
                
                if($r->smoke!=$smoke) $flag=0;
            }
            
            $animal_filter="";
            if($request->input('pets')!='')
            {
                $animal=$request->input('pets');
                
                if($r->animal_friendly!=$animal) $flag=0;
            }
            
            //features filter for the ride START
            if($request->input('features')!='')
            {
                $ride_features=explode(';', $r->features);
                foreach($request->input('features') as $feature)
                {
                    if(!in_array($feature, $ride_features)) $flag=0;
                }
            }
            //features filter for the ride END
            
            //driver name filter for the ride START
            if($request->input('driver_name')!='')
            {
                $driver_name=addslashes($request->input('driver_name'));
                $row2=DB::select("SELECT id, first_name, last_name, profile_image, dob, gender, avatar FROM users WHERE id='$r->added_by' AND (first_name LIKE '%$driver_name%' OR last_name LIKE '%$driver_name%') LIMIT 1");
            }
            else
            $row2=DB::select("SELECT id, first_name, last_name, profile_image, dob, gender, avatar FROM users WHERE id='$r->added_by' LIMIT 1");
            if(count($row2)==0) continue;
            //driver name filter for the ride END
            $driver=collect($row2)->first();
            
            $row2=DB::select("SELECT * FROM ratings WHERE driver_id='$r->added_by' AND type='1'");
            if(count($row2)!=0)
            {
                foreach($row2 as $r2)
                {
                    $driver_rating=($r2->timeliness+$r2->vehicle_condition+$r2->safety+$r2->conscious+$r2->comfort+$r2->communication)/6;
                }
            }
            else $driver_rating='NA';
            if($driver_rating=='') $driver_rating='NA';
            
            //driver rating filter for the ride START
            if($request->input('driver_rating')!='')
            {
                $d_rating=$request->input('driver_rating');
                if($driver_rating=='NA' OR $driver_rating<$d_rating) $flag=0;
            }
            //driver rating filter for the ride END
            
            //passenger rating filter for the ride START
            if($request->input('pass_rating')!='')
            {
                $p_rating=$request->input('pass_rating');
                $bookings2=DB::select("SELECT user_id FROM bookings WHERE ride_id='$r->id' AND status='1'");
                if(count($bookings2)!=0)
                {
                    foreach($bookings2 as $booking)
                    {
                        $row22=DB::select("SELECT * FROM ratings WHERE user_id='$booking->user_id' AND type='2' ORDER BY id DESC");
                        if(count($row22)!=0)
                        {   
                            foreach($row22 as $r22)
                            {
                                $passenger_rating=($r22->timeliness+$r22->safety+$r22->communication+$r22->attitude+$r22->hygiene+$r22->respect)/6;
                            }
                            if($passenger_rating<$p_rating) $flag=0;
                        }
                    }
                }
            }
            //passenger rating filter for the ride END
            
            $t_date=new DateTime('today');
            $driver_age=date_diff(date_create($driver->dob), $t_date)->y;
            //driver age filter for the ride START
            if($request->input('driver_age')!='')
            {
                $age=$request->input('driver_age');
                if($age=='Below 20' AND !($driver_age<20)) $flag=0;
                else if($age=='21 - 30' AND !($driver_age>=20 )) $flag=0;
                else if($age=='31 - 40' AND !($driver_age>=30 )) $flag=0;
                else if($age=='41 - 50' AND !($driver_age>=40 )) $flag=0;
                else if($age=='51 - 60' AND !($driver_age>=50 )) $flag=0;
                else if($age=='Above 60' AND !($driver_age>=60)) $flag=0;
            }
            //driver age filter for the ride END
            
            //phone verified filter for the ride START
            if($request->input('phone')=='1')
            {
                $check=DB::select("SELECT id FROM users WHERE id='$r->added_by' AND phone_verified='1' LIMIT 1");
                if(count($check)==0) $flag=0;
            }
            //phone verified filter for the ride END
            
            //get available seats
            $bookings=DB::select("SELECT id, seats FROM bookings WHERE ride_id='$r->id' AND status!='3'");
            $seats_booked=0;
            if(!empty($bookings)) 
            {
                foreach($bookings as $b)
                {
                    $seats_booked+=$b->seats;
                }
            }
            $seats_left=$r->seats-count($bookings);
            if($seats_left==0) $full_rides+=1;
            
            if(!$flag) 
            {
                $more_rides2[$r->date]['date']=$r->date;
                $more_rides+=1;
                
                $more_rides2[$r->date]['rides'][$i]['seats_left']=$seats_left;
                $more_rides2[$r->date]['rides'][$i]['seats_booked']=count($bookings);
            
                $more_rides2[$r->date]['rides'][$i]['ride']=$r;
                $more_rides2[$r->date]['rides'][$i]['driver']=$driver;
                if($driver_rating!='NA') $driver_rating=number_format($driver_rating,1);
                $more_rides2[$r->date]['rides'][$i]['driver_rating']=$driver_rating;
                $more_rides2[$r->date]['rides'][$i]['driver_age']=$driver_age;
                $i++;
                continue;
            }
            $rides2[$r->date]['date']=$r->date;
            $total_rides+=1;
            
            $rides2[$r->date]['rides'][$i]['seats_left']=$seats_left;
            $rides2[$r->date]['rides'][$i]['seats_booked']=count($bookings);
            
            $rides2[$r->date]['rides'][$i]['ride']=$r;
            $rides2[$r->date]['rides'][$i]['driver']=$driver;
            if($driver_rating!='NA') $driver_rating=number_format($driver_rating,1);
            $rides2[$r->date]['rides'][$i]['driver_rating']=$driver_rating;
            $rides2[$r->date]['rides'][$i]['driver_age']=$driver_age;
            
            $i++;
        }
        $rides=$rides2;
        return view('search.index', ['title'=>$title, 'rides'=>$rides, 'total_rides'=>$total_rides, 'full_rides'=>$full_rides, 'pink_rides'=>$pink_rides, 'extra_care_rides'=>$extra_care_rides, 'customize_rides'=>$custom_rides, 'more_rides'=>$more_rides2, 'total_more_rides'=>$more_rides]);
    }
    
    public function check_time(Request $request)
    {
        $user_id=$request->session()->get('id');
        $data=array();
        $data['success']=0;
        $data['past']=1;
        $date=$request->input('date');
        $time=$request->input('time');
        $time=addslashes($request->input('time'));
        $time=date_format(new DateTime($time),'H:i');
        $date_format=date_format(new DateTime($date),'Y-m-d');
        
        $check=DB::select("SELECT id FROM rides WHERE added_by='$user_id' AND date='$date_format' AND time='$time' AND status!='2' LIMIT 1");
        if(count($check)==0) $data['success']=1;
        
        if($date!='')
        {
            if(date_format(new DateTime($date.' '.$time),'d-m-Y H:i')<date('d-m-Y H:i')) $data['past']=0;
        }
        
        return response()->json($data);
    }
    
    public function check_time_edit(Request $request)
    {
        $user_id=$request->session()->get('id');
        $data=array();
        $data['success']=0;
        $data['past']=1;
        $id=$request->input('id');
        $date=$request->input('date');
        $time=$request->input('time');
        $time=addslashes($request->input('time'));
        $time=date_format(new DateTime($time),'H:i');
        $date_format=date_format(new DateTime($date),'Y-m-d');
        
        $check=DB::select("SELECT id FROM rides WHERE added_by='$user_id' AND date='$date_format' AND time='$time' AND id!='$id' LIMIT 1");
        if(count($check)==0) $data['success']=1;
        
        $check=DB::select("SELECT date, time FROM rides WHERE id='$id' LIMIT 1");
        $check=collect($check)->first();
        $ride_date=$check->date;
        $ride_time=$check->time;
        
        if($date!='' AND ($date!=$ride_date OR $time!=$ride_time))
        {
            if(date_format(new DateTime($date.' '.$time),'d-m-Y H:i')<date('d-m-Y H:i')) $data['past']=0;
        }
        
        return response()->json($data);
    }



     public function smtp_credentials()
    {
        $data['email'] = "support@meganmegmeg.site";
        $data['password'] = "Admin@123123";
        $data['smtp'] = "ssl";
        $data['port'] = 465;
        $data['from'] = "support@meganmegmeg.site";
        $data['from_name'] = "ProximaRide Support Team";
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
            }else{
                return false;
            
            }

        } catch (Exception $e) {
        
            return false;

        }
    }



}
