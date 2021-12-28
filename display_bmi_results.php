<?php
/*
Andrew Dibble
3/20/21
http://chelan.highline.edu/~dibbsports/116/finalProject/display_bmi_results.php
This contains the html for the bmi calculator
*/
error_reporting(E_ALL);
?>

<?php
if (!isset($weight)) { $weight= ''; } 
if (!isset($weight_units)) { $weight_units = ''; } 
if (!isset($height)) { $height = ''; } 
if (!isset($height_units)) { $height_units = ''; } 

?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Fitness Tracker</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
	
	<h1>Health and Fitness Tracker</h1>
	
	<p>Welcome to the Health and Fitness Tracker! Here you can calculate your BMI (Body Mass Index) which is a calculation
	of body fat that uses your height and weight. <?php echo "<br>"?> To meet your body fat goals, use the fitness tracker to log your runs,
	walks, and other activities!</p>
	
	
		
		<form action="." method="post"> <!--the bmi calculator form -->
			<label>Weight:</label>
			<input type = "text" name = "weight" value = "">
		
			<label>Units:</label>
			<select name = "weight_units">
				<option value = "lb">Pounds</option>
				<option value = "kg">Kilograms</option>
			</select>
			<br>
		
			<label>Height:</label>
			<input type = "text" name = "height" value = "">
		
			<label>Units:</label>
			<select name = "height_units">
				<option value = "in">Inches</option>
				<option value = "m">Meters</option>
			</select>
			
			<br><br>
			
			<label>&nbsp;</label>
			<input type="submit" name = "calculate" value="Calculate"><br>
			
		</form>
		
		<br>
		
		
			
	
	</body>
	
	
</html>
