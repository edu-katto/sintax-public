<?php require_once 'views/layout/head.php' ?>
    <link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
    <title>Administración</title>
    <div id="app">
        <?php require_once 'views/layout/sideBar.php' ?>

        <div class="page has-sidebar-left height-full">
            <header class="blue accent-3 relative nav-sticky">
                <div class="container-fluid text-white">
                    <div class="row p-t-b-10 ">
                        <div class="col">
                            <h4>
                                <i class="icon-hotel"></i>
                                Crear Reserva
                            </h4>
                        </div>
                    </div>
                    <div class="row ">
                        <ul class="nav responsive-tab nav-material nav-material-white">
                            <li>
                                <a class="nav-link" href="<?=base_url?>DashBoard/Reserva" ><i class="icon icon-list"></i>Cuadro de reservaciones</a>
                            </li>
                            <li>
                                <a class="nav-link active" href="<?=base_url?>Reserva/RegistrarReserva"><i class="icon icon-clipboard-add"></i>Crear reservacion</a>
                            </li>
                            <li>
                                <a class="nav-link" href="<?=base_url?>Reserva/ListaReserva"><i class="icon icon-trash-can"></i>Lista de reservaciones</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="container-fluid relative animatedParent animateOnce">
                <div class="tab-content pb-3" id="v-pills-tabContent">
                    <!--Today Tab Start-->
                    <div class="row my-3">
                        <?php while ($habitacion = $habitaciones->fetchObject()): ?>
                            <a href="<?=base_url?>Reserva/RegistrarReserva&cod_habitacion=<?=$habitacion->cod_habitacion?>" class="col-md-3 mt-2">
                                <div class="counter-box white r-5 p-3 bg-secondary">
                                    <div class="p-4">
                                        <div class="float-right">
                                            <span class="icon icon-hotel text-white s-48"></span>
                                        </div>
                                        <div class="counter-title white-text"><?=$habitacion->habitacion?></div>
                                        <h4 class="mt-2 white-text"><?=$habitacion->nombre?></h4>
                                        <div class="counter-title white-text"><?=$habitacion->nivel_habitacion?></div>
                                        <p class="text-white s-12 mt-2"><?=$habitacion->detalle?></p>
                                        <p class="text-white mt-2"><span class="badge bg-success">Precio: <?=$habitacion->precio?></span></p>
                                    </div>
                                    <div class="progress progress-xs r-0"></div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="control-sidebar-bg shadow white fixed"></div>
    </div>

<?php require_once 'views/layout/footer.php' ?>
<?php if (!empty($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            title: "<?=$_SESSION['message'][0]?>",
            text: "<?=$_SESSION['message'][1]?>",
            icon: "<?=$_SESSION['message'][2]?>"
        })
    </script>
<?php endif; unset($_SESSION['message']); ?>