<?php
header('Content-Type: application/json');

require_once 'core/init.php';

$type = isset($_GET['type']) ? $_GET['type']:'';
// $solar_data = new SolarData();

$return_data = array();

/*$to_date = date("d-m-Y");
$from_date = date("d-m-Y");*/

$from_date = date("d-m-Y", strtotime("-30 day"));
$to_date = date("d-m-Y", strtotime("-1 day"));

$user = new User();
//$consumer_id = "all";

$consumer_id = $user->data()->consumer_id;
//$consumer_pv_type = $user->data()->consumer_pv_type;

  
    $url_billing ="http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";



$context = stream_context_create(array(
    'http' => array(
        // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
    )
));

$data_billing = file_get_contents($url_billing, false, $context);
$arr_json_billing = json_decode($data_billing, true);

$i = 0;
$power_total=0;
    
     $arr_date_by_date = [];
     foreach ($arr_json_billing['Result']['BLData'] as $d) {
        $_data_key = date("Ymd", strtotime($d['MeterReading_DateTime']));
        if (!isset($arr_date_by_date[$_data_key]['act_exp'])) {
            $arr_date_by_date[$_data_key]['act_exp'] = 0;
          }
           $arr_date_by_date[$_data_key]['act_exp'] = $d['ACT_EXP_TOT'];
         //  $arr_date_by_date[$_data_key]['date'] = $d['MeterReading_DateTime'];
      
    }
     $return_data = [];
      $_loop_count = 0;
     /* foreach ($arr_date_by_date as $key => $value) {
      
         // $date_info =   $value['date'];
         // $dates = date_create($date_info);
         // $date_format= date_format($dates, 'd-M');
      
       // $return_data['bill'][$_loop_count]['date'] = $date_format;
      //  $return_data['bill'][$_loop_count]['act_exp'] = $value['act_exp'];
       // $act_exp =$value['act_exp'];
      //  $power_total +=$value['power'];
        
        $_loop_count++;
      }*/
 $first_date = date("Ymd", strtotime("-29 day"));
 $last_date = date("Ymd", strtotime("-1 day"));
 $act_exp_first=$arr_date_by_date[$first_date];
 $act_exp_last =$arr_date_by_date[$last_date];
 //$act_exp_diff= $act_exp_last-$act_exp_first;

/* foreach ($arr_json_exp['act_exp_first'] as $_data) {
   $data = $_data['act_exp'];
 }
 $arr_json_exp = json_encode($act_exp_first);*/
 $return_data['act_exp_first'] =$act_exp_first;
 $return_data['act_exp_last'] = $act_exp_last;

echo json_encode($return_data);
