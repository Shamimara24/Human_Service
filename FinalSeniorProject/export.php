<?php  
//export.php
$connect = mysqli_connect("127.0.0.1", "rodrigueb6", "909090Br?", "rodrigueb6");
 
$output = '';
if(isset($_POST["export"]))
{
 $query = "select concat(u.firstname, ' ', u.lastname) as studentname, count(ts.timesheetsid) as tsApproved, sum(total_hours) as hrsApproved, concat(us.firstname, ' ', us.lastname) as supervisorName, f.name as site ";
 $query .= "from rodrigueb6.users u ";
 $query .= "join rodrigueb6.students s using (userID) join rodrigueb6.studenttimesheets sts using (bannerID) ";
 $query .= "join rodrigueb6.fieldsites f on (sts.fieldsiteid = f.fieldsiteid) join rodrigueb6.timesheets ts using (timesheetsID) ";
 $query .= "join rodrigueb6.coordinators c on (sts.coordinatorid = c.coordinatorid) join rodrigueb6.users us on (c.user_id = us.userid) ";
 $query .= "where ts.status = 'Approved' group by studentname, supervisorName, site;";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>
                         <th>Student Name</th>
                         <th>Timesheets Approved</th>
                         <th>Total Hours Approved</th>
                         <th>Coordinator Name</th>
                         <th>Work Site</th>                                        
                    </tr>
  ';

  while($row = mysqli_fetch_array($result))
  {

   $output .= '

    <tr>
                         <td>'.$row["studentname"].'</td>
                         <td>'.$row["tsApproved"].'</td>
                         <td>'.$row["hrsApproved"].'</td>
                         <td>'.$row["supervisorName"].'</td>
                         <td>'.$row["site"].'</td>                                 
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
