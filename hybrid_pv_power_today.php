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
$consumer_id = "LT0614T6";
//$consumer_id = $user->data()->consumer_id;

$url = "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
 //echo $url;
$context = stream_context_create(array(
  'http' => array(
    // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
    'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
  )
));
$data = file_get_contents($url, false, $context);
$arr_json = json_decode($data, true);

/* print_r($arr_json);
 exit;
  */
    


      $arr_date_by_date = [];
      foreach ($arr_json['Result']['HIData'] as $_data) {
          $_data_key = date("Ymd", strtotime($_data['Reading_DateTime']));

          if (!isset($arr_date_by_date[$_data_key]['import'])) {
            $arr_date_by_date[$_data_key]['import'] = 0;
          }
         /* if (!isset($arr_date_by_date[$_data_key]['export'])) {
            $arr_date_by_date[$_data_key]['export'] = 0;
          }*/

         $time_info =$_data['Reading_DateTime'];
         $__time= date("H:i:s",strtotime($time_info));

         if($__time<"21:56:43"){
          $arr_date_by_date[$_data_key]['import'] = $_data['PV_Power_Today_Low_Word']; 
        //  $arr_date_by_date[$_data_key]['export'] += $_data['PV_Power_Today_Low_Word'];         
          $arr_date_by_date[$_data_key]['date'] = $_data['Reading_DateTime'];
         
         }
        
          }

        
        // print_r($__time);

         /* $date_info = $_data['MeterReading_DateTime'];
          $dates = date_create($date_info);
          $date_format= date_format($dates, 'd-M');*/
         
             //$date_infor=date_format($date_info,'Y-m-d H:i:s');
     // print_r($date_format);

      $return_data = [];
      $_loop_count = 0;
      foreach ($arr_date_by_date as $key => $value) {
        /*  $date_info =   $value['date'];
          $dates = date_create($date_info);
          $date_format= date_format($dates, 'd-M');*/
        $return_data['chart'][$_loop_count]['date'] = $value['date'];
      //  $return_data['chart'][$_loop_count]['date'] = $date_format;
        $return_data['chart'][$_loop_count]['import'] = $value['import'];
       // $return_data['chart'][$_loop_count]['export'] = $value['export'];

        $_loop_count++;
       // print_r($_loop_count);
      }



echo json_encode($return_data);











//$y_date = date("Ymd", strtotime("-1 day"));
//echo $arr_date_by_date[$y_date]['import'];
//exit;


      

