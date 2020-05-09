<title>Vulnerable grades</title>
<div align="center">
<form action="addGradeCheck.php" method="POST" id="formAddGrade">
	<label>Exam date (optional)</label><br/>
	<input name="date" type="date" id="date" /><br/>
	<label>Username</label><br/>
	<input name="username" type="text" id="username" /><br/>
	<label>Subject</label><br/>
	<input name="subject" type="text" id="subject" /><br/>
	<label>Grade</label><br/>
	<input name="grade" type="text" id="grade" /><br/><br/>
	<label>Passed</label><br/>
	<input name="passed" type="checkbox" id="passed" /><br/><br/>
	<input type="submit" name="Add" value="Add grade" /> 
</form>
<a href="admin.php"> Go back </a>
</div>