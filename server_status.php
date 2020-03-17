<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Server Status<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Server Status</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="#" data-toggle="tooltip" title="Add New Server">
                            <i class="fa fa-plus"></i> Add New Server
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                                <thead>
                                <tr>
                                    <th>Server Name</th>
                                    <th>Server IP</th>
                                    <th>Server Public IP</th>
                                    <th>Server Location</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $state = new Table('smc_servers_status');
                                $rows = $state->find(['active_status', '=', '1']);

                                if ($rows) {
                                    foreach ($rows as $r) {
                                        $class = '';
                                        $server_status = 'Unknown';

                                        if ($r->active_status == 0) {
                                            $class = "bg-yellow";
                                        } else if ($r->status == 1) {
                                            $class = "bg-green";
                                            $server_status = 'UP';
                                        } else {
                                            $class = "bg-red";
                                            $server_status = 'DOWN';
                                        }
                                        ?>
                                        <tr class="<?php echo $class;?>">
                                            <td><?php echo ucwords($r->server_name);?></td>
                                            <td><?php echo $r->server_ip;?></td>
                                            <td><?php echo $r->server_public_ip;?></td>
                                            <td><?php echo $r->server_location;?></td>
                                            <td><?php echo $server_status;?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

