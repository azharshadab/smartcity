<?php
header('Content-Type: application/json');

require_once 'core/init.php';

$user = new User();
if (! $user->isLoggedIn()) {
    Redirect::to('login.php');
}

$attributes = array(
    '4' => array(
        'current_consumption' => '2368a8fa-7b72-4f99-9bc1-5c5af08333c1',
        'state' => 'aa39adca-41c3-49ba-b5ec-7b526188fe69',
        //'amperes' => '6a6015df-81a6-40b1-9211-a17418796ae0',
        //'cumulative_consumption' => '48a407a9-e84f-4942-83f1-50ba870fdd38',
        //'power_factor' => 'ff6ab675-4bbf-49f2-a40b-4e58c79e94fe',
        //'voltage' => '0c39bd50-00a9-4013-9d6d-e91a8f5fccfd'
    ),
    '6' => array(
        'current_consumption' => 'ad2defbc-865b-4d13-84ec-746da57d96e5',
        'state' => 'f0138be5-751f-4153-b4b7-3603acb4b368',
        //'amperes' => '06cb4bb8-e2f2-4678-bff1-b29ed569fd31',
        //'cumulative_consumption' => '56e66b56-30da-4bb9-9d35-fd8d16e4cf4b',
        //'power_factor' => 'f86ef315-0417-4fc2-9be6-8655f8ab97ae',
        //'voltage' => '0016461c-7998-44b4-b9f0-bfd46ea6a0c7'
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

//$arr_attributes['5']['current_consumption'] = '39.2';
//$arr_attributes['5']['state'] = 'true';
//$arr_attributes['6']['current_consumption'] = '0.0';
//$arr_attributes['6']['state'] = 'false';

echo json_encode($arr_attributes);





//$zipatoServices = new MyZipatoServices(Config::get('zipato/username'), Config::get('zipato/password'));

//$rData = $zipatoServices->autogetDevices('');

// Panasonic        => 10fe774d-4800-45a6-900d-2ba69cf9bfe4
// WLE-314 Lights   => 0210491a-f50d-44ba-9d63-ecc0526baa9a
//$rData = $zipatoServices->autogetDevices('0210491a-f50d-44ba-9d63-ecc0526baa9a');

// LIGHT 1  => 20acfa4e-20dc-44f8-beaf-005821f40039
// LIGHT 2  => fe4e4e06-2417-4f4e-8cd3-17f10a31a657
//$rData = $zipatoServices->autogetEndpoints('fe4e4e06-2417-4f4e-8cd3-17f10a31a657');

// LIGHT 1 - AMPERES                    => 6a6015df-81a6-40b1-9211-a17418796ae0
// LIGHT 1 - CUMULATIVE_CONSUMPTION     => 48a407a9-e84f-4942-83f1-50ba870fdd38
// LIGHT 1 - CURRENT_CONSUMPTION        => 2368a8fa-7b72-4f99-9bc1-5c5af08333c1
// LIGHT 1 - POWER_FACTOR               => ff6ab675-4bbf-49f2-a40b-4e58c79e94fe
// LIGHT 1 - STATE                      => aa39adca-41c3-49ba-b5ec-7b526188fe69
// LIGHT 1 - VOLTAGE                    => 0c39bd50-00a9-4013-9d6d-e91a8f5fccfd
// LIGHT 2 - AMPERES                    => 06cb4bb8-e2f2-4678-bff1-b29ed569fd31
// LIGHT 2 - CUMULATIVE_CONSUMPTION     => 56e66b56-30da-4bb9-9d35-fd8d16e4cf4b
// LIGHT 2 - CURRENT_CONSUMPTION        => ad2defbc-865b-4d13-84ec-746da57d96e5
// LIGHT 2 - POWER_FACTOR               => f86ef315-0417-4fc2-9be6-8655f8ab97ae
// LIGHT 2 - STATE                      => f0138be5-751f-4153-b4b7-3603acb4b368
// LIGHT 2 - VOLTAGE                    => 0016461c-7998-44b4-b9f0-bfd46ea6a0c7

//$uuid_l5_amperes = '6a6015df-81a6-40b1-9211-a17418796ae0';
//$uuid_l5_cumulative_consumption = '48a407a9-e84f-4942-83f1-50ba870fdd38';
//$uuid_l5_current_consumption = '2368a8fa-7b72-4f99-9bc1-5c5af08333c1';
//$uuid_l5_power_factor = 'ff6ab675-4bbf-49f2-a40b-4e58c79e94fe';
//$uuid_l5_state = 'aa39adca-41c3-49ba-b5ec-7b526188fe69';
//$uuid_l5_voltage = '0c39bd50-00a9-4013-9d6d-e91a8f5fccfd';
//$uuid_l6_amperes = '06cb4bb8-e2f2-4678-bff1-b29ed569fd31';
//$uuid_l6_cumulative_consumption = '56e66b56-30da-4bb9-9d35-fd8d16e4cf4b';
//$uuid_l6_current_consumption = 'ad2defbc-865b-4d13-84ec-746da57d96e5';
//$uuid_l6_power_factor = 'f86ef315-0417-4fc2-9be6-8655f8ab97ae';
//$uuid_l6_state = 'f0138be5-751f-4153-b4b7-3603acb4b368';
//$uuid_l6_voltage = '0016461c-7998-44b4-b9f0-bfd46ea6a0c7';

//            $attributes = array(
//                '5' => array(
//                    'current_consumption' => '2368a8fa-7b72-4f99-9bc1-5c5af08333c1',
//                    'state' => 'aa39adca-41c3-49ba-b5ec-7b526188fe69',
//                    //'amperes' => '6a6015df-81a6-40b1-9211-a17418796ae0',
//                    //'cumulative_consumption' => '48a407a9-e84f-4942-83f1-50ba870fdd38',
//                    //'power_factor' => 'ff6ab675-4bbf-49f2-a40b-4e58c79e94fe',
//                    //'voltage' => '0c39bd50-00a9-4013-9d6d-e91a8f5fccfd'
//                ),
//                '6' => array(
//                    'current_consumption' => 'ad2defbc-865b-4d13-84ec-746da57d96e5',
//                    'state' => 'f0138be5-751f-4153-b4b7-3603acb4b368',
//                    //'amperes' => '06cb4bb8-e2f2-4678-bff1-b29ed569fd31',
//                    //'cumulative_consumption' => '56e66b56-30da-4bb9-9d35-fd8d16e4cf4b',
//                    //'power_factor' => 'f86ef315-0417-4fc2-9be6-8655f8ab97ae',
//                    //'voltage' => '0016461c-7998-44b4-b9f0-bfd46ea6a0c7'
//                )
//            );

//            $arr_attributes = array();
//            foreach ($attributes as $akey => $at) {
//                foreach ($at as $key => $value) {
//                    $rData = $zipatoServices->autogetAttributes($value);
//                    $arr_attributes[$akey][$key] = $rData->value->value;
//                }
//            }
//            $arr_attributes[5]['current_consumption'] = '39.2';
//            $arr_attributes[5]['state'] = 'true';
//            $arr_attributes[6]['current_consumption'] = '0.0';
//            $arr_attributes[6]['state'] = 'false';

//print_r($arr_attributes);

//$rData = $zipatoServices->switchTo($uuid, true);
//print_r($rData);
