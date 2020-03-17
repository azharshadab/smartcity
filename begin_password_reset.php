<?php
require_once 'core/init.php';

$messages = array();
$messages_class = 'warn';

// delete session to prevent accidental hacking
if (Session::exists('user_data')) {
    Session::delete('user_data');
}
if (Session::exists('password_reset')) {
    Session::delete('password_reset');
}
if (Session::exists('reset_data')) {
    Session::delete('reset_data');
}
if (Session::exists('otp_data')) {
    Session::delete('otp_data');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'username' => array (
                    'required' => true,
                ),
            ),
        ));
    
        if ($validation->passed()) {
            $user = new User();
            $username = Input::get('username');
    
            if (is_numeric($username) && strlen($username) == 10) {
                $field = 'mobile_number';
            } else {
                if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                    $field = 'email';
                } else {
                    $field = 'username';
                }
            }
            
            $user_data = $user->searchData($username, $field);
            
            if ($user_data) {
                Session::put('user_data', $user_data);
                Redirect::to('send_password_reset.php');
            } else {
                $messages[] = "Sorry! User dosn't exists.";
            }
        } else {
            $messages_class = 'danger';
            $messages = $validation->errors();
        }
    } else {
        $messages[] = 'invalid token';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SmartCity | Reset Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="dist/css/custom.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo Config::get('app/base_url');?>"><b>Smart</b>City</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Search your account</p>
            <form name="frmReset" id="frmReset" action="" method="post">
                <div class="form-group has-feedback">
                    <label for="username">Username</label>
                    <input name="username" id="username" type="text" class="form-control" placeholder="Username, phone or email">
                    <span class="fa fa-user-circle-o form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div>
<!--                    <div class="col-xs-4">-->
<!--                        <a href="login.php" class="btn btn-default btn-block btn-flat">Login</a>-->
<!--                    </div>-->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Find User</button>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    
    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- https://notifyjs.com/ -->
	<script src="plugins/notify/notify.min.js"></script>
    <!-- <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>-->
    <!-- jQuery Validation JavaScript -->
    <script src="plugins/jqvalidate/jquery.validate.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>-->
    
    <script type="text/javascript">
        $(document).ready(function() {
            //jQueryValidator Custom Methods
            jQuery.validator.addMethod("nospace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "No space please and don't leave it empty");

            $("#frmReset").validate({
                errorPlacement: function(error, element) {
                    // append error within linked label
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
                    username: {
                        required: true,
                        nospace: true,
                    }
                },
                messages: {
                    username: {
                        required: " (required)",
                        nospace: " (no space please and don't leave it empty)",
                    }
                }
            });
        });
    </script>

    <?php
    if (count($messages) > 0) {
        foreach ($messages as $message) {
            echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
        }
    }
    ?>

    <?php
    if (Session::exists('fmsg')) {
        $flash_message = Session::flash('fmsg');
        $flash_class =  (Session::exists('fclass')) ? Session::flash('fclass') : 'success';
        echo "<script>$.notify(\"$flash_message\", { position:'top center', style:'bootstrap', className:\"$flash_class\" });</script>";
    }
    ?>
</body>
</html>
