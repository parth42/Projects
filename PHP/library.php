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

	class db_link		// Main class for database connectivity
	{
		private $link;
		private $result;
		
		public function __construct()		// constuctor call db_link for connection
		{	/*
			$lines = file('/home/int322/secret/topsecret');
			$dbserver = trim($lines[2]);
			$uid = trim($lines[0]);
			$pw = trim($lines[1]);
			$dbname = trim($lines[3]);

		//Connect to the mysql server
	 		$link = mysqli_connect($dbserver, $uid, $pw, $dbname)
				or die('Could not connect: ' . mysqli_error($this->link));
		        if($link)
		        	$this->link = $link; */
		$dbserver = "localhost";
		$uid = "root";
		$pw = "";
		$dbname = "int322";
  
        //Connect to the mysql server and get back our link_identifier
        $link = mysqli_connect($dbserver, $uid, $pw, $dbname)
                    or die('Could not connect: ' . mysqli_error($link));
		
                  if($link)
                     $this->link = $link;

		}

		function query_result($sql_query)	// SQL query for database connectivity
		{
			$result=mysqli_query($this->link, $sql_query) or die('query failed.. Please check database');
			return $result;
		}

		function query_active()
		{
			return $this->link;	
		}

	
		function __destruct()		// destuctore for close the connection from the database
		{
			mysqli_close($this->link);
		}
	}
?>

<!DOCTYPE html>
	<head>
	<meta charset="utf-8" />
		<style type="text/css">

		th	/* css for the th in table */
		{
			background-color:#9999CC;
			padding-top:10px;
			padding-bottom:10px;
			color:#990000;
			text-align:center;
			width:100px;

		}

		.view	/* css for the table for header */
		{
			border-width:5px;
			border-style:groove;
			padding-top:5px;
		}

		.Link	/* CSS for Add and View link on both pages. */	
		{
			background-color:#CCCC99;
			width:1100px;
			height:40px;
			margin-top:20px;
			text-align:left;
			margin-bottom:10px;
			position:relative;
			font-size:18px;
			font-weight:bold;
		}
		
		
		.footer	/* css for footer */	
		{
			background-color:#CCCC99;
			width:1100px;
			height:60px;
			margin-top:80px;
			padding-bottom:10px;
			font-size:18px;
			font-weight:bold;
			text-align:center;
			margin-bottom:5px;
			position:relative;
			padding-top:0px;
			color:#DF0101;
		}

		.linkTextClr
		{
			color:#DF0101;
		}

		.linkTextClr:hover
		{
			color:#003366;
		}
		#menu_form {display:inline;}
		#top ul li {display:inline;}
		</style>

	<!-- Common theme for both pages. -->

	</head>
	<body>
	<?php 
		function header_page()
		{
	?>
		<div id="header">
			<h2>Garg Online Book store...</h2>
		</div> <!-- end #header -->
	<?php 
		}
		 function menu()
		{
	?>
		
			<div>
				<img src="books.jpg" alt="myPic" />	
			</div>
			 
			 
		<div class="Link"  >
			<div id="top" >
				<ul>
					<li><a href="./add.php" class="linkTextClr">Add</a>&nbsp&nbsp&nbsp&nbsp<a href="./view.php" class="linkTextClr">View All</a>	
					</li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<li>			
						<form method="POST" action="view.php" id="menu_form">
						 Search in description:
						<input type="text" name="searchBox"value="<?php if (isset($_POST['searchBox'])) echo $_POST['searchBox'];?>"/>
						<input type="submit" name="search" value="Search"/>
						</form>
					</li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<li>
						<span>User : <?php echo $_SESSION['username']; ?></span>&nbsp&nbsp                      
						<span>Role : <?php echo $_SESSION['role']; ?></span>
					</li>&nbsp&nbsp&nbsp&nbsp
					<li><a href="logout.php">Logout</a></li>
			    </ul>
			</div>
			
		</div>
 
		<?php  
		}
		function footer_ft()
		{	
			
		?>
			<footer>
				<div class="footer">
				<p>Copyright &copy; 2014 Assignment 1</p>
				<p>Created by Parth Parikh<p/>
				</div>
			</footer> 
		<?php 
			}	 
		?>
	</body>
</html>

