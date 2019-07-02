
<?php
require '../vendor/autoload.php';

//if required field is not present, prolly didn't use the HTML form.
if( !isset($_POST['studentEmail']) ) {
  echo "We apologize, there was an technical error in processing your data please email us using
  the form at <a href='/#contact'>www.metalcowrobotics.com#contact</a>
  or directly at info@metalcowrobotics.com";
  exit(0);
}

//validate form data
$studentFname = filter_var($_POST["studentFname"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentLname = filter_var($_POST["studentLname"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentEmail = filter_var($_POST["studentEmail"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentPhone = filter_var($_POST["studentPhone"], FILTER_SANITIZE_SPECIAL_CHARS);

$parentFname = filter_var($_POST["parentFname"], FILTER_SANITIZE_SPECIAL_CHARS);
$parentLname = filter_var($_POST["parentLname"], FILTER_SANITIZE_SPECIAL_CHARS);
$parentEmail = filter_var($_POST["parentEmail"], FILTER_SANITIZE_SPECIAL_CHARS);
$parentPhone = filter_var($_POST["parentPhone"], FILTER_SANITIZE_SPECIAL_CHARS);

$studentSchool = filter_var($_POST["studentSchool"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentGrade = filter_var($_POST["studentGrade"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentRobotics = filter_var($_POST["studentRobotics"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentCommitments = filter_var($_POST["studentCommitments"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentReference = filter_var($_POST["studentReference"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentRole = filter_var($_POST["studentRole"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentSkills = filter_var($_POST["studentSkills"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentExpectations = filter_var($_POST["studentExpectations"], FILTER_SANITIZE_SPECIAL_CHARS);
$studentInteresting = filter_var($_POST["studentInteresting"], FILTER_SANITIZE_SPECIAL_CHARS);


//if there is an issue, redirect
//pass back things entered.


//setup timezone
date_default_timezone_set('America/Chicago');

//build the application message from the webform contents
$message = "MetalCow,<br>
<br>
The following information has been submitted via the website.<br>
Please review and follow up with the student.<br>

<h3>Student Contact Info</h3>
<b>Name:</b> ".$studentFname." ".$studentLname."<br>
<b>Email:</b> ".$studentEmail."<br>
<b>Phone:</b> ".$studentPhone."<br>

<h3>Parent Contact Info</h3>
<b>Name:</b> ".$parentFname." ".$parentLname."<br>
<b>Email:</b> ".$parentEmail."<br>
<b>Phone:</b> ".$parentPhone."<br>

<h3>Student Academics</h3>
<b>School:</b> ".$studentSchool."<br>
<b>Grade:</b> ".$studentGrade."<br>
<b>How did student find out about MetalCow Robotics:</b> ".$studentReference."<br>
<br>
<b>Robotics Experience:</b><br>
".$studentRobotics."<br>
<br>
<b>Other Commitments:</b><br>
".$studentCommitments."<br>

<h3>Student Team Related Info</h3>
<b>Student is interested in a role on:</b> ".$studentRole."<br>
<b>Student's Skills:</b><br>
".$studentSkills."<br>
<br>
<b>Student's Expectations:</b><br>
".$studentExpectations."<br>
<br>
<b>Something the student finds interesting about themself:</b><br>
".$studentInteresting."<br>
<br>
<br>
<i>www.MetalCowRobotics.com/join | ".date('m/d/Y h:i:s a', time())."</i>";


//make a connection to google to get gmail to send email for us
$name = "MetalCow Robotics";
$email = "teammetalcow@gmail.com";
$from = new SendGrid\Email($name, $email);
$subject = "MetalCow Pre-Enrollment: ".$studentFname." ".$studentLname;
$to = new SendGrid\Email("MetalCow Robotics", getenv('TEAM_EMAIL'));
$content = new SendGrid\Content("text/html", $message);
$mail = new SendGrid\Mail($from, $subject, $to, $content);

//Send email to teammetalcow@gmail.com with the application
$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);
$response = $sg->client->mail()->send()->post($mail);
//echo $response->statusCode();
//echo $response->headers();
//echo $response->body();
//echo $message;


/**************************
Build up an email to the student
******************/
//send email to applicant with links to next available meeting times
//look up next available times on google calendar for times labeled 'interview'

//in the email let them select a time, if they select, update the one they picked with their info.

//do we need some type of one time key?  How could this be hacked?

//Build a second message to the student and parent

//go back to the homepage
header('Location: https://www.metalcowrobotics.com/applySuccess.html');
//die();
?>
