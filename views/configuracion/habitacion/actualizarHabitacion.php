<?php require_once 'views/layout/head.php' ?>
<link rel="stylesheet" href="<?=base_url?>views/assets/css/login.css">

<?php require_once 'views/layout/preload.php' ?>
<title>Actualizar Habitacion</title>

<div id="app">
    <?php require_once 'views/layout/sideBar.php' ?>
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-bed"></i>
                            Actualizar Habitacion
                        </h4>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid animatedParent animateOnce">
            <div class="animated fadeInUpShort">
                <div class="row my-3 justify-content-center">
                    <div class="col-md-6">
                        <form action="<?=base_url?>Configuracion/ActualizarHabitacion" method="post">
                            <div class="card no-b no-r">
                                <div class="card-body">
                                    <h5 class="card-title">Datos Habitacion</h5>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12">Nombre Habitacion</label>
                                                    <input placeholder="Ingresar Nombre" value="<?=$data->nombre?>" class="form-control r-0 light s-12 " type="text" disabled>
                                                    <input type="hidden" name="cod_habitacion" value="<?=$data->cod_habitacion?>">
                                                </div>
                                                <div class="form-group col-6 m-0">
                                                    <label class="col-form-label s-12">Precio Habitacion</label>
                                                    <input placeholder="Ingresar Precio" value="<?=$data->precio?>" class="form-control r-0 light s-12 " type="number" name="precio_habitacion" required>
                                                </div>
                                            </div>
                                            <div class="form-group m-0">
                                                <label class="col-form-label s-12">Detalle Habitacion</label>
                                                <textarea class="form-control r-0 light s-12" name="detalle_habitacion" rows="3" required><?=$data->detalle?></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6 m-0">
                                                    <label class="my-1 mr-2">Tipo Habitacion</label>
                                                    <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" disabled>
                                                        <?php while ($tipoHabitacion = $listaTipoHabitacion->fetchObject()):?>
                                                            <option <?= $tipoHabitacion->cod_tipo_habitacion == $data->cod_tipo_habitacion ? 'selected' : '' ?> value="<?=$tipoHabitacion->cod_tipo_habitacion?>"><?=$tipoHabitacion->habitacion?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-6 m-0">
                                                    <label class="my-1 mr-2">Piso Habitacion</label>
                                                    <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" disabled>
                                                        <?php while ($pisoHabitacion = $listaPisoHabitacion->fetchObject()):?>
                                                            <option <?= $pisoHabitacion->cod_nivel_habitacion == $data->cod_nivel_habitacion ? 'selected' : '' ?> value="<?=$pisoHabitacion->cod_nivel_habitacion?>"><?=$pisoHabitacion->nivel_habitacion?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary btn-lg"><i class="icon-exchange mr-2"></i>Actualizar Habitacion</button>
                                    <a href="<?=base_url?>Configuracion/ListaHabitacion" class="btn btn-warning btn-lg"><i class="icon-chevron-left mr-2"></i>Regresar</a>
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
<?php if (!empty($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            title: "<?=$_SESSION['message'][0]?>",
            text: "<?=$_SESSION['message'][1]?>",
            icon: "<?=$_SESSION['message'][2]?>"
        })
    </script>
<?php endif; unset($_SESSION['message']); ?>