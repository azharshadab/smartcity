<?php include 'header.php'; ?>

<section class="content-wrapper">
    <section class="content-header">
        <h1>User Detail<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="users.php">Users</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>
    
    <?php
    $user_data = new User(Input::get('id'));
    ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords($user_data->data()->title) . ' ' . ucwords($user_data->getFullName()); ?></h3>
                        <div class="box-tools pull-right">
                            <a href="users.php" data-toggle="tooltip" title="Users">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center">
                                <?php
                                $profile_pic = Config::get('app/profile_url') . "/" . $user_data->data()->avatar;
                                if (!file_exists($profile_pic)) {
                                    $profile_pic = Config::get('app/profile_url') . "/no_avatar.jpg";
                                }
                                ?>
                                <img width="350px" alt="User Pic" src="<?php echo $profile_pic; ?>" class="img-thumbnail img-responsive">
                            </div>
                            <div class="col-md-9 col-lg-9">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo strtolower($user_data->data()->username); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Full Name</td>
                                        <td><?php echo ucwords($user_data->data()->title . ' ' . $user_data->getFullName()); ?></td>
                                    </tr>
<!--                                    <tr>-->
<!--                                        <td>Gender</td>-->
<!--                                        <td>-->
<!--                                            --><?php
//                                            echo ucwords($user_data->data()->gender);
//                                            $gcon = array(
//                                                'male' => 'fa-mars',
//                                                'female' => 'fa-venus',
//                                                'other' => 'fa-transgender',
//                                            );
//                                            echo " <i class='fa " . $gcon[$user_data->data()->gender] . "'></i>";
//                                            ?>
<!--                                        </td>-->
<!--                                    </tr>-->
                                    <tr>
                                        <td>Address</td>
                                        <td><?php echo ucwords($user_data->data()->address); ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo ucwords($user_data->data()->city); ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php echo ucwords($user_data->data()->state); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pincode</td>
                                        <td><?php echo $user_data->data()->pincode; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo strtolower($user_data->data()->email); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo $user_data->data()->mobile_number; ?></td>
                                    </tr>

                                    <?php
                                    $group = new Group();
                                    $group_name = $group->getGroupName($user_data->data()->group_id);
                                    ?>
                                    <tr>
                                        <td>User Role</td>
                                        <td><?php echo $group_name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Account ID</td>
                                        <td><?php echo $user_data->data()->account_id;?></td>
                                    </tr>
                                    <tr>
                                        <td>RRNumber</td>
                                        <td><?php echo $user_data->data()->rr_number;?></td>
                                    </tr>
                                    <tr>
                                        <td>Service Point ID</td>
                                        <td><?php echo $user_data->data()->service_point_id;?></td>
                                    </tr>
                                    <tr>
                                        <td>Service Date</td>
                                        <td><?php echo $user_data->data()->service_date;?></td>
                                    </tr>
                                    <tr>
                                        <td>Meter Phase</td>
                                        <td><?php echo $user_data->data()->meter_phase;?></td>
                                    </tr>
                                    <tr>
                                        <td>Consumer PV Type (Gridtie/Hybrid)</td>
                                        <td><?php echo ucwords($user_data->data()->consumer_pv_type);?></td>
                                    </tr>
                                    <tr>
                                        <td>Nature Of Business</td>
                                        <td><?php echo $user_data->data()->nature_of_business;?></td>
                                    </tr>
                                    <tr>
                                        <td>Payment Contract Name</td>
                                        <td><?php echo $user_data->data()->payment_contract_name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Connection Category Name</td>
                                        <td><?php echo $user_data->data()->connection_category_name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Billing Cycle</td>
                                        <td><?php echo $user_data->data()->billing_cycle;?></td>
                                    </tr>
                                    <tr>
                                        <td>Billing Day</td>
                                        <td><?php echo $user_data->data()->billing_day;?></td>
                                    </tr>
                                    <tr>
                                        <td>Bill Payable Day</td>
                                        <td><?php echo $user_data->data()->bill_payable_day;?></td>
                                    </tr>
                                    <tr>
                                        <td>Sanctioned Load KW</td>
                                        <td><?php echo $user_data->data()->sanctioned_load_kw;?></td>
                                    </tr>
                                    <tr>
                                        <td>Connected Load KW</td>
                                        <td><?php echo $user_data->data()->connected_load_kw;?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<?php include 'footer.php'; ?>
