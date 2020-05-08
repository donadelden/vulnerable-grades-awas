<?php
  function checkLoginBase64(){
    // decode the login cookie value
    // it is the base64 of the username
    if ($_COOKIE['LOGIN'] == false)
      return false;
    $cookie = base64_decode($_COOKIE['LOGIN']);
    // check if username in the database
    $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
    $result = pg_query($conn, "SELECT * FROM users WHERE username = '$cookie';");
    pg_close($conn);
    if (pg_num_rows($result) > 0)
      return $cookie;

    return false;
  }

  function checkAdmin($user){
    $conn = pg_connect("host=docker-db dbname=db-grades user=admin password=awas2020" );
    $result = pg_query($conn, "SELECT admin FROM users WHERE username='$user';");
    $row = pg_fetch_row($result);
    // check if the user is admin
    if ($row[0] == t)
      return true;
    else
      return false;

    pg_close($conn);
  }
?>
