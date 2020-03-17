<?php
require_once 'core/init.php';

$user = new User();

if (! $user->isLoggedIn()) {
    Redirect::to('login.php');
}

$data = array();

if (Input::exists()) {
    $id = Input::get('id');
    $group = new Group();
    $row = $group->getGroups($id);
    $json = $row->permissions;
    $data = json_decode($json);
}

if (count($data) > 0) {
?>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Allowed Pages</th>
            <th>Not Allowed Pages</th>
        </tr>
    </thead>
    <tbody>
    <?php
//    print_r($data->pages);
    $arr_pages = (array)$data->pages;
    $arr_allowed = array();
    $arr_not_allowed = array();

    foreach ($arr_pages as $key => $value) {
        if ($value == true) {
            $arr_allowed[] = $key;
        } else {
            $arr_not_allowed[] = $key;
        }
    }
    
    $count_1 = count($arr_allowed);
    $count_2 = count($arr_not_allowed);
    $loop = ($count_1 > $count_2) ? $count_1:$count_2;
    $i = 0;
    while ($i < $loop) {
        ?>
        <tr>
            <td><?php echo $i + 1;?></td>
            <td><span class="text-success"><?php echo (isset($arr_allowed[$i])) ? $arr_allowed[$i]:'';?></span></td>
            <td><span class="text-danger"><?php echo (isset($arr_not_allowed[$i])) ? $arr_not_allowed[$i]:'';?></span></td>
        </tr>
        <?php
        $i++;
    }
    ?>
    </tbody>
</table>
<?php
} else {
    echo "No Data";
}
?>