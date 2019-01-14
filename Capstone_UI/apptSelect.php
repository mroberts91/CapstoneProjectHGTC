<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<title>SQL Select appointment</title>
		<link rel="stylesheet" href="styles.css" />
	</head>
	<body>
	<?php
	$errormsg = "";
	//DATABASE CONNECTION
	require_once "connect.php";
	$sqlselectc = "SELECT * from customer";
	$resultc = $db->prepare($sqlselectc);
	$resultc->execute();
	
	$sqlselectt = "SELECT * from technician";
	$resultt = $db->prepare($sqlselectt);
	$resultt->execute();
	
	if( isset($_POST['thesubmit']) )
		{
			$formfield['ffcustomer'] = trim($_POST['customer']);
			$formfield['fftech'] = trim($_POST['tech']);
			$formfield['ffapptdate'] = trim(strtolower($_POST['apptdate']));
			
			$sqlselect = "select appointment.dbapptdate, customer.dbcustname, technician.dbtechname
							from appointment, customer, technician
							where appointment.dbapptcustomer = customer.dbcustid
							AND appointment.dbappttech = technician.dbtechid
							AND appointment.dbapptcustomer like CONCAT('%', :bvcustomer, '%')
							AND appointment.dbappttech like CONCAT('%', :bvtech, '%')
							AND appointment.dbapptdate like CONCAT('%', :bvapptdate, '%')";
			$result = $db->prepare($sqlselect);
			$result->bindValue(':bvcustomer', $formfield['ffcustomer']);
			$result->bindValue(':bvtech', $formfield['fftech']);
			$result->bindValue(':bvapptdate', $formfield['ffapptdate']);
			$result->execute();
			
		}
	else
		{
			$sqlselect = "select appointment.dbapptdate, customer.dbcustname, technician.dbtechname
				from appointment, customer, technician
				where appointment.dbapptcustomer = customer.dbcustid
				and appointment.dbappttech = technician.dbtechid";
			$result = $db-> query($sqlselect);
		}
	
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="theform">
			<fieldset><legend>Appointment Information</legend>
				<table border>
					<tr>
						<th><label for="customer">Customer:</label></th>
						<td><select name="customer" id="customer">
						<option value = "">Please Select a Position</option>
						<?php while ($rowc = $resultc->fetch() )
							{
							echo '<option value="'. $rowc['dbcustid'] . '">' . $rowc['dbcustname'] . '</option>';
							}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<th><label for="tech">Technician:</label></th>
						<td><select name="tech" id="tech">
						<option value = "">Please Select a Position</option>
						<?php while ($rowt = $resultt->fetch() )
							{
							echo '<option value="'. $rowt['dbtechid'] . '">' . $rowt['dbtechname'] . '</option>';
							}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<th>Date of Appointment</th>
						<td><input type="date" name="apptdate" id="apptdate"
						value = <?php echo $formfield['ffapptdate']; ?>></td>
					</tr>
				</table>
				<input type="submit" name = "thesubmit" value="Enter">
			</fieldset>
		</form>
			<br><br>
	<table border>
	<tr>
		<th>Customer</th>
		<th>Technician</th>
		<th>Appointment Date</th>
	</tr>
	<?php 
		while ( $row = $result-> fetch() )
			{
				echo '<tr><td>' . $row['dbcustname'] . '</td><td> ' . $row['dbtechname'] . 
				'</td><td> ' . $row['dbapptdate'] . '</td></tr>';
			}
		?>
	</table>
	</body>
</html>