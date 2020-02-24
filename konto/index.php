<?php
    include __DIR__ . '/../session.php';

    $username = $_SESSION["username"];
    $sql = "SELECT * FROM Klienci WHERE login='".$username."';";

    mysqli_query($conn, $sql);

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nazwisko = $row["nazwisko"];
    $imie = $row["imie"];
    $adres = $row["adres"];
    $kodpocztowy = $row["kodpocztowy"];
    $miasto = $row["miasto"];
    $telefon = $row["telefon"];
    $email = $row["email"];
    $avatar = $row["avatar"];

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["zmiana"]))
    {
        $nazwisko = $_POST["nazwisko"];
        $imie = $_POST["imie"];
        $adres = $_POST["adres"];
        $kodpocztowy = $_POST["kodpocztowy"];
        $miasto = $_POST["miasto"];
        $telefon = $_POST["telefon"];
        $email = $_POST["email"];

        $sql = "UPDATE Klienci SET nazwisko='".$nazwisko."', imie='".$imie."', adres='".$adres."', kodpocztowy='".$kodpocztowy."', miasto='".$miasto."', telefon='".$telefon."', email='".$email."' WHERE login='".$username."';";

        mysqli_query($conn, $sql);
    }
 
?>
<!DOCTYPE html>
<html lang="pl-PL">
<?php
    require_once __DIR__ . '/../head.php';
?>
<body>

<?php
    require_once __DIR__ . '/../navbar.php';
?>
<div class="flex-container okruszki">
    <div class="row">
        <div class="col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $domain; ?>">Strona główna</a></li>
                <li class="breadcrumb-item active">Moje konto</li>
            </ol>
        </div>
    </div>
</div>
<div class="flex-container">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8">
            <div class="row">
                <div class="col-12">
                    <img src="<?php echo $avatar ?>" class="user-avatar">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 form-group">
                    <form id="wgraj" method="POST" enctype="multipart/form-data">
                        <input type="file" class="form-control" accept="image/*" name="image" id="image">
                        <input type="submit" class="form-control click pink" value="Prześlij">
                    </form>
                    <div id="err"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 order-1">
                    <h4 style="text-align: center;">Dane kontaktowe</h4>
                    <?php
                    if(is_null($imie)) echo '
                    <div class="card">
                        <div class="card-body">
                            <form id="dodaj_adres">
                                <input type="text" id="imie_input" class="form-control" name="imie" placeholder="Imię" required><input type="text" id="nazwisko_input" class="form-control" name="nazwisko"  placeholder="Nazwisko" required>
                                <input type="text" id="adres_input" class="form-control" name="adres" placeholder="Adres" required>
                                <input type="text" id="kod_input" class="form-control" name="kodpocztowy" placeholder="Kod pocztowy" required><input type="text" id="miasto_input" class="form-control" name="miasto" placeholder="Miasto" required>
                                <input type="text" id="telefon_input" class="form-control" name="telefon" placeholder="Telefon" required><br>
                                <input type="submit" id="zapisz_adres" class="card-link" value="Zapisz dane">
                            </form>
                        </div>
                    </div>';
                    else echo '
                    <div class="card">
                        <div class="card-body">
                            <form id="dane_adresata" method="post">
                                <p id="imie_nazwisko" class="card-text">'.$imie.' '.$nazwisko.'</p>
                                <input type="text" id="imie_input" class="form-control" name="imie" value="'.$imie.'" placeholder="Imię" required><input type="text" id="nazwisko_input" class="form-control" name="nazwisko" value="'.$nazwisko.'" placeholder="Nazwisko" required>
                                <p id="adres" class="card-text">'.$adres.'</p>
                                <input type="text" id="adres_input" class="form-control" name="adres" value="'.$adres.'" placeholder="Adres" required>
                                <p id="kod_miasto" class="card-text">'.$kodpocztowy.' '.$miasto.'</p>
                                <input type="text" id="kod_input" class="form-control" name="kodpocztowy" value="'.$kodpocztowy.'" placeholder="Kod pocztowy" required><input type="text" id="miasto_input" class="form-control" name="miasto" value="'.$miasto.'" placeholder="Miasto" required>
                                <p id="telefon" class="card-text">'.$telefon.'</p>
                                <input type="text" id="telefon_input" class="form-control" name="telefon" value="'.$telefon.'" placeholder="Telefon" required><br>
                                <a id="edytuj_adres" href="#" class="card-link">Edytuj adres</a>
                                <input type="submit" id="zapisz_adres" class="card-link" value="Zapisz dane">
                            </form>
                        </div>
                    </div>';
                    ?>
                </div>
                <div class="col-12 col-sm-6 order-2">
                    <h4 style="text-align: center;">Moje zakupy</h4>
                    <div class="card">
                        <div class="card-body">
                            

                            <?php
                                $sql = 'SELECT * FROM Transakcje WHERE login = "'.$username.'";';
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result);
                                if($count == 0) {
                                    echo '<p>Brak transakcji do wyświetlenia</p>';
                                } else {
                                    echo '
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ID transakcji</th>
                                                <th scope="col">Data</th>
                                            </tr>
                                        </thead>
                                    <tbody>';
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $nr_transakcji = $row['nr_transakcji'];
                                        $data = $row['data'];

                                        echo '
                                        <tr>
                                            <th>'.$i++ .'</th>
                                            <td><a href="'.$domain.'ocena/?transakcja='.$nr_transakcji.'"  target="_blank">'.$nr_transakcji.'</a></td>
                                            <td>'.$data.'</td>
                                        </tr>';
                                    }
                                }
                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
</div>


<?php require_once('../footer.php'); ?>

<script>
    $(document).ready(function(e){
        $('h4').css('margin-top', '35px');
        $('.card').css('text-align', 'center');
        $('#wgraj').hide().css('margin-top', '35px');
        var avatarEdit = 0;

        $('.user-avatar').click(function(){
            if(avatarEdit == 0) {
                $('#wgraj').show('slow');
                avatarEdit = 1;
            } else {
                $('#wgraj').hide('slow');
                avatarEdit = 0;
            }
        });

        $('#dodaj_adres').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'zapisz_adresata.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false
            }).done(function(){
                window.location.reload(true);
            });
        });

        $('#dane_adresata > input').hide();

        $('#edytuj_adres').click(function () {
            $('#dane_adresata > input').show('slow');
            $('#dane_adresata > p').hide('slow');
            $('#zapisz_adres').show('slow');
            $(this).hide('slow');
        });

        $('#dane_adresata').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'zapisz_adresata.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false
            }).done(function(){
                window.location.reload(true);
            });

            $('#dane_adresata > input').hide('slow');
            $('#dane_adresata > p').show('slow');
            $('#edytuj_adres').show('slow');
            $('#zapisz_adres').hide('slow');
            $('#zapisz_adres_jednorazowy').hide('slow');
        });

        $("#wgraj").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: "upload.php",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend : function()
                {
                    $("#err").fadeOut();
                },
                success: function(data)
                {
                    if(data == 'invalid')
                    {
                        $("#err").html("Nieprawidłowy format pliku!").fadeIn();
                    }
                },
                error: function(e) 
                {
                    $("#err").html(e).fadeIn();
                }          
            });

        }));
    });
</script>

</body>
</html>