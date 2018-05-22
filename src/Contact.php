<?php

require __DIR__ . '/../vendor/autoload.php';

$siteKey = '6LdGs1oUAAAAAH3FvnrfvpI3e7PUdDI1m6wfxQmi';
$secret = '6LdGs1oUAAAAAGZKT6Jn1195cNvOOdR3QeZ59wLB';

$recaptcha = new \ReCaptcha\ReCaptcha($secret);
$lang = 'en';

if (isset($_POST['g-recaptcha-response'])) {
  
  $emailFrom = "gavinvaught@gmail.com";
  $emailTo = "gavinvaught@gmail.com";
  $subject = "Contact Form Submission – RealCo.";
  $name = Trim(stripslashes($_POST['name'])); 
  $email = Trim(stripslashes($_POST['email'])); 
  $address = Trim(stripslashes($_POST['address'])); 
  $phone = Trim(stripslashes($_POST['phone'])); 
  $referral = Trim(stripslashes($_POST['referral'])); 
  $budget1 = Trim(stripslashes($_POST['budget1']));
  $budget2 = Trim(stripslashes($_POST['budget2']));
  
  $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
  
  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  
  if ($resp->isSuccess()) {
    // prepare email body text
    $body = "";
    $body .= "Name: ";
    $body .= $name;
    $body .= "\n";
    $body .= "Email: ";
    $body .= $email;
    $body .= "\n";
    $body .= "Address: ";
    $body .= $address;
    $body .= "\n";
    $body .= "Phone: ";
    $body .= $phone;
    $body .= "\n";
    $body .= "Referral: ";
    $body .= $referral;
    $body .= "\n";
    $body .= "Budget: ";
    $body .= $budget1." - ".$budget2;
    $body .= "\n";
    // send email 
    $success = mail($emailTo, $subject, $body, "From: <$emailFrom>");

    print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.php>";
  }
  else {
    $error = $resp->error;
  }
}
?>