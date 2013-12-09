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
$con=mysqli_connect("localhost","root","root","movies");

//creating the query
$Query = "SELECT DISTINCT ";
$Type = "";

//finds out what type it is returning
switch ($_POST["return-type"]) {
  //person
  case "Actor":
  case "Director":
    $Query .= "first_name, last_name, birth_date, death_date FROM person ";
    $Type = "Person";
    break;

  //or movie
  case "Movie":
   $Query .= "title, release_date, rating, length, tagline, summary, budget FROM movie ";
    $Type = "Movie";
    break;
  
  default:
    # code...
    break;
}

//if you are searching for a person based on a person
//or a movie based on a movie name simple query
if ($Type == $_POST["param-type"]) {
  $Query .= " WHERE ";
  if ($Type == "Person") {
    $Query .= "person.first_name = '" . $_POST["param-value"] . "'";
  } elseif ($Type == "Movie") {
    $Query .= "movie.title = '" . $_POST["param-value"] . "'";
  }
}

//seaching for a person from by movie name
//or searching for a movie by an actor or a director name
else {
  $Query .= ", " . strtolower($_POST["param-type"]) . ", ";
  //Associate all of the related stuffs
  switch ($_POST["return-type"]) {
    case "Actor":
      $Query .= "acts  WHERE person.id = acts.person_id AND acts.movie_id = movie.id ";
      break;

    case "Director":
      $Query .= "directs  WHERE person.id = directs.person_id AND directs.movie_id = movie.id ";
      break;
    
    case "Movie":
      $Query .= "directs, acts  WHERE ((person.id = directs.person_id AND directs.movie_id = movie.id) OR (person.id = acts.person_id AND acts.movie_id = movie.id)) ";
      break;

    default:
      # code...
      break;
  }

  //runs the actual check against user inputted text
  switch ($_POST["param-type"]) {
    case 'Person':
      $Query .= "AND ((person.first_name='" . $_POST["param-value"] . "') OR (person.last_name='" . $_POST["param-value"] . "'))";
      break;

    case 'Movie':
      $Query .= "AND movie.title='" . $_POST["param-value"] . "'";
      break;
    
    default:
      # code...
      break;
  }
}

echo $Query . "<br>";

$result = mysqli_query($con, $Query);

echo "<table class='table'>";

//Adding the Header
echo "<tr><th>";
  switch($Type)
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
  switch($Type)
  {
    case "Person":
      echo $row['first_name'] . "</td> <td>" . $row['last_name'] . "</td> <td>" . $row['birth_date'] . "</td> <td>" . $row['death_date'];
      break;

    case "Movie":
      echo $row['title'] . "</td> <td>" . $row['release_date'] . "</td> <td>" . $row['rating'] . "</td> <td>" . $row['length'] . "</td> <td>" . $row['tagline'] . "</td> <td>" . $row['summary'] . "</td> <td>" . $row['budget'];
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


