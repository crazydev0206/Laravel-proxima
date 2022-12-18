<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\ExpressCheckout;

class booking extends Controller
{   

    public function reopen_ride(Request $request, $id)
    {

        DB::table('rides')->where('id', $id)->update(['closed'=>'0']);

        return redirect('/rides-posted');

    }
    
    public function book_seat(Request $request)
    {
        $data=array();
        $data['success']=0;
        $customer_id='';
        $charge_id='';
        $payment_type=$request->input('payment');
        
        // get user details START
        $user_id=$request->session()->get('id');
        $user=DB::select("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
        $user=collect($user)->first();
        $email=$user->email;
        // get user details END
        
        
        //get ride details START
        $ride_id=addslashes($request->input('ride_id'));
        $seats=$request->input('seats');
        if($seats=='') $seats=1;
        
        $ride=DB::select("SELECT * FROM rides WHERE id='$ride_id' LIMIT 1");
        if(count($ride)==0)
        {
            $data['error']='Ride not found.';
            return response()->json($data);
        }
        $ride=collect($ride)->first();
        //get ride details END
        
        if($ride->status==1)
        {
            return redirect('ride/'.$ride->url);
        }
        else if($ride->status==2)
        {
            return redirect('ride/'.$ride->url);
        }
        
        //check if seats available to book START
        $booked=0;
        $row2=DB::select("SELECT id, seats, time_limit FROM bookings WHERE ride_id='$ride_id' AND status!='3' AND status!='4'");
        if(count($row2)!=0)
        {
            foreach($row2 as $r)
            {
                $booked+=$r->seats;
            }
        }
        
        $available_seats=$ride->seats-$booked;
        
        if($available_seats==0)
        {
            $request->session()->flash('error', 'Sorry all seats has been booked.');
            return redirect('ride/'.$ride->url);
        }
        else if($available_seats<$seats)
        {
            $request->session()->flash('error', 'Only '.$available_seats.' seats left for booking.');
            return redirect('book-seat/'.$ride->id);
        }
        //check if seats available to book END
        
        
        if($ride->booking_method=='Instant booking') $status=1;
        else $status=0;
        
        
        //get site booking price
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        $driver_id=$ride->added_by;
        $ride_date=$ride->date;
        
        $ride_time=$ride->date.' '.$ride->time;
        $ride_time=strtotime(date_format(new DateTime($ride_time),'H:i'));
        
        $ride_price=$ride->price;
        $payment_method=$ride->payment_method;
        $total_cost=$ride_price*$seats;
        
        $booking_price=$site->booking_price;
        $booking_per=$site->booking_per;
        
        if($user->charge_booking=='0')
        {
            $booking_price=0;
            $booking_per=1;
        }
        else if($user->booking_price!='' OR $user->booking_per!='')
        {
            $booking_price=$user->booking_price;
            $booking_per=$user->booking_per;
        }
        
        if($booking_per==0) $booking_per=1;
        
        $booking_per=$total_cost*$booking_per/100;
        
        //if($booking_price>$booking_per) $booking_price=$booking_per;
        
        if($ride_price<=15) $booking_price=0;
        
        $b_credit=0;
        if($user->booking_credits>0) { $booking_price=0; $b_credit=1; }
            
        $booking_price=number_format($booking_price, 2);
        $total_price=$total_cost+$booking_price;
        $total_price=number_format($total_price, 2);
        $free_ride=0;
        
        if($payment_method=='Cash')
        $charge_price=$booking_price;
        else
        $charge_price=$total_price;
        
        $booking_data=array();
        $booking_data['seats']=$seats;
        $booking_data['booking_price']=$booking_price;
        $booking_data['payment_method']=$payment_method;
        
        if($user->free_rides>0)
        {
            //deduct one free ride
            $new_free_rides=$user->free_rides-1;
            DB::update("UPDATE users SET free_rides='$new_free_rides' WHERE id='$user_id'");
            $free_ride=1;
                
            //make booking START
                $booking_id=$this->make_booking($request, $user_id, $driver_id, $ride_id, $ride_date, $ride_time, $seats, $ride_price, $booking_price, $payment_method, $status, $free_ride, $customer_id, $charge_id);
            //make booking END
            $data['success']=1;
        }
        else if($user->balance>=$charge_price)
        {
            //make payment from wallet
            
            //make payment START
            $new_balance=$user->balance-$charge_price;
            DB::update("UPDATE users SET balance='$new_balance' WHERE id='$user_id'");
            //make payment END
            
            //make booking START
            $booking_id=$this->make_booking($request, $user_id, $driver_id, $ride_id, $ride_date, $ride_time, $seats, $ride_price, $booking_price, $payment_method, $status, $free_ride, $customer_id, $charge_id);
            //make booking END
            
            //Record transaction START
            \CommonFunctions::instance()->record_transaction($request, $user_id, $user_id, $booking_id, '1', $charge_price);
            //Record transaction END
            
            $data['success']=1;
        }
        //check payment method
        else if($payment_method=='Cash')
        {
            //charge booking fee START
            if($charge_price>0) {
                $payment_data=$this->make_payment_card($request, $payment_type, $charge_price, $ride, $user, $booking_data);
                if($payment_data['redirect']=='1') return redirect($payment_data['url']);
                $customer_id=$payment_data['customer_id'];
                $charge_id=$payment_data['charge_id'];
            }
            //charge booking fee END
                
                
            //make booking START
            $booking_id=$this->make_booking($request, $user_id, $driver_id, $ride_id, $ride_date, $ride_time, $seats, $ride_price, $booking_price, $payment_method, $status, $free_ride, $customer_id, $charge_id);
            //make booking END
                
            //Record transaction START
            \CommonFunctions::instance()->record_transaction($request, $user_id, $user_id, $booking_id, '4', $booking_price);
            //Record transaction END
            $data['success']=1;
            
        }
        else if($payment_method=='Online payment' OR $payment_method=='Secured cash')
        {
            //make payment START
            $payment_data=$this->make_payment_card($request, $payment_type, $charge_price, $ride, $user, $booking_data);
            if($payment_data['redirect']=='1') return redirect($payment_data['url']);
            $customer_id=$payment_data['customer_id'];
            $charge_id=$payment_data['charge_id'];
            //make payment END
            
            //make booking START
            $booking_id=$this->make_booking($request, $user_id, $driver_id, $ride_id, $ride_date, $ride_time, $seats, $ride_price, $booking_price, $payment_method, $status, $free_ride, $customer_id, $charge_id);
            //make booking END
            
            //Record transaction START
            \CommonFunctions::instance()->record_transaction($request, $user_id, $user_id, $booking_id, '1', $total_price);
            //Record transaction END
        }
        
        if(isset($booking_id)) {
            if($b_credit==1)
            {
                $b_credit=$user->booking_credits-1;
                DB::update("UPDATE users SET booking_credits='$b_credit' WHERE id='$user->id'");
                DB::update("UPDATE bookings SET booking_credit='1' WHERE id='$booking_id'");
            }
            
            //send email START
            \CommonFunctions::instance()->alert_email($request, $user_id, $driver_id, $booking_id, '1');
            //send email END
            
            if($status==1)
            $request->session()->flash('success', 'Your seat(s) has been booked successfully.');
            else
            $request->session()->flash('success', 'Your booking request has been placed successfully.');
            return redirect('ride/'.$ride->url);
        }
        
        $request->session()->flash('error', 'Sorry there was some error. Please try again later.');
        return redirect('ride/'.$ride->url);
    }
    
    public function cancel_seat(Request $request, $id)
    {
        $user_id=$request->session()->get('id');
        
        $booking=DB::select("SELECT * FROM bookings WHERE id='$id' AND user_id='$user_id' LIMIT 1");
        if(count($booking)==1)
        $booking=collect($booking)->first();
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE id='$booking->ride_id' LIMIT 1");
        foreach($row as $r)
        {
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, driver, profile_image, dob, username, phone_verified FROM users WHERE id='$r->added_by' LIMIT 1");
            $row2=collect($row2)->first();
            $ride[$i]['driver']=$row2;
            
            $t_date=new DateTime('today');
            $driver_age=date_diff(date_create($row2->dob), $t_date)->y;
            $ride[$i]['driver_age']=$driver_age;
            
            $ride[$i]['driver_ratings']='NA';
            $row2=DB::select("SELECT avg(timeliness) as timeliness, avg(vehicle_condition) as vehicle_condition, avg(safety) as safety, avg(conscious) as conscious, avg(comfort) as comfort, avg(communication) as communication FROM ratings WHERE driver_id='$r->added_by' AND type='1' LIMIT 1");



            if(!empty($row2))
            {
                $r2=collect($row2)->first();
                $ride[$i]['driver_ratings']=($r2->timeliness+$r2->vehicle_condition+$r2->safety+$r2->conscious+$r2->comfort+$r2->communication)/6;
            }
            
            $i++;
        }
        
        if(empty($booking) OR $booking->status=='4') return redirect('ride/'.$ride[0]['ride']->url);
        
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
        
        //start cancelling seats
        if($request->input('seats')!='')
        {
            $seats=$request->input('seats');
            
            if($booking->seats>=$seats)
            {
                $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
                $date->modify("-24 hours");
                $hours24_before=$date->format("Y-m-d H:i:00");
    
                $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
                $date->modify("-12 hours");
                $hours12_before=$date->format("Y-m-d H:i:00");
                
                $refund_amount=$booking->ride_price*$seats;
                if($booking->payment_method=='Cash') $refund_amount=0;
                $booking_price=$booking->booking_price;
                
                $policy=0;
                //check the time of booking cancellation
                if($hours24_before>=date('Y-m-d H:i:00') OR $booking->status=='0')
                {
                    //full refund of payment with booking fee
                }
                else if($hours12_before>=date('Y-m-d H:i:00'))
                {
                    //half refund of payment without booking fee
                    if($refund_amount!=0) $refund_amount=$refund_amount/2;
                    $booking_price=0;
                    $policy=1;
                }
                else
                {
                    //no refund of any payment
                    $refund_amount=0;
                    $booking_price=0;
                    $policy=2;
                }
                
                if($booking->seats==$seats) $refund_amount+=$booking_price;
                
                if($booking->payment_method=='Online payment' OR $booking->payment_method=='Secured cash' OR $booking->payment_method=='Cash')
                {
                    //refund the ride price
                    if(1)
                    {
                        $refund_id='';
                        if($refund_amount!=0) 
                        {
                            //refund amount
                            $refund_id=\CommonFunctions::instance()->refund_amount_wallet($request, $booking, $refund_amount);
                    
                            //Record transaction START
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '6', $refund_amount);
                            //Record transaction END
                        }
                        
                            
                        $price=$booking->ride_price*$seats;
                        if($booking->payment_method!='Cash') $price=0;
                        $booking_price=$booking->booking_price;
                        
                        //credit the payment to driver on cancellation if applicable
                        if($policy==1)
                        {
                            $user=DB::select("SELECT balance FROM users WHERE id='$booking->driver_id' LIMIT 1");
                            $user=collect($user)->first();
        
                            $new_balance=$user->balance+($price/2);
        
                            DB::update("UPDATE users SET balance='$new_balance' WHERE id='$booking->driver_id'");
                            
                            //Record transaction START
                            $price2=$price/2;
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->driver_id, $booking->id, '7', $price2);
                            //Record transaction END
                        }
                        else if($policy==2)
                        {
                            $user=DB::select("SELECT balance FROM users WHERE id='$booking->driver_id' LIMIT 1");
                            $user=collect($user)->first();
        
                            $new_balance=$user->balance+$price;
        
                            DB::update("UPDATE users SET balance='$new_balance' WHERE id='$booking->driver_id'");
                            
                            //Record transaction START
                            $price2=$price/2;
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->driver_id, $booking->id, '7', $price2);
                            //Record transaction END
                        }
                        
                        $ride2=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
                        $ride2=collect($ride2)->first();
            
                        $l_from=$ride2->departure_city;
                        $l_to=$ride2->destination_city;
                            
                            //send SMS to passenger START
                            $sms_text='ProximaRide: Your booking has been cancelled for '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride[0]['ride']->date),'l, F d').'. ';
                            
                            if($policy==0) $sms_text.='We have refunded you $'.number_format($price+$booking_price, 2).'.';
                            else if($policy==1) $sms_text.='We have refunded you $'.number_format($refund_amount, 2).' for the late notice.';
                            else if($policy==2) $sms_text.='No refund is made for the late notice.';
                            
                            $user=DB::select("SELECT first_name, phone_verified, country_code, phone FROM users WHERE id='$booking->user_id' LIMIT 1");
                            $user=collect($user)->first();
                            if($user->phone_verified=='1') 
                            {
                                \CommonFunctions::instance()->send_sms($sms_text, $user->country_code.$user->phone);
                            }
                            //send SMS to passenger END
                        
                            //send SMS to driver START
                            $sms_text='Important: '.$user->first_name.' has cancelled their booking from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride[0]['ride']->date),'l, F d').'.';
                            
                        if($booking->payment_method!='Cash') {
                            if($policy==1) 
                            {
                                $price=number_format($price/2, 2);
                                $sms_text.=' You will receive $'.$price.' for the late notice.';
                            }
                            else if($policy==2) 
                            {
                                $price=number_format($price, 2);
                                $sms_text.=' You will receive $'.$price.' for the late notice.';
                            }
                        }
                        
                            $sms_text.=' Team ProximaRide.';
                            
                            $user=DB::select("SELECT phone_verified, country_code, phone FROM users WHERE id='$booking->driver_id' LIMIT 1");
                            $user=collect($user)->first();
                            if($user->phone_verified=='1') 
                            {
                                \CommonFunctions::instance()->send_sms($sms_text, $user->country_code.$user->phone);
                            }
                            //send SMS to driver END
                        
                        //track cancelled seat
                        DB::insert("INSERT INTO cancelled_seats (user_id, booking_id, driver_id, ride_id, seats, refund_amount, refund_id, on_date) VALUES ('$user_id', '$booking->id', '$booking->driver_id', '$booking->ride_id', '$seats', '$refund_amount', '$refund_id', NOW())");
                        $cancelled_id=DB::getPdo()->lastInsertId();
                        
                        if($booking->seats==$seats)
                        {
                            DB::update("UPDATE bookings SET status='4' WHERE id='$booking->id'");
                        }
                        else
                        {
                            $new_seats=$booking->seats-$seats;
                            DB::update("UPDATE bookings SET seats='$new_seats' WHERE id='$booking->id'");
                        }
                        
                        //send email START
                        \CommonFunctions::instance()->alert_email($request, $user_id, $booking->driver_id, $cancelled_id, '6');
                        //send email END
                        
                        if($booking->booking_credit==1)
                        {
                            $user=DB::select("SELECT id, booking_credits FROM users WHERE id='$booking->user_id' LIMIT 1");
                            $user=collect($user)->first();
                            
                            $booking_credits=$user->booking_credits+1;
                            DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$booking->user_id'");
                        }
                        
                        $request->session()->flash('success', 'Your seat(s) has been cancelled succesfully.');
                        return redirect('ride/'.$ride[0]['ride']->url);
                    }
                }
                else if($booking->payment_method=='Cash')
                {
                    
                }
            }
        }
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        return view('cancel_seat.index', ['title'=>'Cancel seat', 'ride'=>$ride, 'user_ride'=>$user_ride, 'user_rating'=>$user_rating, 'site'=>$site, 'booking'=>$booking]);
    }
    
    public function cancel_passenger(Request $request, $id)
    {
        $user_id=$request->session()->get('id');
        
        $booking=DB::select("SELECT * FROM bookings WHERE id='$id' LIMIT 1");
        if(count($booking)==1)
        $booking=collect($booking)->first();
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE id='$booking->ride_id' LIMIT 1");
        foreach($row as $r)
        {
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, driver, profile_image, dob, username, phone_verified FROM users WHERE id='$r->added_by' LIMIT 1");
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
        
        if(count($booking)==0 OR $booking->status=='4') return redirect('ride/'.$ride[0]['ride']->url);
        
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
        
        //start cancelling seats
        if($request->input('seats')!='')
        {
            $seats=$request->input('seats');
            
            if($booking->seats>=$seats)
            {
                $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
                $date->modify("-24 hours");
                $hours24_before=$date->format("Y-m-d H:i:00");
    
                $date = new DateTime($ride[0]['ride']->date." ".$ride[0]['ride']->time);
                $date->modify("-12 hours");
                $hours12_before=$date->format("Y-m-d H:i:00");
                
                $refund_amount=$booking->ride_price*$seats;
                if($booking->payment_method=='Cash') $refund_amount=0;
                $booking_price=$booking->booking_price;
                
                $policy=0;
                //full refund of payment with booking fee
                
                if($booking->seats==$seats) $refund_amount+=$booking_price;
                
                if($booking->payment_method=='Online payment' OR $booking->payment_method=='Secured cash' OR $booking->payment_method=='Cash')
                {
                    //refund the ride price
                    if(1)
                    {
                        $refund_id='';
                        if($refund_amount!=0) 
                        {
                            //refund amount
                            $refund_id=\CommonFunctions::instance()->refund_amount_wallet($request, $booking, $refund_amount);
                    
                            //Record transaction START
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '6', $refund_amount);
                            //Record transaction END
                        }
                        
                            
                        $price=$booking->ride_price*$seats;
                        if($booking->payment_method!='Cash') $price=0;
                        $booking_price=$booking->booking_price;
                        
                        $ride2=DB::select("SELECT id, departure_city, destination_city, departure_place, destination_place, departure_state, destination_state, departure, destination, url, date, time FROM rides WHERE id='$booking->ride_id' LIMIT 1");
                        $ride2=collect($ride2)->first();
            
                        $l_from=$ride2->departure_city;
                        $l_to=$ride2->destination_city;
                            
                            //send SMS to passenger START
                            $sms_text=trans('sms.seat_cancelled_by_driver', ['l_from'=>$l_from, 'l_to'=>$l_to, 'date'=>date_format(new DateTime($ride[0]['ride']->date),'l, F d')]);
                            
                            $sms_text.=trans('sms.refunded_amount', ['amount'=>number_format($price+$booking_price, 2)]);
                            $sms_text.=trans('sms.team_proximaride');
                            
                            $user=DB::select("SELECT first_name, phone_verified, country_code, phone FROM users WHERE id='$booking->user_id' LIMIT 1");
                            $user=collect($user)->first();
                            if($user->phone_verified=='1') 
                            {
                                \CommonFunctions::instance()->send_sms($sms_text, $user->country_code.$user->phone);
                            }
                            //send SMS to passenger END
                        
                            //send SMS to driver START
                            $sms_text=trans('sms.you_cancelled_seats_driver', ['first_name'=>$user->first_name, 'l_from'=>$l_from, 'l_to'=>$l_to, 'date'=>date_format(new DateTime($ride[0]['ride']->date),'l, F d')]);
                            $sms_text.=trans('sms.team_proximaride');
                            
                            $user=DB::select("SELECT phone_verified, country_code, phone FROM users WHERE id='$booking->driver_id' LIMIT 1");
                            $user=collect($user)->first();
                            if($user->phone_verified=='1') 
                            {
                                \CommonFunctions::instance()->send_sms($sms_text, $user->country_code.$user->phone);
                            }
                            //send SMS to driver END
                        
                        //track cancelled seat
                        DB::insert("INSERT INTO cancelled_seats (user_id, booking_id, driver_id, ride_id, seats, refund_amount, refund_id, on_date) VALUES ('$user_id', '$booking->id', '$booking->driver_id', '$booking->ride_id', '$seats', '$refund_amount', '$refund_id', NOW())");
                        $cancelled_id=DB::getPdo()->lastInsertId();
                        
                        if($booking->seats==$seats)
                        {
                            DB::update("UPDATE bookings SET status='4' WHERE id='$booking->id'");
                        }
                        else
                        {
                            $new_seats=$booking->seats-$seats;
                            DB::update("UPDATE bookings SET seats='$new_seats' WHERE id='$booking->id'");
                        }
                        
                        //send email START
                        \CommonFunctions::instance()->alert_email($request, $user_id, $booking->driver_id, $cancelled_id, '6-b');
                        //send email END
                        
                        if($booking->booking_credit==1)
                        {
                            $user=DB::select("SELECT id, booking_credits FROM users WHERE id='$booking->user_id' LIMIT 1");
                            $user=collect($user)->first();
                            
                            $booking_credits=$user->booking_credits+1;
                            DB::update("UPDATE users SET booking_credits='$booking_credits' WHERE id='$booking->user_id'");
                        }
                        
                        $request->session()->flash('success', 'Seat(s) has been cancelled succesfully.');
                        return redirect('ride/'.$ride[0]['ride']->url);
                    }
                }
                else if($booking->payment_method=='Cash')
                {
                    
                }
            }
        }
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        
        $passenger=DB::select("SELECT * FROM users WHERE id='$booking->user_id' LIMIT 1");
        $passenger=collect($passenger)->first();
        return view('cancel_passenger.index', ['title'=>'Cancel passenger', 'ride'=>$ride, 'user_ride'=>$user_ride, 'user_rating'=>$user_rating, 'site'=>$site, 'booking'=>$booking, 'passenger'=>$passenger]);
    }
    
    public function cancel_ride(Request $request, $id)
    {
        $user_id=$request->session()->get('id');
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE id='$id' LIMIT 1");
        foreach($row as $r)
        {
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, driver, profile_image, dob, username, phone_verified FROM users WHERE id='$r->added_by' LIMIT 1");
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
        
        if($ride[0]['ride']->added_by!=$user_id) return redirect('ride/'.$ride[0]['ride']->url);
        
        $bookings=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status!='3' AND status!='4'");
        foreach($row2 as $r2)
        {
            for($j=0; $j<$r2->seats; $j++) 
            {
                $bookings[$i]['booking']=$r2;
            
                $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username, phone_verified FROM users WHERE id='$r2->user_id' LIMIT 1");
                $passenger=collect($passenger)->first();
                $bookings[$i]['passenger']=$passenger;
            
                $i++;
            }
        }
        
        //start cancelling seats
        if($request->input('cancel')!='')
        {
            $ids='';
            $cancel_recurring='';
            if($request->input('cancel_recurring')!='')
            {
                $cancel_recurring=" OR (parent='$ride_id' AND status='0') ";
                $ids2=DB::select("SELECT id FROM rides WHERE parent='$ride_id' AND status='0'");
                
                if($ride[0]['ride']->parent!=0)
                {
                    $recurring_id=$ride[0]['ride']->parent;
                    $cancel_recurring=" OR ((id='$recurring_id' OR parent='$recurring_id') AND status='0') ";
                    $ids2=DB::select("SELECT id FROM rides WHERE (id='$recurring_id' OR parent='$recurring_id') AND status='0'");
                }
                
                foreach($ids2 as $ii)
                {
                    $ids.=" OR ride_id='$ii->id' ";
                }
            }
            DB::update("UPDATE rides SET status='2' WHERE id='$ride_id' $cancel_recurring ");
            
            $bookings=DB::select("SELECT * FROM bookings WHERE (ride_id='$ride_id' $ids ) AND status!='3' AND status!='4'");
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
            
            $l_from=$ride[0]['ride']->departure_city;
            $l_to=$ride[0]['ride']->destination_city;
            
            $sms_text='ProximaRide: You have successfully cancelled your ride from '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride[0]['ride']->date),'l, F d').' at '.date_format(new DateTime($ride[0]['ride']->time),'h:i a').'. Team ProximaRide.';
                            
            $driver_id=$ride[0]['ride']->added_by;
            $user=DB::select("SELECT phone_verified, country_code, phone FROM users WHERE id='$driver_id' LIMIT 1");
            $user=collect($user)->first();
            if($user->phone_verified=='1') 
            {
                \CommonFunctions::instance()->send_sms($sms_text, $user->country_code.$user->phone);
            }
            
            //$request->session()->flash('success', 'Your ride has been cancelled succesfully.');
            return redirect('ride/'.$ride[0]['ride']->url);
        }
        
        $recurring_rides=DB::select("SELECT id FROM rides WHERE (parent='$id' OR (id='$id' AND parent!=0)) AND status='0'");
        $recurring_rides=count($recurring_rides);
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        return view('cancel_ride.index', ['title'=>'Cancel ride', 'ride'=>$ride, 'user_ride'=>$user_ride, 'user_rating'=>$user_rating, 'site'=>$site, 'bookings'=>$bookings, 'recurring_rides'=>$recurring_rides]);
    }
    
    public function close_ride(Request $request, $id)
    {
        $user_id=$request->session()->get('id');
        
        $ride=array(); $i=0;
        $row=DB::select("SELECT * FROM rides WHERE id='$id' LIMIT 1");
        foreach($row as $r)
        {
            $ride[$i]['ride']=$r;
            $ride_id=$r->id;
            
            $row2=DB::select("SELECT id, first_name, last_name, gender, avatar, email, verify, driver, profile_image, dob, username, phone_verified FROM users WHERE id='$r->added_by' LIMIT 1");
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
        
        if($ride[0]['ride']->added_by!=$user_id) return redirect('ride/'.$ride[0]['ride']->url);
        
        $bookings=array(); $i=0;
        $row2=DB::select("SELECT * FROM bookings WHERE ride_id='$ride_id' AND status!='3' AND status!='4'");
        foreach($row2 as $r2)
        {
            for($j=0; $j<$r2->seats; $j++) 
            {
                $bookings[$i]['booking']=$r2;
            
                $passenger=DB::select("SELECT id, first_name, last_name, email, phone, gender, profile_image, avatar, username, phone_verified FROM users WHERE id='$r2->user_id' LIMIT 1");
                $passenger=collect($passenger)->first();
                $bookings[$i]['passenger']=$passenger;
            
                $i++;
            }
        }
        
        //close the ride
        if($request->input('cancel')!='')
        {
            DB::update("UPDATE rides SET closed='1' WHERE id='$ride_id'");
            
            $l_from=$ride[0]['ride']->departure_city;
            $l_to=$ride[0]['ride']->destination_city;
            
            $sms_text='Important: You have closed your ride '.$l_from.' to '.$l_to.' on '.date_format(new DateTime($ride[0]['ride']->date),'l, F d').' at '.date_format(new DateTime($ride[0]['ride']->time),'h:i a').'. Team ProximaRide.';
                            
            $driver_id=$ride[0]['ride']->added_by;
            $user=DB::select("SELECT phone_verified, country_code, phone FROM users WHERE id='$driver_id' LIMIT 1");
            $user=collect($user)->first();
            if($user->phone_verified=='1') 
            {
                /*\CommonFunctions::instance()->send_sms($sms_text, $user->country_code.$user->phone);*/
            }
            
            //$request->session()->flash('success', 'Your ride has been cancelled succesfully.');
            return redirect('ride/'.$ride[0]['ride']->url);
        }
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        return view('close_ride.index', ['title'=>'Close ride', 'ride'=>$ride, 'user_ride'=>$user_ride, 'user_rating'=>$user_rating, 'site'=>$site, 'bookings'=>$bookings]);
    }
    
    public function make_booking($request, $user_id, $driver_id, $ride_id, $ride_date, $ride_time, $seats, $ride_price, $booking_price, $payment_method, $status, $free_ride, $customer_id, $charge_id)
    {
        $time_limit=0;
        if($status==0)
        {
            //set limit to accept booking
            $ride=DB::select("SELECT date, time FROM rides WHERE id='$ride_id' LIMIT 1");
            $ride=collect($ride)->first();
            
            $ride_time=$ride->date.' '.$ride->time;
            $ride_time=strtotime(date_format(new DateTime($ride_time),'Y-m-d H:i'));
            $current_time=strtotime(date('Y-m-d H:i'));
            
            $diff = $ride_time - $current_time;
            $hours = $diff / ( 60 * 60 );
            
            if($hours>=36) $time_limit=12;
            else if($hours>=12 AND $hours<=36) $time_limit=6;
            else if($hours>=6 AND $hours<=12) $time_limit=3;
        }
        
        DB::insert("INSERT INTO bookings (user_id, driver_id, ride_id, ride_date, ride_time, seats, ride_price, booking_price, payment_method, status, booked_on, free_ride, customer_id, charge_id, time_limit) VALUES ('$user_id', '$driver_id', '$ride_id', '$ride_date', '$ride_time', '$seats', '$ride_price', '$booking_price', '$payment_method', '$status', NOW(), '$free_ride', '$customer_id', '$charge_id', '$time_limit')");
        $id=DB::getPdo()->lastInsertId();
        
        return $id;
    }
    
    public function make_payment_card($request, $payment_type, $total, $ride, $user, $booking_data)
    {
        $user_id=$request->session()->get('id');
        $payment_data=array();
        $payment_data['customer_id']='';
        $payment_data['charge_id']='';
        $payment_data['redirect']=0;
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            
        if($payment_type=='my_card')
            {
                $card_id=$request->input('card_id');
                $card=DB::select("SELECT customer_id FROM cards WHERE id='$card_id' LIMIT 1");
                $card=collect($card)->first();
                
                try {
                    $customer_id=$card->customer_id;
                    $charge = Charge::create(array(
                        'customer' => $customer_id,
                        'amount'   => $total*100,
                        'currency' => 'CAD'
                    ));
                    
                    $payment_data['customer_id']=$customer_id;
                    $payment_data['charge_id']=$charge->id;
                    
                }
                catch(\Stripe\Error\Card $e) {
                    // Since it's a decline, \Stripe\Error\Card will be caught
                    
                    $body = $e->getJsonBody();
                    $data['error']  = $body['error'];
                    
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\InvalidRequest $e) {
                    // Invalid parameters were supplied to Stripe's API
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\Authentication $e) {
                    // Authentication with Stripe's API failed
                    // (maybe you changed API keys recently)
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\ApiConnection $e) {
                    // Network communication with Stripe failed
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\Base $e) {
                    // Display a very generic error to the user, and maybe send
                    // yourself an email
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                }
            }
            else if($payment_type=='new_card')
            {
                $card_id=$request->input('card_id');
                
                $token=$request->stripeToken;
                if(!empty($token)) {
                try {
            
                    $customer = \Stripe\Customer::create(array(
                        'email' => $user->email,
                        'source'  => $token
                    ));
                    $customer_id=$customer->id;
                    
                    $charge = Charge::create(array(
                        'customer' => $customer_id,
                        'amount'   => $total*100,
                        'currency' => 'CAD'
                    ));
                    
                    $payment_data['customer_id']=$customer_id;
                    $payment_data['charge_id']=$charge->id;
                    
                    //save this card if not already saved
                    $customer_id=$customer->id;
            
                    $customer = \Stripe\Customer::retrieve($customer_id);
                    $card_id=$customer->sources->data[0]->id;
                    $brand=$customer->sources->data[0]->brand;
                    $exp_month=$customer->sources->data[0]->exp_month;
                    $exp_year=$customer->sources->data[0]->exp_year;
                    $last4=$customer->sources->data[0]->last4;
                                
                    $check=DB::select("SELECT id FROM cards WHERE user_id='$user_id' AND last4='$last4' LIMIT 1");
                    if(count($check)==0)
                    DB::insert("INSERT INTO cards (user_id, customer_id, card_id, brand, exp_month, exp_year, last4, added_on) VALUES ('$user_id', '$customer_id', '$card_id', '$brand', '$exp_month', '$exp_year', '$last4', NOW())");
                    
                }
                catch(\Stripe\Error\Card $e) {
                    // Since it's a decline, \Stripe\Error\Card will be caught
                    $body = $e->getJsonBody();
                    $data['error']  = $body['error'];
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\InvalidRequest $e) {
                    // Invalid parameters were supplied to Stripe's API
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\Authentication $e) {
                    // Authentication with Stripe's API failed
                    // (maybe you changed API keys recently)
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\ApiConnection $e) {
                    // Network communication with Stripe failed
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (\Stripe\Error\Base $e) {
                    // Display a very generic error to the user, and maybe send
                    // yourself an email
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                } catch (Exception $e) {
                    // Something else happened, completely unrelated to Stripe
                    $data['error']=$e->getMessage();
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                }
                } else {
                    $data['error']='Please enter card details to make payment.';
                    $request->session()->flash('error', $data['error']);
                    $payment_data['redirect']=1;
                    $payment_data['url']=url('book-seat/'.$ride->id);
                    //return redirect('book-seat/'.$ride->id);
                    //return response()->json($data);
                }
            }
            else if($payment_type=='paypal')
            {
                $data = [];
                
                $l_from=$ride->departure_city;
                $l_to=$ride->destination_city;
                    
                if($l_from=='') $l_from=$ride->departure_place;
                if($l_to=='') $l_to=$ride->destination_place;
                    
                if($l_from=='') $l_from=$ride->departure_state;
                if($l_to=='') $l_to=$ride->destination_state;

                if($l_from=='') $l_from=$ride->departure;
                if($l_to=='') $l_to=$ride->destination;
                
                $seats=$booking_data['seats'];
                $booking_price=$booking_data['booking_price'];
                $payment_method=$booking_data['payment_method'];
                $booking_id=$this->make_booking($request, $user_id, $ride->added_by, $ride->id, $ride->date, $ride->time, $seats, $ride->price, $booking_price, $payment_method, '5', '0', '', '');
                
                $name='Ride: '.$l_from.' to '.$l_to;
                $data['items'] = [
                [
                    'name' => $name,
                    'price' => $total,
                    'desc'  => 'Seat(s): '.$seats,
                    'qty' => 1
                ]
                ];
  
                $data['invoice_id'] = 'Booking_'.$booking_id;
                $data['invoice_description'] = "Order #{$data['invoice_id']}";
                $data['return_url'] = url('paypal-success/'.$booking_id);
                $data['cancel_url'] = url('paypal-cancel/'.$booking_id);
                $data['total'] = $total;
  
                $provider = new ExpressCheckout;
  
                $response = $provider->setCurrency('CAD')->setExpressCheckout($data);
                //var_dump($response);
  
                $response = $provider->setCurrency('CAD')->setExpressCheckout($data, true);
                //echo $response['paypal_link']; exit();
  
                //return redirect($response['paypal_link']);
                $payment_data['redirect']=1;
                $payment_data['url']=$response['paypal_link'];
            }
            else
            {
                $request->session()->flash('error', 'Please select a payment method.');
                $payment_data['redirect']=1;
                $payment_data['url']=url('book-seat/'.$ride->id);
                //return redirect('book-seat/'.$ride->id);
            }
        
        return $payment_data;
    }
    
    public function ride_completed(Request $request)
    {
        $user_id=$request->session()->get('id');
        $data=array();
        $data['success']=0;
        
        $id=addslashes($request->input('id'));
        
        $booking=DB::select("SELECT id, user_id, driver_id, ride_price, seats, payment_method, charge_id, ride_price, booking_price, customer_id FROM bookings WHERE id='$id'");
        if(count($booking)==1)
        {
            $booking=collect($booking)->first();
            
            //credit the amount to driver or back to passenger
            $user=DB::select("SELECT id, balance FROM users WHERE id='$booking->driver_id' LIMIT 1");
            if(count($user)==1)
            {
                $user=collect($user)->first();
                
                $total_cost=$booking->ride_price*$booking->seats;
                if($booking->payment_method=='Online payment')
                {
                    //credit the ride price to driver account
                    $new_balance=$user->balance+$total_cost;
                    DB::update("UPDATE users SET balance='$new_balance' WHERE id='$booking->driver_id'");
                    
                    $link_id=$id;
                    
                    //Record transaction START
                    \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->driver_id, $link_id, '2', $total_cost);
                    //Record transaction END
                }
                else if($booking->payment_method=='Secured cash')
                {
                    //refund the ride price
                    if($booking->charge_id!='')
                    {
                        //refund amount
                        $refund_id=\CommonFunctions::instance()->refund_amount_wallet($request, $booking, $total_cost);
                    
                        //Record transaction START
                        \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '5', $total_cost);
                        //Record transaction END
                    }
                }
                
                DB::update("UPDATE bookings SET status='2' WHERE id='$id'");
                
                //send email to passenger to leave feedback
                $email_type='4';
                //send email START
                \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $id, $email_type);
                //send email END
                
                //send email to driver to leave feedback
                $email_type='5';
                //send email START
                \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $id, $email_type);
                //send email END
                $data['success']=1;
            }
        }
        
        return response()->json($data);
    }
    
    public function refund_amount($request, $booking, $total)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                        try {
            
                            $refund = \Stripe\Refund::create(array(
                                'charge' => $booking->charge_id,
                                'amount' => $total*100,
                            ));
                            
                            $refund_id=$refund->id;
                            return $refund_id;
                    
                        }
                        catch(\Stripe\Error\Card $e) {
                            // Since it's a decline, \Stripe\Error\Card will be caught
                            $body = $e->getJsonBody();
                            $data['error']  = $body['error'];
                            return response()->json($data);
                        } catch (\Stripe\Error\InvalidRequest $e) {
                            // Invalid parameters were supplied to Stripe's API
                            $data['error']=$e->getMessage();
                            return response()->json($data);
                        } catch (\Stripe\Error\Authentication $e) {
                            // Authentication with Stripe's API failed
                            // (maybe you changed API keys recently)
                            $data['error']=$e->getMessage();
                            return response()->json($data);
                        } catch (\Stripe\Error\ApiConnection $e) {
                            // Network communication with Stripe failed
                            $data['error']=$e->getMessage();
                            return response()->json($data);
                        } catch (\Stripe\Error\Base $e) {
                            // Display a very generic error to the user, and maybe send
                            // yourself an email
                            $data['error']=$e->getMessage();
                            return response()->json($data);
                        } catch (Exception $e) {
                            // Something else happened, completely unrelated to Stripe
                            $data['error']=$e->getMessage();
                            return response()->json($data);
                        }
    }
    
    public function leave_feedback(Request $request, $booking_id)
    {
        $user_id=$request->session()->get('id');
        
        $booking=DB::select("SELECT id, user_id, driver_id, ride_id FROM bookings WHERE id='$booking_id' LIMIT 1");
        $booking=collect($booking)->first();
        
        $ride=DB::select("SELECT * FROM rides WHERE id='$booking->ride_id' LIMIT 1");
        $ride=collect($ride)->first();
        
        if($user_id==$booking->user_id) $type='1';
        else $type='2';
        
        $id=$booking->id;
        $ride_id=$booking->ride_id;
        $user_id=$booking->user_id;
        $driver_id=$booking->driver_id;
        
        $check=DB::select("SELECT id FROM ratings WHERE user_id='$user_id' AND driver_id='$driver_id' AND booking_id='$id' AND type='$type' LIMIT 1");
        if(count($check)==1) return redirect('ride/'.$ride->url);
        
        if($request->input('communication')!='') {
            $timeliness=addslashes($request->input('timeliness'));
            $vehicle_condition=addslashes($request->input('vehicle_condition'));
            $safety=addslashes($request->input('safety'));
            $conscious=addslashes($request->input('conscious'));
            $comfort=addslashes($request->input('comfort'));
            $communication=addslashes($request->input('communication'));
            $review=addslashes($request->input('review'));
            $attitude=addslashes($request->input('attitude'));
            $hygiene=addslashes($request->input('hygiene'));
            $respect=addslashes($request->input('respect'));
            
            $recommend=addslashes($request->input('recommend'));
            $note=addslashes($request->input('note'));
        
            DB::insert("INSERT INTO ratings (user_id, driver_id, ride_id, booking_id, timeliness, vehicle_condition, safety, conscious, comfort, communication, attitude, hygiene, respect, review, type, added_on, posted_by, recommend, note) VALUES ('$user_id', '$driver_id', '$ride_id', '$id', '$timeliness', '$vehicle_condition', '$safety', '$conscious', '$comfort', '$communication', '$attitude', '$hygiene', '$respect', '$review', '$type', NOW(), '$user_id', '$recommend', '$note')");
            
            return redirect('ride/'.$ride->url);
        }
        
        $passenger=DB::select("SELECT id, first_name FROM users WHERE id='$user_id' LIMIT 1");
        $passenger=collect($passenger)->first();
        
        $driver=DB::select("SELECT id, first_name FROM users WHERE id='$driver_id' LIMIT 1");
        $driver=collect($driver)->first();
        
        return view('leave_feedback.index', ['title'=>'Leave feedback', 'ride'=>$ride, 'booking'=>$booking, 'type'=>$type, 'passenger'=>$passenger, 'driver'=>$driver]);
    }
    
    public function change_status(Request $request)
    {
        $user_id=$request->session()->get('id');
        $data=array();
        $data['success']=0;
        
        $id=addslashes($request->input('b_id'));
        $status=addslashes($request->input('status'));
        if($status=='') $status=2;
        
        $booking=DB::select("SELECT * FROM bookings WHERE id='$id' LIMIT 1");
        $booking=collect($booking)->first();
        $ride_id=$booking->ride_id;
        $driver_id=$booking->driver_id;
        
        $check=DB::select("SELECT id FROM rides WHERE id='$ride_id' AND added_by='$user_id'");
        if(count($check)==1)
        {
            DB::update("UPDATE bookings SET status='$status' WHERE id='$id'");
            if($status=='1') {
                $email_type='2';
                $request->session()->flash('success', 'Booking has been accepted successfully.');
            }
            else if($status=='3') {
                $email_type='3';
                $request->session()->flash('success', 'Booking has been rejected successfully.');
                
                $refund_amount=$booking->ride_price*$booking->seats;
                if($booking->payment_method=='Cash') $refund_amount=0;
                $refund_amount+=$booking->booking_price;
                
                if(($booking->payment_method=='Online payment' OR $booking->payment_method=='Secured cash' OR $booking->payment_method=='Cash') AND $booking->free_ride=='0')
                {
                    //refund the ride price
                    if(1)
                    {
                        $refund_id='';
                        if($refund_amount!=0) 
                        {
                            //refund amount
                            $refund_id=\CommonFunctions::instance()->refund_amount_wallet($request, $booking, $refund_amount);
                    
                            //Record transaction START
                            \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '3', $refund_amount);
                            //Record transaction END
                        }
                        
                        //track cancelled seat
                        DB::insert("INSERT INTO cancelled_seats (user_id, booking_id, driver_id, ride_id, seats, refund_amount, refund_id, on_date) VALUES ('$booking->user_id', '$booking->id', '$booking->driver_id', '$booking->ride_id', '$booking->seats', '$refund_amount', '$refund_id', NOW())");
                        $cancelled_id=DB::getPdo()->lastInsertId();
                    }
                }
                else if($booking->free_ride=='1')
                {
                    //refund user free ride
                    $user=DB::select("SELECT free_rides FROM users WHERE id='$booking->user_id' LIMIT 1");
                    $user=collect($user)->first();
                    
                    $new_free_rides=$user->free_rides+1;
                    DB::update("UPDATE users SET free_rides='$new_free_rides' WHERE id='$booking->user_id'");
                }
                
            }
            
            //send email START
            \CommonFunctions::instance()->alert_email($request, $user_id, $driver_id, $id, $email_type);
            //send email END
            
            $data['success']=1;
        }
        
        return response()->json($data);
    }
    
    public function paypal_success(Request $request, $id)
    {
        $token=$request->input('token');
        $payer_id=$request->input('PayerID');
        
        $booking=DB::select("SELECT * FROM bookings WHERE id='$id' LIMIT 1");
        $booking=collect($booking)->first();
        $seats=$booking->seats;
        $booking_price=$booking->booking_price;
        $payment_method=$booking->payment_method;
        
        $ride=DB::select("SELECT * FROM rides WHERE id='$booking->ride_id' LIMIT 1");
        $ride=collect($ride)->first();
        
        if($ride->status==1)
        {
            DB::update("UPDATE bookings SET token='$token', status='4' WHERE id='$id'");
            return redirect('ride/'.$ride->url);
        }
        else if($ride->status==2)
        {
            DB::update("UPDATE bookings SET token='$token', status='4' WHERE id='$id'");
            return redirect('ride/'.$ride->url);
        }
        
        //check if seats are available START
        $booked=0;
        $row2=DB::select("SELECT id, seats FROM bookings WHERE ride_id='$booking->ride_id' AND status!='3' AND status!='4' AND id!='$id'");
        if(count($row2)!=0)
        {
            foreach($row2 as $r)
            {
                $booked+=$r->seats;
            }
        }
        
        $available_seats=$ride->seats-$booked;
        $cancel=0;
        
        if($available_seats==0)
        {
            DB::update("UPDATE bookings SET token='$token', status='4' WHERE id='$id'");
            $request->session()->flash('error', 'Sorry, all seats has been booked.');
            return redirect('ride/'.$ride->url);
            
            $cancel=1;
        }
        else if($available_seats<$seats)
        {
            DB::update("UPDATE bookings SET token='$token', status='4' WHERE id='$id'");
            $request->session()->flash('error', 'Sorry, only '.$available_seats.' seat(s) left for booking.');
            return redirect('book-seat/'.$ride->id);
            
            $cancel=1;
        }
        //check if seats are available END
        
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($token);
        //var_dump($response);
        
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
        $data = [];
                
        $l_from=$ride->departure_city;
        $l_to=$ride->destination_city;
                    
        if($l_from=='') $l_from=$ride->departure_place;
        if($l_to=='') $l_to=$ride->destination_place;
                    
        if($l_from=='') $l_from=$ride->departure_state;
        if($l_to=='') $l_to=$ride->destination_state;

        if($l_from=='') $l_from=$ride->departure;
        if($l_to=='') $l_to=$ride->destination;
                
        $name='Ride: '.$l_from.' to '.$l_to;
        $paypal_email=$response['EMAIL'];
        $payer_id=$response['PAYERID'];
        $amount=$response['AMT'];
        
        $data['items'] = [
                [
                    'name' => $name,
                    'price' => $amount,
                    'desc'  => 'Seat(s): '.$seats,
                    'qty' => 1
                ]
        ];
  
        $data['invoice_id'] = 'Booking_'.$booking->id;
        $data['invoice_description'] = "Order #{$data['invoice_id']}";
        $data['return_url'] = url('paypal-success/'.$booking->id);
        $data['cancel_url'] = url('paypal-cancel/'.$booking->id);
        $data['total'] = $amount;
        
        $response = $provider->doExpressCheckoutPayment($data, $token, $payer_id);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            
            //echo 'Your payment was successfully.';
            if($ride->booking_method=='Instant booking') $status=1;
            else $status=0;
        
            DB::update("UPDATE bookings SET token='$token', status='$status', paypal_email='$paypal_email', payer_id='$payer_id' WHERE id='$id'");
            
            //Record transaction START
            if($booking->payment_method!='Cash')
                \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '1', $amount);
            else
                \CommonFunctions::instance()->record_transaction($request, $booking->user_id, $booking->user_id, $booking->id, '4', $amount);
            //Record transaction END

            //send email START
                \CommonFunctions::instance()->alert_email($request, $booking->user_id, $booking->driver_id, $booking->id, '1');
            //send email END
            
            if($status==1)
            $request->session()->flash('success', 'Your seat(s) has been booked successfully.');
            else
            $request->session()->flash('success', 'Your booking request has been placed successfully.');
            return redirect('ride/'.$ride->url);
            }
        }
        
        DB::update("UPDATE bookings SET token='$token', status='4' WHERE id='$id'");
        $request->session()->flash('error', 'Sorry there was an error for the payment.');
        return redirect('ride/'.$ride->url);
    }
    
    public function paypal_cancel(Request $request, $id)
    {
        $token=$request->input('token');
        DB::update("UPDATE bookings SET token='$token', status='4' WHERE id='$id'");
        
        $booking=DB::select("SELECT ride_id FROM bookings WHERE id='$id' LIMIT 1");
        $booking=collect($booking)->first();
        
        $ride=DB::select("SELECT url FROM rides WHERE id='$booking->ride_id' LIMIT 1");
        $ride=collect($ride)->first();
        
        $request->session()->flash('error', 'The booking has been cancelled.');
        return redirect('ride/'.$ride->url);
    }
}
