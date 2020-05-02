<?php
	$user = $_POST['username'];
	$date = $_POST['date'];
	$subject = $_POST['subject'];
	$grade = $_POST['grade'];

	if((!$user) || (!$subject) || (!$grade)){
	  echo "<script type='text/javascript'>alert('Some fields are missing');</script>";
	  include "addGrade.php";
	} else {
		$conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020");
		// date is optional
		if ($date) {
			$query = "INSERT INTO grades(exam_date, username, subject, grade) VALUES ($1, $2, $3, $4)";
			$result = pg_query_params($conn, $query, array($date, $user, $subject, $grade));
		} else {
			$query = "INSERT INTO grades(username, subject, grade) VALUES ($1, $2, $3)";
			$result = pg_query_params($conn, $query, array($user, $subject, $grade));
		}
		$error = pg_result_error($result);
		echo "<p>Grade added successully!</p>";
		include "addGrade.php";
	}
?>