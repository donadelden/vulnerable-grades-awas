<?php
  function checkLogin(){
    // get the login cookie value
    $cookie = $_COOKIE['LOGIN'];
    // retreive user list
    $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
    $result = pg_query($conn, "SELECT username FROM users;");
    // create a variable to indicate the user states
    $logged = false;
    // check if there is a match and so the user is logged in
    while($row = pg_fetch_row($result)) {
      if (md5($row[0]) == $cookie){
        $user = $row[0];
        $logged = true;
        break;
      }
    }
    // then return a value
    if($logged)
      return $user;
    else
      return false;

    pg_close($conn);
  }

  function checkAdmin($user){
    $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
    $result = pg_query($conn, "SELECT admin FROM users WHERE username='$user';");
    $row = pg_fetch_row($result);
    // check if the user is admin
    if($row[0]==t)
      return true;
    else
      return false;

    pg_close($conn);
  }

?>
