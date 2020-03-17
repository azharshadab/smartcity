<?php
//header('Content-Type: application/json');

require_once 'core/init.php';

$user = new User();

if (! $user->isLoggedIn()) {
    Redirect::to('login.php');
}

$arr_uuid = array(
    5 => "aa39adca-41c3-49ba-b5ec-7b526188fe69",
    6 => "f0138be5-751f-4153-b4b7-3603acb4b368"
);

$state = ($_GET['state'] == 'on') ? false:true;
$uuid = $arr_uuid[$_GET['uuid']];
//$uuid = "f0138be5-751f-4153-b4b7-3603acb4b368";

$zipatoServices = new MyZipatoServices(Config::get('zipato/username'), Config::get('zipato/password'));
$rData = $zipatoServices->switchTo($uuid, $state);
//$rDataPrinted = print_r($rData, true);

//$attributes = array(
//    '5' => array(
//        'current_consumption' => '2368a8fa-7b72-4f99-9bc1-5c5af08333c1',
//        'state' => 'aa39adca-41c3-49ba-b5ec-7b526188fe69',
//        //'amperes' => '6a6015df-81a6-40b1-9211-a17418796ae0',
//        //'cumulative_consumption' => '48a407a9-e84f-4942-83f1-50ba870fdd38',
//        //'power_factor' => 'ff6ab675-4bbf-49f2-a40b-4e58c79e94fe',
//        //'voltage' => '0c39bd50-00a9-4013-9d6d-e91a8f5fccfd'
//    ),
//    '6' => array(
//        'current_consumption' => 'ad2defbc-865b-4d13-84ec-746da57d96e5',
//        'state' => 'f0138be5-751f-4153-b4b7-3603acb4b368',
//        //'amperes' => '06cb4bb8-e2f2-4678-bff1-b29ed569fd31',
//        //'cumulative_consumption' => '56e66b56-30da-4bb9-9d35-fd8d16e4cf4b',
//        //'power_factor' => 'f86ef315-0417-4fc2-9be6-8655f8ab97ae',
//        //'voltage' => '0016461c-7998-44b4-b9f0-bfd46ea6a0c7'
//    )
//);
//
//$arr_attributes = array();
//$rData = $zipatoServices->autogetAttributes($attributes[$_GET['uuid']]['current_consumption']);
//$arr_attributes[$_GET['uuid']]['current_consumption'] = $rData->value->value;
//
//echo json_encode($arr_attributes);

$zipatoServices->finish();