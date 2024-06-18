<?php
	$servername = "mysql:host=localhost;dbname=ds_estate";
	$username = "root";
	$password = "";

	try{
		$conn = new PDO($servername, $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

		if ($_SERVER["REQUEST_METHOD"] == "POST"){

			$fname= $_POST['user_name'];
			$surname = $_POST['surname'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];

			try{
				$sql = "INSERT INTO users (user_name , surname , username , password , email) VALUES (:fname, :surname, :username, :password, :email)";
				$stmt = $conn->prepare($sql);

				$stmt->bindParam(":fname" , $fname);
				$stmt->bindParam(':surname', $surname);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':email', $email);

				$stmt->execute();
				echo json_encode(
					["status" => "success",
					"message" => "New user registered"]
				);
				$conn = null;
				$stmt = null;
			}
			catch (PDOException $e){
				if ($e->getCode() == 23000) {// difference between username and email
					echo json_encode([
						"status" => "error",
						"message" => "Username or email already exists."]
					);
					//echo '<script type="text/javascript">alert("Error: ' .$e->getMessage()  . '");</script>';
				} else {
					return json_encode(
						["status" => "error",
						"message" => "Registration failed: " . $e->getMessage()]
					);
				}
			}
		}
	}
	catch(PDOException $e) {
		echo "Connection failed: " - $e->getMessage();
	}
?>
