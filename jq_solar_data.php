<?php
header('Content-Type: application/json');
//echo "[{ date: '2017-07-22 05:00:08', value: 0 },{ date: '2017-07-22 05:05:08', value: 0 },{ date: '2017-07-22 05:10:09', value: 0 },{ date: '2017-07-22 05:15:07', value: 0 },{ date: '2017-07-22 05:20:07', value: 0 },{ date: '2017-07-22 05:25:07', value: 0 },{ date: '2017-07-22 05:30:08', value: 0 },{ date: '2017-07-22 05:35:07', value: 0 },{ date: '2017-07-22 05:40:07', value: 0 },{ date: '2017-07-22 05:45:07', value: 0 },{ date: '2017-07-22 05:50:08', value: 0 },{ date: '2017-07-22 05:55:07', value: 0.007 },{ date: '2017-07-22 06:00:08', value: 0 },{ date: '2017-07-22 06:05:07', value: 0.186 },{ date: '2017-07-22 06:10:09', value: 0.265 },{ date: '2017-07-22 06:15:08', value: 0.359 },{ date: '2017-07-22 06:20:08', value: 0.48 },{ date: '2017-07-22 06:25:07', value: 0.315 },{ date: '2017-07-22 06:30:08', value: 0.795 },{ date: '2017-07-22 06:35:07', value: 0.755 },{ date: '2017-07-22 06:40:07', value: 0.719 },{ date: '2017-07-22 06:45:07', value: 0.929 },{ date: '2017-07-22 06:50:08', value: 1.346 },{ date: '2017-07-22 06:55:07', value: 2.765 },{ date: '2017-07-22 07:00:08', value: 4.804 },{ date: '2017-07-22 07:05:07', value: 5.397 },{ date: '2017-07-22 07:10:09', value: 5.011 },{ date: '2017-07-22 07:15:07', value: 4.703 },{ date: '2017-07-22 07:20:07', value: 5.022 },{ date: '2017-07-22 07:25:07', value: 5.121 },{ date: '2017-07-22 07:30:08', value: 3.505 },{ date: '2017-07-22 07:35:07', value: 2.309 },{ date: '2017-07-22 07:40:07', value: 2.299 },{ date: '2017-07-22 07:45:07', value: 2.169 },{ date: '2017-07-22 07:50:07', value: 2.393 },{ date: '2017-07-22 07:55:07', value: 4.185 },{ date: '2017-07-22 08:00:08', value: 5.552 },{ date: '2017-07-22 08:05:07', value: 6.432 },{ date: '2017-07-22 08:10:08', value: 6.534 },{ date: '2017-07-22 08:15:07', value: 10.583 },{ date: '2017-07-22 08:20:07', value: 13.044 },{ date: '2017-07-22 08:25:06', value: 4.431 },{ date: '2017-07-22 08:30:08', value: 4.648 },{ date: '2017-07-22 08:35:07', value: 5.703 },{ date: '2017-07-22 08:40:07', value: 6.807 },{ date: '2017-07-22 08:45:06', value: 5.769 },{ date: '2017-07-22 08:50:08', value: 6.137 },{ date: '2017-07-22 08:55:07', value: 6.516 },{ date: '2017-07-22 09:00:07', value: 5.638 },{ date: '2017-07-22 09:05:07', value: 5.662 },{ date: '2017-07-22 09:10:08', value: 7.489 },{ date: '2017-07-22 09:15:07', value: 8.349 },{ date: '2017-07-22 09:20:07', value: 8.936 },{ date: '2017-07-22 09:25:07', value: 8.799 },{ date: '2017-07-22 09:30:08', value: 8.799 },{ date: '2017-07-22 09:35:07', value: 8.533 },{ date: '2017-07-22 09:40:07', value: 8.79 },{ date: '2017-07-22 09:45:07', value: 7.576 },{ date: '2017-07-22 09:50:08', value: 8.675 },{ date: '2017-07-22 09:55:07', value: 11.468 },{ date: '2017-07-22 10:00:07', value: 9.472 },{ date: '2017-07-22 10:05:07', value: 9.472 },{ date: '2017-07-22 10:10:09', value: 8.638 },{ date: '2017-07-22 10:15:07', value: 14.577 },{ date: '2017-07-22 10:20:07', value: 15.616 },{ date: '2017-07-22 10:25:08', value: 9.33 },{ date: '2017-07-22 10:30:09', value: 14.621 },{ date: '2017-07-22 10:35:07', value: 8.67 },{ date: '2017-07-22 10:40:08', value: 6.276 },{ date: '2017-07-22 10:45:07', value: 7.143 },{ date: '2017-07-22 10:50:08', value: 16.559 },{ date: '2017-07-22 10:55:07', value: 21.364 },{ date: '2017-07-22 11:00:07', value: 23.979 },{ date: '2017-07-22 11:05:08', value: 23.979 },{ date: '2017-07-22 11:10:08', value: 7.81 },{ date: '2017-07-22 11:15:07', value: 7.81 },{ date: '2017-07-22 11:20:07', value: 7.863 },{ date: '2017-07-22 11:25:07', value: 13.026 },{ date: '2017-07-22 11:30:07', value: 13.974 },{ date: '2017-07-22 11:35:08', value: 14.458 },{ date: '2017-07-22 11:40:07', value: 12.289 },{ date: '2017-07-22 11:45:07', value: 10.789 },{ date: '2017-07-22 11:50:08', value: 8.705 },{ date: '2017-07-22 11:55:07', value: 7.939 },{ date: '2017-07-22 12:00:07', value: 6.061 },{ date: '2017-07-22 12:05:08', value: 6.061 },{ date: '2017-07-22 12:10:10', value: 6.678 },{ date: '2017-07-22 12:15:10', value: 7.568 },{ date: '2017-07-22 12:20:07', value: 6.82 },{ date: '2017-07-22 12:25:07', value: 9.636 },{ date: '2017-07-22 12:30:07', value: 12.531 },{ date: '2017-07-22 12:35:07', value: 14.451 },{ date: '2017-07-22 12:40:09', value: 14.451 },{ date: '2017-07-22 12:45:07', value: 12.978 },{ date: '2017-07-22 12:50:08', value: 9 },{ date: '2017-07-22 12:55:07', value: 7.257 },{ date: '2017-07-22 13:00:07', value: 7.188 },{ date: '2017-07-22 13:05:08', value: 6.383 },{ date: '2017-07-22 13:10:07', value: 7.4 },{ date: '2017-07-22 13:15:07', value: 7.4 },{ date: '2017-07-22 13:20:07', value: 11.019 },{ date: '2017-07-22 13:25:08', value: 11.019 },{ date: '2017-07-22 13:30:07', value: 12.292 },{ date: '2017-07-22 13:35:07', value: 11.554 },{ date: '2017-07-22 13:40:07', value: 10.319 },{ date: '2017-07-22 13:45:07', value: 10.498 },{ date: '2017-07-22 13:50:07', value: 10.788 },{ date: '2017-07-22 13:55:08', value: 11.084 },{ date: '2017-07-22 14:00:08', value: 12.704 },{ date: '2017-07-22 14:05:07', value: 13.339 },{ date: '2017-07-22 14:10:07', value: 20.163 },{ date: '2017-07-22 14:15:08', value: 20.163 },{ date: '2017-07-22 14:20:07', value: 19.224 },{ date: '2017-07-22 14:25:07', value: 19.224 },{ date: '2017-07-22 14:30:07', value: 10.052 },{ date: '2017-07-22 14:35:07', value: 8.742 },{ date: '2017-07-22 14:40:07', value: 9.27 },{ date: '2017-07-22 14:45:07', value: 8.581 },{ date: '2017-07-22 14:50:12', value: 7.629 },{ date: '2017-07-22 14:55:10', value: 7.447 },{ date: '2017-07-22 15:00:08', value: 6.827 },{ date: '2017-07-22 15:05:07', value: 8.321 },{ date: '2017-07-22 15:10:07', value: 11.08 },{ date: '2017-07-22 15:15:08', value: 12.941 },{ date: '2017-07-22 15:20:07', value: 11.2 },{ date: '2017-07-22 15:25:08', value: 11.2 },{ date: '2017-07-22 15:30:08', value: 5.477 },{ date: '2017-07-22 15:35:11', value: 2.524 },{ date: '2017-07-22 15:40:07', value: 2.284 },{ date: '2017-07-22 15:45:07', value: 2.503 },{ date: '2017-07-22 15:50:08', value: 4.481 },{ date: '2017-07-22 15:55:07', value: 5.872 },{ date: '2017-07-22 16:00:08', value: 6.556 },{ date: '2017-07-22 16:05:07', value: 6.556 },{ date: '2017-07-22 16:10:07', value: 5.95 },{ date: '2017-07-22 16:15:07', value: 6.525 },{ date: '2017-07-22 16:20:07', value: 6.609 },{ date: '2017-07-22 16:25:07', value: 6.304 },{ date: '2017-07-22 16:30:08', value: 6.082 },{ date: '2017-07-22 16:35:07', value: 6.297 },{ date: '2017-07-22 16:40:07', value: 6.379 },{ date: '2017-07-22 16:45:08', value: 5.858 },{ date: '2017-07-22 16:50:08', value: 5.273 },{ date: '2017-07-22 16:55:08', value: 4.488 },{ date: '2017-07-22 17:00:07', value: 4.163 },{ date: '2017-07-22 17:05:08', value: 3.937 },{ date: '2017-07-22 17:10:08', value: 3.682 },{ date: '2017-07-22 17:15:08', value: 3.264 },{ date: '2017-07-22 17:20:07', value: 3.044 },{ date: '2017-07-22 17:25:08', value: 2.621 },{ date: '2017-07-22 17:30:08', value: 1.983 },{ date: '2017-07-22 17:35:07', value: 1.693 },{ date: '2017-07-22 17:40:07', value: 1.501 },{ date: '2017-07-22 17:45:07', value: 1.302 },{ date: '2017-07-22 17:50:08', value: 1.188 },{ date: '2017-07-22 17:55:08', value: 1.188 },{ date: '2017-07-22 18:00:06', value: 1.036 },{ date: '2017-07-22 18:05:07', value: 0.99 },{ date: '2017-07-22 18:10:08', value: 0.99 },{ date: '2017-07-22 18:15:06', value: 0.928 },{ date: '2017-07-22 18:20:08', value: 0.97 },{ date: '2017-07-22 18:25:08', value: 1.04 },{ date: '2017-07-22 18:30:08', value: 1.086 },{ date: '2017-07-22 18:35:08', value: 0.96 },{ date: '2017-07-22 18:40:07', value: 0.916 },{ date: '2017-07-22 18:45:07', value: 0.516 },{ date: '2017-07-22 18:50:08', value: 0.213 },{ date: '2017-07-22 18:55:07', value: 0.052 },{ date: '2017-07-22 19:00:07', value: 0 },{ date: '2017-07-22 19:05:07', value: 0 },{ date: '2017-07-22 19:10:08', value: 0 },{ date: '2017-07-22 19:15:07', value: 0 },{ date: '2017-07-22 19:20:07', value: 0 },{ date: '2017-07-22 19:25:07', value: 0 },]";
require_once 'core/init.php';

$type = isset($_GET['type']) ? $_GET['type']:'';
// $solar_data = new SolarData();

$return_data = array();

$to_date = date("d-m-Y");
$from_date = date("d-m-Y");

if ($type == 'day') {
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
}

$user = new User();
//$consumer_id = "all";

$consumer_id = $user->data()->consumer_id;
$consumer_pv_type = $user->data()->consumer_pv_type;
if ($consumer_pv_type == 'gridtie') {
    $url = "http://172.24.105.27:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
} else if ($consumer_pv_type == 'hybrid') {
    $url = "http://172.24.105.34:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck?ConsumerID=$consumer_id&StartDate=$from_date&EndDate=$to_date";
}

$context = stream_context_create(array(
    'http' => array(
        // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
    )
));
$data = file_get_contents($url, false, $context);
$arr_json = json_decode($data, true);

$i = 0;
$d='';
if ($consumer_pv_type == 'gridtie') {
    foreach ($arr_json['Result']['GIData'] as $d) {
        $return_data['chart'][$i]['date'] = $d['Reading_DateTime'];
        //$return_data['chart'][$i]['value'] = $d['Current_PV1'];
        $c1 = $d['Current_PV1'] * $d['Voltage_PV1'];
        $c2 = $d['Current_PV2'] * $d['Voltage_PV2'];
        $k = ($c1 + $c2) / 1000;
        $return_data['chart'][$i]['value'] = $k;
        $return_data['meta']['power_now'] = $k;



        $time_info =$d['Reading_DateTime'];
        $__time= date("H:i:s",strtotime($time_info));
//        print_r($__time);
        if($__time<"22:00:43"){
            $return_data['meta']['power_today'] = $d['Energy_Today'];
        }

        //$return_data['meta']['power_today'] = $d['Energy_Today'];
        $power_total = ($d['Energy_Total_H'] * 65535) + $d['Energy_Total_L'];
        $return_data['meta']['power_total'] = $power_total / 1000;
        $i++;
    }
    $y_date = date("Ymd", strtotime("-1 day"));



} else {
    $return_data['meta']['power_today'] = 0;
    foreach ($arr_json['Result']['HIData'] as $d) {
        $return_data['chart'][$i]['date'] = $d['Reading_DateTime'];
        $return_data['chart'][$i]['value'] = $d['Battery_Voltage'];
     //   $return_data['meta'][$i]['value'] = $d['Local_Load_Today_Low_Word'];

        $c1 = $d['First_Input_Voltage_DC'] * $d['First_Input_Current_DC'];
        $c2 = $d['Second_Input_Voltage_DC'] * $d['Second_Input_Current_DC'];
        $kw = ($c1 + $c2) / 1000;
        $return_data['chart'][$i]['value'] = $kw;

        $return_data['meta']['power_now'] = $kw;
       // $return_data['meta']['power_today'] = "N/a";
         $return_data['meta']['power_today'] = $d['PV_Power_Today_Low_Word']/1000;
        $return_data['meta']['power_total'] = 'N/a';
        $i++;
    }
}

/*$y_date = date("d-m-Y", strtotime("-1 day"));
$url_y = "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=$consumer_id&StartDate=$y_date&EndDate=$y_date";
$data_y = file_get_contents($url_y, false, $context);
$arr_json_y = json_decode($data_y, true);

 foreach ($arr_json_y['Result']['GIData'] as $c) {

$return_data['meta']['yes_date']=$y_date;
$return_data['meta']['power_yes'] = $c['Energy_Today'];





//$return_data['meta']['power_yes'] = $return_data;
}*/
//echo $x;
//echo $y_date;

if ($return_data['meta']['power_now'] == '0') {
    $return_data['meta']['power_now'] = "0.00";
}

if ($return_data['meta']['power_today'] == '0') {
    $return_data['meta']['power_today'] = "0.00";
}

if ($return_data['meta']['power_total'] == '0') {
    $return_data['meta']['power_total'] = "0.00";
}

echo json_encode($return_data);
