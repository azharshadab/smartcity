<?php require 'header.php';?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $json = array();
        
        $page = new Page();
        $rows = $page->getPages();
        foreach ($rows as $row) {
            $json['pages'][$row->page_name] = false;
        }
        
        if (!empty(Input::get('pages'))) {
            foreach (Input::get('pages') as $p) {
                $json['pages'][$p] = true;
            }
        }
        
        if (Input::get('access_level') == 10) {
            $page = new Page();
            $rows = $page->getPages();
            foreach ($rows as $row) {
                $json['pages'][$row->page_name] = true;
            }
        }
        
        $permissions = json_encode($json);
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'user_role' => array (
                    'required' => true,
                ),
            ),
        ));
        
        if ($validation->passed()) {
            $data = array(
                'user_role' => ucwords(Input::get('user_role')),
                'access_level' => Input::get('access_level'),
                'permissions' => strtolower($permissions)
            );
            
            try {
                $group = new Group();
                $group->update($data, Input::get('gid'));
                
                Session::put('fclass', 'success');
                Session::flash('fmsg', 'Successful!');
                Redirect::to('groups.php');
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
        $group = new Group();
        $rows = $group->find($where);
        
        if (!$rows) {
            Redirect::to('groups.php');
        }
        
        $user_role = $rows[0]->user_role;
        $permissions = $rows[0]->permissions;
        $access_level = $rows[0]->access_level;
        ?>
    
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Dashboard<small>Control panel</small></h1>
                <ol class="breadcrumb">
                    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="groups.php">Groups</a></li>
                    <li class="active">Edit</li>
                </ol>
            </section>
                
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <a class="pull-right" href="groups.php" data-toggle="tooltip" title="Groups">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <form name="frmGroup" id="frmGroup" method="post" action="">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user_role">User Role</label>
                                        <input name="user_role" id="user_role" type="text" class="form-control" value="<?php echo $user_role;?>" <?php if ($access_level == 10) { echo "readonly";}?>/>
                                    </div>
                                    <div class="form-group">
                                        <label for="access_level">Access Level</label>
                                        <?php
                                        $group = new Group();
                                        $gs = $group->getGroups();
                                        $levels = array();
                                        foreach ($gs as $g) {
                                            $levels[$g->access_level] = $g->user_role;
                                        }
                                        ?>
                                        <select name="access_level" id="access_level" class="form-control">
                                            <?php
                                            for ($i = 1; $i <= 10; $i++) {
                                                if (array_key_exists($i, $levels)) {
                                                    ?>
                                                    <option <?php if ($access_level == 10) { if ($i != 10) { echo "disabled";}} else { if($i == 10) { echo "disabled";} }?> value="<?php echo $i;?>" <?php echo ($access_level == $i) ? 'selected':'';?>><?php echo $i . ' - ' . $levels[$i];?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option <?php if ($access_level == 10) { if ($i != 10) { echo "disabled";}} else { if($i == 10) { echo "disabled";} }?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-lg-6">
                                    <?php
                                    $page = new Page();
                                    $pages = $page->getPages();
                                    $access_pages = json_decode($permissions, true);
                    
                                    foreach ($pages as $p) {
                                        if (array_key_exists('pages', $access_pages)) {
                                            $pg = (array_key_exists($p->page_name, $access_pages['pages'])) ? $access_pages['pages'][$p->page_name]:false;
                                        } else {
                                            $pg = false;
                                        }
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input name="pages[]" <?php if ($pg == true) { echo 'checked="checked"';}?> type="checkbox" value="<?php echo $p->page_name;?>">
                                                <?php echo ucwords($p->page_title);?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-footer">
                            <input type="hidden" name="gid" value="<?php echo $id;?>">
                            <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <?php
    }
}
?>

<?php require 'footer.php';?>

<script>
    $(document).ready(function() {
        $("#frmGroup").validate({
            errorPlacement: function(error, element) {
                // Append error within linked label
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
                user_role: {
                    required: true
                }
            },
            messages: {
                user_role: {
                    required: " (required)"
                }
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
