<!DOCTYPE html>
<html>


<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="<?= base_url() ?>signin/css-login/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>signin/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="<?= base_url() ?>signin/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="<?= base_url() ?>signin/code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets_landingpage/img/small.png">

</head>

<body>
	<div class="container-fluid">
		<div class="row ">
			<div class="col-lg-6 col-md-6 d-none d-md-block infinity-image-container"></div>
			<div class="col-lg-6 col-md-6 infinity-form-container">
				<div class="col-lg-9 col-md-12 col-sm-9 col-xs-12 infinity-form">
					<div class="text-center mb-3 mt-5">
						<a href="/"><img src="<?= base_url() ?>signin/agrismart-logo1.png" width="150px"></a>
					</div>
					<div class="text-center mb-4">
						<h4>Gumawa ng Bagong Account</h4>
						<?php if (isset($validation)) : ?>
							<div class="alert alert-warning">
								<?= $validation->listErrors() ?>
							</div>
						<?php endif; ?>
					</div>
					<form action="/register" method="POST" class="px-3">
						<div class="form-input">
							<span><i class="fa fa-user"></i></span>
							<input type="text" name="leader_name" value="<?= set_value('leader_name') ?>" placeholder="Buong Pangalan" tabindex="10" required>
						</div>
						<div class="form-input">
							<span><i class="fa fa-id-card"></i></span>
							<input type="text" name="idnumber" value="<?= set_value('idnumber') ?>" placeholder="RSBSA ID Number" tabindex="10" required>
						</div>
						<div class="form-input">
							<select class="form-select mb-3" name="barangay" tabindex="10" required>
								<option value="" selected disabled>Select Barangay</option>
								<option value="Poblacion I">Poblacion I</option>
								<option value="Poblacion II">Poblacion II</option>
								<option value="Poblacion III">Poblacion III</option>
								<option value="Adrialuna">Adrialuna</option>
								<option value="Andres Ylagan">Andres Ylagan</option>
								<option value="Antipolo">Antipolo</option>
								<option value="Apitong">Apitong</option>
								<option value="Arangin">Arangin</option>
								<option value="Aurora">Aurora</option>
								<option value="Bacungan">Bacungan</option>
								<option value="Bagong Buhay">Bagong Buhay</option>
								<option value="Balite">Balite</option>
								<option value="Bancuro">Bancuro</option>
								<option value="Banuton">Banuton</option>
								<option value="Barcenaga">Barcenaga</option>
								<option value="Bayani">Bayani</option>
								<option value="Buhangin">Buhangin</option>
								<option value="Caburo">Caburo</option>
								<option value="Concepcion">Concepcion</option>
								<option value="Dao">Dao</option>
								<option value="Del Pilar">Del Pilar</option>
								<option value="Estrella">Estrella</option>
								<option value="Evangelista">Evangelista</option>
								<option value="Gamao">Gamao</option>
								<option value="General Esco">General Esco</option>
								<option value="Herrera">Herrera</option>
								<option value="Inarawan">Inarawan</option>
								<option value="Kalinisan">Kalinisan</option>
								<option value="Laguna">Laguna</option>
								<option value="Mabini">Mabini</option>
								<option value="Magtibay">Magtibay</option>
								<option value="Mahabang Parang">Mahabang Parang</option>
								<option value="Malaya">Malaya</option>
								<option value="Malinao">Malinao</option>
								<option value="Malvar">Malvar</option>
								<option value="Masagana">Masagana</option>
								<option value="Masaguing">Masaguing</option>
								<option value="Melgar A">Melgar A</option>
								<option value="Melgar B">Melgar B</option>
								<option value="Metolza">Metolza</option>
								<option value="Montelago">Montelago</option>
								<option value="Montemayor">Montemayor</option>
								<option value="Motoderazo">Motoderazo</option>
								<option value="Mulawin">Mulawin</option>
								<option value="Nag-Iba 1">Nag-Iba 1</option>
								<option value="Nag-Iba 2">Nag-Iba 2</option>
								<option value="Pagkakaisa">Pagkakaisa</option>
								<option value="Paitan">Paitan</option>
								<option value="Paniquian">Paniquian</option>
								<option value="Pinagsabangan 1">Pinagsabangan 1</option>
								<option value="Pinagsabangan 2">Pinagsabangan 2</option>
								<option value="Piñahan">Piñahan</option>
								<option value="Sampaguita">Sampaguita</option>
								<option value="San Agustin 1">San Agustin 1</option>
								<option value="San Agustin 2">San Agustin 2</option>
								<option value="San Andres">San Andres</option>
								<option value="San Antonio">San Antonio</option>
								<option value="San Carlos">San Carlos</option>
								<option value="San Isidro">San Isidro</option>
								<option value="San Jose">San Jose</option>
								<option value="San Luis">San Luis</option>
								<option value="San Nicolas">San Nicolas</option>
								<option value="San Pedro">San Pedro</option>
								<option value="Sta. Cruz">Sta. Cruz</option>
								<option value="Sta. Cruz">Sta. Cruz</option>
								<option value="Sta. Isabel">Sta. Isabel</option>
								<option value="Sta. Maria">Sta. Maria</option>
								<option value="Satiago">Satiago</option>
								<option value="Sto. Niño">Sto. Niño</option>
								<option value="Tagumpay">Tagumpay</option>
								<option value="Tigkan">Tigkan</option>
							</select>
						</div>
						<div class="form-input">
							<span><i class="fa fa-user"></i></span>
							<input type="text" name="position" value="<?= set_value('position') ?>" placeholder="Position" tabindex="10" required>
						</div>
						<div class="form-input">
							<span><i class="fa fa-lock"></i></span>
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-input">
							<span><i class="fa fa-lock"></i></span>
							<input type="password" name="repeat_password" placeholder="Ulitin ang Password" required>
						</div>
						<div class="mb-3">
							<button type="submit" name="signup" id="signup" class="btn btn-block form-submit">Register</button>
						</div>
						<div class="text-right ">
						</div>
						<div class="text-center mb-2">
							<div class="text-center mb-5 text-grey">Meron ng account?
								<a class="register-link" href="/sign_ins">Mag-log in</a>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>