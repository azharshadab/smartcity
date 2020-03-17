<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
}

if (Input::exists()) {
    $arr_column = array(
        'as' => 'active_status',
        'sv' => 'setting_value',
        'dm' => 'display_menu',
    );

    $id         = Input::get('id');
    $action     = Input::get('act');
    $page_target= Input::get('p');
    $column     = Input::get('c');

    $fields = array($arr_column[$column] => $action);

    switch ($page_target) {
        case 'apikey':
            $api_key = new APIKey();
            $api_key->update($fields, $id);
            break;
        case 'page':
            $page = new Page();
            $page->update($fields, $id);
            break;
        case 'state':
            $state = new State();
            $state->update($fields, $id);
            break;
        case 'group':
            $group = new Group();
            $group->update($fields, $id);
            break;
        case 'notif':
            $notif = new Notification();
            $notif->update($fields, $id);
            break;
        case 'user':
            if ($id != 1) {
                $user = new User();
                $user->update($fields, $id);
            }
            break;
        case 'setting':
            $setting = new Setting();
            $setting->update($fields, $id);
            break;
        default:
            break;
    }

    echo ($action == 1) ? 0 : 1;
}