<?php include 'header.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Solar Data<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Solar Data</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr class="bg-light-blue-active color-palette">
                                    <th>Status</th>
                                    <th>House Image</th>
                                    <th>House Number</th>
                                    <th>Power Now (kW)</th>
                                    <th>Total Energy (kWh)</th>
                                    <th>Updated Time</th>
                                </tr>
                            </thead>
                            <tbody id="omnik_data"></tbody>
                        </table>
                    </div>
                    <div class="overlay" id="refresh_data"><i class="fa fa-refresh fa-spin"></i></div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>

<style>
    .table > tbody > tr > td {
        vertical-align: middle;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "/omnik_data/json_data.php",
            success: function (data) {
                $('#refresh_data').hide();
                var items = [];

                $.each( data.data, function( key, val ) {
                    // console.log(val);
                    var cssColorClass = 'bg-green color-palette';

                    if (val.power_now == 0) {
                        cssColorClass = 'bg-aqua color-palette';
                    }

                    if (val.status == 'http://www.omnikportal.com/images/pw_nomsg.png') {
                        cssColorClass = 'bg-yellow color-palette';
                    }

                    if (val.total_energy == 0) {
                        cssColorClass = 'bg-red color-palette';
                    }

                    $("#omnik_data").append(
                        "<tr class='" + cssColorClass + "'><td><img src='"+
                        val.status +"'></td><td><a data-toggle='lightbox' href='"+
                        val.house_image +"'><img class='img-rounded' width='75px' src='"+
                        val.house_image +"'></a></td><td>"+ val.house_number +"</td><td>"+
                        val.power_now +"</td><td>"+ val.total_energy +"</td><td>"+
                        val.update_time +"</td></tr>"
                    );
                });

                $("#omnik_data").append("<tr class='bg-light-blue-active color-palette'><td colspan='3'>Total</td><td>"+ data.total_power_now +" kW</td><td>"+ data.grand_total_energy +" kWh</td><td></td></tr>");
            }
        });
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js"></script>
