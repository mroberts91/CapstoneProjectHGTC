<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<title>SQL Select</title>
		<link rel="stylesheet" href="styles.css" />
	</head>
	<body>
	<?php
	$errormsg = "";
	//DATABASE CONNECTION
	require_once "connect.php";
	if( isset($_POST['thesubmit']) )
		{
			$sqlselect = "SELECT * from customer where dbcustcustname like CONCAT('%', :bvcustname, '%')
							AND dbcustcustaddress like CONCAT('%', :bvcustaddress, '%')
							AND dbcustcustphone like CONCAT('%', :bvcustphone, '%')";
			$result = $db->prepare($sqlselect);
			$result->bindValue(':bvcustname', $_POST['custfullcustname']);
			$result->bindValue(':bvcustaddress', $_POST['custaddress']);
			$result->bindValue(':bvcustphone', $_POST['custphone']);
			$result->execute();
		}
	else
		{
			$sqlselect = "SELECT * from theinfo";
			$result = $db-> query($sqlselect);
		}
	
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" custname="theform">
			<fieldset><legend>Personal Information</legend>
				<table border>
					<tr>
						<th>Name</th>
						<td><input type="text" custname="custfullcustname" id="custfullcustname"
						value = <?php echo $_POST['custfullcustname']; ?>	></td>
					</tr>
					<tr>
						<th>Address</th>
						<td><input type="text" custname="custaddress" id="custaddress"
						value = <?php echo $_POST['custaddress']; ?>></td>
					</tr>
					<tr>
						<th>custphone</th>
						<td><input type="text" custname="custphone" id="custphone"
						value = <?php echo $_POST['custphone']; ?>></td>
					</tr>
				</table>
				<input type="submit" custname = "thesubmit" value="Enter">
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
				echo '<tr><td>' . $row['dbcustcustname'] . '</td><td> ' . $row['dbcustcustaddress'] . 
				'</td><td> ' . $row['dbcustcustphone'] . '</td></tr>';
			}
		?>
	</table>
	</body>
</html>