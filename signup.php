<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';

if(isset($_POST['submit']))
{
    $firstname= $_POST['fname'];
    $lastname= $_POST['lname'];
    $email= $_POST['mail'];
    $date=$_POST['dob'];
    $password= $_POST['pass'];
    $c_password= $_POST['cpass'];
    $image=$_FILES['image']['name'];
    $tmp_image=$_FILES['image']['tmp_name'];  
    $size_image=$_FILES['image']['size'];
    $checkbox=isset($_POST['check']);
//    echo $firstname."</br>".$lastname."</br>";
    
    if(strlen($firstname)<3)
    {
        $msg="<div class='error'>First name must contain atleast 3 characters</div>";
    }
     else if(strlen($lastname)<3)
    {
        $msg2="<div class='error'>Last name must contain atleast 3 characters</div>";
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
         $msg3="<div class='error'>Email valid Email</div>";
    }
    else if(email_exists($email,$con))
    {
        $msg3="<div class='error'>Email already exists</div>";
    }
    else if(empty($date))
    {
        $msg4="<div class='error'>Please, Enter your date of birth</div>";
    }else if(empty($password))
    {
        $msg5="<div class='error'>Please Enter your password</div>";
    }
     else if(strlen($password)<5)
    {
        $msg5="<div class='error'>Password must contain atleast 5 characters</div>";
    }
    else if($password !== $c_password)
    {
        $msg6="<div class='error'>Password is not same.</div>";
    }
     else if($image == '')
    {
        $msg7="<div class='error'>Please upload Your Profile Picture</div>";
    }
     else if($size_image>=1000000)
    {
     $msg7="<div class='error'>Please Upload image less than 1 MB</div>";   
    }
     else if($checkbox=='')
    {
        $msg8="<div class='error'>Please Agree our terms and conditions</div>";
    }
    else
    {
        $password=md5($password);
        $img_ext=explode(".",$image);
        $image_ext=$img_ext['1'];
        $image=rand(1,1000).rand(1,1000).time().".".$image_ext;
        if($image_ext=='jpg' || $image_ext=='JPG' || $image_ext=='png' || $image_ext=='PNG')
        {
        move_uploaded_file($tmp_image,"images/$image");
        mysqli_query($con,"INSERT INTO users(first_name,last_name,mail,dob,password,img)
        VALUES ('$firstname','$lastname','$email','$date','$password','$image')");
        $msg9="<div class='success'><center>You're successfully Registered</center></div>"; $firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
        }
        else
        {
            $msg7="<div class='error'>Please Upload a image File</div>";
        }
    }
}
?>
<title>Sign Up Form</title>
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
        <div class='jumbotron' style='margin-top:20px;padding-top:20px;margin-bottom:20px;padding-bottom:20px;'>
            <h3 align='center'>Sign up Form</h3></br>
        <?php echo $msg9; ?>
        <form method='post' enctype="multipart/form-data">
            
        <div class="form-group">
        <label>First Name : </label>
        <input type='text' name='fname' placeholder="First Name" class='form-control' value='<?php echo $firstname ?>'>
        <?php echo $msg;?>
        </div>
            
        <div class="form-group">
        <label>Last Name : </label>
        <input type='text' name='lname' placeholder="Last Name" class='form-control' value='<?php echo $lastname ?>'>
        <?php echo $msg2;?>
        </div>
            
        <div class="form-group">
        <label>Email : </label>
        <input type='email' name='mail' placeholder="Your E-mail" class='form-control' value='<?php echo $email ?>'>
        <?php echo $msg3;?>
        </div>
            
        <div class="form-group">
        <label>DOB : </label>
        <input type='date' name='dob' placeholder="Your DOB" class='form-control' value='<?php echo $date ?>'>
        <?php echo $msg4;?>
        </div>
            
        <div class="form-group">
        <label>Password : </label>
        <input type='password' name='pass' placeholder="Your Password" class='form-control' value='<?php echo $password ?>'>
        <?php echo $msg5;?>
        </div>
            
        <div class="form-group">
        <label>Confirm Password : </label>
        <input type='password' name='cpass' placeholder="Confirm Password" class='form-control' value='<?php echo $c_password ?>'>
        <?php echo $msg6;?>
        </div>
            
        <div class="form-group">
        <label>Profile Image : </label>
        <input type='file' name='image' value='<?php echo $image ?>' />
        <?php echo $msg7;?>
        </div></br>
            
        <div class="form-group">
        <input type='checkbox' name='check' />
            I Agree the terms and conditions
            <?php echo $msg8;?>
            </div></br>
            
        <center><input type='submit' value='submit' name='submit' class='btn btn-success' /></center></br>
         
    <center><a href='login.php'>Already Registered?</a></center>
        </form>
        </div>
    </div>
</div>
</body>
</html>