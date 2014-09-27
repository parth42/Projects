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

	session_start();
	include ('library.php');
	
	if(!isset($_SESSION['username']))
	{
		header("location:login.php");
		exit;
	}
	else
	{

		if(isset ($_GET['did']))	// get the delete id for on-hand-record and deleted and change through passing value.
		{
			$did = $_GET['did'];	// get deleted id
			$deleteId=$_GET['backorder'];	// get deleted id from backOrder.
			$OnBackOrder=$_GET['backorder'];	// get on back order id from backOrder. 
		
			if($deleteId== 'y')	// check the coming value for the deleted and check it according to condition.
			{
				$new='n';
			}
			else
			{
				$new='y';
			}
			// UPDATE query for deleted link. 
			// the $new should be set to 'y' in the DB, but the item should NOT be physically deleted
			$dbconnect = new db_link();
			$sql_query_new='update inventory set deleted ="'. $new . '" where id=" ' .$did. ' "';
			$result = $dbconnect->query_result($sql_query_new);
			
			header ("location:view.php");
			exit;	// redirect view.php page.
		}

			$dbconnect = new db_link();
			// display all the data in table from database.
			$sql_query_select = "SELECT * from inventory";
			$result = $dbconnect->query_result($sql_query_select);
			//Run our sql query			
	}
?>


