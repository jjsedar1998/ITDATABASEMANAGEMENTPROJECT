<?php
include ('dbconfig.php');
$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
  or die("<br>Cannot connect to DB:$dbname on $dbhostname\n");
//admin count
//$sql = "select count(*) from TECH3740.Admin";
//$result = mysqli_query($con, $sql); echo "<br>SQL: $sql\n";echo "<br>There are $result admin(s) in the database\n";


//get all admins
$sql = "select * from TECH3740.Admin";
$result = mysqli_query($con, $sql); 

echo "<br>SQL: $sql\n";
if($result) {
	if (mysqli_num_rows($result)>0) 
	{
		echo "The following admins are in the database.";
		echo "<TABLE border=1>\n";
		echo "<TR><TH>ID<TH>Login<TH>Password<TH>Name<TH>dob<TH>Join Date<TH>Gender<TH>Address\n";
	while($row = mysqli_fetch_array($result))
	{
		$aid = $row['aid'];
		$login_id = $row['login'];
		$password = $row['password'];
		$name = $row['name'];
		$dob = $row['dob'];
		$join_date = $row['join_date'];
		$gender = $row['gender'];
		$address = $row['Address'];
		//makes color red or blue based on dob and join date
		if($dob < $join_date || $dob == null)
		{
			$color = "red";
			if($dob == null)
			{
				$dob = 'Null';
			}
			else
			{
				$dob = $dob;
			}
			echo "<TR><TD>$aid<TD>$login_id<TD>$password<TD>$name<TD><font color='$color'>$dob<TD><font color='$color'>$join_date<TD>$gender<TD>$address\n";
		}
		else
		{
			$color ="blue";
			echo "<TR><TD>$aid<TD>$login_id<TD>$password<TD>$name<TD><font color='$color'>$dob<TD><font color='$color'>$join_date<TD>$gender<TD>$address\n";
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
 		//table error
		echo "<br>Something wrong with the SQL query.\n";
 	}
	//gets row amount
	$sql2="select count(*) from TECH3740.Admin";
	$result3 = $con->query($sql2);
	while($row = mysqli_fetch_array($result3)) {
		echo "There are ", $row['count(*)'], " Admin(s) in the database.";
		echo "<br />";
	}
	mysqli_close($con);
  ?>
