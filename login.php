<?php

include('connection.php');
 
 @$email=$_POST['email'];
 
 @$password=$_POST['password'];
 
 $query = "select * from trip_user where u_email='$email' and u_password='$password'";
			  
			  if(mysqli_query($conn, $query))
			  {
				  header("Location: ./404.php");
				  die();	
			  }
			  else
			  {
				  header("Location: ./signin.php");
				  die();	
			  
				}

?>