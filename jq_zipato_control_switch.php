<?php
//header('Content-Type: application/json');
require_once 'core/init.php';

$user = new User();

if (! $user->isLoggedIn()) {
    Redirect::to('login.php');
}

$arr_uuid = array(
    'p1' => "03d32f7c-ad1d-41b3-ba85-21ac70f8b5e4",
    'p2' => "f224cfe6-e95e-464b-9903-8bc32bbb0263"
);

$state = ($_GET['state'] == 'on') ? false:true;
$uuid = $arr_uuid[$_GET['uuid']];

$zipatoServices = new MyZipatoServices(Config::get('zipato/username'), Config::get('zipato/password'));
$rData = $zipatoServices->switchTo($uuid, $state);
$zipatoServices->finish();
