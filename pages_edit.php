<?php include 'header.php'; ?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'page_title' => array (
                    'required' => true,
                ),
                'page_filename' => array (
                    'required' => true,
                ),
            ),
        ));

        if ($validation->passed()) {

            $data = array(
                'page_title' => ucwords(Input::get('page_title')),
                'display_menu' => Input::get('display_menu'),
                'display_order' => Input::get('display_order'),
                'fa_menu_icon' => Input::get('menu_icon'),
                'active_status' => Input::get('active_status')
            );

            try {
                $page = new Page();
                $page->update($data, Input::get('pid'));

                Session::put('fclass', 'success');
                Session::flash('fmsg', 'Updated!');
                Redirect::to('pages.php');
            } catch (Exception $e) {
                $messages[] = $e->getMessage();
            }
        } else {
            $messages_class = 'danger';
            $messages = $validation->errors();
        }
    }
}

if (Input::exists('get')) {
    if (!empty(Input::get('id'))) {
        $id = Input::get('id');
        $where = array('id', '=', $id);
        //$state = new State();
        //$rows = $state->find($where);
        $page = new Page();
        $rows = $page->find($where);
        //print_r($rows);

        if (!$rows) {
            Redirect::to('pages.php');
        }

        $page_title     = $rows[0]->page_title;
        $page_name      = $rows[0]->page_name;
        $page_filename  = $rows[0]->page_filename;
        $display_menu   = $rows[0]->display_menu;
        $fa_menu_icon   = $rows[0]->fa_menu_icon;
        $display_order  = $rows[0]->display_order;
        $active_status  = $rows[0]->active_status;
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard<small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="pages.php">Pages</a></li>
            <li class="active">New</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <a href="pages.php" data-toggle="tooltip" title="Pages">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <form name="frmPage" id="frmPage" method="post" action="">
                            <div class="col-lg-6">
                                <div class="well">
                                    <div class="form-group">
                                        <label for="page_filename">Select Page</label>
                                        <select name="page_filename" id="page_filename" class="form-control">
                                            <option><?php echo $page_filename ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_title">Page Title</label>
                                        <input name="page_title" id="page_title" type="text" class="form-control" value="<?php echo $page_title;?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu_icon">Font Awesome Icon Class Name</label>
                                        <input name="menu_icon" id="menu_icon" type="text" class="form-control" value="<?php echo $fa_menu_icon;?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="display_menu">Display Menu</label>
                                        <select name="display_menu" id="display_menu" class="form-control">
                                            <option value="0" <?php if ($display_menu == 0) { echo "selected";}?>>0</option>
                                            <option value="1" <?php if ($display_menu == 1) { echo "selected";}?>>1</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="display_order">Display Order</label>
                                        <input name="display_order" id="display_order" type="number" class="form-control" value="<?php echo $display_order;?>"/>
                                        <span id="helpBlock" class="help-block">
                                            enter value in between 1-100
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="active_status">Active Status</label>
                                        <select name="active_status" id="active_status" class="form-control">
                                            <option value="0" <?php if ($active_status == 0) { echo "selected";}?>>0</option>
                                            <option value="1" <?php if ($active_status == 1) { echo "selected";}?>>1</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.well -->
                                <div class="form-group">
                                    <div class="visible-lg">
                                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save fa-fw"></i>  Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-lg-6 -->

                            <div class="col-lg-6">
                                <?php
                                    $icons = new Icon();
                                    $rows = $icons->getIcons();
                                ?>
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-falist">
                                        <thead>
                                        <tr>
                                            <th>Preview</th>
                                            <th>Class Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach ($rows as $row) {
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?php echo "<i class='fa " . $row->icon_class . "'></i>"; ?></td>
                                                    <td><?php echo $row->icon_class; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="form-group">
                                <div class="visible-sm visible-md visible-xs">
                                    <button type="submit" class="btn btn-lg btn-block btn-danger"><i class="fa fa-save fa-fw"></i>  Update</button>
                                </div>
                                <input type="hidden" name="pid" value="<?php echo $id; ?>">
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    }
}
?>

<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        var table = $('#dataTables-falist').DataTable();

        $('#dataTables-falist tbody').on( 'click', 'td', function () {
            var data = table.cell(this).data();
            //alert(data);
            var regex = new RegExp('^[a-z\-]');
            //alert(regex.test(data));
            if (regex.test(data)) {
                $('#menu_icon').val(data);
            }
        });


        $("#frmPage").validate({
            errorPlacement: function(error, element) {
                // append error within linked label
                $( element )
                    .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                    .append( error ).parent('div')
                    .addClass('has-error');
            },
            errorElement: "span",
            errorClass: "text-danger",
            validClass: "text-success",
            rules: {
                display_menu: {
                    required: true,
                },
                page_title: {
                    required: true,
                },
                display_order: {
                    required: true,
                    range: [0, 100]
                },
            },
            messages: {
                display_menu: {
                    required: " (required)",
                },
                page_title: {
                    required: " (required)",
                },
                display_order: {
                    required: " (required)",
                    range: " (enter a value between 0 and 100)",
                },
            }
        });
    });
</script>

<?php
if (count($messages) > 0) {
    foreach ($messages as $message) {
        //echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
        echo "<script>$.notify(\"$message\", { position:'top center', style:'bootstrap', className:\"$messages_class\" });</script>";
    }
}
?>