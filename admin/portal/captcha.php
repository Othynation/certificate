<?php
session_start();

// Generate a random captcha string
$captcha_string = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

// Store the captcha string in the session for validation
$_SESSION['captcha'] = $captcha_string;

// Output the captcha string as text
header('Content-type: text/plain');
echo $captcha_string;
?>
