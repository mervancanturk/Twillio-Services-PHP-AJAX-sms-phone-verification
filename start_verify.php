<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
include_once("conf.php");


$posted_phone_number = $_POST["phone_number"];

$client = new Client($sid, $token);
$twilio = new Client($sid, $token);
$verification = $twilio->verify->v2->services($service_sid)
                                   ->verifications
                                   ->create($posted_phone_number, "sms");


header('Content-type: application/json');
echo json_encode($verification->sid);