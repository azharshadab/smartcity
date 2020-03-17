<?php
require_once 'core/init.php';

// for otp
require_once('functions/otphp/lib/otphp.php');

$setting = new Setting();
if (!$setting->isSettingActive('forgot_password')) {
    Redirect::to('login.php');
}

$has_errors = false;
$message = '';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
    
        $totp = new \OTPHP\TOTP('', ['digits' => 6, 'digest' => 'sha1', 'interval' => 180]);
        $reset_level = 'send_otp';
        
        if (!empty(Input::get('sms_submit'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'rules' => array (
                    'phone_number' => array(
                        'required' => true,
                        'numeric' => true,
                    ),
                ),
                'messages' => array (
                    'phone_number' => array(
                        'required' => 'Please enter your 10 digit mobile number.',
                        'numeric' => 'Mobile number should be numeric only',
                    ),
                ),
            ));

            if ($validation->passed()) {
                $user = new User();
                $phone_number = Input::get('phone_number');
                if ($user->isPhoneExist($phone_number)) {
                    
                    $otp = $totp->now();
                    
                    //$otp = mt_rand(100000, 999999);
                    // $arr_setting = ['setting_name', '=', 'otp_expire_time'];
                    // $res_setting = $setting->find($arr_setting)[0];
                    //$otp_expire_time = date("Y-m-d H:i:s", strtotime('+3 min'));
                    $otp_message = "Use $otp as RBCapp account password reset code.";
                    
//                    $data = array(
//                            'otp' => $otp,
//                            'otp_expire' => $otp_expire_time
//                    );
    
//                    $user->update($data, $user->getIdForNumber($phone_number));
                    $res_sms = $user->sendSMS($phone_number, $otp_message);
                    // $res_sms = true;
                    
                    if ($res_sms == true) {
                        // $message = $otp_expire_time . ' OTP send successfully -> ' . $otp ;
                        $message = 'OTP send successfully, please check your mobile.';
                        $reset_level = 'validate_otp';
                    } else {
                        //$message = $otp_expire_time . ' OTP send error -> ' . $otp ;
                        $message = 'SMS send failed.';
                    }
                } else {
                    $message = 'Mobile number does not exist.';
                }
            } else {
                $has_errors = true;
            }
        } else if (!empty($_POST['otp_submit']) && !empty(Input::get('phone_number'))) {
            $reset_level = 'validate_otp';
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'rules' => array (
                    'otp' => array(
                        'required' => true,
                        'numeric' => true
                    ),
                ),
                'messages' => array (
                    'otp' => array(
                        'required' => 'Please enter 6 digit OTP sends to your mobile number.',
                        'numeric' => 'OTP should be numeric only',
                    ),
                ),
            ));

            if ($validation->passed()) {
                $user = new User();
                $phone_number = Input::get('phone_number');
                $otp = Input::get('otp');
    
                if ($otp == $totp->now()) {
                //if ($user->isValidOTP($phone_number, $otp) == true) {
                    $hash_expire_time = date("Y-m-d H:i:s", strtotime('+30 min'));
                    $token = md5($phone_number . $otp . time());
                    $data = array(
                        'recover_hash' => $token,
                        'recover_hash_expire' => $hash_expire_time
                    );
    
                    $user->update($data, $user->getIdForNumber($phone_number));
                    header('Location: recover.php?hash=' . $token);
                } else {
                    $message = 'Invalid OTP or it expired';
                }
            } else {
                $has_errors = true;
            }
        }
    }
} else {
    $reset_level = 'send_otp';
    
    if (isset($_COOKIE['rbc_otp_timer'])) {
        setcookie("rbc_otp_timer", "", time() - 3600);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Ishtiyaq Husain">
<!--    <link rel="shortcut icon" href="images/pcl_logo.png" />-->
    <link rel="shortcut icon" href="dist/img/favicon.png" />
    
    <title>PhoniCloud Softech PLC</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="dist/css/custom.css" rel="stylesheet">
    
    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="bg-full">
<div class="bg-overlay"></div>
    <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-rbc">
<!--                <div class="panel-heading text-center">-->
<!--                    <h4>Recover Password</h4>-->
<!--                </div>-->
                <div class="panel-heading text-center">
                    <img src="dist/img/logo.png" width="150px" />
                </div>
                <div class="panel-body">
                    <?php
                    if ($message != '') {
                        echo "<div class=\"alert alert-danger\" role=\"alert\">" . $message . "</div>";
                    }

                    if ($has_errors) {
                        foreach ($validation->errors() as $error) {
                            echo '<p class="text-danger"> - '.ucfirst($error).'</p>';
                        }
                    }
                    ?>
                    
                    <?php //if (!empty($_POST['sms_submit']) && !empty(Input::get('phone_number'))) { ?>
                    <?php if (isset($reset_level) && $reset_level == 'validate_otp') { ?>
                    
                    <form name="frmCheckOTP" role="form" action="" method="post">
                        <div class="form-group">
                            <label for="otp">OTP:</label>
                            <input class="form-control" placeholder="Enter 6 digit OTP" name="otp" id="otp" type="text" autocomplete="off" autofocus required>
                            <span class="resendOTP">
                                <a href="#" id="resendOTP">resend otp</a>
                            </span>
                            <span class="help-block pull-right" id="countdown"></span>
                        </div>
                        <br/>
                        <div class="form-group pull-right">
                            <a class="btn btn-default" href="login.php"><i class="fa fa-sign-in fa-fw"></i> Login</a>
                            <button type="submit" name="otp_submit" value="Submit" class="btn btn-danger"><i class="fa fa-commenting fa-fw"></i> Submit</button>
                        </div>
                        <input type="hidden" id="phone_number" name="phone_number" value="<?php echo Input::get('phone_number'); ?>">
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    </form>
                        
                    <?php } else { ?>
                    
                    <form name="frmSendOTP" role="form" action="" method="post">
                        <div class="form-group">
                            <label for="phone_number">Mobile Number:</label>
                            <input class="form-control" placeholder="Mobile Number" name="phone_number" id="phone_number" type="text" autocomplete="off" autofocus required>
                        </div>
                        <br/>
                        <div class="form-group pull-right">
                            <a class="btn btn-default" href="login.php"><i class="fa fa-sign-in fa-fw"></i> Login</a>
                            <input type="submit" name="sms_submit" value="Send OTP" class="btn btn-danger">
                        </div>
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    </form>

                    <?php } ?>
                </div>
                <div class="panel-footer">
                    <p>
                        <a href="http://rbcapp.com/privacy" target="_blank">Privacy</a> |
                        <a href="http://rbcapp.com/terms" target="_blank">Terms</a> |
                        <a href="http://rbcapp.com/disclaimer" target="_blank">Disclaimer</a>
                    </p>
                    <p class="text-muted">
                        &copy; <?php echo date("Y");?> PhoniCloud Softech PLC
                        <span class="pull-right"><em>beta v1.1.0</em></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php //} ?>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery-1.12.3.js"></script> -->

<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script> -->

<!-- Metis Menu Plugin JavaScript -->
<!-- <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script> -->

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- jQuery Validation JavaScript -->
<!--<script src="dist/js/jquery.validate.js"></script>-->

<!-- Custom User JavaScript -->
<script src="dist/js/custom.js"></script>

<?php if (isset($reset_level) && $reset_level == 'validate_otp') { ?>
<script>
    $(document).ready(function () {
        $('#resendOTP').click(function () {
            let data = 'p=' + $('#phone_number').val();
            //alert(data);
            $.ajax({
                type: "POST",
                url: "jq_resend_otp.php",
                data: data,
                success: function (data) {
                    if (data == 'ok') {
                        $('#resendOTP').remove();
                        $('.resendOTP').html('otp send.');
                    } else {
                        $('#resendOTP').remove();
                        $('.resendOTP').html('Error! please try after sometime.');
                    }
                }
            });
        });
    });
    
    function setCookie(cname,cvalue,exdays)
    {
        var d = new Date();
        d.setTime(d.getTime()+(exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }
    function getCookie(cname)
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++)
        {
            var c = ca[i].trim();
            if (c.indexOf(name)==0) return c.substring(name.length,c.length);
        }
        return "";
    }

    // check existing cookie
    cook = getCookie("rbc_otp_timer");

    if (cook == "") {
        // cookie not found, so set seconds=180
        var seconds = 180;
    } else {
        seconds = cook;
        console.log(cook);
    }

    function secondPassed() {
        var minutes = Math.round((seconds - 30)/60);
        var remainingSeconds = seconds % 60;
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds;
        }
        //store seconds to cookie
        setCookie("rbc_otp_timer", seconds, 5); //here 5 is expiry days
        document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
        if (seconds == 0) {
            clearInterval(countdownTimer);
            document.getElementById('countdown').innerHTML = "otp expired, generate new otp";
        } else {
            seconds--;
        }
    }
    var countdownTimer = setInterval(secondPassed, 1000);
</script>
<?php } ?>

</body>

</html>