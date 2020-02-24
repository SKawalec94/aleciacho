<?php
	include '../session.php';
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
                <li class="breadcrumb-item active">Koszyk</li>
            </ol>
        </div>
    </div>
</div>

<div class="flex-container">
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div class="col-12 col-md-10 col-lg-8">
            <div class="table-responsive table-koszyk">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="display: none;" class="row_id" scope="col">#</th>
                            <th scope="col" style="width: 1px;"></th>
                            <th scope="col" style="padding:0px;"></th>
                            <th scope="col">Nazwa</th>
                            <th scope="col" hidden="hidden">Cena</th>
                            <th scope="col" style="min-width: 35vw;">Ilość</th>
                            <th scope="col">Koszt</th>
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
                                    <th style="display: none;"class="row_id" scope="row">'. $i++ .'</th>
                                    <td><img class="miniaturka" src="'.$grafika.'"></td>
                                    <td><input type="hidden" id="idT" value="'.$id_towaru.'" style="padding: 0px;"></td>
                                    <td class="nazwaProduktu"><a href="'.$domain.'produkt/?pid='.$id_towaru.'">'.$nazwa.'</a></td>
                                    <td hidden="hidden"><a id="cena">'.$cena.'</a> zł</td>
                                    <td class="ile non-selective">
                                        <p><i class="fas plus non-selective">&#xf067;</i><a id="ilosc">'.$ilosc.'</a> szt.<i class="fas minus non-selective">&#xf068;</i></p>
                                        <p style="font-size: 0.8em">(z dostępnych <a class="dostepnosc">'.$dostepnosc.'</a>)</p>
                                    </td>
                                    <td><a id="suma">'.$suma.'</a> zł</td>
							    </tr>';
                        }
                        $_SESSION["ile_w_koszyku"] = $i;

                    ?>
                    </tbody>
                </table>
                <div class="suma_koszyka row">
                    <div class="col-sm-8"></div>
                    <div class="col-12 col-sm-4">
                        <h3 style="margin-bottom: 0px; text-align: -webkit-right;"><strong>Razem: <a id="razem"></a> zł</strong></h3>
                        <p style="font-size: 0.8em; text-align: end">(+ koszty dostawy)</p>
                        <input id="buy_all" type="button" class="form-control pink click" value="Dostawa i płatność">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
</div>



<?php
	require_once('../footer.php');
	if($_SESSION['log_state'] == 0) {
	    $dostepnosc = 0;
	    $id_towaru = 0;
	    $login = "";
    }
?>

<script>
    $('document').ready(function () {

        let rowsNum = $('.table >tbody >tr').length;
        const table = $('.table tbody')[0];
        let razem = 0;

        function sumowanie(){
            razem = 0;
            //console.log(parseInt($cell.text()));

            for (let i = 0; i < rowsNum; i++) {

                let cell = table.rows[i].cells[6];
                let $cell = $(cell);
                let rekord = parseInt($cell.text());
                console.log(rekord);
                razem = razem + parseInt(rekord);
            }
            $('#razem').text(razem);
        }

        sumowanie();

       $('.plus').click(function () {
           const parent = $(this).parent().parent();
           const grandparent = parent.parent();
           const a = $("a#ilosc");
           const suma = $("a#suma");
           const cena = $("a#cena");
           const dostepnosc = $(this).parent().parent().find($('.dostepnosc')).text();
           let ilosc = parseInt(parent.find(a).text());
           if(ilosc < dostepnosc) {
               ilosc++;
               parent.find(a).text(ilosc);
               let cena_val = parseInt(grandparent.find(cena).text());
               let sumka = ilosc * cena_val;
               grandparent.find(suma).text(sumka);
               razem = razem + cena_val;
               $('#razem').text(razem);
               sumowanie();
               $.ajax({
                   url: 'dodaj.php',
                   type: 'POST',
                   data: {
                       'ilosc': ilosc,
                       'pid': <?php echo $id_towaru; ?>,
                       'login': '<?php echo $login; ?>'
                   }
               });
           }

       });
        $('.minus').click(function () {
            const parent = $(this).parent().parent();
            const grandparent = parent.parent();
            const a = $("a#ilosc");
            const suma = $("a#suma");
            const cena = $("a#cena");
            let idTowaru = grandparent.find('#idT').val();
            let ilosc = parseInt(parent.find(a).text());
            if(ilosc > 0) {
                ilosc--;
                parent.find(a).text(ilosc);
                let cena_val = parseInt(grandparent.find(cena).text());
                let sumka = ilosc * cena_val;
                grandparent.find(suma).text(sumka);
                razem = razem - cena_val;
                $('#razem').text(razem);
                sumowanie();
                $.ajax({
                    url: 'dodaj.php',
                    type: 'POST',
                    data: {
                        'ilosc': ilosc,
                        'pid': idTowaru,
                        'login': '<?php echo $login; ?>'
                    }
                });
            }
            if(ilosc == 0) {
                grandparent.fadeOut(function () {
                    this.remove();
                })
                //grandparent.remove();
                rowsNum--;
                $.ajax({
                    url: 'usun.php',
                    type: 'POST',
                    data: {
                        'ilosc': ilosc,
                        'pid': idTowaru,
                        'login': '<?php echo $login; ?>'
                    }
                });
            }

        });

        $('#buy_all').click(function () {
            location.replace('<?php echo $domain; ?>zakupy/');
        });

        if(<?php echo $_SESSION['suma_koszyka']; ?> == 0) {
            $('.table-koszyk').html('<div style="text-align: center; margin-top: 10vh;">' +
                                        '<h1>Twój koszyk świeci pustkami</h1>' +
                                        '<h3>Zrób jakieś zakupy!</h3>' +
                                        '<a href="https://aleciacho.eu/" class="button form-control pink click" style="width: 50%; margin-top: 30px; margin-left: auto; margin-right: auto;">Przejdź do sklepu</a>' +
                                    '</div>');
        }
    });
</script>

</body>
</html>
