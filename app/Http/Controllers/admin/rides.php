<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use DB;

class rides extends Controller
{
    public function rides(Request $request)
    {
        if($request->input('cancel_id')!='')
        {
            $ride_id=$request->input('cancel_id');
            
            DB::update("UPDATE rides SET status='2' WHERE id='$ride_id'");
            
            $ride=DB::select("SELECT * FROM rides WHERE id='$ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $user1=DB::select("SELECT * FROM users WHERE id='$ride->added_by' LIMIT 1");
            $user1=collect($user1)->first();
            
            $l_from=$ride->departure_city;
            $l_to=$ride->destination_city;
                    
            if($l_from=='') $l_from=$ride->departure_place;
            if($l_to=='') $l_to=$ride->destination_place;
                    
            if($l_from=='') $l_from=$ride->departure_state;
            if($l_to=='') $l_to=$ride->destination_state;

            if($l_from=='') $l_from=$ride->departure;
            if($l_to=='') $l_to=$ride->destination;
            
            if($user1->phone_verified=='1')
            {
                $sms_text='Important: We have cancelled your ride from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride->date),'l, F d').' at '.date_format(new DateTime($ride->time),'h:i a').', contact at support@proximaride.com for any further assistance. Team ProximaRide.';
                
                \CommonFunctions::instance()->send_sms($sms_text, $user1->country_code.$user1->phone);
            }
            
            $bookings=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status!='3' AND status!='4'");
            if(count($bookings)!=0)
            {
                foreach($bookings as $booking)
                {
                    $seats=$booking->seats;
                
                    $refund_amount=$booking->ride_price*$seats;
                    if($booking->payment_method=='Cash') $refund_amount=0;
                    $booking_price=$booking->booking_price;
                    $refund_amount+=$booking_price;
                
                    if($booking->payment_method=='Online payment' OR $booking->payment_method=='Secured cash' OR $booking->payment_method=='Cash')
                    {
                        //refund the ride price
                        $refund_id='';
                        if($refund_amount!=0 AND $booking->status!='5') 
                        {
                            //refund amount
                            $refund_id=\CommonFunctions::instance()->refund_amount_wallet($request, $booking, $refund_amount);
                    
                            //Record transaction START
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '7', $refund_amount);
                            //Record transaction END
                        }
                        
                        //track cancelled seat
                        DB::insert("INSERT INTO cancelled_seats (user_id, booking_id, driver_id, ride_id, seats, refund_amount, refund_id, on_date) VALUES ('$booking->user_id', '$booking->id', '$booking->driver_id', '$booking->ride_id', '$seats', '$refund_amount', '$refund_id', NOW())");
                        $cancelled_id=DB::getPdo()->lastInsertId();
                        
                        DB::update("UPDATE bookings SET status='4' WHERE id='$booking->id'");
                        
                        if($booking->status!='5') 
                        {
                            //send email START
                            \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $cancelled_id, '7');
                            //send email END
                        }
                    }
                }
            }
        }
        
        $active_rides='';
        $completed_rides='';
        if($request->input('s')=='1') $active_rides='active';
        else if($request->input('s')=='2') $completed_rides='active';
        $rides=array(); $i=0;
        if($request->input('s')=='2')
        $row=DB::select("SELECT * FROM rides WHERE status!='0' ORDER BY id DESC");
        else
        $row=DB::select("SELECT * FROM rides WHERE status='0' ORDER BY id DESC");
        foreach($row as $r)
        {
            $row2=DB::select("SELECT * FROM users WHERE id='$r->added_by' LIMIT 1");
            if(count($row2)==0) 
            {
                DB::delete("DELETE FROM rides WHERE id='$r->id'");
                continue;
            }
            
            $rides[$i]['ride']=$r;
            
            $rides[$i]['seats_left']=$r->seats;
            
            $bookings=array(); $j=0;
            $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$r->id' ORDER BY id DESC");
            foreach($row2 as $r2)
            {
                $bookings[$j]['booking']=$r2;
                
                if($r2->status!='3') $rides[$i]['seats_left']-=$r2->seats;
            
                $bookings[$j]['ride']='NA';
                $ride=DB::select("SELECT * FROM rides WHERE id='$r2->ride_id' LIMIT 1");
                if(count($ride)==1)
                {
                    $ride=collect($ride)->first();
                    $bookings[$j]['ride']=$ride;
                }
            
                $bookings[$j]['passenger']='NA';
                $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar FROM users WHERE id='$r2->user_id' LIMIT 1");
                if(count($passenger)==1)
                {
                    $passenger=collect($passenger)->first();
                    $bookings[$j]['passenger']=$passenger;
                }
            
                $j++;
            }
            
            $rides[$i]['bookings']=$bookings;
            
            $rides[$i]['driver']='NA';
            $row2=DB::select("SELECT * FROM users WHERE id='$r->added_by' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $rides[$i]['driver']=$row2;
            }
            
            $i++;
        }
        
        return view('admin.all_rides.index', ['title'=>'Rides', 'rides'=>$rides, 'active_rides'=>$active_rides, 'completed_rides'=>$completed_rides]);
    }
    
    public function booking_credits(Request $request)
    {
        if($request->input('delete_id')!='')
        {
            $delete_id=addslashes($request->input('delete_id'));
            
            DB::delete("DELETE FROM credits_package WHERE id='$delete_id'");
            
            $request->session()->flash('success', 'Deleted successfully.');
            return redirect('admin/booking-credits');
        }
        
        if($request->input('credits_price')!='')
        {
            $credits_buy=addslashes($request->input('credits_buy'));
            $credits_get=addslashes($request->input('credits_get'));
            $credits_price=addslashes($request->input('credits_price'));
            
            DB::insert("INSERT INTO credits_package (credits_buy, credits_get, credits_price, added_on) VALUES ('$credits_buy', '$credits_get', '$credits_price', NOW())");
            
            $request->session()->flash('success', 'Added successfully.');
            return redirect('admin/booking-credits');
        }
        
        $credits=array(); $i=0;
        $row=DB::select("SELECT * FROM credits_package ORDER BY credits_buy ASC");
        foreach($row as $r)
        {
            $credits[$i]['credit']=$r;
            
            $i++;
        }
        return view('admin.booking_credits.index', ['title'=>'Booking credits', 'credits'=>$credits]);
    }
    
    public function bookings(Request $request)
    {
        $bookings=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings ORDER BY id DESC");
        foreach($row2 as $r2)
        {
            $bookings[$i]['booking']=$r2;
            
            $bookings[$i]['ride']='NA';
            $ride=DB::select("SELECT * FROM rides WHERE id='$r2->ride_id' LIMIT 1");
            if(count($ride)==1)
            {
                $ride=collect($ride)->first();
                $bookings[$i]['ride']=$ride;
            }
            
            $bookings[$i]['passenger']='NA';
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar FROM users WHERE id='$r2->user_id' LIMIT 1");
            if(count($passenger)==1)
            {
                $passenger=collect($passenger)->first();
                $bookings[$i]['passenger']=$passenger;
            }
            
            $bookings[$i]['driver']='NA';
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar FROM users WHERE id='$r2->driver_id' LIMIT 1");
            if(count($passenger)==1)
            {
                $passenger=collect($passenger)->first();
                $bookings[$i]['driver']=$passenger;
            }
            
            $i++;
        }
        
        return view('admin.all_bookings.index', ['title'=>'Bookings', 'bookings'=>$bookings]);
    }
    
    public function reviews(Request $request)
    {
        if($request->input('feature_id'))
        {
            $feature_id=$request->input('feature_id');
            
            $check=DB::select("SELECT id, feature FROM ratings WHERE id='$feature_id' LIMIT 1");
            if(count($check)==1)
            {
                $check=collect($check)->first();
                if($check->feature=='0') DB::update("UPDATE ratings SET feature='1' WHERE id='$feature_id'");
                else DB::update("UPDATE ratings SET feature='0' WHERE id='$feature_id'");
            }
            
            return redirect('admin/reviews');
        }
        
        if($request->input('delete_id'))
        {
            $delete_id=$request->input('delete_id');
            DB::delete("DELETE FROM ratings WHERE id='$delete_id'");
            
            return redirect('admin/reviews');
        }
        
        $reviews=array(); $i=0;
        $row2=DB::select("SELECT * FROM ratings ORDER BY id DESC");
        foreach($row2 as $r2)
        {
            $reviews[$i]['rating']=$r2;
            
            if($r2->type=='1')
            $reviews[$i]['avg_rating']=($r2->timeliness+$r2->vehicle_condition+$r2->safety+$r2->conscious+$r2->comfort+$r2->communication)/6;
            else
            $reviews[$i]['avg_rating']=($r2->timeliness+$r2->attitude+$r2->safety+$r2->hygiene+$r2->respect+$r2->communication)/6;
            
            $reviews[$i]['ride']='NA';
            $ride=DB::select("SELECT * FROM rides WHERE id='$r2->ride_id' LIMIT 1");
            if(count($ride)==1)
            {
                $ride=collect($ride)->first();
                $reviews[$i]['ride']=$ride;
            }
            
            $reviews[$i]['passenger']='NA';
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar FROM users WHERE id='$r2->user_id' LIMIT 1");
            if(count($passenger)==1)
            {
                $passenger=collect($passenger)->first();
                $reviews[$i]['passenger']=$passenger;
            }
            
            $reviews[$i]['driver']='NA';
            $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar FROM users WHERE id='$r2->driver_id' LIMIT 1");
            if(count($passenger)==1)
            {
                $passenger=collect($passenger)->first();
                $reviews[$i]['driver']=$passenger;
            }
            
            $i++;
        }
        
        return view('admin.all_reviews.index', ['title'=>'Reviews', 'reviews'=>$reviews]);
    }
    
    public function transactions(Request $request)
    {
        $transactions=array(); $i=0;
        $row=DB::select("SELECT * FROM transactions ORDER BY id DESC");
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
            
            $transactions[$i]['for_user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$r->to_id' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $transactions[$i]['for_user']=$row2;
            }
            
            $i++;
        }
        
        return view('admin.all_transactions.index', ['title'=>'All Transactions', 'transactions'=>$transactions]);
    }
}
