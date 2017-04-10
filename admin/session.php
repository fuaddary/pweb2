<?php
   include('../includes/config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   //$ses_sql = mysqli_query($db,"select username from admin where username = '".$user_check."' ");
   $ses_sql = $db->query("select username from admin where username = '".$user_check."' ")->fetch();
   
   $login_session = $ses_sql['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>