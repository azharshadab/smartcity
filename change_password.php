<?php include 'header.php'; ?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'password_current' => array (
                    'required' => true,
                    'min'      => 6,
                ),
                'password_new' => array (
                    'required' => true,
                    'min'      => 6,
                ),
                'password_confirmation' => array (
                    'required' => true,
                    'min'      => 6,
                    'matches'  => 'password_new',
                ),
            ),
        ));
        
        if ($validation->passed()) {
            if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                //$messages[] = 'Your current password is wrong';
                Session::put('fclass', 'warn');
                Session::flash('fmsg', 'Your current password is wrong!');
            } else {
                $salt = Hash::salt(32);
                try {
                    $user->update(array (
                        'password' => Hash::make(Input::get('password_new'), $salt),
                        'salt'     => $salt,
                    ));
    
                    Session::put('fclass', 'success');
                    Session::flash('fmsg', 'Your password has been changed successfully!');
                    Redirect::to('profile.php');
                } catch (Exception $e) {
                    $messages[] = $e->getMessage();
                }
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
        <h1>Change Password<small>set new password</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords($user->data()->title) . ' ' . ucwords($user->getFullName()); ?></h3>
                    </div>
                
                    <form role="form" lpformnum="1" name="frmChangePassword" id="frmChangePassword" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="password_current">Current Password</label>
                                <input type="password" name="password_current" id="password_current" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_new">New Password</label>
                                <input type="password" name="password_new" id="password_new" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>
                
                        <div class="box-footer">
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <button type="submit" class="btn btn-danger">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>

<script type="text/javascript">
    $(document).ready(function() {
        //jQueryValidator Custom Methods
        jQuery.validator.addMethod("nospace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");
        
        $("#frmChangePassword").validate({
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
                password_current: {
                    required: true,
                    nospace: true
                },
                password_new: {
                    required: true,
                    nospace: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password_new",
                    nospace: true
                }
            },
            messages: {
                password_current: {
                    required: " (required)",
                    nospace: " (no space please and don't leave it empty)"
                },
                password_new: {
                    required: " (required)",
                    nospace: " (no space please and don't leave it empty)"
                },
                password_confirmation: {
                    required: " (required)",
                    equalTo: " (password dosn't match)",
                    nospace: " (no space please and don't leave it empty)"
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