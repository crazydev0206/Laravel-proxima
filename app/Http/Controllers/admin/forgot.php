<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class forgot extends Controller
{
    public function index(Request $request){
        
        $error = "";

        if($request->input('username')!=''){

            $username=$request->input('username');

             $row=DB::select("SELECT email FROM admin WHERE username='$username' LIMIT 1");
             if(count($row)!=0) {
                $row=collect($row)->first();
                $email = $row->email;


                    
                $emailMessage = view('emails.admin_reset');

                $uniq = uniqid();



                DB::insert("INSERT INTO admin_verification(email, code) VALUES (?, ?)", [$email, $uniq]);
                
                $urlChangeYourPassword = "https://rideride3.site/admin/changepassword?code=".$uniq;

                $emailMessage = str_replace('--url_change_your_password--', $urlChangeYourPassword, $emailMessage);

                $check = $this->email_send("Reset Your Password", $emailMessage, $email, "support@meganmegmeg.site");

                if ($check == true) {
                    // code...
                    $error = "Email Sent. Please check your inbox";
                }else{

                    $error = "Some Error Occured";
                }


            }
            else $error='Invalid credentials.';

        }

        
        return view('admin.forgot.index',['error'=>$error]);
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
