<?php

// Connect to the database

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
include('connect.php');
$dbh = ConnectDB();
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$roleID = $_SESSION['roleID'];
$sql = "SELECT CONCAT(firstname, ' ' , lastname) AS fullName FROM users where roleId = 2 and active = 1 order BY firstname ASC;";
$result = mysqli_query($dbh,$sql);

$sql2 = "select name FROM fieldsites";
$result2 = mysqli_query($dbh,$sql2);
if(!isset($_SESSION['userid'])) {
  header("Location: http://elvis.rowan.edu/~mcgrathj2/SeniorProject/login.php"); /* Redirect browser */
exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Field Sites</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>

  
  <body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0" style="background-color: #333333">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="admindashboard.php">Rowan University</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="admindashboard.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminreporting.php">
                  <span data-feather="clock"></span>
                  Reporting
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminconnections.php">
                  <span data-feather="users"></span>
                  Connections <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="adminfieldsite.php">
                  <span data-feather="target"></span>
                  Field Sites <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminprofile.php">
                  <span data-feather="user"></span>
                  Profile
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Main dashboard section -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Field Sites</h1>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-1 mb-2">
            <h1 class="h3">Add New Field Site</h1>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <form action="" method="post" class="form-changepass">
              <input type="text" name="fname" class="form-control" placeholder="Fieldsite Name"/>
              <input type="text" name="faddress" class="form-control" placeholder="Fieldsite Address"/>
              <input type="text" name="ftype" class="form-control" placeholder="Fieldsite Type"/>
              <select id='coordinatorname' name='coordinatorname' class="btn btn-sm btn-outline-secondary btn-block pb-2 mb-2">
                <option value="" disabled selected>Select a coordinator</option>
                <?php 
                $sql2 = "SELECT CONCAT(u.firstname, ' ', u.lastname) AS fullname FROM
                       users u JOIN coordinators c ON (u.userid = c.user_id)";
                $result3 = mysqli_query($dbh, $sql2);
                while($row2 = mysqli_fetch_array($result3)):;
                ?>
                <option><?php echo $row2[0];?></option>
                <?php endwhile;?>
              </select>
              <input class="btn btn-lg btn-warning btn-block" type="submit" name="addfieldsite" value="Add Field Site"/>
            </form>
          </div>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-1 mb-2">
            <h1 class="h3">Field Site Workers</h1>
          </div>


          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-1 mb-2">
            <form action="" method="post" name="Reports">
                <div class="btn-group mr-2 pb-2">
                  <input class="btn btn-sm btn-outline-secondary" type="button" value="Edit Field Site"></input>
                  <input class="btn btn-sm btn-outline-secondary" type="submit" name="submit" value="Search"></input>
                  <select class="btn btn-sm btn-outline-secondary" id='fieldsitename' name='fieldsitename'>
                    <option value="" disabled selected>Select a field site</option>
                    <?php
                     while($row1 = mysqli_fetch_array($result2)):;
                    ?>
                      <option><?php echo $row1[0];?></option>
                    <?php endwhile;?>
                  </select>
                  <?php   
                  if (!isset($_GET["fieldsiteid"]) && !$userid == 1){
                  echo "Error: This page is for administrators only. Click <a href='login.php'>here</a> to login.\n";
                  }else{
                    echo $form;
                    $link = "./adminfieldsite.php?fieldsiteid=" . $fieldsiteid;
                    $fieldsiteid = $_GET["fieldsiteid"];
                    $query = "select * from fieldsites where fieldsiteid = '$fieldsiteid'";
                    $result = mysqli_query($dbh, $query);
                    $numrows = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                    $fsname = $row['name'];
                    $fsaddress = $row['address'];
                    $fstype = $row['type']; 
                    }
                    ?>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                  <div class="table-responsive pb-2 mb-2">          
                    <?php
                    $link = "./adminfieldsite.php?fieldsitename=";
                    if($_POST['submit']){
                    $fieldsitename = $_POST['fieldsitename'];
                    $tbl = "select distinct concat(firstname, ' ', lastname) as workerName, email, f.fieldsiteid as fieldid from fieldsites f ";
                    $tbl .= "join studenttimesheets sts on (f.fieldsiteid = sts.fieldsiteid) ";
                    $tbl .= "join students s using (bannerid) ";
                    $tbl .= "join users u using (userid) ";
                    $tbl .= "where f.name = '" . $fieldsitename . "' ";
                    $tblresults = mysqli_query($dbh,$tbl);

                    $getID = "select fieldsiteid from fieldsites where name = '" . $fieldsitename . "' ";
                    $getResults = mysqli_query($dbh,$getID);
                    if($getResults ->num_rows > 0){
                      while ($row = mysqli_fetch_assoc($getResults)){
                        $fsid = "./adminfieldsite.php?fieldsiteid=" . $row['fieldsiteid'];
                      }
                    }


                    if($tblresults ->num_rows > 0){
                      echo "<table class='table'>";
                      echo "<tr><th>&nbsp &nbsp Name &nbsp &nbsp </th>
                            <th> Email </th></tr>";
                      $tableresults = "";


                  while ($row = mysqli_fetch_assoc($tblresults)){
                    $tsidnumber = $row['timesheetid'];
                    $tableresult .= "<tr>";
                    $tableresult .= "<td>" . $row['workerName'] . "</td>";
                    $tableresult .= "<td>" . $row['email'] ."</td>";
                    $tableresult .= "</tr>";
                  }
      
                  $tableresult .= "</table>";
                  echo $tableresult;
                
                  }
                  else{
                  echo "Error. No students working at fieldsite." . mysqli_error($dbh);
                  }
                  }

                  if($_POST['addfieldsite']){
                    $fname = mysqli_real_escape_string($dbh, $_POST['fname']);
                    $faddress = mysqli_real_escape_string($dbh, $_POST['faddress']);
                    $ftype = mysqli_real_escape_string($dbh, $_POST['ftype']);
                    $coordinatorname = mysqli_real_escape_string($dbh, $_POST['coordinatorname']);
                    $namesplit = explode(" ", $coordinatorname);
                    $name = $namesplit[0];
  
                    $selectcoordid = "SELECT c.coordinatorid, u.firstname FROM coordinators c JOIN
                                      users u ON (c.user_id = u.userid) WHERE firstname = '$name'";
                    $res = mysqli_query($dbh, $selectcoordid);
                    if($res){
                      $row = mysqli_fetch_assoc($res);
                      $coordid = $row['coordinatorid'];
                      $sql = "INSERT INTO fieldsites (name, address, type, coordinatorid) VALUES 
                              ('$fname', '$faddress', '$ftype', '$coordid')";
                      $result = mysqli_query($dbh, $sql);
                      if($result){
                        echo "$fname has been successfully added!";
                      }else{
                        echo "Error: New field site could not be entered! Error: " . mysqli_error($dbh);
                      }
                      }
                    else{
                      echo "Error: Couldn't select coordinator id. Error: " . mysqli_error($dbh);
                    }
                    }

                    ?>
                  </div>
              </div>
            </form>
          </div>

        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>
</html>