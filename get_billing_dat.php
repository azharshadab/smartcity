
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
//echo "[{ date: '2017-07-22 05:00:08', value: 0 },{ date: '2017-07-22 05:05:08', value: 0 },{ date: '2017-07-22 05:10:09', value: 0 },]";
require_once '/home/smartcity/automator/vendor/autoload.php';
include_once '/home/smartcity/automator/functions.php';
require_once '/home/smartcity/automator/timer.php';
require_once '/home/smartcity/automator/DB.php';
require_once 'core/init.php';





//$logger = new Katzgrau\KLogger\Logger('/home/smartcity/automator/logs/get_billing_data');
$timer = new Timer();
$timer->start();
//$logger->info('-=| Getting Data from billingdata |=-');





$from_date = date("d-m-Y", strtotime("-5 day"));
$to_date = date("d-m-Y", strtotime("-5 day"));
$db = new DB('localhost', 'root', 'sql6677my', 'iitk_smartcity');
$table_data = $db->rawQueryOne("SELECT MAX(MeterReading_DateTime) AS MeterReading_DateTime FROM smc_billing_data");

//$consumer_id = "LT004";
//$consumer_id = $user->data()->consumer_id;

$url = "http://172.20.226.1:8092/mdmapi/api/mdm/consumer/get/billingdata/mindteck?ConsumerID=all&StartDate=$from_date&EndDate=$to_date";
// echo $url;
$context = stream_context_create(array(
  'http' => array(
    // 'header'  => "Authorization: Basic " . base64_encode("$username:$password")
    'header'  => "Authorization: Basic QXBpVXNlcjpBcGlQYXNz"
  )
));
$data = file_get_contents($url, false, $context);
$arr_json = json_decode($data, true);
//echo $data;
//echo $arr_json;
$i = 0;
$query = '';
$connect = mysqli_connect("localhost", "root", "sql6677my", "iitk_smartcity"); //Connect PHP to MySQL Database

//if ($db->count > 0) {
 	$datetime = urlencode($table_data['MeterReading_DateTime']);

	//$logger->info("URL: ".$url);
	foreach ($arr_json as $row) {
		$i++;
	    $Meter_Serial_Number = $data['Meter_Serial_Number'];
	    $MeterReading_DateTime = $data['MeterReading_DateTime'];
	    $ACT_IMP_TOT = $data['ACT_IMP_TOT'];
	    $ACT_EXP_TOT = $data['ACT_EXP_TOT'];
	    $APP_IMP_TOT = $data['APP_IMP_TOT'];
	    $APP_EXP_TOT = $data['APP_EXP_TOT'];
	    $APPR_IMP_TOT = $data['APPR_IMP_TOT'];
	    $APPR_EXP_TOT = $data['APPR_EXP_TOT'];
	    $REACTV_ENERGY_KVARH_LAG_IMP = $data['REACTV_ENERGY_KVARH_LAG_IMP'];
	    $REACTV_ENERGY_KVARH_LAG_EXP = $data['REACTV_ENERGY_KVARH_LAG_EXP'];
	    $REACTV_ENERGY_KVARH_Lead_IMP = $data['REACTV_ENERGY_KVARH_Lead_IMP'];
	    $REACTV_ENERGY_KVARH_Lead_EXP = $data['REACTV_ENERGY_KVARH_Lead_EXP'];
	    $Forward_PF = $data['Forward_PF'];
	    $Reverse_PF = $data['Reverse_PF'];
	    $KVAR_LEAD_OR_LAG = $data['KVAR_LEAD_OR_LAG'];
	    $MD_Forward_KW = $data['MD_Forward_KW'];
	    $MD_Forward_KW_OccurrenceTime = $data['MD_Forward_KW_OccurrenceTime'];
	    $MD_Forward_KVA = $data['MD_Forward_KVA'];
	    $MD_Forward_KVA_OccurenceTime = $data['MD_Forward_KVA_OccurenceTime'];
	    $MD_Forward_KVAR_Lag = $data['MD_Forward_KVAR_Lag'];
	    $MD_Forward_KVAR_Lag_OccurenceTime = $data['MD_Forward_KVAR_Lag_OccurenceTime'];
	    $MD_Forward_KVAR_Lead = $data['MD_Forward_KVAR_Lead'];
	    $MD_Forward_KVAR_Lead_OccurenceTime = $data['MD_Forward_KVAR_Lead_OccurenceTime'];
	    $MD_Reverse_KW = $data['MD_Reverse_KW'];
	    $MD_Reverse_KW_OccurrenceTime = $data['MD_Reverse_KW_OccurrenceTime'];
	    $MD_Reverse_KVA_Value = $data['MD_Reverse_KVA_Value'];
	    $MD_Reverse_KVA_OccurenceTime = $data['MD_Reverse_KVA_OccurenceTime'];
	    $MD_Reverse_KVAR_Lag = $data['MD_Reverse_KVAR_Lag'];
	    $MD_Reverse_KVAR_Lag_OccurenceTime = $data['MD_Reverse_KVAR_Lag_OccurenceTime'];
	    $MD_Reverse_KVAR_Lead = $data['MD_Reverse_KVAR_Lead'];
	    $MD_Reverse_KVAR_Lead_OccurenceTime = $data['MD_Reverse_KVAR_Lead_OccurenceTime'];
	    $StartTime = $data['StartTime'];
	    $EndTime = $data['EndTime'];
	    $ACT_IMP_OR_EXP = $data['ACT_IMP_OR_EXP'];
	    $TimeZone_ID = $data['TimeZone_ID'];
	    $Tamper_Count = $data['Tamper_Count'];
	    $Tamper_Reset_Count = $data['Tamper_Reset_Count'];


/*
	    $data = array(
	    	
    	'Meter_Serial_Number' => $Meter_Serial_Number,
    	'MeterReading_DateTime' => $MeterReading_DateTime,
	    'ACT_IMP_TOT' => $ACT_IMP_TOT,
	    'ACT_EXP_TOT' => $ACT_EXP_TOT,
	    'APP_IMP_TOT' => $APP_IMP_TOT,
	    'APP_EXP_TOT' => $APP_EXP_TOT,
    	'APPR_IMP_TOT' => $APPR_IMP_TOT,
	    'APPR_EXP_TOT' => $APPR_EXP_TOT,
	    'REACTV_ENERGY_KVARH_LAG_IMP' => $REACTV_ENERGY_KVARH_LAG_IMP,
	    'REACTV_ENERGY_KVARH_LAG_EXP' => $REACTV_ENERGY_KVARH_LAG_EXP,
	    'REACTV_ENERGY_KVARH_Lead_IMP' => $REACTV_ENERGY_KVARH_Lead_IMP,
    	'REACTV_ENERGY_KVARH_Lead_EXP' => $REACTV_ENERGY_KVARH_Lead_EXP,
	    'Forward_PF' => $Forward_PF,
	    'Reverse_PF' => $Reverse_PF,
	    'KVAR_LEAD_OR_LAG' => $KVAR_LEAD_OR_LAG,
	    'MD_Forward_KW' => $MD_Forward_KW,
    	'MD_Forward_KW_OccurrenceTime' => $MD_Forward_KW_OccurrenceTime,
	    'MD_Forward_KVA' => $MD_Forward_KVA,
	    'MD_Forward_KVA_OccurenceTime' => $MD_Forward_KVA_OccurenceTime,
	    'MD_Forward_KVAR_Lag' => $MD_Forward_KVAR_Lag,
	    'MD_Forward_KVAR_Lag_OccurenceTime' => $MD_Forward_KVAR_Lag_OccurenceTime,
    	'MD_Forward_KVAR_Lead' => $MD_Forward_KVAR_Lead,
	    'MD_Forward_KVAR_Lead_OccurenceTime' => $MD_Forward_KVAR_Lead_OccurenceTime,
	    'MD_Reverse_KW' => $MD_Reverse_KW,
	    'MD_Reverse_KW_OccurrenceTime' => $MD_Reverse_KW_OccurrenceTime,
	    'MD_Reverse_KVA_Value' => $MD_Reverse_KVA_Value,
    	'MD_Reverse_KVA_OccurenceTime' => $MD_Reverse_KVA_OccurenceTime,
	    'MD_Reverse_KVAR_Lag' => $MD_Reverse_KVAR_Lag,
	    'MD_Reverse_KVAR_Lag_OccurenceTime' => $MD_Reverse_KVAR_Lag_OccurenceTime,
	    'MD_Reverse_KVAR_Lead' => $MD_Reverse_KVAR_Lead,
	    'MD_Reverse_KVAR_Lead_OccurenceTime' => $MD_Reverse_KVAR_Lead_OccurenceTime,
    	'StartTime' => $StartTime,
	    'EndTime' => $EndTime,
	    'TimeZone_ID' => $TimeZone_ID,
	    'ACT_IMP_OR_EXP' => $ACT_IMP_OR_EXP,
	    'Tamper_Count' => $Tamper_Count,
	    'Tamper_Reset_Count' => $Tamper_Reset_Count,
	   
    	);
*/




    	$query .= "INSERT INTO smc_billing_data(
    	Meter_Serial_Number,
    	MeterReading_DateTime,
    	ACT_IMP_TOT,
    	ACT_EXP_TOT,
    	APP_IMP_TOT,
    	APP_EXP_TOT,
    	APPR_IMP_TOT,
    	APPR_EXP_TOT,
    	REACTV_ENERGY_KVARH_LAG_IMP,
    	REACTV_ENERGY_KVARH_LAG_EXP,
    	REACTV_ENERGY_KVARH_Lead_IMP,
    	REACTV_ENERGY_KVARH_Lead_EXP,
    	Forward_PF,
    	Reverse_PF,
    	KVAR_LEAD_OR_LAG,
    	MD_Forward_KW,
    	MD_Forward_KW_OccurrenceTime,
    	MD_Forward_KVA,
    	MD_Forward_KVA_OccurenceTime,
    	MD_Forward_KVAR_Lag,
    	MD_Forward_KVAR_Lag_OccurenceTime,
    	MD_Forward_KVAR_Lead,
    	MD_Forward_KVAR_Lead_OccurenceTime,
    	MD_Reverse_KW,
    	MD_Reverse_KW_OccurrenceTime,
    	MD_Reverse_KVA_Value,
    	MD_Reverse_KVA_OccurenceTime,
    	MD_Reverse_KVAR_Lag,
    	MD_Reverse_KVAR_Lag_OccurenceTime,
    	MD_Reverse_KVAR_Lead,
    	MD_Reverse_KVAR_Lead_OccurenceTime,
    	StartTime,
    	EndTime,
    	TimeZone_ID,
    	ACT_IMP_OR_EXP,
    	Tamper_Count,
    	Tamper_Reset_Count
   	)

    	 VALUES 
    	 ('".$row["Meter_Serial_Number"]."',
    	  '".$row["MeterReading_DateTime"]."', 
    	  '".$row["ACT_IMP_TOT"]."',
    	  '".$row["ACT_EXP_TOT"]."',
    	  '".$row["APP_IMP_TOT"]."', 
    	  '".$row["APP_EXP_TOT"]."',
    	  '".$row["APPR_IMP_TOT"]."',
    	  '".$row["APPR_EXP_TOT"]."', 
    	  '".$row["REACTV_ENERGY_KVARH_LAG_IMP"]."',
    	  '".$row["REACTV_ENERGY_KVARH_LAG_EXP"]."',
    	  '".$row["REACTV_ENERGY_KVARH_Lead_IMP"]."', 
    	  '".$row["REACTV_ENERGY_KVARH_Lead_EXP"]."',
    	  '".$row["Forward_PF"]."',
    	  '".$row["Reverse_PF"]."', 
    	  '".$row["KVAR_LEAD_OR_LAG"]."',
    	  '".$row["MD_Forward_KW"]."',
    	  '".$row["MD_Forward_KW_OccurrenceTime"]."', 
    	  '".$row["MD_Forward_KVA"]."',
    	  '".$row["MD_Forward_KVA_OccurenceTime"]."',
    	  '".$row["MD_Forward_KVAR_Lag"]."', 
    	  '".$row["MD_Forward_KVAR_Lag_OccurenceTime"]."',
    	  '".$row["MD_Forward_KVAR_Lead"]."',
    	  '".$row["MD_Forward_KVAR_Lead_OccurenceTime"]."', 
    	  '".$row["MD_Reverse_KW"]."',
    	  '".$row["MD_Reverse_KW_OccurrenceTime"]."',
    	  '".$row["MD_Reverse_KVA_Value"]."', 
    	  '".$row["MD_Reverse_KVA_OccurenceTime"]."',
    	  '".$row["MD_Reverse_KVAR_Lag"]."',
    	  '".$row["MD_Reverse_KVAR_Lag_OccurenceTime"]."', 
    	  '".$row["MD_Reverse_KVAR_Lead"]."',
    	  '".$row["MD_Reverse_KVAR_Lead_OccurenceTime"]."',
    	  '".$row["StartTime"]."', 
    	  '".$row["EndTime"]."',
    	  '".$row["TimeZone_ID"]."',
    	  '".$row["ACT_IMP_OR_EXP"]."',
    	  '".$row["Tamper_Count"]."', 
    	  '".$row["Tamper_Reset_Count"]."',

    	); ";


	   // $db->insert('smc_billing_data', $data);

	 /*    
	    if ($db->insert('smc_billing_data', $data)) {
			// $logger->info("Record inserted successfully");
		} else {
			//$logger->error('update failed: ' . $db->getLastError());
			echo "Data not inserted";
			//echo $Meter_Serial_Number;
			//echo $MeterReading_DateTime;
			//echo $i;
		}		*/
//}

}

 /*if(mysqli_multi_query($connect, $query)) //Run Mutliple Insert Query
    {
     echo '<h3>Imported JSON Data</h3><br />';
}
else{
	echo "Data not inserted";
}*/
echo $i;

	    



