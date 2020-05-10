<?php
  setcookie('LOGIN', "", time() - 1); // expire login cookies
  echo "<title>Vulnerable grades</title>";
  echo "<p align=\"center\"> Goodbye!</p>";
  echo "<p align=\"center\"> <a href=\"index.php\"> Login </a></p>";
?>
