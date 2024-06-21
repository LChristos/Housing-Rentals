<?php
	$servername = "mysql:host=localhost;dbname=ds_estate";
	$username = "root";
	$password = "";

	try{
		$conn = new PDO($servername, $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

        if ($_SERVER["REQUEST_METHOD"] == "POST") {    
            $listing_id = $_POST['listing_id'];
            $start_date = $_POST['start_date'];
            $finish_date = $_POST['finish_date'];
            $fname= $_POST['user_name'];
			$surname = $_POST['surname'];
			$email = $_POST['email'];
            $amount = $_POST['amount'];
    
            try{
                $sql = "INSERT INTO reservation (listing_id, user_name , user_surname, email,start_date, finish_date, amount)
                VALUES (:listing_id, :fname, :surname, :email,:start_date, :finish_date , :amount)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':listing_id', $listing_id);
                $stmt->bindParam(":fname" , $fname);
				$stmt->bindParam(':surname', $surname);
				$stmt->bindParam(':email', $email);
                $stmt->bindParam(':start_date', $start_date);
                $stmt->bindParam(':finish_date', $finish_date);
                $stmt->bindParam(':amount', $amount);
                $stmt->execute();

				echo json_encode(
					["status" => "success",
					"message" => "New reservation"]
				);
                $conn = null;
				$stmt = null;
            }
            catch (PDOException $e) {
				echo json_encode(
					["status" => "error",
					"message" => "DATABASE ERROR" . $e->getMessage()]
				);
			}
        }
    }
	catch(PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Connection failed: " . $e->getMessage()
        ]);
	}
?>