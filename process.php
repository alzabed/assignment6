<?php
session_start();

// Validate form inputs
if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$profile_pic = $_FILES['profile_pic']['name'];

	if(empty($name) || empty($email) || empty($password) || empty($profile_pic)) {
		echo "Please fill out all fields";
		exit;
	}
	else {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format";
			exit;
		}
		else {
			// Save profile picture to server with unique filename
			$target_dir = "uploads/";
			$target_file = $target_dir . date('YmdHis') . "_" . basename($_FILES['profile_pic']['name']);
			move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file);

			// Save user data to CSV file
			$file = fopen('users.csv', 'a');
			fputcsv($file, [$name, $email, $target_file]);
			fclose($file);

			// Set cookie with user's name
			setcookie('username', $name, time() + (86400 * 30), "/"); // 86400 = 1 day
			echo "Registration Successful!";

			exit;
		}
	}
}
?>