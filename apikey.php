<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>API Keys<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">API Keys</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> API Usage Chart
                        <div class="pull-right">Weekly Usage</div>
                    </div>

                    <div class="panel-body" id="pbd">
                        <div id="chart_div"></div>
                        <span id="refresh_chart">
                            <i class="fa fa-circle-o-notch fa-spin fa-4x"></i>
                        </span>
                    </div>

                    <script>
                        $(document).ready(function(){
                            $.ajax({
                                type: "GET",
                                url: "jq_api_uses.php",
                                success: function (data) {
                                    console.log('Success:'+data);
                                    $('#refresh_chart').hide();

                                    if (data != 'nok') {
                                        var line = new Morris.Line({
                                            element: 'chart_div',
                                            data: data,
                                            xkey: 'y',
                                            ykeys: ['mdm'],
                                            labels: ['MDM API'],
                                            resize: true,
                                            lineColors: ['#D43F3A'],
                                            yLabelFormat: function(y){return y != Math.round(y)?'':y;},
                                        });
                                    } else {
                                        $('#chart_div').html("Sorry! No available at the moment.");
                                    }
                                },
                                error: function(data) {
                                    console.log('Error...');
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="apikey_add.php" data-toggle="tooltip" title="Add New Group">
                            <i class="fa fa-plus"></i> New API Key
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                                <thead>
                                <tr>
                                    <th>API Key</th>
                                    <th>Requests Per Day</th>
                                    <th>Active Status</th>
<!--                                    <th>Action</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $api_key = new APIKey();
                                $rows = $api_key->find(['created_by', '=', $user->data()->id]);

                                if ($rows) {
                                    $i = 0;
                                    foreach ($rows as $r) {
                                        ?>
                                        <tr data-id="<?php echo $r->id;?>" id="row<?php echo $r->id;?>">
                                            <td><?php echo $r->api_key;?></td>
                                            <td><?php echo ($r->access_limit == 0) ? 'No Limit':$r->access_limit;?></td>
                                            <td class="text-center">
                                                <div id="as<?php echo $r->id;?>">
                                                    <?php
                                                    if ($r->active_status == 1) {
                                                        ?>
                                                        <a data-page="apikey" data-column="as" href="" id="<?php echo $r->id;?>" act="0" class="toggle"><i class="fa fa-toggle-on fa-2x on"></i></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a data-page="apikey" data-column="as" href="" id="<?php echo $r->id;?>" act="1" class="toggle"><i class="fa fa-toggle-off fa-2x off"></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div>
                                            </td>
<!--                                            <td class="text-center">-->
<!--                                                <a data-page="apikey" class="btnDelete" href=""><i class="fa fa-trash fa-fw fa-2x text-danger"></i></a>-->
<!--                                            </td>-->
                                        </tr>
                                        <?php
                                        $i++;
                                    }
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
</div>

<?php require 'footer.php';?>