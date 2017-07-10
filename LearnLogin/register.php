<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<body>
		<h2>Registration Page</h2>
		<a href="index.php">Click here to go back</a><br/><br/>
		<form action="register.php" method="post">
			Enter Username: <input type="text" name="username" required="required"/> <br/>
			Enter Password: <input type="password" name="password" required="required" /> <br/>
			<input type="submit" value="Register"/>
		</form>
	</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['username'];
	$password = $_POST['password'];
    $canAdd = true;
	$redirect = false;

	$mysqli = new mysqli("localhost", "root", "root", "funstuff_db");
	if (mysqli_connect_errno())
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$query = "SELECT * from users";

	if ($result = $mysqli->query($query))
	{
		while ($row = $result->fetch_row()) {
			#printf ("user[%s]=%s <br/>", $row[0], $row[1]);

			if($row['1'] == $username) // checks if there are any matching fields
			{
				$canAdd = false;
				printf ("user exists, error <br/>");
				break;
			}
		}

		$result->close();
	}
	
	if($canAdd)
	{
		$query1 = "INSERT INTO users (username, password) VALUES ('$username','$password')";
		if ($result1 = $mysqli->query($query1))
		{
			$redirect = true;
			echo "</br> user registered <br/>";
			#$result1->close();
		}
		
		if (!$mysqli->commit()) {
			print("Transaction commit failed\n");
			exit();
		}
	}

	$mysqli->close();
	
	if ($redirect)
	{
		echo '<script>alert("Successfully Registered! ... continue to LOGIN page");</script>'; // Prompts the user
		echo '<script>location.href = \'login.php\';</script>';
	}
}
?>