<?php 

include ("includes/db.php");

?>
<html>
<head>
	<title>MyGym</title>
</head>
<body bgcolor="#999999">
	<form method="post" action="add_exercises.php" enctype="multipart/form-data">
		<table width="794px" align="center" border="1" bgcolor="#f1533e">
			<tr>
				<td colspan="2" align="center"><h1>Insérer des exercices</h1></td>
			</tr>
			<tr>
				<td align="right"><b>Sélectionnez un utilisateur</b></td>
				<td>
					<select name="user">
						<option>Sélectionnez un utilisateur</option>
						<?php
						$get_user="SELECT * FROM users";
						$run_user=mysqli_query($con, $get_user);
						while($row_days=mysqli_fetch_array($run_user)){
							$user_id=$row_days['user_id'];
							$user_name=$row_days['user_name'];
							echo "<option value='$user_id'>$user_name</option>";
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Jours</b></td>
				<td>
					<select name="day">
						<option>Sélectionnez un jour</option>
						<?php
							$get_day="SELECT * FROM days";
							$run_day=mysqli_query($con, $get_day);
							while($row_days=mysqli_fetch_array($run_day)){
								$day_id=$row_days['day_id'];
								$day_name=$row_days['day_name'];
								echo "<option value='$day_id'>$day_name</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Nom de l'exercice</b></td>
				<td><input type="text" name="exercise"></td>
			</tr>
			
			<tr>
				<td align="right"><b>Nombre de series</b></td>
				<td><input type="text" name="sets"></td>
			</tr>
			<tr>
				<td align="right"><b>Image de l'exercice</b></td>
				<td><input type="file" name="exer_img"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="insert_workout" value="Attribuer un entraînement"></td>
			</tr>
		</table>
	</form>
</body>
</html>


<?php 

	if (isset($_POST['insert_workout']))
	{

		//Text Data Variables
		$user_name= $_POST['user'];
		$exer_name= $_POST['exercise'];
		$day_name= $_POST['day'];
		$sets= $_POST['sets'];

		//  Image Name
		$exercise_img= $_FILES['exer_img']['name'];

		//Images Temp Name
		$temp_name= $_FILES['exer_img']['tmp_name'];

		//Validations
		if($user_name==''){
			echo "<script>alert('Please Fill All The Fields!')</script>";
			exit();
		}
		elseif ($exer_name=='') {
			echo "<script>alert('Please Fill All The Fields!')</script>";
			exit();
		}
		elseif ($day_name=='') {
			echo "<script>alert('Please Fill All The Fields!')</script>";
			exit();
		}
		elseif ($sets=='') {
			echo "<script>alert('Please Fill All The Fields!')</script>";
			exit();
		}
		elseif ($exercise_img=='') {
			echo "<script>alert('Please Fill All The Fields!')</script>";
			exit();
		}

		else{

			move_uploaded_file($temp_name, "exercise_images/$exercise_img");

			//Query For Inserting Workout Into Database.....
			$insert_exer = "insert into exercises(exer_name, sets, day_id, exer_img, user_id) values('$exer_name','$sets','$day_name','$exercise_img','$user_name')";
			$run_exer = mysqli_query($con, $insert_exer);
			if ($run_exer) {
				echo "<script>alert('Exercise Inserted')</script>";
				echo "<script>window.open('index.php?add_exercises','_self')</script>";
			}
			else{
				echo "<script>alert('Error')</script>";
			}
			
		}
	}
?>