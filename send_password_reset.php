<?php
require_once 'core/init.php';

$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        if (!empty(Input::get('sms_submit'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array (
                'rules' => array (
                    'recover_option' => array (
                        'required' => true,
                    ),
                ),
            ));
    
            if ($validation->passed()) {
                $recover_option = Input::get('recover_option');
                $user_data = Session::get('user_data');
                $mobile_number = $user_data->mobile_number;
                $email = $user_data->email;
                
                $otp = generateOtp(Config::get('otp/length'));
                $otp_time = time();
                
                $otp_data = array(
                    'otp' => $otp,
                    'otp_time' => $otp_time,
                    'otp_number' => $mobile_number,
                    'otp_email' => $email
                );
                Session::put('otp_data', $otp_data);
        
                if ($recover_option == 'mobile') {
                    // send sms
                    // $otp_message = "Your verification code is {$otp}";
                    // OTP for Aadhaar (XXXX7455) is 691899 and is valid for 30 minutes. (Generated at 2017-01-21 6:7:43)
                    $otp_message = $otp." is your OTP for SmartCity and is valid for " . intval(Config::get('otp/life_in_sec') / 60) . " minutes. (Generated at " . date("d-m-Y H:i:s", $otp_time) . ")";
                    
                    $message = new Message();
                    if ($message->sendSMS($mobile_number, $otp_message)) {
                        $messages_class = 'success';
                        $messages[] = 'Please check your mobile for OTP.';
                    } else {
                        Session::put('fclass', 'error');
                        Session::put('fmsg', 'We are unable to send SMS, Please try after sometime.');
                        Session::delete('otp_data');
                        Redirect::to('send_password_reset.php');
                    }
                } else if ($recover_option == 'email') {
                    $first_name = $user_data->first_name;
                    $middle_name = $user_data->middle_name;
                    $last_name = $user_data->last_name;
                    $name = urlencode(ucwords($first_name.' '.$middle_name.' '.$last_name));
                    $subject = 'Password Recovery';
                    // $body = "Your verification code is <h3>{$otp}</h3>";
                    $body = "<strong>".$otp."</strong> is your OTP for SmartCity and is valid for " . intval(Config::get('otp/life_in_sec') / 60) . " minutes. (Generated at " . date("d-m-Y H:i:s", $otp_time) . ")";
                    
                    $message = new Message();
                    $mail_status = $message->sendMail($name, $email, $subject, $body);
                    if ($mail_status) {
                        $messages_class = 'success';
                        $messages[] = 'Please check your mail for OTP.';
                    } else {
                        Session::put('fclass', 'error');
                        Session::put('fmsg', 'We are unable to send email, Please try after sometime.');
                        Session::delete('otp_data');
                        Redirect::to('send_password_reset.php');
                    }
                } else {
                    Session::put('fclass', 'error');
                    Session::put('fmsg', 'Error');
                    Session::delete('otp_data');
                    Redirect::to('begin_password_reset.php');
                }
            } else {
                $messages_class = 'danger';
                $messages = $validation->errors();
            }
        }
        
        if (!empty(Input::get('otp_submit'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array (
                'rules' => array (
                    'otp' => array (
                        'required' => true,
                        'numeric' => true,
                    ),
                ),
                'messages' => array (
                    'otp' => array(
                        'required' => 'Please enter '.Config::get('otp/length').' digit OTP sends to your mobile number.',
                        'numeric' => 'OTP should be numeric only',
                    ),
                ),
            ));
    
            if ($validation->passed()) {
                $otp_data = Session::get('otp_data');
                $time_diff = time() - $otp_data['otp_time'];
                
                $otp = Input::get('otp');
                
                if ($time_diff < Config::get('otp/life_in_sec')) {
                    if ($otp == $otp_data['otp']) {
                        Session::put('reset_data', array('otp_verified' => true, 'check_time' => time()));
                        Session::delete('otp_data');
                        Redirect::to('set_new_password.php');
                    } else {
                        $messages_class = 'danger';
                        $messages[] = 'The OTP that you submitted is not valid. Please submit a valid OTP.';
                    }
                } else {
                    $messages_class = 'danger';
                    $messages[] = 'The OTP is submitted after the OTP has expired. Please generate another OTP, and submit it before it expires.';
                    Session::delete('user_data');
                    Session::delete('otp_data');
                }
            } else {
                $messages_class = 'danger';
                $messages = $validation->errors();
            }
        }
    } else {
        $messages[] = 'invalid token';
    }
}

if (Session::exists('user_data')) {
    $user_data = Session::get('user_data');
} else {
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
        if (Session::exists('otp_data')) {
        ?>
            <div class="login-box-body">
                <p class="login-box-msg">OTP Verification</p>
                <form name="frmOtp" id="frmOtp" action="" method="post">
                    <div class="form-group has-feedback">
                        <label for="otp">OTP</label>
                        <input name="otp" id="otp" type="text" class="form-control" autocomplete="off" autofocus>
                        <span class="fa fa-user-circle-o form-control-feedback"></span>
                        <span class="help-block">Please enter <?php echo Config::get('otp/length');?> digit OTP sends to your mobile number.</span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" name="otp_submit" value="Submit" class="btn btn-primary btn-block btn-flat">Continue</button>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </form>
            </div>
        <?php
        } else {
        ?>
            <div class="login-box-body">
                <p class="login-box-msg">How do you want to reset your password?</p>
                <form name="frmReset" id="frmReset" action="" method="post">
                    <div class="form-group has-feedback">
                        <?php
                        $profile_pic = Config::get('app/profile_url') . "/" . $user_data->avatar;
                        if (!file_exists($profile_pic)) {
                            $profile_pic = Config::get('app/profile_url') . "/no_avatar.jpg";
                        }
                        ?>
                        <img class="img-rounded" src="<?php echo $profile_pic;?>" width="50px">
                        <?php echo ucwords($user_data->first_name.' '.$user_data->middle_name.' '.$user_data->last_name);?>
                    </div>
                    <div class="form-group has-feedback">
                        We found the following information associated with your account
                        <?php
                        if ($user_data->email != '') {
                            ?>
                            <div class="checkbox">
                            <label><input name="recover_option" value="email" type="radio" checked> Email a link to <?php echo maskEmail($user_data->email);?></label>
                        </div>
                        <?php
                        }
                        if ($user_data->mobile_number != '') {
                        ?>
                        <div class="checkbox">
                            <label><input name="recover_option" value="mobile" type="radio"> Text a code to my phone <?php echo maskNumber($user_data->mobile_number);?></label>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <a href="#" data-toggle="modal" data-target="#myModal">I don't have access to any of these</a>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="sms_submit" value="Submit" class="btn btn-primary btn-block btn-flat">Continue</button>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </form>
            </div>
        <?php } ?>
    </div>
    <!-- /.login-box -->
    
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Contact Us</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Please contact SmartCity team.
                        <address>
                            <strong>ADVANCED POWER SYSTEM LAB</strong><br>
                            Room # 105B , ACES Building<br>
                            Department of Electrical Engineering<br>
                            Indian Institute of Technology Kanpur<br>
                            Kanpur - 208016<br>
                            <abbr title="Phone">P:</abbr> (+91) 512-259-6936<br>
                            <abbr title="Email">E:</abbr> smartcityiitk[at]yahoo.com
                        </address>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

            $("#frmOtp").validate({
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
                    otp: {
                        required: true,
                        nospace: true,
                    }
                },
                messages: {
                    otp: {
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
