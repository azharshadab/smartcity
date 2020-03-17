<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Notifications<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Notifications</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="notifications_add.php" data-toggle="tooltip" title="Add New Group">
                            <i class="fa fa-plus"></i> New Notification
                        </a>
                    </div>
                    <div class="box-body">
                        <?php
                            $notification = new Notification();
                            $row = $notification->find();
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
                                    $array_icons = array('message' => 'fa-comment',
                                                         'warning' => 'fa-exclamation-triangle',
                                                         'alert' => 'fa-bell',
                                                         'info' => 'fa-info-circle',
                                    );

                                    $array_colors = array('message' => 'notif-success',
                                                          'warning' => 'notif-warning',
                                                          'alert' => 'notif-danger',
                                                          'info' => 'notif-info',
                                    );

                                    $array_colors_li = array('message' => 'list-group-item-success',
                                                             'warning' => 'list-group-item-warning',
                                                             'alert' => 'list-group-item-danger',
                                                             'info' => 'list-group-item-info',
                                    );
                                ?>
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                                        <thead>
                                        <tr>
                                            <th>Message</th>
                                            <th>Message For</th>
                                            <th>Message Type</th>
                                            <th>Read Status</th>
                                            <th>Active Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                    foreach ($row as $r) {
                                        $read_class = ($r->unread == 1) ? 'warning':'';
                                ?>
                                            <tr class="<?php echo $read_class?>" data-id="<?php echo $r->id;?>" id="row<?php echo $r->id;?>">
                                                <td><?php echo ucfirst($r->message);?></td>
                                                <td><?php echo $r->message_for;?></td>
                                                <td><?php echo $r->message_type;?></td>
                                                <td><?php echo ($r->unread == 1) ? "UnRead":"Read";?></td>
                                                <td class="text-center">
                                                    <div id="as<?php echo $r->id;?>">
                                                    <?php
                                                    if ($r->active_status == 1) {
                                                    ?>
                                                        <a data-page="notif" data-column="as" href="" id="<?php echo $r->id; ?>" act="0" class="toggle"><i class="fa fa-toggle-on fa-2x on"></i></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a data-page="notif" data-column="as" href="" id="<?php echo $r->id; ?>" act="1" class="toggle"><i class="fa fa-toggle-off fa-2x off"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div>
                                                </td>
                                                <td class="text-center">
                                                    <a data-page="notif" class="btnDelete" href=""><i class="fa fa-trash fa-fw fa-2x text-danger"></i></a>
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
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>