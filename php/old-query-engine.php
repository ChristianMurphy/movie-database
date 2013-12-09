<?php
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
      if ($_POST["param-type"] != "Genre")
      {
        $Query .= "directs, acts  WHERE ((person.id = directs.person_id AND directs.movie_id = movie.id) OR (person.id = acts.person_id AND acts.movie_id = movie.id)) ";
      }
      else
      {
        $Query .= "in_genre WHERE (movie.id = in_genre.movie_id AND genre.id = in_genre.genre_id) ";
      }
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

    case 'Genre':
      $Query .= "AND genre.name='" . $_POST["param-value"] . "'";
      break;
    
    default:
      # code...
      break;
  }
}
?>