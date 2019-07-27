<?php
include("includes/config.php");
include("includes/header.php");
include("includes/functions.php");
$id=$_GET['id'];
if(isset($id))
{
$msg='';$msg2='';$msg1='';
if(isset($_POST['submit']))
{
    $password=$_POST['pass'];
    $cpassword=$_POST['cpass'];
    if(empty($password))
    {
        $msg='<div class="error">Please Enter new Password</div>';
    }
    else if(empty($cpassword))
    {
        $msg2='<div class="error">Please Re-enter new Password</div>';
    }
    else if($password != $cpassword)
    {
        $msg2='<div class="error">Password is not same</div>';
    }
    else if(strlen($password)<5)
    {
        $msg='<div class="error">Password must have atleast 5 characters</div>';
    }
    else
    {
        $pass=md5($password);
        mysqli_query($con,"UPDATE users SET password='$pass' WHERE id='$id'");
        $msg1="<div class='success'>Password changed successfully</div>";
    }
}
?>
<title>Change Password</title>
<style type="text/css">
#body-bg
    {
     background-color: #efefef;  
    }
.box
    {
    border: 1px solid gray;   
    padding:20px;
    border-radius:5px;
    box-shadow:3px 3px 3px gray;
    background-color:lightyellow;
    }
.error
    {
        color:red;
        font-weight: 5px;
        font-size: 10px;
    }
.success
    {
        color:green;
        font-weight: bold;
    }
</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:50px;background-color:#fff;margin-top:20px;margin-bottom:20px;width:1200px;height:700px;'>
<div class='box'>
<a href='profile.php'><button class='btn btn-outline-danger' style='float:right;'>Back</button></a>
<div class='col-md-4 offset-md-4'>
<h2 align='center'>Change Password</h2>
<form method='post'>
<div class='form-group'>
<label>New Password</label>
<input type='password' name='pass' class='form-control' placeholder='Enter new Password'>
<?php echo $msg; ?>
</div>
    
<div class='form-group'>
<label>Re-enter Password</label>
<input type='password' name='cpass' class='form-control' placeholder='Re-enter new Password'>
<?php echo $msg2; ?>
</div>
    <center><?php echo $msg1; ?></center>
    <center><button name='submit' class='btn btn-success'>Submit</button></center>
</form>
</div>
</div>
</div>
</body>
</html>
<?php
}
else
{
    header("location:login.php");
}
?>
