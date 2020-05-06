<?php
	$user = $_GET['username'];
	$date = $_GET['date'];
	
	$conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020");
	$query = "DELETE FROM grades WHERE exam_date='$date' AND username='$user'";
	$result = pg_query($conn, $query);
	$error = pg_result_error($result);
	header("Location: admin.php");
?>