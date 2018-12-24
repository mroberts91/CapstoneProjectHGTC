<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<title>Technician Select</title>
		<link rel="stylesheet" href="styles.css" />
	</head>
	<body>
	<h1>Hello World</h1>
  	<h2>This is a test</h2>
	<h3>This was added in Task4445</h3>
	
	<?php
	$errormsg = "";
	//DATABASE CONNECTION
	require_once "connect.php";
	if( isset($_POST['thesubmit']) )
		{
			$sqlselect = "SELECT dbtechtitle, dbtechschedule from technician where dbtechname like CONCAT('%', :bvtechname, '%')
							AND dbtechtitle like CONCAT('%', :bvtechtitle, '%')
							AND dbtechschedule like CONCAT('%', :bvtechschedule, '%')";
			$result = $db->prepare($sqlselect);
			$result->bindValue(':bvtechname', $_POST['techname']);
			$result->bindValue(':bvtechtitle', $_POST['techtitle']);
			$result->bindValue(':bvtechschedule', $_POST['techschedule']);
			$result->execute();
		}
	else
		{
			$sqlselect = "SELECT * from technician";
			$result = $db-> query($sqlselect);
		}
	
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="theform">
			<fieldset><legend>Personal Information</legend>
				<table border>
					<tr>
						<th>Name</th>
						<td><input type="text" name="techname" id="techname"
						value = <?php echo $_POST['techname']; ?>	></td>
					</tr>
					<tr>
						<th>Title</th>
						<td><input type="text" name="techtitle" id="techtitle"
						value = <?php echo $_POST['techtitle']; ?>></td>
					</tr>
					<tr>
						<th>Schedule</th>
						<td><input type="text" name="techschedule" id="techschedule"
						value = <?php echo $_POST['techschedule']; ?>></td>
					</tr>
					<tr>
						<th>Test</th>
						<td>This is a test</td>
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