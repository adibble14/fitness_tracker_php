<?php
/*
Andrew Dibble
3/20/21
http://chelan.highline.edu/~dibbsports/116/finalProject
This contains the majority of the PHP code for the bmi calculator and fitness log. It included the html
and the additional PHP from fitnessTracker.php and display_bmi_results.php.
--there is a lot of php on the fitnessTracker.php too--
*/
?>
<?php
error_reporting(E_ALL);
//the bmi calculator code

include('display_bmi_results.php'); //inserting the html for the bmi calculator

//declaring variables
$weight = filter_input(INPUT_POST,'weight',FILTER_VALIDATE_FLOAT);
$weight_units = filter_input(INPUT_POST,'weight_units');
$height = filter_input(INPUT_POST,'height',FILTER_VALIDATE_FLOAT);
$height_units =  filter_input(INPUT_POST,'height_units');

//validation
if (isset($_POST['calculate'])){
	
	if($weight == FALSE){
		$error_message = "Please enter a valid weight";
	}elseif($weight <= 0){
		$error_message = "Please enter a positive weight";
	}elseif($weight > 1500 ){
		$error_message = "Please enter a lower weight";
	}elseif($height == FALSE){
		$error_message = "Please enter a valid height";
	}elseif($height <= 0){
		$error_message = "Please enter a positive height";
	}elseif($height > 120){
		$error_message = "Please enter a lower height";
	}elseif($weight_units === NULL){
		$error_message = "Please select units for weight";
	}elseif($height_units === NULL){
		$error_message = "Please select units for height";
	}else{
		$error_message = "";
	}

	if($error_message == ""){  //if there is no error
		if($weight_units == "lb"){
			$weight *= 0.45359237;  //converting lbs to kg
		}
		if($height_units == "in"){  //converting in to m
			$height *= 0.0254;
		}
	
		$bmi = computeBMI($weight, $height);  //calling the bmi function
		$categories = bmiCategory($bmi);      //calling the category function
		$category = $categories[0];           //assigning the array values to variables
		$bmi_range = $categories[1];
		$risk = $categories[2];
		
		
		
		//output ?>
		<p>Your BMI is <?php echo htmlspecialchars($bmi);?>. This means that you are <?php echo "$category";?> and in the 
		<?php echo htmlspecialchars($bmi_range);?> range. This means that you have a <?php echo "$risk";?> for chronic diseases.</p>
		
		<br>
		
		<?php if($category == "Underweight"){ ?>
			<p>Being Underweight doesn't mean you should not exercise! Track your fitness activities below while you work to 
			gain more weight to improve your health!</p>
			<br>
		<?php }elseif($category == "Normal Weight"){ ?>
			<p>Staying at the proper weight is important, so use the fitness tracker below to track your activity and to make
			sure you are hitting your goals!</p>
			<br>
		<?php }elseif($category == "Over Weight"){ ?>
			<p>Being a little over weight just means some work is needed! Use the fitness tracker below to stay healthy 
			and meet the recommended goals!</p>
			<br>
		<?php }else{ ?>
			<p>Anyone can change their health and habits. All it takes is a little dedication! Use the fitness tracker
			below to track your progress and hit your goals!</p>
			<br>
		<?php }
	
		
	}else{ //ourput if there is an error
		 if (!empty($error_message)) { ?>
				<p class="error"><?php echo htmlspecialchars($error_message); ?></p> <?php 
		} 
	}
}


function computeBMI($weight, $height){   //calculating the bmi and returning it formatted
		$bmi = number_format($weight/($height*$height),1);
		return $bmi;
}

function bmiCategory($bmi){  //assigning the appropiate categories according to the CDC
	if($bmi <= 18.4){    
			$category = "Underweight";
			$bmi_range = "18.4 and below";
			$risk = "Malnutrition Risk";
		}elseif($bmi >= 18.5 && $bmi <=24.9){
			$category = "Normal Weight";
			$bmi_range = "18.5 - 24.9";
			$risk = "Low Risk";
		}elseif($bmi >=25 && $bmi <= 29.9){
			$category = "Over Weight";
			$bmi_range = "25 - 29.9";
			$risk = "Medium Risk";
		}elseif($bmi >= 30 ){
			$category = "Obese";
			$bmi_range = "30 and above";
			$risk = "High Risk";	
		}
	$categories = array($category, $bmi_range, $risk);
	return $categories;
}     


//the fitness tracker code

//getting old data from previous submitions
$name_array = filter_input(INPUT_POST, 'hidden_name', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$type_array = filter_input(INPUT_POST, 'hidden_type', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$date_array = filter_input(INPUT_POST, 'hidden_date', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$time_array = filter_input(INPUT_POST, 'hidden_time', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

if($name_array === NULL){ //creating array if it is empty
	$name_array = array();
	$type_array = array();
	$date_array = array();
	$time_array = array();
}


$name = filter_input(INPUT_POST,'name');  //getting the input
$type = filter_input(INPUT_POST,'type');
$date = filter_input(INPUT_POST,'date');
$time = filter_input(INPUT_POST,'time', FILTER_VALIDATE_FLOAT);

$action = filter_input(INPUT_POST, 'action');  //getting what button was pressed
$error = array();

if (isset($_POST['action'])){
	if($name == FALSE || $type == FALSE || $date == FALSE || $time == FALSE){  //validation
		$error[] = "Please fill all fields with valid info";
	}elseif(!preg_match('/[A-Z][a-z][a-z]-[0-9][0-9]-[0-9][0-9][0-9][0-9]/',$date)){
		$error[] = "Please enter a correct date in the form i.e. Jan-01-2001";
	}elseif($time > 10000){
		$error[] = "Not enought minutes in the week";
	}elseif($time <= 0){
		$error[] = "Please enter a positive time";
	}
	
	if(count($error)==0){
		if($action == 'Add Exercise'){ //if the add exercise button was pressed add the exercise to the list
			array_push($name_array, $name);
			array_push($type_array, $type);
			array_push($date_array, $date);
			array_push($time_array, $time);
		}
	}
}



include("fitnessTracker.php"); //including the html for the fitness tracker


?>