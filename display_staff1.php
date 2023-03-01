<?php
//Jacob Sedar
include "dbconfig1.php";

//if(!isset($_COOKIE["userid"]))
//die("<br>Please login first");
 
 $con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $dbhostname. Error:
	  " . mysqli_connect_error());
$sql="select * from Staff";
$result = mysqli_query($con, $sql); 
 
echo "<br>SQL: $sql\n";
 
if ($result) 
{
	if (mysqli_num_rows($result)>0) 
	{
		echo "The following admins are in the database.";
		echo "<TABLE border=1>\n";
		echo "<TR><TH>Staff Number<TH>First Name<TH>Last Name<TH>Position<TH>DOB<TH>Salary<TH>Branch Number\n";
	    while($row = mysqli_fetch_array($result))
		{
			$staffNo = $row['staffNo'];
	        $fname = $row['fName'];
			$lname = $row['lName'];
	        $position = $row['position'];
			$sex= $row['sex'];
			$dob = $row['DOB'];
	        $salary = $row['salary'];
			$branchNo = $row['branchNo'];
	        echo "<TR><TD>$staffNo<TD>$fname<TD>$lname<TD>$position<TD>$sex<TD>$dob<TD>$salary<TD>$branchNo\n";
	    }
	    echo "</TABLE>\n";
	}
	else
		echo "<br>No record found\n";
}
else 
{
  echo "<br>Something is wrong with SQL:" . mysqli_error($con);	
}
mysqli_free_result($result);
mysqli_close($con);
?>
