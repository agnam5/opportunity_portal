<?php
session_start();
require 'connection.php';
if(isset($_POST['submit1'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$rollno = $_POST['rollno'];
	$email = $_POST['email'];
	$password = hash('sha256', $_POST['confirm_password']);
	date_default_timezone_set('Asia/Kolkata');
	$time=date("Y-m-d H:i:s"); 
	$query = "SELECT * FROM students where rollno = '".$rollno."' OR email = '".$email."'";
	$query_run = mysqli_query($conn, $query);
	$data = mysqli_fetch_all($query_run, MYSQLI_ASSOC);	
	if(count($data) == 0) {
		$sql = "INSERT INTO students (email, firstname, lastname, rollno, password, time) 
		VALUES ('$email', '$firstname', '$lastname', '$rollno', '$password', '$time')";
		$_SESSION['email'] = $email;
		$_SESSION['rollno'] = $rollno;
		if ($conn->query($sql) === TRUE) {
			echo "1";
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else {
		echo "0";
	}	
}
$conn->close();
?>