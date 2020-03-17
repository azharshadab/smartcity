 <?php
$servername = "localhost";
$username = "root";
$password = "sql6677my";
$dbname = "ishtiyaq_omnik";

// Create connection
//echo "Check1";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
//echo "Check2";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Check3";
} 
//echo "Check4";
$sql = "SELECT fee_receipt FROM user_register WHERE ID = 37";
echo "Check5";
$result = mysql_query($sql,$conn);    
echo "Check6";
while ($myrowsel = mysql_fetch_array($result)) 
   {
        //header("Content-Type: application/pdf");
        echo "Check1";
        header("Content-Type: image/png");
        echo $myrowsel[fee_receipt];
        exit();
   }

/*$sql = "SELECT fee_receipt FROM user_register where id=37";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["fee_receipt"]. "<br>";
    }
} else {
    echo "0 results";
}*/
$conn->close();
?>

