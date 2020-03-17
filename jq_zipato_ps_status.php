<?php
header('Content-Type: application/json');

require_once 'core/init.php';

$user = new User();
if (! $user->isLoggedIn()) {
    Redirect::to('login.php');
}

$attributes = array(
    'p1' => array(
        'current_consumption' => 'ae4aa8d0-82df-4254-a093-24eee71846d4',
        'state' => '03d32f7c-ad1d-41b3-ba85-21ac70f8b5e4',
        'amperes' => '09402571-cd3d-4cf8-8602-25854b6a6445',
        'cumulative_consumption' =>	'e041dcac-2469-45d1-9464-076327e10330',
        'power_factor' => 'f4d07f4a-e075-4d62-a1c2-4bceb0037e4f',
        'voltage' => 'b772e64e-511c-4588-b32f-9d4f876f4e3d'
    ),
    'p2' => array(
        'current_consumption' => 'd0ce69de-75f8-4a63-b066-86e50ea04258',
        'state' => 'f224cfe6-e95e-464b-9903-8bc32bbb0263',
        'amperes' => '8c07d257-5ef2-4866-a093-bd7db2e85e5e',
        'cumulative_consumption' =>	'f9fda9c3-d4c0-49a6-aa60-b37b8032df34',
        'power_factor' => '24415410-e8a6-40fd-a757-ab4cb2e7274f',
        'voltage' => '00b6dbb0-972b-47fa-8a04-f748765025d6'
    )
);

$zipatoServices = new MyZipatoServices(Config::get('zipato/username'), Config::get('zipato/password'));
$arr_attributes = array();
foreach ($attributes as $akey => $at) {
    foreach ($at as $key => $value) {
        $rData = $zipatoServices->autogetAttributes($value);
        $arr_attributes[$akey][$key] = $rData->value->value;
    }
}
$zipatoServices->finish();

echo json_encode($arr_attributes);