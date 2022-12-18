<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cookie;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Log;
use DateTime;
use Mail;

class profile extends Controller
{
    public function driver_profile(Request $request, $username)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT * FROM users WHERE username='$username' LIMIT 1");
        $user=collect($user)->first();
        
        $t_date=new DateTime('today');
        $user_age=date_diff(date_create($user->dob), $t_date)->y;
        
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user->id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        $ratings=array(); $i=0;
        $row=DB::select("SELECT * FROM ratings WHERE driver_id='$user->id' AND type='1' ORDER BY id DESC");
        foreach($row as $r)
        {
            $ratings[$i]['rating']=$r;
            $ratings[$i]['avg_rating']=($r->timeliness+$r->vehicle_condition+$r->safety+$r->conscious+$r->comfort+$r->communication)/6;
            
            $ride=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            $ratings[$i]['ride']=$ride;
            
            $ratings[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->user_id' LIMIT 1");
            if(count($row2)==1) {
                $row2=collect($row2)->first();
                $ratings[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        $row=DB::select("SELECT avg(timeliness) as avg FROM ratings WHERE driver_id='$user->id' AND type='1'");
        $row=collect($row)->first();
        $timeliness=$row->avg;
        
        $row=DB::select("SELECT avg(vehicle_condition) as avg FROM ratings WHERE driver_id='$user->id' AND type='1'");
        $row=collect($row)->first();
        $vehicle_condition=$row->avg;
        
        $row=DB::select("SELECT avg(safety) as avg FROM ratings WHERE driver_id='$user->id' AND type='1'");
        $row=collect($row)->first();
        $safety=$row->avg;
        
        $row=DB::select("SELECT avg(conscious) as avg FROM ratings WHERE driver_id='$user->id' AND type='1'");
        $row=collect($row)->first();
        $conscious=$row->avg;
        
        $row=DB::select("SELECT avg(comfort) as avg FROM ratings WHERE driver_id='$user->id' AND type='1'");
        $row=collect($row)->first();
        $comfort=$row->avg;
        
        $row=DB::select("SELECT avg(communication) as avg FROM ratings WHERE driver_id='$user->id' AND type='1'");
        $row=collect($row)->first();
        $communication=$row->avg;
        
        if($timeliness=='') $timeliness=0;
        if($vehicle_condition=='') $vehicle_condition=0;
        if($safety=='') $safety=0;
        if($conscious=='') $conscious=0;
        if($comfort=='') $comfort=0;
        if($communication=='') $communication=0;
        
        return view('driver_profile.index', ['title'=>$user->first_name.' '.$user->last_name.' | Driver | Profile', 'user_data'=>$user, 'user_age'=>$user_age, 'vehicle'=>$vehicle, 'ratings'=>$ratings, 'timeliness'=>$timeliness, 'vehicle_condition'=>$vehicle_condition, 'safety'=>$safety, 'conscious'=>$conscious, 'comfort'=>$comfort, 'communication'=>$communication]);
    }
    
    public function passenger_profile(Request $request, $username)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT * FROM users WHERE username='$username' LIMIT 1");
        $user=collect($user)->first();
        
        $t_date=new DateTime('today');
        $user_age=date_diff(date_create($user->dob), $t_date)->y;
        
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user->id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        $ratings=array(); $i=0;
        $row=DB::select("SELECT * FROM ratings WHERE user_id='$user->id' AND type='2' ORDER BY id DESC");
        foreach($row as $r)
        {
            $ratings[$i]['rating']=$r;
            $ratings[$i]['avg_rating']=($r->timeliness+$r->safety+$r->communication+$r->attitude+$r->hygiene+$r->respect)/6;
            
            $ride=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            $ratings[$i]['ride']=$ride;
            
            $ratings[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->driver_id' LIMIT 1");
            if(count($row2)==1) 
            {
                $row2=collect($row2)->first();
                $ratings[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        $row=DB::select("SELECT avg(timeliness) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $timeliness=$row->avg;
        
        $row=DB::select("SELECT avg(vehicle_condition) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $vehicle_condition=$row->avg;
        
        $row=DB::select("SELECT avg(safety) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $safety=$row->avg;
        
        $row=DB::select("SELECT avg(conscious) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $conscious=$row->avg;
        
        $row=DB::select("SELECT avg(comfort) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $comfort=$row->avg;
        
        $row=DB::select("SELECT avg(communication) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $communication=$row->avg;
        
        $row=DB::select("SELECT avg(attitude) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $attitude=$row->avg;
        
        $row=DB::select("SELECT avg(hygiene) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $hygiene=$row->avg;
        
        $row=DB::select("SELECT avg(respect) as avg FROM ratings WHERE user_id='$user->id' AND type='2'");
        $row=collect($row)->first();
        $respect=$row->avg;
        
        if($timeliness=='') $timeliness=0;
        if($vehicle_condition=='') $vehicle_condition=0;
        if($safety=='') $safety=0;
        if($conscious=='') $conscious=0;
        if($comfort=='') $comfort=0;
        if($communication=='') $communication=0;
        if($attitude=='') $attitude=0;
        if($hygiene=='') $hygiene=0;
        if($respect=='') $respect=0;
        
        return view('passenger_profile.index', ['title'=>$user->first_name.' '.$user->last_name.' | Passenger | Profile', 'user_data'=>$user, 'user_age'=>$user_age, 'vehicle'=>$vehicle, 'ratings'=>$ratings, 'timeliness'=>$timeliness, 'vehicle_condition'=>$vehicle_condition, 'safety'=>$safety, 'conscious'=>$conscious, 'comfort'=>$comfort, 'communication'=>$communication, 'attitude'=>$attitude, 'hygiene'=>$hygiene, 'respect'=>$respect]);
    }
    
    public function ratings_left(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
        $user=collect($user)->first();
        
        $t_date=new DateTime('today');
        $user_age=date_diff(date_create($user->dob), $t_date)->y;
        
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user->id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        $ratings=array(); $i=0;
        $row=DB::select("SELECT * FROM ratings WHERE posted_by='$user->id' ORDER BY id DESC");
        foreach($row as $r)
        {
            $ride=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            if(count($ride)==0) 
            {
                DB::delete("DELETE FROM rides WHERE id='$r->ride_id'");
                continue;
            }
            $ride=collect($ride)->first();
            
            $ratings[$i]['rating']=$r;
            
            if($r->type=='1')
            $ratings[$i]['avg_rating']=($r->timeliness+$r->vehicle_condition+$r->safety+$r->conscious+$r->comfort+$r->communication)/6;
            else
            $ratings[$i]['avg_rating']=($r->timeliness+$r->attitude+$r->safety+$r->hygiene+$r->respect+$r->communication)/6;
            
            $ratings[$i]['ride']=$ride;
            
            $ratings[$i]['user']='NA';
            if($user->id==$r->driver_id)
            $u=$r->user_id;
            else
            $u=$r->driver_id;
            $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$u' LIMIT 1");
            if(count($row2)==1) 
            {
                $row2=collect($row2)->first();
                $ratings[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        $row=DB::select("SELECT id FROM ratings WHERE posted_by='$user->id'");
        $timeliness['total']=count($row);
        $row=DB::select("SELECT avg(timeliness) as avg FROM ratings WHERE posted_by='$user->id'");
        $row=collect($row)->first();
        $timeliness['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='1' AND posted_by='$user->id'");
        $vehicle_condition['total']=count($row);
        $row=DB::select("SELECT avg(vehicle_condition) as avg FROM ratings WHERE type='1' AND posted_by='$user->id'");
        $row=collect($row)->first();
        $vehicle_condition['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE posted_by='$user->id'");
        $safety['total']=count($row);
        $row=DB::select("SELECT avg(safety) as avg FROM ratings WHERE posted_by='$user->id'");
        $row=collect($row)->first();
        $safety['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='1' AND posted_by='$user->id'");
        $conscious['total']=count($row);
        $row=DB::select("SELECT avg(conscious) as avg FROM ratings WHERE type='1' AND posted_by='$user->id'");
        $row=collect($row)->first();
        $conscious['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='1' AND posted_by='$user->id'");
        $comfort['total']=count($row);
        $row=DB::select("SELECT avg(comfort) as avg FROM ratings WHERE type='1' AND posted_by='$user->id'");
        $row=collect($row)->first();
        $comfort['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE posted_by='$user->id'");
        $communication['total']=count($row);
        $row=DB::select("SELECT avg(communication) as avg FROM ratings WHERE posted_by='$user->id'");
        $row=collect($row)->first();
        $communication['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='2' AND posted_by='$user->id'");
        $attitude['total']=count($row);
        $row=DB::select("SELECT avg(attitude) as avg FROM ratings WHERE type='2' AND posted_by='$user->id'");
        $row=collect($row)->first();
        $attitude['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='2' AND posted_by='$user->id'");
        $hygiene['total']=count($row);
        $row=DB::select("SELECT avg(hygiene) as avg FROM ratings WHERE type='2' AND posted_by='$user->id'");
        $row=collect($row)->first();
        $hygiene['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='2' AND posted_by='$user->id'");
        $respect['total']=count($row);
        $row=DB::select("SELECT avg(respect) as avg FROM ratings WHERE type='2' AND posted_by='$user->id'");
        $row=collect($row)->first();
        $respect['avg']=$row->avg;
        
        if($timeliness['avg']=='') $timeliness['avg']=0;
        if($vehicle_condition['avg']=='') $vehicle_condition['avg']=0;
        if($safety['avg']=='') $safety['avg']=0;
        if($conscious['avg']=='') $conscious['avg']=0;
        if($comfort['avg']=='') $comfort['avg']=0;
        if($communication['avg']=='') $communication['avg']=0;
        if($attitude['avg']=='') $attitude['avg']=0;
        if($hygiene['avg']=='') $hygiene['avg']=0;
        if($respect['avg']=='') $respect['avg']=0;
        
        return view('ratings_left.index', ['title'=>'Ratings I left', 'user_data'=>$user, 'user_age'=>$user_age, 'vehicle'=>$vehicle, 'ratings'=>$ratings, 'timeliness'=>$timeliness, 'vehicle_condition'=>$vehicle_condition, 'safety'=>$safety, 'conscious'=>$conscious, 'comfort'=>$comfort, 'communication'=>$communication, 'attitude'=>$attitude, 'hygiene'=>$hygiene, 'respect'=>$respect]);
    }

    
    
    public function ratings_received(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
        $user=collect($user)->first();
        
        $t_date=new DateTime('today');
        $user_age=date_diff(date_create($user->dob), $t_date)->y;
        
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user->id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        $ratings=array(); $i=0;
        $row=DB::select("SELECT * FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id') ORDER BY id DESC");
        foreach($row as $r)
        {
            $ride=DB::select("SELECT * FROM rides WHERE id='$r->ride_id' LIMIT 1");
            if(count($ride)==0) 
            {
                DB::delete("DELETE FROM rides WHERE id='$r->ride_id'");
                continue;
            }
            
            $ratings[$i]['rating']=$r;
            
            if($r->type=='1')
            $ratings[$i]['avg_rating']=($r->timeliness+$r->vehicle_condition+$r->safety+$r->conscious+$r->comfort+$r->communication)/6;
            else
            $ratings[$i]['avg_rating']=($r->timeliness+$r->attitude+$r->safety+$r->hygiene+$r->respect+$r->communication)/6;
            
            $ratings[$i]['ride']=$ride;
            
            $ratings[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, gender, profile_image, username FROM users WHERE id='$r->posted_by' LIMIT 1");
            if(count($row2)==1) 
            {
                $row2=collect($row2)->first();
                $ratings[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        $row=DB::select("SELECT id FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $timeliness['total']=count($row);
        $row=DB::select("SELECT avg(timeliness) as avg FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $timeliness['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='1' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $vehicle_condition['total']=count($row);
        $row=DB::select("SELECT avg(vehicle_condition) as avg FROM ratings WHERE type='1' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $vehicle_condition['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $safety['total']=count($row);
        $row=DB::select("SELECT avg(safety) as avg FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $safety['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='1' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $conscious['total']=count($row);
        $row=DB::select("SELECT avg(conscious) as avg FROM ratings WHERE type='1' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $conscious['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='1' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $comfort['total']=count($row);
        $row=DB::select("SELECT avg(comfort) as avg FROM ratings WHERE type='1' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $comfort['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $communication['total']=count($row);
        $row=DB::select("SELECT avg(communication) as avg FROM ratings WHERE posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $communication['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='2' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $attitude['total']=count($row);
        $row=DB::select("SELECT avg(attitude) as avg FROM ratings WHERE type='2' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $attitude['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='2' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $hygiene['total']=count($row);
        $row=DB::select("SELECT avg(hygiene) as avg FROM ratings WHERE type='2' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $hygiene['avg']=$row->avg;
        
        $row=DB::select("SELECT id FROM ratings WHERE type='2' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $respect['total']=count($row);
        $row=DB::select("SELECT avg(respect) as avg FROM ratings WHERE type='2' AND posted_by!='$user->id' AND (user_id='$user->id' OR driver_id='$user->id')");
        $row=collect($row)->first();
        $respect['avg']=$row->avg;
        
        if($timeliness['avg']=='') $timeliness['avg']=0;
        if($vehicle_condition['avg']=='') $vehicle_condition['avg']=0;
        if($safety['avg']=='') $safety['avg']=0;
        if($conscious['avg']=='') $conscious['avg']=0;
        if($comfort['avg']=='') $comfort['avg']=0;
        if($communication['avg']=='') $communication['avg']=0;
        if($attitude['avg']=='') $attitude['avg']=0;
        if($hygiene['avg']=='') $hygiene['avg']=0;
        if($respect['avg']=='') $respect['avg']=0;
        
        return view('ratings_received.index', ['title'=>'Ratings I received', 'user_data'=>$user, 'user_age'=>$user_age, 'vehicle'=>$vehicle, 'ratings'=>$ratings, 'timeliness'=>$timeliness, 'vehicle_condition'=>$vehicle_condition, 'safety'=>$safety, 'conscious'=>$conscious, 'comfort'=>$comfort, 'communication'=>$communication, 'attitude'=>$attitude, 'hygiene'=>$hygiene, 'respect'=>$respect]);
    }
    public function personal_information(Request $request)
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
        
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
       
        if ($user->step < 6) {
            // code...

            return redirect('/step/'.$user->step);
        
        }

        
        return view('personal_information.index', ['title'=>'Personal information', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }

   
    public function close_account(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('delete')!='')
        {
            $pass=addslashes($request->input('pass'));
            $reasons='';
            if($request->input('reasons')!='') $reasons=implode(', ', $request->input('reasons'));
            $recommend=$request->input('recommend');
            $more=$request->input('more');
            
            $check=DB::select("SELECT id FROM users WHERE id='$id' AND pass='$pass' LIMIT 1");
            if(count($check)==0)
            {   
                $request->session()->flash('error', 'You have entered an incorrect password.');
                return redirect('close-account');
            }
            else
            {
                $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
                $user=collect($user)->first();
                
                DB::update("UPDATE users SET deleted='1' WHERE id='$id'");
                $request->session()->put('id', '');
                $request->session()->forget('id');
                Cookie::queue('user_login_token', '', 2628000);
            
            $body='The following user has closed the account:<br><br>
            <b>Name:</b> '.$user->first_name.''.$user->last_name.'<br>
            <b>Email:</b> '.$user->email.'<br><br>
            <b>The reason(s) you are closing the account:</b> '.$reasons.'<br>
            <b>Would you recommend ProximaRide to your friends?:</b> '.$recommend.'<br>
            <b>More: please tell us how we can improve:</b> '.$more;
            
            $title='Feedback on account closed';
            $email='ccaned@gmail.com';
            $from=env('MAIL_USERNAME');
            $data2=array(
                'email'=>$email,
                'from'=>$from,
                'title'=>$title,
                'body'=>$body
            );
            
            Mail::send('emails.account_closed', $data2, function($message) use($email, $from, $title) {
                $message->from('info@proximaride.com', 'ProximaRide');
                $message->to($email);
                $message->subject($title);
                //$message->attach($pathToFile);
            });
                
                return redirect('/');
            }
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        
        return view('close_account.index', ['title'=>'Close my account', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function home_address(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('country')!='')
        {
            $address=addslashes($request->input('address'));
            $city=addslashes($request->input('city'));
            $state=addslashes($request->input('state'));
            $country=addslashes($request->input('country'));
            $zip_code=addslashes($request->input('zip_code'));
            
            DB::update("UPDATE users SET home_address='$address', home_state='$state', home_country='$country', home_city='$city', home_zipcode='$zip_code' WHERE id='$id'");
            $request->session()->flash('success', 'Your details have been updated successfully.');
            return redirect('home-address');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        
        return view('home_address.index', ['title'=>'Home address', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function verify_phone(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        
        if($user->phone=='') return redirect('welcome/step1of5');
            
        return view('verify_phone.index', ['title'=>'Verify phone number', 'user_data'=>$user]);
    }
    
    public function phone(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('otp')!='')
        {
            $otp=addslashes($request->input('otp'));
            
            $check=DB::select("SELECT id, country_code_new, phone_new FROM users WHERE id='$id' AND otp='$otp'");
            if(count($check)==1)
            {
                $check=collect($check)->first();
                DB::update("UPDATE users SET phone_verified='1', otp='', country_code_new='', phone_new='', country_code='$check->country_code_new', phone='$check->phone_new' WHERE id='$id'");
                $request->session()->flash('success', 'Your phone number has been updated successfully.');
                return redirect('phone');
            }
            else {
                $request->session()->flash('error', 'Please enter a valid OTP.');
                return redirect('phone?v=1');
            }
            
        }
        
        if($request->input('phone_new')!='')
        {
            $country_code_new=addslashes($request->input('country_code_new'));
            $country_code_new='+'.$country_code_new;
            $phone_new=addslashes($request->input('phone_new'));
            
            $otp=rand(pow(10, 4-1), pow(10, 4)-1);
            \CommonFunctions::instance()->send_sms('Your OTP for ProximaRide is '.$otp, $country_code_new.$phone_new);
            
            DB::update("UPDATE users SET country_code_new='$country_code_new', phone_new='$phone_new', otp='$otp' WHERE id='$id'");
            return redirect('phone?v=1');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        
        return view('phone.index', ['title'=>'Phone', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function email(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        if($request->input('email')!='' AND $user->email!=$request->input('email'))
        {
            $email=addslashes($request->input('email'));
            
            $check=DB::select("SELECT id FROM users WHERE email='$email' LIMIT 1");
            if(count($check)==0)
            {
                $code=substr(md5(uniqid(rand(),true)),0,20);
                DB::update("UPDATE users SET update_email='$email', code='$code' WHERE id='$id'");
                
                $name=$user->first_name;
                    
                $from=env('MAIL_USERNAME');
                $data2=array(
                    'u_id'=>$id,
                    'code'=>$code,
                    'email'=>$email,
                    'from'=>$from,
                    'name'=>$name
                );
                Mail::send('emails.verify2', $data2, function($message) use($email, $from, $name) {
                    $message->from('info@proximaride.com', 'ProximaRide');
                    $message->to($email);
                    $message->subject('Please comfirm your email address');
                });
                
                //$request->session()->flash('success', 'We have sent you a verification email to '.$email.'. Please follow the link to get your email updated.');
            }
            else
            {
                $request->session()->flash('error', 'Email '.$email.' is already registered with ProximaRide.');
            }
            return redirect('email');
        }
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        
        return view('email.index', ['title'=>'Email', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function photo(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('file_name')!=''){
            $file_name=$request->input('file_name');
            
            DB::update("UPDATE users SET profile_image='$file_name' WHERE id='$id'");
            
            return redirect('photo');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('photo.index', ['title'=>'Photo', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function preferences(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('pets')!='')
        {
            $pets=addslashes($request->input('pets'));
            $smoke=addslashes($request->input('smoke'));$features='';
            if($request->input('features')!='') $features=implode(';', $request->input('features'));
            
            DB::update("UPDATE users SET smoke='$smoke', pets='$pets', features='$features' WHERE id='$id'");
            $request->session()->flash('success', 'Your preferences have been updated successfully.');
            return redirect('preferences');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('preferences.index', ['title'=>'Preferences', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function verify_driver(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        $data = array();
        $data['success'] = 0;

        if($request->file('file')!=''){
            $error='';
            $file=$request->file('file');
            
            //Move Uploaded File

                $dir = 'driver_license/';
                $data = $this->upload_image($file, $dir);

                // $img_name=$file->getClientOriginalName();
                // $array=explode('.', $img_name);
                // $img_name=$array[0];
                // $ext=$array[1];
                // $img_name=time().rand(pow(10, 4-1), pow(10, 4)-1).'.'.$ext;
                // $fileName = $destinationPath . $img_name; // renameing image
                
                if($data['success'] == 1) {
                    $img_name = $data['name'];
                    DB::update("UPDATE users SET driver_license='$img_name', driver='2' WHERE id='$id'");
                    
                     return response()->json($data);
                }
            
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('verify_driver.index', ['title'=>"Verify driver's license", 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function verify_student(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->file('file')!=''){
            $error='';
            $file=$request->file('file');
            
            //Move Uploaded File
            $destinationPath = 'student_cards/';

            $data = $this->upload_image($file, $destinationPath);
            

            if($data['success'] == 1) {
                $img_name = $data['name'];
                DB::update("UPDATE users SET student_card='$img_name', student='2' WHERE id='$id'");

                return response()->json($data);
            }

            // return redirect('verify-student');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('verify_student.index', ['title'=>"Verify student card", 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function password(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('pass')!='')
        {
            $pass=addslashes($request->input('pass'));
            $pass1=addslashes($request->input('pass1'));
            $pass2=addslashes($request->input('pass2'));
            
            $check=DB::select("SELECT id FROM users WHERE id='$id' AND pass='$pass' LIMIT 1");
            if(count($check)==1)
            {
                if($pass1==$pass2) 
                {
                    DB::update("UPDATE users SET pass='$pass1' WHERE id='$id'");
                    $request->session()->flash('success', 'Your password has been updated successfully.');
                    
                    //send email START
                        \CommonFunctions::instance()->alert_email($request, $user_id, '0', '0', '8');
                    //send email END
                }
                else
                {
                    $request->session()->flash('error', 'Passwords did not match.');
                }
            }
            else
            {
                $request->session()->flash('error', 'Current password is invalid.');
            }
            
            return redirect('password');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('password.index', ['title'=>'Password', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function payments(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('add_card')!='')
        {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $token=$request->stripeToken;
            $row=DB::select("SELECT email FROM users WHERE id='$id' LIMIT 1");
            $row=collect($row)->first();
            $email=$row->email;
            
            try {
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
            ));
            }
            catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];
                $request->session()->flash('error', $e->getJsonBody());
                return redirect('payments');
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                $request->session()->flash('error', $e->getMessage());
                return redirect('payments');
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
                $request->session()->flash('error', $e->getMessage());
                return redirect('payments');
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                $request->session()->flash('error', $e->getMessage());
                return redirect('payments');
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $request->session()->flash('error', $e->getMessage());
                return redirect('payments');
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $request->session()->flash('error', $e->getMessage());
                return redirect('payments');
            }
            
            $customer_id=$customer->id;
            
            $customer = \Stripe\Customer::retrieve($customer_id);
            $card_id=$customer->sources->data[0]->id;
            $brand=$customer->sources->data[0]->brand;
            $exp_month=$customer->sources->data[0]->exp_month;
            $exp_year=$customer->sources->data[0]->exp_year;
            $last4=$customer->sources->data[0]->last4;
                                
            DB::insert("INSERT INTO cards (user_id, customer_id, card_id, brand, exp_month, exp_year, last4, added_on) VALUES ('$id', '$customer_id', '$card_id', '$brand', '$exp_month', '$exp_year', '$last4', NOW())");
            $request->session()->flash('success', 'Your card has been added successfully.');
            return redirect('payments');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('payments.index', ['title'=>'Payments', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function booking_credits(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        
        if($request->input('package')!='')
        {
            $package=$request->input('package');
            $credit=DB::select("SELECT credits_get, credits_price FROM credits_package WHERE id='$package' LIMIT 1");
            $credit=collect($credit)->first();
            
            $total=$credit->credits_price;
            
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $token=$request->stripeToken;
            $row=DB::select("SELECT email, booking_credits FROM users WHERE id='$id' LIMIT 1");
            $row=collect($row)->first();
            $email=$row->email;
            
            try {
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
            ));
                
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $total*100,
                'currency' => 'CAD'
            ));
                
            $booking_credits=$row->booking_credits+$credit->credits_get;
            DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$id'");
                
            //Record transaction START
            \CommonFunctions::instance()->record_transaction($request, $user_id, 0, 0, '8', $total);
            //Record transaction END
                
            }
            catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];
                $request->session()->flash('error', $e->getMessage());
                return redirect('payments');
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                $request->session()->flash('error', $e->getMessage());
                return redirect('profile?t=payments');
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
                $request->session()->flash('error', $e->getMessage());
                return redirect('profile?t=payments');
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                $request->session()->flash('error', $e->getMessage());
                return redirect('profile?t=payments');
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $request->session()->flash('error', $e->getMessage());
                return redirect('profile?t=payments');
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $request->session()->flash('error', $e->getMessage());
                return redirect('profile?t=payments');
            }
            
            $request->session()->flash('success', 'Booking credits purchased successfully.');
            return redirect('booking-credits');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $credits=DB::select("SELECT * FROM credits_package ORDER BY credits_buy ASC");
        
        return view('booking_credits.index', ['title'=>'Booking credits', 'credits'=>$credits, 'user_data'=>$user]);
    }
    
    public function vehicle(Request $request)
    {
        $id=$request->session()->get('id');
        $user_id=$request->session()->get('id');
        $image=$request->input('car_file_name');
        
        if($request->input("remove")=='1')
        {
            $check=DB::select("SELECT id FROM vehicles WHERE user_id='$id' ORDER BY id DESC LIMIT 1");
            if(count($check)==1)
            {
                $check=collect($check)->first();
                DB::update("UPDATE vehicles SET image='' WHERE id='$check->id'");
                $image='';
            }
        }
        
        if($request->input('model')!='')
        {
            $model=addslashes($request->input('model'));
            $type=addslashes($request->input('type'));
            $other=addslashes($request->input('other'));
            $license_no=addslashes($request->input('license_no'));
            $color=addslashes($request->input('color'));
            $year=addslashes($request->input('year'));
            
            $check=DB::select("SELECT id FROM vehicles WHERE user_id='$id' ORDER BY id DESC LIMIT 1");
            if(count($check)==1)
            {
                $check=collect($check)->first();
                DB::update("UPDATE vehicles SET model='$model', type='$type', other='$other', license_no='$license_no', color='$color', year='$year' WHERE id='$check->id'");
                
                if($image!='')
                    DB::update("UPDATE vehicles SET image='$image' WHERE id='$check->id'");
            }
            else {
                DB::insert("INSERT INTO vehicles (user_id, model, type, other, license_no, color, year, image, added_on) VALUES ('$id', '$model', '$type', '$other', '$license_no', '$color', '$year', '$image', NOW())");
            }
            
            return redirect('vehicle');
        }
        
        $user=DB::select("SELECT * FROM users WHERE id='$id' LIMIT 1");
        $user=collect($user)->first();
        
        $cards=DB::select("SELECT * FROM cards WHERE user_id='$id' ORDER BY id DESC");
        $vehicle=DB::select("SELECT * FROM vehicles WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($vehicle)==1) $vehicle=collect($vehicle)->first();
        
        if($user->phone=='') return redirect('welcome/step1of5');
        return view('vehicle.index', ['title'=>'Vehicle', 'user_data'=>$user, 'cards'=>$cards, 'vehicle'=>$vehicle]);
    }
    
    public function all_transactions(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $transactions=array(); $i=0;
        $row=DB::select("SELECT * FROM transactions WHERE to_id='$user_id' ORDER BY id DESC");
        foreach($row as $r)
        {
            $transactions[$i]['transaction']=$r;
            
            $transactions[$i]['link']='NA';
            $row2=DB::select("SELECT ride_id FROM bookings WHERE id='$r->link_id' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                
                $row2=DB::select("SELECT url FROM rides WHERE id='$row2->ride_id' LIMIT 1");
                if(count($row2)==1)
                {
                    $row2=collect($row2)->first();
                    $transactions[$i]['link']=$row2;
                }
            }
            
            $transactions[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$r->user_id' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $transactions[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        return view('all_transactions.index', ['title'=>'All transactions', 'transactions'=>$transactions]);
    }
    
    public function refer_friend(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $transactions=array(); $i=0;
        $row=DB::select("SELECT * FROM transactions WHERE to_id='$user_id' ORDER BY id DESC");
        foreach($row as $r)
        {
            $transactions[$i]['transaction']=$r;
            
            $transactions[$i]['link']='NA';
            $row2=DB::select("SELECT ride_id FROM bookings WHERE id='$r->link_id' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                
                $row2=DB::select("SELECT url FROM rides WHERE id='$row2->ride_id' LIMIT 1");
                if(count($row2)==1)
                {
                    $row2=collect($row2)->first();
                    $transactions[$i]['link']=$row2;
                }
            }
            
            $transactions[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$r->user_id' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $transactions[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        return view('all_referrals.index', ['title'=>'Refer a Friend', 'transactions'=>$transactions]);
    }
    
    public function request_withdrawal(Request $request)
    {
        $user_id=$request->session()->get('id');
        
        $user=DB::select("SELECT balance, email FROM users WHERE id='$user_id' LIMIT 1");
        $user=collect($user)->first();
        
        $withdrawal_request=DB::select("SELECT * FROM withdrawal_requests WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
        if(count($withdrawal_request)==1) $withdrawal_request=collect($withdrawal_request)->first();
        
        $active_request=DB::select("SELECT * FROM withdrawal_requests WHERE user_id='$user_id' AND status='0' ORDER BY id DESC LIMIT 1");
        if(count($active_request)==1) $active_request=collect($active_request)->first();
        
        if($request->input('amount')!='')
        {
            $amount=addslashes($request->input('amount'));
            $method=addslashes($request->input('method'));
            $account_no=addslashes($request->input('account_no'));
            $bank_name=addslashes($request->input('bank_name'));
            $ifsc_code=addslashes($request->input('ifsc_code'));
            $country=addslashes($request->input('country'));
            $paypal_email=addslashes($request->input('paypal_email'));
            
            if($amount>10)
            {
                if($amount<=$user->balance)
                {
                    DB::insert("INSERT INTO withdrawal_requests (user_id, amount, method, account_no, bank_name, ifsc_code, country, paypal_email, status, on_date) VALUES ('$user_id', '$amount', '$method', '$account_no', '$bank_name', '$ifsc_code', '$country', '$paypal_email', '0', NOW())");
                    return redirect('request-withdrawal');
                }
                else
                {
                    $request->session()->flash('error', 'Insufficient funds to make withdrawal request.');
                    return redirect('request-withdrawal');
                }
            }
            else
            {
                $request->session()->flash('error', 'Minimum $10 CAD is required to make withdrawal request.');
                return redirect('request-withdrawal');
            }
        }
        
        return view('request_withdrawal.index', ['title'=>'Request withdrawal', 'request'=>$withdrawal_request, 'active_request'=>$active_request]);
    }
}
