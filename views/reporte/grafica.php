<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Graficos</title>

<div id="app">
    <?php require_once 'views/layout/sideBar.php' ?>
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-bar-chart2"></i>
                            Graficas
                        </h4>
                    </div>
                </div>
            </div>
        </header>
        <div class="content-wrapper animatedParent animateOnce">
            <div class="container-fluid">
                <section class="paper-card">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                                <div class="card no-b no-r">
                                    <div class="card-body">
                                        <h5 class="card-title">Clientes de mayor reservacion</h5>
                                        <div style="height: 400px">
                                            <canvas
                                                    data-chart="bar"
                                                    data-dataset="[<?=$tresDatos;?>]"
                                                    data-labels="<?=$tresEncabezado;?>"
                                                    data-dataset-options="[{borderColor:  'rgba(106, 90, 205, 1)', backgroundColor: 'rgba(106, 90, 205, 0.2)'}]">
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="card no-b no-r">
                                <div class="card-body">
                                    <h5 class="card-title">Cliente con mayor ocupacion</h5>
                                    <div style="height: 400px">
                                        <canvas
                                                data-chart="bar"
                                                data-dataset="[<?=$cincoDatos;?>]"
                                                data-labels="<?=$cincoEncabezado;?>"
                                                data-dataset-options="[{borderColor:  'rgba(255,99,132,1)', backgroundColor: 'rgba(255, 99, 132, 0.2)'}]">
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="card no-b no-r">
                                <div class="card-body">
                                    <h5 class="card-title">Ganancia</h5>
                                    <div style="height: 400px">
                                        <canvas
                                                data-chart="bar"
                                                data-dataset="[<?=$cuatroDatos;?>]"
                                                data-labels="['Ganancia']"
                                                data-dataset-options="[{borderColor:  'rgba(255, 165, 0, 1)', backgroundColor: 'rgba(255, 165, 0, 0.2)'}]">
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
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
