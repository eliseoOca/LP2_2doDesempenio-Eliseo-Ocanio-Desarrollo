<?php
session_start();

if (empty($_SESSION['usuario_nombre'])){
    header('Location: cerrar_sesion.inc.php');
    exit;
}

require_once 'conexion/conexion.php';
require_once 'funciones/lista_paciente.php';
require_once 'funciones/lista_sesiones.php';
require_once 'funciones/validar_carga_input.php';
require_once 'funciones/validar_carga_insert.php';
require_once 'funciones/insertar_turno.php';

$Miconexion = ConexionBD();
$ListaPacientes = Lista_paciente($Miconexion);
$CantidadPacientes = count($ListaPacientes);
$ListaSesiones = Lista_sesiones($Miconexion);
$CantidadSesiones = count($ListaSesiones);


$Mensaje2 = '';
if (!empty($_POST['BtnRegistrar'])) {    
    $Mensaje2 = validar_input();
    if(empty($Mensaje2)){
        if(insertar_turno($Miconexion,$_POST['pacientes'], $_POST['sesiones'], $_POST['fecha'],$_SESSION['usuario_id'])){
            $Mensaje2 = '<div class="alert alert-warning" role="alert">  <i data-feather="alert-circle"></i> Error al guandar el turno </div>';
        }else{
            $Mensaje2 = '<div class="alert alert-success" role="alert">  <i data-feather="check-circle"></i> Se han registrado los datos ingresados. </div>';
        }
    }
}

?>
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



    <!-- Include Bootstrap CDN
    <link href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
    <!--
Include Moment.js CDN  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js">
    </script>

    <!-- Include Bootstrap DateTimePicker CDN -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
        </script>

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Mobile header ] start -->
    <div class="pc-mob-header pc-header">
        <div class="pcm-logo">
            <img src="assets/images/logo.svg" alt="" class="logo logo-lg">
        </div>
        <div class="pcm-toolbar">
            <a href="#!" class="pc-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
                <!-- <i data-feather="menu"></i> -->
            </a>

            <a href="#!" class="pc-head-link" id="header-collapse">
                <i data-feather="more-vertical"></i>
            </a>
        </div>
    </div>
    <!-- [ Mobile header ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pc-sidebar ">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="direccionar_index.inc.php" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="assets/images/logo.svg" alt="" class="logo logo-lg">
                    <img src="assets/images/logo-sm.svg" alt="" class="logo logo-sm">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Navegación</label>

                    </li>


                    <li class="pc-item pc-caption">
                        <label>Prestaciones</label>
                    </li>


                    <li class="pc-item"><a href="direccionar_carga.inc.php" class="pc-link ">
                            <span class="pc-micon"><i data-feather="layout"></i></span>
                            <span class="pc-mtext">Cargar nueva</span></a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Listados</label>
                    </li>
                    <li class="pc-item"><a href="direccionar_listado.inc.php" class="pc-link ">
                            <span class="pc-micon"><i data-feather="list"></i></span>
                            <span class="pc-mtext">Listado de mis cargas</span></a>
                    </li>






                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="pc-header ">
        <div class="header-wrapper">

            <div class="ml-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i data-feather="search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/user/<?php echo $_SESSION['usuario_img']?>" alt="user-image" class="user-avtar">
                            <span>
                                <span class="user-name"><?php echo $_SESSION['usuario_nombre'].' '.$_SESSION['usuario_apellido']?></span>
                                <span class="user-desc"><?php echo $_SESSION['usuario_rango']?></span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
                            <div class=" dropdown-header">
                                <h6 class="text-overflow m-0">Bienvenido!</h6>
                            </div>
                            <a href="#!" class="dropdown-item">
                                <i data-feather="user"></i>
                                <span>Mis Datos</span>
                            </a>
                            <a href="cerrar_sesion.inc.php" class="dropdown-item">
                                <i data-feather="power"></i>
                                <span>Cerrar sesión</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </header>

    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <section class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Solicitudes</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="menu.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="#!">Prestaciones</a></li>
                                <li class="breadcrumb-item">Cargar nueva</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ form-element ] start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Cargar Solicitud </h5>
                            <hr>
                            <?php if (!empty($Mensaje2)) { ?>
                                <?php echo $Mensaje2; ?>
                            <?php } ?>
                            <div class="alert alert-info" role="alert">
                                <i data-feather="info"></i>
                                Los campos con * son obligatorios.
                            </div>

                            <form role="form" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Indique el Paciente (*)
                                            </label>
                                            <select class="form-control" name="pacientes"
                                                id="exampleFormControlSelect1">
                                                <option >Selecciona una opción...</option>
                                                <?php for ($i = 0; $i < $CantidadPacientes; $i++) { ?>
                                                    <option value="<?php echo $ListaPacientes[$i]['ID']; ?>"> <?php echo $ListaPacientes[$i]['APELLIDO']; ?>&nbsp;<?php echo $ListaPacientes[$i]['NOMBRE']; ?>&nbsp;(<?php echo $ListaPacientes[$i]['DNI']; ?>)</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Seleccione Prestación (*)</label>
                                            <select class="form-control" name="sesiones" id="exampleFormControlSelect2">
                                                <option value="">Selecciona una opción...</option>
                                                <?php

                                                for ($x = 0; $x < $CantidadSesiones; $x++) { ?>
                                                    <option value="<?php echo $ListaSesiones[$x]['ID'] ?>">
                                                        <?php echo $ListaSesiones[$x]['SESIONES'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Ingrese el Diagnóstico</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="datepicker">Ingresa Fecha y Hora (*)</label>
                                        <div class="col-md-3">
                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input name="fecha" class="form-control" type="date" id="datepicker"
                                                    placeholder="Selecciona fecha">
                                            </div>

                                            <div class="md-form md-outline input-with-post-icon datepicker">
                                                <input class="form-control" placeholder="Selecciona hora" type="text"
                                                    id="datetime" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" value="Registrar" name="BtnRegistrar"
                                            class="btn  btn-primary">Registrar</button>
                                        <input class="btn btn-secondary" type="reset" value="Limpiar datos">
                                        <a class="btn btn-light" href="direccionar_index.inc.php" role="button">Volver a Home</a>
                                    </div>

                                </div>
                            </form>


                            <script>
                                $('#datetime').datetimepicker({
                                    format: 'HH:mm:ss'
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <!-- [ form-element ] end -->
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </section>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="assets/js/plugins/clipboard.min.js"></script>
    <script src="assets/js/uikit.min.js"></script>

    <script>


        // header option
        $('#pct-toggler').on('click', function () {
            $('.pct-customizer').toggleClass('active');

        });
        // header option
        $('#cust-sidebrand').change(function () {
            if ($(this).is(":checked")) {
                $('.theme-color.brand-color').removeClass('d-none');
                $('.m-header').addClass('bg-dark');
            } else {
                $('.m-header').removeClassPrefix('bg-');
                $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
                $('.theme-color.brand-color').addClass('d-none');
            }
        });
        // Header Color
        $('.brand-color > a').on('click', function () {
            var temp = $(this).attr('data-value');
            // $('.header-color > a').removeClass('active');
            // $('.pcoded-header').removeClassPrefix('brand-');
            // $(this).addClass('active');
            if (temp == "bg-default") {
                $('.m-header').removeClassPrefix('bg-');
            } else {
                $('.m-header').removeClassPrefix('bg-');
                $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
                $('.m-header').addClass(temp);
            }
        });
        // Header Color
        $('.header-color > a').on('click', function () {
            var temp = $(this).attr('data-value');
            // $('.header-color > a').removeClass('active');
            // $('.pcoded-header').removeClassPrefix('brand-');
            // $(this).addClass('active');
            if (temp == "bg-default") {
                $('.pc-header').removeClassPrefix('bg-');
            } else {
                $('.pc-header').removeClassPrefix('bg-');
                $('.pc-header').addClass(temp);
            }
        });
        // sidebar option
        $('#cust-sidebar').change(function () {
            if ($(this).is(":checked")) {
                $('.pc-sidebar').addClass('light-sidebar');
                $('.pc-horizontal .topbar').addClass('light-sidebar');
                // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo-dark.svg');
            } else {
                $('.pc-sidebar').removeClass('light-sidebar');
                $('.pc-horizontal .topbar').removeClass('light-sidebar');
                // $('.m-header > .b-brand > .logo-lg').attr('src', 'assets/images/logo.svg');
            }
        });
        $.fn.removeClassPrefix = function (prefix) {
            this.each(function (i, it) {
                var classes = it.className.split(" ").map(function (item) {
                    return item.indexOf(prefix) === 0 ? "" : item;
                });
                it.className = classes.join(" ");
            });
            return this;
        };
    </script>
</body>

</html>