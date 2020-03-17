<?php
header('Content-Type: application/json');

require_once 'core/init.php';

$type = isset($_GET['type']) ? $_GET['type']:'';
// $solar_data = new SolarData();

$return_data = array();

//$to_date = date("d-m-Y");
//$from_date = date("d-m-Y");
$to_date = date("d-m-Y", strtotime("-1 day"));
$from_date = date("d-m-Y", strtotime("-1 day"));

/*if ($type == 'day') {
    if (date("d-m-Y H:i:s") < date("d-m-Y 05:00:00")) {
        $from_date = date("d-m-Y", strtotime("-1 day"));
    } else {
        $from_date = $to_date;
    }
} else if ($type == 'yesterday') {
    $from_date = date("d-m-Y", strtotime("-1 day"));
} else if ($type == 'week') {
    $from_date = date("d-m-Y", strtotime("-6 day"));
} else {
    $from_date = $to_date;
}*/

$user = new User();
//$consumer_id = "LT004";
$consumer_id = $user->data()->consumer_id;
$consumer_pv_type = $user->data()->consumer_pv_type;
if ($consumer_pv_type == 'gridtie') {
    $url = "http://172.24.105.27:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
} else if ($consumer_pv_type == 'hybrid') {
    $url = "http://172.24.105.27:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
}

$context = stream_context_create(array(
    'http' => array(
        // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
    )
));
$data = file_get_contents($url, false, $context);
$arr_json = json_decode($data, true);
/*print_r($arr_json);
exit;*/

$i = 0;
$d='';
$arr_date_by_date = [];
if ($consumer_pv_type == 'gridtie') {

    foreach ($arr_json['Result']['GIData'] as $d) {

        $time_info =$d['Reading_DateTime'];
        $__time= date("H:i:s",strtotime($time_info));

        $return_data['meta']['date'] = $d['Reading_DateTime'];
        if($__time<"20:00:43"){
            $return_data['meta']['power_yes'] = $d['Energy_Today'];
        }      
    
        $i++;
    }

}
 else {
   // $return_data['meta']['power_today'] = 0;
    foreach ($arr_json['Result']['HIData'] as $d) {
    	$return_data['chart'][$i]['date'] = $d['Reading_DateTime'];
    	$time_info =$d['Reading_DateTime'];
        $__time= date("H:i:s",strtotime($time_info));
        if($__time<"22:00:43"){
        $return_data['meta']['power_yes'] = $d['PV_Power_Today_Low_Word']/1000;
        }
        $return_data['meta']['power_total'] = 'N/a';
        $i++;
    }
}
  
   

echo json_encode($return_data);
