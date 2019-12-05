<?php

//Database info
$hostname = "fdb22.awardspace.net";
$username = "3166491_boatventures";
$passwd = "FinalProj29!";
$database = "3166491_boatventures";
$port = "3306";

//Print result
$resultMsg = "";

$firstName = $_POST["formFNameStu"];
$lastName = $_POST["formLNameStu"];
$email = $_POST["formEmailStu"];
$phone = $_POST["formPhoneStu"];
$date = $_POST["formDateStu"];
$timeStart = $_POST["formTime1Stu"];
$timeEnd = $_POST["formTime2Stu"];

$connection = mysqli_connect($hostname, $username, $passwd, $database, $port)
   or die("Connection failed: " . mysqli_connect_error());

//Pull index and times where stuDates match. 
$sql = "SELECT stuResIndex, stuResTime1, stuResTime2 FROM studioRes where stuResDate='$date' ";
$result = $connection->query($sql);

if ($result->num_rows == 0) //No date matches, insert then mail. 
{
  insertRes($connection, $firstName, $lastName, $email, $phone, $date, $timeStart, $timeEnd);
}
else if ($result->num_rows > 0) //Date matches, check for time matches. Show possible errors.
{
  while ($row = $result->fetch_assoc()) 
  {
    if ($timeStart >= $row["stuResTime1"] && $timeStart <= $row["stuResTime2"]) //Bad start, print error. Exit script.
    {
      $resultMsg = "Invalid start time. Already reserved for: " . $row["stuResTime1"] . " to " . $row["stuResTime2"];
      echo json_encode(['msg'=>$resultMsg]);
      exit();
    }
    else if (($timeEnd + "00:15:00") > $row["stuResTime1"] && $timeEnd <= $row["stuResTime2"]) //Bad end time, print error. Exit script.
    {
      $resultMsg = "Invalid end time. Already reserved for: " . ($row["stuResTime1"] - "00:15:00"). " to " . $row["stuResTime2"];
      echo json_encode(['msg'=>$resultMsg]);
      exit();
    }
    else if ($timeStart <= $row["stuResTime1"] && $timeEnd >= $row["stuResTime2"]) //Overlaps range
    {
      $resultMsg = "Invalid time. Already reserved for: " . $row["stuResTime1"] . " to " . $row["stuResTime2"];
      echo json_encode(['msg'=>$resultMsg]);
      exit();
    }
    else
    {
      insertRes($connection, $firstName, $lastName, $email, $phone, $date, $timeStart, $timeEnd);
    }
  }
}

//Send email confirmation. Requires actual domain?
//$subject = "Studio Reservation Confirmation";
//$message = $firstName . " " . $lastName . ", You reserved the following studio time. Start Time: " . $timeStart . " End Time: " . $timeEnd;
//$headers = "From: *louie email here *" . "\r\n" . "CC: jensen29@live.com";
//mail($email, $subject, $message, $headers);
//End email.

function insertRes($connection, $fName, $lName, $email, $phone, $date, $time1, $time2)
{
  $sqlInsert = "INSERT INTO studioRes (stuResFName, stuResLName, stuResEmail, stuResPhone, stuResDate, stuResTime1, stuResTime2)
                VALUES ('$fName', '$lName', '$email', '$phone', '$date', '$time1', '$time2')";
                
  if ($connection->query($sqlInsert) == TRUE) 
  {
    $resultMsg = "Studio reservation confirmed.";
    echo json_encode(['msg'=>$resultMsg]);
  }
  else 
  {
    $resultMsg = "ERROR: " . $connection->error;
    echo json_encode(['msg'=>$resultMsg]);
  }

  $connection->close() ;             
}
?>