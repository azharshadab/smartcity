<?php
$url = "http://172.20.46.3:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=LT004&StartDate=14-11-2017&EndDate=14-11-2017";
//$username = 'username';
//$password = 'password';
$context = stream_context_create(array(
    'http' => array(
        // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
    )
));
$data = file_get_contents($url, false, $context);
$arr_json = json_decode($data, true);

echo "<pre>";
//print_r($arr_json);
$return_data = array();
$i = 0;
foreach ($arr_json['Result']['GIData'] as $d) {
    $return_data[$i]['date'] = $d['Reading_DateTime'];
    $return_data[$i]['value'] = $d['Current_PV1'];

    $i++;
}

print_r($return_data);
