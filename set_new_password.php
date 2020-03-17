<?php
require_once 'core/init.php';

$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'password' => array (
                    'required' => true,
                    'min'      => 6,
                ),
                'confirm_password' => array (
                    'required' => true,
                    'min'      => 6,
                    'matches'  => 'password',
                ),
            ),
        ));
        
        if ($validation->passed()) {
            if (Session::exists('user_data')) {
                $user_data = Session::get('user_data');
                $user = new User();
                $salt = Hash::salt(32);
                try {
                    $user->update(array (
                          'password' => Hash::make(Input::get('password'), $salt),
                          'salt'     => $salt,
                      ), $user_data->id);
        
                    Session::put('password_reset', true);
                } catch (Exception $e) {
                    $messages[] = $e->getMessage();
                }
            } else {
                Redirect::to('begin_password_reset.php');
            }
        } else {
            $messages_class = 'danger';
            $messages = $validation->errors();
        }
    } else {
        $messages[] = 'invalid token';
    }
}

if (Session::exists('reset_data')) {
    $reset_data = Session::get('reset_data');
    $time_diff = time() - $reset_data['check_time'];
    if ($reset_data['otp_verified'] != true && $time_diff > Config::get('reset/time')) {
        Session::delete('user_data');
        Session::delete('reset_data');
        Redirect::to('begin_password_reset.php');
    }
} else {
    Session::delete('user_data');
    Redirect::to('begin_password_reset.php');
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
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    
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
    <div class="login-box reset-box">
        <div class="login-logo">
            <a href="<?php echo Config::get('app/base_url');?>"><b>Smart</b>City</a>
        </div>
        <?php
        if (Session::exists('password_reset') && Session::get('password_reset') == true) {
            ?>
            <div class="login-box-body">
                <p class="login-box-msg">Reset Password</p>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="lead">
                           Your password has been changed successfully!
                            <a href="login.php">Click here</a> to login with new password.
                        </p>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="login-box-body">
                <p class="login-box-msg">Reset Password</p>
                <form name="frmSetPassword" id="frmSetPassword" action="#" method="post">
                    <div class="form-group has-feedback">
                        <label for="password">New Password</label>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter new password">
                        <span class="fa fa-user-circle-o form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="confirm_password">Confirm Password</label>
                        <input name="confirm_password" id="confirm_password" type="password" class="form-control" placeholder="Confirm new password">
                        <span class="fa fa-user-circle-o form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Update Password</button>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </form>
            </div>
            <?php
        }
        ?>
    </div>

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

            $("#frmSetPassword").validate({
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
                    password: {
                        required: true,
                        nospace: true,
                    },
                    confirm_password: {
                        required: true,
                        nospace: true,
                    }
                },
                messages: {
                    password: {
                        required: " (required)",
                        nospace: " (no space please and don't leave it empty)",
                    },
                    confirm_password: {
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
</body>
</html>
