<?php
		include '../session.php';

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
        $path = '../media/produkty/'; // upload directory
        
        $nazwa = $_POST['nazwa'];
        $kategoria = $_POST['kategoria'];
        $waga = $_POST['waga'];
        $alergeny = $_POST['alergeny'];
        $cena = $_POST['cena'];
        $max = $_POST['max'];
        $opis = $_POST['opis'];

        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];
        $errorimg = $_FILES['image']['error'];

        if($errorimg > 0)
        {
           die('<div class="alert alert-danger" role="alert">Podczas przesyłania pliku wystąpił błąd.</div>');
        }

        if($size > 2097152)
        {
            die('<div class="alert alert-danger" role="alert">Plik za duży.</div>');
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
        } 
        else 
        {
            die('Nieprawidłowy format pliku.');
        }    

        $sql1 = "INSERT INTO Towary (nazwa, kategoria, cena) VALUES ('".$nazwa."','".$kategoria."',".$cena.")";

        if(mysqli_query($conn, $sql1))
        {
            $id_towaru = mysqli_insert_id($conn);
        }
        else
        {
            echo "Błąd: " . mysqli_error($conn);
        }

        $sql2 = "INSERT INTO Opisy (id_towaru, opis, waga, alergeny, grafika) VALUES (".$id_towaru.",'".$opis."',".$waga.",'".$alergeny."','".$produkt."')";

        $sql3 = "INSERT INTO Magazyn (id_towaru, dostepnosc, sprzedanych) VALUES (".$id_towaru.",".$max.", 0)";

        mysqli_query($conn, $sql2) or die("Błąd: " . mysqli_error($conn));
        mysqli_query($conn, $sql3) or die("Błąd: " . mysqli_error($conn));
        
        mysqli_close($conn);
?>