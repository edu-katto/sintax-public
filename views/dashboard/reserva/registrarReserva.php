<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Registrar Reservacion</title>

<div id="app">
    <?php require_once 'views/layout/sideBar.php' ?>
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10">
                    <div class="col">
                        <h4>
                            <i class="icon-calendar"></i>
                            Reservacion
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
        <div class="container-fluid animatedParent animateOnce">
            <div class="animated fadeInUpShort">
                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <form action="<?=base_url?>Reserva/RegistrarReserva" method="post">
                            <div class="card no-b no-r">
                                <div class="card-body">
                                    <h5 class="card-title">Datos Reserva</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Nombre Habitacion: <?=$habita->nombre?></p>
                                            <p>Precio Habitacion: <?=$habita->precio?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Descripcion Habitacion: <?=$habita->detalle?></p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-12 m-0">
                                                    <label class="my-1 mr-2">Cliente</label>
                                                    <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12 js-select2" name="cliente" required>
                                                        <?php while ($list = $listaCliente->fetchObject()):?>
                                                            <option value="<?=$list->cod_cliente?>"><?=$list->documento?> - <?=$list->nombre?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12">Fecha Inicio</label>
                                                    <input class="form-control r-0 light s-12 " type="datetime-local" name="fecha_inicio" required>
                                                </div>
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12">Fecha Fin</label>
                                                    <input class="form-control r-0 light s-12 " type="datetime-local" name="fecha_fin" required>
                                                </div>
                                            </div>
                                            <div class="form-group m-0">
                                                <label class="col-form-label s-12">Monto Adelanto</label>
                                                <input class="form-control r-0 light s-12 " value="<?=$habita->precio?>" type="number" name="monto_adelanto" required>
                                                <input value="<?=$habita->cod_habitacion?>" type="hidden" name="cod_habitacion" required>
                                            </div>
                                            <div class="form-row">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Registrar Reservacion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'views/layout/footer.php' ?>
<script>
    $(document).ready(function() {
        $('.js-select2').select2({
            theme: 'bootstrap4',
            closeOnSelect: false
        });
    });
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