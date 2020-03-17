<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Reorder Menu<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reorder Menu</li>
        </ol>
    </section>

        <?php
            /* on form submission */
            //if (isset($_POST['do_submit']))
            if (Input::exists()) {
                /* split the value of the sortation */
                $ids = explode(',', $_POST['sort_order']);
                $pages = new Page();

                /* run the update query for each id */
                foreach ($ids as $index => $id) {
                    $id = (int) $id;
                    if ($id != '') {
                        $data = array (
                            'display_order' => $index + 1
                        );
                        $pages->update($data, $id);
                    }
                }

                /* now what? */
                if ($_POST['byajax']) {
                    die();
                } else {
                    $message = 'Sortation has been saved.';
                }
            }
        ?>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!--                            <a href="apikey_add.php" data-toggle="tooltip" title="Add New Group">-->
                        <!--                                <i class="fa fa-plus"></i> New API Key-->
                        <!--                            </a>-->
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form id="dd-form" action="" method="post">
                                <div class="col-lg-3">
                                        <ul class="list-group" id="sortable-list">
                                            <?php
                                                $pages = new Page();

                                                $where = array('display_menu', '=', '1');
                                                $rows = $pages->find($where);
                                                $order = array();
                                                foreach ($rows as $row) {
                                                    if ($user->hasPermission('pages', $row->page_name)) {
                                                        $order[] = $row->id;
                                            ?>
                                                        <li class="list-group-item" title="<?php echo $row->id;?>">
                                                            <i class="fa <?php echo $row->fa_menu_icon;?> fa-fw"></i> <?php echo $row->page_title;?>
                                                        </li>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </ul>
                                </div>
                                <div class="col-lg-3">
                                    <div id="message-box" class="alert alert-info">
                                        <?php //echo $message; ?> Waiting for sortation submission...
                                    </div>
                                    <hr/>
                                    <div class="checkbox">
                                        <label for="autoSubmit">
                                            <input type="checkbox" value="1" name="autoSubmit" id="autoSubmit" <?php if (Input::get('autoSubmit')) { echo 'checked="checked"';}?> />
                                            Automatically submit on drop event
                                        </label>
                                    </div>
                                    <hr/>
                                    <div class="form-group pull-right">
                                        <input type="hidden" name="sort_order" id="sort_order" value="<?php echo implode(',', $order); ?>" />
                                        <input type="submit" name="do_submit" value="Submit Sortation" class="btn btn-danger" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.js"></script>

<script type="text/javascript">
    /* when the DOM is ready */
    jQuery(document).ready(function() {
        /* grab important elements */
        var sortInput = jQuery('#sort_order');
        var submit = jQuery('#autoSubmit');
        var messageBox = jQuery('#message-box');
        var list = jQuery('#sortable-list');
        /* create requesting function to avoid duplicate code */
        var request = function() {
            jQuery.ajax({
                beforeSend: function() {
                    messageBox.text('Updating the sort order in the database.');
                },
                complete: function() {
                    messageBox.text('Database has been updated.');
                },
                data: 'sort_order=' + sortInput[0].value + '&ajax=' + submit[0].checked + '&do_submit=1&byajax=1', //need [0]?
                type: 'post',
                url: '<?php echo $_SERVER["REQUEST_URI"]; ?>'
            });
        };
        /* worker function */
        var fnSubmit = function(save) {
            var sortOrder = [];
            list.children('li').each(function(){
                sortOrder.push(jQuery(this).data('id'));
            });
            sortInput.val(sortOrder.join(','));
            if(save) {
                request();
            }
        };
        /* store values */
        list.children('li').each(function() {
            var li = jQuery(this);
            li.data('id',li.attr('title')).attr('title','');
        });
        /* sortables */
        list.sortable({
            opacity: 0.7,
            update: function() {
                fnSubmit(submit[0].checked);
            }
        });
        list.disableSelection();

        /* ajax form submission */
        jQuery('#dd-form').bind('submit',function(e) {
            if(e) e.preventDefault();
            fnSubmit(true);
        });
    });
</script>
