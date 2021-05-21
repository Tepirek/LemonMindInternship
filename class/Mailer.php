<?php

namespace App\class;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

final class Mailer {

    private string $recipient;
    private string $recipientsName;
    private string $subject;
    private string $body;
    private array $attachments;

    public function __construct($recipientsName, $subject, $body, $attachments) {
        $this->recipientsName = $recipientsName;
        $this->subject = $subject;
        $this->body = $body;
        $this->attachments = $attachments;
    }

    public function setRecipient($type) {
        if (strcmp($type, 'Airbus A380')) $this->recipient = $_ENV['AIRBUS_EMAIL'];
        if (strcmp($type, 'Boeing 747')) $this->recipient = $_ENV['BOEING_EMAIL'];
    }

    public function send(): bool {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = $_ENV['MTP_USERNAME'];
            $mail->Password = $_ENV['MTP_PASSWORD'];

            // Recipients
            $mail->setFrom($_ENV['MTP_EMAIL'], 'LemonMind');
            $mail->addAddress($this->recipient, $this->recipientsName);

            // Attachments
            foreach ($this->attachments as $att) {
                $mail->addAttachment($att);
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body = $this->body;
            // TODO: $mail->AltBody = ;

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}