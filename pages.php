<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Pages<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pages</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="pages_add.php" data-toggle="tooltip" title="Add New Page">
                            <i class="fa fa-plus"></i> New Page
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                                <thead>
                                <tr>
                                    <th>Display Name</th>
                                    <th>Page Name</th>
                                    <th>Menu Icon</th>
                                    <th>Display Order</th>
                                    <th>Display Menu</th>
                                    <th>Active Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $page = new Page();
                                $rows = $page->getPages(true);

                                $i = 0;
                                foreach ($rows as $r) {
                                    ?>
                                    <tr data-id="<?php echo $r->id;?>" id="row<?php echo $r->id;?>">
                                        <td><?php echo ucwords($r->page_title);?></td>
                                        <td><?php echo $r->page_name;?></td>
                                        <td class="text-center"><i class="fa <?php echo $r->fa_menu_icon;?>"></i></td>
                                        <td class="text-center"><?php echo $r->display_order;?></td>
                                        <td class="text-center"><?php //echo $r->display_menu;?>
                                            <div id="dm<?php echo $r->id;?>">
                                                <?php
                                                if ($r->display_menu == 1) {
                                                    ?>
                                                    <a data-page="page" data-column="dm" href="" id="<?php echo $r->id;?>" act="0" class="toggle"><i class="fa fa-toggle-on fa-2x on"></i></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a data-page="page" data-column="dm" href="" id="<?php echo $r->id;?>" act="1" class="toggle"><i class="fa fa-toggle-off fa-2x off"></i></a>
                                                    <?php
                                                }
                                                ?>
                                                <div>
                                        </td>
                                        <td class="text-center">
                                            <div id="as<?php echo $r->id;?>">
                                                <?php
                                                if ($r->active_status == 1) {
                                                    ?>
                                                    <a data-page="page" data-column="as" href="" id="<?php echo $r->id;?>" act="0" class="toggle"><i class="fa fa-toggle-on fa-2x on"></i></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a data-page="page" data-column="as" href="" id="<?php echo $r->id;?>" act="1" class="toggle"><i class="fa fa-toggle-off fa-2x off"></i></a>
                                                    <?php
                                                }
                                                ?>
                                                <div>
                                        </td>
                                        <td class="text-center">
                                            <a class="btnEdit" href="pages_edit.php?id=<?php echo $r->id;?>"><i class="fa fa-pencil fa-fw fa-2x"></i></a>
                                            <a data-page="page" class="btnDelete" href=""><i class="fa fa-trash fa-fw fa-2x text-danger"></i></a>
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

<?php include 'footer.php'; ?>
