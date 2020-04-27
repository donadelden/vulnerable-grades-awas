<?php
  // start and empty session
  //session start();
  // get user and password
  $user = $_POST['user'];
  $password = $_POST['password'];

  if((!$user) || (!$password)){
    echo "Please, insert both username and passowrd! <br /><br />";
    include "index.php";
  }
  $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
  $query = "SELECT * FROM users WHERE username ='$user' AND password='$password';";
  $result = pg_query($conn, $query);
  //todo: verify this stuff for errors...
  $error = pg_result_error($result);
  // check if there are some results
  if(pg_num_rows($result)!=1){
    echo"<html><body>";
    echo"<p align=\"center\">Your username and/or password is incorrect! <a href=\"index.php\">Retry</a></p>";
    // todo: remove this error stuff or almost hidden it
    echo"<p>'$error'</p>";
    echo"</body></html>";
  } else {
    // todo: check if admin
    setcookie("test:ok");
    //header("Location:pg_inic.php");
    echo"<html><body>";
    echo"<p align=\"center\">Welcome, '$user'!</p>";
    // debug:
    //$row = pg_fetch_row($result);
    //echo "$row[0] $row[1] $row[2] $row[3] $row[4]";
    echo"</body></html>";

  }
   pg_close($conn);
?>
