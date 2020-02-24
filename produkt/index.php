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


    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(!(isset($_GET['pid'])))
        {
        	header("Location: $domain");
        	exit();
        }

        	$PID = $_GET['pid'];
            $_SESSION['pid'] = $PID;

        	if(isset($_GET['mode']))
        	{
        		$mode = $_GET['mode'];       		

        		if(!($admin))
        		{
        			header("Location: $domain");
        			die();
        		}

        		switch($mode)
        		{
        			case 'edit':
        				$edit = 1;
        				$new = 0;
        				break;
        			case 'new':
        				$new = 1;
        				$edit = 0;
        				break;
        			default:
        				$edit = 0;
        				$new = 0;
        				break;
        		}
        	}
        	else
        	{
        		$mode = "";
        		$edit = 0;
        		$new = 0;
        	}

            $sql = "SELECT * FROM Towary
            JOIN Opisy ON Opisy.id_towaru = Towary.id
            JOIN Magazyn ON Magazyn.id_towaru = Towary.id
            WHERE Towary.id = ".$PID."";

            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $link = $row["grafika"];
            $opis = $row["opis"];
            $nazwa = $row["nazwa"];
            $max = $row["dostepnosc"];
            $cena = $row["cena"];
            $waga = $row["waga"];
            $alergeny = $row["alergeny"];
            $kategoria = $row["kategoria"];

            $suma_koszyka = $_SESSION['suma_koszyka'];

            echo
		    '<div class="flex-container okruszki">
			    <div class="row">
			        <div class="col-12">
			            <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="'.$domain.'">Strona główna</a></li>';
			                if(!($new)) echo '
                            <li class="breadcrumb-item"><a href="'.$domain.'?cat='.strtolower($kategoria).'">'.$kategoria.'</a></li>
			                <li class="breadcrumb-item active">'. $nazwa .'</li>';
			                else echo '<li class="breadcrumb-item active">Dodawanie nowego produktu</li>';
			            echo
			            '</ol>
			        </div>
			    </div>
			</div>';

			echo '<div class="wczytywanie"></div>';

			if($admin)
		    {
		        echo '<a href="'.$domain.'admin/" class="admin">
						<i class="moj-admin fas">&#xf3ed;</i>
					</a>';
			}

			switch($mode)
	        {
		        case 'edit':
		            echo '<a href="'.$domain.'admin/" class="admin">
				            <i class="moj-admin fas">&#xf3ed;</i>
				        </a>';
		            break;
		        case 'new':
		            echo '<a href="'.$domain.'admin/" class="admin">
				            <i class="moj-admin fas">&#xf3ed;</i>
				        </a>';
		            break;
		        default:
		            if($_SESSION['log_state']) {
                        echo '
                                <a href="'.$domain.'koszyk/" class="koszyk">
                                    <i class="moj-koszyk fas">&#xf291;</i>
                                </a>';
                                if($suma_koszyka >= 1) echo '<i class="stan_koszyka">'.$suma_koszyka.'</i>';

				    }
		            break;
	        }

            echo
            '<div class="flex-container">
            	<div class="row">
	            	<div class="col-md-1 col-lg-2"></div>
	            	<div class="col-12 col-md-10 col-lg-8">
	                	';

	                	switch($mode)
	                	{
	                		case 'edit':
	                			echo '<form id="edycja" action="edycja.php" method="post" enctype="multipart/form-data">';
	                			break;
	                		case 'new':
	                			echo '<form id="dodawanie" action="nowy.php" method="post" enctype="multipart/form-data">';
	                			break;
	                		default:
	                			echo '<form id="kupowanie" method="post" action="../koszyk/index.php">';
	                			break;
	                	}

	                    echo '<div class="row">
                                <div class="col-sm-7 order-1 order-sm-1 margtop">
	                            <img src="'. $link .'" style="width: 100%;">';

                                switch($mode)
                                {
                                	case 'edit':
                                		echo '<input type="file" id="fobraz" class="form-control click" accept="image/*" name="image" value="Zmień zdjęcie">';
                                		break;
                                	case 'new':
                                		echo '<input type="file" id="fobraz" class="form-control click" accept="image/*" name="image" value="Dodaj zdjęcie">';
                                		break;
                                }


	                   echo '</div>
	                    	<div class="col-sm-5 order-2 order-sm-2 margtop">';

                            $sql4 = "SELECT AVG(ocena) AS srednia_ocena FROM Komentarze WHERE id_towaru=".$PID;
                            $result4 = mysqli_query($conn, $sql4);
                            $row4 = mysqli_fetch_assoc($result4);

                            $srednia = number_format($row4['srednia_ocena'],1);

	                    	switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<h1><input type="text" id="fnazwa" name="nazwa" class="form-control" value="'.$nazwa.'"></h1><p>Kategoria: <input type="text" id="fkategoria" name="kategoria" class="form-control" value="'.$kategoria.'" style="width: 50%; display: inline-flex;"></p>';
	                    			break;
	                    		case 'new':
	                    			echo '<h1><input type="text" id="fnazwa" name="nazwa" class="form-control" value="" placeholder="Nazwa produktu"></h1><p>Kategoria: <input type="text" id="fkategoria" name="kategoria" class="form-control" value="" placeholder="Kategoria produktu" style="width: 50%; display: inline-flex;"></p>';
	                    			break;
	                    		default:
	                    			echo '<input type="hidden" name="PID" value="'.$PID.'"><h1>'. $nazwa .'</h1>
                                            <div class="my-rating-4" data-rating="'.$srednia.'"></div>
                                          ';
	                    			break;
	                    	}

	                       echo '<div class="cechy">';

	                       switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<p>Waga: <input type="number" name="waga" min="1" max="25000" step="1" id="fwaga" class="form-control" value="'.$waga.'" style="width:50%; display: inline-flex"> gramów</p>';
	                    			break;
	                    		case 'new':
	                    			echo '<p>Waga: <input type="number" name="waga" min="1" max="25000" step="1" id="fwaga" class="form-control" value="" placeholder="Waga" style="width:50%; display: inline-flex"> gramów</p>';
	                    			break;
	                    		default:
	                    			echo '<p>Waga: '. $waga .' gramów</p>';
	                    			break;
	                    	}

	                    	switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<p>Alergeny: <input type="text" id="falergeny" name="alergeny" class="form-control" value="'.$alergeny.'" style="width:80%; display: inline-flex"></p>';
	                    			break;
	                    		case 'new':
	                    			echo '<p>Alergeny: <input type="text" id="falergeny" name="alergeny" class="form-control" value="" placeholder="Alergeny" style="width:80%; display: inline-flex"></p>';
	                    			break;
	                    		default:
	                    			echo '<p>Alergeny: '. $alergeny .'</p>';
	                    			break;
	                    	}


	                       echo '</div>';
	                        //if(!($edit)) echo '<form type="post">';
		                    
		                    switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<p class="cena">Koszt: <input type="number" name="cena" min="1" max="25000" step="1" id="fcena" class="form-control" value="'.$cena.'" style="width: 65px; display: inline-flex"> PLN</p>';
	                    			break;
	                    		case 'new':
	                    			echo '<p class="cena">Koszt: <input type="number" name="cena" min="1" max="25000" step="1" id="fcena" class="form-control" value="" style="width: 65px; display: inline-flex"> PLN</p>';
	                    			break;
	                    		default:
	                    			echo '<p class="cena">Koszt: '. $cena .' PLN</p>';
	                    			break;
	                    	}

	                    	switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<p>Sztuk w magazynie: <input type="number" name="max" min="0" max="999" step="1" id="fmax" class="form-control" value="'.$max.'" style="width: 60px; display: inline-flex"></p>';
	                    			break;
	                    		case 'new':
	                    			echo '<p>Sztuk w magazynie: <input type="number" name="max" min="0" max="999" step="1" id="fmax" class="form-control" value="" style="width: 60px; display: inline-flex"></p>';
	                    			break;
	                    		default:
	                    			echo '<p>Liczba sztuk z '. $max .' dostępnych
		                            <input type="number" class="form-control" name="ilosc" value="1" min="1" max="'. $max .'" step="1"></p>
		                            <input type="submit" class="form-control pink click" value="Dodaj do koszyka">';
	                    			break;
	                    	}


	                        //if(!($edit)) echo '</form>';
	                        echo '</div>
	                        <div class="col-sm-12 order-3 margtop">';

	                        switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<p><input id="fopis" type="text" name="opis" value="" hidden><textarea id="opisarea" rows="6" class="form-control">'.$opis.'</textarea></p>';
	                    			break;
	                    		case 'new':
	                    			echo '<p><input id="fopis" type="text" name="opis" value="" hidden><textarea id="opisarea" rows="6" class="form-control" placeholder="Opis"></textarea></p>';
	                    			break;
	                    		default:
	                    			echo'<p>'. $opis .'</p>';
	                    			break;
	                    	}

	                    	switch($mode)
	                    	{
	                    		case 'edit':
	                    			echo '<input type="submit" id="ok" class="form-control pink click" value="Zakończ edycję">
                            <div id="info"></div>';
	                    			break;
	                    		case 'new':
	                    			echo '<input type="submit" id="ok" class="form-control pink click" value="Dodaj">
                            <div id="info"></div>';
	                    			break;
	                    	}


	                   echo' </div>
	                    </div>
	                </div>
	                <div class="col-md-1 col-lg-2"></div>
                    </div>
                    </form>
                    </div>';



            if(!($edit) && !($new))
            {
                $sql3 = "SELECT *, Klienci.avatar FROM Komentarze JOIN Klienci ON Klienci.login = Komentarze.login WHERE id_towaru = '$PID' ORDER BY data DESC";

                $result3 = mysqli_query($conn, $sql3);

                echo 
                '<div class="flex-container">
                    <div class="row">
                        <div class="col-md-1 col-lg-2"></div>
                        <div class="col-12 col-md-10 col-lg-8">
                            <h2>Opinie</h2>';

                if(mysqli_num_rows($result3) > 0)
                {
                    while($row3 = mysqli_fetch_assoc($result3))
                    {
                        $komentarz = $row3["komentarz"];
                        $ocena = $row3["ocena"];
                        $data = $row3["data"];
                        $komentator = $row3["login"];
                        $avatar = $row3["avatar"];
                        //$srednia = number_format($row["srednia"],1,'.','');

                        echo
                                '<div class="media border p-3">
                                <img src="'. $avatar .'" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                    <div class="media-body">
                                        <h4>'. $komentator .'</h4>
                                        <p><div class="my-rating-4" data-rating="'.$ocena.'"></div></p>
                                        <p>'. $komentarz .'</p>
                                        <p><small><i>Opublikowano '. $data .'</i></small></p>
                                    </div>
                                </div>';
                    }
                } else
                {
                    echo '<p>Brak opini o tym produkcie.</p>';
                }

                echo
                '       </div>
                        <div class="col-md-1 col-lg-2"></div>
                    </div>
                </div>';
            }
            

        echo '</div>
            </div>';
        
    }
    else
    {
    	header("Location: $domain");
    }

    

    require_once('../footer.php');
?>

<script>
    $(document).ready(function(){
        $('#edycja').submit(function(e){
            e.preventDefault();

            $('#fopis').val($('#opisarea').val());

            $body = $("body");

			$(document).on({
			    ajaxStart: function() { $body.addClass("loading");    },
			    ajaxStop: function() {
			    	$body.removeClass("loading");
			    	window.location.replace("<?php echo $domain; ?>admin/");
			    }    
			});

            $.ajax({
                url: 'edycja.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $('#dodawanie').submit(function(e){
            e.preventDefault();

            $('#fopis').val($('#opisarea').val());

            $body = $("body");

			$(document).on({
			    ajaxStart: function() { $body.addClass("loading");    },
			    ajaxStop: function() {
			    	$body.removeClass("loading");
			    	window.location.replace("<?php echo $domain; ?>admin/");
			    }    
			});

            $.ajax({
                url: 'nowy.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $('#kupowanie').submit(function(e){
            e.preventDefault();
            $body = $("body");

            $(document).on({
                ajaxStart: function() { $body.addClass("loading");    },
                ajaxStop: function() {
                    $body.removeClass("loading");
                    //window.location.replace("<?php echo $domain; ?>admin/");
                }
            });

            if(!(<?php echo $_SESSION['log_state'] ?>)) {
                alert("Musisz się zalogować!");
            } else {
                $.ajax({
                    url: 'zakup.php',
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(){
                	window.location.reload(true);
                });
            }

        });


        $(".my-rating-4").starRating({
            totalStars: 5,
            starShape: 'rounded',
            starSize: 40,
            emptyColor: 'lightgray',
            activeColor: '#FF63B1',
            useGradient: false,
            readOnly: true
        });


    });
</script>

</body>
</html>