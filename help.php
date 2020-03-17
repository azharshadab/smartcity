<?php require 'header.php';?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Help<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Help</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            TODO List
                        </div>
                        <div class="box-body">
                            <ol>
                                <li>Widget Display Permission</li>
                                <li>Hide Humidity/Temperature for Users</li>
                                <li>Billing System</li>
<!--                                <li>Demand Response</li>-->
<!--                                <li>AMI Server Data for Home Meters</li>-->
<!--                                <li>SCADA Server Data for 33kV/SubStations [Grid Load / Sub Station Load]</li>-->
<!--                                <li>Omnik Solar Data</li>-->
<!--                                <li>Appliances List</li>-->
<!--                                <li>Control Home Automation Devices via API</li>-->
                                <li>Send Notifications (Android/Web/SMS) to Users</li>
                                <li>Cronjob
                                    <ul>
                                        <li>SCADA Peak [Normal/Critical/Emergency]</li>
                                    </ul>
                                </li>
                                <li>API for Android App
                                    <ul>
                                        <li>Login</li>
                                        <li>User Detail</li>
                                        <li>Device Registration for Firebase Notification</li>
                                        <li>Omnik Solar Data</li>
                                    </ul>
                                </li>
<!--                                <li>Google Play Store Registration - iitk.smartcity@gmail.com</li>-->
<!--                                <li>Automatic Scheduling based on Time + Solar Generation</li>-->
                                <li>Peak Load Notification for All IITK</li>
                                <li>Invoice</li>
                                <li>Heat Map to Show Electricity Uses</li>
                                <li>Preferences: Dashboard widgets hide/show</li>
<!--                                <li>New Tables-->
<!--                                    <ul>-->
<!--                                        <li>smc_appliances</li>-->
<!--                                        <li>smc_appliances_company</li>-->
<!--                                        <li>smc_appliances_power_consumption</li>-->
<!--                                        <li>smc_dr_switches</li>-->
<!--                                        <li>smc_houses</li>-->
<!--                                        <li>smc_houses_meter</li>-->
<!--                                        <li>smc_meter_master</li>-->
<!--                                        <li>smc_meter_reading_data</li>-->
<!--                                        <li>smc_temperature</li>-->
<!--                                    </ul>-->
<!--                                </li>-->
                            </ol>

<pre>
Formula:
Electricity Unit = (30 x n x W x H) / 1000
Where, W = Energy Consumption Unit (watts) H = Time (hours) n = Number of Appliances
</pre>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php require 'footer.php';?>
