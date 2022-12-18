<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class site extends Controller
{
    public function site_settings(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('booking_price')!='')
        {
            $site_name=addslashes($request->input('site_name'));
            $site_keywords=addslashes($request->input('site_keywords'));
            $site_description=addslashes($request->input('site_description'));
            $logo_width=addslashes($request->input('logo_width'));
            $logo_height=addslashes($request->input('logo_height'));
            $facebook=addslashes($request->input('facebook'));
            $instagram=addslashes($request->input('instagram'));
            $youtube=addslashes($request->input('youtube'));
            $twitter=addslashes($request->input('twitter'));
            $booking_price=addslashes($request->input('booking_price'));
            $booking_per=addslashes($request->input('booking_per'));
            $gas_cost=addslashes($request->input('gas_cost'));
            
            DB::update("UPDATE site SET booking_price='$booking_price', booking_per='$booking_per', keywords='$site_keywords', description='$site_description', facebook='$facebook', instagram='$instagram', youtube='$youtube', twitter='$twitter', gas_cost='$gas_cost' WHERE id='1'");
            $flag=1;
        }
        
        if($request->file('favicon')!='') {
            $file=$request->file('favicon');
            //Move Uploaded File
            $destinationPath = 'images/favicon';
            if($file->move($destinationPath,$file->getClientOriginalName())) {
                $cover=$file->getClientOriginalName();
                    
                DB::update("UPDATE site SET favicon='$cover' WHERE id='1'");
                $flag=1;
            }
        }
        
        
        if($request->file('logo')!='') {
            $file=$request->file('logo');
            //Move Uploaded File
            $destinationPath = 'images/logo';
            if($file->move($destinationPath,$file->getClientOriginalName())) {
                $cover=$file->getClientOriginalName();
                    
                DB::update("UPDATE site SET logo='$cover' WHERE id='1'");
                $flag=1;
            }
        }
        
        if(isset($flag)) return redirect('admin/site-settings');
        
        $site=DB::select("SELECT * FROM site WHERE id='1' LIMIT 1");
        $site=collect($site)->first();
        
        return view('admin.site_settings.index', ['title'=>'Site Settings', 'site'=>$site]);
    }
    
    public function new_article(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('title')!='')
        {
            $agency=addslashes($request->input('agency'));
            $title=addslashes($request->input('title'));
            $description=addslashes($request->input('description'));
            $by = addslashes($request->input('by'));
            
            if($request->file('file')!=''){
                $file=$request->file('file');
            
                //Move Uploaded File
                $destinationPath = 'article_images/';
                $img_name=$file->getClientOriginalName();
                $array=explode('.', $img_name);
                $img_name=$array[0];
                $ext=$array[1];
                $img_name=rand(pow(10, 4-1), pow(10, 4)-1).'.'.$ext;
                $fileName = $destinationPath . $img_name; // renameing image
                

                $date = $request->input('date');
                $time = $request->input('time');

                $full = $date." ".$time;

                $fullDate = date('Y-m-d H:i:s', strtotime($full));

                $writerImage = "";

                if ($request->file('writers_photo') != "") {
                    // code...
                    $writerFileName = $request->file('writers_photo');
                    $dp = "article_writers_image/";
                    $fn = $writerFileName->getClientOriginalName();
                    $fn = uniqid()."_".$fn;

                    if ($writerFileName->move($dp, $fn)) {
                        // code...
                        $writerImage = $fn;
                    }

                }

                if($file->move($destinationPath,$img_name)) {
                    $url = str_replace(' ','-',strtolower($title));
                    $url = preg_replace("/[^A-Za-z0-9-]/", '', $url);
                    
                    DB::insert("INSERT INTO articles (agency, title, description, image, url, added_by, added_on, writer_image) VALUES ('$agency', '$title', '$description', '$img_name', '$url', '$by', '$fullDate', '$writerImage')");
                }
            
                return redirect('admin/all-articles');
            }
        }
        
        return view('admin.new_article.index', ['title'=>'New Article']);
    }
    
    public function edit_article(Request $request, $id)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->file('file')!=''){
                $file=$request->file('file');
            
                //Move Uploaded File
                $destinationPath = 'article_images/';
                $img_name=$file->getClientOriginalName();
                $array=explode('.', $img_name);
                $img_name=$array[0];
                $ext=$array[1];
                $img_name=rand(pow(10, 4-1), pow(10, 4)-1).'.'.$ext;
                $fileName = $destinationPath . $img_name; // renameing image
                
                if($file->move($destinationPath,$img_name)) {
                    DB::update("UPDATE articles SET image='$img_name' WHERE id='$id'");
                }
        }
        
        if($request->input('title')!='')
        {
            $agency=addslashes($request->input('agency'));
            $title=addslashes($request->input('title'));
            $description=addslashes($request->input('description'));
            
            DB::update("UPDATE articles SET agency='$agency', title='$title', description='$description' WHERE id='$id'");
            return redirect('admin/edit-article/'.$id);
        }
        
        $article=DB::select("SELECT * FROM articles WHERE id='$id' LIMIT 1");
        $article=collect($article)->first();
        return view('admin.edit_article.index', ['title'=>'Edit Article', 'article'=>$article]);
    }
    
    public function all_articles(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('delete_id')!='')
        {
            $delete_id=$request->input('delete_id');
            DB::delete("DELETE FROM articles WHERE id='$delete_id'");
            
            return redirect('admin/all-articles');
        }
        
        $articles=DB::select("SELECT * FROM articles ORDER BY id DESC");
        return view('admin.all_articles.index', ['title'=>'All Articles', 'articles'=>$articles]);
    }
    
    public function withdrawal_requests(Request $request)
    {
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        if($request->input('accept')!='')
        {
            $id=addslashes($request->input('accept'));
            
            $w_request=DB::select("SELECT amount, user_id FROM withdrawal_requests WHERE id='$id' LIMIT 1");
            $w_request=collect($w_request)->first();
            
            $user=DB::select("SELECT balance, email FROM users WHERE id='$w_request->user_id' LIMIT 1");
            $user=collect($user)->first();
            
            if($w_request->amount>$user->balance)
            {
                $request->session()->flash('error', 'No sufficient funds to process this withdrawal request.');
                return redirect('admin/withdrawal-requests');
            }
            
            $new_balance=$user->balance-$w_request->amount;
            DB::update("UPDATE users SET balance='$new_balance' WHERE id='$w_request->user_id'");
            
            DB::update("UPDATE withdrawal_requests SET status='1' WHERE id='$id'");
            
            $request->session()->flash('success', 'Request has been marked as processed.');
            return redirect('admin/withdrawal-requests');
        }
        
        if($request->input('reject')!='')
        {
            $id=addslashes($request->input('reject'));
            $reason=addslashes($request->input('reason'));
            
            DB::update("UPDATE withdrawal_requests SET status='2', reason='$reason' WHERE id='$id'");
            
            $request->session()->flash('success', 'Request has been rejected.');
            return redirect('admin/withdrawal-requests');
        }
        
        $withdrawal_requests=array(); $i=0;
        $row=DB::select("SELECT * FROM withdrawal_requests ORDER BY id DESC");
        foreach($row as $r)
        {
            $withdrawal_requests[$i]['request']=$r;
            
            $withdrawal_requests[$i]['user']='NA';
            $row2=DB::select("SELECT id, first_name, last_name, balance, phone, email FROM users WHERE id='$r->user_id' LIMIT 1");
            if(count($row2)==1)
            {
                $row2=collect($row2)->first();
                $withdrawal_requests[$i]['user']=$row2;
            }
            
            $i++;
        }
        
        return view('admin.withdrawal_requests.index', ['title'=>'Withdrawal Requests', 'requests'=>$withdrawal_requests]);
    }
}
