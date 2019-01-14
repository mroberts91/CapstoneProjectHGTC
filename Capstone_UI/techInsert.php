<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<title>Technician Insert</title>
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
			$formfield['fftechname'] = trim($_POST['techname']);
			$formfield['fftechtitle'] = trim($_POST['techtitle']);
			$formfield['fftechschedule'] = trim($_POST['techschedule']);
		
			/*  ****************************************************************************
     		CHECK FOR EMPTY FIELDS
    		Complete the lines below for any REQIURED form fields only.
			Do not do for optional fields.
    		**************************************************************************** */
			if(empty($formfield['fftechname'])){$errormsg .= "<p>Your techname is empty.</p>";}
			if(empty($formfield['fftechtitle'])){$errormsg .= "<p>Your techtitle is empty.</p>";}
			if(empty($formfield['fftechschedule'])){$errormsg .= "<p>Your techschedule is empty.</p>";}

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
					$sqlinsert = 'INSERT INTO technician (dbtechname, dbtechtitle, dbtechschedule)
								  VALUES (:bvtechname, :bvtechtitle, :bvtechschedule)';
					$stmtinsert = $db->prepare($sqlinsert);
					$stmtinsert->bindvalue(':bvtechname', $formfield['fftechname']);
					$stmtinsert->bindvalue(':bvtechtitle', $formfield['fftechtitle']);
					$stmtinsert->bindvalue(':bvtechschedule', $formfield['fftechschedule']);
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


	$sqlselect = 'SELECT dbtechname, dbtechtitle, dbtechschedule from technician';

	$result = $db-> query($sqlselect);

	?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="theform">
			<fieldset><legend>Personal Information</legend>
				<table border>
					<tr>
						<th>Name</th>
						<td><input type="text" name="techname" id="techname"
						value = <?php echo $formfield['fftechname']; ?>	></td>
					</tr>
					<tr>
						<th>Title</th>
						<td><input type="text" name="techtitle" id="techtitle"
						value = <?php echo $formfield['fftechtitle']; ?>></td>
					</tr>
					<tr>
						<th>Schedule</th>
						<td><input type="tel" name="techschedule" id="techschedule"
						value = <?php echo $formfield['fftechschedule']; ?>></td>
					</tr>
				</table>
				<input type="submit" name = "thesubmit" value="Enter">
			</fieldset>
		</form>
			<br><br>
	<table border>
	<tr>
		<th>Name</th>
		<th>Title</th>
		<th>Schedule</th>
	</tr>
	<?php 
		while ( $row = $result-> fetch() )
			{
				echo '<tr><td>' . $row['dbtechname'] . '</td><td> ' . $row['dbtechtitle'] . 
				'</td><td> ' . $row['dbtechschedule'] . '</td></tr>';
			}
		?>
	</table>
	</body>
</html>