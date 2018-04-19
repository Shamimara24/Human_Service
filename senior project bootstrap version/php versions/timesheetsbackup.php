

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Timesheets</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
  </head>

  
  <body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0" style="background-color: #333333">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Rowan University</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="login.php">Sign out</a>
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
                <a class="nav-link" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="timesheets.php">
                  <span data-feather="clock"></span>
                  Timesheets <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="connections.php">
                  <span data-feather="users"></span>
                  Connections
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">
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
            <h1 class="h2">Timesheet</h1>
          </div>
          
          <form name="form-time" align="center">
            <div class="table-responsive pb-2 mb-2">          
            <table class="table">
                <tr>
                  <th></th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thursday</th>
                  <th>Friday</th>
                  <th>Saturday</th>
                  <th>Sunday</th>
                </tr>
              <tbody>
                <tr>
                  <td>Week 1</td>
                  <td>
                    <input type="number" id="monday1" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="tuesday1" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="wednesday1" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="thursday1" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="friday1" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="saturday1" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="sunday1" class="form-control" placeholder="0" required>
                  </td>
                </tr>
                <tr>
                  <td>Week 2</td>
                  <td>
                    <input type="number" id="monday2" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="tuesday2" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="wednesday2" class="form-control" placeholder="0" required>
                  </td>
                  <td>
                    <input type="number" id="thursday2" class="form-control" placeholder="0">
                  </td>
                  <td>
                    <input type="number" id="friday2" class="form-control" placeholder="0">
                  </td>
                  <td>
                    <input type="number" id="saturday2" class="form-control" placeholder="0">
                  </td>
                  <td>
                    <input type="number" id="sunday2" class="form-control" placeholder="0" required>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
            <button class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Submit TimeSheet">Submit Timesheet</button>
          </form>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 mt-3 border-top">
            <h1 class="h2">Submitted Timesheets</h1>
          </div>
            <div class="table-responsive pb-2 mb-2">          
            <table class="table">
              <thead>
                <tr>
                  <th>Timesheet #</th>
                  <th>Date Created</th>
                  <th>Total # of Hours</th>
                  <th>Supervisor</th>
                  <th>Status</th>
                  <th>Open</th>
                </tr>
              </thead>

              <br />
<b>Warning</b>:  mysqli_fetch_array() expects parameter 1 to be mysqli_result, boolean given in <b>/home/mcgrathj2/public_html/SeniorProject/timesheets.php</b> on line <b>181</b><br />
              
            </table>
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
