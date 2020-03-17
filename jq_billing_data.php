<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
//echo "[{ date: '2017-07-22 05:00:08', value: 0 },{ date: '2017-07-22 05:05:08', value: 0 },{ date: '2017-07-22 05:10:09', value: 0 },]";


require_once 'core/init.php';

$type = isset($_GET['type']) ? $_GET['type']:'';
$return_data = array();


$from_date = date("d-m-Y", strtotime("-30 day"));
$to_date = date("d-m-Y", strtotime("-1 day"));
if ($type == 'month') {
    $from_date = date("d-m-Y", strtotime("-30 day"));
}else if ($type == 'week') {
    $from_date = date("d-m-Y", strtotime("-7 day"));
   // $to_date = date("d-m-Y", strtotime("-30 day"));
}
$user = new User();
//$consumer_id = "LT004";
$consumer_id = $user->data()->consumer_id;

//$url = "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/lsdata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
 $url="http://172.24.105.22:8091/SGBillingApi/KWHAndBillingAmount?ConsumerID=$consumer_id&FromDate=$from_date&ToDate=$to_date";
 //echo $url;
$context = stream_context_create(array(
  'http' => array(
    // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
    'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
  )
));
$data = file_get_contents($url, false, $context);
$arr_json = json_decode($data, true);
 

 $y_date = date("d-M", strtotime("-30 day"));
 $return_data['meta']['date']= $y_date;

foreach ($arr_json['Result']as $d) {

  $return_data['meta']['consumption_units'] = $d['ConsumptionUnits_kWh'];
  $return_data['meta']['consumption_amount'] = $d['ConsumptionAmount_INR'];
  $return_data['meta']['export_units'] = $d['ExportUnits_kWh'];
  $return_data['meta']['bill'] = $d['NetBillingAmount_INR'];
}

echo json_encode($return_data);
