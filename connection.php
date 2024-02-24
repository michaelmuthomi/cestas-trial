<?php
require_once('logic/dbconnection.php');
session_start();
 if(isset($_POST['login']))
    {
        //fetch form data
        $username=$_POST['username'];
        $password=$_POST['password'];
        $newpass=md5($password);

        $sql= mysqli_query($conn,"SELECT*FROM account WHERE 
        username='$username' and
        password='newpass'");
        $fetch=mysqli_fetch_array($sql);

        if($fetch>0)
        {
            //$_SESSION['login']=username;
            header('location:index.php');
         }
        else{
         echo"error";
         }
    }
?>