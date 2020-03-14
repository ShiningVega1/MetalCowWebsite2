<?php
require '../vendor/autoload.php';

//verify the recaptcha
$captcha;
if(isset($_POST['g-recaptcha-response'])){
  $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
  echo "We apologize, there was an technical error in processing your request please contact us directly at teammetalcow@gmail.com";
  exit(0);
}

$secretKey = getenv('RECAPTCHA_SECRET_API_KEY');
$ip = $_SERVER['REMOTE_ADDR'];
// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
$response = file_get_contents($url);
$responseKeys = json_decode($response,true);
// should return JSON with success as true
if($responseKeys["success"]) {


    //if required field is not present, prolly didn't use the HTML form.
    if( !isset($_POST['myname']) ) {
      echo "We apologize, there was an technical error in processing your request please contact us directly at teammetalcow@gmail.com";
      exit(0);
    }

    //sanitize all inputs for security
    $name = filter_var($_POST["myname"], FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_var($_POST["mymessage"], FILTER_SANITIZE_SPECIAL_CHARS);
    $subject = filter_var($_POST["mysubject"], FILTER_SANITIZE_SPECIAL_CHARS);

    if(filter_var($_POST["myemail"], FILTER_VALIDATE_EMAIL) ){
      $email = $_POST["myemail"];
    }else{
      echo "We apologize, there was a problem with your email address, please contact us directly at teammetalcow@gmail.com";
      exit(0);
    }


    /////
    //Send the customer's inquiry to MetalCow
    /////

    $from = new SendGrid\Email($name, $email);
    $subject = "Website Inquiry: ".$subject;
    $to = new SendGrid\Email("MetalCow Robotics", getenv('TEAM_EMAIL'));
    $content = new SendGrid\Content("text/html", $message);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->headers();
    echo $response->body();
    echo $message;

    //ToDo: Add a response ticket email to the customer to confirm we have recieved their question.
    //Need to look up how to write this professionally.  What did JawBone do with your ticket?

    //go back to the homepage
    header('Location: https://www.metalcowrobotics.com/index.html');

} else {
  echo "We apologize, there was an technical error in processing your request please contact us directly at teammetalcow@gmail.com";
  exit(0);
}

?>
