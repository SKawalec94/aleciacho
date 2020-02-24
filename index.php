<?php
	include('session.php');
?>
<!DOCTYPE html>
<html lang="pl-PL">
<?php
    include('head.php');
?>
<body>
<?php

        include 'navbar.php';


            if(isset($_GET['cat'])) {
                echo
                '<div class="flex-container okruszki">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="'.$domain.'">Strona główna</a></li>
                                <li class="breadcrumb-item active">'.ucfirst($_GET["cat"]).'</li>
                            </ol>
                        </div>
                    </div>
                </div>';
            } else {

                echo
                '<div class="flex-container okruszki">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Strona główna</li>
                        </ol>
                    </div>
                </div>
            </div>';
                }

            if ($_SESSION['log_state'] && !($admin)) {
                echo '
                                <a href="'.$domain.'koszyk/" class="koszyk">
                                    <i class="moj-koszyk fas">&#xf291;</i>
                                </a>';
                if ($_SESSION['suma_koszyka'] >= 1) echo '<i class="stan_koszyka">' . $_SESSION['suma_koszyka'] . '</i>';

            }

            if ($admin){
                    echo '<a href="'.$domain.'admin/" class="admin">
                            <i class="moj-admin fas">&#xf3ed;</i>
                        </a>';
                }

            if(isset($_GET['cat'])) {
                switch ($_GET['cat']) {
                    case 'ciasta':
                        echo
                            '<div class="flex-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2 style="text-align: center;">Ciasta</h2>
                                        <hr>
                                    </div>
                                    <div class="col-sm-2"></div>
                                        <div class="col-sm-8">';
                                    $sql = "SELECT * FROM Towary
                                    JOIN Opisy ON Opisy.id_towaru = Towary.id
                                    WHERE Towary.kategoria = 'Ciasta'";

                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $PID = $row["id"];
                                        $grafika = $domain + $row["grafika"];
                                        $nazwa = $row["nazwa"];
                                        $cena = $row["cena"];
                                        $kategoria = $row["kategoria"];

                                        echo '<div class="col-sm-3 product-sm">
                                                <a href="'.$domain.'produkt/?pid=' . $PID . '">
                                                    <img src="' . $grafika . '">
                                                    <div class="podpis">
                                                     <p><strong>' . $nazwa . '</strong></p>
                                                     <h3>' . $cena . ' zł</h3>
                                                    </div>
                                                </a>
                                              </div>';
                                    }

                                    echo '</div>
                                            <div class="col-sm-2"></div>
                                            </div>
                                        </div>';
                        break;
                    case 'ciastka':
                        echo
                        '<div class="flex-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2 style="text-align: center;">Ciastka</h2>
                                        <hr>
                                    </div>
                                    <div class="col-sm-2"></div>
                                        <div class="col-sm-8">';
                        $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Ciastka'";

                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $PID = $row["id"];
                            $grafika = $row["grafika"];
                            $nazwa = $row["nazwa"];
                            $cena = $row["cena"];
                            $kategoria = $row["kategoria"];

                            echo '<div class="col-sm-3 product-sm">
                                                <a href="'.$domain.'produkt/?pid=' . $PID . '">
                                                    <img src="' . $grafika . '">
                                                    <div class="podpis">
                                                     <p><strong>' . $nazwa . '</strong></p>
                                                     <h3>' . $cena . ' zł</h3>
                                                    </div>
                                                </a>
                                              </div>';
                        }

                        echo '</div>
                                            <div class="col-sm-2"></div>
                                            </div>
                                        </div>';
                        break;
                    case 'babeczki':
                        echo
                        '<div class="flex-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2 style="text-align: center;">Babeczki</h2>
                                        <hr>
                                    </div>
                                    <div class="col-sm-2"></div>
                                        <div class="col-sm-8">';
                        $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Babeczki'";

                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $PID = $row["id"];
                            $grafika = $row["grafika"];
                            $nazwa = $row["nazwa"];
                            $cena = $row["cena"];
                            $kategoria = $row["kategoria"];

                            echo '<div class="col-sm-3 product-sm">
                                                <a href="'.$domain.'produkt/?pid=' . $PID . '">
                                                    <img src="' . $grafika . '">
                                                    <div class="podpis">
                                                     <p><strong>' . $nazwa . '</strong></p>
                                                     <h3>' . $cena . ' zł</h3>
                                                    </div>
                                                </a>
                                              </div>';
                        }

                        echo '</div>
                                            <div class="col-sm-2"></div>
                                            </div>
                                        </div>';
                        break;
                    case 'torty':
                        echo
                        '<div class="flex-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2 style="text-align: center;">Torty</h2>
                                        <hr>
                                    </div>
                                    <div class="col-sm-2"></div>
                                        <div class="col-sm-8">';
                        $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Torty'";

                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $PID = $row["id"];
                            $grafika = $row["grafika"];
                            $nazwa = $row["nazwa"];
                            $cena = $row["cena"];
                            $kategoria = $row["kategoria"];

                            echo '<div class="col-sm-3 product-sm">
                                                <a href="'.$domain.'produkt/?pid=' . $PID . '">
                                                    <img src="' . $grafika . '">
                                                    <div class="podpis">
                                                     <p><strong>' . $nazwa . '</strong></p>
                                                     <h3>' . $cena . ' zł</h3>
                                                    </div>
                                                </a>
                                              </div>';
                        }

                        echo '</div>
                                            <div class="col-sm-2"></div>
                                            </div>
                                        </div>';
                        break;
                }
            }else {
                echo
                '<div class="flex-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center;">Popularne</h2>
                    <hr>
                </div>
                <div class="col-sm-2"></div>
                    <div class="col-sm-8 category-show">';
                $sql = "SELECT * FROM Towary 
                JOIN Opisy ON Opisy.id_towaru = Towary.id
                JOIN Magazyn ON Magazyn.id_towaru = Towary.id
                ORDER BY Magazyn.sprzedanych DESC;";

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $PID = $row["id"];
                    $grafika = $row["grafika"];
                    $nazwa = $row["nazwa"];
                    $cena = $row["cena"];
                    $kategoria = $row["kategoria"];

                    echo '<div class="col-sm-3 product-sm">
                        <a href="'.$domain.'produkt/?pid=' . $PID . '">
                            <img src="' . $grafika . '">
                            <div class="podpis">
                                <p><strong>' . $nazwa . '</strong></p>
                                <h3>' . $cena . ' zł</h3>
                            </div>
                        </a>
                    </div>';
                }

                echo '</div>
                    <div class="col-sm-2"></div>
                    </div>
                </div>';


                echo
                '<div class="flex-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center;">Ciasta</h2>
                    <hr>
                </div>
                <div class="col-sm-2"></div>
                    <div class="col-sm-8 category-show">';
                $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Ciasta'";

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $PID = $row["id"];
                    $grafika = $row["grafika"];
                    $nazwa = $row["nazwa"];
                    $cena = $row["cena"];
                    $kategoria = $row["kategoria"];

                    echo '<div class="col-sm-3 product-sm">
            <a href="'.$domain.'produkt/?pid=' . $PID . '">
            <img src="' . $grafika . '">
            <div class="podpis">
                                <p><strong>' . $nazwa . '</strong></p>
                                <h3>' . $cena . ' zł</h3>
                            </div>
            </a>
            </div>';
                }

                echo '</div>
                <div class="col-sm-2"></div>
                </div>
            </div>';

                echo
                '<div class="flex-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center;">Ciastka</h2>
                    <hr>
                </div>
                <div class="col-sm-2"></div>
                    <div class="col-sm-8 category-show">';
                $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Ciastka'";

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $PID = $row["id"];
                    $grafika = $row["grafika"];
                    $nazwa = $row["nazwa"];
                    $cena = $row["cena"];
                    $kategoria = $row["kategoria"];

                    echo '<div class="col-sm-3 product-sm">
            <a href="'.$domain.'produkt/?pid=' . $PID . '">
            <img src="' . $grafika . '">
            <div class="podpis">
                                <p><strong>' . $nazwa . '</strong></p>
                                <h3>' . $cena . ' zł</h3>
                            </div>
            </a>
            </div>';
                }

                echo '</div>
                <div class="col-sm-2"></div>
                </div>
            </div>';

                echo
                '<div class="flex-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center;">Babeczki</h2>
                    <hr>
                </div>
                <div class="col-sm-2"></div>
                    <div class="col-sm-8 category-show">';

                $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Babeczki'";

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $PID = $row["id"];
                    $grafika = $row["grafika"];
                    $nazwa = $row["nazwa"];
                    $cena = $row["cena"];
                    $kategoria = $row["kategoria"];

                    echo '<div class="col-sm-3 product-sm">
            <a href="'.$domain.'produkt/?pid=' . $PID . '">
            <img src="' . $grafika . '">
            <div class="podpis">
                                <p><strong>' . $nazwa . '</strong></p>
                                <h3>' . $cena . ' zł</h3>
                            </div>
            </a>
            </div>';
                }

                echo '</div>
                <div class="col-sm-2"></div>
                </div>
            </div>';

                echo
                '<div class="flex-container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center;">Torty</h2>
                    <hr>
                </div>
                <div class="col-sm-2"></div>
                    <div class="col-sm-8 category-show">';
                $sql = "SELECT * FROM Towary JOIN Opisy ON Opisy.id_towaru=Towary.id WHERE Towary.kategoria='Torty'";

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $PID = $row["id"];
                    $grafika = $row["grafika"];
                    $nazwa = $row["nazwa"];
                    $cena = $row["cena"];
                    $kategoria = $row["kategoria"];

                    echo '<div class="col-sm-3 product-sm">
            <a href="'.$domain.'produkt/?pid=' . $PID . '">
            <img src="' . $grafika . '">
            <div class="podpis">
                                <p><strong>' . $nazwa . '</strong></p>
                                <h3>' . $cena . ' zł</h3>
                            </div>
            </a>
            </div>';
                }

                echo '</div>
                <div class="col-sm-2"></div>
                </div>
            </div>';
            }
            require_once('footer.php');


echo '<script src="'.$domain.'slick/slick.min.js"></script>';
?>


<script>
    $(document).ready(function(){
    	//var W = $(window).width();
        if(/Mobi|Android/i.test(navigator.userAgent))
        {
            $('.category-show').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2
            });
        }
        else{
            $('.category-show').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 2
            });
        }

        $('.product-sm').hover(function () {
           $(this).find('.podpis').css("background","#ff63b1");
           $(this).find('img').css("filter", "contrast(120%)");
        }, function () {
            $(this).find('.podpis').css("background","#ff63b1a8");
            $(this).find('img').css("filter", "contrast(100%)");
        });

        

        $('h2').css('margin-top', '3vh');
    });

</script>

</body>
</html>