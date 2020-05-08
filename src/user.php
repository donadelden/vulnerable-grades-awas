<?php
	require_once("sessionManagement.php");
	echo "<title>Vulnerable grades</title>";
	// validate username
	$user = checkLoginBase64();
	if ($user != false){
		$conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
		echo"<p align=\"center\">Welcome, $user!</p>";
		echo"<p align=\"center\">This is the USER page!</p>";
		// get grades
		$query = "SELECT * FROM grades WHERE username ='$user';";
		$result = pg_query($conn, $query);
		$error = pg_result_error($result);
		if (pg_num_rows($result) > 0) {
			echo "<table border=\"1px solid\" align=\"center\"><tr><th>Date</th><th>Subject</th><th>Grade</th></tr>";
			while ($grade_row = pg_fetch_assoc($result)) {
				echo "<tr><td>".$grade_row["exam_date"]."</td><td>".$grade_row["subject"]."</td><td>".$grade_row["grade"]."</td></tr>";
			}
		} else {
			echo"<p align=\"center\">You don't have any grades to show.</p>";
		}
		echo "<a align=\"center\" href=\"logout.php\">Logout</a>";
		pg_close($conn);
	} else {
		echo"<p align=\"center\">Your session is expired. Please login again.</p>";
		echo "<a href=\"index.php\"> Login </a>";
	}
?>
