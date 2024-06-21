<?php
	$servername = "mysql:host=localhost;dbname=ds_estate";
	$username = "root";
	$password = "";

	try{
		$conn = new PDO($servername, $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

		if ($_SERVER["REQUEST_METHOD"] == "POST"){

			$username = $_POST['username'];
			$password = $_POST['password'];

			try{
				$sql = "SELECT id, username , password FROM users";

				$stmt = $conn->prepare($sql);
				$stmt->execute();

				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$status = false;
				foreach ($result as $user) {
					if ($username == "$user[username]" && $password == "$user[password]"){
						$status = true;
					}
					
				}

				if ($status){
					setcookie("user_id", $user['id'], time() + (86400 * 30), "/");
					echo json_encode(
						["status" => "success",
						"message" => "Successful Login."]
					);
				}
				else{//Difference between password and username error
					echo json_encode(
						["status" => "failure",
						"message" => "Λάθος όνομα χρήστη ή κωδικός πρόσβασης."]
					);
				}
				$conn = null;//?
				$stmt = null;

			}
			catch (PDOException $e) {
				echo json_encode(
					["status" => "error",
					"message" => $e->getMessage()]
				);
			}
		}
    }
    catch(PDOException $e) {
        echo "Connection failed: " - $e->getMessage();
    }
?>