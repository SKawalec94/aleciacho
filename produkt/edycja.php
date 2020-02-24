<?php
		include '../session.php';

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $path = '../media/produkty/'; // upload directory
        
        $id = $_SESSION['pid'];
        $nazwa = $_POST['nazwa'];
        $kategoria = $_POST['kategoria'];
        $waga = $_POST['waga'];
        $alergeny = $_POST['alergeny'];
        $cena = $_POST['cena'];
        $max = $_POST['max'];
        $opis = $_POST['opis'];

        $sql = "";

            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];
            $errorimg = $_FILES['image']['error'];

            if($size != 0)
            {
                if($errorimg > 0)
                {
                   die('<div class="alert alert-danger" role="alert"> An error occurred while uploading the file </div>');
                }

                if($size > 2097152)
                {
                    die('<div class="alert alert-danger" role="alert"> File is too big </div>');
                }

                // get uploaded file's extension
                $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                // can upload same image using rand function
                $final_image = rand(1000000,1000000000).".".$ext;
                // check's valid format
                if(in_array($ext, $valid_extensions)) 
                { 
                    $path = $path.strtolower($final_image); 
                    move_uploaded_file($tmp,$path);

                    $produkt = $domain."media/produkty/".$final_image;
                    $sql = "UPDATE Opisy SET grafika = '$produkt' WHERE id_towaru = $id";
                    mysqli_query($conn, $sql) or die("Błąd: " . mysqli_error($conn));
                } 
                else 
                {
                    echo 'invalid';
                }
            }

	    $sql1 = "UPDATE Opisy SET opis = '".$opis."', waga = ".$waga.", alergeny = '".$alergeny."' WHERE id_towaru = ".$id;
        $sql2 = "UPDATE Towary SET nazwa = '".$nazwa."', kategoria = '".$kategoria."', cena = ".$cena." WHERE id = ".$id;
        $sql3 = "UPDATE Magazyn SET dostepnosc = ".$max." WHERE id_towaru = ".$id;

        mysqli_query($conn, $sql1) or die("Błąd: " . mysqli_error($conn));
        mysqli_query($conn, $sql2) or die("Błąd: " . mysqli_error($conn));
        mysqli_query($conn, $sql3) or die("Błąd: " . mysqli_error($conn));
        
        mysqli_close($conn);
?>