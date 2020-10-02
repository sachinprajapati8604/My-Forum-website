<?php 
$showEroor="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['cPassword'];
    

//check weather this gmail exist

$existSql="SELECT * FROM `users` WHERE user_email='$user_email' ";
$result=mysqli_query($conn,$existSql);
$numRows=mysqli_num_rows($result);
if($numRows>0){
    $showEroor="Email  already in use";

}
        else{
            if($pass==$cpass){
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$pass', current_timestamp());";
                $result=mysqli_query($conn,$sql);
                if($result){
                    $showAlert=true;
                    header("Location: /MyForum/index.php?signupsuccess=true");
                    exit();
                }
                
            }
            else{
                $showEroor="Password do not match";
                
            }
        }
        header("Location: /MyForum/index.php?signupsuccess=false&error=$showEroor");

}
?>