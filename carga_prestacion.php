<?php
session_start();
require_once "funciones/validaciones.inc.php";
require_once "funciones/insertar_prestacion.php";
require_once 'conexion/conexion.php';
$Miconexion = ConexionBD();

if (empty($_SESSION['usuario_nombre']) || !validarAccesoCargaPrestacion($_SESSION['usuario_id_rango'])) {
    header('Location: cerrar_sesion.inc.php');
    exit;
}
$mensajeValidacion = '';
if (!empty($_POST['btnRegistrar'])) {

    $mensajeValidacion = validarCargaPrestacion($_POST["nombre"], isset($_REQUEST["compleja"]), $_POST["precio"], $_POST["porcentaje"]);
    if (empty($mensajeValidacion)){
        $mensajeValidacion = insertar_prestacion($Miconexion,$_POST["nombre"], $_POST["precio"], $_POST["porcentaje"], isset($_REQUEST["compleja"]), isset($_REQUEST["activa"]), $_SESSION['usuario_email']);
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
                        <label>Administracion del sitio</label>
                    </li>

                    <li class="pc-item"><a href="direccionar_carga_prestaciones.inc.php" class="pc-link ">
                            <span class="pc-micon"><i data-feather="layout"></i></span>
                            <span class="pc-mtext">Cargar nueva Prestación</span></a>
                    </li>



                    <li class="pc-item pc-caption">
                        <label>Listados</label>
                    </li>
                    <li class="pc-item"><a href="direccionar_listado.inc.php" class="pc-link ">
                            <span class="pc-micon"><i data-feather="list"></i></span>
                            <span class="pc-mtext">Listado de turnos</span></a>
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
                            <form class="px-3" method="post">
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
                            <img src="assets/images/user/<?php echo $_SESSION['usuario_img'] ?>" alt="user-image"
                                class="user-avtar">
                            <span>
                                <span class="user-name">
                                    <?php echo $_SESSION['usuario_nombre'] . ' ' . $_SESSION['usuario_apellido'] ?>
                                </span>
                                <span class="user-desc">
                                    <?php echo $_SESSION['usuario_rango'] ?>
                                </span>
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

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#!">Administracion Sitio</a></li>
                                <li class="breadcrumb-item">Cargar nueva Prestación</li>
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
                            <h5>Cargar Prestación Medica </h5>
                            <hr>                            

                            <?php if (!empty($mensajeValidacion)) { ?>
                                <?php echo $mensajeValidacion ?>
                            <?php } ?>


                            <div class="alert alert-info" role="alert">
                                <i data-feather="info"></i>
                                Los campos con * son obligatorios. 
                            </div>

                            <form method="post">

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlText1">Ingrese el nombre (*)</label>
                                            <input class="form-control" type="text" placeholder="Nombre" name="nombre"
                                                id="exampleFormControlText1">
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlText2">Ingrese el Precio</label>
                                            <input class="form-control" type="text" placeholder="Precio" name="precio"
                                                id="exampleFormControlText2">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlText3">Ingrese el Porcentaje </label>
                                            <input class="form-control" type="text" placeholder="Porcentaje"
                                                name="porcentaje" id="exampleFormControlText3">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input input-secondary"
                                                name="compleja" id="customCheckdefh1">
                                            <label class="custom-control-label" for="customCheckdefh1">Compleja</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input input-primary"
                                                name="activa" id="customCheckdefh2" checked="">
                                            <label class="custom-control-label" for="customCheckdefh2">Activa</label>
                                        </div>
                                    </div>



                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button class="btn  btn-primary" value="hola"
                                            name="btnRegistrar">Registrar</button>
                                        <a class="btn btn-light" href="direccionar_index.inc.php" role="button">Volver a
                                            Home</a>

                                    </div>
                                </div>
                            </form>
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