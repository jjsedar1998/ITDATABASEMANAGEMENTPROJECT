<?php
/*
    Jacob Sedar
    TECH3740-01
    Project
    login.php if correct login information from index.html
*/
//connects config file for database access
include ('dbconfig.php');
//database connection
$con = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) 
or die("<br>Cannot connect to DB:$dbname on $dbhostname. Error:
" . mysqli_connect_error());
//pulls user and password from index
$login=mysqli_real_escape_string($con,$_POST["username"]);
$bpassword=mysqli_real_escape_string($con,$_POST["password"]);

//get user info
$query = "select * from TECH3740.Admin where
login = '$login' and password ='$bpassword'";
//get age
$sql = "select *, timestampdiff(year, dob, curdate()) as age from TECH3740.Admin where login = '$login' and password = '$bpassword'";
//query for all info
$result = mysqli_query($con, $query);
$result1 = mysqli_query($con, $sql);
//query for age
$row2 = mysqli_fetch_array($result1);
$row = mysqli_fetch_array($result);
//password check
if ($row['password']==$bpassword)
{ 
    echo "<br>Login successful!\n";
    //set cookie
    setcookie("userid", $row['aid'], time() + 3600, "/");
    //get ip info
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    { 
        $ip = $_SERVER['HTTP_CLIENT_IP']; 
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    { 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    }
    else 
    { 
        $ip = $_SERVER['REMOTE_ADDR']; 
    }
    $IPv4= explode(".",$ip);
    echo "<br>Your IP: $ip\n";
    $IPv4= explode(".",$ip);
    if ($IPv4[0] == "10")
    { 
        echo "<br>You are from Kean University.\n" ;
    }
    else 
    { 
        echo "<br>You are NOT from Kean University.\n" ;
    }  
    //get user info
    $aid = $row['aid'];
    $login = $row['login'];
    $password = $row['password'];
    $name = $row['name'];
    $dob = $row['dob'];
    $join_date = $row['join_date'];
    $gender = $row['gender'];
    $address = $row['Address'];
    $age = $row2['age'];
    echo "<br> Welcome user: $name";
    echo "<br> Date of birth: $dob";
    echo "<br> Address: $address";
    echo "<br> Gender: $gender";
    echo "<br> Join Date: $join_date";
    echo "<br> Age: $age";
    //logout
    echo "<br><a href='logout.php'> Logout</a>";
    //add course
    echo "<br><a href='add_course.php'> Add Course</a>";
    //search course
    echo"<form action='search_course.php' method='GET'
    Search course (id or name): <br>
    <input type='text' name='searching' required='required'> 
    <input type='submit' value='search'>
    </form>";
}
//wrong password
elseif($login = $row['login'] && $bpassword != $row['password'])
{
    echo "Login failed (user exists, but wrong password!";
}
//wrong everything
else
{
    echo "Login failed!";
}
?> 