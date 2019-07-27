<?php
include("includes/header.php");
include("includes/config.php");
session_start();
$name=$_SESSION['name'];
if(isset($name))
{
    $result=mysqli_query($con,"SELECT id,first_name,last_name,mail,dob,img FROM users");
    $row=mysqli_num_rows($result);
  echo "<div class='container'>";
   echo "<h3></br>Welcome to Admin Panel</h3>";
   echo "Total registered users : ".$row;
    echo "<a href='admin-logout.php'><button class='btn btn-primary' style='float:right;'>Logout</button></a>";
    echo "</br></br><table class='table table-striped table-bordered table-responsive'>";
    echo "<tr align='center'>";
    echo "<th>S.no</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>email</th>";
    echo "<th>dob</th>";
    echo "<th>Profile Image</th>";
    echo "<th>Delete User</th>";
    echo "<th>Edit User Details</th>";
    echo "</tr>";
    $i=0;
    while($retrive=mysqli_fetch_array($result))
    {
        $id = $retrive['id'];
        $fname = $retrive['first_name'];
        $lname = $retrive['last_name'];
        $mail = $retrive['mail'];
        $date = $retrive['dob'];
        $pro = $retrive['img'];
        echo "<tr align='center'>";
        echo "<th>".$i=$i+1;"</th>";
        echo "<th>$fname</th>";
        echo "<th>$lname</th>";
        echo "<th>$mail</th>";
        echo "<th>$date</th>";
        echo "<th><img src='images/$pro' height=70px width=70px></th>";
        echo "<th><a href='delete-admin.php?del=$id'><button class='btn btn-danger'>Delete</button></a></th>";
          echo "<th><a href='update-admin.php?user=$id'><button class='btn btn-success'>Update</button></a></th>";
        echo "</tr>";
    }
    echo "</table";
}
else
{
    header("location:admin.php");
}
?>  