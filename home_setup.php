<?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Smart Home<small>Demo for Smart Home Setup</small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">SGCC</li>
        </ol>
    </section>

    <script src="assets/js/jquery.imagemapster.js"></script>
    <script type='text/javascript'>
        $(document).ready(function () {
            $(".onoff").click(function () {
                var id = $(this).attr('id');
                $("#" + id + " img").toggle();
            });
        });

        $(document).ready(function () {
            $(".onofftube").click(function () {
                var id = $(this).attr('id');
                $("#" + id + " img").toggle();
            });
        });

        function changeStatus(c, ds) {
            //$('#themap').mapster('set', c, ds, {altImage: 'images/house_458_off.png'});
            $('#themap').mapster('set', c, ds);
        }
        //<![CDATA[
        $(window).load(function () {
            var profiles = [{
                areas: "1,2,3,4,5,6",
                options: {
                    fillColor: '000000'
                }
            }];
            var optionsXref = {};
            $.each(profiles, function (i, e) {
                var areas = e.areas.split(',');

                $.each(areas, function (j, key) {
                    optionsXref[key] = e.options;
                });
            });
            var image = $('#themap');
            image.mapster({
                highlight: false,
                mapKey: 'data-state',
                onClick: function (e) {
                    $("#onofftube" + e.key + " img").toggle();
                    if (e.selected) {
                        image.mapster('set', true, e.key, optionsXref[e.key]);
                        return false;
                    }
                }
            });
        }); //]]>
    </script>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        House Number 458
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-10">
                                <img id="themap" src="images/house_458.png" usemap="#H458" class="img-responsive">
                                <map name="H458">
                                    <area data-state="1" href="#" shape="poly" coords="47,52,503,53,502,381,45,382"/>
                                    <area data-state="2" href="#" shape="poly" coords="528,52,528,379,971,379,970,120,1056,119,1057,54"/>
                                    <area data-state="3" href="#" shape="poly" coords="1083,53,1084,456,1444,458,1446,53"/>
                                    <area data-state="4" href="#" shape="poly" coords="1471,52,1790,51,1794,446,1942,447,1943,1023,1473,1020"/>
                                    <area data-state="5" href="#" shape="poly" coords="1011,819,1212,818,1214,1022,1013,1023"/>
                                    <area data-state="6" href="#" shape="poly" coords="532,652,985,652,984,1021,532,1022"/>
                                    <area data-state="7" href="#" shape="poly" coords="46,654,505,654,507,1020,46,1020"/>
                                    <area data-state="8" href="#" shape="poly" coords="46,407,272,407,272,630,46,631"/>
                                </map>
                            </div>

                            <div class="col-lg-2">
                                <?php
                                $arr_list = array(
                                    1 => "Study Room",
                                    2 => "Back Room",
                                    3 => "Kitchen",
                                    4 => "Living Room",
                                    5 => "Washroom",
                                    6 => "Bedroom 1",
                                    7 => "Bedroom 2",
                                    8 => "Bathroom"
                                );
                                ?>
                                <div class="panel panel-primary" id="zipato_controller">
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
                                                         onclick="changeStatus(false, '<?php echo $al;?>')" style="cursor: hand; display: none">
                                                    <img id="l<?php echo $al;?>_on" src="images/tubelight_on.png" class="img-responsive" data-value="off"
                                                         onclick="changeStatus(true, '<?php echo $al;?>')" style="cursor: hand;">
                                                </span>
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require 'footer.php';?>