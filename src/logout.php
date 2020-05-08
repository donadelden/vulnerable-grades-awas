<?php
  // expire login cookies
  setcookie('LOGIN', "", time()-1);
  echo "<p align=\"center\"> Goodbye!</p>";
  echo "<a href=\"index.php\"> Login </a>";
?>
