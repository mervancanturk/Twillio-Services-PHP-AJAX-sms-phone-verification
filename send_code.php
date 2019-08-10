<?php
include_once("conf.php");
$posted_phone_number = $_POST["phone_number"];
$posted_code = $_POST["posted_code"];

require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;
$client = new Client($sid, $token);

$verification_check = $client->verify->v2->services($service_sid)
                                         ->verificationChecks
                                         ->create($posted_code, array("to" => $posted_phone_number)
                                         );

header('Content-type: application/json');
echo json_encode($verification_check->status);