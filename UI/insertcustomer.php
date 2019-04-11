<?php
$pagetitle = 'Insert Customer';
require_once 'header.php';
require_once 'connect.php';


	
	
	
	
	//Mike will help with setting up PHP code. 
	
	?>
	
	
	
	
	
	
	
		<form method="post" action="contactcomplete.php" name="MBform">
			<fieldset><legend>Personal Information</legend>
				<table border>
					<tr>
						<th><label for="MBname">First Name:</label></th>
						<td><input type="text" name="MBname" id="MBname" value="<?php if( isset($formfield['ffname'])){
						    echo $formfield['ffname'];}?>"/></td>
					</tr>
					<tr>
						<th><label for="MBlastname">Last Name:</label></th>
						<td><input type="text" name="MBlastname" id="MBlastname" value="<?php if( isset($formfield['fflastname'])){
						    echo $formfield['fflastname'];}?>" /></td>
					</tr>
					<tr>
						<th><label for="MBaddress">Address:</label></th>
						<td><input type="text" name="MBaddress" id="MBaddress" value="<?php if( isset($formfield['ffaddress'])){
						    echo $formfield['ffaddress'];}?>" /></td>
					</tr>
					<tr>
						<th><label for="MBcity">City:</label></th>
						<td><input type="text" name="MBcity" id="MBcity" value="<?php if( isset($formfield['ffcity'])){
						    echo $formfield['ffcity'];}?>" /></td>
					</tr>
					<tr>
						<th><label for="MBstate">State:</label></th>
						<td><input type="text" name="MBstate" id="MBstate" value="<?php if( isset($formfield['ffstate'])){
						    echo $formfield['ffstate'];}?>" /></td>
					</tr>
					<tr>
						<th><label for="MBzip">Zip:</label></th>
						<td><input type="text" name="MBzip" id="MBzip" value="<?php if( isset($formfield['ffzip'])){
						    echo $formfield['ffzip'];}?>" /></td>
					</tr>
					<tr>
						<th><label for="MBemail">Email:</label></th>
						<td><input type="text" name="MBemail" id="MBemail" value="<?php if( isset($formfield['ffemail'])){
						    echo $formfield['ffemail'];}?>" /></td>
					</tr>
					<tr>
						<th>Submit:</th>
						<td><input type="submit" name="MBsubmit" value="Submit" /></td>
					</tr>
				</table>
			</fieldset>
		</form>
			<br><br>
	
	
	
	
<?php
}
include_once 'footer.php';
?>	