<?php require_once 'views/layout/head.php' ?>
    <link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
    <title>Check Out</title>
    <div id="app">
        <?php require_once 'views/layout/sideBar.php' ?>

        <div class="page has-sidebar-left height-full">
            <header class="blue accent-3 relative nav-sticky">
                <div class="container-fluid text-white">
                    <div class="row p-t-b-10 ">
                        <div class="col">
                            <h4>
                                <i class="icon-arrow-left"></i>
                                Check Out
                            </h4>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container-fluid relative animatedParent animateOnce">
                <div class="tab-content pb-3" id="v-pills-tabContent">
                    <!--Today Tab Start-->
                    <div class="row my-3">
                        <?php while ($reserva = $dataReserva->fetchObject()): ?>
                            <a href="<?=base_url?>CheckOut/Salida&cod_reserva=<?=$reserva->cod_reserva?>&cod_habitacion=<?=$reserva->cod_habitacion?>" class="col-md-3 mt-2">
                                <div class="counter-box white r-5 p-3 bg-secondary">
                                    <div class="p-4">
                                        <h5 class="counter-title white-text">Nombre Cliente: <?=$reserva->nombre_cliente?></h5>
                                        <h5 class="mt-2 white-text mb-3">Documento Cliente: <?=$reserva->documento?></h5>
                                        <div class="counter-title white-text">Fecha Inicio: <?=$reserva->fecha_inicio?></div>
                                        <p class="text-white s-12 mt-2">Fecha Fin: <?=$reserva->fecha_fin?></p>
                                        <p class="text-white mt-2"><span class="badge bg-success">Adelanto: <?=$reserva->adelanto?></span></p>
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