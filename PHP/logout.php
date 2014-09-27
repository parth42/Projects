<?php /*

Subject Code and Section = INT322A (Section A)
Student Name = PARTH PARIKH
Assignment 2
Date Submitted = 7th April 2014

Student Declaration

I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. 
No part of this assignment has been copied manually or electronically ,
from any other source (including web sites) or distributed to other students.

Name =    PARTH PARIKH 

Student ID = 011-195-138


*/ ?>



<?php
        session_start();	// session start
        include ('library.php');	//include common file library.php
if(isset($_SERVER['HTTPS']))
{
		
	
	if(isset($_SESSION['username']))	// if the username is valid then redirect on view.php
	{
		header("location:view.php");
		exit;
	}
	if (isset($_GET))	// check the variable for forgot password link 
        {
         	$temp = isset($_GET['temp'])?$_GET['temp']:0;
		
        }
        
        $user_name = "";
        $pass = "";
        $msg="";
	$loginErr="";
	$email="";
	
	
	
	if((isset($_POST['loginSubmit'])) || isset($_POST['email_text']))	//	check event for login and forgot pass. 

	{
		if(isset($_POST['email_text']))
		{
			$temp = 1;
		}

		if ($temp == 1)	// check the temp value
		    {

		        $email =htmlentities(trim($_POST['email_text']));// prevent an XSS or SQL injection attack.
		        $dbconnect = new db_link(); // Object for data base connection and connecting queries.
			$sql_query_new = 'SELECT * from users  WHERE username = "'.$email.'" ';
			$result = $dbconnect->query_result($sql_query_new);
			$numberofrows = mysqli_num_rows($result);
		
			if($numberofrows != 0)	// check the number of rows are empty or not.
			{
				$row=mysqli_fetch_assoc($result);
				$use_name=$row['username'];
		              $passhint=$row['passwordHint'];

		              if($user_name=$email)
		              {
				  $mail= mail("int322@localhost", "Forgot Password..!", "User Name : $user_name\nPassword Hint : $passhint", "From: Garg Library>");
		                  header('location: login.php');
					exit;
		              }
		        }
		    }
		else{
			
			$user_name = htmlentities(trim($_POST['username'])); // prevent an XSS or SQL injection attack.
			$pass = htmlentities(trim($_POST['password']));// prevent an XSS or SQL injection attack.
			$dbconnect = new db_link(); // Object for data base connection and connecting queries.

			$sql_query_new = 'SELECT * from users  WHERE username = "'.$user_name.'" ';	// sql queries.

			$result = $dbconnect->query_result($sql_query_new);
			$numberofrows = mysqli_num_rows($result);
			
			if($numberofrows != 0)
			{
				$row=mysqli_fetch_assoc($result);
				$log_pass=$row["password"];
	
	
				if(crypt($pass,$log_pass)==$log_pass)
				{
					$_SESSION['username'] = $user_name; // setting session for login user 
					$_SESSION['role']= $row['role']; // setting role for login user
					header("Location: view.php");
				}
				else
				{
					$loginErr = "Invalid Username or Password";	// showing errores if username is invalid
				}
		
			}
			else
			{
				$msg = "Invalid Username or Password";	// showing errors if password is not correct
			}	
		   }
	}
    ?> 


	<!DOCTYPE html>
	<body>
        <head>
       		<title>Login.php</title>
        </head>
        <body>
	<h2><p>Login</p></h2>
	
	<?php 
	if($temp==0)
	{
	?>
	
	<style type="text/css"> 
		td{font-weight:bold;}
	</style>
	<form action="login.php" method="POST">
	<table>
          
		<tr>
		    <td>User Name:</td>
		    <td><input name="username" type="text" value=""</td>
		</tr>
		  
		
		<tr>
		    <td>Password:</td>
		    <td><input name="password" type="password" value=""</td>
		   
		</tr>
		  <tr>
			<td style="color:#ff0000;"><?php echo $loginErr ;?></td>				
			<td style="color:#ff0000;"><?php echo $msg ;?></td>
		</tr>
		<tr>
              		<td><a href='login.php?temp=1'>Forgot Your Password?</a></td>
       		  </tr>	
		<tr>
			<td><input name="loginSubmit" type="submit" value="Login"></td>	<!-- if submit press then go to all condition and check step to step. -->
		</tr>
                  
	</table>  
        
	</form>	
	
	
	<?php 
			
	}

	else
	{
	?>
	

	<!-- applying the css for fonts and errors. -->	
	<style type="text/css"> 
		td{font-weight:bold;}
	</style>
	<form action="login.php" method="POST">
	<style type="text/css"> 
		td{font-weight:bold;}
	</style>
	
	<table>
          
		<tr>
		    <td>Email address:</td>
		    <td><input name="email_text" type="text" value=""</td>
		</tr>
		<tr>
			<td><td> <input type="submit" name="email" value="Email" /> </td></td>
		</tr>
	</table>
	</form>
<?php
				
	}
    	// call	 the footer functions in library page.
footer_ft();
?>

</body>
</html> 
<?php
}
  else{
	header("location: https://localhost/final_pages/login.php");
	}
	?>
