<html>
<head>
	<title>MyGym | View Users</title>
<style type="text/css">
	table{
		background-color: darkgrey;
	}
	tr,th{
		border: 2px solid white;
	}
</style>
</head>
<body>
	<table align="center" width="794" style="color:white;">
		<tr align="center">
			<td colspan="6"><h2>Tous Les Utilisateurs</h2><br></td>
		</tr>
		<tr>
			<th>Utilisateur Numero :</th>
			<th>Nom Utilisateurs : </th>
			<th>Adresse mail : </th>
			<th>Poid : </th>
			<th>Age : </th>
			<th>Contact : </th>
			<th>Supprimer Utilisateur</th>
		</tr>
		<?php 
		$i=0;
			$sel_user="SELECT * FROM users";
			$run_user=mysqli_query($con, $sel_user);
			while ($row_user=mysqli_fetch_array($run_user)) {
				$user_id=$row_user['user_id'];
				$user_name=$row_user['user_name'];
				$user_email=$row_user['user_email'];
				$user_weight=$row_user['user_weight'];
				$user_age=$row_user['user_age'];
				$user_contact=$row_user['user_contact'];

				$i++;
			
		?>
		<tr align="center">
			<td><?php echo $i; ?></td>
			<td><?php echo $user_name; ?></td>
			<td><?php echo $user_email; ?></td>
			<td><?php echo $user_weight; ?></td>
			<td><?php echo $user_age; ?></td>
			<td><?php echo $user_contact; ?></td>
			<td><a href="index.php?delete_user=<?php echo $user_id; ?>">Supprimer Utilisateur</a></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>