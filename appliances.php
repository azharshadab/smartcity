<?php require 'header.php';?>

    <div class="content-wrapper">
       <section class="content-header">
           <h1>Appliances<small></small></h1>
           <ol class="breadcrumb">
               <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Appliances</li>
           </ol>
       </section>

       <section class="content">
           <div class="row">
               <div class="col-xs-12">
                   <div class="box box-primary">
<!--                        <div class="box-header with-border">-->
<!--                            <h3 class="box-title"></h3>-->
<!--                            <div class="box-tools pull-right">-->
<!--                                <a href="apikey.php" data-toggle="tooltip" title="API Keys">-->
<!--                                    <i class="fa fa-arrow-left"></i> Back-->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </div>-->
                       <div class="box-header with-border">
<!--                            <a href="apikey_add.php" data-toggle="tooltip" title="Add New Group">-->
<!--                                <i class="fa fa-plus"></i> New API Key-->
<!--                            </a>-->
                       </div>
                       <div class="box-body">
                           <?php
                           $url = "http://172.24.105.34:8092/mdmapi/api/mdm/consumer/get/applianceinfo/mindteck?Consumer_CID=".$user->data()->consumer_id;
                           $context = stream_context_create(array(
                               'http' => array(
                                   // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
                                   'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
                               )
                           ));
                           $data = file_get_contents($url, false, $context);
                           $arr_json = json_decode($data, true);

//                           echo '<pre>';
//                           print_r($arr_json['Result']['AIData']);
//                           echo '</pre>';

//                           echo "Total Smart Devices: ".count($arr_json['Result']['AIData']);

                           //http://172.20.46.3:8092/mdmapi/api/mdm/consumer/applianceonoff/mindteck?ConsumerApplianceLoad_ID=1&OnOff=true
//                            [ConsumerApplianceLoad_ID] => 4
//                            [HomeAutomation_Type] => Silvan
//                            [Gateway_User] =>
//                            [Gateway_Pwd] =>
//                            [Make_Name] => Silvan-Lumo
//                           [Make_Name] => Silvan-Sirus
//                            [MacID] => 5CCF7FD14B18
//                            [IP] => 172.20.46.5
//                            [Port] => 1080
//                            [Parameter] => B
                           foreach ($arr_json['Result']['AIData'] as $sm) {
                               if ($sm['Make_Name'] == "Silvan-Lumo") {
                                   ?>
                                   <button class="btn btn-primary btn-lg btnLight" data-id="3" data-type="false"><i
                                               class="fa fa-power-off"></i> Light 1 On/Off
                                   </button>
                                   <?php
                               }
                           }

                           foreach ($arr_json['Result']['AIData'] as $sm) {
                               if ($sm['Make_Name'] == "Silvan-Sirus") {
                                   ?>
                                   <button class="btn btn-success btn-lg btnLight" data-id="2" data-type="true"><i
                                               class="fa fa-power-off"></i> AC ON
                                   </button>
                                   <button class="btn btn-success btn-lg btnLight" data-id="2" data-type="false"><i
                                               class="fa fa-power-on"></i> AC OFF
                                   </button>
                                   <?php
                               }
                           }
                           ?>
                       </div>
                   </div>
               </div>
           </div>
       </section>
    </div>

<?php require 'footer.php';?>

<script>
    $(document).ready(function() {
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
    });
</script>