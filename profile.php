<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Profile<small>user detail</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo ucwords($user->data()->title) . ' ' . ucwords($user->getFullName()); ?>
                </h3>
                <div class="box-tools pull-right">
                    <a href="profile_edit.php" data-toggle="tooltip" title="Edit Profile">
                        <i class="fa fa-pencil"></i> Edit
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center">
                        <?php
                        $profile_pic = Config::get('app/profile_url') . "/" . $user->data()->avatar;
                        if (!file_exists($profile_pic)) {
                            $profile_pic = Config::get('app/profile_url') . "/no_avatar.jpg";
                        }
                        ?>
                        <img alt="User Pic" src="<?php echo $profile_pic; ?>" class="img-thumbnail img-responsive">
                        <br /><br />
                        <div class="visible-lg">
                            <a href="change_password.php" class="btn btn-danger"><i class="fa fa-key fa-fw"></i> Change Password</a>
                            <br /><br />
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Consumer ID</td>
                                <td><?php echo $user->data()->consumer_id;?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><?php echo strtolower($user->data()->username); ?></td>
                            </tr>
                            <tr>
                                <td>Consumer Name</td>
                                <td><?php echo ucwords($user->data()->title . ' ' . $user->getFullName()); ?></td>
                            </tr>
                            <tr>
                                <td>House Number</td>
                                <td><?php echo $user->data()->house_number;?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?php echo ucwords($user->data()->address); ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?php echo ucwords($user->data()->city); ?></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td><?php echo ucwords($user->data()->state); ?></td>
                            </tr>
                            <tr>
                                <td>Pincode</td>
                                <td><?php echo $user->data()->pincode; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <?php
                                    echo strtolower($user->data()->email);

                                    if ($user->data()->email_verified == 1) {
                                        ?>
                                        <i class="fa fa-check-square-o text-primary" data-toggle="tooltip" title="verified"></i>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>LandLine Number</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Mobile Number</td>
                                <td>
                                    <?php
                                    echo $user->data()->mobile_number;

                                    if ($user->data()->mobile_verified == 1) {
                                        ?>
                                        <i class="fa fa-check-square-o text-primary" data-toggle="tooltip" title="verified"></i>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
//                            $user_meta = $user->findUserMeta($user->data()->id);
                            ?>
                            <tr>
                                <td>Account ID</td>
                                <td><?php echo $user->data()->account_id;?></td>
                            </tr>
                            <tr>
                                <td>RRNumber</td>
                                <td><?php echo $user->data()->rr_number;?></td>
                            </tr>
                            <tr>
                                <td>Service Point ID</td>
                                <td><?php echo $user->data()->service_point_id;?></td>
                            </tr>
                            <tr>
                                <td>Service Date</td>
                                <td><?php echo $user->data()->service_date;?></td>
                            </tr>
                            <tr>
                                <td>Meter Phase</td>
                                <td><?php echo $user->data()->meter_phase;?></td>
                            </tr>
                            <tr>
                                <td>Consumer PV Type (Gridtie/Hybrid)</td>
                                <td><?php echo ucwords($user->data()->consumer_pv_type);?></td>
                            </tr>
                            <tr>
                                <td>Nature Of Business</td>
                                <td><?php echo $user->data()->nature_of_business;?></td>
                            </tr>
                            <tr>
                                <td>Payment Contract Name</td>
                                <td><?php echo $user->data()->payment_contract_name;?></td>
                            </tr>
                            <tr>
                                <td>Connection Category Name</td>
                                <td><?php echo $user->data()->connection_category_name;?></td>
                            </tr>
                            <tr>
                                <td>Billing Cycle</td>
                                <td><?php echo $user->data()->billing_cycle;?></td>
                            </tr>
                            <tr>
                                <td>Billing Day</td>
                                <td><?php echo $user->data()->billing_day;?></td>
                            </tr>
                            <tr>
                                <td>Bill Payable Day</td>
                                <td><?php echo $user->data()->bill_payable_day;?></td>
                            </tr>
                            <tr>
                                <td>Sanctioned Load KW</td>
                                <td><?php echo $user->data()->sanctioned_load_kw;?></td>
                            </tr>
                            <tr>
                                <td>Connected Load KW</td>
                                <td><?php echo $user->data()->connected_load_kw;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>
