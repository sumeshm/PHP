<html>
	<head>
		<title>My first PHP website</title>
	</head>
	<body>
		<?php
			echo "<p>Hello World!</p>";
		?>
		<a href="login.php">Click here to login</a> <br/>
		<a href="register.php">Click here to register</a>
	</body>
	<br/>
	<h2 align="center">List</h2>
	<table width="100%" border="1px">
			<tr>
				<th>Id</th>
				<th>Username</th>
			</tr>
			<?php
				$dbConnection = new mysqli("localhost", "root", "root", "funstuff_db");
				if (mysqli_connect_errno())
				{
					echo "Connect failed: ". mysqli_connect_error();
					exit();
				}

				$query = "SELECT * from users";

				if ($resultSet = $dbConnection->query($query))
				{
					while ($row = $resultSet->fetch_row()) {
						echo "<tr>";
						echo '<td align="center">'. $row[0] . "</td>";
						echo '<td align="center">'. $row[1] . "</td>";
						echo "</tr>";
					}

					$resultSet->close();
				}
				
				$dbConnection->close();
			?>
	</table>

		<?php
			echo "</br><h2> Print rows with 'fetch_assoc' </h2>";

			$dbConnection = new mysqli("localhost", "root", "root", "funstuff_db");
			if (mysqli_connect_errno())
			{
				echo "</br> Connect failed: ". mysqli_connect_error();
				exit();
			}
			echo "</br>";

			$query = "SELECT * from users";
			$resultSet = $dbConnection->query($query);
			if ($resultSet->num_rows > 0) {
				// output data of each row
				while($row = $resultSet->fetch_assoc()) {
					echo "id: " . $row["id"]. " -> Name: " . $row["username"]. "<br>";
				}
				
				$resultSet->close();
			} else {
				echo "0 results";
			}
			
			$dbConnection->close();
			
			interface iService
			{
				public function doService($serviceName);
			}
			
			class ServiceProvider implements iService
			{
				private $name = "Airtel";
				
				public function __construct()
				{
					echo "</br> You have created service provider - { $this->name} ";
				}
				
				public function doService($serviceName)
				{
					echo "</br> { $this->name} - performing  a service - {$serviceName}";
				}
			}
			
			$airtel = new ServiceProvider();
			$airtel->doService("Record");
			
		?>	
</html>