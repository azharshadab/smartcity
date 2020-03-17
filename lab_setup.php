<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Smart Grid Control Centre<small>Smart Lab Setup</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">SGCC</li>
        </ol>
    </section>

    <script src="assets/js/jquery.imagemapster.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.1/css/bootstrap-slider.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.1/bootstrap-slider.min.js"></script>

    <script type='text/javascript'>
        //<![CDATA[
        $(window).load(function() {
            var profiles = [{
                areas: "1,2,3,4,5,6",
                options: {
                    fillColor: '000000'
                }
            }];

            var optionsXref = {};
            $.each(profiles, function(i, e) {
                var areas = e.areas.split(',');

                $.each(areas, function(j, key) {
                    optionsXref[key] = e.options;
                });
            });

            var image = $("#themap");
            image.mapster({
                highlight: false,
                mapKey: 'data-state',
                onClick: function(e) {
                    if (e.selected) {
                        image.mapster('set', true, e.key, optionsXref[e.key]);
                        changeStatus();
                        return false;
                    }
                }
            });
        }); //]]>

        $(document).ready(function() {
            $("#switching").hide();
            $("#p1_controller").hide();
            $("#p2_controller").hide();
            $('#themap').mapster('set', false, '5');

            $("#switch_p1_button").click(function() {
                // $(this).find('img').toggle();
                var state_value = $(this).find('img').css("display");
                var state = 'off';
                if (state_value === 'block') {
                    //on
                    state = 'on';
                } else {
                    //off
                    state = 'off';
                }
                changePowerSocketStatus(state, 'p1');
            });

            $("#switch_p2_button").click(function() {
                // $(this).find('img').toggle();
                var state_value = $(this).find('img').css("display");
                var state = 'off';
                if (state_value === 'block') {
                    //on
                    state = 'on';
                } else {
                    //off
                    state = 'off';
                }
                changePowerSocketStatus(state, 'p2');
            });

            function changePowerSocketStatus(state, ds) {
                $("#switching").show();
                $.ajax({
                    url: "jq_zipato_control_switch.php?state="+state+"&uuid="+ds,
                    success: function (result) {
                        console.log(result);
                        $("#switch_"+ds+"_button").find('img').toggle();
                        $("#switching").hide();
                    },
                    error: function() {
                        console.log('error');
                        $("#switching").hide();
                    }
                });
            }

            checkSocketCurrentStatus();
            function checkSocketCurrentStatus() {
                $('#refresh_status').show();
                $.ajax({
                    url: "jq_zipato_ps_status.php",
                    success: function (data) {
                        console.log(data);
                        $('#refresh_status').hide();
                        //$("#light_controller").show();
                        //$("#ac_controller").show();
                        $("#p1_controller").show();
                        $("#p2_controller").show();
                        $.each(data, function(index, element) {
                            $('#'+index+'_watts').append(element.current_consumption+' Watts');
                            $('#'+index+'_amperes').append(element.amperes);
                            $('#'+index+'_cumulative_consumption').append(element.cumulative_consumption);
                            $('#'+index+'_power_factor').append(element.power_factor);
                            $('#'+index+'_voltage').append(element.voltage);
                            if (element.state === 'true') {
                                $('#'+index+'_on').css('display', 'none');
                            } else {
                                $('#' + index + '_off').css('display', 'none');
                            }
                        });
                    },
                    error: function() {
                        console.log('Unable to connect zipato server.');
                    }
                });
            }




            $("#switch_ac_button").click(function(){
                $(this).find('img').toggle();

                var state_value = $(this).find('img').css("display");
                //alert(state_value);
                if (state_value == 'block') {
                    //on
                    $("#ex8").slider("enable");
                } else {
                    //off
                    $("#ex8").slider("disable");
                }

            });

            $("#ex8").slider({
                tooltip: 'always',
                formatter: function(value) {
                    //ajax
                    return value;
                }
            });
        });

        function changeStatus(c, ds) {
            $("#switching").show();

            var state = '';
            if (ds == 5 || ds == 6) {
                if (c === true) {
                    state = 'on';
                } else {
                    state = 'off';
                }

                //console.log("jq_zipato_control.php?state="+state+"&uuid="+ds);
                $.ajax({
                    url: "jq_zipato_control.php?state="+state+"&uuid="+ds,
                    success: function (result) {
                        console.log(result);
                        $("#onofftube" + ds + " img").toggle();
                        $('#themap').mapster('set', c, ds);
                        $("#switching").hide();
                    },
                    error: function() {
                        console.log('error');
                        $("#switching").hide();
                    }
                });
            }
        }
    </script>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <img id="themap" src="images/sgcc.png" usemap="#wle" class="img-responsive">
                                <map name="SGCC">
                                    <area target="" alt="6" data-state="6" title="6" href="" coords="32,68,1275,699" shape="rect">
                                    <area target="" alt="5" data-state="5" title="5" href="" coords="35,699,1275,1192" shape="rect">
                                    <area target="" alt="4" data-state="4" title="4" href="" coords="35,1192,1275,1781" shape="rect">
                                    <area target="" alt="3" data-state="3" title="3" href="" coords="1275,70,2672,699" shape="rect">
                                    <area target="" alt="2" data-state="2" title="2" href="" coords="1275,699,2672,1189" shape="rect">
                                    <area target="" alt="1" data-state="1" title="1" href="" coords="1275,1189,2672,1783" shape="rect">
                                </map>
                            </div>

                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="panel panel-primary" id="p1_controller">
                                            <div class="panel-heading">
                                                Power Socket 1
                                            </div>
                                            <div class="panel-body">
                                                <img src="images/plug.jpg" class="img-responsive">
                                                <span id="switch_p1_button">
                                                    <img id="p1_off" src="images/switch_on.png" class="img-responsive" data-value="off" style="cursor: hand;">
                                                    <img id="p1_on" src="images/switch_off.png" class="img-responsive" data-value="on" style="cursor: hand;">
                                                </span>
                                            </div>
                                            <div class="panel-footer">
                                                Current Consumption: <span id="p1_watts"></span><br>
                                                Amperes: <span id="p1_amperes"></span><br>
                                                Cumulative Consumption: <span id="p1_cumulative_consumption"></span><br>
                                                Power Factor: <span id="p1_power_factor"></span><br>
                                                Voltage: <span id="p1_voltage"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="panel panel-primary" id="p2_controller">
                                            <div class="panel-heading">
                                                Power Socket 2
                                            </div>
                                            <div class="panel-body">
                                                <img src="images/plug.jpg" class="img-responsive">
                                                <span id="switch_p2_button">
                                                    <img id="p2_off" src="images/switch_on.png" class="img-responsive" data-value="off" style="cursor: hand;">
                                                    <img id="p2_on" src="images/switch_off.png" class="img-responsive" data-value="on" style="cursor: hand;">
                                                </span>
                                            </div>
                                            <div class="panel-footer">
                                                Current Consumption: <span id="p2_watts"></span><br>
                                                Amperes: <span id="p2_amperes"></span><br>
                                                Cumulative Consumption: <span id="p2_cumulative_consumption"></span><br>
                                                Power Factor: <span id="p2_power_factor"></span><br>
                                                Voltage: <span id="p2_voltage"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php
                                        $arr_list = array(
                                            4 => "Light 4",
                                            6 => "Light 6"
                                        );
                                        ?>
                                        <div class="panel panel-primary" id="light_controller">
                                            <div class="panel-heading">Light Controller</div>
                                            <div class="panel-body">
                                                <p class="lead">
                                                    <?php
                                                    foreach ($arr_list as $al => $name) {
                                                        ?>
                                                        <span class="h4">
                                                            <?php echo $name;?>
                                                            <span id="l<?php echo $al;?>_watts"></span>
                                                        </span>
                                                        <span id="onofftube<?php echo $al;?>" class="onofftube">
                                                            <img id="l<?php echo $al;?>_off" src="images/tubelight_off.png" class="img-responsive" data-value="on"
                                                                 onclick="changeStatus(false, '<?php echo $al;?>')" style="cursor: hand">
                                                            <img id="l<?php echo $al;?>_on" src="images/tubelight_on.png" class="img-responsive" data-value="off"
                                                                 onclick="changeStatus(true, '<?php echo $al;?>')" style="cursor: hand;">
                                                        </span>
                                                        <?php
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="panel panel-primary" id="ac_controller">
                                            <div class="panel-heading">AC Controller</div>
                                            <div class="panel-body">
                                                <p>
                                                    <span id="switch_ac_button">
                                                        <img src="images/switch_on.png" class="img-responsive" data-value="off" style="cursor: hand; display: none;">
                                                        <img src="images/switch_off.png" class="img-responsive" data-value="on" style="cursor: hand;">
                                                    </span>
                                                <hr/>
                                                <input id="ex8" data-slider-id='ex1Slider' type="text"
                                                       data-slider-min="16" data-slider-max="30" data-slider-step="1" data-slider-value="22"
                                                       data-slider-enabled="false"/>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="switching">
                                            <img src="images/switching.gif" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay" id="refresh_status">
                        <i class="fa fa-refresh fa-spin fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>

<script>
    jQuery(function($) {
        $("#refresh_status").hide();
        $("#light_controller").hide();
        $("#ac_controller").hide();
        checkCurrentStatus();

        function checkCurrentStatus() {
            $('#refresh_status').show();
            $.ajax({
                url: "jq_zipato_status.php",
                success: function (data) {
                    console.log(data);
                    $('#refresh_status').hide();
                    $("#light_controller").show();
                    //$("#ac_controller").show();
                    $.each(data, function(index, element) {
                        $('#l'+index+'_watts').append(' ['+element.current_consumption+' Watts]');
                        if (element.state === 'true') {
                            $('#l' + index + '_off').css('display', 'none');
                        } else {
                            $('#l'+index+'_on').css('display', 'none');
                        }
                    });
                },
                error: function() {
                    console.log('Unable to connect zipato server.');
                }
            });
        }
    });
</script>
