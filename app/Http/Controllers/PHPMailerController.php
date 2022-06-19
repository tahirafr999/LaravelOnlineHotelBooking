<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;
use App\User;

class PHPMailerController extends Controller
{
    public function email() {
        return  view("auth.register");
    }

    public function composeEmail(Request $request) {

        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        require base_path("vendor/autoload.php");

    
 
        try {
 
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'tahirafridi0900@gmail.com';   //  sender username
            $mail->Password = 'tahir43210432100';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465
 
            $mail->setFrom('tahirafridi0900@gmail.com', 'Tahir');
            $mail->addAddress($request->email);
            $mail->addCC($request->emailCc);
            $mail->addBCC($request->emailBcc);
 
            $mail->addReplyTo('tahirafridi0900@gmail.com', 'Tahir');
 
            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }
 
 
            $mail->isHTML(true);                // Set email content format to HTML
 
            $mail->Subject = $request->emailSubject;
            $mail->Body    = $request->emailBody;
 
            // $mail->AltBody = plain text version of email body;
 
            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "Email has been sent.");
            }
 
        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }
    }

    // public function create(array $data)
    // {
    //   return User::create([
    //     'company_name' => $data['company_name'],
    //     'email' => $data['email'],
    //     'username' => $data['username'],
    //     'password' => Hash::make($data['password']),
    //     'cpassword' => Hash::make($data['cpassword']),
    //     'verify_token' =>  $data['verify_token']
    //   ]);
    // }
}
