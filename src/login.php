<?php
  // set validity time for cookies
  $validity_time = 72000; //two hours
  // get user and password
  $user = $_POST['user'];
  $password = $_POST['password'];

  if ((!$user) || (!$password)) {
    echo "Please, insert both username and passowrd! <br /><br />";
    include "index.php";
  }

  $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020");
  // validate username and password - in the database, passwords are md5 encrypted
  $enc_pass = md5($password);
  $query = "SELECT * FROM users WHERE username ='$user' AND password='$enc_pass';";
  $result = pg_query($conn, $query);
  // no match
  if (pg_num_rows($result) == 0) {
    echo"<html><body>";
    echo "<title>Vulnerable grades</title>";
    echo"<p align=\"center\">Your username and/or password is incorrect! <a href=\"index.php\">Retry</a></p>";
    echo"</body></html>";
  } else { 
    $row = pg_fetch_row($result);
    // use as session cookie the base64 of the username
    setcookie('LOGIN', base64_encode($user), time() + $validity_time);
    //check if admin
    if ($row[4]=='t') {
      // admin page
      header("location: /admin.php");
    } else {
      // user page
      header("location: /user.php");
    }
  }
  pg_close($conn);
?>
