<?php
	include '../session.php';

	if(!($admin)) header("Location: $domain");
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

<div class="flex-container">
	<div class="row okruszki">
	    <div class="col-sm-12">
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="<?php echo $domain; ?>">Strona główna</a></li>
	            <li class="breadcrumb-item active">Panel administratora</li>
	        </ol>
	    </div>
	</div>
</div>

<a href="<?php echo $domain; ?>admin/" class="admin">
	<i class="moj-admin fas" style="font-size: 33px; color: white;">&#xf3ed;</i>
</a>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		        
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		    </button>
		    </div>
		      <div class="modal-body">
		        <div class="login-pop">
		       		<form method="POST">
		       			<p>Login: <input type="text" name="user" class="form-control"></p>
		                <p>Hasło: <input type="password" name="password" class="form-control"></p>
		                <p><input type="submit" class="form-control" name="log" value="Zaloguj się"></p>
                        <p><input type="button" id="rejestruj" class="form-control" name="rejestracja" value="Utwórz konto"></p>
		            </form>
		        </div>
		      </div>
		     
		</div>
	</div>
</div>

<div class="flex-container">
	<div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div id="produkty" class="col-12 col-md-10 col-lg-8">
        	<div class="title">
        		<h3>Zarządzanie produktami</h3>
        		<i class="plus">+</i>
        		<i class="minus">-</i>
        	</div>
        	<div class="content">
				<input type="button" id="dodaj" class="form-control pink" value="Dodaj produkt">
				<div class="table-responsive">
				<table class="table table-sm table-striped">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nazwa</th>
							<th scope="col">Kategoria</th>
							<th scope="col">Cena</th>
							<th scope="col">Szt. w magazynie</th>
							<th scope="col">Edycja</th>
						</tr>
					</thead>
				<tbody>

				<?php
					$sql = "SELECT * FROM Towary JOIN Magazyn ON Magazyn.id_towaru = Towary.id";

					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_assoc($result))
					{
						$id = $row['id'];
						$nazwa = $row['nazwa'];
						$kategoria = $row['kategoria'];
						$cena =  $row['cena'];
						$dostepnosc = $row['dostepnosc'];

						echo
								'<tr>
									<th scope="row">'. $id .'</th>
									<td>'.$nazwa.'</td>
									<td>'.$kategoria.'</td>
									<td>'.$cena.'</td>
									<td>'.$dostepnosc.'</td>
									<td><a href="'.$domain.'produkt/?pid='.$id.'&mode=edit">Edytuj</td>
								</tr>';
					}

				?>
				</tbody>
				</table>
				</div>
			</div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-2"></div>
        <div id="klienci" class="col-12 col-md-10 col-lg-8">
        	<div class="title">
        		<h3>Zarządzanie klientami</h3>
        		<i class="plus">+</i>
        		<i class="minus">-</i>
        	</div>
        	<div class="content">
			<div class="table-responsive">
			<table class="table table-sm table-striped">
				<thead>
					<tr>
						<th scope="col">Login</th>
						<th scope="col">Nazwisko</th>
						<th scope="col">Adres</th>
						<th scope="col">Telefon</th>
						<th scope="col">E-mail</th>
					</tr>
				</thead>
			<tbody>

			<?php
				$sql = "SELECT * FROM Klienci
				WHERE login != 'admin'";

				$result = mysqli_query($conn,$sql);
				while($row = mysqli_fetch_assoc($result))
				{
					$nazwisko = $row['nazwisko'];
					$imie = $row['imie'];
					$adres = $row['adres'];
					$kodpocztowy = $row['kodpocztowy'];
					$miasto = $row['miasto'];
					$telefon = $row['telefon'];
					$email = $row['email'];
					$login = $row['login'];


					echo
							'<tr>
								<td>'.$login.'</td>
								<td>'.$imie.' '.$nazwisko.'</td>
								<td>'.$adres.'<br>'.$kodpocztowy.', '.$miasto.'</td>
								<td>'.$telefon.'</td>
								<td>'.$email.'</td>
							</tr>';
				}

			?>
			</tbody>
			</table>
			</div>
        </div>
        <div class="col-md-1 col-lg-2"></div>
</div>
	</div>
    <div class="row">

		<div class="col-md-1 col-lg-2"></div>
        <div id="transakcje" class="col-12 col-md-10 col-lg-8">
        	<div class="title">
        		<h3>Zarządzanie transakcjami</h3>
        		<i class="plus">+</i>
        		<i class="minus">-</i>
        	</div>
        	<div class="content">
			<div class="table-responsive">
			<table class="table table-sm table-hover">
				<thead>
					<tr style="line-height: 50px">
						<th scope="col"></th>
						<th scope="col">Numer transakcji</th>
						<th scope="col">Login</th>
						<th scope="col">Data</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
			<tbody>

			<?php
				$sql = "SELECT * FROM Transakcje";

				$result = mysqli_query($conn,$sql);
				$i = 1;
				while($row = mysqli_fetch_assoc($result))
				{
					$nr_transakcji = $row['nr_transakcji'];
					$login = $row['login'];
					$data = $row['data'];


					echo
					'<tr style="line-height: 50px" class="clickable" data-toggle="collapse" id="row'.$i.'" data-target=".row'.$i.'">
						<td>+</td>
						<td id="nr_transakcji"><a style="color: #007bff;">'.$nr_transakcji.'</a></td>
						<td>'.$login.'</td>
						<td>'.$data.'</td>
						<td><a href="#">Oznacz jako wysłane</a></td>
					</tr>
					<tr style="background-color: #FF63B1;" class="collapse row'.$i.'">
						<th></th>
						<th>Nazwa</th>
						<th>Ilość szt.</th>
						<th>Cena za szt.</th>
						<th>Razem</th>
					</tr>';

					$sql2 = "SELECT * FROM Szczegoly_transakcji
					JOIN Towary ON Towary.id = Szczegoly_transakcji.id_towaru
					JOIN Opisy ON Opisy.id_towaru = Szczegoly_transakcji.id_towaru
					WHERE nr_transakcji = '".$nr_transakcji."';";
					$result2 = mysqli_query($conn,$sql2);
					while($row2 = mysqli_fetch_assoc($result2))
					{
						$ilosc = $row2["ilosc"];
						$nazwa = $row2["nazwa"];
				        $cena = $row2["cena"];
				        $suma = $cena * $ilosc;
						echo
						'
						<tr class="collapse row'.$i.'">
							<td></td>
							<td>'.$nazwa.'</td>
							<td>'.$ilosc.' szt.</td>
							<td>'.$cena.'</td>
							<td>'.$suma.' zł</td>
						</tr>
						';
					}
					
					$i++;
				}

			?>
			</tbody>
			</table>
			</div>
        </div>
        <div class="col-md-1 col-lg-2"></div>

	</div>
</div>


<?php

require_once('../footer.php');

?>

<script>
	$(document).ready(function(){
		$('#dodaj').click(function(){
			window.location.replace("<?php echo $domain; ?>produkt/?pid=0&mode=new");
		});
		$('.row').not('.okruszki, .footer').css('margin-bottom','5%');
		$('.title i').css('float', 'right').css('font-size', 'x-large');
		$('.title h3').css('float', 'left');

		$('.minus').hide();
		$('.content').hide();

		$('.plus').click(function(){
			$(this).parent().parent().find('.content').fadeToggle('fast');
			$(this).hide();
			$(this).siblings('.minus').show();
		});
		
		$('.minus').click(function(){
			$(this).parent().parent().find('.content').fadeToggle('fast');
			$(this).hide();
			$(this).siblings('.plus').show();
		});
	});
</script>
</body>
</html>
