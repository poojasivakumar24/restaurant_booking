<!DOCTYPE html>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href="action_page.css"/>
</head>
<body>

  <?php
  $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "restaurant booking";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo"eroor";
    }

//Sending form data to sql db.
$sql="INSERT INTO customer (NAME,ADDRESS,CONTACT)
VALUES ('$_POST[Name]', '$_POST[add]','$_POST[cnt]')"
;

$result=$conn->query($sql);
$Name=$_POST['Name'];
$pizza=$_POST['qty1'];
$pasta=$_POST['qty2'];
$spagetti=$_POST['qty3'];
$tortilla=$_POST['qty4'];
$total=$_POST['qty1']+$_POST['qty2']+$_POST['qty3']+$_POST['qty4'];

$totalamt=($_POST['qty1']*500)+($_POST['qty2']*300)+($_POST['qty3']*350)+($_POST['qty4']*250);
$sql2="INSERT INTO order_1 (no_items,customer_name) VALUES($total,'$Name')";
$result2=$conn->query($sql2);

$sql3="SELECT o_no from order_1 where customer_name='$Name'";
$result3=$conn->query($sql3);
if(!$result3)
{echo"error1";}

  $row = $result3->fetch_assoc();
   $o_no=$row['o_no'];
   /*
   $sql5="UPDATE item SET quantity=quantity-$pizza where name= "PIZZA" ;
   $result6=$conn->query($sql5);
   $sql5="UPDATE item SET quantity=quantity-$tortilla where name="TORTILLA" ;
   $result6=$conn->query($sql5);
*/

$sql4="INSERT INTO bill(o_no,total)VALUES($o_no,$totalamt)";


$result5=$conn->query($sql4);
if(!$result5)
{echo "error2";}
$sql5="SELECT bill_no,o_no from bill where o_no=$o_no ";
$result4=$conn->query($sql5);
$row = $result4->fetch_assoc();
 $bill_no=$row['bill_no'];
 echo "<html>";
 echo"<body>";
 echo "<div class=container1>";
 echo "<h1><center>BILL</center> </h1>";
 echo"</div>";
 echo "<div class=container2>";
 echo"<h5>ORDER NO :</h5>";
 echo $o_no;
 echo"<br>";
 echo "<h5>BILL NO :</h5>";
 echo $bill_no;
 echo "<br>";
 echo"<h5>TOTAL :</h5>";
 echo $totalamt;
 echo"</div>";


 echo"</body>";
 echo"</html>";





//$result4=$conn->query($sql4);
$conn->close();


    ?>



</div>
</div>
  </body>

  </html>
