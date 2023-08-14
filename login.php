<!DOCTYPE html>
<html lang="en">

<head>

	<title>2do Desempeño</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />

	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.svg" type="image/x-icon">

	<!-- font css -->
	<link rel="stylesheet" href="assets/fonts/font-awsome-pro/css/pro.min.css">
	<link rel="stylesheet" href="assets/fonts/feather.css">
	<link rel="stylesheet" href="assets/fonts/fontawesome.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/customizer.css">


</head>
<?php 
session_start();
require_once 'funciones/select_usuario.php';
require_once 'conexion/conexion.php';
$conexion = ConexionBD();
$Mensaje='';

if (!empty($_POST['btnLogin'])) {

	$getUsuario = DatosLogin($_POST['email'], $_POST['password'], $conexion);
	$Mensaje='entro aca';

    //la consulta con la BD para que encuentre un usuario registrado con el usuario y clave brindados
    if ( !empty($getUsuario)) {
		$_SESSION['usuario_id'] = $getUsuario['ID'];
		$_SESSION['usuario_nombre'] = $getUsuario['NOMBRE'];
		$_SESSION['usuario_apellido'] = $getUsuario['APELLIDO'];
		$_SESSION['usuario_rango'] = $getUsuario['RANGO'];
		$_SESSION['usuario_id_rango'] = $getUsuario['ID_RANGO'];
		$_SESSION['usuario_img'] = $getUsuario['IMG'];
		//este dato lo utilizamos para crear el archivo .log
		$_SESSION['usuario_email'] = $getUsuario['EMAIL'];
        header('Location: index.php');
        exit;
    }else {
        $Mensaje='Datos incorrectos, ingresa nuevamente.';
    }

}

?>
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<!--<img src="assets/images/logo-dark.svg" alt="" class="img-fluid mb-4"> -->

						<h2>Ingresa al panel</h2>
						<h4 class="mb-3 f-w-400">Login</h4>
						<?php if(!empty($Mensaje)):?>
							<div class="form-group text-left mt-2">
								<div class="alert alert-danger" role="alert">
								<?php echo $Mensaje ?>
								</div>
							</div>
						<?php endif;?>
						
						<form method="post">
							<div class="form-group text-left mt-2">
								<div class="alert alert-info" role="alert">
									Usuario y clave son requeridos.
								</div>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i data-feather="mail"></i></span>
								</div>
								<input type="email" name="email" value =""class="form-control" placeholder="Email address">
							</div>
							<div class="input-group mb-4">
								<div class="input-group-prepend">
									<span class="input-group-text"><i data-feather="lock"></i></span>
								</div>
								<input type="password" name="password" value= "" class="form-control" placeholder="Password">
							</div>
							<button type="submit" name="btnLogin" value="login"
								class="btn btn-block btn-primary mb-4">Ingresa</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>

</body>

</html>