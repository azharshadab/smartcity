 <?php require 'header.php';?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Consumer<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Help</li>
            </ol>
        </section>

       <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="total_power_yesterday"></h3>
                        <span id="refresh_power_now">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>
                         Yesterday's Solar Energy (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-sunny"></i>
                    </div>
                  <!--   <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a> -->
                    <span class="small-box-footer" id="solar_date" style="font-weight: bold;color:white">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3 id="tot_consumption"></h3>
                      <span id="refresh_tot_consumption">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Yesterday's Grid Energy Consumption (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="ls_date" style="font-weight: bold;color:white">
                        XX-XX-XXXX XX:XX:XX XX
                        
                    </span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="tot_export"></h3>
                        <span id="refresh_tot_export">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Yesterday's Solar Energy Export
                         (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="e_ls_date" style="font-weight: bold;color:white">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

             <div class="col-sm-4">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="fixed_total_consumption"></h3>
                        <span id="refresh_fixed_total_consumption">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Yesterday's Total Energy Consumption
                         (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="consumption_date" style="font-weight: bold;color:white">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="month_consumption_units"></h3>
                        <span id="refresh_month_consumption_units">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Last 30 Days Energy Consumption
                         (kWh)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-bolt"></i>
                    </div>
                    <span class="small-box-footer" id="from_date_consumption" style="font-weight: bold;color:white">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="monthly_bill_amount"></h3>
                        <span id="refresh_monthly_bill_amount">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </span>
                        <p>Last 30 Days Bill Amount
                         </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-thunderstorm"></i>
                    </div>
                    <span class="small-box-footer" id="from_date_bill" style="font-weight: bold;color:white">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

            
           <section class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-lightbulb-o"></i><i class="far fa-lightbulb"></i> Light Control</h3>
                    </div>
                    <div class="box-body">
                       
                    </div>
                </div>
            </section>
        

            <section class="col-lg-6 connectedSortable ui-sortable">
                <div class="box box-success">
                    <div class="box-header with-border ui-sortable-handle" style="cursor: move;">
                        <h3 class="box-title">
                            <i class="ion ion-ios-sunny"></i> Solar Power Generation Data (kW)
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
                                <h3 id="total_power_now">0.00 kWh</h3>
                                <div>Today's Solar Energy</div>
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
                <div class="box  box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> Grid Energy Consumption (kWh)
                        </h3>
                         <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <button class="btn btn-warning btn-xs btnRange1" data-type="month">Month</button>
                                <button class="btn btn-success btn-xs btnRange1" data-type="week">Week</button>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="ls_data_graph" style="height: 250px;"></div>
                    </div>
                    <div class="overlay" id="refresh_ls_data_graph">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                    <div class="box-footer no-border">
                        <div class="row">
                            
                            <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                                <h3 id="e_tot_consumption">0.00 kWh</h3>
                                <div>Yesterday</div>
                            </div>
                           
                            </div>
                        </div>
                    </div>
            
            </section>


            <div class="col-lg-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> Solar Energy Export (kWh)
                        </h3>
                         <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <button class="btn btn-warning btn-xs btnRange2" data-type="month">Month</button>
                                <button class="btn btn-success btn-xs btnRange2" data-type="week">Week</button>
                            </button>
                        </div>
                         </div>
                           <div class="box-body">
                        <div id="ls_data_export_graph" style="height: 250px;"></div>
                    </div>
                    <div class="overlay" id="refresh_ls_export_data_graph">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                    <div class="box-footer no-border">
                        <div class="row">
                            
                            <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                                <h3 id="e_tot_export"> 0.00 kWh</h3>

                                <div>	Yesterday</div>
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
        
    </section>
</div>

<?php require 'footer.php';?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    $(document).ready(function() {
    	$('#refresh_month_consumption_units').show();
    	$('#refresh_monthly_bill_amount').show();
        $('#refresh_solar_data_graph').show();
        $('#refresh_ls_data_graph').show();
        $('#refresh_tot_export').show();
        $('#refresh_tot_consumption').show();
        $('#refresh_power_now').show();
        $('#refresh_ls_export_data_graph').show();

        setInterval(function () {
            loadSolarChartData('day');
       		//loadLsImportChartData();
       		//loadLsExportChartData();           
        }, 250000);
        var total_power_yesterday=0;
        var tot_export=0;
        var tot_consumption=0;
        loadBillingData();  
       	loadLsImportChartData();
       	loadLsExportChartData();
        loadYesterdaySolarData();
        //loadTotalConsumptionData();


        $('button.btnRange').on('click', function(e) {
            var type = $(this).data('type');
            loadSolarChartData(type);
           // loadLsImportChartData(type);
        });

         $('button.btnRange1').on('click', function(e) {
            var type = $(this).data('type');
           // loadSolarChartData(type);
            loadLsImportChartData(type);
        });
          $('button.btnRange2').on('click', function(e) {
            var type = $(this).data('type');
           // loadSolarChartData(type);
            loadLsExportChartData(type);
        });

         function loadYesterdaySolarData(type) {
            console.log("getting solar data...");
            $('#solar_data_graph').empty();
            $('#refresh_power_now').hide();


            $.ajax({
                url: "jq_solar_power_generation.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);

                    $('#refresh_power_yesterday').hide();
                    total_power_yesterday= $('#total_power_yesterday').html(chart_data.meta.power_yes);
                 
                         total_power_yesterday=chart_data.meta.power_yes;
                          
                          //window.alert(total_power_yesterday);
                }
            });
        }
               // window.alert(total_power_yesterday);


                function loadBillingData(type) {
            console.log("getting billing data...");
         //   $('#solar_data_graph').empty();
         //   $('#refresh_solar_data_graph').show();

            $.ajax({
                url: "jq_billing_data.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);
                    $('#refresh_month_consumption_units').hide();
                    $('#refresh_monthly_bill_amount').hide();
                    $('#month_consumption_units').html(chart_data.meta.consumption_units);
                    $('#monthly_bill_amount').html(chart_data.meta.bill + ' INR');
                    $('#from_date_consumption').html('From  ' + chart_data.meta.date);
                    $('#from_date_bill').html('From  ' + chart_data.meta.date);
                  //  $('#solar_overall_load').html(chart_data.meta.power_total + ' MWh');
                    	//window.alert(chart_data.chart);
                  //  $('#refresh_solar_data_graph').hide();

                 
                },
                error: function(data) {
                    console.log('error');
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

                    
                    $('#total_power_now').html(chart_data.meta.power_today+' kWh');
                    $('#solar_load_now').html(chart_data.meta.power_now + ' kW');
                    $('#solar_overall_load').html(chart_data.meta.power_total + ' MWh');
                    $('#refresh_solar_data_graph').hide();
                    console.log("got solar chart data...");
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


function loadLsImportChartData(type) {
     console.log("getting Import chart data...");
          //  window.alert(chart_data);
          $('#ls_data_graph').empty();
            $('#refresh_ls_data_graph').show();
            $.ajax({
                url: "jq_ls_data.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);

                    $('#refresh_tot_consumption').hide();
                    $('#refresh_ls_data_graph').hide(); 
                    $('#tot_consumption').html(chart_data.meta.tot_consumption.import);
                    $('#e_tot_consumption').html(chart_data.meta.tot_consumption.import+ ' kWh');
                  //  $('#ls_date').html(chart_data.meta.tot_consumption.date);
                    $('#ls_date').html(chart_data.meta.date);
                    $('#solar_date').html(chart_data.meta.date);

                     tot_consumption=chart_data.meta.tot_consumption.import;
                  //  window.alert(tot_consumption);
                    //console.log('--->');
                    Morris.Bar({
                        element: 'ls_data_graph',
                        resize: true,
                        data: chart_data.chart,
                        xkey: 'date',
                        ykeys: ['import'],
                        labels: ['Energy Consumed'],
                        postUnits: ' kWh',
                        barColors:['#0073B7'],   
                        hideHover: 'true',
                        pointSize: 0
                    });

                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
      /*  var total= total_power_yesterday+tot_consumption;
        window.alert(total);*/


  function loadLsExportChartData(type) {
    console.log("getting Export chart data...");
          
          $('#ls_data_export_graph').empty();
          $('#refresh_ls_export_data_graph').show();
          $('#refresh_fixed_total_consumption').show();

          
            $.ajax({
                url: "jq_ls_data.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);

                    $('#refresh_ls_export_data_graph').hide();
                    $('#refresh_tot_export').hide();
                    $('#refresh_fixed_total_consumption').hide();
                    $('#tot_export').html(chart_data.meta.tot_consumption.export);
                    $('#e_tot_export').html(chart_data.meta.tot_consumption.export + ' kWh');
                   // $('#e_ls_date').html(chart_data.meta.tot_consumption.date);
                    $('#e_ls_date').html(chart_data.meta.date);
                    $('#consumption_date').html(chart_data.meta.date);
                     tot_export= chart_data.meta.tot_consumption.export;
                   // window.alert(tot_export);
                   var total=(total_power_yesterday+tot_consumption)-tot_export;
                   var fixed_total=total.toFixed(2);
                  document.getElementById("fixed_total_consumption").innerHTML = fixed_total;
                 //  window.alert(fixed_total);
                   // console.log(fixed_total);
                    Morris.Bar({
                        element: 'ls_data_export_graph',
                        resize: true,
                        data: chart_data.chart,
                        xkey: 'date',
                        ykeys: ['export'],
                        labels: ['Energy Exported'],
                        postUnits: ' kWh',
                        barColors:['#CB4335'],
                        hideHover: 'true',
                        pointSize: 0
                    });

                },
                error: function(data) {
                    console.log('error');
                }
            });
        }


    });
</script>


