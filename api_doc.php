<?php require 'header.php';?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>MDM API Doc<small></small></h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">API Doc</li>
            </ol>
        </section>

        <link rel="stylesheet" href="dist/css/prettify.css">
        <script src="dist/js/prettify.js"></script>
        <script type="text/javascript">
            !function ($) {
                $(function(){
                    window.prettyPrint && prettyPrint()
                })
            }(window.jQuery);
        </script>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <h2>Overview</h2>
                            <p>
                                ...
                            </p>
                            <h3>API endpoint Local:</h3>
                            <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/
</pre>
                            <h3>API endpoint Public:</h3>
                            <pre class="prettyprint">
http://103.246.106.202:8092/mdmapi/
</pre>
                            <h3>Headers</h3>
                            All API call must include this header in order to auth the usage of MDM API.
                            <pre class="prettyprint">
Authorization: Basic YOUR_AUTH_KEY
Content-Type: application/json
</pre>
                            <span class="help-block">Replace your YOUR_AUTH_KEY with your own key.</span>

                            <h3>Body</h3>
                            All the request and response are in JSON string.
                            <hr>
<div>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#consumer_info" aria-controls="consumer_info" role="tab" data-toggle="tab">Consumer Info</a></li>
    <li role="presentation"><a href="#ipdata" aria-controls="ipdata" role="tab" data-toggle="tab">IP Data</a></li>
    <li role="presentation"><a href="#lsdata" aria-controls="lsdata" role="tab" data-toggle="tab">LS Data</a></li>
    <li role="presentation"><a href="#billing_data" aria-controls="billing_data" role="tab" data-toggle="tab">Billing Data</a></li>
    <li role="presentation"><a href="#gridtie_data" aria-controls="gridtie_data" role="tab" data-toggle="tab">Gridtie Data</a></li>
    <li role="presentation"><a href="#hybrid_data" aria-controls="hybrid_data" role="tab" data-toggle="tab">Hybrid Data</a></li>
    <li role="presentation"><a href="#appliance_info" aria-controls="appliance_info" role="tab" data-toggle="tab">Consumer Appliance Info</a></li>
    <li role="presentation"><a href="#switch_point_status" aria-controls="switch_point_status" role="tab" data-toggle="tab">Switch Point Status</a></li>
    <li role="presentation"><a href="#appliance_control" aria-controls="appliance_control" role="tab" data-toggle="tab">Appliance Control (On/Off)</a></li>
    <li role="presentation"><a href="#dbbox_info" aria-controls="dbbox_info" role="tab" data-toggle="tab">DB Box Info</a></li>
    <li role="presentation"><a href="#dbbox_control" aria-controls="dbbox_control" role="tab" data-toggle="tab">DB Box Control</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="consumer_info">
        <h3><span class="text-primary">GET</span> Consumer Info</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/consumerinfo/{LoginID}?{ConsumerTypeID}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/consumerinfo/esya?ConsumerTypeID=2
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerTypeID</th>
                <td>0 for all, 1 for Single Phase, 2 for Three Phase</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#consumer_info_curl" aria-controls="consumer_info_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#consumer_info_php" aria-controls="consumer_info_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#consumer_info_python" aria-controls="consumer_info_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="consumer_info_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.46.4/smartcity/api/v1/mdm/consumer?api_key=a92c87fc7ae848205104e2b12535743b2d92cd9e&data_type=consumerinfo&ctype=0' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="consumer_info_php">
                    <pre class="prettyprint">
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://172.20.46.4/smartcity/api/v1/mdm/consumer?api_key=a92c87fc7ae848205104e2b12535743b2d92cd9e&data_type=consumerinfo&ctype=0",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="consumer_info_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,4")

headers = {
    'Cache-Control': "no-cache"
    }

conn.request("GET", "smartcity,api,v1,mdm,consumer", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "esya",
        "ConsumerTypeID": 0
    },
    "Response": "Success: 4 record(s) found.",
    "Result": {
        "CIData": [
            {
                "Consumer_CID": "LT312WLEG",
                "Consumer_Name": "WLE 314 Grid Tie Inverter",
                "RRNumber": "LT312WLEG",
                "Account_ID": "LT312WLEGM01",
                "ServicePoint_ID": "LT312WLE",
                "Consumer_Address": "Western Lab Extension - 314, Department of Electrical Engineering, IIT Kanpur, Kanpur",
                "Consumer_Email": "shivks@iitk.ac.in",
                "Consumer_MobileNumber": "9918987920",
                "Meter_Serial_Number": "SMR01-1117-0020",
                "Sanctioned_Load_KW": 5,
                "Phase_Model": "Single Phase",
                "ConnectedToDCU": false,
                "DeviceDCU_Name": null
            },
            {
                "Consumer_CID": "LT0458T4",
                "Consumer_Name": "Dr. Saikat Chakrabarti",
                "RRNumber": "LT0458T4",
                "Account_ID": "LT0458T4M01",
                "ServicePoint_ID": "LT0458T4",
                "Consumer_Address": "H. No. 458, IIT Kanpur, Kanpur",
                "Consumer_Email": "saikatc@iitk.ac.in",
                "Consumer_MobileNumber": "9151225345",
                "Meter_Serial_Number": "SMR01-1117-0010",
                "Sanctioned_Load_KW": 5,
                "Phase_Model": "Single Phase",
                "ConnectedToDCU": false,
                "DeviceDCU_Name": null
            },
            {
                "Consumer_CID": "LT312WLEH",
                "Consumer_Name": "WLE 314 Hybrid Inverter",
                "RRNumber": "LT312WLEH",
                "Account_ID": "LT312WLEHM02",
                "ServicePoint_ID": "LT312WLE",
                "Consumer_Address": null,
                "Consumer_Email": "shoaib@iitk.ac.in",
                "Consumer_MobileNumber": "9151225345",
                "Meter_Serial_Number": "SMR01-1317-0053",
                "Sanctioned_Load_KW": 1,
                "Phase_Model": "Single Phase",
                "ConnectedToDCU": false,
                "DeviceDCU_Name": null
            },
            {
                "Consumer_CID": "LT312WLE",
                "Consumer_Name": "Lab 3P HPL LTCT Ethernet",
                "RRNumber": "LT312WLE",
                "Account_ID": "LT312WLEM01",
                "ServicePoint_ID": "LT312WLE",
                "Consumer_Address": null,
                "Consumer_Email": "shivks@iitk.ac.in",
                "Consumer_MobileNumber": "9918987920",
                "Meter_Serial_Number": "664191",
                "Sanctioned_Load_KW": 0,
                "Phase_Model": "3 Phase LT CT GPRS",
                "ConnectedToDCU": false,
                "DeviceDCU_Name": null
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Details</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid configuration for appliance</td>
            </tr>
        </table>
    </div>
<!-- ======================================================================================================================================= -->

 <div role="tabpanel" class="tab-pane" id="switch_point_status">
        <h3><span class="text-primary">GET</span> Hybrid Data</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/switchpointstatus/mindteck?ConsumerApplianceLoad_ID={ID}&MacID={ID}

</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>ConsumerApplianceLoad_ID</th>
                <td>6</td>
            </tr>
            <tr>
                <th>MacID</th>
                <td>5CCF7FD14B18</td>
            </tr>
           
        </table>

 <!--        <h4>Sample Request</h4> -->
        <!--  <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#hybrid_data_curl" aria-controls="hybrid_data_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#hybrid_data_php" aria-controls="hybrid_data_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#hybrid_data_python" aria-controls="hybrid_data_python" role="tab" data-toggle="tab">Python</a></li>
            </ul> 

             Tab panes 
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="hybrid_data_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck?ConsumerID=LT0458T4&StartDate=04-08-2017&EndDate=04-08-2017' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="hybrid_data_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'ConsumerID' => 'LT0458T4',
  'StartDate' => '04-08-2017',
  'EndDate' => '04-08-2017'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="hybrid_data_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,hybriddata,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>  -->

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "ConsumerApplianceLoad_TblRefID": 6,
        "MacID": "5CCF7FD14B18"
    },
    "Response": "Success",
    "Result": {
        "PointStatus": [
            {
                "SwitchPointID": "1",
                "Status": "1"
            },
            {
                "SwitchPointID": "2",
                "Status": "1"
            },
            {
                "SwitchPointID": "3",
                "Status": "1"
            },
            {
                "SwitchPointID": "4",
                "Status": "1"
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid ConsumerApplianceLoad_ID</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid MacID</td>
            </tr>
           
        </table>
    </div>




<!-- ======================================================================================================================================================= -->










    <div role="tabpanel" class="tab-pane" id="ipdata">
        <h3><span class="text-primary">GET</span> IP Data</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/ipdata/{LoginID}?{ConsumerID}&{StartDate}&{EndDate}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/ipdata/mindteck?ConsumerID=LT007&StartDate=10-09-2017&EndDate=11-09-2017
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerID</th>
                <td>all or specific RRNo</td>
            </tr>
            <tr>
                <th>StartDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
            <tr>
                <th>EndDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#ipdata_curl" aria-controls="ipdata_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#ipdata_php" aria-controls="ipdata_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#ipdata_python" aria-controls="ipdata_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="ipdata_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/ipdata/mindteck?ConsumerID=LT007&StartDate=10-09-2017&EndDate=11-09-2017' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="ipdata_php">
                    <pre class="prettyprint">
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8092",
  CURLOPT_URL => "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/ipdata/mindteck?ConsumerID=LT007&StartDate=10-09-2017&EndDate=11-09-2017",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic QXBpVXNlcjpBcGlQYXNz",
    "Cache-Control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="ipdata_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
'Cache-Control': "no-cache"
}

conn.request("GET", "mdmapi,api,mdm,consumer,get,ipdata,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
            <pre class="prettyprint">
{
   "Request":{
      "LoginID":"mindteck",
      "StartDate":"01-07-2017",
      "EndDate":"01-07-2017",
      "ConsumerID":"664183"
   },
   "Response":"Success: 141 record(s) found.",
   "Result":{
      "IPData":[
         {
            "Consumer_ID":"664183",
            "Meter_Serial_Number":"664181",
            "MeterReading_DateTime":"2017-07-01T00:08:57",
            "Billing_Date":"0001-01-01T00:00:00",
            "R_PH_TO_NEU_VT":234.560,
            "Y_PH_TO_NEU_VT":236.820,
            "B_PH_TO_NEU_VT":236.420,
            "VT_OR_AVG_PH_VT":0.0,
            "RY_LN_VT":0.0,
            "YB_LN_VT":0.0,
            "BR_LN_VT":0.0,
            "AVG_LN_VT":0.0,
            "R_PH_INST_LN_CUR":0.160,
            "Y_PH_INST_LN_CUR":0.160,
            "B_PH_INST_LN_CUR":0.130,
            "CUR_OR_AVG_PH_CUR":0.0,
            "R_PH_INST_PW_FACTOR":0.990,
            "Y_PH_INST_PW_FACTOR":0.990,
            "B_PH_INST_PW_FACTOR":0.990,
            "PW_FACTOR_OR_AVG_INST_PW_FACTOR":0.990,
            "R_PH_INST_KW":0.0,
            "Y_PH_INST_KW":0.0,
            "B_PH_INST_KW":0.0,
            "KW_OR_SUM_INST_KW":0.099,
            "KWH":79.600,
            "KVA_R_PH":0.0,
            "KVA_Y_PH":0.0,
            "KVA_B_PH":0.0,
            "KVA":0.099,
            "KVAH":79.700,
            "KVAR_R_PHASE":0.0,
            "KVAR_Y_PHASE":0.0,
            "KVAR_B_PHASE":0.0,
            "KVAR":0.000,
            "KVARH":0.0,
            "KVARH_Capacitive":0.0,
            "KVARH_Inductive":0.0,
            "CURR_NEU":0.0,
            "INST_FREQUENCY":49.920,
            "MD_KW":0.0,
            "MD_KW_OT":"0001-01-01T00:00:00",
            "MD_KVA":0.0,
            "MD_KVA_OT":"0001-01-01T00:00:00",
            "KWH_Export":0.0,
            "KWH_NET":0.0,
            "KVAH_Export":0.0,
            "POWER_OUTAGE_COUNT":0,
            "Cumulative_Power_On_Duration":0,
            "Cumulative_Power_Off_Duration":0,
            "Cumulative_Tamper_Count":0,
            "Cumulative_Billing_Count":0,
            "Cumulative_Programming_Count":0,
            "Load_Limit_Function_Status":false,
            "Load_Limit_Value":0.0
         }
      ]
   }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Consumer ID</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid Start Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>4</th>
                <td>Failure - Invalid End Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>5</th>
                <td>Failure - Date range can not be greater than 7 days.</td>
            </tr>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="lsdata">
        <h3><span class="text-primary">GET</span> LS Data</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/lsdata/{LoginID}?{ConsumerID}&{StartDate}&{EndDate}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/lsdata/mindteck?ConsumerID=LT001&StartDate=25-09-2017&EndDate=29-09-2017
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerID</th>
                <td>all or specific RRNo</td>
            </tr>
            <tr>
                <th>StartDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
            <tr>
                <th>EndDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#lsdata_curl" aria-controls="lsdata_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#lsdata_php" aria-controls="lsdata_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#lsdata_python" aria-controls="lsdata_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="lsdata_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/lsdata/mindteck?ConsumerID=LT001&StartDate=25-09-2017&EndDate=29-09-2017' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="lsdata_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/lsdata/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'ConsumerID' => 'LT001',
  'StartDate' => '25-09-2017',
  'EndDate' => '29-09-2017'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="lsdata_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,lsdata,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "StartDate": "01-03-2018",
        "EndDate": "01-03-2018",
        "ConsumerID": "LT312WLEH"
    },
    "Response": "Success: 48 record(s) found.",
    "Result": {
        "LSData": [
            {
                "Consumer_ID": "LT312WLEH",
                "Meter_Serial_Number": "SMR01-1317-0053",
                "MeterReading_DateTime": "2018-03-01T00:00:00",
                "R_PH_TO_NEU_VT": 0,
                "Y_PH_TO_NEU_VT": 0,
                "B_PH_TO_NEU_VT": 0,
                "VT_OR_AVG_PH_VT": 238,
                "RY_LN_VT": 0,
                "YB_LN_VT": 0,
                "BR_LN_VT": 0,
                "AVG_LN_VT": 0,
                "R_PH_INST_LN_CUR": 0,
                "Y_PH_INST_LN_CUR": 0,
                "B_PH_INST_LN_CUR": 0,
                "CUR_OR_AVG_PH_CUR": 0,
                "R_PH_INST_PW_FACTOR": 0,
                "Y_PH_INST_PW_FACTOR": 0,
                "B_PH_INST_PW_FACTOR": 0,
                "PW_FACTOR_OR_AVG_INST_PW_FACTOR": 0,
                "R_PH_INST_KW": 0,
                "Y_PH_INST_KW": 0,
                "B_PH_INST_KW": 0,
                "KW_OR_SUM_INST_KW": 0,
                "KVA_R_PH": 0,
                "KVA_Y_PH": 0,
                "KVA_B_PH": 0,
                "KVA": 0,
                "KVAR_R_PHASE": 0,
                "KVAR_Y_PHASE": 0,
                "KVAR_B_PHASE": 0,
                "KVAR": 0,
                "CURR_NEU": 0,
                "INST_FREQUENCY": 0,
                "ACT_IMP_TOT": 0.004,
                "ACT_EXP_TOT": 0,
                "ACT_NET_TOT": 0,
                "APP_IMP_TOT": 0.005,
                "APP_EXP_TOT": 0,
                "APP_NET_TOT": 0,
                "KVARH_Lead_IMP": 0,
                "KVARH_Lag_IMP": 0
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Consumer ID</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid Start Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>4</th>
                <td>Failure - Invalid End Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>5</th>
                <td>Failure - Date range can not be greater than 7 days.</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="billing_data">
        <h3><span class="text-primary">GET</span> Billing Data</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/{LoginID}?{ConsumerID}&{StartDate}&{EndDate}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck?ConsumerID=664183&StartDate=11-04-2017&EndDate=11-04-2017
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerID</th>
                <td>all or specific RRNo</td>
            </tr>
            <tr>
                <th>StartDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
            <tr>
                <th>EndDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#billingdata_curl" aria-controls="billingdata_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#billingdata_php" aria-controls="billingdata_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#billingdata_python" aria-controls="billingdata_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="billingdata_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck?ConsumerID=LT312WLEH&StartDate=01-03-2018&EndDate=02-03-2018' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="billingdata_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'ConsumerID' => 'LT312WLEH',
  'StartDate' => '01-03-2018',
  'EndDate' => '02-03-2018'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="billingdata_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,billingdata,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "StartDate": "01-03-2018",
        "EndDate": "02-03-2018",
        "ConsumerID": "LT312WLEH"
    },
    "Response": "Success: 15 record(s) found.",
    "Result": {
        "BLData": [
            {
                "Meter_Serial_Number": "SMR01-1317-0053",
                "MeterReading_DateTime": "2018-03-01T00:00:00",
                "ACT_IMP_TOT": 9.556,
                "ACT_EXP_TOT": 0,
                "APP_IMP_TOT": 14.095,
                "APP_EXP_TOT": 0,
                "APPR_IMP_TOT": 0,
                "APPR_EXP_TOT": 0,
                "REACTV_ENERGY_KVARH_LAG_IMP": 0,
                "REACTV_ENERGY_KVARH_LAG_EXP": 0,
                "REACTV_ENERGY_KVARH_Lead_IMP": 0,
                "REACTV_ENERGY_KVARH_Lead_EXP": 0,
                "Forward_PF": 0.67,
                "Reverse_PF": 0,
                "KVAR_LEAD_OR_LAG": 0,
                "MD_Forward_KW": 0.008,
                "MD_Forward_KW_OccurrenceTime": "0001-01-01T00:00:00",
                "MD_Forward_KVA": 0,
                "MD_Forward_KVA_OccurenceTime": "0001-01-01T00:00:00",
                "MD_Forward_KVAR_Lag": 0,
                "MD_Forward_KVAR_Lag_OccurenceTime": "0001-01-01T00:00:00",
                "MD_Forward_KVAR_Lead": 0,
                "MD_Forward_KVAR_Lead_OccurenceTime": "0001-01-01T00:00:00",
                "MD_Reverse_KW": 0,
                "MD_Reverse_KW_OccurrenceTime": "0001-01-01T00:00:00",
                "MD_Reverse_KVA_Value": 0,
                "MD_Reverse_KVA_OccurenceTime": "0001-01-01T00:00:00",
                "MD_Reverse_KVAR_Lag": 0,
                "MD_Reverse_KVAR_Lag_OccurenceTime": "0001-01-01T00:00:00",
                "MD_Reverse_KVAR_Lead": 0,
                "MD_Reverse_KVAR_Lead_OccurenceTime": "0001-01-01T00:00:00",
                "StartTime": "0001-01-01T00:00:00",
                "EndTime": "0001-01-01T00:00:00",
                "TimeZone_ID": 0,
                "ACT_IMP_OR_EXP": 0,
                "Tamper_Count": 0,
                "Tamper_Reset_Count": 0
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Consumer ID</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid Start Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>4</th>
                <td>Failure - Invalid End Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>5</th>
                <td>Failure - Date range can not be greater than 7 days.</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="gridtie_data">
        <h3><span class="text-primary">GET</span> Gridtie Data</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/gridtiedata/{LoginID}?{ConsumerID}&{StartDate}&{EndDate}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=LT004&StartDate=04-10-2017&EndDate=04-10-2017
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerID</th>
                <td>all or specific RRNo</td>
            </tr>
            <tr>
                <th>StartDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
            <tr>
                <th>EndDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#gridtie_data_curl" aria-controls="gridtie_data_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#gridtie_data_php" aria-controls="gridtie_data_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#gridtie_data_python" aria-controls="gridtie_data_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="gridtie_data_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck?ConsumerID=LT0448T4&StartDate=04-10-2017&EndDate=04-10-2017' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="gridtie_data_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/gridtiedata/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'ConsumerID' => 'LT0448T4',
  'StartDate' => '04-10-2017',
  'EndDate' => '04-10-2017'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="gridtie_data_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,gridtiedata,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "StartDate": "04-10-2017",
        "EndDate": "04-10-2017",
        "ConsumerID": "LT0448T4"
    },
    "Response": "Success: 256 record(s) found.",
    "Result": {
        "GIData": [
            {
                "Consumer_ID": "LT0448T4",
                "Reading_DateTime": "2017-10-04T00:04:55.75",
                "Temperature": 4.6,
                "Voltage_PV1": 0,
                "Voltage_PV2": 0,
                "Reserved_1": 0,
                "Current_PV1": 0,
                "Current_PV2": 0,
                "Reserved_2": 0,
                "Current_AC_R_Phase": 0,
                "Current_AC_S_Phase": 0,
                "Current_AC_T_Phase": 0,
                "Voltage_AC_R_Phase": 0,
                "Voltage_AC_S_Phase": 0,
                "Voltage_AC_T_Phase": 0,
                "Frequency": 0,
                "Power_AC_R_Phase": 0,
                "Power_AC_S_Phase": 0,
                "Power_AC_T_Phase": 0,
                "Reserved_3": 0,
                "Reserved_4": 0,
                "Energy_Today": 0,
                "Energy_Total_H": 0,
                "Energy_Total_L": 3077,
                "Operation_Hour_Total_H": 0,
                "Operation_Hour_Total_L": 0,
                "Operation_Mode": 0,
                "GridVoltage_FaultValue": 0,
                "GridFrequency_FaultValue": 0,
                "GridImpedance_FaultValue": 0,
                "Temperature_FaultValue": 0,
                "PV_FaultValue": 0,
                "GFCI_FaultValue": 0,
                "Error_Message_H": 0,
                "Error_Message_L": 0,
                "First_Error_H": 0,
                "First_Error_L": 0,
                "First_Error_Time_H": 0,
                "First_Error_Time_L": 0,
                "Second_Error_H": 0,
                "Second_Error_L": 0,
                "Second_Error_Time_H": 0,
                "Second_Error_Time_L": 0,
                "Third_Error_H": 0,
                "Third_Error_L": 0,
                "Third_Error_Time_H": 0,
                "Third_Error_Time_L": 0,
                "Fourth_Error_H": 0,
                "Fourth_Error_L": 0,
                "Fourth_Error_Time_H": 0,
                "Fourth_Error_Time_L": 0,
                "Fifth_Error_H": 0,
                "Fifth_Error_L": 0,
                "Fifth_Error_Time_H": 0,
                "Fifth_Error_Time_L": 0
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Consumer ID</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid Start Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>4</th>
                <td>Failure - Invalid End Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>5</th>
                <td>Failure - Date range can not be greater than 7 days.</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="hybrid_data">
        <h3><span class="text-primary">GET</span> Hybrid Data</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/{LoginID}?{ConsumerID}&{StartDate}&{EndDate}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck?ConsumerID=all&StartDate=04-08-2017&EndDate=04-08-2017
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerID</th>
                <td>all or specific RRNo</td>
            </tr>
            <tr>
                <th>StartDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
            <tr>
                <th>EndDate</th>
                <td>DD-MM-YYYY</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#hybrid_data_curl" aria-controls="hybrid_data_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#hybrid_data_php" aria-controls="hybrid_data_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#hybrid_data_python" aria-controls="hybrid_data_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="hybrid_data_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck?ConsumerID=LT0458T4&StartDate=04-08-2017&EndDate=04-08-2017' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="hybrid_data_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/hybriddata/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'ConsumerID' => 'LT0458T4',
  'StartDate' => '04-08-2017',
  'EndDate' => '04-08-2017'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="hybrid_data_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,hybriddata,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "StartDate": "04-08-2017",
        "EndDate": "04-08-2017",
        "ConsumerID": "LT0458T4"
    },
    "Response": "Success: 410 record(s) found.",
    "Result": {
        "HIData": [
            {
                "Consumer_ID": "LT0458T4",
                "Reading_DateTime": "2017-08-04T07:37:27.133",
                "L1_Phase_Voltage_AC": 235.7,
                "L1_Phase_Current_AC": 1.61,
                "L1_Power_High_Word": 0,
                "L1_Power_Low_Word": 19,
                "L1_AC_Frequency": 50.01,
                "L2_Phase_Voltage_AC": 233.8,
                "L2_Phase_Current_AC": 2.24,
                "L2_Power_High_Word": 0,
                "L2_Power_Low_Word": 513,
                "L2_AC_Frequency": 50.01,
                "L3_Phase_Voltage_AC": 0,
                "L3_Phase_Current_AC": 0,
                "L3_Power_High_Word": 0,
                "L3_Power_Low_Word": 0,
                "L3_AC_Frequency": 0,
                "First_Input_Voltage_DC": 278,
                "First_Input_Current_DC": 1.4,
                "First_Input_Power_High_Word": 0,
                "First_Input_Power_Low_Word": 389.2,
                "Second_Input_Voltage_DC": 277.8,
                "Second_Input_Current_DC": 1.33,
                "Second_Input_Power_High_Word": 0,
                "Second_Input_Power_Low_Word": 369.4,
                "Third_Input_Voltage_DC": 0,
                "Third_Input_Current_DC": 0,
                "Third_Input_Power_High_Word": 0,
                "Third_Input_Power_Low_Word": 0,
                "Inverter_Internal_Temperature": 40.6,
                "Working_Mode": "Load sharing",
                "Date_Year_Month": "17 : 6",
                "Date_Day_Hour": "22 : 17",
                "Date_Min_Sec": "40 : 40",
                "S1_Error_Code1_High_Word": 0,
                "S1_Error_Code1_Low_Word": 0,
                "S1_Error_Code0_High_Word": 0,
                "S1_Error_Code0_Low_Word": 0,
                "Local_Load": 513,
                "Local_Load_Today_High_Word": 23,
                "Local_Load_Today_Low_Word": -21390,
                "Grid_Power_Today_High_Word": 0,
                "Grid_Power_Today_Low_Word": -12405,
                "PV_Power_Today_High_Word": 28,
                "PV_Power_Today_Low_Word": 19599,
                "S2_Error_Code1_High_Word": 0,
                "S2_Error_Code1_Low_Word": 0,
                "S2_Error_Code0_High_Word": 0,
                "S2_Error_Code0_Low_Word": 0,
                "Reversed": 0,
                "Battery_Voltage": 51.6,
                "Battery_Temperature": 29.2,
                "Battery_Charging_Current": 2.46,
                "Battery_Discharging_Current": 0,
                "Battery_Status": "16386:Battery Capacity (High) , Equalized Charging"
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Consumer ID</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid Start Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>4</th>
                <td>Failure - Invalid End Date. Expected Format dd-mm-yyyy</td>
            </tr>
            <tr>
                <th>5</th>
                <td>Failure - Date range can not be greater than 7 days.</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="appliance_info">
        <h3><span class="text-primary">GET</span> Appliance Info</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/applianceinfo/{LoginID}?{Consumer_CID}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/applianceinfo/mindteck?Consumer_CID=LT312WLEG
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>Consumer_CID</th>
                <td></td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#appliance_info_curl" aria-controls="appliance_info_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#appliance_info_php" aria-controls="appliance_info_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#appliance_info_python" aria-controls="appliance_info_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="appliance_info_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/applianceinfo/mindteck?Consumer_CID=LT312WLEG' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="appliance_info_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/applianceinfo/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'Consumer_CID' => 'LT312WLEG'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz'
    'Cache-Control' => 'no-cache',
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="appliance_info_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,applianceinfo,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "Consumer_CID": "LT312WLEG"
    },
    "Response": "Success: 6 record(s) found.",
    "Result": {
        "AIData": [
            {
                "ConsumerApplianceLoad_ID": 1,
                "HomeAutomation_Type": "Silvan",
                "Gateway_User": null,
                "Gateway_Pwd": null,
                "Make_Name": "Silvan-Sirus",
                "MacID": "5CCF7FD15B47",
                "IP": "172.20.46.5",
                "Port": "1080",
                "Parameter": null
            },
            {
                "ConsumerApplianceLoad_ID": 2,
                "HomeAutomation_Type": "Silvan",
                "Gateway_User": null,
                "Gateway_Pwd": null,
                "Make_Name": "Silvan-Sirus",
                "MacID": "600194103D57",
                "IP": "172.20.46.5",
                "Port": "1080",
                "Parameter": null
            },
            {
                "ConsumerApplianceLoad_ID": 3,
                "HomeAutomation_Type": "Silvan",
                "Gateway_User": null,
                "Gateway_Pwd": null,
                "Make_Name": "Silvan-Lumo",
                "MacID": "5CCF7FD14B18",
                "IP": "172.20.46.5",
                "Port": "1080",
                "Parameter": "A"
            },
            {
                "ConsumerApplianceLoad_ID": 4,
                "HomeAutomation_Type": "Silvan",
                "Gateway_User": null,
                "Gateway_Pwd": null,
                "Make_Name": "Silvan-Lumo",
                "MacID": "5CCF7FD14B18",
                "IP": "172.20.46.5",
                "Port": "1080",
                "Parameter": "B"
            },
            {
                "ConsumerApplianceLoad_ID": 5,
                "HomeAutomation_Type": "Silvan",
                "Gateway_User": null,
                "Gateway_Pwd": null,
                "Make_Name": "Silvan-Lumo",
                "MacID": "5CCF7FD14B18",
                "IP": "172.20.46.5",
                "Port": "1080",
                "Parameter": "C"
            },
            {
                "ConsumerApplianceLoad_ID": 6,
                "HomeAutomation_Type": "Silvan",
                "Gateway_User": null,
                "Gateway_Pwd": null,
                "Make_Name": "Silvan-Lumo",
                "MacID": "5CCF7FD14B18",
                "IP": "172.20.46.5",
                "Port": "1080",
                "Parameter": "D"
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Details</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid configuration for appliance</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="appliance_control">
        <h3><span class="text-primary">GET</span> Appliance Control</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/applianceonoff/{LoginID}?{ConsumerApplianceLoad_ID}&{OnOff}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/applianceonoff/mindteck?ConsumerApplianceLoad_ID=1&OnOff=true
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>OnOff</th>
                <td>true/false</td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#appliance_control_curl" aria-controls="appliance_control_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#appliance_control_php" aria-controls="appliance_control_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#appliance_control_python" aria-controls="appliance_control_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="appliance_control_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/applianceonoff/mindteck?ConsumerApplianceLoad_ID=1&OnOff=true' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="appliance_control_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/applianceonoff/mindteck');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'ConsumerApplianceLoad_ID' => '1',
  'OnOff' => 'true'
));

$request->setHeaders(array(
  'Postman-Token' => '1642996f-b070-4510-9728-cd55f41acde8',
  'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="appliance_control_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,applianceonoff,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "ConsumerApplianceLoad_TblRefID": 1,
        "OnOff": true
    },
    "Response": "Success",
    "Result": {
        "ActionResult": "Content-type: text/html\n\nSuccessful\n"
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Details</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid configuration for appliance</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="dbbox_info">
        <h3><span class="text-primary">GET</span> DB Box Info</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/dbboxinfo/{LoginID}?{Consumer_CID}

http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/dbboxinfo/esya?Consumer_CID=LT312WLEG
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>Consumer_CID</th>
                <td></td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#dbbox_info_curl" aria-controls="dbbox_info_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#dbbox_info_php" aria-controls="dbbox_info_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#dbbox_info_python" aria-controls="dbbox_info_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="dbbox_info_curl">
                    <pre class="prettyprint">
curl -X GET \
  'http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/dbboxinfo/esya?Consumer_CID=LT312WLEG' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="dbbox_info_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/dbboxinfo/esya');
$request->setMethod(HTTP_METH_GET);

$request->setQueryData(array(
  'Consumer_CID' => 'LT312WLEG'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane active" id="dbbox_info_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("GET", "mdmapi,api,mdm,consumer,get,dbboxinfo,esya", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "esya",
        "Consumer_CID": "LT312WLEG"
    },
    "Response": "Success: 4 record(s) found.",
    "Result": {
        "DBIData": [
            {
                "DBBoxPoint": "K1",
                "DBBoxName": "Grid",
                "IP": "172.20.46.5",
                "Port": "2080",
                "Parameter": "A "
            },
            {
                "DBBoxPoint": "K2",
                "DBBoxName": "Solar Grid",
                "IP": "172.20.46.5",
                "Port": "2080",
                "Parameter": "B "
            },
            {
                "DBBoxPoint": "K3",
                "DBBoxName": "Essential",
                "IP": "172.20.46.5",
                "Port": "5080",
                "Parameter": "A "
            },
            {
                "DBBoxPoint": "K4",
                "DBBoxName": "Non-Essential",
                "IP": "172.20.46.5",
                "Port": "5080",
                "Parameter": "B "
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Details</td>
            </tr>
            <tr>
                <th>3</th>
                <td>Failure - Invalid configuration for appliance</td>
            </tr>
        </table>
    </div>

    <div role="tabpanel" class="tab-pane" id="dbbox_control">
        <h3><span class="text-danger">POST</span> DB Box Control</h3>
        <pre class="prettyprint">
http://172.20.226.1:8092/mdmapi/api/mdm/dbbox/switchcontrol/{LoginID}?{ConsumerID}&{K1}&{K2}&{K3}&{K4}&{Reason}

http://172.20.226.1:8092/mdmapi/api/mdm/dbbox/switchcontrol/mindteck?ConsumerID=SMR01-1117-0019&K1=false&K2=false&K3=false&K4=false&Reason=testing
</pre>

        <h4>Parameters</h4>
        <table class="table table-bordered">
            <tr>
                <th>Login_ID</th>
                <td>mindteck</td>
            </tr>
            <tr>
                <th>ConsumerID</th>
            </tr>
            <tr>
                <th>K1</th>
                <td>true/false</td>
            </tr>
            <tr>
                <th>K2</th>
                <td>true/false</td>
            </tr>
            <tr>
                <th>K3</th>
                <td>true/false</td>
            </tr>
            <tr>
                <th>K4</th>
                <td>true/false</td>
            </tr>
            <tr>
                <th>Reason</th>
                <td></td>
            </tr>
        </table>

        <h4>Sample Request</h4>
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#dbbox_control_curl" aria-controls="dbbox_control_curl" role="tab" data-toggle="tab">CURL</a></li>
                <li role="presentation"><a href="#dbbox_control_php" aria-controls="dbbox_control_php" role="tab" data-toggle="tab">PHP</a></li>
                <li role="presentation"><a href="#dbbox_control_python" aria-controls="dbbox_control_python" role="tab" data-toggle="tab">Python</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="dbbox_control_curl">
                    <pre class="prettyprint">
curl -X POST \
  'http://172.20.226.1:8092/mdmapi/api/mdm/dbbox/switchcontrol/mindteck?ConsumerID=LT312WLEG&K1=false&K2=false&K3=false&K4=false&Reason=testing' \
  -H 'Authorization: Basic QXBpVXNlcjpBcGlQYXNz' \
  -H 'Cache-Control: no-cache'
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="dbbox_control_php">
                    <pre class="prettyprint">
$request = new HttpRequest();
$request->setUrl('http://172.20.226.1:8092/mdmapi/api/mdm/dbbox/switchcontrol/mindteck');
$request->setMethod(HTTP_METH_POST);

$request->setQueryData(array(
  'ConsumerID' => 'LT312WLEG',
  'K1' => 'false',
  'K2' => 'false',
  'K3' => 'false',
  'K4' => 'false',
  'Reason' => 'testing'
));

$request->setHeaders(array(
    'Authorization' => 'Basic QXBpVXNlcjpBcGlQYXNz',
    'Cache-Control' => 'no-cache'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</pre>
                </div>
                <div role="tabpanel" class="tab-pane" id="dbbox_control_python">
                    <pre class="prettyprint">
import http.client

conn = http.client.HTTPConnection("172,20,46,3")

headers = {
    'Authorization': "Basic QXBpVXNlcjpBcGlQYXNz",
    'Cache-Control': "no-cache"
    }

conn.request("POST", "mdmapi,api,mdm,dbbox,switchcontrol,mindteck", headers=headers)

res = conn.getresponse()
data = res.read()

print(data.decode("utf-8"))
</pre>
                </div>
            </div>
        </div>

        <h4>Json (Success Sample)</h4>
        <pre class="prettyprint">
{
    "Request": {
        "LoginID": "mindteck",
        "ConsumerID": "LT312WLEG",
        "K1": false,
        "K2": false,
        "K3": false,
        "K4": false,
        "Reason": "testing"
    },
    "Response": "Success",
    "Result": {
        "DBSwitchStatus": [
            {
                "DBBoxSwitch": "K1",
                "Result": "Success"
            },
            {
                "DBBoxSwitch": "K2",
                "Result": "Success"
            },
            {
                "DBBoxSwitch": "K3",
                "Result": "Success"
            },
            {
                "DBBoxSwitch": "K4",
                "Result": "Success"
            }
        ]
    }
}
</pre>

        <h4>Json (failure Sample)</h4>
        <table class="table table-bordered">
            <tr>
                <th>1</th>
                <td>Failure - Invalid Login ID</td>
            </tr>
            <tr>
                <th>2</th>
                <td>Failure - Invalid Consumer ID</td>
            </tr>
        </table>
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

<?php
// Meter Connect/disconnect    Post    http://172.20.226.1:8092/mdmapi/api/mdm/consumer/metercommand/mindteck?AccountID=LT312WLEGM01&MeterSiNo=SMR01-1117-0020&OnOff=false  """AccountID"": ""LT312WLEGM01"",
//         ""MeterSiNo"": ""SMR01-1117-0020"","    Success | Failure   ActionResult    "{
//     ""Request"": {
//         ""LoginID"": ""mindteck"",
//         ""AccountID"": ""LT312WLEGM01"",
//         ""MeterSiNo"": ""SMR01-1117-0020"",
//         ""OnOff"": false
//     },
//     ""Response"": ""Success: Command Initiated Successfully.""
// }

// "   "Possible Error Msg:
// 1. Invalid Account ID.
// 2. Invalid Meter SI No.
// 3. Meter SI No and Account ID mapping not available.
// 4. Invalid single phase meter."
// Get Silvan/Owon status  get http://172.20.226.1:8092/mdmapi/api/mdm/consumer/switchpointstatus/mindteck?ConsumerApplianceLoad_ID=12&MacID=00606EFFFEA6E8DC   " ""ConsumerApplianceLoad_TblRefID"": 12,
//         ""MacID"": ""00606EFFFEA6E8DC"""    Success | Failure   ActionResult    "{
//     ""Request"": {
//         ""LoginID"": ""mindteck"",
//         ""ConsumerApplianceLoad_TblRefID"": 12,
//         ""MacID"": ""00606EFFFEA6E8DC""
//     },
//     ""Response"": "" Success"",
//     ""Result"": {
//         ""PointStatus"": [
//             {
//                 ""SwitchPointID"": ""1"",
//                 ""Status"": ""1""
//             }
//         ]
//     }
// }

// {
//     ""Request"": {
//         ""LoginID"": ""mindteck"",
//         ""ConsumerApplianceLoad_TblRefID"": 3,
//         ""MacID"": ""600194103B25""
//     },
//     ""Response"": ""Success"",
//     ""Result"": {
//         ""PointStatus"": [
//             {
//                 ""SwitchPointID"": ""1"",
//                 ""Status"": ""0""
//             },
//             {
//                 ""SwitchPointID"": ""2"",
//                 ""Status"": ""1""
//             },
//             {
//                 ""SwitchPointID"": ""3"",
//                 ""Status"": ""0""
//             },
//             {
//                 ""SwitchPointID"": ""4"",
//                 ""Status"": ""1""
//             }
//         ]
//     }
// }"  

?>