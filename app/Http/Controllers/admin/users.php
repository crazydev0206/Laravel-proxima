<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;

class users extends Controller
{
    public function index(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('suspend_id')!='') {
            $suspend=$request->input('suspend_id');
            $suspend_status=$request->input('suspend');
            
            if($suspend_status=='1') $suspend_status='0';
            else  $suspend_status='1';
            
            $update=DB::update("UPDATE users SET suspend='$suspend_status' WHERE id='$suspend'");
            
            if($suspend_status=='1') $request->session()->flash('success', 'The user has been suspended successfully.');
            else $request->session()->flash('success', 'The user has been un-suspended.');
            return redirect('admin/users');
        }
        
        if($request->input('update')!='') {
            $id=$request->input('update');
            $booking_price=$request->input('booking_price');
            $booking_per=$request->input('booking_per');
            $charge_booking=$request->input('charge_booking');
            $verify=$request->input('verify');
            $phone_verified=$request->input('phone_verified');
            $driver=$request->input('driver_verified');
            $student=$request->input('student_verified');
            
            $update=DB::update("UPDATE users SET booking_price='$booking_price', booking_per='$booking_per', charge_booking='$charge_booking', verify='$verify', phone_verified='$phone_verified', driver='$driver' WHERE id='$id'");
            return redirect('admin/users');
        }
        
        if($request->input('delete_id')) {
            $delete_id=$request->input('delete_id');
            
            DB::delete("DELETE FROM users WHERE id='$delete_id'");
            DB::delete("DELETE FROM rides WHERE added_by='$delete_id'");
            DB::delete("DELETE FROM bookings WHERE user_id='$delete_id' OR driver_id='$delete_id'");
            DB::delete("DELETE FROM transactions WHERE user_id='$delete_id' OR to_id='$delete_id'");
            DB::delete("DELETE FROM withdrawal_requests WHERE user_id='$delete_id'");
            DB::delete("DELETE FROM ratings WHERE user_id='$delete_id' OR driver_id='$delete_id'");
            return redirect('admin/users');
        }
        
        $users=array(); $i=0;
        $row=DB::select("SELECT * FROM users WHERE deleted='0' ORDER BY id DESC");
        foreach($row as $r){
            $users[$i]['user']=$r;
            
            $users[$i]['referral']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email, type FROM users WHERE id='$r->referral' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $users[$i]['referral']='#1 - '.$row2->first_name.' '.$row2->last_name.' ('.$row2->email.') <p>'.$row2->type.'</p>';
                
            }
            
            $i++;
        }
        return view('admin.users.index',['users'=>$users]);
    }
    
    public function verify_drivers(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('approve')!='') {
            $delete_id=$request->input('approve');
            
            DB::update("UPDATE users SET driver='1' WHERE id='$delete_id'");
            $request->session()->flash('success', 'Driver has been verified successfully.');
            
            //send email alert START
            $user=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$delete_id' LIMIT 1");
            $user=collect($user)->first();
                    $name=$user->first_name;
                    $email=$user->email;
                    
                    $title="Driver’s license verified";
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'driver'=>'1',
                        'title'=>$title,
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.approved', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Congratulations. Driver’s license verified');
                        //$message->attach($pathToFile);
                    });
            //send email alert START
            
            return redirect('admin/verify-drivers');
        }
        
        if($request->input('reject')!='') {
            $delete_id=$request->input('reject');
            
            DB::update("UPDATE users SET driver='3' WHERE id='$delete_id'");
            $request->session()->flash('success', 'Driver has been rejected successfully.');
            
            //send email alert START
            $user=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$delete_id' LIMIT 1");
            $user=collect($user)->first();
                    $name=$user->first_name;
                    $email=$user->email;
                    
                    $title="Driver’s license rejected";
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'driver'=>'1',
                        'title'=>$title,
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.rejected', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('We are Sorry!');
                        //$message->attach($pathToFile);
                    });
            //send email alert START
            
            return redirect('admin/verify-drivers');
        }
        
        $users=array(); $i=0;
        $row=DB::select("SELECT * FROM users WHERE driver='2' OR driver='3' ORDER BY id DESC");
        foreach($row as $r){
            $users[$i]['user']=$r;
            
            $users[$i]['referral']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email, type FROM users WHERE id='$r->referral' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $users[$i]['referral']='#1 - '.$row2->first_name.' '.$row2->last_name.' ('.$row2->email.') <p>'.$row2->type.'</p>';
                
            }
            
            $i++;
        }
        return view('admin.verify_drivers.index',['users'=>$users]);
    }
    
    public function verify_students(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('approve')!='') {
            $delete_id=$request->input('approve');
            
            DB::update("UPDATE users SET student='1', charge_booking='0' WHERE id='$delete_id'");
            $request->session()->flash('success', 'Student has been verified successfully.');
            
            //send email alert START
            $user=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$delete_id' LIMIT 1");
            $user=collect($user)->first();
                    $name=$user->first_name;
                    $email=$user->email;
                    
                    $title='Student card verified';
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'student'=>'1',
                        'title'=>$title,
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.approved', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Congratulations. Student card verified');
                        //$message->attach($pathToFile);
                    });
            //send email alert START
            
            return redirect('admin/verify-students');
        }
        
        if($request->input('reject')!='') {
            $delete_id=$request->input('reject');
            
            DB::update("UPDATE users SET student='3' WHERE id='$delete_id'");
            $request->session()->flash('success', 'Student has been rejected successfully.');
            
            //send email alert START
            $user=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$delete_id' LIMIT 1");
            $user=collect($user)->first();
                    $name=$user->first_name;
                    $email=$user->email;
                    
                    $title='Student card rejected';
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'student'=>'1',
                        'title'=>$title,
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.rejected', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('We are Sorry!');
                        //$message->attach($pathToFile);
                    });
            //send email alert START
            
            return redirect('admin/verify-students');
        }
        
        $users=array(); $i=0;
        $row=DB::select("SELECT * FROM users WHERE student='2' OR student='3' ORDER BY id DESC");
        foreach($row as $r){
            $users[$i]['user']=$r;
            
            $users[$i]['referral']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email, type FROM users WHERE id='$r->referral' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $users[$i]['referral']='#1 - '.$row2->first_name.' '.$row2->last_name.' ('.$row2->email.') <p>'.$row2->type.'</p>';
                
            }
            
            $i++;
        }
        return view('admin.verify_students.index',['users'=>$users]);
    }
    
    public function pending_users(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('suspend')!='') {
            $suspend=$request->input('suspend');
            $suspend_status=$request->input('suspend_status');
            
            if($suspend_status=='1') $suspend_status='2';
            else  $suspend_status='1';
            
            $update=DB::update("UPDATE users SET status='$suspend_status' WHERE id='$suspend'");
        }
        
        if($request->input('approve')!='') {
            $delete_id=$request->input('approve');
            
            DB::update("UPDATE users SET status='1' WHERE id='$delete_id'");
            $request->session()->flash('success', 'User has been approved successfully.');
            
            //send email alert START
            $user=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$delete_id' LIMIT 1");
            $user=collect($user)->first();
                    $name=$user->first_name;
                    $email=$user->email;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.approved', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('Congratulations!');
                        //$message->attach($pathToFile);
                    });
            //send email alert START
            
            return redirect('admin/pending-users');
        }
        
        if($request->input('reject')!='') {
            $delete_id=$request->input('reject');
            
            DB::update("UPDATE users SET status='3' WHERE id='$delete_id'");
            $request->session()->flash('success', 'User has been rejected successfully.');
            
            //send email alert START
            $user=DB::select("SELECT id, first_name, last_name, email FROM users WHERE id='$delete_id' LIMIT 1");
            $user=collect($user)->first();
                    $name=$user->first_name;
                    $email=$user->email;
                    
                    $from=env('MAIL_USERNAME');
                    $data2=array(
                        'email'=>$email,
                        'from'=>$from,
                        'name'=>$name
                    );
                    Mail::send('emails.rejected', $data2, function($message) use($email, $from, $name) {
                        $message->from('developer@codingWWW.com', 'codingWWW');
                        $message->to($email);
                        $message->subject('We are Sorry!');
                        //$message->attach($pathToFile);
                    });
            //send email alert START
            
            return redirect('admin/pending-users');
        }
        
        if($request->input('delete_id')!='') {
            $delete_id=$request->input('delete_id');
            
            DB::delete("DELETE FROM users WHERE id='$delete_id'");
            return redirect('admin/pending-users');
        }
        
        $users=array(); $i=0;
        $row=DB::select("SELECT * FROM users WHERE status!='1' ORDER BY id DESC");
        foreach($row as $r){
            $users[$i]['user']=$r;
            
            $users[$i]['referral']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, email, type FROM users WHERE id='$r->referral' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $users[$i]['referral']='#1 - '.$row2->first_name.' '.$row2->last_name.' ('.$row2->email.') <p>'.$row2->type.'</p>';
                
            }
            
            $i++;
        }
        return view('admin.pending_users.index',['users'=>$users]);
    }
    
    public function review_orders(Request $request){
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('delete_id')) {
            $delete_id=$request->input('delete_id');
            
            DB::delete("DELETE FROM review_orders WHERE id='$delete_id'");
        }
        
        $orders=array(); $i=0;
        if($admin_id=='1')
        $row=DB::select("SELECT * FROM review_orders ORDER BY id DESC");
        else
        $row=DB::select("SELECT * FROM review_orders WHERE added_by='$admin_id' ORDER BY id DESC");
        foreach($row as $r){
            $row2=DB::select("SELECT id, site_name FROM admin WHERE id='$r->added_by' LIMIT 1");
            if(count($row2)==0) continue;
            $row2=collect($row2)->first();
            $companies_data[$i]['admin']=$row2;
            
            $orders[$i]['order']=$r;
            
            $user=DB::select("SELECT * FROM users WHERE id='$r->user_id' LIMIT 1");
            $user=collect($user)->first();
            
            $orders[$i]['user']=$user;
            $i++;
        }
        return view('admin.review_orders.index',['orders'=>$orders]);
    }

    // clean up the CAD & USD columns of all users
    public function clearBalance(Request $request)
    {
        $update=DB::update("UPDATE users SET cad=0.0, usd=0.0");
        return redirect('admin/users');
    }
}
