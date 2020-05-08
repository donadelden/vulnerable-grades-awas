<?php
  echo "<title>Vulnerable grades</title>";
  setcookie('LOGIN', "", time() - 1); // expire login cookies
  echo "<p align=\"center\"> Goodbye!</p>";
  echo "<a href=\"index.php\"> Login </a>";
?>
