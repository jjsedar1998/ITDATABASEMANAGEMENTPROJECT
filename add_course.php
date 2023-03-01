    <?php
    include ('dbconfig.php');
    $con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
or die("<br>Cannot connect to DB:$dbname on $dbhostname. Error:
" . mysqli_connect_error());
   /* if(!isset($_COOKIE["aid"]))
 die("<br>Please login first. \n")
 else
 {
    setcookie("userid", $row['aid'], time(), + 3600);
 }*/
 $cookie_name = $_COOKIE['userid'];
 if(!isset($cookie_name)) {
   header("location: index.html");
 } else {
 echo "Cookie is named: " . $cookie_name;
 }
 //make array for checkboxes use while loop
 $sql = "select Fid, name from TECH3740.Faculty";
 $sql2 = "select rid, concat(Building,'', Number) as name, size from TECH3740.Rooms";
echo "<br><a href='logout.php'>logout</a><br>";
echo "<font size=4><b>Add a course</b></font>";
echo "<form name='input' action='insert_course.php' method='post' required='required'>
Course ID: <input type='text' name='course_id' size=5 required='required'> (ex: CPS1231)";
echo "<br>Course Name: <input type='text' name='course_name' required='required'>";
echo "<br> Term: ";
echo "<input type='checkbox' name='term' value='Spring'><label>Spring</label>";
echo "<input type='checkbox' name='term' value='Summer'><label>Summer</label>";
echo "<input type='checkbox' name='term' value='Fall'><label>Fall</label>";
echo "<br> Enrollment: <input type='text' name='enrollment' size=3 required='required'>(# of registered students)";
echo "<br>Select a faculty: ";
echo "<SELECT name='fid'>";
echo "<option value = ''></option>";
$result = mysqli_query($con, $sql);
        if($result) 
        {
         if (mysqli_num_rows($result)>0) 
        {
                //echo "<br>There are the following admin(s) in the database where .";
        while($row = mysqli_fetch_array($result))
        {
                    //rid, name, building room, room number, size
                    echo '<option value = "' .$row["Fid"]. '">'.$row["name"].'</option>';
                    
        }
      }
   }
  echo "</select>";
  echo "<br>Room: ";
echo "<SELECT name='rid'>";
echo "<option value = ''></option>";
$result2 = mysqli_query($con, $sql2);
        if($result2) 
        {
         if (mysqli_num_rows($result2)>0) 
        {
                //echo "<br>There are the following admin(s) in the database where .";
        while($row2 = mysqli_fetch_array($result2))
        {
                    //rid, name, building room, room number, size
                    echo '<option value = "' .$row2["rid"]. '">'.$row2["name"].' has ' .$row2['size']. ' seats.'. '</option>';
                    
        }
      }
   }
  echo "</select>";
echo "<input type='submit' value='Submit' name='Submit'>
</form>";
echo "</HTML>";
?>