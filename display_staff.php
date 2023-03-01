<?php
include "dbconfig.php";
 if(!isset($_COOKIE["userid"]))
 die("<br>Please login first. \n")

 $connection = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
 or die("<br>Cannot connect to DB:$dbname on $dbhostname\n Error:
	  " . mysqli_connect_error());
$salary =1000; 
$sql="select * from dreamhome.Staff where salary> $salary and sex='F' ";
$result = mysqli_query($con, $sql); 
 
echo "<br>SQL: $sql\n";
 
if ($result) 
{
	if (mysqli_num_rows($result)>0) 
	{
		echo "<TABLE border=1>\n";
		echo "<TR><TH>Fname<TH>Sex<TH>Salary";
	    while($row = mysqli_fetch_array($result))
		{
	        $fname = $row['fName'];
	        $sex= $row['sex'];
	        $salary=$row['salary'];
	        if ($sex =="F")      
	        	$color="red";
	        else
	        	$color="blue";
	        echo "<TR><TD>$fname<TD><font color='$color'>$sex</font><TD>$salary\n";
	    }
	    echo "</TABLE>\n";
	}
	else
		echo "<br>No record found\n";
}
else 
{
  echo "<br>Something is wrong with SQL:" . mysqli_error($connection);	
}
mysqli_free_result($result);
mysqli_close($connection);
?>
