 <?php require 'header.php';?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Consumer(Three Phase)<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Help</li>
            </ol>
        </section>

       <section class="content">
        <div class="row">
            
            <div class="col-sm-6">
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
                    <span class="small-box-footer" id="ls_date">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>

            <div class="col-sm-6">
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
                    <span class="small-box-footer" id="e_ls_date">
                        XX-XX-XXXX XX:XX:XX XX
                    </span>
                </div>
            </div>
        


            <section class="col-lg-6">
                <div class="box  box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> Grid Energy Consumption (kWh)
                        </h3>
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


            <div class="col-lg-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="ion ion-ios-bolt"></i> Solar Energy Export (kWh)
                        </h3>
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
       // $('#refresh_solar_data_graph').show();
        $('#refresh_ls_data_graph').show();
        $('#refresh_tot_export').show();
        $('#refresh_tot_consumption').show();
        $('#refresh_ls_export_data_graph').show();

        setInterval(function () {
         //   loadSolarChartData('day');
       		//loadLsImportChartData();
       		//loadLsExportChartData();           
        }, 250000);

      //  loadSolarChartData('day');
       	loadLsImportChartData();
       	loadLsExportChartData();


        $('button.btnRange').on('click', function(e) {
            var type = $(this).data('type');
            loadSolarChartData(type);
        });

        

       

  		function loadLsImportChartData() {
          //  window.alert(chart_data);
            $.ajax({
                url: "jq_ls_data.php",
                success: function (chart_data) {
                    console.log(chart_data);

                    $('#refresh_tot_consumption').hide();
                    $('#refresh_ls_data_graph').hide(); 
                    $('#tot_consumption').html(chart_data.meta.tot_consumption.import);
                    $('#e_tot_consumption').html(chart_data.meta.tot_consumption.import+ ' kWh');
                    $('#ls_date').html(chart_data.meta.tot_consumption.date);

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


        function loadLsExportChartData() {
          //  window.alert(chart_data);
            $.ajax({
                url: "jq_ls_data.php",
                success: function (chart_data) {
                    console.log(chart_data);

                    $('#refresh_ls_export_data_graph').hide();
                    $('#refresh_tot_export').hide();
                    $('#tot_export').html(chart_data.meta.tot_consumption.export);
                    $('#e_tot_export').html(chart_data.meta.tot_consumption.export + ' kWh');
                    $('#e_ls_date').html(chart_data.meta.tot_consumption.date);
         			
                    //console.log('--->');
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


