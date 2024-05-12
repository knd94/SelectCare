<?php

require __DIR__ . 'autoload.php';
use Twilio\Rest\Client;

$account_sid = getenv('ACaae52f847cead68486b9926796c6e13e');
$auth_token = getenv('b51d0179fba3ccdedb2812eec05f5d76');

$twilio_number = "+447479277404";

$client = new Client($account_sid, $auth_token);
$client->messages->create(

    '07722365775',
    array(
        'from' => $twilio_number,
        'body' => 'Lily Smith requires your attention. 
					Her emergency button has been pressed.'
    )
);

?>
