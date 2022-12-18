<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;

class picks extends Controller
{
    public function index(Request $request){
        $picks=DB::select("SELECT * FROM picks ORDER BY id DESC");
        return view('admin.picks.index', ['picks'=>$picks]);
    }
    
    public function manage_forms(Request $request){
        if($request->input('delete_id')!=''){
            $id=$request->input('delete_id');
            DB::delete("DELETE FROM picks WHERE id='$id'");
        }
        
        if($request->input('update')!=''){
            $id=$request->input('update');
            $result=$request->input('result');
            
            DB::update("UPDATE picks SET result='$result' WHERE id='$id'");
        }
        
        if($request->input('type')!=''){
            $type=addslashes($request->input('type'));
            $title=addslashes($request->input('title'));
            $team=addslashes($request->input('team'));
            $pick=addslashes($request->input('pick'));
            $notes=addslashes($request->input('notes'));
            
            if(DB::insert("INSERT INTO picks (type, title, team, pick, notes, on_date) VALUES ('$type', '$title', '$team', '$pick', '$notes', NOW())")){
                if($type=='NBA'){
                    $users=DB::select("SELECT id, email FROM users WHERE package='3' OR package='2'");
                }
                else if($type=='NFL'){
                    $users=DB::select("SELECT id, email FROM users WHERE package='1' OR package='2'");
                }
                
                foreach($users as $user){
                    DB::insert("INSERT INTO notifications (user_id, type, on_date, seen) VALUES ('$user->id', '1', NOW(), '0')");
                    
                $from=env('MAIL_USERNAME');
                $name=env('APP_NAME');
                $notify='There is a new pick posted for you. Login now to check it out.';
                $subject='New Pick Posted';
                $link=url('/login');
                $email=$user->email;
                $data2=array(
                'link'=>$link,
                'email'=>$email,
                'from'=>$from,
                'notify'=>$notify,
                'subject'=>$subject,
                'name'=>$name
                );
                Mail::send('emails.notification', $data2, function($message) use($email, $from, $name, $subject) {
            $message->from('info@bet2collect.com', 'Bet2Collect');
            $message->to($email);
            $message->subject($subject.' | Bet2Collect');

            //$message->attach($pathToFile);
            });
                    
                }
            }
        }
        
        return redirect('admin/picks');
    }
    
    public function free_picks(Request $request){
        if($request->input('delete_id')!=''){
            $id=$request->input('delete_id');
            
            DB::delete("DELETE FROM free_picks WHERE id='$id'");
        }
        
        $data=DB::select("SELECT * FROM free_picks ORDER BY id DESC");
        return view('admin.free_picks.index', ['data'=>$data]);
    }
}
