    <?php require 'header.php';?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Map_SmartCity<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Map</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div id="dvMap" style="width: 100%; height: 100vh"></div>
                <div id="legend2">
<!--                    <input type="button" id="btn" value="Show/Hide" class="off" onclick="toggleState('legend',this)" />-->
                    <div id="legend">
<!--                        <h3>Notations</h3>-->
                    </div>
                </div>
        </div>
    </section>

    <?php
    $scada_data  = new ScadaData();
    $map_data = $scada_data->getCurrentSubStationLoad();
//    echo '<pre>';
//    print_r($map_data);
//    echo '</pre>';
    ?>
</div>

<?php require 'footer.php';?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDDvE8WexsyU1QpOekRjdCqvTGAxKqTwh0"></script>
<script type="text/javascript">
    function toggleState(id,item){
        var el = document.getElementById(id);

        if(item.className == "on") {
            item.className="off";
            el.style.display = 'block';
        } else {
            item.className="on";
            el.style.display = 'none';
        }
    }

//    function getDesc( callback ) {
//        var obj = {};
//        $.getJSON("http://172.20.46.4/omnik_data/json_data.php", function (result) {
//            $.each(result.data, function (i, field) {
//                // console.log(field.house_number);
//                obj[field.house_number] = {};
//                obj[field.house_number]['status'] = field.status;
//                obj[field.house_number]['house_image'] = field.house_image;
//                obj[field.house_number]['power_now'] = field.power_now;
//                obj[field.house_number]['total_energy'] = field.total_energy;
//                obj[field.house_number]['update_time'] = field.update_time;
//                obj[field.house_number]['html'] = 'House Number: <strong>' + field.house_number + '</strong><br/>';
//            });
//
//            // console.log(obj);
//            // console.log(obj[401].house_image);
//        });
//
//        // return obj;
//        callback(obj);
//    }
//
//    getDesc( function ( value ) {
//        console.log(value);
//    });

    var obj = {};
    $.ajax({
        //url: 'http://103.246.106.202/omnik_data/json_data.php',
        url: '/omnik_data/json_data.php',
        async: false,
        dataType: 'json',
        success: function (result) {
            $.each(result.data, function (i, field) {
                obj[field.house_number] = {};
                obj[field.house_number]['status'] = field.status;
                obj[field.house_number]['house_image'] = field.house_image;
                obj[field.house_number]['power_now'] = field.power_now;
                obj[field.house_number]['total_energy'] = field.total_energy;
                obj[field.house_number]['update_time'] = field.update_time;
                obj[field.house_number]['html'] =
					'<div class="media">' +
					'<div class="media-left">' +
					'<img class="media-object img-thumbnail" src="'+field.house_image+'" width="150px">' +
					'</div>' +
					'<div class="media-body">' +
					'<h4 class="media-heading">House Number: '+field.house_number+'</h4>' +
					'System Size: 5 kWp' +
					'<br>Power Now: ' + field.power_now + ' kW' +
                    '<br>Total Energy: ' + field.total_energy + ' kWh' +
                    '<br>Update Time: ' + field.update_time +
                    //'<br><span class="text-danger">Total Load: Coming Soon...</span>' +
                    //'<br><span class="text-danger">Current Bill: Coming Soon...</span>' +
                    //'<br><span class="text-danger">Last Bill: Coming Soon...</span>' +
                    //'<br><span class="text-danger">User Rating: ' +
                    //'<i class="fa fa-star" aria-hidden="true"></i>' +
                    //'<i class="fa fa-star" aria-hidden="true"></i>' +
                    //'<i class="fa fa-star" aria-hidden="true"></i>' +
                    //'<i class="fa fa-star-half-o" aria-hidden="true"></i>' +
                    //'<i class="fa fa-star-o" aria-hidden="true"></i></span>' +
					'</div>' +
					'</div>';
            });
        }
    });
    // console.log(obj[401]);

    var marker_33kV = 'dist/img/icon_33kv30.png';
    var marker_substation = 'dist/img/icon_ss30.png';
    var marker_house = 'dist/img/icon_home30.png';
    var marker_houseui = 'dist/img/icon_homeb30.png';
     var marker_hostel = 'dist/img/icon_hostel30.png';
     var marker_hostel1 = 'dist/img/icon_hostelnew30.png';
     var marker_multistorey = 'dist/img/icon_building30.png';
    // var marker_here = 'dist/img/you_are_here_pin.png';
    var marker_here = 'dist/img/you_are_here_01.png';

    console.log(marker_hostel);

    var markers = [
	    {
            "title": 'Control Centre',
            "lat": '26.504071',
            "lng": ' 80.235205',
           // "description": "<b>SMART GRID CONTROL CENTRE</b>",
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/sgcc.jpg" alt="Smiley face"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SMART GRID CONTROL CENTRE </b></h4></div>',
            "category": marker_here
        },
        {
            "title": '33kV',
            "lat": '26.503932',
            "lng": '80.235403',
          //  "description": "<b>33kV MAIN SUBSTATION</b><br><br>Current Load: <?php echo round($map_data['SS33KV'], 3);?> kW",
            "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/33kvss.jpg" alt="Smiley face"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>33kV MAIN SUBSTATION</b></h4><br><br>Current Load: <?php echo round($map_data['SS33KV'], 3);?> kW</div>',

            "category": marker_33kV
        },
        {
            "title": 'SS1',
            "lat": '26.512014',
            "lng": '80.230459',
         //   "description": "<br><b>SUBSTATION NO. 1A</b><br><br>Current Load: <?php echo round($map_data['SP1'] + $map_data['SP2'], 3);?> kW",
            "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation1.jpg" alt="Substation1"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 1</b></h4><br><br>Current Load: <?php echo round($map_data['SP1'] + $map_data['SP2'], 3);?> kW</div>',
            "category": marker_substation
        },
/*        {
            "title": 'SP2',
            "lat": '26.512014',
            "lng": '80.230459',
            "description": "<br><b>SUBSTATION NO. 1B</b><br><br>Current Load: <?php echo round($map_data['SP2'], 3);?> kW",
            "category": marker_substation
        },*/
        {
            "title": 'SS2',
            "lat": '26.508432',
            "lng": '80.235082',
         //   "description": "<br><b>SUBSTATION NO. 2</b><br><br>Current Load: <?php echo round($map_data['SS2'], 3);?> kW",
            "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation2.jpg" alt="Substation2"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 2</b></h4><br><br>Current Load: <?php echo round($map_data['SS2'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS3',
            "lat": '26.514102',
            "lng": '80.237536',
         //   "description": "<br><b>SUBSTATION NO. 3</b><br><br>Current Load: <?php echo round($map_data['SS3'], 3);?> kW",
            "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation3.jpg" alt="Substation3"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 3</b></h4><br><br>Current Load: <?php echo round($map_data['SS3'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS4',
            "lat": '26.514917',
            "lng": '80.234818',
          //  "description": "<br><b>SUBSTATION NO. 4</b><br><br>Current Load: <?php echo round($map_data['SS4'], 3);?> kW",
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation4.jpg" alt="Substation4"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 4</b></h4><br><br>Current Load: <?php echo round($map_data['SS4'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS5',
            "lat": '26.507457',
            "lng": '80.229728',
          //  "description": "<br><b>SUBSTATION NO. 5</b><br><br>Current Load: <?php echo round($map_data['SS5'], 3);?> kW",
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation5.jpg" alt="Substation4"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 5</b></h4><br><br>Current Load: <?php echo round($map_data['SS5'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS6',
            "lat": '26.509991',
            "lng": '80.242525',
          //  "description": "<br><b>SUBSTATION NO. 6</b><br><br>Current Load: <?php echo round($map_data['SS6'], 3);?> kW",
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation6.jpg" alt="Substation6"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 6</b></h4><br><br>Current Load: <?php echo round($map_data['SS6'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS7',
            "lat": '26.516396',
            "lng": '80.232530',
    //     "description": "<br><b>SUBSTATION NO. 7</b><br><br>Current Load: <?php echo round($map_data['SS7'], 3);?> kW",
    "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation7.jpg" alt="Substation7"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 7</b></h4><br><br>Current Load: <?php echo round($map_data['SS7'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS8',
            "lat": '26.507136',
            "lng": '80.225754',
       //     "description": "<br> <b>SUBSTATION NO. 8</b><br><br>Current Load: <?php echo round($map_data['SS8'], 3);?> kW",
       "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation8.jpg" alt="Substation8"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 8</b></h4><br><br>Current Load: <?php echo round($map_data['SS8'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS9',
            "lat": '26.514440',
            "lng": '80.235644',
       //     "description": "<br> <b>SUBSTATION NO. 9</b><br><br>Current Load: <?php echo round($map_data['SS9'], 3);?> kW",
       "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation8.jpg" alt="Substation9"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 9</b></h4><br><br>Current Load: <?php echo round($map_data['SS9'], 3);?> kW</div>',
            "category": marker_substation
        },
        {
            "title": 'SS10',
            "lat": '26.503672',
            "lng": '80.233573',
        //    "description": "<br><b>SUBSTATION NO. 10</b><br><br>Current Load: <?php echo round($map_data['SS10'], 3);?> kW",
        "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/substation/substation10.jpg" alt="Substation10"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading"><b>SUBSTATION NO. 10</b></h4><br><br>Current Load: <?php echo round($map_data['SS10'], 3);?> kW</div>',
            "category": marker_substation
        },
        

        {
            "title": '401',
            "lat": '26.509686',
            "lng": '80.239325',
            // "description": '<br>House No. : <b>412</b><br>',
            "description": obj[401].html,
            "category": marker_house
        },

        {
            "title": '412',
            "lat": '26.509300',
            "lng": '80.238145',
           // "description": '<br><b>HOUSE NO. 415</b><br>',
           "description": obj[412].html,
            "category": marker_house
        },
        {
            "title": '415',
            "lat": '26.509679',
            "lng": '80.237682',
            // "description": '<br>House No. : <b>412</b><br>',
            "description": obj[415].html,
            "category": marker_house
        },
       {
            "title": '421',
            "lat": '26.508833',
            "lng": '80.238172',
            // "description": '<br>House No. : <b>412</b><br>',
            "description": obj[421].html,
            "category": marker_house
        },
        {
            "title": '440',
            "lat": '26.507715',
            "lng": '80.238645',
           // "description": '<br><b>HOUSE NO. 415</b><br>',
           "description": obj[440].html,
            "category": marker_house
        },
        {
            "title": '442',
            "lat": '26.507705',
            "lng": '80.238340',
            // "description": '<br>House No. : <b>412</b><br>',
            "description": obj[442].html,
            "category": marker_house
        },
        {
            "title": '453',
            "lat": '26.507269',
            "lng": '80.237892',
           // "description": '<br><b>HOUSE NO. 415</b><br>',
           "description": obj[453].html,
            "category": marker_house
        },

        
        {
            "title": '448',
            "lat": '26.507699',
            "lng": '80.237713',
            // "description": '<br>House No. : <b>412</b><br>',
            "description": obj[448].html,
            "category": marker_house
        },
        {
            "title": '613',
            "lat": '26.513012',
            "lng": '80.238477',
            // "description": '<br>House No. : <b>412</b><br>',
            "description": obj[412].html,
            "category": marker_house
        },
        {
            "title": '614',
            "lat": '26.513061',
            "lng": '80.238822',
           // "description": '<br><b>HOUSE NO. 415</b><br>',
           "description": obj[415].html,
            "category": marker_house
        },
        
        {
            "title": '4071',
            "lat": '26.514810',
            "lng": '80.241740',
            //"description": '<br>House No. : <b>453</b><br>',
            /*"description": obj[453].html,*/
            "category": marker_house
        },

        {
            "title": '4073',
            "lat": '26.514572',
            "lng": '80.241341',
            //"description": '<br>House No. : <b>453</b><br>',
            /*"description": obj[453].html,*/
            "category": marker_house
        },
        
        {
            "title": '4078',
            "lat": '26.513988',
            "lng": '80.240266',
            //"description": '<br>House No. : <b>453</b><br>',
            /*"description": obj[453].html,*/
            "category": marker_house
        },
        {
            "title": '4079',
            "lat": '26.515750',
            "lng": '80.241349',
            //"description": '<br>House No. : <b>453</b><br>',
            /*"description": obj[453].html,*/
            "category": marker_house
        },
        {
            "title": '4080',
            "lat": '26.515878',
            "lng": '80.241609',
            //"description": '<br>House No. : <b>453</b><br>',
            /*"description": obj[453].html,*/
            "category": marker_house
        },


















         {
            "title": 'Faculty Apt Block C',
            "lat": '26.503438',
            "lng": '80.232996',
         //  "description": '<b>Faculty Apartment Block C</b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment4.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h5 class="media-heading"><b>Faculty Apartment Block C </b></h5>/*System Size: 50 kWp*/</div>',
            "category": marker_multistorey
        },
        
        {
            "title": 'GH-1',
            "lat": '26.507084',
            "lng": '80.233443',
         // "description": '<b>HALL OF RESIDENCE FOR GIRLS NO. 1<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel1.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE FOR GIRLS NO. 1</h4>System Size: 25 kWp</div>',
            "category": marker_hostel
        },
        
        {
            "title": 'Hall-2',
            "lat": '26.510560',
            "lng": '80.229857',
         //  "description": '<b>HALL OF RESIDENCE NO. 4<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel4.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 2 </h4>System Size: 0 kWp</div>',
            "category": marker_hostel1
        },

        {
            "title": 'Hall-3',
            "lat": '26.508307',
            "lng": '80.229882',
         //  "description": '<b>HALL OF RESIDENCE NO. 4<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel4.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 3 </h4>System Size: 0 kWp</div>',
            "category": marker_hostel1
        },
        

        {
            "title": 'Hall-4',
            "lat": '26.507293',
            "lng": '80.232682',
         //  "description": '<b>HALL OF RESIDENCE NO. 4<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel4.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 4 </h4>System Size: 25 kWp</div>',
            "category": marker_hostel
        },
        
        
        {
            "title": 'Hall-5',
            "lat": '26.509670',
            "lng": '80.228009',
         //  "description": '<b>HALL OF RESIDENCE NO. 5<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel5.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 5 </h4>System Size: 25 kWp</div>',
            "category": marker_hostel
        },
        
        {
            "title": 'Hall-6 A+B',
            "lat": '26.505804',
            "lng": '80.233699',
          // "description": '<b>HALL OF RESIDENCE NO. 6<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel6.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 6 </h4>System Size: 70 kWp</div>',
            "category": marker_hostel
        },

        {
            "title": 'Hall-6 C+D',
            "lat": '26.505061',
            "lng": '80.234833',
          // "description": '<b>HALL OF RESIDENCE NO. 6<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel6.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 6 C+D </h4>System Size: 70 kWp</div>',
            "category": marker_hostel1
        },
        
        {
            "title": 'Hall-7',
            "lat": '26.507658',
            "lng": '80.228200',
          // "description": '<b>HALL OF RESIDENCE NO. 7<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel7.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 7</h4>System Size: 175 kWp</div>',
            "category": marker_hostel
        },
        
        {
            "title": 'Hall-8',
            "lat": '26.504969',
            "lng": '80.228573',
         //  "description": '<b>HALL OF RESIDENCE NO. 8<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel1.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 8</h4>System Size: 255 kWp</div>',
            "category": marker_hostel
        },
        
        {
            "title": 'Hall-9',
            "lat": '26.507768',
            "lng": '80.226333',
         //  "description": '<b>HALL OF RESIDENCE NO. 9<b>',
         "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel1.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 9</h4>System Size: 225 kWp</div>',
            "category": marker_hostel1
        },

        {
            "title": 'Hall-11 Admin Block',
            "lat": '26.505506',
            "lng": '80.226643',
         //  "description": '<b>HALL OF RESIDENCE NO. 9<b>',
         "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel1.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 11 Admin Block</h4>System Size: 225 kWp</div>',
            "category": marker_hostel1
        },

        {
            "title": 'Hall-11 B-Block',
            "lat": '26.504530',
            "lng": '80.226394',
         //  "description": '<b>HALL OF RESIDENCE NO. 9<b>',
         "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/hostel/hostel1.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">HALL OF RESIDENCE NO. 11 B-Block</h4>System Size: 225 kWp</div>',
            "category": marker_hostel1
        },

       {
            "title": 'Centre for Environmental Science',
            "lat": '26.515828',
            "lng": '80.234241',
         //  "description": '<b>Centre for Environmental Science<b>',
            "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment1.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">Centre for Environmental Science</h4>System Size: 5 kWp</div>',
            "category": marker_multistorey
        },
        
       {
            "title": 'Visitor Hostel',
            "lat": '26.507449',
            "lng": '80.234075',
         //  "description": '<b>VISITORS HOSTEL<b>',
           "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment2.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">VISITORS HOSTEL</h4>System Size: 50 kWp</div>',
            "category": marker_hostel
        },
        {
            "title": 'Old RA Hostel',
            "lat": '26.505591',
            "lng": '80.232698',
          // "description": '<b>Faculty Apartment Block D<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment3.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">Old RA Hostel </h4>System Size: 50 kWp</div>',
            "category": marker_hostel1
        },
        {
            "title": 'New RA Hostel',
            "lat": '26.504883',
            "lng": '80.232009',
          // "description": '<b>Faculty Apartment Block D<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment3.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">New RA Hostel </h4>System Size: 50 kWp</div>',
            "category": marker_hostel1
        },
        {
            "title": 'Faculty Apt Block D',
            "lat": '26.502775',
            "lng": '80.232891',
          // "description": '<b>Faculty Apartment Block D<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment3.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">Faculty Apartment Block D </h4>System Size: 50 kWp</div>',
            "category": marker_multistorey
        },
        {
            "title": 'Campus School',
            "lat": '26.505775',
            "lng": '80.234900',
          // "description": '<b>Faculty Apartment Block D<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment3.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">Campus School </h4>System Size: 0 kWp</div>',
            "category": marker_hostel1
        },
        {
            "title": 'Kendriya Vidhyalaya',
            "lat": '26.508166',
            "lng": '80.236464',
          // "description": '<b>Faculty Apartment Block D<b>',
          "description": '<div class="media"><div class="media-left"><img class="media-object img-thumbnail" src="images/building/Apartment3.png" alt="h614.jpg"  width="150" height="250"></div><div class="media-body"><h4 class="media-heading">Kendriya Vidhyalaya </h4>System Size: 50 kWp</div>',
            "category": marker_hostel1
        },
        
    ];

    window.onload = function () {
        LoadMap();
    };

    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng(26.510463, 80.235318),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            fullscreenControl: true,
        };

        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);

        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();

        var icons = {
            info: {
                name: '33kV MAIN SUBSTATION',
                icon: marker_33kV
            },
            library: {
                name: '11kV/415V SUBSTATION',
                icon: marker_substation
            },
            parking: {
                name: 'SMART HOME',
                icon: marker_house
            },
            newhouse: {
                name: 'SMART HOME NEW',
                icon: marker_houseui
            }, 

            lab: {
                name: 'MULTISTOREY BUILDING',
                icon: marker_multistorey
            },
            hostel: {
                name: 'HOSTEL BUILDING',
                icon: marker_hostel
            }
        };


        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title,
                icon: data.category,
                animation: google.maps.Animation.DROP
            });


            //Attach click event to the marker.
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent("<div style = 'width:350px;min-height:100px'>" + data.description + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }

        /* 2nd Legend Start */
        var legend2 = document.getElementById('legend2');
        var div = document.createElement('div');

        legend2.appendChild(div);
        map.controls[google.maps.ControlPosition.LEFT_CENTER].push(legend2);
        /* 2nd Legend Ends */
        /* 1st Legend Start */
        var legend = document.getElementById('legend');
        for (var key in icons) {
            var type = icons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }
        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
        /* 1st Legend Start */
    }
</script>

