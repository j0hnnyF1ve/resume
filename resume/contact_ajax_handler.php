<?php

$email = isset($_POST['ContactEmail']) ? $_POST['ContactEmail'] : '';
$subject = isset($_POST['ContactSubject']) ? $_POST['ContactSubject'] : '';
$message = isset($_POST['ContactMessage']) ? $_POST['ContactMessage'] : '';

// validate form info
if($email == '')
{
    $commentMessage .= 'Email must not be left blank<br/>';
}
else if(preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i', $email) == 0)
{
    $commentMessage .= 'You must enter a valid email<br/>';
}

if($subject == '')
{
    $commentMessage .= 'Subject must not be left blank<br/>';
}

if($message == '')
{
    $commentMessage .= 'Email message must not be left blank<br/>';
}

if($commentMessage == '')
{
    $headers = 'From: '.$email.'\r\n';
    
    // mail to me
    mail('john.pangilinan1@gmail.com', $email . ' - ' . $subject, $message, $headers);
    echo json_encode( array('success' => true, 'message' => 'Your email has been sent successfully!') );
}
else
{
    $commentMessage = 'The following errors need to be corrected:<br/><br/> <span style="color: red;">' . $commentMessage . '</span><br/>';
    echo json_encode( array('success' => false, 'message' => $commentMessage) );
}
?>