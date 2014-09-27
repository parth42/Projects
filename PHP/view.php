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
	
	
	include ('library.php');	// include library.php page for common css and database code 
  	if(!isset($_SESSION['username']))
	{
		header("location:login.php");
	}
	else
	{		
	    	$boxValue="";
		$sortValue="";
		$valid=true;	// set initial condition for valid data.
	    
		if(!isset($_COOKIE['index']))
		{
			$_COOKIE['index']="1";
		}
		$sortValue = isset($_GET['sort'])?$_GET['sort']:$_COOKIE['index'];
		
		setcookie("index",$sortValue,time()+3600*24*30);

		if(!isset($_SESSION['textSearch']))
		{
			$_SESSION['textSearch']="";
		}
		if($_POST)
		{
			$_SESSION['textSearch'] = htmlentities($_POST['searchBox']);
			$boxValue = $_SESSION['textSearch'];
		}
		else
		{
			if(isset($_GET['sort']))
			{
				$boxValue = $_SESSION['textSearch'];	
			}
			else
			{
				$boxValue="";
			}
		}
			
		    
		$dbconnect = new db_link(); // Creating object for database connections and running queries
		$boxValue = mysqli_real_escape_string($dbconnect->query_active(), $boxValue);
 		$boxValue = trim($boxValue);
		$sql_query_new = "select * from inventory where description like '%$boxValue%' ORDER BY $sortValue";
		$_SESSION['textSearch'] = $boxValue;
		$result = $dbconnect->query_result($sql_query_new);
		$numberofrows = mysqli_num_rows($result);
	
 
?>
  
<html>
    <head>
	<title>View.php Page.</title>
	<style type="text/css">

		
		td
		{
			text-align:center;
			padding-top:5px;
			padding-bottom:5px;
			height:50px;
		}
	</style>
	</head>
	<body>
	<h2> <?php header_page(); ?></h2>
	
	<?php 	
		menu(); 
	?>
	
        <table class="view" border="1">
        	<tr>
		    <th><a href="?sort=1">ID</th>
			<th><a href="?sort=2">Iteam Name</th>
			<th><a href="?sort=3">Description</th>
			<th><a href="?sort=4">Supplier</th>
			<th><a href="?sort=5">Cost</th>
			<th><a href="?sort=6">Price</th>
			<th><a href="?sort=7">Number on Hand</th>
			<th><a href="?sort=8">Record Level</th>
			<th><a href="?sort=9">On back Order</th>
			<th><a href="?sort=10">Delete/Restore</th>
		    <?php
				// Condition true till condition false. and print all the data in form.
			if($numberofrows != 0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
		    ?>
				<tr>
			    	
					<td><a href="add.php?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
					<td><?php print $row['itemName']; ?></td>
					<td><?php print $row['description']; ?></td>
					<td><?php print $row['supplierCode']; ?></td>
					<td><?php print $row['cost']; ?></td>
					<td><?php print $row['price']; ?></td>
					<td><?php print $row['onHand']; ?></td>
					<td><?php print $row['reorderPoint']; ?></td>
					<td><?php print $row['backOrder']; ?></td>
					      <!-- check the value and pass that value for deleted variable for 'On Back Order' -->
			     		<?php if($row['deleted'] == 'n'){ ?> <!-- If deleted is unchecked then show 'DELETE' Link  -->
				     	<td> <a href='delete.php?did=<?php echo $row['id'] ?>&backorder=<?php echo $row['deleted'] ?>'>Restore</a> </td>
				     	<?php }else{ ?> <!-- If deleted is checked then show 'RESTORE' Link  -->
				      	<td> <a href='delete.php?did=<?php echo $row['id'] ?>&backorder=<?php echo $row['deleted'] ?>'>Delete</a> </td>
				     	<?php } ?>
				</tr>
		     <?php
		       		 }
			}
			else
			{
			?>
				<p><?php echo "There is no data which you are searching"; ?></p>			
			<?php	
			}
		     ?>
        </table>
        <?php 
		footer_ft(); // call the footer functions in library page
}
	 ?>		
	</body>
</html>

