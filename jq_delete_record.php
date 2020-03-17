<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

if (Input::exists()) {
    $id         = Input::get('id');
    $page_target= Input::get('p');

    $fields = array("id", "=", $id);

    switch ($page_target) {
        case 'state':
            $state = new State();
            $state->delete($fields);
            break;
        case 'page':
            $page = new Page();
            $page->delete($fields);
            break;
        case 'group':
            $group = new Group();
            $group->delete($fields);
            break;
        case 'setting':
            $setting = new Setting();
            $setting->delete($fields);
            break;
        case 'notif':
            $notif = new Notification();
            $notif->delete($fields);
            break;
        case 'user':
            if ($id != 1) {
                $user = new User();
                $user->delete($fields);
            }
            break;
        default:
            break;
    }
    echo 'ok';
}
