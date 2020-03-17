<?php
header('Content-Type: application/json');

require_once 'core/init.php';

$scada = new ScadaData();
$peak_load = $scada->getPeakLoad();

$return_data = array();

$return_data['peak_load_curr_val_f'] = $peak_load->PEAK_LOAD_CURR_VAL_f;
$return_data['start_time_curr_val_f'] = round($peak_load->START_TIME_CURR_VAL_f, 2);
$return_data['end_time_curr_val_f'] = round($peak_load->END_TIME_CURR_VAL_f, 2);
$return_data['peak_price_curr_val_f'] = $peak_load->PEAK_PRICE_CURR_VAL_f;
$return_data['md_limit_curr_val_f'] = $peak_load->MD_LIMIT_CURR_VAL_f;

echo json_encode($return_data);
