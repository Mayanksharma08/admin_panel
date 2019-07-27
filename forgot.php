<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
$msg='';$msg1='';$msg2='';$msg3='';$msg4='';$email='';$date='';$password='';$cpassword='';
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $date=$_POST['dob'];
    $password=$_POST['pass'];
    $cpassword=$_POST['cpass'];
    
    if(empty($email))
    {
    $msg="<div class='error'>Please Enter your E-mail</div>";
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $msg="<div class='error'>Please Enter Valid Email</div>";
    }
    else if(empty($date))
    {
        $msg2="<div class='error'>Please Enter your Date of Birth</div>";
    }
    else if(empty($password))
    {
        $msg3="<div class='error'>Please Enter your password</div>";
    }
    else if(empty($cpassword))
    {
        $msg4="<div class='error'>Please Re-enter your password</div>";
    }
    else if(strlen($password)<5)
    {
        $msg3="<div class='error'>Password must contain atleast 5 characters</div>";
    }
    else if($password != $cpassword)
    {
        $msg4="<div class='error'>Password doesn't match</div>";
    }
    else if(email_exists($email,$con))
    {
        $result=mysqli_query($con,"SELECT dob FROM users WHERE mail='$email'");
        $retrive=mysqli_fetch_Array($result);
        $DOB=$retrive['dob'];
        if($date==$DOB)
        {
            $pass=md5($password);
            mysqli_query($con,"UPDATE users set password='$pass'");
            $msg1="<div class='success'>Password changed successfully</div>";
        }
        else
        {
            $msg2="<div class='error'>Incorrect date of birth</div>";
        }
    }
    else
    {
        $msg="<div class='error'>Email doesn't exists</div>";
    }
}
?>
<title>Forgot Password</title>
</head>

<style type='text/css'>
#body-bg
    {
        background: url("images/bg.jpg") center no-repeat fixed;
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

<body id='body-bg'>
<div class='container'>
    <div class='login-form col-md-6 offset-md-3'>
        <div class='jumbotron' style='margin-top:20px;padding-top:20px;margin-bottom:20px;padding-bottom:30px;'>
            <h3 align='center'>Forgot Password</h3></br>
        <form method='post' >
        <div class='form-group'>
        <label>Email : </label> 
        <input type='email' name='email' value="<?php echo $email;?>" class='form-control' placeholder='Enter Your Email' >
        <?php echo $msg; ?>
        </div>
            
        <div class='form-group'>
        <label>Date of Birth : </label> 
        <input type='date' name='dob' value="<?php echo $date;?>" class='form-control'>
        <?php echo $msg2; ?>
        </div>
        
        <div class='form-group'>
        <label>Password : </label> 
        <input type='password' name='pass' value="<?php echo $password;?>" class='form-control' placeholder='Enter New Password'>
        <?php echo $msg3;?>
        </div>
            
        <div class='form-group'>
        <label>Re-enter Password : </label> 
        <input type='password' name='cpass' value="<?php echo $cpassword; ?>" class='form-control' placeholder='Re-enter New Password' >
        <?php echo $msg4;?>
        </div>
            <center><button class='btn btn-success' name='submit'>Submit</button></center></br> 
        <center><a href='login.php'>Go back to login</a></center>
            <center><?php echo $msg1; ?></center>
        </form>
        </div>
    </div>
</div>
</body>
</html>