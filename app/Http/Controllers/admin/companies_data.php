<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class companies_data extends Controller
{
    public function index(Request $request){
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        $all_companies=''; $vcs=''; $ang=''; $acc='';
        if($request->input('delete_id')!=''){
            $id=$request->input('delete_id');
            DB::delete("DELETE FROM companies_data WHERE id='$id'");
        }
        
        $companies_data=array(); $i=0;
        if($request->input('type')=='VC') {
            if($admin_type=='1') $added_by=" AND added_by!='0'";
            else $added_by=" AND added_by='$admin_id'";
        $row=DB::select("SELECT * FROM companies_data WHERE type='VC' $added_by ORDER BY id DESC");
        $vcs='active';
        }
        else if($request->input('type')=='Accelerator') {
            if($admin_type=='1') $added_by=" AND added_by!='0'";
            else $added_by=" AND added_by='$admin_id'";
        $row=DB::select("SELECT * FROM companies_data WHERE type='Accelerators' $added_by ORDER BY id DESC");
        $acc='active';
        }
        else if($request->input('type')=='Angel Group') {
            if($admin_type=='1') $added_by=" AND added_by!='0'";
            else $added_by=" AND added_by='$admin_id'";
        $row=DB::select("SELECT * FROM companies_data WHERE type='Angel Group' $added_by ORDER BY id DESC");
        $ang='active';
        }
        else {
            if($admin_type=='1') $added_by=" added_by!='0'";
            else $added_by=" added_by='$admin_id'";
        $row=DB::select("SELECT * FROM companies_data WHERE $added_by ORDER BY id DESC");
        $all_companies='active';
        }
        
        foreach($row as $r)
        {
            $row2=DB::select("SELECT id, site_name FROM admin WHERE id='$r->added_by' LIMIT 1");
            if(count($row2)==0) continue;
            $row2=collect($row2)->first();
            $companies_data[$i]['admin']=$row2;
            
            $companies_data[$i]['data']=$r;
            
            $i++;
        }
        return view('admin.companies_data.index', ['companies_data'=>$companies_data, 'all_companies'=>$all_companies, 'vcs'=>$vcs, 'acc'=>$acc, 'ang'=>$ang]);
    }
    
    public function import_data(){
        return view('admin.import_data.index');
    }
    
    public function fetch_data_xlsx(Request $request){
        $admin_id=$request->session()->get('admin_id');
        $admin_type=$request->session()->get('admin_type');
        
        $rules = array(
        'file' => 'required'
    );

    $validator = Validator::make($request->all(), $rules);
    // process the form
    if ($validator->fails()) 
    {
        return Redirect::to('admin/import-data')->withErrors($validator);
    }
    else 
    {
        try {
            Excel::load($request->file('file'), function ($reader) {

                
                //foreach ($reader->toArray() as $row) {
                    $row=$reader->toArray();
                //store CV'
                    foreach ($row[0] as $key) {
                        
                        $company_name=addslashes($key['company_name']);
                        $website_link=addslashes($key['website_link']);
                        $address=addslashes($key['address']);
                        $city=addslashes($key['city']);
                        $country=addslashes($key['country']);
                        $region=addslashes($key['region_eu']);
                        $funded_startups=addslashes($key['number_of_startups_funded']);
                        $funded_amount=addslashes($key['funded']);
                        $contact_general=addslashes($key['contact_general']);
                        $contact_number=addslashes($key['contact_number']);
                        $contact_email=addslashes($key['contact_email']);
                        $contact_person=addslashes($key['contact_person']);
                        $title=addslashes($key['title']);
                        
                        $check=DB::select("SELECT id FROM companies_data WHERE name='$company_name' AND website='$website_link' LIMIT 1");
                        if(count($check)==1) continue;
                        
                        DB::insert("INSERT INTO companies_data (name, website, address, city, country, region, funded_startups, funded_amount, contact_general, contact_number, contact_email, contact_person, title, type, added_by) VALUES ('$company_name', '$website_link', '$address', '$city', '$country', '$region', '$funded_startups', '$funded_amount', '$contact_general', '$contact_number', '$contact_email', '$contact_person', '$title', 'VC', '$admin_id')");
                }
                
                //store Accelerators
                foreach ($row[1] as $key) {
                        
                        $company_name=addslashes($key['company_name']);
                        $website_link=addslashes($key['website_link']);
                        $address=addslashes($key['address']);
                        $city=addslashes($key['city']);
                        $country=addslashes($key['country']);
                        $region=addslashes($key['region_eu']);
                        $funded_startups=addslashes($key['number_of_startups_funded']);
                        $funded_amount=addslashes($key['funded']);
                        $contact_general=addslashes($key['contact_general']);
                        $contact_number=addslashes($key['contact_number']);
                        $contact_email=addslashes($key['contact_email']);
                        $contact_person=addslashes($key['contact_person']);
                        $title=addslashes($key['title']);
                    
                        $check=DB::select("SELECT id FROM companies_data WHERE name='$company_name' AND website='$website_link' LIMIT 1");
                        if(count($check)==1) continue;
                    
                        DB::insert("INSERT INTO companies_data (name, website, address, city, country, region, funded_startups, funded_amount, contact_general, contact_number, contact_email, contact_person, title, type, added_by) VALUES ('$company_name', '$website_link', '$address', '$city', '$country', '$region', '$funded_startups', '$funded_amount', '$contact_general', '$contact_number', '$contact_email', '$contact_person', '$title', 'Accelerator', '$admin_id')");
                }
                
                //store Angel Group
                foreach ($row[2] as $key) {
                        
                        $company_name=addslashes($key['company_name']);
                        $website_link=addslashes($key['website_link']);
                        $address=addslashes($key['address']);
                        $city=addslashes($key['city']);
                        $country=addslashes($key['country']);
                        $region=addslashes($key['region_eu']);
                        $funded_startups=addslashes($key['number_of_startups_funded']);
                        $funded_amount=addslashes($key['funded']);
                        $contact_general=addslashes($key['contact_general']);
                        $contact_number=addslashes($key['contact_number']);
                        $contact_email=addslashes($key['contact_email']);
                        $contact_person=addslashes($key['contact_person']);
                        $title=addslashes($key['title']);
                    
                        $check=DB::select("SELECT id FROM companies_data WHERE name='$company_name' AND website='$website_link' LIMIT 1");
                        if(count($check)==1) continue;
                    
                        DB::insert("INSERT INTO companies_data (name, website, address, city, country, region, funded_startups, funded_amount, contact_general, contact_number, contact_email, contact_person, title, type, added_by) VALUES ('$company_name', '$website_link', '$address', '$city', '$country', '$region', '$funded_startups', '$funded_amount', '$contact_general', '$contact_number', '$contact_email', '$contact_person', '$title', 'Angel Group', '$admin_id')");
                }
                //}
                
            });
            
            $request->session()->flash('success', 'Data imported successfully.');
            return redirect('admin/import-data');
        } catch (\Exception $e) {
            //Session::flash('error', $e->getMessage());
            echo $e->getMessage(); exit();
            return redirect('admin/import-data');
        }
    }
        
        Excel::load('file.xlsx', function ($reader) {

            });
        exit();
        
        if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
            $path = $request->file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
 
                foreach ($data as $key => $value) {
                    $insert[] = [
                    'name' => $value->name,
                    'email' => $value->email,
                    'phone' => $value->phone,
                    ];
                }
 
                if(!empty($insert)){
 
                    $insertData = DB::table('students')->insert($insert);
                    if ($insertData) {
                        Session::flash('success', 'Your Data has successfully imported');
                    }else {                        
                        Session::flash('error', 'Error inserting the data..');
                        return back();
                    }
                }
            }
        }
            
    $rules = array(
        'file' => 'required',
        'num_records' => 'required',
    );

    $validator = Validator::make(Input::all(), $rules);
    // process the form
    if ($validator->fails()) 
    {
        return Redirect::to('customer-upload')->withErrors($validator);
    }
    else 
    {
        try {
            Excel::load(Input::file('file'), function ($reader) {

                foreach ($reader->toArray() as $row) {
                    User::firstOrCreate($row);
                }
            });
            
            return redirect(route('users.index'));
        } catch (\Exception $e) {
            //Session::flash('error', $e->getMessage());
            return redirect(route('users.index'));
        }
    } 
    }
    
}
