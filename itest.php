 <?php require 'header.php';?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Consumer<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Help</li>
            </ol>
        </section>

         
                       
              
                        
                        
         <?php
        // $url = "http://".Config::get('mdm/server_ip').":".Config::get('mdm/port')."mdmapi/api/mdm/consumer/get/lsdata/mindteck?Consumer_CID=".$user->data()->consumer_id."&StartDate=25-09-2018&EndDate=29-09-2018";
           //   $url = "http://".Config::get('mdm/server_ip').":".Config::get('mdm/port')."/mdmapi/api/mdm/consumer/get/applianceinfo/mindteck?Consumer_CID=".$user->data()->consumer_id;
          $url = "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/lsdata/mindteck?ConsumerID=LT0442T4&StartDate=25-12-2018&EndDate=25-12-2018";
         // echo $url;
        $context = stream_context_create(array(
            'http' => array(
                // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
                'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
            )
        ));
        $data = file_get_contents($url, false, $context);
        $arr_json = json_decode($data, true);
      
        $i = 0;
        $k=0;
        
      foreach ($arr_json['Result']['LSData'] as $d) {
        $return_data['chart'][$i]['date'] = $d['MeterReading_DateTime'];
       $c1 = $d['ACT_IMP_TOT'] ;
       
        $k= $k+ $d['ACT_IMP_TOT'];    
        $return_data['chart'][$i]['value'] = $k;
        
        
            
        $i++;
        //echo $k;
        
        }
         echo json_encode($return_data);
        
        ?>
       
       
                 
                 
        <div class="row">
            <div class="col-sm-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="total_power_now"></h3>
                        <span id="refresh_power_now">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>
                         Power Today (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-sunny"></i>
                    </div>
                    <a href="omnik_solar_data.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
       
       
         <div class="row">
            <section class="col-lg-6 connectedSortable ui-sortable">
                <div class="box box-solid box-success">
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
                <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> Grid Power Consumption
                        </h3>
<!--                        <div class="box-tools pull-right">-->
<!--                            <button type="button" class="btn btn-box-tool" data-widget="collapse">-->
<!--                                <i class="fa fa-minus"></i>-->
<!--                            </button>-->
<!--                        </div>-->
                    </div>
                    <div class="box-body">
                        <div id="ls_data_graph" style="height: 250px;"></div>
                    </div>
                    <div class="overlay" id="refresh_scada_data_graph">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                    <div class="box-footer no-border">
                        <div class="row">
                           
                            <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                                <h3 id="tot_consumption">0.00 kW</h3>
                                <div>Maximum</div>
                            </div>
                            <div class="col-xs-6 text-center">
                                <h3 id="scada_minimum_load">0.00 kW</h3>
                                <div>Minimum</div>
                            </div>
                        </div>
                    </div>
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
            loadLsChartData();
        }, 250000);

        loadSolarChartData('day');
        loadScadaCharData();
        loadScadaSSCharData();
        loadLsChartData();
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
                    //console.log(chart_data);

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
                        labels: ['Power Today'],
                        lineColors: ['#3c8dbc', '#3c8dbc'],
                        hideHover: 'true',
                        pointSize: 0
                    });
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
        
        
  /*       function loadLsChartData() {
            console.log("getting solar chart data...");
            $('#solar_data_graph').empty();
            $('#refresh_solar_data_graph').show();

            $.ajax({
                url: "jq_ls_data.php",
                success: function (chart_data) {
                    //console.log(chart_data);

                    $('#refresh_power_now').hide();
                    $('#total_power_now').html(chart_data.meta.power_today);
                    $('#solar_load_now').html(chart_data.meta.power_now + ' kW');
                    $('#solar_overall_load').html(chart_data.meta.power_total + ' MWh');

                    $('#refresh_solar_data_graph').hide();
                    Morris.Bar({
                        element: 'ls_data_graph',
                        resize: true,
                        data: chart_data.chart,
                        xkey: 'date',
                        ykeys: ['value'],
                        labels: ['Power Today'],
                        lineColors: ['#3c8dbc', '#3c8dbc'],
                        hideHover: 'true',
                        pointSize: 0
                    });
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
        
      */
      
      function loadLsChartData() {
            console.log("getting solar chart data...");
            var complex = <?php echo json_encode($return_data); ?>;
          //  window.alert(complex);
            
                    Morris.Bar({
                        element: 'ls_data_graph',
                        resize: true,
                        data: complex,
                        xkey: 'date',
                        ykeys: ['value'],
                        labels: ['Power Today'],
                        lineColors: ['#3c8dbc', '#3c8dbc'],
                        hideHover: 'true',
                        pointSize: 0
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
                        ykeys: ['sp1','sp2','ss2','ss3','ss4', 'ss5', 'ss6', 'ss7', 'ss8', 'ss10'],
                        labels: ['Sub Station Part1', 'Sub Station Part2', 'Sub Station 2', 'Sub Station 3', 'Sub Station 4', 'Sub Station 5', 'Sub Station 6', 'Sub Station 7', 'Sub Station 8', 'Sub Station 10'],
                        postUnits: ' kW',
                        parseTime: true,
                        lineColors: ['red', 'green', 'blue', '#590099', '#008279', '#479e00', '#008a8e', '#a50478', '#c9024b', '#0098bf'],
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

