<?php

//export.php
include('connect.php');
$connect = ConnectDB();


$output = '';
if(isset($_POST["export"]))
{
 $query = "select concat(firstname, ' ', lastname) as name, timesheetsid, datestart, total_hours, coordinatorid, status ";
 $query .= "from rodrigueb6.users ";
 $query .= "join rodrigueb6.students s using (userID) ";
 $query .= "join rodrigueb6.studenttimesheets sts using (bannerID) ";
 $query .= "join rodrigueb6.timesheets ts using (timesheetsID);";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">
                    <tr>
                         <th>Student Name</th>
                         <th>Timesheet</th>

                         <th>Total Hours</th>

                                                 <th>CoordinatorID</th>

                         <th>Status</th>                                          

                    </tr>

  ';
  while($row = mysqli_fetch_array($result))

  {

   $output .= '

    <tr>

                         <td>'.$row["name"].'</td>

                         <td>'.$row["timesheetsid"].'</td>

                         <td>'.$row["datestart"].'</td>

                                                 <td>'.$row["coordinatorid"].'</td>

                         <td>'.$row["status"].'</td>                              

                    </tr>

   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
