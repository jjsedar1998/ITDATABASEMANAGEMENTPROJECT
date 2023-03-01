<?php
/*
    Jacob Sedar
    TECH3740-01
    Project
    insert_course.php to insert a course into database and check if it is already there
    */
    //connects config file for database access
//connect to database through cookie
if (isset($_POST['Submit']))  
{
  include ('dbconfig.php');

  $con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
  or die("<br>Cannot connect to DB:$dbname on $dbhostname. Error:
  " . mysqli_connect_error());

  $cookie_name = $_COOKIE['userid'];
  if(!isset($cookie_name)) 
  {
    header("location: index.html");
  } 
  else 
  {
    echo "Cookie is named: " . $cookie_name;
  }

  $c_num = $_POST['course_id'];


  $c_name = $_POST['course_name'];


  $enrollment = $_POST['enrollment'];


  $term = $_POST['term'];

  //checking radio buttons to provide enrollment amount
  $fid = $_POST['fid'];


  $rid = $_POST['rid'];


  //checks to see if value exists and if it does it isn't added
  $sql= "select * FROM TECH3740_2022F.Courses_sedarj where cid like '%$c_num%' or name like '%$c_name%'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_num_rows($result); 

  //echo "<br>SQL: $sql\n";
  if($row >= 1) 
  {
      echo "<br>This course cannot be added as it is a duplicate name or number. Please try again.";
      echo "<br><a href='logout.php'> Logging out</a>";    
  }
  else
  {
    //insertation sql
    $sql1 = "insert into TECH3740_2022F.Courses_sedarj (cid, name, term, enrollment, Fid, Rid, aid) values ('$c_num', '$c_name', '$term', $enrollment, $fid, $rid, $cookie_name)"; 
    $result1 = mysqli_query($con, $sql1); 
   // echo "<br>SQL: $sql1\n";
    if($result1)
    {
      echo "<br>The record was successfully added!";
      echo "<br><a href='index.html'> Back to login</a>";
    }
  }
}
?>