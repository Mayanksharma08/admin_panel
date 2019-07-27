<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

session_start();

$msg='';$msg2='';$email='';
if(isset($_POST['submit']))
{
    $email=$_POST['mail'];
    $password=$_POST['pass'];
    $checkbox=isset($_POST['check']);
    if(empty($email))
    {
        $msg='<div class="error">Please Enter your Email</div>';
    }
    
    else if(empty($password))
    {
        $msg2='<div class="error">Please Enter your Password</div>';
    }
    else if(email_exists($email,$con))
    {
    $pass=mysqli_query($con,"SELECT password FROM users WHERE mail='$email'");
    $pass_w=mysqli_fetch_array($pass);
    $dpass=$pass_w['password'];
    $password=md5($password);
    if($password!==$dpass)
    {
        $msg2="<div class='error'>Password is wrong</div>";
    }
      else
      {
          $_SESSION['mail']=$email;
          if($checkbox=='on')
          {
              setcookie('name',$email,time()+3000);
              
          }
          header("location:profile.php");
      }
    }
    else
    {
         $msg='<div class="error">Email does not exists</div>';
    }
    
}
?>

<title>Login Form</title>
<style type="text/css">
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
</style>
</head>
<body id=body-bg>
<div class='container'>
    <div class='login-form col-md-4 offset-md-4'>
        <div class='jumbotron' style='margin-top:100px;padding-top:20px;padding-bottom:10px;'>
            <h2 align='center'>Login Form</h2></br>
        <form method='post'>
        <div class='form-group'>
            <label>Email : </label>
            <input type='email' name="mail" class='form-control' value='<?php echo $email; ?>'/>
            <?php echo $msg; ?>
        </div>  
            
        <div class='form-group'>
            <label>Password : </label>
            <input type='password' name="pass" class='form-control' />
            <?php echo $msg2; ?>
        </div> 
            
        <div class='form-group'>
            <input type='checkbox' name='check' />
            &nbsp; Keep me Logged in
            </div> </br>
         
        <div class='form-group'>
        <center><input type="submit" name='submit' value='Login' class='btn btn-success' /></center>
        </div>
        
    <center><a href='forgot.php'>Forgot Password</a></center>
            
        </form>
        </div>
    </div>
</body>
</html>