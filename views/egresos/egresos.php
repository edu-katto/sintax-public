<?php require_once 'views/layout/head.php' ?>
    <link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
    <title>Egresos</title>

    <div id="app">
        <?php require_once 'views/layout/sideBar.php' ?>
        <div class="page has-sidebar-left height-full">
            <header class="blue accent-3 relative">
                <div class="container-fluid text-white">
                    <div class="row p-t-b-10 ">
                        <div class="col">
                            <h4>
                                <i class="icon-money-1"></i>
                                Egresos
                            </h4>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content-wrapper animatedParent animateOnce">
                <div class="container-fluid">
                    <section class="paper-card">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 mb-3">
                                <form action="<?=base_url?>Egresos/Registrar" method="post">
                                    <div class="card no-b no-r">
                                        <div class="card-body">
                                            <h5 class="card-title">Datos Egresos</h5>
                                            <div class="form-row">
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12">Egreso</label>
                                                    <input type="text" name="egreso" class="form-control r-0 light s-12">
                                                </div>
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12">Fecha Egreso</label>
                                                    <input type="datetime-local" name="fecha_egreso" class="form-control r-0 light s-12" value="<?= date('Y-m-d\TH:m:s') ?>">
                                                </div>
                                                <div class="form-group col-12 m-0">
                                                    <label class="col-form-label s-12">Descipcion</label>
                                                    <textarea class="form-control r-0 light s-12" name="detalle" rows="3" required></textarea>
                                                </div>
                                                <div class="form-group col-12 m-0">
                                                    <label class="col-form-label s-12">monto</label>
                                                    <input type="number" name="monto" class="form-control r-0 light s-12" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary btn-lg col-md-12"><i class="icon-money2 mr-2"></i>Registrar Egreso</button>
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
                                                <th>Egreso</th>
                                                <th>Descripcion</th>
                                                <th>Fecha Egreso</th>
                                                <th>Monto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php while ($egreso = $listaEgreso->fetchObject()): ?>
                                                <tr>
                                                    <td><?= $egreso->cod_egreso ?></td>
                                                    <td><?= $egreso->egreso ?></td>
                                                    <td><?= $egreso->descripcion ?></td>
                                                    <td><?= $egreso->fecha_egreso ?></td>
                                                    <td><?= $egreso->monto ?></td>
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