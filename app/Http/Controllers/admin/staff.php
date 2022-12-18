<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class staff extends Controller
{
    public function index(Request $request){
        if($request->input('username')!='') {
            $site_name=$request->input('site_name');
            $username=$request->input('username');
            $pass=$request->input('pass');
            
            $check=DB::select("SELECT id FROM admin WHERE username='$username' LIMIT 1");
            if(count($check)==0)
            {
                $update=DB::insert("INSERT INTO admin (username, pass, type, site_name) VALUES ('$username', '$pass', '2', '$site_name')");
                $this->createDomain($username);
                $request->session()->flash('success', 'Portal created successfully.');
            }
            else
            {
                $request->session()->flash('error', 'Username already exists.');
            }
            
            return redirect('admin/portals');
        }
        
        if($request->input('delete_id')) {
            $delete_id=$request->input('delete_id');
            
            DB::delete("DELETE FROM admin WHERE id='$delete_id'");
        }
        
        $row=DB::select("SELECT * FROM admin WHERE type='2' ORDER BY id DESC");
        return view('admin.staff.index',['users'=>$row]);
    }
    
        public function createDomain($domain) {
        $subDomain = $domain;
    $cPanelUser = 'owli62281551';
    $cPanelPass = 'DaQuXAS6#';
    $rootDomain = 'owliko.com';



//  $buildRequest = "/frontend/x3/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain;


//$buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=public_html/code/" . $subDomain;
$buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=public_html/platform/";

$openSocket = fsockopen('localhost',2082);
if(!$openSocket) {
    return "Socket error";
    exit();
}

$authString = $cPanelUser . ":" . $cPanelPass;
$authPass = base64_encode($authString);
$buildHeaders  = "GET " . $buildRequest ."\r\n";
$buildHeaders .= "HTTP/1.0\r\n";
$buildHeaders .= "Host:localhost\r\n";
$buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
$buildHeaders .= "\r\n";

fputs($openSocket, $buildHeaders);
while(!feof($openSocket)) {
fgets($openSocket,128);
}
fclose($openSocket);

$newDomain = "http://" . $subDomain . "." . $rootDomain . "/";
//echo $newDomain;
return 1;
exit();

        $cpanelusername = "owli62281551";
$cpanelpassword = "DaQuXAS6#";
$subdomain = 'newsubdomain';
$domain = 'owliko.com';
$directory = "/public_html/platform";  // A valid directory path, relative to the user's home directory. Or you can use "/$subdomain" depending on how you want to structure your directory tree for all the subdomains.

$query = "https://$domain:2083/json-api/cpanel?cpanel_jsonapi_func=addsubdomain&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_version=2&domain=$subdomain&rootdomain=$domain&dir=$directory";   

$curl = curl_init();                                // Create Curl Object
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname
curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec
$header[0] = "Authorization: Basic " . base64_encode($cpanelusername.":".$cpanelpassword) . "\n\r";
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
$result = curl_exec($curl);
if ($result == false) {
    error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");   
                                                    // log error if curl exec fails
}
curl_close($curl);

print $result;
exit();
    // your cPanel username
    $cpanel_user = 'owli62281551';

    // your cPanel password
    $cpanel_pass = 'DaQuXAS6#';

    // your cPanel skin
    $cpanel_skin = 'paper_lantern';

    // your cPanel domain
    $cpanel_host = 'owliko.com';

    // subdomain name
    $subdomain = $domain;

    // directory - defaults to public_html/subdomain_name
    $dir = 'public_html/platform';

    // create the subdomain

    $sock = fsockopen($cpanel_host,2083);
    if(!$sock) {
        print('Socket error');
        exit();
    }

    $pass = base64_encode("$cpanel_user:$cpanel_pass");
    $in = "GET /frontend/$cpanel_skin/subdomain/doadddomain.html?rootdomain=$cpanel_host&domain=$subdomain&dir=$dir\r\n";
    $in .= "HTTP/1.0\r\n";
    $in .= "Host:$cpanel_host\r\n";
    $in .= "Authorization: Basic $pass\r\n";
    $in .= "\r\n";

    fputs($sock, $in);
        while (!feof($sock)) {
        $result .= fgets ($sock,128);
    }
    fclose($sock);

    return $result;
}
}
