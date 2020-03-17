<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Users<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="users_add.php" data-toggle="tooltip" title="Add New User">
                            <i class="fa fa-plus"></i> New User
                        </a>
                    </div>
                    <div class="box-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                        <thead>
                            <tr>
                                <th>Consumer ID</th>
                                <th>Full Name</th>
                                <th>House No.</th>
                                <th>Meter Phase</th> 
                                <th>Username</th>
                                <th>Email-ID</th>
                                <th>Mobile Number</th>
                                <th>Role</th>
                                <th>Last Active</th>
                                <th>Active Status</th>
                                <th class="min-tablet">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                       
                       /* $db = DB::getInstance();
                        $db->delete('smc_users','$r->id');*/
                        $user = new User();
                        $rows = $user->getAllUsers();
    
                        foreach ($rows as $r) {
//                            if ($r->id == 1 && $user->data()->id != 1) {
//                                continue;
//                            }
                            ?>
                            <tr data-id="<?php echo $r->id; ?>" id="row<?php echo $r->id; ?>">
                                <td><?php echo $r->consumer_id;?></td>
                                <td><?php echo ucwords($r->title . ' ' . $r->first_name . ' ' . $r->middle_name . ' ' . $r->last_name);?></td>
                                <td><?php echo $r->house_number;?></td>
                                <td><?php echo $r->meter_phase;?></td> 
                                <td><?php echo $r->username;?></td>
                                <?php $td_class = ($r->email_verified == 1) ? '' : 'danger';?>
                                <td class="<?php echo $td_class;?>"><?php echo $r->email;?></td>
                                <?php
                                if ($r->mobile_verified == 1) {
                                    ?>
                                    <td><?php echo $r->mobile_number;?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td class="danger"><?php echo $r->mobile_number;?></a></td>
                                    <?php
                                }

                                $group = new Group();
                                ?>
                                <td><?php echo $group->getGroupName($r->group_id);?></td>
                                <td><?php echo  date("d M, Y H:i:s", strtotime($user->getLastActiveTime($r->id)->date_last_active));?></td>
                                <td class="text-center">
                                        <div id="as<?php echo $r->id;?>">
                                            <?php
                                            if ($r->id == 1) {
                                                ?>
                                                <i class="fa fa-toggle-on fa-1p5x text-muted"></i>
                                                <?php
                                            } else {
                                                if ($r->active_status == 1) {
                                                    ?>
                                                    <a data-page="user" data-column="as" href="" id="<?php echo $r->id; ?>"
                                                       act="0" class="toggle"><i class="fa fa-toggle-on fa-1p5x on"></i></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a data-page="user" data-column="as" href="" id="<?php echo $r->id; ?>" act="1" class="toggle"><i class="fa fa-toggle-off fa-1p5x off"></i></a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btnView" href="users_detail.php?id=<?php echo $r->id;?>"><i class="fa fa-eye fa-fw fa-1p5x"></i></a>
                                        <?php if ($r->group_id == 1) { ?>
                                            <a class="btnEdit" href="users_edit.php?id=<?php echo $r->id;?>"><i class="fa fa-pencil fa-fw fa-1p5x"></i></a>
                                            <i class="fa fa-trash fa-fw fa-1p5x text-muted"></i>
                                        <?php } else { ?>
                                            <a class="btnEdit" href="users_edit.php?id=<?php echo $r->id;?>"><i class="fa fa-pencil fa-fw fa-1p5x"></i></a>
                                            <a data-page="user" class="btnDelete" href="#"><i class="fa fa-trash fa-fw fa-1p5x text-danger"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        </table>
                        


                        <!-- start: Delete Coupon Modal -->
                            <div class="modal fade" id="deleteConf" tabindex="-1" role="dialog" aria-labelledby="DeleteConfirmation" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title" id="myModalLabel">Warning!</h3>

                                        </div>
                                        <div class="modal-body">
                                            <h4> Are you sure you want to DELETE?</h4>

                                        </div>
                                        <!--/modal-body-collapse -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        </div>
                                        <!--/modal-footer-collapse -->
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
</div>
    <!-- /.content-wrapper -->

<?php require 'footer.php';?>
