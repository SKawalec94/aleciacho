<?php
include __DIR__ . '/../session.php';
?>
<!DOCTYPE html>
<html lang="pl-PL">
<?php
if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['transakcja']))
{

	require_once __DIR__ . '/../head.php';
	require_once __DIR__ . '/../navbar.php';

	$nr_transakcji = $_GET['transakcja'];

	$sql = "SELECT * FROM Szczegoly_transakcji
	JOIN Towary ON Szczegoly_transakcji.id_towaru = Towary.id
	JOIN Opisy ON Szczegoly_transakcji.id_towaru = Opisy.id_towaru
	WHERE nr_transakcji = '".$nr_transakcji."';";
	$result = mysqli_query($conn, $sql);

	echo
		    '<div class="flex-container okruszki">
			    <div class="row">
			        <div class="col-12">
			            <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="https://aleciacho.eu/">Strona główna</a></li>
			                <li class="breadcrumb-item active">Ocena zakupionych produktów</li>
			            </ol>
			        </div>
			    </div>
			</div>';

	echo
            '<div class="flex-container">
            	<div class="row">
	            	<div class="col-md-1 col-lg-2"></div>
	            	<div class="col-12 col-md-10 col-lg-8">
	            		<h2 style="text-align: center;">Zamówienie numer '.$nr_transakcji.':</h2>';

	$i = 1;
	while($row = mysqli_fetch_assoc($result))
	{
		$grafika = $row['grafika'];
		$nazwa = $row['nazwa'];
		$id = $row['id_towaru'];

		echo '	
	        <div style="margin-top: 5vh;" class="row">
		        <div style="margin: auto; width: 45vw; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="card">
	            	<div class="card-body">
	            		<form class="formularz">
	            			<h3><a style="display: block; text-align: center;" href="https://aleciacho.eu/produkt/?pid='.$id.'">'.$nazwa.'</a></h3>
	            			<hr>
	            			<img style="width: 60%; margin: auto; margin-top: 4%; display: block;" src="'.$grafika.'">
	            			<h4 style="display: block; margin-top: 4%;">Twoja ocena:</h4>';

							$sql2 = "SELECT * FROM Komentarze WHERE (login = '".$username."' AND id_towaru = ".$id.");";
							$result2 = mysqli_query($conn, $sql2);
							$row2 = mysqli_fetch_assoc($result2);
							if(!(is_null($row2['ocena'])))
							{
								$kom = $row2['komentarz'];
								$oc = $row2['ocena'];
								echo '
			            			<div style="margin: auto; margin-top: 4%; position: relative; width: fit-content;" class="my-rating-4 nonedit" data-rating="'.$oc.'"></div>
			            			<h4 style="display: block;">Twój komentarz:</h4>
			            			<p style="display: block; width: 100%; margin-bottom: 1%; text-align: center;">'.$kom.'</p>';
							} else {
							echo '
		            			<div style="margin: auto; margin-top: 4%; position: relative; width: fit-content;" class="my-rating-4" data-rating="2.5"></div>
		            			<label style="display: block;" for="komentarz"><h4>Twój komentarz:</h4></label>
		            			<input style="display: block; width: 100%; margin-bottom: 1%;" type="text" name="komentarz">
		            			<input type="hidden" name="id" value="'.$id.'">
		            			<input type="submit" class="form-control pink click" value="Dodaj ocenę">';
							}

	            			echo '
	            		</form>
	            	</div>
	            </div>
            </div>
	    ';
	$i++;
	}
	echo '</div>
	<div class="col-md-1 col-lg-2"></div>
	</div>
	</div>';
	            		
	require_once('../footer.php');
	?>
	<script>
		$(document).ready(function(e){

			var ocenka;		

			$(".nonedit").starRating({
	            totalStars: 5,
	            starShape: 'rounded',
	            starSize: 40,
	            emptyColor: 'lightgray',
	            activeColor: '#FF63B1',
	            useGradient: false,
	            readOnly: true
	        });	
						
			$(".my-rating-4").starRating({
	            totalStars: 5,
	            starShape: 'rounded',
	            starSize: 40,
	            emptyColor: 'lightgray',
	            activeColor: '#FF63B1',
	            hoverColor: '#FF63B1',
	            ratedColor: '#FF63B1',
	            useGradient: false,
	            disableAfterRate: false,
	            callback: function(currentRating, $el){
	    		ocenka = currentRating;
	  			}
	        });

	        $('.formularz').submit(function(e){
				e.preventDefault();
				let komentarz = $(this).find($('input[name="komentarz"]')).val();
				let id_towaru = $(this).find($('input[name="id"]')).val();
				$.ajax({
                url: 'ocena.php',
                type: 'POST',
                data: {"ocenka": ocenka, "komentarz": komentarz, "id_towaru": id_towaru},
            	}).done(function(){
            		window.location.replace("https://aleciacho.eu/konto/");
            	});

			});

		});

	</script>

	<?php

} else {
	header('Location: https://aleciacho.eu/');
    exit();
}


?>