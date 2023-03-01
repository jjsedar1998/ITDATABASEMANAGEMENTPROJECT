<?php
include ('dbconfig.php');
$cookie_name = $_COOKIE['userid'];
 if(!isset($cookie_name)) {
   header("location: index.html");
 } else {
 echo "Cookie is named: " . $cookie_name;
 }
 
$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
or die("<br>Cannot connect to DB:$dbname on $dbhostname. Error:
" . mysqli_connect_error());
$user_input = $_GET['searching'];
//sql search for all
if($user_input == '*')
{
$sql = "select c.cid, c.name, f.name as faculty_name, c.term, c.enrollment, concat(r.Building, ' ', r.Number) as building_room, r.size, a.name as added_by_admin from TECH3740_2022F.Courses_sedarj c, TECH3740.Faculty f, TECH3740.Rooms r, TECH3740.Admin a where c.Fid=f.fid and c.Rid=r.Rid and c.aid=a.aid";
$result = mysqli_query($con, $sql); 


//all courses searched
if($result) 
{
	$sql2="select c.cid, c.name, f.name as faculty_name, c.term, c.enrollment, concat(r.Building, ' ', r.Number) as building_room, r.size, a.name as added_by_admin, count(*) from TECH3740_2022F.Courses_sedarj c, TECH3740.Faculty f, TECH3740.Rooms r, TECH3740.Admin a where c.Fid=f.fid and c.Rid=r.Rid and c.aid=a.aid";
	 $result3 = $con->query($sql2);
	 while($row = mysqli_fetch_array($result3)) 
	 {
		 echo "<br>There are ", $row['count(*)'], " courses(s) in the database that match '%$user_input%'.";
		 echo "<br />";
	 }
	if (mysqli_num_rows($result)>0) 
	{
		
		echo "<TABLE border=1>\n";
		echo "<TR><TH>Course ID<TH>Course Name<TH>Faculty Name<TH>Term<TH>Enrollment<TH>Building Room<TH>Size<TH>Added by Admin\n";
	while($row = mysqli_fetch_array($result))
	{
		//rid, name, building room, room number, size
		$course_id = $row['cid'];
		$course_name = $row['name'];
		$faulty_name = $row['faculty_name'];
		$term = $row['term'];
		$enrollment = $row['enrollment'];
		$building_room = $row['building_room'];
		$size = $row['size'];
		$added_by_admin = $row['added_by_admin'];
		//checks enrollment and prints on difference
		if($enrollment >= $size || $enrollment <= 0)
		{
			$color="red";
			echo "<TR><TD>$course_id<TD>$course_name<TD>$faulty_name<TD>$term<TD><font color='$color'>$enrollment<TD>$building_room<TD>$size<TD>$added_by_admin\n";
		}
		else
		{
			echo "<TR><TD>$course_id<TD>$course_name<TD>$faulty_name<TD>$term<TD>$enrollment<TD>$building_room<TD>$size<TD>$added_by_admin\n";
		}
	}
		echo "</TABLE>\n";
		
	}
	else 
	{
		//no results
		echo "<br>No records in the database.\n";
		mysqli_free_result($result);
 	} 
	}
 	else 
	{
 		echo "<br>Something wrong with the SQL query.\n";
 	}
	//rows for courses
	 
	//get total enrollment
	$sql3="select c.cid, c.name, f.name as faculty_name, c.term, sum(c.enrollment) as total, concat(r.Building, ' ', r.Number) as building_room, r.size, a.name as added_by_admin, count(*) from TECH3740_2022F.Courses_sedarj c, TECH3740.Faculty f, TECH3740.Rooms r, TECH3740.Admin a where c.Fid=f.fid and c.Rid=r.Rid and c.aid=a.aid";
	 $result4 = $con->query($sql3);
	 while($row = mysqli_fetch_array($result4)) 
	 {
		 echo "Total enrollment: ", $row['total'];
		 echo "<br />";
	}
}
	else
{
	$sql1 = "select c.cid, c.name, f.name as faculty_name, c.term, c.enrollment, 
	concat(r.Building, ' ', r.Number) as building_room, r.size, a.name as added_by_admin from TECH3740_2022F.Courses_sedarj c, 
	TECH3740.Faculty f, TECH3740.Rooms r, TECH3740.Admin a where c.Fid=f.fid and c.Rid=r.Rid 
	and c.aid=a.aid and (c.cid like '%$user_input%' or c.name like '%$user_input%')";
	$result1 = mysqli_query($con, $sql1); 
	
	//courses searched by parameter
	if($result1) 
	{
		$sql2="select c.cid, c.name, f.name as faculty_name, c.term, c.enrollment, 
		concat(r.Building, ' ', r.Number) as building_room, r.size, a.name as added_by_admin, count(*) from TECH3740_2022F.Courses_sedarj c, 
		TECH3740.Faculty f, TECH3740.Rooms r, TECH3740.Admin a where c.Fid=f.fid and c.Rid=r.Rid 
		and c.aid=a.aid and (c.cid like '%$user_input%' or c.name like '%$user_input%')";
		$result3 = $con->query($sql2);
		while($row = mysqli_fetch_array($result3)) 
		{
			echo "<br>There are ", $row['count(*)'], " courses(s) in the database that match '%$user_input%'.";
			echo "<br />";
		}
		if (mysqli_num_rows($result1)>0) 
		{
			echo "<TABLE border=1>\n";
			echo "<TR><TH>Course ID<TH>Course Name<TH>Faculty Name<TH>Term<TH>Enrollment<TH>Building Room<TH>Size<TH>Added by Admin\n";
		while($row = mysqli_fetch_array($result1))
		{
			//rid, name, building room, room number, size
			$course_id = $row['cid'];
			$course_name = $row['name'];
			$faulty_name = $row['faculty_name'];
			$term = $row['term'];
			$enrollment = $row['enrollment'];
			$building_room = $row['building_room'];
			$size = $row['size'];
			$added_by_admin = $row['added_by_admin'];
			//checks enrollment and prints on difference
			if($enrollment >= $size)
			{
				$color = "red";
				echo "<TR><TD>$course_id<TD>$course_name<TD>$faulty_name<TD>$term<TD><font color='$color'>$enrollment<TD>$building_room<TD>$size<TD>$added_by_admin\n";
			}
			else
			{
				echo "<TR><TD>$course_id<TD>$course_name<TD>$faulty_name<TD>$term<TD>$enrollment<TD>$building_room<TD>$size<TD>$added_by_admin\n";
			}
		}	
			echo "</TABLE>\n";
			
		}
		else 
		{
			//no records
			echo "<br>No records in the database.\n";
			mysqli_free_result($result1);
		 } 
		}
		 else 
		{
			//query error
			 echo "<br>Something wrong with the SQL query.\n";
		 }
		 //gets row amount
	
	$sql3="select c.cid, c.name, f.name as faculty_name, c.term, sum(c.enrollment) as total, 
	concat(r.Building, ' ', r.Number) as building_room, r.size, a.name as added_by_admin, 
	count(*) from TECH3740_2022F.Courses_sedarj c, 
	TECH3740.Faculty f, TECH3740.Rooms r, TECH3740.Admin a 
	where c.Fid=f.fid and c.Rid=r.Rid 
	and c.aid=a.aid and (c.cid like '%$user_input%' or c.name 
	like '%$user_input%')";
	 $result4 = $con->query($sql3);
	 while($row = mysqli_fetch_array($result4)) 
	 {
		 echo "Total enrollment: ", $row['total'];
		 echo "<br />";
	}
	
}
	mysqli_close($con);
  ?>
