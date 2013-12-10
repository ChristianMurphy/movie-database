<?php

function table_type ($table_name) {
	$Type = "";
	switch ($table_name) {
		case "Actor":
		case "Director":
			$Type = "Person";
			break;

		case "Movie":
			$Type = "Movie";
                        break;

                case "Critiques":
                        $Type = "Critiques";
                        break;

		default:
			# code...
			break;
	}

	return $Type;
}

function return_attributes ($return_type) {
	$Attributes = "";
	switch (table_type($return_type)) {
		case 'Person':
			$Attributes = "first_name, last_name, birth_date, death_date";
			break;
		
		case 'Movie':
			$Attributes = "title, release_date, rating, length, tagline, summary, budget";
                        break;
                case 'Critiques':
                        $Attributes = "first_name, last_name, title, stars, content";
                       break; 

		default:
			# code...
			break;
	}
	return $Attributes;
}

function tables($return_type, $param_type) {
	$Tables = strtolower($param_type);
	if (table_type($return_type) != $param_type) {
		switch ($_POST["return-type"]) {
			case "Actor":
				$Tables .= ", person, acts";
				break;

			case "Director":
				$Tables .= ", person, directs";
				break;
    
			case "Movie":
				if ($_POST["param-type"] == "Genre") {
					$Tables .= ", movie, in_genre";
				} else {
					$Tables .= ", movie , directs, acts";
				}
				break;
			default:
				# code...
				break;
		}
	}
	return $Tables;
}

function select($return_type, $param_type, $param_value) {
	$Select = "";

	//query by user value
	switch ($param_type) {
		case 'Person':
		$Select .= "((person.first_name='" . $param_value . "') OR (person.last_name='" . $param_value . "'))";
		break;

	case 'Movie':
		$Select .= "movie.title='" . $param_value . "'";
		break;

	case 'Genre':
		$Select .= "genre.name='" . $param_value . "'";
		break;
    
	default:
		# code...
		break;
	}

	//handles join tables
	if (table_type($return_type) != $param_type) {
		$Select .= " AND ";
		switch ($return_type) {
			case "Actor":
			$Select .= "person.id = acts.person_id AND acts.movie_id = movie.id";
			break;

		case "Director":
			$Select .= "person.id = directs.person_id AND directs.movie_id = movie.id";
			break;
    
		case "Movie":
			if ($param_type == "Genre"){
				$Select .= "(movie.id = in_genre.movie_id AND genre.id = in_genre.genre_id) ";
			} else {
				$Select .= "((person.id = directs.person_id AND directs.movie_id = movie.id) OR (person.id = acts.person_id AND acts.movie_id = movie.id))";
			}
		break;

		default:
			# code...
			break;
		}
	}

	return $Select;
}

function query ($return_type, $param_type, $param_value) {
	return "SELECT DISTINCT " . return_attributes($return_type) . " FROM " . tables($return_type, $param_type) . " WHERE " . select($return_type, $param_type, $param_value);
}

?>
