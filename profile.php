<?php
include("includes/config.php");
include("includes/header.php");
session_start();
include("includes/functions.php");
if(logged_in())
{
    header("location:login.php");
}
else
{
if(isset($_COOKIE['name']))
{
$email=$_COOKIE['name'];
$result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users where mail='$email'");
$retrive=mysqli_fetch_array($result);
$id=$retrive['id']; 
$firstname=$retrive['first_name'];
$lastname=$retrive['last_name'];
$image=$retrive['img'];
?>
<title>Profile Page</title>
<style type="text/css">
#body-bg
    {
     background-color: #efefef;  
    }
</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:10px;background-color:#fff;margin-top:20px;margin-bottom:20px;width:1200px;height:700px;'>
<h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname)?></h2>
    <a href='logout.php'> <button class='btn btn-outline-success' style='float:right;'>Logout</button></a>

<a href='change-password.php?id=<?php echo $id;?>'> <button class='btn btn-outline-primary' style='float:left;'>Change Password</button></a>

    </br></br><center><img src='images/<?php echo $image?>' class='img-fluid img-thumbnail' style='width:350px;'/></center> 
</div>
</body>
</html> 
<?php
}
    
else
    {
$email=$_SESSION['mail'];
$result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users where mail='$email'");
$retrive=mysqli_fetch_array($result);
$id=$retrive['id'];
$firstname=$retrive['first_name'];
$lastname=$retrive['last_name'];
$image=$retrive['img'];
?>
<title>Profile Page</title>
<style type="text/css">
#body-bg
    {
     background-color: #efefef;  
    }
</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:10px;background-color:#fff;margin-top:20px;margin-bottom:20px;width:1200px;height:700px;'>
<h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname)?></h2>
    
  <a href='logout.php'> <button class='btn btn-outline-success' style='float:right;'>Logout</button></a>
<a href='change-password.php?id=<?php echo $id;?>'> <button class='btn btn-outline-primary' style='float:left;'>Change Password</button></a>

    </br></br><center><img src='images/<?php echo $image?>' class='img-fluid img-thumbnail' style='width:350px;'/></center> 
    
</div>
</body>
</html> 
<?php
} }
?>    