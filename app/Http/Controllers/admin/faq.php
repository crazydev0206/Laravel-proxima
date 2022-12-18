<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class faq extends Controller
{
    public function index(Request $request){
        $faq_topic=DB::select("SELECT id, name FROM faq_topics");
        return view('admin.faq_topics.index', ['faq_topics'=>$faq_topic]);
    }
    
    public function add_topic(Request $request){
        if($request->input('name')!=''){
            $name=addslashes($request->input('name'));
            
            DB::insert("INSERT INTO faq_topics (name, on_date) VALUES ('$name', NOW())");
        }
        
        
        if($request->input('delete_id')!=''){
            $delete=addslashes($request->input('delete_id'));
            
            DB::delete("DELETE FROM faq_topics WHERE id='$delete'");
            DB::delete("DELETE FROM faq WHERE t_id='$delete'");
        }
        
        return redirect('admin/manage-faq');
    }
    
    public function manage_faq(Request $request){
        $faqs=DB::select("SELECT * FROM faq");
        return view('admin.faq.index', ['faqs'=>$faqs]);
    }
    
    public function add_faq(Request $request){
        if($request->input('question')!=''){
            $question=addslashes($request->input('question'));
            $answer=addslashes($request->input('answer'));
            
            DB::insert("INSERT INTO faq (question, answer, on_date) VALUES ('$question', '$answer', NOW())");
        }
        
        
        if($request->input('delete_id')!=''){
            $delete=addslashes($request->input('delete_id'));
            
            DB::delete("DELETE FROM faq WHERE id='$delete'");
        }
        
        return redirect('admin/manage-faq/');
    }
    
    public function edit_faq_topic(Request $request, $id){
        if($request->input('name')!=''){
            $name=addslashes($request->input('name'));
            
            DB::update("UPDATE faq_topics SET name='$name' WHERE id='$id'");
        }
        
        $faq_topic=DB::select("SELECT id, name FROM faq_topics WHERE id='$id' LIMIT 1");;
        $faq_topic=collect($faq_topic)->first();
        return view('admin.edit_faq_topic.index', ['faq_topic'=>$faq_topic]);
    }
    
    public function edit_question(Request $request, $id){
        if($request->input('question')!=''){
            $question=addslashes($request->input('question'));
            $answer=addslashes($request->input('answer'));
            
            DB::update("UPDATE faq SET question='$question', answer='$answer' WHERE id='$id'");
        }
        
        $faq=DB::select("SELECT * FROM faq WHERE id='$id' LIMIT 1");
        $faq=collect($faq)->first();
        return view('admin.edit_question.index', ['edit_faq'=>$faq]);
    }
}
