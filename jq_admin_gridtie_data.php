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

    $url_gridtie = "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
    //$url_billing ="http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";



$context = stream_context_create(array(
    'http' => array(
        // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
    )
));
$data_gridtie = file_get_contents($url_gridtie, false, $context);
$arr_json_gridtie = json_decode($data_gridtie, true);
/*$data_billing = file_get_contents($url_billing, false, $context);
$arr_json_billing = json_decode($data_billing, true);
*/
$i = 0;
$power_total=0;
    /*foreach ($arr_json_gridtie['Result']['GIData'] as $d) {

       // $return_data['chart'][$i]['date'] = $d['Reading_DateTime'];
         $time_info =$d['Reading_DateTime'];
        $__time= date("H:i:s",strtotime($time_info));
        if($__time<"22:00:43"){
        $_power = $d['Energy_Today'];
    }
        $power_day =$_power;
        $power_total +=$power_day;
        $return_data['meta']['power_total'] = $power_total;
        $i++;
    }

     $arr_data_by_date = [];
     foreach ($arr_json_billing['Result']['BLData'] as $d) {
        $_data_key = date("Ymd", strtotime($d['MeterReading_DateTime']));
        if (!isset($arr_data_by_date[$_data_key]['act_exp'])) {
            $arr_data_by_date[$_data_key]['act_exp'] = 0;
          }
           $arr_data_by_date[$_data_key]['act_exp'] = $d['ACT_EXP_TOT'];
           $arr_data_by_date[$_data_key]['date'] = $d['MeterReading_DateTime'];
       // $return_data['chart'][$i]['date'] = $d['Reading_DateTime'];
       /* $act_exp = $d['ACT_EXP_TOT'];
        $return_data['meta']['act_exp'] = $act_exp;
        $i++;
    }
    // $return_data = [];
      $__loop_count = 0;
      foreach ($arr_data_by_date as $key => $value) {
      
         $date_info =   $value['date'];
          $dates = date_create($date_info);
          $date_format= date_format($dates, 'd-M');
      
        $return_data['bill'][$__loop_count]['date'] = $date_format;
        $return_data['bill'][$__loop_count]['act_exp'] = $value['act_exp'];
        $act_exp =$value['act_exp'];
      //  $power_total +=$value['power'];
        
        $__loop_count++;
      }*/





 $arr_date_by_date = [];
      foreach ($arr_json_gridtie['Result']['GIData'] as $_data) {
          $_data_key = date("Ymd", strtotime($_data['Reading_DateTime']));
          $time_info =$_data['Reading_DateTime'];
          $__time= date("H:i:s",strtotime($time_info));
          if (!isset($arr_date_by_date[$_data_key]['power_total'])) {
            $arr_date_by_date[$_data_key]['power_total'] = 0;
          }
          if($__time<"22:00:43"){
          $arr_date_by_date[$_data_key]['power'] = $_data['Energy_Today']; 
          $arr_date_by_date[$_data_key]['date'] = $_data['Reading_DateTime'];
         }
          }
         

      $return_data = [];
      $_loop_count = 0;
      foreach ($arr_date_by_date as $key => $value) {
          $date_info =   $value['date'];
          $dates = date_create($date_info);
          $date_format= date_format($dates, 'd-M');
      
      //  $return_data['chart'][$_loop_count]['date'] = $date_format;
      //  $return_data['chart'][$_loop_count]['power'] = $value['power'];
        $power_total +=$value['power'];
        
        $_loop_count++;
      }
     // $return_data['meta']['power'] +=$value['power_total'];
//print_r($return_data);
     // $return_data['meta']['power_total'] +=$value['power'];
     // $y_date = date("Ymd", strtotime("-1 day"));
      $return_data['meta']['power_total']=$power_total;
     // $return_data['bill']['act_exp']=$act_exp;
     // $return_data['meta']['date'] = date("d-M", strtotime("-1 day"));

    // echo $y_date;
     // $y_date = date("Y-m-d", strtotime("-1 day"));
     // $return_data['meta']['tot_consumption'] = $arr_date_by_date[$y_date];
    














echo json_encode($return_data);

