<?php

// Manually load the necessary parts of CodeIgniter without the full bootstrap
require_once __DIR__ . '/vendor/autoload.php';

// Define necessary constants if missing
if (!defined('APPPATH')) define('APPPATH', __DIR__ . '/app/');
if (!defined('SYSTEMPATH')) define('SYSTEMPATH', __DIR__ . '/vendor/codeigniter4/framework/system/');

// Initialize the configuration
$config = new \Config\Email();

// Manually create the email object
$email = new \CodeIgniter\Email\Email($config);

$email->setTo('test@example.com');
$email->setFrom('hello@nextcafe.com', 'NextCafe Test');
$email->setSubject('SMTP Test (Direct) - ' . date('Y-m-d H:i:s'));
$email->setMessage('This is a direct test message to verify Mailtrap configuration.');

echo "Attempting to send email (Direct Mode)...\n";

if ($email->send()) {
    echo "SUCCESS: Email sent successfully!\n";
} else {
    echo "ERROR: Failed to send email.\n";
    echo $email->printDebugger(['headers', 'subject', 'body']);
}
