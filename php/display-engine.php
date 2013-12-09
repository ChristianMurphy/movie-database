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
				echo "<tr><td>" . $row['first_name'] . "</td> <td>" . $row['last_name'] . "</td> <td>" . $row['birth_date'] . "</td> <td>" . $row['death_date'] . "</td></tr>";
			}
			break;

		case "Movie":
			echo "<tr><th>title</th> <th>Release Date</th> <th>Rating</th> <th>Length</th> <th>Tagline</th> <th>Summary</th> <th>Budget</th></tr>";
			while($row = mysqli_fetch_array($result)) {
				echo "<tr><td>" . $row['title'] . "</td> <td>" . $row['release_date'] . "</td> <td>" . $row['rating'] . "</td> <td>" . $row['length'] . "</td> <td>" . $row['tagline'] . "</td> <td>" . $row['summary'] . "</td> <td>$" . $row['budget'] . " million" . "</td></tr>";
			}
			break;

		default:
			break;
	}
	echo "</table>";

	mysqli_close($con);
	
}
?>