<?php require 'header.php';?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>Admin<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin</li>
        </ol>
    </section>

    <?php
  //  <?php
    //header('Content-Type: application/json');

    //require_once 'core/init.php';

    $type = isset($_GET['type']) ? $_GET['type']:'';
    // $solar_data = new SolarData();

    $return_data = array();

    /*$to_date = date("d-m-Y");
    $from_date = date("d-m-Y");*/

    $from_date = date("d-m-Y", strtotime("-30 day"));
    $to_date = date("d-m-Y", strtotime("-1 day"));

    $user = new User();
    //$consumer_id = "all";

    $consumer_id = $user->data()->consumer_id;
    //$consumer_pv_type = $user->data()->consumer_pv_type;

  
    $url_billing ="http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck?ConsumerID=all&StartDate=$from_date&EndDate=$to_date";

    $arr_expo_data = array();

    $context = stream_context_create(array(
        'http' => array(
            // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
            'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
        )
    ));

    $data_billing = file_get_contents($url_billing, false, $context);
    $arr_json_billing = json_decode($data_billing, true);

    $i = 0;
    $power_total=0;
    
     $arr_date_by_date = [];
     foreach ($arr_json_billing['Result']['BLData'] as $d) {
        $_data_key = date("Ymd", strtotime($d['MeterReading_DateTime']));
        if (!isset($arr_date_by_date[$_data_key]['act_exp'])) {
            $arr_date_by_date[$_data_key]['act_exp'] = 0;
          }
           $arr_date_by_date[$_data_key]['act_exp'] = $d['ACT_EXP_TOT'];
         //  $arr_date_by_date[$_data_key]['date'] = $d['MeterReading_DateTime'];

           $arr_expo_data['meter_sn_number'] = $d['Meter_Serial_Number'];
           print_r($arr_expo_data);
           break;
    }
    $_loop_count=0;
    foreach ($arr_expo_data as $key => $value) {
        $return_data['chart'][$_loop_count]['meter_sn_number'] = $value['meter_sn_number'];
        print_r($value['meter_sn_number']);
        $_loop_count++;



        # code...
    }
     $return_data = [];
   //   $_loop_count = 0;
     /* foreach ($arr_date_by_date as $key => $value) {
      
         // $date_info =   $value['date'];
         // $dates = date_create($date_info);
         // $date_format= date_format($dates, 'd-M');
      
       // $return_data['bill'][$_loop_count]['date'] = $date_format;
      //  $return_data['bill'][$_loop_count]['act_exp'] = $value['act_exp'];
       // $act_exp =$value['act_exp'];
      //  $power_total +=$value['power'];
        
        $_loop_count++;
      }*/
   //  $first_date = date("Ymd", strtotime("-29 day"));
//  $last_date = date("Ymd", strtotime("-1 day"));
   //  $act_exp_first=$arr_date_by_date[$first_date];
   //  $act_exp_last =$arr_date_by_date[$last_date];
     //$act_exp_diff= $act_exp_last-$act_exp_first;

    /* foreach ($arr_json_exp['act_exp_first'] as $_data) {
       $data = $_data['act_exp'];
     }
     $arr_json_exp = json_encode($act_exp_first);*/
    // $return_data['act_exp_first'] =$act_exp_first;
    // $return_data['act_exp_last'] = $act_exp_last;

    //echo json_encode($return_data);

    ?>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <!-- <div class="box-header with-border">
                        <a href="users_add.php" data-toggle="tooltip" title="Add New User">
                            <i class="fa fa-plus"></i> New User
                        </a>
                    </div> -->
                    <div class="box-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover display responsive nowrap" id="dataTables-list">
                        <thead>
                            <tr>
                                
                                <th>Consumer ID</th>
                                <th>Full Name</th>
                                <th>House No.</th>
                                <th>Email-ID</th>
                                <th>Energy Import</th>
                                <th>Energy Export</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user = new User();
                        $rows = $user->getAllUsers();



                         foreach ($rows as $r) {
//                            if ($r->id == 1 && $user->data()->id != 1) {
//                                continue;
//                            }
                            ?>
                            <tr>

                                <td><?php echo $r->consumer_id;?></td>
                                <td><?php echo ucwords($r->title . ' ' . $r->first_name . ' ' . $r->middle_name . ' ' . $r->last_name);?></td>
                                <td><?php echo $r->house_number;?></td>
                                <td class="<?php echo $td_class;?>"><?php echo $r->email;?></td>
                                <td id="solar_overall_load"></td>
                                <td><?php echo $arr_expo_data[$r->consumer_id];?></td>
                                </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        </table>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
</div>
    <!-- /.content-wrapper -->

<script type="text/javascript">
    
    var solar_data=0;
    var total_export=0;
    var act_exp_diff=0;
    var act_exp_last=0;
    var act_exp_first=0;
    
    loadBillingData();
    loadGridtieData();
    
    
            //window.alert(solar_data);
 function loadBillingData(type) {
            console.log("getting Billing data...");
            
            $.ajax({
                url: "jq_admin_billing_data.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);

                    //window.alert(solar_data);
                 //   $('#solar_overall_load').html(chart_data.act_exp_first.act_exp + ' MWh');
                  act_exp_first = chart_data.act_exp_first.act_exp;
                  act_exp_last = chart_data.act_exp_last.act_exp;
                  act_exp_diff = act_exp_last-act_exp_first;
                 
                        //window.alert(chart_data.chart);
                  

                   
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }
  function loadGridtieData(type) {
            console.log("getting gridtie data...");
            
            $.ajax({
                url: "jq_admin_gridtie_data.php?type="+type,
                success: function (chart_data) {
                    console.log(chart_data);

                    
               //  var solar_data= $('#solar_overall_load').html(chart_data.meta.power_total);
                        //window.alert(chart_data.chart);

                            solar_data = chart_data.meta.power_total;
                            total_export = solar_data-act_exp_diff;
                            var fixed_total_exp=total_export.toFixed(2);
                            document.getElementById("solar_overall_load").innerHTML = fixed_total_exp;



                        //window.alert(act_exp_diff);
                   
                },
                error: function(data) {
                    console.log('error');
                }
            });
        } 

</script>

<?php require 'footer.php';?>
