<html>
   
   <head>
      <title>Add New Record in MySQL Database</title>
   </head>
   
   <body>
      <?php
         
         if(isset($_POST['add'])) {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = 'sql6677my';
            $d_base ='ishtiyaq_omnik';
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $d_base);
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
           // echo "check 2";
             if(! get_magic_quotes_gpc() ) {
               $name = addslashes ($_POST['name']);
               $email = addslashes ($_POST['email']);
               $contact_no = addslashes ($_POST['contact_no']);
               $dob = addslashes ($_POST['dob']);
               $gender = addslashes ($_POST['gender']);
               $fax = addslashes ($_POST['fax']);
               $degree = addslashes ($_POST['degree']);
               $year = addslashes ($_POST['year']);
               $university = addslashes ($_POST['university']);
               $experience = addslashes ($_POST['experience']);
               $cheque_ref_no = addslashes ($_POST['cheque_ref_no']);
               $bank_name = addslashes ($_POST['bank_name']);
               $amount = addslashes ($_POST['amount']);
               $drawn_on = addslashes ($_POST['drawn_on']);
               $sponser_name = addslashes ($_POST['sponser_name']);
               
            }else {
               $name = $_POST['name'];
               $email = $_POST['email'];
               $contact_no =  ($_POST['contact_no']);
               $dob = $_POST['dob'];
               $gender = $_POST['gender'];
               $fax = $_POST['fax'];
               $degree = $_POST['degree'];
               $year = $_POST['year'];
               $university = $_POST['university'];
               $experience = $_POST['experience'];
               $cheque_ref_no = $_POST['cheque_ref_no'];
               $bank_name = $_POST['bank_name'];
               $amount = $_POST['amount'];
               $drawn_on = $_POST['drawn_on'];
               $sponser_name = $_POST['sponser_name'];
            }
            
          
           
           // $emp_salary = $_POST['emp_salary'];
            
            $sql = "INSERT INTO user_register (name, email, contact_no, dob,gender,fax,degree,year,university,experience,cheque_ref_no,bank_name,amount,drawn_on,sponser_name)
            VALUES('$name','$email','$contact_no','$dob','$gender','$fax','$degree','$year','$university','$experience',
                     '$cheque_ref_no','$bank_name','$amount','$drawn_on','$sponser_name')";
               


         /* $sql = "INSERT INTO user_register ". "(name,email, academic) ". "VALUES('$name','$email',$academic, NOW())";*/


if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



               
           /* mysqli_select_db('ishtiyaq_omnik');
            $retval = mysqli_query( $sql, $conn);
            
            if(! $retval ) {
                echo "data not inserted";
               die('Could not enter data: ' . mysqli_error());
            }
            
            echo "Entered data successfully\n";*/
            
            mysql_close($conn);
         }else {
            ?>
            
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <table width = "400" border = "0" cellspacing = "1" 
                     cellpadding = "2">
                
                     <tr>
                        <td width = "100">Name</td>
                        <td><input name = "name" type = "text" 
                           id = "name"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Email</td>
                        <td><input name = "email" type = "text" 
                           id = "email"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Contact NO</td>
                        <td><input name = "contact_no" type = "text" 
                           id = "contact_no"></td>
                     </tr>
                      <tr>
                        <td width = "100">Date of Birth</td>
                        <td><input name = "dob" type = "text" 
                           id = "dob"></td>
                     </tr>



                      <tr>
                        <td width = "100">Gender</td>
                        <td><input name = "gender" type = "text" 
                           id = "gender"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Fax</td>
                        <td><input name = "fax" type = "text" 
                           id = "fax"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Degree</td>
                        <td><input name = "degree" type = "text" 
                           id = "degree"></td>
                     </tr>
                      <tr>
                        <td width = "100">Year</td>
                        <td><input name = "year" type = "text" 
                           id = "year"></td>
                     </tr>
                  

                   <tr>
                        <td width = "100">University</td>
                        <td><input name = "university" type = "text" 
                           id = "university"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Experience</td>
                        <td><input name = "experience" type = "text" 
                           id = "experience"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Cheque Ref No</td>
                        <td><input name = "cheque_ref_no" type = "text" 
                           id = "cheque_ref_no"></td>
                     </tr>
                      <tr>
                        <td width = "100">Bank Name</td>
                        <td><input name = "bank_name" type = "text" 
                           id = "bank_name"></td>
                     </tr>
                  


                   <tr>
                        <td width = "100">Amount</td>
                        <td><input name = "amount" type = "text" 
                           id = "amount"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Drawn On</td>
                        <td><input name = "drawn_on" type = "text" 
                           id = "drawn_on"></td>
                     </tr>
                  
                     <tr>
                        <td width = "100">Sponsor Name </td>
                        <td><input name = "sponser_name" type = "text" 
                           id = "sponser_name"></td>
                     </tr>
                    
                  
                  
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                  
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "add" type = "submit" id = "add" 
                              value = "Register">
                        </td>
                     </tr>
                  
                  </table>
               </form>
            
            <?php
         }
      ?>
   
   </body>
</html>