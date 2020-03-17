<?php include 'header.php'; ?>

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
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <?php
                            $notification = new Notification();
                            $row = $notification->find($user->data()->id, null);
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
                                <ul class="list-group">
                                    <?php
                                        foreach ($row as $r) {
                                            ?>
                                            <li class="list-group-item <?php echo $array_colors_li[$r->message_type];?>">
                                                <i class="fa <?php echo $array_icons[$r->message_type] . ' ' . $array_colors[$r->message_type];?>"></i>&nbsp;
                                                <?php
                                                    if ($r->unread == 1) {
                                                        ?>
                                                        <strong><?php echo ucfirst($r->message); ?></strong>
                                                        <?php
                                                    } else {
                                                        echo ucfirst($r->message);
                                                    }
                                                ?>
                                                <span class="pull-right text-muted small"><?php echo elapsedTimeString($r->date_created);?></span>
                                            </li>
                                            <?php
                                        }

                                        // mark all notifications as read
                                        $notification->changeMessageStatus();
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>
