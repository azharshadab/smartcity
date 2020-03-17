<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Groups<small>access control list</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Groups</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="groups_add.php" data-toggle="tooltip" title="Add New Group">
                            <i class="fa fa-plus"></i> New Group
                        </a>
                    </div>
                    <div class="box-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                            <thead>
                            <tr>
                                <th>Group Name</th>
                                <th>Access Level</th>
                                <th>Allowed Pages</th>
                                <th>Count Users</th>
                                <th>Active Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $group = new Group();
                            $rows = $group->getGroups();
                            
                            //print_r($rows);
    
                            $count_group = $group->countGroups();
    
                            $i = 0;
                            foreach ($rows as $r) {
                                $has_user = false;
                                ?>
                                <tr data-id="<?php echo $r->id;?>" id="row<?php echo $r->id;?>">
                                        <td><?php echo ucwords($r->user_role);?></td>
                                        <td><?php echo ucwords($r->access_level);?></td>
                                        <td>
                                            <a class="btnView" data-toggle="modal" data-id="<?php echo $r->id;?>" data-target="#permModal">View Pages</a>
                                        </td>
                                        <td>
                                        <?php
                                        if (array_key_exists($r->id, $count_group)) {
                                            echo $count_group[$r->id];
                                            $has_user = true;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                        </td>
                                        <td class="text-center">
                                            <div id="as<?php echo $r->id;?>">
                                                <?php
                                                if ($has_user) {
                                                    ?>
                                                    <i class="fa fa-toggle-on fa-1p5x text-muted"></i>
                                                    <?php
                                                } else {
                                                    if ($r->active_status == 1) {
                                                        ?>
                                                        <a data-page="group" data-column="as" href="" id="<?php echo $r->id; ?>" act="0"
                                                           class="toggle"><i class="fa fa-toggle-on fa-1p5x on"></i></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a data-page="group" data-column="as" href="" id="<?php echo $r->id; ?>" act="1"
                                                           class="toggle"><i class="fa fa-toggle-off fa-1p5x off"></i></a>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <div>
                                        </td>
                                        <td class="text-center">
                                            <a class="btnEdit" href="groups_edit.php?id=<?php echo $r->id;?>"><i class="fa fa-pencil fa-fw fa-1p5x"></i></a>
                                            <?php if ($has_user) { ?>
                                                <i class="fa fa-trash fa-fw fa-1p5x text-muted"></i>
                                            <?php } else { ?>
                                                <a data-page="group" class="btnDelete" href="#"><i class="fa fa-trash fa-fw fa-1p5x text-danger"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                $i++;
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
                                        <h3 class="modal-title text-danger" id="myModalLabel">Danger Zone!</h3>
                                    </div>
                                    <div class="modal-body bg-danger">
                                        <h4>Warning, are you sure you want to DELETE?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    
<div class="container">
    <div class="modal fade" id="permModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div id="result"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<?php require 'footer.php';?>

<script>
    $(document).ready(function() {
        $('a.btnView').on('click', function (e) {
            e.preventDefault();
            var element = $(this);
            var id = element.attr("data-id");
            // var json = element.attr("data-src");
            var data = 'id=' + id;
            //alert(data);
            $.ajax({
                type: "POST",
                url: "jq_view_group_pages.php",
                data: data,
                success: function (data) {
                    $('h4#myModalLabel').html("Allowed Pages");
                    $('#result').html(data);
                }
            });
        });
    });
</script>
