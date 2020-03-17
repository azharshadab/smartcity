<?php require 'header.php';?>

<?php

$device = new Device();

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array (
        'rules' => array (
            'title' => array (
                'required' => true,
            ),
            'message' => array (
                'required' => true,
            ),
            'push_type' => array(
                'required' => true,
            ),
        ),
    ));

    if ($validation->passed()) {
        $title = Input::get('title');
        $message = Input::get('message');
        $push_type = Input::get('push_type');
        $include_image = Input::get('include_image');

        $firebase = new Firebase();
        $push = new Push();

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        // $title = isset($_GET['title']) ? $_GET['title'] : '';
        $title = isset($title) ? $title : '';

        // notification message
        // $message = isset($_GET['message']) ? $_GET['message'] : '';
        $message = isset($message) ? $message : '';

        // push type - single user / topic
        // $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';
        $push_type = isset($push_type) ? $push_type : '';

        // whether to include to image or not
        // $include_image = isset($_GET['include_image']) ? TRUE : FALSE;
        $include_image = isset($include_image) ? true : false;

        $push->setTitle($title);
        $push->setMessage($message);

        if ($include_image) {
            $push->setImage('http://ishtiyaq.com/__resources/minion.jpg');
        } else {
            $push->setImage('');
        }

        $push->setIsBackground(false);
        $push->setPayload($payload);

        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();

            $reg_id = Input::get('regId');
            $regId = isset($reg_id) ? $reg_id : '';

            //echo 'regId: '.$reg_id;

            // $sql = "SELECT * FROM devices WHERE id = $regId";
            // $d1 = $db->getQuery($sql);
            // $regId = $d1[0]['token'];
            //$regId = '';

            $response = $firebase->send($regId, $json);

            //print_r($json);

            $arr_response = json_decode($response);

            if ($arr_response->failure == 1) {
                $messages_class = 'danger';
                $messages[] = 'error';
                //$messages = $arr_response;
            } else {
                $messages_class = 'success';
                $messages[] = 'send';
            }
        }
    } else {
        $messages_class = 'danger';
        $messages = $validation->errors();
    }
}
?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Android Notification<small>send notification</small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Firebase</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Send to Single Device</h3>
                        </div>
                        <div class="box-body">
                            <?php
                            $devices = $device->find(['1','=','1']);
                            ?>
                            <form method="post" name="frmSingle" id="frmSingle">
                                <div class="form-group">
                                    <label for="regId">Users</label>
                                    <select id="regId" name="regId" class="form-control">
                                        <option value="0"> -- Select User -- </option>
                                        <?php
                                        foreach ($devices as $d) {
                                            $u = $user->searchData($d->user_id,'id');
                                            // print_r($user->data());
                                            ?>
                                            <option value="<?php echo $d->token;?>"><?php echo $u->mobile_number . ' - ' . ucwords($u->first_name . ' ' . $u->middle_name . '' . $u->last_name);?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" rows="5" name="message" id="message" placeholder="Notification message!"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="include_image" class="">
                                        <input name="include_image" id="include_image" type="checkbox"> Include image
                                    </label>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="push_type" value="individual"/>
                                    <button type="submit" class="btn btn-danger">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Send to Topic `global`</h3>
                        </div>
                        <div class="box-body">
                            <form method="get" name="frmGlobal" id="frmGlobal">
                                <div class="form-group">
                                    <label for="title1">Title</label>
                                    <input type="text" id="title1" name="title" class="form-control" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label for="message1">Message</label>
                                    <textarea class="form-control" name="message" id="message1" rows="5" placeholder="Notification message!"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="include_image1" class="pure-checkbox">
                                        <input id="include_image1" name="include_image" type="checkbox"> Include image
                                    </label>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="push_type" value="topic"/>
                                    <button type="submit" class="btn btn-danger">Send to Topic</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php require 'footer.php';?>

<script>
    $(document).ready(function() {
        $("#frmSingle").validate({
            errorPlacement: function(error, element) {
                // Append error within linked label
                $( element )
                    .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                    .append( error ).parent('div')
                    .addClass('has-error');
            },
            errorElement: "span",
            errorClass: "text-danger",
            validClass: "text-success",
            rules: {
                title: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: " (required)"
                },
                message: {
                    required: " (required)"
                }
            }
        });

        $("#frmGlobal").validate({
            errorPlacement: function(error, element) {
                // Append error within linked label
                $( element )
                    .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                    .append( error ).parent('div')
                    .addClass('has-error');
            },
            errorElement: "span",
            errorClass: "text-danger",
            validClass: "text-success",
            rules: {
                title: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: " (required)"
                },
                message: {
                    required: " (required)"
                }
            }
        });
    });
</script>

<?php
if (count($messages) > 0) {
    foreach ($messages as $message) {
        //echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
        echo "<script>$.notify(\"$message\", { position:'top center', style:'bootstrap', className:\"$messages_class\" });</script>";
    }
}
?>