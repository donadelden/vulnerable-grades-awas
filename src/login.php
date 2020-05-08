<?php
  // start and empty session
  // session_start();
  // set validity time for cookies
  $validity_time = 72000; //two hours
  // get user and password
  $user = $_POST['user'];
  $password = $_POST['password'];

  if((!$user) || (!$password)){
    echo "Please, insert both username and passowrd! <br /><br />";
    include "index.php";
  }
  $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
  // with password before username it can't be possible to use a simple injection
  // like user="denis'--" password="any" to login
  $enc_pass = md5($password);
  $query = "SELECT * FROM users WHERE username ='$user' AND password='$enc_pass';";
  $result = pg_query($conn, $query);
  // check if there are some results
  // if we set !=1 we eliminate the possibility to inject:
  // user="any" password="any' or 1=1;--"
  // to retrieve all the users and so print login as the first one
  // also, with password="any' or 1=1 and admin=TRUE;--" you can login as admin
  if(pg_num_rows($result)==0){
    echo"<html><body>";
    echo "<title>Vulnerable grades</title>";
    echo"<p align=\"center\">Your username and/or password is incorrect! <a href=\"index.php\">Retry</a></p>";
    echo"</body></html>";
  } else if(pg_num_rows($result)==1){
    $row = pg_fetch_row($result);
    // use as session cookie the base64 of the username
    setcookie('LOGIN', base64_encode($user), time()+$validity_time);
    //check if admin
    if($row[4]=='t'){
      // admin page
      header("location: /admin.php");
    } else {
      header("location: /user.php");
    }
  } else {
    echo"<html><body>";
    echo"<p align=\"center\">A problem occurs! <a href=\"index.php\">Retry</a></p>";
    echo"<!--";
    while($row = pg_fetch_row($result)) {
      echo"$row[0], $row[1], $row[2], $row[3], $row[4]<br>";
    }
    echo"--!>";
    echo"</body></html>";
  }
  pg_close($conn);
?>
