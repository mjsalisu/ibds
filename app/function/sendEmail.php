<?php
session_start();
function sendEmail($email, $subject, $message) {
    $to = $email;
    $subject = $subject;
    $message = $message;
    $from = 'mjsalisu@comcreate.ng';
    $headers = "From: " . strip_tags($from) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    // Check if the email was sent successfully
    if (mail($to, $subject, $message, $headers)) {
        echo 'Email sent successfully.';
    } else {
        echo 'Email sending failed.';
    }

}

function sendWelcomeEmail($email, $name, $password) {
    $subject = 'Welcome to Our Platform!';

    $message = 'Dear '.$name.',' . PHP_EOL . PHP_EOL .
    'Welcome to our platform! We\'re thrilled to have you on board. Your account has been successfully created, and we are excited to see you explore all the features and benefits our platform has to offer.' . PHP_EOL . PHP_EOL .
    'Please find your login details below:' . PHP_EOL .
    'Password: '.$password.'.' . PHP_EOL . PHP_EOL .
    'Remember to keep this information confidential. If you have any questions or need assistance, feel free to reach out. We\'re here to help!' . PHP_EOL . PHP_EOL .
    'Best regards,' . PHP_EOL .
    'IBDS Team';
    sendEmail($email, $subject, $message);
}

function sendItemRegistrationEmail($email, $name, $trackingId) {
    $subject = 'Item Registration Successful!';

    $message = 'Dear '.$name.',' . PHP_EOL . PHP_EOL .
    'Congratulations! Your item has been successfully registered on our platform. Thank you for choosing our services. Here are the details:' . PHP_EOL . PHP_EOL .
    'Item Tracking ID: '.$trackingId.'.' . PHP_EOL . PHP_EOL .
    'You can use this ID to keep track of your item\'s status. If you have any questions or concerns, don\'t hesitate to contact us. We\'re here to assist you.' . PHP_EOL . PHP_EOL .
    'Best regards,' . PHP_EOL .
    'IBDS Team';
    sendEmail($email, $subject, $message);
}

function sendItemApprovalEmail($email, $name, $trackingId) {
    $subject = 'Item Approval Notification';

    $message = 'Dear '.$name.',' . PHP_EOL . PHP_EOL .
    'We\'re pleased to inform you that your recently registered item with Tracking ID: '.$trackingId.' has been approved by our administrators. Your item is now safe and secure with us.' . PHP_EOL . PHP_EOL .
    'If you have any further questions or if there\'s anything else we can assist you with, feel free to reach out. Thank you for choosing our platform.' . PHP_EOL . PHP_EOL .
    'Best regards,' . PHP_EOL .
    'IBDS Team';
    sendEmail($email, $subject, $message);
}

function sendItemRejectionEmail($email, $name, $trackingId) {
    $subject = 'Item Rejection Notification';

    $message = 'Dear '.$name.',' . PHP_EOL . PHP_EOL .
    'We regret to inform you that your recently registered item with Tracking ID: '.$trackingId.' has been rejected by our administrators. If you have any questions regarding the rejection or need further assistance, please don\'t hesitate to contact us.' . PHP_EOL . PHP_EOL .
    'We appreciate your understanding, and we\'re here to help with any concerns you may have.' . PHP_EOL . PHP_EOL .
    'Best regards,' . PHP_EOL .
    'IBDS Team';
    sendEmail($email, $subject, $message);
}

function sendIetmCheckOutEmail($email, $name, $trackingId) {
    $subject = 'Item Check-Out Confirmation';

    $message = 'Dear '.$name.',' . PHP_EOL . PHP_EOL .
    'Your item with Tracking ID: '.$trackingId.' has been successfully checked out from our facility. If you were the one who picked it up, thank you for choosing our services. If you believe there is an error or if you did not pick up the item, please contact us immediately.' . PHP_EOL . PHP_EOL .
    'We\'re here to assist you with any questions or concerns you may have.' . PHP_EOL . PHP_EOL .
    'Best regards,' . PHP_EOL .
    'IBDS Team';
    sendEmail($email, $subject, $message);
}
?>