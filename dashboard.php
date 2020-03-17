
<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard<small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="total_power_now" ></h3>
                        <span id="refresh_power_now">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>
                         Today's Solar Energy (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-sunny"></i>
                    </div>
                    <a href="omnik_solar_data.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="grid_load"></h3>
                        <span id="refresh_grid_load">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Current Grid Load (kW)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="grid_load_date">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="max_grid_load"></h3>
                        <span id="refresh_max_grid_load">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Max Grid Load (kW)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="max_grid_load_date">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="min_grid_load"></h3>
                        <span id="refresh_min_grid_load">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Min Grid Load (kW)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="min_grid_load_date">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>  
            </div>
        </div>

        <?php
        $url = "http://".Config::get('mdm/server_ip').":".Config::get('mdm/port')."/mdmapi/api/mdm/consumer/get/applianceinfo/mindteck?Consumer_CID=".$user->data()->consumer_id;
        $context = stream_context_create(array(
            'http' => array(
                // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
                'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
            )
        ));
        $data = file_get_contents($url, false, $context);
        $arr_json = json_decode($data, true);
        //print_r($arr_json);
        ?>
        <div class="row">
            <?php
            $col_lg = '12';
            if (!in_array('Silvan-Sirus', array_column($arr_json['Result']['AIData'], 'Make_Name'))) {
                $col_lg = '12';
            }
            ?>
            <section class="col-lg-<?php echo $col_lg;?>">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-lightbulb-o"></i><i class="far fa-lightbulb"></i> Light Control</h3>
                    </div>
                    <div class="box-body">
                        <?php
                        $i = 1;
                        foreach ($arr_json['Result']['AIData'] as $sm) {
                            if ($sm['Make_Name'] == "Silvan-Lumo") {
                                ?>
                               <button style="width: 24.5%" class="btn btn-primary btn-lg btn-space btnLight" data-id="<?php echo $sm['ConsumerApplianceLoad_ID'];?>" data-type="false"><i
                                            class="fa fa-power-off" ></i>  <?php echo $sm['Location'];echo $i;?> 
                                </button>


                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

            <?php
            $j = 1;
            foreach ($arr_json['Result']['AIData'] as $sm) {
                if ($sm['Make_Name'] == "Silvan-Sirus") {
                    ?>
                    <section class="col-lg-3">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-snowflake-o"></i><i class="far fa-snowflake"></i><?php echo $sm['Location'];echo $j;?> </h3>
                            </div>
                            <div class="box-body">
                                <button class="btn btn-success btn-lg btn-space btnLight" data-id="<?php echo $sm['ConsumerApplianceLoad_ID'];?>" data-type="true"><i class="fa fa-power-off"></i> AC ON</button>
                                <button class="btn btn-danger  btn-lg btn-space btnLight" data-id="<?php echo $sm['ConsumerApplianceLoad_ID'];?>" data-type="false"><i class="fa fa-power-off"></i> AC OFF</button>
                            </div>
                        </div>
                    </section>
                    <?php
                    $j++;
                }
            }
            ?>
        </div>
        <div class="row">
            <section class="col-lg-6 connectedSortable ui-sortable">
                <div class="box box-success">
                    <div class="box-header with-border ui-sortable-handle" style="cursor: move;">
                        <h3 class="box-title">
                            <i class="ion ion-ios-sunny"></i> Solar Power Generation Data
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <button class="btn btn-primary btn-xs btnRange" data-type="day">Today</button>
                                <button class="btn btn-warning btn-xs btnRange" data-type="yesterday">Yesterday</button>
                                <button class="btn btn-danger btn-xs btnRange" data-type="week">Week</button>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="solar_data_graph" style="height: 250px;"></div>
                    </div>
                    <div class="overlay" id="refresh_solar_data_graph">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                    <div class="box-footer no-border">
                        <div class="row">
                            <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                                <h3 id="solar_load_now">0.00 kWh</h3>
                                <div>Now</div>
                            </div>
                            <div class="col-xs-6 text-center">
                                <h3 id="solar_overall_load">0.00 kWh</h3>
                                <div>Since Dec 2016</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> IITK Grid Load
                        </h3>
<!--                        <div class="box-tools pull-right">-->
<!--                            <button type="button" class="btn btn-box-tool" data-widget="collapse">-->
<!--                                <i class="fa fa-minus"></i>-->
<!--                            </button>-->
<!--                        </div>-->
                    </div>
                    <div class="box-body">
                        <div id="scada_data_graph" style="height: 250px;"></div>
                    </div>
                    <div class="overlay" id="refresh_scada_data_graph">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                    <div class="box-footer no-border">
                        <div class="row">
                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                <h3 id="scada_load_now">0.00 kW</h3>
                                <div>Now</div>
                            </div>
                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                <h3 id="scada_maximum_load">0.00 kW</h3>
                                <div>Maximum</div>
                            </div>
                            <div class="col-xs-4 text-center">
                                <h3 id="scada_minimum_load">0.00 kW</h3>
                                <div>Minimum</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> Sub Station Load
                        </h3>
<!--                        <div class="box-tools pull-right">-->
<!--                            <button type="button" class="btn btn-box-tool" data-widget="collapse">-->
<!--                                <i class="fa fa-minus"></i>-->
<!--                            </button>-->
<!--                        </div>-->
                    </div>
                    <div class="box-body">
                        <div id="ss_data_graph" style="height: 250px;"></div>
                    </div>
                    <div class="overlay" id="refresh_scada_ss_data_graph">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                    <div class="box-footer no-border visible-lg">
                        <div class="row">
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#17202A">
                                <h3 id="data_sp1">0.00 kW</h3>
                                <div>Sub Station P1</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:green">
                                <h3 id="data_sp2">0.00 kW</h3>
                                <div>Sub Station P2</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#FF4500">
                                <h3 id="data_ss2">0.00 kW</h3>
                                <div>Sub Station 2</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#590099">
                                <h3 id="data_ss3">0.00 kW</h3>
                                <div>Sub Station 3</div>
                            </div>
                            <div class="col-xs-2 text-center" style="border-right: 1px solid #f4f4f4;color:#0E6655">
                                <h3 id="data_ss4">0.00 kW</h3>
                                <div>Sub Station 4</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#479e00">
                                <h3 id="data_ss5">0.00 kW</h3>
                                <div>Sub Station 5</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#c9024b">
                                <h3 id="data_ss6">0.00 kW</h3>
                                <div>Sub Station 6</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:blue">
                                <h3 id="data_ss7">0.00 kW</h3>
                                <div>Sub Station 7</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#D68910">
                                <h3 id="data_ss8">0.00 kW</h3>
                                <div>Sub Station 8</div>
                            </div>
                            <div class="col-xs-1 text-center" style="border-right: 1px solid #f4f4f4;color:#0098bf">
                                <h3 id="data_ss9">0.00<sup>kW</sup></h3>
                                <div>Sub Station 9</div>
                            </div>
                            <div class="col-xs-1 text-center" style="color:red">
                                <h3 id="data_ss10">0.00 kW</h3>
                                <div>Sub Station 10</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            //$scada = new ScadaData();
            //$peak_load = $scada->getPeakLoad();
            //print_r($peak_load);
            ?>
<!--            <div class="col-lg-3">-->
<!--                <div class="box box-warning">-->
<!--                    <div class="box-header with-border">-->
<!--                        <h3 class="box-title"><i class="ion ion-ios-bolt"></i> Peak Load Price</h3>-->
<!--                    </div>-->
<!--                    <div class="box-body">-->
<!--                        <ul class="list-group">-->
<!--                            <li class="list-group-item">-->
<!--                                <span class="badge label-danger" id="b_peak_load"></span>PEAK LOAD-->
<!--                            </li>-->
<!--                            <li class="list-group-item">-->
<!--                                <span class="badge" id="b_start_time"></span>START TIME-->
<!--                            </li>-->
<!--                            <li class="list-group-item">-->
<!--                                <span class="badge" id="b_end_time"></span>END TIME-->
<!--                            </li>-->
<!--                            <li class="list-group-item">-->
<!--                                <span class="badge" id="b_peak_priced"></span>PEAK PRICED-->
<!--                            </li>-->
<!--                            <li class="list-group-item">-->
<!--                                <span class="badge" id="b_maximum_demand"></span>MAXIMUM DEMAND-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="overlay" id="refresh_scada_peak_price">-->
<!--                        <i class="fa fa-refresh fa-spin fa-2x"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="small-box bg-primary">-->
<!--                    <div class="inner text-center">-->
<!--                        <h3 id="date"></h3>-->
<!--                        <h3 id="time"></h3>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <iframe width="100%" height="100%" frameborder="0" src="https://app.ubidots.com/ubi/public/getdashboard/LP6xqSQuRS8XhxX9xuzZImmifJY"></iframe>-->
        </div>
    </section>
</div>

<?php require 'footer.php';?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    $(document).ready(function() {
        $('#refresh_solar_data_graph').show();
        $('#refresh_scada_data_graph').show();
        $('#refresh_scada_ss_data_graph').show();
        $('#refresh_scada_peak_price').show();

        setInterval(function () {
            getGridLoad();
            //getSolarData();
            getSubStaionCurrentLoad();
            // getPeakPriceData();
        }, 10000);

        setInterval(function () {
            loadSolarChartData('day');
            loadScadaCharData();
            loadScadaSSCharData();
        }, 250000);

        loadSolarChartData('day');
        loadScadaCharData();
        loadScadaSSCharData();
        // getSubStaionCurrentLoad();
        //getSolarData();
        // getGridLoad();

        $('button.btnRange').on('click', function(e) {
            var type = $(this).data('type');
            loadSolarChartData(type);
        });

        $('button.btnLight').on('click', function(e) {
            var switch_id = $(this).data('id');
            var mode = $(this).data('type');
            console.log(switch_id + '  ' + mode);
            toggleSwitch(switch_id, mode);
        });

        function toggleSwitch(switch_id, mode) {
            $.ajax({
                url: "jq_toggle_switch.php?switch="+switch_id+"&mode="+mode,
                success: function (data) {
                },
                error: function(data) {
                    console.log('Error: switch');
                }
            });
        }

        function loadSolarChartData(type) {
            console.log("getting solar chart data...");
            $('#solar_data_graph').empty();
            $('#refresh_solar_data_graph').show();

            $.ajax({
                url: "jq_solar_data.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);

                    $('#refresh_power_now').hide();
                    $('#total_power_now').html(chart_data.meta.power_today);
                    $('#solar_load_now').html(chart_data.meta.power_now + ' kW');
                    $('#solar_overall_load').html(chart_data.meta.power_total + ' MWh');

                    $('#refresh_solar_data_graph').hide();
                    Morris.Area({
                        element: 'solar_data_graph',
                        resize: true,
                        data: chart_data.chart,
                        xkey: 'date',
                        ykeys: ['value'],
                        labels: ['PV Power'],
                        postUnits: ' kW',
                        lineColors: ['#229954', '#3c8dbc'],
                        hideHover: 'true',
                        pointSize: 0
                    });
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

//        function getSolarData() {
//            $.ajax({
//                type: "GET",
//                url: "/omnik_data/json_data.php",
//                //url: "jq_json_solar_data.php",
//                success: function (data) {
//                    $('#refresh_power_now').hide();
//                    //$('#total_power_now').html(data.total_power_now + ' / ' + data.grand_total_energy);
//                    $('#total_power_now').html(data.total_power_now);
//                    $('#solar_overall_load').html(data.grand_total_energy + ' kWh');
//
//                    var pn = '0.00 kW';
//                    if (data.total_power_now != 0) {
//                        pn = data.total_power_now + ' kW';
//                    } else {
//                        $('#total_power_now').html('0.00');
//                    }
//                    $('#solar_load_now').html(pn);
//                }
//            });
//        }

        // function getPeakPriceData() {
        //     $.ajax({
        //         type: "GET",
        //         url: "jq_get_peak_data.php",
        //         success: function (data) {
        //             $('#refresh_scada_peak_price').hide();
        //             // console.log(data);
        //             $("#b_peak_load").html(data.peak_load_curr_val_f + " kW");
        //             $("#b_start_time").html(data.start_time_curr_val_f);
        //             $("#b_end_time").html(data.end_time_curr_val_f);
        //             $("#b_peak_priced").html("&#8377; " + data.peak_price_curr_val_f);
        //             $("#b_maximum_demand").html(data.md_limit_curr_val_f);
        //         },
        //         error: function(data) {}
        //     });
        // }

        function loadScadaCharData() {
            console.log("getting 33kv chart data...");
            $('#scada_data_graph').empty();
            $('#refresh_scada_data_graph').show();
            $.ajax({
                url: "jq_get_scada_data.php?a=scada",
                success: function (chart_data) {
                    $('#refresh_scada_data_graph').hide();
                    new Morris.Area({
                        element: 'scada_data_graph',
                        data: chart_data,
                        xkey: 'date',
                        ykeys: ['value'],
                        labels: ['IITK Load'],
                        postUnits: ' kW',
                        parseTime: true,
                        lineColors: ['red'],
                        resize: true,
                        hideHover: 'true',
                        pointSize: 0
                    });
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

        function loadScadaSSCharData() {
            console.log("getting sub station chart data...");
            $('#ss_data_graph').empty();
            $('#refresh_scada_ss_data_graph').show();
            $.ajax({
                url: "jq_get_scada_data.php?a=scada_ss",
                success: function (chart_data) {
                    console.log(chart_data);
                    $('#refresh_scada_ss_data_graph').hide();
                    new Morris.Area({
                        element: 'ss_data_graph',
                        data: chart_data,
                        xkey: 'date',
                        ykeys: ['sp1','sp2','ss2','ss3','ss4', 'ss5', 'ss6', 'ss7', 'ss8','ss9', 'ss10'],
                        labels: ['Sub Station Part1', 'Sub Station Part2', 'Sub Station 2', 'Sub Station 3', 'Sub Station 4', 'Sub Station 5', 'Sub Station 6', 'Sub Station 7', 'Sub Station 8', 'Sub Station 9','Sub Station 10'],
                        postUnits: ' kW',
                        parseTime: true,
                        lineColors: ['#17202A', 'green', '#FF4500', '#590099', '#0E6655', '#479e00', '#c9024b', 'blue', '#D68910', '#0098bf','red'],
                        fillOpacity: 0.8,
                        resize: true,
                        hideHover: 'true',
                        pointSize: 0
                    });
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

        function getSubStaionCurrentLoad() {
            $.ajax({
                url: "jq_get_scada_data.php?a=scada_ss_cl",
                success: function (data) {
                    //console.log(data);
                    $('#data_sp1').html(data.SP1+'<sup>kW</sup>');
                    $('#data_sp2').html(data.SP2+'<sup>kW</sup>');
                    $('#data_ss2').html(data.SS2+'<sup>kW</sup>');
                    $('#data_ss3').html(data.SS3+'<sup>kW</sup>');
                    $('#data_ss4').html(data.SS4+'<sup>kW</sup>');
                    $('#data_ss5').html(data.SS5+'<sup>kW</sup>');
                    $('#data_ss6').html(data.SS6+'<sup>kW</sup>');
                    $('#data_ss7').html(data.SS7+'<sup>kW</sup>');
                    $('#data_ss8').html(data.SS8+'<sup>kW</sup>');
                    $('#data_ss9').html(data.SS9+'<sup>kW</sup>');
                    $('#data_ss10').html(data.SS10+'<sup>kW</sup>');
                    //console.log(data);
                    //console.log(data.SP1);
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

        function getGridLoad() {
            $.ajax({
                type: "GET",
                url: "jq_get_scada_data.php",
                success: function (data) {
                    $('#refresh_grid_load').hide();
                    $('#refresh_max_grid_load').hide();
                    $('#refresh_min_grid_load').hide();
                    $('#grid_load').html(data.current_load);
                    $('#grid_load_date').html(data.current_load_time);
                    $('#max_grid_load').html(data.max_load);
                    $('#max_grid_load_date').html(data.max_load_time);
                    $('#min_grid_load').html(data.min_load);
                    $('#min_grid_load_date').html(data.min_load_time);
                    $('#scada_load_now').html(data.current_load);
                    $('#scada_maximum_load').html(data.max_load);
                    $('#scada_minimum_load').html(data.min_load);
                },
                error: function() {
                    console.log('Error: jq_get_data');
                }
            });
        }
    });
</script>
