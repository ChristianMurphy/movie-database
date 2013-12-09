<?php
function display_query($Query, $Result_Type) {
	$con=mysqli_connect("localhost","root","root","movies");
	
	//display the query
	echo "<div class='panel panel-default'><div class='panel-body'>" . $Query . "</div></div>";

	
	//query the database
	$result = mysqli_query($con, $Query);

	echo "<table class='table'>";
	
	switch(table_type($Result_Type)) {
		case "Person":
			echo "<tr><th>First Name</th> <th>Last Name</th> <th>Birth Date</th> <th>Death Date</th></tr>";
			while($row = mysqli_fetch_array($result)) {
				display_row(array("first_name", "last_name", "birth_date", "death_date"), $row);
			}
			break;

		case "Movie":
			echo "<tr><th>title</th> <th>Release Date</th> <th>Rating</th> <th>Length</th> <th>Tagline</th> <th>Summary</th> <th>Budget</th></tr>";
			while($row = mysqli_fetch_array($result)) {
				display_row(array("title", "release_date", "rating", "length", "tagline", "summary", "budget"), $row);
			}
			break;

		default:
			break;
	}
	echo "</table>";

	mysqli_close($con);
}

function display_row($fields, $row) {
	echo "<tr>";
	foreach ($fields as $field) {
		echo "<td>" . $row[$field] . "</td>";
  	}
  	echo "</tr>";
}
?>