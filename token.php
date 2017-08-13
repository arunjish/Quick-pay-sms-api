

    <?php
    session_start();
    include('connection.php');
    $mobile_no=$_POST['mobile_no'];
    $banking_option=$_POST['banking_option'];
    $amount=$_POST['amount'];
    putenv("TZ=Europe/Amsterdam");
    date_default_timezone_set("Asia/Kolkata");


    $select= mysql_query("SELECT *  FROM bank_db where bank_id='SBI102'");
    $result= mysql_fetch_assoc($select);
    $money_left=$result["money_left"];
    $current_length_of_queue=$result["current_length_of_queue"];
    $per_user_time=$result["per_user_time"];



    $now = time();
    $minute_to_wait = $now + ($per_user_time * $current_length_of_queue * 60);
    $registered_time = date('Y-m-d H:i:s', $now);
    $calculated_time = date('Y-m-d H:i:s', $minute_to_wait);

    mysql_query("INSERT INTO customer_info(mobile_no,banking_option,amount,registered_time,calculated_time) VALUES('$mobile_no', '$banking_option', '$amount','$registered_time','$calculated_time')");




        //  echo $mobile_no;


          echo "<br>";
          echo "Registred Time---:". $registered_time;
          echo "<br>";
          echo "Calculated time  ---:".$calculated_time;
          echo "<br>";


          //Your authentication key
$authKey = "131780A5SrpYt3EyI58345fc2";

//Multiple mobiles numbers separated by comma
$mobileNumber = "$mobile_no";

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "QuiWay";

//Your message to send, Add URL encoding here.
$message = urlencode("You can withdraw your money at $calculated_time .  Your token no:SBIQ123 . we will remind you 15 minits before your turn :)");

//Define route
$route = "4";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}

curl_close($ch);

echo $output;
    ?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
