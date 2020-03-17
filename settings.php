<?php require 'header.php';?>
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>Settings<small>control system settings</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
<!--                    <div class="box-header with-border">-->
<!--                        <a href="users_add.php">-->
<!--                            <i class="fa fa-plus" data-toggle="tooltip" title="Add New User"></i>-->
<!--                        </a>-->
<!--                    </div>-->
                    <div class="box-body">
                            <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                                <thead>
                                <tr>
                                    <th>Setting Name</th>
                                    <th>Setting Value</th>
                                    <th>Active Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $setting = new Setting();
                                    $rows = $setting->getSettings();
            
                                    $i = 0;
                                    foreach ($rows as $r) {
                                        ?>
                                        <tr data-id="<?php echo $r->id;?>" id="row<?php echo $r->id;?>">
                                            <td><?php echo $r->setting_name;?></td>
                                            <td class="text-center">
                                                <div id="sv<?php echo $r->id;?>">
                                                <?php if ($r->setting_value == 1) { ?>
                                                    <a data-page="setting" data-column="sv" href="" id="<?php echo $r->id;?>" act="0" class="toggle">
                                                        <i class="fa fa-toggle-on fa-1p5x on"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <a data-page="setting" data-column="sv" href="" id="<?php echo $r->id;?>" act="1" class="toggle">
                                                        <i class="fa fa-toggle-off fa-1p5x off"></i>
                                                    </a>
                                                <?php } ?>
                                                <div>
                                            </td>
                                            <td class="text-center">
                                                <div id="as<?php echo $r->id;?>">
                                                    <?php
                                                    if ($r->active_status == 1) {
                                                    ?>
                                                        <a data-page="setting" data-column="as" href="" id="<?php echo $r->id;?>" act="0" class="toggle">
                                                            <i class="fa fa-toggle-on fa-1p5x on"></i>
                                                        </a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a data-page="setting" data-column="as" href="" id="<?php echo $r->id;?>" act="1" class="toggle">
                                                            <i class="fa fa-toggle-off fa-1p5x off"></i>
                                                        </a>
                                                    <?php
                                                    }
                                                    ?>
                                                <div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php'; ?>