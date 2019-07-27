<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';

$firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
$id=$_GET['user'];

if(isset($id)){
    $result=mysqli_query($con,"SELECT first_name,last_name,dob,mail FROM users WHERE id='$id'");
    $retrive=mysqli_fetch_array($result);
    $name=$retrive['first_name'];
    $last=$retrive['last_name'];
    $dob=$retrive['dob'];
    $mail=$retrive['mail'];
}

if(isset($_POST['submit']))
{
        
    $firstname= $_POST['fname'];
    $lastname= $_POST['lname'];
    $email= $_POST['mail2'];
    $date=$_POST['dob2'];
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
    else if(empty($date))
    {
        $msg4="<div class='error'>Please, Enter your date of birth</div>";
    }
    else
    {
    
        mysqli_query($con,"UPDATE users SET first_name='$firstname',last_name='$lastname',mail='$email',dob='$date' WHERE id=$id;");
        header("location:admin-panel.php");    $firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
        }

    }
?>
<title>Update User</title>
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
            <h3 align='center'>Update User Details</h3></br>
        <?php echo $msg9; ?>
        <form method='post'>
            
        <div class="form-group">
        <label>First Name : </label>
        <input type='text' name='fname' placeholder="First Name" class='form-control' value='<?php echo $name; ?>'>
        <?php echo $msg;?>
        </div>
            
        <div class="form-group">
        <label>Last Name : </label>
        <input type='text' name='lname' placeholder="Last Name" class='form-control' value='<?php echo $last; ?>'>
        <?php echo $msg2;?>
        </div>
            
        <div class="form-group">
        <label>Email : </label>
        <input type='email' name='mail2' placeholder="Your E-mail" class='form-control' value='<?php echo $mail; ?>'>
        <?php echo $msg3;?>
        </div>
            
        <div class="form-group">
        <label>DOB : </label>
        <input type='date' name='dob2' placeholder="Your DOB" class='form-control' value='<?php echo $dob; ?>'>
        <?php echo $msg4;?>
        </div>
            
        <center><input type='submit' value='Update' name='submit' class='btn btn-success' /></center></br>
        
        </form>
        </div>
    </div>
</div>
</body>
</html>