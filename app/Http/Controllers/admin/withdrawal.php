<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class withdrawal extends Controller
{
    public function index(Request $request){
        $user_id=$request->session()->get('id');
        
        $requests=DB::select("SELECT * FROM withdrawal_requests ORDER BY id DESC");
        $applications=array(); $i=0;
        foreach($requests as $app){
            $user=$app->user_id;
            $applications[$i]['id']=$app->id;
            $applications[$i]['user_id']=$app->user_id;
            $applications[$i]['status']=$app->status;
            if($app->method=='1')
            $applications[$i]['method']='Express Withdrawal';
            else if($app->method=='2')
            $applications[$i]['method']='PayPal';
            $applications[$i]['method']='Stripe';
            //$applications[$i]['reason']=$app->reason;
            $applications[$i]['req_on']=$app->on_date;
            $applications[$i]['amount']=$app->amount;
            $row2=DB::select("SELECT name, email, cad FROM users WHERE id='$user' LIMIT 1");
            $row2=collect($row2)->first();
            $applications[$i]['user']=$row2;
            $row2=DB::select("SELECT * FROM bank_details WHERE user_id='$user' LIMIT 1");
            $row2=collect($row2)->first();
            $applications[$i]['details']=$row2;
            $i++;
        }
        return view('admin/withdrawl_requests.index', ['requests'=>$applications]);
    }
    
    public function manage_forms(Request $request){
        if($request->input('delete')!='') {
            $id=$request->input('delete');
            $row=DB::select("DELETE FROM withdrawal_requests WHERE id='$id'");
        }
        
        if($request->input('accept')!='') {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $id=$request->input('accept');
            $row=DB::select("SELECT user_id, amount FROM withdrawal_requests WHERE id='$id'");
            $row=collect($row)->first();
            
            $user=$row->user_id;
            $amount=$row->amount;
            
            $row=DB::select("SELECT cad, email, acc_id FROM users WHERE id='$user' LIMIT 1");
            $row=collect($row)->first();
            $cad=$row->cad-$amount;
            
            $balance=\Stripe\Balance::retrieve();
            $balance=$balance->available[0]['amount'];
            
            $acc_id=$row->acc_id;
            $email=$row->email;
            
            $balance_u=$amount;
        
        if($balance>=$balance_u) {
        $transfer=\Stripe\Transfer::create(array(
            "amount" => $amount*100,
            "currency" => "cad",
            "destination" => "'".$acc_id."'"
        ));
            
        $transfer_id=$transfer->id;
        
            
            $update=DB::update("UPDATE withdrawal_requests SET status='2' WHERE id='$id'");
            $update=DB::update("UPDATE users SET cad='$cad' WHERE id='$user'");
            
            //record transaction start
            DB::insert("INSERT INTO transactions (user, user_id, amount, currency, type, on_date, link) VALUES ('0', '$user', '$amount', 'CAD', '13', NOW(), '0')");
            //record transaction end
        }
            else $request->session()->flash('error', "No sufficient balance in Stripe account to make this Payout!");
            
        }
        
        if($request->input('reject')!='') {
            $id=$request->input('reject');
            $reason=$request->input('reason');
            $row=DB::select("SELECT user_id FROM withdrawal_requests WHERE id='$id'");
            $row=collect($row)->first();
            
            $user=$row->user_id;
            $update=DB::update("UPDATE withdrawal_requests SET status='3', reason='$reason' WHERE id='$id'");
        }
        
        return redirect('admin/withdrawal');
    }
}
