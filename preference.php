<?php require 'header.php';?>

<?php
$messages = array();
$messages_class = 'warn';

$dr_participation = $user->data()->dr_participation;

if (Input::exists()) {
    $data = array(
        'dr_participation' => Input::get('dr')
    );

    try {
        $user->update($data, $user->data()->id);
        $dr_participation = Input::get('dr');

        $messages[] = "Setting saved.";
        $messages_class = "success";
    } catch (Exception $e) {
        $messages[] = $e->getMessage();
    }
}
?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Preference<small>control system personal settings</small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Preference</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">DR Program Participation</h3>
                        </div>

                        <div class="box-body">
                            <form method="post" action="" name="frmDemandResponse">
                                <div class="form-group">
                                    <label for="dr">Do you want to participate in demand response program?</label>
                                    <select class="form-control" name="dr" title="Demand Response">
                                        <option value="yes" <?php echo ($dr_participation == 'yes') ? 'selected':'';?>>Yes</option>
                                        <option value="no" <?php echo ($dr_participation == 'no') ? 'selected':'';?>>No</option>
                                    </select>
                                </div>
                                <button class="btn btn-danger pull-right"><i class="fa fa-save"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
<!--                <div class="col-lg-3">-->
<!--                    <div class="box">-->
<!--                        <div class="box-header with-border">-->
<!--                            <h3 class="box-title"></h3>-->
<!--                        </div>-->
<!--                        <div class="box-body"></div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </section>
    </div>

<?php require 'footer.php'; ?>

<?php
if (count($messages) > 0) {
    foreach ($messages as $message) {
        //echo "<script>$.notify(\"{$message}\", \"{$messages_class}\");</script>";
        echo "<script>$.notify(\"$message\", { position:'top center', style:'bootstrap', className:\"$messages_class\" });</script>";
    }
}
?>
