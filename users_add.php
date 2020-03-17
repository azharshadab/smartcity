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
                'consumer_id' => array(
                    'required' => true,
                ),
//                'mobile_number' => array (
//                    'required' => true,
//                    'numeric' => true,
//                    'min' => 10,
//                    'max' => 10,
//                    'unique' => 'smc_users',
//                ),
                'username' => array(
                    'required' => true,
                    'unique' => 'smc_users',
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6,
                ),
                'confirm_password' => array(
                    'required' => true,
                    'min' => 6,
                    'matches' => 'password',
                ),
            ),
        ));

        if ($validation->passed()) {
            $salt = Hash::salt(32);
            $password = Hash::make(Input::get('password'), $salt);

            $service_date = (Input::get('service_date') == '') ? null:Input::get('service_date');
            $data = array(
                'group_id'          => Input::get('group'),
                'username'          => Input::get('username'),
                'title'             => Input::get('title'),
                'first_name'        => Input::get('first_name'),
                'middle_name'       => Input::get('middle_name'),
                'last_name'         => Input::get('last_name'),
                'email'             => Input::get('email'),
                'mobile_number'     => Input::get('mobile_number'),
                'avatar'            => 'no_avatar.jpg',
                'address'           => Input::get('address'),
                'city'              => Input::get('city'),
                'state'             => Input::get('state'),
                'pincode'           => Input::get('pincode'),
                'consumer_id'       => Input::get('consumer_id'),
                'house_number'      => Input::get('house_number'),
                'meter_serial_number'   => Input::get('meter_serial_number'),
                'account_id'        => Input::get('account_id'),
                'rr_number'         => Input::get('rr_number'),
                'service_point_id'  => Input::get('service_point_id'),
                'service_date'      => $service_date,
                'meter_phase' => Input::get('meter_phase'),
                'payment_contract_name' => Input::get('payment_contract_name'),
                'consumer_pv_type'  => Input::get('consumer_pv_type'),
                'nature_of_business'=> Input::get('nature_of_business'),
                'connected_to_dcu'  => Input::get('connected_to_dcu'),
                'device_dcu_name'   => Input::get('device_dcu_name'),
                'dr_participation'  => Input::get('dr_participation'),
                'connection_category_name' => Input::get('connection_category_name'),
                'billing_cycle' => Input::get('billing_cycle'),
                'billing_day' => Input::get('billing_day'),
                'bill_payable_day' => Input::get('bill_payable_day'),
                'sanctioned_load_kw' => Input::get('sanctioned_load_kw'),
                'connected_load_kw' => Input::get('connected_load_kw'),
                'email_verified'    => '1',
                'mobile_verified'   => '1',
                'active_status'     => Input::get('status'),
                'password'          => $password,
                'salt'              => $salt,
                'otp'               => null,
                'active_hash'       => null,
                'recover_hash'      => null,
                'date_created'      => date("Y-m-d H:i:s"),
                'created_by'        => $user->data()->id,
            );

            try {
                $user = new User();
                $user->create($data);

                Session::put('fclass', 'success');
                Session::flash('fmsg', 'Successful!');
                Redirect::to('users.php');
            } catch (Exception $e) {
                $messages[] = $e->getMessage();

                print_r($messages);
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
        <h1>Dashboard<small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="users.php">Users</a></li>
            <li class="active">New</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <a class="pull-right" href="users.php" data-toggle="tooltip" title="Users">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form name="frmUser" id="frmUser" method="post" action="">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <select name="title" id="title" class="form-control">
                                            <option value="Mr.">Mr.</option>
                                            <option value="Prof.">Prof.</option>
                                            <option value="Dr.">Dr.</option>
                                            <option value="Miss.">Miss.</option>
                                            <option value="Mrs.">Mrs.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input name="first_name" id="first_name" type="text" class="form-control" value="<?php echo Input::get('first_name');?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="middle_name">Middle Name</label>
                                        <input name="middle_name" id="middle_name" type="text" class="form-control" value="<?php echo Input::get('middle_name');?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input name="last_name" id="last_name" type="text" class="form-control" value="<?php echo Input::get('last_name');?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Email ID</label>
                                        <input name="email" id="email" type="email" class="form-control" value="<?php echo Input::get('email');?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input name="mobile_number" id="mobile_number" type="text" class="form-control" maxlength="10" value="<?php echo Input::get('mobile_number');?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control"><?php echo Input::get('address');?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input name="city" id="city" type="text" class="form-control" value="<?php echo Input::get('city');?>"/>
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
                                                <option value="<?php echo $state->state_name?>">
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
                                        <input name="pincode" id="pincode" type="text" class="form-control" maxlength="6" value="<?php echo Input::get('pincode');?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="consumer_id">Consumer ID</label>
                                        <input name="consumer_id" id="consumer_id" type="text" class="form-control" value="<?php echo Input::get('consumer_id');?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="house_number">House Number</label>
                                        <input name="house_number" id="house_number" type="text" class="form-control" value="<?php echo Input::get('house_number');?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="meter_serial_number">Meter Serial Number</label>
                                        <input name="meter_serial_number" id="meter_serial_number" type="text" class="form-control" value="<?php echo Input::get('meter_serial_number');?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="account_id">Account ID</label>
                                        <input name="account_id" id="account_id" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="rr_number">RR Number</label>
                                        <input name="rr_number" id="rr_number" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="service_point_id">Service Point ID</label>
                                        <input name="service_point_id" id="service_point_id" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="service_date">Service Date</label>
                                        <input name="service_date" id="service_date" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <div class="form-group">
                                        <label for="meter_phase">Meter Phase</label>
                                      <!--   <input name="service_point_meter_type_name" id="service_point_meter_type_name" type="text" class="form-control"/> -->
                                         <select name="meter_phase" id="meter_phase" class="form-control">
                                                <option value="Single Phase">Single Phase</option>
                                                <option value="Three Phase">Three Phase</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="nature_of_business">Nature of Business</label>
                                        <input name="nature_of_business" id="nature_of_business" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="consumer_pv_type">Consumer PV Type (Gridtie/Hybrid)</label>
                                            <select name="consumer_pv_type" id="consumer_pv_type" class="form-control">
                                                <option value="gridtie">Gridtie</option>
                                                <option value="hybrid">Hybrid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="connected_to_dcu">Connected to DCU</label>
                                        <select name="connected_to_dcu" id="connected_to_dcu" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="device_dcu_name">Device DCU Name</label>
                                        <input name="device_dcu_name" id="device_dcu_name" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="dr_participation">DR Participation</label>
                                        <select name="dr_participation" id="dr_participation" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="connection_category_name">Connection Category Name</label>
                                        <select name="connection_category_name" id="connection_category_name" class="form-control">
                                            <option value="LT">LT</option>
                                            <option value="HT">HT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nature_of_business">Nature Of Business</label>
                                        <input name="nature_of_business" id="nature_of_business" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="payment_contract_name">Payment Contract Name</label>
                                        <select name="payment_contract_name" id="payment_contract_name" class="form-control">
                                            <option value="postpaid">Postpaid</option>
                                            <option value="prepaid">Prepaid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="bill_payable_day">Bill Payable Day</label>
                                        <input name="bill_payable_day" id="bill_payable_day" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="billing_cycle">Billing Cycle</label>
                                        <input name="billing_cycle" id="billing_cycle" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="billing_day">Billing Day</label>
                                        <input name="billing_day" id="billing_day" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sanctioned_load_kw">Sanctioned Load kW</label>
                                        <input name="sanctioned_load_kw" id="sanctioned_load_kw" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="connected_load_kw">Connected Load kW</label>
                                        <input name="connected_load_kw" id="connected_load_kw" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input name="username" id="username" type="text" class="form-control" value="<?php echo Input::get('username');?>"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" id="password" type="password" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input name="confirm_password" id="confirm_password" type="password" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="group">Access Group</label>
                                <select name="group" id="group" class="form-control">
                                <?php
                                $group = new Group();
                                $groups = $group->find(["1", "=", "1"]);
                                foreach ($groups as $group) {
                                    ?>
                                    <option value="<?php echo $group->id?>" <?php if (Input::get('group') == $group->id) { echo "selected";}?>>
                                            <?php echo $group->user_role?>
                                        </option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Active Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" selected>Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
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
        $("#frmUser").validate({
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
                email: {
                    required: true,
                    nospace: true,
                },
                // mobile_number: {
                //     required: true,
                //     nospace: true,
                //     mobileonly: true,
                // },
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
                    nospace: true,
                    digitsonly: true,
                    minlength: 6,
                    maxlength: 6,
                },
                consumer_id: {
                    required: true
                },
                username: {
                    required: true,
                    nospace: true,
                    minlength: 5,
                },
                password: {
                    required: true,
                    nospace: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    nospace: true,
                    minlength: 6,
                    equalTo: "#password",
                },
            },
            messages: {
                first_name: {
                    required: " (required)",
                },
                last_name: {
                    required: " (required)",
                },
                email: {
                    required: " (required)",
                    nospace: " (no space please and don't leave it empty)",
                },
                // mobile_number: {
                //     required: " (required)",
                //     nospace: " (no space please and don't leave it empty)",
                //     mobileonly: " (please enter valid mobile number)",
                // },
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
                    nospace: " (no space please and don't leave it empty)",
                    minlength: " (please enter at least 6 characters)",
                },
                consumer_id: {
                    required: " (required)"
                },
                username: {
                    required: " (required)",
                    nospace: " (no space please and don't leave it empty)",
                    minlength: " (please enter at least 5 characters)",
                },
                password: {
                    required: " (required)",
                    nospace: " (no space please and don't leave it empty)",
                    minlength: " (please enter at least 6 characters)",
                    maxlength: " (please enter at least 6 characters)",
                },
                confirm_password: {
                    required: " (required)",
                    nospace: " (no space please and don't leave it empty)",
                    minlength: " (please enter at least 6 characters)",
                    equalTo: " (confirm password should match password)",
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
