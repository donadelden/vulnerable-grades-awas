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
  // with password before username it can't be possible to use a simple injection
  // like user="denis'--" password="any" to login
  $query = "SELECT * FROM users WHERE password='$password' AND username ='$user';";
  $result = pg_query($conn, $query);
  //todo: verify this stuff for errors...
  $error = pg_result_error($result);
  // check if there are some results
  // if we set !=1 we eliminate the possibility to inject:
  // user="any" password="any' or 1=1;--"
  // to retrieve all the users and so print login as the first one
  // also, with password="any' or 1=1 and admin=TRUE;--" you can login as admin
  if(pg_num_rows($result)==0){
    echo"<html><body>";
    echo"<p align=\"center\">Your username and/or password is incorrect! <a href=\"index.php\">Retry</a></p>";
    echo"<p>$error</p>";
    echo"</body></html>";
  } else {
    $row = pg_fetch_row($result);
    //check if admin
    if($row[4]=='t'){
      //setcookie("test:ok"); //do we want to set some cookies?
      // admin page
      echo"<html><body>";
      echo"<p align=\"center\">Welcome, $row[0]!</p>";
      echo"<p align=\"center\">This is the ADMIN page!</p>";
      //include admin.php
      echo"</body></html>";
    } else {
      // standard user page
      echo"<html><body>";
      echo"<p align=\"center\">Welcome, $row[0]!</p>";
      echo"<p align=\"center\">This is the USER page!</p>";
      include "user.php";
      echo"</body></html>";
    }
    // debug:
    //echo "$row[0] $row[1] $row[2] $row[3] $row[4]";
  }
   pg_close($conn);
?>
