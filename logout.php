<!DOCTYPE html>
<html>
<body>
 
<?php
 
    echo "Logged out successfully";
 
    setcookie("userid", '', time() - 3600, "/");

    echo"<br><a href='index.html'>Project home page</a>";

 
?>
 
</body>
</html>