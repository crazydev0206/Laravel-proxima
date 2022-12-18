<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class commissions extends Controller
{
    public function index(Request $request){
        $row=DB::select("SELECT * FROM commissions WHERE id='1' LIMIT 1");
        $row=collect($row)->first();
       return view('admin.set_commissions.index', ['commission'=>$row]);
    }
    
    public function manage_form(Request $request){
        if($request->input('vendor')!=''){
            $vendor=$request->input('vendor');
            $site=$request->input('site');
            $cm=$request->input('cm');
            $rm=$request->input('rm');
            $vr=$request->input('vr');
            $cu=$request->input('cu');
            $cr=$request->input('cr');
            $sp=$request->input('sp');
            
            DB::update("UPDATE commissions SET vendor='$vendor', site='$site', cm='$cm', rm='$rm', vr='$vr', cu='$cu', cr='$cr', sp='$sp' WHERE id='1'");
            return redirect('admin/set-commissions');
        }
    }
    
    public function business_commissions(Request $request){
        $row=DB::select("SELECT * FROM business_commissions");
        $b_comm=array(); $i=0;
        foreach($row as $r){
            $user=$r->user_id;
            $row2=DB::select("SELECT name, email FROM users WHERE id='$user' LIMIT 1");
            $row2=collect($row2)->first();
            $b_comm[$i]['for']=$row2->name.' <br>('.$row2->email.')';
            $b_comm[$i]['id']=$r->id;
            $b_comm[$i]['user_id']=$user;
            $b_comm[$i]['title']=$r->title;
            $b_comm[$i]['sale_price']=$r->sale_price;
            $b_comm[$i]['price']=$r->price;
            $b_comm[$i]['percent']=$r->percent;
            $b_comm[$i]['fixed']=$r->fixed;
            $i++;
        }
        
        $row=DB::select("SELECT * FROM users WHERE type='2' AND manager_type='2'");
       return view('admin.business_commissions.index', ['commissions'=>$b_comm, 'b_users'=>$row]);
    }
    
    public function manage_business_form(Request $request){
        if($request->input('id')!=''){
            $id=$request->input('id');
            $title=$request->input('title');
            $sale_price=$request->input('sale_price');
            $price=$request->input('price');
            $percent=$request->input('percent');
            $fixed=$request->input('fixed');
            
            DB::update("UPDATE business_commissions SET price='$price', percent='$percent', fixed='$fixed', title='$title', sale_price='$sale_price' WHERE id='$id'");
        }
        
        if($request->input('delete_id')!=''){
            $id=$request->input('delete_id');
            
            DB::delete("DELETE FROM business_commissions WHERE id='$id'");
        }
        
        if($request->input('user_id')!=''){
            $user=$request->input('user_id');
            $titles=$request->input('titles');
            $sale_prices=$request->input('sale_prices');
            $prices=$request->input('deposit_prices');
            $percents=$request->input('percents');
            $fixeds=$request->input('fixed');
            
            $total=count($prices);
            for($i=0;$i<$total;$i++){
                $title=$titles[$i];
                $sale_price=$sale_prices[$i];
                $price=$prices[$i];
                $percent=$percents[$i];
                $fixed=$fixeds[$i];
                
                DB::insert("INSERT INTO business_commissions (user_id, price, percent, fixed, title, sale_price) VALUES ('$user', '$price', '$percent', '$fixed', '$title', '$sale_price')");
            }
        }
        
            return redirect('admin/business-commissions');
    }
}
