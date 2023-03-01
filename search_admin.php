<?php
include ('dbconfig.php');
/*if(!isset($_COOKIE["userid"]))
 die("<br>Please login first. \n")*/
$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
or die("<br>Cannot connect to DB:$dbname on $dbhostname. Error:
" . mysqli_connect_error());
$user_input = $_GET['keyword'];

//sql search for all
if($user_input == '*')
{
$sql = "select * from TECH3740.Admin";
$result = mysqli_query($con, $sql); 

echo "<br>SQL: $sql\n";
//all admins searched
if($result) 
{
	if (mysqli_num_rows($result)>0) 
	{
		echo "The following admins are in the database.";
		echo "<TABLE border=1>\n";
		echo "<TR><TH>Aid<TH>Login<TH>Password<TH>Name<TH>DOB<TH>Join Date<TH>Gender<TH>Address\n";
	while($row = mysqli_fetch_array($result))
	{
		//get information on admins and prints in a table
		$aid = $row['aid'];
		$login = $row['login'];
		$password = $row['password'];
		$name = $row['name'];
		$dob = $row['dob'];
		$join_date = $row['join_date'];
		$gender = $row['gender'];
		$address = $row['Address'];
		//checks the join versus birth or null
		if($dob < $join_date || $dob == null)
		{
			//changes color
			$color = "red";
			//if null put it as string
			if($dob == null)
			{
				$dob = 'Null';
			}
			else
			{
				$dob = $dob;
			}
			//prints table
			echo "<TR><TD>$aid<TD>$login_id<TD>$password<TD>$name<TD><font color='$color'>$dob<TD><font color='$color'>$join_date<TD>$gender<TD>$address\n";
		}
		else
		{
			//blue if otherwise
			$color ="blue";
			//prints table
			echo "<TR><TD>$aid<TD>$login_id<TD>$password<TD>$name<TD><font color='$color'>$dob<TD><font color='$color'>$join_date<TD>$gender<TD>$address\n";
		}
	}
		echo "</TABLE>\n";
		
	}
	else 
	{
		//no records
		echo "<br>No records in the database.\n";
		mysqli_free_result($result);
 	} 
	}
 	else 
	{
		//query error
 		echo "<br>Something wrong with the SQL query.\n";
 	}
	//number of admins
	 $sql2="select count(*) from TECH3740.Admin";
	 $result3 = $con->query($sql2);
	 while($row = mysqli_fetch_array($result3)) {
		 echo "There are ", $row['count(*)'], " Admin(s) in the database.";
		 echo "<br />";
	 }
}
	else
{
	//character search
	$sql = "select * from TECH3740.Admin where login like '%$user_input%' or password like '%$user_input%' or name like '%$user_input%' or Address like '%$user_input%'";
	$result = mysqli_query($con, $sql); 
	
	//courses searched by parameter
	echo "<br>";
	//all courses searched
	if($result) {
		if (mysqli_num_rows($result)>0) 
		{
			echo "<TABLE border=1>\n";
			echo "<TR><TH>Aid<TH>Login<TH>Password<TH>Name<TH>DOB<TH>Join Date<TH>Gender<TH>Address\n";
			while($row = mysqli_fetch_array($result))
		{
			//admin info
			$aid = $row['aid'];
		$login = $row['login'];
		$password = $row['password'];
		$name = $row['name'];
		$dob = $row['dob'];
		$join_date = $row['join_date'];
		$gender = $row['gender'];
		$address = $row['Address'];
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
			echo "<TR><TD>$aid<TD>$login<TD>$password<TD>$name<TD><font color='$color'>$dob<TD><font color='$color'>$join_date<TD>$gender<TD>$address\n";
		}
		else
		{
			$color ="blue";
			echo "<TR><TD>$aid<TD>$login<TD>$password<TD>$name<TD><font color='$color'>$dob<TD><font color='$color'>$join_date<TD>$gender<TD>$address\n";
		}
	}
		echo "</TABLE>\n";
			
		}
		else 
		{
			echo "<br>No records in the database.\n";
			mysqli_free_result($result);
		 } 
		}
		 else 
		{
			 echo "<br>Something wrong with the SQL query.\n";
		 }
		
		 $sql2="select count(*) from TECH3740.Admin where login like '%$user_input%' or password like '%$user_input%' or name like '%$user_input%' or Address like '%$user_input%'";
	$result3 = $con->query($sql2);
	while($row = mysqli_fetch_array($result3)) {
		echo "There are ", $row['count(*)'], " Admin(s) in the database that match '%$user_input%'.";
		echo "<br />";
	}
	}

	mysqli_close($con);
  ?>
