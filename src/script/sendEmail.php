<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// (dirname(__DIR__) . '/script/deleteUserFiles.php');
require dirname(__DIR__).'/PHPMailer/src/Exception.php';
require dirname(__DIR__).'/PHPMailer/src/PHPMailer.php';
require dirname(__DIR__).'/PHPMailer/src/SMTP.php';

// sending an email function
function sendmail($to,$subject,$message,$name)
{
    $mail             = new PHPMailer();
    $body             = $message;
    $mail->IsSMTP();
    // $mail->SMTPDebug = 2;
    $mail->SMTPAuth   = true;
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 465;
    $mail->Username   = "lentalwebsite@gmail.com";
    $mail->Password   = "Rental1234";
    $mail->SMTPSecure = 'ssl';
    $mail->SetFrom('lentalwebsite@gmail.com', 'Lental');
    $mail->AddReplyTo("lentalwebsite@gmail.com","Lental");
    $mail->Subject    = $subject;
    $mail->AltBody    = "Any message.";
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($address, $name);
    if(!$mail->Send()) {
        return 0;
    } else {
          return 1;
   }
}

/**
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * This function uses type hints now (PHP 7+ only), but it was originally
 * written for PHP 5 as well.
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = strlen($keyspace) - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
 ?>
