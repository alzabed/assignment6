<!DOCTYPE html>
<html>
<head>
	<title>User Data</title>
</head>
<body>
	<h2>User Data</h2>
	<table>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Profile Picture</th>
		</tr>
		<?php
			// Display user data from CSV file
			$file = fopen('users.csv', 'r');
			while(($data = fgetcsv($file)) !== FALSE) {
				echo "<tr>";
				echo "<td>" . $data[0] . "</td>";
				echo "<td>" . $data[1] . "</td>";
				echo "<td><img src='" . $data[2] . "' width='100'></td>";
				echo "</tr>";
			}
			fclose($file);
		?>
	</table>
    <?php include 'users.php';?>
</body>
</html>