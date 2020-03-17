<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Tariff<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Tariff</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="#" data-toggle="tooltip" title="Add New Group">
                            <i class="fa fa-plus"></i> New Tariff
                        </a>
                    </div>
                    <div class="box-body">
                        <select>
                            <option value="-1">-- Select Tariff Type --</option>
                            <option value="Residential">Residential</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Institutional">Institutional</option>
                            <option value="Large Residential">Large Residential</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>
