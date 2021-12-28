<?php
/*
Andrew Dibble
3/20/21
This contains the html and PHP for the Fitness log part of the program.
*/
error_reporting(E_ALL);
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Fitness Tracker</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<p>The American Heart Association recommends that everyone gets at least 150 minutes of moderately intense 
		aerobic activity (i.e. walking) <?php echo "<br>"?>or 75 minutes of strenuous aerobic activity (i.e. running) each week.</p>
		
		
		<h2>Record your Exercise</h2>
		
		<span class="error">
		<?php
		if (count($error) > 0){ //outputting errors if there are any
			echo htmlspecialchars($error[0]);
		} ?>
		</span>
		
		<form action="." method="post"> <!--the fitness tracker form -->
		
		
			<label>Exercise Name:</label>
			<input type = "text" name = "name" value = "">
			
			<label>Exercise Type:</label>
			<select name = "type">
				<option value = "moderate">Moderate</option>
				<option value = "strenuous">Strenuous</option>
			</select>
			
			<label>Date:</label>
			<?php $current_date = date("M-j-Y"); ?>
			<input type = "text" name = "date" value = <?php echo htmlspecialchars($current_date) ?>>  <!-- setting default date to current date-->
			
			<label>Exercise Time (min):</label>
			<input type = "text" name = "time" value = "">
			
			<br>
			
			<label>&nbsp;</label>
			<input type="submit" name = "action" value="Add Exercise"><br>
			
		
			<?php
			if(count($name_array)==0){ //if there are no exercises ?>
				<p>There are no exercises recorded</p> <?php
			}else{ 
				echo "<table border='1'>";//creating the table ?>
				<tr>
					<td>Exercise Name<td>
					<td>Type<td>
					<td>Date<td>
					<td>Time(min)<td>
				</tr>
 
				<?php $count = count($name_array);
				for($i = 0; $i < $count; $i++){ //looping through and creating the columns of the table?> 
					<tr>
						<td><?php echo htmlspecialchars($name_array[$i]) ?><td>
						<td><?php echo htmlspecialchars($type_array[$i]) ?><td>
						<td><?php echo htmlspecialchars($date_array[$i]) ?><td>
						<td><?php echo htmlspecialchars($time_array[$i]) ?><td>
					</tr> <?php
				} 
				
				$total_time = 0;
				for($i = 0; $i < $count; $i++){  //calculating the total time of workouts
					$total_time += $time_array[$i];
				}?>
				<tr>
					<td>Total<td>
					<td><td>
					<td><td>
					<td><?php echo "$total_time "; ?>min<td> <!-- adding the total to the table -->
				</tr> <?php
				echo "</table>"; 
				
				$med_exercise_time = 0;  
				$hard_exercise_time = 0;
				
				for($i = 0; $i < $count; $i++){ //calculating if the exercise is hard or medium and getting the time for both
					if($type_array[$i] == "moderate"){
						$med_exercise_time += $time_array[$i];
					}else{
						$hard_exercise_time += $time_array[$i];
					}
				} 
				
				
				//the output ?>
				<p>Congratulations! You have completed <?php echo htmlspecialchars($med_exercise_time); ?> min of Moderate Activity and 
				<?php echo htmlspecialchars($hard_exercise_time); ?> min of Strenuous Activity! </p>
				<br> <?php
				$time_needed = 150 - $med_exercise_time - (2 * $hard_exercise_time);
				if($time_needed > 0){ ?>
					<p>This means you only need <?php echo htmlspecialchars($time_needed); ?> min of moderate exercise or 
					<?php echo htmlspecialchars($time_needed / 2); ?> min of strenuous exercise to reach the goal!</p><?php
				}else{?>
					<p>You have reached the weekly goal! </p> <?php
				}
				
			} 
		
			//passing all data to the arrays to keep previous submissions 
			foreach($name_array as $n){ ?>
				<input type="hidden" name="hidden_name[]" value="<?php echo htmlspecialchars($n); ?>"> <?php
			}
			foreach($type_array as $ty){ ?>
				<input type="hidden" name="hidden_type[]" value="<?php echo htmlspecialchars($ty); ?>"> <?php
			}
			foreach($date_array as $d){ ?>
				<input type="hidden" name="hidden_date[]" value="<?php echo htmlspecialchars($d) ?>"> <?php
			}
			foreach($time_array as $ti){ ?>
				<input type="hidden" name="hidden_time[]" value="<?php echo htmlspecialchars($ti); ?>"> <?php
			}?>
					
			
		</form>
		<a href="http://chelan.highline.edu/~dibbsports/116/finalProject">Reset Log</a>
		<br>
		<a href="../index.html">Return to index page</a>
		<br>
		<a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fchelan.highline.edu%2F%7Edibbsports%2F116%2FfinalProject%2FfitnessTracker.php">Validate</a>
		
	</body>	
</html>