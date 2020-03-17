<?php
require_once 'core/init.php';

$setting = new Setting();
$meter_phase = new meter_phase();
$test=$meter_phase->getMeterPhase();

//print_r($test);

if ($setting->isSettingActive('site_maintenance') == true) {
    Redirect::to('site_maintenance.php');
    
    // todo allow admin ip address to access the site
}

$messages = array();
$messages_class = 'warn';

if (Session::exists(Config::get('session/session_name')) == true) {
    header('location: dashboard.php');
    exit();
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'username' => array (
                    'required' => true,
                ),
                'password' => array (
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
            
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login($username, Input::get('password'), $field, $remember);
            
            if ($login) {
                $data = array ('date_last_active' => date("Y-m-d H:i:s"));
                try {
                    $user->update($data, $user->data()->id);
                } catch (Exception $e) {
                    echo $e;
                }

               Redirect::to('consumer.php');

/*
                if($test == "Single Phase"){
                Redirect::to('three_phase_consumer.php');
            }
            else
            {
                Redirect::to('consumer.php');
            }

*/
            }


             else {
                $messages[] = "Sorry! logging failed. This incident will be reported.";
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
    <title><?php echo Config::get('app/name');?> | Log in</title>
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
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo Config::get('app/base_url');?>"><b>Smart</b>City</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form name="frmLogin" id="frmLogin" action="" method="post">
                <div class="form-group has-feedback">
                    <label for="username">Username</label>
                    <input name="username" id="username" type="text" class="form-control" placeholder="Username, phone or email">
                    <span class="fa fa-user-circle-o form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                    <span class="fa fa-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <?php if ($setting->isSettingActive('remember')) { ?>
                                <label><input name="remember" id="remember" type="checkbox"> Remember Me</label>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            </form>
            <?php if ($setting->isSettingActive('forgot_password')) { ?>
                <a href="begin_password_reset.php">I forgot my password</a><br>
            <?php } ?>
        </div>
    </div>
    
    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery -->
    <!--	<script src="assets/js/jquery-3.1.1.min.js"></script>-->
    <!--    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
    
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>

    <!-- https://notifyjs.com/ -->
	<script src="plugins/notify/notify.min.js"></script>
    <!-- <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>-->

    <!-- jQuery Validation JavaScript -->
    <script src="plugins/jqvalidate/jquery.validate.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            //jQueryValidator Custom Methods
            jQuery.validator.addMethod("nospace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "No space please and don't leave it empty");

            jQuery.validator.addMethod("digitsonly", function(value, element) {
                return this.optional(element) || /^[0-9]+$/i.test(value);
            }, "Digits only please");

            jQuery.validator.addMethod("mobileonly", function(value, element) {
                return this.optional(element) || /^[7-9]{1}[0-9]{9}$/i.test(value);
            }, "10 digit mobile number only please");
            
            $("#frmLogin").validate({
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
                    },
                    password: {
                        required: true,
                        nospace: true,
                    }
                },
                messages: {
                    username: {
                        required: " (required)",
                        nospace: " (no space please and don't leave it empty)",
                    },
                    password: {
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
