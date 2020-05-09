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
			echo "<table border=\"1px solid\" align=\"center\"><tr><th>Date</th><th>Subject</th><th>Grade</th><th>Passed</th></tr>";
			while ($grade_row = pg_fetch_row($result)) {
				if ($grade_row[4] == t)
					$passed = "YES";
				else
					$passed = "NO";
				echo "<tr><td>".$grade_row[0]."</td><td>".$grade_row[2]."</td><td>".$grade_row[3]."</td><td>".$passed."</td></tr>";
			}
		} else {
			echo"<p align=\"center\">You don't have any grades to show.</p>";
		}
		echo "<p align=\"center\"><a href=\"logout.php\">Logout</a></p>";
		pg_close($conn);
	} else {
		echo"<p align=\"center\">Your session is expired. Please login again.</p>";
		echo "<p align=\"center\"> <a href=\"index.php\"> Login </a></p>";
	}
?>
