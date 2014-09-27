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


<?php		// Declare all the variables for error messages.
	session_start();
	
	include ('library.php');	// include library.php page for common css and database code 
  	if(!isset($_SESSION['username']))
	{
		header("location:login.php");
		exit;
	}
	else
		
		$id = "";
		$valid=true;
		$iteamNameErrErr = "";
		$descriptionErr = "";
		$supplierCodeErr = "";
		$costErr = "";
		$priceErr = "";
		$numberOn_handErr = "";
		$recordPointErr = "";
		$backOrderErr = "";
		$itemName = "";
		$description = "";
		$supplierCode = "";
		$cost = "";
		$price = "";
		$onHand = "";
		$reorderPoint = "";
		$backOrder = "";
		$deleted = "";
		    
		if(isset($_POST['submit']))		// If submit successfully then check all the text field and check conditions
		{             
		      
			if ($_POST['itemName'] == "")	// check if the field is blank.
			{
		    		$iteamNameErrErr = "Error - Enter the Iteam Name. It shouldn't be blank";
		    		$valid = false;
			}
			else	// check regular expression for item name.
			{
		    		$pc=($_POST['itemName']);
		    		if(!preg_match("/^\s*[;:,\-,'0-9a-zA-Z\s]*\s*$/",$pc))
		    		{
		        		$iteamNameErrErr = "Iteam name is not valid";    
		        		$valid = false;
		    		}
			}	 
		  
			if ($_POST['description'] == "")	// check empty field for description
			{
			    	$descriptionErr = "Error - Enter the Description. It shouldn't be blank";
			    	$valid= false;      
			}
			else	// check regular expression for Description.
			{
			    	$pc=($_POST['description']);
			    	if(!preg_match("/^\s*[\.,\-,'0-9a-zA-Z\s]*\s*$/",$pc))
			    	{
					$descriptionErr = "Description is not valid";    
					$valid = false;
			    	}
			} 
	
			if ($_POST['supplierCode'] == "") 
			{
				$supplierCodeErr = "Error - Enter the Suppliers Code. It shouldn't be blank";
		    		$valid = false;
			}
			else	// check regular expression for Supplier.
			{
		    		$pc=($_POST['supplierCode']);
			        if(!preg_match("/^\s*[\-0-9a-zA-Z\s]*\s*$/",$pc))
		    		{
		        		$supplierCodeErr = "Supplier Code is not valid";    
				        $valid = false;
		    		}
			} 
	
			if ($_POST['cost'] == "") 
			{
		    		$costErr = "Error - Enter the Cost. It shouldn't be blank";
		    		$valid= false;      
			}
			else	// check regular expression for cost.
			{
		    		$pc=($_POST['cost']);
		    		if(!preg_match("/^\s*[0-9]*\.[0-9]{2}\s*$/",$pc))
		    		{
		        		$costErr = "Cost is not valid";    
		        		$valid = false;
		    		}
			} 

	       		if ($_POST['price'] == "") 
			{
		    		$priceErr = "Error - Enter the Price. It shouldn't be blank";
		    		$valid= false;      
			}
			else// check regular expression for Price.
			{
		    		$pc=($_POST['price']);
		    		if(!preg_match("/^\s*[0-9]*\.[0-9]{2}\s*$/",$pc))
		    		{
		        		$priceErr = "Price is not valid";    
		        		$valid = false;
		    		}
			} 

	       		if ($_POST['onHand'] == "") 
			{
		    		$numberOn_handErr = "Error - Enter the hand copies. It shouldn't be blank";
		    		$valid= false;      
			}
			else// check regular expression for On hand copies.
			{
	       		        $pc=($_POST['onHand']);
			        if(!preg_match("/^\s*[0-9]*\s*$/",$pc))
		    		{
				        $numberOn_handErr = "On Hand is not valid";    
		        		$valid = false;
		    		}
			}	 	
	
			if ($_POST['reorderPoint'] == "") 
			{
		    		$recordPointErr = "Error - Please enter right record point  for the iteam"; 
		    		$valid= false;      
			}
			else	// check regular expression for Recorder Point
			{
		    		$pc=($_POST['reorderPoint']);
		    		if(!preg_match("/^\s*[0-9]*\s*$/",$pc))
		    		{
		        		$recordPointErr="Record Point is not valid";    
		        		$valid = false;
		    		}
			} 

			if(isset($_POST['backOrder']))  // check for check-box it is checked or not. And no validation required for that.
			{
			    	if ($_POST['backOrder'] == "")
			    	{
					$backOrderErr = "Error - Please enter right back order for the iteam"; 
					$valid= false;      
			    	}
			}
        	}	

		if(isset($_POST['submit']) && $valid)	// If all the fields are valid then form submitted and redirect on view.php
	    	{ 	
			$itemName = htmlentities(trim($_POST['itemName']));
			$description = htmlentities(trim($_POST['description']));
			$supplierCode = htmlentities(trim($_POST['supplierCode']));
			$cost = htmlentities(trim($_POST['cost']));
			$price = htmlentities(trim($_POST['price']));
			$onHand = htmlentities(trim($_POST['onHand']));
			$reorderPoint = htmlentities(trim($_POST['reorderPoint']));
			// set the value for check-box 'Y' if checked or 'N' if unchecked.
			if((htmlentities(trim($_POST['backOrder']))) && (htmlentities(trim($_POST['backOrder'])))!= NULL)
			{
				$backOrder = 'y';
				$deleted = 'y';
			}
			else
			{
				$backOrder = 'n';
				$deleted = 'n';
			}

			$dbconnect = new db_link();
			$itemName = mysqli_real_escape_string($dbconnect->query_active(), $itemName);
			$description = mysqli_real_escape_string($dbconnect->query_active(), $description);
			$supplierCode = mysqli_real_escape_string($dbconnect->query_active(), $supplierCode);
			$cost = mysqli_real_escape_string($dbconnect->query_active(), $cost);
			$price = mysqli_real_escape_string($dbconnect->query_active(), $price);
			$onHand = mysqli_real_escape_string($dbconnect->query_active(), $onHand);
			$reorderPoint = mysqli_real_escape_string($dbconnect->query_active(), $reorderPoint);
			$backOrder = mysqli_real_escape_string($dbconnect->query_active(), $backOrder);
			
			if(isset($_POST['id']))	
			{
				$sql_query_new = 'UPDATE inventory SET itemName = "' .$itemName. '", description="' . $description . '", supplierCode="' . $supplierCode . '",cost="' . $cost . '", price="' . $price . '", onHand="' . $onHand . '", reorderPoint="' . $reorderPoint . '", backOrder="' . $backOrder . '", deleted="' . $backOrder . '" WHERE id = "'.$_POST[id].'" ';
			}
			else
			{
				$sql_query_new = 'INSERT INTO inventory set itemName="' . $itemName . '", description="' . $description . '", supplierCode="' . $supplierCode . '",cost="' . $cost . '", price="' . $price . '", onHand="' . $onHand . '", reorderPoint="' . $reorderPoint . '", backOrder="' . $backOrder . '", deleted="' . $backOrder . '"';
			}
			$result = $dbconnect->query_result($sql_query_new);
	       		header("location:view.php");	// redirect form to view.php and display all valid data.       
			exit;
	    }
      
		else 
		{	// if any error in field then display the errors right beside the field and redirect the same page. 
?>
<!DOCTYPE html>
	<head>
		<title>
			add.php page
		</title>
	</head>  
	<body>   
	<h2>	<?php header_page(); ?>	</h2>
		<?php 	
			menu(); 
		?>
	 
		<form action="add.php" method="POST">	
		<!-- applying the css for fonts and errors. -->	
			<style type="text/css"> 
				td{font-weight:bold;}
			</style>
		
		<?php 
			if (isset($_GET['id']))
			{
				$id=trim($_GET['id']);
				$dbconnect = new db_link();
				$sql_query_new = 'SELECT * from inventory where id = "'.$id.'" ';
				$result = $dbconnect->query_result($sql_query_new);
				$row=mysqli_fetch_assoc($result);
				$itemName = $row['itemName'];
				$description = $row['description'];
				$supplierCode = $row['supplierCode'];
				$cost = $row['cost'];
				$price = $row['price'];
				$onHand = $row['onHand'];
				$reorderPoint = $row['reorderPoint'];
				$backOrder = $row['backOrder'];
				$deleted = $row['deleted'];
			}
		?>
			<table>
		
			<?php 
				if($id)
				{
			?>
				<tr>
					<td>id:</td>
					<td><input name="id" type="text" readonly="readonly" value="<?php echo $id; ?>"></td>
				</tr>
			<?php 
				}
			?>
				<tr>
					<td>Iteam name:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="itemName" type="text" value="<?php echo $itemName ;?>"</td>
					<?php
					}
					else
					{
					?>
					<td><input name="itemName" type="text" value="<?php if(isset($_POST['itemName'])) echo $_POST['itemName'];?>"></td>
					<?php 
					}
					?>
					 <td style="color:#ff0000;"><?php echo $iteamNameErrErr ;?></td>	<!-- Display error in RED color -->
				</tr>
				  
				<tr>
					<td>Description:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><textarea row="4" cols="20" name="description"><?php echo $description;?></textarea> </td>
					<?php
					}
					else
					{
					?>
				    	<td><textarea rows="4" cols="20" name="description"><?php if (isset($_POST['description'])) echo $_POST['description']; ?></textarea></td>
					<?php 
					}
					?>
				    	<td style="color:#ff0000;"><?php echo $descriptionErr ;?></td>	<!-- Display error in RED color -->
				</tr>
				  
				<tr>
				    <td>Suppier Code:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="supplierCode" type="text" value="<?php echo $supplierCode ;?>"</td>
					<?php
					}
					else
					{
					?>
			    		<td><input name="supplierCode" type="text" value="<?php if (isset($_POST['supplierCode'])) echo $_POST['supplierCode']; ?>"></td>
					<?php
					}
					?>
					<td style="color:#ff0000;"><?php echo $supplierCodeErr ;?></td>	<!-- Display error in RED color -->
				</tr>
				  
				<tr>
			    		<td>Cost:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="cost" type="text" value="<?php echo $cost ;?>"</td>
					<?php
					}
					else
					{
					?>
			    		<td><input name="cost" type="text" value="<?php if (isset($_POST['cost'])) echo $_POST['cost']; ?>"></td>
					<?php
					}
					?>
			    		<td style="color:#ff0000;"><?php echo $costErr ;?></td>	<!-- Display error in RED color -->
				</tr>
				  
				<tr>
		    			<td>Price:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="price" type="text" value="<?php echo $price ;?>"</td>
					<?php
					}
					else
					{
					?>
	    				<td><input name="price" type="text" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>"></td>
					<?php 
					}
					?>
		   			<td style="color:#ff0000;"><?php echo $priceErr ;?></td>	<!-- Display error in RED color -->
				</tr>
				  
				<tr>
			    		<td>Number on Hand:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="onHand" type="text" value="<?php echo $onHand ;?>"</td>
					<?php
					}
					else
					{
					?>
			    		<td><input name="onHand" type="text" value="<?php if (isset($_POST['onHand'])) echo $_POST['onHand']; ?>"></td>
					<?php 
					}
					?>
			    		<td style="color:#ff0000;"><?php echo $numberOn_handErr ;?></td>	<!-- Display error in RED color -->
				</tr>
				  
				<tr>
			    		<td>Recorder Point:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="reorderPoint" type="text" value="<?php echo $reorderPoint ;?>"</td>
					<?php
					}
					else
					{
					?>
		    			<td><input name="reorderPoint" type="text" value="<?php if (isset($_POST['reorderPoint'])) echo $_POST['reorderPoint']; ?>"></td>
					<?php 
					}
					?>
			    		<td style="color:#ff0000;"><?php echo $recordPointErr ;?></td>	<!-- Display error in RED color -->
					</tr>
				  
				<tr>
			    		<td>On Back Order:</td>
					<?php 
					if(isset($id))
					{
					?>
					<td><input name="backOrder" type="checkbox" value="y"<?php if($backOrder == 'y')echo 'checked="checked"' ;?>"</td>
					<?php
					}
					else
					{
					?>
		    			 <td><input name="backOrder" type="checkbox" value="1" <?php if(isset($_POST['backOrder'])) { if($_POST['backOrder'] == '1') { ?> checked = "checked" <?php } }?> ></td>
		      			<?php 
					}
					?>
			    		<td style="color:#ff0000;"><?php echo $backOrderErr ;?></td>	<!-- No error display -->
				</tr>
				  
				<tr>
					<td><input name="submit" type="submit"></td>	<!-- if submit press then go to all condition and check step to step. -->
				</tr>
				  
			</table>  
		
		</form>
<?php
    }
	// call the footer functions in library page.
	footer_ft();
?>

	</body>
</html> 


