<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<body>
		<h2>Login Page</h2>
		<a href="index.php">Click here to go back</a><br/><br/>
		<form action="login.php" method="post">
			Enter Username: <input type="text" name="username" required="required"/> <br/>
			Enter Password: <input type="password" name="password" required="required" /> <br/>
			<input type="submit" value="Login"/>
		</form>
	</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$dbConnection = new mysqli("localhost", "root", "root", "funstuff_db");
	if (mysqli_connect_errno())
	{
		echo "Connect failed: ". mysqli_connect_error();
		exit();
	}

	#echo "</br> Username=" . $username;
	#echo "</br> Password=" . $password;

	$query = "SELECT password from users where username=". $username;
	$resultSet = $dbConnection->query($query);
	if ($resultSet && $resultSet->num_rows > 0) 
	{
		$row = $resultSet->fetch_row();
		#echo "</br> pwd=" . $row['0'];
		if ($password == $row['0'])
		{
			echo "</br> Login was successful";
		}
		else
		{
			echo "</br> Invalid password";
		}

		$resultSet->close();
	}
	else
	{
		echo "</br> User not found";
		echo "</br> <a href=\"register.php\">Click here register</a>";
	}
	
	$dbConnection->close();
}
?>