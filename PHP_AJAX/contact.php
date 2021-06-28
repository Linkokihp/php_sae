

<?php 

//Chechk if empty field

if( 
    empty($_POST['name']) || 
    empty($_POST['email']) || 
    empty($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
        echo json_encode(array('Fail', 'Inputs invalid'));
        return false;
    };

    // Send Email with 'mail'
    $name = strip_tags(htmlspecialchars($_POST['name']))
    $email = strip_tags(htmlspecialchars($_POST['email']))
    $message = strip_tags(htmlspecialchars($_POST['message']))

    // Create the Email u want to send
    $to = 'phil.koch@gmx.ch';
    $email_subject = 'Website contact form ' + $name;
    $email_body = $message;
    $headers = 'From: noreply@website.ch\n';
    $headers .= 'Reply-To: ' . $email;
    
    mail($to, $email_subject, $email_body, $headers);




    echo json_encode(array('success', 'Message Sent'));
    return true;


?>