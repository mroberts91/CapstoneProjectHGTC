<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<title>SQL Insert</title>
		<link rel="stylesheet" href="styles.css" />
	</head>
	<body>
	<?php
	//NECESSARY VARIABLES
	$errormsg = "";
	$showform = 1;
	//DATABASE CONNECTION
	require_once "connect.php";

		if( isset($_POST['thesubmit']) )
		{
			echo '<p>The form was submitted.</p>';

			//Data Cleansing
			$formfield['ffcustname'] = trim($_POST['fullcustname']);
			$formfield['ffcustaddress'] = trim($_POST['custaddress']);
			$formfield['ffcustphone'] = trim($_POST['custphone']);
		
			/*  ****************************************************************************
     		CHECK FOR EMPTY FIELDS
    		Complete the lines below for any REQIURED form fields only.
			Do not do for optional fields.
    		**************************************************************************** */
			if(empty($formfield['ffcustname'])){$errormsg .= "<p>Your custname is empty.</p>";}
			if(empty($formfield['ffcustaddress'])){$errormsg .= "<p>Your custaddress is empty.</p>";}
			if(empty($formfield['ffcustphone'])){$errormsg .= "<p>Your custphone is empty.</p>";}

			/*  ****************************************************************************
			DISPLAY ERRORS
			If we have concatenated the error message with details, then let the user know
			**************************************************************************** */
			if($errormsg != "")
			{
				echo "<div class='error'><p>THERE ARE ERRORS!</p>";
				echo $errormsg;
				echo "</div>";
			}
			else
			{
				try
				{
					//enter data into database
					$sqlinsert = 'INSERT INTO customer (dbcustname, dbcustaddress, dbcustphone)
								  VALUES (:bvcustname, :bvcustaddress, :bvcustphone)';
					$stmtinsert = $db->prepare($sqlinsert);
					$stmtinsert->bindvalue(':bvcustname', $formfield['ffcustname']);
					$stmtinsert->bindvalue(':bvcustaddress', $formfield['ffcustaddress']);
					$stmtinsert->bindvalue(':bvcustphone', $formfield['ffcustphone']);
					$stmtinsert->execute();
					echo "<div class='success'><p>There are no errors.  Thank you.</p></div>";
				}//try
				catch(PDOException $e)
				{
					echo 'ERROR!!!' .$e->getMessage();
					exit();
				}
			}//else statement end
		}//if isset submit


	$sqlselect = 'SELECT dbcustname, dbcustaddress, dbcustphone from customer';

	$result = $db-> query($sqlselect);

	?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="theform">
			<fieldset><legend>Personal Information</legend>
				<table border>
					<tr>
						<th>Name</th>
						<td><input type="text" name="fullcustname" id="fullcustname"
						value = <?php echo $formfield['ffcustname']; ?>	></td>
					</tr>
					<tr>
						<th>Address</th>
						<td><input type="text" name="custaddress" id="custaddress"
						value = <?php echo $formfield['ffcustaddress']; ?>></td>
					</tr>
					<tr>
						<th>Phone</th>
						<td><input type="tel" name="custphone" id="custphone"
						value = <?php echo $formfield['ffcustphone']; ?>></td>
					</tr>
				</table>
				<input type="submit" name = "thesubmit" value="Enter">
			</fieldset>
		</form>
			<br><br>
	<table border>
	<tr>
		<th>Name</th>
		<th>Address</th>
		<th>Phone</th>
	</tr>
	<?php 
		while ( $row = $result-> fetch() )
			{
				echo '<tr><td>' . $row['dbcustname'] . '</td><td> ' . $row['dbcustaddress'] . 
				'</td><td> ' . $row['dbcustphone'] . '</td></tr>';
			}
		?>
	</table>
	</body>
</html>