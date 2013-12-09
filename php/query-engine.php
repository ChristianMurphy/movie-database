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
	  
		default:
			# code...
			break;
	}

	return $Type;
}

function return_attributes ($return_type, $param_type) {
	$Attributes = "";
	switch (table_type($return_type)) {
		case 'Person':
			$Attributes = "first_name, last_name, birth_date, death_date";
			break;
		
		case 'Movie':
			$Attributes = "title, release_date, rating, length, tagline, summary, budget FROM movie";
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
				$Tables .= "acts";
				break;

			case "Director":
				$Tables .= "directs";
				break;
    
			case "Movie":
				if ($_POST["param-type"] == "Genre") {
					$Tables .= "in_genre";
				} else {
					$Tables .= "directs, acts";
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
	return $Select;
}

?>