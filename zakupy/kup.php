<?php
    include __DIR__ . '/../session.php';

    function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

    $nr_transakcji = generateRandomString(7);

    $imie = $_POST['FinImie'];
    $nazwisko = $_POST['FinNazwisko'];
    $adres = $_POST['FinAdres'];
    $kodpocztowy = $_POST['FinKod'];
    $miasto = $_POST['FinMiasto'];
    $telefon = $_POST['FinTelefon'];
    $dostawa = $_POST['FinDostawa'];
    $platnosc = $_POST['FinPlatnosc'];

    $login = $_SESSION["username"];

    $sql = "INSERT INTO Transakcje (nr_transakcji, login, dostawa, platnosc, data)
VALUES ('".$nr_transakcji."', '".$login."', '".$dostawa."', '".$platnosc."', NOW())";
    mysqli_query($conn,$sql);

    $sql = "SELECT data FROM Transakcje WHERE nr_transakcji = '".$nr_transakcji."';";
    mysqli_query($conn,$sql);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data = $row['data'];


    $sql = "INSERT INTO Adresaci (imie, nazwisko, adres, kodpocztowy, miasto, telefon, nr_transakcji)
VALUES ('".$imie."', '".$nazwisko."', '".$adres."', '".$kodpocztowy."', '".$miasto."', '".$telefon."', '".$nr_transakcji."', )";
    mysqli_query($conn,$sql);


    $sql = "SELECT * FROM Koszyk WHERE login='".$login."'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $ilosc = $row["ilosc"];
        $id_towaru = $row["id_towaru"];

        $sql2 = "INSERT INTO Szczegoly_transakcji (id_towaru, ilosc, nr_transakcji) VALUES (".$id_towaru.", ".$ilosc.", '".$nr_transakcji."')";
        mysqli_query($conn, $sql2);

        $sql3 = "UPDATE Magazyn SET dostepnosc = dostepnosc - ".$ilosc." WHERE id_towaru = ".$id_towaru.";";
        mysqli_query($conn, $sql3);

        $sql4 = "UPDATE Magazyn SET sprzedanych = sprzedanych + ".$ilosc." WHERE id_towaru = ".$id_towaru.";";
        mysqli_query($conn, $sql4);
    }

    $sql = "DELETE FROM Koszyk WHERE login = '".$login."';";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT email FROM Klienci WHERE login = '".$login."';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];

    $subject = "Potwierdzenie zamówienia z aleciacho.eu";
    $text = "
    <html>
    <head>
    <title>Potwierdzenie zamówienia z aleciacho.eu</title>
    <style>
    .centered {
        text-align: center;
    }
    </style>
    </head>
    <body>
    <div class='centered'>
    <h1>Cześć, ".$imie."!</h1>
    <p>W dniu ".$data." kupiłeś następujące produkty:</p> 
    </div>
    <div>
    <table>
    <thead>
    <tr>
    <th id='grafika'></th>
    <th id='nazwa'></th>
    <th id='ilosc'></th>
    <th id='koszt'></th>
    </tr>
    </thead>
    <tbody>";

    $sql = "SELECT * FROM Szczegoly_transakcji
    JOIN Towary ON Towary.id = Szczegoly_transakcji.id_towaru
    JOIN Opisy ON Opisy.id_towaru = Szczegoly_transakcji.id_towaru
    WHERE nr_transakcji = '".$nr_transakcji."';";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $ilosc = $row["ilosc"];
        $nazwa = $row["nazwa"];
        $cena = $row["cena"];
        $suma = $cena * $ilosc;
        $grafika = $row['grafika'];

        $text .= "
        <tr>
        <td><img style='width: 12vh;' src='".$grafika."'></td>
        <td>".$nazwa."</td>
        <td style='width: fit-content; padding-left: 10%;'>".$ilosc." szt.</td>
        <td style='width: fit-content; padding-left: 10%;'><strong>".$suma." zł</strong></td>
        </tr>";
    }

    $text .= "
    <h3><strong>Sposób dostawy:</strong></h3>
    <tr>
    <th id='sposob_dostawy'></th>
    <th id='koszt_dostawy'</th>
    </tr>
    <tr>
    <td>".$dostawa."</td>
    <td></td>
    </tr>";




    $text .= "
    </tbody>
    </table>
    </div>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <aleciacho.eu>" . "\r\n";

    mail("$email", "$subject", "$text", "$headers");


?>