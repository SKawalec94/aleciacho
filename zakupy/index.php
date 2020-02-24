<?php
include '../session.php';

if($_SESSION['log_state'] == 0) header("Location: $domain");
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
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $domain; ?>">Strona główna</a></li>
                <li class="breadcrumb-item active">Dostawa i płatność</li>
            </ol>
        </div>
    </div>
</div>

<div class="flex-container">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8" style="display: -webkit-inline-flex; text-align: center;">
            <div id="Ldostawa" class="col-4">Dostawa</div>
            <div id="Lplatnosc" class="col-4">Płatność</div>
            <div id="Lpodsumowanie" class="col-4">Podsumowanie</div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8">
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
</div>

<div class="flex-container">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8 dostawa">
            <h2>Sposób dostawy</h2>
            <div class="card" style="width: 20rem;">
                <div id="SposobDostawy" class="card-body">
                    <?php
                    $sql = "SELECT * FROM Dostawa";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $id = $row['id'];
                        $typ = $row['typ'];
                        $koszt = $row['koszt'];

                        echo
                        '<div class="form-check">
                            <input type="radio" class="form-check-input" name="sposob_dostawy" id="dostawa'.$id.'" value="'.strtolower(str_replace(" ", "_", $typ)).'" checked>
                            <label class="form-chceck-label" for="dostawa1">'.$typ.' ('.$koszt.' zł)</label>
                        </div>
                        ';
                    }
                    ?>
                </div>
            </div>

            <h2>Adres dostawy</h2>
            <?php
            $sql = "SELECT * FROM Klienci WHERE login='".$_SESSION['username']."'";
            if($result = mysqli_query($conn, $sql)) {
                $row = mysqli_fetch_assoc($result);
                $imie = $row['imie'];
                $nazwisko = $row['nazwisko'];
                $adres = $row['adres'];
                $kodpocztowy = $row['kodpocztowy'];
                $miasto = $row['miasto'];
                $telefon = $row['telefon'];
            }

            echo '
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
                        <input type="submit" id="zapisz_adres" class="card-link" value="Zapisz jako domyślny adres dostawy">
                        <a id="zapisz_adres_jednorazowy" class="click">Zapisz adres dostawy</a>
                    </form>
                </div>
            </div>
            ';

            ?>
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-12 col-sm-4">
                    <input id="to_payment" type="button" class="form-control pink click" value="Wybierz sposób płatności">
                </div>
            </div>

        </div>
        <div class="col-12 col-md-10 col-lg-8 platnosc">
            <h2>Sposób dostawy</h2>
            <h6 class="mb-6 muted">Obecnie przelew tradycyjny jest jedyną obsługiwaną metodą płatności</h6>
            <?php
            $sql = "SELECT * FROM Platnosc";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result))
            {
                $id = $row['id'];
                $typ = $row['typ'];
                $typ2 = $row['typ2'];
                $koszt = $row['koszt'];

                echo
                '<div class="card">
                    <div class="card-body">
                        <h5 class="card-title">'.$typ2.'</h5>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="sposob_platnosci" id="platnosc'.$id.'" value="'.strtolower(str_replace(" ", "_", $typ)).'" checked>
                            <label class="form-chceck-label" for="platnosc'.$id.'">'.$typ.' ('.$koszt.' zł)</label>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-12 col-sm-4">
                    <input id="to_summary" type="button" class="form-control pink click" value="Przejdź do podsumowania">
                </div>
            </div>

        </div>
        <div class="col-12 col-md-10 col-lg-8 podsumowanie">
            <div class="card">
                <h5 class="card-header">Wybrane produkty</h5>
                <div class="card-body">
                    <table id="produkty" class="table table-sm">
                        <thead>
                            <tr>
                                <th class="row_id" scope="col" hidden>#</th>
                                <th scope="col" style="width: 1px;"></th>
                                <th scope="col" style="padding:0px;"></th>
                                <th scope="col">Nazwa</th>
                                <th scope="col" hidden="hidden">Cena</th>
                                <th scope="col" style="min-width: 15vw;">Ilość</th>
                                <th scope="col">Suma</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $login = $_SESSION["username"];
                        $sql = "SELECT * FROM Koszyk
                                JOIN Towary ON Towary.id = Koszyk.id_towaru
                                JOIN Opisy ON Opisy.id_towaru = Koszyk.id_towaru
                                JOIN Magazyn ON Magazyn.id_towaru = Koszyk.id_towaru
                                WHERE login ='".$login."'";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                        $laczneKoszty = 0;

                        while($row = mysqli_fetch_assoc($result))
                        {
                            $nazwa = $row["nazwa"];
                            $cena = $row["cena"];
                            $ilosc = $row["ilosc"];
                            $suma = $cena * $ilosc;
                            $id_towaru = $row["id_towaru"];
                            $grafika = $row["grafika"];
                            $dostepnosc = $row["dostepnosc"];

                            echo
                                '<tr>
                                    <th class="row_id" scope="row" hidden>'. $i++ .'</th>
                                    <td><img class="miniaturka" src="'.$grafika.'"></td>
                                    <td><input type="hidden" id="idT" value="'.$id_towaru.'" style="padding: 0px;"></td>
                                    <td class="nazwaProduktu"><a href='.$domain.'"produkt/?pid='.$id_towaru.'">'.$nazwa.'</a></td>
                                    <td hidden="hidden"><a id="cena">'.$cena.'</a> zł</td>
                                    <td class="ile non-selective">
                                        <p><a id="ilosc">'.$ilosc.'</a> szt.</p>
                                    </td>
                                    <td><a id="suma">'.$suma.'</a> zł</td>
							    </tr>';
                            $laczneKoszty += $suma;
                        }
                        $_SESSION["ile_w_koszyku"] = $i;

                        ?>
                        <tr style="background-color: #ff63b187;">
                            <th hidden></th>
                            <td><strong>RAZEM</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td id="ProduktyRazem"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <h5 class="card-header">Koszty dostawy</h5>
                <div class="card-body">
                    <table id="koszty_dostawy" class="table table-sm">
                        <thead>
                            <th class="row_id" scope="col" hidden>#</th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Koszt</th>
                        </thead>
                        <tbody>
                            <tr id="Dostawa">
                                <th hidden></th>
                                <td id="JakaDostawa"></td>
                                <td id="DostawaRazem"></td>
                            </tr>
                            <tr id="Platnosc">
                                <th hidden></th>
                                <td id="JakaPlatnosc"></td>
                                <td id="PlatnoscRazem"></td>
                            </tr>
                            <tr style="background-color: #ff63b187;">
                                <th hidden></th>
                                <td><strong>RAZEM</strong></td>
                                <td id="DodatkoweRazem"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-12 col-sm-4">
                    <form id="zamowienie">
                        <input type="hidden" name="FinImie" value="">
                        <input type="hidden" name="FinNazwisko" value="">
                        <input type="hidden" name="FinAdres" value="">
                        <input type="hidden" name="FinKod" value="">
                        <input type="hidden" name="FinMiasto" value="">
                        <input type="hidden" name="FinTelefon" value="">
                        <input type="hidden" name="FinDostawa" value="">
                        <input type="hidden" name="FinPlatnosc" value="">
                        <h3 style="margin-bottom: -10px; margin-top: 30px; text-align: -webkit-right;"><strong>Razem: <a id="LaczneKoszty"></a></strong></h3>
                        <input id="finish" type="sumbit" class="form-control pink click" value="Złóż zamówienie" readonly>
                    </form>
                </div>
            </div>
        </div>
            <div class="col-12 col-md-10 col-lg-8 potwierdzenie">
                <h3 style="margin-top: 30px;"><strong>Twoje zamówienie zostało złożone.</strong></h3>
                <p>Dodatkowe informacje, w tym dane do przelewu, wysłaliśmy do Ciebie w wiadomości email.</p>
                <input id="complete" class="form-control pink click" value="Wróć do strony głównej" readonly>
            </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
</div>



<?php
require_once('../footer.php');
?>

<script>
    $(document).ready(function () {

        function zapisanieAdresata(){
            $('p#imie_nazwisko').text($('#imie_input').val() + ' ' + $('#nazwisko_input').val());
            $('p#adres').text($('#adres_input').val());
            $('p#kod_miasto').text($('#kod_input').val() + ' ' + $('#miasto_input').val());
            $('p#telefon').text($('#telefon_input').val());
            $('#to_payment').prop('disabled', false);
        }



        $('#dane_adresata > input').hide();
        $('#zapisz_adres').hide();
        $('#zapisz_adres_jednorazowy').hide();
        $('.potwierdzenie').hide();

        $('.platnosc').hide();
        $('.podsumowanie').hide();
        $('#Ldostawa').css('font-weight', 'bold');

        $('#to_payment').click(function () {
            $('.dostawa').hide('slow');
            $('.platnosc').show('slow');
            $('.progress-bar').attr('aria-valuenow', '67').css('width', '67%');
            $('#Ldostawa').css('font-weight', 'normal');
            $('#Lplatnosc').css('font-weight', 'bold');
        });

        $('#to_summary').click(function () {
            let sposobPlatnosciID = $('input[name=sposob_platnosci]:checked', '.platnosc').attr('id');
            sposobPlatnosciID = parseInt(sposobPlatnosciID.replace ( /[^\d.]/g, '' ), 10);

            let sposobDostawyID = $('input[name=sposob_dostawy]:checked', '.dostawa').attr('id');
            sposobDostawyID = parseInt(sposobDostawyID.replace ( /[^\d.]/g, '' ), 10);

            var sposobPlatnosciKoszt;
            var sposobPlatnosci;
            var sposobDostawyKoszt;
            var sposobDostawy;
            var razemDostawa = 0;

            function callback1(response) {
                var platnosciArray = response.split(",");
                sposobPlatnosci = platnosciArray[0];
                sposobPlatnosciKoszt = parseInt(platnosciArray[2], 10);
                $('#JakaPlatnosc').text(sposobPlatnosci);
                $('#PlatnoscRazem').text(sposobPlatnosciKoszt + ' zł');
            }
            function callback2(response) {
                var dostawaArray = response.split(",");
                sposobDostawyKoszt = parseInt(dostawaArray[1], 10);
                sposobDostawy = dostawaArray[0];
                $('#JakaDostawa').text(sposobDostawy);
                $('#DostawaRazem').text(sposobDostawyKoszt + ' zł');
            }

            $.ajax({
                url: 'dostawa_platnosc.php',
                type: 'POST',
                async: false,
                data: {"sposobPlatnosciID": sposobPlatnosciID},
                success: callback1,
            });

            $.ajax({
                url: 'dostawa_platnosc.php',
                type: 'POST',
                async: false,
                data: {"sposobDostawyID": sposobDostawyID},
                success: callback2,
            });

            var razemProdukty = <?php echo $laczneKoszty; ?>;
            razemDostawa = sposobPlatnosciKoszt + sposobDostawyKoszt;
            var platnoscRazem = $('#PlatnoscRazem').text();
            var dostawaRazem = $('#DostawaRazem').text();

            $('#ProduktyRazem').text(razemProdukty + ' zł').css('font-weight', 'bold');
            $('#DodatkoweRazem').text(razemDostawa + ' zł').css('font-weight', 'bold');

            $('.platnosc').hide('slow');
            $('.podsumowanie').show('slow');
            $('.progress-bar').attr('aria-valuenow', '100').css('width', '100%');
            $('#Lplatnosc').css('font-weight', 'normal');
            $('#Lpodsumowanie').css('font-weight', 'bold');

            let rowsNumProdukty = $('#produkty >tbody >tr:not(:last-child)').length;
            let rowsNumDostawa = $('#koszty_dostawy >tbody >tr:not(:last-child)').length;
            const tableProdukty = $('#produkty tbody')[0];
            const tableDostawa = $('#koszty_dostawy tbody')[0];

            let LaczneKoszty = razemDostawa + razemProdukty;
            $('#LaczneKoszty').text(LaczneKoszty + ' zł');


            $('#zamowienie > input[name=FinImie]').val($('#imie_input').val());
            $('#zamowienie > input[name=FinNazwisko]').val($('#nazwisko_input').val());
            $('#zamowienie > input[name=FinAdres]').val($('#adres_input').val());
            $('#zamowienie > input[name=FinKod]').val($('#kod_input').val());
            $('#zamowienie > input[name=FinMiasto]').val($('#miasto_input').val());
            $('#zamowienie > input[name=FinTelefon]').val($('#telefon_input').val());
            $('#zamowienie > input[name=FinDostawa]').val(sposobDostawy);
            $('#zamowienie > input[name=FinPlatnosc]').val(sposobPlatnosci);


            });

        $('#edytuj_adres').click(function () {
            $('#to_payment').prop('disabled', true);
            $('#dane_adresata > input').show('slow');
            $('#dane_adresata > p').hide('slow');
            $('#zapisz_adres').show('slow');
            $('#zapisz_adres_jednorazowy').show('slow');
            $(this).hide('slow');
        });

        $('#dane_adresata').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'edytuj_adres.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    zapisanieAdresata();
                }
            });

            $('#dane_adresata > input').hide('slow');
            $('#dane_adresata > p').show('slow');
            $('#edytuj_adres').show('slow');
            $('#zapisz_adres').hide('slow');
            $('#zapisz_adres_jednorazowy').hide('slow');
        });

        $('#zapisz_adres_jednorazowy').click(function () {
           zapisanieAdresata();

            $('#dane_adresata > input').hide('slow');
            $('#dane_adresata > p').show('slow');
            $('#edytuj_adres').show('slow');
            $('#zapisz_adres').hide('slow');
            $('#zapisz_adres_jednorazowy').hide('slow');
        });

        $('#finish').click(function () {
            $(this).trigger('submit');
        })

        $('form#zamowienie').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'kup.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    $('#finish').prop('disabled', true);
                    $('.podsumowanie').hide('slow');
                    $('.potwierdzenie').show('slow');
                }
            });
        });

        $("#complete").click(function(){
            location.replace("<?php echo $domain; ?>");
        });

    });
</script>
