<?php
	$servername = "mysql:host=localhost;dbname=ds_estate";
	$username = "root";
	$password = "";

	try{
		$conn = new PDO($servername, $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents('php://input'), true);
    
            $listing_id = $_POST['listing_id'];
            $start_date = $_POST['start_date'];
            $finish_date = $_POST['finish_date'];
    
            try{
                $sql = "SELECT * FROM reservation WHERE listing_id = :listing_id AND (start_date <= :finish_date AND finish_date >= :start_date)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':listing_id', $listing_id);
                $stmt->bindParam(':start_date', $start_date);
                $stmt->bindParam(':finish_date', $finish_date);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($stmt->rowCount() > 0) {
                    $dates=[];
                    foreach ($result as $user) {
                        $dates[] = $user['start_date'] . " - " . $user['finish_date'];
                        
                    }
                    $message = "The property is not available for the selected dates: " . implode(", ", $dates);

                    echo json_encode([
                        "status" => "failure",
                        "message" => $message
                    ]);
                } 
                else {    
                    echo json_encode([
                        "status" => "success",
                        "message" => "The property is  available for the selected dates."
                    ]);
                }
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