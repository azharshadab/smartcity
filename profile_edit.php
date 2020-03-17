<?php require 'header.php';?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'rules' => array (
                'email' => array (
                    'required' => true,
                ),
                'mobile_number' => array (
                    'required' => true,
                    'numeric' => true,
                    'min' => 10,
                    'max' => 10,
                ),
                'username' => array (
                    'required' => true,
                ),
            ),
        ));
        
        if ($validation->passed()) {
            $avatar = null;
            // $filename = 'no_avatar.jpg';

            if (!empty($_FILES["profile_pic"]["tmp_name"])) {
                $target_dir = Config::get('app/profile_path');
                $target_file = $target_dir . '/' . basename($_FILES["profile_pic"]["name"]);
                $image_file_type = pathinfo($target_file, PATHINFO_EXTENSION);
                $filename = getUniqueFileName('PP') . '.' . $image_file_type;
                $target_file = $target_dir . '/' . $filename;
                
                $upload_ok = 1;
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
                if ($check !== false) {
                    //$messages[] = "File is an image - " . $check["mime"] . ".";
                    $upload_ok = 1;
                } else {
                    $messages[] = "File is not an image.";
                    $upload_ok = 0;
                }
                
                // Check if file already exists
                //if (file_exists($target_file)) {
                //$messages[] = "Sorry, file already exists.";
                //$upload_ok = 0;
                //}
                
                // Check file size
                if ($_FILES["profile_pic"]["size"] > 500000) {
                    $messages[] = "Sorry, your file is too large.";
                    $upload_ok = 0;
                }
                
                // Allow certain file formats
                if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
                    $messages[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $upload_ok = 0;
                }
                
                // Check if $upload_ok is set to 0 by an error
                if ($upload_ok == 0) {
                    $messages[] = "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                        //$messages[] = "The file ". basename( $_FILES["profile_pic"]["name"]). " has been uploaded.";
                        $avatar = $filename;
                    } else {
                        $messages[] = "Sorry, there was an error uploading your file." . $target_file;
                    }
                }
            }
            
            $data = array (
                'title'             => Input::get('title'),
                'first_name'        => Input::get('first_name'),
                'middle_name'       => Input::get('middle_name', true),
                'last_name'         => Input::get('last_name'),
                'address'           => Input::get('address', true),
                'city'              => Input::get('city', true),
                'state'             => Input::get('state', true),
                'pincode'           => Input::get('pincode', true)
            );

            $data_meta = array(
                'consumer_id' => Input::get('consumer_id'),
                'account_id' => Input::get('account_id'),
                'rr_number' => Input::get('rr_number'),
                'service_point_id' => Input::get('service_point_id'),
                'service_date' => Input::get('service_date'),
                'service_point_meter_type_name' => Input::get('service_point_meter_type_name'),
                'consumer_pv_type' => Input::get('consumer_pv_type'),
                'nature_of_business' => Input::get('nature_of_business'),
                'payment_contract_name' => Input::get('payment_contract_name'),
                'connection_category_name' => Input::get('connection_category_name'),
                'billing_cycle' => Input::get('billing_cycle'),
                'billing_day' => Input::get('billing_day'),
                'bill_payable_day' => Input::get('bill_payable_day'),
                'sanctioned_load_kw' => Input::get('sanctioned_load_kw'),
                'connected_load_kw' => Input::get('connected_load_kw')
            );

            if ($avatar !== null) {
                $data['avatar'] = $avatar;
            }

            try {
                $user = new User();
                $user->update($data, $user->data()->id);
                
                Session::put('fclass', 'success');
                Session::flash('fmsg', 'Updated!');
                Redirect::to('profile.php');
            } catch (Exception $e) {
                $messages = $e->getMessage();
            }
        }
        else {
            $messages_class = 'danger';
            $messages = $validation->errors();
        }
    }
}

//$user_meta = $user->findUserMeta($user->data()->id);
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Profile Edit<small>edit profile data</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
        
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo ucwords($user->data()->title) . ' ' . ucwords($user->getFullName()); ?>
                </h3>
                <div class="box-tools pull-right">
                    <a href="profile.php" data-toggle="tooltip" title="Profile">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <form role="form" lpformnum="1" name="frmProfile" id="frmProfile" method="post" action="" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <?php
                                $profile_pic = Config::get('app/profile_url') . '/' . $user->data()->avatar;
                                if (!file_exists($profile_pic)) {
                                    $profile_pic = Config::get('app/profile_url') . '/no_avatar.jpg';
                                }
                                ?>
                                <div class="text-center">
                                    <img id="uploadPreview" alt="User Pic" src="<?php echo $profile_pic; ?>" class="img-thumbnail img-responsive" width="150px">
                                    <h6>Upload a different photo...</h6>
                                    <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <select name="title" id="title" class="form-control">
                                    <option value="Mr." <?php if ($user->data()->title == 'Mr.') { echo "selected";}?>>Mr.</option>
                                    <option value="Mrs." <?php if ($user->data()->title == 'Mrs.') { echo "selected";}?>>Mrs.</option>
                                    <option value="Dr." <?php if ($user->data()->title == 'Dr.') { echo "selected";}?>>Dr.</option>
                                     <option value="Prof." <?php if ($user->data()->title == 'Mrs.') { echo "selected";}?>>Prof.</option>
                                    <option value="Miss." <?php if ($user->data()->title == 'Dr.') { echo "selected";}?>>Miss.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input name="first_name" id="first_name" type="text" class="form-control" value="<?php echo $user->data()->first_name;?>"/>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input name="middle_name" id="middle_name" type="text" class="form-control" value="<?php echo $user->data()->middle_name;?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input name="last_name" id="last_name" type="text" class="form-control" value="<?php echo $user->data()->last_name;?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control"><?php echo $user->data()->address;?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input name="city" id="city" type="text" class="form-control" value="<?php echo $user->data()->city;?>"/>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select name="state" id="state" class="form-control">
                                            <?php
                                            $state = new State();
                                            $states = $state->find(["active_status", "=", "1"]);
                                            foreach ($states as $state) {
                                                ?>
                                                <option value="<?php echo $state->state_name?>" <?php if ($user->data()->state == $state->state_name) { echo "selected";}?>>
                                                        <?php echo $state->state_name?>
                                                    </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="pincode">Pincode</label>
                                        <input name="pincode" id="pincode" type="text" class="form-control" maxlength="6" value="<?php echo $user->data()->pincode;?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="well">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input name="username" id="username" type="text" class="form-control" value="<?php echo $user->data()->username;?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email ID</label>
                                    <input name="email" id="email" type="email" class="form-control" value="<?php echo $user->data()->email;?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input name="mobile_number" id="mobile_number" type="text" class="form-control" maxlength="10" value="<?php echo $user->data()->mobile_number;?>" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    <input type="hidden" name="uid" value="<?php echo $user->data()->id; ?>">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
            </form>
        </div>
    </section>
</div>

<?php require 'footer.php';?>

<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#uploadPreview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile_pic").change(function(){
            readURL(this);
        });

        // datetime picker
//        $('#date_of_birth').datetimepicker({
//            timepicker: false,
//            format: 'd-m-Y',
//            mask: false
//        });

        $("#frmProfile").validate({
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
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                address: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
            },
            messages: {
                first_name: {
                    required: " (required)",
                },
                last_name: {
                    required: " (required)",
                },
                address: {
                    required: " (required)",
                },
                city: {
                    required: " (required)",
                },
                state: {
                    required: " (required)",
                },
                pincode: {
                    required: " (required)",
                    minlength: " (please enter at least 6 characters)",
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
