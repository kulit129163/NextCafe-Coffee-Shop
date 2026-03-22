<?php

// Load CodeIgniter's bootstrap
require_once __DIR__ . '/public/index.php';

$email = \Config\Services::email();

$email->setTo('test@example.com');
$email->setFrom('hello@nextcafe.com', 'NextCafe Test');
$email->setSubject('SMTP Test - ' . date('Y-m-d H:i:s'));
$email->setMessage('This is a test email to verify Mailtrap configuration.');

echo "Attempting to send email...\n";

if ($email->send()) {
    echo "SUCCESS: Email sent successfully!\n";
} else {
    echo "ERROR: Failed to send email.\n";
    echo $email->printDebugger(['headers', 'subject', 'body']);
}
