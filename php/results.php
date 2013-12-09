<!DOCTYPE html>
<html>
  <head>
    <title>Movie Database Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" defer></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" defer></script>
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Movie Database</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <p class="navbar-text navbar-right">Justin Dobson, Kris Dorer, Christian Murphy</li></p>
      </div><!-- /.navbar-collapse -->
    </nav>



    <main class="container">



<?php
require "query-engine.php";
$con=mysqli_connect("localhost","root","root","movies");

//creating the query
$Query = "SELECT DISTINCT " . return_attributes($_POST["return-type"], $_POST["param-type"]) . " FROM " . tables($_POST["return-type"], $_POST["param-type"]) . " WHERE " . select($_POST["return-type"], $_POST["param-type"], $_POST["param-value"]);;
$Type = "";

echo $Query . "<br>";

$result = mysqli_query($con, $Query);

echo "<table class='table'>";

//Adding the Header
echo "<tr><th>";
  switch(table_type($_POST["return-type"]))
  {
    case "Person":
      echo "First Name</th> <th>Last Name</th> <th>Birth Date</th> <th>Death Date";
      break;

    case "Movie":
      echo "title</th> <th>Release Date</th> <th>Rating</th> <th>Length</th> <th>Tagline</th> <th>Summary</th> <th>Budget";
      break;

    default:
      break;
  }
  echo "</th></tr>";


//Adding all the data
while($row = mysqli_fetch_array($result)) 
{
  echo "<tr><td>";
  switch(table_type($_POST["return-type"]))
  {
    case "Person":
      echo $row['first_name'] . "</td> <td>" . $row['last_name'] . "</td> <td>" . $row['birth_date'] . "</td> <td>" . $row['death_date'];
      break;

    case "Movie":
      echo $row['title'] . "</td> <td>" . $row['release_date'] . "</td> <td>" . $row['rating'] . "</td> <td>" . $row['length'] . "</td> <td>" . $row['tagline'] . "</td> <td>" . $row['summary'] . "</td> <td>$" . $row['budget'] . " million";
      break;

    default:
      break;
  }
  echo "</td></tr>";
}
echo "</table>";

mysqli_close($con);
?> 



    </main>
   
  </body>
</html>


