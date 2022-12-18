<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class changepassword extends Controller
{
    public function index(Request $request){
        
        $error = "";

        if (isset($_GET['code'])) {
            // code...
            $code = $_GET['code'];

            if ($request->method() == "POST") {
                // code...
                $newPassword = $request->input('password');
                $confirmPassword = $request->input('confirm_password');

                if ($newPassword != $confirmPassword) {
                    // code...
                    $error = "Both Password Doesn't Matches";
                
                }else{

                    $admin_id = $request->input('adminid');

                    DB::update("UPDATE admin SET pass = ? WHERE id = ?", [$newPassword, $admin_id]);

                    DB::delete("DELETE FROM admin_verification WHERE code = ?", [$code]);

                    return redirect('admin/login');

                }

            }


            $row=DB::select("SELECT * FROM admin_verification WHERE code = '$code'");

            if (count($row) > 0) {
                // code...

                $row=collect($row)->first();

                $getEmail = $row->email;

                $user = DB::select("SELECT * FROM admin WHERE email = '$getEmail'");

                $uCollect = collect($user)->first();

                $adminid = $uCollect->id;

                return view('admin.forgot.verify',['error'=>$error, 'adminid'=>$adminid]);

            }else{

                 return redirect('admin/forgot');
            }

        }else{
            
        
            return redirect('admin/login');
        }
    }


    public function smtp_credentials()
    {
        $data['email'] = "support@meganmegmeg.site";
        $data['password'] = "Admin@123123";
        $data['smtp'] = "ssl";
        $data['port'] = 465;
        $data['from'] = "support@meganmegmeg.site";
        $data['from_name'] = "ProximaRide Support Team";
        $data['host'] = "mail.meganmegmeg.site";


        return $data;
    }

    public function email_send($subject, $message, $to_email, $reply_email)
    {

        $smtp_credentials = $this->smtp_credentials();

        $mail = new PHPMailer(true);

        //Enable SMTP debugging.
        $mail->SMTPDebug = 0;                            
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();            
        //Set SMTP host name                          
        $mail->Host = $smtp_credentials['host'];
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = $smtp_credentials['email'];                 
        $mail->Password = $smtp_credentials['password']; 

        $mail->AddReplyTo($reply_email);

        $mail->SMTPSecure = $smtp_credentials['smtp'];                           
        //Set TCP port to connect to
        $mail->Port = $smtp_credentials['port'];                                   

        $mail->From = $smtp_credentials['from'];
        $mail->FromName = $smtp_credentials['from_name'];

        $mail->addAddress($to_email);

        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        try {
            if ($mail->Send()) {
                // code...
                return true;
            }else{
                return false;
            
            }

        } catch (Exception $e) {
        
            return false;

        }
    }

}
