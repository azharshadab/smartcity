<?php include 'header.php'; ?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
     if (Token::check(Input::get('token'))) {
        $salt = $user->data()->salt;
        $username = $user->data()->username;
        $email = $user->data()->email;
        $phone = $user->data()->mobile_number;

        $apikey = sha1($salt + time() + $username + $email + $phone);

        $data = array(
            'apikey' => $apikey,
            'access_limit' => '0',
            'api_service_id' => '0',
            'active_status' => '1',
            'date_created' => date("Y-m-d H:i:s"),
            'created_by' => $user->data()->id
        );

        try {
            $api = new APIKey();
            $api->create($data);

            Session::put('fclass', 'success');
            Session::flash('fmsg', 'Successful!');
            Redirect::to('apikey.php');
        } catch (Exception $e) {
            $messages[] = $e->getMessage();
        }
     } else {
         $messages[] = 'invalid token';
     }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>API Keys<small>add new api key</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="groups.php">API Key</a></li>
            <li class="active">New</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <a href="apikey.php" data-toggle="tooltip" title="API Keys">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <form name="frmGroup" id="frmGroup" method="post" action="">
                <div class="box-body">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="visible-lg">
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-key fa-fw"></i>  Generate API Key</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php require 'footer.php';?>

<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $("#frmGroup").validate({-->
<!--            errorPlacement: function(error, element) {-->
<!--                // Append error within linked label-->
<!--                $( element )-->
<!--                    .closest( "form" )-->
<!--                    .find( "label[for='" + element.attr( "id" ) + "']" )-->
<!--                    .append( error ).parent('div')-->
<!--                    .addClass('has-error');-->
<!--            },-->
<!--            errorElement: "span",-->
<!--            errorClass: "text-danger",-->
<!--            validClass: "text-success",-->
<!--            rules: {-->
<!--                user_role: {-->
<!--                    required: true-->
<!--                }-->
<!--            },-->
<!--            messages: {-->
<!--                user_role: {-->
<!--                    required: " (required)"-->
<!--                }-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->

<?php
if (count($messages) > 0) {
    foreach ($messages as $message) {
        //echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
        echo "<script>$.notify(\"$message\", { position:'top center', style:'bootstrap', className:\"$messages_class\" });</script>";
    }
}
?>
