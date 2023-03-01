<HTML> 
    <?php
    include "dbconfig.php";
    $connection = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $dbhostname\n");
    $sql="SELECT * from TECH3740.EMPLOYEE";
$result = mysqli_query($connection, $sql); 
 
echo "<br>SQL: $sql\n";
//$result = mysqli_query($con,$query);
//Example: Display Employee, part II
if($result) 
{
  if (mysqli_num_rows($result)>0) 
  {
    echo "The following employee are in the database.";
    echo "<TABLE border=1>\n";
    echo "<TR><TH>ID<TH>Login<TH>Password<TH>Name<TH>Role<TH>Salary<TH>Gender\n";
    while($row = mysqli_fetch_array($result))
    {
      $id = $row['employee_id'];
      $login_id = $row['login'];
      $password = $row['password'];
      $name = $row['name'];
      $role = $row['role'];
      $salary = $row['salary'];
      $gender = $row['gender'];
      if($salary == null)
      {
        $salary='Null';
        echo "<TR><TD>$id<TD>$login_id<TD>$password<TD>$name<TD>$role<TD>$salary<TD>$gender\n";
      }
      else
      {
        echo "<TR><TD>$id<TD>$login_id<TD>$password<TD>$name<TD>$role<TD>$salary<TD>$gender\n";
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
  mysqli_free_result($result);
  mysqli_close($connection);
  ?>

