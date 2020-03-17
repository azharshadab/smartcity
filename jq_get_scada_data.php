<?php
header('Content-Type: application/json');

require_once 'core/init.php';

$action = isset($_GET['a']) ? $_GET['a']:'scada_mm';
$return_data = array();

if ($action == 'scada') {
    $scada_data = new ScadaData();
    $chart_data = $scada_data->getChartData(720);

    $i = 0;
    foreach ($chart_data as $cd) {
        $load = abs($cd->L33KV_OG_TRF1_KW_CURR_VAL_f) + abs($cd->L33KV_OG_TRF2_KW_CURR_VAL_f) + abs($cd->L33KV_OG_TRF3_KW_CURR_VAL_f);
        
        $power_now = round($load, 3);
        $date_now = date("Y-m-d H:i:s", strtotime($cd->LOG_TIME . ' +0000'));
        //echo "{ date: '{$date_now}', value: {$power_now} },";
        $return_data[$i]['date'] = $date_now;
        $return_data[$i]['value'] = $power_now;
        $i++;
    }
} else if ($action == 'scada_ss') {
    $scada_data = new ScadaData();
    $chart_data_ss = $scada_data->getSubStationData(720);

    $i = 0;
    foreach ($chart_data_ss as $cd) {
        $sp1 = round($cd->SP1_11KV_IC1_KW_CURR_VAL_f, 3);
        $sp2 = round($cd->SP2_11KV_IC_KW_CURR_VAL_f, 3);
        $ss2 = round($cd->SS2_11KV_IC_KW_CURR_VAL_f, 3); 
        $ss3 = round($cd->SS3_11KV_IC1_KW_CURR_VAL_f+$cd->SS3_11KV_IC2_KW_CURR_VAL_f, 3);
        $ss4 = round($cd->SS4_11KV_IC1_KW_CURR_VAL_f+$cd->SS4_11KV_IC2_KW_CURR_VAL_f, 3);
        $ss5 = round($cd->SS5_11KV_IC1_KW_CURR_VAL_f+$cd->SS5_11KV_IC2_KW_CURR_VAL_f, 3);
        $ss6 = round($cd->SS6_11KV_IC1_KW_CURR_VAL_f+$cd->SS6_11KV_IC2_KW_CURR_VAL_f, 3);
        $ss7 = round($cd->SS7_11KV_IC1_KW_CURR_VAL_f+$cd->SS7_11KV_IC2_KW_CURR_VAL_f, 3);
        $ss8 = round($cd->SS8_11KV_IC1_KW_CURR_VAL_f+$cd->SS8_11KV_IC2_KW_CURR_VAL_f, 3);
        $ss9 = round($cd->SS9_11KV_IC2_KW_CURR_VAL_f+$cd->SS9_11KV_IC1_KW_CURR_VAL_f, 3);
        $ss10 = round($cd->SS10_11KV_IC1_KW_CURR_VAL_f+$cd->SS10_11KV_IC2_KW_CURR_VAL_f, 3);

        $date_now = date("Y-m-d H:i:s", strtotime($cd->LOG_TIME . ' +0000'));

        $return_data[$i]['date'] = $date_now;
        $return_data[$i]['sp1'] = $sp1;
        $return_data[$i]['sp2'] = $sp2;
        $return_data[$i]['ss2'] = $ss2;
        $return_data[$i]['ss3'] = $ss3;
        $return_data[$i]['ss4'] = $ss4;
        $return_data[$i]['ss5'] = $ss5;
        $return_data[$i]['ss6'] = $ss6;
        $return_data[$i]['ss7'] = $ss7;
        $return_data[$i]['ss8'] = $ss8;
        $return_data[$i]['ss9'] = $ss9;
        $return_data[$i]['ss10'] = $ss10;
        $i++;
    }

} else if ($action == 'scada_ss_cl') {
    function formatData(&$value, $key) {
        $value = round($value, 2);
    }

    $scada_data = new ScadaData();
    $ss_current_load = $scada_data->getCurrentSubStationLoad();
    array_walk($ss_current_load, 'formatData');
    $return_data = $ss_current_load;
    // print_r($return_data);
} else if ($action == 'scada_mm') {
    $scada_data = new ScadaData();
    $sd_max = $scada_data->getMaxLoad();
    $sd_min = $scada_data->getMinLoad();

    $return_data['current_load'] = $scada_data->getCurrentLoad();
    $return_data['current_load_time'] = date("d-m-Y H:i:s A");

    $return_data['max_load_time'] = date("d-m-Y H:i:s A", strtotime($sd_max->LOG_TIME . ' +0000'));
    $return_data['min_load_time'] = date("d-m-Y H:i:s A", strtotime($sd_min->LOG_TIME . ' +0000'));

    $return_data['max_load'] = round($sd_max->ALOAD, 2);
    $return_data['min_load'] = round($sd_min->ALOAD, 2);
}

echo json_encode($return_data);
