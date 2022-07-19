<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Caja Apertura</title>

<div id="app">
    <?php require_once 'views/layout/sideBar.php' ?>
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-money-1"></i>
                            Caja
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link active" href="<?=base_url?>Caja/AperturaCaja"><i class="icon icon-money2"></i>Apertura Caja</a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?=base_url?>Caja/CierreCaja" ><i class="icon icon-money-bag"></i>Cierre Caja</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="content-wrapper animatedParent animateOnce">
            <div class="container-fluid">
                <section class="paper-card">
                    <div class="row justify-content-center">
                        <div class="col-lg-7 mb-3">
                            <form action="<?=base_url?>Caja/AperturaCaja" method="post">
                                <div class="card no-b no-r">
                                    <div class="card-body">
                                        <h5 class="card-title">Datos Caja</h5>
                                        <div class="form-row">
                                            <div class="form-group col-6 m-0">
                                                <label class="col-form-label s-12">Fecha Apertura</label>
                                                <input type="text" class="form-control r-0 light s-12" value="<?= date('Y-m-d h:m:s') ?>" disabled>
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                <label class="col-form-label s-12">Monto Apertura</label>
                                                <input type="number" class="form-control r-0 light s-12" placeholder="Ingresar Monto" name="monto_apertura" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-lg col-md-12"><i class="icon-money2 mr-2"></i>Abrir Caja</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <!-- tabla -->
                                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Monto Apertura</th>
                                            <th>Monto Sin Cierre</th>
                                            <th>Monto Actual Mas Cierre</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($caja = $listaCaja->fetchObject()): ?>
                                            <tr>
                                                <td><?= $caja->cod_caja ?></td>
                                                <td><?= $caja->fecha_inicio ?></td>
                                                <td><?= $caja->fecha_fin ?></td>
                                                <td><?= $caja->monto_apertura ?></td>
                                                <td><?= $caja->monto_sin_cierre ?></td>
                                                <td><?= $caja->monto_actual_mas_cierre ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                    <!-- tabla -->
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
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<?php if (!empty($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            title: "<?=$_SESSION['message'][0]?>",
            text: "<?=$_SESSION['message'][1]?>",
            icon: "<?=$_SESSION['message'][2]?>"
        })
    </script>
<?php endif; unset($_SESSION['message']); ?>
