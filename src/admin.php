<?php
	echo"<html><body>";
	echo"<p align=\"center\">Welcome!</p>";
	echo"<p align=\"center\">This is the ADMIN page!</p>";
	echo"<p align=\"center\">Here are all the grades:</p>";
	echo "<nav><a href=\"addGrade.php\">Add grade</a></nav>";
	$conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020");
	$query = "SELECT exam_date, subject, grade, name, surname, g.username AS usr FROM grades g, users u WHERE g.username = u.username";
	$result = pg_query($conn, $query);
	$error = pg_result_error($result);
	if (pg_num_rows($result) > 0) {
		echo "<table border=\"1px solid\" align=\"center\"><tr><th>Date</th><th>Name</th><th>Surname</th><th>Username</th><th>Subject</th><th>Grade</th><th>Delete</th></tr>";
		while ($grade_row = pg_fetch_assoc($result)) {
			echo "<tr><td>".$grade_row["exam_date"]."</td><td>".$grade_row["name"]."</td><td>".$grade_row["surname"]."</td><td>".$grade_row["usr"]."</td><td>".$grade_row["subject"]."</td><td>".$grade_row["grade"]."</td><td> <a href=\"deleteGrade.php?username=".$grade_row["usr"]."&date=".$grade_row["exam_date"]."\" onclick=\"return confirm('Are you sure you want to delete this?')\">delete</a> </td></tr>";
		}
	} else {
		echo"<p align=\"center\">No entries available.</p>";
	}
	echo "<a href=\"index.php\"> Logout </a>";
    echo"</body></html>";
?>