<?php
require_once 'core/init.php';

/* create new user instance */
$user = new User();

/* check if user is logged in */
if (!$user->isLoggedIn()) {
    /* if user is not loggedin, redirect to login page */
    Redirect::to('login.php');
}

$api = new APIKey();
$user = new User();

$history = $api->getAccessHistory();

// api_access_history

if ($history) {
    $reutrn = array();
    $ser = array(
        '1' => 'mdm',
    );


    foreach ($history as $h) {
        $reutrn[$h->y][$ser[$h->api_service_id]] = $h->a;
        $reutrn[$h->y]['y'] = $h->y;
    }

    foreach ($reutrn as $r) {
        foreach ($ser as $key) {
            if (!array_key_exists($key, $r)) {
                $r[$key] = 0;
                //array_push($r, 0);
            }
        }

        $x[] = $r;
    }

    header('Content-Type: application/json');
    echo json_encode($x);

} else {
    //$x['msg'] = 'none';
    echo 'nok';
    //echo "[{'way2sms':0,'pnr':0,'dnd':0,'mailer':0}]";
}
