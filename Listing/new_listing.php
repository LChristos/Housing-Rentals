<?php
	$servername = "mysql:host=localhost;dbname=ds_estate";
	$username = "root";
	$password = "";

	try{
		$conn = new PDO($servername, $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
            $targetDir = "../images/"; 
            $targetFile = $targetDir . basename($_FILES["photo"]["name"]); 
            move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
          
            $title = $_POST['title'];
            $region = $_POST['region'];
            $room = $_POST['room'];
            $price = $_POST['price'];
    
            try{
                $sql = "INSERT INTO listing (photo, title, region, room, price  ) VALUES ( :targetFile, :title, :region, :room, :price)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':targetFile', $targetFile);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':region', $region);
                $stmt->bindParam(':room', $room);
                $stmt->bindParam(':price', $price);
                $stmt->execute();

                echo json_encode(
					["status" => "success",
					"message" => "Η αγγελία δημιουργήθηκε επιτυχώς!"]
				);

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