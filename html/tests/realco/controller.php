<?php
// require_once __DIR__ . '/../../../config/pdo_connect.php';
require_once __DIR__ . '/../../../src/Input.php';

function pageController($dbc) {
  $data = [];
  $errors = [];
  $data['entries'] = $dbc->query('SELECT * FROM contact_entries')->fetchAll();
  $data['page'] = Input::get('page', 1);
  $secret = '6LdGs1oUAAAAAGZKT6Jn1195cNvOOdR3QeZ59wLB';
  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  $lang = 'en';

  if(Input::isPost()) {
    try {
      $name = Input::getString('name', 1, 20);
    } catch (Exception $e) {
      $errors['name'] = $e->getMessage();
    } catch (LengthException $e) {
      $errors['name'] = $e->getMessage();
    }
    try {
      $email = Input::getString('email');
    } catch (Exception $e) {
      $errors['email'] = $e->getMessage();
    } catch (LengthException $e) {
      $errors['email'] = $e->getMessage();
    }
    try {
      $address = Input::getString('address');
    } catch (Exception $e) {
      $errors['address'] = $e->getMessage();
    } catch (LengthException $e) {
      $errors['address'] = $e->getMessage();
    }
    try {
      $phone = Input::getString('phone', 10);
    } catch (Exception $e) {
      $errors['phone'] = $e->getMessage();
    } catch (LengthException $e) {
      $errors['phone'] = $e->getMessage();
    }
    try {
      $referral = Input::getString('referral');
    } catch (Exception $e) {
      $errors['referral'] = $e->getMessage();
    } catch (RangeException $e) {
      $errors['referral'] = $e->getMessage();
    }
    try {
      $budget1 = preg_replace('/([$])/', '', Input::getNumber('budget1'));
    } catch (Exception $e) {
      $errors['budget1'] = $e->getMessage();
    } catch (RangeException $e) {
      $errors['budget1'] = $e->getMessage();
    }
    try {
      $budget2 = preg_replace('/([$])/', '', Input::getNumber('budget2'));
    } catch (Exception $e) {
      $errors['budget2'] = $e->getMessage();
    } catch (RangeException $e) {
      $errors['budget2'] = $e->getMessage();
    }
    
    $emailTo = "gavinvaught@gmail.com";
    $subject = "Contact Form Submission – RealCo.";
    
    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    // Send to email
    if ($resp->isSuccess() && !$errors) {
      $body = "sent from RealCo. Contact Form: ";
      $body .= "\n"."\n";
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
      $body = mail($emailTo, $subject, $body, 'From: <noreply@gavinvaught.com>');
    }
    
    // Send data to local db
    if($resp->isSuccess() && !$errors) {
      $insert = 'INSERT INTO contact_entries (name, email, phone, address, referral, budget1, budget2) VALUES (:name, :email, :phone, :address, :referral, :budget1, :budget2)';
      $statement = $dbc->prepare($insert);
      $statement->bindValue(':name', $name, PDO::PARAM_STR);
      $statement->bindValue(':email', $email, PDO::PARAM_STR);
      $statement->bindValue(':phone', $phone, PDO::PARAM_STR);
      $statement->bindValue(':address', $address, PDO::PARAM_STR);
      $statement->bindValue(':referral', $referral, PDO::PARAM_STR);
      $statement->bindValue(':budget1', $budget1, PDO::PARAM_STR);
      $statement->bindValue(':budget2', $budget2, PDO::PARAM_STR);
      $statement->execute();
    } else { 
      $errors['reCaptcha'] = $resp->getErrorCodes(); 
    }  
  }

  $data['errors'] = $errors;

  return $data;
}