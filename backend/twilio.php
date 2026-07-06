<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/vendor/autoload.php";

use Twilio\Rest\Client;


function getTwilioClient()
{
    return new Client(ACCOUNT_SID, AUTH_TOKEN);
}

function checkWhatsappJoined($mobile)
{
    $client = getTwilioClient();

    $messages = $client->messages->read([], 50);

    $from = "whatsapp:+91" . $mobile;

    foreach ($messages as $msg) {
        if (
            $msg->from === $from &&
            stripos($msg->body, "join language-prepare") !== false
        ) {
            return true;
        }
    }

    return false;
}

function sendWhatsappOTP($mobile, $otp)
{
    $client = getTwilioClient();

    $client->messages->create(
        "whatsapp:+91" . $mobile,
        [
            "from" => TWILIO_WHATSAPP,
            "body" => "Your e-Voting OTP is: {$otp}\nValid for 5 minutes."
        ]
    );

    return true;
}
