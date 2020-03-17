<?php include 'header.php'; ?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'rules' => array (
                'message' => array (
                    'required' => true,
                ),
                'message_for' => array (
                    'required' => true,
                ),
            ),
        ));

        if ($validation->passed()) {
            $message_for = Input::get('message_for');

            try {
                $notification = new Notification();

                if ($message_for == 'all') {
                    $rows = $user->getAllUsers();
                    foreach ($rows as $row) {
                        $data = array(
                            'message' => Input::get('message'),
                            'message_type' => Input::get('message_type'),
                            'unread' => '1',
                            'message_for' => $row->id,
                            'date_created' => date("Y-m-d H:i:s"),
                            'created_by' => $user->data()->id,
                        );

                        $notification->create($data);
                    }
                } elseif (substr($message_for, 0, 1) == 'G') {
                    $rows = $user->getUserWhere(['group_id', '=', '1']);
                    foreach ($rows as $row) {
                        $data = array(
                            'message' => Input::get('message'),
                            'message_type' => Input::get('message_type'),
                            'unread' => '1',
                            'message_for' => $row->id,
                            'date_created' => date("Y-m-d H:i:s"),
                            'created_by' => $user->data()->id,
                        );

                        $notification->create($data);
                    }
                } else {
                    $data = array(
                        'message' => Input::get('message'),
                        'message_type' => Input::get('message_type'),
                        'unread' => '1',
                        'message_for' => $user->getIdForNumber(Input::get('message_for')),
                        'date_created' => date("Y-m-d H:i:s"),
                        'created_by' => $user->data()->id,
                    );

                    $notification->create($data);
                }

                Session::put('fclass', 'success');
                Session::flash('fmsg', 'Successful!');
                Redirect::to('notifications.php');
            } catch (Exception $e) {
                $messages[] = $e->getMessage();
            }
        } else {
            $messages_class = 'danger';
            $messages = $validation->errors();
        }
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Push Notification<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Push Notification</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <a href="notifications.php" data-toggle="tooltip" title="Groups">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="box-body">
                        <form name="frmNotification" id="frmNotification" method="post" action="">
                            <div class="col-lg-6">
                                <div class="well">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="message_for">Message For</label>
                                        <input name="message_for" id="message_for" class="form-control" maxlength="10" readonly>
                                    </div>
            <!--                        <div class="form-group">-->
            <!--                            <div class="checkbox">-->
            <!--                                <label><input name="send_all" id="send_all" type="checkbox" value="all">Send to all</label>-->
            <!--                            </div>-->
            <!--                        </div>-->
                                    <div class="form-group">
                                    <?php
                                        $group = new Group();
                                        $rows = $group->getGroups();
                                    ?>
                                        <label for="group">Send to*</label>
                                        <select name="group" id="group" class="form-control">
                                            <option value="">-- Select Group --</option>
                                            <option value="all">0 - Send to all</option>
                                    <?php
                                        foreach ($rows as $row) {
                                            echo $row->user_role;
                                    ?>
                                            <option value="G<?php echo $row->id;?>"><?php echo $row->id . ' - ' . $row->user_role;?></option>
                                    <?php
                                        }
                                    ?>
                                        </select>
                                        <span id="helpBlock" class="help-block">
                                            if you want to send messages to a group or all users, please select the option.
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="message_type">Message Type</label>
                                        <select name="message_type" id="message_type" class="form-control">
                                            <option value="message">General Message</option>
                                            <option value="info">Information</option>
                                            <option value="alert">Alert Message</option>
                                            <option value="warning">Warning Message</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.well -->
                                <div class="form-group">
                                    <span class="pull-right visible-lg">
                                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save fa-fw"></i>  Send</button>
                                    </span>
                                    <span class="visible-sm visible-md visible-xs">
                                        <button type="submit" class="btn btn-lg btn-block btn-danger"><i class="fa fa-save fa-fw"></i> Send</button>
                                        <hr/>
                                    </span>
                                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                </div>
                            </div>
                        </form>

                        <div class="col-lg-6">
                            <?php
                                $rows = $user->getAllUsers();
                            ?>
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-list-doc">
                                    <thead>
                                    <tr>
                                        <th>Phone Number</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($rows as $r) {
                                            ?>
                                            <tr>
                                                <td><?php echo $r->mobile_number;?></td>
                                                <td><?php echo ucwords($r->first_name . ' ' . $r->middle_name . ' ' . $r->last_name);?></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#group').change(function() {
            $('#message_for').val($(this).val());
        });

        $('#dataTables-list-doc').DataTable({
            responsive: true,
            searching: true,
            bSort: false
        });

        var table = $('#dataTables-list-doc').DataTable();
        $('#dataTables-list-doc tbody').on( 'click', 'td', function () {
            var data = table.cell(this).data();
            //alert(data);
            if ($.isNumeric(data)) {
                $('#message_for').val(data);
            }
        });


        $("#frmNotification").validate({
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
                message: {
                    required: true,
                },
                message_for: {
                    required: true,
                },
            },
            messages: {
                message: {
                    required: " (required)",
                },
                message_for: {
                    required: " (required)",
                },
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