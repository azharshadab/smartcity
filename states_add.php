<?php include 'header.php'; ?>

<?php
$messages = array();
$messages_class = 'warn';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'rules' => array (
                'state_name' => array (
                    'required' => true,
                    'unique' => 'pcp_states',
                ),
            ),
        ));

        if ($validation->passed()) {

            $data = array(
                'state_name'    => Input::get('state_name'),
                'state_capital' => Input::get('state_capital', true),
                'state_code'    => Input::get('state_code', true),
                'subdivision_category' => Input::get('subdivision_category', true),
                'active_status' => '0',
                'date_created'  => date("Y-m-d H:i:s"),
                'created_by'    => $user->data()->id,
            );

            try {
                $state = new State();
                $state->create($data);

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
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>New State<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New State</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">
                            <a href="states.php" data-toggle="tooltip" title="Groups">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <form name="frmState" id="frmState" method="post" action="">
                                <div class="col-lg-6">
                                    <div class="well">
                                        <div class="form-group">
                                            <label for="state_name">State Name</label>
                                            <input name="state_name" id="state_name" type="text" class="form-control" value="<?php echo Input::get('state_name');?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="state_capital">State Capital</label>
                                            <input name="state_capital" id="state_capital" type="text" class="form-control" value="<?php echo Input::get('state_capital');?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="state_code">State Code</label>
                                            <input name="state_code" id="state_code" type="text" class="form-control" value="<?php echo Input::get('state_code');?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="subdivision_category">Subdivision Category</label>
                                            <input name="subdivision_category" id="subdivision_category" type="text" class="form-control" value="<?php echo Input::get('subdivision_category');?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="visible-lg">
                                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save fa-fw"></i>  Save</button>
                                        </div>
                                        <div class="visible-sm visible-md visible-xs">
                                            <button type="submit" class="btn btn-lg btn-block btn-danger"><i class="fa fa-save fa-fw"></i>  Save</button>
                                        </div>
                                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
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

<?php
if (count($messages) > 0) {
    foreach ($messages as $message) {
        //echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
        echo "<script>$.notify(\"$message\", { position:'top center', style:'bootstrap', className:\"$messages_class\" });</script>";
    }
}
?>