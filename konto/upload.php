<?php
		include '../session.php';

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $path = '../media/avatary/'; // upload directory
        if($_FILES['image'])
        {
        	$username = $_SESSION['username'];


            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            // get uploaded file's extension
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            // can upload same image using rand function
            $final_image = rand(1000,1000000).".".$ext;
            // check's valid format
            if(in_array($ext, $valid_extensions)) 
            { 
                $path = $path.strtolower($final_image); 
                move_uploaded_file($tmp,$path);
            } 
            else 
            {
            	echo 'invalid';
            }

            if($errorimg > 0)
	        {
	           die('<div class="alert alert-danger" role="alert"> An error occurred while uploading the file </div>');
	        }
	        else

	        if($myFile['size'] > 500000)
	        {
	            die('<div class="alert alert-danger" role="alert"> File is too big </div>');
	        }

	        $avatar = "https://aleciacho.eu/media/avatary/".$final_image;

	        $sql = "UPDATE Klienci SET avatar = '$avatar' WHERE login = '$username'";

	        mysqli_query($conn, $sql) or die("Błąd." . mysqli_error($conn));
        }
?>