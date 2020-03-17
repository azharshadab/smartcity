<?php include 'header.php'; ?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'rules' => array (
                'state_name' => array (
                    'required' => true,
                    //'unique' => 'pr_states',
                ),
            ),
        ));

        if ($validation->passed()) {

            $data = array(
                'state_code' => Input::get('state_code', true),
                'state_name' => Input::get('state_name', true),
                'state_capital' => Input::get('state_capital', true),
                'subdivision_category' => Input::get('subdivision_category', true),
            );

            try {
                $state = new State();
                $state->update($data, Input::get('sid'));

                Session::put('fclass', 'success');
                Session::flash('fmsg', 'Successful!');
                Redirect::to('states.php');
            } catch (Exception $e) {
                $messages[] = $e->getMessage();
            }
        } else {
            $messages_class = 'danger';
            $messages = $validation->errors();
        }
    }
}

if (count($messages) > 0) {
    foreach ($messages as $message) {
        echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
    }
}

if (Input::exists('get')) {
    if (!empty(Input::get('id'))) {
        $id = Input::get('id');
        $where = array('id', '=', $id);
        $state = new State();
        $rows = $state->find($where);
        //print_r($rows);

        if (!$rows) {
            Redirect::to('states.php');
        }

        $state_code = $rows[0]->state_code;
        $state_name = $rows[0]->state_name;
        $state_capital = $rows[0]->state_capital;
        $subdivision_category = $rows[0]->subdivision_category;
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header visible-lg">Edit State
                    <span class="pull-right">
						<a class="btn btn-primary" href="states.php"><i class="fa fa-chevron-left fa-fw"></i> States</a>
	                </span>
                </h3>
                <h3 class="page-header hidden-lg">Edit State</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <form name="frmState" id="frmState" method="post" action="">
            <div class="col-lg-6">
                <div class="well">
                    <div class="form-group">
                        <label for="state_name">State Name</label>
                        <input name="state_name" id="state_name" type="text" class="form-control" value="<?php echo $state_name;?>"/>
                    </div>
                    <div class="form-group">
                        <label for="state_capital">State Capital</label>
                        <input name="state_capital" id="state_capital" type="text" class="form-control" value="<?php echo $state_capital;?>"/>
                    </div>
                    <div class="form-group">
                        <label for="state_code">State Code</label>
                        <input name="state_code" id="state_code" type="text" class="form-control" value="<?php echo $state_code;?>"/>
                    </div>
                    <div class="form-group">
                        <label for="subdivision_category">Subdivision Category</label>
                        <input name="subdivision_category" id="subdivision_category" type="text" class="form-control" value="<?php echo $subdivision_category;?>"/>
                    </div>
                </div>
                <!-- /.well -->
                <div class="form-group">
                    <div class="visible-lg">
                        <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save fa-fw"></i>  Save</button>
                    </div>
                    <div class="visible-sm visible-md visible-xs">
                        <button type="submit" class="btn btn-lg btn-block btn-danger"><i class="fa fa-save fa-fw"></i>  Save</button>
                    </div>
                    <input type="hidden" name="sid" value="<?php echo $id; ?>">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                </div>
            </div>
            <!-- /.col-lg-6 -->
            </form>
        </div>
        <!-- /.row -->

        <div class="row hidden-lg">
            <div class="col-lg-12">
                <hr/>
                <a class="btn btn-block btn-lg btn-primary" href="states.php"><i class="fa fa-caret-left fa-fw"></i> States</a>
                <br/>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php
    }
}
?>

<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        $("#frmState").validate({
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
                state_name: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                state_name: {
                    required: " (required)",
                    minlength: " (State must consist of at least 2 characters)"
                }
            }
        });
    });
</script>
