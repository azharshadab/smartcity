<?php
header('Content-Type: application/json');
require_once 'core/init.php';

if (Input::get('switch') != '' && Input::get('mode') != '') {
    $switch_id = Input::get('switch');
    $mode = Input::get('mode');

    $url = "http://172.24.105.27:8092/mdmapi/api/mdm/consumer/applianceonoff/mindteck?ConsumerApplianceLoad_ID=$switch_id&OnOff=$mode";
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz\r\n"
        )
    );

    $context = stream_context_create($opts);
    $file = file_get_contents($url, false, $context);
}