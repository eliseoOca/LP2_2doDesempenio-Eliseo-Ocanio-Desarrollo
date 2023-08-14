<?php
session_start();


if (empty($_SESSION['usuario_nombre'])) {
    header('Location: cerrar_sesion.inc.php');
    exit;
}

require_once 'conexion/conexion.php';
$Miconexion = ConexionBD();

require_once 'funciones/salect_turnero.php';
require_once 'funciones/validaciones.inc.php';
require_once 'funciones/salect_turnero_por_id_usuario.php';
$selectTurnos = array();
if (getDatosTurneroPorNivel($_SESSION['usuario_id_rango'])) {
    if ($_SESSION['usuario_id_rango'] == 3) {
        $selectTurnos = Listar_turnero_por_id_usuario($Miconexion, $_SESSION['usuario_id']);
    } else {
        $selectTurnos = Listar_turnero_por_id_medico($Miconexion, $_SESSION['usuario_id']);
    }
} else {
    $selectTurnos = Listar_turnero($Miconexion);
}
$cantidadTurnos = count($selectTurnos);
$mensajeTituloValido = validarMensajeTituloPorNivel($_SESSION['usuario_id_rango']);

//validacion de precio}
function validarMensajePrecio($precio, $idRango, $porcentaje)
{
    $mensajePrecio = '';
    if($idRango == 2){
        return $mensajePrecio;
    }
    if (!empty($precio) || !is_null($precio)) {
        $mensajePrecio = 'Monto a abonar: $' . (($precio * $porcentaje)/100 );
    }
    return $mensajePrecio;
}

function validarFormatoEstadoTurno($idEstadoTurno)
{
    $estilo = '';

    if ($idEstadoTurno == 1) {
        $estilo = 'table-success';
    }

    if ($idEstadoTurno == 2) {
        $estilo = 'table-warning';
    }

    return $estilo;

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

                    <?php if (validarPermisoUsuario($_SESSION['usuario_id_rango']) == 1): ?>

                        <?php if ($_SESSION['usuario_id_rango'] == 2): ?>
                        <li class="pc-item"><a href="direccionar_carga.inc.php" class="pc-link ">
                                <span class="pc-micon"><i data-feather="layout"></i></span>
                                <span class="pc-mtext">Cargar nuevo Turno</span></a>
                        </li>                        
                        <?php endif; ?>

                        <?php if ($_SESSION['usuario_id_rango'] == 4): ?>
                            <li class="pc-item"><a href="direccionar_carga_prestaciones.inc.php" class="pc-link ">
                                <span class="pc-micon"><i data-feather="layout"></i></span>
                                <span class="pc-mtext">Cargar nueva Prestación</span></a>
                            </li>                      
                        <?php endif; ?>
                        
                    <?php endif; ?>

                    <li class="pc-item pc-caption">
                        <label>Listados</label>
                    </li>
                    <li class="pc-item"><a href="Location: listado.php" class="pc-link ">
                            <span class="pc-micon"><i data-feather="list"></i></span>
                            <span class="pc-mtext">Listado total</span></a>
                        <span class="pc-mtext">Listado mis turnos</span></a>
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
                            <div class="page-header-title">
                                <h5 class="m-b-10">Prestaciones</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="menu.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="#!">Listados</a></li>
                                <li class="breadcrumb-item">
                                    <?php echo $mensajeTituloValido ?>
                                </li>
                                <!-- ver los titulos solicitados en el pdf-->

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Contextual-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <?php echo $mensajeTituloValido ?> (
                            <?php echo $cantidadTurnos ?>)
                        </h5>
                    </div>
                    <!-- ver los titulos solicitados en el pdf y en (xx) poder ver la cantidad de registros visualizados-->

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <!-- ver columnas y datos solicitados para cada nivel -->
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Obra social</th>
                                        <th>Solicitante</th>
                                        <th>Prestación</th>
                                        <th>
                                            <?php if (validarBotonesAccionesPorNivel($_SESSION['usuario_id_rango']) == 1): ?>
                                                Acciones
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < $cantidadTurnos; $i++) { ?>
                                        <?php if (!empty($selectTurnos[$i]['PRECIO'])) {
                                            $mensajePrecio = 'Monto a abonar: $' . $selectTurnos[$i]['PRECIO'];
                                        } ?>
                                        <tr
                                            class="<?php echo validarFormatoEstadoTurno($selectTurnos[$i]['ESTADO_TURNO']) ?>">
                                            <td>
                                                <?php echo $selectTurnos[$i]['ID'] ?>
                                            </td>
                                            <td>
                                                <?php echo $selectTurnos[$i]['FECHA'] ?>
                                            </td>
                                            <td>
                                                <?php echo $selectTurnos[$i]['NOMBRE_PACIENTE'] ?>
                                            </td>
                                            <td>
                                                <?php echo $selectTurnos[$i]['OBRA_SOCIAL'] ?>
                                            </td>
                                            <td>
                                                <?php echo $selectTurnos[$i]['ESPECIALISTA'] ?>
                                            </td>
                                            <td>
                                                <?php echo $selectTurnos[$i]['SESIONES'] ?> <br />
                                                <?php echo validarMensajePrecio($selectTurnos[$i]['PRECIO'], $_SESSION['usuario_id_rango'],$selectTurnos[$i]['PORCENJATE_PRESTACION']) ?>
                                            </td>
                                            <td>
                                                <?php if (validarBotonesAccionesPorNivel($_SESSION['usuario_id_rango']) == 1): ?>
                                                    <a href="#!" title="Asistencia/Inasistencia Turno"><i
                                                            class="icon feather icon-clock f-20  text-success"></i></a>
                                                    <a href="#!" title="Cancelar turno"><i
                                                            class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                                </td>

                                            <?php endif; ?>

                                        </tr>

                                        <!-- <tr class="table-warning" title="Este turno figura no asistido">
                                        <td></td>
                                        
                                        <td><?php echo $SePacientes[$i]['APELLIDO']; ?></td>
                                        <td><?php echo $SePacientes[$i]['NOMBRE']; ?></td>
                                        <td><?php echo $SePacientes[$i]['ESPECIALISTA']; ?></td>
                                        <td><?php echo $SePacientes[$i]['SESIONES']; ?></td>
                                        <td>
                                            <a href="#!" title="Asistencia/Inasistencia Turno"><i class="icon feather icon-clock f-20  text-success"></i></a>
                                            <a href="#!" title="Cancelar turno"><i class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                        </td>
                                    </tr>-->

                                        <!-- <tr class="table-success" title="Este turno figura asistido">
                                        <td>2</td>
                                        <td>05/06/2023<br />08:30:00</td>
                                        <td>Echeverri Juliana</td>
                                        <td>OSDE</td>
                                        <td>Dr. Saude Mauricio</td>
                                        <td>Sesiones de Psicologia</td>
                                        <td>
                                            <a href="#!" title="Asistencia/Inasistencia Turno"><i class="icon feather icon-clock f-20  text-success"></i></a>
                                            <a href="#!" title="Cancelar turno"><i class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="table-success" title="Este turno figura asistido">
                                        <td>3</td>
                                        <td>05/06/2023<br /> 08:00:00</td>
                                        <td>Navarro Gloria</td>
                                        <td>Swiss Medical</td>
                                        <td>Dra. Moreno Trinidad</td>
                                        <td>Tomografía (TAC) <br />Monto a abonar: $1500</td>
                                        <td>
                                            <a href="#!" title="Asistencia/Inasistencia Turno"><i class="icon feather icon-clock f-20  text-success"></i></a>
                                            <a href="#!" title="Cancelar turno"><i class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>4</td>
                                        <td>06/06/2023<br />09:00:00</td>
                                        <td>Zapata Cristina</td>
                                        <td>OSDE</td>
                                        <td>Dra. Moreno Trinidad</td>
                                        <td>Tomografía (TAC)  <br />Monto a abonar: $1500</td>  
                                        <td>
                                            <a href="#!" title="Asistencia/Inasistencia Turno"><i class="icon feather icon-clock f-20  text-success"></i></a>
                                            <a href="#!" title="Cancelar turno"><i class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                        </td>
                                    </tr>
                                                                                                           </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>06/06/2023<br />09:00:00</td>
                                        <td>Echeverri Juliana</td>
                                        <td>OSDE</td>
                                        <td>Dr. Saude Mauricio</td>
                                        <td>Resonancia Magnética  <br />Monto a abonar: $2500</td>
                                        <td>
                                            <a href="#!" title="Asistencia/Inasistencia Turno"><i class="icon feather icon-clock f-20  text-success"></i></a>
                                            <a href="#!" title="Cancelar turno"><i class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>06/06/2023<br />10:00:00</td>
                                        <td>Navarro Gloria</td>
                                        <td>Swiss Medical</td>
                                        <td>Dr. Gonzalez Jose</td>
                                        <td>Resonancia Magnética  <br />Monto a abonar: $2500</td>
                                        <td>
                                            <a href="#!" title="Asistencia/Inasistencia Turno"><i class="icon feather icon-clock f-20  text-success"></i></a>
                                            <a href="#!" title="Cancelar turno"><i class="feather icon-trash-2 ml-3 f-20 text-danger"></i></a>
                                        </td>
                                    </tr>-->
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Contextual-table ] end -->

            <?php if ($_SESSION['usuario_id_rango'] != 2): ?>
                <!-- support-section start -->
                <div class="col-xl-6 col-md-12">
                    <div class="card flat-card">
                        <div class="row-table">
                            <div class="col-sm-6">
                                <div class="card prod-p-card background-pattern">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-0">
                                            <div class="col">
                                                <h6 class="m-b-5">Cantidad de Prestaciones Complejas</h6>
                                                <h3 class="m-b-0">
                                                    <?php echo sumarPrestacionesComplejas($selectTurnos) ?>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-tags text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card prod-p-card bg-primary background-pattern-white">
                                    <div class="card-body">
                                        <div class="row align-items-center m-b-0">
                                            <div class="col">
                                                <h6 class="m-b-5 text-white">Total Recaudación</h6>
                                                <h3 class="m-b-0 text-white">$
                                                    <?php echo sumarPrecioPrestacionesComplejas($selectTurnos) ?>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-money-bill-alt text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

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


</body>

</html>