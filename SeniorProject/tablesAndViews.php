<?php
   // Connect to the database
   if (!include('connect.php')) {
      die('error finding connect file');
   }
   $dbh = ConnectDB();
?>
<html>
<head>
   <link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
   <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet" type='text/css'>
   <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
   <link href="main.css" rel="stylesheet" type='text/css'>
   <title>Table Results</title>
<style>
h1 {
font-family: 'Lobster', serif;
font-size: 20px;
}
body {
font-family: 'Cuprum', serif;
font-size: 14px;
}
</style>
</head>
<body>
<div class="content">
<h1>Table and View Browser</h1>
<p>Select a table or view from the dropdown and submit to see all records.</p>
<div class="form">
<form action="search.php" method="get">
<?php
  // Get the full list of tablenames from schema
  $sql =  "SELECT username FROM rodrigueb6.users";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $result = mysqli_query($dbh, $sql);
  $numrows = mysqli_num_rows($result);
  echo "$numrows \n";
  if($result){
        echo "failed\n";
  }

  // Prep drop down control
  echo "<label for='tablename'>Select department: </label>\n";
  echo "<select id='tablename' name='tablename'>\n";
  // Put table names in the options
  foreach ($stmt->fetchAll() as $tables) {
     echo "<option value='" . $tables['username'] . "'>" . $tables['username'] . "</option>\n";
  }
 // End dropdown and submit button
  echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;\n\n";

  // End dropdown and submit button
  echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Submit'>\n</form>\n</div>";
?>
</div>
</body>
</html>

